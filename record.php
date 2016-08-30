<?php
/*  Mongo DB

ini_set('error_reporting', E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
$mongo = new MongoClient(); //("mongodb://".$dbhost);
$mongodb = $mongo->selectDB('CardData'); //$dbname;

$idTables = new MongoCollection($mongodb,'idTables');
$dataRecord = new MongoCollection($mongodb,'dataRecord');

$idDoc = $idTables->findOne(array('Name'=>(string) 'dataID' ));

$newID = $idDoc['Value'] + 1;

$idTables->update( array('Name'=>(string) 'dataID' ),
                   array('$set'=>array( 'Value'=>(integer) $newID )) );

$sourceData = $_POST['sourceData'];
$formData = $_POST['formData'];
$textData = $_POST['textData'];

$dataRecord->insert(array('id' => (string) $newID,
                          'sourceData' => (string) $sourceData,
                          'formData' => (string) $formData,
                          'textData' => (string) $textData,
                          'Time' => (string) date(DATE_RFC2822)) );

echo json_encode(array('result'=>'good'));
*/

require_once 'sqldb.php';

$sourceData = $_POST['sourceData'];
$transCodeLog = $_POST['transCodeLog'];

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));

$sql = "INSERT INTO DataRecord(SourceData,transCodeLog,TaiwanTime)
        VALUES ('".$sourceData."','".$transCodeLog."','".$localTime."')";

$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);
echo json_encode(array('result'=>'good'));
