<link rel="stylesheet" type="text/css" href="js/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="js/autocomplete/jquery.autocomplete.js"></script>

<div class="search">
<form method="post" action="search.php">
<div class="sch-left"></div>
<div class="sch-input">
<input type="hidden" name="action" value="search" />
<input type="hidden" name="field" value="subject" />
<input type="hidden" name="cid" value="" />
<input type="hidden" name="nid" value="" />
<input type="hidden" name="orderway" value="postdate" />
<input type="hidden" name="asc" value="DESC" />
<input type="hidden" name="lines" value="10" />
<input type="hidden" name="showtype" value="0" />
<input type="text" name="keyword" maxlength="30" class="search_key" />					
</div>
<input id="search-btn" name="submit" type="submit" value="" class="sch-btn" />
</form>
</div>
<script type="text/javascript">
$('#search-btn').bind('mouseenter mouseleave', function() {
  $(this).toggleClass('on-sch-btn');
});	

$('.search_key').autocomplete({
showHint:false,
limit:20,
source:[{
url:"ajax.php?action=search_auto_complete&keyword=%QUERY%",
type:'remote',
ajax:{
dataType : 'json'
}
}]
});	
</script>