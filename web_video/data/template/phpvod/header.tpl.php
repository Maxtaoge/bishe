<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="<?php echo $db_wwwurl;?>/" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $db_charset;?>" />
<?php if(PHPFUNC=='showmsg') { ?>	
<title>提示信息 - powered by PHPvod.com</title>	
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />	
<?php } elseif(PHPSELF=='index') { ?>
<title><?php echo $db_wwwname;?> - powered by PHPvod.com</title>	
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />
<?php } elseif(PHPSELF=='category') { ?>
<title><?php echo $_class[$cid]['caption'];?> - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />	
<?php } elseif(PHPSELF=='class') { ?>
<title><?php echo $_class[$cid]['caption'];?> - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />
<?php } elseif(PHPSELF=='read') { ?>
<title><?php echo $video['subject'];?> - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<meta name="keywords" content="<?php echo str_replace(array('"',"\'",'&nbsp;'), '', strip_tags($video['subject'])) ?>" />
<meta name="description" content="<?php echo pv_substr(str_replace(array('"',"\'","\n",'&nbsp;',' ','　'), '', strip_tags($video['synopsis'])), 200, 1); ?>" />
<?php } elseif(PHPSELF=='play') { ?>
<title><?php echo $video['subject'];?>(<?php echo $urlcaption;?>) - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />
<?php } else { if(PHPSELF == 'post') { ?>
<title>发布视频 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'faq') { ?>
<title>帮助 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'hack') { ?>	
<title><?php echo $_hack[$hackname]['name'];?> - 插件 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'login') { ?>	
<title>会员登录 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'message') { ?>
<title>短消息 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'notice') { ?>	
<title>网站公告 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'profile') { ?>
<title>个人中心 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>		
<?php } elseif(PHPSELF == 'register') { ?>
<title>会员注册 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'report') { ?>
<title>举报 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'search') { if(!empty($keyword)) $search_keyword = $keyword . ' - '; else $search_keyword = ''; ?><title><?php echo $search_keyword;?>搜索 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } elseif(PHPSELF == 'sendpwd') { ?>
<title>找回密码 - <?php echo $db_wwwname;?> - powered by PHPvod.com</title>
<?php } else { ?>
<title><?php echo $db_wwwname;?></title>
<?php } ?>
<meta name="keywords" content="<?php echo $db_keywords;?>" />
<meta name="description" content="<?php echo $db_description;?>" />
<?php } ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/phpvod.js"></script>
<!-- CSS --><?php $usercss = getcookie('pv_usercss', false); $csspath = !empty($usercss) ? $usercss : "$imgpath/$stylepath/default.css"; ?><link rel="stylesheet" type="text/css" id="csslink" href="<?php echo $csspath;?>" />
<!-- LESS -->
<!--
<link rel="stylesheet/less" type="text/css" href="<?php echo $imgpath;?>/<?php echo $stylepath;?>/default.less" />
<script type="text/javascript">var less = {env: "development"};</script>
<script type="text/javascript" src="js/less/less-1.7.0.min.js"></script>
<script type="text/javascript">less.watch();</script>
-->	
</head>
<body class="g-doc">
<div class="g-hd"><?php $adcode = ad('header'); if($adcode!='') { ?><div class="u-adheader f-m0a"><?php echo $adcode;?></div><?php } ?>	
<div class="m-header">
<div class="top">
<div class="style"><?php include gettpl('panel_style'); ?></div>
<div class="nav"><?php include gettpl('panel_nav'); ?></div>
</div>
<div class="logobanner">
<div class="logo"><a href="<?php echo $db_bfn;?>"><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/logo.gif" alt="<?php echo $db_wwwname;?>"/></a></div>
<div class="banner"><?php include gettpl('panel_search'); ?></div>			
</div>
</div><!-- header end --><?php include gettpl('panel_menu'); ?></div>

<div class="g-bd">
