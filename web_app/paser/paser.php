<?php
// 新建一个Dom实例
include_once '../lib/simple_html_dom.php';
include ('model/paser');
$html = new simple_html_dom();
$url='https://movie.douban.com/subject/25830732/?tag=%E7%83%AD%E9%97%A8&from=gaia';
$html->load_file($url);
$main = $html->find('div[id=info]',0);
//echo $main;
//$result = $main->find('span.pl');
//foreach($result as $v) {echo $v->outertext . '<br>';}
/* foreach($html->find('div#info') as $e)
	echo $e->innertext . '<br>'; */
//echo $main;
$ret =$main->find('span.attrs');
echo $ret[0]->innertext;
$ret1 = $ret[0]->find('a', 0);
 MV->actor=$ret1->innertext;
echo $ret1->innertext;

//echo $ret->innertext;
?>