<?php

require_once 'sqldb.php';

switch ($_POST['op']) {
    case 'get_rule_list':

        $rule_list = array();

        $sql = "SELECT * FROM rulelist";
        $conn->query('SET NAMES UTF8');
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    $rule_list[$row['RuleSetID']][$key] = $value;
                }
            }
        }

        echo json_encode(array('ruleList' => $rule_list));

        break;

    case 'get_rule_obj':

        $sql = "select * from transcoderule where RuleSetID='" . $_POST['RuleSetID'] . "' order by LineNumber";
        $conn->query('SET NAMES UTF8');
        $result = $conn->query($sql);

        $new_rule = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

                $LSB = ($row['LSB'] === 'true') ? true : false;
                $UnixTime = ($row['UnixTime'] === 'true') ? true : false;
                $TranscodeRule = explode(',', $row['TranscodeRule']);
                $OnlyShowInBody = ($row['OnlyShowInBody'] !== null && $row['OnlyShowInBody'] !== '') ? explode(',', $row['OnlyShowInBody']) : [];

                $JumpRuleCondition = [];
                if($row['JumpRuleCondition'] !== null && $row['JumpRuleCondition'] !== ''){
                    $Conditions = explode(';',$row['JumpRuleCondition']);
                    foreach ($Conditions as $key => $condi){
                        $factor = explode('-',$condi);
                        $JumpRuleCondition[] = ['KeyValue'=>$factor[0],'StartLine'=>$factor[1],'JumpToRule'=>$factor[2]];
                    }
                }

                $new_rule[] = ['Subject' => $row['Subject'],
                    'LineNumber' => $row['LineNumber'],
                    'Content' => $row['Content'],
                    'Exp' => $row['Exp'],
                    'Length' => (float)$row['Length'],
                    'DataCoding' => $row['DataCoding'],
                    'LSB' => $LSB,
                    'UnixTime' => $UnixTime,
                    'TranscodeRule' => $TranscodeRule,
                    'Marked' => $row['Marked'],
                    'PreConditionLine' => $row['PreConditionLine'],
                    'ChildRule' => $row['ChildRule'],
                    'Condition' => $row['Condition'],
                    'OnlyShowInBody' => $OnlyShowInBody,
                    'JumpRuleCondition'=> $JumpRuleCondition];
            }
        } else {

        }

        echo json_encode(array('RuleSetID' => $_POST['RuleSetID'], 'new_rule' => $new_rule));

        break;

    default:
        # code...
        break;
}
