<!DOCTYPE HTML>
<html>
	<head>
		<title>Result</title>
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
							<span class=""><a href="../index.php"><img src="images/banne.jpg" alt="" /></a></span>
							<h1>
							<?php
							session_start();
							
							echo $_SESSION['result'];
							?></h1>
							
							<?php
							if ($_SESSION['result'] == "Submit Succeeded" &&
							    $_SESSION['previousPagePath'] == "teacher_portfolio.php#ads"){
									echo $_SESSION['previousPagePath'];
								echo '<script>
									var makePaymentNow = false;
									if (confirm("Would you like to make the payment now?") == true) {
										window.location.assign("/Techer/payment.php");
									} else {
										window.location.assign("/Techer/'. $_SESSION['previousPagePath']. '");
									}
									</script>';
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
							<li><a href=<?php echo $_SESSION['previousPagePath']; ?>><?php echo $_SESSION['previousPage']; ?></a></li>
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