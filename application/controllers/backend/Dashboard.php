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
            echo "Backend";
        } else {
            redirect('signin');
        }

    }

    public function dashboard(){
        echo "Dashboard";
    }


} // end of class
