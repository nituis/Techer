<?php

//connect to localhost
function connect_to_database(){
	$dbhost = 'localhost';
	$dbuser = 'seadmin';
	$dbpass = '19931113';
	$dbname = 'seproject';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
		or die("Unable to connect to MySQL");
	return $conn;
}

//upload comment
function uploadComment($varName, $varEmail, $varComment){	
		$conn = connect_to_database();
		$sql = "INSERT INTO `comment` (`name`, `email`, `comment`) VALUES ('".
				 $varName . "', '" .
				 $varEmail . "', '".
				 $varComment ."')";
				 
		$retval = $conn->query($sql);

	//$retval = mysql_query( "SELECT * FROM comment where 1",$conn );
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
	   
	echo "Entered data successfully\n";
	   
	//mysql_close($conn);
}
function reg_User($varName, $varPassword,$varUserType){	
		$conn = connect_to_database();
		$sql = "INSERT INTO user (name, password, userType) VALUES ('".
				 $varName . "','" .
				 $varPassword . "','".
				 $varUserType ."')" ;
				 
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();

}
function reg_StudentLogin($varName, $varPassword,$varUserType){	
$conn = connect_to_database();
	
		$sql = "INSERT INTO `login_student` (`name`, `password`) VALUES ('".
				 $varName . "','" .
				 $varPassword ."')";
				 
		$retval = $conn->query($sql);
		//mysql_select_db('seproject');
	
	//$retval = mysql_query( "SELECT * FROM comment where 1",$conn );
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}

}

function reg_TutorLogin($varName, $varPassword){	
		$conn = connect_to_database();
			
		$sql = "INSERT INTO `login_tutor` (`name`, `password`) VALUES ('".
				 $varName . "','" .
				 $varPassword ."')";
				 
		$retval = $conn->query($sql);
		mysql_select_db('seproject');
	
	//$retval = mysql_query( "SELECT * FROM comment where 1",$conn );
			if(! $retval ){
				die('Could not enter data: ' . mysql_error());
			}

}

?>