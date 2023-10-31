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
					<span class="text">Bid Access</span>
					
				</div>
				<?php
					require './php/db.php';
				
							$query = "SELECT a.*,CONCAT(b.fname,' ',b.lname) as name
							FROM `bidding_access` as a  
							LEFT JOIN bidder_tbl as b 
							ON a.bidder = b.id
							WHERE a.status = 0";
							$query_run = mysqli_query($conn, $query);
							$counter=0;
							while ($row = $query_run->fetch_array()){
								
								echo '
								<div class="boxes mb-3">
									<div class="box box3">
										<i class="bx bx-user"></i>
										<span class="text">Name : '.ucwords($row['name']).'</span>
										<span class="text">Paypal : '.ucwords($row['paypal']).'</span>
									</div>
									<div class="box box5">
										<i class="bx bx-directions"></i>
										<span class="text">Address : '.ucwords($row['address'].' , '.$row['city'] ).'</span>
										<span class="text">Phone : '.$row['phone'].' </span>
									</div>

									<div class="box box3" style="padding:2.5%; background:lightblue">
										<a style=" padding: 10px 20px;
										font-size: 16px;
										background-color: #4CAF50;
										color: white;
										border: none;
										border-radius: 5px;
										text-align: center;
										text-decoration: none;
										cursor: pointer;
										transition: background-color 0.3s ease;" href="php/bidedit.php?status=2&id='.$row['bidder'].'">Confirm</a>

										<a style="padding: 10px 20px;
										font-size: 16px;
										background-color: #FF3333; /* Red background color for rejection */
										color: white;
										border: none;
										border-radius: 5px;
										text-align: center;
										text-decoration: none;
										cursor: pointer;
										transition: background-color 0.3s ease;" href="php/bidedit.php?status=3&id='.$row['bidder'].'">Reject</a>
									</div>
									
								</div>
								';


								$counter +=1;
							}
							if($counter==0){
								echo '<h3>There is no pending now.</h3>';
							}
						?>
						
			</div>
		</div>
	</section>
    	<script src="js/bidder_feed.js"></script>
    
</body>
</html>