<?php
require_once 'sqldb.php';

switch ($_POST['op']) {
  case 'get_branch':

  $branch = [];

  $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid']." ORDER BY LineNumber;";
  $conn->query('SET NAMES UTF8');
  $result = $conn->query($query);

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $branch[] = ['id'=>$row['id'],'LineNumber'=>$row['LineNumber'],'Condition'=>$row['Condition'],'ChildRule'=>$row['ChildRule']];
    }
  }



    break;


}



 ?>
