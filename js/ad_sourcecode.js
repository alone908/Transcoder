
$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );
  $('#previewfile').css('width', ($(document).width()-500).toString()+'px' );

  $('.saveFile').click(function(e){

    if(codeMirrorValue){
      $('#loader').css('display','block');
      $.ajax({
        type: 'POST',
        url: "appphp/ad_sourcecode_backend.php",
        data:{op:'save_file',url:editCodeFileURL,content:codeMirrorValue },
        dataType: "json",
        success: function (data) {
          location.reload();
        },
        error: function(requestObject, error, errorThrown) {
                $('#loader').css('display','none');
                $('#ajax_err').css('display','block');
        }
      });
    }

  })

})

var zTreeObj;

var setting = {
  callback:{
    onClick:function(e){
      if(e.target.dataset.url){
        var file_ext = e.target.dataset.url.split('.').pop();
        if( $.inArray( file_ext,['txt','html','css','js','php','sql'] ) !== -1 ){
          build_codeMirror(e.target.dataset.url,file_ext);
        }else if ( $.inArray( file_ext,['bmp','png','jpg','jpeg','gif','tif'] ) !== -1 ) {
          show_img(e.target.dataset.url);
        }else {
          file_not_viewable();
        }

      }
    }
  }
};

$.ajax({
  type: 'POST',
  url: "appphp/ad_sourcecode_backend.php",
  data:{op:'get_zTree_node'},
  dataType: "json",
  success: function (zTreeNodes) {

    $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zTreeNodes);
    });

  },
  error: function(requestObject, error, errorThrown) {
          $('#ajax_err').css('display','block');
  }
});

var codeMirrorValue;
var editCodeFileURL;
function build_codeMirror(url,file_ext){

  editCodeFileURL = url;
  var mode = 'text/html';
  if(file_ext === 'css') { mode = 'text/css'; }
  if(file_ext === 'js' ) { mode = 'text/javascript'; }
  if(file_ext === 'php') { mode = 'application/x-httpd-php'; }
  if(file_ext === 'sql') { mode = 'text/x-sql'; }
  var file_name = url.substring(url.lastIndexOf('/')+1,url.length);
  var editableFile = ['an.rule.js'];
  var readOnly = ( editableFile.indexOf(file_name) === -1 ) ? true : false ;
  var editable = ( editableFile.indexOf(file_name) === -1 ) ? false : true ;

  $.ajax({
    type: 'POST',
    url: "appphp/ad_sourcecode_backend.php",
    data:{op:'get_file_content',url:url},
    dataType: "json",
    success: function (lines) {

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
          readOnly:readOnly

        });

        editor.on('update', function (instance) {
          codeMirrorValue = $("#codeMirror").val(instance.getValue())[0].value;
        });

        if(editable){ $('.saveFile').css('display','inline-block') }
        if(!editable){ $('.saveFile').css('display','none') }

    },
    error: function(requestObject, error, errorThrown) {
            $('#ajax_err').css('display','block');
    }
  });

}

function show_img(url){
  var dirname = window.location.pathname.substring( 1,window.location.pathname.lastIndexOf('/') );
  var src = url.substring( url.indexOf(dirname)+dirname.length+1 );
  $('.previewfile').html('<div style="height:500px;text-align:center;overflow:auto"><img src="'+src+'"></div>');
}

function file_not_viewable(){
  $('.previewfile').html('<h2>Sorry, can not show this file.</h2>');
}
