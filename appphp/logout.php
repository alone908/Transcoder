<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 13/03/2018
 * Time: 1:34 PM
 */

if(!isset($_SESSION)){
    session_start();
}

unset($_SESSION['login_user']);
unset($_SESSION['login_userid']);
unset($_SESSION['user_auth']);
unset($_SESSION['user_enrollment']);

header("Location: ../index.php");
