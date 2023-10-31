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

      
            <div class="row">
            <?php
                $getData = "SELECT * FROM livestock_tbl where live_status=2 LIMIT 1";
                
                if(isset($_GET['id'])){
                    $id = htmlentities($_GET['id']);
                    $getData = "SELECT * FROM livestock_tbl WHERE id = $id ORDER BY id DESC LIMIT 1";
                }
                error_reporting(0);

                $list = $conn->query($getData);
                $fetch = $list->fetch_assoc();
                if($fetch['id']==""){
                    echo '<script>
                            alert("There is no item in the auction.. Try again later")
                            window.location="bidder_feed.php"
                         </script>';
                }
                $id = htmlentities($fetch['id']);
                $sellerID = htmlentities($fetch['seller_id']);
                ?>



        <?php 
        $sql = "SELECT * FROM `bidding_access` WHERE seller = '$sellerID' AND bidder = '$bidder_id' ";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            ?>
            <div class="column1">
                <h2>Livestock Information</h2>
                <form action="managelivestock.php" method="POST">
                    <div class="form-group">
                        <label for="">Head Count:</label>
                        <br>
                        <input type="text" name="head_count" value='<?php echo $fetch['head_count'] ?>' id="headCount" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Description:</label><br>
                        <input type="text" name="descript" value='<?php echo $fetch['description'] ?>' id="description" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Weight:</label><br>
                        <input type="text" name="weight" value='<?php echo $fetch['weight'] ?>' id="Weight" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Price per Head:</label><br>
                        <input type="text" name="per_head" value='<?php echo $fetch['per_head'] ?>' id="perHead" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Total Weight:</label><br>
                        <input type="text" name="total_weight" value='<?php echo $fetch['total_weight'] ?>' id="totalWeight" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Selling Price:</label><br>
                        <input type="text" name="selling_price" value='<?php echo $fetch['selling_price'] ?>' id="sellingPrice" disabled>
                    </div>
                </form>
                <form action="./php/bidding.php" method="POST">
                <div class="form-group1">
                    <h2 class="ohayo">Bidding</h2>
                    <div class="bakit">
                        <input type="text" name="bid_live" hidden value='<?php echo $fetch['id'] ?>' required>
                        <input type="text" name="bid_amount" placeholder="Enter your bid" id="bid" required>
                        <input type="submit" name="bid_button" id="btn" value="Add Bid">
                    </div>
                </div>
            </form>
                        
            </div>

            <div class="column2">
                <div class="viewing">
                    <h2>Live Viewing</h2>
                    <p>Some text..</p>
                </div>
                
                <div class="bott">
                    <div>
                        <table border="1" id="show">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Bid</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($id!=""){
                                $query = "SELECT * FROM bidding_tbl WHERE id = '$id' ORDER BY bid_amount DESC";
                                    
                                    if(isset($_GET['id'])){
                                        $id = htmlentities($_GET['id']);
                                        $query = "SELECT * FROM bidding_tbl WHERE bid_livestock_id='$id' ORDER BY bid_amount DESC";
                                    }
                                    $result = mysqli_query($conn, $query);
                            
                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td style='text-align: center;'>".$row['fname']."</td>";
                                    echo "<td style='text-align: center;'>".$row['bid_amount']."</td>";
                                    echo "</tr>";
                                }
                            }
                                 
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="column3">
                <h2>Live Chat</h2>
                <p>Some text..</p>
            </div>
        </div>

            <?php }else{?>

                <div class="container mt-5" style="text-align: center;">
                    <div class="col-sm-6">
                    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
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

        <body>
            <div class="container">
                <form method="POST" action="addinfo.php">
                    <div class="form-group">
                        <label for="exampleInputName1" class="form-label">Address</label>
                        <input type="text" name="address" placeholder="Address" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" placeholder="City" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2" class="form-label">Paypal</label>
                        <input type="text" name="paypal" class="form-control" placeholder="Paypal" required >
                    </div>
                    <input type="text" value="<?=$sellerID?>" name="seller" hidden>
                    <div class="form-group">
                        <label for="exampleInputName2" class="form-label">Phone</label>
                        <input type="phone" name="phone" class="form-control" placeholder="Phone Number" required pattern="[0-9]{11}" oninvalid="this.setCustomValidity('Enter 11 Digits Number')"oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="terms" required>
                        <a target="_blank" href="terms.php" style="text-decoration: none; color:black; ">
                        <label class="form-check-label" >I accept the terms and conditions</label>
                        </a>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </body>
    </div>
</div>

        
        <?php }
                ?>
    </section>

    <script src="js/seller_dashboard.js"></script>
    
</body>
</html>
