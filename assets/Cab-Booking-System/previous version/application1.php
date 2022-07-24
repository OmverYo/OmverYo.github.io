<?php	
	require_once ("../../conf/settings.php");
	
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	$db_select = mysqli_select_db($connection, "kcy0482");
	
	$query = "SELECT BookingRefNo, CustomerName, CustomerPhone, UnitNumber, StreetNumber, 
	StreetName, SuburbName, DsbName, BookingDate, BookingTime, Status
	FROM cabsOnline WHERE Status = 'unassigned'";
	
	$result = @mysqli_query($connection, $query);
	
	$rowsCounter = @mysqli_num_rows($result);
	
	if ($rowsCounter == 0)
	{
		$message = "Search failed!";
	}
	
	else
	{
		$message = 
		"<table border='1' style='text-align:center;'>
		<thead>
		<th>Booking Reference Number</th>
		<th>Customer Name</th>
		<th>Customer Phone</th>
		<th>Unit Number</th>
		<th>StreetNumber</th>
		<th>StreetName</th>
		<th>SuburbName</th>
		<th>DsbName</th>
		<th>BookingDate</th>
		<th>BookingTime</th>
		<th>Status</th>
		</thead>
		<tbody>";
		
		if ($result)
		{
			while($row = mysqli_fetch_array($result))
			{
				$message = $message . "<tr>";
				
				for ($i = 0; $i < 11; $i++)
				{
					$message = $message . "<td style='max-width: 300px; 
					word-wrap: break-word; text-align:center;'>";
					$message = $message . "<p>" . $row[$i] . "</p>";			
				}
				$message = $message . "</td>";	
				$message = $message . "</tr>";
			}
			mysqli_free_result($result);
		}
		mysqli_close($connection);
		
		$message = $message . "</tbody></table>";
	}
	
	echo $message;
?>