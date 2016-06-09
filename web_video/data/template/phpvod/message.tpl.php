<table class="m-box f-w100 f-mt10">
<tr><th colspan="4"><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 短消息</th></tr>
<tr class="f-tac">
<td width="25%"><a href="message.php?action=write">写新消息</a></td>
<td width="25%"><a href="message.php">收件箱</a></td>
<td width="25%"><a href="message.php?action=sendbox">发件箱</a></td>
<td width="25%"><a href="message.php?action=clear" onclick="return confirm('将删除收件箱和发件箱内所有消息，请确认！');">清空</a></td>
</tr>
</table>
<?php if($action=='receivebox') { ?>
<form action="message.php" method="post">
<input type="hidden" name="action" value="del" />
<table class="m-box f-w100 f-mt10">
<tr><th colspan="6"><span class="f-fs12 f-defaultcolor f-fr">信箱状态：目前有短消息 <?php echo $msgcount;?> 条；最多可存消息 <?php echo $gp_maxmsg;?> 条；使用率 <?php echo $contl;?>%</span>收件箱</th></tr>
<tr class="f-fwb f-tac">
<td width="6%">ID</td>
<td>标题</td>
<td width="10%">发件人</td>
<td width="20%">时间</td>
<td width="7%">已读</td>
<td width="7%">删除</td>		
</tr><?php if(is_array($msgdb)) { foreach($msgdb as $key => $value) { $key++; ?><tr class="f-tac">
<td><?php echo $key;?></td>
<td><a href="message.php?action=read&mid=<?php echo $value['mid'];?>"><?php echo $value['title'];?></a></td>
<td><?php echo $value['username'];?></td>
<td><?php echo $value['mdate'];?></td>
<td>
<?php if($value['ifnew']) { ?>
<span style="color:#FF0000">否</span>
<?php } else { ?>
是
<?php } ?>
</td>
<td><input type="checkbox" name="delid[]" value="<?php echo $value['mid'];?>" /></td>
</tr><?php } } ?></table><br />
<center>
<input type="button" name="chkall" value="全 选" class="u-btn2" onclick="check_all(this.form)" />
<input type="submit" value="提 交" class="u-btn1" />
</center>
</form>
<?php } elseif($action=='sendbox') { ?>
<form action="message.php" method="post">
<input type="hidden" name="action" value="del" />
<table class="m-box f-w100 f-mt10">
<tr><th colspan="5">发件箱</th></tr>
<tr class="f-fwb f-tac">
<td width="6%">ID</td>
<td>标题</td>
<td width="10%">收件人</td>
<td width="20%">时间</td>
<td width="7%">删除</td>
</tr><?php if(is_array($msgdb)) { foreach($msgdb as $key => $value) { $key++; ?><tr class="f-tac">
<td><?php echo $key;?></td>
<td><a href="message.php?action=read&mid=<?php echo $value['mid'];?>"><?php echo $value['title'];?></a></td>
<td><?php echo $value['touser'];?></td>
<td><?php echo $value['mdate'];?></td>
<td><input type="checkbox" name="delid[]" value="<?php echo $value['mid'];?>" /></td>
</tr><?php } } ?></table><br />
<center>
<input type="button" name="chkall" value="全 选" class="u-btn2" onclick="check_all(this.form)" />
<input type="submit" value="提 交" class="u-btn1" />
</center>
</form>
<?php } elseif($action=='write') { ?>
<form action="message.php?action=write" method="post">
<input type="hidden" name="step" value="2" />
<input type="hidden" name="mdate" value="<?php echo $timestamp;?>" />

<table class="m-box f-w100 f-mt10">
<tr><th colspan="2">写新消息</th></tr>
<tr>
<td class="f-w30">用户名</td>
<td><input type="text" name="msg_user" maxlength="100" class="u-text" value="<?php echo $msgid;?>"/></td>
</tr>

<tr>
<td>标题</td>
<td><input type="text" name="msg_title" maxlength="75" class="u-text" value="<?php echo $subject;?>" /></td>
</tr>
<tr>
<td>内容</td>
<td><?php echo create_kindeditor('msg','msg_content',600,200,$content,'base_options'); ?></td>
</tr>
<?php if($db_gdcheck & 8) { ?>
<tr>
<td>认证码</td>
<td>
<div><input type="text" id="gdcode" name="gdcode" size="6" class="u-text" /></div>
<div class="f-mt2"><img src="ck.php?nowtime=<?php echo $timestamp;?>" align="absmiddle" style="cursor:pointer;" id="ckcode" onclick="this.src='ck.php?nowtime='+new Date().getTime();" alt="看不清楚，换一张" title="看不清楚，换一张" /></div>
</td>
</tr>
<?php } ?>
<tr>
<td>&nbsp;</td>
<td><input type="checkbox" name="ifsave" value="1" /> 保存到发件箱</td>
</tr>
</table><br />
<center><input type="submit" value="提 交" name="Submit" class="u-btn1" /></center>
</form>
<?php } elseif($action=='read') { ?>
<table class="m-box f-w100 f-mt10">
<tr><th colspan="2">阅读短消息</th></tr>
<tr>
<td class="f-w30">用户名</td>
<td><?php echo $msginfo['username'];?></td>
</tr>
<tr>
<td>标题</td>
<td><?php echo $msginfo['title'];?></td>
</tr>
<tr>
<td>时间</td>
<td><?php echo $msginfo['mdate'];?></td>
</tr>
<tr>
<td>内容</td>
<td><?php echo $msginfo['content'];?></td>
</tr>
<tr>
<td>操作</td>
<td>
<?php if($msginfo['fromuid'] != $uid && $msginfo['fromuid'] != '0') { ?>
<a href="message.php?action=write&remid=<?php echo $msginfo['mid'];?>">回复</a>&nbsp;
<?php } ?>
<a href="message.php?action=del&mid=<?php echo $msginfo['mid'];?>">删除</a>
</td>
</tr>
</table><br />
<center><input type="button" value="返 回" class="u-btn1" onclick="javascript:history.go(-1);"></center>
<?php } ?>
