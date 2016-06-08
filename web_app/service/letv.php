<?php
//生成api所需信息
$times = time();
$uu = "ab417c1571";//B站uu
$vu = "1233a5fc63";//视频vu
$sign_f = "cfflashformatjsonran".$times."uu".$uu."ver2.2vu".$vu."2f9d6924b33a165a6d8b5d3d42f4f987";//合并签名参数
$sign = md5($sign_f);//计算签名
$api = "http://api.letvcloud.com/gpc.php?cf=flash&sign=".$sign."&ver=2.2&format=json&uu=".$uu."&vu=".$vu."&ran=".$times;//计算api地址
//访问api取得详细信息
$res = file_get_contents($api);
$info = json_decode($res, true);
//解析api结果
if($info['code'] != 0){
    echo "调用未成功，原因：".$info['message'];
    exit();
}
$video_info=$info['data']['video_info']['media'];
foreach($video_info as $video_value){
    echo "找到清晰度：".$video_value['definition']."\n分辨率：".$video_value['play_url']['vwidth']."×".$video_value['play_url']['vheight']."\n";
    echo "比特率：".$video_value['play_url']['gbr']."\n";
    echo "下载地址：".base64_decode($video_value['play_url']['main_url'])."\n";
    echo "\n";
}