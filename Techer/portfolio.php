<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<?php
session_start();
if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
header ("Location: login.php");
}
include 'function.php';
				$sql = "SELECT user_id, user_name, user_type, user_gender, user_email, user_phone, user_educationBackground, registrationDate, icon,cover FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
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
					$user_icon = $row["icon"];
					$user_cover = $row["cover"];
					$user_regDay = $row["registrationDate"];

				}
?>
	<head>
		<title><?php echo $user_name ?>'s Portfolio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main_o_cm.css" />
		<link rel="stylesheet" href="assets/css/main_teacher.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header">

				<div class="top">
					<!-- Back to Home -->
						<div id="bk2hm">
							<!-- back to home page -->
							<a href="index.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home icon2"></span></a>
							<!-- Log out -->
							<a href="logout.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-sign-out iconOut">Log Out</span></a>
							<br>
							
						</div>

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48 circle_image"><img src="<?php echo $user_cion?>" alt="" /></span>
							<a href="#">
                            	<h1 id="title"><a href="changeInfo.php"><?php echo $user_name?></a></h1>
								<p>Maths Teacher</p>
                            </a>
						</div>

					<!-- Nav -->
						<nav id="nav">

							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon  fa-users">My Students</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Materials</span></a></li>
								
							</ul>
						</nav>

				</div>

				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<!--
                            <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							-->
                            <li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>

				</div>

			</div>

		<!-- Main -->
			<div id="main" style="margin-bottom: 300px;">
				<div style="width:100%; height: 300px">
					<a href="#" class="image featured" style="width:100%; height: 300px;">
					<img src="<?php echo $user_cover?>" alt="" style="width:100%"/></a>
				</div>
				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">
							<header>
								<h2 style="width:100%; background-color: #C0C0C0">About Me</h2>
							</header>

							
							
						</div>
					</section>
                
                
                <!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
                            	<h2> Students </h2>
								
								
                                <div class="row">
                                    <?php loop_class_inTable_tutor($user_id)?>
                                       
                                </div>
							</header>

							<hr/>
							
							<footer>
	                            <h2> Students Requests </h2>
								<!--
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
								-->
								<div>
                                	<img src="images/shot05.png" />
                                </div>
                                <div>
                                	<img src="images/shot05.png" />
                                </div>
							
							</footer>

						</div>
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>Materials</h2>
							</header>

							
							<table id="t01">
								  <tr>
									<th>File Name</th>
									<th>File Type</th>		
									<th>Description</th>
									<th>Categories</th>
									<th>Update</th>		
									<th>Accibility</th>
								  </tr>
								  <tr>
									<td>math_T01</td>
									<td>mp4</td>		
									<td>F.1 Maths lesson 1</td>
									<td>F1, Maths</td>
									<td>2015/10/09</td>		
									<td>Public</td>
								  </tr>
								  <tr>
									<td>eng_L01</td>
									<td>mp4</td>		
									<td>general english</td>
									<td>english</td>
									<td>2015/10/10</td>		
									<td>Student</td>
								  </tr>
								  
						  </table>
							
							<footer>
								<a href="uploadMaterial.php" class="button scrolly">Upload Materials</a>
							</footer>
						</div>
					</section>

									
				<!-- Contact -->

			</div>

		<!-- Footer -->

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>