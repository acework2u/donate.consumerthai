<!DOCTYPE html>
<html>
<head>
    <title>Foundation for Consumers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="<?php echo base_url('assets/img/thank.png')?>"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@FoundationforConsumers">
    <meta name="twitter:creator" content="@FoundationforConsumers">
    <meta name="twitter:title" content="Foundation for Consumers">
    <meta name="twitter:description" content="เราเป็นองค์กรสาธารณะประโยชน์ ที่ทำงานคุ้มครองผู้บริโภคมาเป็นเวลากว่า 30 ปี ด้วยการส่งเสริมให้ผู้บริโภคได้รับการคุ้ครองสิทธิอันพึงมีได้ ">
    <meta name="twitter:image" content="<?php echo base_url('assets/img/thank.png')?>">


    <meta property="og:title" content="Foundation for Consumers" />
    <meta property="og:image" content="<?php echo base_url('assets/img/thank.png')?>" />
    <meta property="og:description" content="เราเป็นองค์กรสาธารณะประโยชน์ ที่ทำงานคุ้มครองผู้บริโภคมาเป็นเวลากว่า 30 ปี ด้วยการส่งเสริมให้ผู้บริโภคได้รับการคุ้ครองสิทธิอันพึงมีได้ " />


    <link href="<?php echo base_url('assets/css/bootstrap.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css');?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
</head>
<body class="position-relative">
<div class="w-100 position-relative" ref="header">
    <img src="<?php echo base_url('assets/img/bg-header.png');?>" class="w-100 lg-bg-header">
    <a href="https://www.consumerthai.org" target="_blank"><img  src="<?php echo base_url('assets/img/logo.png')?>" class="header-logo position-absolute" style="z-index: 1"></a>

    <h1 class="header-text position-absolute text-center">ร่วมบริจาคกับเราวันนี้</h1>
    <h2 class="header-sub-text position-absolute text-cente d-none d-xl-block">คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม เราได้กำลังใจ</h2>
    <h2 class="header-sub-text-2 position-absolute text-center d-xl-none">ร่วมบริจาคเพื่อ สนับสนุนฟ้องคดี ให้แก่ผู้บริโภคที่ได้รับความเสียหาย และสนับสนุนศูนย์ทดสอบฉลาดซื้อ ให้ทดสอบสินค้าและบริการ </h2>
    <a href="<?php echo site_url();?>"><img src="<?php echo base_url('assets/img/home-button.png')?>" class="position-absolute home-button"></a>
    <div class="d-flex d-xl-none">
        <button class="button-more position-absolute d-none d-xl-none" id="button-more">อ่านข้อมูลเพิ่มเติม</button>
        <button class="button-more position-absolute d-xl-none" style="z-index: 1" id="button-donate">คลิกเพื่อบริจาค</button>
    </div>
    <div class="lang-button-contaier d-flex position-absolute" id="appDonate">
        <!--
        <button @click="switchlang" type="button" class="hidden lang-button" id="eng">ENG</button>
        <button @click="switchlang" type="button" class="hidden lang-button" id="th">TH</button>
        -->
        <a @click="switchlang('en')" :class="classEng" class="lang-button btn" id="eng" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english">ENG</a>
        <a @click="switchlang('th')" :class="classThai" class="lang-button btn" id="th" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/thai">TH</a>

        <input  ref="inputlang"  name="switchlang" type="hidden" value="<?php echo $_SESSION['site_lang'] ?>">
    </div>
</div>
