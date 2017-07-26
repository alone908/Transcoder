<?php
require_once 'header.php';
?>

<link rel="stylesheet" href="css/zTree.custom.css" type="text/css">
<link rel="stylesheet" href="css/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="js/jquery.ztree.all.js"></script>

<script src="js/lib/codemirror.js"></script>
<script src="js/addon/edit/closetag.js"></script>
<script src="js/addon/fold/xml-fold.js"></script>
<script src="js/addon/edit/matchtags.js"></script>
<script src="js/addon/display/placeholder.js"></script>

<script src="js/mode/clike/clike.js"></script>
<script src="js/mode/xml/xml.js"></script>
<script src="js/mode/javascript/javascript.js"></script>
<script src="js/mode/css/css.js"></script>
<script src="js/mode/htmlmixed/htmlmixed.js"></script>
<script src="js/mode/sql/sql.js"></script>
<script src="js/mode/php/php.js"></script>

<link rel="stylesheet" href="css/codemirror.css">
<style type="text/css">
	.CodeMirror {height: auto;}
	.CodeMirror pre.CodeMirror-placeholder { color: #999; }
	.CodeMirror pre { line-height: 1.25;}
	.CodeMirror-linenumber { line-height: 1.25;}
</style>

<link rel="stylesheet" href="css/sourceCode.css" type="text/css">
<script src="js/sourceCode.js"></script>

<div class="container" style="margin:0px;">

  <nav class="navbar navbar-inverse" style="margin:5px 0px;padding:10px 5px;min-height:0px;">
	  <a href="index.php?noCover=true" class="btn btn-info" style="background-color:#0e61a7;">
      <i class='glyphicon glyphicon-arrow-left'></i>&nbsp;&nbsp;Go Back
    </a>
  </nav>

  <font style="font-size:18px;font-weight:bold;display:inline-block;">You can see all the source code of this project here.</font>
	<button class="btn btn-info saveFile" style="background-color:#0e61a7;padding:0px 6px;vertical-align:bottom;display:none;">
		<i class='glyphicon glyphicon-floppy-disk'></i>&nbsp;&nbsp;Save
	</button>

  <br>

  <div style="display:inline-block;">
     <ul id="treeDemo" class="ztree"></ul>
  </div>

  <div class="previewfile">
  </dvi>

</div>
