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

		//variables -  some were converted from Session for ease of typing
		$type = $_POST['type'];
		$advisor_ID = $_POST['advisor'];
		$_SESSION['advID'] = $_POST['advisor'];
		$date = $_POST['date'];
		$_SESSION['date'] = $_POST['date'];

		//	If individual, checked for all open slots for date
		//	If group, checked for open slots and all group appts with less than 10 attendees.
		if ($type == "individual") {
			$sql = "SELECT timeslot_ID FROM Timeslots WHERE timeslot_ID NOT IN (SELECT timeslot_ID from Appointment WHERE apptDate = CAST('$date' AS DATE) AND advisor_ID = $advisor_ID)";
			$rs = $COMMON -> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		} else {
			$sql = "SELECT timeslot_ID FROM Timeslots WHERE timeslot_ID NOT IN (SELECT timeslot_ID from 
				Appointment WHERE apptDate = CAST('$date' AS DATE) AND advisor_ID = $advisor_ID AND (type='I' OR student_ID10 IS NOT NULL))";
			$rs = $COMMON -> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

		}

		//	displayed available times with radio buttons
		while($row = mysql_fetch_array($rs)) {
			$sql = "SELECT time FROM Timeslots WHERE timeslot_ID=$row[0]";
			$rt = $COMMON -> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			echo "<form action='confirm.php'method='post'>";
			while($tile=mysql_fetch_array($rt)) {
				echo "<input type='radio' name='slot' value='$row[0]'>";
				echo $tile[0];
				echo "<br>";
			}				
		}
		echo "<input type='submit' value='submit'>";
		echo "</form>";

		
	?>
	</div><!-- End of pageWrapper -->

</body>

</html>