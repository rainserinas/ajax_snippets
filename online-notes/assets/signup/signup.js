function validate_pass(retype) {

    var password = $("#password").val();

    if (password === retype) {
        $("#match-password").hide();
    } else {
        $("#match-password").show();
        $("#submit").prop("disabled", false);
    }

}
