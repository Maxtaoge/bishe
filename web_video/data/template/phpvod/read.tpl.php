<script type="text/javascript" src="js/score/score.js"></script>
<script type="text/javascript">
$("#score_show").ready(function(){
score_show(<?php echo $video['vid'];?>,<?php echo $video['star'];?>);
});
</script>

<div class="m-navpath">当前位置: <?php echo $navpath;?></div><?php $adcode = ad('nav'); if($adcode!='') { ?><div class="u-adnav f-mt10"><?php echo $adcode;?></div><?php } ?>

<div class="g-full f-mt10 f-fl">
<div class="g-main f-fl">
<div class="m-box">
<div class="title">
<span class="f-fr f-defaultcolor f-fs12">
<a href="javascript:;" onclick='$.ajax({type:"POST",url:"ajax.php",data:"action=add_favorite&vid=<?php echo $video['vid'];?>", success:function(msg){alert(msg);}});'>收藏</a>
&nbsp; <a href="report.php?vid=<?php echo $vid;?>">举报</a>
<?php if($editvideo=='1') { ?>
&nbsp; <a href="post.php?action=modify&vid=<?php echo $video['vid'];?>">编辑</a>
<?php } if($delvideo=='1') { ?>
&nbsp; <a href="post.php?action=del&vid=<?php echo $video['vid'];?>" onclick="return window.confirm('您确定要删除视频 <?php echo $video['subject'];?> 吗？');">删除</a>
<?php } ?>					
</span>
视频详细信息
</div>
<div class="content m-videodd">

<div class="videopic"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>" /></div>
<div class="videoinfo">

<div id="score_show"></div> <!-- 评分 -->
<h2><?php echo $video['subject'];?></h2>
<p class="line"><?php echo $video['class_name'];?> <span class="f-gray">(栏目)</span> &nbsp; <?php echo $video['nation_name'];?> <span class="f-gray">(地区)</span> &nbsp; <?php echo $video['serialise']>0 ? '连载至第'.$video['serialise'].'集' : '完结'; ?> <span class="f-gray">(状态)</span> &nbsp; <?php echo $video['author'];?> <span class="f-gray">(会员)</span></p>
<p>演员: <?php echo $video['playactor_link'];?></p>
<p>导演: <?php echo $video['director_link'];?></p>
<p>标签: <?php echo $video['tag_link'];?></p>
<p>年代: <?php echo $video['year'];?></p>
<p>评分: <?php echo $video['star'];?> (<?php echo $video['usernth'];?>人参与评分)</p>
<p>人气: <?php echo $video['hits'];?></p>
<p>发布时间: <?php echo get_date($video['postdate'], 'Y-m-d H:i'); ?> &nbsp; 更新时间: <?php echo get_date($video['lastdate'], 'Y-m-d H:i'); ?></p>
<p>备注: <?php echo $video['memo'];?></p>					
</div>

<div class="videointro">
<div class="caption">视频简介</div>
<div class="content"><?php echo $video['synopsis'];?></div>
</div><?php if(is_array($urldb)) { foreach($urldb as $playgroup => $msg) { ?><div class="videourls">
<div class="caption"><span class="f-fr"><?php echo $msg['player'];?></span>播放组<?php echo $msg['playgroup'];?></div>
<div class="content"><?php if(is_array($msg['urls'])) { foreach($msg['urls'] as $key => $v) { ?><a href="play.php?vid=<?php echo $video['vid'];?>&playgroup=<?php echo $msg['playgroup'];?>&index=<?php echo $key;?>" target="_blank" title="<?php echo $v['caption'];?>"><?php echo $v['caption'];?></a><?php } } ?><div class="f-cb"></div>							
</div>
</div><?php } } if($db_reply=='1') { include gettpl('panel_reply'); } ?>															

</div>		
</div>
</div>
<div class="g-side f-fr">
<div class="m-box">
<div class="title">栏目排行 </div>
<div class="content">
<ul class="m-list2-1"><?php $i=1; $videodb = pv_loop('video',"cid=$video[cid]|showsub=1|order=hits DESC|limit=10"); if(is_array($videodb)) { foreach($videodb as $video) { if($i==1) { ?>
<li class="l1">
<a class="imgbg1" href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>"/><span class="num1">1</span></a>
<p class="subject"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></p>
<p>类别: <?php echo $video['class_name'];?></p>
<p>地区: <?php echo $video['nation_name'];?></p>
<p>热度: <?php echo $video['hits'];?></p>
<p>更新日期: <?php echo get_date($video['lastdate'], 'Y-m-d H:i'); ?></p>							
</li>					
<?php } else { ?>
<li>
<span class="f-fr"><?php echo $video['hits'];?></span>
<i><?php echo $i;?></i>
<span class="sj"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></span>
</li>					
<?php } $i++; } } ?></ul>				
</div>			
</div><?php $videodb = pv_loop('video',"cid=$video[cid]|best=2|showsub=1|order=lastdate DESC,postdate DESC|limit=3"); if(!empty($videodb)) { ?>
<div class="m-box f-mt10">
<div class="title">栏目推荐</div>
<div class="content">
<ul class="m-list2-1"><?php if(is_array($videodb)) { foreach($videodb as $key => $video) { ?><li class="l1<?php if($key>0) { ?> f-mt10<?php } ?>">
<a class="imgbg1" href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>"/></a>
<p class="subject"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></p>
<p>类别: <?php echo $video['class_name'];?></p>
<p>地区: <?php echo $video['nation_name'];?></p>
<p>热度: <?php echo $video['hits'];?></p>
<p>更新日期: <?php echo get_date($video['lastdate'], 'Y-m-d H:i'); ?></p>							
</li><?php } } ?></ul>			
</div>
</div>
<?php } ?>		
</div>
</div>
