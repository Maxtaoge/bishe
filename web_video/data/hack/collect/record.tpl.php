<?php include_once gettpl("hack_top"); ?><table width="98%" align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td class=header colspan=2>提示信息</td></tr>
<tr><td class=bg style="padding: 20px; line-height: 1em;">
说明：显示自动采集记录
</td></tr>
</table>
<br />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr>
<td class=bg>
[<a href="<?php echo $basename;?>">管理采集项目</a>]
[<a href="<?php echo $basename;?>&action=rules&type=new">添加/编辑采集规则</a>]
[<a href="<?php echo $basename;?>&action=bakup&type=import">导入规则</a>]
[<a href="<?php echo $basename;?>&action=setup">采集设置</a>]
[<strong><a href="<?php echo $basename;?>&action=record">自动采集记录</a></strong>]
</td>
</tr>
</table>
<br />

<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="9" class="header">自动采集记录</td></tr>
<tr align="center" class="field">
<td width="5%">序号</td>
<td width="15%">采集名称</td>
<td width="9%">入库成功</td>
<td width="9%">入库失败</td>
<td width="9%">不入库</td>
<td width="9%">采集出错</td>
<td width="17%">开始时间</td>
<td width="17%">结束时间</td>
<td width="10%">采集耗时(秒)</td>		
</tr><?php if(is_array($recorddb)) { foreach($recorddb as $record) { ?><tr class=bg align=center>
<td><?php echo $record['lid'];?></td>
<td><?php echo $record['name'];?></td>
<td><?php echo $record['collectdata']['import_success'];?></td>
<td><?php echo $record['collectdata']['import_fail'];?></td>
<td><?php echo $record['collectdata']['import_unsubmit'];?></td>
<td><?php echo $record['collectdata']['import_dataerror'];?></td>
<td><?php echo $record['collectdata']['starttime'];?></td>
<td><?php echo $record['collectdata']['endtime'];?></td>
<td><?php echo $record['collectdata']['withtime'];?></td>	
</tr><?php } } ?></table><br />
<div style="text-align: right; width: 98%; "><?php echo $pages;?></div><br /><?php include_once gettpl("hack_bottom"); ?>