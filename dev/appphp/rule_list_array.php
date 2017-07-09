<?php
require_once 'appphp/sqldb.php';

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

?>
