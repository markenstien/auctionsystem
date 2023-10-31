<?php
    session_start();
	use Omnipay\Omnipay;
	include 'php/db.php';
    require 'functions/functions.php';
	require_once 'libraries/vendor/autoload.php';

    $adminPercetangeCut = 23; //cut is 23 percent per sale
    $dateTime = date('Y-m-d H:i:s');
    $req = $_GET;

    $gateway = Omnipay::create('PayPal_Rest');
    $gateway->setClientId($PAYPALCLIENTID);
    $gateway->setSecret($PAYPALCLIENTSECRET);
    $gateway->setTestMode(true);

    /**
     * get the bidinformatiion
     */
     $bidId = $req['bidWinnerId'];
     $liveStockId = $req['liveStockId'];
 
     $bidWinner = getSingle($conn, "
         SELECT * FROM bidding_tbl
             WHERE id = '{$bidId}' 
     ");
 
     $liveStock = getSingle($conn, "
         SELECT * FROM livestock_tbl
             WHERE id = '{$liveStockId}' 
     ");
 
     $bidder = getSingle($conn, "
         SELECT * FROM bidder_tbl
             WHERE id = '{$bidWinner['bidder_id']}' 
     ");
 
     $seller = getSingle($conn, "
         SELECT * FROM seller_tbl
             WHERE id = '{$liveStock['seller_id']}'
     ");

    $headCountText = $liveStock['head_count'] > 3 ? ' x '.$liveStock['head_count'] : '';
	$livestockPurcaseData = "({$liveStock['description']}) {$headCountText}";

    //confirms paypal payment

    if (isset($req['paymentId'], $req['PayerID'])) {

        $transaction = $gateway->completePurchase(array(
            'payer_id' => $req['PayerID'],
            'transactionReference' => $req['paymentId'],
        ));

        $response = $transaction->send();

        if($response->isSuccessful()) {
            $responseData = $response->getData();
            $externalReference = $responseData['id'];

            $amount = $bidWinner['bid_amount'];
            $amounInText = number_format($amount, 2);
            //compute admin cut
            $adminCut = ($adminPercetangeCut/$amount) * 100;
            $adminCutIntext = number_format($adminCut, 2);
            //final amount that will receive by the seller
            $netAmount = $amount - $adminCut;

            $remarks = "
                Admin commission of {$adminCutIntext}({$adminPercetangeCut}%) has been
                    deducted to livestock sold amount {$amount}
            ";
            //store payment
            $paymentDataSQL = "
                INSERT INTO payments(
                    amount,
                    net_amount,
                    internal_remarks,
                    organization,
                    external_reference,
                    bidder_id,
                    seller_id,
                    date_time
                ) VALUES(
                    '{$amount}',
                    '{$netAmount}',
                    '{$remarks}',
                    'PAYPAL',
                    '{$externalReference}',
                    '{$bidder['id']}',
                    '{$seller['id']}',
                    '{$dateTime}'
                )
            ";
            $response = dbexecute($conn,$paymentDataSQL);

            if($response[0]) {
                //save commission data
                $commissionSQL = "
                    INSERT INTO commissions(
                        net_amount,
                        name,
                        payment_id,
                        bidder_id,
                        seller_id,
                        date_time
                    ) VALUES(
                        '{$adminCut}',
                        '{$livestockPurcaseData}',
                        '{$response[1]->insert_id}',
                        '{$bidder['id']}',
                        '{$seller['id']}',
                        '{$dateTime}'
                    )
                ";

                $res = dbexecute($conn,$commissionSQL);
                //update bidding_tbl set status to 5
                $updateBiddingTableSQL = "
                    UPDATE bidding_tbl
                        SET bid_status = 5
                        WHERE id = '{$bidWinner['id']}'
                ";
                dbexecute($conn,$updateBiddingTableSQL);
                return header("Location:billing_payment.php");
            }
        }
    }
?>