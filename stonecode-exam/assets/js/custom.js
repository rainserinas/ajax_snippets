/**
 * Created by Raineir on 4/28/2016.
 */

$(function () {
    $("#datepicker").datepicker({
        onSelect: function (dateText, inst) {

            var date = new Date(dateText);
            var year = date.getFullYear();

            //Check if date enter is over 18 or not
            if (year > 1997) {
                $(this).val("");
                $(".date-alert").show();
                $('.submit-btn').attr('disabled', 'disabled');
            } else {
                $('.date-alert').hide();
                $('.submit-btn').removeAttr('disabled');
            }

        }
    });
});


//prevent alphabet on input
$(".phonenum").keypress(function (e) {
    //if the letter is not digit then display error and don't type anything
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(this).val("");
        return false;
    }
});

function validate(conf_password) {

    var password = $('.password').val();

    if (password !== conf_password) {
        $('.match').show();
        $('.submit-btn').attr('disabled', 'disabled');
    } else {
        $('.match').hide();
        $('.submit-btn').removeAttr('disabled');

    }

}

function addnum() {

    $(".phonenum-row").append("<br><div class='col-md-8'>" +
        "<input name='phonenum[]' maxlength='11' type='text' class='form-control phonenum phonenum-add' placeholder='Phone Number'>" +
        "</div>");

    //prevent alphabet on input
    $(".phonenum").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $(this).val("");
            return false;
        }
    });
}

function readURL(input) {

    $('.thumb-img-div').show();

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

