<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_auth'])){
    header('Location: index.php');
}
?>
<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_brancheditor.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<?php

?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>
<script src="js/rm_brancheditor.js"></script>

<div id="wrapper">
    <?php include_once 'loader_err.php'; ?>

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

        <div style="margin-top:10px;">
            <ol class="breadcrumb" style="margin-bottom:10px;">
                <li><a href="index.php">Home</a></li>
                <li>Rule Manager</li>
                <li>Branch Editor - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
                &nbsp;&nbsp;&nbsp;
                <div id="rule_selector" style="display: inline-block;"></div>
            </ol>
        </div>

        <div id="brancheditor-container">

            <h3 id="branch_editor_title">Branch:</h3>
            <select id="branch_select" class="form-control" style="display:inline-block;width:250px;cursor:pointer">
            </select>

            <span id="add_branch_btn" class="btn btn-lg-black" data-toggle="modal" data-target="#addBranchModal"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;ADD</span>
            <span id="del_branch_btn" class="btn btn-lg-black" data-toggle="modal" data-target="#delBranchModal"><i class="fa fa-minus" aria-hidden="true"></i>&nbsp;&nbsp;DELETE</span>
            <span id="save_branch_btn" class="btn btn-lg-black"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;SAVE</span>

            <div id="conditions_div"></div>

            <br>
            <span id="add_condi_btn" class="btn btn-lg-black">Add Condition</span>

        </div>


    </div>

</div>

<?php include_once 'footer.php';?>
