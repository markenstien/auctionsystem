<?php 
session_start();
include_once  "db.php";

//let's check user upload file or not

$image = '';
$password = '';
$fname = htmlentities($_POST['fname']);
$lname = htmlentities($_POST['lname']);
$phone = htmlentities($_POST['phone']);

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
        // let's start insert data into table
         $image =", `image` = '$newimagename'";  
         $_SESSION['image'] = $newimagename;
        }
    }
}

if(isset($_POST['password'])){
    if($_POST['password']!=""){
        $password = md5($_POST['password']);
        $password =", `password` = '$password'";  

    }
}

if($_SESSION['position']=="seller"){
    $bidder_id = $_SESSION['id'];
    $sql = "UPDATE `seller_tbl` SET `fname` = '$fname', `lname` = '$lname', `phone` = '$phone' $image $password WHERE `id` = '$bidder_id'";
}else if($_SESSION['position']=="bidder"){
    $bidder_id = htmlentities($_SESSION['bidder_id']);
    $sql = "UPDATE `bidder_tbl` SET `fname` = '$fname', `lname` = '$lname', `phone` = '$phone' $image $password WHERE `id` = '$bidder_id'";
}else if($_SESSION['position']=="admin"){
    $bidder_id = htmlentities($_SESSION['bidder_id']);
    $sql = "UPDATE `admin_tbl` SET `fname` = '$fname', `lname` = '$lname', `phone` = '$phone' $image $password WHERE `id` = '$bidder_id'";
}

if ($conn->query($sql) === TRUE) {
    echo "200";
  }


?>