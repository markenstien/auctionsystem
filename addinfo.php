<pre>
<?php 
	include 'php/db.php';
session_start();
$address = $_POST['address'];
$city = $_POST['city'];
$paypal = $_POST['paypal'];
$phone = $_POST['phone'];
$terms = $_POST['terms'];
$seller = $_POST['seller'];
$bidder_id = $_SESSION['bidder_id'];


$sql = "INSERT INTO `bidding_access` (`id`, `bidder`, `seller`, `address`, `city`, `phone`, `paypal`, `status`)
 VALUES (NULL, '$bidder_id', '$seller', '$address', '$city', '$phone', '$paypal', '0');
";

$result = mysqli_query($conn, $sql);
echo '<script>
window.location.href="bidder_auction.php";
</script>';
?>
