<?php if($action!='show' || $userdb['uid']==$uid) { ?>
<table class="m-box f-w100 f-mt10">
<tr><th colspan="4"><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 个人中心</th></tr>
<tr class="f-tac">
<td><a href="profile.php?action=show&id=<?php echo $uid;?>">个人资料</a></td>
<td><a href="profile.php?action=modify">修改资料</a></td>
<td><a href="profile.php?action=changepass">密码安全</a></td>
<td><a href="profile.php?action=myvideo">我的视频</a></td>
</tr>
</table>
<?php } if($action=='show') { ?>
<table class="m-box f-w100 f-mt10">
<tr><th colspan="2">
<img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 个人资料
</th></tr>
<tr><td class="f-w40"><strong>UID</strong></td><td><?php echo $userdb['uid'];?></td></tr>
<tr><td><strong>用户名</strong></td><td><?php echo $userdb['username'];?></td></tr>
<tr>
<td><strong>系统头衔</strong></td>
<td>
<?php if($userdb['groupid']=='-1') { ?>正式会员<?php } else { ?><?php echo $userdb['grouptitle'];?><?php } if($userdb['groupid']=='4' && $uid==$userdb['uid']) { ?>&nbsp;&nbsp;「<a href="javascript:;" onclick='$.ajax({type:"POST",url:"ajax.php",data:"action=resend_email&yzuid=<?php echo $userdb['uid'];?>", success:function(msg){alert(msg);}});'>重发验证邮件</a>」<?php } ?>
</td>
</tr>
<tr><td><strong>会员头衔</strong></td><td><?php echo $userdb['membertitle'];?></td></tr>
<tr><td><strong>自定义头衔</strong></td><td><?php echo $userdb['honor'];?></td></tr>
<tr><td><strong>最后登录IP</strong></td><td><?php echo $userdb['ip'];?></td></tr>
<tr><td><strong>综合积分</strong></td><td><?php echo $userdb['credit'];?></td></tr>
<tr><td><strong>视频数</strong></td><td><?php echo $userdb['postnum'];?></td></tr>
<tr><td><strong>威望</strong></td><td><?php echo $userdb['rvrc'];?></td></tr>
<tr><td><strong>金钱</strong></td><td><?php echo $userdb['money'];?></td></tr><?php if(is_array($creditdb)) { foreach($creditdb as $key => $value) { if($_creditdb[$key]) { ?>
<tr><td><strong><?php echo $value['0'];?></strong></td><td><?php echo $value['1'];?></td></tr>
<?php } } } ?><tr><td><strong>头像</strong></td><td><img src="<?php echo $userdb['icon'];?>" width="120" height="120" /></td></tr>
<tr>
<td><strong>Email</strong></td>
<td>
<?php if($userdb['publicmail'] == '1') { ?>
<a href="mailto:<?php echo $userdb['email'];?>"><?php echo $userdb['email'];?></a>
<?php } else { ?>
邮箱未公开
<?php } ?>
</td></tr>
<tr><td><strong>腾讯QQ</strong></td><td><?php echo $userdb['oicq'];?></td></tr>
<tr><td><strong>Msn</strong></td><td><?php echo $userdb['msn'];?></td></tr>
<tr><td><strong>性别</strong></td><td><?php echo !$userdb['gender'] ? '保密' : ($userdb['gender'] == '1' ? '帅哥' : '靓女'); ?></td></tr>
<tr><td><strong>生日</strong></td><td><?php echo $userdb['bday'];?></td></tr>
<tr><td><strong>个人主页</strong></td><td><a href="<?php echo $userdb['site'];?>" target="_blank"><?php echo $userdb['site'];?></a></td></tr>
<tr><td><strong>签名</strong></td><td><?php echo $userdb['signature'];?></td></tr>
<tr><td><strong>注册时间</strong></td><td><?php echo $userdb['regdate'];?></td></tr>
<tr><td><strong>最后登录</strong></td><td><?php echo $userdb['lastlogin'];?></td></tr>
</table>
<?php } elseif($action=='modify') { ?>
<form action="profile.php" method="post" onSubmit="return procheck(this)" name="creator" enctype="multipart/form-data">
<input type="hidden" name="action" value="modify" />
<input type="hidden" value="2" name="step" />
<table class="m-box f-w100 f-mt10">

<tr><th colspan="2"><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 修改资料</th></tr>
<tr>
<td class="f-w40"><strong>系统风格</strong></td>
<td><select name="userstyle"><?php echo $styles;?></select></td>
</tr>

<tr>
<td><strong>选择您的头像</strong></td>
<td>
<img src="<?php echo $iconpath;?>" name="useravatars" width="120" height="120"/>
<select name="proicon" onChange="showimage('<?php echo $imgpath;?>',this.options[this.selectedIndex].value)">
<option value="none.gif">none.gif</option>
<?php echo $imgselect;?>
</select>
<br />
<?php if($delicon=='1') { ?>
<a href="profile.php?action=delicon">[删除自定义头像]</a>
<?php } if($gp_allowseticon=='1') { ?>
<br />
头像位置 <input type="text" class="u-text" name="iconurl" value="<?php echo $iconurl;?>" /> 必须以 http://开头的路径。 
<?php if($db_iconupload=='1' && $gp_allowupicon=='1') { ?>
<br />
头像上传 <input type=file name="upicon" class="u-text" />
<?php } } ?>
</td>
</tr>	

<tr>
<td><strong>性别</strong></td>
<td>
<select name="progender">
<option value="1" <?php echo $gender_1;?>>帅哥</option>
<option value="2" <?php echo $gender_2;?>>靓女</option>
<option value="0" <?php echo $gender_0;?>>保密</option>
</select>
</td>
</tr>

<tr>
<td><strong>生日</strong></td>
<td>
<select name="proyear">
<option value=""></option><?php for($i=1960;$i<=2008;$i++){ ?><option value="<?php echo $i;?>" <?php echo $year[$i];?>><?php echo $i;?></option><?php } ?></select>年 
<select name="promonth">
<option value=""></option><?php for($i=1;$i<=12;$i++){ ?><option value="<?php echo $i;?>" <?php echo $month[$i];?>><?php echo $i;?></option><?php } ?></select>月 
<select name="proday">
<option value=""></option><?php for($i=1;$i<=31;$i++){ ?><option value="<?php echo $i;?>" <?php echo $day[$i];?>><?php echo $i;?></option>  <?php } ?></select>日
</td>
</tr>

<?php if($gp_allowhonor=='1') { ?>
<tr>
<td><strong>自定义头衔</strong></td>
<td><input type="text" class="u-text" name="prohonor" value="<?php echo $user['honor'];?>"/></td>
</tr>
<?php } ?>

<tr>
<td><strong>腾讯QQ</strong></td>
<td><input type="text" class="u-text" name="prooicq" value="<?php echo $user['oicq'];?>"/></td>
</tr>

<tr>
<td><strong>MSN</strong></td>
<td><input type="text" class="u-text" name="promsn" value="<?php echo $user['msn'];?>"/></td>
</tr>

<tr>
<td><strong>个人主页</strong></td>
<td><input type="text" class="u-text" name="prosite" value="<?php echo $user['site'];?>"/></td>
</tr>

<tr>
<td><strong>个性签名</strong><br /><?php echo $rg_regmaxsign;?>字节以内</td>
<td><textarea name="prosign" cols="50" rows="5"><?php echo $user['signature'];?></textarea></td>
</tr>

<tr>
<td><strong>是否公开邮箱</strong></td>
<td>			
<input type=radio value="1" name="propublicmail" <?php echo $publicmail_1;?>> 公开 
<input type=radio value="0" name="propublicmail" <?php echo $publicmail_0;?>> 隐藏
</td>
</tr>

<tr>
<td><strong>是否接收系统邮件</strong></td>
<td>
<input type=radio value="1" name="proreceivemail" <?php echo $receivemail_1;?>> 接收邮件 
<input type=radio value="2" name="proreceivemail" <?php echo $receivemail_2;?>> 不接收邮件
</td>
</tr>
</table>
<br /><center><input type="submit" name="prosubmit" value="提 交" class="u-btn1"/></center>
</form>
<?php } elseif($action=='changepass') { ?>
<form action="profile.php" method="post">
<input type="hidden" name="action" value="changepass" />
<input type="hidden" value="2" name="step" />
<table class="m-box f-w100 f-mt10">
<tr><th colspan="2"><img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 修改资料</th></tr>
<tr>
<td class="f-w40"><strong>原密码</strong></td>
<td><input type="password" name="oldpwd" value="" class="u-text" /></td>
</tr>
<tr>
<td><strong>新密码</strong><br />不修改请留空</td>
<td><input type="password" name="propwd" value="" class="u-text" /></td>
</tr>
<tr>
<td><strong>确认密码</strong></td>
<td><input type="password" name="check_pwd" value="" class="u-text" /></td>
</tr>
<tr>
<td><strong>E-Mail</strong><br />不修改请留空</td>
<td><input type="text" name="proemail" class="u-text" /></td>
</tr>
</table>
<br /><center><input type="submit" name="prosubmit" value="提 交" class="u-btn1"/></center>
</form>
<?php } elseif($action=='myvideo') { ?>
<table class="m-box f-w100 f-mt10">
<tr><th colspan="8">
<span class="f-fr f-fs12 f-defaultcolor f-fwn"><a href="profile.php?action=myvideo&type=post">已发布</a> | <a href="profile.php?action=myvideo&type=favorite">已收藏</a></span>
<img src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/dticon1.gif" align="absmiddle"> <a href="<?php echo $db_bfn;?>"><?php echo $db_wwwname;?></a> &raquo; 我的视频 &raquo; <?php if($type=='post') { ?>已发布<?php } elseif($type=='favorite') { ?>已收藏<?php } ?>
</th></tr>

<?php if($type=='post') { ?>
<tr class="f-fwb f-tac">
<td width="8%">ID</td>
<td width="*">标题</td>
<td width="10%">状态</td>
<td width="15%">更新时间</td>
<td width="5%">人气</td>
<td width="5%">评论</td>
<td width="10%">审核</td>
<td width="15%">操作</td>
</tr><?php if(is_array($videolist)) { foreach($videolist as $value) { ?><tr class="f-tac">
<td><?php echo $value['vid'];?></td>
<td><a href="read.php?vid=<?php echo $value['vid'];?>" target="_blank"><?php echo $value['subject'];?></a></td>
<td>
<?php if($value['serialise'] > 0) { ?>
连载至<?php echo $value['serialise'];?>
<?php } else { ?>
完结
<?php } ?>			
</td>
<td><?php echo $value['lastdate'];?></td>
<td><?php echo $value['hits'];?></td>
<td><?php echo $value['reply'];?></td>
<td>
<?php if($value['yz'] == 1) { ?>
<span style="color: green;">通过</span>
<?php } else { ?>
<span style="color: red;">未审核</span>
<?php } ?>
</td>
<td>
<a href="read.php?vid=<?php echo $value['vid'];?>" target="_blank">浏览</a>
<?php if($SYSTEM['allowadminedit']== '1' || $gp_alloweditatc == 1) { ?>
<a href="post.php?action=modify&vid=<?php echo $value['vid'];?>">编辑</a>
<?php } if($SYSTEM['allowadmindel'] == '1' || $gp_allowdelatc == '1') { ?>
<a href="post.php?action=del&vid=<?php echo $value['vid'];?>">删除</a>
<?php } ?>
</td>
</tr><?php } } } else { ?>
<tr class="f-fwb f-tac">
<td width="8%">ID</td>
<td width="*">标题</td>
<td width="10%">状态</td>
<td width="15%">会员</td>
<td width="15%">更新时间</td>
<td width="5%">人气</td>
<td width="5%">评论</td>
<td width="15%">操作</td>
</tr><?php if(is_array($videolist)) { foreach($videolist as $value) { ?><tr class="f-tac">
<td><?php echo $value['vid'];?></td>
<td><a href="read.php?vid=<?php echo $value['vid'];?>" target="_blank"><?php echo $value['subject'];?></a></td>
<td>
<?php if($value['serialise'] > 0) { ?>
连载至<?php echo $value['serialise'];?>
<?php } else { ?>
完结
<?php } ?>
<td><a href="profile.php?action=show&id=<?php echo $value['authorid'];?>" target="_blank"><?php echo $value['author'];?></a></td>
<td><?php echo $value['lastdate'];?></td>
<td><?php echo $value['hits'];?></td>
<td><?php echo $value['reply'];?></td>
<td>
<a href="read.php?vid=<?php echo $value['vid'];?>" target="_blank">浏览</a>
<a href="profile.php?action=remove&type=<?php echo $type;?>&vid=<?php echo $value['vid'];?>">移除</a>
</td>
</tr><?php } } } ?>
</table>
<div class="u-pages"><?php pv_page($pages); ?></div>

<?php } ?>

<script type="text/javascript">
function procheck(formct)
{
if (formct.prosign.value.length > <?php echo $rg_regmaxsign;?>)
{
alert('个性签名太长，请在<?php echo $rg_regmaxsign;?>字节以内');
return false;
}
}
function showimage(imgpath,value)
{
if(value!= '')
document.images.useravatars.src = imgpath+'/face/'+value;
else
document.images.useravatars.src = imgpath+'/face/none.gif';
}
</script>
