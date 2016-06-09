<div class="g-full f-mt10 f-fl">

<div class="g-main f-fl">
<div class="m-box f-mb10">
<div class="title"><?php echo $_artclass[$classid];?></div>
<div class="content f-p10">
<ul class="m-artlist"><?php $articledb = pv_loop('article',"classid=$classid|limit=20|page=$page|url=artlist.php?classid=$classid&|cachetime=60s|sync=1"); if(is_array($articledb)) { foreach($articledb as $article) { ?><li>
<span class="arttime"><?php echo get_date($article['timestamp']); ?></span>
<span class="artsubject"><a href="article.php?aid=<?php echo $article['aid'];?>"><?php echo $article['subject'];?></a></span>
</li><?php } } ?></ul>	
</div>	
</div>
<div class="u-pages"><?php pv_page($pageinfo); ?></div>
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
