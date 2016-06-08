<?php 
include_once("../conn.php");//连接数据库 
 
$verify = stripslashes(trim($_GET['verify'])); 
$nowtime = time(); 
$query = mysql_query("select * from user where status='1' and	code='$verify'");
$row = mysql_fetch_array($query); 
if($row){ 
    if($nowtime>$row['exptime']){ //24hour 
        $msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.'; 
    }else{ 
        mysql_query("update user set status=0 where uid=".$row['uid']); 
        
        $msg = '激活成功！'; 
    } 
}else{ 
    $msg = 'error.';     
} 
echo $msg;
?>