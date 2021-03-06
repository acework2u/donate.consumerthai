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
    private $_donationId;
    private $_invoiceId;
    private $_fillter;


    public function __construct()
    {
        parent::__construct();

        $this->_note = "";
        $this->_createDate = date('Y-m-d H:i:s');
        $this->_updatedDate = date('Y-m-d H:i:s');


    }

    public function setFillter($filter_search)
    {
        $this->_fillter = $filter_search;
    }


    public function setDonationId($donationId)
    {
        $this->_donationId = $donationId;
    }

    public function getDonationId()
    {
        return $this->_donationId;
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

    public function setPaymentChannel($paymentChanel)
    {
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

    public function setBankName($bankName)
    {
        $this->_bankName = $bankName;
    }

    public function setPan($cardNumber)
    {
        $this->_pan = $cardNumber;
    }

    public function setTransRef($transRef)
    {
        $this->_tranRef = $transRef;
    }

    public function setProcessBy($processBy)
    {
        $this->_processBy = $processBy;
    }

    public function setIssuerCountry($countryCode)
    {
        $this->_issuerCountry = $countryCode;
    }

    public function setInvoiceId($invoice_id)
    {
        $this->_invoiceId = $invoice_id;
    }


    public function check_transction_no($transection = "")
    {

        $action = "new";
        $aid = "";
        if (!is_blank($transection)) {
            $this->db->where('transection_no', $transection);
            $this->db->limit(1);
            $this->db->order_by('aid', 'desc');
            $q = $this->db->get($this->tbl_donation);


            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $aid = $row->aid;
                }

                $this->setDonationId($aid);
                $action = "update";
            }
        }
        $this->db->reset_query();

        return $action . $aid;


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

        $action = "new";
        $aid = "";
        if (!is_blank($this->_transection_no)) {
            $this->db->where('transection_no', $this->_transection_no);
            $this->db->limit(1);
            $this->db->order_by('aid', 'desc');
            $q = $this->db->get($this->tbl_donation);


            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $aid = $row->aid;
                }

                $this->setDonationId($aid);
                $action = "update";
            }
        }

        $this->db->reset_query();


        if ($action == "new") {
            $this->db->insert($this->tbl_donation, $data);
            if (!is_blank($this->db->insert_id()) && $this->db->insert_id() > 0) {
                $this->setDonationId($this->db->insert_id());
                return true;
            } else {
                return false;
            }

        } else {

            $data_update = array(
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
            $this->db->where('transection_no', $this->_transection_no);
            if (!is_blank($this->_donationId)) {
                $this->db->where('aid', $this->_donationId);
            }
            $this->db->update($this->tbl_donation, $data_update);
            $aff_num = $this->db->affected_rows();
            if ($aff_num > 0) {
                return true;
            } else {
                return false;
            }

        }

    }

    public function update($donation_id = "")
    {
        $data = array(
            'invoice_id' => $this->_invoiceId,
            'inv_number' => $this->_inv_number
        );
        if (!is_blank($donation_id)) {
            $this->db->where('aid', $donation_id);
            $this->db->update($this->tbl_donation, $data);

            if ($this->db->affected_rows()) {
                return true;
            } else {
                return false;
            }


        } else {
            return false;
        }


    }

    public function updateDonation($donation_id = "")
    {

        $data = array();
        if (!is_blank($this->_inv_number)) {
            $data['inv_number'] = $this->_inv_number;
        }
        if (!is_blank($this->_amount)) {
            $data['amount'] = $this->_amount;
        }
        if (!is_blank($this->_status)) {
            $data['payment_status'] = $this->_status;
        }
        if (!is_blank($this->_bankName)) {
            $data['bankName'] = $this->_bankName;
        }
        if (!is_blank($this->_transferDate)) {
            $data['transfer_date'] = $this->_transferDate;
        }
        if (!is_blank($this->_invoiceId)) {
            $data['invoice_id'] = $this->_invoiceId;
        }
        if (!is_blank($this->_tranRef)) {
            $data['tranRef'] = $this->_tranRef;
        }
        if (!is_blank($this->_note)) {
            $data['updated_date'] = $this->_updatedDate;
        }
        if (!is_blank($this->_note)) {
            $data['note'] = $this->_note;
        }


        if (!is_blank($donation_id) && !is_blank($data)) {
            $this->db->where('aid', $donation_id);
            $this->db->update($this->tbl_donation, $data);
            if ($this->db->affected_rows()) {
                return true;
            } else {
                return false;
            }
        }

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
        $result = "";
        $this->db->select_max('aid');
        $query = $this->db->get($this->tbl_donation);
        $result = $query->row_array();

        if (is_array($result)) {
            $result = get_array_value($result, 'aid');
        }

        return $result;


    }

    public function donationById()
    {
        $this->db->select('donation.* ,
	donor.title_name,
	donor.first_name,
	donor.last_name,
	donor.tax_code,
	donor.address,
	donor.email,
	donor.tel,
	donation_campaign.title AS campaign_name');
        $this->db->join($this->tbl_donor, 'donation.doner_aid = donor.aid', 'left');
        $this->db->join($this->tbl_payment_channel, 'donation.payment_channel = payment_channel.`code`', 'left');
        $this->db->join($this->tbl_donation_campaign, 'donation.donation_campaign_aid = donation_campaign.aid ', 'left');
        $this->db->where('donation.aid', $this->_donationId);
        $query = $this->db->get($this->tbl_donation);
        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;


    }

    public function topDonor()
    {
        $this->db->select('*,SUM(amount) as TotalAmount,donor.aid as donor_id');
        $this->db->join($this->tbl_donation, 'donation ON donor.aid = donation.doner_aid', 'left');
        $this->db->where("donation.payment_status='00' OR donation.payment_status='000'");
        $this->db->group_by('donor.aid');
        $this->db->order_by('TotalAmount DESC');
        $this->db->limit(10);
        $query = $this->db->get($this->tbl_donor);
        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function donationByDonor()
    {
        $result = array();
        if (!is_blank($this->_fillter)) {
            $this->db->select('donation.* ,
	donor.title_name,
	donor.first_name,
	donor.last_name,
	donor.tax_code,
	donor.address,
	donor.email,
	donation_campaign.title AS campaign_name');
            $this->db->join($this->tbl_donor, 'donation.doner_aid = donor.aid', 'left');
            $this->db->join($this->tbl_payment_channel, 'donation.payment_channel = payment_channel.`code`', 'left');
            $this->db->join($this->tbl_donation_campaign, 'donation.donation_campaign_aid = donation_campaign.aid ', 'left');
            $this->db->or_like('donor.email', $this->_fillter);
            $this->db->or_like('donor.first_name', $this->_fillter);
            $query = $this->db->get($this->tbl_donation);
            $result = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $result[] = $row;
                }
            }
        }
        return $result;
    }


}// end of class
