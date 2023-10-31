<?php 
	session_start();
	include 'php/db.php';
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	$bidder_id = $_SESSION['bidder_id'];
    // $seller_id = $_SESSION['bidder_id'];

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

   <title> Bidder Auction | EZauction </title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/seller_auction.css">

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

                
            <img src="images/<?=$_SESSION['image']?>" alt="">
        </div>

        <div class="container mt-5" style="text-align: center;">
                    <div class="col-sm-6">
                    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

        <body  style="margin-top:10%">
            <div class="container">
               
    <h1>General Terms and Conditions of Use for EZAuction Website</h1>

<br><h2>1. Acceptance of Terms</h2>
<p>By accessing or using the EZAuction website, you agree to comply with and be bound by these Terms and Conditions. If you do not agree to these terms, please do not use the website.</p>

<br><h2>2. User Account</h2>
<p>
    2.1. You must be 18 years or older to use this service.<br>
    2.2. You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account.
</p>

<br><h2>3. Listings and Bidding</h2>
<p>
    3.1. EZAuction provides a platform for users to create listings and bid on items.<br>
    3.2. All listings must be accurate, legal, and not violate any third-party rights.<br>
    3.3. Bidding on an item is a legally binding contract. If you win a bid, you are obligated to complete the transaction.
</p>

<br><h2>4. Prohibited Activities</h2>
<p>
    4.1. You may not use the EZAuction service for any illegal or unauthorized purpose.<br>
    4.2. You may not interfere with the proper working of the website or engage in any activity that disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of the services.
</p>

<br><h2>5. Disclaimer</h2>
<p>
    5.1. EZAuction is not responsible for the quality, safety, legality, or authenticity of the items listed on the website.<br>
    5.2. EZAuction does not guarantee the accuracy of listings or the ability of sellers to sell items or of buyers to pay for items.
</p>

<br><h2>6. Modifications</h2>
<p>
    6.1. EZAuction reserves the right to modify or revise these Terms and Conditions at any time. Continued use of the website after any such changes shall constitute your consent to such changes.
</p>

<p>These Terms and Conditions were last updated on October 17, 2023.</p>

            </div>
        </body>
    </div>
</div>

    </section>

    <script src="js/seller_dashboard.js"></script>
    
</body>
</html>
