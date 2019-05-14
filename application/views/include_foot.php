

</body>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-xl">
    <div class="d-none d-xl-block">
        <img src="<?php echo base_url('assets/img/lock-icon.png')?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span class="footer-text ml-4">สอบถามข้อมูลเพิ่มเติม</span><img src="<?php echo base_url('assets/img/tel-icon.png')?>" class="ml-4"><span class="footer-text ml-2">089 761 9150, 089 765 9151</span>
    </div>
</footer>
<footer class="footer pl-4 pr-4 pt-2 pb-2 mt-4 d-flex" id="footer-lg">
    <div class="d-xl-none">
        <img src="<?php echo base_url('assets/img/lock-icon.png')?>"><span class="footer-text ml-2">consumerthai.org มีความปลอดภัย ข้อมูลส่วนตัวของคุณจะถูกเก็บรักษาเป็นอย่างดี ตามนโยบายความเป็นส่วนตัว</span><span class="footer-text ml-4 pull-right">สอบถามข้อมูลเพิ่มเติม</span><span class="footer-text ml-2 pull-right">089 761 9150, 089 765 9151</span><img src="<?php echo base_url('assets/img/tel-icon.png')?>" class="ml-2 pull-right">
        <a href="https://seal.beyondsecurity.com/vulnerability-scanner-verification/donate.consumerthai.org"><img src="https://seal.beyondsecurity.com/verification-images/donate.consumerthai.org/vulnerability-scanner-2.gif" alt="Website Security Test" border="0"></a>
    </div>
</footer>

<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/script.js')?>"></script>
<script src="<?php echo base_url('assets/js/vue.js') ?>"></script>
<script src="<?php echo base_url('assets/js/axios.js') ?>"></script>
<script src="<?php echo base_url('assets/js/donate.js') ?>"></script>
<script src="<?php echo base_url('assets/js/payment_confirm.js'); ?>"></script>
<!--Importing 2c2p JSLibrary-->
<script type="text/javascript" src="https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/api/my2c2p.1.6.9.min.js"></script>
<script type="text/javascript">
    <!--checkout function-->
    function Checkout() {
        //your code here
        //if there is no error, submit the form.
        My2c2p.submitForm("2c2p-payment-form",function(errCode,errDesc){
            if(errCode!=0){ alert(errDesc+" ("+errCode+")"); }
        });




    }
</script>

</html>
