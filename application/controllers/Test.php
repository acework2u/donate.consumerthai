<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo "Joe";
    }


    public function testpdf()
    {
        $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew']);
        $html = $this->load->view('html_to_pdf', [], true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
    }


    public function checkDonor()
    {
        $this->load->model($this->donor_model, 'donor');

        $email = "kasinee.nut@gmail.com";

        $result = array();
        $this->donor->setEmail($email);

        $result = $this->donor->checkDonor();
        $donorID = $this->donor->getDonorId();

//        print_r($result);

        echo "Donor ID = $result" . $donorID;
//        echo $this->db->last_query();

    }


    public function getInvoiceNo()
    {

        echo $this->generateInvoice();

    }



    public function amount(){
        $amount = '000000010054';

        echo floatval($amount)/100;
        echo "<br>";
        echo amountToDb($amount);

    }


}
