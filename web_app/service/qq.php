<?php
$a = $_GET["id"];
$str=file_get_contents("http://vv.video.qq.com/geturl?vid=$a");
preg_match( "/<urlbk>(.*?)<\/urlbk>/",$str,$durl);
preg_match("/<url>(.*?)<\/url>/",$durl[1],$url);
$url = $url[1];
header('Content-Type:application/force-download');//强制下载
header("Location:".$url);
?>