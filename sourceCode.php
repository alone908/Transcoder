<?php

require_once 'header.php';

$treeNode = json_encode( file_list(__DIR__,array()) );

function file_list($dir,$treeNode){

    $entry = [];
    $files = scandir($dir);
    foreach ( $files as $index => $file  ){

      if(is_file($dir .'/'. $file) && !in_array($file,['.','..','.git'])){

        $entry[] = ['name'=>$file,'filetype'=>'file','path'=>$dir .'/'. $file];

      }elseif (is_dir($dir .'/'. $file) && !in_array($file,['.','..','.git'])) {

        $treeNode[] = ['name'=>$file,'open'=>false,'filetype'=>'dir','children'=>[]];
        $enterKey = count($treeNode)-1;
        $returnNode = file_list( $dir.'/'.$file, $treeNode[$enterKey]['children'] );
        $treeNode[$enterKey]['children'] = $returnNode;

      }
    }

    $treeNode = array_merge($treeNode,$entry);

  return $treeNode;
}

?>


<link rel="stylesheet" href="css/zTree.custom.css" type="text/css">
<link rel="stylesheet" href="css/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="js/jquery.ztree.all.js"></script>

<!-- <script src="js/lib/codemirror.js"></script>
<script src="js/mode/javascript/javascript.js"></script> -->
<link rel="stylesheet" href="css/codemirror.css">

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

<style type="text/css">
	.CodeMirror {border: 1px solid #888; height: auto;}
	.CodeMirror pre.CodeMirror-placeholder { color: #999; }
	.CodeMirror pre { line-height: 1.25;}
	.CodeMirror-linenumber { line-height: 1.25;}
</style>



<script type="text/javascript">
   var zTreeObj;
   // zTree configuration information, refer to API documentation (setting details)
   var setting = {
     callback:{
       onClick:function(e){
         console.log(e);
       }
     }
   };

   // zTree data attributes, refer to the API documentation (treeNode data details)
   var zNodes = '<?php echo $treeNode;?>';
   zNodes = JSON.parse(zNodes);

   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);

      var editor = CodeMirror.fromTextArea(document.getElementById("codeMirror"), {
          lineNumbers: true,
          //mode: 'application/x-httpd-php',
          // mode: 'text/html',
          mode: 'text/javascript',
          // mode: 'application/x-httpd-php',
          // mode: 'text/css',
          // mode: 'text/x-sql',
          // autoCloseTags: true,
          // matchTags: {bothTags: true},
          //extraKeys: {"Ctrl-J": "toMatchingTag"},
          lineWrapping: true,
          styleActiveLine: true,
          readOnly:true

        });
        editor.on('update', function (instance) {
          $("#codeMirror").val(instance.getValue());
        });


   });
</script>

<div class="container" style="margin:0px;">
<!-- Nav tabs -->
  <nav class="navbar navbar-inverse" style="margin:5px 0px;padding:10px 5px;min-height:0px;">
	  <a href="parser.php?noCover=true" class="btn btn-info" style="background-color:#0e61a7;"><i class='glyphicon glyphicon-arrow-left'></i>&nbsp;&nbsp;Go Back</a>
  </nav>

  <div style="display:inline-block;">
     <ul id="treeDemo" class="ztree"></ul>
  </div>

  <div class="previewfile" style="display:inline-block;width:1000px;height:500px;vertical-align:top;margin:10px;">
    <textarea id="codeMirror" type="text" style="font-size:10px;width:850px;height:500px;"><?php
print_r( file_get_contents('js/parser.js') );
        //print_r( file_get_contents('appphp/insertRecord.php') );
        //print_r( file_get_contents('MySQL/CardData_DataRecord.sql') );
?>
    </textarea>
  </dvi>

</div>
