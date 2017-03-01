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
	$conn = connect_to_database();
	$_SESSION['target_id'] = $_POST['idss'];
	
	$sql = "SELECT user_id, user_name, user_type, user_gender, user_id_card, user_email, user_phone, user_educationBackground, registrationDate FROM techer_users WHERE user_id ='" . $_SESSION['target_id'] . "'";
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
		die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		$user_id = $row["user_id"];
		//$user_id_card = $row["user_id_card"];
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
		<title>Registration Details</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/adminStageCss.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	
	<body>

		<!-- Header -->
		<?php get_admin_menu($user_id); ?>

		<!-- Main -->
			<div id="main">

				<!-- Details of registration --> 
					<section id="RegDetails" class="one dark ">
						<div class="container">

							<header>
								<h3>Details of Registration Requests </h2>
							</header>
                            <!--
                            ID Card copy:
                            <br>							
                            <img src="Registration/ID_uploads/
							< ?php echo $user_id_card ?>">
                            <br>-->
				
							<table id="t02">
								<tbody>
								
									<tr>
									<td>User Name</td>
									<td><?php echo $user_name?></td>
									</tr>
							
									<tr>
									<td>User Type</td>
									<td><?php if ($user_type === 's')
															echo 'Student';
														else if($user_type === 't')
															echo 'Tutor'?></td>
									</tr>
									
									<tr>
									<td>Email Address</td>
									<td><?php echo $user_email?></td>
									</tr>
									
									<tr>
									<td>Phone Number</td>
									<td><?php echo $user_phone ?></td>
									</tr>
									
									<tr>
									<td>Education Background</td>
									<td><?php echo $user_educationBackground ?></td>
									</tr>
									
									<tr>
									<td>Registration Date</td>
									<td><?php echo $user_regDay ?></td>
									</tr>


								</tbody>
							</table>
							
                            <footer>
                                <form method='POST' action='validate_tutor.php'>
									<INPUT TYPE="submit" name="val" value="Accept" class="accept"/>
                                    <INPUT TYPE="submit" name="val" value="Reject " class="reject"/>						
                                </form>
                            </footer>
							
						</div>
					</section>

				

								
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