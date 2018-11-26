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
            $this->control_home();
        } else {
            redirect('signin');
        }


    }


} // end of class
