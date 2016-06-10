<?php
include('../../lib/conn.php');
 class MV {
 	public $name;
 	public $actor;
 	public $type;
 	public $makeArea;
 	public $language;
 	public $releaseTime;
 	public $long;
 function check(){
 	$sql="select id from movie where $name='$name'  limit 1";
 	if($result = $mysqli->query($sql)){
 		echo "已存在".$name;
 	}
 	else{
 		echo "不存在".$name;
 	}
 }
 function insert(){
 	$regtime = time();
 	$sql="INSERT INTO movie VALUES('$name','$actor','$type','$makeArea','$language','$releaseTime','$long','$regtime')";
 	if($result = $mysqli->query($sql)){
 		echo "添加成功".$name;
 	}
 	else{
 		echo "添加失败".$name;
 	}
 }
 }
?>