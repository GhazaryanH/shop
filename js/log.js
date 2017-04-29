$(document).ready(function () {
    $('.reg_in').click(function () {
        log = $('.reg_log').val();
        pas = $('.reg_pas').val();
        $.ajax({
            url: 'reg_check.php',
            type: 'post',
            data:({log: log, pas: pas}),
            success: function (data) {
                if(data == 1){
                    window.location.replace('index.php');
                }else {
                    $('.reg_alert').css({'visibility': 'visible'});
                    if (data == 2) {
                        $('.reg_alert').html('Fill all fields');
                    }
                    if (data == 3) {
                        $('.reg_alert').html('Login is not available');
                    }
                    if (data == 4) {
                        $('.reg_alert').html('The password should be at least 8 characters');
                    }
                }
            }
        })
    });
    $('.log_in').click(function () {
        log = $('.log_log').val();
        pas = $('.log_pas').val();
        $.ajax({
            url: 'log_check.php',
            type: 'post',
            data:({log: log, pas: pas}),
            success: function (data) {
                if(data == 1){
                    window.location.replace('index.php');
                }else {
                    $('.log_alert').css({'visibility': 'visible'});
                    if (data == 2) {
                        $('.log_alert').html('Fill all fields');
                    }
                    if (data == 3) {
                        $('.log_alert').html('This login does not exist');
                    }
                    if (data == 4) {
                        $('.log_alert').html('The password is written wrong');
                    }
                }
            }
        })
    });
});