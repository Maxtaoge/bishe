<?php include_once gettpl("hack_top"); ?><table width="98%" align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr><td class=header colspan=2>提示信息</td></tr>
<tr><td class=bg style="padding: 20px; line-height: 1em;">
说明：导入各站点采集规则
</td></tr>
</table>
<br />

<table width=98% align=center cellspacing=1 cellpadding=3 class=tableborder>
<tr>
<td class=bg>
[<a href="<?php echo $basename;?>">管理采集项目</a>]
[<a href="<?php echo $basename;?>&action=rules&type=new">添加/编辑采集规则</a>]
[<strong><a href="<?php echo $basename;?>&action=bakup&type=import">导入规则</a></strong>]
[<a href="<?php echo $basename;?>&action=setup">采集设置</a>]
[<a href="<?php echo $basename;?>&action=record">自动采集记录</a>]
</td>
</tr>
</table>
<br />

<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="5" class="header">采集规则在线安装</td></tr>
<tr align="center" class="field">
<td width="15%">名称</td>
<td width="25%">网址</td>
<td width="10%">推荐等级</td>
<td width="40%">简介</td>
<td width="10%">操作</td>
</tr><?php if(is_array($rules)) { foreach($rules as $rule) { ?><tr class=bg align=center>
<td><?php echo $rule['caption'];?></td>
<td><a href="<?php echo $rule['url'];?>" target="_blank"><?php echo $rule['url'];?></a></td>
<td><?php echo $rule['star'];?></td>
<td><?php echo $rule['memo'];?></td>
<td><a href="<?php echo $basename;?>&action=bakup&type=install&file=<?php echo $rule['file'];?>">安装</a></td>
</tr><?php } } ?></table>
<br />

<form method="post" action="<?php echo $basename;?>&action=bakup&type=import">
<input type="hidden" name="step" value="2" />
<table width=98% align="center" cellpadding=3 cellspacing=1 class=tableborder>
<tr><td colspan="2" class="header">规则导入</td></tr>
<tr class=bg>
<td width="30%">规则代码</td>
<td><textarea cols="65" rows="8" name="rulecode"></textarea></td>
</tr>
</table>
<br />
<center><input type="submit" value="提 交"/></center>
</form><?php include_once gettpl("hack_bottom"); ?>