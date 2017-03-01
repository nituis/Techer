<?php
//update table ads_request
session_start(); 
error_reporting(1);
include 'function.php';
$message = null;


if (isset($_SESSION['user_id'])){
	echo $_FILES["video"]["size"];
	//check if tutor has uploaded before
	$tableName = "ads_request";
	$columnName = "";
	$condition = "where user_id=". $_SESSION['user_id'];
	$firstUpload = true;
	$result = select($tableName, $columnName, $condition);
	//echo"1";
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$firstUpload = false;
		//echo"2";
	}
	
	
	//extract($_POST);
	
	$target_dir = "ads_video/";
	$video = $_FILES["video"]["name"];
	$target_file = $target_dir. basename($video);
	
	$videoFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file = filesize($video);
	
	if (!empty($videoFileType) && $videoFileType != "mp4" && 
		$videoFileType != "avi" && 
		$videoFileType != "mov" && 
		$videoFileType != "3gp" && 
		$videoFileType != "mpeg"){
		$message = "File format other than .mp3, .mp4, .avi, .mov, .3gp, .mpeg is not supported. Please upload the correct file.";
		//echo"3";
	} else if (filesize($video) > 5000000) {  //test!!! 2000000byte = 2000kbyte = 2Mbyte
		$message = "File size must not exceed 5MB";
		//echo"4";
	} else if (file_exists($target_file)) {
		$message = "File already exists. Please use other file name.";
		//echo"5";
	} else {
		$video = $_FILES["video"]["name"];
		
		
		move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir.$video);  
		//echo $target_dir.$video;
		//echo"6";
		if ($_FILES["video"]["error"] > 0)
			$message = "upload error: ". $_FILES["video"]["error"];
		else {
			if (!$firstUpload){
				$tableName = "ads_request";
				$condition = "where user_id=". $_SESSION['user_id'];
				//update($tableName, "req_time", date("Y-m-d h:i:sa"), $condition);
				update($tableName, "req_video", $video, $condition);
				update($tableName, "req_status", 1, $condition);
				update($tableName, "payment_status", 1, $condition);
				//echo"7";
			} else {
				
					

					$mysql_hostname = 'localhost';
					$mysql_username = 'seadmin';
					$mysql_password = '19931113';
					$mysql_dbname = 'seproject';

					try {
						//echo"9";
						$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
						
						/*** $message = a message saying we have connected ***/
						$user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
						$req_id = filter_var($maxID, FILTER_SANITIZE_STRING);
						$req_time = filter_var(date("Y-m-d h:i:sa"), FILTER_SANITIZE_STRING);
						$req_video = filter_var($video, FILTER_SANITIZE_STRING);
						/*
						$user_id = $_SESSION['user_id'];
						$req_id = $maxID;
						$req_time = date("Y-m-d h:i:sa");
						$req_video = $video;*/
					
						/*** set the error mode to excptions ***/
						$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						/*** prepare the insert ***/
						$stmt = $dbh->prepare('insert into ads_request (user_id, req_video, req_status, payment_status) values (:user_id, :req_video, 1, 1)');
						
						/*** bind the parameters ***/
						$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
						//$stmt->bindParam(':req_id', $req_id, PDO::PARAM_STR);
						//$stmt->bindParam(':req_time', $req_time, PDO::PARAM_STR);
						$stmt->bindParam(':req_video', $req_video, PDO::PARAM_STR);
						//echo $user_id. " ". $req_id. " ".$req_time. " ".$req_video;
						//echo"10";
						$stmt->execute();
						
						//echo"11";
					} catch(Exception $e) {
						/*** check if the username already exists ***
						if( $e->getCode() == 23000){
							$message = 'File Name already exists';
						} else{
							/*** if we are here, something has gone wrong with the database ***
							$message = 'We are unable to process your request. Please try again later';
						//}
					
						}*/
						$message = $e->getMessage();
						
					}
			}
		}

}
//$message = "file ".$file . "---";
if ($message == null)
	$_SESSION['result'] = "Submit Succeeded".$message;
else 
	$_SESSION['result'] = "Failed to submit request. Reason: ".$message;

$_SESSION['previousPage'] = "Back to My Portfolio";
$_SESSION['previousPagePath'] = "teacher_portfolio.php#ads";

header("Location: general_result_page.php");
//*6 end
}
?>