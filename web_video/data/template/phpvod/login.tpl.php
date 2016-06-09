<div class="g-full f-mt10">
<form action="login.php" method="post" name="login">
<input type="hidden" value="2" name="step" />
<table class="m-box f-w100">
<tr><th colspan="2">
<img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> 
<a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 会员登录
</th></tr>
<?php if($db_gdcheck & 2) { ?>
<tr>
<td><strong>验证码</strong></td>
<td>
<div><input type="text" id="gdcode" name="gdcode" size="6" class="u-text" /></div>
<div class="f-mt2"><img src="ck.php?nowtime=<?php echo $timestamp;?>" align="absmiddle" style="cursor:pointer;" id="ckcode" onclick="this.src='ck.php?nowtime='+new Date().getTime();" alt="看不清楚，换一张" title="看不清楚，换一张" /></div>
</td>
</tr>
<?php } ?>

<tr>
<td class="f-w40"><strong>用户名</strong></td>
<td><input type="text" name="username" class="u-text" /></td>
</tr>
<tr>
<td><strong>密码</strong></td>
<td><input type="password" name="password" class="u-text" /> <a href="sendpwd.php">忘记密码</a></td>
</tr>
<tr>
<td><strong>Cookie 有效期</strong></td>
<td>
<input type="radio" name="cktime" value="31536000" checked="checked" /> 一年
<input type="radio" name="cktime" value="2592000" /> 一个月
<input type="radio" name="cktime" value="86400" /> 一天
<input type="radio" name="cktime" value="3600" /> 一小时
<input type="radio" name="cktime" value="0" /> 即时
</td>
</tr>
</table>
<br /><center><input name="submit" type="submit" value="登 录" class="u-btn3" /></center>
</form>
</div>
