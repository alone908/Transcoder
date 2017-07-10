var ruleList;
var defaultRuleSetID = 1;

get_rule_list();

$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-250).toString()+'px' );

  $('#rule-list-table > tbody > tr').on('click',function(e){ select_rule(e,$(this)); })

  $('.del_rule_btn').on('click',function(e){ $('#del_rule').data('rulesetid',$(this).data('rulesetid')); })
  $('#del_rule').on('click',function(e){ del_rule($(this).data('rulesetid')); })

})

function get_rule_list(){
  $.ajax({
    type: 'POST',
    url: "appphp/TranscodeRule.php",
    data: {op:'get_rule_list'},
    dataType: "json",
    success: function (data) {
      ruleList = data.ruleList;
    }
  });
}

function select_rule(e,ele){
  $('#rule-list-table > tbody > tr').removeClass('info');
  ele.addClass('info');
  $('#rule-info').html('');
  var RuleSetID = ele.data('rulesetid');
  $('#rule-info').append('<span style="font-size:18px">RuleSetID : '+ele.data('rulesetid')+'</span><br>');
  for(var key in ruleList[RuleSetID]){
    $('#rule-info').append('<span style="font-size:18px">'+key+' : '+ruleList[RuleSetID][key]+'</span><br>');
  }
  $('#rule-title-li').text('Rule List - '+ruleList[RuleSetID]['RuleName']);
  $('#rm_rulelist_href').attr('href','rm_rulelist.php?rulesetid='+RuleSetID);
  $('#rm_ruleeditor_href').attr('href','rm_ruleeditor.php?rulesetid='+RuleSetID);
  $('#rm_rulebranch_href').attr('href','rm_rulebranch.php?rulesetid='+RuleSetID);
  $('#rm_preference_href').attr('href','rm_preference.php?rulesetid='+RuleSetID);
}

function del_rule(rulesetid){
  $.ajax({
    type: 'POST',
    url: "appphp/rule_list_backend.php",
    data: {op:'del_rule',rulesetid:rulesetid},
    dataType: "json",
    success: function (data) {

    }
  });
}
