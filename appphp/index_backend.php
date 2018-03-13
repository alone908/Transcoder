<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 12/03/2018
 * Time: 8:27 PM
 */


if(!isset($_SESSION)){
    session_start();
}

require_once 'sqldb.php';

switch ($_POST['op']) {
    case 'login':

        $query = "SELECT * FROM users WHERE user_name='" . $_POST['user'] . "';";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($_POST['password'] === $row['user_password']) {
                $_SESSION['login_user'] = $row['user_name'];
                $_SESSION['user_auth'] = $row['user_auth'];
                echo json_encode(array('result' => 'good','user'=>$row['user_name']));
            } else {
                echo json_encode(array('result' => 'bad'));
            }
        } else {
            echo json_encode(array('result' => 'bad'));
        }

        break;
}