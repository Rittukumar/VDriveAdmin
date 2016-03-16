<!DOCTYPE html>
<html>
<head>
<!--internal style sheet starts-->
<style>
.button {
    position: relative;
    background-color: #f4511e;
    border: none;
    font-size: 16px;
    color: #FFFFFF;
    padding: 15px;
    width: 200px;
    text-align: center;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
}

.button:hover {
    background-color: #804C7F;
    transition: all 0.8s
}
</style>
<!--internal style sheet ends-->
<meta charset="ISO-8859-1">
<title>Payment Redirecting page</title>
</head>

<body style="background-color:#E2EBEC;">

		<?php
			$status=$data["status"];
			$amount=$data["amount"];
			$txnid=$data["txnid"];
			$productinfo=$data["productinfo"];
		?>

<?php if ($status ==  "success") { 
	?>
<div class="col-md-12 col-xs-12" style="background-color: #FFFFFF;width:90%;margin: auto;">
	
	<h1 style="padding:10px 0px 0px 20px;color:#55C334;text-align:center;">Payment Successfull</h1>
	
	<p style="padding:0px 20px 0px 20px;color:#8E8E94;text-align:center;">Your payment has been processed! Details of the transaction are included below:</p>
	
	<div style="background-color:#F5F5F5;width:100%;float:left;text-align:center;">
		<p style="padding:0px 0px 0px 20px;font-size:20px;"><label>Amount Paid : </label> <b style="color:#55C334;">&#x20B9;<?php echo $amount ?></b></p>
	</div>
	<div style="margin-top:120px;text-align:center;">
		<p style="padding:0px 0px 0px 30px;color:#8E8E94;font-size:24px;">You can use the below transaction code to track your order!</p>
		<p style="padding:0px 0px 0px 30px;color:#C64727;font-size:40px;"><?php echo $txnid ?></p>
	</div>
		<p style="text-align:center;color:#8E8E94;">Thank you for shopping with us.</p>

	    <form name="test" method="get" action="http://www.evezown.com/#/evezplace" style="text-align:center">
			<input type="submit" class="button" value="Return to Evezown" style="margin-bottom: 20px;">
	    </form>
</div>
<?php }
else { ?>
		<div class="col-md-12 col-xs-12" style="background-color: #FFFFFF;width:90%;margin: auto;">

			<h1 style="padding:10px 0px 0px 20px;color:#C64727;text-align:center;">Payment Failed</h1>
	
			<p style="padding:0px 20px 0px 20px;color:#8E8E94;text-align:center;">Your payment has been failed! please try again:</p>


			<form name="test" method="get" action="http://www.evezown.com/#/evezplace" style="text-align:center">
			<input type="submit" class="button" value="Return to Evezown" style="margin-bottom: 20px;">
	    	</form>

		</div>
<?php } ?>
</body>
</html>