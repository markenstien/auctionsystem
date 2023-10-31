<?php
	session_start();
	include 'db.php'; 
    
    if(isset($_POST['bid_button'])){
        
        $bid_live = $_POST['bid_live'];
        $bid_amount = $_POST['bid_amount'];
        $bidder_id = $_SESSION['bidder_id'];
        $fname = $_SESSION['fname'];
        
        $query = "INSERT INTO bidding_tbl (bidder_id, fname, bid_amount) VALUES ($bidder_id, '$fname', '$bid_amount')";

        $query ="INSERT INTO `bidding_tbl` (`id`, `bidder_id`, `fname`, `bid_amount`, `bid_livestock_id`, `bid_created`, `bid_status`) VALUES (NULL, '$bidder_id', '$fname', '$bid_amount', '$bid_live', current_timestamp(), '0')";

        if ($conn->query($query) === TRUE) {
          echo "<script>
                alert('Bid Successfully Added');
                window.location='../bidder_auction.php?id=".$bid_live."';
          </script>";
        } else {
        echo "<script>alert('Bid Not Added');</script>";
        }
        
        // print_r($query);
                
    }
?>