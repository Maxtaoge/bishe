
<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
	header("Location:'login.html'");
	exit();
}

//包含数据库连接文件
include('conn.php');
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$user_query = mysql_query("select * from user where uid=$userid limit 1");
if($user_query){
$row = mysql_fetch_array($user_query);
echo '用户信息：<br />';
echo '用户ID：',$userid,'<br />';
echo '用户名：',$username,'<br />';
echo '邮箱：',$row['email'],'<br />';
echo '注册日期：',date("Y-m-d", $row['regdate']),'<br />';
echo '<a href="login.php?action=logout">注销</a>  <a href="list.php">数据库信息</a>  <a href="message/addmessage.php">添加留言</a>登录<br /> ';
echo '<a href="message/listmessage.php">留言板</a> <a href="service/upload.php">上传电影</a>';
echo '<a href="list_upload.php">查看上传</a>';
}
else {
	echo '<p> 查询数据库出错</p>';
}
?>