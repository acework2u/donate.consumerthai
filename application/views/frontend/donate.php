<!DOCTYPE html>
<html>
<head>
    <title>Foundation for Consumers</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="<?php echo base_url('assets/img/thank.png') ?>"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@FoundationforConsumers">
    <meta name="twitter:creator" content="@FoundationforConsumers">
    <meta name="twitter:title" content="Foundation for Consumers">
    <meta name="twitter:description"
          content="เราเป็นองค์กรสาธารณะประโยชน์ ที่ทำงานคุ้มครองผู้บริโภคมาเป็นเวลากว่า 30 ปี ด้วยการส่งเสริมให้ผู้บริโภคได้รับการคุ้มครองสิทธิอันพึงมีได้ ">
    <meta name="twitter:image" content="<?php echo base_url('assets/img/thank.png') ?>">


    <meta property="og:title" content="Foundation for Consumers"/>
    <meta property="og:image" content="<?php echo base_url('assets/img/thank.png') ?>"/>
    <meta property="og:description"
          content="เราเป็นองค์กรสาธารณะประโยชน์ ที่ทำงานคุ้มครองผู้บริโภคมาเป็นเวลากว่า 30 ปี ด้วยการส่งเสริมให้ผู้บริโภคได้รับการคุ้มครองสิทธิอันพึงมีได้ "/>

    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133926625-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-133926625-1');
    </script>

</head>
<body class="position-relative">
<div class="w-100 position-relative" ref="header">
    <img src="<?php echo base_url('assets/img/bg-header.png'); ?>" class="w-100 lg-bg-header">
    <a href="https://www.consumerthai.org" target="_blank"><img src="<?php echo base_url('assets/img/logo.png') ?>"
                                                                class="header-logo position-absolute"
                                                                style="z-index: 1"></a>

    <h1 class="header-text position-absolute text-center">ร่วมบริจาคกับเราวันนี้</h1>
    <h2 class="header-sub-text position-absolute text-cente d-none d-xl-block">คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม
        เราได้กำลังใจ</h2>
    <h2 class="header-sub-text-2 position-absolute text-center d-xl-none"><?php echo $this->lang->line('induce_info2')?></h2>
    <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('assets/img/home-button.png') ?>"
                                             class="position-absolute home-button"></a>
    <div class="d-flex d-xl-none">
        <button class="button-more position-absolute d-none d-xl-none" id="button-more">อ่านข้อมูลเพิ่มเติม</button>
        <button class="button-more position-absolute d-xl-none" style="z-index: 1" id="button-donate">คลิกเพื่อบริจาค
        </button>
    </div>
    <div class="lang-button-contaier d-flex position-absolute" id="appDonate">
        <!--
        <button @click="switchlang" type="button" class="hidden lang-button" id="eng">ENG</button>
        <button @click="switchlang" type="button" class="hidden lang-button" id="th">TH</button>
        -->
        <a @click="switchlang('en')" :class="classEng" class="lang-button btn" id="eng"
           href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english">ENG</a>
        <a @click="switchlang('th')" :class="classThai" class="lang-button btn" id="th"
           href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/thai">TH</a>

        <input ref="inputlang" name="switchlang" type="hidden" value="<?php echo $_SESSION['site_lang'] ?>">
    </div>
</div>

<div class="container d-flex" ref="body"
">
<div class="row mt-5 " id="main">
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 pl-0 pr-5 pr-0-lg" id="container-left">
        <div class="d-flex">
            <?php if ($this->_myLang == "thai") { ?>
                <div class="tab-header text-center active" id="tab-1">เราคือใคร</div>
                <div class="tab-header text-center" id="tab-2">เราใช้เงินบริจาคอย่างไร</div>
                <div class="tab-header text-center" id="tab-3">ความปลอดภัย</div>
            <?php } else { ?>
                <div class="tab-header text-center active" id="tab-1">Who we are</div>
                <div class="tab-header text-center" id="tab-2">How we spend</div>
                <div class="tab-header text-center" id="tab-3">How to contribute</div>

            <?php } ?>

        </div>
        <div class="d-flex">

            <div class="tab-body mb-5" id="tab-body-1">
                <div class="video-container w-100 d-flex">
                    <iframe class="w-100" src="https://www.youtube.com/embed/hegUM5aIyUo" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <div class="info-container">
                    <?php if($this->_myLang=="thai"){ ?>
                        <h2 class="text-center mt-1 mb-3">รู้จัก มูลนิธิเพื่อผู้บริโภค (มพบ.)</h2>
                        <p>เราเป็นองค์กรสาธารณะประโยชน์ ที่ทำงานคุ้มครองผู้บริโภคมาเป็นเวลากว่า 30 ปี
                            ด้วยการส่งเสริมให้ผู้บริโภคได้รับการคุ้มครองสิทธิอันพึงมีได้ การเผยแพร่ข้อมูลเพื่อเลือกสินค้า
                            สนับสนุนและส่งเสริมให้องค์กรต่างๆมีส่วนร่วมในการคุ้มครองผู้บริโภค และเสนอนโยบายมาตรการต่างๆ
                            เพื่อยกระดับการคุ้มครองผู้บริโภค</p>
                        <h2 class="text-center quote-text mt-5 mb-5">
                            มูลนิธิเพื่อผู้บริโภค มีจุดยืนที่ชัดเจน<br>
                            สนับสนุนความเข้มแข็งของผู้บริโภค<br>
                            ไม่รับการบริจาคจากภาคธุรกิจ<br>
                            เงินบริจาคของคุณ จึงมีความสำคัญ<br>
                            ช่วยผู้เดือดร้อน และสังคมได้
                        </h2>
                        <p class="text-center small">มูลนิธิเพื่อผู้บริโภค เป็นองค์กรสาธารณะประโยชน์ ลำดับที่ 576
                            ตามประกาศกระทรวงการคลัง<br>ทุกยอดการบริจาคนำไปหลดหย่อนภาษีประจำปีได้</p>
                  <?php  }else{ ?>
                        <h2 class="text-center mt-1 mb-3">Foundation for Consumers</h2>
                        <p>We are a not-for-profit organization that has been working on consumer protection for more than 30 years.  We encourage consumers to exercise their rights and make use of the information when choosing goods or services.  At the same time we support participation in consumer protection by various groups/organizations and call for policies that will improve consumer rights.</p>
                        <h2 class="text-center quote-text mt-5 mb-5">
                            Foundation for Consumers’ goal is to empower consumers.<br>
                            We do not accept sponsorships from business operators for our works.<br>
                            However, any consumers can help fund activities that will benefit the society and those in need.<br>

                        </h2>
                        <p class="text-center small">Foundation for Consumers is public interest organization number 576, according to the Ministry of Finance’s notification.<br>Any donation made to us is eligible for tax reduction.</p>


                  <?php  } ?>

                </div>


            </div>

            <?php if($this->_myLang=="thai"){?>
                <div class="tab-body mb-5 d-none" id="tab-body-2">
                    <h2 class="text-center mt-5 mt-4-lg mb-3">เราใช้เงินบริจาคของคุณอย่างไร เพื่ออะไร</h2>
                    <ul>
                        <li>สนับสนุนฟ้องคดีเรียกค่าเสียหาย ให้แก่ผู้บริโภคที่ได้รับความเสียหาย</li>
                    </ul>
                    <div class="img">
                        <img src="<?php echo base_url('assets/img/subject-1.png') ?>">
                    </div>
                    <div class="subject-1">
                        <h3 class="mt-2">รู้หรือไม่ว่า ? </h3>
                        <p>ผู้เสียหายจำนวนมากที่ได้รับความเดือดร้อน ไม่มีทุนทรัพย์พอ ในการฟ้องคดี จึงมาขอความช่วยเหลือจาก
                            “ศูนย์ทนายความเพื่อการคุ้มครองผู้บริโภค มูลนิธิเพื่อผู้บริโภค” ซึ่งนับตั้งแต่ปี 2548 จนถึงปี
                            2559 ศูนย์ทนายความฯ มีผลการดำเนินคดีเพื่อคุ้มครองสิทธิอันพึงมีพึงได้ของผู้บริโภค จำนวนทั้งสิ้น
                            534 คดี</p>
                    </div>
                    <div class="row subject-2">
                        <div class="col-5">
                            <img src="<?php echo base_url('assets/img/subject-2.png') ?>" class="w-100">
                        </div>
                        <div class="col-7 pl-2 pl-0-lg pr-0">
                            <ul class="mb-1 pl-4">
                                <li>สนับสนุนศูนย์ทดสอบฉลาดซื้อ</li>
                            </ul>
                            <p>ถึงแม้ว่าการทดสอบแต่ละครั้ง จะต้องใช้งบประมาณที่สูงมาก แต่เราก็ไม่หยุดที่จะ
                                ทดสอบสินค้าและบริการ ให้ผู้บริโภครู้ว่าสินค้า หรือบริการนั้นๆ ยี่ห้อไหนมีคุณภาพ
                                และราคาไม่แพง คุ้มค่ากับเงินที่จ่ายไป รวมไปถึงการทดสอบสินค้าที่ไม่ปลอดภัย ต่อผู้บริโภค
                                และเผยแพร่เพื่อเป็นประโยชน์ต่อสาธารณะ</p>
                        </div>
                        <p class="text-center small">มูลนิธิเพื่อผู้บริโภค เป็นองค์กรสาธารณะประโยชน์ ลำดับที่ 576
                            ตามประกาศกระทรวงการคลัง<br>ทุกยอดการบริจาคนำไปหลดหย่อนภาษีประจำปีได้</p>
                    </div>
                </div>
           <?php }else{ ?>
                <div class="tab-body mb-5 d-none" id="tab-body-2">
                    <h2 class="text-center mt-5 mt-4-lg mb-3">How we spend your donations</h2>
                    <ul>
                        <li>We help pay legal costs of consumer cases in court.</li>
                    </ul>
                    <div class="img">
                        <img src="<?php echo base_url('assets/img/subject-1.png') ?>">
                    </div>
                    <div class="subject-1">
                        <h3 class="mt-2">Do you know…? </h3>
                        <p>A lot of distraught consumers without enough money to enter the legal process have sought help from our “Lawyers for Consumer Protection Center”.  Between 2005 and 2016 the center had handled 534 consumer cases.</p>
                    </div>
                    <div class="row subject-2">
                        <div class="col-5">
                            <img src="<?php echo base_url('assets/img/subject-2.png') ?>" class="w-100">
                        </div>
                        <div class="col-7 pl-2 pl-0-lg pr-0">
                            <ul class="mb-1 pl-4">
                                <li>We fund product / service tests by Chaladsue Test Center.</li>
                            </ul>
                            <p>Comparative tests are quite expensive but we insist on conducting them because we want consumers to see the real quality and performance of the products/services before making decisions.  We also conduct tests on product safety and publish the results for the public interest.  Your donation will help us pay lab fees.</p>
                        </div>
                        <p class="text-center small">Foundation for Consumers is public interest organization number 576, according to the Ministry of Finance’s notification.<br>Any donation made to us is eligible for tax reduction.</p>
                    </div>
                </div>
           <?php }?>

            <?php if($this->_myLang=="thai"){?>
                <div class="tab-body mb-5 d-none" id="tab-body-3">
                    <div class="d-flex mt-5 mt-4-lg mb-4">
                        <img src="<?php echo base_url('assets/img/safety.png') ?>" class="safety">
                    </div>
                    <h2 class="mt-5 mb-4 mt-4-lg  text-center">Contribute to our cause via safe online payment.</h2>
                    <div class="d-flex">
                        <p>เว็บไซต์ของเรามีความปลอดภัย<br>ข้อมูลบัตรเครดิตรของคุณจะไม่ถูกเก็บไว้ในระบบ<br>ขณะที่ข้อมูลส่วนบุคคลของคุณ<br>ได้รับการปกป้องตามนโยบายรักษาความเป็นส่วนตัว
                        </p>
                    </div>
                    <p class="subject-3 mb-4">มูลนิธิเพื่อผู้บริโภคเป็นองค์กรสาธารณะประโยชน์ ลำดับที่ 576
                        ตามประกาศกระทรวงการคลัง
                        ทุกยอดการบริจาคสามารถนำไปลดหย่อนภาษีประจำปีได้</p>
                </div>
            <?php }else{ ?>
                <div class="tab-body mb-5 d-none" id="tab-body-3">
                    <div class="d-flex mt-5 mt-4-lg mb-4">
                        <img src="<?php echo base_url('assets/img/safety.png') ?>" class="safety">
                    </div>
                    <h2 class="mt-5 mb-4 mt-4-lg  text-center">Contribute to our cause via safe online payment.</h2>
                    <div class="d-flex">
                       <ul class="list-unstyled content-list">
                           <li>Our website is safe. </li>
                           <li>Your credit card information will not be stored in the system</li>
                           <li>while your personal information is protected under the privacy protection policy.</li>

                       </ul>
                    </div>
                    <p class="subject-3 mb-4">Foundation for Consumers is public interest organization number 576, according to the Ministry of Finance’s notification.  All donations are eligible for tax reduction.</p>
                </div>
            <?php }?>



        </div>
    </div>
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 pl-5 pl-0-lg pr-0-lg" id="container-right">
        <form id="2c2p-payment-form" method="post" action="<?php echo base_url('donation/2c2p-payment') ?>">
            <div class="payment-container" id="payment-1">
                <h1 class="mt-3 mb-3 text-center"><?php echo $this->lang->line('induce_info')?></h1>
                <hr width="50%">
                <div class="mt-2">
                    <div class="d-flex position-relative">
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-1.png') ?>" class="w-75-lg">
                            <p class="position-absolute state-1 state-active">1 <?php echo $this->lang->line('amount');?></p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-2-gray.png') ?>"
                                 class="mr-3 ml-3 w-75-lg">
                            <p class="position-absolute state-2">2 <?php echo $this->lang->line('detail');?></p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-3-gray.png') ?>" class="w-70-lg">
                            <p class="position-absolute state-3">3 <?php echo $this->lang->line('payment');?></p>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <img src="<?php echo base_url('assets/img/pig-icon.png') ?>" class="mr-2 h-30">
                        <span class="state-1-header"><?php echo $this->lang->line('payment_info');?></span>
                    </div>
                    <div class="mt-3 mr-5 text-center">
                        <button type="button" class="money ml-3 mr-3" id="100B" value="100">100</button>
                        <button type="button" class="money ml-3 mr-3" id="300B" value="300">300</button>
                    </div>
                    <div class="mt-3 ml-5 text-center">
                        <button type="button" class="money ml-3 mr-3" id="500B" value="500">500</button>
                        <button type="button" class="money ml-3 mr-3" id="1000B" value="1000">1000</button>
                    </div>
                    <p class="mt-4 pl-5 pl-4-lg mb-2 money-input-header"><?php echo $this->lang->line('custom_amount_info');?></p>
                    <input type="number" name="money-input" id="money-input"
                           class="form-control money-input ml-5 ml-4-lg pl-4" value="100" min="100">
                    <p class="mt-2 pl-5 pl-4-lg mb-4 money-input-sub"><?php echo $this->lang->line('tax_info');?></p>
                    <div class="d-flex">
                        <button type="button" class="next position-relative mb-4" id="next-payment-1"><span
                                    class="position-absolute"><i class="fa fa-angle-double-right"></i></span>Next
                        </button>
                    </div>
                </div>
            </div>
            <div class="payment-container d-none" id="payment-2">
                <h1 class="mt-3 mb-3 text-center"><?php echo $this->lang->line('induce_info')?></h1>
                <hr width="50%">
                <div class="mt-2">
                    <div class="d-flex position-relative pointer">
                        <div class="position-relative" id="payment-2_state-1">
                            <img src="<?php echo base_url('assets/img/state-button-2-gray.png') ?>" class="w-75-lg">
                            <p class="position-absolute state-1">1 จำนวนเงิน</p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-1.png') ?>"
                                 class="mr-3 ml-3 w-75-lg">
                            <p class="position-absolute state-2 state-active">2 รายละเอียด</p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-3.png') ?>" class="w-70-lg">
                            <p class="position-absolute state-3">3 การชำระเงิน</p>
                        </div>
                    </div>
                </div>
                <div class="ml-5 ml-4-lg mt-3">
                    <div id="donate-choose">
                        <div class="mt-3">
                            <img src="<?php echo base_url('assets/img/money-icon.png') ?>" class="mr-2 ml-2 h-30">
                            <span class="state-2-header">เลือกรูปแบบการชำระเงิน</span>
                        </div>
                        <div class="payment-choose-container position-relative mt-3">
                            <label class="radio-label mb-0"> ไม่ประสงค์ออกนาม
                                <input type="radio" name="donate-type" id="donate-type-1" value="type-1"
                                       checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="payment-choose-container position-relative mt-2">
                            <label class="radio-label mb-0"> ประสงค์ออกนาม
                                <input type="radio" name="donate-type" value="type-2">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="payment-choose-container position-relative mt-2">
                            <label class="radio-label mb-0"> ต้องการนำใบเสร็จไปลดหย่อนภาษี
                                <input type="radio" name="donate-type" value="type-3">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div id="bill" class="mt-4">
                        <div>
                            <img src="<?php echo base_url('assets/img/bill-icon.png') ?>" class="mr-2 ml-2 h-30">
                            <span class="state-2-header h-30">ข้อมูลใบเสร็จ</span>
                        </div>
                        <div class="row mt-2 position-relative">
                            <span class="input-sub position-absolute ml-5">กรุณากรอกด้วยชื่อ-สกุลจริง ตามบัตรประชาชน เพื่อสิทธิประโยชน์ในการลดหย่อนภาษี</span>
                            <span class="input-sub-2 position-absolute ml-5">กรอกเบอร์มือถือ เช่น 0891234567</span>
                            <div class="col-6-xl col-12-lg pr-0 pl-5 pl-4-lg mr-2">
                                <label class="state-2-label mb-1 pl-1 mr-2">ชื่อ / บริษัท
                                    ผู้บริจาค<span> *</span></label>
                                <input type="text" name="name" class="form-control pr-4 bil-input">
                                <label class="state-2-label mt-5 mb-1 pl-1 mr-2">เบอร์โทรศัพท์มือถือ<span> *</span></label>
                                <input type="text" name="tel" class="form-control pr-4 bil-input">
                            </div>
                            <div class="col-6-xl col-12-lg pl-0 pl-4-lg mt-4-lg">
                                <label class="state-2-label mb-1 pl-1">เลขผู้เสียภาษี หรือ เลขบัตรประชาชน<span> *</span></label>
                                <input type="text" name="tax_id" class="form-control pr-4 bil-input">
                            </div>
                        </div>
                        <div class="mt-5">
                            <img src="<?php echo base_url('assets/img/mail-icon.png') ?>" class="mr-2 ml-2 h-30">
                            <span class="state-2-header h-30">ช่องทางการส่งใบเสร็จ</span>
                            <div class="row position-relative">
                                <div class="col-9 pr-0 pl-5 pl-4-lg mr-2 mt-2">
                                    <label class="state-2-label mb-1 pl-1">อีเมล<span> *</span></label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="col-9 pr-0 pl-5 pl-4-lg mr-2 mt-2">
                                    <label class="state-2-label mb-1 pl-1">ที่อยู่ สำหรับออกใบเสร็จ
                                        เพื่อใช้ลดหย่อนภาษี<span> *</span></label>
                                    <textarea id="donor-address" name="adress1" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <img src="<?php echo base_url('assets/img/newspaper.png') ?>" class="mr-2 ml-2 h-30">
                        <span class="state-2-header h-30">ข้อมูลข่าวสารเพิ่มเติม</span>
                        <div class="payment-choose-container position-relative mt-3">
                            <label class="radio-label mb-0"> รับข้อมูลข่าวสารผ่านทาง Email
                                <input type="radio" name="news-type" id="yes" checked="checked" value="1">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="payment-choose-container position-relative mt-2">
                            <label class="radio-label mb-0"> ยังไม่สนใจ
                                <input type="radio" name="news-type" value="2">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="row position-relative">
                        <div class="col-8-xl col-9-lg pr-0 pl-5 pl-4-lg mt-2">
                            <label class="state-2-label mb-1 pl-1">อีเมล</label>
                            <input type="email" name="new-email" id="new-email" class="form-control" value="">
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <button type="button" class="next position-relative mb-3" id="next-payment-2"><span
                                class="position-absolute"><i class="fa fa-angle-double-right"></i></span>Next
                    </button>
                </div>
            </div>
            <div class="payment-container d-none" id="payment-3">
                <h1 class="mt-3 mb-3 text-center"><?php echo $this->lang->line('induce_info')?></h1>
                <hr width="50%">
                <div class="mt-2">
                    <div class="d-flex position-relative">
                        <div class="position-relative pointer" id="payment-3_state-1">
                            <img src="<?php echo base_url('assets/img/state-button-2-gray.png') ?>" class="w-75-lg">
                            <p class="position-absolute state-1 w-75-lg">1 จำนวนเงิน</p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-2-gray.png') ?>"
                                 class="mr-3 ml-3 w-75-lg" id="payment-3_state-2">
                            <p class="position-absolute state-2 w-75-lg">2 รายละเอียด</p>
                        </div>
                        <div class="position-relative pointer">
                            <img src="<?php echo base_url('assets/img/state-button-3.png') ?>" class="w-70-lg">
                            <p class="position-absolute state-3 state-active">3 การชำระเงิน</p>
                        </div>
                    </div>
                    <div id="payment-choose">
                        <div class="d-flex mt-3">
                            <img src="<?php echo base_url('assets/img/money-icon.png') ?>" class="mr-2 h-30">
                            <span class="state-1-header">เลือกรูปแบบการชำระเงิน</span>
                        </div>
                        <div class="payment-choose-container position-relative mt-3">
                            <label class="radio-label mb-0"> บัตรเดบิต / บัตรเครดิต
                                <input type="radio" name="payment-type" value="type-1" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                            <span class="ml-4 sub-payment">(ชำระผ่าน VISA, Master Card)</span>
                            <div class="payment-logo-contrainer position-absolute d-none d-lg-block">
                                <img src="<?php echo base_url('assets/img/visa-icon.png') ?>">
                                <img src="<?php echo base_url('assets/img/mastercard-icon.png') ?>">
                            </div>
                        </div>
                        <div class="payment-choose-container position-relative mt-4">
                            <label class="radio-label mb-0"> Prompt Pay / QR Code (รับได้ทุกธนาคาร)
                                <input type="radio" name="payment-type" value="type-2">
                                <span class="checkmark"></span>
                            </label>
                            <img src="<?php echo base_url('assets/img/prompt-pay-icon.png') ?>"
                                 class="ml-4 mt-2 d-none d-lg-inline-block">
                            <img src="<?php echo base_url('assets/img/qr-icon.png') ?>"
                                 class="ml-3 mt-2 d-none d-lg-inline-block">
                        </div>
                        <div class="payment-choose-container position-relative mt-4">
                            <label class="radio-label mb-0"> โอนผ่านบัญชีธนาคาร
                                <input type="radio" name="payment-type" value="type-3">
                                <span class="checkmark"></span>
                            </label>
                            <img src="<?php echo base_url('assets/img/scb-icon.png') ?>"
                                 class="ml-4 mt-2 d-none d-lg-inline-block">
                            <img src="<?php echo base_url('assets/img/kbank-icon.png') ?>"
                                 class="mt-2 d-none d-lg-inline-block">
                            <img src="<?php echo base_url('assets/img/bay-icon.png') ?>"
                                 class="mt-2 d-none d-lg-inline-block">
                            <img src="<?php echo base_url('assets/img/ktb-icon.png') ?>"
                                 class="mt-2 d-none d-lg-inline-block">
                            <img src="<?php echo base_url('assets/img/bbl-icon.png') ?>"
                                 class="mt-2 d-none d-lg-inline-block">
                        </div>
                        <div class="d-flex mt-4">
                            <button type="button" class="next position-relative mb-4" id="next-payment-3"><span
                                        class="position-absolute"><i class="fa fa-angle-double-right"></i></span>Next
                            </button>
                        </div>
                    </div>
                    <div id="payment-type-1" class="d-none">
                        <div class="payment-choose-container position-relative mt-3">
                            <label class="radio-label mb-0"> บัตรเดบิต / บัตรเครดิต
                                <input type="radio" name="payment-type-1" value="type-1" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                            <span class="ml-4 sub-payment">(ชำระผ่าน VISA, Master Card)</span>
                            <div class="payment-logo-contrainer position-absolute d-none d-lg-block">
                                <img src="<?php echo base_url('assets/img/visa-icon.png') ?>">
                                <img src="<?php echo base_url('assets/img/mastercard-icon.png') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7 pr-0 ml-5 mt-4">
                                <label class="state-2-label mb-1 pl-1">หมายเลขบัตร<span> *</span></label>
                                <input type="text" name="card-number" data-encrypt="cardnumber" class="form-control"
                                       maxlength="16">

                            </div>
                            <div class="col-7 pr-0 ml-5 mt-4">
                                <label class="state-2-label mb-1 pl-1">ชื่อบนบัตร
                                    (ภาษาอังกฤษเท่านั้น)*<span> *</span></label>
                                <input type="text" name="cardholderName" class="form-control">
                            </div>
                            <div class="col-8 pr-0 ml-5 mt-4">
                                <label class="state-2-label mb-1 pl-1">วันหมดอายุ เดือน/ปี<span> *</span></label>
                                <div class="row ml-0">
                                    <div class="col-5 pl-0 mr-3">
                                        <input type="text" name="month" class="form-control" data-encrypt="month"
                                               maxlength="2" placeholder="MM">

                                    </div>
                                    <div class="col-5 pl-0">
                                        <input type="text" data-encrypt="year" maxlength="4" placeholder="YYYY"
                                               name="year" class="form-control">

                                    </div>
                                </div>
                            </div>
                            <div class="col-4 pr-0 ml-5 mt-4 position-relative">
                                <label class="state-2-label mb-1 pl-1">หมายเลข CVC/CVV/CID<span> *</span></label>
                                <input type="password" data-encrypt="cvv" maxlength="4" autocomplete="off"
                                       placeholder="CVV2/CVC2" name="cvc" class="form-control">

                                <img src="<?php echo base_url('assets/img/credit-icon.png') ?>"
                                     class="position-absolute credit-icon">
                            </div>
                        </div>
                        <p class="ml-5 mt-3 mb-0">รหัสความปลอดภัยบัตร </p>
                        <p class="ml-5 mb-0">CVC/CVV/CID คือตัวเลข 3-4 ตัว </p>
                        <p class="ml-5 mb-0">ที่ถูกพิมพ์อยู่ด้านหน้าหรือหลังบัตรของคุณ </p>
                        <p class="ml-5 mb-0">(ไม่ใช่หมายเลขบัตรตัวนูน) </p>
                        <div class="d-flex">
                            <button type="button" value="Checkout" onclick="Checkout()"
                                    style="width: 120px;padding-left: 20px;"
                                    class="confirm-btn next position-relative mb-4 mt-4 done"><span
                                        class="position-absolute"><i class="fa fa-angle-double-right"></i></span>
                                Confirm
                            </button>
                        </div>
                    </div>
                    <div id="payment-type-2" class="d-none">
                        <div class="payment-choose-container position-relative mt-4">
                            <label class="radio-label mb-0"> Prompt Pay / QR Code (รับได้ทุกธนาคาร)
                                <input type="radio" name="payment-type-2" value="type-2" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <p class="text-center mt-3">คุณสามารถบริจาคผ่าน QR Code ทุกธนาคาร หรือ Mobile Banking
                            ของธนาคารของคุณ</p>
                        <div class="row">
                            <div class="col-xl-5 pr-0 text-center">
                                <div>
                                    <img src="<?php echo base_url('assets/img/prompt-pay-icon.png') ?>"
                                         class="mb-2 mr-2 h-20">
                                </div>
                                <div>
                                    <img src="<?php echo base_url('assets/img/qr.png') ?>" class="h-60">
                                </div>
                                <p class="mb-0 mt-2 qr-text">ชื่อบัญชี : มูลนิธิเพื่อผู้บริโภค (2)</p>
                                <p class="qr-text">หมายเลขพร้อมเพย์ 0993000203941</p>
                            </div>
                            <div class="col-xl-7 pl-0">
                                <div class="qr-text-container">
                                    <ol class="pl-4 mb-0">
                                        <li class="qr-text">Log-in Mobile Banking ของธนาคารของคุณ</li>
                                        <li class="qr-text">เลือกเมนู Scan QR Code</li>
                                        <li class="qr-text">Scan QR ที่ปรากฎในหน้าจอนี้</li>
                                        <li class="qr-text">ตรวจสอบยอดเงิน และชื่อบัญชี ว่าใช่มูลนิธิที่คุณ
                                            กำลังจะบริจาคหรือไม่
                                        </li>
                                        <li class="qr-text">เมื่อทำรายการบน Mobile Banking เรียบร้อย
                                            หน้าจอจะแสดงผลสำเร็จ
                                        </li>
                                        <li class="qr-text">อัปโหลดหลักฐานการโอน</li>
                                        <li class="qr-text">รอรับใบเสร็จรับเงินทางอีเมลที่แจ้งไว้</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-xl-1"></div>
                            <div class="col-xl-10 col-12-lg mt-4">
                                <div class="transfer-header text-center">
                                    <span>วิธีส่งหลักฐานการโอน</span>
                                </div>
                                <div class="transfer-body">
                                    <p class="mb-0">1. อัปโหลดหลักฐานการโอนเงินด้านล่างหน้านนี้ หรือ</p>
                                    <p class="mb-0">2. ส่งมาที่ อีเมล donationffc@gmail.com หรือ 3. ส่งมาที่ ไลน์แอท
                                        @chaladsue.online
                                        พร้อมใส่รายละเอียดชื่อ - ที่อยู่ ที่จะให้ทางมูลนิธิฯ ออกใบเสร็จรับเงิน
                                        เพื่อใช้ในการลดหย่อนภาษี
                                        ระบบจะส่งใบเสร็จรับเงินบริจาคทางอีเมลที่ได้แจ้งไว้</p>
                                </div>
                            </div>
                            <div class="col-xl-1"></div>
                            <div class="col-xl-6 col-lg-12 upload-container d-flex ml-5">
                                <div class="mr-3 ml-5 ml-0-lg">
                                    <p class="mb-0 mt-3">คลิกเพื่ออัปโหลด</p>
                                    <p>หลักฐานการโอน</p>
                                </div>
                                <div class="inputWrapper">
                                    <input class="fileInput" type="file" name="file1"/>
                                    <img src="<?php echo base_url('assets/img/upload-icon.png') ?>"
                                         class="position-absolute upload-icon">
                                </div>
                            </div>
                            <div class="d-flex col-lg-12 mt-4 ml-4">
                                <button class="next position-relative mb-4 done"><span class="position-absolute"><i
                                                class="fa fa-angle-double-right"></i></span>Next
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="payment-type-3" class="d-none">
                        <div class="payment-choose-container position-relative mt-4">
                            <label class="radio-label mb-0"> โอนผ่านบัญชีธนาคาร
                                <input type="radio" name="payment-type-3" value="type-3" checked="checked">
                                <span class="checkmark"></span>
                                <img src="<?php echo base_url('assets/img/scb-icon.png') ?>" class="ml-4">
                                <img src="<?php echo base_url('assets/img/kbank-icon.png') ?>">
                                <img src="<?php echo base_url('assets/img/bay-icon.png') ?>">
                                <img src="<?php echo base_url('assets/img/ktb-icon.png') ?>">
                                <img src="<?php echo base_url('assets/img/bbl-icon.png') ?>">
                            </label>
                        </div>
                        <div class="payment-choose-container mt-3">
                            <div class="row">
                                <div class="col-12 pl-4 mt-2">
                                    <p>ชื่อบัญชี มูลนิธิเพื่อผู้บริโภค</p>
                                </div>
                                <div class="col-xl-6 col-lg-12 pl-4">
                                    <div class="row">
                                        <div class="col-3 pr-0">
                                            <img src="<?php echo base_url('assets/img/scb-icon-45.png') ?>"
                                                 class="h-30">
                                        </div>
                                        <div class="col-9 pl-0 pr-0">
                                            <p class="payment-type-3-text mb-0 ml-4">ธนาคารไทยพาณิชย์</p>
                                            <p class="payment-type-3-text mb-0 ml-4">สาขา งามวงศ์วาน</p>
                                            <p class="payment-type-3-text mb-0 ml-4">319 - 2 - 62123 - 1</p>
                                        </div>
                                        <div class="col-3 pr-0 mt-3">
                                            <img src="<?php echo base_url('assets/img/bay-icon-45.png') ?>"
                                                 class="h-30">
                                        </div>
                                        <div class="col-9 pl-0 pr-0 mt-3">
                                            <p class="payment-type-3-text mb-0 ml-4">ธนาคารกรุงศรีอยุธยา</p>
                                            <p class="payment-type-3-text mb-0 ml-4">สาขาย่อย เดอะมอลล์งามวงศ์วาน</p>
                                            <p class="payment-type-3-text mb-0 ml-4">463 - 1 - 10884 - 6</p>
                                        </div>
                                        <div class="col-3 pr-0 mt-3">
                                            <img src="<?php echo base_url('assets/img/bbl-icon-45.png') ?>"
                                                 class="h-30">
                                        </div>
                                        <div class="col-9 pl-0 pr-0 mt-3" class="h-30">
                                            <p class="payment-type-3-text mb-0 ml-4">ธนาคารกรุงเทพ</p>
                                            <p class="payment-type-3-text mb-0 ml-4">สาขาย่อย เดอะมอลล์งามวงศ์วาน</p>
                                            <p class="payment-type-3-text mb-0 ml-4">088 - 0 - 38742 - 8</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12  pl-4-lg">
                                    <div class="row pr-4 pr-0-lg mt-3-lg">
                                        <div class="col-3 pr-0 pr-0-lg">
                                            <img src="<?php echo base_url('assets/img/kbank-icon-45.png') ?>"
                                                 class="h-30">
                                        </div>
                                        <div class="col-9 pl-0 pr-0">
                                            <p class="payment-type-3-text mb-0 ml-4">ธนาคารกสิกรไทย</p>
                                            <p class="payment-type-3-text mb-0 ml-4">สาขา งามวงศ์วาน</p>
                                            <p class="payment-type-3-text mb-0 ml-4">058 - 2 - 86735 - 6</p>
                                        </div>
                                        <div class="col-3 pr-0 mt-3">
                                            <img src="<?php echo base_url('assets/img/ktb-icon-45.png') ?>"
                                                 class="h-30">
                                        </div>
                                        <div class="col-9 pl-0 pr-0 mt-3">
                                            <p class="payment-type-3-text mb-0 ml-4">ธนาคารกรุงไทย</p>
                                            <p class="payment-type-3-text mb-0 ml-4">สาขา งามวงศ์วาน</p>
                                            <p class="payment-type-3-text mb-0 ml-4">141 - 1 - 28408 - 9</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-1"></div>
                            <div class="col-xl-10 col-12-lg mt-4">
                                <div class="transfer-header text-center">
                                    <span>วิธีส่งหลักฐานการโอน</span>
                                </div>
                                <div class="transfer-body">
                                    <p class="mb-0">1. อัปโหลดหลักฐานการโอนเงินด้านล่างหน้านนี้ หรือ</p>
                                    <p class="mb-0">2. ส่งมาที่ อีเมล donationffc@gmail.com หรือ 3. ส่งมาที่ ไลน์แอท
                                        @chaladsue.online
                                        พร้อมใส่รายละเอียดชื่อ - ที่อยู่ ที่จะให้ทางมูลนิธิฯ ออกใบเสร็จรับเงิน
                                        เพื่อใช้ในการลดหย่อนภาษี
                                        ระบบจะส่งใบเสร็จรับเงินบริจาคทางอีเมลที่ได้แจ้งไว้</p>
                                </div>
                            </div>
                            <div class="col-xl-1"></div>
                            <div class="col-xl-6 col-lg-12 upload-container d-flex ml-5 ml-0-lg">
                                <div class="mr-3 ml-5">
                                    <p class="mb-0 mt-3">คลิกเพื่ออัปโหลด</p>
                                    <p>หลักฐานการโอน</p>
                                </div>
                                <div class="inputWrapper">
                                    <input class="fileInput" type="file" name="file1"/>
                                    <img src="<?php echo base_url('assets/img/upload-icon.png') ?>"
                                         class="position-absolute upload-icon">
                                </div>
                            </div>
                            <div class="d-flex col-lg-12 mt-4 ml-4">
                                <button class="next position-relative mb-4 done"><span class="position-absolute"><i
                                                class="fa fa-angle-double-right"></i></span>Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>


</body>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-xl">
    <div class="d-none d-xl-block">
        <img src="<?php echo base_url('assets/img/lock-icon.png') ?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span
                class="footer-text ml-4">สอบถามข้อมูลเพิ่มเติม</span><img
                src="<?php echo base_url('assets/img/tel-icon.png') ?>" class="ml-4"><span class="footer-text ml-2">089 761 9150, 089 765 9151</span>
    </div>
</footer>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-lg">
    <div class="d-xl-none">
        <img src="<?php echo base_url('assets/img/lock-icon.png') ?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span
                class="footer-text ml-4 pull-right">สอบถามข้อมูลเพิ่มเติม</span><span
                class="footer-text ml-2 pull-right">089 761 9150, 089 765 9151</span><img
                src="<?php echo base_url('assets/img/tel-icon.png') ?>" class="ml-2 pull-right">
    </div>
</footer>

<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/script.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vue.js') ?>"></script>
<script src="<?php echo base_url('assets/js/axios.js') ?>"></script>
<script src="<?php echo base_url('assets/js/donate.js') ?>"></script>
<!--Importing 2c2p JSLibrary-->
<!--Demo-->
<!--<script type="text/javascript" src="https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/api/my2c2p.1.6.9.min.js"></script>-->
<script type="text/javascript" src="https://t.2c2p.com/securepayment/api/my2c2p.1.6.9.min.js"></script>
<script type="text/javascript">
    <!--checkout function-->
    function Checkout() {
        //your code here
        //if there is no error, submit the form.
        My2c2p.submitForm("2c2p-payment-form", function (errCode, errDesc) {
            if (errCode != 0) {
                alert(errDesc + " (" + errCode + ")");
            }
        });

    }
</script>

</html>
