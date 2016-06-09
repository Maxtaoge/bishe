<?php include gettpl('panel_flash'); $adcode = ad('nav'); if($adcode!='') { ?><div class="u-adnav f-mt10"><?php echo $adcode;?></div><?php } ?>

<div class="g-full f-mt10 f-fl">
<div class="g-main f-fr">

<div class="m-box">
<div class="title">视频检索</div>
<div class="content m-classfilter">
<p>
<label>类别: </label> <?php $cdb = pv_loop('class',"cid=$cup"); if(is_array($cdb)) { foreach($cdb as $c) { ?><a href="javascript:;" onclick='javascript:window.location.href="class.php?cid=<?php echo $c['cid'];?><?php echo $nidurl;?><?php echo $yearurl;?><?php echo $orderurl;?>";return false;'<?php echo $sel['cid'][$c['cid']];?>><?php echo $c['caption'];?></a><?php } } ?></p>				
<p>
<label>地区: </label>
<a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $yearurl;?><?php echo $orderurl;?>";return false;'<?php echo $sel['nid']['all'];?>>全部</a><?php if(is_array($_nation)) { foreach($_nation as $k => $n) { ?><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?>&nid=<?php echo $k;?><?php echo $yearurl;?><?php echo $orderurl;?>";return false;'<?php echo $sel['nid'][$k];?>><?php echo $n;?></a><?php } } ?></p>				
<p>
<label>时间: </label>
<a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?><?php echo $orderurl;?>";return false;'<?php echo $sel['year']['all'];?>>全部</a><?php for($i=$db_yearend;$i>=$db_yearstart;$i--) {if($db_yearend-$i>=10) break; ?><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?>&year=<?php echo $i;?><?php echo $orderurl;?>";return false;'<?php echo $sel['year'][$i];?>><?php echo $i;?></a><?php } ?><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?>&year=b<?php echo $i;?><?php echo $orderurl;?>";return false;'<?php echo $sel['year']['b'.$i];?>>更早</a>
</p>				
<p>
<label>排序: </label>
<a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?><?php echo $yearurl;?>&order=postdate";return false;'<?php echo $sel['order']['postdate'];?>>发布时间</a><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?><?php echo $yearurl;?>&order=lastdate";return false;'<?php echo $sel['order']['lastdate'];?>>最后更新</a><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?><?php echo $yearurl;?>&order=hits";return false;'<?php echo $sel['order']['hits'];?>>人气</a><a href="javascript:;" onclick='javascript:window.location.href="class.php<?php echo $cidurl;?><?php echo $nidurl;?><?php echo $yearurl;?>&order=reply";return false;'<?php echo $sel['order']['reply'];?>>评论</a>
</p>				
</div>
</div>

<div class="m-box g-main f-mt10">
<div class="title">
<span class="f-fr f-fs12"><?php $c1db = pv_loop('class',"cid=$cid"); if(is_array($c1db)) { foreach($c1db as $c1) { ?>&nbsp;&nbsp;<a href="class.php?cid=<?php echo $c1['cid'];?>"><?php echo $c1['caption'];?></a><?php } } ?></span>
<?php echo $_class[$cid]['caption'];?>				
</div>
<div class="content"><?php $videodb = pv_loop('video',"$tagstr|showsub=1|order=$orderway $orderasc,v.vid DESC|limit=$db_perpage|page=$page|url=$url|sync=1"); ?><ul class="m-list3"><?php if(is_array($videodb)) { foreach($videodb as $video) { ?><li>
<a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>"/></a>
<h2><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></h2>
<p>主演: <?php echo $video['playactor'];?></p>
<p>地区: <?php echo $video['nation_name'];?></p>
<p>时间: <?php echo get_date($video['postdate'], 'Y-m-d'); ?></p>
<p>会员: <a href="profile.php?action=show&id=<?php echo $video['authorid'];?>" target="_blank"><?php echo $video['author'];?></a></p>
<p>人气: <?php echo $video['hits'];?></p>
<p>评论: <?php echo $video['reply'];?></p>
</li><?php } } ?></ul>				
</div>		
</div>
<div class="u-pages"><span class="f-stylecolor">提示：可使用键盘方向键←→翻页</span> &nbsp;&nbsp;&nbsp;&nbsp; <?php pv_page($pageinfo); ?></div>
<!-- 键盘翻页 -->
<script type="text/javascript"><?php $page_down = !empty($pageinfo['page_down']) ? $pageinfo['page_down'] : 1; $page_up = !empty($pageinfo['page_up']) ? $pageinfo['page_up'] : 1; $nextpage = pv_url('class.php' . $cidurl . $nidurl . $yearurl . $orderurl . '&page=' . $page_down); $prevpage = pv_url('class.php' . $cidurl . $nidurl . $yearurl . $orderurl . '&page=' . $page_up); ?>$(document).keyup(function(event){
if(event.keyCode=='37') window.location.href="<?php echo $prevpage;?>";
if(event.keyCode=='39') window.location.href="<?php echo $nextpage;?>";
});			
</script>
</div>
<div class="g-side f-fl">
<div class="m-box">
<div class="title">本类排行 </div>
<div class="content">
<ul class="m-list2-1"><?php $i=1; $videodb = pv_loop('video',"cid=$cid|showsub=1|order=hits DESC,v.vid DESC|limit=10"); if(is_array($videodb)) { foreach($videodb as $video) { if($i==1) { ?>
<li class="l1">
<a class="imgbg1" href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>"/><span class="num1">1</span></a>
<p class="subject"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></p>
<p>类别: <?php echo $video['class_name'];?></p>
<p>地区: <?php echo $video['nation_name'];?></p>
<p>热度: <?php echo $video['hits'];?></p>
<p>更新日期: <?php echo get_date($video['lastdate'], 'Y-m-d'); ?></p>							
</li>					
<?php } else { ?>
<li>
<span class="f-fr"><?php echo $video['hits'];?></span>
<i><?php echo $i;?></i>
<span class="sj"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></span>
</li>					
<?php } $i++; } } ?></ul>				
</div>			
</div><?php $videodb = pv_loop('video',"cid=$cid|best=2|showsub=1|order=lastdate DESC,postdate DESC,v.vid DESC|limit=3"); if(!empty($videodb)) { ?>
<div class="m-box f-mt10">
<div class="title">本类推荐</div>
<div class="content">
<ul class="m-list2-1"><?php if(is_array($videodb)) { foreach($videodb as $key => $video) { ?><li class="l1<?php if($key>0) { ?> f-mt10<?php } ?>">
<a class="imgbg1" href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><img src="<?php echo $video['picurl'];?>" alt="<?php echo $video['subject'];?>"/></a>
<p class="subject"><a href="read.php?vid=<?php echo $video['vid'];?>" title="<?php echo $video['subject'];?>"><?php echo $video['subject'];?></a></p>
<p>类别: <?php echo $video['class_name'];?></p>
<p>地区: <?php echo $video['nation_name'];?></p>
<p>热度: <?php echo $video['hits'];?></p>
<p>更新日期: <?php echo get_date($video['lastdate'], 'Y-m-d'); ?></p>							
</li><?php } } ?></ul>			
</div>
</div>
<?php } ?>
</div>

</div>
