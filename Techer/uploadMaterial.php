<!DOCTYPE HTML>
<?php
/*** begin our session ***/
session_start(); 


/*** set a form token ***/
$form_token = md5( uniqid('auth', true) );
include 'function.php';
/*** set the session form token ***/
$_SESSION['form_token'] = $form_token;
if(!isset( $_POST['file_description']))
{
	if ( empty($_POST['file_description'])) {
		$message =' ';
	}
	else{
	header("uploadMaterial.php");
    $message = 'Please enter a file description';
	}
}
else if(!isset( $_POST['file_name']))
{
	header("uploadMaterial.php");
    $message = 'Please enter a valid file name';
}
elseif (ctype_alnum($_POST['user_class']) == NULL )
{
        //*** if there is no match ***
        $message = "Please choice your class";
}


else
{
	
	/******* UPload images*****/
$target_dir = "material/";
$target_file = $target_dir . basename($_FILES["user_material"]["name"]);
$image_name = addslashes ($_FILES["user_material"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 move_uploaded_file($_FILES["user_material"]["tmp_name"], $target_file);

	//echo  $image_name;

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
		$user_class = filter_var($_POST['user_class'], FILTER_SANITIZE_STRING);
    $file_description = filter_var($_POST['file_description'], FILTER_SANITIZE_STRING);
	$file_accessibility = filter_var($_POST['file_accessibility'], FILTER_SANITIZE_STRING);
	$file_name = filter_var($_POST['file_name'], FILTER_SANITIZE_STRING);
	//$image_name = filter_var($_POST['image_name'], FILTER_SANITIZE_STRING);
	
        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        /*** prepare the insert ***/
        $stmt = $dbh->prepare("INSERT INTO material (classID, Name, description, Accessibility, video_url) VALUES (:user_class, :file_name,:file_description, :file_accessibility, :image_name)");
		
        /*** bind the parameters ***/
        $stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
		$stmt->bindParam(':file_accessibility', $file_accessibility, PDO::PARAM_STR);
		$stmt->bindParam(':file_description', $file_description, PDO::PARAM_STR);
		$stmt->bindParam(':user_class', $user_class, PDO::PARAM_STR);
		$stmt->bindParam(':image_name', $image_name, PDO::PARAM_STR);		
		
 /*** if we are here the data is valid and we can insert it into database ***/
 	
    
	  $stmt->execute();
	 $message = 'Material Upload Succeed';
	
        /*** unset the form token session variable ***/
       // unset( $_SESSION['form_token'] );
		
  
       

          //header("location:teacher_portfolio.php#portfolio");

        /*** if all is done, say thanks ***/
      
		
    }
    catch(Exception $e)
    {
        /*** check if the username already exists ***/
        if( $e->getCode() == 23000)
        {
            $message = 'File Name already exists';
        }
        else
        {
            /*** if we are here, something has gone wrong with the database ***/
            $message = 'We are unable to process your request. Please try again later';
			 //$message = 'Upload Successful!';
        }
    }

}
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

<html>
	<head>
		<title>Upload Material</title>
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
							<span class=""><a href="../index.php"><img src="images/banne.jpg" alt="" /></a></span>
							<h1>Material Upload</h1>
							
							<form action="#" method="POST" enctype="multipart/form-data" >
							
							<table>
							<tbody>
								<tr>
								<td>Class Belongs</td>
								<td>
									<select name="user_class" id="user_class">
										<?php loop_class_upload($user_id); ?>						
									</select>
								</td>
								</tr>
								
								<tr>
								<td>File Name</td>
								<td>
								<input type="text" name="file_name" id="file_name" placeholder=" "/>
								</td>
								</tr>
								
								<tr>
								<td>File Description</td>
								<td>
								<input type="text" name="file_description" id="file_description" placeholder=" "/>
								</td>
								</tr>
								
								<td>Accessibility</td>
								<td>
								<select name="file_accessibility" id="file_accessibility">
										<option value = "Private"> Private </option>
										<option value = "Public"> Public </option>
									</select>
								</td>
								</tr>
								
								<tr>
								<td>File select</td>
								<td>
								<input type="file" name="user_material" id="user_material">
								</td>
								</tr>
								
							</tbody>
							</table>
							
							<br>
							<input type="submit" value="Upload">
							</form>
							<?php echo $message ?>
							<body>
						</header>

					</section>

				<!-- Footer -->
					<footer id="footer">
						<ul class="copyright">
							<li><a href="teacher_portfolio.php">Back to portfolio</a></li>
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