<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';
initvar(array('vid', 'playgroup', 'index'), 'GP', 2);

$video = get_video_info($vid); //获取视频信息
if(empty($video) || ($SYSTEM['allowadminshow'] != '1' && $video['yz'] != '1')) showmsg('data_error');
$cid = $video['cid'];

//用户组权限检测
if($gp_allowplay != '1') showmsg('group_play');

//栏目权限检测
$cr = pv_class_allow($cid);
switch($cr['result'])
{
	case '-1':
		showmsg('play_guest');
		break;
	case '-2':
		showmsg('play_noper');
		break;
	case '-3':
		showmsg('play_guestlimit');
		break;
	case '-4':
		showmsg('class_creditlimit','','',array($cr['data']['class_rvrcneed'],$cr['data']['user_rvrc'],$cr['data']['class_moneyneed'],$cr['data']['user_money'],$cr['data']['class_postneed'],$cr['data']['user_postnum']),30);
		break;
	case '-5':
		showmsg('classpw_guest');
		break;
	case '-6':
		$cid = $cr['data']['cid'];
		$forward = $cr['data']['forward'];
		require_once PHPVOD_ROOT . 'require/header.php';
		require_once gettpl('classpw');
		footer();
		break;
}

//获取视频播放地址的相关信息
$urldb = get_urls_info($video['vid']);

//获取视频播放器
$player = get_video_player($urldb, $playgroup, $index);

//导航
$urlcaption = $urldb[$playgroup]['urls'][$index]['caption'];
$navpath = navpath($video['cid']) . ' &raquo; <a href="read.php?vid=' . $video[vid] . '">' . $video[subject] . '</a>' . ' &raquo; ' . $urlcaption;


//模板文件
$tplfile = $_class[$cid]['play_tplfile'] != '' ? $_class[$cid]['play_tplfile'] : 'play'; //tplfile

require_once PHPVOD_ROOT . 'require/header.php';
require_once gettpl($tplfile);
footer();
?>