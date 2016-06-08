<?php
$str = "http://www.php-z.com/";
$pat="/^(http:\/\/)?([^\/]+)/i";
preg_match($pat, $str, $match);
#preg_match("/^(htp:\/\/)?([^/]+)/i","http://www.5idev.com/index.html", $matches);
$host = $match[2];
echo $host;
// 从主机名中取得后面两段
#preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
//UTF-8 使用：
//preg_match_all("/[x{4e00}-x{9fa5}]+/u", $str, $match);
$pat1="/[^\.\/]+\.[^\.\/]+$/";
preg_match($pat1, $host, $match);
print_r($match);
?>