
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login Techer</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<?php
include('login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
header("location: ../student_portfolio.php");
}
?>
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><img src="images/banne.jpg" alt="" /></span>
							<h1>Welcome to Techer </h1>
							<form action="" method="post">
                                <label>UserName :</label>
                                <input id="name" name="username" placeholder="username" type="text">
                                <label>Password :</label>
                                <input id="password" name="password" placeholder="**********" type="password">
                                </br>
                                <input name="submit" type="submit" value=" Login ">
                                </br>
                                <span><?php echo $error; ?></span>
                            </form>
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
							<li><a href="#">Register</a></li>
							<li><a href="#">Forget your password?</a></li>
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