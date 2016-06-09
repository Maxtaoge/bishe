<div class="m-navpath">当前位置: <?php echo $navpath;?></div><?php $adcode = ad('nav'); if($adcode!='') { ?><div class="u-adnav f-mt10"><?php echo $adcode;?></div><?php } ?>
<div class="g-full f-mt10">
<div class="m-box">
<div class="title"><?php echo $video['subject'];?> - <?php echo $urlcaption;?></div>
<div class="content f-tac f-p5"><?php $adcode = ad('play',1); ?><!-- 播放器左侧广告 190*550-->
<?php if($adcode!='') { ?><div class="f-fl u-adplayside"><?php echo $adcode;?></div><?php } $adcode = ad('play',2); ?><!-- 播放器右侧广告 190*550-->
<?php if($adcode!='') { ?><div class="f-fr u-adplayside"><?php echo $adcode;?></div><?php } ?>
<div class="m-play"><?php echo $player;?></div>
</div>	
</div><?php if(is_array($urldb)) { foreach($urldb as $pg => $msg) { ?><div class="m-box f-mt10">
<div class="title"><span class="f-fr"><?php echo $msg['player'];?></span>播放组<?php echo $msg['playgroup'];?></div>
<div class="content m-playlist"><?php if(is_array($msg['urls'])) { foreach($msg['urls'] as $key => $value) { ?><a href="play.php?vid=<?php echo $msg['vid'];?>&playgroup=<?php echo $msg['playgroup'];?>&index=<?php echo $key;?>" title="<?php echo $value['caption'];?>" <?php if($msg['playgroup']==$playgroup && $key==$index) { ?>class="sel"<?php } ?>><?php echo $value['caption'];?></a><?php } } ?><div class="f-cb"></div>							
</div>
</div><?php } } $adcode = ad('play',3); if($adcode!='') { ?><div class="u-adplay f-mt15"><?php echo $adcode;?></div><?php } ?>	
</div>