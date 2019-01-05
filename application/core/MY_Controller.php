<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{


    public $view_page;
    public $language;

    public $report_model;
    public $donation_model;
    public $mail_model;
    public $donor_model;


    /*** 2c2p *****/
    public $_merchant_id;
    public $_secret_key;
    public $_payment_description;
    public $_order_id;
    public $_currency;
    public $_amount;
    public $_version;
    public $_payment_url;
    public $_result_url;
    public $_params;
    public $_has_value;


    function __construct()
    {
        parent::__construct();


        $this->language = "thai";

        if (!$this->session->userdata('site_lang')) {
            $this->session->set_userdata('site_lang', $this->language);
        }

        $this->view_page = "";

        $this->report_model = "report_model";
        $this->donation_model = "donation_model";
        $this->donor_model = "donor_model";


        /**** 2C2P ***/
        $this->_merchant_id = C2P_MERCHANT_ID;
        $this->_secret_key = C2P_SECRET_KEY;
        $this->_currency = C2P_CURRENCY;
        $this->_order_id = "";
        $this->_version = C2P_VERSION;
        $this->_payment_url = C2P_PAYMENT_URL;
        $this->_result_url = C2P_RESULT_URL;
        $this->_payment_description = "Donate Consumer thai.org";
        $this->_params = "";
        $this->_amount = '000000000000';


    }


    public function sendParams()
    {

        $this->_params = $this->_version . $this->_merchant_id . $this->_payment_description . $this->_order_id . $this->_currency . $this->_amount . $this->_result_url;

        return $this->_params;
    }

    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    public function setPaymentDescription($description)
    {
        $this->_payment_description = $description;
    }

    public function setOrderId($orderId)
    {
        $this->_order_id = $orderId;
    }

    public function hashValue()
    {
        $hash_value = "";
//        $hash_val = hash_hmac('sha1',$this->sendParams(),$this->_secret_key,false);


//        $params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1;
        $params2 = $this->_version . $this->_merchant_id . $this->_payment_description . $this->_order_id . $this->_currency . $this->_amount . $this->_result_url;
        $hash_value = hash_hmac('sha1', $params2, $this->_secret_key, false);


        return $hash_value;
    }


    //create custom Controller
    function page_construct($page, $meta = array(), $data = array())
    {
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['info'] = $this->site->getNotifications();
        $this->load->view('include_header', $meta);
        $this->load->view($page, $data);
        $this->load->view('include_footer', $data);
    }

    public function getUserSession()
    {
        $userSession = $this->session->userdata('userSession');
        return $userSession;
    }

    public function getSessionUserAid()
    {
        $obj = $this->getUserSession();
        return get_array_value($obj, "user_id", "");
    }

    function getSessionUserRoleAid()
    {
        $obj = $this->getUserSession();
        return get_array_value($obj, "user_role_id", "");
    }

    public function is_login()
    {
        $user_aid = $this->getSessionUserAid();
        if ($user_aid != "") {
            return true;
        } else {
            return false;
        }

    }


    public function resizeImage($filename)
    {
        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => 1100,
            'height' => 617
        );


        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        } else {

        }

        $this->image_lib->clear();
    }

    public function do_upload_file()
    {

        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['overwrite'] = TRUE;
//        $config['max_width'] = '1024';
//        $config['max_height'] = '574';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $data = array();

        if (!$this->upload->do_upload('userfile')) {

            $data = array('upload_data' => $this->upload->data(), 'error' => $this->upload->display_errors());
//            $this->load->view('test', $data);

            return $data;

        } else {

            $uploadedImage = $this->upload->data();
            $this->resizeImage($uploadedImage['file_name']);

            $data = array('upload_data' => $this->upload->data(), 'error' => $this->upload->display_errors());
            return $data;
        }


    }


    public function generateInvoice()
    {
        $this->load->model($this->donation_model, 'donation');
        $numId = 0;
        $numId = $this->donation->lastDonationId();
        $numId += 1;
        $inv = str_pad($numId, 6, "0", STR_PAD_LEFT);
        $inv = "FFC" . date("y") . $inv;

        return $inv;
    }


}
