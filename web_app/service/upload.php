<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

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
include('../conn.php');
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
<html>
<head>
<title>电影上传</title>
<style type="text/css">
<!--
body
{
font-size: 9pt;
}
input
{
background-color: #66CCFF;
border: 1px inset #CCCCCC;
}
-->
</style>
</head>


<body>
<form enctype="multipart/form-data" method="post" name="upform">
<p>
<label for="moviename" class="label">电影名称:</label>
<input id="moviename" name="moviename" type="text" class="input" />
<p/>
<p>
<label for="movieurl" class="label">电影链接:</label>
<input id="movieurl" name="movieurl" type="text" class="input" />
<p/>
<p>
<label for="actor" class="label">主       演:</label>
<input id="actor" name="actor" type="text" class="input" />
<p/>
<p>
<label for="detail" class="label">描        述:</label>
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