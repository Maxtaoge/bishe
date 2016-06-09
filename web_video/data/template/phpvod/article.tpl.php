<div class="g-full f-mt10 f-fl">

<div class="g-main f-fl">
<div class="m-box f-mb10">
<div class="title">文档内容</div>
<div class="content m-article">
<h3><?php echo $article['subject'];?></h3>
<span class="artinfo">
<span>发布人：<a href="profile?uid=<?php echo $article['authorid'];?>" target="_blank"><?php echo $article['author'];?></a></span> &nbsp;&nbsp;&nbsp;
<span>发布时间：<?php echo get_date($article['timestamp']); ?></span> &nbsp;&nbsp;&nbsp;
<span>点击数：<?php echo $article['hits'];?></span>
</span>
<span class="article_content">
<?php echo $article['content'];?>
</span>					
</div>	
</div>
</div>

<div class="g-side f-fr">
<div class="m-box">
<div class="title">栏目列表</div>
<div class="content">
<ul class="m-artclass">
<li><a href="arthome.php">文档首页</a></li><?php if(is_array($_artclass)) { foreach($_artclass as $classid => $classname) { ?><li><a href="artlist.php?classid=<?php echo $classid;?>"><?php echo $classname;?></a></li><?php } } ?></ul>				
</div>			
</div>		
</div>

</div>