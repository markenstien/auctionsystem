<?php
	
	session_start();
	include 'php/db.php';
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

	if (isset($_POST["submit"])) {
		date_default_timezone_set("Asia/Manila");

		$head_count = $_POST['head_count'];
		$description = $_POST['description'];
		$weight = $_POST['weight'];
		$per_head = $_POST['per_head'];
		$total_weight = $_POST['total_weight'];
		$selling_price = $_POST['selling_price'];
		$seller_id = $_SESSION['id'];
		$live_end = timeConverter($_POST['live_number'],$_POST['live_duration_type']);
		$sql = "INSERT INTO `livestock_tbl`(`id`, `head_count`, `description`, `weight`, `per_head`, `total_weight`, `selling_price`,live_status,`seller_id`,live_end) VALUES (NULL,'$head_count','$description','$weight','$per_head','$total_weight','$selling_price',2, '$seller_id','$live_end')";

		// echo '<pre>';
		// print_r($_POST);
		$result = mysqli_query($conn, $sql);
		if ($result) {
			header("Location: seller_livestock.php?msg=New record created successfully");
		} else {
			echo "Failed: " . mysqli_error($conn);
		}			
			 
	}

	function timeConverter($number, $type){
		if($type == "hr"){
			// Add the number of hours to the current date and time
			return date('Y-m-d H:i:s', strtotime("+$number hours"));
		}
		if($type == "min"){
			// Add the number of minutes to the current date and time
			return date('Y-m-d H:i:s', strtotime("+$number minutes"));
		}
		if($type == "day"){
			// Add the number of days to the current date and time
			return date('Y-m-d H:i:s', strtotime("+$number days"));
		}
	}


	
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/add_livestock.css">

	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>


	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Add Livestock</title>

</head>
<body style="background-color: #E4E9F7;">

		<div class="container d-flex justify-content-center">
			<form action="" method="post">
				<div class="row mb-3">
					<h3>Add Livestock</h3>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Head Count:</label>
						<input required type="text" class="form-control" name="head_count" >
					</div>

					<div class="col">
						<label class="form-label">Description:</label>
						<input required type="text" class="form-control" name="description" >
					</div>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Weight(kg):</label>
						<input required type="text" class="form-control" name="weight" >
					</div>
				
					<div class="col">
						<label class="form-label">Price Per Head:</label>
						<input required type="text" class="form-control" name="per_head" >
					</div>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Total Weight:</label>
						<input required type="text" class="form-control" name="total_weight" >
					</div>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label class="form-label">Selling Price:</label>
						<input required type="text" class="form-control" name="selling_price" >
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-sm-12">
						<label class="form-label">Live Duration:</label>
						<div class="row">
							<div class="col-4">
								<span>Number</span>
								<input type="number" value="1" min="1" max="99999" name="live_number" class="form-control" required>
							</div>
							<div class="col-6">
								<span>Duration</span>
								<select name="live_duration_type" id="" class="form-control" required>
									<option value="">Select Duration Type</option>
									<option value="min">Minute</option>
									<option value="hr">Hour</option>
									<option value="day">Day</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row mb-3">
					<div class="col">
						<button type="submit" class="btn btn-dark" name="submit">Save</button>
						<a href="seller_livestock.php" class="btn btn-danger">Cancel</a>
					</div>
				</div>
			</form>
		</div>

	<!-- Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	<script src="js/seller_dashboard.js"></script>

</body>
</html>