<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/dbreg.php';
include_once PHPVOD_ROOT . 'data/cache/level.php';

initvar('action');
if($action == "show")
{
	initvar('id','GP',2);

	/* 用户组权限 */
	if($id != $uid && $gp_allowprofile == '0') showmsg('profile_error');
	if($id == '0') showmsg('guest_info');

	$userdb = array();
	$userdb = $db->get_one("SELECT m.*,md.* FROM pv_members m LEFT JOIN pv_memberdata md ON m.uid=md.uid WHERE m.uid='$id'");
	if(!$userdb) showmsg('user_not_exists','','',array($id));

	$logininfo = explode('|', $userdb['onlineip']);
	$userdb['ip'] = $logininfo[0];
	$userdb['lastlogin'] = get_date($logininfo[1], "Y-m-d");
	$userdb['regdate'] = get_date($userdb['regdate'], "Y-m-d");
	$userdb['grouptitle'] = $ltitle[$userdb['groupid']];
	$userdb['membertitle'] = $ltitle[$userdb['memberid']];
	!ereg("^http", $userdb['icon']) && $userdb['icon'] = "$imgpath/face/$userdb[icon]";

	$usercredit = array("postnum" => "$userdb[postnum]", "rvrc" => "$userdb[rvrc]", "money" => "$userdb[money]");
	$creditdb = get_custom_credit($id);
	foreach($creditdb as $key => $value)
	{
		$usercredit[$key] = $value[1];
	}
	$upgradeset = unserialize($db_upgrade);
	$userdb['credit'] = calculate_credit($usercredit, $upgradeset);
}
elseif($action == "modify")
{
	initvar('step','GP',2);
	$groupid == 'guest' && showmsg('not_login');
	if($step != 2)
	{
		ifcheck($user['receivemail'], 'receivemail');
		ifcheck($user['gender'], 'gender','select');
		ifcheck($user['publicmail'], 'publicmail');

		$getbirthday = explode("-", $user['bday']);
		$year[$getbirthday[0]] = 'selected="selected"';
		$month[$getbirthday[1]] = 'selected="selected"';
		$day[$getbirthday[2]] = 'selected="selected"';

		$userstyle = getcookie('pv_userstyle', false);
		$style = $userstyle ? $userstyle : $db_defaultstyle;
		$styles = create_style_option($style);

		$delicon = ereg("^user/", $user['icon']) ? '1' : '0';

		$iconurl = $iconpath = '';
		if(ereg("^http", $user['icon']))
		{
			$iconurl = $user['icon'];
			$iconpath = $user['icon'];
		}
		else
		{
			$iconpath = "$imgpath/face/$user[icon]";
		}

		$img = @opendir("$imgdir/face");
		while($imagearray = @readdir($img))
		{
			$extend = pathinfo($imagearray);
			$extend = strtolower($extend["extension"]);
			if($imagearray != "." && $imagearray != ".." && $imagearray != "" && $imagearray != "none.gif" && in_array($extend, array('jpg', 'jpeg', 'gif', 'png', 'bmp')))
			{
				$filedb[] = $imagearray;
			}
		}
		@closedir($img);
		natcasesort($filedb);
		foreach($filedb as $value)
		{
			$value == $user['icon'] ? $c = 'selected="selected"' : $c = '';
			$imgselect .= "<option value='$value' $c>$value</option>";
		}
	}
	else
	{
		initvar(array('proicon','userstyle'),'GP',0);
		initvar(array('proyear','promonth','proday','progender','proreceivemail','propublicmail'), 'GP', 2);
		initvar(array('iconurl', 'prohonor', 'prooicq', 'promsn', 'prosite', 'prosign'), 'GP');

		$bday = (!$proyear || !$promonth || !$proday) ? '0000-00-00' : $proyear . "-" . $promonth . "-" . $proday;

		if(strlen($prohonor) > $rg_regmaxhonor)	showmsg('honor_limit','','goback',array($rg_regmaxhonor));
		if(strlen($prosign) > $rg_regmaxsign) showmsg('sign_limit','','goback',array($rg_regmaxsign));
		if(strpos($proicon, '..') !== false) showmsg('undefined_action','','goback');
		if(ereg("^user/", $user['icon'])) $proicon = $user['icon'];

		if($iconurl)
		{
			if(!ereg("^http", $iconurl))
			{
				showmsg('illegal_customimg','','goback');
			}
			else
			{
				if(ereg("^user/", $user['icon']) && file_exists($imgdir . '/face/' . $user['icon'])) showmsg('pro_custom_fail','','goback');
				$proicon = $iconurl;
			}
		}

		/* 系统风格 */
		if($userstyle == '')
			cookie('pv_userstyle', '', 0, false);
		else
			cookie('pv_userstyle', $userstyle, 'F', false);

		/* 上传头像 */
		$error = $_FILES['upicon']['error'];
		$img_name = $_FILES['upicon']['name'];
		$img_tmp = $_FILES['upicon']['tmp_name'];
		$img_size = $_FILES['upicon']['size'];
		$image_path = $imgpath . "/face/user/";

		if($error == '0' && $img_size > 0 && $db_iconupload == '1' && $gp_allowupicon == '1')
		{
			$iconsize = $db_iconsize * 1024;
			if($img_size > $iconsize) showmsg('pro_loadimg_limit','','',array($iconsize));
			if(ereg("^user/", $user['icon']) && file_exists($imgdir . '/face/' . $user['icon'])) showmsg('pro_loadimg_fail','','goback');

			$img_ext = strtolower(substr(strrchr($img_name, '.'), 1));
			if($img_ext && in_array($img_ext, array('jpg', 'jpeg', 'png', 'bmp', 'gif')) && !in_blacklist($img_ext))
			{
				$filename = $uid . '.' . $img_ext;
				if(copy($img_tmp, $image_path . $filename))
				{
					$proicon = "user/$filename";
				}
			}
			else
				showmsg('pro_loadimg_ext');
		}
		$db->update("UPDATE pv_members SET publicmail='$propublicmail', receivemail='$proreceivemail', honor='$prohonor', icon='$proicon', gender='$progender', oicq='$prooicq', msn='$promsn', site='$prosite', bday='$bday', signature='$prosign' WHERE uid='$uid'");
		refreshto("./profile.php?action=$action", 'operate_success');
	}
}
elseif($action == "changepass")
{
	initvar('step','GP',2);
	$groupid == 'guest' && showmsg('not_login');
	if($step == 2)
	{
		initvar(array('oldpwd','propwd','check_pwd','proemail'),'GP',0);
		if(!$oldpwd) showmsg('not_oldpwd','','goback');
		if(($propwd || $check_pwd) && ($propwd != $check_pwd)) showmsg('password_confirm','','goback');
		user_edit($username,$oldpwd,$propwd,$proemail);
		refreshto("./profile.php?action=show&id=$uid", 'operate_success');
	}
}
elseif($action == "myvideo")
{
	initvar(array('type','page'));
	if(empty($type) || !in_array($type, array('post','favorite'))) $type = 'post';
	$groupid == 'guest' && showmsg('not_login');

	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_perpage . ",$db_perpage";
	switch ($type)
	{
		case 'post':
			$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_video WHERE authorid='$uid'");
			$video_num = $rt['sum'];
			$sql = "SELECT * FROM pv_video AS v WHERE v.authorid='$uid' ORDER BY postdate DESC $limit";
			break;
		case 'favorite':
			$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_favorite WHERE uid='$uid'");
			$video_num = $rt['sum'];
			$sql = "SELECT v.*,f.timestamp FROM pv_favorite AS f LEFT JOIN pv_video AS v ON f.vid=v.vid WHERE f.uid='$uid' ORDER BY f.fid DESC $limit";
			break;
	}
	$pages = numofpage($video_num, $page, $db_perpage, "profile.php?action=myvideo&type={$type}&");
	$videolist = array();
	$query = $db->query($sql);
	while($video = $db->fetch_array($query))
	{
		$video['postdate'] = get_date($video['postdate']);
		$video['lastdate'] = get_date($video['lastdate']);
		$video['timestamp'] = get_date($video['timestamp']);
		$videolist[] = $video;
	}
}

elseif($action == 'remove')
{
	initvar('type');
	initvar('vid','GP',2);

	$groupid == 'guest' && showmsg('not_login');
	if($type == 'favorite')
	{
		$db->update("DELETE FROM pv_favorite WHERE uid='$uid' AND vid='$vid'");
	}
	refreshto("profile.php?action=myvideo&type=$type", 'operate_success');
}
elseif($action == "delicon")
{
	$groupid == 'guest' && showmsg('not_login');
	if(ereg("^user/", $user['icon']) && file_exists("$imgdir/face/$user[icon]")) delfile("$imgdir/face/$user[icon]");
	$db->query("UPDATE pv_members SET icon='none.gif' WHERE uid='$uid'");
	refreshto('profile.php?action=modify', 'operate_success');
}

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl('profile');
footer();
?>