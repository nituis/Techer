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
	
	/*$sql = "SELECT user_id, user_name, user_type, user_gender, user_email, user_phone, user_educationBackground, registrationDate FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
	*/
	$sql = "SELECT * FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
		
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
		die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		/*$user_id = $row["user_id"];
		$user_name = $row["user_name"];
		$user_type = $row["user_type"];
		$user_gender = $row["user_gender"];
		$user_email = $row["user_email"];
		$user_phone = $row["user_phone"];
		$user_educationBackground = $row["user_educationBackground"];
		$user_regDay = $row["registrationDate"];
		*/
		
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
		<link rel="stylesheet" href="assets/css/main_student.css" />
		<link rel="stylesheet" href="map_student.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<style>
		
		</style>
		<!--MAP-->
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script src="map.js"></script>
	</head>
	
	<body onload="sorter.size(5)">
	<!-- Header -->
		<?php get_student_menu($user_id);?>

		<!-- Main -->
			<div id="main">
									
				<!-- About Me | cover -->
					
					<section id="about" class="dark" style="padding: 0;">
						<?php get_tutor_aboutMe($user_id); ?>
					</section>
                
                
                <!-- Tutorials (top) | slide 1-->
					<section id="top" class="one">
						<div class="container">
							<header>
								<h2 style="color:black;">My Tutorials </h2>
							</header>
                            								
							<div class="classlist">
								<!--<div class="4u 13u$(mobile)">-->
								<?php loop_class_inTable($_SESSION['user_id'])?>
								<!-- </div>	-->
							</div>

						</div>
					</section>
					
				<!--request response | slide 2-->
					<section id="req" class="two" >
						<div class="container">
							<header>
								<h2 style="color:black;"> Request Reply </h2>
							</header>
                            								
							<div class="classlist">
								<!--<div class="4u 13u$(mobile)">-->
									<?php get_notification($user_id);?>
								<!-- </div>	-->
							</div>							
						

						</div>
					</section>
					
				<!-- find teacher (Map) | slide 3-->
					<section id="portfolio" class="three" >
						<div class="container">
							
							<!-- === Map === -->
															
								<!--<div class="slide story" data-slide="4" id="slide-4" style="height:450px;"></div>
								
								</div>-->

								<?php get_map_student(); ?>
									
						</div>
					</section>
					
					<!-- Search Tutors | slide 4--> 
					<section id="searchtut" class="four">
						<div class="container">

							<h2 style="color: black;">Search Teacher
							</h2>
						
						<!-- searcj text box-->
						<div class="searchbox">
							<script>
								function showUser() {
									var str = document.getElementById('search').value;

									$.ajax({
										type: 'GET',
										url: 'showTutor.php',		
										data: 'str=' +str,
										cache: false,
		
										success:function(response){
											$('#searchResult').html(response);
											
										},
										error:function(){
											$('#searchResult').html = ('Error');
										}
									});
								};
							</script>
								
							<form id="searchUser" method='GET'>
								<input autocomplete='off' class='search' type='search' id='search' name='search' placeholder='SEARCH HERE' data-col='all' oninput='showUser()'/>
							</form>
						
						</div>
												
						<p class="noti">Tutor info will be listed here. Click the name to view details</p>
							
						<div id='searchResult' class="sortable">
							<table  id="t02" >
							<thead>
								<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Education Background</th>
								</tr>
							</thead>
							
							<tbody>
							
							<?php
							$sql = "SELECT * FROM techer_users where user_type = 't' ";
							$con = mysql_connect("localhost", "seadmin", "19931113") or  
								die("Could not connect: " . mysql_error());  
							mysql_select_db("seproject");
							$retval =  mysql_query( $sql);
							if(! $retval ){
								die('Could not get data: ' . mysql_error());
							}
							
							while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
								echo '<tr><td>' .$row['user_id']. '</a></td>' ;
								echo '<td><a href="viewTutor.php?id='.$row['user_id'] . '">' .$row['user_name']. '</a></td>';
								echo '<td>' .$row['user_gender']. '</td>';
								echo '<td>' .$row['user_email']. '</td>';
								echo '<td>' .$row['user_phone']. '</td>';
								echo '<td>' .$row['user_educationBackground']. '</td>';
								
							}
							?>
							</tbody>
							</table>
						</div>
							
						<!-- pager -->
						
						<div id="controls">
							<div id="perpage">
								<select onchange="sorter.size(this.value)">
									<option value="5">5</option>
									<option value="10">10</option>
									<option value="20">20</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select>
								<span>Entries Per Page</span>
							</div>
							
							<div id="navigation">
								<img src="images/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
								
								<img src="images/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
								
								<img src="images/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
								
								<img src="images/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
							</div>
							<div id="text">Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span></div>
						</div>
						</div>

					</section>
		<!-- Session timeout -->
		<div id="dialog" title="Session Expiration Warning!"></div>


		<!-- Footer -->

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
			<script src="assets/js/jquery.tablesorter.js"></script>
			<script>
			var sorter = new TINY.table.sorter("sorter");
			sorter.head = "head";
			sorter.asc = "asc";
			sorter.desc = "desc";
			sorter.even = "evenrow";
			sorter.odd = "oddrow";
			sorter.evensel = "evenselected";
			sorter.oddsel = "oddselected";
			sorter.paginate = true;
			sorter.currentid = "currentpage";
			sorter.limitid = "pagelimit";
			sorter.init("t02",1);
			</script>
		

	</body>
</html>