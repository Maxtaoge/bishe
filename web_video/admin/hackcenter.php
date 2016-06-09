<?php
!defined('IN_PHPVOD') && exit('Forbidden');
include_once (PHPVOD_ROOT . 'data/cache/hack.php');

if($action == 'add')
{
	initvar('step','P',2);
	if($step == '2')
	{
		initvar(array('hidden','spos'),'P',2);
		initvar(array('name','directory','listener'),'P');

		if(!$name || !$directory)
		{
			adminmsg('hackcenter_empty');
		}
		if(!is_dir(PHPVOD_ROOT . "hack/$directory"))
		{
			adminmsg('hackcenter_upload');
		}
		if(is_array($_hack))
		{
			foreach($_hack as $key => $value)
			{
				if($directory == $value['directory'])
				{
					adminmsg('hackcenter_sign_exists', '', array($directory));
				}
			}
		}
		if(!empty($listener) && !file_exists(PHPVOD_ROOT . "hack/$directory/$listener"))
		{
			adminmsg('listener_not_exists');
		}	
		
		if(file_exists(PHPVOD_ROOT . "hack/$directory/sql.txt"))
		{
			database_revert(PHPVOD_ROOT . "hack/$directory/sql.txt");
			delfile(PHPVOD_ROOT . "hack/$directory/sql.txt");
		}

		$db->update("INSERT INTO pv_hack (name,directory,hidden,spos,listener) VALUES ('$name','$directory','$hidden','$spos','$listener');");
		updatecache_hack();
		!empty($listener) && register_listener(array('file'=>"hack/$directory/$listener")); //注册监听器
		adminmsg('operate_success');
	}
}
elseif($action == "edit")
{
	initvar('step','P',2);
	if($step != 2)
	{
		initvar('directory','GP');
		ifcheck($_hack[$directory]['hidden'], 'hidden');
		ifcheck($_hack[$directory]['spos'], 'spos', 'select');
	}
	else
	{
		initvar(array('hidden','spos'),'P',2);
		initvar(array('name','directory','hackdir','listener'),'P');
		$lisfile = $_hack[$hackdir]['listener'];
		
		if(!$name || !$directory)
		{
			adminmsg('hackcenter_empty');
		}

		if(is_array($_hack))
		{
			foreach($_hack as $key => $value)
			{
				if($directory == $value['directory'] && $value['hid'] != $_hack[$hackdir]['hid'])
				{
					adminmsg('hackcenter_sign_exists', '', array($directory));
				}
			}
		}
		
		if(!empty($listener) && !file_exists(PHPVOD_ROOT . "hack/$hackdir/$listener"))
		{
			adminmsg('listener_not_exists');
		}				

		$db->update("UPDATE pv_hack SET hidden='$hidden',name='$name',directory='$directory',spos='$spos',listener='$listener' WHERE directory='$hackdir'");
		updatecache_hack();

		//更新监听器		
		if(!empty($lisfile)) //已经设置过监听器
		{
			$old_listener = "hack/$hackdir/$lisfile";
			$lis = $db->get_one("SELECT id FROM pv_listener WHERE file='$old_listener'");
			if($lis['id']) //有监听器记录，可能的操作为更新或卸载
			{
				if(empty($listener))
					unregister_listener($lis['id']); //卸载监听器
				else
					update_listener(array('file'=>"hack/$directory/$listener"), $lis['id']); //更新监听器				
			}
			else
			{
				!empty($listener) && register_listener(array('file'=>"hack/$directory/$listener")); //注册监听器
			}
		}
		else 
		{
			!empty($listener) && register_listener(array('file'=>"hack/$directory/$listener")); //注册监听器
		}
		
		if(@rename(PHPVOD_ROOT . "hack/$hackdir", PHPVOD_ROOT . "hack/$directory"))
		{
			adminmsg('operate_success');
		}
		else
		{
			adminmsg('hackcenter_edit_fail', '', array($hackdir, $directory));
		}
	}
}
elseif($action == "update")
{
	initvar('applyid','P',2);
	$db->update("UPDATE pv_hack SET hidden=0");
	if($applyid = checkselid($applyid))
	{
		$db->update("UPDATE pv_hack SET hidden=1 WHERE hid IN($applyid)");
	}
	updatecache_hack();
	adminmsg('operate_success');
}
elseif($action == 'del')
{
	initvar('directory');
	$db->query("DELETE FROM pv_hack WHERE directory='$directory'");
	if(empty($_hack[$directory]['directory'])) adminmsg('hackcenter_directory_error');
	$file_dir = PHPVOD_ROOT . "hack/{$_hack[$directory][directory]}";
	$data_dir = PHPVOD_ROOT . "data/hack/{$_hack[$directory][directory]}";
	updatecache_hack();
	
	//卸载监听器
	if(!empty($_hack[$directory]['listener']))
	{
		$listener = "hack/$directory/{$_hack[$directory]['listener']}";
		$lis = $db->get_one("SELECT id FROM pv_listener WHERE file='$listener'");
		if(!empty($lis)) unregister_listener($lis['id']);		
	}
	
	if(deldir($file_dir) === false || deldir($data_dir) === false)
	{
		adminmsg('hackcenter_del_fail', '', array($_hack[$directory]['directory']));
	}
	else
	{
		adminmsg('operate_success');
	}
}
elseif($action == 'parse')
{
	initvar('directory');
	updatecache_hack_template($directory);
	adminmsg('operate_success');
}

include gettpl('hackcenter');
?>