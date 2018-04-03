$(document).ready(function () {

    $('#login').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }else {

            $.ajax({
                type: 'POST',
                url: "appphp/index_backend.php",
                data: {op: 'get_profile', userid: login_userid},
                dataType: "json",
                success: function (data) {
                    if(data.result === 'good'){

                        $('#userName').val(data.user);
                        $('#userEmail').val(data.email);
                        $('#userPass, #confirmUserPass').val(data.password);
                        $('#userEnrollment').html(data.enrollment_start + ' ~ ' + data.enrollment_end);
                        $('#profileModal').modal('show');

                    }else if(data.result === 'bad'){

                    }
                },
                error: function (requestObject, error, errorThrown) {
                    $('#loader').css('display', 'none');
                    $('#ajax_err').css('display', 'block');
                }
            });

        }
    })

    $('#saveUserProfile').click(function () {

        if($('#userPass').val() !== $('#confirmUserPass').val()){
            $('#profile_err_text').html('Password are not same, please check your password.');
        }else {

            $.ajax({
                type: 'POST',
                url: "appphp/index_backend.php",
                data: {op: 'save_profile', userid: login_userid, user:$('#userName').val(), password:$('#userPass').val(), email:$('#userEmail').val()},
                dataType: "json",
                success: function (data) {
                    if(data.result === 'good'){
                        $('#profileModal').modal('hide');
                        location.reload();
                    }else if(data.result === 'bad'){
                        $('#profile_err_text').html(data.msg);
                    }
                },
                error: function (requestObject, error, errorThrown) {
                    $('#loader').css('display', 'none');
                    $('#ajax_err').css('display', 'block');
                }
            });

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

    $('#profileModal').on('hidden.bs.modal', function (e) {
        $('#profile_err_text').html('');
    })

})