<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation_model extends MY_Model
{

    private $_transection_no;
    private $_inv_number;
    private $_amount;
    private $_donor_id;
    private $_donationCampaign_id;
    private $_payment_channel;
    private $_status;
    private $_note;
    private $_createDate;
    private $_updatedDate;
    private $_transferDate;
    private $_bankName;
    private $_pan;
    private $_tranRef;
    private $_processBy;
    private $_issuerCountry;

    public function __construct()
    {
        parent::__construct();

        $this->_note = "";
        $this->_createDate = date('Y-m-d H:i:s');
        $this->_updatedDate = date('Y-m-d H:i:s');


    }

    public function setTransectionNo($transection_no)
    {
        $this->_transection_no = $transection_no;
    }

    public function setInvNumber($invoice_no)
    {
        $this->_inv_number = $invoice_no;
    }

    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    public function setDonorId($doner_id)
    {
        $this->_donor_id = $doner_id;
    }

    public function setDonationCampId($donateCampId)
    {
        $this->_donationCampaign_id = $donateCampId;
    }

    public function setPaymentStatus($status)
    {
        $this->_status = $status;
    }
    public function setPaymentChannel($paymentChanel){
        $this->_payment_channel = $paymentChanel;
    }

    public function setNote($note)
    {
        $this->_note = $note;
    }

    public function setCreatedDate($createDate)
    {
        $this->_createDate = $createDate;
    }

    public function setUpdatedDate($updateDate)
    {
        $this->_updatedDate = $updateDate;
    }

    public function setPaymentId($payment_id)
    {
        $this->_payment_id = $payment_id;
    }

    public function setTransferDate($transferDate)
    {
        $this->_transferDate = $transferDate;
    }
    public function setBankName($bankName){
        $this->_bankName = $bankName;
    }
    public function setPan($cardNumber){
        $this->_pan = $cardNumber;
    }
    public function setTransRef($transRef){
        $this->_tranRef = $transRef;
    }
    public function setProcessBy($processBy){
        $this->_processBy = $processBy;
    }
    public function setIssuerCountry($countryCode){
        $this->_issuerCountry = $countryCode;
    }



    public function create()
    {
        $data = array(
            'transection_no' => $this->_transection_no,
            'inv_number' => $this->_inv_number,
            'amount' => $this->_amount,
            'doner_aid' => $this->_donor_id,
            'donation_campaign_aid' => $this->_donationCampaign_id,
            'payment_channel' => $this->_payment_channel,
            'payment_status' => $this->_status,
            'bankName' => $this->_bankName,
            'pan' => $this->_pan,
            'tranRef' => $this->_tranRef,
            'processBy' => $this->_processBy,
            'issuerCountry' => $this->_issuerCountry,
            'transfer_date' => $this->_transferDate,
            'note' => $this->_note,
            'created_date' => $this->_createDate,
            'updated_date' => $this->_updatedDate
        );

        $this->db->insert($this->tbl_donation, $data);
        if (!is_blank($this->db->insert_id()) && $this->db->insert_id() > 0) {

            return true;
        } else {
            return false;
        }


    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function read()
    {

    }

    public function totalDonate()
    {

    }

    public function lastDonationId()
    {
        $result="";
        $this->db->select_max('aid');
        $query  = $this->db->get($this->tbl_donation);
        $result  = $query->row_array();

        if(is_array($result)){
            $result = get_array_value($result,'aid');
        }

        return $result;



    }


}// end of class
