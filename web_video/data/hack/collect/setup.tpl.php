<?php include_once gettpl("hack_top"); ?><table width="98%" align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td class=header colspan=2>提示信息</td></tr>
<tr><td class=bg style="padding: 20px; line-height: 1em;">
说明：管理各站点采集规则
</td></tr>
</table>
<br />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr>
<td class=bg>
[<a href="<?php echo $basename;?>">管理采集项目</a>]
[<a href="<?php echo $basename;?>&action=rules&type=new">添加/编辑采集规则</a>]
[<a href="<?php echo $basename;?>&action=bakup&type=import">导入规则</a>]
[<strong><a href="<?php echo $basename;?>&action=setup">采集设置</a></strong>]
[<a href="<?php echo $basename;?>&action=record">自动采集记录</a>]
</td>
</tr>
</table>
<br />

<form method="post" action="<?php echo $basename;?>&action=setup">
<input type="hidden" name="step" value="2" />
<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="2" class="header">采集设置</td></tr>
<tr class="bg">
<td width="35%">每次采集的项目数</td>
<td><input type="text" name="collect[col_step]" value="<?php echo $col_step;?>"/></td>
</tr>
<tr class="bg">
<td>连载影片入库时除更新播放地址外, 还需更新</td>
<td>
<input type="checkbox" name="collect[col_update_subject]" value="1" <?php if($col_update_subject==1) { ?>checked="checked"<?php } ?> />标题
<input type="checkbox" name="collect[col_update_pic]" value="1" <?php if($col_update_pic==1) { ?>checked="checked"<?php } ?> />海报
<input type="checkbox" name="collect[col_update_playactor]" value="1" <?php if($col_update_playactor==1) { ?>checked="checked"<?php } ?> />演员
<input type="checkbox" name="collect[col_update_director]" value="1" <?php if($col_update_director==1) { ?>checked="checked"<?php } ?> />导演
<input type="checkbox" name="collect[col_update_year]" value="1" <?php if($col_update_year==1) { ?>checked="checked"<?php } ?> />年代		
<input type="checkbox" name="collect[col_update_memo]" value="1" <?php if($col_update_memo==1) { ?>checked="checked"<?php } ?> />备注
<input type="checkbox" name="collect[col_update_content]" value="1" <?php if($col_update_content==1) { ?>checked="checked"<?php } ?> />内容简介
</td>
</tr>
<tr class="bg">
<td>影片入库存在同名影片时</td>
<td>
<input type="radio" name="collect[col_samename]" value="4" <?php echo $col_samename_4;?> />正常入库
<input type="radio" name="collect[col_samename]" value="1" <?php echo $col_samename_1;?> />添加播放来源
<input type="radio" name="collect[col_samename]" value="2" <?php echo $col_samename_2;?> />覆盖源地址
<input type="radio" name="collect[col_samename]" value="3" <?php echo $col_samename_3;?> />忽略
</td>
</tr>
<tr class="bg">
<td>影片入库随机用户名<br />多个用户名之间用逗号(,)隔开</td>
<td>
<input type="text" name="collect[col_random_username]" value="<?php echo $col_random_username;?>" style="width: 300px;"/>
</td>
</tr>
<tr class="bg">
<td>影片入库随机发布时间<br />开始时间 - 结束时间</td>
<td>
<input type="text" name="collect[col_random_postdate_start]" value="<?php echo $col_random_postdate_start;?>" />
-
<input type="text" name="collect[col_random_postdate_end]" value="<?php echo $col_random_postdate_end;?>" />
(格式: 2010-06-16 16:30:00) 
</td>
</tr>
<tr class="bg">
<td>影片入库随机点击数<br />最小值 - 最大值</td>
<td>
<input type="text" name="collect[col_random_hits_min]" value="<?php echo $col_random_hits_min;?>" />
-
<input type="text" name="collect[col_random_hits_max]" value="<?php echo $col_random_hits_max;?>" />
</td>
</tr>
</table>
<br />
<center><input type="submit" value="提 交" /></center>
</form><?php include_once gettpl("hack_bottom"); ?>