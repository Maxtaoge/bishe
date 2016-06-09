<div class="videoreply">
<div class="caption">视频评论</div>
<div class="content">
<form method="post" name="replyform" action="reply.php?action=add" id="login" onsubmit="return false;">
<input type="hidden" name="vid" id="vid" value="<?php echo $video['vid'];?>" />
<input type="hidden" name="cid" id="cid" value="<?php echo $video['cid'];?>" />
<div class="showedit"><?php echo create_kindeditor('reply','content','656','200','','base_options'); ?></div>
<div class="f-fr">
<input type="button" value="提 交" onclick="post_reply();" class="u-btn1" />
<input type="button" value="重 写" onclick="reply.html('');" class="u-btn2" />
</div>
<?php if($db_gdcheck & 4) { ?>
<div class="f-fl">
<div class="f-fl"><label for="gdcode">验证码：</label></div>
<div class="f-fl"><input type="text" id="gdcode" name="gdcode" size="6" class="u-text" /></div>
<div class="gdimg f-fl"><img src="ck.php?admin=1&nowtime=<?php echo $timestamp;?>" align="absmiddle" style="cursor:pointer;" id="ckcode" onclick="this.src='ck.php?admin=1&nowtime='+new Date().getTime();" alt="看不清楚，换一张" title="看不清楚，换一张" /></div>
</div>
<?php } ?>
<div class="f-cb"></div>								
</form>	
<a name="replylist"></a>
<div id="replylist">正在加载评论，请稍候...</div>					
</div>					
</div>

<script type="text/javascript">
function post_reply()
{
len = reply.count('text');
if(len < <?php echo $db_postmin;?> || len > <?php echo $db_postmax;?>)
{
alert('内容尺寸必须在 <?php echo $db_postmin;?> - <?php echo $db_postmax;?> 之间, 当前长度: '+len);
}
else
{
var gdcheck = $("#gdcode").length > 0 ? true : false;
vid = $("#vid").attr("value");
cid = $("#cid").attr("value");
content = reply.html();
var datastr = {"vid":vid,"cid":cid,"content":content};

if(gdcheck)
{
if($("#gdcode").val()=="")
{
alert("请输入验证码");
$("#gdcode").focus();
return false;								
}
else
{
var gdcode = $("#gdcode").val();
}
}

if(gdcode == undefined)
var datastr = {"vid":vid,"cid":cid,"content":content};
else
var datastr = {"vid":vid,"cid":cid,"content":content,"gdcode":gdcode};					

$.ajax({
type:"POST",
url:"reply.php?action=add",
data:datastr,
success:function(msg){
if(gdcheck)
{
$("#gdcode").attr("value","");
$("#ckcode").attr("src","ck.php?admin=1&nowtime="+new Date().getTime()); //更换验证码										
} 

if(msg!='success' && msg!='')
{
alert(msg);
}
else
{
reply.html('');
get_reply(vid);									
}
}
});				
}			
}

function get_reply(vid)
{
var parampage = arguments[1];
var page = parampage ? parampage : 1;
  
$.ajax({
type:"POST",
url:"reply.php",
data:"vid="+vid+"&page="+page,
success:function(msg){
$("#replylist").html(msg);
if(parampage) location.hash="#replylist"; //如果参数包含页码，则跳转到#replylist标记
}
});
}

get_reply(<?php echo $vid;?>);
</script>