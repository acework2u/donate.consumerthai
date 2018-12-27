<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data = array();
    }


    public function index(){

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
        $rs = ($bath*100);
        $amount = sprintf("%'.012d", $rs);

        $this->data['amount'] = $amount;


        $this->setOrderId($order_No);
        $this->setAmount($amount);
        $this->sendParams();

        $hashData = $this->hashValue();
        $this->data['hashdata'] =  $hashData;




        $this->load->view('frontend/donate',$this->data);
    }


    public function confirmData2c2p(){
        $order_id = "";
        $donate_amount =0;

        $payment_description = "Consumer Thai";

       if(!is_blank($this->input->get_post('order_no'))){
           $order_id = trim($this->input->get_post('order_no'));
       }
       if(!is_blank($this->input->get_post('donate_amount'))){
           $donate_amount = trim($this->input->get_post('donate_amount'));
       }


        $this->setOrderId($order_id);
        $this->setAmount($donate_amount);
        $this->setPaymentDescription($payment_description);
        $this->sendParams();

        $hashData = "";
        $data = array();
        $hashData = $this->hashValue();
        if(!is_blank($hashData)){
            $data['message'] = $hashData;
        }else{
            $data['error'] = true;
        }


        echo json_encode($data);










    }


    public function demoDonate(){
//        $merchant_id = "JT01";			//Get MerchantID when opening account with 2C2P
        $merchant_id = C2P_MERCHANT_ID;			//Get MerchantID when opening account with 2C2P
        $secret_key = C2P_SECRET_KEY;	//Get SecretKey from 2C2P PGW Dashboard

        //Transaction information
        $payment_description  = 'Donate for Consomerthai.org';
        $order_id  = time();
        $currency = "764"; //THB 764
        // $amount  = '000000002550';
        $bath = 25.5;
        $rs = ($bath*100);
        $amount = sprintf("%'.012d", $rs);
        // // $amount  = '000000002550';
        // $amount = strval($amount);


        //Request information
        $version = C2P_VERSION;
        $payment_url = C2P_PAYMENT_URL;//"https://demo2.2c2p.com/2C2PFrontEnd/RedirectV3/payment";
        $result_url_1 = C2P_RESULT_URL;//"http://2c2p-v3.local/result.php";

        //Construct signature string
        $params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1;
        $hash_value = hash_hmac('sha1',$params, $secret_key,false);	//Compute hash value

        echo 'Payment information:';
        echo '<html> 
	<body>
	<form id="myform" method="post" action="'.$payment_url.'">
		<input type="text" name="version" value="'.$version.'"/>
		<input type="text" name="merchant_id" value="'.$merchant_id.'"/>
		<input type="text" name="currency" value="'.$currency.'"/>
		<input type="text" name="result_url_1" value="'.$result_url_1.'"/>
		<input type="text" name="hash_value" value="'.$hash_value.'"/>
    PRODUCT INFO : <input type="text" name="payment_description" value="'.$payment_description.'"  readonly/><br/>
		ORDER NO : <input type="text" name="order_id" value="'.$order_id.'"  readonly/><br/>
		AMOUNT: <input type="text" name="amount" value="'.$amount.'" readonly/><br/>
		<input type="submit" name="submit" value="Confirm" />
	</form>  
	
	<script type="text/javascript">
		document.forms.myform.submit();
	</script>
	</body>
	</html>';
    }









} // End of Class
