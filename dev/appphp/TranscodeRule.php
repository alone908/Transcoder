<?php

require_once 'sqldb.php';

$sql = "select * from TransCodeRule where RuleSetID='".$_POST['RuleSetID']."' order by LineNumber";
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);

$transcodeRule = array();
$transcodeRule['DataHead'] = array();
$transcodeRule['DataBody'] = array();

$new_rule = array();

if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

    $LSB = ($row['LSB'] === 'true') ? true : false;
    $UnixTime = ($row['UnixTime'] === 'true') ? true : false;
    $TranscodeRule = explode(',',$row['TranscodeRule']);

    $new_rule[] = ['Subject'=>$row['Subject'],
                   'LineNumber'=>$row['LineNumber'],
                   'Content'=>$row['Content'],
                   'Exp'=>$row['Exp'],
                   'Length'=> (integer) $row['Length'],
                   'DataCoding'=> $row['DataCoding'],
                   'LSB'=> $LSB,
                   'UnixTime'=>$UnixTime,
                   'TranscodeRule'=>$TranscodeRule,
                   'Marked'=>$row['Marked'],
                   'PreConditionLine'=>$row['PreConditionLine'],
                   'ChildRule'=>$row['ChildRule'],
                   'Condition'=>$row['Condition']];
  }
}else {

}

echo json_encode(array('TranscodeRule'=>$transcodeRule,'new_rule'=>$new_rule));
