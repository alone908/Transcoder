$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );

  $('#branch_select').on('change',function(e){ select_branch( Number( $(this).val() ) ) });

})

var branch,totalLines;
$.ajax({
  type: 'POST',
  url: "appphp/rm_brancheditor_backend.php",
  data: {op:'get_branch',rulesetid:currentRulesetID},
  dataType: "json",
  success: function (data) {
    branch = data.branch;
    totalLines = data.total_lines;
    console.log(branch);
  }
})

var ruleList;
$.ajax({
  type: 'POST',
  url: "appphp/TranscodeRule.php",
  data: {op:'get_rule_list'},
  dataType: "json",
  success: function (data) {
    ruleList = data.ruleList;
  }
});

function select_branch(id){

  $('#conditions_div').html( condi_div_tpl(id) );

}

function condi_div_tpl(id){

  var tpl = '';

  branch[id]['condition_array'].forEach(function(condi,key){

    if(condi['pre_line'] !== null && condi['pre_line'] !== ''){

      tpl += "\
      <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
        <form class='form-inline'>\
          <div class='form-group'>\
            <label style='font-size:18px;'>Previous&nbsp;&nbsp;Line&nbsp;&nbsp;</label>\
            <select class='form-control' style='width:100px;cursor:pointer;vertical-align:text-bottom;'>"+pre_line_option(id,key)+"\
            </select>\
          </div>\
          <div class='form-group'>\
            <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Equals&nbsp;&nbsp;Value&nbsp;&nbsp;</label>\
            <input type='text' class='form-control' placeholder='value' value='"+condi['condi_val']+"' style='width:100px;vertical-align:text-bottom;'>\
          </div>\
          <div class='form-group'>\
            <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
            <select class='form-control' style='width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,key)+"\
            </select>\
          </div>\
        </form>\
      </div>";

    }else if (condi['pre_line'] === null || condi['pre_line'] === '') {

      tpl += "\
      <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
      <form class='form-inline'>\
          <div class='form-group'>\
            <label style='font-size:18px;'>Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
            <select class='form-control' style='width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,key)+"\
            </select>\
          </div>\
        </form>\
      </div>";

    }

  })

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
