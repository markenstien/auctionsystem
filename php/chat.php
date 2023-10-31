<?php 
session_start();
include_once  "db.php";

if(isset($_POST['auction'])){
$auction = htmlentities($_POST['auction']);
$text = htmlentities($_POST['message']);

    if($_SESSION['position']=='seller'){
        $user = htmlentities($_SESSION['id']);
        $sql = "INSERT INTO `auctionchat` (`id`, `seller`, `auction`, `text`, `date`) 
        VALUES (NULL, '$user', '$auction', '$text', current_timestamp())";
        
        if ($conn->query($sql) === TRUE) {
        echo "200";
        } 
    }else{
        $user = htmlentities($_SESSION['bidder_id']);
        $sql = "INSERT INTO `auctionchat` (`id`, `user`, `auction`, `text`, `date`) 
        VALUES (NULL, '$user', '$auction', '$text', current_timestamp())";
        
        if ($conn->query($sql) === TRUE) {
        echo "200";
        } 
    }
}

?>