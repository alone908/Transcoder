$(document).ready(function () {
    $('#login').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }
    })
    $('#rule_manager, #advance').click(function () {
        if(login_user === null || user_auth !== 'admin'){
            $('#loginModal').modal('show');
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
                    $('#loginModal').modal('hide');
                    $('#login').html($('#inputUser').val());
                    document.reload();
                }
            },
            error: function (requestObject, error, errorThrown) {
                $('#loader').css('display', 'none');
                $('#ajax_err').css('display', 'block');
            }
        });
    })
})