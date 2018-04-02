$(document).ready(function () {

    $('#rule_manager, #advance').click(function () {
        if(login_user === null){
            $('#loginModal').modal('show');
        }
        if(login_user !== null){
            if(user_auth === 'admin'){
                if($(this).attr('id') === 'rule_manager'){
                    window.location = "rm_rulelist.php";
                }else if($(this).attr('id') === 'advance'){
                    window.location = "ad_fileexplorer.php";
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
            window.location = "transcoder.php";
        }
    })

})