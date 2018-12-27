<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends CI_Controller{
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
}
