<?php
    require './php/db.php';
    require './functions/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Admin Dashboard | EZauction </title>
	<!-- custom css file link  -->
	<link rel="stylesheet" href="css/seller_dashboard.css">
	<!-- Boxiocns CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<!----===== Iconscout CSS ===== -->
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style type = "text/css">
        #mediaPrint{
            display: none;
        }
        @media screen {
            p.bodyText {font-family:verdana, arial, sans-serif;}
        }

        @media print {
            section.dashboard{
                display: none;
            }
            nav{
                display: none;
            }
            #mediaPrint{
                display: block;
            }
        }
        @media screen, print {
            p.bodyText {font-size:10pt}
        }
    </style>

</head>
<body>

<?php
    session_start();
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];
    $commissions = getList($conn, 
        "SELECT com.*, pm.amount as pm_amount,
            pm.net_amount as pm_net_amount,
            concat(seller.fname, ' ' ,seller.lname) as seller_name,
            concat(bidder.fname, ' ' ,bidder.lname) as bidder_name
            FROM commissions as com

            LEFT JOIN payments as pm
                ON pm.id = com.payment_id
            LEFT JOIN seller_tbl as seller
                ON seller.id = pm.seller_id
            LEFT JOIN bidder_tbl as bidder
                ON bidder.id = pm.bidder_id
            WHERE date(com.date_time) between 
                '{$startDate}' AND '{$endDate}' "
    );

    $bestBids = getList($conn,
    "SELECT com.*, pm.amount as pm_amount,
        pm.net_amount as pm_net_amount,
        concat(seller.fname, ' ' ,seller.lname) as seller_name,
        concat(bidder.fname, ' ' ,bidder.lname) as bidder_name,
        selling_price, bid_amount
        FROM commissions as com

        LEFT JOIN payments as pm
            ON pm.id = com.payment_id
        LEFT JOIN seller_tbl as seller
            ON seller.id = pm.seller_id
        LEFT JOIN bidder_tbl as bidder
            ON bidder.id = pm.bidder_id
        LEFT JOIN bidding_tbl as btbl
            ON btbl.bid_livestock_id = pm.livestock_id
        LEFT JOIN livestock_tbl 
            ON livestock_tbl.id = btbl.bid_livestock_id
        WHERE date(com.date_time) between 
            '{$startDate}' AND '{$endDate}' 
            AND btbl.bid_status = 5
            
        ORDER BY (livestock_tbl.selling_price - btbl.bid_amount) asc"
    );

    $reportResult = [
        'totalSales' => 0,
        'totalCommissions' => 0,
    ];
    
    if($commissions) {
        foreach($commissions as $key => $row) {
            $reportResult['totalSales'] += $row['pm_amount'];
            $reportResult['totalCommissions'] += $row['net_amount'];
        }
    }
?>

<?php
    include_once('include/admin_nav.php')?>
	<section class="dashboard">
		<div class="top">
			<i class="uil uil-bars sidebar-toggle"></i>
			<img src="Images/<?=$_SESSION['image']?>" alt="">
		</div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <span class="text">Reports</span>
                    <p>Commissions and Sales</p>
                </div>

                <p onclick="print();" style="font-weight: bold; text-decoration:underline;cursort:pointer">Print Report</p>
            </div>

            <div class="content">
                <table class="table table-bordered">
                    <tr>
                        <td>Total Sales</td>
                        <td>Total Commissions</td>
                    </tr>

                    <tr>
                        <td><?php echo number_format($reportResult['totalSales'], 2)?></td>
                        <td><?php echo number_format($reportResult['totalCommissions'], 2)?></td>
                    </tr>

                    <tr>
                        <td colspan="2">Top 10 Best Bidding Result</td>
                    </tr>
                    <tr>
                        <td>Product</td>
                        <td>Seller</td>
                        <td>Bid Winner</td>
                        <td>Sell Price</td>
                        <td>Sold Price</td>
                        <th>Remarks</th>
                    </tr>

                    <?php foreach($bestBids as $key => $row) :?>
                        <tr>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['seller_name']?></td>
                            <td><?php echo $row['bidder_name']?></td>
                            <td><?php echo number_format($row['selling_price'], 2)?></td>
                            <td><?php echo number_format($row['bid_amount'],2)?></td>
                            <td><?php
                                $percentage = (100 - ($row['selling_price'] / $row['bid_amount']) * 100);
                                echo $percentage;
                                if($percentage > 0) {
                                    echo ' Increase ';
                                } elseif($percentage < 0) {
                                    echo ' Decrease ';
                                }
                            ?>%
                            </td>
                        </tr>
                    <?php endforeach?>
                </table>
            </div>
        </div>
	</section>

    <div id="mediaPrint">
        <h4>Commission Report</h4>
        <p>From <?php echo $_GET['start_date'] . ' To ' . $_GET['end_date']?> as of <?php echo date('Y-m-d H:i:s a')?></p>
        <table class="table table-bordered">
            <tr>
                <td>Total Sales</td>
                <td>Total Commissions</td>
            </tr>

            <tr>
                <td><?php echo number_format($reportResult['totalSales'], 2)?></td>
                <td><?php echo number_format($reportResult['totalCommissions'], 2)?></td>
            </tr>

            <tr>
                <td colspan="2">Top 10 Best Bidding Result</td>
            </tr>
            <tr>
                <td>Product</td>
                <td>Seller</td>
                <td>Bid Winner</td>
                <td>Sell Price</td>
                <td>Sold Price</td>
                <th>Remarks</th>
            </tr>

            <?php foreach($bestBids as $key => $row) :?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['seller_name']?></td>
                    <td><?php echo $row['bidder_name']?></td>
                    <td><?php echo number_format($row['selling_price'], 2)?></td>
                    <td><?php echo number_format($row['bid_amount'],2)?></td>
                    <td><?php
                        $percentage = (100 - ($row['selling_price'] / $row['bid_amount']) * 100);
                        echo $percentage;
                        if($percentage > 0) {
                            echo ' Increase ';
                        } elseif($percentage < 0) {
                            echo ' Decrease ';
                        }
                    ?>%
                    </td>
                </tr>
            <?php endforeach?>
        </table>
    </div>
</body>
</html>