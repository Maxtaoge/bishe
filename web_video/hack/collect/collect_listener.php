<?php
!defined('IN_PHPVOD') && exit('Forbidden');
class Collect_listener extends listener
{
	public function __construct($param)
	{
		parent::__construct($param);
	}
	public function run_common()
	{}
	public function run_admincp()
	{}
	public function run_global()
	{}
	public function run_header()
	{}
	public function run_footer()
	{
		/* ----------- 自动采集设置选项 (开始)----------- */
		$collect_switch = '0';	//自动采集开关(1开启/0关闭)
		$interval = 86400; 		//自动采集时间间隔(单位:秒)
		$hackdir = 'collect'; 	//采集插件目录
		$rid = '1'; 			//采集规则ID,多个ID之间用/分隔,如:1/2/3
		$adminuid = '1'; 		//执行采集操作的用户ID
		$adminname = 'phpvod'; 	//执行采集操作的用户名
		$unimport = ''; 		//当影片名称中包含该字符时则只采集不入库，如是中文，必须使用urlencode函数编码
		/* ----------- 自动采集设置选项 (结束)----------- */
		if($collect_switch == '1')
		{
			$url = "hack.php?hackname={$hackdir}&rid={$rid}&adminuid={$adminuid}&adminname={$adminname}&interval={$interval}&unimport={$unimport}";
			$htmlstr = "<img src=\"{$url}\" style=\"width:0px;height:0px;border:0px;\" />";
			echo $htmlstr;
		}
	}
	public function run_output()
	{}
}
?>