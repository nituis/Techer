<!DOCTYPE HTML>
<html>
<?php
function connect_to_database(){
	$dbhost = 'localhost';
	$dbuser = 'seadmin';
	$dbpass = '19931113';
	$dbname = 'seproject';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
		or die("Unable to connect to MySQL");
	return $conn;
}

function updateInfo($varField, $varValue,$varID){
	$conn = connect_to_database();
	$sql = "UPDATE `techer_users` SET `" .$varField ."`='".
				$varValue . "' WHERE `user_id` = '". $varID."';";
				 
		$retval = $conn->query($sql);
		//mysql_select_db('seproject');
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
}
?>
<?php
	session_start();
	if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
	header ("Location: login.php");
	}
	/*
	$conn = connect_to_database();
	$sql = "SELECT user_id, user_name, user_type, user_gender, user_email, user_phone, user_educationBackground, registrationDate FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
		die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		$user_id = $row["user_id"];
		$user_name = $row["user_name"];
		$user_type = $row["user_type"];
		$user_gender = $row["user_gender"];
		$user_email = $row["user_email"];
		$user_phone = $row["user_phone"];
		$user_educationBackground = $row["user_educationBackground"];
		$user_regDay = $row["registrationDate"];
	}
	*/
?>
	<head>
		<title>Update succeeded</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">
	<?php
	$varCount = 0;
	$user_type = $_SESSION['user_type'];
		$user_id = $_SESSION['user_id'];
		$message = "Please enter correct information";
	//if (isset($_POST['email']) || isset($_POST['phone'])
		//|| isset($_POST['edu_bg']) || (isset($_POST['pw']) && isset($_POST['pw2']))){
		//$varName  = $_POST["name"];
		$varEmail = $_POST["email"];
		$varPhone = $_POST["phone"];
		//$varGender= $_POST["gender"];
		$varEdu_bg= $_POST["edu_bg"];
		$varPw = $_POST["pw"];  //*
		$varPw2 = $_POST["pw2"];  //*		
		
		$pwIsMatched = true;
		$pwIsAccepted = true;
		
		if (!empty($varPw) && !empty($varPw2)){  //*
			if (strlen($varPw) > 20 || strlen($varPw) < 4){
				$pwIsAccepted = false;
			} else {
				if ($varPw == $varPw2){
					$varPw = sha1( $varPw );
					updateInfo("user_password", $varPw, $user_id);
					$varCount +=1;
				}
				else $pwIsMatched = false;
			}
		}	
		
		/*if (!empty($varName) && $pwIsMatched){
			updateInfo("user_name",$varName, $user_id);
			$varCount +=1;
		}
		if (!empty($varGender) && $pwIsMatched){
			updateInfo("user_gender",$varGender, $user_id);
			$varCount +=1;
		}*/
		if (!empty($varEmail) && $pwIsMatched){
			updateInfo("user_email",$varEmail, $user_id);
			$varCount +=1;
		}
		if (!empty($varPhone) && $pwIsMatched){
			updateInfo("user_phone",$varPhone, $user_id);
			$varCount +=1;
		}
		if (!empty($varEdu_bg) && $pwIsMatched){
			updateInfo("user_educationBackground",$varEdu_bg, $user_id);
			$varCount +=1;
		}
	?>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><img src="images/banne.jpg" alt="" /></span>
							<h1>
							<?php
							if (!$pwIsAccepted) {
								$message = 'Incorrect Length for Password (4-20)';
							} else if($varCount > 0 && $pwIsMatched){
								$message = 'Your information has been updated successfully';
							} else
								$message = 'Passwords do not match or no new information input';
							echo $message; ?>
							
							</h1>

<body>
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
							<li><a href="changeInfo.php">Back to Setting</a></li>
							<?php 
								if ($user_type == 's')
									echo '<li><a href="student_portfolio.php">Back to My portfolio</a></li>';
								else
									echo '<li><a href="teacher_portfolio.php">Back to My portfolio</a></li>';
							?>
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