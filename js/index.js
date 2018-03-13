$(document).ready(function () {

    $('#rule_manager, #advance').click(function () {
        if(login_user === null || user_auth !== 'admin'){
            $('#loginModal').modal('show');
        }
        if(login_user !== null && user_auth === 'admin'){
            if($(this).attr('id') === 'rule_manager'){
                window.location = "rm_rulelist.php";
            }else if($(this).attr('id') === 'advance'){
                window.location = "ad_fileexplorer.php";
            }
        }
    })

})