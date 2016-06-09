<link rel="stylesheet" type="text/css" href="js/validform/style.css" />
<script type="text/javascript" src="js/validform/validform_min.js"></script>
<script type="text/javascript" src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/post.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#postform").Validform({
showAllError: true,
tiptype:3
});
});
function playgroup_add()
{
var caption = '视频地址<span class="u-need">*</span><br />每行输入一个视频地址<br />格式：<span style="color: green">视频地址</span>,<span style="color: red">标题</span><br />说明：视频地址与标题之间用","分开，标题部分为可选项，可省略。';
var html = '<select name="video[pid][]"><?php echo $video['player']['0'];?></select><br /><textarea name="video[urls][]" cols="80" rows="8" style="word-wrap: normal; overflow-x: auto; margin: 5px 0px;" datatype="*" nullmsg="视频地址不能为空！"></textarea><br /><input type="button" class="u-btn2" onclick="playgroup_del(this);" value="删除" /><span class="Validform_checktip"></span>';
$("#post_url").append("<tr><td>"+caption+"</td><td>"+html+"</td></tr>");
}
function playgroup_del(obj)
{
$(obj).parent().parent().remove();
}
</script>

<form method="post" name="from" id="postform" action="post.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="<?php echo $action;?>" />
<input type="hidden" value="2" name="step" />

<?php if($action=='modify') { ?>
<input type="hidden" value="<?php echo $video['vid'];?>" name="video[vid]" />
<?php } if(($action=='new' || $action=='modify') && $step!='2') { ?>
<table class="m-box f-w100 f-mt10" id="tp">
<tr><th colspan="2">
<img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 
<?php if($action=='new') { ?>发布视频<?php } else { ?>编辑视频<?php } ?>
</th></tr>


<?php if($db_gdcheck & 4) { ?>
<tr>
<td>认证码<span class="u-need">*</span></td>
<td>
<div><input type="text" id="gdcode" name="video[gdcode]" size="6" class="u-text" datatype="*" ajaxurl="ajax.php?action=check_gdcode" nullmsg="请输入验证码！" errormsg="验证码错误！" /></div>
<div class="f-mt2"><img src="ck.php?nowtime=<?php echo $timestamp;?>" align="absmiddle" style="cursor:pointer;" id="ckcode" onclick="this.src='ck.php?nowtime='+new Date().getTime();" alt="看不清楚，换一张" title="看不清楚，换一张" /></div>
</td>
</tr>
<?php } ?>

<tr>
<td class="f-w40">所属类别<span class="u-need">*</span></td>
<td>
<select name="video[cid]">
<?php echo $_class_opt;?>
</select>
</td>
</tr>

<tr>
<td>国家/地区<span class="u-need">*</span></td>
<td>
<select name="video[nid]">
<?php echo $_nation_opt;?>
</select>
</td>
</tr>

<tr>
<td>标题<span class="u-need">*</span></td>
<td>
<input type="text" name="video[subject]" id="subject" size="30" class="u-text" value="<?php echo $video['subject'];?>" datatype="*" ajaxurl="ajax.php?action=check_video_subject&type=<?php echo $action;?>&vid=<?php echo $video['vid'];?>" nullmsg="视频标题不能为空！" />
</td>
</tr>

<tr>
<td>标签[<a href="#" onclick="this.blur();alert('其他用户可以通过标签方便的找到这个节目');return false;">说明</a>]</td>
<td>
<input type="text" name="video[tag]" value="<?php echo $video['tag'];?>" class="u-text" /> (多个标签、演员或导演请用空格或","隔开)
</td>
</tr>

<tr>
<td>领衔主演</td>
<td><input type="text" name="video[playactor]" value="<?php echo $video['playactor'];?>" class="u-text" /></td>
</tr>

<tr>
<td>导演</td>
<td><input type="text" name="video[director]" value="<?php echo $video['director'];?>" class="u-text" /></td>
</tr>

<?php if($db_yearstart!='' && $db_yearend!='') { ?>
<tr>
<td>发行年份</td>
<td>
<select name="video[year]">
<option value="">未知</option><?php for($i=$db_yearstart;$i<=$db_yearend;$i++) { ?><option value="<?php echo $i;?>"<?php echo $year[$i];?>><?php echo $i;?></option><?php } ?></select>
</td>
</tr>
<?php } ?>

<tr>
<td>影片状态</td>
<td>
<select name="video[serialise]">
<option value="0"<?php echo $serialise_0;?>>完结</option>
<option value="1"<?php echo $serialise_1;?>>连载</option>
</select>
</td>
</tr>

<tr>
<td>备注</td>
<td><input type="text" name="video[memo]" value="<?php echo $video['memo'];?>" class="u-text" /></td>
</tr>

<tr>
<td>内容简介</td>
<td><?php echo create_kindeditor('synopsis','video[synopsis]',600,200, $video['synopsis']); ?></td>
</tr>

<tr>
<td>海报 <br />允许上传格式: <?php echo $db_picfiletype;?> <br />允许上传大小: <?php echo ceil($db_picmaxsize / 1024); ?>KB</td>
<td>
<?php if($action=='modify') { ?>		
<div class="f-mb5"><img src="<?php echo $img;?>" style="width: 95px; height: 127px;" /></div>
<?php } if($db_uploadvodpic) { ?>
<div style="margin-bottom: 3px;">图片上传 <input name="video[image]" type="file" size="30" class="u-text" onchange="image_change(this)"/></div>
<?php } ?>
<div>图片地址 <input name="video[imgurl]" type="text" size="30" class="u-text" />
<input name="video[downimg]" type="checkbox" value="1" />下载图片 [地址必须是以 http://开头的路径]</div>
</td>
</tr>

<tbody id="post_url">
<tr><td colspan="2">播放组控制: <input type="button" class="u-btn1" onclick="playgroup_add();return false;" value="添加播放组" /></td></tr><?php if(is_array($video['urls'])) { foreach($video['urls'] as $key => $value) { ?><tr>
<td>视频地址<span class="u-need">*</span><br />
每行输入一个视频地址<br />
格式：<span style="color: green">视频地址</span>,<span style="color: red">标题</span><br />
说明：视频地址与标题之间用","分开，标题部分为可选项，可省略。
</td>
<td>
<select name="video[pid][]"><?php echo $video['player'][$key];?></select><br />
<textarea name="video[urls][]" cols="80" rows="8" style="margin: 5px 0px;" wrap="off" datatype="*" nullmsg="视频地址不能为空！"><?php echo $value;?></textarea>
<br />
<input type="button" class="u-btn2" onclick="playgroup_del(this);" value="删除" />
<span class="Validform_checktip"></span>
</td>
</tr><?php } } ?></tbody>

</table><br />
<center><input id="submit_button" type="submit" value="提 交" class="u-btn3" /></center><br />
</form>
<?php } ?>