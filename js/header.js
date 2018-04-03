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
                        if(data.enrollment_start !== '' && data.enrollment_end !== ''){
                            $('#userEnrollment').html(data.enrollment_start + ' ~ ' + data.enrollment_end);
                        }else {
                            $('#userEnrollment').html('No Enrollment');
                        }
                        $('#profileTitle').html(data.user);
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

    $('#signup_btn').click(function () {
        $('#loginModal').modal('hide');
        $('#signupModal').modal('show');
    })

    $('#signupUser').click(function () {

        if($('#signupUserName').val() === ''){
            $('#signup_err_text').html('Please type your username.');
        }else if($('#signupUserPass').val() === ''){
            $('#signup_err_text').html('Please type your password.');
        }else if($('#signupUserEmail').val() === ''){
            $('#signup_err_text').html('Please type your email.');
        }else if($('#signupUserPass').val() !== $('#signupConfirmUserPass').val()){
            $('#signup_err_text').html('Password are not same, please check your password.');
        }else {

            $.ajax({
                type: 'POST',
                url: "appphp/index_backend.php",
                data: {op: 'signup', user:$('#signupUserName').val(), password:$('#signupUserPass').val(), email:$('#signupUserEmail').val()},
                dataType: "json",
                success: function (data) {
                    if(data.result === 'good'){
                        $('#signupModal').modal('hide');
                        location.reload();
                    }else if(data.result === 'bad'){
                        $('#signup_err_text').html(data.msg);
                    }
                },
                error: function (requestObject, error, errorThrown) {
                    $('#loader').css('display', 'none');
                    $('#ajax_err').css('display', 'block');
                }
            });

        }
    })

    $('.buyTranscoder').click(function () {
        $('#profileModal').modal('hide');
    })

    $('#loginModal').on('hidden.bs.modal', function (e) {
        $('#login_err_text').html('');
    })

    $('#profileModal').on('hidden.bs.modal', function (e) {
        $('#profile_err_text').html('');
    })

    $('#signupModal').on('hidden.bs.modal', function (e) {
        $('#signup_err_text').html('');
    })

})