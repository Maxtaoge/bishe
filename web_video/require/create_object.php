<?php
!defined('IN_PHPVOD') && exit('Forbidden');

function create_phpmailer($exceptions = false)
{
	require PHPVOD_ROOT . 'require/PHPMailer/class.phpmailer.php';
	return new PHPMailer($exceptions);
}

function create_chinese($source_lang = '', $target_lang = '', $force_table = false)
{
	require PHPVOD_ROOT . 'require/chinese.php';
	return new Chinese($source_lang, $target_lang, $force_table);
}

function create_mobile_detect()
{
	require PHPVOD_ROOT . 'require/MobileDetect/Mobile_Detect.php';
	return new Mobile_Detect;
}
?>