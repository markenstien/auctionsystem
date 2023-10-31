<?php 
session_start();
include_once  "db.php";

if(isset($_POST['auction'])){
$auction = htmlentities($_POST['auction']);
$text = htmlentities($_POST['message']);

 
    $sql = "
        SELECT a.*,
        CONCAT(b.fname,' ',b.lname) as userName,
        CONCAT(c.fname,' ',c.lname) as sellerName FROM `auctionchat` as a 
        LEFT JOIN bidder_tbl as b 
        ON a.user = b.id
        LEFT JOIN seller_tbl as c 
        ON a.seller = c.id
        WHERE a.auction='$auction'
        ORDER BY date ASC
    ";

    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

                if($row['seller'] == $_SESSION['id']){
                    echo '<div class="message sent">You: '.$row['text'].'</div>';
                }else{
                    if(isset($row['userName'])){
                        echo '<div class="message ">'.ucwords($row['userName']).': '.$row['text'].'</div>';
                    }else{
                        echo '<div class="message ">'.ucwords($row['sellerName']).': '.$row['text'].'</div>';
                    }
                }            }
            
    
    }
    } else {
    echo "0 results";
}
    

?>