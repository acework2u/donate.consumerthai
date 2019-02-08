<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(){

        if ($this->is_login()) {
            $this->dashboard();
        } else {
            redirect('signin');
        }

    }

    public function dashboard(){


        $this->data['title'] = "donate Consumerthai.org Management";

        $this->load->view('tpl_dashboard',$this->data);
    }

    public function topdaonate(){
        if($this->is_login()){
            $this->load->model($this->donation_model,'donation');
            $result = array();
            $result = $this->donation->topDonor();

            $rows = array();
            if(is_array($result) && !is_blank($result)){
                foreach ($result as $row){
                    $rows[] = array(
                        'aid'=>get_array_value($row,'aid',''),
                        'full_name'=>get_array_value($row,'first_name',''),
                        'email'=>get_array_value($row,'email',''),
                        'total_amount'=>get_array_value($row,'TotalAmount','0'),
                        'donor_id'=>get_array_value($row,'donor_id','')
                    );
                }
            }
            echo json_encode($rows);


        }
    }






} // end of class
