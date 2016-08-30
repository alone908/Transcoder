<?php

require_once 'sqldb.php';

$sql = "select * from TransCodeRule order by RuleID";
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);

$transcodeRule = array();
$transcodeRule['DataHead'] = array();
$transcodeRule['DataBody'] = array();

if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

    $LSB = ($row['LSB'] === 'true') ? true : false;
    $UnixTime = ($row['UnixTime'] === 'true') ? true : false;
    $rules = explode(',',$row['Rule']);

    $transcodeRule[$row['Section']][$row['Subject']] = array();
    $transcodeRule[$row['Section']][$row['Subject']]['Content'] = $row['Content'];
    $transcodeRule[$row['Section']][$row['Subject']]['Exp'] = $row['Exp'];
    $transcodeRule[$row['Section']][$row['Subject']]['length'] = (integer) $row['Length'];
    $transcodeRule[$row['Section']][$row['Subject']]['dataCoding'] = $row['DataCoding'];
    $transcodeRule[$row['Section']][$row['Subject']]['LSB'] = $LSB;
    $transcodeRule[$row['Section']][$row['Subject']]['UnixTime'] = $UnixTime;
    $transcodeRule[$row['Section']][$row['Subject']]['Rule'] = $rules;
  }
}else {

}

$transcodeRuleJSON = json_encode($transcodeRule);

//echo json_encode(array('result'=>'good','TranscodeRule'=>$transcodeRule));

/* create TransCodeRule Table *************************************************

$transcodeRule = $_POST['TranscodeRule'];

foreach ($transcodeRule['DataHead'] as $key => $value) {

  $rules = join($value['Rule'],',');

  $sql = "insert INTO TransCodeRule
          (Section,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,Rule) values
          ('DataHead','".$key."','".$value['Content']."','".$value['Exp']."',
           ".$value['length'].",'".$value['dataCoding']."','".$value['LSB']."',
           '".$value['UnixTime']."','".$rules."');";

  $conn->query('SET NAMES UTF8');
  $result = $conn->query($sql);

}

foreach ($transcodeRule['DataBody'] as $key => $value) {

  $rules = join($value['Rule'],',');

  $sql = "insert INTO TransCodeRule
          (Section,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,Rule) values
          ('DataBody','".$key."','".$value['Content']."','".$value['Exp']."',
           ".$value['length'].",'".$value['dataCoding']."','".$value['LSB']."',
           '".$value['UnixTime']."','".$rules."');";

  $conn->query('SET NAMES UTF8');
  $result = $conn->query($sql);

}
*/
