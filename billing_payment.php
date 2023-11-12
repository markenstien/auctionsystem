<?php 
    /***** IMPORTANT **** !!
     * BIDDER PAGE ONLY
     */
	session_start();
	include 'php/db.php';
	include 'functions/functions.php';

	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
    //bidder ID
    $bidder_id = $_SESSION['bidder_id'];
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title> Bidder <?php echo $fname;?> | EZauction </title>
    <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" i
	ntegrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- custom css file link  -->
    <link rel="stylesheet" href="css/seller_livestock.css">
    
	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	

	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


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
					<span class="text">BIlling and Payments</span>
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
						<th>Status</th>
					</tr>
				</thead>

				<tbody>
					<?php
						$sql = "SELECT a.*, a.id as livestock_id , max_bids.winnerAmmount, max_bids.bid_winner_id, b.fname as 
                        fname,c.address,c.phone,max_bids.bidder_id,  max_bids.is_sent,
                        max_bids.bid_status
						FROM `livestock_tbl` as a 
						LEFT JOIN (
							SELECT bid_status,is_sent,bidder_id,bidding_tbl.id as bid_winner_id, bid_livestock_id, MAX(bid_amount) as winnerAmmount
							FROM bidding_tbl
							GROUP BY bid_livestock_id
						) as max_bids
						ON a.id = max_bids.bid_livestock_id
						LEFT JOIN bidding_tbl as b
						ON a.id = b.bid_livestock_id AND b.bid_amount = max_bids.winnerAmmount
						LEFT JOIN bidding_access as c 
						ON b.bidder_id = c.bidder
						WHERE max_bids.`bidder_id`='$bidder_id'
						AND max_bids.is_sent = true
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
			</div>
		</div>
	</section>
        <script>
            function redirectToWinnerReceipt(bidWinnerId, liveStockId) {
                return window.location = `<?php echo $BASE_URL?>/bid_receipt.php?bidWinnerId=${bidWinnerId}&liveStockId=${liveStockId}&user_role=BIDDER`;
            }
        </script>
</body>
</html>