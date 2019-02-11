<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
</head>
<body>

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
<div id="summernote">Hello Summernote</div>


<script>
    $(document).ready(function() {
        $('#summernote').summernote();

        console.log()
    });
</script>

</body>
</html>
