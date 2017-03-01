<?php
$error='';
session_start(); // Starting Session
// Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "";
}
else
{
echo 1;
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", 'seadmin', '19931113');
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("seproject", $connection);
echo 2;
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from techer_users where user_name='$username' AND user_password=$password'", $connection);
echo 3;
echo $query;
$rows = mysql_num_rows($query);

echo 4;
if ($rows == "1") {
	echo 2;
$Type = mysql_query("select user_type from techer_users where user_name='$username' ", $connection);
echo 2;
echo $Type;
$_SESSION['login_user']=$username; // Initializing Session
if ($Type == 's'){
	echo 5;
header("location: student_portfolio.php");
}
elseif($Type == 't'){
	echo 6;
header("location: student_portfolio.php");
}// Redirecting To Other Page
}
else {
	echo 8;
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>