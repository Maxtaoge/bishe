<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $db_charset;?>">
<meta name="keywords" content="phpvod,php,mysql,video,movie">
<meta http-equiv="refresh" content="<?php echo $statime;?>;url=<?php echo $url;?>">
<base href="<?php echo $db_wwwurl;?>/" />
<title><?php echo $db_wwwname;?> - Powered by phpvod</title>
<style type="text/css">
body{ font-size:12px;}
a{ text-decoration:none;color:#333;}
a:hover{ text-decoration:underline;}
ol{list-style-type:decimal;margin-left:24px;color:#888;}
.fl{float:left;}
.fr{float:right;}
.mt10{margin-top:10px;}
.lh3{line-height:3;}
.tip-page{width:600px;margin:100px auto 30px;}
.tip-table{margin:0 1px;background:#ffffff;width:598px;}
.tip-top{background:url(<?php echo $imgpath;?>/<?php echo $stylepath;?>/tip-top.png) center no-repeat;height:50px;}
.tip-bgA,.tip-bgB,.tip-bgC,.tip-bgC {background:#333;}
.tip-bgA,.tip-bgB{height:1px;overflow:hidden;}
.tip-bgA{margin:0 2px;}
.tip-bgB{margin:0 1px;}
.tip-bgC{padding-top:1px;}
.tip-content{padding:0 0 0 67px;}
.tip-content tr td{padding:5px 10px 5px 0;line-height:25px;}
.show-back{text-decoration:underline;display:block;padding-right:25px;line-height:22px;overflow:hidden;background:url(<?php echo $imgpath;?>/<?php echo $stylepath;?>/tip-back.gif) right 0 no-repeat;height:20px;}
.show-back:hover{ background-position:right -20px;}
</style>
</head>
<body><?php echo $str;?>
<div class="tip-page">
<div class="tip-bgA"></div>
<div class="tip-bgB"></div>
<div class="tip-bgC">
<div class="tip-top"></div>
<table cellpadding="0" cellspacing="0" class="tip-table">
<tr><td height="170">
<div class="tip-content">
<div class="lh3">
<span class="f14"><?php echo $content;?></span><br />
<div class="cc" style="padding:0 20px 20px 0;">
<a href="<?php echo $url;?>" class="show-back fl" tabindex="20">如果您的浏览器没有自动跳转,请点击这里</a>
</div><br />
</div>
</div>
</td></tr>
</table>
</div>
<div class="tip-bgB"></div>
</div>	
</body></html>
