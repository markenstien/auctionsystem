<?php 
	session_start();
	use Omnipay\Omnipay;
	include 'php/db.php';
    require 'functions/functions.php';
	require_once 'libraries/vendor/autoload.php';
    
    $req = $_GET;
    
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	if(empty($unique_id)) {
		header ("Location: login_bidder.php");
	} 

	$qry = mysqli_query($conn, "SELECT * FROM bidder_tbl WHERE unique_id = '{$unique_id}'");
	if(mysqli_num_rows($qry) > 0){
		$row = mysqli_fetch_assoc($qry);
		if($row){
			$_SESSION['Role'] = $row['Role'];
			if($row['verification_status'] != 'Verified') {
				header ("Location: verify_bidder.php");
			} 
		}
	}

    $bidId = $req['bidWinnerId'];
    $liveStockId = $req['liveStockId'];

	$bidWinner = getSingle($conn, "
		SELECT * FROM bidding_tbl
			WHERE id = '{$bidId}
			ORDER BY bid_amount desc' 
	");

	$liveStock = getSingle($conn, "
		SELECT * FROM livestock_tbl
			WHERE id = '{$liveStockId}' 
	");

	$bidder = getSingle($conn, "
		SELECT * FROM bidder_tbl
			WHERE id = '{$bidWinner['bidder_id']}' 
	");

	$seller = getSingle($conn, "
		SELECT * FROM seller_tbl
			WHERE id = '{$liveStock['seller_id']}'
	");
	
	/**
	 * there is no foreign key id for this table
	 * I used bidder and seller id to get bidder address
	 */
	$biddingAccess = getSingle($conn,"
		SELECT * FROM bidding_access
			WHERE bidder='{$bidder['id']}'
				AND seller='{$seller['id']}'");



				//trigger paypal
	if(isset($_POST['paypal_pay_button'])) {
		$post = $_POST;
		
		$gateway = Omnipay::create('PayPal_Rest');
		$gateway->setClientId($PAYPALCLIENTID);
		$gateway->setSecret($PAYPALCLIENTSECRET);
		$gateway->setTestMode(true);

		$returnURL  = $BASE_URL . "/paypal_response.php?bidWinnerId={$bidId}&liveStockId={$liveStockId}";
		$cancelURL  = $BASE_URL . "/bid_receipt.php?bidWinnerId={$bidId}&liveStockId={$liveStockId}";


		$purchase = $gateway->purchase([
			'amount' => $post['amount'],
			'currency' => 'PHP',
			'name'    => 'COW',
			'returnURL' => $returnURL,
			'cancelURL' => $cancelURL
		])->send();
			
		if ($purchase->isRedirect()) {
			// redirect to offsite payment gateway
			$purchase->redirect();
		} elseif ($purchase->isSuccessful()) {
			// payment was successful: update database
			print_r($purchase);
		} else {
			// payment failed: display message to customer
			echo $purchase->getMessage();
		}
	}

	if(isset($_GET['action'], $_GET['bidWinnerId'], $_GET['liveStockId']) && $_GET['action'] == 'sendReceipt') {
		$response = dbexecute($conn, 
			"UPDATE bidding_tbl set is_sent = true
				WHERE id = '{$bidId}' "
		);
		$_SESSION['message'] = "Bill sent to bid winner";
		return header("Location:seller_bidderwinners.php");
	}
?>

<?php if($req['user_role'] == 'SELLER') :?>
	<?php 
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	$seller_id = $_SESSION['id'];
	if(empty($unique_id)) {
		header ("Location: login.php");
	} 
	$qry = mysqli_query($conn, "SELECT * FROM seller_tbl WHERE unique_id = '{$unique_id}'");
	if(mysqli_num_rows($qry) > 0){
		$row = mysqli_fetch_assoc($qry);
		if($row){
			$_SESSION['Role'] = $row['Role'];
			if($row['verification_status'] != 'Verified') {
				header ("Location: verify.php");
			} 
		}
  	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title> Seller Livestock | EZauction </title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/seller_livestock.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" i
	ntegrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
		integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Manage Livestock</title>
	<style>
			.card-content section {
				border:  1px solid #000;
				margin-top: 50px;
				padding: 20px;
			}
			#Receipt{
				padding: 30px;
				width: 600px;
				margin: 0px auto;
			}

			table tr td{
				padding: 5px;
			}
			table{
				border-collapse: collapse;
			}

			.paypal_btn{
				display: inline-block;
				font-family: inherit;
				font-size: 14px;
				font-weight: bold;
				color: #fff;
				text-align: center;
				padding: 10px 14px;
				margin: 0;
				background: #ff6600;
				border: 0;
				cursor: pointer;
				outline: none;
			}
			.paypal_btn:hover{ background: #e05c04; }
		</style>
</head>
<body>

<?php include_once('include/seller_nav.php')?>
	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>
			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>
		<div class="dash-content">
			<div class="overview">
				<div class="title">
					<span class="text">Congratulation for Bid Winners</span>
				</div>

				<div class="content" style="background-color: #fff;" id="Receipt">
					<div style="margin-bottom:20px">
						<a href="<?php echo $BASE_URL . "/bid_receipt.php?bidWinnerId={$bidId}&liveStockId={$liveStockId}&action=sendReceipt"?>">Send Receipt To Bidder</a>
					</div>
					<?php
						$headCountText = $liveStock['head_count'] > 3 ? ' x '.$liveStock['head_count'] : '';
						$livestockPurcaseData = "({$liveStock['description']}) {$headCountText}";
					?>
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Auction Winner Bidder Receipt Form</h4>
							<p>Ez Auction Receipt for <?php echo $livestockPurcaseData?></p>
							<small>Auctioned Date : <?php echo $liveStock['live_date']?></small>
						</div>

						<div class="card-content">
							<section>
								<strong>Live Stock Details</strong>
								<table class="table table-bordered">
									<tr>
										<td>Weight</td>
										<td>Price Per Head</td>
										<td>Total Weight</td>
										<td>Quantity</td>
									</tr>

									<tr>
										<td><?php echo $liveStock['weight']?></td>
										<td><?php echo $liveStock['per_head']?></td>
										<td><?php echo $liveStock['total_weight']?></td>
										<td><?php echo $liveStock['head_count']?></td>
									</tr>
								</table>
							</section>
							<section>
								<strong>Bidder Info</strong>
								<table class="table table-bordered">
									<tr>
										<td>Bidder Name : </td>
										<td><?php echo $bidder['fname'] . ' '.$bidder['lname']?></td>
									</tr>
									<tr>
										<td>Email : </td>
										<td><?php echo $bidder['email']?></td>
									</tr>
									<tr>
										<td>Phone: </td>
										<td><?php echo $bidder['phone']?></td>
									</tr>
									<?php if($biddingAccess) :?>
										<tr>
											<td>Address : </td>
											<td><?php echo $biddingAccess['address']?></td>
										</tr>
									<?php endif?>
								</table>
							</section>
							

							<section>
								<strong>Seller Info</strong>
								<table class="table table-bordered">
								<tr>
									<td>Seller Name: </td>
									<td><?php echo $seller['fname'] . ' '.$seller['lname']?></td>
								</tr>
								<tr>
									<td>Email: </td>
									<td><?php echo $seller['email']?></td>
								</tr>
								<tr>
									<td>Phone: </td>
									<td><?php echo $seller['phone']?></td>
								</tr>
								<?php if($biddingAccess) :?>
									<tr>
										<td>Address: </td>
										<td><?php echo $biddingAccess['address']?></td>
									</tr>
								<?php endif?>
							</table>
							</section>

							<!-- HIDE THIS ACTION IF NOT THE BIDDER WINNER -->
							<div style="margin-top: 20px;">
								<h4>Auctioned Livestock Selling Price : <?php echo number_format($liveStock['selling_price'], 2)?></h4>
								<h1>Auctioned Amount : <?php echo number_format($bidWinner['bid_amount'],2)?></h1>
								<form action="" method="post"> 
									<!-- Identify your business so that you can collect the payments. --> 
									<input type="hidden" name="business" value="herschelgomez@xyzzyu.com"> 
									<!-- Specify a Buy Now button. --> 
									<input type="hidden" name="cmd" value="_xclick"> 
									<!-- Specify details about the item that buyers will purchase. --> 
									<input type="hidden" name="item_name" value="<?php echo $livestockPurcaseData?>"> 
									<input type="hidden" name="amount" value="<?php echo $bidWinner['bid_amount']?>"> 
									<input type="hidden" name="currency_code" value="USD"> 
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>
<?php else :?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title> Bidder <?php echo $fname;?> | EZauction </title>

		<!-- custom css file link  -->
		<link rel="stylesheet" href="css/bidder_feed.css">

		<!-- Boxiocns CDN Link -->
		<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
		

		<!----===== Iconscout CSS ===== -->
		<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
		<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $PAYPALCLIENTID?>"></script>
		<style>
			.card-content section {
				border:  1px solid #000;
				margin-top: 50px;
				padding: 20px;
			}
			#Receipt{
				padding: 30px;
				width: 600px;
				margin: 0px auto;
			}

			table tr td{
				padding: 5px;
			}
			table{
				border-collapse: collapse;
			}

			.paypal_btn{
				display: inline-block;
				font-family: inherit;
				font-size: 14px;
				font-weight: bold;
				color: #fff;
				text-align: center;
				padding: 10px 14px;
				margin: 0;
				background: #ff6600;
				border: 0;
				cursor: pointer;
				outline: none;
			}
			.paypal_btn:hover{ background: #e05c04; }
		</style>
	</head>
	<body>
		<?php include_once('include/bidder_nav.php')?>
		<section class="dashboard">
			<div class="top">
				<i class="uil uil-bars sidebar-toggle"></i>
				<img src="Images/<?=$_SESSION['image']?>" alt="">
			</div>
			<div class="dash-content">
				<div class="overview">
					<div class="title">
						<span class="text">Congratulation for Bid Winners</span>
					</div>

					<div class="content" style="background-color: #fff;" id="Receipt">
						<?php
							$headCountText = $liveStock['head_count'] > 3 ? ' x '.$liveStock['head_count'] : '';
							$livestockPurcaseData = "({$liveStock['description']}) {$headCountText}";
						?>
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Auction Winner Bidder Receipt Form</h4>
								<p>Ez Auction Receipt for <?php echo $livestockPurcaseData?></p>
								<small>Auctioned Date : <?php echo $liveStock['live_date']?></small>
							</div>

							<div class="card-content">
								<section>
									<strong>Live Stock Details</strong>
									<table class="table table-bordered">
										<tr>
											<td>Weight</td>
											<td>Price Per Head</td>
											<td>Total Weight</td>
											<td>Quantity</td>
										</tr>

										<tr>
											<td><?php echo $liveStock['weight']?></td>
											<td><?php echo $liveStock['per_head']?></td>
											<td><?php echo $liveStock['total_weight']?></td>
											<td><?php echo $liveStock['head_count']?></td>
										</tr>
									</table>
								</section>
								<section>
									<strong>Bidder Info</strong>
									<table class="table table-bordered">
										<tr>
											<td>Bidder Name : </td>
											<td><?php echo $bidder['fname'] . ' '.$bidder['lname']?></td>
										</tr>
										<tr>
											<td>Email : </td>
											<td><?php echo $bidder['email']?></td>
										</tr>
										<tr>
											<td>Phone: </td>
											<td><?php echo $bidder['phone']?></td>
										</tr>
										<?php if($biddingAccess) :?>
											<tr>
												<td>Address : </td>
												<td><?php echo $biddingAccess['address']?></td>
											</tr>
										<?php endif?>
									</table>
								</section>
								

								<section>
									<strong>Seller Info</strong>
									<table class="table table-bordered">
									<tr>
										<td>Seller Name: </td>
										<td><?php echo $seller['fname'] . ' '.$seller['lname']?></td>
									</tr>
									<tr>
										<td>Email: </td>
										<td><?php echo $seller['email']?></td>
									</tr>
									<tr>
										<td>Phone: </td>
										<td><?php echo $seller['phone']?></td>
									</tr>
									<?php if($biddingAccess) :?>
										<tr>
											<td>Address: </td>
											<td><?php echo $biddingAccess['address']?></td>
										</tr>
									<?php endif?>
								</table>
								</section>

								<!-- HIDE THIS ACTION IF NOT THE BIDDER WINNER -->
								<div style="margin-top: 20px;">
									<h4>Auctioned Livestock Selling Price : <?php echo number_format($liveStock['selling_price'], 2)?></h4>
									<h1>Auctioned Amount : <?php echo number_format($bidWinner['bid_amount'],2)?></h1>
									<form action="" method="post"> 
										<!-- Identify your business so that you can collect the payments. --> 
										<input type="hidden" name="business" value="herschelgomez@xyzzyu.com"> 
										<!-- Specify a Buy Now button. --> 
										<input type="hidden" name="cmd" value="_xclick"> 
										<!-- Specify details about the item that buyers will purchase. --> 
										<input type="hidden" name="item_name" value="<?php echo $livestockPurcaseData?>"> 
										<input type="hidden" name="amount" value="<?php echo $bidWinner['bid_amount']?>"> 
										<input type="hidden" name="currency_code" value="USD"> 
										<?php if($bidWinner['bid_status'] == 5) :?>
											<h4>Receipt Paid</h4>
										<?php else:?>
										<!-- Display the payment button. --> 
										<input type="submit" value="Pay with Paypal" 
											name="paypal_pay_button" title="PayPal - The safer, easier way to pay online!" class="paypal_btn">
										<?php endif?>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>
<?php endif?>