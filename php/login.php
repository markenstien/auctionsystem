<?php 
	session_start();
	include 'db.php'; 
	$Email = $_POST['email'];
	$Password =  md5($_POST['pass']);

	if(!empty($Email)&& !empty($Password)) {
		$sql = mysqli_query($conn, "SELECT * FROM seller_tbl WHERE email = '{$Email}' AND password = '{$Password}'");
		if(mysqli_num_rows($sql) > 0){
			$row = mysqli_fetch_assoc($sql);
			if($row) {
				$_SESSION['id'] = $row['id'];
				$_SESSION['position'] = 'seller';
				$_SESSION['unique_id'] = $row['unique_id'];
				$_SESSION['fname'] = $row['fname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['otp'] = $row['otp'];
				$_SESSION['image'] = $row['image'];
				echo "success";
			}
		}
		else {
			echo "Email or Password is Incorrect! ";    
		}
	}
	else {
		echo "All Fields are Required!";
	}
?>