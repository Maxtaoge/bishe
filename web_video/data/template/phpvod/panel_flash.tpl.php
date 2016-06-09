<?php $picarray = unserialize($db_setshowpic); if($db_showpic==1 && !empty($picarray)) { ?>
<script src="js/jquery.KinSlideshow.js" type="text/javascript"></script>
<script type="text/javascript">
var moveStyle
var rand =parseInt(Math.random()*4)
switch(rand){
case 0:	moveStyle="left" ;break;
case 1:	moveStyle="right" ;break;
case 2:	moveStyle="down" ;break;
case 3:	moveStyle="up" ;break;
}
$(function(){
$("#show").KinSlideshow({moveStyle:moveStyle,mouseEvent:"mouseover"});	
})
</script>
<div class="m-jsshow" id="show"><?php if(is_array($picarray)) { foreach($picarray as $k => $picstr) { $showpic = explode('|', $picstr); ?>    <a href="<?php echo $showpic['1'];?>" target="_blank"><img src="<?php echo $imgpath;?>/show/<?php echo $showpic['0'];?>" alt="<?php echo $showpic['2'];?>" id="showpic<?php echo $k;?>" /></a><?php } } ?></div>
<?php } ?>