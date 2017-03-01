<?php
	session_start();
	require_once("function.php");
	$user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['user_type'];
	$location = $_POST['user_location'];
	
	//check if is first-click case
	$tableName = "location";
	$columnName = null;
	$condition = "where loc_user_id = " . $user_id;
	$result = select($tableName, $columnName, $condition);

	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		//do update operation but need to check
		$columnName = "location";
		if (update($tableName, $columnName, $location, $condition)){
			header("location: index.php#slide-4");
		} else echo "alter error";
		
	} else {  //store if first-click case
		$parameterName = $user_id . ", '". $user_type. "', '". $location. "'";
		if (insertInto($tableName, $columnName, $parameterName)){
		   header("location: index.php#slide-4");
		} else echo "insert error";
	}
	/* test case :
	guest :
	onload : 
	  zoom : smaller
	  center : hong kong
	click :
	  zoom : bigger
	  center : own location
	  
	tutor/student(/admin) :
	onload : 
	  zoom : bigger
	  center : 
	    if db no data : hong kong
		else : saved location
	click :
	  zoom : bigger
	  center : current location
	 */
?>

