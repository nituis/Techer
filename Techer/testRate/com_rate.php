<!DOCTYPE HTML>
<html>
<?php
	session_start();
	if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
	header ("Location: login.php");
	}
	include '../function.php';
?>
	<head>
		<title>Rating succeeded</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-loading">

		<!-- Wrapper -->
		<div id="wrapper">

		<!-- Main -->
		<section id="main">
			<header>

			<span class=""><img src="../images/banne.jpg" alt="" /></span>
			<?php 
			$c=0;
			$conn = mysql_connect("localhost", "seadmin", "19931113") or  
			die("Could not connect: " . mysql_error());  
			mysql_select_db("seproject");
			//checking
			$sql = "SELECT * FROM student_rank_totutor 
					WHERE sID=" .$_SESSION['user_id'];
			$retval =  mysql_query( $sql);
			if(!$retval ){
				die('Could not get data: ' . mysql_error());
			}	
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
				if ($row['tID'] ===$_POST['tID']){$c++;}
			}
			
			//rating
			if($c ===0){
			$sql ="INSERT INTO student_rank_totutor (sID, tID, rank) VALUES (".$_SESSION['user_id'].",".$_POST['tID'].",".$_POST['star'].")";
			$result =  mysql_query( $sql);
			if(! $result ){
				die('Could not get data: ' . mysql_error());
			}	
			mysql_close($conn);
			echo '<h1>Rating succeeded</h1>';}
			else {
				echo '<h1>You can only rate the same tutor once!</h1>';
			}
				?>

<body>

</header>
						
					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li><a href="../student_portfolio.php">Back my portfolio</a></li>
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