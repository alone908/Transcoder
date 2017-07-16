<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>

<?php $page = 'ad_sourcecode.php' ?>

<!-- Custom CSS -->
<link rel="stylesheet" href="css/codemirror.css" type="text/css">
<link rel="stylesheet" href="css/zTreeStyle.css" type="text/css">
<link href="css/sb-admin.css" rel="stylesheet">

<!-- Custom JS -->
<script src="appjs/jquery.ztree.all.js" type="text/javascript"></script>

<script src="appjs/lib/codemirror.js"></script>
<script src="appjs/addon/edit/closetag.js"></script>
<script src="appjs/addon/fold/xml-fold.js"></script>
<script src="appjs/addon/edit/matchtags.js"></script>
<script src="appjs/addon/display/placeholder.js"></script>

<script src="appjs/mode/clike/clike.js"></script>
<script src="appjs/mode/xml/xml.js"></script>
<script src="appjs/mode/javascript/javascript.js"></script>
<script src="appjs/mode/css/css.js"></script>
<script src="appjs/mode/htmlmixed/htmlmixed.js"></script>
<script src="appjs/mode/sql/sql.js"></script>
<script src="appjs/mode/php/php.js"></script>

<script src="js/ad_sourcecode.js"></script>

<div id="wrapper">
<?php include_once 'loader_err.php'; ?>

    <?php include_once 'ad_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Advance</li>
          <li>Source Code</li>
        </ol>
      </div>

      <div id="" class="" style="width:100%;height:100%;padding:0px;">

        <style type="text/css">
        	.CodeMirror {height: auto;}
        	.CodeMirror pre.CodeMirror-placeholder { color: #999; }
        	.CodeMirror pre { line-height: 1.25;}
        	.CodeMirror-linenumber { line-height: 1.25;}
        </style>

        <div style="display:inline-block;">
            <div id="zTreeDiv">
              <ul id="treeDemo" class="ztree"></ul>
            </div>
            <br>
            <button class="btn btn-lg-black saveFile" style="display:none;">
              <i class='glyphicon glyphicon-floppy-disk'></i>&nbsp;&nbsp;Save
            </button>
        </div>


        <div id="previewfile" class="previewfile" style=""></div>

      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
