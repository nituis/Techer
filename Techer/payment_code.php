<?php
/*should reference -> form "payment" in get_tutor_ads_request()
<form name='payment' action='payment.php' method='post'>Unpayed  
			   <button type='submit' name='pay' id='pay'>Pay Now</button>
			   </form>"
*/
session_start();

if (isset($_POST['pay']) && isset($_SESSION['user_id'])){
	
	
}

?>