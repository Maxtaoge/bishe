<?php
//zend54   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php
function shutdown()
{
	$pages = array("arthome", "article", "artlist", "category", "class", "index", "play", "read", "rss", "search", "sendpwd");
	if (in_array(PHPSELF, $pages) && (RUN_FOOTER !== true)) {
		footer();
	}
}

function gdconfirm($code)
{
	cookie("cknum", "", 0);
	if (!$code || !safecheck(explode("\t", strcode(getcookie("cknum"), "DECODE")), strtoupper($code), "cknum", 300)) {
		return false;
	}
	else {
		return true;
	}
}

function userinfo($uid, $password)
{
	$db = &$GLOBALS["db"];
	$u = $db->get_one("SELECT m.*,md.* FROM pv_members m LEFT JOIN pv_memberdata md ON m.uid=md.uid WHERE m.uid='$uid' AND m.password='$password'");

	if (!$u) {
		unset($u);
		$GLOBALS["groupid"] = "guest";
		cookie("user", "", 0);
		showmsg("password_change", "showmsg_login", "login.php");
	}
	else {
		unset($u["password"]);
		return $u;
	}
}

function refreshto($url, $content, $str = "", $statime = 2)
{
	$db_charset = &$GLOBALS["db_charset"];
	$db_wwwname = &$GLOBALS["db_wwwname"];
	$db_wwwurl = &$GLOBALS["db_wwwurl"];
	$imgpath = &$GLOBALS["imgpath"];
	$stylepath = &$GLOBALS["stylepath"];
	$url = str_replace("&#61;", "=", $url);
	ob_end_clean();
	obstart();
	include_once getlang("refreshto");
	$lang[$content] && ($content = $lang[$content]);
	include_once gettpl("refreshto");
	exit();
}

function obheader($url)
{
	ob_end_clean();
	header("Location: $url");
	exit();
}

function showmsg($msgkey, $atext = "", $jumpurl = "", $values = array(), $second = 3)
{
	pv_define_const("CALL_SHOWMSG_FUN", "1", true);
	define("PHPFUNC", "showmsg");
	@extract($GLOBALS, EXTR_SKIP);

	if (defined("PHPVOD_HACK_ROOT")) {
		include_once PHPVOD_HACK_ROOT . "lang/msg.php";

		if (!isset($lang[$msgkey])) {
			include_once getlang("msg");
		}
	}
	else {
		include_once getlang("msg");
	}

	if (isset($lang[$msgkey])) {
		$msg = lang_replace($lang[$msgkey], $values);
	}
	else {
		$msg = $msgkey;
	}

	if ($atext != "") {
		$text = lang($atext);
	}
	else {
		$text = lang("showmsg_goback");
	}

	if ($jumpurl != "") {
		if ($jumpurl == "goback") {
			$url = "javascript:history.go(-1);";
		}
		else {
			$url = $jumpurl;
			$ifjump = "<meta http-equiv='Refresh' content='$second; url=$jumpurl'>";
		}
	}
	else if (!$url) {
		$url = $http_referer;
	}

	if (strpos($servar["HTTP_USER_AGENT"], "MSIE 7.0;") !== false) {
		list($url) = explode("#", $url);
		list($jumpurl) = explode("#", $jumpurl);
	}

	require_once PHPVOD_ROOT . "require/header.php";
	require_once gettpl("showmsg");
	echo "<script language=\"javascript\" src=\"http://service.phpvod.com/data/advert/showmsg.js\" charset=\"utf-8\"></script>";
	footer();
}

function getlang($lang, $ext = "php")
{
	$path = PHPVOD_ROOT . "lang/lang_$lang.$ext";
	return $path;
}

function gettpl($template, $ext = "htm")
{
	$tplpath = &$GLOBALS["tplpath"];
	$db_tplrefresh = &$GLOBALS["db_tplrefresh"];
	empty($template) && ($template = "N");
	$tplfile = PHPVOD_ROOT . "template/$tplpath/$template.$ext";

	if (file_exists($tplfile)) {
		$objfile = PHPVOD_ROOT . "data/template/$tplpath/$template.tpl.php";
		if (($db_tplrefresh == 1) && (@filemtime($objfile) < @filemtime($tplfile))) {
			parse_template($tplpath, $template, $ext);
		}
	}
	else {
		$objfile = PHPVOD_ROOT . "data/template/phpvod/$template.tpl.php";
	}

	return $objfile;
}

function footer()
{
	$db_copyright = &$GLOBALS["db_copyright"];
	$db_icp = &$GLOBALS["db_icp"];
	$db_icpurl = &$GLOBALS["db_icpurl"];
	$db_wwwname = &$GLOBALS["db_wwwname"];
	$db_ceoconnect = &$GLOBALS["db_ceoconnect"];
	$db_ceoemail = &$GLOBALS["db_ceoemail"];
	$groupid = &$GLOBALS["groupid"];
	$version = &$GLOBALS["version"];
	$vertype = &$GLOBALS["vertype"];
	$db_htmifopen = &$GLOBALS["db_htmifopen"];
	$db_obstart = &$GLOBALS["db_obstart"];
	$db_statcode = &$GLOBALS["db_statcode"];
	$db_timedf = &$GLOBALS["db_timedf"];
	$db = &$GLOBALS["db"];
	$runtime = runtime_end();
	$db_icp && ($db_icp = ($db_icpurl ? "<a href=\"$db_icpurl\" target=\"_blank\">$db_icp</a>" : "<a href=\"http://www.miibeian.gov.cn\">$db_icp</a>"));
	call_listener("footer");
	include gettpl("footer");
	$GLOBALS["output"] = ob_get_contents();
	call_listener("output");
	$output = $GLOBALS["output"];
	unset($GLOBALS["output"]);
	$powered = "<a href='http://www.phpvod.com' target=\"_blank\">Powered by phpvod $version $vertype</a>";
	$generator = "<meta name=\"generator\" content=\"phpvod $version $vertype\" />";
	$author = "<meta name=\"author\" content=\"phpvod.com\" />";
	$copyright = "<meta name=\"copyright\" content=\"Copyright 2009-2099 by phpvod.com\" />";
	$output = preg_replace("/\<\/head\>/i", "{$generator}\n$author\n$copyright\n</head>", $output);
	$output = preg_replace("/\<\/body\>/i", "<div style=\"clear: both; width: 100%; text-align: center; line-height: 2; padding-bottom: 10px;\">" . $powered . "</div></body>", $output);
	$valid = true;
	$bdpos = stripos($output, "</body>");
	$bdcon = ($bdpos !== false ? substr($output, 0, $bdpos) : "");

	if (!empty($bdcon)) {
		$t0 = strripos($bdcon, "<!DOCTYPE");
		$t1 = strripos($bdcon, "<!");
		$t2 = strripos($bdcon, "-->");

		if ($t0 == $t1) {
			$t1 = false;
		}

		if (($t1 !== false) && (($t2 === false) || ($t2 < $t1))) {
			$valid = false;
		}
	}
	else {
		$valid = false;
	}

	if ((strpos($output, $powered) === false) || (strpos($output, "{$generator}\n$author\n$copyright") === false) || ($valid === false)) {
		ob_end_clean();
		exit();
	}

	if (CALL_SHOWMSG_FUN == "1") {
		if (strpos($output, "<script language=\"javascript\" src=\"http://service.phpvod.com/data/advert/showmsg.js\" charset=\"utf-8\"></script>") === false) {
			ob_end_clean();
			exit();
		}
	}
	else {
		if ((strtolower(PHPSELF) == "play") && (strpos($output, "<script language=\"javascript\" src=\"http://service.phpvod.com/data/advert/play.js\" charset=\"utf-8\"></script>") === false)) {
			ob_end_clean();
			exit();
		}
	}

	$output = str_replace(array("<!--<!---->", "<!---->"), array("", ""), $output);

	if ($db_htmifopen) {
		$output = preg_replace("/\<a(\s*[^\>]+\s*)href\=([\"|\']?)([^\"\'>\s]+\.php\?[^\"\'>\s]+)([\"|\']?)/ies", "htm_cv('\3','<a\1href=\"')", $output);
	}

	ob_end_clean();
	pv_define_const("RUN_FOOTER", true);
	($db_obstart == 1) && function_exists("ob_gzhandler") ? ob_start("ob_gzhandler") : ob_start();
	echo $output;
	exit();
}

function htm_cv($url, $tag)
{
	$db_dir = &$GLOBALS["db_dir"];
	$db_ext = &$GLOBALS["db_ext"];
	$db_optimizelink = &$GLOBALS["db_optimizelink"];

	if (ereg("^http|ftp|telnet|mms|rtsp|admin.php|rss.php|search.php|hack.php", $url) === false) {
		if (strpos($url, "#") !== false) {
			$add = substr($url, strpos($url, "#"));
		}

		if (preg_match("/^category\.php\?cid\=\d+$/is", $url, $m) && ($db_optimizelink & 1)) {
			$url = str_replace(array("category.php?cid=", $add), array("category-", ""), $url) . $db_ext . $add;
		}
		else {
			if (preg_match("/^class\.php\?cid\=\d+(&page\=\d+)?$/is", $url, $m) && ($db_optimizelink & 2)) {
				$url = str_replace(array("class.php?cid=", "&page=", $add), array("class-", "-", ""), $url) . $db_ext . $add;
			}
			else {
				if (preg_match("/^read\.php\?vid\=\d+$/is", $url, $m) && ($db_optimizelink & 4)) {
					$url = str_replace(array("read.php?vid=", $add), array("read-", ""), $url) . $db_ext . $add;
				}
				else {
					if (preg_match("/^play\.php\?vid\=\d+&playgroup\=\d+&index\=\d+$/is", $url, $m) && ($db_optimizelink & 8)) {
						$url = str_replace(array("play.php?vid=", "&playgroup=", "&index=", $add), array("play-", "-", "-", ""), $url) . $db_ext . $add;
					}
					else {
						$url = str_replace(array(".php?", "=", "&", $add), array($db_dir, "-", "-", ""), $url) . $db_ext . $add;
					}
				}
			}
		}
	}

	return stripslashes($tag) . $url . "\"";
}

function navpath($cid)
{
	$db_wwwname = &$GLOBALS["db_wwwname"];
	$db_wwwurl = &$GLOBALS["db_wwwurl"];
	$_class = &$GLOBALS["_class"];
	$str = "";

	while (true) {
		if (isset($_class[$cid])) {
			if ($_class[$cid]["cup"] == 0) {
				$a = "<a href=\"category.php?cid=" . $_class[$cid]["cid"] . "\">" . $_class[$cid]["caption"] . "</a>";
			}
			else {
				$a = "<a href=\"class.php?cid=" . $_class[$cid]["cid"] . "\">" . $_class[$cid]["caption"] . "</a>";
			}

			$str = (empty($str) ? $a : $a . " &raquo; " . $str);

			if ($_class[$cid]["cup"] != "0") {
				$cid = $_class[$cid]["cup"];
			}
			else {
				break;
			}
		}
		else {
			break;
		}
	}

	return !empty($str) ? "<a href=\"" . $db_wwwurl . "\">" . $db_wwwname . "</a> &raquo; " . $str : "";
}

function ad($ckey, $pos = "")
{
	$timestamp = &$GLOBALS["timestamp"];
	include PHPVOD_ROOT . "data/cache/advert.php";
	$ad = "";
	$adarray = array();

	if (is_array($advert[$ckey])) {
		foreach ($advert[$ckey] as $key => $value ) {
			if (($value["stime"] <= $timestamp) && ($timestamp <= $value["etime"])) {
				$adarray[$key] = $value;
			}
		}

		if (!empty($adarray)) {
			switch ($ckey) {
			case $ckey:
			case $ckey:
			case $ckey:
				switch (PHPSELF) {
				case PHPSELF:
					$s = "0";
					break;

				case PHPSELF:
					$s = "1";
					break;

				case PHPSELF:
					$s = "2";
					break;

				case PHPSELF:
					$s = "3";
					break;

				default:
					$s = "";
				}

				PHPSELF;
				$ads = array();

				foreach ($adarray as $key => $value ) {
					if ((strpos("," . $value["adarea"] . ",", ",-1,") !== false) || (strpos("," . $value["adarea"] . ",", "," . $s . ",") !== false)) {
						$ads[$key] = $value;
					}
				}

				if (!empty($ads)) {
					$i = array_rand($ads, 1);
					$ad = $ads[$i]["code"];
				}

				break;

			case $ckey:
			case $ckey:
			case $ckey:
			case $ckey:
			case $ckey:
				$ads = array();

				if (is_numeric($pos)) {
					foreach ($adarray as $key => $value ) {
						if ($value["pos"] == $pos) {
							$ads[$key] = $value;
						}
					}
				}

				if (!empty($ads)) {
					$i = array_rand($ads, 1);
					$ad = $ads[$i]["code"];
				}

				break;

			default:
				$i = array_rand($adarray, 1);
				$ad = $adarray[$i]["code"];
				break;
			}
		}
	}

	return $ad;
}

function get_today_vodnum($ct = "")
{
	$db = &$GLOBALS["db"];
	$cs = &$GLOBALS["cs"];
	$db_cachetime = &$GLOBALS["db_cachetime"];
	($ct == "") && ($ct = $db_cachetime);

	if ($ct != "-1") {
		$value = $cs->get("today_update");

		if ($value !== false) {
			return $value;
		}
	}

	$value = $db->get_value("SELECT COUNT(vid) AS sum FROM pv_video WHERE yz='1' AND ((from_unixtime(postdate,'%Y-%m-%d')=date(now())) OR (from_unixtime(lastdate,'%Y-%m-%d')=date(now())))");

	if ($ct != "-1") {
		$cs->set("today_update", $value, $ct);
	}

	return $value;
}

function update_video_hits($vid, $n = 1)
{
	$db = &$GLOBALS["db"];
	$timestamp = &$GLOBALS["timestamp"];
	$r = $db->get_one("SELECT hits,yesterday_hits,day_hits,week_hits,month_hits,hits_update_time FROM pv_video WHERE vid='$vid'");

	if (!$r) {
		return false;
	}

	$hits = $r["hits"] + $n;
	$yesterday_hits = (date("Ymd", $r["hits_update_time"]) == date("Ymd", strtotime("-1 day")) ? $r["day_hits"] : $r["yesterday_hits"]);
	$day_hits = (date("Ymd", $r["hits_update_time"]) == date("Ymd", $timestamp) ? $r["day_hits"] + $n : 1);
	$week_hits = (date("YW", $r["hits_update_time"]) == date("YW", $timestamp) ? $r["week_hits"] + $n : 1);
	$month_hits = (date("Ym", $r["hits_update_time"]) == date("Ym", $timestamp) ? $r["month_hits"] + $n : 1);
	$db->update("UPDATE pv_video SET hits='$hits', yesterday_hits='$yesterday_hits', day_hits='$day_hits', week_hits='$week_hits', month_hits='$month_hits', hits_update_time='$timestamp' WHERE vid='$vid'");
}

function pv_user_login($username, $password, $cktime = 0)
{
	$db = &$GLOBALS["db"];
	$onlineip = &$GLOBALS["onlineip"];
	$timestamp = &$GLOBALS["timestamp"];
	$db_bfn = &$GLOBALS["db_bfn"];
	if ($username && $password) {
		$u = $db->get_one("SELECT m.uid,m.password,m.groupid,m.yz,md.onlineip FROM pv_members AS m LEFT JOIN pv_memberdata AS md ON md.uid=m.uid WHERE username='$username'");

		if ($u) {
			$e_login = explode("|", $u["onlineip"]);
			if (($e_login[0] == $onlineip . " *") && (($timestamp - $e_login[1]) <= 600) && ($e_login[2] <= 0)) {
				$GLOBALS["left_time"] = 600 - $timestamp - $e_login[1];
				showmsg("login_forbid", "showmsg_login", "login.php", array($GLOBALS["left_time"]), 3);
			}

			if ($u["password"] == md5($password)) {
				($cktime != 0) && ($cktime += $timestamp);
				cookie("user", $u["uid"] . "\t" . $u["password"], $cktime);
				$db->update("UPDATE pv_memberdata SET onlineip='$onlineip|$timestamp|6' WHERE uid='{$u["uid"]}'");
				refreshto($db_bfn, "have_login");
			}
			else {
				$left = $e_login[2];
				$left ? $left-- : $left = 5;
				$db->update("UPDATE pv_memberdata SET onlineip='$onlineip *|$timestamp|$left' WHERE uid='{$u["uid"]}'");
				showmsg("login_pwd_error", "", "", array($left));
			}
		}
		else {
			showmsg("user_not_exists", "", "", array($username));
		}
	}
	else {
		showmsg("login_empty");
	}
}

function pv_user_loginout()
{
	$db_bfn = &$GLOBALS["db_bfn"];
	cookie("user", "", 0);
	refreshto($db_bfn, "login_out");
}

function getsubcid($cid = "-1")
{
	$groupid = &$GLOBALS["groupid"];
	$subcid = "";
	include PHPVOD_ROOT . "data/cache/class.php";

	if ($cid == "-1") {
		foreach ($_class as $svalue ) {
			if (($svalue["type"] != "free") && ($groupid == "guest")) {
				continue;
			}

			if (($svalue["allowvisit"] != "") && (strpos($svalue["allowvisit"], ",$groupid,") === false)) {
				continue;
			}

			if ($subcid == "") {
				$subcid .= "{$svalue["cid"]}";
			}
			else {
				$subcid .= ",{$svalue["cid"]}";
			}
		}
	}
	else {
		foreach ($_class as $svalue ) {
			$fathers = explode(",", $svalue["fathers"]);

			if (in_array($cid, $fathers)) {
				if (($svalue["type"] != "free") && ($groupid == "guest")) {
					continue;
				}

				if (($svalue["allowvisit"] != "") && (strpos($svalue["allowvisit"], ",$groupid,") === false)) {
					continue;
				}

				if ($subcid == "") {
					$subcid .= "{$svalue["cid"]}";
				}
				else {
					$subcid .= ",{$svalue["cid"]}";
				}
			}
		}
	}

	return $subcid;
}

function pv_loop($type, $str_param)
{
	$param_array = explode("|", $str_param);
	$param = array();

	foreach ($param_array as $value ) {
		$p = strpos($value, "=");

		if ($p === false) {
			continue;
		}

		$key = substr($value, 0, $p);
		$val = substr($value, $p + 1);
		$val = str_replace("PHPVOD-TAG-SEPARATOR", "|", $val);
		$param[$key] = $val;
	}

	$result = array();

	switch ($type) {
	case $type:
		$result = pv_video_loop($param);
		break;

	case $type:
		$result = pv_class_loop($param);
		break;

	case $type:
		$result = pv_article_loop($param);
		break;
	}

	return $result;
}

function pv_video_loop($param)
{
	$db = &$GLOBALS["db"];
	$cid = &$GLOBALS["cid"];
	$SYSTEM = &$GLOBALS["SYSTEM"];
	$groupid = &$GLOBALS["groupid"];
	$timestamp = &$GLOBALS["timestamp"];
	$db_cachetime = &$GLOBALS["db_cachetime"];
	$cs = &$GLOBALS["cs"];
	$cache_key = $groupid . "_" . md5(serialize($param));
	if (!isset($param["cachetime"]) || empty($param["cachetime"])) {
		$param["cachetime"] = $db_cachetime;
	}

	if ($param["cachetime"] != "-1") {
		$cache_value = $cs->get($cache_key);

		if ($cache_value != false) {
			$GLOBALS["pageinfo"] = $cache_value["page"];
			return $cache_value["data"];
		}
	}

	$result = array("data" => NULL, "page" => NULL);
	$allsub = getsubcid("-1");

	if ($allsub == "") {
		return $result;
	}

	if ($SYSTEM["allowadminshow"] != "1") {
		$sql = "v.yz='1'";
	}
	else {
		$sql = "1";
	}

	if (isset($param["sync"]) && ($param["sync"] == "1")) {
		$last_sync_time = $cs->_get_last_sync_time($param["cachetime"]);

		if ($last_sync_time != false) {
			$sql .= " AND v.postdate<='$last_sync_time'";
		}

		$param["sync"] = true;
	}
	else {
		$param["sync"] = false;
	}

	if (isset($param["field"]) && !empty($param["field"])) {
		if ($param["field"] == "basic") {
			$field = "v.*";
			$table = "pv_video AS v";
		}
		else if ($param["field"] == "full") {
			$field = "v.*,vd.synopsis";
			$table = "pv_video AS v LEFT JOIN pv_videodata AS vd ON v.vid=vd.vid";
		}
		else {
			$video_field = array("vid", "cid", "nid", "author", "authorid", "postdate", "lastdate", "subject", "picfolder", "pic", "playactor", "director", "tag", "year", "best", "serialise", "memo", "reply", "hits", "yesterday_hits", "day_hits", "week_hits", "month_hits", "hits_update_time", "usernth", "fraction", "star", "yz");
			$videodata_field = array("synopsis");
			$lkvd = false;
			$field_arr = explode(",", $param["field"]);

			foreach ($field_arr as $key => $val ) {
				if (in_array($val, $video_field)) {
					$field_arr[$key] = "v." . $val;
					continue;
				}

				if (in_array($val, $videodata_field)) {
					$field_arr[$key] = "vd." . $val;
					$lkvd = true;
					continue;
				}

				unset($field_arr[$key]);
			}

			$field_str = implode(",", $field_arr);

			if (!empty($field_str)) {
				$field = $field_str;
				$table = ($lkvd == false ? "pv_video AS v" : "pv_video AS v LEFT JOIN pv_videodata AS vd ON v.vid=vd.vid");
			}
			else {
				$field = "v.*";
				$table = "pv_video AS v";
			}
		}
	}
	else {
		$field = "v.*";
		$table = "pv_video AS v";
	}

	if (isset($param["sqlwhere"]) && !empty($param["sqlwhere"])) {
		$sql .= " AND ({$param["sqlwhere"]})";
	}

	if (isset($param["uid"]) && is_numeric($param["uid"]) && (0 < (int) $param["uid"])) {
		$sql .= " AND v.authorid='{$param["uid"]}'";
	}

	if (isset($param["cid"]) && is_numeric($param["cid"]) && (0 < (int) $param["cid"])) {
		if (strpos("," . $allsub . ",", "," . $param["cid"] . ",") === false) {
			return $result;
		}

		$sql .= " AND (v.cid='{$param["cid"]}'";
		if (isset($param["showsub"]) && ($param["showsub"] == "1")) {
			$subcid = getsubcid($param["cid"]);

			if ($subcid != "") {
				$sql .= " OR v.cid IN($subcid))";
			}
			else {
				$sql .= ")";
			}
		}
		else {
			$sql .= ")";
		}
	}
	else {
		$sql .= " AND v.cid IN($allsub)";
	}

	if (isset($param["nid"]) && is_numeric($param["nid"]) && (0 < (int) $param["nid"])) {
		$sql .= " AND v.nid='{$param["nid"]}'";
	}

	if (isset($param["year"])) {
		if (is_numeric($param["year"])) {
			$sql .= " AND v.year='{$param["year"]}'";
		}
		else {
			$strtmp = strtolower(substr($param["year"], 0, 1));

			if ($strtmp == "b") {
				$stryear = substr($param["year"], 1);
				$sql .= " AND v.year<='" . $stryear . "'";
			}
		}
	}

	if (isset($param["best"]) && is_numeric($param["best"]) && (0 <= (int) $param["best"])) {
		switch ($param["best"]) {
		case $param["best"]:
			$sql .= " AND v.best='0'";
			break;

		case $param["best"]:
			$sql .= " AND (v.best='1' OR v.best='3')";
			break;

		case $param["best"]:
			$sql .= " AND (v.best='2' OR v.best='3')";
			break;
		}
	}

	if (isset($param["series"]) && is_numeric($param["series"])) {
		if ($param["series"] == "0") {
			$sql .= " AND v.serialise='0'";
		}
		else if ($param["series"] == "1") {
			$sql .= " AND v.serialise>'0'";
		}
	}

	if (isset($param["order"]) && ($param["order"] != "")) {
		$sql .= " ORDER BY {$param["order"]}";
	}

	if (isset($param["limit"]) && ($param["limit"] != "")) {
		if (is_numeric($param["page"]) && (0 < $param["page"]) && isset($param["url"]) && ($param["url"] != "")) {
			$query = $db->query("SELECT\t$field FROM $table WHERE $sql");
			$recordnum = $db->num_rows($query);
			$pages = numofpage($recordnum, $param["page"], $param["limit"], $param["url"]);
			$result["page"] = $pages;

			if ("0" < $recordnum) {
				$pagenum = ceil($recordnum / $param["limit"]);

				if ($pagenum < $param["page"]) {
					$param["page"] = $pagenum;
				}

				$startnum = ($param["page"] - 1) * $param["limit"];
			}
			else {
				$startnum = 0;
			}
		}
		else {
			$startnum = 0;
		}

		$limit = " LIMIT $startnum,{$param["limit"]}";
	}

	$query = $db->query("SELECT $field FROM $table WHERE $sql $limit");
	include PHPVOD_ROOT . "data/cache/class.php";
	include PHPVOD_ROOT . "data/cache/nation.php";

	while ($video = $db->fetch_array($query)) {
		isset($video["cid"]) && ($video["class_name"] = $_class[$video["cid"]]["caption"]);
		isset($video["nid"]) && ($video["nation_name"] = $_nation[$video["nid"]]);
		isset($video["picfolder"]) && isset($video["pic"]) && ($video["picurl"] = get_poster_url($video["picfolder"], $video["pic"], 3));
		$result["data"][] = $video;
	}

	if ($param["cachetime"] != "-1") {
		$cs->set($cache_key, $result, $param["cachetime"], $param["sync"]);
	}

	$GLOBALS["pageinfo"] = $result["page"];
	return $result["data"];
}

function pv_class_loop($param)
{
	$groupid = &$GLOBALS["groupid"];
	$result = array();
	include PHPVOD_ROOT . "data/cache/class.php";
	if (isset($param["cid"]) && is_numeric($param["cid"])) {
		if ($param["cid"] == "0") {
			$_class1 = $_class2 = $_class;

			foreach ($_class1 as $value ) {
				if ($value["cup"] == "0") {
					$subnum = 0;

					foreach ($_class2 as $sub ) {
						if (($sub["cup"] == $value["cid"]) && (($sub["type"] != "hidden") || (strpos($sub["allowvisit"], ",$groupid,") !== false))) {
							$subnum++;
						}
					}

					if ((0 < $subnum) || !empty($value["link"])) {
						$result[] = $value;
					}
				}
			}
		}
		else {
			foreach ($_class as $value ) {
				if (($value["cup"] == $param["cid"]) && (($value["type"] != "hidden") || (strpos($value["allowvisit"], ",$groupid,") !== false))) {
					$result[] = $value;
				}
			}
		}
	}

	return $result;
}

function pv_article_loop($param)
{
	$db = &$GLOBALS["db"];
	$cs = &$GLOBALS["cs"];
	$db_cachetime = &$GLOBALS["db_cachetime"];
	$cache_key = "article_" . md5(serialize($param));
	if (!isset($param["cachetime"]) || empty($param["cachetime"])) {
		$param["cachetime"] = $db_cachetime;
	}

	if ($param["cachetime"] != "-1") {
		$cache_value = $cs->get($cache_key);

		if ($cache_value != false) {
			$GLOBALS["pageinfo"] = $cache_value["page"];
			return $cache_value["data"];
		}
	}

	$result = array("data" => NULL, "page" => NULL);
	$sql = "1";
	if (isset($param["sync"]) && ($param["sync"] == "1")) {
		$last_sync_time = $cs->_get_last_sync_time($param["cachetime"]);

		if ($last_sync_time != false) {
			$sql .= " AND timestamp<='$last_sync_time'";
		}

		$param["sync"] = true;
	}
	else {
		$param["sync"] = false;
	}

	if (is_numeric($param["classid"])) {
		$sql .= " AND classid='{$param["classid"]}'";
	}

	if (isset($param["sqlwhere"]) && !empty($param["sqlwhere"])) {
		$sql .= " AND ({$param["sqlwhere"]})";
	}

	if (isset($param["order"]) && ($param["order"] != "")) {
		$sql .= " ORDER BY {$param["order"]}";
	}
	else {
		$sql .= " ORDER BY vieworder DESC, aid DESC";
	}

	$limit = "";
	if (is_numeric($param["limit"]) && (0 < $param["limit"])) {
		if (is_numeric($param["page"]) && (0 < $param["page"]) && isset($param["url"]) && ($param["url"] != "")) {
			$query = $db->query("SELECT\taid FROM pv_article WHERE $sql");
			$recordnum = $db->num_rows($query);
			$pages = numofpage($recordnum, $param["page"], $param["limit"], $param["url"]);
			$result["page"] = $pages;

			if ("0" < $recordnum) {
				$pagenum = ceil($recordnum / $param["limit"]);

				if ($pagenum < $param["page"]) {
					$param["page"] = $pagenum;
				}

				$startnum = ($param["page"] - 1) * $param["limit"];
			}
			else {
				$startnum = 0;
			}
		}
		else {
			$startnum = 0;
		}

		$limit = " LIMIT $startnum,{$param["limit"]}";
	}

	include PHPVOD_ROOT . "data/cache/artclass.php";
	$query = $db->query("SELECT aid,classid,author,authorid,subject,vieworder,timestamp FROM pv_article WHERE $sql $limit");

	while ($article = $db->fetch_array($query)) {
		isset($article["classid"]) && ($article["classname"] = $_artclass[$article["classid"]]);
		$result["data"][] = $article;
	}

	if ($param["cachetime"] != "-1") {
		$cs->set($cache_key, $result, $param["cachetime"], $param["sync"]);
	}

	$GLOBALS["pageinfo"] = $result["page"];
	return $result["data"];
}

function pv_class_allow($cid)
{
	$uid = &$GLOBALS["uid"];
	$_class = &$GLOBALS["_class"];
	$groupid = &$GLOBALS["groupid"];
	$db = &$GLOBALS["db"];
	$request_uri = &$GLOBALS["request_uri"];
	$user = &$GLOBALS["user"];
	if (($_class[$cid]["type"] != "free") && ($groupid == "guest")) {
		return array("result" => "-1");
	}

	if ($_class[$cid]["allowvisit"] != "") {
		if (($groupid == "guest") || (strpos($_class[$cid]["allowvisit"], ",$groupid,") === false)) {
			return array("result" => "-2");
		}
	}

	if (($_class[$cid]["allowplay"] != "") && (PHPSELF == "play")) {
		if (($groupid == "guest") || (strpos($_class[$cid]["allowplay"], ",$groupid,") === false)) {
			return array("result" => "-2");
		}
	}

	if ($_class[$cid]["rvrcneed"] || $_class[$cid]["moneyneed"] || $_class[$cid]["postneed"]) {
		if ($groupid == "guest") {
			return array("result" => "-3");
		}

		$check = 1;
		if ($_class[$cid]["rvrcneed"] && ($user["rvrc"] < $_class[$cid]["rvrcneed"])) {
			$check = 0;
		}
		else {
			if ($_class[$cid]["moneyneed"] && ($user["money"] < $_class[$cid]["moneyneed"])) {
				$check = 0;
			}
			else {
				if ($_class[$cid]["postneed"] && ($user["postnum"] < $_class[$cid]["postneed"])) {
					$check = 0;
				}
			}
		}

		if (!$check) {
			return array(
	"result" => "-4",
	"data"   => array("class_rvrcneed" => $_class[$cid]["rvrcneed"], "user_rvrc" => $user["rvrc"], "class_moneyneed" => $_class[$cid]["moneyneed"], "user_money" => $user["money"], "class_postneed" => $_class[$cid]["postneed"], "user_postnum" => $user["postnum"])
	);
		}
	}

	if ($_class[$cid]["password"] != "") {
		if ($groupid == "guest") {
			return array("result" => "-5");
		}

		if (getcookie("classpass_$cid") != md5($_class[$cid]["password"])) {
			return array(
	"result" => "-6",
	"data"   => array("cid" => $cid, "forward" => $request_uri)
	);
		}
	}

	return array("result" => "1");
}

function pv_sql($sql, $ct = "", $sync = false)
{
	$db = &$GLOBALS["db"];
	$cs = &$GLOBALS["cs"];
	$groupid = &$GLOBALS["groupid"];
	$db_cachetime = &$GLOBALS["db_cachetime"];
	$sql = trim($sql);

	if (strtoupper(substr($sql, 0, 6)) == "SELECT") {
		($ct == "") && ($ct = $db_cachetime);

		if ($ct != "-1") {
			$cache_key = $groupid . "_" . md5($sql);
			$cache_value = $cs->get($cache_key);

			if ($cache_value != false) {
				return $cache_value;
			}
		}

		$result = array();
		$query = $db->query($sql);

		while ($row = $db->fetch_array($query)) {
			$result[] = $row;
		}

		if ($ct != "-1") {
			$cs->set($cache_key, $result, $ct, $sync);
		}

		return $result;
	}
	else if (strtoupper(substr($sql, 0, 6)) == "INSERT") {
		$db->query($sql);
		return $db->insert_id();
	}
	else {
		return $db->query($sql);
	}
}

error_reporting(1 | 4);
set_magic_quotes_runtime(0);
define("IN_PHPVOD", 1);
define("PHPVOD_ROOT", dirname(__FILE__) . DIRECTORY_SEPARATOR);
file_exists("install.php") && header("Location: ./install.php");
require_once PHPVOD_ROOT . "require/common.php";
register_shutdown_function("shutdown");
define("PHPSELF", strtolower(basename($_SERVER["PHP_SELF"], ".php")));
if ($db_dir && $db_ext) {
	$self_array = explode("-", $db_ext ? substr($_SERVER["QUERY_STRING"], 0, strpos($_SERVER["QUERY_STRING"], $db_ext)) : $_SERVER["QUERY_STRING"]);
	$s_count = count($self_array);

	for ($i = 0; $i < $s_count; $i++) {
		$_key = $self_array[$i];
		$_value = $self_array[++$i];
		!isset($_GET[$_key]) && ($_GET[$_key] = urldecode($_value));
	}
}

require_once PHPVOD_ROOT . "data/sql_config.php";
if (($database == "mysqli") && (ckfun("mysqli", "mysqli_get_client_info") === false)) {
	$database = "mysql";
}

require_once PHPVOD_ROOT . "require/" . $database . ".php";
$db = new phpvod_database($dbhost, $dbuser, $dbpw, $dbname, $dbpre, $charset, $pconnect);
unset($dbhost);
unset($dbuser);
unset($dbpw);
unset($dbname);
unset($charset);
unset($pconnect);
$style = (getcookie("pv_userstyle", false) ? getcookie("pv_userstyle", false) : $db_defaultstyle);
include_once PHPVOD_ROOT . "data/style/$style.php";
list($uid, $password) = explode("\t", getcookie("user"));
if (is_numeric($uid) && (32 <= strlen($password))) {
	$user = userinfo($uid, $password);
	$uid = $user["uid"];
	$ucuid = $user["ucuid"];
	$username = $user["username"];
	$groupid = $user["groupid"];
	$memberid = $user["memberid"];
	($groupid == "-1") && ($groupid = $memberid);
}
else {
	$groupid = "guest";
	cookie("user", "", 0);
}

if ($groupid != "guest") {
	if (file_exists(PHPVOD_ROOT . "data/groupdb/group_$groupid.php")) {
		require_once path_cv(PHPVOD_ROOT . "data/groupdb/group_$groupid.php");
	}
	else {
		require_once PHPVOD_ROOT . "data/groupdb/group_1.php";
	}
}
else {
	require_once PHPVOD_ROOT . "data/groupdb/group_2.php";
}

require_once PHPVOD_ROOT . "require/template.php";
include_once PHPVOD_ROOT . "data/cache/hack.php";
include_once PHPVOD_ROOT . "data/cache/level.php";
include_once PHPVOD_ROOT . "data/cache/dbset.php";
include_once PHPVOD_ROOT . "data/cache/siteinfo.php";
!$db_siteifopen && ($user["groupid"] != "3") && showmsg($db_whyclose);
call_listener("global");

