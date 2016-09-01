<?php

require_once 'sqldb.php';

$sourceData = $_POST['sourceData'];
$transCodeLog = $_POST['transCodeLog'];

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));

$sql = "INSERT INTO DataRecord(SourceData,transCodeLog,TaiwanTime)
        VALUES ('".$sourceData."','".$transCodeLog."','".$localTime."')";

$conn->query('SET NAMES UTF8');
$conn->query($sql);
echo json_encode(array('result'=>'good'));
