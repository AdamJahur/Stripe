<?php

include("include/header.php");
include("include/config.php");

if(isset($_REQUEST['card_number'])){
	//For creating token
	try{
		\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

		$token=\Stripe\Token::create(array(
			"card" => array(
				"number" => $_REQUEST['card_number'],
				"exp_month" => $_REQUEST['exp_month'],
				"exp_year" => $_REQUEST['exp_year'],
				"cvc" => $_REQUEST['cvv']
				)
			));
		$token_id=$token->id;
	}
	catch(Exception $e) {
		$_SESSION['error_msg'] = "Error :".$e->getMessage();
	} 
	if(!empty($token_id)){
      	// For create customer
		try{
			

			$charging=\Stripe\Customer::create(array(
				"description" => "create testing customer",
  				"source" => $token_id // obtained with Stripe.js
  				));
			$_SESSION['customer_id']=$charging->id;
		}
		catch(Exception $e) {
			$_SESSION['error_msg'] = "Error :".$e->getMessage();
		} 
	}
	

}
?>

<div class="main-content">


	<form class="form-basic" method="post" action="">

		<div class="form-title-row">
			<h1>Create Cusomer </h1>
		</div>
		<?php

		$msg=$_SESSION['customer_id'];
		$err=$_SESSION['error_msg'];
		if(!empty($msg)){
			echo "<p style='color:green;' >Customer created Successfully . Customer id ".$msg."</p></br>";
			unset($_SESSION['customer_id']);
		}
		if(!empty($err)){
			echo "<p style='color:red;' >".$err."</p></br>";
			unset($_SESSION['error_msg']);
		}
		?>
		<div class="form-row">
			<label>
				<span>Full name</span>
				<input type="text" name="name" required>
			</label>
		</div>

		<div class="form-row">
			<label>
				<span>Card number</span>
				<input type="text" name="card_number" required>
			</label>
		</div>

		<div class="form-row">
			<label>
				<span>Exp Month</span>
				<input type="text" name="exp_month" placeholder="MM(eg:11)" required>
			</label>
		</div>

		<div class="form-row">
			<label>
				<span>Exp Year</span>
				<input type="text" name="exp_year" placeholder="YYYY(eg:2022)" required>
			</label>
		</div>
		<div class="form-row">
			<label>
				<span>cvv</span>
				<input type="text" name="cvv" placeholder="cvv" required>
			</label>
		</div>

		

		
		<div class="form-row">
			<button type="submit" name="submit">Submit Form</button>
		</div>

	</form>

</div>

</body>

</html>