<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donate extends MY_Controller
{
    public $_myLang;

    public function __construct()
    {
        parent::__construct();
        $this->data = array();
        $this->_myLang = $this->session->userdata('site_lang');
    }


    public function index()
    {

        $order_No = time();
        $this->data['order_id'] = $order_No;
        $this->data['payment_description'] = "Consumer Thai";
        $this->data['payment_url'] = C2P_PAYMENT_URL;
        $this->data['result_url_1'] = C2P_RESULT_URL;
        $this->data['version'] = C2P_VERSION;
        $this->data['merchant_id'] = C2P_MERCHANT_ID;
        $this->data['currency'] = C2P_CURRENCY;
        $this->data['secret_key'] = C2P_SECRET_KEY;

        $bath = 25.5;
        $rs = ($bath * 100);
        $amount = sprintf("%'.012d", $rs);

        $this->data['amount'] = $amount;


        $this->setOrderId($order_No);
        $this->setAmount($amount);
        $this->sendParams();

        $hashData = $this->hashValue();
        $this->data['hashdata'] = $hashData;


        $this->load->view('frontend/donate', $this->data);
    }


    public function confirmData2c2p()
    {
        $order_id = "";
        $donate_amount = 0;

        $payment_description = "Consumer Thai";

        if (!is_blank($this->input->get_post('order_no'))) {
            $order_id = trim($this->input->get_post('order_no'));
        }
        if (!is_blank($this->input->get_post('donate_amount'))) {
            $donate_amount = trim($this->input->get_post('donate_amount'));
        }


        $this->setOrderId($order_id);
        $this->setAmount($donate_amount);
        $this->setPaymentDescription($payment_description);
        $this->sendParams();

        $hashData = "";
        $data = array();
        $hashData = $this->hashValue();
        if (!is_blank($hashData)) {
            $data['message'] = $hashData;
        } else {
            $data['error'] = true;
        }


        echo json_encode($data);


    }


    public function paymentBy2c2p()
    {
        /*****/
        $this->load->model($this->donation_model, 'donation');
        $amount_to_db = "0";
        $full_name = "";
        $tel = "";
        $tax_id = "";
        $adress = "";
        $email = "";
        $news_type = "off";
        $news_email = "";
        $payment_type = "";
        $cardholderName = "";
        $donorId = "";
        $title_name = "";
        $created_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $status = 1;
        $paymentChannel = "";
        $donateType = "";
        $bank_transfer = "";

        if (!is_blank($this->input->get_post('money-input'))) {
            $amount_to_db = $this->input->get_post('money-input');
        }
        if (!is_blank($this->input->get_post('name'))) {
            $full_name = $this->input->get_post('name');
        }
        if (!is_blank($this->input->get_post('id'))) {
            $tax_id = $this->input->get_post('id');
        }
        if (!is_blank($this->input->get_post('email'))) {
            $email = trim($this->input->get_post('email'));
        }
        if (!is_blank($this->input->get_post('new-email'))) {
            $news_email = $this->input->get_post('new-email');
        }
        if (!is_blank($this->input->get_post('news-type'))) {
            $news_type = $this->input->get_post('news-type');
        }
        if (!is_blank($this->input->get_post('payment-type'))) {
            $payment_type = $this->input->get_post('payment-type');
        }
        if (!is_blank($this->input->get_post('payment-type'))) {
            $payment_type = $this->input->get_post('payment-type');
        }
        if (!is_blank($this->input->get_post('cardholderName'))) {
            $cardholderName = $this->input->get_post('cardholderName');
        }
        if (!is_blank($this->input->get_post('title_name'))) {
            $title_name = $this->input->get_post('title_name');
        }
        if (!is_blank($this->input->get_post('tel'))) {
            $tel = $this->input->get_post('tel');
        }
        if (!is_blank($this->input->get_post('tax_id'))) {
            $tax_id = $this->input->get_post('tax_id');
        }
        if (!is_blank($this->input->get_post('adress1'))) {
            $address = $this->input->get_post('adress1');
        }

        if (!is_blank($this->input->get_post('donate-type'))) {
            $donateType = trim($this->input->get_post('donate-type'));
        }

        if ($donateType == "type-1") {
            $email = "donationffc@gmail.com";
            $$full_name = "ไม่ประสงค์ออกนาม";
        }


        #Check Donor
        $this->load->model($this->donor_model, 'donor');

        $this->donor->setEmail($email);
        $chk = $this->donor->checkDonor();

        if ($chk) {
            //Donor
            $donorId = $this->donor->getDonorId();
            $data = array();


        } else {
            /** Add New Donor*/
            $this->donor->setTitleName($title_name);
            $this->donor->setFirstName($full_name);
            $this->donor->setEmail($email);
            $this->donor->setAddress($address);
            $this->donor->setTaxNo($tax_id);
            $this->donor->setTel($tel);
            $this->donor->setStatus($status);
            $this->donor->setCreatedDate($created_date);
            $this->donor->setUpdatedDate($updated_date);

            if ($this->donor->create()) {
                $donorId = $this->donor->getDonorId();
            }

        }


        $userData['donorId'] = $donorId;
        $userInv = $this->generateInvoice();


        switch ($payment_type) {
            case "type-1":
                $paymentChannel = "001";
                $merchantID = C2P_MERCHANT_ID;        //Get MerchantID when opening account with 2C2P
                $secretKey = C2P_SECRET_KEY;    //Get SecretKey from 2C2P PGW Dashboard
                //Transaction Information
                $desc = "Donate Consumer Thai";
                $uniqueTransactionCode = time();
                $currencyCode = "764";
                $amt = "000000000010";
                $amount = trim($this->input->get_post('money-input'));
                if (!is_blank($amount)) {
                    $amt = amount2c2p($amount);
                }
                $panCountry = "TH";
                //Customer Information
//        $cardholderName = "John Doe";

                //Encrypted card data
                $encCardData = $_POST['encryptedCardInfo'];

                /**123 Option Channel**/
                //Payment Options
                $paymentChannel = "123";        //Set transaction as Alternative Payment Method
                $agentCode = "AXS";            //APM agent code
                $channelCode = "WEBPAY";            //APM channel code
                $paymentExpiry = (new DateTime('today'))->format("Y-m-d 23:59:59");    //pay slip expiry date (optional). format yyyy-MM-dd HH:mm:ss
                $mobileNo = "81238888";        //customer mobile number
                $cardholderEmail = "demo@2c2p.com";    //customer email address

                //Request Information
//                $version = "9.3";
                $version = "9.9";

                //Construct signature string
//                $stringToHash = $version . $merchantID . $uniqueTransactionCode . $desc . $amt . $currencyCode . $panCountry . $cardholderName . $email . $donorId . $userInv . $email . $encCardData;
//                $hash = strtoupper(hash_hmac('sha1', $stringToHash, $secretKey, false));    //Compute hash value

                //Construct payment request message
                $xml = "<PaymentRequest>
		<version>$version</version> 
		<merchantID>$merchantID</merchantID>
		<uniqueTransactionCode>$uniqueTransactionCode</uniqueTransactionCode>
		<desc>$desc</desc>
		<amt>$amt</amt>
		<currencyCode>$currencyCode</currencyCode>  
		<panCountry>$panCountry</panCountry> 
		<cardholderName>$cardholderName</cardholderName>
		<cardholderEmail>$email</cardholderEmail>
		<userDefined1>$donorId</userDefined1>
		<userDefined2>$userInv</userDefined2>
		<userDefined3>$email</userDefined3>
		<encCardData>$encCardData</encCardData>	  	   	         
	
		</PaymentRequest>";

                //3) Create inner payload
                $paymentPayload = base64_encode($xml); //Convert payload to base64
//                $payload = base64_encode($xml);    //Convert payload to base64

                //4) Generate signature based on inner payload
                $signature = strtoupper(hash_hmac('sha256', $paymentPayload, $secretKey, false));
                $payloadXML = "<PaymentRequest><version>$version</version><payload>$paymentPayload</payload><signature>$signature</signature></PaymentRequest>";
                $payload = base64_encode($payloadXML);


                $this->data['payload'] = $payload;


                $this->load->view('frontend/payload', $this->data);


                break;
            case "type-2":
                /** QR Code**/
                $paymentChannel = "003";
                /** BAnk Transfer**/
                $uniqueTransactionCode = time();
                $resCode = "001";
                $payment_channel = "007";
                $donateCampaignId = "1";
                /**** Create Donation ****/
                $this->load->model($this->donation_model, 'donation');
                $this->donation->setTransectionNo($uniqueTransactionCode);
//        $this->donation->setInvNumber($invoiceNo);
                $this->donation->setAmount($amount_to_db);
                $this->donation->setDonorId($donorId);
                $this->donation->setDonationCampId($donateCampaignId);
                $this->donation->setPaymentStatus($resCode);
                $this->donation->setPaymentChannel($payment_channel);
                $this->donation->setBankName($bank_transfer);

                $this->donation->create();


//                //123 Service
//                $paymentChannel = "001";
//                $merchantID = C2P_MERCHANT_ID;        //Get MerchantID when opening account with 2C2P
//                $secretKey = C2P_SECRET_KEY;    //Get SecretKey from 2C2P PGW Dashboard
//                //Transaction Information
//                $desc = "Donate Consumer Thai";
//                $uniqueTransactionCode = time();
//                $currencyCode = "764";
//                $amt = "000000000010";
//                $amount = trim($this->input->get_post('money-input'));
//                if (!is_blank($amount)) {
//                    $amt = amount2c2p($amount);
//                }
//                $panCountry = "TH";
//
//                $encCardData = $_POST['encryptedCardInfo'];
//                /**123 Option Channel**/
//                //Payment Options
//                $paymentChannel = "123";        //Set transaction as Alternative Payment Method
//                $agentCode = "AXS";            //APM agent code
//                $channelCode = "WEBPAY";            //APM channel code
//                $paymentExpiry = (new DateTime('today'))->format("Y-m-d 23:59:59");    //pay slip expiry date (optional). format yyyy-MM-dd HH:mm:ss
//                $mobileNo = "81238888";        //customer mobile number
//                $cardholderEmail = "demo@2c2p.com";    //customer email address
//
//                //Request Information
//                $version = "9.9";
//                //Construct payment request message
//                $xml = "<PaymentRequest>
//		<version>$version</version>
//		<merchantID>$merchantID</merchantID>
//		<uniqueTransactionCode>$uniqueTransactionCode</uniqueTransactionCode>
//		<desc>$desc</desc>
//		<amt>$amt</amt>
//		<currencyCode>$currencyCode</currencyCode>
//		<panCountry>$panCountry</panCountry>
//		<cardholderName>$cardholderName</cardholderName>
//		<cardholderEmail>$email</cardholderEmail>
//		<userDefined1>$donorId</userDefined1>
//		<userDefined2>$userInv</userDefined2>
//		<userDefined3>$email</userDefined3>
//		<encCardData>$encCardData</encCardData>
//
//		</PaymentRequest>";
//                //3) Create inner payload
//                $paymentPayload = base64_encode($xml); //Convert payload to base64
////                $payload = base64_encode($xml);    //Convert payload to base64
//
//                //4) Generate signature based on inner payload
//                $signature = strtoupper(hash_hmac('sha256', $paymentPayload, $secretKey, false));
//                $payloadXML = "<PaymentRequest><version>$version</version><payload>$paymentPayload</payload><signature>$signature</signature></PaymentRequest>";
//                $payload = base64_encode($payloadXML);
//
//
//                $this->data['payload'] = $payload;
//
//                $this->data['payload'] = $payload;
//
//
//                $this->load->view('frontend/payload', $this->data);
//
//
//                break;


                /// Send Mail to Donor
                $this->load->library('mailer');

                $fullName = "";
                $amountDonate = "";

                $amountDonate = number_format($amount_to_db, 2);

                $templateData = array(
                    'name' => $full_name,
                    'amount' => $amountDonate
                );

                if (!is_blank($email)) {
                    $result = $this->mailer->to($email)->subject("Thank you for Donate")->send("transfer_thankyou.php", compact('templateData'));
                }

                redirect('thankyou');

                break;
            case "type-3":
                /** BAnk Transfer**/
                $uniqueTransactionCode = time();
                $resCode = "001";
                $payment_channel = "006";
                $donateCampaignId = "1";

                /**** Create Donation ****/
                $this->load->model($this->donation_model, 'donation');
                $this->donation->setTransectionNo($uniqueTransactionCode);
//        $this->donation->setInvNumber($invoiceNo);
                $this->donation->setAmount($amount_to_db);
                $this->donation->setDonorId($donorId);
                $this->donation->setDonationCampId($donateCampaignId);
                $this->donation->setPaymentStatus($resCode);
                $this->donation->setPaymentChannel($payment_channel);
                $this->donation->setBankName($bank_transfer);


                $this->donation->create();

                /// Send Mail to Donor
                $this->load->library('mailer');

                $fullName = "";
                $amountDonate = "";

                $amountDonate = number_format($amount_to_db, 2);

                $templateData = array(
                    'name' => $full_name,
                    'amount' => $amountDonate,
                    'email'=>$email,
                    'ref'=>$uniqueTransactionCode,
                    'status'=>"รอการโอนเงิน",
                    'taxId'=>$tax_id,
                    'address'=>$address,
                    'tel'=>$tel,
                    'donate_date'=>$created_date
                );

                if (!is_blank($email)) {
                    $result = $this->mailer->to($email)->subject("Thank you for Donate")->send("transfer_thankyou.php", compact('templateData'));
                }


                redirect('thankyou');


                break;
        }


    }


    public function donateSuccess()
    {

        $this->load->library('Recive2c2p');

        $res = new res2c2p();
        $response = "";

        if (!is_blank($this->input->get_post('paymentResponse'))) {
            $response = $this->input->get_post('paymentResponse');
        }

        /*** API 9.9 **/
        $reponsePayLoadXML = base64_decode($response);
        $xmlObject = simplexml_load_string($reponsePayLoadXML) or die("Error: Cannot create object");

        //Decode payload with base64 to get the Reponse
        $payloadxml = base64_decode($xmlObject->payload);

        //Get the signature from the ResponseXML
        $signaturexml = $xmlObject->signature;

        $merchantID = C2P_MERCHANT_ID;        //Get MerchantID when opening account with 2C2P
        $secretKey = C2P_SECRET_KEY;    //Get SecretKey from 2C2P PGW Dashboard

        $base64EncodedPayloadResponse = base64_encode($payloadxml);

        $signatureHash = strtoupper(hash_hmac('sha256', $base64EncodedPayloadResponse, $secretKey, false));

        //Compare the response signature with payload signature with secretKey
        if ($signaturexml == $signatureHash) {
//            echo "Response :<br/><textarea style='width:100%;height:80px'>". $payloadxml."</textarea>";

            $xml = simplexml_load_string($payloadxml);
            //convert into json
            $json = json_encode($xml);

//convert into associative array
            $xmlArr = json_decode($json, true);


//
//            print_r($xmlArr);
//            print_r($json);
//            exit(0);


            $resCode = "";
            $panCard = "";
            $amt = "";
            $tranRef = "";
            $transection_no = "";
            $dateTime = "";
            $donorId = "";
            $invoiceNo = "";
            $issuerCountry = "";
            $bankName = "";
            $processBy = "";
            $payment_channel = "001";
            $donateCampaignId = 1;
            $email = "";
            $created_date = date('Y-m-d H:i:s');
            $updated_date = date('Y-m-d H:i:s');
            $failReason = "";

            if (is_array($xmlArr)) {
                $resCode = get_array_value($xmlArr, 'respCode', '');
                $panCard = get_array_value($xmlArr, 'pan', '');
                $amt = get_array_value($xmlArr, 'amt', '');
                $tranRef = get_array_value($xmlArr, 'tranRef', '');
                $TransactionCode = get_array_value($xmlArr, 'uniqueTransactionCode', '');
                $dateTime = get_array_value($xmlArr, 'dateTime', '');
                $donorId = get_array_value($xmlArr, 'userDefined1', '');
                $invoiceNo = get_array_value($xmlArr, 'userDefined2', '');
                $email = get_array_value($xmlArr, 'userDefined3', '');
                $issuerCountry = get_array_value($xmlArr, 'issuerCountry', '');
                $bankName = get_array_value($xmlArr, 'bankName', '');
                $processBy = get_array_value($xmlArr, 'processBy', '');
                $failReason = get_array_value($xmlArr, 'failReason', '');
            }

            /**** Create Donation ****/
            $this->load->model($this->donation_model, 'donation');
            $this->donation->setTransectionNo($TransactionCode);
//        $this->donation->setInvNumber($invoiceNo);
            $this->donation->setAmount(amountToDb($amt));
            $this->donation->setDonorId($donorId);
            $this->donation->setDonationCampId($donateCampaignId);
            $this->donation->setPaymentStatus($resCode);
            $this->donation->setPaymentChannel($payment_channel);
            $this->donation->setBankName($bankName);
            $this->donation->setTransferDate($dateTime);
            $this->donation->setPan($panCard);
            $this->donation->setTransRef($tranRef);
            $this->donation->setProcessBy($processBy);
            $this->donation->setIssuerCountry($issuerCountry);
            $this->donation->setNote($failReason);

            $this->donation->create();

            if ($resCode == "00") {
                $this->load->model($this->invoice_model, 'invoice');

                $invoiceNo = $this->generateInvoice();
                $donationId = $this->donation->getDonationId();
                $invoiceStatus = 1;
                $remark = "2c2p";


                $this->invoice->setInvoiceNo($invoiceNo);
                $this->invoice->setDonationId($donationId);
                $this->invoice->setInvoiceStatus($invoiceStatus);
                $this->invoice->setRemark($remark);

                if ($this->invoice->create()) {
                    $invID = $this->invoice->getInvoiceId();
                    $this->donation->setInvoiceId($invID);
                    $this->donation->setInvNumber($invoiceNo);
                    $this->donation->update($donationId);

                    /// Send Mail to Donor
                    $this->load->library('mailer');
                    $pdfFile = $this->generate_invoice($donationId);


                    $fullName = "";
                    $amountDonate = "";

                    $this->load->model($this->donor_model, 'donor');

                    $this->donor->setDonorId($donorId);

                    $doner_info =array();
                    $doner_info = $this->donor->donor_info();
                    $taxId = get_array_value($doner_info,'tax_code','');
                    $cusAddr = get_array_value($doner_info,'address','');
                    $tel = get_array_value($doner_info,'tel','');




                    $fullName = $this->donor->getDonorFirstName();
                    $amountDonate = number_format(amountToDb($amt), 2);


//                    $templateData = array(
//                        'name' => $fullName,
//                        'amount' => $amountDonate,
//                        'invoice_no' => $invoiceNo,
//                        'ref_no' => $TransactionCode,
//                        'date_time' => datetime2display($dateTime)
//                    );
                    $status = "Approved";
                    $channel_payment = "Credit/Debit (2C2P)";
                    $templateData = array(
                        'name' => $fullName,
                        'amount' => $amountDonate,
                        'invoice_no' => $invoiceNo,
                        'ref_no' => $TransactionCode,
                        'bank_name' => $bankName,
                        'status' => $status,
                        'pan' => $panCard,
                        'date_time' => datetime2display($dateTime),
                        'tax_id' => $taxId,
                        'email' => $email,
                        'tel' => $tel,
                        'cus_addr' => $cusAddr,
                        'payment_channel'=>$channel_payment

                    );

                    $fileName = "$invoiceNo.pdf";
                    if (!is_blank($email)) {
                        $result = $this->mailer->to($email)->subject("Thank you for Donate")->setAttachFile($pdfFile, $fileName)->send("thank_you.php", compact('templateData'));

                        if (!$result) {
                            redirect('thankyou');
                        }

                    }

                }


            }

        }

        redirect('thankyou');

    }


} // End of Class
