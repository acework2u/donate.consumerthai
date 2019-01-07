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
//        $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew']);
////        $html = $this->load->view('html_to_pdf', [], true);
////        $mpdf->WriteHTML($html);
////        $mpdf->Output(); // opens in browser
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


    public function amount()
    {
        $amount = '000000010054';

        echo floatval($amount) / 100;
        echo "<br>";
        echo amountToDb($amount);

    }


    public function thankyou()
    {


        $this->load->library('SocialMedia');

        $socmed = new SocialMedia();
        $social_media_name =$socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
        $myScial = array('url' => 'https://donate.consumerthai.org/', 'title' => 'Consumer Thailand');
        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks($myScial);

        $this->data['media_name'] = $social_media_name;
        $this->data['media_urls'] = $social_media_urls;

//        $socmed = new SocialMedia();
//        $social_media_names = $socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
//        $mySocial = array('url' => 'http://www.earthfluent.com/', 'title' => 'EarthFluent','image'=>"");
//        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks($mySocial);


        $this->load->view('frontend/thankyou',$this->data);
    }


    public function testdate(){
        echo date('m-01-Y 00:00:00',strtotime('this month')) . '<br/>';
        echo date('m-t-Y 12:59:59',strtotime('this month')) . '<br/>';

        echo date('Y-m-01 00:00:00',strtotime('this month')) . '<br/>';
        echo date('Y-m-t 12:59:59',strtotime('this month')) . '<br/>';


//        $timeStamp = "060119164635";
////        $timeStamp = str_split($timeStamp,2);
//////        $timeStamp = date( "y-m-d H:m:s", strtotime($timeStamp));
////
////        $d=mktime($timeStamp[3],$timeStamp[4],$timeStamp[5],$timeStamp[1],$timeStamp[0],$timeStamp[2]);
//
//        print_r($timeStamp);
//        echo "Created date is " . datetime2db($timeStamp);
//
//        echo datetime2display($timeStamp);

        $this->load->model($this->report_model,'report');

        $startDate = date('Y-m-01 00:00:00');
        $endDate = date('Y-m-t 12:59:59');
//        $startDate =  mdate('%Y-%m-%d %H:%i:%s', now());


        $jvDate = "2018-12-31T17:00:00.000Z";


        echo $jvDate = date('Y-m-d',strtotime($jvDate));
        exit();



        if(!is_blank($this->input->get_post('startDate'))){

        }


//        $data_where['updated_date'] = "2017-01-01 00:00:00";

        $start_date = array('updated_date >= $startDate');
        $end_date = array('updated_date <= $endDate');



        $donationList = array();

        $this->report->setStartDate($start_date);
        $this->report->setEndDate($end_date);
        if($this->report->donation()){
            $donationList = $this->report->donation();
        }

        echo json_encode($donationList);


    }


}
