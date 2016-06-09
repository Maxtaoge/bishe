<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if($action == 'cache')
{
	updatecache();
	adminmsg('operate_success');
}
elseif($action == 'template_cache')
{
	updatecache_template();
	updatecache_template_data();
	adminmsg('operate_success');
}
elseif($action == 'data_cache')
{
	$cs->clear();
	adminmsg('operate_success');
}
elseif($action == 'siteinfo')
{
	update_siteinfo(array('newmember','totalmember','totalvideo'));
	adminmsg('operate_success');
}
elseif($action == 'memberid_cache')
{
	updatecache_memberid();
	adminmsg('operate_success');
}
elseif($action == 'video_count')
{
	updatecache_video_count();
	adminmsg('operate_success');
}

include gettpl('updatecache');
?>