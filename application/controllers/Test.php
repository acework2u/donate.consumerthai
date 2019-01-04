<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        echo "Joe";
    }


    public function testpdf(){
        $mpdf = new \Mpdf\Mpdf( ['default_font' => 'thsarabunnew']);
        $html = $this->load->view('html_to_pdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
    }




    public function checkDonor(){
        $this->load->model($this->donor_model,'donor');

        $email = "acework2u@gmail.com";

        $result = array();
        $this->donor->setEmail($email);

        $result = $this->donor->checkDonor();
        $donorID = $this->donor->getDonorId();

//        print_r($result);

        echo "Donor ID = ".$donorID;
//        echo $this->db->last_query();

    }
}
