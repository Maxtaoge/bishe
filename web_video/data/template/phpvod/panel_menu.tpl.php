<link rel="stylesheet" type="text/css" href="<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/ddlevelsmenu-topbar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/ddlevelsmenu-sidebar.css" />
<script type="text/javascript" src="<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/ddlevelsmenu.js"></script><?php $mainarray = array();
$subarray = array();
include PHPVOD_ROOT . 'data/cache/class.php';

function class2array($class) //栏目转换为数组格式
{
global $groupid;
$sub = array();
foreach($class as $c)
{
if(!empty($c['fathers']))
{
if(($c['type'] != 'hidden' || strpos($c['allowvisit'], ",$groupid,") !== false))
{
$s = str_replace(',', '][', $c['fathers']);
$s = '[' . $s . ']' . '[' . $c['cid'] . ']';
$e = '$sub' . $s . ' = NULL;';
eval($e);
}					
}
}
return $sub;
}	

function loopclass($arr,$class) //递归
{
foreach($arr as $k => $v)
{
echo '<li><a href="class.php?cid='. $class[$k]['cid'] .'">' . $class[$k]['caption'] . '</a>';
if(is_array($v))
{
echo '<ul>';
loopclass($v,$class);
echo '</ul>';
}
echo '</li>';							
}				
} ?><div id="ddtopmenubar" class="mattblackmenu">
<ul>
<li><a href="<?php echo $db_bfn;?>">首页</a></li><?php $cdb = pv_loop('class',"cid=0"); if(is_array($cdb)) { foreach($cdb as $c) { ?><li><a href="category.php?cid=<?php echo $c['cid'];?>" rel="submenu<?php echo $c['cid'];?>"><?php echo $c['caption'];?></a></li><?php $mainarray[]=$c['cid']; } } if(is_array($hackdb['2'])) { foreach($hackdb['2'] as $h) { ?><li><a href="hack.php?hackname=<?php echo $h['directory'];?>"><?php echo $h['name'];?></a></li><?php } } ?></ul>
</div>

<script type="text/javascript">
ddlevelsmenu.arrowpointers.downarrow = ["<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/arrow-down.gif", 11,7];
ddlevelsmenu.arrowpointers.rightarrow = ["<?php echo $imgpath;?>/<?php echo $stylepath;?>/ddlevelsfiles/arrow-right.gif", 12,12];
ddlevelsmenu.arrowpointers.showarrow = {toplevel: true, sublevel: true};	
ddlevelsmenu.setup("ddtopmenubar", "topbar");
</script><?php $subarray=class2array($_class); if(is_array($subarray)) { foreach($subarray as $k => $v) { if(!in_array($k, $mainarray)) continue; ?><ul id="submenu<?php echo $k;?>" class="ddsubmenustyle"><?php loopclass($v,$_class); ?></ul><?php } } ?>