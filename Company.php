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

    	try{
		// Get account balance
		\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

		$balance=\Stripe\Balance::retrieve();

		$balance_array=json_decode(json_encode($balance), true);
		$available=$balance_array['available'];
		$pending=$balance_array['pending'];
	}
	catch(Exception $e) {
        	$_SESSION['error_msg'] = "Error :".$e->getMessage();
      	} 

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

         <form class="form-basic" method="post" action="">

            <div class="form-title-row">
                <h1>Balance for your stripe account </h1>
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
