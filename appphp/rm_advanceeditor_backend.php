<?php

require_once 'sqldb.php';

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));


switch ($_POST['op']) {
  case 'save_rule_table':

    foreach ($_POST['ruleTable'] as $key => $rule_row) {

      switch ($rule_row['op']) {
        case 'insert':

        // Hide insert function from advance editor.

        // $query = "SELECT * FROM rulelist WHERE RuleSetID=".$_POST['rulesetid'];
        // $conn->query('SET NAMES UTF8');
        // $result = $conn->query($query);
        // $row = $result->fetch_assoc();
        //
        // $rule_name = $row['RuleName'];
        // $rule_type = $row['RuleType'];
        // $rule_var = 'RuleSet_'.$_POST['rulesetid'];
        //
        // $query = "INSERT INTO
        // TransCodeRule(RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
        // VALUES (".$_POST['rulesetid'].",'".$rule_name."','".$rule_type."','".$rule_var."',".$rule_row['LineNumber'].",
        // '".$rule_row['Subject']."','".$rule_row['Subject']."','',0,'','','','','".$localTime."',
        // '".$rule_row['Marked']."',".$rule_row['PreConditionLine'].",".$rule_row['ChildRule'].",".$rule_row['Condition'].")";
        //
        // $conn->query('SET NAMES UTF8');
        // $conn->query($query);

          break;

        case 'update':

        $query = "UPDATE transcoderule SET LineNumber=".$rule_row['LineNumber'].",Subject='".$rule_row['Subject']."',Content='".$rule_row['Content']."',Marked='".$rule_row['Marked']."',
        PreConditionLine='".$rule_row['PreConditionLine']."',ChildRule='".$rule_row['ChildRule']."',`Condition`='".$rule_row['Condition']."',CreateTime='".$localTime."' WHERE id=".$rule_row['id'];

        $conn->query('SET NAMES UTF8');
        $conn->query($query);

          break;

        case 'delete':

        // Hide delete function from advance editor.

        // $query = "DELETE FROM transcoderule WHERE id=".$rule_row['id'];
        // $result = $conn->query($query);

          break;

      }
    }

    echo json_encode(array('RuleSetID'=>$_POST['rulesetid']));

    break;
}


 ?>
