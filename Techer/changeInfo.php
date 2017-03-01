
<!DOCTYPE HTML>
<html>
<style>
.s {}
</style>

<?php
	session_start();
	if (!(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')) {
	header ("Location: login.php");
	}
	include 'function.php';
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
		<title>Setting</title>
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
				<form action="updateSucceed.php" method="POST">
				<table>
				<tbody>
				<!--<tr>
				<td class="s">User ID</td>
				<td><?php echo $user_id?></td>
				</tr>-->
				<tr>
				<td class="s">User Name</td>
				<td>
				<?php echo $user_name?>
				</td>
				</tr>
				<tr>
				<td valign="top" class="s">Password</td>
				<td>
				<input type="password" id="pw" name="pw" placeholder="New password"/>
<!--*-->		<input type="password" id="pw2" name="pw2" placeholder="Re-enter new passwod"/>
				</td>
				</tr>
				<tr>
				<td class="s">User Type</td>
				<td><?php if ($user_type === 's')
										echo 'Student';
									else if($user_type === 't')
										echo 'Tutor'?></td>

				</tr>
				<!--<td class="s">Gender</td>
				<td>
				<select name="gender">
						<option value=""><?php if($user_gender ==='F'){echo '--Female--';}
												else echo '--Male--';?></option>
						<option value="F">Female</option>
						<option value="M">Male</option>
					</select>
				</td>
				</tr>-->
				<tr>
				<td class="s">Email Address</td>
				<td>
				<input type="text" name="email" placeholder="<?php echo $user_email?>"/>
				</td>

				</tr>
				<tr>
				<td class="s">Phone Number</td>
				<td><input type="text" name="phone" placeholder="<?php echo $user_phone?>"/></td>

				</tr>
				<tr>
				<td class="s">Education Background</td>
				<td><select name="edu_bg">
						<option value=""><?php echo '--'.$user_educationBackground.'--';?></option>
						<option value="degree">Bachelor degree</option>
						<option value="master">Master</option>
						<option value="doctor">Doctor</option>
						<option value="doctor">Others</option>
					</select></td>
				</tr>
				<tr>
				<td class="s">Registration Date</td>
				<td><?php echo $user_regDay ?></td>

				</tr>
				</tbody>
				</table>

				<input type="submit" value="Confirm Changes">
				</form>


				</header>
			</section>

				<!-- Footer -->
					<footer id="footer" >
						<ul class="copyright">
							<?php 
								if ($user_type == 's')
									echo '<li ><a href="student_portfolio.php">Back to My portfolio</a></li>';
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