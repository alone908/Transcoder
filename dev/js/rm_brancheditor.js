var branch,totalLines,ruleList;

$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );

  $('#branch_select').on('change',function(e){ select_branch( Number( $(this).val() ) ) });

  $.ajax({
    type: 'POST',
    url: "appphp/rm_brancheditor_backend.php",
    data: {op:'get_branch',rulesetid:currentRulesetID},
    dataType: "json",
    success: function (data) {

      branch = data.branch;
      totalLines = data.total_lines;

      $('#branch_select').html( branch_select_option( data.first_branch_id ) );
      $('#conditions_div').html( condi_div_tpl( data.first_branch_id ) );

      if(branch[data.first_branch_id]['condition_array'][0]['pre_line'] === null ||
      branch[data.first_branch_id]['condition_array'][0]['pre_line'] === ''){
        $('#add_condi_btn').attr('disabled',true);
      }

    }
  })

})

$.ajax({
  type: 'POST',
  url: "appphp/TranscodeRule.php",
  data: {op:'get_rule_list'},
  dataType: "json",
  success: function (data) {
    ruleList = data.ruleList;
  }
});

function branch_select_option(first_branch_id){
  var tpl = '';

  for(var key in branch){
    if(Number(key) !== first_branch_id) tpl += '<option value="'+branch[key]['id']+'">Line : '+branch[key]['LineNumber']+'</option>';
    if(Number(key) === first_branch_id) tpl += '<option value="'+branch[key]['id']+'" selected>Line : '+branch[key]['LineNumber']+'</option>';
  }

  return tpl;
}


function select_branch(id){
  $('#conditions_div').html( condi_div_tpl(id) );
}

function condi_div_tpl(id){

  var tpl = '';

  branch[id]['condition_array'].forEach(function(condi,key){

    if(condi['pre_line'] !== null && condi['pre_line'] !== ''){

      var del_valid = (key === 0) ? false : true;

      tpl += condition_line_tpl(id,key,condi,del_valid);
      $('#add_condi_btn').removeAttr('disabled');

    }else if (condi['pre_line'] === null || condi['pre_line'] === '') {

      tpl += no_condi_line_tpl(id,key);
      $('#add_condi_btn').attr('disabled',true);

    }

  })

  return tpl;
}

function condition_line_tpl(id,condi_key,condi,del_valid){
  var tpl = '';

  if(del_valid){
    var del_btn = '&nbsp;<button class="btn btn-lg-black" data-rulesetid="'+id+'" style="vertical-align:top;"><i class="fa fa-minus-square-o" aria-hidden="true"></i></button>';
  }else {
    var del_btn = '';
  }

  tpl += "\
  <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
    <form class='form-inline' style='display:inline-block'>\
      <div class='form-group'>\
        <label style='font-size:18px;'>Previous&nbsp;&nbsp;Line&nbsp;&nbsp;</label>\
        <select class='form-control' style='width:100px;cursor:pointer;vertical-align:text-bottom;'>"+pre_line_option(id,condi_key)+"\
        </select>\
      </div>\
      <div class='form-group'>\
        <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Equals&nbsp;&nbsp;Value&nbsp;&nbsp;</label>\
        <input type='text' class='form-control' placeholder='value' value='"+condi['condi_val']+"' style='width:100px;vertical-align:text-bottom;'>\
      </div>\
      <div class='form-group'>\
        <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
        <select class='form-control' style='width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,condi_key)+"\
        </select>\
      </div>\
    </form>"
    +del_btn+"\
  </div>";

  return tpl;
}

function no_condi_line_tpl(id,condi_key,condi,del_valid){
  var tpl = '';

  tpl += "\
  <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
  <form class='form-inline'>\
      <div class='form-group'>\
        <label style='font-size:18px;'>Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
        <select class='form-control' style='width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,condi_key)+"\
        </select>\
      </div>\
    </form>\
  </div>";

  return tpl;

}

function pre_line_option(id,key){
  var tpl = '';
  for(var i=1;i<=totalLines;i++){
    if(i === Number(branch[id]['condition_array'][key]['pre_line'])){
      tpl += '<option value="'+i+'" selected>'+i+'</option>';
    }else {
      tpl += '<option value="'+i+'">'+i+'</option>';
    }
  }
  return tpl;
}

function childset_option(id,key){
  var tpl = '';
  for(var rulesetid in ruleList) {
    if(ruleList[rulesetid]['RuleType'] === 'SubRule'){
      if(rulesetid === branch[id]['condition_array'][key]['childset']){
        tpl += '<option value="'+rulesetid+'" selected>'+ruleList[rulesetid]['RuleName']+'</option>';
      }else {
        tpl += '<option value="'+rulesetid+'">'+ruleList[rulesetid]['RuleName']+'</option>';
      }
    }
  }
  return tpl;
}
