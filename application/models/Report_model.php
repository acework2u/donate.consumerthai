<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends MY_Model
{

    private $_startDate;
    private $_endDate;
    private $_limit;

    public function __construct()
    {
        parent::__construct();
    }


    public function setStartDate($startDate)
    {
        $this->_startDate = $startDate;
    }

    public function setEndDate($endDate)
    {
        $this->_endDate = $endDate;
    }

    public function setLimit($limit){
        $this->_limit = $limit;
    }


    public function donation()
    {
        $this->db->select('donation.*,
	email,
	first_name,
	last_name,
	payment_code.title as status,
	payment_channel.title as paymentchanel,
	donation_campaign.title AS campaign_name');
        $this->db->join($this->tbl_donor, 'donor.aid = donation.doner_aid', 'inner');
        $this->db->join($this->tbl_donation_campaign, 'donation.donation_campaign_aid = donation_campaign.aid', 'inner');
        $this->db->join($this->tbl_payment_code, 'donation.payment_status = payment_code.code', 'left');
        $this->db->join($this->tbl_payment_channel, 'donation.payment_channel = payment_channel.aid', 'left');
        if(!is_blank($this->_startDate)){
            $this->db->where('donation.updated_date >=',$this->_startDate);
        }
        if(!is_blank($this->_endDate)){
            $this->db->where('donation.updated_date <=',$this->_endDate);
        }

        if(!is_blank($this->_limit)){
            $this->db->limit($this->_limit);
        }
        $this->db->order_by('donation.aid', 'DESC');
        $query = $this->db->get($this->tbl_donation);

        $result = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }

        return $result;


    }


    public function donorsList()
    {
        $where = "donation.payment_status ='00' || donation.payment_status='000'";
        $this->db->select('donor.first_name,
	donor.email,
	donor.tel,
	sum(amount) as donateTotal');
        $this->db->join($this->tbl_donor,'donation.doner_aid = donor.aid','left');
        $this->db->where($where);
        $this->db->group_by('donor.aid');
        $this->db->order_by('donateTotal','desc');
        $query = $this->db->get($this->tbl_donation);

        $result = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
        }
        return $result;

    }


}// end of class
