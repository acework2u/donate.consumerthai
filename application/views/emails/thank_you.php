<?php
$full_name="";
$amountDonate ="";

if(isset($templateData)){
    if(is_array($templateData)){
        $full_name = get_array_value($templateData,'name','');
        $amountDonate = get_array_value($templateData,'amount','');
    }
}

?>
<p>เรียน <?php echo $full_name?></p>
<p>ขอบคุณที่ร่วมบริจาคกับ มูลนิธิเพื่อผู้บริโภค เป็นจำนวนเงิน <?php echo $amountDonate; ?> บาท ใบเสร็จรับเงินการบริจาค ท่านสามารถดาวโหลดได้จากไฟล์แนบ.</p>
<p>ขอบพระคุณที่ร่วมบริจาคกับเรา</p>
<p style="margin-top: 40px;">ด้วยความเคารพ</p>
<p>มูลนิธิเพื่อผู้บริโภค 4/2 ซอยวัฒนโยธิน แขวงถนนพญาไท เขตราชเทวี กรุงเทพฯ 10400</p>
<p>โทรศัพท์ 02-248-3737 โทรสาร 02-248-3733</p>








