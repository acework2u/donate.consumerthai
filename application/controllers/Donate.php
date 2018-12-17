<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donate extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index(){


        $this->load->view('frontend/donate_view');
    }









} // End of Class
