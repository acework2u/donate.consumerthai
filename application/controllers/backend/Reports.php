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

            $startDate = date('Y-m-01 00:00:00');
            $endDate = date('Y-m-t 12:59:59');

            if(!is_blank($this->input->get_post('startDate'))){
                $startDate = date('Y-m-d',strtotime($this->input->get_post('startDate')));
            }
            if(!is_blank($this->input->get_post('endDate'))){
                $endDate = date('Y-m-d',strtotime($this->input->get_post('endDate')));
            }


            $donationList = array();
            $start_date = array('updated_date >= $startDate');
            $end_date = array('updated_date <= $endDate');

            $this->report->setStartDate($start_date);
            $this->report->setEndDate($end_date);

            if($this->report->donation()){
                $donationList = $this->report->donation();
            }

           echo json_encode($donationList);

        }
    }



} // end of class
