$(document).ready(function () {

    if(hasPaid){
        $('#thankyouPaidModal').modal('show');
    }

    $('#rule_manager, #advance').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }
        if(login_user !== null){
            if(user_auth === 'admin'){
                if(user_enrollment === 'going'){
                    if($(this).attr('id') === 'rule_manager'){
                        window.location = "rm_rulelist.php";
                    }else if($(this).attr('id') === 'advance'){
                        window.location = "ad_fileexplorer.php";
                    }
                }else if(user_enrollment === 'expired' || user_enrollment === 'no'){
                    $('#buyEnrollmentModal').modal('show');
                }
            }else {
                $('#notAdminModal').modal('show');
            }
        }
    })

    $('#transcoder').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }
        if(login_user !== null){
            if(user_enrollment === 'going'){
                window.location = "transcoder.php";
            }else if(user_enrollment === 'expired' || user_enrollment === 'no'){
                $('#buyEnrollmentModal').modal('show');
            }
        }
    })

    $('.buyTranscoder').click(function () {
        $('#buyEnrollmentModal').modal('hide');
    })

})