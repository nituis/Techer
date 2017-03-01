<?php
if(isset($_GET['str'])){
		$str = $_GET['str'];

		$con = mysql_connect("localhost", "seadmin", "19931113") or die("Could not connect: " . mysql_error());  
		mysql_select_db("seproject");

		$sql = 'SELECT * FROM techer_users WHERE user_type = "t" AND (user_id LIKE "%' .$str. '%" or user_name like"%' .$str. '%" or user_gender like"%' .$str. '%" or user_email like"%' .$str. '%" or user_phone like"%' .$str. '%" or user_educationBackground like"%' .$str. '%")';
		
		$retval =  mysql_query( $sql);
		if(! $retval ){
			die('Could not get data: ' . mysql_error());
		}
		
		echo '<table id="t02" class="sortable">
			<thead>
			<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Education Background</th>
			</tr></thead><tbody>';
		
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){	
			echo '<tr><td>' . $row['user_id']. '</td>' ;
			echo '<td><a href="viewTutor.php?id='.$row['user_id'] . '">' .$row['user_name']. '</a></td>';
			echo '<td>' .$row['user_gender']. '</td>';
			echo '<td>' .$row['user_email']. '</td>';
			echo '<td>' .$row['user_phone']. '</td>';
			echo '<td>' .$row['user_educationBackground']. '</td></tr>';
			
		}

		echo '</tbody></table>';
	
}
echo '<script>
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
	sorter.size(5);</script>';

?>