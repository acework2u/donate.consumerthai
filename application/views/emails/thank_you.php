<?php
$full_name = "";
$amountDonate = "";
$invoice_no = "";
$ref_no = "";
$bankName = "";
$status = "";
$pan = "";
$taxid = "";
$email = "";
$tel = "";
$cus_addr = "";
$payment_channel = "";

if (isset($templateData)) {
    if (is_array($templateData)) {
        $full_name = get_array_value($templateData, 'name', '');
        $amountDonate = get_array_value($templateData, 'amount', '');
        $invoice_no = get_array_value($templateData, 'invoice_no', '');
        $ref_no = get_array_value($templateData, 'ref_no', '');
        $date_time = get_array_value($templateData, 'date_time', '');
        $bank_name = get_array_value($templateData, 'bank_name', '');
        $status = get_array_value($templateData, 'status', '');
        $pan = get_array_value($templateData, 'pan', '');
        $cus_addr = get_array_value($templateData, 'cus_addr', '');
        $email = get_array_value($templateData, 'email', '');
        $tel = get_array_value($templateData, 'tel', '');
        $taxid = get_array_value($templateData, 'tax_id', '');
        $payment_channel = get_array_value($templateData, 'payment_channel', '');

    }
}

?>
<p>เรียน <?php echo $full_name ?></p>
<p>TaxID.<?php echo $taxid; ?></p>
<p>ที่อยู่ <?php echo $cus_addr; ?></p>
<p>เบอร์โทร. <?php echo $tel ?></p>
<p>email: <?php echo $email ?></p>
<p>เลขที่อ้างอิง : <?php echo $ref_no; ?></p>
<p>วันที่บริจาค : <?php echo $date_time; ?>น.</p>
<p>จำนวนเงินบริจาค : <?php echo $amountDonate ?> บาท</p>
<p>รายละเอียดการบริจาค :</p>
<p>ช่องทางชำระ : <?php echo $payment_channel; ?></p>
<p>เลขที่บัตร : <?php echo $pan ?></p>
<p>ธนาคาร : <?php echo $bank_name ?></p>
<p>สถานะ : <?php echo $status ?></p>
<p>เลขที่ใบเสร็จ : <?php echo $invoice_no; ?></p>
<p style="margin-top: 20px;">ขอบพระคุณที่ร่วมบริจาค เพื่อสนับสนุนการทำงานคุ้มครองผู้บริโภคกับมูลนิธิเพื่อผู้บริโภค
    ใบเสร็จรับเงินของท่าน ท่านสามารถดาวโหลดได้จากไฟล์แนบ.</p>
<p style="margin-top: 20px;">มูลนิธิเพื่อผู้บริโภค 4/2 ซอยวัฒนโยธิน แขวงถนนพญาไท เขตราชเทวี กรุงเทพฯ 10400</p>
<p>มือถือ 089 761 9150 โทรศัพท์ 02-248-3737 โทรสาร 02-248-3733</p>








