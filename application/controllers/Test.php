<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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


        $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew', 'default_font_size' => 15]);

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
        $amount1 = number_format($amount, 2, '.', ',');
        $textAmount = Convert($amount);
        $mpdf->WriteFixedPosHTML($amount1, 40, 73, 50, 90, 'auto');
        $mpdf->WriteFixedPosHTML($textAmount, 120, 73, 100, 90, 'auto');
        //Check mark

        //Credit
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 86, 6, 6, 'png', '', true, false);
        //Debit
        $mpdf->Image('uploads/icons8-checkmark-26.png', 65, 86, 6, 6, 'png', '', true, false);
        // Card Number
        $cardId = "345xxxxxxx230";
        $mpdf->WriteFixedPosHTML($cardId, 110, 86, 50, 90, 'auto');
        /*** Bank Name  */
        $bankName = "UOB Bank";
        $mpdf->WriteFixedPosHTML($bankName, 160, 86, 50, 90, 'auto');


        //QR Code
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 92, 6, 6, 'png', '', true, false);
        //Bank Transfer
        $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 99, 6, 6, 'png', '', true, false);
        /*** Bank Name  */
        $bankName = "กสิกรไทย";
        $mpdf->WriteFixedPosHTML($bankName, 70, 99, 50, 90, 'auto');
        $bankBranch = "งามวงศ์วาน";
        $mpdf->WriteFixedPosHTML($bankBranch, 125, 99, 50, 90, 'auto');
        $trnsferDate = date('Y-m-d H:i:s');
        $mpdf->WriteFixedPosHTML(DateTimeThai($trnsferDate), 170, 99, 50, 90, 'auto');
        $mpdf->Output();


    }


    public function donationById()
    {
        $this->load->model($this->donation_model, 'donation');

        $id = 6;
        $this->donation->setDonationId($id);
        $result = array();
        $result = $this->donation->donationById();

        if (is_array($result)) {
            foreach ($result as $row) {
                $invoice_no = get_array_value($row, 'inv_number', '');
                $amount = get_array_value($row, 'amount', 0);
                $payment_channel = get_array_value($row, 'payment_channel', '');
                $payment_status = get_array_value($row, 'payment_status', '');
                $bank_name = get_array_value($row, 'bankName', '');
                $panCard = get_array_value($row, 'pan', '');
                $tranRef = get_array_value($row, 'tranRef', '');
                $transfer_date = get_array_value($row, 'transfer_date', '');
                $title_name = get_array_value($row, 'title_name', '');
                $first_name = get_array_value($row, 'first_name', '');
                $last_name = get_array_value($row, 'last_name', '');
                $tax = get_array_value($row, 'tax_code', '');
                $address = get_array_value($row, 'address', '');
                $campaign_name = get_array_value($row, 'campaign_name', '');


            }
            $full_name = $title_name . " " . $first_name . " " . $last_name;
            $transferDateTime = datetime2display($transfer_date);
            $transferDate = DateThai($transferDateTime);


            // Create Pdf
            $mpdf = new \Mpdf\Mpdf(['default_font' => 'thsarabunnew', 'default_font_size' => 15]);

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

            $amount1 = number_format($amount, 2, '.', ',');
            $textAmount = Convert($amount);
            $mpdf->WriteFixedPosHTML($amount1, 40, 73, 50, 90, 'auto');
            $mpdf->WriteFixedPosHTML($textAmount, 120, 73, 100, 90, 'auto');
            //Check mark


            switch ($payment_channel) {
                case "001":
                    // Credit
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 86, 6, 6, 'png', '', true, false);
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
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 99, 6, 6, 'png', '', true, false);
                    /*** Bank Name  */
                    $bankName = $bank_name;
                    $mpdf->WriteFixedPosHTML($bankName, 70, 99, 50, 90, 'auto');
                    $bankBranch = "งามวงศ์วาน";
                    $mpdf->WriteFixedPosHTML($bankBranch, 125, 99, 50, 90, 'auto');
                    $mpdf->WriteFixedPosHTML($transferDate, 170, 99, 50, 90, 'auto');

                    break;
                case "003":
                    //Debit
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 65, 86, 6, 6, 'png', '', true, false);
                    // Card Number
                    $cardId = $panCard;
                    $mpdf->WriteFixedPosHTML($cardId, 110, 86, 50, 90, 'auto');
                    break;
                case "004":
                    //QR COde
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 92, 6, 6, 'png', '', true, false);
                    break;


            }
            $fileName = $invoice_no . ".pdf";
            $fullfilePath = "downloads/invoice/" . $invoice_no . ".pdf";

            $mpdf->Output($fileName, 'D');
            ob_clean();
            $mpdf->Output($fullfilePath, 'F');

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

//
//        echo $jvDate = date('Y-m-d', strtotime($jvDate));
//        exit();


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


    public function exportxls($data = '')
    {


        $report_date = "วันที่ " . date('Y-m-d');

        $sp = new Spreadsheet();
        $sheet = $sp->getActiveSheet();
        /**** Header ***/
        $sheet->setCellValue('C1', 'มูลนิธิเพื่อผู้บริโภค');
        $sheet->setCellValue('C2', 'รายงานรับเงินบริจาค');
//        $sheet->setCellValue('A3', $report_date);

        /*** Column ***/
        $sheet->setCellValue('A4', 'ลำดับที่');
        $sheet->setCellValue('B4', 'วันที่');
        $sheet->setCellValue('C4', 'ใบเสร็จรับเงิน');
        $sheet->setCellValue('D4', 'ชื่อ-นามสกุล');
        $sheet->setCellValue('E4', 'จำนวนเงินที่ได้รับ(บาท)');
        $sheet->setCellValue('F4', 'ชำระเงิน ธนาคาร');
        /**Content */

        $data = $this->getfiles();
        if (is_array($data)) {
            $sp->getActiveSheet()->fromArray($data, null, 'A5');
            $last_row = count($data) + 1;

            /***** Style ***/
            $sp->getActiveSheet()->getStyle('E5:E' . $last_row)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sp->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);
            $sp->getActiveSheet()->getStyle('C1:C2')->getFont()->setBold(true);

            foreach (range('A', 'F') as $columnID) {
                $sp->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }

        }


        $writer = new Xlsx($sp);
        $filename = 'donation-report_' . date('Y-m-d');

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');


    }


    public function getfiles()
    {
        if ($this->is_login()) {
            $this->load->model($this->report_model, 'report');

            $startDate = date('Y-m-01 00:00:00');
            $endDate = date('Y-m-t 12:59:59');

            if (!is_blank($this->input->get_post('startDate'))) {
                $startDate = date('Y-m-d', strtotime($this->input->get_post('startDate')));
            }
            if (!is_blank($this->input->get_post('endDate'))) {
                $endDate = date('Y-m-d', strtotime($this->input->get_post('endDate')));
            }


            $donationList = array();
            $start_date = array('updated_date >= $startDate');
            $end_date = array('updated_date <= $endDate');

            $this->report->setStartDate($start_date);
            $this->report->setEndDate($end_date);

            if ($this->report->donation()) {
                $donationList = $this->report->donation();
            }

//            echo json_encode($donationList);
            $reports_info = array();
            if (is_array($donationList)) {
                $i = 1;
                foreach ($donationList as $row) {
                    $rows = array(
                        'indexd' => $i,
                        'aid' => get_array_value($row, 'aid', ''),
                        'transection_no' => get_array_value($row, 'transection_no', ''),
                        'mount' => get_array_value($row, 'mount', ''),
                        'doner_aid' => get_array_value($row, 'doner_aid', ''),
                        'donation_campaign_aid' => get_array_value($row, 'donation_campaign_aid', ''),
                        'payment_channel' => get_array_value($row, 'payment_channel', ''),
                        'payment_status' => get_array_value($row, 'payment_status', ''),
                        'bankName' => get_array_value($row, 'bankName', ''),
                        'pan' => get_array_value($row, 'pan', ''),
                        'note' => get_array_value($row, 'note', ''),
                        'tranRef' => get_array_value($row, 'tranRef', ''),
                        'processBy' => get_array_value($row, 'processBy', ''),
                        'issuerCountry' => get_array_value($row, 'issuerCountry', ''),
                        'transfer_date' => datetime2display(get_array_value($row, 'transfer_date')),
                        'created_date' => get_array_value($row, 'created_date', ''),
                        'first_name' => get_array_value($row, 'first_name', ''),
                        'updated_date' => get_array_value($row, 'updated_date', 0),
                        'invoice_id' => get_array_value($row, 'invoice_id', '')

                    );
                    $reports_info[] = $rows;
                    $i++;
                }
            }


            echo "<pre>";
            print_r($reports_info);
            echo "</pre>";

//            return $reports_info;

        }
    }


    public function testGenInvoice()
    {
        $this->load->model($this->donation_model, 'donation');

        $Id = $this->donation->lastInvoiceId();

        echo $this->genInvoiceNo();
    }

    public function genInvoiceNo()
    {
        $this->load->model($this->donation_model, 'donation');
        $numId = 0;
        $numId = $this->donation->lastInvoiceId();
        if (is_blank($numId)) {
            $numId = 0;
        }
        $numId += 1;
        $inv = str_pad($numId, 6, "0", STR_PAD_LEFT);
        $inv = "FFC" . date("y") . $inv;

        return $inv;
    }

    public function bankList()
    {
        $rs = $this->getBanklist();
        $pc = $this->getPaymentStatus();
        echo "<pre>";
        print_r($rs);
        print_r($pc);
        echo "</pre>";
    }

    public function testformatdatetime()
    {

        $dateTime = "2019-10-01 18:01:03";
        $date1 = date('mdyHms', strtotime($dateTime));

        $mydateDb = datetime2db($date1);

        echo "DateTime =" . $dateTime . " strTotime" . strtotime($dateTime) . " newFormat=" . date('mdyHms', strtotime($dateTime));


    }


    public function testSendMail()
    {
        $this->load->library('mailer');
        $viewsMail = VIEWPATH;
//        echo $viewsMail;

        $email = 'acework2u@gmail.com';

//        $pdfFile = chunk_split(base64_encode(file_get_contents("downloads/invoice/FFC19000001.pdf")));
//        $pdfFile = file_get_contents("downloads/invoice/FFC19000001.pdf");
        $doantionId = 15;
        $pdfFile = $this->generate_invoice($doantionId);

        $fileName = "FFC19000001.pdf";
//        $pdfFile = $strContent1 = chunk_split(base64_encode(file_get_contents("downloads/invoice/FFC19000001.pdf")));

//        echo $pdfFile;
//        exit();
// Use user or any information to load in email template

        $templateData = array(
            'name' => 'Anon Dechpala'
        );


        $result = $this->mailer->to($email)->subject("Thank you for Donate")->setAttachFile($pdfFile, $fileName)->send("thank_you.php", compact('templateData'));


        if ($result) {
            echo "Email sent successfully $result";
        } else {
            echo "Email failed to send $result";

        }
    }


    public function testInvoice(){
        $Invoice = $this->generate_invoice(6);

    }


} //end of Class
