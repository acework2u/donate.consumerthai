<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function donation()
    {
        $this->db->select('donation.*,
	email,
	first_name,
	last_name,
	payment_code.title as status,
	donation_campaign.title AS campaign_name');
        $this->db->join($this->tbl_donor, 'donor.aid = donation.doner_aid', 'inner');
        $this->db->join($this->tbl_donation_campaign, 'donation.donation_campaign_aid = donation_campaign.aid', 'inner');
        $this->db->join($this->tbl_payment_code,'donation.payment_status = payment_code.code','left');
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


    public function donor()
    {

    }


}// end of class
