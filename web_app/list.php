<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<body>
<center><table style="border:dotted;border-color:#F06">
<caption>用户信息</caption>
<tr><th>用户名</th><th>密码</th><th>邮箱</th><th>注册时间</th><th>编号</th></tr>
<?php

  session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
	header("Location:login.html");
	exit();
}
$link=mysql_connect('localhost','root','123456')or die("数据库连接失败");
//连接数据库
mysql_select_db('myphp',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式
$q="select * from user";//设置查询指令
$result=mysql_query($q);//执行查询
while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
 echo"<tr><td>".$row["username"]."</td><td>".$row["password"]."</td><td>".$row["email"]."</td><td>".$row["regdate"]."</td><td>".$row["uid"]."</td><tr>";
 
}
?>
</table>
<a href="my.php"">用户中心</a>
</center>
</body>
</html>