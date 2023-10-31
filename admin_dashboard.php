<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title> Admin Dashboard | EZauction </title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/seller_dashboard.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	

	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


</head>
<body>
<?php
	session_start();

include_once('include/admin_nav.php')?>


	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>

			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>

		<div class="dash-content">
			<div class="overview">
				<div class="title">
					<span class="text">Admin Dashboard</span>
				</div>

				<div class="boxes">
					<div class="box box1">
						<i class='bx bx-user'></i>
						<span class="text">Total Bidder</span>
						<?php
							require './php/db.php';
							$query = "SELECT id FROM bidder_tbl";
							$query_run = mysqli_query($conn, $query);
							$row = mysqli_num_rows($query_run);
							echo '<span class="number">' .$row. '</span>';
						?>
					</div>

					<div class="box box2">
						<i class='bx bx-donate-heart'></i>
						<span class="text">Total Seller</span>
						<?php
							require './php/db.php';
							$query = "SELECT id FROM seller_tbl";
							$query_run = mysqli_query($conn, $query);
							$row = mysqli_num_rows($query_run);
							echo '<span class="number">' .$row. '</span>';
						?>
					</div>

					<div class="box box3">
						<i class='bx bx-user-voice' ></i>
						<span class="text">Total Auction</span>
						<?php
							require './php/db.php';
							$query = "SELECT id FROM livestock_tbl";
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