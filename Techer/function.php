<?php
//connect to localhost, return $conn
function connect_to_database(){
	$dbhost = 'localhost';
	$dbuser = 'seadmin';
	$dbpass = '19931113';
	$dbname = 'seproject';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)  
		or die("Unable to connect to MySQL");
	return $conn;
}

/*
insert data into database
return operation result whether is true or false
(true = insert success, false = insert fail)

required parameters :
$tableName 
$columnName : can be null
$parameterName : value inside () in SQL code
*/
function insertInto($tableName, $columnName, $parameterName){
	if ($columnName != null)
  	  $sql = "INSERT INTO " . $tableName . " (" . $columnName.") values (" . $parameterName . ")";
    else
	  $sql = "INSERT INTO " . $tableName ." values (" . $parameterName . ")";
  
    $conn = connect_to_database();
	
	$result = "";

	if ($conn->query($sql) === TRUE) 
		$result = true;
	else 
		$result = false;

	$conn->close();
	//echo $sql;
	return $result;
}

	//eg update location set location = '1,2' where loc_user_id = 20;
	
//need to check
function update($tableName, $columnName, $value, $condition){
	$sql = "UPDATE " . $tableName ." set " . $columnName. " = '". $value. "' ". $condition;
    //echo $sql;
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
			die("Could not connect: " . mysql_error());  
		mysql_select_db("seproject");
		$result =  mysql_query( $sql);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}	
	mysql_close($con);
	return $result;
}

/*
select data from database
return operation result in terms of number of rows 


required parameters :
$tableName 
$columnName : can be null ($columnName = null : means select all columns)
$condition : phrase after 'select .. from tableName '
*/

//to use : $row = mysql_fetch_array($result, MYSQL_ASSOC)
function select($tableName, $columnName, $condition){
	if ($columnName != null)
  	  $sql = "select " . $columnName. " from ". $tableName . " ". $condition;
    else
	  $sql = "select * from ". $tableName . " ". $condition;
  
    //echo $sql;
    $con = mysql_connect("localhost", "seadmin", "19931113") or  
			die("Could not connect: " . mysql_error());  
		mysql_select_db("seproject");
		$result =  mysql_query( $sql);
		if(! $result ){
			die('Could not get data: ' . mysql_error());
		}	
	mysql_close($con);
	return $result;
}

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
	   
	//mysql_close($conn);
}

function updateInfo($varField, $varValue,$varID){
	$conn = connect_to_database();
	$sql = "UPDATE `techer_users` SET " .$varField ."='".
				$varValue . "' WHERE user_id = '". $varID."';";
				 
		$retval = $conn->query($sql);
		//mysql_select_db('seproject');
	if(! $retval ){
		die('Could not enter data: ' . mysql_error());
	}
}

//student page functions

function loop_class_inTable($varStdID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class_participant WHERE studentID ='".$varStdID."'";
	$retval =  mysql_query( $sql);
	if(!$retval ){
		die('Could not get data: ' . mysql_error());
	}	
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		get_class_info($row['classID']);
	}
}

function get_class_info($varClassID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE ID ='".$varClassID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		echo '<a href="courseMaterial.php?id='.$varClassID.'"><p>' . $row['Name'] .' | '.$row['TeacherName']. '</p></a>';
	}
}
	
function loop_material_inTable($varClassID){  //need edit
	/*$c=0;*/
	$conn = connect_to_database();
	$sql = "SELECT * FROM material WHERE classID ='".$varClassID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	/*echo '<table class="">';*/
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		/*if($c%3===0){
			echo '<tr>';
		}
		echo '<td><article class="item">
				<h4>'.$row['Name'].'</h4>
				
				<a href="viewVideo.php?mid='.$row['ID'].'" class="image fit"><img src="images/'.$row['preview_url'].'" alt="" /></a>
				<p>'.$row['description'].'</p>
			</article></td>';
		if($c%3===2){
			echo '</tr>';
			}
		$c++;
		*/
		echo '<div id="classlist" class="classparti" >
				<div class="materialname">
					'.$row['Name'].'
				</div>
				
				<div class="fit">
					<a href="viewVideo.php?mid='.$row['ID'].'" class="image">
						<video height="" width="" controls>
						<source src="video/'.$row['video_url'].'" type="video/mp4">
						</video></a>
				</div>
					
				<div class="descrition">';
				
				if ($row['description'] == ""){
					echo 'No Description';
				}
				else{
					echo $row['description'];
				}
				
		echo'
				</div>
			</div>';
			
	}
	/*
	if($c%3!=2){
		echo '</tr>';
	} echo '</table>';
	*/
}

function get_video($varMaterialID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM material WHERE ID ='".$varMaterialID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		echo 	'<article class="item">
						<h2>'.$row['Name'].'</h2>
						
						<video height="" width="" controls>
						<source src="video/'.$row['video_url'].'" type="video/mp4">
						</video>		
					</article>';
	}
}

function get_videoComment($varMaterialID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM material_comment WHERE materialID ='".$varMaterialID."'";
	$retval =  mysql_query($sql);
	if(!$retval ){
		die('Could not get data: ' . mysql_error());
	}	
	echo '';
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		echo 	'<p>'. $row['userName'] . '   @' .$row['time'] .'<br/>' . $row['comment'] .'</p>';
	}
}

function get_student_menu($userID/*$user_name*/){
	$menuItem1 ='My Tutorials';
	$Item1_url ='student_portfolio.php#top';
	$Item1_html5_link = 'top-link';
	
	$menuItem2 ='Find Teacher';
	$Item2_url ='student_portfolio.php#portfolio';
	$Item2_html5_link = 'portfolio-link';
	
	$menuItem3 ='Request Reply';
	$Item3_url ='student_portfolio.php#req';
	$Item3_html5_link = 'req-link';
	
	$menuItem4 ='Search Teacher';
	$Item4_url ='student_portfolio.php#searchtut';
	$Item4_html5_link = 'searchtut-link';
	
	$about_url = 'student_portfolio.php#about';
	
	$std_name = get_studentName($userID);
	$std_icon = get_tutorIcon($userID);
	
	echo '
		<div id="header">

			<div class="top">
			<!-- Back to Home -->
				<div id="bk2hm">
					<!-- back to home page -->
						<a href="index.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home icon2"></span></a>
					<!-- Log out -->
						<a href="logout.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-sign-out iconOut">Log Out</span></a>
					<br>
					
				</div>

			<!-- Logo -->
				<div id="logo">
						<a href="'.$about_url.'">
							<div>
							<div class="image avatar48 circle_image"><img src="'.$std_icon.'" alt="" /></div>							
							
							<h1 id="title">'. $std_name.'</h1>
							<p style=" font-weight:bold;">Student | 
							<a href="changeInfo.php" >Edit</a>
							</p>
							</div>
						</a>
					</div>

			<!-- Nav -->
				<nav id="nav">

					<ul>
						<li><a href="'.$Item1_url.'" id="'.$Item1_html5_link.'" class="skel-layers-ignoreHref"><span class="icon  fa-folder">'.$menuItem1.'</span></a></li>
						
						<li><a href="'.$Item3_url.'" id="'.$Item3_html5_link.'" class="skel-layers-ignoreHref"><span class="icon  fa-reply">'.$menuItem3.'</span></a></li>
						
						<li><a href="'.$Item2_url.'" id="'.$Item1_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-map-marker">'.$menuItem2.'</span></a></li>	
						
						<li><a href="'.$Item4_url.'" id="'.$Item4_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-search">'.$menuItem4.'</span></a></li>	
					</ul>
				</nav>

		</div>

		</div>';
}

function get_notification($user_id){
	$conn = connect_to_database();
	$sql = 'SELECT ID,tID, respond FROM request WHERE sid ="'. $user_id . '" AND Choice IS NOT NULL AND respond <>"" AND visible="yes"';
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}		
	
	$c =1;
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
	$tid = $row['tID'];
		$msg = $row['respond'];
		
		echo '<div class="requestinfo">
			
				<div class="requesttitle">Response '.$c.'</div>
				
				<div class="msgresponse">
				<p>';
				
				$tname = get_studentName($tid);
				
		echo 	$tname.' : '.$msg;
		echo 	'</p>
		<form method="POST" action="hideRequest.php">
		<input type="hidden" name="id" value="'.$row['ID'].'"/>
		<input type ="submit" value="Delete"/>
		</form>
		</div></div>';
		
		$c++;
	}
	
}


function get_map_student(){
	$user_id = "";
	$user_location = null;
	$otherUser_location = null;
	$target = " to find the nearby teachers";
	$icon = null;
	$major = null; //where to get?
	 
	$tableName = "location"; 
	$columnName = null;
	$condition = "";


	if ((!empty($_SESSION['user_id'])) && (!empty($_SESSION['user_type']))){
		//check whether location table have current user's location
		$user_id = $_SESSION['user_id'];
		$user_type = $_SESSION['user_type'];
		$condition = "where loc_user_id = ". $user_id;
		if ($result = select($tableName, $columnName, $condition)) {
			if ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$user_location = $row['location'];
				$target = " to change your current location";
			}
		} else echo $result;
	} 

	//find other tutors' location *editted
	$condition = "where l.loc_user_type = 't' and l.loc_user_id = t.user_id";
	$tableName = "location l, techer_users t";
	$columnName = "l.loc_user_id, l.location, t.user_name, t.icon";
	if ($result = select($tableName, $columnName, $condition)) {
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$otherUser_location = $row['loc_user_id']. ":". $row['icon']. ":". $row['user_name']. ":". $row['location']. ":". $otherUser_location;
		}
	} else echo $result;
	/*$condition = "where loc_user_type = 't'";
	$tableName = "location";
	$columnName = "loc_user_id, location";
	if ($result = select($tableName, $columnName, $condition)) {
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$otherUser_location = $row['loc_user_id']. ":". $row['location']. ":". $otherUser_location;
		}
	} else echo $result;*/

	echo 
	'<div class="slide" id="slide-4">  
		
		<header>
			<h2>Find Teacher</h2>
		</header>
		
		<div class="row-5">
		
			<h2 class="subtitle" style="black">
				<p class="slide4Text">Click </p>
				
				<button onClick="findLocation();" class="smallBox" id="start">Start</button>
				
				<p class="slide4Text">'. $target. '</p>  
			</h2>

			<form id="hiddenForm" method="post" action="location_student.php">
				<input id="user_id" name="user_id" type="text" value="'.$user_id.'">
				<input id="user_location" name="user_location" type="text" value="'.$user_location.'">
				<input id="otherUser_location" name="otherUser_location" type="text" value="'.$otherUser_location.'">
			</form>
		
		</div><!--end row-5-->
		

		<div id="map"></div>

	</div>';
}

//tutor page functions

function loop_class_mystudent_tutor($varTutID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$varTutID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		get_studentID($row['ID']);
	}
	
}

function get_studentID($varClassID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class_participant WHERE classID ='".$varClassID."' AND active ='Y'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}		
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
			$name = get_studentName($row['studentID']);
			$ssid = $row['studentID'];
			
			echo '<li>';
			echo $name.' ( '.$ssid.' )
			<a href="TutMan/remStudent.php?sid='.$row['studentID'] .'&cid='.$row['classID'].'">
			Delete
			</a>
			</li>';			
		}
			
		
}

function get_studentName($varStuID){
	//$conn = connect_to_database();
	$sql = "SELECT * FROM techer_users WHERE user_id ='".$varStuID ."'";
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
			die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	if($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		$result = $row['user_name'];
	}
	//mysql_close($con);
	return $result;
}

function get_tutorIcon($varStuID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM techer_users WHERE user_id ='".$varStuID ."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		$result = $row['icon'];
	}
	return $result;
}

function get_tutor_menu($vartutID){
	
	$menuItem1 ='Student requests';
	$Item1_url ='teacher_portfolio.php#request';
	$Item1_html5_link = 'request-link';
	
	$menuItem2 ='My classes';
	$Item2_url ='teacher_portfolio.php#classes';
	$Item2_html5_link = 'classes-link';  //id
		
	$menuItem3 ='Materials';
	$Item3_url ='teacher_portfolio.php#material';
	$Item3_html5_link = 'material-link';
	
	$menuItem4 = 'Advertisement Service';
	$Item4_url = 'teacher_portfolio.php#ads';
	$Item4_html5_link = 'ads-link';
	
	//$menuItem5 = 'Payment Method';
	//$Item5_url = 'teacher_portfolio.php#payment';
	//$Item5_html5_link = 'payment-link';
	
	$tut_name = get_studentName($vartutID);
	$tut_icon = get_tutorIcon($vartutID);
	
	echo '	<div id="header">

			<div class="top">
				<!-- Back to Home -->
					<div id="bk2hm">
						<!-- back to home page -->
						<a href="index.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home icon2"></span></a>
						<!-- Log out -->
						<a href="logout.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-sign-out iconOut">Log Out</span></a>
						<br>							
					</div>

				<!-- Logo -->
					<div id="logo">
						<a href="#about">
						<div>
						<div class="image avatar48 circle_image"><img src="'.$tut_icon.'" alt="" /></div>
						
						
						<h1 id="title">'. $tut_name.'</h1>
						<p style=" font-weight:bold;">Teacher | 
						<a href="changeInfo.php" >Edit</a>
						</p>
						</div>
						</a>
					</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="'.$Item1_url.'" id="'.$Item1_html5_link.'" class="skel-layers-ignoreHref"><span class="icon  fa-bell">'.$menuItem1.'</span></a></li>

						<li><a href="'.$Item2_url.'" id="'.$Item2_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-users">'.$menuItem2.'</span></a></li>
						
						<li><a href="'.$Item3_url.'" id="'.$Item3_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-th">'.$menuItem3.'</span></a></li>

						<li><a href="'.$Item4_url.'" id="'.$Item4_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-video-camera">'.$menuItem4.'</span></a></li>';
						
			//echo'<li><a href="'.$Item5_url.'" id="'.$Item5_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-th">'.$menuItem5.'</span></a></li>			';
			
			echo '		</ul>
				</nav>
			</div>';
			
			/*
			echo '
			<div class="bottom">
			<!-- Social Icons -->
				<!--
				<ul class="icons">
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
					<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
					<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
					<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
				</ul>
				-->
					
			</div>
*/
			echo '</div>';

}

function get_tutor_aboutMe($vartutID){
	$sql = "SELECT * FROM techer_users WHERE user_id ='" . $vartutID . "'";
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
		$user_icon = $row["icon"];
		$user_cover = $row["cover"];
		$user_regDay = $row["registrationDate"];
	}
	
	$sql = "SELECT req_video FROM ads_request WHERE user_id = " . $vartutID;
	$video = "";
	$con = mysql_connect("localhost", "seadmin", "19931113") or  
		die("Could not connect: " . mysql_error());  
	mysql_select_db("seproject");
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	if ($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		$video = "ads_video/". $row['req_video'];
	}
		
	echo '<div class="about cover"
	
		style="background-image: url('.$user_cover.'); 
		background-repeat: no-repeat;     
		background-position: center; 
		background-size: 100% 100%;">
			<!--
			<div class="fbcover">
				<span class="image featured">
					<img src="'. $user_cover . '" alt=""/>					
				</span>		
			</div>
			-->
			
			<div >				
				<img src="'. $user_icon . '" class="viewtuticon"/>
				<span class="viewtutname">'.$user_name.'</span>
			</div>
			
			
			<div class="aboutme"  >		
			<!--		
				<p class="p1">Gender: ' .$user_gender.'</p>
				<p class="p2">Email: ' .$user_email.'</p>
				<p class="p3">Phone: ' .$user_phone.'</p>
				<p class="p4">Education Background: ' .$user_educationBackground.'</p>
				<p class="p5">Phone: ' .$user_phone.'</p>
			-->
			<ul>
				<li>Gender: ' .$user_gender.'</li>
				<li>Education Background: ' .$user_educationBackground.'</li>
				<li>Email: ' .$user_email.'</li>
				<li>Phone: ' .$user_phone.'</li>
				
			</ul>
			<div>
			
			<div class="description">
			
			</div>
			
			
			<div class="ads">
				<iframe id="ads_video" width="" height="" src="'. $video. '" frameborder="0" allowfullscreen></iframe>
			</div>
		
			
			
		</div>'
		;

}

function get_classMaterial_tutor($vartutID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$vartutID."'";
	$retval =  mysql_query( $sql);
	
	$c =0;
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){		
	
		echo '<div class="classmaterial">';
		
		echo '<p>#'.$c.' Class Name: '.$row['Name'].'</p>';
		
		echo '<form method="post" action="materialDetails.php">
				<input type="hidden" name="cid" value="'.$row['ID'].'"/>
				<input type="hidden" name="cname" value="'.$row['Name'].'"/>
				<input type="submit" value="Details" name="Details">								
			</form>';
		
		
		echo '</div>';
		$c++;
	}
		
	
	/*
	echo '<table id="t01">
			<tr>
				<th>File Name</th>
				<th>File Type</th>		
				<th>Description</th>
				<th>Update Date</th>		
				<th>Accibility</th>
			</tr>';
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){				
		get_material_tutor($row['ID']);
	}
	echo '</tr></table>';
	*/
}

function get_material_tutor($varClassID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM material WHERE classID ='".$varClassID."'";
	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	
	echo '<table id="t01" class="materialtable">
			<tr>
				<th>File Name</th>
					<!--<th>File Type</th>		-->
				<th>Description</th>
				<th>Update Date</th>		
				<th>Accessibility</th>
				<th></th>
			</tr>';
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
		echo '<tr  >';
		echo '<td>'.$row['Name'].'</td>';
		//echo '<td></td>';
		echo '<td>'.$row['description'].'</td>';
		echo '<td>'.$row['UploadDate'].'</td>';
		echo '<td>'.$row['Accessibility'].'</td>';	
		echo '<td>
			<form action="">
				<input type="button" value="Delete"/>			
				
			</form>
			</td>';
			
		/*echo '<a href="TutMan/remStudent.php?sid='.$row['studentID'] .'&cid='.$row['classID'].'">
			Delete
			</a>';
		*/
	}
	echo '</tr></table>';
	
	
	echo '<hr/>';
	
	echo '';
	
}

function get_tutor_request($vartutID){
	$sql = 'SELECT * FROM request WHERE tID ="' . $vartutID . '" AND Choice =""';
	$con = connect_to_database();
	$retval =  mysql_query( $sql);
	
	$c = 0;
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		
		echo '<div class="requestinfo requ1">	';		
		
		/* request title (new version) */
		echo '<div id="poplink" >
				#'. $c.' Student Name : '.get_studentName($row['sID']).' ('.$row['sID'].')
				
				<a href="#popup'.$c.'"  >
				<span class="poplink">Details</span>
				</a>
			</div>
			';
			
			/*
				<button value="Details" style="float:right;">Details</button>
				
				<input type="button" value="Details" onclick=function(){
						document.getElementById("popup1").classList.toggle("hidden");} >
						
				<p  style="font-weight:bold; float: right; background-color: navy; color: white;"
					onclick="function(){
						document.getElementById("dpopup1").classList.toggle("hidden");}">Details</p>
						
				
			*/
			
		echo '<div id="popup'.$c.'" class="overlay">
			<div class="popup">
			<form method="POST" action="handleRequest.php">
			
			
			<h2>#'.$c.' <input type="hidden" name ="sid" value="'.$row['sID'].'"/>'. get_studentName($row['sID']).'</h2>
			
				<a class="close" href="#poplink" style="color: black;font-weight: bold;">&times;</a>';
				
		echo '<div class="content">';
					
		echo '<p>Class Name &nbsp; &nbsp;&nbsp; : 
			<input type="text" name="cname" placeholder="Enter a class name" style="width: 70%; display: inline;"/>
			</p>';		
		
		echo '<p>Time arrange &nbsp;&nbsp;: 
		<input type="hidden" name="Time" value="'.$row['Time'].'"/>'. $row['Time'].'</p>';
		
		echo '<p>Group Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
		<input type="hidden" name ="group" value="'.$row['GroupType'].'"/>';
		
		if($row['GroupType'] === 'S')
			echo 'One-to-one tutorial class';
		else echo 'Group class';
		
		echo '</p>';
		
		echo '<p>Class Type &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; : 
		<input type="hidden" name ="type" value="'.$row['ClassType'].'"/>';
		if($row['ClassType'] === 'PU')
			echo 'Public class';
		else echo 'Private class';
		echo '</p>';
		
		if($row['message'] ===''){echo '<p>No message';}
		else {echo '<p>Message &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;: '. $row['message'] ;}
		
		echo '<input type="hidden" name ="Requestid" value="'.$row['ID'].'"/>';
		
		echo '<input type="text" id="response" name="response" placeholder="message to student" />
			<br/>
			<input type="submit" name="val" value="Accept"/>
			<input type="submit" name="val" value="Reject"/>';	
	
				
		echo '</div>
		
			</form>				
			</div>
		</div>		
		</div>		';
		
		
		/*	old version*/
		/*		
		echo '<div class="requestinfo">
		
			<div class="requesttitle">New Request</div>';
		
		echo '<form method="POST" action="handleRequest.php">';
		
		echo '<div class="msgresponse">
			<p>Student Name : 
			<input type="hidden" name ="sid" value="'.$row['sID'].'"/>'. get_studentName($row['sID']).'</p>';
		
		//echo '<div style="visibility:'.$hidden.';"> ';
		
		echo '<p>Class Name &nbsp; &nbsp;&nbsp; : 
			<input type="text" name="cname" placeholder="Enter a class name" style="width: 70%; display: inline;"/>
			</p>';
		
		echo '<p>Time arrange &nbsp;&nbsp;: 
		<input type="hidden" name="Time" value="'.$row['Time'].'"/>'. $row['Time'].'</p>';
		
		echo '<p>Group Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
		<input type="hidden" name ="group" value="'.$row['GroupType'].'"/>';
		if($row['GroupType'] === 'S')
			echo 'One-to-one tutorial class';
		else echo 'Group class';
		echo '</p>';
		
		echo '<p>Class Type &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; : 
		<input type="hidden" name ="type" value="'.$row['ClassType'].'"/>';
		if($row['ClassType'] === 'PU')
			echo 'Public class';
		else echo 'Private class';
		echo '</p>';
		
		if($row['message'] ===''){echo '<p>No message';}
		else {echo '<p>Message &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;: '. $row['message'] ;}
		/*if($row['ClassType'] === 'PU')
			echo 'public class';
		else echo 'private';*/
		/*
		echo '</p>';
		
		echo '<input type="hidden" name ="Requestid" value="'.$row['ID'].'"/>';
		
		echo '<input type="text" id="response" name="response" placeholder="message to student" />
			<br/>
			<input type="submit" name="val" value="Accept"/>
			<input type="submit" name="val" value="Reject"/>
			
			</div>
			</form>
		</div>';
		*/
	
	$c++;
	}
}

function loop_class_tutor($varTutID){
	$c = 1;
	
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$varTutID."'";
	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		$classname = $row['Name'];
		/*		if ($c%2===0){
			echo '<div class="4u 12u$(mobile)">';
		}			echo '<div class="item student">
				<p style="">'.$classname.'<a href="" style="color:red;float:right">+</a></p>			
				<hr/>';
				echo '<ul>';
				get_studentID($row['ID']);
				echo '</ul>		
			</div>';
		if ($c%2===1){
			echo '</div>';
		}		*/
		
		echo '<div id="classlist" class="classlist" >		
				<div class="requesttitle" >
					#'.$c.': '.$classname.' ('.$row['ID'].') 
				</div>	
			';
				
		echo '	<form method="post" action="editClassParti.php">
					<input type="hidden" name="cid" value="'.$row['ID'].'"/>
					<input type="hidden" name="cname" value="'.$row['Name'].'"/>
					<input type="submit" value="Details" name="partiDetails">								
				</form>
			
			';
					
					
		/*echo	'<a href="TutMan/addStudent.php?cid='.$row['ID'].'" style="color:red;float:right;font-weight: bold;">+</a>
				</div>';
		
				<div>
					<ul>
						get_studentID($row['ID']);
		echo'		</ul>
				</div>';
				*/
		
		echo '</div>';
		$c++;
	}
}

function loop_class_tutorInManage($varTutID){
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$varTutID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	echo '<select name="classID" ><option value="NULL">Select...</option>';
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		echo '<option value="'. $row['ID'].'">' . $row['Name'] . '</option>';
	}
	echo '</select>';
}

function loop_student_tutor_manage($varTutID){
		$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$varTutID."'";
	$retval =  mysql_query( $sql);
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){			$conn = connect_to_database();
		$sql = "SELECT * FROM class_participant WHERE classID ='".$row['ID']."' AND active ='Y'";
		$retval =  mysql_query( $sql);
		if(! $retval ){
			die('Could not get data: ' . mysql_error());
		}	
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
			$conn = connect_to_database();
			$sql = "SELECT * FROM techer_users WHERE user_id ='".$row['studentID'] ."'";
			$retval =  mysql_query( $sql);
			if(! $retval ){
				die('Could not get data: ' . mysql_error());
			}	
			echo '<select name="studID">';
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
						echo '<option value="'. $row['user_name'].'">' . $row['user_name'] . '</option>';
			}
			echo '</select>';
		}
				
		}
	}

function loop_class_upload($varTutID){
	
	$conn = connect_to_database();
	$sql = "SELECT * FROM class WHERE teacherID ='".$varTutID."'";
	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		$classname = $row['Name'];
		$classID = $row['ID'];		
		echo '<option value="'.$classID.'">'.$classname.'</option>';
	}
}


/* view tutor .php*/
function view_tutorialsNumber($varTutID){
	
			$conn = connect_to_database();			 

			$sql  ="SELECT COUNT(ID) AS totalClass
					FROM class 
					WHERE teacherID ='".$varTutID."'";

			$retval =  mysql_query( $sql);
			if(! $retval ){
				die('Could not get data: ' . mysql_error());
			}	
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
				$totalClass = $row['totalClass'];
			}
				//echo $totalClass	;
			$sql2 ="SELECT COUNT(cp.studentID) AS totalStudent
					FROM class_participant cp, class c
					WHERE c.ID = cp.classID
					AND c.teacherID ='".$varTutID."'";
				
			$retval =  mysql_query( $sql2);
			if(! $retval ){
				die('Could not get data: ' . mysql_error());
			}	
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
				$totalStudent = $row['totalStudent'];
			}
				//echo $totalStudent;
			$sql3 ="SELECT COUNT(m.ID) AS totalMaterial
					FROM material m, class c 
					WHERE m.classID = c.ID 
					AND c.teacherID ='".$varTutID."'";
					
			$retval =  mysql_query( $sql3);
			if(! $retval ){
				die('Could not get data: ' . mysql_error());
			}	
			while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
				$totalMaterial = $row['totalMaterial'];
			}
					//echo $totalMaterial;
			
			echo '
			<div class="cont">
			<h2>Ranking Information</h2>	
			
			<ul style="margin-top: 30px;">
				<li>
					Total Classes : '. $totalClass.'
				</li>
				<li>
					Total Students : '.$totalStudent.'
				</li>
				<li>
					Total Material : '.$totalMaterial.'
				</li>
			</ul>
			</div>';
			
}

//retrieve data to tutor portfolio
/*
-req_status: 1=approving, 2=accepted, 3=rejected
-payment_status: 1=unpay, 2=payed
*/
function get_tutor_ads_request($varTutID){ 
	$tableName = "ads_request";
	$columnName = "";
	$condition = 'WHERE user_id ="' . $varTutID . '" order by req_time DESC';
	
	echo '<span class="adsrecord"><table >
	<tr>
	<th>Submit Time</th>
	<th>Video</th>
	<th>Payment Status</th>
	</tr>';

	$result = select($tableName, $columnName, $condition);
	$payment_action = "<form name='payment' action='payment.php' method='post'>Unpayed  
			   <button type='submit' name='pay' id='pay'>Pay Now</button>
			   </form>";
			   
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		/*
		if ($row['req_status'] == '2')
			$ads_status = "Accepted";
		else if ($row['req_status'] == '3')
			$ads_status = "Rejected";
		else 
			$ads_status = "Approving";
		*/
		if ($row['payment_status'] == '2')
			$payment_status = "Payed";
		else 
			$payment_status = $payment_action;
		
		echo  "<tr><td>". $row['req_time']. "</td><td>". $row['req_video']. "</td><td>". $payment_status. "</td></tr>";
		
	}
	
	echo "</table></span>";
}


//admin page function
function loop_message(){
	//$conn = connect_to_database();
	$con = mysql_connect("localhost", "seadmin", "19931113");
	mysql_select_db("seproject");
	$sql = "SELECT * FROM comment WHERE visible ='yes'";
	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		echo '<tr>
			<td>'.$row['name'].'</td>		
			<td>'.$row['comment'].'</td>		
			<td>
				<form action="hideMessage.php" method="POST">
				<input value='.$row['id'].'" name="id" type="hidden"/>
				<input type="submit" value="delete"/>
				</form>
			</td>
		</tr>';
	}
}

function get_all_tutor_ads_request(){  //
	$tableName = "ads_request";
	$columnName = null;
	$condition = 'order by req_time DESC';
	$result = "<table><tr><th>Request ID</th><th>User ID</th><th>Submit Time</th><th>Video</th><th>Ads Status</th><th>Payment Status</th>";
	echo $result;
	$result_query = select($tableName, $columnName, $condition);
	
	$ads_action = "<form action='validateAds.php' method='post'>
			   <button type='submit' name='accept' id='accept'>Accept</button>
			   <button type='submit' name='reject' id='reject'>Reject</button>
			   </form>";
			   
	$payment_action = "<form action='payment.php' method='post'>
			   <button type='submit' name='pay' id='pay'>Pay</button>
			   </form>";
			   
	while ($row = mysql_fetch_array($result_query, MYSQL_ASSOC)){
		if ($row['req_status'] == '2')
			$ads_status = "Accepted";
		else if ($row['req_status'] == '3')
			$ads_status = "Rejected";
		else 
			$ads_status = $ads_action;
		
		if ($row['payment_status'] == '2')
			$payment_status = "Payed";
		else 
			$payment_status = $payment_action;
		
		echo  "<tr><td>". $row['user_id']. "</td><td>". $row['req_time']. "</td><td>". $row['req_video']. "</td><td>". $ads_status. "</td><td>". $payment_status. "</td></tr>";
	}
	
	echo "</table>";
}

function get_admin_menu($vartutID){
	
	$menuItem1 ='Add New User';
	$Item1_url ='adminStage.php#addUser';
	$Item1_html5_link = 'add-link';
	
	$menuItem2 ='Display Users';
	$Item2_url ='adminStage.php#displayUser';
	$Item2_html5_link = 'display-link';  //id
		
	$menuItem3 ='Registration Requests';
	$Item3_url ='adminStage.php#registration';
	$Item3_html5_link = 'registration-link';
	
	$menuItem4 = 'Messages';
	$Item4_url = 'adminStage.php#message';
	$Item4_html5_link = 'message-link';
	
	$menuItem5 = 'Statistics';
	$Item5_url = 'adminStage.php#statistics';
	$Item5_html5_link = 'stat-link';
	
	//$menuItem5 = 'advertisment Requests';
	//$Item5_url = 'adminStage.php#advertisment';
	//$Item5_html5_link = 'ads-link';
	
	$tut_name = get_studentName($vartutID);
	$tut_icon = get_tutorIcon($vartutID);
	
	echo '	<div id="header">

			<div class="top">
				<!-- Back to Home -->
					<div id="bk2hm">
						<!-- back to home page -->
						<a href="index.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home icon2"></span></a>
						<!-- Log out -->
						<a href="logout.php" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-sign-out iconOut">Log Out</span></a>
						<br>							
					</div>

				<!-- Logo -->
					<div id="logo">
						<a href="#about">
						<div>
						<div class="image avatar48 circle_image"><img src="'.$tut_icon.'" alt="" /></div>
						
						
						<h1 id="title">'. $tut_name.'</h1>
						<p style=" font-weight:bold;">Admin
						<!---
						| 
						<a href="changeInfo.php" >Edit</a>
						
						-->
						</p>
						</div>
						</a>
					</div>

				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="'.$Item1_url.'" id="'.$Item1_html5_link.'" class="skel-layers-ignoreHref"><span class="icon  fa-users">'.$menuItem1.'</span></a></li>

						<li><a href="'.$Item2_url.'" id="'.$Item2_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-th">'.$menuItem2.'</span></a></li>
						
						<li><a href="'.$Item3_url.'" id="'.$Item3_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-bell">'.$menuItem3.'</span></a></li>

						<li><a href="'.$Item4_url.'" id="'.$Item4_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-envelope-o">'.$menuItem4.'</span></a></li>
						
						<li><a href="'.$Item5_url.'" id="'.$Item5_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-line-chart">'.$menuItem5.'</span></a></li>';
						
			//echo'<li><a href="'.$Item5_url.'" id="'.$Item5_html5_link.'" class="skel-layers-ignoreHref"><span class="icon fa-th">'.$menuItem5.'</span></a></li>			';
			
			echo '		</ul>
				</nav>
			</div>';
			
			
			echo '</div>';

}

function stats($var){
	$conn = connect_to_database();
	if($var === 'log'){
		$sql = "SELECT count(id) as num FROM log";
	}
	if ($var === 'student'){
		$sql = "SELECT count(user_id) as num FROM techer_users WHERE user_type = 's'";
	}
	if ($var === 'tutor'){
		$sql = "SELECT count(user_id) as num FROM techer_users WHERE user_type = 't'";
	}
	if ($var === 'class'){
		$sql = "SELECT count(ID) as num FROM class";
	}
 	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		echo $row['num'];
	}
	
}



//index page function
function get_random_ads_video(){  //not finished
	//generate a request id
	$array = array();  //correct declaration+initialization?
	$tableName = "ads_request";  
	$columnName = "req_id";   
	$condition = ' where payment_status = 2';
	$size = -1; //count($array);
	$result = select($tableName, $columnName, $condition);
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$size += 1;
		$array[$size] = $row['req_id'];
	}
		
	if (($size + 1) > 0){
		//get ads details
		$index = rand(0, $size);  //random generated, array size function = correct?
		//echo $index;
		$tutorLink = null;
		$userID = null;
		$video = null;
		$image = "images/close.gif";
		$tableName = "ads_request a, techer_users t";  
		$columnName = "a.req_video as video, t.user_id as id";   
		$condition = ' where a.user_id = t.user_id and a.req_id= '. $array[$index];
		//echo $condition;
		//select a.req_video as video, t.user_id as id from ads_request a, techer_users t where a.user_id = t.user_id and a.req_id=1;
		$result = select($tableName, $columnName, $condition);
		
		if ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$video = "ads_video/". $row['video'];
			$userID = $row['id'];
			$tutorLink = '/Techer/viewTutor.php?id=". $userID. "';
			$removeLink = 'javascript: $("#fixedAds").remove()';
			//href not work
			echo '<div id="fixedAds">
			<a href="javascript: $(\'#fixedAds\').remove()">
			<img id="close"  name="close" src="'. $image. '"/>
			</a>
			<div id="tutorLink" href="javascript: window.location.assign(\'/Techer/viewTutor.php?id='. $userID. '\')">
				<div class="ads">
					<iframe id="ads_video"   src="'. $video. '" frameborder="0" allowfullscreen></iframe>
				</div>
						'. get_small_profile($userID). '
					
				</div>
				</div>';	
		} else
			echo "error";
	}
	
}


function get_small_profile($user_id){ 
$out = null;
if (isset($user_id)){
	$link = "";  //default image?
	$userName = "";
	$major = "Math";  //where to get this?
	
	$tableName = "techer_users";  
	$columnName = "icon, user_name";   
	$condition = 'where user_id='. $user_id;
	
	$result = select($tableName, $columnName, $condition);
	
	if ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$link = $row['icon'];
		$userName = $row['user_name'];
	}
	
	$out = '<a href="viewTutor.php?id='. $user_id. '"><div id="profile">
		<img id="user_icon"  src="'. $link. '"/>
		<p>'. $userName. '<br/>'. $major.'</p>
        </div></a>';
}

return $out;
}

function get_map(){
	$user_id = "";
	$user_location = null;
	$otherUser_location = null;
	$target = " to find the nearby teachers";
	$icon = null;
	$major = null; //where to get?
	 
	$tableName = "location"; 
	$columnName = null;
	$condition = "";


	if ((!empty($_SESSION['user_id'])) && (!empty($_SESSION['user_type']))){
		//check whether location table have current user's location
		$user_id = $_SESSION['user_id'];
		$user_type = $_SESSION['user_type'];
		$condition = "where loc_user_id = ". $user_id;
		if ($result = select($tableName, $columnName, $condition)) {
			if ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$user_location = $row['location'];
				$target = " to change your current location";
			}
		} else echo $result;
	} 

	//find other tutors' location *editted
	$condition = "where l.loc_user_type = 't' and l.loc_user_id = t.user_id";
	$tableName = "location l, techer_users t";
	$columnName = "l.loc_user_id, l.location, t.user_name, t.icon";
	if ($result = select($tableName, $columnName, $condition)) {
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$otherUser_location = $row['loc_user_id']. ":". $row['icon']. ":". $row['user_name']. ":". $row['location']. ":". $otherUser_location;
		}
	} else echo $result;
	/*$condition = "where loc_user_type = 't'";
	$tableName = "location";
	$columnName = "loc_user_id, location";
	if ($result = select($tableName, $columnName, $condition)) {
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$otherUser_location = $row['loc_user_id']. ":". $row['location']. ":". $otherUser_location;
		}
	} else echo $result;*/

	echo 
	'<div class="slide" id="slide-4">  
		<div class="row-1">
		<h1 class="title">FIND TEACHERS</h1>
		<div class="row-5">
		<h2 class="subtitle">
		<p class="slide4Text">Click </p>
		<button onClick="findLocation();" class="smallBox" id="start">Start</button>
		
		<p class="slide4Text">'. $target. '</p>  
		</h2>

		<form id="hiddenForm" method="post" action="location.php">
		<input id="user_id" name="user_id" type="text" value="'.$user_id.'">
		<input id="user_location" name="user_location" type="text" value="'.$user_location.'">
		<input id="otherUser_location" name="otherUser_location" type="text" value="'.$otherUser_location.'">
		</form>
		</div><!--end row-5-->
		</div><!--end row-1-->

		<div id="map" style="z-index: 10;"></div>

	</div>';
}

function top_rank(){
	$con = mysql_connect("localhost", "seadmin", "19931113");
	mysql_select_db("seproject");
	$sql = "select tID, avg(rank) from student_rank_totutor group by tID order by avg(rank) desc limit 3";
	
 	$retval =  mysql_query( $sql);
	
	if(! $retval ){
		die('Could not get data: ' . mysql_error());
	}	
	//echo '<p>';
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		//echo '<td>'.'<img src="'.get_small($row['tID']).' " height=80px/><br/.>'.get_studentName($row['tID']).'</td>';
		echo '<p class="rank_user">'.get_small_profile($row['tID']).'</p>';
	}
	echo '</p>';
}

?>