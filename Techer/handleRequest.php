<!DOCTYPE HTML>
<html>

<?php
include 'function.php';
	session_start();
	if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
		header ("Location: login.php");
	}
	
	$conn = connect_to_database();
	$sql = "SELECT * FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
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
?>
	<head>
		<title>Handle Request</title>
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
//echo $_POST['date'];
//echo $_POST['time'];
if(isset($_POST['type'])){
	$type = $_POST['type'];}
if(isset($_POST['Time'])){
$dt = $_POST['Time'];}
if(isset($_POST['group'])){
	$group = $_POST['group'];}
if(isset($_POST['name'])){
	$name = $_POST['name'];}
if(isset($_POST['val'])){
	$val = $_POST['val'];}	
if(isset($_POST['Requestid'])){
	$varID = $_POST['Requestid'];}
if(isset($_POST['response'])){
	$varRes = $_POST['response'];}
	$tid = $user_id;
	$sid= $_POST['sid'];
if(!empty($_POST['cname'])){
	$cname = $_POST['cname'];
	if($val === 'Accept'){
	$sql = 'INSERT into class (Name, TeacherID, TeacherName, ClassType, Date, GroupType) values("'.$cname.'","'.$user_id.'","'.get_studentName($user_id).'","'.$type.'","'.$dt.'","'.$group.'")';
	$retval = $conn->query($sql);
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
	
	$highest_id = mysql_result(mysql_query("SELECT MAX(id) FROM class"), 0);
	
	$sql3 = 'INSERT into class_participant (classID, studentID, active) values("'.$highest_id.'","'.$sid.'","'.'Y'.'")';
	$retval = $conn->query($sql3);
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
	
}
$sql2 =	'UPDATE request SET Choice ="'.$val .'" WHERE ID ="'.$varID.'"';
$retval = $conn->query($sql2);
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
	echo '<h1>Request '.$val.'ed</h1>';
$sql4 =	'UPDATE request SET Respond ="'.$varRes .'" WHERE ID ="'.$varID.'"';
$retval = $conn->query($sql4);
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
}	
	else if($val === 'Accept'){echo '<h1>Please enter a class name</h1>';}
	else if($val === 'Reject'){
		echo '<h1>Request rejected</h1>';
		$sql2 =	'UPDATE request SET Choice ="'.$val .'" WHERE ID ="'.$varID.'"';
		$retval = $conn->query($sql2);
			if(! $retval ){
				die('Could not enter data: ' . mysql_error());
			}
	}
	

?>
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
							<li><a href="teacher_portfolio.php">Back to My portfolio</a></li>
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