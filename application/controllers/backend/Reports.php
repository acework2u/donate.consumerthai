<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reports extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->data['title'] = "Donation Report";

        $this->load->view('tpl_report', $this->data);

    }


    public function jsonDonationList()
    {
        if ($this->is_login()) {
            $this->load->model($this->report_model, 'report');

            $startDate = date('Y-m-01 00:00:00');
            $endDate = date('Y-m-t 12:59:59');
            $limit = "";

            if (!is_blank($this->input->get_post('startDate'))) {
                $startDate = date('Y-m-d', strtotime($this->input->get_post('startDate')));
            }
            if (!is_blank($this->input->get_post('endDate'))) {
                $endDate = date('Y-m-d', strtotime($this->input->get_post('endDate')));
            }
            if(!is_blank($this->input->get_post('limit'))){
                $limit = $this->input->get_post('limit');
            }


            $donationList = array();
            $start_date = array('updated_date >= $startDate');
            $end_date = array('updated_date <= $endDate');

            $this->report->setStartDate($startDate);
            $this->report->setEndDate($endDate);

            if(!is_blank($limit)){
                $this->report->setLimit($limit);
            }

            if ($this->report->donation()) {
                $donationList = $this->report->donation();
            }
            $data = array();
            $data['donationlist'] =  $donationList;
            $data['last_query'] = $this->db->last_query();

//            echo json_encode($donationList);
            echo json_encode($data);

        }
    }

    public function donationList()
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

            $this->report->setStartDate($startDate);
            $this->report->setEndDate($endDate);

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
                        'transfer_date' => datetime2display(get_array_value($row, 'transfer_date')),
                        'invoice_no' => get_array_value($row, 'inv_number', ''),
                        'first_name' => get_array_value($row, 'first_name', ''),
                        'amount' => get_array_value($row, 'amount', 0),
                        'bankName' => get_array_value($row, 'bankName', '')

                    );
                    $reports_info[] = $rows;
                    $i++;
                }
            }


            return $reports_info;

        }
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


        if (is_blank($data)) {
            $data = $this->donationList();
        }

//        $data = $this->getfiles();


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

    public function genInvoice($donateId = 0)
    {
        $this->load->model($this->donation_model, 'donation');

        $id = $donateId;
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
            $transferDate = '';

            if(!is_blank($transfer_date)){
                $transferDateTime = datetime2display($transfer_date);
                $transferDate = DateThai($transferDateTime);
            }



            // Create Pdf
            $options = array(
                'default_font' => 'thsarabunnew',
                'default_font_size' => 15,
                'debug' => true
            );

            $mpdf = new \Mpdf\Mpdf($options);


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
                case "006":
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
                case "007":
                    //QR COde
                    $mpdf->Image('uploads/icons8-checkmark-26.png', 35, 92, 6, 6, 'png', '', true, false);
                    break;


            }

            $mpdf->Output();
            $fileName = $invoice_no . ".pdf";
            $fullfilePath = "downloads/invoice/" . $invoice_no . ".pdf";
            ob_clean();
            $mpdf->Output($fullfilePath, 'F');

        } // end if
    }

    public function updateDonationStatus()
    {
        if ($this->is_login()) {

            $donationId = "";
            $transection_no = "";
            $inv_number = "";
            $amount = "";
            $transfer_datetime = "";
            $donorId = "";
            $bank_name = "";
            $payment_channel = "";
            $payment_status = "";
            $updated_date = date('Y-m-d H:i:s');
            $donor_email = "";

            if (!is_blank($this->input->get_post('aid'))) {
                $donationId = $this->input->get_post('aid');
            }
            if (!is_blank($this->input->get_post('transfer_date'))) {
                $transfer_datetime = $this->input->get_post('transfer_date');
            }
            if(!is_blank($this->input->get_post('doner_aid'))){
                $donorId = $this->input->get_post('doner_aid');
            }
            if(!is_blank($this->input->get_post('amount'))){
                $amount = $this->input->get_post('amount');
            }
            if(!is_blank($this->input->get_post('bankName'))){
                $bank_name = $this->input->get_post('bankName');
            }
            if(!is_blank($this->input->get_post('email'))){
                $donor_email = $this->input->get_post('email');
            }
            if(!is_blank($this->input->get_post('payment_status'))){
                $payment_status = trim($this->input->get_post('payment_status'));
            }
            if(!is_blank($this->input->get_post('payment_channel'))){
                $payment_channel = $this->input->get_post('payment_channel');
            }
            if(!is_blank($this->input->get_post('tranRef'))){
                $transection_no = trim($this->input->get_post('tranRef'));
            }

            $checkDuplicateInvoice = $this->checkInvoiceDuplicate($donationId);
            $this->load->model($this->donation_model, 'donation');


           if(!is_blank($transfer_datetime)){
               $date1 = date('mdyHms',strtotime($transfer_datetime));
                $transfer_datetime = $date1;
           }





            $data = array();

            if($payment_status=="00" || $payment_status=="000"){
                // Payment Success
                if(!$checkDuplicateInvoice){
                    $this->load->model($this->invoice_model,'invoice');
                    $invoiceNo = $this->generateInvoice();
                    $invoiceStatus = 1;
                    $remark = "";

                    $this->invoice->setInvoiceNo($invoiceNo);
                    $this->invoice->setDonationId($donationId);
                    $this->invoice->setInvoiceStatus($invoiceStatus);
                    $this->invoice->setRemark($remark);

                    if($this->invoice->create()){
                        $invID = $this->invoice->getInvoiceId();
                        $this->donation->setInvoiceId($invID);
                        $this->donation->setInvNumber($invoiceNo);
                        $this->donation->setPaymentStatus($payment_status);
                        $this->donation->setTransferDate($transfer_datetime);
                        $this->donation->setTransRef($transection_no);
                        $this->donation->setBankName($bank_name);
                        $this->donation->setUpdatedDate($updated_date);
                        $this->donation->setNote($remark);
                        $this->donation->setAmount($amount);
                        if($this->donation->updateDonation($donationId)){
                            $data['message'] = "Update Success";
                        }else{
                            $data['error'] = true;
                            $data['message'] = "Cloud no update";
                        }

                    }



                }else{
                   // Have Invoice
                    $this->donation->setTransferDate($transfer_datetime);
                    $this->donation->setTransRef($transection_no);
                    $this->donation->setBankName($bank_name);
                    $this->donation->setUpdatedDate($updated_date);
                    $this->donation->setPaymentStatus($payment_status);
                    $this->donation->setAmount($amount);
                    if($this->donation->updateDonation($donationId)){



                        $data['message'] = "Update Donation info  Success";
                    }else{
                        $data['error'] = true;
                        $data['message'] = "Cloud no update Duplicate Invoice";
                    }

//                    $data['message'] = "Duplicate Invoice";
                }


            }else{

                $this->donation->setTransferDate($transfer_datetime);
                $this->donation->setTransRef($transection_no);
                $this->donation->setBankName($bank_name);
                $this->donation->setUpdatedDate($updated_date);
                $this->donation->setPaymentStatus($payment_status);
                $this->donation->setAmount($amount);
                if($this->donation->updateDonation($donationId)){
                    $data['message'] = "Update Donation info  Success";
                }else{
                    $data['error'] = true;
                    $data['message'] = "Cloud no update Duplicate Invoice";
                }





            }








            echo json_encode($data);








        }// end if login

    }

    public function sendEmailInvoiceToDonor($donationId=""){

        if($this->is_login()){

            $data = array();

            if(!is_blank($this->input->get_post('donation_id'))){
                $donationId = $this->input->get_post('donation_id');
            }
            if(!is_blank($donationId)){
                /// Send Mail to Donor
                $this->load->model($this->donation_model, 'donation');
                $this->donation->setDonationId($donationId);
                $donateInfo = $this->donation->donationById();

                /// Send Mail to Donor
                $this->load->library('mailer');
                $pdfFile = $this->generate_invoice($donationId);


                $fullName = "";
                $amountDonate = "";
                $email = "";
                $invoiceNo = "";
                if (is_array($donateInfo)) {
                    foreach ($donateInfo as $row) {
                        $fullName = get_array_value($row, 'first_name', '');
                        $amountDonate = get_array_value($row, 'amount', '');
                        $email = get_array_value($row, 'email', '');
                        $invoiceNo = get_array_value($row, 'inv_number', 'Invoice');
                    }
                }

                if (!is_blank($amountDonate)) {
                    $donateAmount = number_format($amountDonate, 2);
                }

                $templateData = array(
                    'name' => $fullName,
                    'amount' => $amountDonate
                );

                $fileName = "$invoiceNo.pdf";
                if (!is_blank($email)) {
                    $result = $this->mailer->to($email)->subject("Thank you for Donate")->setAttachFile($pdfFile, $fileName)->send("thank_you.php", compact('templateData'));
                }


                if ($result) {

                    $data['message'] = "Send Email Success";
                } else {

                    $data['message'] = "Send Email to Donor Success";
                }



            }

            echo json_encode($data);



        }



    }





} // end of class
