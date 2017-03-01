
<!DOCTYPE HTML>
<?php

/*** begin our session ***/
session_start();

/*** check if the users is already logged in ***/
if(!empty($_SESSION['user_id']))
{
	$sql = "SELECT user_type FROM techer_users WHERE user_id ='" . $_SESSION['user_id'] . "'";
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
		die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		$uType = $row["user_type"];
	}
	if($uType==='s')
		header ("Location: student_portfolio.php");
	else if ($uType==='t')
		header ("Location: teacher_portfolio.php");
}
/*** check that both the username, password have been submitted ***/
if(!isset( $_POST['user_name'], $_POST['user_password']))
{
	if (empty($_POST['user_name']) || empty($_POST['user_password'])) {
		$message =' ';
	}
	else{
    $message = 'Please enter a valid username and password';
	}
}
/*** check the username is the correct length ***/
elseif (strlen( $_POST['user_name']) > 20 || strlen($_POST['user_name']) < 4)
{
    $message = 'Incorrect Length for Username';
}
/*** check the password is the correct length ***/
elseif (strlen( $_POST['user_password']) > 20 || strlen($_POST['user_password']) < 4)
{
    $message = 'Incorrect Length for Password';
}
/*** check the username has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['user_name']) != true)
{
    /*** if there is no match ***/
    $message = "Username must be alpha numeric";
}
/*** check the password has only alpha numeric characters ***/
elseif (ctype_alnum($_POST['user_password']) != true)
{
        /*** if there is no match ***/
        $message = "Password must be alpha numeric";
}
else
{
    /*** if we are here the data is valid and we can insert it into database ***/
    $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
    $user_password = filter_var($_POST['user_password'], FILTER_SANITIZE_STRING);

    /*** now we can encrypt the password ***/
    $user_password = sha1( $user_password );
    
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
        $stmt = $dbh->prepare("SELECT user_id, user_name, user_password, user_type, status FROM techer_users WHERE user_name = :user_name AND user_password = :user_password");
        /***bind the parameters ***/
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $user_password, PDO::PARAM_STR, 40);
	
		
        /*** execute the prepared statement ***/
        $stmt->execute();
		
		$stmt->bindColumn('user_id',$user_id);
		$stmt->bindColumn('status',$status);
		$stmt->bindColumn('user_type',$user_type);
        /*** check for a result ***/
       
		$stmt->fetch(PDO::FETCH_BOUND);
		
        /*** if we have no result then fail boat ***/
        if($user_id == false)
        {
                $message = 'Login Failed';
        }
        /*** if we do have a result, all is well ***/
        else
        {
                /*** set the session user_id variable ***/
                $_SESSION['user_id'] = $user_id;
				$_SESSION['user_type'] = $user_type;
				$_SESSION['status'] = $status;
				
if ($user_type == 's'&& $user_name != 'admin'){
header("location: student_portfolio.php");
}
elseif($user_type == 't' && $status=='A' ){
header("location: teacher_portfolio.php");
}
elseif($user_name == 'admin'){
	header("location: adminStage.php");
}
else{
	  $message = 'Sorry, You need to wait us to approve';
 }
		
        }


    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}
?>

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
	<body class="is-loading">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main">
						<header>
							<span class=""><a href="index.php"><img src="images/banne.jpg" alt="" /></a></span>
							<h1>Welcome to Techer </h1>
							<form action="#" method="post">
                                <label>UserName :</label>
                                <input id="user_name" name="user_name" placeholder="username" type="text">
                                <label>Password :</label>
                                <input id="user_password" name="user_password" placeholder="**********" type="password">
                                </br>
                                <input name="submit" type="submit" value=" Login ">
                                </br>
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
							<li><a href="forgetPassword.php">Forget your password?</a></li>
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