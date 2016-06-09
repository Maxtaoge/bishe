<?php
<?php
取得指定位址的內容，並储存至text
$text=file_get_contents('http://yourweb/');

去除換行及空白字元（序列化內容才需使用）
$text=str_replace(array("\r","\n","\t","\s"), '', $text); 

取出div标签且id為PostContent的內容，並储存至阵列match
preg_match('/<div[^>]*id="PostContent"[^>]*>(.*?) <\/div>/si',$text,$match);

印出match[0]
print($match[0]);
?>