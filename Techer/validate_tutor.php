<html>
<?php 
session_start();
if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
header ("Location: login.php");}
include 'function.php';

$choice =$_POST['val'];
$varField = "status"; 
$varID =$_SESSION['target_id'];

if ($choice === 'Accept'){
	$varValue = "A";
	$msg = "A tutor has been accepted";
	updateInfo($varField, $varValue,$varID);
}else if ($choice === 'Reject'){
	$varValue = "R";
	$msg = "A tutor has been rejected";
	updateInfo($varField, $varValue,$varID);
}
$_SESSION['target_id'] ="";
?>
<head>
		<meta http-equiv="refresh" content="2; url=adminStage.php"/>
		<title>Validation succeed</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/adminStageCss.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
</head>
<body class="is-loading">
<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><img src="images/banne.jpg" alt="" /></span>
							<h1>
							<?php
									echo $msg;
							?>
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
							<li><a href="adminStage.php">Back to Admin Stage</a></li>
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