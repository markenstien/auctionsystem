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
    flex-direction:column;
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

   <title> Bidder Auction | EZauction </title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/seller_auction.css">

   <!-- Boxiocns CDN Link -->
   <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
   

   <!----===== Iconscout CSS ===== -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


</head>
<body>
<?php 
  if($_SESSION['position']=="seller"){
    $bidder_id = $_SESSION['id'];
    include_once('include/seller_nav.php');
}else if($_SESSION['position']=="bidder"){
    include_once('include/bidder_nav.php');
}else if($_SESSION['position']=="admin"){
    include_once('include/admin_nav.php');
}
?>


    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

                
            <img src="Images/<?=$_SESSION['image']?>" alt="">
        </div>

      
            <div class="row">
         
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
        /* aaaa */
        /* CSS to make the circular preview */
.preview-container {
    width: 100px; /* Set the width and height of the circular preview */
    height: 100px;
    overflow: hidden; /* Hide overflowing content */
    border-radius: 50%; /* Apply circular border-radius */
    margin-top: 10px; /* Adjust margin as needed */
}

.preview-image {
    width: 100%; /* Make sure the image takes up 100% of the container */
    height: auto; /* Maintain aspect ratio */
    border-radius: 50%; /* Apply circular border-radius */
}

/* CSS to hide the default file input */
#image-upload {
    display: none;
}
/* aaaaaaaaaaaaaa */
.file-label {
    margin-left: 26%;
    margin-top: 5%;
    margin-bottom: 5%;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 2px dashed #3498db; /* Border color for the circular container */
    cursor: pointer;
    overflow: hidden; /* Hide overflowing content */
}

.circle-container {
    width: 100%;
    height: 100%;
    overflow: hidden;
    border-radius: 50%;
}

.preview-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure the image covers the container */
    display: none; /* Initially hide the image */
}

.file-input {
    display: none;
}



    </style>
</head>

        <body>
            <div class="container">
                <?php 
                if($_SESSION['position']=="seller"){
                    $bidder_id = $_SESSION['id'];
                    $sql = "SELECT * FROM seller_tbl WHERE id = '$bidder_id'";
                }else if($_SESSION['position']=="bidder"){
                    $sql = "SELECT * FROM bidder_tbl WHERE id = '$bidder_id'";
                }else if($_SESSION['position']=="admin"){
                    $sql = "SELECT * FROM admin_tbl WHERE id = '$bidder_id'";
                }
                $row = $conn->query($sql)->fetch_assoc();
                ?>
                <form class="form" id="editProfile" enctype="multipart/form-data">
                     <!-- <div class="form-group">
                        <label for="exampleInputName1" class="form-label">Image</label>
                        <input type="file" name="image" placeholder="Image" class="form-control"  >
                    </div> -->
                    <!-- aa -->
                    <label for="exampleInputName1" class="form-label">Profile Picture</label>

                    <label for="file-input" class="file-label">

                        <div class="circle-container">
                            <img id="preview-image" class="preview-image" src="#" alt="Preview">
                        </div>
                    </label>
                    <input type="file" name="image" id="file-input" class="file-input">
                    <!-- aa -->

                     <div class="form-group">
                        <label for="exampleInputName1" class="form-label">First Name</label>
                        <input type="text" name="fname" value="<?=$row['fname']?>" placeholder="First Name" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1" class="form-label">Last Name</label>
                        <input type="text" name="lname" value="<?=$row['lname']?>" placeholder="Last Name" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1" class="form-label">Phone</label>
                        <input type="text" name="phone" value="<?=$row['phone']?>" placeholder="Phone" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1" class="form-label">Password</label>
                        <input type="password" name="password"  placeholder="Password" class="form-control"  >
                    </div>
                    <!-- sss -->
                    <button type="submit" class="btn btn-primary submit">Submit</button>
                </form>
            </div>
        </body>
    </div>
</div>
  
    </section>

    <script src="js/seller_dashboard.js"></script>
    <script src="js/editProfile.js"></script>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // jQuery code
$(document).ready(function() {
    $('#file-input').change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
                $('.preview-image').show(); // Show the image inside the circular container
            };
            reader.readAsDataURL(input.files[0]); // Read the selected file as data URL
        }
    });
});

</script>