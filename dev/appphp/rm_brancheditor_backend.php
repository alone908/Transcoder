<?php
require_once 'sqldb.php';

switch ($_POST['op']) {
  case 'get_branch':

  $branch = [];

  $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid']." AND NOT `Condition`='' ORDER BY LineNumber ASC;";
  $conn->query('SET NAMES UTF8');
  $result = $conn->query($query);

  $first_branch_id = null;
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        if($first_branch_id === null) $first_branch_id = $row['id'];

        $branch[$row['id']] = ['op'=>'update','id'=>$row['id'],'LineNumber'=>$row['LineNumber'],'Marked'=>$row['Marked'],'PreConditionLine'=>$row['PreConditionLine'],'Condition'=>$row['Condition'],'ChildRule'=>$row['ChildRule']];

        $conditions = explode(';',$row['Condition']);
        unset($conditions[count($conditions)-1]);

        foreach ($conditions as $key => $condi) {

          preg_match('/markedValue\["(.*)"]/', $condi, $matches);
          if(isset($matches[1])){
            $pre_condi_line = $matches[1];
          }else {
            $pre_condi_line = null;
          }

          preg_match('/===\s"(.*)"\)/', $condi, $matches);
          if(isset($matches[1])){
            $condi_value = $matches[1];
          }else {
            $condi_value = null;
          }

          preg_match('/childRuleSet\s=\s"(.*)"/', $condi, $matches);
          if(isset($matches[1])){
            $child_ruleset = $matches[1];
          }else {
            $child_ruleset = null;
          }

          $branch[$row['id']]['condition_array'][] = ['op'=>'update','pre_line'=>$pre_condi_line,'condi_val'=>$condi_value,'childset'=>$child_ruleset];

        }
    }
  }

  $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid'];
  $result = $conn->query($query);
  $total_lines = $result->num_rows;
  $branch_basket = [];
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $branch_basket[$row['id']] = ['id'=>$row['id'],'LineNumber'=>$row['LineNumber']];
    }
  }

  echo json_encode(array('branch'=>$branch,'total_lines'=>$total_lines,'first_branch_id'=>$first_branch_id,'branch_basket'=>$branch_basket));

    break;

  case 'save_branch':

  print_r($_POST['branch']);

    break;

}



 ?>
