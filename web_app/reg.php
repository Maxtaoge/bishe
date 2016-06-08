<?php
require_once("service/mail.php");
session_start();
if(!isset($_POST['submit'])){
	exit('非法访问!');
}
unset($_SESSION['userid']);
unset($_SESSION['username']);
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['user_email'];
//注册信息判断
if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
	exit('错误：用户名不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
if(strlen($password) < 6){
	exit('错误：密码长度不符合规定。<a href="javascript:history.back(-1);">返回</a>');
}
  if(preg_match('/^([a-zA-Z0-9] [_|-|.]?)*[a-zA-Z0-9] @([a-zA-Z0-9] [_|-|.]?)*[a-zA-Z0-9] .[a-zA-Z]{2,3}$/', $email)){
	exit('错误：电子邮箱格式错误。<a href="javascript:history.back(-1);">返回</a>');
}
//包含数据库连接文件
include('conn.php');
//检测用户名是否已经存在
$check_query = mysql_query("select uid from user where username='$username' limit 1");
if(mysql_fetch_array($check_query)){
	echo '错误：用户名 ',$username,' 已存在。<a href="javascript:history.back(-1);">返回</a>';
	exit;
}
//写入数据
$email = trim($_POST['user_email']); //邮箱
$regtime = time();
$password = MD5($password);
$regdate = date("Y-m-d");
$status=1;
$token = md5($username.$_POST['password'].$regtime); //创建用于激活识别码
$exptime = time()+60*60*24;//过期时间为24小时后
$sql = "INSERT INTO user(username,password,email,regdate,status,code,exptime)VALUES('$username','$password','$email','$regdate','$status','$token','$exptime')";
if(mysql_query($sql,$conn)){
    $check_query = mysql_query("select uid from user where username='$username' and password='$password' limit 1");
if($result = mysql_fetch_array($check_query) or die(mysql_error())) {
	
	sendMail($email,$username,$token);
	
    //登录成功
    
    echo $username,' 欢迎你！进入 <a href="index.php">用户中心</a><br />';
    echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
    exit;
} else {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
	
} else {
	echo '抱歉！添加数据失败：',mysql_error(),'<br />';
	echo '点击此处 <a href="javascript:history.back(-1);">返回</a> 重试';
}
?>
