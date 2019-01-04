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

    public function setStatus($status)
    {
        $this->_status = $status;
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


    public function create()
    {
        $data = array(
            'transection_no' => $this->_transection_no,
            'inv_number' => $this->_inv_number,
            'amount' => $this->_amount,
            'donor_aid' => $this->_donor_id,
            'donation_campaign_aid' => $this->_donationCampaign_id,
            'payment_channel' => $this->_payment_channel,
            'payment_status' => $this->_status,
            'note' => $this->_note,
            'created_date' => $this->_createDate,
            'updated_date' => $this->_updatedDate,
            'transfer_date' => $this->_transferDate
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
        
    }


}// end of class
