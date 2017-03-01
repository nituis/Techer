<html>
<head>
<link rel="icon" href="logo.ico">
</head>
<body>

<?php
include 'function.php';
connect_to_database(1);
?>

<form method="post" action="thankyou.php" >
<div class="row">
<div class="6u 12u$(mobile)">Name:<input type="text" name="name" placeholder="Name"/>

<div class="6u$ 12u$(mobile)">E-mail:<input type="text" name="email" placeholder="Email"/>
</div>
<div class="12u$">
<textarea name="message" placeholder="Message" value="message"></textarea>
</div>
<div class="12u$">
<input type="submit" value="Send Message" />
</div>
</div>
</form>


</body>
</html>

