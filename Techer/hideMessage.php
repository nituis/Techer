<!DOCTYPE HTML>
<html>
	<head>
		<title>Hide Comment succeeded</title>
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
<?php
include 'function.php';

?>
						<span class=""><img src="images/banne.jpg" alt="" /></span>
							<?php $con = mysql_connect("localhost", "seadmin", "19931113") or die("Could not connect: " . mysql_error());  
							mysql_select_db("seproject");

							$sql ="UPDATE comment
								SET visible='no'
								WHERE id='".$_POST['id']."'";
							$retval =  mysql_query( $sql);
							if(! $retval ){
								die('Could not get data: ' . mysql_error());
							}
							echo '<h1>hide successfully!</h1>';
			?>

<body>

</header>

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