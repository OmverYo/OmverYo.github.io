var xhr = createRequest();

function booking(dataSource, divID, request)
{
	if(xhr)
	{
		var obj = document.getElementById(divID);
		
		var requestbody ="adminBookingRefNo="+encodeURIComponent(request);
		
 		xhr.open("POST", dataSource, true);
		
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 
				obj.innerHTML = xhr.responseText;
			} // end if
		} // end anonymous call-back function
 		xhr.send(requestbody);
		
	} // end if
} // end function

function assign(dataSource, divID, date)
{
	if(xhr)
	{
		var obj = document.getElementById(divID);
		
		var requestbody ="date="+encodeURIComponent(date);
		
 		xhr.open("POST", dataSource, true);
		
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		
		xhr.onreadystatechange = function()
		{
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 
				obj.innerHTML = xhr.responseText;
			} // end if
		} // end anonymous call-back function
 		xhr.send(requestbody);
		
	} // end if
}