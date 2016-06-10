<?php
// 新建一个Dom实例
include_once '../lib/simple_html_dom.php';
$html = new simple_html_dom();
$url='https://movie.douban.com/subject/25830732/?tag=%E7%83%AD%E9%97%A8&from=gaia';
$html->load_file($url);
$main = $html->find('div[id=info]',0);
//echo $main;
$result = $main->find('span.pl');
foreach($result as $v) {echo $v->outertext . '<br>';}
?>