<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_brancheditor.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<?php
$query = "SELECT * FROM transcoderule WHERE RuleSetID=".$current_ruleset_id." AND NOT `Condition`='' ORDER BY LineNumber ASC;";
$conn->query('SET NAMES UTF8');
$result = $conn->query($query);

$first_branch_id = null;

if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      if($first_branch_id === null) $first_branch_id = $row['id'];
      $branch[$row['id']] = ['id'=>$row['id'],'LineNumber'=>$row['LineNumber'],'Marked'=>$row['Marked'],'PreConditionLine'=>$row['PreConditionLine'],'Condition'=>$row['Condition'],'ChildRule'=>$row['ChildRule']];

      $conditions = explode(';',$row['Condition']);
      unset($conditions[count($conditions)-1]);

      foreach ($conditions as $key => $condi) {

        preg_match('/markedValue\["(.*)"]/', $condi, $matches);
        if(isset($matches[1])){
          $pre_condi_line = $matches[1];
        }else {
          $pre_condi_line = null;
        }

        preg_match('/===\s"(.*)"\)/', $condi, $matches);
        if(isset($matches[1])){
          $condi_value = $matches[1];
        }else {
          $condi_value = null;
        }

        preg_match('/childRuleSet\s=\s"(.*)"/', $condi, $matches);
        if(isset($matches[1])){
          $child_ruleset = $matches[1];
        }else {
          $child_ruleset = null;
        }

        $branch[$row['id']]['condition_array'][] = ['pre_line'=>$pre_condi_line,'condi_val'=>$condi_value,'childset'=>$child_ruleset];

      }
  }
}

$query = "SELECT * FROM transcoderule WHERE RuleSetID=".$defaultRuleSetID;
$result = $conn->query($query);
$total_lines = $result->num_rows;

?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>
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
          <?php
          foreach ($branch as $key => $line) :
          ?>
            <option value="<?php echo $line['id']?>">Line : <?php echo $line['LineNumber']?></option>
          <?php
          endforeach;
          ?>
        </select>

        <span id="" class="btn btn-lg-black" >Add Branch</span>
        <span id="" class="btn btn-lg-black" disabled>Add Condition</span>

        <div id="conditions_div">

          <?php
          foreach ($branch[$first_branch_id]['condition_array'] as $key => $condi) {
            if($condi['pre_line'] !== null && $condi['pre_line'] !== ''){
          ?>

          <div class="condi_container" style="margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;">

            <form class="form-inline">

              <div class="form-group">
                <label style="font-size:18px;">Previous&nbsp;&nbsp;Line&nbsp;&nbsp;</label>
                <select class="form-control" style="width:100px;cursor:pointer;vertical-align:text-bottom;">
                  <?php
                    for($i=1;$i<=$total_lines;$i++){
                      if($i === (integer) $condi['pre_line']){
                        echo '<option value="'.$i.'" selected>'.$i.'</option>';
                      }else {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      }
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label style="font-size:18px;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Equals&nbsp;&nbsp;Value&nbsp;&nbsp;</label>
                <input type="text" class="form-control" placeholder="value" value="<?php echo $condi['condi_val'];?>" style="width:100px;vertical-align:text-bottom;">
              </div>

              <div class="form-group">
                <label style="font-size:18px;"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>
                <select class="form-control" style="width:200px;cursor:pointer;vertical-align:text-bottom;">
                  <?php
                  foreach ($rule_list as $rulesetid => $rule) {
                    if($rule['RuleType'] === 'SubRule'){
                      if($rulesetid === (integer) $condi['childset']){
                        echo '<option value="'.$rulesetid.'" selected>'.$rule['RuleName'].'</option>';
                      }else {
                        echo '<option value="'.$rulesetid.'">'.$rule['RuleName'].'</option>';
                      }
                    }
                  }
                  ?>
                </select>
              </div>

            </form>

          </div>

          <?php
            }elseif ($condi['pre_line'] === null || $condi['pre_line'] === ''){

          ?>
          <div class="condi_container" style="margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;">

            <form class="form-inline">
              <div class="form-group">
                <label style="font-size:18px;">Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>
                <select class="form-control" style="width:200px;cursor:pointer;vertical-align:text-bottom;">
                  <?php
                  foreach ($rule_list as $rulesetid => $rule) {
                    if($rule['RuleType'] === 'SubRule'){
                      if($rulesetid === (integer) $condi['childset']){
                        echo '<option value="'.$rulesetid.'" selected>'.$rule['RuleName'].'</option>';
                      }else {
                        echo '<option value="'.$rulesetid.'">'.$rule['RuleName'].'</option>';
                      }
                    }
                  }
                  ?>
                </select>
              </div>
            </form>

          </div>

          <?php
            }
          }
          ?>

        </div>

      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
