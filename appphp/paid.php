<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 09/04/2018
 * Time: 6:11 PM
 */
 if(!isset($_SESSION)){
     session_start();
 }

 require_once 'sqldb.php';

 $userid = $_SESSION['login_userid'];

 $sql = "select * from users where id=".$userid;
 $conn->query('SET NAMES UTF8');
 $result = $conn->query($sql);
 if($result->num_rows > 0) {
     $row = $result->fetch_assoc();
     $enroll_start = $row['enrollment_start'];
     $enroll_end = $row['enrollment_end'];
 }

 $end_parts = explode('-',$enroll_end);
 $end_year = $end_parts[2];
 $end_month = $end_parts[0];
 $end_day = $end_parts[1];
 $new_enroll_start = $enroll_end;
 if( (integer) $end_month < 12){
     $new_month = (integer) $end_month+1;
     if($new_month < 10) $new_month = '0'.(string) $new_month;
     $new_enroll_end = $new_month.'-'.$end_day.'-'. $end_year;
 }elseif ((integer) $end_month === 12) {
     $new_year = (string) (integer) $end_year+1;
     $new_enroll_end = '01-'.$end_day.'-'.$new_year;
 }

 $query = "UPDATE users SET enrollment_start='" . $new_enroll_start . "',enrollment_end='" . $new_enroll_end . "' WHERE id=" . $userid;
 $conn->query($query);
