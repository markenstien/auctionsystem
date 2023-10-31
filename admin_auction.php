<?php 
	session_start();
	include 'php/db.php';
	$unique_id = $_SESSION['unique_id'];
	$email = $_SESSION['email'];
	$fname = $_SESSION['fname'];
	$bidder_id = $_SESSION['bidder_id'];

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
      $liveID = isset($_GET['id']) ? $_GET['id']:'0';

?>
<style>
/* Styles for the chat container */
.chat-container {
    margin-top: 2%;
    width: 100%;
    height: 80%;
    border-radius: 15px;
    border: 1px solid #ccc;
    overflow-y: auto;
    padding: 10px;
    display: flex;
    flex-direction: column;
}

.message {
    background-color: #f1f1f1;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    max-width: 100%;
    align-self: flex-start;
}

.sent {
    background-color: #2196F3;
    color: white;
    align-self: flex-end;
}
/* Styles for the chat input container */
.chat-input-container {
    display: flex;
    margin-top: 10px;
}

/* Styles for the chat input field */
#message-input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
}

/* Styles for the send button */
button {
    padding: 10px 20px;
    border: none;
    background-color: #11101d;
    color: white;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title> Admin Auction | EZauction </title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/seller_auction.css">

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
                
                        
            </div>

            <div class="column2">
                <div class="viewing">
                    <h2>Live Viewing</h2>
                    <p>Some text..</p>
                </div>
                
                <div class="bott">
                    <div>
                    <div id="refresh-div">
                            </div>
                        <!-- <table border="1" id="show">
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
                        </table> -->
                    </div>
                </div>
            </div>

            <div class="column3">
                <h2>Live Chat</h2>
                <div class="chat-container" id="chat-container">
                    <!-- <div class="message">Hello!</div>
                    <div class="message sent">Hi there!</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div>
                    <div class="message">How can I help you?</div> -->
                </div>
                <form class="form" id="livechat" hidden>
                    <div class="chat-input-container">
                        <input type="text" name="auction" hidden value="<?=$_GET['id']?>" required>
                        <input type="text" name="message" id="message-input" required>
                        <button type="submit" class="submit" id="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="js/seller_dashboard.js"></script>
    
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
      // Function to reload the div content
      function reloadDiv() {
        $('#refresh-div').load('bid_admin.php?id=<?php echo json_encode($liveID);?>'); // Load the content from 'content.php' into the div
      }

      // Reload the div every 2 seconds
      setInterval(reloadDiv, 3000);
    });
  </script>
    <script src="js/allchatadmin.js"></script>
    <script src="js/chatadmin.js"></script>
