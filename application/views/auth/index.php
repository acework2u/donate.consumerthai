<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>SRV Selection Software</title>
    <!-- Icons-->
    <link href="<?php echo base_url('node_modules/@coreui/icons/css/coreui-icons.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/flag-icon-css/css/flag-icon.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('node_modules/simple-line-icons/css/simple-line-icons.css');?>" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="<?php echo base_url('src/css/style.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('src/vendors/pace-progress/css/pace.css')?>" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137501772-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-137501772-1');
    </script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar bg-light-blue">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='<?php echo site_url('home');?>'">
            <img src="img/icon/home-white-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Home</span>
        </li>
        <li class="nav-item d-flex pointer" onclick="window.location.href='<?php echo site_url('project');?>'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Project</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='indoor.html'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Indoor</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='outdoor.html'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Outdoor</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='piping.html'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Piping</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='controller.html'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Controller</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='report.html'">
            <img src="img/icon/not_allowed-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Report</span>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='setting.html'">
            <img src="img/icon/setting-white-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Settings</span>
        </li>
        <li class="nav-item d-flex pointer unactive" onclick="window.location.href='<?php echo site_url('profile');?>'">
            <img src="img/icon/account-white-icon.png" class="index-nav-icon"><span class="text-white index-nav-text">Account</span>
        </li>
    </ul>
</header>
<div class="app-body">
    <div class="sidebar project-sidebar-border-right">
        <div class="col-12 sidebar-padding">
            <img src="img/logo/saijo-logo-light-blue.png" class="sidebar-logo">
            <div class="col-12 d-flex flex-column sidebar-padding-left">
                <div class="d-flex">
                    <span class="text-light-blue sidebar-header-srv default">SRV</span>
                    <span class="text-light-blue sidebar-header-sub default">Selection<br>Software</span>
                </div>
            </div>
            <div class="nav-link bg-light-blue mt-3 sidebar-margin">
                <span class="sidebar-header">Project</span>
            </div>
            <div class="nav-link bg-light-blue sidebar-margin sidebar-padding-none sidebar-bottom-container d-flex">
                <div class="col-6 sidebar-padding-none"></div>
                <div class="col-6 sidebar-padding-none">
                    <button class="sidebar-button sidebar-left-button-border text-white" onclick="window.location.href='indoor.html'">Next</button>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="project-top-nav text-light-blue">Project
            <div class="right">
            <button class="btn btn-danger" onclick="window.location.href='logout.html'">Log Out</button>
            </div>
        </div>
        <div class="d-flex-top">
            <div class="col-6 mt-3">
                <div class="card border-light-blue-light">
                    <div class="card-header bg-light-blue-light border-light-blue-light text-light-blue">
                        <span class="card-title">User info</span>

                    </div>
                    <div class="card-body">
                        <label class="input-label text-light-blue">Name</label>
                        <input class="form-control project-input bg-light-blue-light text-light-blue mb-3" name="project-name" type="text">
                        <label class="input-label text-light-blue">Lastname</label>
                        <input class="form-control project-input bg-light-blue-light text-light-blue mb-3" name="customer-name" type="text">
                        <label class="input-label text-light-blue">Address</label>
                        <textarea class="form-control project-input bg-light-blue-light text-light-blue mb-3" rows="4"></textarea>
                        <label class="input-label text-light-blue">Nation</label>
                        <div class="p-relative">
                            <div class="project-select-input">
                                <select class="form-control card-input select-input bg-light-blue-light text-light-blue mb-3" name="nation">
                                    <option>Thailand</option>
                                </select>
                            </div>
                        </div>
                        <label class="input-label text-light-blue">Revision</label>
                        <input class="form-control project-input bg-light-blue-light text-light-blue mb-3" name="revision" type="text">
                        <label class="input-label text-light-blue">Note</label>
                        <textarea class="form-control project-input bg-light-blue-light text-light-blue mb-3" rows="6" name="note"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-6 mt-3">
                <div class="card border-light-blue-light mb-3 d-none">
                    <div class="card-header bg-light-blue-light border-light-blue-light text-light-blue">
                        <span class="card-title">Refrigerant</span>
                    </div>
                    <div class="card-body">
                        <label class="input-label text-light-blue">Refrigerant</label>
                        <div class="p-relative">
                            <div class="project-select-input">
                                <select class="form-control project-input select-input bg-light-blue-light text-light-blue mb-3" name="refrigerant">
                                    <option>R 410A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-light-blue-light mb-3">
                    <div class="card-header bg-light-blue-light border-light-blue-light text-light-blue">
                        <span class="card-title">Location</span>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!-- CoreUI and necessary plugins-->
<script src="<?php echo base_url('node_modules/jquery/dist/jquery.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery-ui.js');?>"></script>
<script src="<?php echo base_url('node_modules/popper.js/dist/umd/popper.min.js');?>"></script>
<script src="<?php echo base_url('node_modules/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('node_modules/pace-progress/pace.min.js');?>"></script>
<!--<script src="--><?php //echo base_url('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js');?><!--"></script>-->
<script src="<?php echo base_url('node_modules/@coreui/coreui/dist/js/coreui.min.js');?>"></script>

</body>
</html>
