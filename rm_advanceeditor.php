<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_auth']) || $_SESSION['user_auth'] !== 'admin' || $_SESSION['user_enrollment'] !== 'going'){
    header('Location: index.php');
}
?>
<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_advanceeditor.php' ?>
<?php $defaultRuleSetID = 1 ?>
<?php $current_ruleset_id = (isset($_GET['rulesetid'])) ? $_GET['rulesetid'] : $defaultRuleSetID ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/rm_advanceeditor.js"></script>
<script>var currentRulesetID=<?php echo $current_ruleset_id; ?></script>

<div id="wrapper">
    <?php include_once 'loader_err.php'; ?>

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

        <div>
            <ol class="breadcrumb" style="margin-bottom:10px;">
                <li><a href="index.php">Home</a></li>
                <li>Rule Manager</li>
                <li>Rule Editor - <?php echo $rule_list[$current_ruleset_id]['RuleName'];?></li>
                &nbsp;&nbsp;&nbsp;
                <div id="rule_selector" style="display: inline-block;"></div>
                <span id="save_btn" class="btn btn-black start"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;SAVE</span>
            </ol>
        </div>

        <div id="editor" style="height:85%;">
            <div id="editor_title" style="height:30px;background-color:#222;color:#9d9d9d;">
                <!-- <span style="display:inline-block;padding:5px;width:25px;"></span> -->
                <span style="display:inline-block;padding:5px;width:50px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">#</span>
                <span style="display:inline-block;padding:5px;width:15%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Subject</span>
                <span style="display:inline-block;padding:5px;width:15%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Content</span>
                <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Marked</span>
                <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">PreConditionLine</span>
                <span style="display:inline-block;padding:5px;width:10%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">ChildRule</span>
                <span style="display:inline-block;padding:5px;width:20%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;">Condition</span>
                <span style="display:inline-block;padding:5px;width:100px;text-overflow:ellipsis;white-space:nowrap;overflow:hidden;vertical-align:top;"></span>
            </div>
            <div id="rule_row_container" style="height:85%;border-left:1px solid #222;border-right:1px solid #222;border-bottom:1px solid #222;overflow:auto;">

                <?php

                $sql = "select * from transcoderule where RuleSetID='".$current_ruleset_id."' order by LineNumber";
                $conn->query('SET NAMES UTF8');
                $result = $conn->query($sql);

                $new_rule = array();

                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        if($row['Subject'] === 'Blank' || $row['Subject'] === 'HeadTitle' || $row['Subject'] === 'BodyTitle'){ ?>

                            <div id="<?php echo $row['id'];?>" class="rule_row" style="background-color:<?php if($row['Subject'] === 'Blank'){echo '#d9edf7';}else{echo '#B2E0F7';}?>;" data-subject="<?php echo $row['Subject']?>">

                                <!-- <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span> -->
                                <span class="LineNumber editor_line_span" style="width:50px;"><?php echo $row['LineNumber'];?></span>

                                <?php if($row['Subject'] === 'Blank'){ ?>
                                    <input class="Subject editor_line_input" type="text" style="width:15%;" value="<?php echo $row['Subject'];?>"></input>
                                <?php }else { ?>
                                    <span class="Subject editor_line_span" style="width:15%;border-bottom:1px solid black;"><?php echo $row['Subject'];?></span>
                                <?php } ?>
                                <span class="Content editor_line_span" style="width:15%;"><?php echo $row['Content']?></span>
                                <span class="Marked editor_line_span" style="width:10%;"></span>
                                <span class="PreConditionLine editor_line_span" style="width:10%;"></span>
                                <span class="ChildRule editor_line_span" style="width:10%;"></span>
                                <span class="Condition editor_line_span" style="width:20%;"></span>
                                <span class="editor_line_span">
                    <!-- <button class="btn btn-sm-black insert_btn" data-id="<?php echo $row['id'];?>" data-linenumber="<?php echo $row['LineNumber'];?>" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button> -->
                                    <?php if($row['Subject'] === 'Blank'){ ?>
                                        <!-- <button class="btn btn-sm-black del_btn" data-id="<?php echo $row['id'];?>" data-linenumber="<?php echo $row['LineNumber'];?>" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button> -->
                                        <?php
                                    }
                                    ?>
                  </span>

                            </div>

                            <?php
                        }else {
                            ?>

                            <div id="<?php echo $row['id'];?>" class="rule_row" data-subject="<?php echo $row['Subject']?>">

                                <!-- <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span> -->
                                <span class="LineNumber editor_line_span" style="width:50px;"><?php echo $row['LineNumber'];?></span>
                                <input class="Subject editor_line_input" type="text" style="width:15%;" value="<?php echo $row['Subject'];?>"></input>
                                <input class="Content editor_line_input" type="text" style="width:15%;" value="<?php echo $row['Content'];?>"></input>
                                <input class="Marked editor_line_input" type="text" style="width:10%;" value="<?php echo $row['Marked'];?>"></input>
                                <input class="PreConditionLine editor_line_input" type="text" style="width:10%;" value="<?php echo $row['PreConditionLine'];?>"></input>
                                <input class="ChildRule editor_line_input" type="text" style="width:10%;" value="<?php echo $row['ChildRule'];?>"></input>
                                <input class="Condition editor_line_input" type="text" style="width:20%;" value="<?php echo htmlspecialchars($row['Condition']);?>"></input>
                                <span class="editor_line_span">
                  <!-- <button class="btn btn-sm-black insert_btn" data-id="<?php echo $row['id'];?>" data-linenumber="<?php echo $row['LineNumber'];?>" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button> -->
                                    <!-- <button class="btn btn-sm-black del_btn" data-id="<?php echo $row['id'];?>" data-linenumber="<?php echo $row['LineNumber'];?>" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button> -->
                  <button class="btn btn-sm-black detail_btn" data-id="<?php echo $row['id'];?>">&nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i>&nbsp;</button>
                </span>
                                <br>
                                <div id="detail_<?php echo $row['id'];?>" style="display:none;height:225px;padding-left:75px;background-color:#f5f5f5;">

                                    <div style="display:inline-block;width:50%;float:left;padding:10px;">
                                        <span><?php echo 'id : '.$row['id']; ?></span><br>
                                        <span><?php echo 'RuleSetID : '.$row['RuleSetID']; ?></span><br>
                                        <span><?php echo 'RuleName : '.$row['RuleName']; ?></span><br>
                                        <span><?php echo 'RuleType : '.$row['RuleType']; ?></span><br>
                                        <span><?php echo 'RuleVar : '.$row['RuleVar']; ?></span><br>
                                        <span class="detail_linenumber"><?php echo 'LineNumber : '.$row['LineNumber']; ?></span><br>
                                        <span><?php echo 'Subject : '.$row['Subject']; ?></span><br>
                                        <span><?php echo 'Content : '.$row['Content']; ?></span><br>
                                        <span><?php echo 'Exp : '.$row['Exp']; ?></span><br>
                                        <span><?php echo 'Length : '.$row['Length']; ?></span><br>
                                    </div>

                                    <div style="display:inline-block;width:50%;float:right;padding:10px;">

                                        <span><?php echo 'DataCoding : '.$row['DataCoding']; ?></span><br>
                                        <span><?php echo 'LSB : '.$row['LSB']; ?></span><br>
                                        <span><?php echo 'UnixTime : '.$row['UnixTime']; ?></span><br>
                                        <span><?php echo 'TranscodeRule : '.$row['TranscodeRule']; ?></span><br>
                                        <span><?php echo 'CreateTime : '.$row['CreateTime']; ?></span><br>
                                        <span><?php echo 'Marked : '.$row['Marked']; ?></span><br>
                                        <span><?php echo 'PreConditionLine : '.$row['PreConditionLine']; ?></span><br>
                                        <span><?php echo 'ChildRule : '.$row['ChildRule']; ?></span><br>
                                        <span><?php echo 'Condition : '.$row['Condition']; ?></span><br>

                                    </div>

                                </div>

                            </div>

                            <?php
                        }
                    }
                }
                ?>

            </div>
        </div>

    </div>

</div>

<?php include_once 'footer.php';?>
