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
                $_SESSION['login_userid'] = $row['id'];
                $_SESSION['user_auth'] = $row['user_auth'];

                //check enrollment
                if($row['enrollment_end'] === null){
                    $_SESSION['user_enrollment'] = 'no';
                }else{
                    $enroll_date_array = explode('-',$row['enrollment_end']);
                    $enroll_year = (integer) $enroll_date_array[2];
                    $enroll_month = (integer) $enroll_date_array[0];
                    $enroll_day = (integer) $enroll_date_array[1];
                    $current_year = (integer) date('Y');
                    $current_month = (integer) date('n');
                    $current_day = (integer) date('j');
                    if($enroll_year > $current_year){
                        $_SESSION['user_enrollment'] = 'going';
                    }else if($enroll_year === $current_year){
                        if($enroll_month > $current_month){
                            $_SESSION['user_enrollment'] = 'going';
                        }elseif ($enroll_month === $current_month){
                            if($enroll_day >= $current_day){
                                $_SESSION['user_enrollment'] = 'going';
                            }else{
                                $_SESSION['user_enrollment'] = 'expired';
                            }
                        }else{
                            $_SESSION['user_enrollment'] = 'expired';
                        }
                    }else{
                        $_SESSION['user_enrollment'] = 'expired';
                    }
                }

                echo json_encode(array('result' => 'good','user'=>$row['user_name']));
            } else {
                echo json_encode(array('result' => 'bad'));
            }
        } else {
            echo json_encode(array('result' => 'bad'));
        }

        break;

    case 'get_profile':

        $query = "SELECT * FROM users WHERE id=" . $_POST['userid'] . ";";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            echo json_encode(array('result' => 'good','user'=>$row['user_name'], 'password'=>$row['user_password'], 'email'=>$row['user_email'], 'auth'=>$row['user_auth'], 'enrollment_start'=>($row['enrollment_start'] === null) ? '' : $row['enrollment_start'], 'enrollment_end'=>($row['enrollment_end'] === null) ? '' : $row['enrollment_end']));
        } else {
            echo json_encode(array('result' => 'bad'));
        }

        break;

    case 'save_profile':

        //check user name is taken or not.
        $query = "SELECT * FROM users WHERE user_name='" . $_POST['user'] . "';";
        $result = $conn->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if($row['id'] !== $_POST['userid']){
                echo json_encode(array('result' => 'bad', 'msg'=>'This username has already been taken.'));
                break;
            }
        }

        //check user email is taken or not.
        $query = "SELECT * FROM users WHERE user_email='" . $_POST['email'] . "';";
        $result = $conn->query($query);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if($row['id'] !== $_POST['userid']){
                echo json_encode(array('result' => 'bad', 'msg'=>'This email has already been taken.'));
                break;
            }
        }

        $query = "UPDATE users SET user_name='" . $_POST['user'] . "',user_password='" . $_POST['password'] . "',user_email='" . $_POST['email'] . "' WHERE id=" . $_POST['userid'];
        $conn->query($query);
        $_SESSION['login_user'] = $_POST['user'];

        echo json_encode(array('result' => 'good', 'userid'=>$_POST['userid'], 'user'=>$_POST['user']));

        break;

    case 'signup':

        //check user name is taken or not.
        $query = "SELECT * FROM users WHERE user_name='" . $_POST['user'] . "';";
        $result = $conn->query($query);
        if ($result->num_rows >= 1) {
            echo json_encode(array('result' => 'bad', 'msg'=>'This username has already been taken.'));
            break;
        }

        //check user email is taken or not.
        $query = "SELECT * FROM users WHERE user_email='" . $_POST['email'] . "';";
        $result = $conn->query($query);
        if ($result->num_rows >= 1) {
            echo json_encode(array('result' => 'bad', 'msg'=>'This email has already been taken.'));
            break;
        }

        $query = "INSERT INTO users(user_name,user_password,user_email,user_auth) VALUES ('" . $_POST['user'] . "','" . $_POST['password'] . "','" . $_POST['email'] . "','user')";
        $conn->query($query);

        echo json_encode(array('result' => 'good', 'user'=>$_POST['user']));

        break;
}