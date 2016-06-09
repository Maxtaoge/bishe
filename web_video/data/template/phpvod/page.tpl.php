<?php if(!empty($pageinfo)) { ?>
<a href="<?php echo $pageinfo['url'];?>page=<?php echo $pageinfo['page_first'];?>">首页</a>&nbsp;&nbsp;
<a href="<?php echo $pageinfo['url'];?>page=<?php echo $pageinfo['page_up'];?>">上一页</a>&nbsp;&nbsp;<?php for($i=$pageinfo['page_current']-3;$i<$pageinfo['page_current'];$i++) { if($i<1) continue; ?><a href="<?php echo $pageinfo['url'];?>page=<?php echo $i;?>"><?php echo $i;?></a>&nbsp;&nbsp;<?php } ?><strong><?php echo $pageinfo['page_current'];?></strong>&nbsp;&nbsp;

<?php if($pageinfo['page_current']<$pageinfo['page_end']) { $flag=0; for($i=$pageinfo['page_current']+1;$i<=$pageinfo['page_end'];$i++) { ?><a href="<?php echo $pageinfo['url'];?>page=<?php echo $i;?>"><?php echo $i;?></a>&nbsp;&nbsp;<?php $flag++; if($flag==4) break; } } ?>

<a href="<?php echo $pageinfo['url'];?>page=<?php echo $pageinfo['page_down'];?>">下一页</a>&nbsp;&nbsp;
<input type="text" size="2" style="height: 16px; border:1px solid #698CC3" onkeydown="javascript: if(event.keyCode==13){location='<?php echo $pageinfo['url'];?>page='+this.value;return false;}">&nbsp;<a href="<?php echo $pageinfo['url'];?>page=<?php echo $pageinfo['page_end'];?>">尾页</a>&nbsp;Pages: ( <?php echo $pageinfo['page_current'];?>/<?php echo $pageinfo['page_end'];?> total )
<?php } ?>