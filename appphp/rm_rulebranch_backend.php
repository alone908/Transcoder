<?php
require_once 'sqldb.php';

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

$query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid']." AND NOT `Condition`='' ORDER BY LineNumber ASC;";
$conn->query('SET NAMES UTF8');
$result = $conn->query($query);

$condi_line = [];
$line_section = [];
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $condi_line[] = ['start'=>$row['LineNumber'],'end'=>$row['LineNumber'],'Condition'=>$row['Condition'],'ChildRule'=>$row['ChildRule']];
  }
}

foreach ($condi_line as $key => $line) {
  if($key === 0){
    if( (integer) $line['start'] === 1){
      $line_section[] = ['start'=>$line['end'],'end'=>$line['end'],'Condition'=>$line['Condition'],'ChildRule'=>$line['ChildRule']];
    }elseif ((integer) $line['start'] !== 1) {
      $line_section[] = ['start'=>1,'end'=>$line['end']-1];
      $line_section[] = ['start'=>$line['end'],'end'=>$line['end'],'Condition'=>$line['Condition'],'ChildRule'=>$line['ChildRule']];
    }
    $last_condi_line = $line['end'];
  }elseif ($key !== 0) {
    if( (integer)$line['start'] !== (integer)$last_condi_line+1 ){
      $line_section[] = ['start'=>$last_condi_line+1,'end'=>$line['end']-1];
      $line_section[] = ['start'=>$line['end'],'end'=>$line['end'],'Condition'=>$line['Condition'],'ChildRule'=>$line['ChildRule']];
    }elseif ((integer)$line['start'] === (integer)$last_condi_line+1) {
      $line_section[] = ['start'=>$line['end'],'end'=>$line['end'],'Condition'=>$line['Condition'],'ChildRule'=>$line['ChildRule']];
    }
    $last_condi_line = $line['end'];
  }
}

if(count($line_section) > 0){
  $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid'];
  $result = $conn->query($query);
  if( (integer) $line_section[count($line_section)-1]['end'] !== $result->num_rows){
    $line_section[] = ['start'=>(integer) $line_section[count($line_section)-1]['end']+1, 'end'=>$result->num_rows ];
  }
}

$branch = [];
foreach ($line_section as $key => $section) {

  if(!isset($section['ChildRule'])){
      if( $section['start'] !== $section['end'] ){
        $branch[] = ['name'=>'Line: '.(string)$section['start'].'~'.(string)$section['end']];
      }elseif ( $section['start'] === $section['end'] ) {
        $branch[] = ['name'=>'Line: '.(string)$section['start']];
      }
  }elseif (isset($section['ChildRule'])) {

      $child_rules = explode(',',$section['ChildRule']);

      $branch[] = ['name'=>'Line :'.(string) $section['end'],
                   'children'=>[]];

      $children = [];
      foreach ($child_rules as $key => $child_rule_set) {
        $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$child_rule_set;
        $result = $conn->query($query);
        $child_rule_node =
        ['name'=>$rule_list[$child_rule_set]['RuleName'],
         'children'=>[
            ['name'=>'Line: 1~'.$result->num_rows]
           ]
         ];
         $branch[count($branch)-1]['children'][] = $child_rule_node;
      }
  }
}

$rule_name = $rule_list[$_POST['rulesetid']]['RuleName'];
$rule_type = $rule_list[$_POST['rulesetid']]['RuleType'];

if($rule_type === 'MainRule'){
  $treeData = ['name'=>'Source',
  'children'=>[
    ['name'=>$rule_name,
    'children'=>$branch]
  ]
];
}elseif ($rule_type === 'SubRule') {
  $query = "SELECT * FROM transcoderule WHERE RuleSetID=".$_POST['rulesetid'];
  $result = $conn->query($query);
  $treeData = [
    'name'=>'Source',
    'children'=>[
      ['name'=>$rule_name,
       'children'=>[['name'=>'1~'.$result->num_rows]]
      ]
    ]
  ];
}


echo json_encode(array('treeData'=>$treeData));


?>
