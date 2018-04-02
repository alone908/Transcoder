$(document).ready(function () {

    $('#login').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }else {
            console.log('show profile');
            $('#profileModal').modal('show');
        }
    })

    $('#login_btn').click(function () {
        $.ajax({
            type: 'POST',
            url: "appphp/index_backend.php",
            data: {op: 'login', user: $('#inputUser').val() , password: $('#inputPassword').val()},
            dataType: "json",
            success: function (data) {
                if(data.result === 'good'){
                    location.reload();
                }else if(data.result === 'bad'){
                    $('#login_err_text').html('Sorry! User name or password is not correct.');
                }
            },
            error: function (requestObject, error, errorThrown) {
                $('#loader').css('display', 'none');
                $('#ajax_err').css('display', 'block');
            }
        });
    })

    $('#loginModal').on('hidden.bs.modal', function (e) {
        $('#login_err_text').html('');
    })
})