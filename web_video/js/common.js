var ifcheck = true;
function check_all(form)
{
	for (var i=0;i<form.elements.length-2;i++)
	{
		var e = form.elements[i];
		if(e.type!='radio') e.checked = ifcheck;
	}
	ifcheck = ifcheck == true ? false : true;
}