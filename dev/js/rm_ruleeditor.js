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

  $('.detail_btn').on('click',function(e){
    detail_btn_event(e,$(this));
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
  })
}

function detail_btn_event(e,ele){
  $('#detail_'+ele.data('id')).toggle('display');
}
