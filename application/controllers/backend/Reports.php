<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->data['title'] = "Donation Report";

        $this->load->view('tpl_report', $this->data);

    }


    public function jsonDonationList(){
        if($this->is_login()){
            $this->load->model($this->report_model,'report');

            $donationList = array();
            if($this->report->donation()){
                $donationList = $this->report->donation();
            }

           echo json_encode($donationList);

        }
    }



} // end of class
