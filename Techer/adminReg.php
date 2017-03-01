<!DOCTYPE HTML>
<html>
<?php
	session_start();
	if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
	header ("Location: login.php");
	}
	include 'function.php';
?>
	<head>
		<title>Register succeeded</title>
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
			$conn = mysql_connect("localhost", "seadmin", "19931113");  
			mysql_select_db("seproject");
			
			//check
			$c=0;
			if(!empty($_POST['user_type'])&& $_POST['user_type']!='t0'){$type = $_POST['user_type']; $c++; }
			if(!empty($_POST['user_name'])){$name = $_POST['user_name']; $c++;}
			if(!empty($_POST['user_password']) && $_POST['user_password'] === $_POST['com_password'])
				{$pw = $_POST['user_password']; $c++;}
			if(!empty($_POST['user_email'])){$email = $_POST['user_email']; $c++;}
			if(!empty($_POST['phone_number'])){$phone = $_POST['phone_number']; $c++;}
			if(!empty($_POST['user_gender']) &&$_POST['user_gender'] != 'g0'){$gender = $_POST['user_gender'];$c++;}
			
			if($c===6){
			/*** mysql hostname ***/
			$mysql_hostname = 'localhost';

			/*** mysql username ***/
			$mysql_username = 'seadmin';

			/*** mysql password ***/
			$mysql_password = '19931113';

			/*** database name ***/
			$mysql_dbname = 'seproject';
			//prepare
			$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $dbh->prepare("INSERT INTO techer_users (user_name, user_password, user_type , user_gender , user_email , user_phone) VALUES (:user_name, :user_password, :user_type, :user_gender , :user_email ,:user_phone )");
		
			/*** bind the parameters ***/
			$stmt->bindParam(':user_name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':user_password', $pw, PDO::PARAM_STR, 40);
			$stmt->bindParam(':user_type', $type, PDO::PARAM_STR);
			$stmt->bindParam(':user_gender', $gender, PDO::PARAM_STR);
			$stmt->bindParam(':user_email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':user_phone', $phone, PDO::PARAM_STR);
			
			/*** execute the prepared statement ***/
			$stmt->execute();
			//registing
			/*$sql ="INSERT INTO `techer_users` (user_name, user_type, user_phone) VALUES ('".$name."','".$type."','".$phone."')";
			$result =  mysql_query( $sql);
			if(!$result ){
				die('Could not get data: ' . mysql_error());
			}		
			
			mysql_close($conn);*/
			echo '<h1>Register succeeded</h1>';}
			else echo '<h1>Invalid input</h1>';
				?>

<body>

</header>
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li><a href="adminStage.php">Back to AdminStage</a></li>
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