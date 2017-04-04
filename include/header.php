<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Payment Gateway</title>

	<link rel="stylesheet" href="assets/demo.css">
	<link rel="stylesheet" href="assets/form-basic.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script>
	$(document).ready(function(){
		var url      = window.location.href;
		var value = url.substring(url.lastIndexOf('/') + 1);
		$('.menu').each(function(){

       			$(this).find('li').each(function(){
           			var href=$(this).find('a').attr('href');
           			if($.trim(href)==$.trim(value)){

           			$(this).find('a').addClass("active");
           			}
        		});
        		});
	});
	</script>
</head>
<body>


	<header>
		<h1>Payment Gateway</h1>
    </header>

    <ul class="menu">
        <li><a href="Company.php" >Company</a></li>
        <li><a href="Customer.php">Customer</a></li>
    </ul>




