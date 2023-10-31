<?php 
	session_start();
	include_once  "db.php";
// 	$id = $_SESSION['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = md5($_POST['pass']);
	$cpassword = md5($_POST['cpass']);
	$Role = 'seller';
	$verification_status = '0';

	// checking fields are not empty
	if(!empty($fname) && !empty($lname) && !empty($email) && !empty($phone) && !empty($password) && !empty($cpassword)){
	//if email is valid
	if(filter_var($email,FILTER_VALIDATE_EMAIL)){
		//checking email already exists
		$sql = mysqli_query($conn,"SELECT email FROM seller_tbl WHERE email = '{$email}'");
		if(mysqli_num_rows($sql) > 0){
			echo "$email - Already Exists!";
		}
		else{
			if($password == $cpassword){
			//let's check user upload file or not
			if (isset($_FILES['image'])) {          //if file is uploaded 
			$img_name = $_FILES['image']['name'];       //getting image name
			$img_typ = $_FILES['image']['type'];            //getting image name
			$tmp_name = $_FILES['image']['tmp_name'];   //set temporary name
			$img_explode = explode('.', $img_name);   // let's Explode Image
			$img_extension = end($img_explode);
			$extensions = ['png', 'jpeg', 'jpg'];       //these are some valid extensions

			if(in_array($img_extension,$extensions) === true){
			$time = time();
			$newimagename = $time . $img_name;
			if(move_uploaded_file($tmp_name,"../Images/" . $newimagename)){
				$random_id = rand(time(),10000000);
				$otp =  mt_rand(1111,9999); 
				// let's start insert data into table

				$sql2 = mysqli_query($conn,"INSERT INTO seller_tbl (unique_id, fname, lname, email, phone, password, image,otp,verification_status, Role)
				VALUES ({$random_id},'{$fname}','{$lname}','{$email}','{$phone}','{$password}','{$newimagename}','{$otp}','{$verification_status}','{$Role}')");
				if($sql2){
					$sql3 = mysqli_query($conn,"SELECT * FROM seller_tbl WHERE email = '{$email}'");
					if(mysqli_num_rows($sql3)>0){
					$row = mysqli_fetch_assoc($sql3);
					$_SESSION['id'] = $row['id'];
					$_SESSION['unique_id'] = $row['unique_id'];
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['otp'] = $row['otp'];



					//mail function
					if($otp){
						$receiver = $email;
						$subject = "To: $fname $lname";
						$body = "Name "." $fname $lname  \nEmail:" . " $email \nOTP:" . " $otp";
						$sender = "From: EZauction ezauction2023@gmail.com" ; 
						
						if(mail($receiver, $subject, $body, $sender)){
						echo "success";
						}
						else{
							echo "Email Problem!" . mysqli_error($conn);
						}
					}

					// mail function end
					}
				}
				else {
					echo "Somethings went wrong! " . mysqli_error($conn);
				}
			}
			
			} else {
			echo "Please Select an Profile File - JPEG, PNG, JPG!";
			}
		
		
			}  
			else {
			echo "Please Select an Profile File";
			}
		}
		else{
			echo "Confirm Password Don't Match!";

		}
		}
		
	}
	else {
		echo "$email ~ This is not valid Email!";
	}
	}
	else {
	echo "All Inputs Fields are Required!";
	}
?>
