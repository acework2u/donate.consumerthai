$('#tab-1').click(function () {
    $('#tab-body-1').removeClass('d-none');
    $('#tab-body-2').addClass('d-none');
    $('#tab-body-3').addClass('d-none');

    $('#tab-1').addClass('active');
    $('#tab-2').removeClass('active');
    $('#tab-3').removeClass('active');
});

$('#tab-2').click(function () {
    $('#tab-body-1').addClass('d-none');
    $('#tab-body-2').removeClass('d-none');
    $('#tab-body-3').addClass('d-none');

    $('#tab-1').removeClass('active');
    $('#tab-2').addClass('active');
    $('#tab-3').removeClass('active');
});

$('#tab-3').click(function () {
    $('#tab-body-1').addClass('d-none');
    $('#tab-body-2').addClass('d-none');
    $('#tab-body-3').removeClass('d-none');

    $('#tab-1').removeClass('active');
    $('#tab-2').removeClass('active');
    $('#tab-3').addClass('active');
});

$(".money").click(function () {
    $("#money-input").val($(this).val());
});

$('#next-payment-1').click(function () {
    $('#payment-1').addClass('d-none');
    $('#payment-2').removeClass('d-none');
    $('#payment-3').addClass('d-none');

    $('#tab-body-1').addClass('d-none');
    $('#tab-body-2').removeClass('d-none');
    $('#tab-body-3').addClass('d-none');

    $('#tab-1').removeClass('active');
    $('#tab-2').addClass('active');
    $('#tab-3').removeClass('active');

});

$('#next-payment-2').click(function () {

    $('#tab-body-1').addClass('d-none');
    $('#tab-body-2').addClass('d-none');
    $('#tab-body-3').removeClass('d-none');

    $('#tab-1').removeClass('active');
    $('#tab-2').removeClass('active');
    $('#tab-3').addClass('active');

    if (!$("input[name='donate-type']").is(':checked')) {
        // alert('Nothing is checked! Value is');
    }
    else {
        let donor_type = $("input[name='donate-type']:checked").val();

        if (donor_type == "type-1") {
            $('#payment-1').addClass('d-none');
            $('#payment-2').addClass('d-none');
            $('#payment-3').removeClass('d-none');

        } else {
            let fullname = $("input[name='name']").val();
            let taxId = $("input[name='tax_id']").val();
            let telNumber = $("input[name='tel']").val();
            let emailDonor = $("input[name='email']").val();
            let addressDonor = $("#donor-address").val();


            if (fullname == "") {
                $("input[name='name']").focus();
            } else if (taxId == "") {
                $("input[name='tax_id']").focus();
            } else if (telNumber == "") {
                $("input[name='tel']").focus();
            } else if (emailDonor == "") {
                $("input[name='email']").focus();
            } else if (addressDonor == "" || addressDonor.length == 0) {
                $("#donor-address").focus();
            }else{
                $('#payment-1').addClass('d-none');
                $('#payment-2').addClass('d-none');
                $('#payment-3').removeClass('d-none');
            }


        }

        // alert('One of the radio buttons is checked! is VALUE ='+ donor_type);
    }


});

$('#next-payment-3').click(function () {
    $('#payment-choose').addClass('d-none');

    if ($('input[name="payment-type"]:checked').val() == 'type-1') {
        $('#payment-type-1').removeClass('d-none');
        $('#payment-type-2').addClass('d-none');
        $('#payment-type-3').addClass('d-none');
    } else if ($('input[name="payment-type"]:checked').val() == 'type-2') {
        $('#payment-type-1').addClass('d-none');
        $('#payment-type-2').removeClass('d-none');
        $('#payment-type-3').addClass('d-none');
    } else {
        $('#payment-type-1').addClass('d-none');
        $('#payment-type-2').addClass('d-none');
        $('#payment-type-3').removeClass('d-none');
    }
});

$('#payment-2_state-1').click(function () {
    $('#payment-1').removeClass('d-none');
    $('#payment-2').addClass('d-none');
    $('#payment-3').addClass('d-none');

    $('#tab-body-1').removeClass('d-none');
    $('#tab-body-2').addClass('d-none');
    $('#tab-body-3').addClass('d-none');

    $('#tab-1').addClass('active');
    $('#tab-2').removeClass('active');
    $('#tab-3').removeClass('active');


});

$('#payment-3_state-1').click(function () {
    $('#payment-1').removeClass('d-none');
    $('#payment-2').addClass('d-none');
    $('#payment-3').addClass('d-none');
});

$('#payment-3_state-2').click(function () {
    $('#payment-1').addClass('d-none');
    $('#payment-2').removeClass('d-none');
    $('#payment-3').addClass('d-none');
});

$('input[name="donate-type"]').click(function () {
    if ($('#donate-type-1').is(':checked')) {
        $('#bill').hide('slow');
    } else {
        $('#bill').show('slow');
    }
});

$('input[name="news-type"]').click(function () {
    if ($('#yes').is(':checked')) {
        $('#new-email').removeAttr('readonly');
    } else {
        $('#new-email').attr('readonly', 'readonly');
    }
});

$('.done').click(function () {
    $('#thank').removeClass('d-none');
    $('#main').addClass('d-none');
});

$('.thank-container img').click(function () {
    $('#thank').addClass('d-none');
    $('#main').removeClass('d-none');

    $('#payment-1').removeClass('d-none');
    $('#payment-2').addClass('d-none');
    $('#payment-3').addClass('d-none');
});

$('#button-donate').click(function () {
    $('#button-more').removeClass('d-none');
    $('#button-donate').addClass('d-none');

    $('#container-left').hide();
    $('#container-right').show();
});

$('#button-more').click(function () {
    $('#button-more').addClass('d-none');
    $('#button-donate').removeClass('d-none');

    $('#container-left').show();
    $('#container-right').hide();
});
