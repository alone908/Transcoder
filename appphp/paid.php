<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 09/04/2018
 * Time: 6:11 PM
 */
if (!isset($_SESSION)) {
    session_start();
}

require_once 'sqldb.php';

$userid = $_SESSION['login_userid'];

$sql = "select * from users where id=" . $userid;
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $enroll_start = $row['enrollment_start'];
    $enroll_end = $row['enrollment_end'];
}

if ($_SESSION['user_enrollment'] === 'going') {
    $new_enroll_start = $enroll_start;
    $start_parts = explode('-', $enroll_end);
}elseif ($_SESSION['user_enrollment'] === 'no' || $_SESSION['user_enrollment'] === 'expired'){
    $new_enroll_start = date('m-d-Y');
    $start_parts = explode('-', $new_enroll_start);
}

$start_year = $start_parts[2];
$start_month = $start_parts[0];
$start_day = $start_parts[1];

if ((integer)$start_month < 12) {

    $new_month = (integer)$start_month + 1;

    if ($new_month === 4 || $new_month === 6 || $new_month === 9 || $new_month === 11) {
        $new_end_day = ((integer)$start_day > 30) ? '30' : $start_day;
    } else if ($new_month === 2) {
        $new_end_day = ((integer)$start_day > 28) ? '28' : $start_day;
    } else {
        $new_end_day = $start_day;
    }
    if ($new_month < 10) $new_month = '0' . (string) $new_month;
    $new_enroll_end = $new_month . '-' . $new_end_day . '-' . $start_year;

} elseif ((integer)$start_month === 12) {
    $new_year = (string)(integer)$start_year + 1;
    $new_enroll_end = '01-' . $start_day . '-' . $new_year;
}

$query = "UPDATE users SET enrollment_start='" . $new_enroll_start . "',enrollment_end='" . $new_enroll_end . "' WHERE id=" . $userid;
$conn->query($query);

$_SESSION['user_enrollment'] = 'going';

header('Location: ../index.php?hasPaid=true');
