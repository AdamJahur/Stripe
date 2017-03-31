<?php

include("include/header.php");
include("include/config.php");

try{
		//Get account balance
	\Stripe\Stripe::setApiKey(
		STRIPE_SECRET_KEY);

	$balance=\Stripe\Balance::retrieve();

	$balance_array=json_decode(json_encode($balance), true);

	$available=$balance_array['available'];

	$pending=$balance_array['pending'];
}
catch(Exception $e) {
	$_SESSION	['error_msg'] = "Error :".$e->getMessage();
}
?>

<div class="main-content">

	<form class="form-basic" method="post" action="">
		
		<div class="form-title-row">
			<h1>Balance for your stripe account</h1>
		</div>
		<?php
		
		echo "<h2>Available</h2>";
		foreach($available as $detail){
			
			echo "Amount:".$detail['amount']."[".$detail['currency']."]";
		}
		echo "</br><h2>Pending</h2>";
		foreach($pending as $details){
			
			echo "Amount:".$details['amount']."[".$detail['currency']."]";			
		}
		?>
	</form>

</div>

</body>

</html>