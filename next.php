<?php
	session_start();
	?>
<!-- Author: Russell Allen CMSC 331 -->
<!-- For school project -->

<!doctype html>
<html>

<head>
	<!-- Stuff for DatePicker -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script>
	  $(function() {
	  	$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd"});
	  });
	  </script>

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
		$firstName = $_POST["firstname"];
		$lastName = $_POST["lastname"];
		$major = $_POST["major"];
		$_SESSION['stuID'] = $_POST["stuID"];
		$stuID = $_POST["stuID"];

		//check for student in DB then Display if found/Did not set up verification
		$sql = "SELECT * FROM Student WHERE student_ID = '$stuID'";
		$rs = $COMMON -> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
					
		$row = mysql_fetch_array($rs);
		echo $row[0] . " " . $row[1] . " " . $row[3];

?>

	<form action="sked.php" method="post">
		<input type="radio" name="type" value="individual">Individual
		<input type="radio" name="type" value="group" checked="checked">Group <br>
		Advisor:<select name="advisor">
			<option value="1">Abrams</option>
			<option value="2">Arey</option>
			<option value="3">Stephens</option>
			</select>
			<br>
		Date:<input type="text" id="datepicker" name="date"><br>
		<input type="submit" value="Submit">


</div> <!--End of pageWrapper -->
</body>
</html>