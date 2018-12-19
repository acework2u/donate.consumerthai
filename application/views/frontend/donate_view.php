<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/front/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">




    <title>Consumer Thailand Donate Page</title>
</head>
<body>

<main role="main" class="container-fluid" id="appDonate">

    <div class="row bg-header">

            <div class="col-12 col-md-4">
                <img class="img-responsive" src="<?php echo base_url('assets/img/consumerthai-logo.png') ?>">
            </div>
            <div class="col-12 col-md-6 d-none d-lg-block"><img class="img-responsive float-sm-left" src="<?php echo base_url('assets/img/top-banner.png') ?>"></div>

            <div class="col-12 col-md-2">
                <ul class="mt-2 float-right  nav">
                    <li class="nav-item">
                        <a @click="switchlang" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/thai"
                           class="nav-link active text-yellow"><img
                                    src="<?php echo base_url('assets/img/icon/thailand-flag-round-icon-32.png') ?>"> TH</a>
                    </li>
                    <li class="nav-item">
                        <a @click="switchlang" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english"
                           class="nav-link"><img
                                    src="<?php echo base_url('assets/img/icon/united-states-of-america-flag-round-icon-32.png') ?>">
                            EN</a>
                    </li>
                </ul>
            </div>
        <div class="w-100"></div>
            <div class="col-12 col-md-2"><img class="img-responsive d-none d-sm-block"
                                     src="<?php echo base_url('assets/img/icon/home-mini.png') ?>">
            </div>
            <div class="mt-sm-3 col-12 col-md-10"><span class="float-md-right text-banner-center d-none d-sm-block">คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม เราได้กำลังใจ</span>
            </div>

    </div>

<div class="clear"></div>

    <div class="row d-block d-sm-none">
        <div class="col-12"><span class="float-md-right text-banner-center text-white"><em> คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม เราได้กำลังใจ </em></span></div>
    </div>

    <div class="row bg-header d-none">

        <div class="col-12 col-md-4 header-a-logo">

            <img class="img-responsive" src="<?php echo base_url('assets/img/consumerthai-logo.png') ?>">

            <div>
                <img class="img-responsive" src="<?php echo base_url('assets/img/icon/home-mini.png') ?>">
            </div>

        </div>
        <div class="col-12 col-md-6 top-banner">
            <img class="img-responsive" src="<?php echo base_url('assets/img/top-banner.png') ?>">
            <div class="mt-2">
                <span class="text-banner-center"><em>คุณได้บุญ เราได้ทำงาน ...คุณได้รอยยิ้ม เราได้กำลังใจ</em></span>
            </div>

        </div>
        <div class="col-12 col-md-2">

            <ul class="mt-2 float-right  nav">

                <li class="nav-item">
                    <a @click="switchlang" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/thai"
                       class="nav-link active"><img
                                src="<?php echo base_url('assets/img/icon/thailand-flag-round-icon-32.png') ?>"> TH</a>
                </li>
                <li class="nav-item">
                    <a @click="switchlang" href="<?php echo base_url(); ?>LanguageSwitcher/switchLang/english"
                       class="nav-link"><img
                                src="<?php echo base_url('assets/img/icon/united-states-of-america-flag-round-icon-32.png') ?>">
                        EN</a>
                </li>
            </ul>

            <select class="selectpicker d-none" data-width="fit">
                <option data-content='<span class="flag-icon flag-icon-us"></span> English'><img
                            src="<?php echo base_url('assets/img/icon/united-states-of-america-flag-round-icon-32.png') ?>">
                    EN
                </option>
                <option data-content='<span class="flag-icon flag-icon-th"></span> Español'>TH</option>
            </select>

        </div>

    </div>

    <div class="row">
        <div class="col-12 col-md-6">

            <div class="news-content full-width-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">เราคือใคร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">เราใช้เงินบริจาคอย่างไร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#messages" role="tab">ความปลอดภัย</a>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content box-content bg-green-light">
                    <div class="tab-pane active" id="home" role="tabpanel">pane 1</div>
                    <div class="tab-pane" id="profile" role="tabpanel">pane 2</div>
                    <div class="tab-pane" id="messages" role="tabpanel">pane 3</div>

                </div>


            </div>


        </div>
        <div class="col-12 col-md-6">
            <div class="box-body news-content">
                <div class="box-content bg-content">
                    ร่วมบริจาคเพื่อสนับสนุนฟ้องคดี ให้แก่ผู้บริโภคที่ได้รับความเสียหาย และสนับสนุนศูนย์ทดสอบฉลาดซื้อ ให้ทดสอบสินค้าและบริการ

                <div class="row">
                    <div class="col-12"><button class="btn bg-yellow-gradient">1. จำนวนเงิน</button></div>
                    <div class="col-12"><button class="btn bg-yellow-gradient">2. รายละเอียด</button></div>
                    <div class="col-12"><button class="btn bg-yellow-gradient">3. การชำระเงิน</button></div>
                </div>
                <div class="row">
                    <div class="col-12"><input class="rounded-right" type="button" value="100"></div>
                    <div class="col-12"><input class="rounded-right" type="button" value="300"></div>
                    <div class="col-12"><input class="rounded-right" type="button" value="500"></div>
                    <div class="col-12"><input class="rounded-right" type="button" value="1000"></div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <span></span>
                        <input type="number">
                    </div>
                </div>



                </div>




            </div>

            <div class="card border-0 d-none ">
                <div class="card-body box-content border-0 ">
                    <?php $ap = array('english' => 'MY Content', 'thai' => 'บทความฉันเอง') ?>
                    <p>This Lang : <?php if (isset($_SESSION['site_lang'])) {
                            echo $ap[$this->session->userdata('site_lang')];
                            echo " " . $_SESSION['site_lang'];
                        } ?></p>


                    ร่วมบริจาคเพื่อสนับสนุนฟ้องคดี ให้แก่ผู้บริโภคที่ได้รับความเสียหาย และสนับสนุนศูนย์ทดสอบฉลาดซื้อ ให้ทดสอบสินค้าและบริการ
                </div>
                <div class="card-footer">
                    <input ref="input-lang" type="text" value="<?php echo $_SESSION['site_lang'] ?>">
                </div>
            </div>


        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-6">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                       aria-controls="nav-home" aria-selected="true">เราคือใคร</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                       aria-controls="nav-profile" aria-selected="false">เราใช้เงินอย่างไร</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                       aria-controls="nav-contact" aria-selected="false">ความปลอดภัย</a>

                </div>
            </nav>


            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>

            </div>
        </div>
        <div class="col-12 col-md-6">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                       aria-controls="nav-home" aria-selected="true">เราคือใคร</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                       aria-controls="nav-profile" aria-selected="false">เราใช้เงินอย่างไร</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                       aria-controls="nav-contact" aria-selected="false">ความปลอดภัย</a>

                </div>
            </nav>


            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <i class="fab fa-bitcoin bg-red"></i>Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                    veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                    Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                    non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                    ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                    Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                </div>

            </div>
        </div>




    </div>




    <div class="row">
        <div class="">
            <div class="col-12 col-md-12"></div>
        </div>
    </div>

</main>

<footer class="footer bg-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"><span class="text-muted">Place sticky footer content here.</span></div>
            <div class="col-md-8">2</div>
            <div class="col-md-2">3</div>
        </div>
    </div>
</footer>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo base_url('assets/js/jquery-3.3.1.slim.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/vue.js') ?>"></script>
<script src="<?php echo base_url('assets/js/donate.js') ?>"></script>


</body>
</html>
