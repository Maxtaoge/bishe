<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';
include_once PHPVOD_ROOT . 'data/cache/bwd.php';

header("Content-type: text/html;charset=$db_charset");
header("Cache-Control: no-cache, must-revalidate"); //不缓存数据

initvar('action', 'GP');
initvar(array('vid', 'page'), 'GP', 2);

if(!$action)
{
	$rt = $db->get_one("SELECT COUNT(*) AS sum FROM pv_reply WHERE vid='$vid' AND yz='1'");
	(!is_numeric($page) || $page < 1) && $page = 1;
	$limit = "LIMIT " . ($page - 1) * $db_readperpage . ",$db_readperpage";
	$pages = numofpage($rt['sum'], $page, $db_readperpage, "javascript:get_reply($vid,%page%)");

	$query = $db->query("SELECT * FROM pv_reply WHERE vid='$vid' AND yz='1' ORDER BY postdate DESC $limit");
	while($reply = $db->fetch_array($query))
	{
		$reply['postdate'] = get_date($reply['postdate']);
		$reply['content'] = ieconvert($reply['content']);
		$reply['content'] = str_replace($_bwddb, '*', $reply['content']);

		if($reply['authorid'] == '0') //游客
		{
			$reply['signature'] = '';
			$reply['icon'] = "$imgpath/face/none.gif";
		}
		else
		{
			$s = $db->get_one("SELECT icon,signature FROM pv_members WHERE uid='$reply[authorid]'"); //个性签名
			$reply['signature'] = $s['signature'];

			if($s['icon'] == '' || !file_exists("$imgdir/face/$s[icon]"))
				$s['icon'] = "$imgpath/face/none.gif";
			else
				$s['icon'] = "$imgpath/face/$s[icon]";
			$reply['icon'] = $s['icon'];
		}

		$replydb[] = $reply;
	}
	unset($reply);
	require_once gettpl('reply');
	exit();
}
elseif($ation = 'add')
{
	initvar(array('vid', 'cid'), 'GP', 2);
	initvar('content', 'GP', 0);
	initvar('gdcode', 'GP', 0);

	/* 用户组权限 */
	if($gp_allowrp != '1') exit(lang('reply_group'));

	/* 栏目权限 */
	$v = $db->get_one("SELECT cid,subject FROM pv_video WHERE vid='$vid'");
	$cid = $v['cid'];

	if($_class[$cid]['type'] != 'free' && $groupid == 'guest') exit(lang('reply_class1'));
	if($_class[$cid]['allowrp'] != '' && ($groupid == 'guest' || strpos($_class[$cid]['allowrp'], ",$groupid,") === false)) exit(lang('reply_class2'));

	if(($_class[$cid]['atccheck'] == '2' || $_class[$cid]['atccheck'] == '3') && $gp_rpcheck == '1')
		$yz = '0';
	else
		$yz = '1';

	/* 认证码 */
	if($db_gdcheck & 4)
	{
		if(!gdconfirm($_POST['gdcode'])) exit(lang('check_error'));
	}

	if($db_charset != 'utf-8')
	{
		$content = str_convert($content, $db_charset, 'utf-8');
	}

	if($groupid == 'guest')
	{
		$username = lang('guest');
		$uid = '0';
	}

	
	$db->update("INSERT INTO pv_reply (vid,author,authorid,postdate,content,yz) VALUES ('$vid','$username','$uid','$timestamp','$content','$yz')");

	if($yz == '1')
	{
		$db->update("UPDATE pv_video SET reply=reply+1 WHERE vid='$vid'");
		if($groupid != 'guest') update_member_data($uid, 'Reply');
		exit('success');
	}
	else
	{
		exit(lang('reply_admin_check'));
	}

}
?>