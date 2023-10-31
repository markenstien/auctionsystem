<?php 
	session_start();
	include 'php/db.php';
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
?>

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
					<span class="text">Feeds</span>
				</div>

				<?php
							require './php/db.php';
				
							$query = "SELECT a.*,CONCAT(fname,' ',lname) as seller ,
							 CASE
								WHEN TIMESTAMPDIFF(SECOND, `live_date`, NOW()) <= 60 THEN 'active a minute ago'
								WHEN TIMESTAMPDIFF(MINUTE, `live_date`, NOW()) <= 60 THEN CONCAT(TIMESTAMPDIFF(MINUTE, `live_date`, NOW()), ' minutes ago')
								WHEN TIMESTAMPDIFF(HOUR, `live_date`, NOW()) <= 24 THEN CONCAT(TIMESTAMPDIFF(HOUR, `live_date`, NOW()), ' hours ago')
								ELSE CONCAT(TIMESTAMPDIFF(DAY, `live_date`, NOW()), ' days ago')
							END AS time_ago
							FROM `livestock_tbl` as a 
							LEFT JOIN seller_tbl as b 
							ON a.seller_id = b.id
							WHERE live_status=2
							ORDER BY live_date desc
							";
							$query_run = mysqli_query($conn, $query);
							$counter=0;
							while ($row = $query_run->fetch_array()){
								$seller = $row['seller'];
								$description = $row['description'];
								$id = $row['id'];
								$liveEnd = $row["live_end"];


								if(date('Y-m-d H:i:s')>=$liveEnd){
									$update = "UPDATE `livestock_tbl` SET `live_status` = '3' WHERE `livestock_tbl`.`id` = '$id'";
									mysqli_query($conn, $update);
								}

								echo '
								<a href="bidder_auction.php?id='.$id.'">
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
											<span class="text">Live '.$row['time_ago'].'</span>
										</div>
									</div>
								</a>
								';
								$counter +=1;
							}
							if($counter==0){
								echo '<h3>There is no item in the auction.</h3>';
							}
						?>
			</div>
		</div>
	</section>
    	<script src="js/bidder_feed.js"></script>
    
</body>
</html>