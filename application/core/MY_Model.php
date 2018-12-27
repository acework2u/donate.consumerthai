<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public $db2;
    public $tbl_users;
    public $tbl_cus_group;
    public $tbl_donation;
    public $tbl_donation_campaign;
    public $tbl_donor;
    public $tbl_payment_code;
    public $tbl_user_role;
    public $tbl_payment_channel;




    public function __construct()
    {
        $this->tbl_users = "users";
        $this->tbl_cus_group = "cus_group";
        $this->tbl_donation = "donation";
        $this->tbl_donation_campaign = "donation_campaign";
        $this->tbl_donor = "donor";
        $this->tbl_user_role = "user_role";
        $this->tbl_payment_code = "payment_code";
        $this->tbl_payment_channel = "payment_channel";

    }





} //End of Model


?>
