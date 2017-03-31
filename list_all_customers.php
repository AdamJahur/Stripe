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