<?php
session_start();

//注销登录
if(isset($_GET['action'])){
 if($_GET['action'] == "logout"){
    unset($_SESSION['userid']);
    unset($_SESSION['username']);
    echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
    exit;
}
}

//登录
if(!isset($_POST['submit'])){
    exit('非法访问!');
}
$username = htmlspecialchars($_POST['username']);
$password = MD5($_POST['password']);

//包含数据库连接文件
include('conn.php');
//检测用户名及密码是否正确
$check_query = mysql_query("select uid,status from user where username='$username' and password='$password'  
limit 1");
if($result = mysql_fetch_array($check_query) or die(mysql_error())) {
    //登录成功
    if($result['status']=='0'){
    $_SESSION['username'] = $username;
    $_SESSION['userid'] = $result['uid'];
    $url="index.php";
   header("Location: $url"); 
   # echo $username,' 欢迎你！进入 <a href="index.php">用户中心</a><br />';
    #echo '点击此处 <a href="login.php?action=logout">注销</a> 登录！<br />';
    exit;
}
else {
	
	
	exit('用户尚未激活，请激活后重试！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}
}
else {
    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
}




?>