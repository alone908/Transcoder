var zTreeObj;

var setting = {
  callback:{
    onClick:function(e){
      var file_ext = e.target.dataset.url.split('.').pop();
      build_codeMirror(e.target.dataset.url,file_ext);
    }
  }
};

$.ajax({
  type: 'POST',
  url: "appphp/zTreeNode.php",
  data:{},
  dataType: "json",
  success: function (zTreeNodes) {

    $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zTreeNodes);
    });

  }
});

function build_codeMirror(url,file_ext){

  $('.previewfile').html('');
  var mode = 'text/html';
  if(file_ext === 'css') { mode = 'text/css'; }
  if(file_ext === 'js' ) { mode = 'text/javascript'; }
  if(file_ext === 'php') { mode = 'application/x-httpd-php'; }
  if(file_ext === 'sql') { mode = 'text/x-sql'; }

  $.ajax({
    type: 'POST',
    url: "appphp/get_file_content.php",
    data:{url:url},
    dataType: "json",
    success: function (lines) {
        console.log(lines);
        var file_content = lines.join("");

        $('.previewfile').html('<textarea id="codeMirror" type="text"></textarea>');
        $('#codeMirror').text(file_content);

        var editor = CodeMirror.fromTextArea(document.getElementById("codeMirror"), {
          lineNumbers: true,
          mode: mode,
          autoCloseTags: true,
          matchTags: {bothTags: true},
          extraKeys: {"Ctrl-J": "toMatchingTag"},
          lineWrapping: true,
          styleActiveLine: true,
          readOnly:true

        });
        editor.on('update', function (instance) {
          $("#codeMirror").val(instance.getValue());
        });

    }
  });

}
