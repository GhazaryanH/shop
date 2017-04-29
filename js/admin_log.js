$(document).ready(function () {
    $('.confirm').click(function () {
        login = $('.login').val();
        pass = $('.pass').val();
        $.ajax({
            url: 'check_admin.php',
            type: 'post',
            data: ({login: login, pass: pass}),
            success: function (data) {
                if(data == 1){
                    $('.conf_alert').html('Fill all fields');
                    $('.conf_alert').css({'visibility': 'visible'});
                }
                if(data == 2){
                    $('.conf_alert').html('login wrong');
                    $('.conf_alert').css({'visibility': 'visible'});
                }
                if(data == 3){
                    $('.conf_alert').html('Password wrong');
                    $('.conf_alert').css({'visibility': 'visible'});
                }
                if(data == 4){
                    window.location.assign("home.php");
                }
            }
        })
    })
});