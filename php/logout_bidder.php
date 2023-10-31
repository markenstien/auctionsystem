<?php 
	session_start();
	if(isset($_SESSION['unique_id'])) {
		include "db.php";
		$logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
		if(isset($logout_id)) {
			session_unset();
			session_destroy();
			header("location: ../login_bidder.php");
		}
		else {
			header("location: ../bidder_feed.php");
		}
	}   
	else {
		header("location: ../login_bidder.php");
	}

?>