<?php
require_once 'appphp/sqldb.php';

$rule_list = array();
$sql = "SELECT * FROM rulelist ORDER BY RuleName ASC";
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);
if($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    foreach ($row as $key => $value) {
      $rule_list[$row['RuleSetID']][$key] = $value;
    }
  }
}

?>
