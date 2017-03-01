<!DOCTYPE HTML>
<html>
	<head>
		<title>Register to Techer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><img src="images/banne.jpg" alt="" /></span>
							<?php
								session_start();
								include '../function.php';
								
								/*if(!isset($_POST['user_type'])){$type = $_POST['user_type']; }
								if(!isset($_POST['user_name'])){$name = $_POST['user_name']; }
								if(!isset($_POST['user_password']) && $_POST['user_password'] === $_POST['com_password']){$pw = $_POST['user_password']; }
								if(!isset($_POST['user_email'])){$email = $_POST['user_email']; }
								if(!isset($_POST['phone_number'])){$phone = $_POST['phone_number']; }*/
								$dbhost = 'localhost';
	$dbuser = 'seadmin';
	$dbpass = '19931113';
	$dbname = 'seproject';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)  
		or die("Unable to connect to MySQL");
								$sql = "SELECT count(ID) as num FROM class";
								$retval =  mysql_query( $sql);
								
								if(! $retval ){
									die('Could not get data: ' . mysql_error());
								}	
								while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
									echo $row['num'];
								}
							
							?>
							
				
						</header>
						<!--<footer>
							<ul class="icons">
								<li><a href="#" class="fa-twitter">Twitter</a></li>
								<li><a href="#" class="fa-instagram">Instagram</a></li>
								<li><a href="#" class="fa-facebook">Facebook</a></li>
							</ul>
						</footer>-->
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li><a href="../index.php">Back to Home Page</a></li>
						</ul>
					</footer>

			</div>
		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/respond.min.js"></script><![endif]-->
			<script>
				if ('addEventListener' in window) {
					window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-loading\b/, ''); });
					document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
				}
			</script>
	</body>
</html>