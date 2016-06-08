

<?php
session_start();
if(!isset($_SESSION['userid'])){
	header("Location:login.html");
	exit();
}
/******************************************************************************

参数说明:
$max_file_size : 上传文件大小限制, 单位BYTE
$destination_folder : 上传文件路径
$watermark : 是否附加水印(1为加水印,其他为不加水印);

使用说明:
1. 将PHP.INI文件里面的"extension=php_gd2.dll"一行前面的;号去掉,因为我们要用到GD库;
2. 将extension_dir =改为你的php_gd2.dll所在目录;
******************************************************************************/
include('conn.php');
//上传文件类型列表
$uptypes=array(
'image/jpg',
'image/jpeg',
'image/png',
'image/pjpeg',
'image/gif',
'image/bmp',
'image/x-png'
);

$max_file_size=2000000; //上传文件大小限制, 单位BYTE
$destination_folder="../web_app/uploadimg/"; //上传文件路径
$watermark=1; //是否附加水印(1为加水印,其他为不加水印);
$watertype=1; //水印类型(1为文字,2为图片)
$waterposition=1; //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
$waterstring="http://www.phpthinking.com/"; //水印字符串
$waterimg="xplore.gif"; //水印图片
$imgpreview=1; //是否生成预览图(1为生成,其他为不生成);
$imgpreviewsize=1/2; //缩略图比例
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hydrogen &mdash; A free HTML5 Template </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Google Webfonts -->
	<link href='http://fonts.useso.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
	<link href='http://fonts.useso.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Salvattore -->
	<link rel="stylesheet" href="css/salvattore.css">
	<!-- Theme Style -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div id="fh5co-offcanvass">
		<a href="#" class="fh5co-offcanvass-close js-fh5co-offcanvass-close">Menu <i class="icon-cross"></i> </a>
		<h1 class="fh5co-logo"><a class="navbar-brand" href="index.html">Hydrogen</a></h1>
		<ul>
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="pricing.html">Pricing</a></li>
			<li><a href="upload.php">上传</a></li>
			<li><a href="list_upload.php">查看上传</a></li>
			<li><a href="pricing.html">注册</a></li>
		</ul>
		<h3 class="fh5co-lead">Connect with us</h3>
		<p class="fh5co-social-icons">
			<a href="#"><i class="icon-twitter"></i></a>
			<a href="#"><i class="icon-facebook"></i></a>
			<a href="#"><i class="icon-instagram"></i></a>
			<a href="#"><i class="icon-dribbble"></i></a>
			<a href="#"><i class="icon-youtube"></i></a>
		</p>
	</div>
	<header id="fh5co-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<a href="#" class="fh5co-menu-btn js-fh5co-menu-btn">Menu <i class="icon-menu"></i></a>
					<a class="navbar-brand" href="index.html">Hydrogen</a>		
				</div>
			</div>
		</div>
	</header>
	<!-- END .header -->
	
	
	<div id="fh5co-main">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2>Pricing</h2>
					
						<div>
       <form enctype="multipart/form-data" method="post" name="upform">
          <p>
          <font size="3" color="red">电影名称:</font>
        <input id="moviename" name="moviename" type="text" class="input" />
             <p/>
           <p>
        <font size="3" color="red">电影链接:</font>
       <input id="movieurl" name="movieurl" type="text" class="input" />
             <p/>
        <p>
           <font size="3" color="red">电影主演:</font>
          <input id="actor" name="actor" type="text" class="input" />
       <p/>
         <p>
          <font size="3" color="red">电影描述:</font>
           <input id="detail" name="detail" type="text" class="input" />
         <span>(必填)</span>
        <p/>
           <p>
          <input type="submit" name="submit" value=" 上传  " class="left" />
             </p>
         封面:
          <input name="upfile" type="file">
           <input type="submit" value="上传"><br>
            允许上传的文件类型为:<?php echo implode(', ',$uptypes)?>
            </form>
               </div>
					
					</div>
					
				</div>
        		
        	</div>
       </div>
	</div>

	<footer id="fh5co-footer">
		
		<div class="container">
			<div class="row row-padded">
				<div class="col-md-12 text-center">
					<p class="fh5co-social-icons">
						<a href="#"><i class="icon-twitter"></i></a>
						<a href="#"><i class="icon-facebook"></i></a>
						<a href="#"><i class="icon-instagram"></i></a>
						<a href="#"><i class="icon-dribbble"></i></a>
						<a href="#"><i class="icon-youtube"></i></a>
					</p>
					<p><small>&copy; Hydrogen Free HTML5 Template. All Rights Reserved. <br>More Templates <a href="#" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="#" title="网页模板" target="_blank">网页模板</a> | Images by: <a href="http://pexels.com" target="_blank">Pexels</a> </small></p>
				</div>
			</div>
		</div>
	</footer>


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Salvattore -->
	<script src="js/salvattore.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>

	
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
if (!is_uploaded_file($_FILES["upfile"]["tmp_name"]))
//是否存在文件
{
echo "图片不存在!";
exit;
}

$file = $_FILES["upfile"];
if($max_file_size < $file["size"])
//检查文件大小
{
echo "文件太大!";
exit;
}

if(!in_array($file["type"], $uptypes))
//检查文件类型
{
echo "文件类型不符!".$file["type"];
exit;
}

if(!file_exists($destination_folder))
{
mkdir($destination_folder);
}

$filename=$file["tmp_name"];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo['extension'];
$destination = $destination_folder.time().".".$ftype;
if (file_exists($destination) && $overwrite != true)
{
echo "同名文件已经存在了";
exit;
}

if(!move_uploaded_file ($filename, $destination))
{
echo "移动文件出错";
exit;
}

$pinfo=pathinfo($destination);
$fname=$pinfo["basename"];
echo " <font color=red>已经成功上传</font><br>文件名: <font color=blue>".$destination_folder.$fname."</font><br>";
echo " 宽度:".$image_size[0];
echo " 长度:".$image_size[1];
echo "<br> 大小:".$file["size"]." bytes";

$username = $_SESSION['username'];
$moviename = $_POST['moviename'];
$movieurl = $_POST['movieurl'];
$actor = $_POST['actor'];
$detail = $_POST['detail'];
$regdate = date("Y-m-d");
$check_query = mysql_query("select upload_id from upload_movie where movie_name='$moviename' limit 1");
if(mysql_fetch_array($check_query)){
	echo '错误：电影 ',$moviename,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
	exit;
}
$sql = "INSERT INTO upload_movie(pic_name,user,movie_name,upload_time,movie_link,major_actor,describ)VALUES('$fname','$username','$moviename','$regdate','$movieurl','$actor','$detail')";
if(mysql_query($sql,$conn)){
	exit('上传成功！');
} else {
	echo '抱歉！添加数据失败：',mysql_error(),'<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
if($watermark==1)
{
$iinfo=getimagesize($destination,$iinfo);
$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
$white=imagecolorallocate($nimage,255,255,255);
$black=imagecolorallocate($nimage,0,0,0);
$red=imagecolorallocate($nimage,255,0,0);
imagefill($nimage,0,0,$white);
switch ($iinfo[2])
{
case 1:
$simage =imagecreatefromgif($destination);
break;
case 2:
$simage =imagecreatefromjpeg($destination);
break;
case 3:
$simage =imagecreatefrompng($destination);
break;
case 6:
$simage =imagecreatefromwbmp($destination);
break;
default:
die("不支持的文件类型");
exit;
}

imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);

switch($watertype)
{
case 1: //加水印字符串
imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
break;
case 2: //加水印图片
$simage1 =imagecreatefromgif("xplore.gif");
imagecopy($nimage,$simage1,0,0,0,0,85,15);
imagedestroy($simage1);
break;
}

switch ($iinfo[2])
{
case 1:
//imagegif($nimage, $destination);
imagejpeg($nimage, $destination);
break;
case 2:
imagejpeg($nimage, $destination);
break;
case 3:
imagepng($nimage, $destination);
break;
case 6:
imagewbmp($nimage, $destination);
//imagejpeg($nimage, $destination);
break;
}

//覆盖原上传文件
imagedestroy($nimage);
imagedestroy($simage);
}

if($imgpreview==1)
{
echo "<br>图片预览:<br>";
echo "<img src=\"".$destination."\" width=".($image_size[0]*$imgpreviewsize)." height=".($image_size[1]*$imgpreviewsize);
echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
}
}
?>
	
	</body>
</html>
