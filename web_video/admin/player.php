<?php
!defined('IN_PHPVOD') && exit('Forbidden');

if(!$action)
{
	$playerdb = array();
	$query = $db->query("SELECT * FROM pv_player ORDER BY pid");
	while($player = $db->fetch_array($query))
	{
		$playerdb[] = $player;
	}
}
elseif($action == "add")
{
	initvar('step', 'P', 2);
	if($step == '2')
	{
		initvar(array('name', 'subject'), 'P');
		initvar(array('playpath', 'content'), 'P', 0);
		initvar('hidden', 'P', 2);
		$content = stripslashes($content);

		if(empty($name) || empty($content) || empty($playpath)) adminmsg('operate_fail');
		$playpath .= '.htm';
		if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath)) adminmsg('player_file_exists', 'goback', array($playpath));
		writeover(PHPVOD_ROOT . 'data/player/' . $playpath, $content);
		if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath))
		{
			$db->update("INSERT INTO pv_player (hidden,name,subject,playpath) VALUES ('$hidden','$name','$subject','$playpath');");
			adminmsg('operate_success');
		}
		else
		{
			adminmsg('player_error', 'goback');
		}
	}
}
elseif($action == "edit")
{
	initvar('step', 'P', 2);
	if($step != '2')
	{
		initvar('pid', 'G', 2);
		$player = $db->get_one("SELECT * FROM pv_player WHERE pid='$pid'");
		!$player && adminmsg('player_not_exists');
		ifcheck($player['hidden'], 'hidden');
		$content = readover(PHPVOD_ROOT . 'data/player/' . $player['playpath']);
		$player['playpath'] = trim($player['playpath'], '.htm');
	}
	else
	{
		initvar(array('name', 'subject'), 'P');
		initvar(array('playpath', 'content'), 'P', 0);
		initvar(array('hidden', 'pid'), 'P', 2);
		$content = stripslashes($content);

		if(empty($name) || empty($content) || empty($playpath)) adminmsg('operate_fail');
		$playpath .= '.htm';

		$player = $db->get_one("SELECT playpath FROM pv_player WHERE pid='$pid'");
		if($player['playpath'] != $playpath)
		{
			if(is_file(PHPVOD_ROOT . 'data/player/' . $playpath)) adminmsg('player_file_exists', 'goback', array($playpath));
			rename(PHPVOD_ROOT . 'data/player/' . $player['playpath'], PHPVOD_ROOT . 'data/player/' . $playpath);
		}
		writeover(PHPVOD_ROOT . 'data/player/' . $playpath, $content);
		$db->update("UPDATE pv_player SET hidden='$hidden',name='$name',subject='$subject',playpath='$playpath' WHERE pid='$pid'");
		adminmsg('operate_success');
	}
}
elseif($action == "del")
{
	initvar(array('selid','applyid'), 'P', 2);
	if(!empty($selid))
	{
		foreach($selid as $pid)
		{
			$player = $db->get_one("SELECT playpath FROM pv_player WHERE pid='$pid'");
			delfile(PHPVOD_ROOT . 'data/player/' . $player['playpath']);
			$db->update("DELETE FROM pv_player WHERE pid='$pid'");
		}
	}
	$db->update("UPDATE pv_player SET hidden=0");
	if($idstr = checkselid($applyid))
	{
		$db->update("UPDATE pv_player SET hidden=1 WHERE pid IN($idstr)");
	}
	adminmsg('operate_success');
}
elseif($action == "playerlist")
{
	$xml = new DOMDocument();

	// 加载Xml文件
	$xml->load("http://service.phpvod.com/data/player/config.xml");

	// 获取所有的item标签
	$items = $xml->getElementsByTagName("item");

	$i = 0;
	$playerlist = array();
	foreach($items as $item)
	{
		$name = str_convert($item->getElementsByTagName("name")->item(0)->nodeValue, $db_charset, 'utf-8'); //播放器名称
		$subject = str_convert($item->getElementsByTagName("subject")->item(0)->nodeValue, $db_charset, 'utf-8'); //播放器描述
		$datetime = str_convert($item->getElementsByTagName("datetime")->item(0)->nodeValue, $db_charset, 'utf-8'); //最后更新时间

		$playerlist[$i]['name'] = $name;
		$playerlist[$i]['subject'] = $subject;
		$playerlist[$i]['datetime'] = $datetime;

		$i++;
	}
}
elseif($action == 'install')
{
	initvar('player', 'G', 0);
	if(!empty($player))
	{
		$remoteurl = 'http://service.phpvod.com/data/player/' . $player . '/';

		$xml = new DOMDocument();
		$xml->load($remoteurl . 'config.xml');

		$name = str_convert($xml->getElementsByTagName("name")->item(0)->nodeValue, $db_charset, 'utf-8'); //播放器名称
		$subject = str_convert($xml->getElementsByTagName("subject")->item(0)->nodeValue, $db_charset, 'utf-8'); //播放器描述
		$playpath = str_convert($xml->getElementsByTagName("playpath")->item(0)->nodeValue, $db_charset, 'utf-8'); //播放器文件名
		$filelist = str_convert($xml->getElementsByTagName("filelist")->item(0)->nodeValue, $db_charset, 'utf-8'); //文件列表

		if(empty($name) || empty($playpath) || empty($filelist)) adminmsg('player_info_error');

		//下载播放器文件
		define('PHPVOD_PLAYER_ROOT', PHPVOD_ROOT . 'data' . DIRECTORY_SEPARATOR . 'player');
		$filearray = explode("\n", $filelist);
		foreach($filearray as $filepath)
		{
			$filepath = trim($filepath);
			if($filepath == '') continue;

			//创建目录
			$current_dir = PHPVOD_PLAYER_ROOT;
			$dir = dirname($filepath);
			if($dir != '.')
			{
				$dirname = explode('/', $dir);
				foreach($dirname as $d)
				{
					if(!is_dir($current_dir . DIRECTORY_SEPARATOR . $d)) mkdir($current_dir . DIRECTORY_SEPARATOR . $d);
					$current_dir .= DIRECTORY_SEPARATOR . $d;
				}
			}

			//下载文件
			copy($remoteurl . $filepath, PHPVOD_PLAYER_ROOT . DIRECTORY_SEPARATOR . $filepath);
		}

		//更新数据库
		$db->if_update("SELECT pid FROM pv_player WHERE playpath='$playpath'",
				"UPDATE pv_player SET name='$name',subject='$subject' WHERE playpath='$playpath'",
				"INSERT INTO pv_player(name,subject,playpath,hidden) VALUES('$name','$subject','$playpath','1')"
				);

		adminmsg('operate_success');
	}
	else
	{
		adminmsg('operate_fail');
	}
}

include gettpl('player');

?>