
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php	require_once 'appphp/TranscodeRule.php';	?>

<script>var TranscodeRule = '<?php echo $transcodeRuleJSON; ?>'</script>

<!-- Page Content -->
<div class="" style="padding:0px 10px;">

    <div style="margin-top:60px;">
      <ol class="breadcrumb" style="margin-bottom:10px;">
        <li><a href="index.php">Home</a></li>
        <li class="active">Transcoder</li>
        &nbsp;&nbsp;&nbsp;
        <span id="start-btn" class="btn btn-black start"><i class='glyphicon glyphicon-play'></i>&nbsp;&nbsp;START</span>
        <span id="clear-btn" class="btn btn-black clear"><i class='glyphicon glyphicon-warning-sign'></i>&nbsp;&nbsp;CLEAR</span>
        <span id="import-btn" class="btn btn-black import" data-toggle="modal" data-target="#importModal"><i class='glyphicon glyphicon-save'></i>&nbsp;&nbsp;IMPORT</span>
        <span id="record-btn" class="btn btn-black" data-toggle="modal" data-target="#recordModal"><i class='glyphicon glyphicon-list-alt'></i>&nbsp;&nbsp;RECORDS</button>
        &nbsp;
      </ol>

    </div>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
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
                <a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
            <div id="page-content">

              <div id="form-data-container">

                <div id="form-title-div">
                  <div class="checkbox">
      					     <label><input class="checkContent" type="checkbox" value="" checked>Content</label>
      						   <label><input class="checktransCode" type="checkbox" value="" checked>Transcode</label>
      						   <label><input class="checktranscodeRule" type="checkbox" value="" >Rule</label>
      					   </div>
                   <div class="mefTitle">
                     <font style="font-weight:bold;">MEF01/MEF03/MEF08/MEF0B</font>
                   </div>
                </div>
                <div id="form-data" class = "dataForm"></div>
                <div id="mef-form" class = "mefForm"></div>

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

<script>

    $(document).ready(function(){
    })
</script>

<!-- Footer -->
<?php include_once 'footer.php';?>
