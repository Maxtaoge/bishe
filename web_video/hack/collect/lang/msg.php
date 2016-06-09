<?php
$lang = array(
	'operate_success'					=>	'完成相应操作',
	'operate_fail'						=>	'操作失败，请检查数据完整性',

	'admin_function_error'				=>	'PHP运行环境已屏蔽 file_get_contents 函数, 插件无法使用',
	'admin_phpini_error'				=>	'PHP运行环境没有开启 allow_url_fopen 选项, 插件无法使用',
	'admin_chmod'						=>	'请为 \\1 目录添加可读写权限，Unix主机请设为777',

	'collect_cache_success'				=>	'缓存已生成, 正在收集影片地址, 请稍候...',
	'collect_show_listurls'				=>	'列表页地址: \\1 &nbsp;&nbsp;<a href="\\2">[跳过]</a>&nbsp;&nbsp;<a href="\\3">[停止]</a><br /><br /><br />新记录 \\4 条, 连载 \\5 条, 重复 \\6 条',
	'collect_video_content'				=>	'正在采集影片内容, 请稍候...',
	'collect_video_limit'				=>	'采集中, 请稍候... &nbsp;&nbsp; 采集进度: \\1/\\2 <br /><br />\\3<br /><br /><br /><a href="\\4">[重试]</a>&nbsp;&nbsp;<a href="\\5">[停止]</a>',
	'collect_success'					=>	'恭喜, 采集完成',

	'serialise_cache_success'			=>	'缓存已生成, 正在更新连载影片, 请稍候...',
	'serialise_video_limit'				=>	'更新中, 请稍候... &nbsp;&nbsp; 更新进度: \\1/\\2 <br /><br />\\3<br /><br /><br /><a href="\\4">[重试]</a>&nbsp;&nbsp;<a href="\\5">[停止]</a>',
	'serialise_success'					=>	'恭喜, 连载更新完成, 已更新 \\1 部影片, 请及时入库',

	'replace_class_error'				=>	'栏目无效, 请选择频道的下级栏目',

	'video_class_error'					=>	'不能将栏目设置为频道级别, 请选择子栏目',
	'video_import_http'					=>	'影片入库不支持使用跨台固定图片链',
	'video_import_success'				=>	'操作完成, 成功导入 \\1 部影片, \\2 部影片导入失败',
	'video_import_isun'					=>	'部分影片所属未知栏目或未知地区, 操作无法继续',
	'video_import_running'				=>	'正在导入影片, \\1 - \\2 导入完成, \\3 部影片导入失败',
	'video_downpic_cache'				=>	'缓存已生成, 正在下载影片海报, 请稍候...',
	'video_downpic_running'				=>	'正在下载海报, 请稍候... &nbsp;&nbsp; 更新进度: \\1/\\2 <br /><br />\\3<br /><br /><br /><a href=\"\\4\">[重试]</a>&nbsp;&nbsp;<a href="\\5">[停止]</a>',
	'video_downpic_success'				=>	'恭喜, 海报下载完成',

	'bakup_import_fail'					=>	'规则格式错误, 导入失败',
);
?>