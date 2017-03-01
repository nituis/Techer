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
		<link rel="stylesheet" href="testRate/css/Fr.star.css" />
		<script src="http://lab.subinsb.com/projects/jquery/core/jquery-latest.js"></script>
		<script src="http://lab.subinsb.com/projects/Francium/star/Fr.star.js"></script>
		<!--<script src="testRate/js/rate.js"></script>-->
		<link rel="stylesheet" href="assets/css/rate.css" />
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
		<link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css"/>
		
	</head>
	<body>
	<!-- header -->
		<?php
			if($user_type === 's'){
				get_student_menu($user_id/*$user_name*/);
			}else if ($user_type === 't'){
				get_tutor_menu($_GET['id']);
			}				
			
			$page_type = "v";
			$varTutID = $_GET['id'];
		?>

		
		<!-- Main -->
			<div id="main">
			<!-- about me | cover -->
			<section style="padding: 0;">
				<?php get_tutor_aboutMe($_GET['id']); ?>
			
				
			</section>
		
			
			<section id="viewtutorial" class="two">
				<div class="container">				
				
					<!-- View tutorial -->
				<?php view_tutorialsNumber($_GET['id'])?>
											
				<div class="cont">
				<div class="stars">
			  
			  <h3> Click Stars, Rank Me!</h3>
				<form action="testRate/com_rate.php" method="POST">
					<input class="star star-5" id="star-5-2" type="radio" name="star" value="5"/>
					<label class="star star-5" for="star-5-2"></label>
					
					<input class="star star-4" id="star-4-2" type="radio" name="star"value="4"/>
					<label class="star star-4" for="star-4-2"></label>
					
					<input class="star star-3" id="star-3-2" type="radio" name="star"value="3"/>
					<label class="star star-3" for="star-3-2"></label>
					
					<input class="star star-2" id="star-2-2" type="radio" name="star"value="2"/>
					<label class="star star-2" for="star-2-2"></label>
					
					<input class="star star-1" id="star-1-2" type="radio" name="star"value="1"/>
					<label class="star star-1" for="star-1-2"></label>
					
					<input name="tID" value="<?php echo $varTutID;?>" type="hidden" />
					
					<input type="submit" value="submit"/>
				</form>
			  </div>
			  </div>
			
			<!-- rank calculation -->
				<?php					
			$conn = mysql_connect("localhost", "seadmin", "19931113") or  die("Could not connect: " . mysql_error());  
			mysql_select_db("seproject");
			$sql4 ="SELECT ROUND(AVG(rank),2) , COUNT(rank) AS num
					FROM student_rank_totutor
					WHERE tID ='".$varTutID."'";;
					
			$retval =  mysql_query( $sql4);
			if(! $retval ){
				die('Could not get data: ' . mysql_error());
			}	
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
				$rank = $row['ROUND(AVG(rank),2)'];
				$num = $row['num'];
			}
			echo '
			<div class="cont">
			<h3>Rank '.$rank . ' in ' .$num .' votes </h3>
			</div>';
					?>
			
				</section>
			
			
			<!-- Book a tutorial--->
				<section id="bookTut" class="three">
					<div class="container">
					
						<header>
							<h3>Booking for a tutorial</h3>
						</header>
						
						<form method="POST" action="sendRequest.php">

							<select name="type" >
								<option value="Se">Select Class Type</option>
								<option value="PU">Public</option>
								<option value="PR">Private</option>
							</select>
							
							<br/>
							<select name="group" >
								<option value="Se">Select Group Type</option>
								<option value="SI">one to one tutorial</option>
								<option value="GR">group tutorial</option>
							</select>
							
							<br/>
							<input name="date" type="date"/>
							<input name="time" type="time"/>
							
							<br/>
							<br/>
							<input type="text" name="msg" placeHolder="Leave Message"/>
							
							<br/>
							<input type="hidden" name="tid" value="<?php echo $_GET['id']; ?>"/>
							
							<input type="submit" value="Book"/>
						</form>

						<footer></footer>
						</div>
					</div>
				</section>
				
			<!-- down or top-->

			<!-- Session timeout -->
				<div id="dialog" title="Session Expiration Warning!"></div>
			</div>
			
			<!--End of Main DIV-->
			
				
			
		<!-- Scripts -->
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
			<script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
			<script src="assets/js/jquery.idletimer.js"></script>
			<script>
				jQuery.noConflict();
				(function( $ ) {
					var initialSessionTimeoutMsg = 'You will be logged off in <span id="dialog-countdown"></span> seconds. Do you want to continue your session?';
				
					$("#dialog").html(initialSessionTimeoutMsg);
					$("#dialog").dialog({
						autoOpen: false,
						modal: true,
						minWidth: 500,
						minHeight: 150,
						closeOnEscape: false,
						draggable: false,
						resizable: false,
						open: function() {
							$('body').css('overflow','hidden');
						},
						close: function() { 
							$('body').css('overflow','auto');
						},
						buttons: {
							'Stay Connected': function(){
								$(this).dialog('close');
							},
							'Logout Now': function(){
								window.location = "logout.php";
							}
						}
					});

					var $countdown = $("#dialog-countdown");

					$.idleTimeout('#dialog', 'div.ui-dialog-buttonpane button:first', {
						idleAfter: 1800, //30 minutes
						pollingInterval: 2,
					//keepAliveURL: 'keepAlive.asp',
						serverResponseEquals: 'OK',
						onTimeout: function(){
							window.alert("Your session was timed 	out.");
							window.location = "logout.php";
						},
						onIdle: function(){
							$(this).dialog("open");
						},
						onCountdown: function(counter){
							$countdown.html(counter);
						}
					});
				})(jQuery);
			</script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46156385-1', 'cssscript.com');
  ga('send', 'pageview');

</script>

	</body>
</html>