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




} // end of class
