<?php

require_once 'sqldb.php';

switch ($_POST['op']) {
    case 'save_preference':

        $ruleHasSelectorType = $_POST['ruleHasSelectorType'];

        foreach ($ruleHasSelectorType as $key => $types){

            $rule_set_id = substr($key, 10);
            $query = "UPDATE rulelist SET `RuleSelectorType`='".$types."' WHERE `RuleSetID`=".$rule_set_id;
            $conn->query($query);

        }


        echo json_encode(array('result'=>'good', 'RuleHasSelectorType'=>$ruleHasSelectorType));

        break;
}


?>
