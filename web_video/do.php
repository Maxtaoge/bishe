<?php
require_once 'global.php';
include_once PHPVOD_ROOT . 'data/cache/class.php';

initvar('action', 'GP');
if($action == 'confirm_classpw')
{
	initvar(array('forward','classpass','cid'), 'GP', 0);
	if($classpass == $_class[$cid]['password'])
	{
		cookie("classpass_$cid", md5($_class[$cid]['password']));
		obheader($forward);
	}
	else
	{
		showmsg('classpw_pwd_error','',$forward);
	}
}
?>