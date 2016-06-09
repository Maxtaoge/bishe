<form action="register.php" method="post" name="register" class="register">
<input type="hidden" value="2" name="step" />
<table class="m-box f-w100 f-mt10">
<tr><th colspan="2">
<img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> 
<a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 新会员注册
</th></tr>
<?php if($db_gdcheck & 1) { ?>
<tr>
<td><strong>认证码<span class="u-need">*</span></strong></td>
<td> 
<div><input type="text" name="gdcode" id="gdcode" size="6" class="u-text" datatype="*" ajaxurl="ajax.php?action=check_gdcode" nullmsg="请输入验证码！" errormsg="验证码错误！" /></div>
<div class="f-mt2"><img src="ck.php?nowtime=<?php echo $timestamp;?>" align="absmiddle" style="cursor:pointer;" id="ckcode" onclick="this.src='ck.php?nowtime='+new Date().getTime();$('#gdcode')[0].validform_valid='false';" alt="看不清楚，换一张" title="看不清楚，换一张" /></div>
</td>
</tr>
<?php } ?>
<tr>
<td class="f-w40"><strong>用户名<span class="u-need">*</span></strong></td>
<td><input type="text" class="u-text" name="regname" datatype="s<?php echo $rg_regminname;?>-<?php echo $rg_regmaxname;?>" ajaxurl="ajax.php?action=check_username" nullmsg="请输入用户名！" errormsg="用户名长度为<?php echo $rg_regminname;?>-<?php echo $rg_regmaxname;?>个字符！" /></td>
</tr>

<tr>
<td><strong>密码<span class="u-need">*</span></strong></td>
<td><input type="password" class="u-text" name="regpwd" datatype="*6-20" nullmsg="请填写密码！" errormsg="密码范围在6-20位之间！" /></td>
</tr>

<tr>
<td><strong>确认密码<span class="u-need">*</span></strong></td>
<td><input type="password" class="u-text" name="regpwdrepeat" datatype="*" recheck="regpwd" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" /></td>
</tr>

<tr>
<td><strong>E-Mail<span class="u-need">*</span></strong><?php if($rg_regcheck=='1') { ?><br /><span class="f-stylecolor">帐号需要认证，请正确填写邮箱地址</span><?php } ?></td>
<td><input type="text" class="u-text" name="regemail" datatype="e" ajaxurl="ajax.php?action=check_email" nullmsg="请输入邮箱！" errormsg="错误的邮箱地址！" /></td>
</tr>
</table>
<br /><center><input name="regsubmit" type="submit" value="提 交" class="u-btn3"/></center>
</form>

<link rel="stylesheet" type="text/css" href="js/validform/style.css" />
<script type="text/javascript" src="js/validform/validform_min.js"></script>
<script type="text/javascript">
$(function(){
$(".register").Validform({
showAllError: true,
tiptype:3
});
})
</script>
