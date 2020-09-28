$(document).ready(function() {
    // find a ride Number of seats to book input field working as a counter
    $('.minus').click(function () {
        var $input = $('.passenger');
        if(isNaN(parseInt($input.val()))){
            var count = 1;
        }else{
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
        }
        $input.val(count);
    });
    $('.plus').click(function () {
        var $input = $('.passenger');
        if(isNaN(parseInt($input.val()))){
            $input.val(1);
        }else{
            var count = parseInt($input.val()) + 1;
            count = count >=8 ? 8 : count;
            $input.val(count);
        }
    });

    //sign up and edit password sectons form password and confirm password show and hide
    var clicksPassBtn = 0;
    $('#signup-pass-btn').on('click',function(event){
        event.preventDefault();
        if (clicksPassBtn === 0){ 
            $(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
            $('#signup-pass-input').prop("type","text");
            clicksPassBtn++;
        }else if (clicksPassBtn === 1){
            $(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
            $('#signup-pass-input').prop("type","password");
            clicksPassBtn--;
        }
    });
    var clicksConfirmPassBtn = 0;
    $('#signup-confirm-pass-btn').on('click',function(event){
        event.preventDefault();
        if (clicksConfirmPassBtn === 0){ 
            $(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
            $('#signup-confirm-pass-input').prop("type","text");
            clicksConfirmPassBtn++;
        }else if (clicksConfirmPassBtn === 1){
            $(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
            $('#signup-confirm-pass-input').prop("type","password");
            clicksConfirmPassBtn--;
        }
    });

    // password and confirm password signup and edit password sectons match
    $("#signup_submit").click(function (event) {
        var password = $("#signup-pass-input").val();
        var confirmPassword = $("#signup-confirm-pass-input").val();
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
        return true;
    });
    $("#signup-confirm-pass-input").on('change',function(){
        var pass = $("#signup-pass-input").val();
        var confirmPass = $("#signup-confirm-pass-input").val();
        if (pass != confirmPass) {
            $('.signup-invalid-passwords').show('fast');
        }else if (pass == confirmPass){
            $('.signup-invalid-passwords').hide('fast');
        }
    });
    

    //login and edit password old password show and hide
    var clicksPassBtnLogin = 0;
    $('#login-pass-btn').on('click',function(event){
        event.preventDefault();
        if (clicksPassBtnLogin === 0){ 
            $(this).children().removeClass('fa-eye').addClass('fa-eye-slash');
            $('#login-pass-input').prop("type","text");
            clicksPassBtnLogin++;
        }else if (clicksPassBtnLogin === 1){
            $(this).children().removeClass('fa-eye-slash').addClass('fa-eye');
            $('#login-pass-input').prop("type","password");
            clicksPassBtnLogin--;
        }
    });


});