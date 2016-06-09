您好，
<?php if($groupid=='guest') { ?>
请 <a href="register.php">注册</a> 或 <a href="login.php">登录</a>
<?php } else { ?>
<?php echo $username;?>！<a href="login.php?action=quit">[退出]</a>
┆ <a href="profile.php?action=show&id=<?php echo $uid;?>">个人中心</a>
┆ <a href="message.php">短消息</a> <?php if($user['newpm']==1) { ?><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/new.gif" /><?php } } if($gp_allowpost=='1') { ?>
┆ <a href="post.php" class="f-stylecolor">发布视频</a>
<?php } if(is_array($hackdb['1'])) { foreach($hackdb['1'] as $h) { ?>┆ <a href="hack.php?hackname=<?php echo $h['directory'];?>"><?php echo $h['name'];?></a><?php } } if($SYSTEM['allowadmincp']=='1') { ?>
┆ <a href="admin.php" target="_blank">后台管理</a>
<?php } ?>

┆ <a href="search.php">搜索</a>

<?php if($db_mergesystype=='ucenter' && $db_mergeshowapp=='1') { include_once PHPVOD_ROOT . 'uc_client/data/cache/apps.php'; if(is_array($_CACHE['apps'])) { foreach($_CACHE['apps'] as $key => $value) { if($value['appid'] != UC_APPID && is_numeric($key)) { ?>
┆ <a href="<?php echo $value['url'];?>" target="_blank"><?php echo $value['name'];?></a>	
<?php } } } } ?>

┆ <a href="arthome.php">文档</a>
┆ <a href="rss.php" target="_blank">RSS</a>