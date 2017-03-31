<?php

include("include/header.php");
include("include/config.php");

?>

<div class="main-content">


	<form class="form-basic" method="post" action="">

		<div class="form-title-row">
			<h1>Simple Stripe checkout</h1>
		</div>
		<?php

		if(!empty($_REQUEST)){
			echo "<p style='color:green;' >Amount Paid Successfully . Token id ".$_REQUEST['stripeToken']."</p></br>";
			
		}
		?>
		<script
		src="https://checkout.stripe.com/checkout.js" class="stripe-button"
		data-key="<?php echo STRIPE_PUBLIC_KEY; ?>" 
		data-amount="999"
		data-name="Product name"
		data-description="Pay the amount for this product"
		data-image="assets/logo.png"
		data-locale="auto">
	</script>
</form>

</div>

</body>

</html>
