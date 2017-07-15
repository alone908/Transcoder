<?php

require_once 'sqldb.php';

$sourceData = $_POST['sourceData'];
$transCodeLog = $_POST['transCodeLog'];

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));

$sql = "INSERT INTO datarecord(SourceData,transCodeLog,TaiwanTime)
        VALUES ('".$sourceData."','".$transCodeLog."','".$localTime."')";

$conn->query('SET NAMES UTF8');
$conn->query($sql);

$sql = "SELECT MAX(id) FROM datarecord";
$result = $conn->query($sql);

if($result->num_rows > 0) {

  //keep maxmum 50 records
  $row = $result->fetch_assoc();
  $floor = (integer) $row['MAX(id)']-50;
  $sql = "DELETE FROM datarecord where id <= $floor";
  $conn->query($sql);

}else {

}

echo json_encode(array('result'=>'good'));
