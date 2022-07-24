<?php
	// Connection to the database
	require_once ("../../conf/settings.php");
	
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	$db_select = mysqli_select_db($connection, "kcy0482");
	
	$query = "SELECT BookingRefNo FROM cabsOnline";
	
	$result = mysqli_query($connection, $query);
	
	// Creates a cabsOnline TABLE if it does not exist
	if (empty($result))
	{
		$tableCreate = "CREATE TABLE cabsOnline
		(
		BookingRefNo INT(10) NOT NULL,
		CustomerName VARCHAR(30) NOT NULL,
		CustomerPhone INT(12) NOT NULL,
		UnitNumber INT(10),
		StreetNumber INT(10) NOT NULL,
		StreetName VARCHAR(30) NOT NULL,
		SuburbName VARCHAR(30),
		DsbName VARCHAR(30),
		BookingDate DATE NOT NULL,
		BookingTime TIME NOT NULL,
		Status VARCHAR(10) NOT NULL,
		PRIMARY KEY(BookingRefNo)
		)";
		
		// An announcement message to let the user know the table is created
		if ($tableCreate)
		{
			echo "<p>CabsOnline Table has been successfuly created</p>";
		}
	}
	
	$message = "";
	
	$cname = $_POST["cname"];
	$phone = $_POST["phone"];
	$unumber = $_POST["unumber"];
	$snumber = $_POST["snumber"];
	$stname = $_POST["stname"];
	$sbname = $_POST["sbname"];
	$dsbname = $_POST["dsbname"];
	$date = $_POST["date"];
	$time = $_POST["time"];
	$status = "unassigned";
	
	// It checks if the customer's name is valid and contains alphabets only
	if (isset($_POST["cname"]) && preg_match('/[a-zA-Z]/', $_POST["cname"]))
	{
		$message = $message . "Valid Customer Name" . "<br>";
	}
	
	// It checks if the phone number is at least 10 numbers long and 12 numbers long
	if (isset($_POST["phone"]) && preg_match('/[0-9]/', $_POST["phone"]) || strlen($_POST["phone"]) <= 10 && strlen($_POST["phone"]) >= 12 )
	{
		$message = $message . "Valid Phone Number" . "<br>";
	}
	
	// It checks if the unit number is valid and contains numbers only
	if (isset($_POST["unumber"]) && preg_match('/[0-9]/', $_POST["unumber"]))
	{
		$message = $message . "Valid Unit Number" . "<br>";
	}
	
	// It checks if the street number is valid and contains numbers only
	if (isset($_POST["snumber"]) && preg_match('/[0-9]/', $_POST["snumber"]))
	{
		$message = $message . "Valid Street Number" . "<br>";
	}
	
	// It checks if the street name is valid and contains alphabets only
	if (isset($_POST["stname"]) && preg_match('/[a-zA-Z]/', $_POST["stname"]))
	{
		$message = $message . "Valid Street Name" . "<br>";
	}
	
	// It checks if the suburb is valid and contains alphabets only
	if (isset($_POST["sbname"]) && preg_match('/[a-zA-Z]/', $_POST["sbname"]))
	{
		$message = $message . "Valid Suburb" . "<br>";
	}
	
	// It checks if the destination suburb is valid and contains alphabets only
	if (isset($_POST["dsbname"]) && preg_match('/[a-zA-Z]/', $_POST["dsbname"]))
	{
		$message = $message . "Valid Destination Suburb" . "<br>";
	}
	
	// It checks if the date provided is valid
	if (isset($_POST["date"]))
	{
		$message = $message . "Valid Date" . "<br>";
	}
	
	// It checks if the time provided is valid
	if (isset($_POST["time"]))
	{
		$message = $message . "Valid Time" . "<br>";
	}
	
	if ($connection)
	{
		echo $message . "<br>";
		
		// Creates random booking reference number
		$bookingRefNo = rand(1, 500);
		
		$query = "SELECT * FROM cabsOnline WHERE BookingRefNo = '$bookingRefNo'";
		
		$queryCheck = @mysqli_query($connection, $query);
		
		if (!$queryCheck)
		{
			echo "<p>Database connection and query failure</p>";
		}
		
		$rowsCounter = @mysqli_num_rows($queryCheck);
		
		// Checks if booking number Exists
		while ($rowsCounter > 0)
		{
			$bookingRefNo = rand(1, 500);
			
			$queryCheck = @mysqli_query($connection, $query);
			
			if (!$queryCheck)
			{
				echo "<p>Database connection and query failure</p>";
			}
			
			$rowsCounter = @mysqli_num_rows($queryCheck);
		}
		
		// Inserts every data into database
		$query = "INSERT INTO cabsOnline(BookingRefNo, CustomerName, CustomerPhone, UnitNumber,
		StreetNumber, StreetName, SuburbName, DsbName, BookingDate, BookingTime, Status) 
		VALUES ('$bookingRefNo', '$cname', '$phone', '$unumber', '$snumber', '$stname', '$sbname',
		'$dsbname', '$date', '$time', '$status')";
		
		$queryCheck = @mysqli_query($connection, $query);
		
		if (!$queryCheck)
		{
			echo "<p>Database connection and query failure</p>";
		}
		
		mysqli_close($connection);
		
		$message = "Thanks! Your booking number is $bookingRefNo.
		<br> You will be picked up in front of your provided address at $time on $date.";
		
		echo $message;
	}
?>