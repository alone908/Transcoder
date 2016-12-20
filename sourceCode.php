<?php

require_once 'header.php';

?>


  <link rel="stylesheet" href="css/zTree.custom.css" type="text/css">
  <link rel="stylesheet" href="css/zTreeStyle.css" type="text/css">
  <script type="text/javascript" src="js/jquery.ztree.all.min.js"></script>
  <SCRIPT LANGUAGE="JavaScript">
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
   var zNodes = [
   {name:"test1", open:true, children:[
      {name:"test1_1"}, {name:"test1_2"}]},
   {name:"test2", open:true, children:[
      {name:"test2_1"}, {name:"test2_2"}]}
   ];
   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
   });
  </SCRIPT>
 </HEAD>
<BODY>
<div>
   <ul id="treeDemo" class="ztree"></ul>
</div>
</BODY>
</HTML>
