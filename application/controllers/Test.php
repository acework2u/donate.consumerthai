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









        $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew','default_font_size' => 15]);

        $mpdf->SetImportUse();
        $pagecount = $mpdf->SetSourceFile('uploads/invoicetemplate.pdf');
// Import the last page of the source PDF file
        $tplId = $mpdf->ImportPage($pagecount);
        $mpdf->UseTemplate($tplId);
        //Invoice No
        $mpdf->WriteFixedPosHTML('FFC19000001', 162, 37, 50, 90, 'auto');
        $date = date('d-m-Y');
        $mpdf->WriteFixedPosHTML(DateThai($date), 162, 46, 50, 90, 'auto');
        //$Full Name Donor
        $fullName = "นาย อานนท์ เดชพละ";
        $mpdf->WriteFixedPosHTML($fullName, 40, 54, 100, 90, 'auto');
//        Address
        $address = "4/488 อาคาร p2 ต.บ้านใหม่ อ.บากเกร็ด จ.นนทบุรี 11120";
        $mpdf->WriteFixedPosHTML($address, 35, 60, 100, 90, 'auto');
        // Campaign
        $Campaign = "มูลนิธิเพื่อผู้บริโภค";
        $mpdf->WriteFixedPosHTML($Campaign, 40, 66, 100, 90, 'auto');
        // Amount Donation
        $amount = '10000';
        $amount1 = number_format($amount,2,'.',',');
        $textAmount = Convert($amount);
        $mpdf->WriteFixedPosHTML($amount1, 40, 73, 50, 90, 'auto');
        $mpdf->WriteFixedPosHTML($textAmount, 120, 73, 100, 90, 'auto');
        //Check mark

        //Credit
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 86, 6,6, 'png', '', true, false);
        //Debit
        $mpdf->Image('uploads/icons8-checkmark-26.png', 65, 86, 6,6, 'png', '', true, false);
        // Card Number
        $cardId = "345xxxxxxx230";
        $mpdf->WriteFixedPosHTML($cardId, 110, 86, 50, 90, 'auto');
        /*** Bank Name  */
        $bankName = "UOB Bank";
        $mpdf->WriteFixedPosHTML($bankName, 160, 86, 50, 90, 'auto');




        //QR Code
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 92, 6,6, 'png', '', true, false);
        //Bank Transfer
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 99, 6,6, 'png', '', true, false);
        /*** Bank Name  */
        $bankName = "กสิกรไทย";
        $mpdf->WriteFixedPosHTML($bankName, 70, 99, 50, 90, 'auto');
        $bankBranch = "งามวงศ์วาน";
        $mpdf->WriteFixedPosHTML($bankBranch, 125, 99, 50, 90, 'auto');
        $trnsferDate = date('Y-m-d H:i:s');
        $mpdf->WriteFixedPosHTML(DateTimeThai($trnsferDate), 170, 99, 50, 90, 'auto');
        $mpdf->Output();





    }


    public function donationById(){
        $this->load->model($this->donation_model,'donation');

        $id=5;
        $this->donation->setDonationId($id);
        $result = array();
        $result = $this->donation->donationById();

        if(is_array($result)){
            foreach ($result as $row){
                $invoice_no = get_array_value($row,'inv_number','');
                $amount = get_array_value($row,'amount',0);
                $payment_channel = get_array_value($row,'payment_channel','');
                $payment_status = get_array_value($row,'payment_status','');
                $bank_name = get_array_value($row,'bankName','');
                $panCard = get_array_value($row,'pan','');
                $tranRef = get_array_value($row,'tranRef','');
                $transfer_date = get_array_value($row,'transfer_date','');
                $title_name = get_array_value($row,'title_name','');
                $first_name = get_array_value($row,'first_name','');
                $last_name = get_array_value($row,'last_name','');
                $tax = get_array_value($row,'tax_code','');
                $address = get_array_value($row,'address','');
                $campaign_name = get_array_value($row,'campaign_name','');


            }
            $full_name = $title_name." ".$first_name." ".$last_name;
            $transferDateTime = datetime2display($transfer_date);
            $transferDate = DateThai($transferDateTime);



            // Create Pdf
            $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew','default_font_size' => 15]);

            $mpdf->SetImportUse();
            $pagecount = $mpdf->SetSourceFile('uploads/invoicetemplate.pdf');
// Import the last page of the source PDF file
            $tplId = $mpdf->ImportPage($pagecount);
            $mpdf->UseTemplate($tplId);
            //Invoice No
            $mpdf->WriteFixedPosHTML($invoice_no, 162, 37, 50, 90, 'auto');

            $mpdf->WriteFixedPosHTML($transferDate, 162, 46, 50, 90, 'auto');
            //$Full Name Donor

            $mpdf->WriteFixedPosHTML($full_name, 40, 54, 100, 90, 'auto');
//        Address

            $mpdf->WriteFixedPosHTML($address, 35, 60, 100, 90, 'auto');
            // Campaign

            $mpdf->WriteFixedPosHTML($campaign_name, 40, 66, 100, 90, 'auto');
            // Amount Donation

            $amount1 = number_format($amount,2,'.',',');
            $textAmount = Convert($amount);
            $mpdf->WriteFixedPosHTML($amount1, 40, 73, 50, 90, 'auto');
            $mpdf->WriteFixedPosHTML($textAmount, 120, 73, 100, 90, 'auto');
            //Check mark


            switch ($payment_channel){
                case "001":
                    // Credit
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 86, 6,6, 'png', '', true, false);
                    // Card Number
                    $cardId = $panCard;
                    $mpdf->WriteFixedPosHTML($cardId, 105, 86, 50, 90, 'auto');
                    /*** Bank Name  */
                    $bankName = $bank_name;
                    $mpdf->WriteFixedPosHTML($bankName, 160, 86, 50, 90, 'auto');
                    break;
                case "002":
                    // Bank Transfer
                    //Bank Transfer
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 99, 6,6, 'png', '', true, false);
                    /*** Bank Name  */
                    $bankName = $bank_name;
                    $mpdf->WriteFixedPosHTML($bankName, 70, 99, 50, 90, 'auto');
                    $bankBranch = "งามวงศ์วาน";
                    $mpdf->WriteFixedPosHTML($bankBranch, 125, 99, 50, 90, 'auto');
                    $mpdf->WriteFixedPosHTML($transferDate, 170, 99, 50, 90, 'auto');

                    break;
                 case "003":
                     //Debit
                     $mpdf->Image('uploads/icons8-checkmark-26.png', 65, 86, 6,6, 'png', '', true, false);
                     // Card Number
                     $cardId = $panCard;
                     $mpdf->WriteFixedPosHTML($cardId, 110, 86, 50, 90, 'auto');
                    break;
                 case "004":
                     //QR COde
                     $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 92, 6,6, 'png', '', true, false);
                    break;


            }

            $mpdf->Output();

        } // end if

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
        $social_media_name = $socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
        $myScial = array('url' => 'https://donate.consumerthai.org/', 'title' => 'Consumer Thailand');
        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks($myScial);

        $this->data['media_name'] = $social_media_name;
        $this->data['media_urls'] = $social_media_urls;

//        $socmed = new SocialMedia();
//        $social_media_names = $socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
//        $mySocial = array('url' => 'http://www.earthfluent.com/', 'title' => 'EarthFluent','image'=>"");
//        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks($mySocial);


        $this->load->view('frontend/thankyou', $this->data);
    }


    public function testdate()
    {
        echo date('m-01-Y 00:00:00', strtotime('this month')) . '<br/>';
        echo date('m-t-Y 12:59:59', strtotime('this month')) . '<br/>';

        echo date('Y-m-01 00:00:00', strtotime('this month')) . '<br/>';
        echo date('Y-m-t 12:59:59', strtotime('this month')) . '<br/>';


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

        $this->load->model($this->report_model, 'report');

        $startDate = date('Y-m-01 00:00:00');
        $endDate = date('Y-m-t 12:59:59');
//        $startDate =  mdate('%Y-%m-%d %H:%i:%s', now());


        $jvDate = "2018-12-31T17:00:00.000Z";


        echo $jvDate = date('Y-m-d', strtotime($jvDate));
        exit();


        if (!is_blank($this->input->get_post('startDate'))) {

        }


//        $data_where['updated_date'] = "2017-01-01 00:00:00";

        $start_date = array('updated_date >= $startDate');
        $end_date = array('updated_date <= $endDate');


        $donationList = array();

        $this->report->setStartDate($start_date);
        $this->report->setEndDate($end_date);
        if ($this->report->donation()) {
            $donationList = $this->report->donation();
        }

        echo json_encode($donationList);


    }


}
