<?php

require_once 'sqldb.php';

switch ($_POST['op']) {
  case 'get_rule_list':

    $rule_list = array();

    $sql = "select * from rulelist";
    $conn->query('SET NAMES UTF8');
    $result = $conn->query($sql);

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rule_list[$row['RuleSetID']] = ['RuleName'=>$row['RuleName'],
                                         'RuleVar'=>$row['RuleVar'],
                                         'RuleType'=>$row['RuleType'],
                                         'CreateTime'=>$row['CreateTime']];
      }
    }

    echo json_encode(array('ruleList'=>$rule_list));

    break;

  case 'get_rule_obj':

  $sql = "select * from transcoderule where RuleSetID='".$_POST['RuleSetID']."' order by LineNumber";
  $conn->query('SET NAMES UTF8');
  $result = $conn->query($sql);

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

  echo json_encode(array('RuleSetID'=>$_POST['RuleSetID'],'new_rule'=>$new_rule));

    break;

  default:
    # code...
    break;
}
