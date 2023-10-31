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

	<title> Seller Manage Auction | EZauction </title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/seller_livestock.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

<?php include_once('include/seller_nav.php')?>


	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>

			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>

		<div class="container">
			<?php
				if (isset($_GET["msg"])) {
					$msg = $_GET["msg"];
					echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					' . $msg . '
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				}
			?>
			<a href="add_livestock.php" class="btn btn-dark mb-3"  style="margin-right:60px;">Add Auction</a>

			<div class="table-responsive">
			<table class="table table-hover text-center">
				<thead class="table-dark">
					<tr>
						<th scope="col">LIVE</th>
						<th scope="col">ID</th>
						<th scope="col">Head Count</th>
						<th scope="col">Description</th>
						<th scope="col">Weight</th>
						<th scope="col">Price Per Head</th>
						<th scope="col">Total Weight</th>
						<th scope="col">Selling Price</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
						<!-- <th scope="col">Live Duration</th> -->
					</tr>
				</thead>

				<tbody>
					<?php
						$sql = "SELECT * FROM `livestock_tbl` WHERE seller_id = $seller_id AND live_status !=1";
						$result = mysqli_query($conn, $sql);
						while ($row = mysqli_fetch_assoc($result)) {
							$live = $row["live_status"];
							$liveId = $row["id"];
							$liveEnd = $row["live_end"];
							if(date('Y-m-d H:i:s')>=$liveEnd && $live==2){
								$update = "UPDATE `livestock_tbl` SET `live_status` = '3' WHERE `livestock_tbl`.`id` = '$liveId'";
								mysqli_query($conn, $update);
							}
					?>
						<tr>
							<td><?=($live == 2)?'<a href="seller_auction.php?id='.$liveId.'" class="link-dark"><span class="btn btn-primary me-2">VIEW</span></a>':'' ?></td>
							<td><?=$liveId ?></td>
							<td><?=$row["head_count"] ?></td>
							<td><?=$row["description"] ?></td>
							<td><?=$row["weight"] ?></td>
							<td><?=$row["per_head"] ?></td>
							<td><?=$row["total_weight"] ?></td>
							<td><?=$row["selling_price"] ?></td>
							<td><?=liveStatus($live) ?></td>
							<td>
								<?php 
									if($live == 0){
										echo '<a href="controller/live_start.php?id='.$liveId.'" class="link-dark"><span class="btn btn-success me-2">START</span></a>';
										echo '<a href="controller/live_delete.php?id='.$liveId.'" class="link-dark"><span class="btn btn-danger">CANCEL</span></a>';
									}
									else if($live == 1){
										echo 'Deleted';
									}
									else if($live == 2){
										echo '<a href="controller/live_end.php?id='.$liveId.'" class="link-dark"><span class="btn btn-danger me-2">END</span></a>';
									}
									else if ($live == 3){
										echo 'Live ended';
									}
								?>
								
							</td>
							<!-- <td><?php 
							//$dateTime = new DateTime($liveEnd);
							//echo $dateTime->format("M-d-Y h:i A");?></td> -->
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

</body>

</html>