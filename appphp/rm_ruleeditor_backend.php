<?php

require_once 'sqldb.php';

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',', '', (string)date(DATE_RFC850));


switch ($_POST['op']) {
    case 'save_rule_table':

        foreach ($_POST['ruleTable'] as $key => $rule_row) {

            switch ($rule_row['op']) {
                case 'insert':

                    $query = "SELECT * FROM rulelist WHERE RuleSetID=" . $_POST['rulesetid'];
                    $conn->query('SET NAMES UTF8');
                    $result = $conn->query($query);
                    $row = $result->fetch_assoc();

                    $rule_name = $row['RuleName'];
                    $rule_type = $row['RuleType'];
                    $rule_var = 'RuleSet_' . $_POST['rulesetid'];
                    $content = $rule_row['Exp'];

                    $query = "INSERT INTO
                    transcoderule(RuleSetID,RuleName,RuleType,RuleVar,LineNumber,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,TranscodeRule,CreateTime,Marked)
                    VALUES (" . $_POST['rulesetid'] . ",'" . $rule_name . "','" . $rule_type . "','" . $rule_var . "'," . $rule_row['LineNumber'] . ",
                    '" . $rule_row['Subject'] . "','" . $content . "','" . $rule_row['Exp'] . "'," . $rule_row['Length'] . ",'" . $rule_row['DataCoding'] . "','" . $rule_row['LSB'] . "','" . $rule_row['UnixTime'] . "','" . $rule_row['TranscodeRule'] . "','" . $localTime . "',
                    'false')";

                    $conn->query('SET NAMES UTF8');
                    $conn->query($query);

                    break;

                case 'update':

                    $query = "UPDATE transcoderule SET LineNumber=" . $rule_row['LineNumber'] . ",Exp='" . $rule_row['Exp'] . "',Length=" . $rule_row['Length'] . ",DataCoding='" . $rule_row['DataCoding'] . "',
                    LSB='" . $rule_row['LSB'] . "',UnixTime='" . $rule_row['UnixTime'] . "',TranscodeRule='" . $rule_row['TranscodeRule'] . "',CreateTime='" . $localTime . "' WHERE id=" . $rule_row['id'];

                    $conn->query('SET NAMES UTF8');
                    $conn->query($query);

                    break;

                case 'delete':

                    $query = "DELETE FROM transcoderule WHERE id=" . $rule_row['id'];
                    $result = $conn->query($query);

                    break;

            }
        }

        echo json_encode(array('RuleSetID' => $_POST['rulesetid']));

        break;
}


?>
