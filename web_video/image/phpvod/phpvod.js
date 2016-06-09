function setstyle(stylename)
{
    $.cookie('pv_userstyle', stylename, {expires: 365});
	window.location.reload();
}

function setcss(csspath)
{
	$.cookie('pv_usercss', csspath, {expires: 365});
	$("#csslink").attr('href', csspath);
}

function tab(group,count,index)
{
	for(i=1;i<=count;i++)
	{
		if(i==index)
		{
			$('#a'+group+'_'+i).addClass('sel');
			$('#c'+group+'_'+i).show();			
		}
		else
		{
			$('#a'+group+'_'+i).removeClass('sel');
			$('#c'+group+'_'+i).hide();
		}		
	}
}