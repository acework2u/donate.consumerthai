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
        <a href="<?php echo get_array_value($media_urls,'twitter');?>"><img src="<?php echo base_url('assets/img/twitter-icon.png')?>" class="h-30"></a>
<!--        <img src="--><?php //echo base_url('assets/img/ig-icon.png')?><!--" class="h-30">-->
<!--        <a href="--><?php //echo get_array_value($media_urls,'google.plus');?><!--"><img src="--><?php //echo base_url('assets/img/google_plus-icon.png')?><!--" class="h-30"></a>-->
<!--        <a href=""><img src="--><?php //echo base_url('assets/img/pinterest-icon.png')?><!--" class="h-30"></a>-->

        <a data-pin-do="buttonPin" data-pin-custom="true" data-pin-tall="true" href="https://www.pinterest.com/pin/create/button/?url=https%3A%2F%2Fdonate.consumerthai.org&media=https%3A%2F%2Fdonate.consumerthai.org%2Fassets%2Fimg%2Fthank.png&description=Next%20stop%3A%20Foundation%20for%20Consumers"><img class="h-30" src="//assets.pinterest.com/images/pidgets/pinit_fg_en_round_red_32.png" /></a>

    </div>
    <div class="mt-2 ml-5 mb-2 position-relative">
        <img src="<?php echo base_url('assets/img/share-icon.png')?>" class="ml-5 ml-0-lg h-30">
        <span>แชร์บอกเพื่อน</span>
        <a href="<?php echo site_url()?>"><img src="<?php echo base_url('assets/img/click-donate.png')?>" class="ml-5 position-absolute click-donate h-60"></a>
    </div>
</div>
</div>


