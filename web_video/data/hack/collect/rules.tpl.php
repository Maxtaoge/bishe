<?php include_once gettpl("hack_top"); ?><script language="javascript" src="<?php echo $hackpath;?>/collect.js"></script>

<style type="text/css">
textarea{word-wrap: normal; overflow-x: auto;}
</style>

<table width="98%" align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td class=header colspan=2>提示信息</td></tr>
<tr><td class=bg style="padding: 20px; line-height: 1em;">
说明：可以添加及管理各站点采集规则，用<span style="color: red;">(*)</span>表示变动数据，用<span style="color: red;">(#)</span>表示需采集的数据<br /><br />
支持Perl风格的正则表达式，使用正则表达式时代码请用rule:开头。
</td></tr>
</table>
<br />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr>
<td class=bg>
[<a href="<?php echo $basename;?>">管理采集项目</a>]
[<strong><a href="<?php echo $basename;?>&action=rules&type=new">添加/编辑采集规则</a></strong>]
[<a href="<?php echo $basename;?>&action=bakup&type=import">导入规则</a>]
[<a href="<?php echo $basename;?>&action=setup">采集设置</a>]
[<a href="<?php echo $basename;?>&action=record">自动采集记录</a>]
</td>
</tr>
</table>
<br>

<form action="<?php echo $basename;?>&action=rules" method="post">
<input type=hidden name="type" value="<?php echo $type;?>">
<input type=hidden name="rid" value="<?php echo $row['id'];?>">
<input type=hidden name="step" value="2">

<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="2" class="header">基本信息</td></tr>
<tr class=bg>
<td width="30%">采集名称 <span style="color: red;">*</span></td>
<td>
<input type="text" name="rule[name]" value="<?php echo $row['name'];?>"/>
</td>
</tr>

<tr class=bg>
<td>目标网站编码</td>
<td>
<select name="rule[encode]">
<option value="gbk" <?php echo $encode_gbk;?>>简体中文 (gbk)</option> 
<option value="big5" <?php echo $encode_big5;?>>繁体中文 (big5)</option>
<option value="utf-8" <?php echo $encode_utf8;?>>UTF8编码 (utf-8)</option>
</select>
</td>
</tr>

<tr class=bg>
<td>播放器类型</td>
<td>
<select name="rule[playerType]">
<?php echo $player;?>
</select>
</td>
</tr>

</table>
<br>

<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="2" class="header">列表页链接采集</td></tr>
<tr class=bg>
<td>列表页设置</td>
<td>
<select name="rule[listType]" onchange="MM(this);">
<option value="0" <?php echo $listType_0;?>>单页</option> 
<option value="1" <?php echo $listType_1;?>>批量</option>
<option value="2" <?php echo $listType_2;?>>手动</option>
</select>
</td>
</tr>

<tr id="page0" class=bg>
<td>列表页地址 <span style="color: red;">*</span></td>
<td><input type="text" name="rule[listUrl1]" size="60" value="<?php echo $listUrl1;?>"/></td>
</tr>

<tr id="page1" class=bg style="display:none;">
<td>批量添加列表页地址 <span style="color: red;">*</span></td>
<td>
格式: http://www.phpvod.com/vod/class.php?page=(*)<br />
<input type="text" name="rule[listUrl2]" size="60" value="<?php echo $listUrl2;?>"/><br />
生成范围: <input type="text" name="rule[listUrl2s]" size="2" value="<?php echo $listUrl2s;?>"/> 到 <input type="text" name="rule[listUrl2e]" size="2" value="<?php echo $listUrl2e;?>"/>
</td>
</tr>

<tr id="page2" class=bg style="display:none;">
<td>手动添加列表页地址 <span style="color: red;">*</span><br /><span style="color: blue;">每行输入一个列表页地址</span></td>
<td>
<textarea name="rule[listUrl3]" cols="60" rows="5"><?php echo $listUrl3;?></textarea>
</td>
</tr>

<tr class=bg>
<td width="30%">链接代码区域</td>
<td>
<textarea name="rule[listLinkArea]" cols="60" rows="5"><?php echo $row['listLinkArea'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>链接代码 <span style="color: red;">*</span></td>
<td>
<textarea name="rule[listLink]" cols="60" rows="5"><?php echo $row['listLink'];?></textarea>
</td>
</tr>
</table>
<br>

<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="2" class="header">影片内容采集</td></tr>

<tr class=bg>
<td>影片栏目设置</td>
<td>
<select name="rule[videoClassType]" onchange="MM(this)">
<option value="3" <?php echo $videoClassType_3;?>>固定栏目</option>
<option value="4" <?php echo $videoClassType_4;?>>采集栏目</option>
</select>
</td>
</tr>

<tr id="page3" class=bg>
<td>选择栏目</td>
<td>
<select name="rule[videoClass1]"><?php echo $class_opt;?></select>
</td>
</tr>

<tr id="page4" class=bg style="display:none;">
<td>采集栏目</td>
<td>
<textarea name="rule[videoClass2]" cols="60" rows="5"><?php echo $row['videoClass'];?></textarea>
</td>
</tr>

<tr class=bg>
<td>影片地区设置</td>
<td>
<select name="rule[videoNationType]" onchange="MM(this)">
<option value="5" <?php echo $videoNationType_5;?>>固定地区</option>
<option value="6" <?php echo $videoNationType_6;?>>采集地区</option>
</select>
</td>
</tr>

<tr id="page5" class=bg>
<td>选择地区</td>
<td>
<select name="rule[videoNation1]"><?php echo $nation_opt;?></select>
</td>
</tr>

<tr id="page6" class=bg style="display:none;">
<td>采集地区</td>
<td>
<textarea name="rule[videoNation2]" cols="60" rows="5"><?php echo $row['videoNation'];?></textarea>
</td>
</tr>

<tr class=bg>
<td width="30%">标题</td>
<td>
<textarea name="rule[videoSubject]" cols="60" rows="5"><?php echo $row['videoSubject'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>主演</td>
<td>
<textarea name="rule[videoPlayactor]" cols="60" rows="5"><?php echo $row['videoPlayactor'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>导演</td>
<td>
<textarea name="rule[videoDirector]" cols="60" rows="5"><?php echo $row['videoDirector'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>年代</td>
<td>
<textarea name="rule[videoYear]" cols="60" rows="5"><?php echo $row['videoYear'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>备注</td>
<td>
<textarea name="rule[videoMemo]" cols="60" rows="5"><?php echo $row['videoMemo'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>海报</td>
<td>
<textarea name="rule[videoPic]" cols="60" rows="5"><?php echo $row['videoPic'];?></textarea>
<input type="checkbox" name="rule[videoPicDown]" value="1" <?php echo $videoPicDown_1;?> /> 下载图片
</td>
</tr>
<tr class=bg>
<td>简介</td>
<td>
<textarea name="rule[videoContent]" cols="60" rows="5"><?php echo $row['videoContent'];?></textarea>
<br />
<input type="checkbox" name="rule[delTag]" value="1" <?php echo $delTag;?>/> 删除HTML标签, 但保留 <input type="text" name="rule[tag]" value="<?php echo $tag;?>"/> 标签
</td>
</tr>
<tr class=bg>
<td>连载标记</td>
<td>
<textarea name="rule[videoSerialiseFlag]" cols="60" rows="5"><?php echo $row['videoSerialiseFlag'];?></textarea>
<br />
<input type="checkbox" name="rule[serSet]" value="1" <?php echo $serSet;?>/>
执行替换操作后的连载标记
<select name="rule[serSel]">
<option value="1" <?php echo $serSel_1;?>>包含</option>
<option value="2" <?php echo $serSel_2;?>>未包含</option>
</select>
<input type="text" name="rule[serCon]" value="<?php echo $serCon;?>"/>时，设置影片状态为连载，否则设置为完结
</td>
</tr>
<tr class=bg>
<td>播放列表区域</td>
<td>
<textarea name="rule[videoUrlArea]" cols="60" rows="5"><?php echo $row['videoUrlArea'];?></textarea>
</td>
</tr>
<tr class=bg>
<td>影片地址设置</td>
<td>
<select name="rule[videoUrlType]" onchange="MM(this)">
<option value="7" <?php echo $videoUrlType_7;?>>地址在本页</option>
<option value="8" <?php echo $videoUrlType_8;?>>地址在新页</option>
</select>	
</td>
</tr>

<tr id="page7" class=bg style="display: none;">
<td>新页链接处理</td>
<td>
<select id="url_replace" name="rule[videoUrlReplaceType]" onchange="MM(this)">
<option value="9" <?php echo $videoUrlReplaceType_9;?>>不处理</option>
<option value="10" <?php echo $videoUrlReplaceType_10;?>>替换地址</option>
</select>	
</td>
</tr>

<tr id="page8" class=bg style="display: none;">
<td>新页链接</td>
<td>
<textarea name="rule[videoUrlNewpage]" cols="60" rows="5"><?php echo $row['videoUrlNewpage'];?></textarea>
</td>
</tr>

<tr id="page9" class=bg style="display: none;">
<td>
替换为<br />
<span style="color: blue;">
新页连接: 如:javaScript:openwindow(<span style="color: red;">(#)</span>)<br />
替换为: 如:play.php?id=<span style="color: red;">(#)</span>
</span>
</td>
<td>
<textarea name="rule[videoUrlReplace]" cols="60" rows="5"><?php echo $row['videoUrlReplace'];?></textarea>
</td>
</tr>

<tr class=bg>
<td>
影片地址与各集标题<br />
<span style="color: blue;">
影片地址规则与标题规则请用 $$$ 分开
</span>
</td>
<td>
<textarea name="rule[videoUrl]" cols="60" rows="5"><?php echo $row['videoUrl'];?></textarea>
</td>
</tr>

</table>
<br>

<center><input type="submit" value="提 交"></center>
</form>


<script type="text/javascript">
change_sel("<?php echo $row['listType'];?>");
change_sel("<?php echo $row['videoClassType'];?>");
change_sel("<?php echo $row['videoNationType'];?>");
change_sel("<?php echo $row['videoUrlType'];?>");
change_sel("<?php echo $row['videoUrlReplaceType'];?>");
</script><?php include_once gettpl("hack_bottom"); ?>