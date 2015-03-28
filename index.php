<?php
	session_start();
	?>

<!-- Author: Russell Allen CMSC 331 -->

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
			<h2 id="instructions">Enter your information to get started</h2>
		<div id="forms" align="center">
		<form action="next.php" method="post">
			First Name:<input type="text" name="firstname"><br>
			Last Name:<input type="text" name="lastname"><br>
			Student ID:<input type="text" name="stuID"><br>
			<span id="major">Major:<input type="text" name="major"></span><br>
			
			<span id="submit"><input type="submit" value="Submit"></span>
		</form>
		</div> <!-- End of forms -->

		<?php
			$debug = false;
			include('CommonMethods.php');
			$COMMON = new Common($debug);

		?>
	</div> <!--End of pageWrapper -->

</body>
	
</html>