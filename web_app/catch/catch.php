<?php

//取得指定位址的內容，並储存至text
$text=file_get_contents('http://blog.sina.com.cn/s/blog_6ad6243801016dmi.html');

//去除換行及空白字元（序列化內容才需使用）
$text=str_replace(array("\r","\n","\t","\s"), '', $text); 
$pattern='#<div[^<>]*>(([^<>]*|(?R))*)</[^<>]*>#';
preg_match_all($pattern,$text,$match);
//取出div标签且id為PostContent的內容，並储存至阵列match
//preg_match('/<div[^>]*id="sinablogHead"[^>]*>(.*?) <\/div>/',$text,$match);

//印出match[0]
print($match[0]);
//preg_match('/<div[^>]*id="headflash"[^>]*><\/div>/',$match[0],$match);//(.*?) 
//print($match[0]);
?>