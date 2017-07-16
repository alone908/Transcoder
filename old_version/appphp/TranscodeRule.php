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

    $transcodeRule[$row['Section']][$row['RuleID']] = array();
    $transcodeRule[$row['Section']][$row['RuleID']]['Content'] = $row['Content'];
    $transcodeRule[$row['Section']][$row['RuleID']]['Exp'] = $row['Exp'];
    $transcodeRule[$row['Section']][$row['RuleID']]['length'] = (integer) $row['Length'];
    $transcodeRule[$row['Section']][$row['RuleID']]['dataCoding'] = $row['DataCoding'];
    $transcodeRule[$row['Section']][$row['RuleID']]['LSB'] = $LSB;
    $transcodeRule[$row['Section']][$row['RuleID']]['UnixTime'] = $UnixTime;
    $transcodeRule[$row['Section']][$row['RuleID']]['Rule'] = $rules;
  }
}else {

}

$transcodeRuleJSON = json_encode($transcodeRule);
