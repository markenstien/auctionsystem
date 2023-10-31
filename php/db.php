<?php 
	date_default_timezone_set("Asia/Manila");

	$conn = new mysqli('localhost','root','','th_ez_auction');
	if(!$conn.mysqli_connect_error()) {
		echo "Connection Denied";
	}

	$BASE_URL = 'http://localhost/thesis/EZauction';
	$PAYPALCLIENTID = "AWRIfZLsLDm6LPcmNh551qLko2SDJFS5EVf1iqHy7eBHDls1eEsEfcSKX64N3kMqVCYHyogSRpTMRCoS";
	$PAYPALCLIENTSECRET = "ELK1rCsE-eZHr1P1_fChBSWIhLleT2VXpA5YzTdqmR9eyrndHBRExT6lZV_UlbrtNUDiEQRlsJbvsFVF";
?>