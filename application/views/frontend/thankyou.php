<!DOCTYPE html>
<html>
<head>
    <title>Foundation for Consumers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta property="og:image" content="<?php echo base_url('assets/img/thank.png')?>"/>

    <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="position-relative">
<div class="w-100 position-relative" ref="header">
    <img src="<?php echo base_url('assets/img/bg-header.png');?>" class="w-100 lg-bg-header">
    <img src="<?php echo base_url('assets/img/logo.png')?>" class="header-logo position-absolute">
    <h1 class="header-text position-absolute text-center">ร่วมบริจาคกับเราวันนี้</h1>
    <h2 class="header-sub-text position-absolute text-cente d-none d-xl-block">คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม เราได้กำลังใจ</h2>
    <h2 class="header-sub-text-2 position-absolute text-center d-xl-none">ร่วมบริจาคเพื่อ สนับสนุนฟ้องคดี ให้แก่ผู้บริโภคที่ได้รับความเสียหาย และสนับสนุนศูนย์ทดสอบฉลาดซื้อ ให้ทดสอบสินค้าและบริการ </h2>
    <img src="<?php echo base_url('assets/img/home-button.png')?>" class="position-absolute home-button">
    <div class="d-flex d-xl-none">
        <button class="button-more position-absolute d-none d-xl-none" id="button-more">อ่านข้อมูลเพิ่มเติม</button>
        <button class="button-more position-absolute d-xl-none" id="button-donate">คลิกเพื่อบริจาค</button>
    </div>
    <div class="lang-button-contaier d-flex position-absolute">
        <button type="button" class="lang-button" id="eng">ENG</button>
        <button type="button" class="lang-button" id="th">TH</button>
    </div>
</div>
<div class="container d-flex" ref="body"">


<div class="thank-container pt-3 pb-3 mt-4 mb-4 " id="thank">
    <div class="d-flex">
        <img src="<?php echo base_url('assets/img/thank-header.png')?>" class="pb-3">
    </div>
    <div class="d-flex">
        <img  src="<?php echo base_url('assets/img/thank.png')?>" class="w-100">
    </div>
    <div class="mt-4 ml-5">
        <a href="<?php echo get_array_value($media_urls,'facebook');?>"><img src="<?php echo base_url('assets/img/fb-icon.png')?>" class="h-30"></a>
        <img src="<?php echo base_url('assets/img/twitter-icon.png')?>" class="h-30">
        <img src="<?php echo base_url('assets/img/ig-icon.png')?>" class="h-30">
        <img src="<?php echo base_url('assets/img/google_plus-icon.png')?>" class="h-30">
        <img src="<?php echo base_url('assets/img/pinterest-icon.png')?>" class="h-30">
    </div>
    <div class="mt-2 ml-5 mb-2 position-relative">
        <img src="<?php echo base_url('assets/img/share-icon.png')?>" class="ml-5 ml-0-lg h-30">
        <span>แชร์บอกเพื่อน</span>
        <img src="<?php echo base_url('assets/img/click-donate.png')?>" class="ml-5 position-absolute click-donate h-60">
    </div>
</div>


<?php
//echo "<pre>";
//print_r($media_name);
//print_r($media_urls);
//
//echo get_array_value($media_urls,'facebook');
//echo "</pre>";
//?>


</div>
</body>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-xl">
    <div class="d-none d-xl-block">
        <img src="<?php echo base_url('assets/img/lock-icon.png')?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span class="footer-text ml-4">สอบถามข้อมูลเพิ่มเติม</span><img src="<?php echo base_url('assets/img/tel-icon.png')?>" class="ml-4"><span class="footer-text ml-4">089 761 9150, 089 765 9151</span>
    </div>
</footer>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-lg">
    <div class="d-xl-none">
        <img src="<?php echo base_url('assets/img/lock-icon.png')?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span class="footer-text ml-4 pull-right">สอบถามข้อมูลเพิ่มเติม</span><span class="footer-text ml-2 pull-right">089 761 9150, 089 765 9151</span><img src="<?php echo base_url('assets/img/tel-icon.png')?>" class="ml-2 pull-right">
    </div>
</footer>

<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
<!--<script src="--><?php //echo base_url('assets/js/script.js')?><!--"></script>-->
<script src="<?php echo base_url('assets/js/vue.js') ?>"></script>
<script src="<?php echo base_url('assets/js/axios.js') ?>"></script>
<script src="<?php echo base_url('assets/js/donate.js') ?>"></script>
<!--Importing 2c2p JSLibrary-->
<script type="text/javascript" src="https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/api/my2c2p.1.6.9.min.js"></script>
<script type="text/javascript">
    <!--checkout function-->
    function Checkout() {
        //your code here
        //...
        //if there is no error, submit the form.
        My2c2p.submitForm("2c2p-payment-form",function(errCode,errDesc){
            if(errCode!=0){ alert(errDesc+" ("+errCode+")"); }
        });
    }
</script>
</html>
