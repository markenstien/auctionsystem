<?php 
	session_start();
	include 'php/db.php';
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	if(empty($unique_id)) {
		header ("Location: login_admin.php");
	} 

	$qry = mysqli_query($conn, "SELECT * FROM admin_tbl WHERE unique_id = '{$unique_id}'");
	if(mysqli_num_rows($qry) > 0){
		$row = mysqli_fetch_assoc($qry);
		if($row){
			$_SESSION['Role'] = $row['Role'];
			if($row['verification_status'] != 'Verified') {
				header ("Location: verify_admin.php");
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

	<title> Admin Auction | EZauction </title>

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/bidder_feed.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	

	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


</head>
<body>
	<?php include_once('include/admin_nav.php')?>

	
	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>

			
			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>

		<div class="dash-content">
			<div class="overview">
				<div class="title">
					<span class="text">List of Auctions</span>
				</div>

				<?php
							require './php/db.php';
				
							$query = "SELECT a.*,CONCAT(fname,' ',lname) as seller 
							FROM `livestock_tbl` as a 
							LEFT JOIN seller_tbl as b 
							ON a.seller_id = b.id
							WHERE live_status=2";
							$query_run = mysqli_query($conn, $query);
							$counter=0;
							while ($row = $query_run->fetch_array()){
								$seller = $row['seller'];
								$description = $row['description'];
								$id = $row['id'];
								echo '
								<a href="admin_auction.php?id='.$id.'">
									<div class="boxes mb-3" >
										<div class="box box6">
											<i class="bx bx-user"></i>
											<span class="text">'.ucwords($seller).'</span>
										</div>
										<div class="box box5">
											<i class="bx bx-purchase-tag"></i>
											<span class="text">'.ucfirst($description).'</span>
										</div>
										<div class="box box3">
											<i class="bx bx-user-voice" ></i>
											<span class="text">Live Now</span>
										</div>
									</div>
								</a>
								';
								$counter +=1;
							}
							if($counter==0){
								echo '<h3>There is no auction now.</h3>';
							}
						?>
			</div>
		</div>
	</section>
    	<script src="js/bidder_feed.js"></script>
    
</body>
</html>