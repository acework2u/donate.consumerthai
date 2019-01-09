<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Invoice_model extends MY_Model{

    private $_invoiceId;
    private $_invoice_no;
    private $_donation_id;
    private $_invoice_status;
    private $_remark;

    public function __construct()
    {
        parent::__construct();
    }

    public function setInvoiceId($invoiceId){
        $this->_invoiceId = $invoiceId;
    }
    public function getInvoiceId(){
        return $this->_invoiceId;
    }
    public function setInvoiceNo($invoiceNo){
        $this->_invoice_no = $invoiceNo;
    }
    public function setDonationId($donationId){
        $this->_donation_id = $donationId;
    }
    public function setInvoiceStatus($status){
        $this->_invoice_status = $status;
    }
    public function setRemark($remark){
        $this->_remark = $remark;
    }

    public function create(){
        $data = array(
            'invoice_no'=>$this->_invoice_no,
            'donation_id'=>$this->_donation_id,
            'invoice_status'=>$this->_invoice_status,
            'remark'=>$this->_remark
        );

        $this->db->insert($this->tbl_donation_invoice,$data);
        if (!is_blank($this->db->insert_id() && $this->db->insert_id() > 0)) {
            $this->setInvoiceId($this->db->insert_id());
            return true;
        } else {
            return false;
        }

    }










} // end of Class
