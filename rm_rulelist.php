<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_rulelist.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/rm_rulelist.js"></script>
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>

<div id="wrapper">

<?php include_once 'loader_err.php'; ?>

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Rule Manager</li>
          <li id="rule-title-li">Rule List - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
        </ol>
      </div>

      <span>Select Transcode Rule</span>
      <button class="btn btn-lg-black add_rule_btn" data-toggle="modal" data-target="#addRuleModal" style="display:inline-block;margin-left:25px;">
        Add Rule
      </button>
      <br>
      <div id="rule-list-div">
        <table id="rule-list-table" class="table table-hover">
          <tbody>
            <?php
              foreach ($rule_list as $rule_set_id => $rule) {
                  $class = ($rule_set_id === (integer) $current_ruleset_id) ? 'info' : '';
                  echo '<tr style="cursor:pointer;" class="'.$class.'" data-rulesetid="'.$rule_set_id.'" data-rulevar="'.$rule['RuleVar'].'">
                  <td style="padding:8px 2px;">'.$rule['RuleName'].'</td>
                  <td style="padding:8px 2px;width:75px;">
                  <button class="btn btn-sm-black edit_rule_btn" data-rulesetid="'.$rule_set_id.'" data-toggle="modal" data-target="#editRuleModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                  <button class="btn btn-sm-black clone_rule_btn" data-rulesetid="'.$rule_set_id.'" data-toggle="modal" data-target="#cloneRuleModal"><i class="fa fa-clone" aria-hidden="true"></i></button>
                  <button class="btn btn-sm-black del_rule_btn" data-rulesetid="'.$rule_set_id.'" data-toggle="modal" data-target="#delRuleModal"><i class="fa fa-minus-square-o" aria-hidden="true"></i></button>
                  </td></tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
      <div id="rule-info">
        <?php
        foreach ($rule_list[$current_ruleset_id] as $key => $value) :
            echo '<span style="font-size:18px">'.$key.' : '.$value.'</span><br>';
        endforeach;
        ?>
      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
