<?php
include '../php/db.php';
$id = $_GET["id"];
$sql = "UPDATE `livestock_tbl` SET `live_status` = '2' WHERE `livestock_tbl`.`id` = '$id';";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: ../seller_livestock.php?msg=Stock Live successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}
