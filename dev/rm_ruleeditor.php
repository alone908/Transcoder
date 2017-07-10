<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_ruleeditor.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/rm_ruleeditor.js"></script>
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>

<div id="wrapper">

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Rule Manager</li>
          <li>Rule Editor - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
        </ol>
      </div>

      <div id="editor" style="height:85%;">
        <div id="editor_title" style="height:30px;background-color:#222;color:#9d9d9d;">
          <span style="display:inline-block;padding:5px;width:25px;"></span>
          <span style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">#</span>
          <span style="display:inline-block;padding:5px;width:20%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Exp</span>
          <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Length</span>
          <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">DataCoding</span>
          <span style="display:inline-block;padding:5px;width:5%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">LSB</span>
          <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">UnixTime</span>
          <span style="display:inline-block;padding:5px;width:20%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">TranscodeRule</span>
          <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;"></span>
        </div>
        <div id="rule_row_container" style="height:85%;border-left:1px solid #222;border-right:1px solid #222;border-bottom:1px solid #222;overflow:auto;">

          <?php

          $sql = "select * from transcoderule where RuleSetID='".$current_ruleset_id."' order by LineNumber";
          $conn->query('SET NAMES UTF8');
          $result = $conn->query($sql);

          $new_rule = array();

          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { ?>

              <div class="rule_row">

                <span class="handle" style="display:inline-block;padding:5px;width:24px;cursor:pointer;"><i class="fa fa-bars" aria-hidden="true"></i></span>
                <span type="text" style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;border-bottom:1px solid black;"><?php echo $row['LineNumber'];?></span>
                <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['Exp'];?>"></input>
                <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['Length'];?>"></input>
                <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['DataCoding'];?>"></input>
                <input type="text" style="width:5%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['LSB'];?>"></input>
                <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['UnixTime'];?>"></input>
                <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="<?php echo $row['TranscodeRule'];?>"></input>
                <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">
                  <button class="btn btn-sm-black"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>
                  <button class="btn btn-sm-black">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
                </span>

              </div>

          <?php
            }
          }
          ?>

          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
            $( function() {
              $( "#rule_row_container" ).sortable({handle: ".handle"});
              $( "#rule_row_container" ).disableSelection();
            } );
            </script>

          <!-- <div class="rule_row">

            <span style="display:inline-block;padding:5px;width:24px;cursor:pointer;"><i class="fa fa-bars" aria-hidden="true"></i></span>
            <span type="text" style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;border-bottom:1px solid black;">#</span>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Exp"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Length"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="DataCoding"></input>
            <input type="text" style="width:5%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="LSB"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="UnixTime"></input>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="TranscodeRule"></input>
            <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">
              <button class="btn btn-sm-black"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>
              <button class="btn btn-sm-black">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
            </span>

          </div>

          <div class="rule_row">

            <span style="display:inline-block;padding:5px;width:24px;cursor:pointer;"><i class="fa fa-bars" aria-hidden="true"></i></span>
            <span type="text" style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;border-bottom:1px solid black;">#</span>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Exp"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Length"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="DataCoding"></input>
            <input type="text" style="width:5%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="LSB"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="UnixTime"></input>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="TranscodeRule"></input>
            <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">
              <button class="btn btn-sm-black"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>
              <button class="btn btn-sm-black">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
            </span>

          </div>

          <div class="rule_row">

            <span style="display:inline-block;padding:5px;width:24px;cursor:pointer;"><i class="fa fa-bars" aria-hidden="true"></i></span>
            <span type="text" style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;border-bottom:1px solid black;">#</span>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Exp"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="Length"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="DataCoding"></input>
            <input type="text" style="width:5%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="LSB"></input>
            <input type="text" style="width:10%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="UnixTime"></input>
            <input type="text" style="width:20%;border:0;outline:0;background:transparent;border-bottom: 1px solid black;padding:5px;" value="TranscodeRule"></input>
            <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">
              <button class="btn btn-sm-black"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>
              <button class="btn btn-sm-black">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
            </span>

          </div> -->

        </div>
      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
