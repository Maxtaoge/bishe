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
[<strong><a href="<?php echo $basename;?>">管理采集项目</a></strong>]
[<a href="<?php echo $basename;?>&action=rules&type=new">添加/编辑采集规则</a>]
[<a href="<?php echo $basename;?>&action=bakup&type=import">导入规则</a>]
[<a href="<?php echo $basename;?>&action=setup">采集设置</a>]
[<a href="<?php echo $basename;?>&action=record">自动采集记录</a>]
</td>
</tr>
</table>
<br />

<table width="98%" align="center" cellpadding="3" cellspacing="1" class="tableborder">
<tr><td colspan="3" class="header">采集项目管理</td></tr>
<tr align="center" class="field">
<td width="10%">ID</td>
<td width="60%">采集名称</td>
<td width="30%">操作</td>
</tr><?php if(is_array($collectdb)) { foreach($collectdb as $value) { ?><tr class=bg align="center">
<td><?php echo $value['id'];?></td>
<td><?php echo $value['name'];?></td>
<td>
<a href="<?php echo $basename;?>&action=collect&rid=<?php echo $value['id'];?>" title="采集并更新指定页面中的影片和连载影片">采集</a>
<a href="<?php echo $basename;?>&action=serialise&rid=<?php echo $value['id'];?>" title="更新所有连载影片">连载</a>
<a href="<?php echo $basename;?>&action=replace&rid=<?php echo $value['id'];?>" title="设置替换规则">替换</a> 
<a href="<?php echo $basename;?>&action=rules&type=edit&rid=<?php echo $value['id'];?>" title="编辑采集规则">编辑</a>
<a href="<?php echo $basename;?>&action=video&rid=<?php echo $value['id'];?>" title="管理已采集的影片">影片</a>
<a href="<?php echo $basename;?>&action=manage&do=del&rid=<?php echo $value['id'];?>" title="删除采集规则">删除</a> 		
<a href="<?php echo $basename;?>&action=bakup&type=export&rid=<?php echo $value['id'];?>" title="导出采集规则">导出</a> 
</td>
</tr><?php } } ?></table><?php include_once gettpl("hack_bottom"); ?>