<?php
	require_once ("../../conf/settings.php");
	
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	$db_select = mysqli_select_db($connection, "kcy0482");
	
	$message = "";
	
	$adminBookingRefNo = $_POST["adminBookingRefNo"];
	
	$query = "SELECT * FROM cabsOnline WHERE BookingRefNo = '$adminBookingRefNo'";
	
	$queryCheck = @mysqli_query($connection, $query);
	
	if (!$queryCheck)
	{
		echo "<p>Database connection and query failure</p>";
	}
	
	$rowsCounter = @mysqli_num_rows($queryCheck);
	
	if ($rowsCounter > 0)
	{
		$query = "SELECT * FROM cabsOnline WHERE BookingRefNo = '$adminBookingRefNo' AND Status = 'assigned'";
		
		$queryCheck = @mysqli_query($connection, $query);
		
		if (!$queryCheck)
		{
			echo "<p>Database connection and query failure</p>";
		}
		
		$rowsCounter = @mysqli_num_rows($queryCheck);
		
		if ($rowsCounter > 0)
		{
			$message = "The application has already been assigned.";
		}
		
		else
		{
			$query = "UPDATE cabsOnline SET Status = 'assigned' WHERE BookingRefNo = $adminBookingRefNo";
			
			$queryCheck = @mysqli_query($connection, $query);
			
			if (!$queryCheck)
			{
				echo "<p>Database connection and query failure</p>";
			}
			
			$message = "The application for booking $adminBookingRefNo has been assigned.";
		}
	}
	
	else
	{
		$message = "Wrong Booking Reference Number, please try again with correct number.";
	}
	
	echo $message;
?>