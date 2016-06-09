function MM(selObj)
{
	i = selObj.options[selObj.selectedIndex].value;

	if(i=='7')
		document.getElementById('url_replace').selectedIndex=0;

	change_sel(i);
}

function change_sel(Flag)
{
	switch (Flag)
	{
		case '0' :
			document.getElementById('page0').style.display='';
			document.getElementById('page1').style.display='none';
			document.getElementById('page2').style.display='none';
			break;
		case '1' :
			document.getElementById('page0').style.display='none';
			document.getElementById('page1').style.display='';
			document.getElementById('page2').style.display='none';		
			break;
		case '2' :
			document.getElementById('page0').style.display='none';
			document.getElementById('page1').style.display='none';
			document.getElementById('page2').style.display='';
			break;

		case '3' :
			document.getElementById('page3').style.display='';
			document.getElementById('page4').style.display='none';
			break;
		case '4' :
			document.getElementById('page3').style.display='none';
			document.getElementById('page4').style.display='';
			break;

		case '5' :
			document.getElementById('page5').style.display='';
			document.getElementById('page6').style.display='none';
			break;
		case '6' :
			document.getElementById('page5').style.display='none';
			document.getElementById('page6').style.display='';
			break;

		case '7' :
			document.getElementById('page7').style.display='none';
			document.getElementById('page8').style.display='none';
			document.getElementById('page9').style.display='none';
			break;

		case '8' :
			document.getElementById('page7').style.display='';
			document.getElementById('page8').style.display='';
			document.getElementById('page9').style.display='none';
			break;

		case '9' :
			document.getElementById('page9').style.display='none';
			break;

		case '10' :
			document.getElementById('page9').style.display='';
			break;
	
	}
}