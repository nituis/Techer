<?php session_start();

//include "function.php"; //connects to the database
//connect_to_database();
$message="";        $sentmail="";
if (isset($_POST['username'])){

    $username = $_POST['username'];

    //$query="select user_name,user_password,user_email from techer_user where username='$username'";

    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'seadmin';

    /*** mysql password ***/
    $mysql_password = '19931113';

    /*** database name ***/
    $mysql_dbname = 'seproject';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the select statement ***/
        $stmt = $dbh->prepare("select user_name,user_password,user_email from techer_users where user_name= :username ");
        /***bind the parameters ***/
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        //$stmt->bindParam(':user_password', $user_password, PDO::PARAM_STR, 40);
	//echo $username;
		

	
        /*** execute the prepared statement ***/
        $stmt->execute();


		$stmt->bindColumn('user_name',$user_name);
		$stmt->bindColumn('user_password',$user_password);
		$stmt->bindColumn('user_email',$user_email);
	

		

        /*** check for a result ***/
       
		$stmt->fetch(PDO::FETCH_BOUND);
	        /*** if we have no result then fail boat ***/
			
			 /*** now we can encrypt the password ***/
		$user_password = sha1( $user_password );
        if($user_name == false)
        {

                $message = 'No Such User Please Enter Again';
        }
        /*** if we do have a result, all is well ***/
        if($user_email == true){


        

        $to = $user_email;

        //echo "your email is ::".$email;

        //Details for sending E-mail

        $from = " Techer Admin";

        $url = "http://ec2-52-33-243-138.us-west-2.compute.amazonaws.com/techer/
";

        $body  =  "Hello , Dear Techer User 

        -----------------------------------------------

        Url : $url;

		email Details is : $to;

        Here is your password  :$user_password;

        Sincerely,

        Techer";

        $from = " Techer Admin";

        $subject = "Techer Forget Password ";

        $headers1 = "From: $from\n";

        $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";

        $headers1 .= "X-Priority: 1\r\n";

        $headers1 .= "X-MSMail-Priority: High\r\n";

        $headers1 .= "X-Mailer: Just My Server\r\n";

        $sentmail = mail ( $to, $subject, $body, $headers1 );
		echo "2";

    } 
	/*(else {

    if ($_POST ['email'] != "") {

    echo "<span style="color: #ff0000;"> Not found your email in our database</span>";

        }

        }

    //If the message is sent successfully, display sucess message otherwise display an error message.
	*/
    if($sentmail==1){

        $message ="Your Password Has Been Sent To Your Email Address Please Check.";
    }

     else{

        if(empty($user_password))

        $message =" Cannot send password to your e-mail address.Problem with sending mail";

	}

}
    
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later';
    }
}
	
	
    // If the count is equal to one, we will send message other wise display an error message.

 

?>

 

<html>
	<head>
		<title>Forget Password</title>
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
							<span class=""><a href="index.php"><img src="images/banne.jpg" alt="" /></a></span>
							<h1>Welcome to Techer </h1>
							<form action="#" method="post">

								<label> Enter your User ID : </label>

								<input id="username" type="text" name="username" />

								<input id="button" type="submit" name="button" value="Submit" />
								<br/>
							
                                <span><?php echo $message; ?></span>
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
							<li><a href="Registration/reg.php">Register</a></li>
							
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
