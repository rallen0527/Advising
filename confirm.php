<?php
	session_start();
	?>

<!-- Author: Russell Allen CMSC 331 -->

<!doctype html>

<html>
<head>
	<title>CSEE Advising</title>
	<link rel="stylesheet" type="text/css" href="theme.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
</head>
<body>
	<div id="pageWrapper">
		<div id = "header">

			<div id="umbcLogo">
				<a href="http://www.umbc.edu" alt="UMBC.edu">
					<img src="umbc.png" alt="UMBC.edu">
				</a>
			</div> <!--End of umbcLogo -->
			<div id = "title">
				<h2 id="csee"><strong>CSEE</strong></h2>
				<h2 id="advising"><strong>Advising</strong></h2>
			</div> <!--End of title -->
			<div id = "links">
				<a href = "http://www.umbc.edu">UMBC.edu</a>
				<a href = "http://www.csee.umbc.edu/">CSEE Home</a>
				<a href = "http://my.umbc.edu/">myUMBC</a>
			</div><!-- End of Links -->
		</div> <!--End of header -->
			
			<br><br><br>
	<?php

		include('CommonMethods.php');
		$COMMON = new COMMON(false);
		//variables
		$advisorID = $_SESSION['advID'];
		$date = $_SESSION['date'];
		$value = $_POST['slot'];

		//retrieved timeslot
		$sql = "SELECT time FROM Timeslots WHERE timeslot_ID = '$value'";
		$rs = $COMMON -> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_array($rs);
		$time = $row[0];

		//Gets advisor info
		$query = "SELECT * FROM Advisors WHERE advisor_ID = '" . $_SESSION['advID'] . "'";
		$rt = $COMMON -> executeQuery($query, $_SERVER["SCRIPT_NAME"]);
		$row1 = mysql_fetch_array($rt);
		
		//retrieves appt info at time and date, if any, and finds the insertion point for new student_ID
		$getInsertionPoint = "SELECT * FROM Appointment WHERE apptDate = CAST('$date' AS DATE) AND timeslot_ID = $value";
		$iP = $COMMON -> executeQuery($getInsertionPoint, $_SERVER["SCRIPT_NAME"]);
		$iPArray =  mysql_fetch_array($iP);
		
		$check = "student_ID1";
		if($iPArray[0] != null) { 
			foreach ($iPArray as $key=>$val) {
				if ($val == null) {
					$check = "student_ID".strval($key);
					break;
				}
			}
		}
			
		$insert = "INSERT INTO Appointment (advisor_ID, " . $check . ", apptDate, type, timeslot_ID) 
		VALUES ('". $_SESSION['advID'] . "', '" . $_SESSION['stuID'] . "', '"
			. $date . "', 'G' , " . $value . ")";
		if($newAppt = $COMMON -> executeQuery($insert, $_SERVER["SCRIPT_NAME"])) {
			echo "New Appointment Created <br>";
		}
		
		//Hey! You set an appointment	
		echo "You have an appointment with " . $row1[1] . " " . $row1[2] . " at " . $time . " on " . $date;		

		
		
	?>
	</div><!-- End of pageWrapper -->
</body>


</html>