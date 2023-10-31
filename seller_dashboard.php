<?php 
	session_start();
	include 'php/db.php';
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
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

	<title> Seller Dashboard <?php echo $fname;?> | EZauction </title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/seller_dashboard.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	

	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


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
					<span class="text">Seller Dashboard</span>
				</div>

				<div class="boxes">
					<div class="box box1">
						<i class='bx bx-user'></i>
						<span class="text">Total Bidder</span>
						<?php
							require './php/db.php';
							$id = $_SESSION['id'];
							$query = "SELECT * FROM `bidding_tbl` as a 
							LEFT JOIN livestock_tbl as b ON a.bid_livestock_id = b.id
							WHERE seller_id='$id' GROUP BY a.bidder_id;
							";
							$query_run = mysqli_query($conn, $query);

							$row = mysqli_num_rows($query_run);

							echo '<span class="number">' .$row. '</span>';

						?>
						
					</div>

					<div class="box box2">
						<i class='bx bx-donate-heart'></i>
						<span class="text">Total Livestock</span>
						<?php 
						$query = "SELECT * FROM `livestock_tbl` WHERE `seller_id` ='$id'";
						$query_run = mysqli_query($conn, $query);

						$row = mysqli_num_rows($query_run);

						echo '<span class="number">' .$row. '</span>';
						?>
					</div>

					<div class="box box3">
						<i class='bx bx-user-voice' ></i>
						<span class="text">Total Sold</span>
						<?php 
						$query = "SELECT * FROM `bidding_tbl` as a 
						LEFT JOIN livestock_tbl as b 
						ON a.bid_livestock_id = b.id 
						WHERE b.seller_id ='$id'
						GROUP BY b.id";
						$query_run = mysqli_query($conn, $query);

						$row = mysqli_num_rows($query_run);

						echo '<span class="number">' .$row. '</span>';
						?>
					</div>
				</div>
			</div>
		</div>
	</section>

    	<script src="js/seller_dashboard.js"></script>
    
</body>
</html>