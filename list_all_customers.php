<?php

include("include/header.php");
include("include/config.php");

try{
		//Get all customers
	\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

	$list=\Stripe\Customer::all(array("limit" => 10));

	$list_array=json_decode(json_encode($list), true);
		//print_r($list_array);

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
			<h1>Customer Listing </h1>
		</div>
		
		<?php
		
		echo "<table><tr>
		<th>Customer id</th>

		<th>Created</th>
	</tr>";
	if(!empty($list_array['data'])){
		foreach($list_array['data'] as $detail){
			
			echo "<tr><td>".$detail['id']."</td><td>".date("Y-m-d H-i-s",$detail['created'])."</td></tr>";	
		}
	}
	else{
		
		echo "Available amount empty";			
	}
	echo "</table>";
	
	?>
</form>

</div>

</body>

</html>