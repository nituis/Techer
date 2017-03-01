<!DOCTYPE html>

<html>
<head>
<link rel="icon" href="logo.ico">
</head>
<?php
include 'function.php';
connect_to_database(1);
?>

<body>
<?php
$varName = $_POST["name"];
$varEmail = $_POST["email"];
$varComment = $_POST["message"];

echo $varName .'<br>' . $varEmail .'<br>' . $varComment ;

uploadComment($varName, $varEmail, $varComment);
?>

</body>
</html>