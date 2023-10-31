<?php
	session_start();
	include 'db.php'; 
    
  if(isset($_GET['status']) && isset($_GET['id'])){

    $id = htmlentities($_GET['id']);
    $status = htmlentities($_GET['status']);

    $sql = "UPDATE `bidding_access` SET `status` = '$status' WHERE `bidder` = '$id';";
    if ($conn->query($sql) === TRUE) {
      echo "<script>
            alert('Edited Successfully');
            window.location='../bid.php';
      </script>";
    } else {
    echo "<script>alert('Bid Not Added');</script>";
    }

  }

?>