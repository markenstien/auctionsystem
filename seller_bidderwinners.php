<?php 
	session_start();
	include 'php/db.php';
	include 'functions/functions.php';
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

</head>
<body>

<?php include_once('include/seller_nav.php')?>
	

	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>

			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>

		<div class="container">
			<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead class="table-dark">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Head Count</th>
						<th scope="col">Description</th>
						<th scope="col">Weight</th>
						<th scope="col">Price/Head</th>
						<th scope="col">Total Weight</th>
						<th scope="col">Selling Price</th>
						<th scope="col">Winner</th>
						<th scope="col">Address</th>
						<th scope="col">Contact</th>
						<th scope="col">Amount</th>
						<th scope="col">Payment</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$seller_id = $_SESSION['id'];
						// $sql = "SELECT a.*,MAX(b.bid_amount) as winnerAmmount,b.fname
						// FROM `livestock_tbl` as a 
						// LEFT JOIN bidding_tbl as b 
						// ON a.id = b.bid_livestock_id
						// WHERE `seller_id` ='$seller_id'
						// GROUP BY a.id";

						$sql = "SELECT a.*, a.id as livestock_id , max_bids.winnerAmmount, max_bids.bid_status,
						max_bids.is_sent, max_bids.bid_winner_id, b.fname as fname,c.address,c.phone
						FROM `livestock_tbl` as a 
						LEFT JOIN (
							SELECT is_sent,bid_status,bidding_tbl.id as bid_winner_id, bid_livestock_id, MAX(bid_amount) as winnerAmmount
							FROM bidding_tbl
							GROUP BY bid_livestock_id
						) as max_bids
						ON a.id = max_bids.bid_livestock_id
						LEFT JOIN bidding_tbl as b
						ON a.id = b.bid_livestock_id AND b.bid_amount = max_bids.winnerAmmount
						LEFT JOIN bidding_access as c 
						ON b.bidder_id = c.bidder
						WHERE a.`seller_id`='$seller_id' 
						";

						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$live = $row["live_status"];
							$liveId = $row["id"];
							$fname = isset($row["fname"]) ? $row["fname"]:'N/A';
					?>
						<tr class="trClick"
							onclick="redirectToWinnerReceipt('<?php echo $row['bid_winner_id']?>', '<?php echo $row['livestock_id']?>')">
							<td><?=$liveId ?></td>
							<td><?=$row["head_count"] ?></td>
							<td><?=$row["description"] ?></td>
							<td><?=$row["weight"] ?></td>
							<td><?=$row["per_head"] ?></td>
							<td><?=$row["total_weight"] ?></td>
							<td><?=$row["selling_price"] ?></td>
							<td><?=  ucwords($fname) ?></td>
							<td><?=  ucwords($row['address']) ?></td>
							<td><?=  ucwords($row['phone']) ?></td>
							<td>P <?=number_format($row["winnerAmmount"]); ?></td>
							<td><?php echo ($row['bid_status'] == 5) ? 'PAID': 'UNPAID'?></td>
						</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			</div>
		</div>

	</section>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="js/seller_dashboard.js"></script>
	<script defer>
		function redirectToWinnerReceipt(bidWinnerId, liveStockId) {
			return window.location = `<?php echo $BASE_URL?>/bid_receipt.php?bidWinnerId=${bidWinnerId}&liveStockId=${liveStockId}`;
		}
	</script>
</body>

</html>