<?php 
include 'php/db.php';
require_once 'libraries/vendor/autoload.php';
$id = json_decode($_GET['id'])?>
<table border="1" id="show">
    <thead>
        <tr>
            <th style="text-align: center;">Name</th>
            <th style="text-align: center;">Bid</th>
        </tr>
    </thead>
<tbody>
<?php

$query = "SELECT * FROM bidding_tbl WHERE bid_livestock_id = '$id' ORDER BY bid_amount DESC";

$result = mysqli_query($conn, $query);


while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td style='text-align: center;'>".$row['fname']."</td>";
    echo "<td style='text-align: center;'>".$row['bid_amount']."</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
