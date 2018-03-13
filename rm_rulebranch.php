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
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_rulebranch.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- load the d3.js library -->
<script src="appjs/d3.min.js"></script>
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>

<style>

    .node circle {
        fill: #fff;
        stroke: steelblue;
        stroke-width: 2px;
    }

    .node text {
        font: 14px;
        font-family: 'Noto Sans TC', sans-serif;
    }

    .link {
        fill: none;
        stroke: #ccc;
        stroke-width: 2px;
    }

</style>

<div id="wrapper">
    <?php include_once 'loader_err.php'; ?>

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

        <div style="margin-top:10px;">
            <ol class="breadcrumb" style="margin-bottom:10px;">
                <li><a href="index.php">Home</a></li>
                <li>Rule Manager</li>
                <li>Rule Branch - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
                &nbsp;&nbsp;&nbsp;
                <div id="rule_selector" style="display: inline-block;"></div>
            </ol>
        </div>

        <div id="#TreeContainer" style="height:500px;width:800px;">
            <svg></svg>
        </div>

    </div>

</div>

<!-- Custom JS -->
<script src="js/rm_rulebranch.js"></script>

<?php include_once 'footer.php';?>
