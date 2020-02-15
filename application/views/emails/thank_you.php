<?php
$full_name="";
$amountDonate ="";
$invoice_no ="";
$ref_no ="";

if(isset($templateData)){
    if(is_array($templateData)){
        $full_name = get_array_value($templateData,'name','');
        $amountDonate = get_array_value($templateData,'amount','');
        $invoice_no = get_array_value($templateData,'invoice_no','');
        $ref_no = get_array_value($templateData,'ref_no','');
        $date_time = get_array_value($templateData,'date_time','');
    }
}

?>
<p>เรียน <?php echo $full_name?></p>
<p>รายละเอียดการบริจาค</p>
<p>วันที่บริจาค : <?php echo $date_time;?>น.</p>
<p>เลขที่อ้างอิง : <?php echo $ref_no;?></p>
<p>เลขที่ใบเสร็จ : <?php echo $invoice_no;?></p>
<p>จำนวนเงินบริจาค : <?php echo $amountDonate?> บาท</p>
<p>ขอบพระคุณที่ร่วมบริจาคกับมูลนิธิเพื่อผู้บริโภค ใบเสร็จรับเงินการบริจาคของท่าน ท่านสามารถดาวโหลดได้จากไฟล์แนบคะ.</p>
<p>ขอบพระคุณที่ร่วมบริจาคกับเรา</p>
<p style="margin-top: 40px;">ด้วยความเคารพ</p>
<p>มูลนิธิเพื่อผู้บริโภค 4/2 ซอยวัฒนโยธิน แขวงถนนพญาไท เขตราชเทวี กรุงเทพฯ 10400</p>
<p>โทรศัพท์ 02-248-3737 โทรสาร 02-248-3733</p>








