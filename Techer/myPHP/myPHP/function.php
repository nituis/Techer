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

//
function uploadComment($varName, $varEmail, $varComment){	
		$conn = connect_to_database();
		$sql = "INSERT INTO `comment` (`name`, `email`, `comment`) VALUES ('".
				 $varName . "', '" .
				 $varEmail . "', '".
				 $varComment ."')";
				 
		$retval = $conn->query($sql);
		//mysql_select_db('seproject');
	
	//$retval = mysql_query( "SELECT * FROM comment where 1",$conn );
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
	   
	echo "Entered data successfully\n";
	   
	//mysql_close($conn);
}

?>