<?php

include("include/header.php");
include("include/config.php");

try{
		//Get all payment
	\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

	$list=\Stripe\Charge::all(array("limit" => 10));

	$list_array=json_decode(json_encode($list), true);


}
catch(Exception $e) {
	$_SESSION['error_msg'] = "Error :".$e->getMessage();
} 


?>
<style>
	.form-basic{

		max-width: 741px !important;
	}
</style>
<div class="main-content">



	<form class="form-basic" method="post" action="">

		<div class="form-title-row">
			<h1>Payment Listing </h1>
		</div>
		
		<?php
		
		echo "<table><tr>
		<th>Charge id</th>
		<th>Amount</th>
		<th>Customer</th>
		<th>Created</th>
	</tr>";
	if(!empty($list_array['data'])){
		foreach($list_array['data'] as $detail){
			
			echo "<tr><td>".$detail['id']."</td><td>".$detail['amount']."</td><td>".$detail['customer']."</td><td>".date("Y-m-d H-i-s",$detail['created'])."</td></tr>";	
		}
	}
	else{
		
		echo "<tr>Empty</tr>";			
	}
	echo "</table>";
	
	?>
</form>

</div>

</body>

</html>
