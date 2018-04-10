<?php

require_once 'sqldb.php';

switch ($_POST['op']) {

  case 'insert_record':

  $sourceData = $_POST['sourceData'];
  $transCodeLog = $_POST['transCodeLog'];

  date_default_timezone_set("Asia/Taipei");
  $localTime = date('m-d-Y H:i:s (l)');
  $ruleSetID = $_POST['ruleSetID'];

  $sql = "INSERT INTO datarecord(RuleSetID,SourceData,transCodeLog,TaiwanTime)
          VALUES (".$ruleSetID.",'".$sourceData."','".$transCodeLog."','".$localTime."')";

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

    break;

  case 'upload_filelist':

  $path = $_POST['path'];
  $folderArray = [];
  $fileArray = [];

  if (file_exists($path)) {
  	$handle = opendir($path);
  	while ($file = readdir($handle)) {
  		if ($file !== '.' && $file !== '..') {
        $ext = (is_file($path.'/'.$file)) ? pathinfo($file,PATHINFO_EXTENSION) : '';
        if(is_dir($path.'/'.$file)){
  				$folderArray[$file] = array("fileName" => $file,"fileType" => "folder","path" => $path.'/'.$file);
  			}
  			if($ext === 'dat' || $ext === 'DAT'){
  				$fileArray[$file] = array("fileName" => $file,"fileType" => "file","path" => $path.'/'.$file);
  			}
  		}
  	}
  }

  echo json_encode(array_merge($folderArray,$fileArray));

    break;

  case 'parse_file_onServer':

  $file = $_POST['path'];

  $sourceData = bin2hex(file_get_contents( $file ));

  echo json_encode( array('sourceData'=>$sourceData) );

    break;

  case 'list_records':

  $sql = "select * from datarecord order by id desc LIMIT 50";
  $conn->query('SET NAMES UTF8');
  $result = $conn->query($sql);

  $records = [];

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $sourceData = substr($row['SourceData'],0,15).'.....';
      $records[] = array('id'=>$row['id'],'RuleSetID'=>($row['RuleSetID'] !== null) ? $row['RuleSetID'] : '-1','SourceData'=>$sourceData,'TimeStamp'=>$row['TaiwanTime']);
    }
  }else {

  }

  echo json_encode(array('result'=>'good','Records'=>$records));

    break;

  case 'get_single_record':

  $sql = "select * from datarecord where id=".(integer) $_POST['recordid'];
  $conn->query('SET NAMES UTF8');
  $result = $conn->query($sql);

  if($result->num_rows === 1) {
    while($row = $result->fetch_assoc()) {
      $record = array('id'=>$row['id'],'SourceData'=>$row['SourceData']);
    }
  }else {

  }

  echo json_encode(array('result'=>'good','Record'=>$record));

    break;

  case 'parse_upload_file':

  print_r('here');

    break;

}

 ?>
