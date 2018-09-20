<?php

require_once 'sqldb.php';

switch ($_POST['op']) {

  case 'add_rule':

  //Add row in rulelist; ///////////////////////////////////////////////////
  $query = "SELECT * FROM rulelist ORDER BY id desc LIMIT 1";
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $new_rule_set_id = $row['id']+1;
  $new_rule_set_id_text = (string) $row['id']+1;
  $rule_var = 'RuleSet_'.$new_rule_set_id_text;

  date_default_timezone_set("Asia/Taipei");
  $localTime = str_replace(',','',(string) date(DATE_RFC850));

  $query = "INSERT INTO rulelist (RuleSetID,RuleName,RuleType,RuleVar,CreatedBy,CreateTime, RuleSelectorType, RuleGroup)
  VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."','Add Rule','".$localTime."','InTranscoder,InRuleEditor,InAdvanceEditor,InRuleBranch,InBranchEditor,','Default')";

  $conn->query('SET NAMES UTF8');
  $conn->query($query);

  if($_POST['rule_type'] === 'MainRule'){

    $line_num = 1;
    //Insert HeadTitle Row
    $query = "INSERT INTO transcoderule
    (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
    VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."',".$line_num.",
    'HeadTitle','==表頭==','==表頭==',0,NULL,NULL,NULL,NULL,'".$localTime."','false',NULL,NULL,NULL)";

    $conn->query('SET NAMES UTF8');
    $conn->query($query);

    for($i=1;$i<=(integer) $_POST['lines_in_head'];$i++){

      $line_num ++ ;
      $subject = $rule_var.'_'.$line_num;

      $query = "INSERT INTO transcoderule
      (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
      VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."',".$line_num.",
      '".$subject."',NULL,NULL,0,NULL,NULL,NULL,NULL,'".$localTime."','false',NULL,NULL,NULL)";

      $conn->query('SET NAMES UTF8');
      $conn->query($query);

    }

    //Insert BodyTitle Row
    $line_num ++ ;
    $query = "INSERT INTO transcoderule
    (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
    VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."',".$line_num.",
    'BodyTitle','==表身==','==表身==',0,NULL,NULL,NULL,NULL,'".$localTime."','false',NULL,NULL,NULL)";

    $conn->query('SET NAMES UTF8');
    $conn->query($query);

    for($i=1;$i<=(integer) $_POST['lines_in_body'];$i++){

      $line_num ++ ;
      $subject = $rule_var.'_'.$line_num;

      $query = "INSERT INTO transcoderule
      (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
      VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."',".$line_num.",
      '".$subject."',NULL,NULL,0,NULL,NULL,NULL,NULL,'".$localTime."','false',NULL,NULL,NULL)";

      $conn->query('SET NAMES UTF8');
      $conn->query($query);

    }

  }elseif ($_POST['rule_type'] === 'SubRule') {

    $line_num = 0;
    for($i=1;$i<=(integer) $_POST['lines_in_rule'];$i++){

      $line_num ++ ;
      $subject = $rule_var.'_'.$line_num;

      $query = "INSERT INTO transcoderule
      (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
      VALUES (".$new_rule_set_id.",'".$_POST['rule_name']."','".$_POST['rule_type']."','".$rule_var."',".$line_num.",
      '".$subject."',NULL,NULL,0,NULL,NULL,NULL,NULL,'".$localTime."','false',NULL,NULL,NULL)";

      $conn->query('SET NAMES UTF8');
      $conn->query($query);

    }

  }

  echo json_encode(array('op'=>'add_rule','rulesetid'=>$new_rule_set_id));

    break;

  case 'del_rule':

    $rule_set_id = (integer) $_POST['rulesetid'];

    $query = "DELETE FROM transcoderule WHERE RuleSetID=".$rule_set_id;

    $result = $conn->query($query);

    $query = "DELETE FROM rulelist WHERE RuleSetID=".$rule_set_id;

    $result = $conn->query($query);

    echo json_encode(array('op'=>'del_rule','rulesetid'=>$rule_set_id));

    break;

  case 'check_clone_rulename';

    $new_name = $_POST['new_name'];

    $checking = true;
    while ($checking) {
      $query = "SELECT * FROM rulelist WHERE RuleName='".$new_name."'";
      $conn->query('SET NAMES UTF8');
      $result = $conn->query($query);

      if($result->num_rows > 0){
        $new_name .= '[CLONE]';
      }else {
        $checking = false;
      }
    }

    echo json_encode(array('op'=>'check_clone_rulename','new_name'=>$new_name));

    break;

  case 'clone_rule';

    $rule_set_id = (integer) $_POST['rulesetid'];

    //Clone row in rulelist; ///////////////////////////////////////////////////
    $query = "SELECT * FROM rulelist ORDER BY id desc LIMIT 1";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $new_rule_set_id = $row['id']+1;
    $new_rule_set_id_text = (string) $row['id']+1;

    $query = "SELECT * FROM rulelist WHERE RuleSetID=".$rule_set_id;
    $result = $conn->query($query);
    $origin_rule = $result->fetch_assoc();

    $rule_var = 'RuleSet_'.$new_rule_set_id_text;
    $created_by = 'Clone RuleSet '.$rule_set_id;

    date_default_timezone_set("Asia/Taipei");
    $localTime = str_replace(',','',(string) date(DATE_RFC850));

    $query = "INSERT INTO rulelist (RuleSetID,RuleName,RuleType,RuleVar,CreatedBy,CreateTime,RuleSelectorType,RuleGroup)
    VALUES (".$new_rule_set_id.",'".$_POST['rulename']."','".$origin_rule['RuleType']."','".$rule_var."','".$created_by."','".$localTime."','".$origin_rule['RuleSelectorType']."','".$origin_rule['RuleGroup']."')";

    $conn->query('SET NAMES UTF8');
    $conn->query($query);

    //Clone row in transcoderule; //////////////////////////////////////////////
    $sql = "select * from transcoderule where RuleSetID=".$_POST['rulesetid']." order by LineNumber";
    $conn->query('SET NAMES UTF8');
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $query = "INSERT INTO transcoderule
        (RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked,PreConditionLine,ChildRule,`Condition`)
        VALUES (".$new_rule_set_id.",'".$_POST['rulename']."','".$row['RuleType']."','".$rule_var."',".$row['LineNumber'].",
        '".$row['Subject']."','".$row['Content']."','".$row['Exp']."',".$row['Length'].",'".$row['DataCoding']."','".$row['LSB']."','".$row['UnixTime']."','".$row['TranscodeRule']."',
        '".$localTime."','".$row['Marked']."','".$row['PreConditionLine']."','".$row['ChildRule']."','".$row['Condition']."')";

        $conn->query('SET NAMES UTF8');
        $conn->query($query);

      }
    }else {

    }

    echo json_encode(array('op'=>'clone_rule','newrulesetid'=>$new_rule_set_id));

    break;

  case 'edit_rule_name':

  $rule_set_id = (integer) $_POST['rulesetid'];

  $query = "UPDATE rulelist SET RuleName='".$_POST['rulename']."', RuleGroup='".$_POST['rulegroup']."' WHERE RuleSetID=".$rule_set_id;
  $conn->query('SET NAMES UTF8');
  $conn->query($query);

  $query = "UPDATE transcoderule SET RuleName='".$_POST['rulename']."' WHERE RuleSetID=".$rule_set_id;
  $conn->query('SET NAMES UTF8');
  $conn->query($query);

  echo json_encode(array('op'=>'edit_rule_name'));

  default:
    # code...
    break;
}

?>
