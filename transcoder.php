<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_auth']) || $_SESSION['user_enrollment'] !== 'going'){
    header('Location: index.php');
}
?>
<?php require_once 'appphp/sqldb.php'; ?>
<?php include_once 'header.php'; ?>
<?php include_once 'modals.php'; ?>
<?php include_once 'appphp/rule_list_array.php'; ?>
<?php $defaultRuleSetID = 1; ?>

<!-- Custom CSS -->
<link href="css/landing-page.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet">

<!-- Custom JS -->
<script src="js/an.rule.js"></script>
<script src="js/transcoder.js"></script>

<!-- Page Content -->
<div class="" style="padding:0px 10px;">

    <?php include_once 'loader_err.php'; ?>

    <div style="margin-top:60px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li><a href="index.php">Home</a></li>
            <li id="rule-title-li" class="active">Transcoder
                - <?php echo $rule_list[$defaultRuleSetID]['RuleName']; ?></li>
            &nbsp;&nbsp;&nbsp;
            <div id="rule_selector" style="display: inline-block;"></div>
            <span id="start-btn" class="btn btn-black start"><i
                        class='glyphicon glyphicon-play'></i>&nbsp;&nbsp;START</span>
            <span id="clear-btn" class="btn btn-black clear"><i class='glyphicon glyphicon-warning-sign'></i>&nbsp;&nbsp;CLEAR</span>
            <span id="import-btn" class="btn btn-black import" data-toggle="modal" data-target="#importModal"><i
                        class='glyphicon glyphicon-save'></i>&nbsp;&nbsp;IMPORT</span>
            <span id="record-btn" class="btn btn-black" data-toggle="modal" data-target="#recordModal"><i
                        class='glyphicon glyphicon-list-alt'></i>&nbsp;&nbsp;RECORDS</span>
            <span id="calculator-btn" class="btn btn-black" data-toggle="modal" data-target="#calculatorModal"><i
                        class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;CALCULATOR</span>
        </ol>
    </div>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li id="rule-tab"><a href="#">RULE</a></li>
                <li id="source-tab"><a href="#">SOURCE</a></li>
                <li id="form-tab"><a href="#" class="a-active">FORM</a></li>
                <li id="text-tab"><a href="#">TEXT</a></li>
                <li id="log-tab"><a href="#">LOG</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div id="menu-toggle-div">
                <a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list"
                                                              aria-hidden="true"></span></a>
            </div>
            <div id="page-content">

                <div id="rule-tab-container">
                    <span>Select Transcode Rule</span><br>
                    <div id="rule-list-div">
                        <table id="rule-list-table" class="table table-hover">
                            <tbody>
                            <?php
                            foreach ($rule_list as $rule_set_id => $rule) {
                                if ($rule['RuleType'] === 'MainRule') {
                                    $class = ($rule_set_id === $defaultRuleSetID) ? 'info' : '';
                                    echo '<tr style="cursor:pointer;" class="' . $class . '" data-rulesetid="' . $rule_set_id . '" data-rulevar="' . $rule['RuleVar'] . '"><td>' . $rule['RuleName'] . '</td></tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="rule-info">
                        <?php
                        foreach ($rule_list[$defaultRuleSetID] as $key => $value):
                            echo '<span style="font-size:18px">' . $key . ' : ' . $value . '</span><br>';
                        endforeach; ?>
                    </div>
                </div>

                <div id="form-data-container">

                    <div id="form-title-div">
                        <div class="checkbox">
                            <label><input class="checkExp" type="checkbox" value="" checked>Expression</label>
                            <label><input class="checktransCode" type="checkbox" value="" checked>Transcode</label>
                            <label><input class="checktranscodeRule" type="checkbox" value="">Rule</label>
                        </div>
                        <div class="mefTitle">
                            <font id="subrule_title" style="font-weight:bold;">Sub Rule : </font>
                        </div>
                    </div>
                    <div id="form-data" class="dataForm"></div>
                    <div id="mef-form" class="mefForm"></div>

                </div>

                <div id="text-data-container">
                    <span>Text Data</span><br>
                    <textarea type="text" class="form-control dataText" style="width:100%;height:96%;"></textarea>
                </div>

                <div id="log-data-container">
                    <span>Log Data</span><br>
                    <textarea type="text" class="form-control datalog" style="width:100%;height:96%;"></textarea>
                </div>

                <div id="source-data-container">
                    <span>Source Data</span><br>
                    <textarea type="text" class="form-control originalDATA" style="width:100%; height:96%;"></textarea>
                </div>

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

</div>

<!-- Footer -->
<?php include_once 'footer.php'; ?>
