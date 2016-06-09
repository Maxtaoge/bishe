<?php $css_config = array();
$css_config_file = PHPVOD_ROOT . $imgpath . '/'. $stylepath . '/css.config.php';
if(file_exists($css_config_file))
{
$css_config = include_once $css_config_file;
} if(is_array($css_config) && !empty($css_config)) { ?>
<style type="text/css">
.u-stylebox{width:7px;height:7px;display:block;float:left;overflow:hidden;margin-right:5px;margin-top:9px;}
</style><?php if(is_array($css_config)) { foreach($css_config as $key => $value) { ?><a href="javascript:;" onclick="javascript:setcss('<?php echo $imgpath;?>/<?php echo $stylepath;?>/<?php echo $value['cssfile'];?>');" title="<?php echo $key;?>" style="background-color:<?php echo $value['color'];?>;" class="u-stylebox"></a><?php } } } ?>
