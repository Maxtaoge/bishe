	<div class="f-cb"></div>
</div>
<div class="g-ft">
<div class="m-footer" align="center"><?php $adcode = ad('footer'); if($adcode!='') { ?><div class="u-adfooter f-mt10"><?php echo $adcode;?></div><?php } ?>	
<hr />
<a href="<?php echo $db_ceoconnect;?>" target="_blank">关于<?php echo $db_wwwname;?></a> ┆ <a href="mailto:<?php echo $db_ceoemail;?>">联系我们</a><?php if($db_statcode) { ?> ┆ <?php echo $db_statcode;?><?php } ?> <br />
<?php echo $db_copyright;?><br />
<div><?php echo $db_icp;?></div>
GMT<?php if($db_timedf>=0) { ?>+<?php echo $db_timedf;?><?php } ?>, Processed in <?php echo $runtime;?> second(s), <?php echo $db->query_num; ?> queries<?php if($db_obstart=='1') { ?>, Gzip enabled <?php } ?>
</div>
</div>
</body>
</html>
