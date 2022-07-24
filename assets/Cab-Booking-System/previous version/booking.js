var xhr = createRequest();

function bookingFunction(dataSource, divID, cname, phone, unumber, snumber,
stname, sbname, dsbname, date, time)
{
	if(xhr)
	{
		var obj = document.getElementById(divID);
		
		var requestbody =
		"&cname="+encodeURIComponent(cname)+
		"&phone="+encodeURIComponent(phone)+
		"&unumber="+encodeURIComponent(unumber)+
		"&snumber="+encodeURIComponent(snumber)+
		"&stname="+encodeURIComponent(stname)+
		"&sbname="+encodeURIComponent(sbname)+
		"&dsbname="+encodeURIComponent(dsbname)
		"&date="+encodeURIComponent(date)+
		"&time="+encodeURIComponent(time);
 		xhr.open("POST", dataSource, true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
			{
				obj.innerHTML = xhr.responseText;
			}
		}
 		xhr.send(requestbody);
	}
}