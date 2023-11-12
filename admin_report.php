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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php
	session_start();
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
            </div>

            <div class="content">
                <?php if(!isset($_POST['btn_generate_report'])) :?>
                <div style="width: 300px;">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary btn-sm" value="Generate Report" name="btn_generate_report">
                        </div>
                    </form>
                </div>
                <?php endif?>

                <?php if(isset($_POST['btn_generate_report'])) :?>
                    <?php
                        $startDate = $_POST['start_date'];
                        $endDate = $_POST['end_date'];
                        $commissions = getList($conn, 
                            "SELECT com.*, pm.amount as pm_amount,livestock_id,
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
                    ?>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4 class="card-title">Commissions</h4>
                            <a href="admin_report_print.php?start_date=<?php echo $_POST['start_date']?>&end_date=<?php echo $_POST['end_date']?>">Generate Report</a> | 
                            <a href="admin_report.php">Show Form</a>
                        </div>

                        <div class="card-body">
                            <?php if(empty($commissions)) :?>
                                <p>No Commissions Found.</p>
                            <?php else:?>
                                <div class="card-body">
                                    <div style="height: 600px;">
                                        <h4>Net Commission Chart</h4>
                                        <canvas id="myBar"></canvas>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>#</th>
                                            <th>Seller</th>
                                            <th>Bidder</th>
                                            <th>Product</th>
                                            <th>Sold Amount</th>
                                            <th>Commission</th>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $soldAmountTotal = 0;
                                                $commissionTotal = 0;
                                            ?>
                                            <?php foreach($commissions as $key => $com) :?>
                                                <?php $soldAmountTotal += $com['pm_amount']?>
                                                <?php $commissionTotal += $com['net_amount']?>
                                                <tr>
                                                    <td><?php echo ++$key?></td>
                                                    <td><?php echo $com['seller_name']?></td>
                                                    <td><?php echo $com['bidder_name']?></td>
                                                    <td><?php echo $com['name']?></td>
                                                    <td><?php echo number_format($com['pm_amount'], 2)?></td>
                                                    <td><?php echo number_format($com['net_amount'], 2)?></td>
                                                </tr>
                                            <?php endforeach?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><h4><?php echo number_format($soldAmountTotal, 2)?></h4></td>
                                                <td><h4><?php echo number_format($commissionTotal, 2)?></h4></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                <?php endif?>
            </div>
        </div>
	</section>
    <?php
		$pieLabels = [];
		$pieValues = [];

		$barLabels = [];
		$barValues = [];

		foreach($commissions as $key => $row) {
			if(!isset($pieLabels[$row['livestock_id']])) {
				$pieLabels[$row['livestock_id']] = $row['name'];
				$pieValues[$row['livestock_id']] = $row['pm_net_amount'];
			} else {
				$pieValues[$row['livestock_id']] .= $row['pm_net_amount'];
			}
		}

	?>

    <script>
		const barCtx = document.getElementById('myBar');
			let pieLabels = ['<?php echo implode("','", $pieLabels)?>'];
			let pieValues =['<?php echo implode("','", $pieValues)?>'];

			let barLabels = ['<?php echo implode("','", $barLabels)?>'];
			let barValues =['<?php echo implode("','", $barValues)?>'];

			new Chart(barCtx, {
				type: 'bar',
				data: {
					labels: pieLabels,
					datasets: [{
						label: 'total comissions',
						data: pieValues,
						borderWidth: 1
					}],
				}
			});
	</script>
</body>
</html>