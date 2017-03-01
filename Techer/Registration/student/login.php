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
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from techer_users where user_password='$password' AND user_name='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
	$Type = $query = mysql_query("select user_type from techer_users where user_name='$username' ", $connection);
$_SESSION['login_user']=$username; // Initializing Session
header("location: ../student_portfolio.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>