<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Payment Redirecting page</title>
</head>
<body>
  <form name="test" method="get" action="http://www.evezown.com/#/evezplace">
  
  		<?php
			$status=$data["status"];
			$amount=$data["amount"];
			$txnid=$data["txnid"];
			$productinfo=$data["productinfo"];
			
			echo "<h1>Thank You. Your order status is ". $status .".</h1>";
			echo "<h3>Your transaction Id is ". $txnid .".</h3>";
			echo "<h4>Amount ". $amount .".</h4>";
			echo "<h5>Product Details ". $productinfo .".</h5>";
		
		?>
  		 
		<input type="submit" value="Return to Evezown" >
  </form>
</body>
</html>