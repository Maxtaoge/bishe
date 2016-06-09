<?php
defined('IN_PHPVOD') or exit('Access Denied');
interface listener_interface
{
	public function run_common();
	public function run_admincp();
	public function run_global();
	public function run_header();
	public function run_footer();
	public function run_output();
}
?>