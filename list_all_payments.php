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