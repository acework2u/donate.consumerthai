<?php
	$response = $_REQUEST["paymentResponse"];

	include_once('pkcs7.php');
	$pkcs7 = new pkcs7();
//	$response = $pkcs7->decrypt($response,"./keys/demo2.crt","./keys/demo2.pem","2c2p");  // Demo
	$response = $pkcs7->decrypt($response,"./keys/cert.crt","./keys/private.pem","Joe2262527");
	echo "Response:<br/><textarea style='width:100%;height:80px'>". $response."</textarea>";
?>
