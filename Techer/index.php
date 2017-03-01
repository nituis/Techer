<?php 
	session_start();
	include "function.php";	?>
<!doctype html>
<html>
<head lang="en"><!--how about Chinese language?-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title>HOME - TECHER</title> 

	<meta name="description" content="a platform to help students to find their teachers or tutors with efficiency">	    
	<meta name="keywords" content="tutor, teacher, parent, student, tutorial, gps, webapp">
	<meta property="og:title" content="">

	<!--CSS newly created stylesheet-->
	<link rel="stylesheet" type="text/css" href="style.css">

	<!--munter template--
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">	
	<link rel="stylesheet" href="fancybox/jquery.fancybox-v=2.1.5.css" type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/style.css">	
	-->	
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" rel="stylesheet">

	<!--MAP-->
	<script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script src="map.js"></script>
	
	<!--ADS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	
	<link rel="stylesheet" href="css/ads.css" rel="stylesheet">
</head>

<body>
<!--menu bar--------------------------------------------------------------------------------->
	<script>
	/* When the user clicks on the button, 
	toggle between hiding and showing the dropdown content */
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
			document.getElementById("homelogo").classList.toggle("homelogodiv2");
			document.getElementById("menu2").classList.toggle("menubar2");
			document.getElementById("dropdown").classList.toggle("mini2");
		}

	// Close the dropdown menu if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {

			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
			  var openDropdown = dropdowns[i];
			  if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			  }	 
			}
			
			if (document.getElementById("homelogo").classList.contains("homelogodiv2")){
				document.getElementById("homelogo").classList.remove("homelogodiv2");
			}
			
			if (document.getElementById("menu2").classList.contains("menubar2")){
				document.getElementById("menu2").classList.remove("menubar2");
			}
			
			if (document.getElementById("dropdown").classList.contains("mini2")){
				document.getElementById("dropdown").classList.remove("mini2");
			}
			
		  }		  
		}
	</script>

	<div id="menu2" class="menu-bar">  

		<div  id="homelogo" class="homelogodiv">
			<a href="index.php" title="home" >
			<img id="home" src="images/logo.png" alt="home" />
			</a>
		</div>
		
		<!-- mobile navigation-->
		<div id="dropdown" class="mini dropdown">
			<div class="menuicon">
			<a onclick="myFunction()" class="dropbtn fa fa-bars fa-2x"  title="mobile navigation">			
			</a>
			</div>

	
			<div id="myDropdown" class="dropdown-content">		
				<a id="menu-link-1" href="#slide-1" title="HOME">HOME</a>		
				<a id="menu-link-2" href="#slide-2" title="ABOUT US">ABOUT US</a>		
				<a id="menu-link-3" href="#slide-3" title="OUR SERVICE">OUR SERVICE</a>		
				<a id="menu-link-4" href="#slide-4" title="FIND TEACHERS">FIND TEACHERS</a>		
				<a id="menu-link-5" href="#slide-5" title="RANKED TEACHERS">RANKING</a>		
				<a id="menu-link-6" href="#slide-6" title="CONTACT US">CONTACT US</a>		
				<a href="Registration/reg.php" title="REGISTER">REGISTER</a>		
			</div>
			
		</div> 
		
		<!--normal navigation-->
		<div class="navLink">
			<ul>
			<li class="topLi">
			<a id="menu-link-1" href="#slide-1" title="HOME">HOME</a>
			</li>

			<li class="topLi">
			<a id="menu-link-2" href="#slide-2" title="ABOUT US">ABOUT US</a>
			</li>

			<li class="topLi">
			<a id="menu-link-3" href="#slide-3" title="OUR SERVICE">OUR SERVICE</a>
			</li>

			<li class="topLi">
			<a id="menu-link-4" href="#slide-4" title="FIND TEACHERS">FIND TEACHERS</a>
			</li>

			<li class="topLi">
			<a id="menu-link-5" href="#slide-5" title="RANKED TEACHERS">RANKING</a>
			</li>

			<li class="topLi">
			<a id="menu-link-6" href="#slide-6" title="CONTACT US">CONTACT US</a>
			</li>

			<li class="topLi">
			<a href="Registration/reg.php" title="REGISTER">REGISTER</a>
			</li>
			</ul>
		</div><!--END navLink-->

	</div><!--END menu-bar-------------------------------------------------------------------->

<!-- === ADS === -------------------------------------------------->
	<?php  get_random_ads_video();  ?>
<!-- === MAIN === -------------------------------------------------->
<!-- === Slide 1 home logo === -->
	<div class="slide" id="slide-1">

		<div class="row-1">
		<img id="cover" src="images/logo.png" />
		<h2 id="slide1title">FIND TEACHERS? FIND TECHER!</h2>
		</div><!--END row-1-->

		<div class="row-2">
			<div class="row-2-1">
				<div class="complexButton">
				<div class="floatingButton">
				<a href="login.php" title="login">
				<img class="login" src="images/s03.png">
				</a>
				</div>
				<p class="loginText">STUDENTS</p>
				</div>
			</div>

		<div class="row-2-1">
		<div class="complexButton">
		<div class="floatingButton">
		<a href="login.php" title="login">
		<img class="login" src="images/s04.png">
		</a>
		</div>
		<p class="loginText">TEACHERS</p>
		</div>
		</div>

		</div><!--END row-2 -->

	</div><!--END slide-1 -->

<!-- === Slide 2 about us === -->  <!--mixed code mainly from fractal template-->
	<div class="slide" id="slide-2">

		<div class="row-1">
			<h1 class="title">WHAT IS TECHER?</h1> 

			<div class="row-4">
				<img id="leftImg" src="images/wit.jpg" alt="MISSIONS"  />
				<p id="rightP" class="pBesideCircleImg">
				Techer is a platform to help students to find their teachers or tutors with efficiency and great accessibility.
				<br />
				<br />
				You can find your Tutor Anywhere Anytime!
				</p>
			</div><!--end subRow-->
		</div><!--END row-1-->

		<div class="row-2">
			<h1 class="title">OUR MISSION</h1> 

			<div class="row-4">
				<p id="leftP" class="pBesideCircleImg">
				Provide a platform for potential parties to organize a tutorial classes.
				<br>Ensure the qualification of each teachers.
				<br>Be a chatroom among authorized users.
				<br>Raise the quality of tutorial classes.
				</p>
				<img id="rightImg" src="images/omis4.jpg" alt="MISSIONS" />
			</div>
		</div><!--END row-2-->

	</div><!--END slide-2 -->



<!-- === Slide 3 our service === -->
	<div class="slide" id="slide-3">

		<div class="row-1">
			<h1 class="title">OUR SERVICE</h1> 

			<p>This is what we do best</p>
		</div><!--END row-1 -->

		<div class="row-2">
			<div class="col">
			<!--	!!!!!!!!need edit here for all images-->
				<img class="slide3Image" src="images/secure.png" alt="secure identity"/>  
				<h2 class="subtitle">SECURE IDENTITY</h2>
				<p>Verify users' information</p>                                                 
			</div><!--END col -->

			<div class="col">
				<img class="slide3Image" src="images/webapp.png" alt="web app"/>
				<h2 class="subtitle">WEBAPP</h2>
				<p>View tutorials everywhere</p>
			</div><!--END col -->

			<div class="col">
				<img class="slide3Image" src="images/findNearest.png" alt="find nearest"/>
				<h2 class="subtitle">FIND NEAREST</h2>
				<p>Find the closest teacher</p>
			</div><!--END col -->

			<div class="col">
				<img class="slide3Image" src="images/ranking.png" alt="ranking system"/>
				<h2 class="subtitle">RANKING SYSTEM</h2>
				<p>Find highlighted teachers</p>
			</div><!--END col -->
		</div><!--END row-2 -->

	</div><!--END slide-3 -->

<!-- === Slide 4 Map === -->
<?php get_map(); ?>



<!-- === Slide 5 Ranking teacher === -->
	<div class="slide" id="slide-5">

		<div class="row-1">
		<h1 class="title" >RANKING</h1> 
		<div id="ranking" class="">
			<?php top_rank()?>

		</div><!--END row-1 -->


		<div class="row-2">
		<!--add code--
		<img src="images/test.png" alt="RANKED TEACHERS">
		-->

		</div><!--END row-2 -->

		</div><!--END slide-5 -->
	</div>

<!-- === Slide 6  Contact === -->
	<div class="slide"  id="slide-6">

	<div class="row-1">
	<h1 class="title">CONTACT US</h1>
	<p>You can find us literally anywhere, just push a button and we’re there</p>
	</div><!--END row-1 -->

	<div class="row-2">

	<form method="post" action="thankyou.php" >
	<input type="text" class="smallBox" id="name" name="name" placeholder="Name" />
	<input type="text" class="smallBox" id="email" name="email" placeholder="Email"/> 
	<textarea id="message" class="bigBox" name="message" placeholder="Message" >
	</textarea>
	<button type="submit" class="smallBox" id="submit" name="submit" formaction="thankyou.php" value="">Send Message</button>

	</form>
	</div> <!--end row-2-->

	<!--
	<div class="row-3">
	<div class="row-3-1">
	<div class="cellInfo">
	<a target="_blank" href="#">
	<img class="info" src="images/phone.png"></a>
	<p class="hidden">PHONE NO</p>
	</div><!--END cell --

	<div class="cellInfo">
	<a target="_blank" href="#">
	<img class="info" src="images/email.png"></a>
	<p class="hidden">EMAIL ADDRESS</p>
	</div><!--END cell --
	</div>

	<div class="row-3-1">
	<div class="cellInfo">
	<a target="_blank" href="#">
	<img class="info" src="images/facebook.png"></a>
	<p class="hidden">FACEBOOK NAME</p>
	</div><!--END cell --

	<div class="cellInfo">
	<a target="_blank" href="#">
	<img class="info" src="images/twitter.png"></a>
	<p class="hidden">TWITTER NAME</p>
	</div><!--END cell --
	</div>
	</div><!--END row-3 -->

	</div>
</div>
<!--END Slide 6 -->

<!--END MAIN CONTENT-------------------------------------------------------------------------->


<!--FOOTER: SITEMAP--------------------------------------------------------------------------->
	<div class="footer" >
		<ul>
		<li >
		<a href="#slide-2" title="ABOUT US">ABOUT US</a>
		</li>
		<li class="bottomLi"> &bull; </li>
		
		<li ">
		<a href="#slide-3" title="OUR SERVICE">OUR SERVICE</a>
		</li>
		<li class="bottomLi"> &bull; </li>

		<li>
		<a href="#slide-4" title="FIND TEACHERS">FIND TEACHERS</a>
		</li>
		<li class="bottomLi"> &bull; </li>
		
		<li >
		<a href="#slide-5" title="RANKED TEACHERS">RANKING</a>
		</li>
		<li class="bottomLi"> &bull; </li>

		<li >
		<a href="#slide-6" title="CONTACT US">CONTACT US</a>
		</li>
		<li class="bottomLi"> &bull; </li>

		<li >
		<a href="Registration/reg.php" title="REGISTER">REGISTER</a>
		</li>
		<li class="bottomLi"> &bull; </li>

		<li>
		<a href="login.php" title="LOGIN">LOGIN</a>
		</li>
		<li class="bottomLi"> &bull;</li>

		<li >
		<a href="legalPolicy.php" title="LEGAL POLICY">LEGAL POLICY</a>
		</li>
		</ul>
	
		<p class="footerText">© 2015 COPYRIGHT TECHER. ALL RIGHTS RESERVED.</p>

	
	</div> 
<!--END  FOOTER------------------------------------------------------------------>
<div id="sessionTimeoutWarning" style="display: none"></div>
</body>

<!-- SCRIPTS -->
<script src="js/html5shiv.js"></script>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.pack-v=2.1.5.js"></script>
<script src="js/script.js"></script>
	<script src="assets/js/jquery.idletimer.js"></script>

</html>