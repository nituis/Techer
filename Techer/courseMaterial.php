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
?>
	<head>
		<title><?php echo $user_name ?>'s Portfolio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main_o_cm.css" />
		<link rel="stylesheet" href="assets/css/main_student.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		
		<!--MAP-->
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script>
			var map;
			var myCenter=new google.maps.LatLng(22.316144,114.1781523);

			function initialize()
			{
			var mapProp = {
			  center:myCenter,
			  zoom:15,
			  mapTypeId:google.maps.MapTypeId.ROADMAP
			  };
			  map = new google.maps.Map(document.getElementById("slide-4"),mapProp);
			var marker=new google.maps.Marker({
			  position:myCenter,
			  });

			marker.setMap(map);
			  google.maps.event.addListener(map, 'click', function(event) {
				placeMarker(event.latLng);
			  });

			}

			function placeMarker(location) {
			  var marker = new google.maps.Marker({
				position: location,myCenter,
				map: map,
				icon:'images/s04.png'
			  });


			}

			google.maps.event.addDomListener(window, 'load', initialize);
		</script>	
	</head>
	<body style="background-color: #e6e6e6;">
		<!--header-->
		<?php get_student_menu($user_id);?>
		
		<!-- Main -->
			<div id="main">

                <!-- Classes Material -->
					<section id="courseMaterial" class="">
						<div class="container">

							<header>
                            	<h2 style="color:black;"> Tutorials : 
								<?php echo $_GET['id'];?>
								</h2>								
							</header>
															
							<div class="row" style="margin-left: 2px;">
								<?php loop_material_inTable($_GET['id']) ?>
							</div>
							
						</div>
					</section>

			</div>


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