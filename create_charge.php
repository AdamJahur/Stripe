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
      	// For charge
	      	try{


			$charging=\Stripe\Charge::create(array(
			  "amount" => $_REQUEST['amount'],
			  "currency" => "usd",
			  "source" => $token_id, 
			  "description" => "Payment for testing"
			));
			$_SESSION['charging_id']=$charging->id;
		}
		catch(Exception $e) {
			$_SESSION['error_msg'] = "Error :".$e->getMessage();
	      	} 
      	}
      	

}
?>


    <div class="main-content">

        <!-- You only need this form and the form-basic.css -->

        <form class="form-basic" method="post" action="">

            <div class="form-title-row">
                <h1>Payment form </h1>
            </div>
	<?php

	$msg=$_SESSION['charging_id'];
	$err=$_SESSION['error_msg'];
	if(!empty($msg)){
		echo "<p style='color:green;' >Amount Paid Successfully . Charge id ".$msg."</p></br>";
		unset($_SESSION['charging_id']);
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
                <label>
                    <span>Amount</span>
                    <input type="text" name="amount" required>
                </label>
            </div>

            
            <div class="form-row">
                <button type="submit" name="submit">Submit Form</button>
            </div>

        </form>

    </div>

</body>

</html>
