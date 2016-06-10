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
<title>Payment Status</title>
</head>

<body style="background-color:#E2EBEC;">

		<?php
			$status = $data["status"];
			$amount = $data["amount"];
			$storeId = $data["zipcode"];
			$PageSource = $data["address1"];
		?>

<?php if ($status ==  "success") { 
	?>
<div class="col-md-12 col-xs-12" style="background-color: #FFFFFF;width:90%;margin: auto;">
	
	<h1 style="padding:10px 0px 10px 20px;color:#55C334;text-align:center;">Payment Successfull</h1>
		
	<div style="background-color:#FFFFFF;width:100%;float:left;text-align:center;">
		<p style="padding:0px 0px 0px 10px;font-size:20px;"><label>Amount Paid : </label> <b style="color:#55C334;">&#x20B9;<?php echo $amount ?></b></p>
		<p style="text-align:center;color:#8E8E94;">Thank you for using Evezown</p><br>
		<p><a href="<?php echo Config::get('app.evezown_url'); ?>/store/<?php echo $storeId ?>/manage/store_info/<?php echo $PageSource ?>" class="button">Return to Evezown</a></p><br>
	</div>
</div>	
<?php }
else { ?>
		<div class="col-md-12 col-xs-12" style="background-color: #FFFFFF;width:90%;margin: auto;">

			<h1 style="padding:10px 0px 10px 20px;color:#C64727;text-align:center;">Payment Failed</h1>
	
			<p style="padding:0px 10px 10px 20px;color:#8E8E94;text-align:center;">Your payment has been failed! please try again</p>


			<div style="background-color:#FFFFFF;width:100%;float:left;text-align:center;">
				<br><p><a href="<?php echo Config::get('app.evezown_url'); ?>/store/<?php echo $storeId ?>/manage/store_info/<?php echo $PageSource ?>" class="button">Return to Evezown</a></p><br>
			</div>

		</div>
<?php } ?>
</body>
</html>