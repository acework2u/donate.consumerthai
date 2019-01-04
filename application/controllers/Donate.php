<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data = array();
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
        $title_name="";
        $created_date = date('Y-m-d H:i:s');
        $updated_date = date('Y-m-d H:i:s');
        $status=1;

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
            $email = $this->input->get_post('email');
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
        if(!is_blank($this->input->get_post('title_name'))){
            $title_name = $this->input->get_post('title_name');
        }
        if(!is_blank($this->input->get_post('tel'))){
            $tel = $this->input->get_post('tel');
        }
        if(!is_blank($this->input->get_post('tax_id'))){
            $tax_id = $this->input->get_post('tax_id');
        }
        if(!is_blank($this->input->get_post('adress1'))){
            $address = $this->input->get_post('adress1');
        }


        print_r($_POST);
        exit();


        #Check Donor
        $this->load->model($this->donor_model, 'donor');
        $chk = $this->donor->checkDonor($email);
        if ($chk) {
            //Donor
            $donorId = $this->donor->getDonorId();
        }else{
            /** Add New Donor*/
            $this->donor->setTitleName($title_name);
            $this->donor->setFirstName($full_name);
            $this->donor->setEmail($email);
            $this->donor->setTel($tel);
            $this->donor->setStatus($status);
            $this->donor->setCreatedDate($created_date);
            $this->donor->setUpdatedDate($updated_date);

            if($this->donor->create()){
                $donorId = $this->donor->getDonorId();
            }

        }


//
//        print_r($_POST);

        echo "Donor ID: ".$donorId;
        exit();


        //Merchant's account information
        # $merchantID = "764764000001745";        //Get MerchantID when opening account with 2C2P
        # $secretKey = "A92FC2236FCB7D94772BBED0560ABB4747B104EC355A97385095A4FD3390ADFB";    //Get SecretKey from 2C2P PGW Dashboard
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

        //Retrieve card information for merchant use if needed
        $maskedCardNo = $_POST['maskedCardInfo'];
        $expMonth = $_POST['expMonthCardInfo'];
        $expYear = $_POST['expYearCardInfo'];

        //Request Information
        $version = "9.3";

        //Construct signature string
        $stringToHash = $version . $merchantID . $uniqueTransactionCode . $desc . $amt . $currencyCode . $panCountry . $cardholderName . $encCardData;
        $hash = strtoupper(hash_hmac('sha1', $stringToHash, $secretKey, false));    //Compute hash value


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
		<encCardData>$encCardData</encCardData>		
	    <cardholderEmail>$email</cardholderEmail>	
	    <userDefined1></userDefined1>
	    <userDefined2></userDefined2>
	    <userDefined3></userDefined3>	   
		<secureHash>$hash</secureHash>
		</PaymentRequest>";
        $payload = base64_encode($xml);    //Convert payload to base64

        $this->data['payload'] = $payload;

        $this->load->view('frontend/payload', $this->data);


    }


    public function donateSuccess()
    {

        $this->load->library('recive2c2p');

        $res = new res2c2p();
        $response = "";

        if (!is_blank($this->input->get_post('paymentResponse'))) {
            $response = $this->input->get_post('paymentResponse');
        }

        $res->setResponse($response);
        $result = $res->getResult();


        //convert xml string into an object
        $xml = simplexml_load_string($result);

//convert into json
        $json = json_encode($xml);

//convert into associative array
        $xmlArr = json_decode($json, true);
        echo "<pre>";
        print_r($xmlArr);
        echo "</pre>";

//        echo "Response:<br/><textarea style='width:100%;height:80px'>". $result."</textarea>";


        /*** Load View **/
        $this->load->view('frontend/thankyou');
    }


    public function demoDonate()
    {
//        $merchant_id = "JT01";			//Get MerchantID when opening account with 2C2P
        $merchant_id = C2P_MERCHANT_ID;            //Get MerchantID when opening account with 2C2P
        $secret_key = C2P_SECRET_KEY;    //Get SecretKey from 2C2P PGW Dashboard

        //Transaction information
        $payment_description = 'Donate for Consomerthai.org';
        $order_id = time();
        $currency = "764"; //THB 764
        // $amount  = '000000002550';
        $bath = 25.5;
        $rs = ($bath * 100);
        $amount = sprintf("%'.012d", $rs);
        // // $amount  = '000000002550';
        // $amount = strval($amount);


        //Request information
        $version = C2P_VERSION;
        $payment_url = C2P_PAYMENT_URL;//"https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
        $result_url_1 = C2P_RESULT_URL;//"http://2c2p-v3.local/result.php";

        //Construct signature string
        $params = $version . $merchant_id . $payment_description . $order_id . $currency . $amount . $result_url_1;
        $hash_value = hash_hmac('sha1', $params, $secret_key, false);    //Compute hash value

        echo 'Payment information:';
        echo '<html> 
	<body>
	<form id="myform" method="post" action="' . $payment_url . '">
		<input type="text" name="version" value="' . $version . '"/>
		<input type="text" name="merchant_id" value="' . $merchant_id . '"/>
		<input type="text" name="currency" value="' . $currency . '"/>
		<input type="text" name="result_url_1" value="' . $result_url_1 . '"/>
		<input type="text" name="hash_value" value="' . $hash_value . '"/>
    PRODUCT INFO : <input type="text" name="payment_description" value="' . $payment_description . '"  readonly/><br/>
		ORDER NO : <input type="text" name="order_id" value="' . $order_id . '"  readonly/><br/>
		AMOUNT: <input type="text" name="amount" value="' . $amount . '" readonly/><br/>
		<input type="submit" name="submit" value="Confirm" />
	</form>  
	
	<script type="text/javascript">
		document.forms.myform.submit();
	</script>
	</body>
	</html>';
    }


} // End of Class
