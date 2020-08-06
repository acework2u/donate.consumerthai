<?php
$full_name = "";
$amountDonate = "";
$address = "";
$taxID = "";
$tel = "";
$email = "";
$refId = "";
$date_donate = "";
$bank = "";
$status = "";

if (isset($templateData)) {
    if (is_array($templateData)) {
        $full_name = get_array_value($templateData, 'name', '');
        $amountDonate = get_array_value($templateData, 'amount', '');
        $refId = get_array_value($templateData, 'ref', '');
        $address = get_array_value($templateData, 'address', '');
        $tel = get_array_value($templateData, 'tel', '');
        $email = get_array_value($templateData, 'email', '');
        $status = get_array_value($templateData, 'status', '');
        $date_donate = get_array_value($templateData, 'donate_date', '');
        $taxID = get_array_value($templateData, 'taxId', '');

    }
}

?>
<p>เรียน <?php echo $full_name ?></p>
<p>TaxID. <?php echo $taxID;?></p>
<p>ที่อยู่: <?php echo $email;?></p>
<p>เบอร์โทร: <?php echo $tel;?></p>
<p>อีเมล: <?php echo $email;?> </p>
<p>เลขที่อ้างอิง: <?php echo $refId; ?></p>
<p>วันที่บริจาค <?php echo $date_donate?></p>
<p>จำนวนเงินบริจาค <?php echo $amountDonate; ?> บาท</p>
<p><b>รายละเอียดการบริจาค</b></p>
<p>ช่องทางชำระเงิน</p>
<p>สถานะ: รอการโอนเงิน</p>
<p>ธนาคาร</p>
<p style="margin-top: 10px;">1.) ธนาคารไทยพาณิชย์ สาขา งามวงศ์วาน เลขที่บัญชี 319-2-62123-1</p>
<p style="margin-top: 10px;">2.) ธนาคารกสิกรไทย สาขา งามวงศ์วาน เลขที่บัญชี 058-2-86735-6</p>
<p style="margin-top: 10px;">3.) ธนาคารกรุงไทย สาขา งามวงศ์วาน เลขที่บัญชี 141-1-28408-9</p>
<p style="margin-top: 10px;">4.) ธนาคารกรุงศรีอยุธยา สาขาย่อย เดอะมอลล์งามวงศ์วาน เลขที่บัญชี 463-1-10884-6</p>
<p style="margin-top: 10px;">5.) ธนาคารกรุงเทพ สาขาย่อย เดอะมอลล์งามวงศ์วาน เลขที่บัญชี 088-0-38742-8</p>

<p style="margin-top: 20px;"> ขอบคุณที่ท่านร่วมบริจาค สนับสนุนการทำงานคุ้มครองผู้บริโภค ใบเสร็จรับเงินสามารถดาวโหลดได้จากไฟล์แนบ.</p>
<p style="margin-top: 20px;">มูลนิธิเพื่อผู้บริโภค 4/2 ซอยวัฒนโยธิน แขวงถนนพญาไท เขตราชเทวี กรุงเทพฯ 10400</p>
<p>มือถือ 089 761 9150 โทรศัพท์ 02-248-3737 โทรสาร 02-248-3733</p>









