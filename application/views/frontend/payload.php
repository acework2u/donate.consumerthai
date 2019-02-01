<!--<form action='https://demo2.2c2p.com/2C2PFrontEnd/SecurePayment/PaymentAuth.aspx' method='POST' name='paymentRequestForm'>-->
<form action='https://t.2c2p.com/SecurePayment/PaymentAuth.aspx' method='POST' name='paymentRequestForm'>
    <!--display wait message to user when page is loading-->
    Processing payment request, Do not close the browser, press back or refresh the page.

    <input type="hidden" name="paymentRequest" value="<?php echo $payload;?>">


</form>
<script language="JavaScript">
    document.paymentRequestForm.submit();	//submit form to 2c2p PGW
</script>
