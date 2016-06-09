<?php include_once gettpl("hack_top"); ?><form action="<?php echo $basename;?>&action=video&act=search&rid=<?php echo $rid;?>" method="POST">
<table width="98%" align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td class=header colspan=2>影片搜索</td></tr>
<tr><td class=bg style="padding: 20px; line-height: 1em;">
说明: 搜索已采集的影片。(支持通配置符 *)<br /><br />
栏目: <select name="cid"><option value="all" selected>无限制</option><?php echo create_class_option(array('optgroup'=>true)); ?></select>
地区: <select name="nid"><option value="all" selected>无限制</option><?php echo create_nation_option(); ?></select>	
名称: <input type="text" name="subject" /> <input type="checkbox" name="subject_s" value="1"> 精确匹配
<input type="submit" value="提 交"/>
</td></tr>
</table>
</form>
<br />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr>
<td class=bg>
[<a href="<?php echo $basename;?>&action=video&rid=<?php echo $rid;?>" title="管理所有已采集的影片">影片管理</a>] 
[<a href="<?php echo $basename;?>&action=video&act=importall&rid=<?php echo $rid;?>&step=0" title="将所有已采集和连载已更新的影片进行入库操作">全部入库</a>] 
[<a href="<?php echo $basename;?>&action=video&act=downpic&rid=<?php echo $rid;?>" title="下载所有未入库影片的海报至本地">下载海报</a>]
[<a href="<?php echo $basename;?>&action=video&act=serialise&rid=<?php echo $rid;?>" title="管理已设置为连载的影片">连载影片</a>]
[<a href="<?php echo $basename;?>&action=video&act=unclass&rid=<?php echo $rid;?>" title="管理未知栏目的影片">未知栏目</a>]
[<a href="<?php echo $basename;?>&action=video&act=unnation&rid=<?php echo $rid;?>" title="管理未知地区的影片">未知地区</a>]
[<a href="<?php echo $basename;?>&action=video&act=import&rid=<?php echo $rid;?>" title="管理已入库的影片">已入库</a>]
[<a href="<?php echo $basename;?>&action=video&act=unimport&rid=<?php echo $rid;?>" title="管理未入库的影片">未入库</a>]
[<a href="<?php echo $basename;?>&action=video&act=unsubmit&rid=<?php echo $rid;?>" title="管理已设置不入库标记的影片">不入库</a>]
[<a href="<?php echo $basename;?>&action=video&act=delall&rid=<?php echo $rid;?>" title="清空所有采集记录" onclick="return window.confirm('清空历史数据将无法判断影片是否采集过，您确定要清空吗？');">清空历史数据</a>]
[<a href="<?php echo $basename;?>&action=manage">返回</a>]
</td>
</tr>
</table>
<br>

<?php if($act=='unclass' && count($errcids)>0) { ?>
<form action="<?php echo $basename;?>&action=replace&act=replaceClass" method="post" onKeydown="if(event.keyCode==13)return false;">
<input type="hidden" name="rid" value="<?php echo $rid;?>" />
<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td colspan="2" class="header">栏目批量替换</td></tr>
<tr class="bg">
<td width="40%">源栏目</td>
<td>
<select name="oldClass"><?php if(is_array($errcids)) { foreach($errcids as $errcid) { ?><option value="<?php echo $errcid['cid'];?>"><?php echo $errcid['cid'];?></option><?php } } ?></select>
</td>
</tr>
<tr class="bg">
<td>替换为</td>
<td><select name="newClass"><?php echo create_class_option(array('optgroup'=>true)); ?></select></td>
</tr>
<tr class="bg">
<td>添加至替换规则</td>
<td>
<input type="radio" name="addToReplaceRule" value="1" checked/>是
<input type="radio" name="addToReplaceRule" value="0" />否
</td>
</tr>
</table>
<br /><center><input type="submit" value="提 交" /></center>
</form>
<br />
<?php } if($act=='unnation' && count($errnids)>0) { ?>
<form action="<?php echo $basename;?>&action=replace&act=replaceNation" method="post" onKeydown="if(event.keyCode==13)return false;">
<input type="hidden" name="rid" value="<?php echo $rid;?>" />
<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td colspan="2" class="header">地区批量替换</td></tr>
<tr class="bg">
<td width="40%">源地区</td>
<td>
<select name="oldNation"><?php if(is_array($errnids)) { foreach($errnids as $errnid) { ?><option value="<?php echo $errnid['nid'];?>"><?php echo $errnid['nid'];?></option><?php } } ?></select>		
</td>
</tr>
<tr class="bg">
<td>替换为</td>
<td><select name="newNation"><?php echo create_nation_option(); ?></select></td>
</tr>
<tr class="bg">
<td>添加至替换规则</td>
<td>
<input type="radio" name="addToReplaceRule" value="1" checked/>是
<input type="radio" name="addToReplaceRule" value="0" />否
</td>
</tr>
</table>
<br /><center><input type="submit" value="提 交" /></center>
</form>
<br />
<?php } if(!$act || $act=='serialise' || $act=='unclass' || $act=='unnation' || $act=='unimport' || $act=='import' || $act=='unsubmit' || $act=='search') { ?>
<form action="<?php echo $basename;?>&action=video&act=post" method="post" onKeydown="if(event.keyCode==13)return false;">
<input type="hidden" name="rid" value="<?php echo $rid;?>" />
<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td colspan="10" class="header">影片管理</td></tr>	
<tr align="center" class="field">
<td width="5%">ID</td>
<td width="*">名称</td>
<td width="10%">栏目</td>
<td width="10%">地区</td>
<td width="8%">海报</td>
<td width="8%">采集</td>
<td width="8%">入库</td>
<td width="10%">连载</td>
<td width="5%">编辑</td>
<td width="5%">操作</td>
</tr><?php if(is_array($videodb)) { foreach($videodb as $video) { ?><tr align="center" class="bg">
<td><?php echo $video['id'];?><?php if($video['submit_flag']=='1') { ?><span style="color:red;">*</span><?php } ?></td>
<td>
<a href="<?php echo $video['fromurl'];?>" target="_blank"><?php echo $video['subject'];?></a>
<?php if(empty($video['pic']) || empty($video['content']) || empty($video['url']) || ($rule['videoPicDown']=='1' && $video['pic_flag']=='0')) { ?>
<br />
<span style="color: red;">
<?php if(empty($video['url'])) { ?>
影片地址
<?php } if(empty($video['content'])) { ?>
影片简介
<?php } if(empty($video['pic'])) { ?>
海报地址
<?php } if(($rule['videoPicDown']=='1' && $video['pic_flag']=='0')) { ?>
海报下载
<?php } ?>

出错!
</span>			
<?php } ?>			
</td>
<td><?php echo $video['cid'];?></td>
<td><?php echo $video['nid'];?></td>
<td>
<?php if($video['pic_flag']=='1') { ?>
<span style="color: green;">已下载</span>
<?php } else { ?>
<span style="color: red;">未下载</span>
<?php } ?>
</td>
<td>
<?php if($video['collect_flag']=='1') { ?>
<span style="color: green;">已采集</span>
<?php } else { ?>
<span style="color: red;">未采集</span>
<?php } ?>		
</td>
<td>
<?php if($video['import_flag']=='1') { ?>
<span style="color: green;">已入库</span>
<?php } else { ?>
<span style="color: red;">未入库</span>
<?php } ?>		
</td>
<td>
<?php if($video['serialise_flag']=='1') { ?><span style="color: green;">是</span><?php } else { ?><span style="color: red;">否</span><?php } ?> <?php if($video['serialise_update']=='1' && $video['import_flag']=='1') { ?><span style="color: red;">需要更新</span><?php } ?>
</td>
<td>
<a href="<?php echo $basename;?>&action=video&act=edit&rid=<?php echo $rid;?>&id=<?php echo $video['id'];?>">编辑</a>
</td>
<td>
<input type="checkbox" name="ids[]" value="<?php echo $video['id'];?>" />
</td>
</tr><?php } } ?></table><br />
<div style="text-align: right; width: 98%; "><?php echo $pages;?></div><br />
<center>
操作: 
<select name="operate">
<option value="import">影片入库</option>
<option value="restart">重新采集</option>
<option value="serialise">设置/取消连载</option>
<option value="submit">设置/取消不入库标记</option>
<option value="del">删除影片</option>
</select>

<input type="button" onClick="CheckAll(this.form)" value="全 选" /> 
<input type="submit" value="提 交" /> <br />
</center>
</form>

<?php } elseif($act=='edit') { ?>
<form action="<?php echo $basename;?>&action=video&act=edit" method="post">
<input type="hidden" name="step" value="2" />
<input type="hidden" name="id" value="<?php echo $row['id'];?>" />
<input type="hidden" name="rid" value="<?php echo $rid;?>" />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td colspan="2" class="header">影片编辑</td></tr>
<tr class=bg>
<td width="30%">栏目</td>
<td>
<select name="video[class]">
<?php if(isset($_class[$row['cid']])) { echo create_class_option(array('select'=>$row['cid'],'optgroup'=>true)); } else { ?>
<option value="<?php echo $row['cid'];?>" selected="selected">未知栏目</option><?php echo create_class_option(array('optgroup'=>true)); } ?>
</select>
</td>
</tr>
<tr class=bg>
<td>地区</td>
<td>
<select name="video[nation]">
<?php if(isset($_nation[$row['nid']])) { echo create_nation_option($row['nid']); } else { ?>
<option value="<?php echo $row['nid'];?>" selected="selected">未知地区</option><?php echo create_nation_option(); } ?>		
</select>
</td>
</tr>
<tr class=bg>
<td>标题</td>
<td><input type="text" name="video[subject]" value="<?php echo $row['subject'];?>" /></td>
</tr>
<tr class=bg>
<td>演员</td>
<td><input type="text" name="video[playactor]" value="<?php echo $row['playactor'];?>" /></td>
</tr>
<tr class=bg>
<td>导演</td>
<td><input type="text" name="video[director]" value="<?php echo $row['director'];?>" /></td>
</tr>
<tr class=bg>
<td>年代</td>
<td><input type="text" name="video[year]" value="<?php echo $row['year'];?>" /></td>
</tr>	
<tr class=bg>
<td>备注</td>
<td><input type="text" name="video[memo]" value="<?php echo $row['memo'];?>" /></td>
</tr>
<tr class=bg>
<td>海报</td>
<td><img src="<?php echo $vodimg;?>" width="134" height="180"/></td>
</tr>
<tr class=bg>
<td>内容</td>
<td><textarea cols="60" rows="8" name="video[content]"><?php echo $row['content'];?></textarea></td>
</tr>
<tr class=bg>
<td>地址<br /><span style="color:blue;">每行输入一个地址</span></td>
<td><textarea cols="60" rows="8" name="video[url]" wrap="off"><?php echo $row['url'];?></textarea></td>
</tr>
<tr class=bg>
<td>是否连载</td>
<td>
<input type="radio" name="video[serialise]" value="1" <?php echo $serialise_flag_1;?> />是
<input type="radio" name="video[serialise]" value="0" <?php echo $serialise_flag_0;?> />否
</td>
</tr>
</table>
<br >
<center><input type="submit" value="提 交" /></center>
</form>

<?php } include_once gettpl("hack_bottom"); ?>