$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-250).toString()+'px' );
  $('#editor').css('height', ($('#page-wrapper').height()-135).toString()+'px' );
  $('#rule_row_container').css('height', ($('#editor').height()-35).toString()+'px' );

  $( "#rule_row_container" ).sortable({
    handle: ".handle",
    start: function(event,ui){ start_sorting_color(event,ui);},
    stop : function(event,ui){
      end_sorting_color(event,ui);
      sort_linenumber(event,ui);
    }
  });
  $( "#rule_row_container" ).disableSelection();

  $('.detail_btn').on('click',function(e){ detail_btn_event(e,$(this)); })

  $('.insert_btn').on('click',function(e){
    insert_btn_event(e,$(this));
  })

  $('#insert').on('click',function(e){
    if( $('input[name=type]:checked').length === 0 || $('input[name=position]:checked').length === 0 ){
      $('#insert_err').html('Please select type and position.');
    }else {
      $('#insertRowModal').modal('hide');
      $('#insert_err').html('');
      insert_row($(this).data('id'),$(this).data('linenumber'),$('input[name=type]:checked').val(),$('input[name=position]:checked').val());
    }
  })

})

function start_sorting_color(event,ui){
  var subject = ui.item[0].dataset.subject;
  $(ui.item).css('background-color','black');
  $(ui.item).css('color','white');
}

function end_sorting_color(event,ui){
  var subject = ui.item[0].dataset.subject;
  if(subject === 'Blank'){
    $(ui.item).css('background-color','#d9edf7');
  }else if (subject === 'HeadTitle' || subject === 'BodyTitle') {
    $(ui.item).css('background-color','#B2E0F7');
  }else {
    $(ui.item).css('background-color','#fff');
  }
  $(ui.item).css('color','#000');
}

function sort_linenumber(event,ui){
  $('.rule_row').each(function(index,row){
    row.children[1].textContent = index+1;
    $('#'+$(this).attr('id')+' .insert_btn').attr('data-linenumber',index+1);
    $('#'+$(this).attr('id')+' .del_btn').attr('data-linenumber',index+1);
  })
}

function detail_btn_event(e,ele){
  $('#detail_'+ele.data('id')).toggle('display');
}

function insert_btn_event(e,ele){
  $('#insert').data('id',ele.data('id'));
  $('#insert').data('linenumber',ele.data('linenumber'));
}

var tempID = 0;
function insert_row(id,linenumber,type,position){
  
  tempID ++ ;

  if(position === 'before'){
    $('\
    <div id="'+tempID+'" class="rule_row" style="background-color:#d9edf7;" data-subject="Blank">\
      <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
      <span class="LineNumber editor_line_span" style="width:50px;">'+linenumber+'</span>\
        <input class="Exp editor_line_input" type="text" style="width:20%;" value="====="></input>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:5%;"></span>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:20%;"></span>\
        <span class="editor_line_span">\
        <button class="btn btn-sm-black insert_btn" data-id="'+tempID+'" data-linenumber="'+linenumber+'" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
        <button class="btn btn-sm-black del_btn" data-id="'+tempID+'" data-linenumber="'+linenumber+'">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
      </span>\
    </div>').insertBefore('#'+id);
  }else if (position === 'after') {
    linenumber ++ ;
    $('\
    <div id="'+tempID+'" class="rule_row" style="background-color:#d9edf7;" data-subject="Blank">\
      <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
      <span class="LineNumber editor_line_span" style="width:50px;">'+linenumber+'</span>\
        <input class="Exp editor_line_input" type="text" style="width:20%;" value="====="></input>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:5%;"></span>\
        <span class="editor_line_span" style="width:10%;"></span>\
        <span class="editor_line_span" style="width:20%;"></span>\
        <span class="editor_line_span">\
        <button class="btn btn-sm-black insert_btn" data-id="'+tempID+'" data-linenumber="'+linenumber+'" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
        <button class="btn btn-sm-black del_btn" data-id="'+tempID+'" data-linenumber="'+linenumber+'">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
      </span>\
    </div>').insertAfter('#'+id);
  }

  sort_linenumber(null,null);
  // console.log(id);
  // console.log(linenumber);
  // console.log(type);
  // console.log(position);
}
