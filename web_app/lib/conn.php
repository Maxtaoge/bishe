<?php
/*****************************
*数据库连接
*****************************/
$conn = new mysqli("localhost","root","123456");
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
mysql_select_db("db", $conn);
//字符转换，读库
mysql_query("set character set 'utf-8'");
//写库
mysql_query("set names 'utf-8'");
?>