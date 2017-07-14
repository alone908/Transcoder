<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_brancheditor.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<?php
$query = "SELECT * FROM transcoderule WHERE RuleSetID=".$current_ruleset_id;
$result = $conn->query($query);
$total_branch = $result->num_rows;
?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>
<script>var totalBranchNum=<?php echo $total_branch; ?></script>
<script src="js/rm_brancheditor.js"></script>

<div id="wrapper">

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Rule Manager</li>
          <li>Branch Editor - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
        </ol>
      </div>

      <div id="brancheditor-container">

        <h3>Branch:</h3>
        <select id="branch_select" class="form-control" style="display:inline-block;width:250px;cursor:pointer">
        </select>

        <span id="add_branch_btn" class="btn btn-lg-black" data-toggle="modal" data-target="#addBranchModal">Add Branch</span>
        <span id="del_branch_btn" class="btn btn-lg-black" >Delete Branch</span>

        <div id="conditions_div"></div>

        <br>
        <span id="add_condi_btn" class="btn btn-lg-black">Add Condition</span>

      </div>


    </div>

</div>

<?php include_once 'footer.php';?>
