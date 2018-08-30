<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login_user']) || !isset($_SESSION['user_auth']) || $_SESSION['user_auth'] !== 'admin' || $_SESSION['user_enrollment'] !== 'going') {
    header('Location: index.php');
}
?>
<?php require_once 'appphp/sqldb.php'; ?>
<?php include_once 'header.php'; ?>
<?php include_once 'appphp/rule_list_array.php'; ?>
<?php $page = 'rm_preference.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<?php

$rule_list = [];

$sql = "SELECT * FROM rulelist ORDER BY RuleName";
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rule_list[] = [];
        foreach ($row as $key => $value) {
            $rule_list[count($rule_list) - 1][$key] = $value;
        }
    }
}

?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/rm_preference.js"></script>

<div id="wrapper">

    <?php include_once 'loader_err.php'; ?>

    <?php include_once 'rm_sidebar.php'; ?>

    <div id="page-wrapper" style="position:absolute; width:100%; min-height:100%; overflow: auto; margin-bottom: 36px;">

        <div style="margin-top:10px;">
            <ol class="breadcrumb" style="margin-bottom:10px;">
                <li><a href="index.php">Home</a></li>
                <li>Rule Manager</li>
                <li>Preference</li>
            </ol>
        </div>

        <?php

        $rule_selector_types = [
            'InTranscoder',
            'InRuleEditor',
            'InAdvanceEditor',
            'InRuleBranch',
            'InBranchEditor'
        ];

        foreach ($rule_selector_types as $type_key => $type){

            $all_rule_has = true;
            if($type === 'InTranscoder'){
                $title = 'in Transcoder';
            } elseif ($type === 'InRuleEditor'){
                $title = 'in RuleEditor';
            } elseif ($type === 'InAdvanceEditor'){
                $title = 'in AdvanceEditor';
            } elseif ($type === 'InRuleBranch'){
                $title = 'in RuleBranch';
            } elseif ($type === 'InBranchEditor'){
                $title = 'in BranchEditor';
            }

        ?>

            <div style="clear: both; margin-bottom: 10px; overflow: auto;">

                <div style="float: left; width: 25%;">
                    <span>Rule Selector <?php echo $title;?></span>
                </div>
                <div style="float: right; width: 75%; max-height: 150px; overflow: auto;">
                    <?php

                    foreach ($rule_list as $key => $rule) {

                        if(!strpos($rule['RuleSelectorType'], $type) && strpos($rule['RuleSelectorType'], $type) !== 0){
                            $all_rule_has = false;
                        }

                        ?>

                        <div class="checkbox" style="display: inline-block; width: auto;">
                            <label>
                                <input type="checkbox" value="<?php echo $rule['RuleSetID']; ?>" name="<?php echo $type; ?>" <?php if(strpos($rule['RuleSelectorType'], $type) || strpos($rule['RuleSelectorType'], $type) === 0) echo 'checked'; ?>>
                                <?php echo $rule['RuleName']; ?>
                            </label>
                        </div>

                        <?php
                    }

                    ?>

                    <div class="checkbox" style="display: inline-block; width: auto;">
                        <label>
                            <input class="selectAll" type="checkbox" value="All" data-ruleselectortype="<?php echo $type; ?>" <?php if($all_rule_has) echo 'checked' ?>>
                            Select All
                        </label>
                    </div>

                </div>

            </div>

        <?php

        }

        ?>

        <span id="save_preference" class="btn btn-black"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;SAVE</span>

    </div>

</div>

<?php include_once 'footer.php'; ?>
