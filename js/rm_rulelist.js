var ruleList;
var defaultRuleSetID = 1;

get_rule_list();

$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );

  $('#rule-list-table > tbody > tr').on('click',function(e){ select_rule(e,$(this)); })

  $('.del_rule_btn').on('click',function(e){ $('#del_rule').data('rulesetid',$(this).data('rulesetid')); })
  $('#del_rule').on('click',function(e){ del_rule($(this).data('rulesetid')); })

  $('.clone_rule_btn').on('click',function(e){
    check_clone_rulename($(this).data('rulesetid'));
    $('#clone_rule').data('rulesetid',$(this).data('rulesetid'));
  })
  $('#clone_rule').on('click',function(e){ clone_rule($(this).data('rulesetid')); })

  $('.edit_rule_btn').on('click',function(e){
    $('#rule_name').val(ruleList[$(this).data('rulesetid')].RuleName);
    $('#save_rule_name').data('rulesetid',$(this).data('rulesetid'));
  })
  $('#save_rule_name').on('click',function(e){ edit_rule_name($(this).data('rulesetid')); })

  $('#add_rule').on('click',function(e){ add_rule() });

  $('#mainrule_radio_text').on('click',function(e){
      $('input[value=mainrule]').prop('checked',true);
      $('#mainrule_op').css('display','block');
      $('#subrule_op').css('display','none');
  })

  $('#subrule_radio_text').on('click',function(e){
    $('input[value=subrule]').prop('checked',true);
    $('#mainrule_op').css('display','none');
    $('#subrule_op').css('display','block');
  })

  $('input[name=ruletype]').on('change',function(e){
    if($('input[name=ruletype]:checked').val() === 'mainrule'){
      $('#mainrule_op').css('display','block');
      $('#subrule_op').css('display','none');
    }else if ($('input[name=ruletype]:checked').val() === 'subrule') {
      $('#mainrule_op').css('display','none');
      $('#subrule_op').css('display','block');
    }
  })

})

function get_rule_list(){
  $.ajax({
    type: 'POST',
    url: "appphp/TranscodeRule.php",
    data: {op:'get_rule_list'},
    dataType: "json",
    success: function (data) {
      ruleList = data.ruleList;
    },
    error: function(requestObject, error, errorThrown) {
            $('#ajax_err').css('display','block');
    }
  });
}

function select_rule(e,ele){

  var RuleSetID = ele.data('rulesetid');
  currentRulesetID = RuleSetID;

  $('#rule-list-table > tbody > tr').removeClass('info');
  ele.addClass('info');

  $('#rule-info').html('');
  for(var key in ruleList[RuleSetID]){
    $('#rule-info').append('<span style="font-size:18px">'+key+' : '+ruleList[RuleSetID][key]+'</span><br>');
  }

  $('#rule-title-li').text('Rule List - '+ruleList[RuleSetID]['RuleName']);
  $('#rm_rulelist_href').attr('href','rm_rulelist.php?rulesetid='+RuleSetID);
  $('#rm_ruleeditor_href').attr('href','rm_ruleeditor.php?rulesetid='+RuleSetID);
  $('#rm_advanceeditor_href').attr('href','rm_advanceeditor.php?rulesetid='+RuleSetID);
  $('#rm_rulebranch_href').attr('href','rm_rulebranch.php?rulesetid='+RuleSetID);
  $('#rm_brancheditor_href').attr('href','rm_brancheditor.php?rulesetid='+RuleSetID);
  $('#rm_preference_href').attr('href','rm_preference.php?rulesetid='+RuleSetID);
}

function add_rule(){
  $('#loader').css('display','block');
  $.ajax({
    type: 'POST',
    url: "appphp/rm_rulelist_backend.php",
    data: {op:'add_rule',
           rule_name:$('#name_of_rule').val(),
           rule_type:$('input[name=ruletype]:checked').val(),
           lines_in_head:$('#lines_in_head').val(),
           lines_in_body:$('#lines_in_body').val(),
           lines_in_rule:$('#lines_in_rule').val()},
    dataType: "json",
    success: function (data) {
      window.location = 'rm_rulelist.php';
    },
    error: function(requestObject, error, errorThrown) {
            $('#loader').css('display','none');
            $('#ajax_err').css('display','block');
    }
  });
}

function del_rule(rulesetid){
  $('#loader').css('display','block');
  $.ajax({
    type: 'POST',
    url: "appphp/rm_rulelist_backend.php",
    data: {op:'del_rule',rulesetid:rulesetid},
    dataType: "json",
    success: function (data) {
      window.location = 'rm_rulelist.php';
    },
    error: function(requestObject, error, errorThrown) {
            $('#loader').css('display','none');
            $('#ajax_err').css('display','block');
    }
  });
}

function check_clone_rulename(rulesetid){
  $('#loader').css('display','block');
  $.ajax({
    type: 'POST',
    url: "appphp/rm_rulelist_backend.php",
    data: {op:'check_clone_rulename',new_name:ruleList[rulesetid]['RuleName']+'[CLONE]'},
    dataType: "json",
    success: function (data) {
      $('#new_rule_name').val(data.new_name);
      $('#loader').css('display','none');
    },
    error: function(requestObject, error, errorThrown) {
            $('#loader').css('display','none');
            $('#ajax_err').css('display','block');
    }
  });
}

function clone_rule(rulesetid){
  $('#loader').css('display','block');
  $.ajax({
    type: 'POST',
    url: "appphp/rm_rulelist_backend.php",
    data: {op:'clone_rule',rulesetid:rulesetid,rulename:$('#new_rule_name').val()},
    dataType: "json",
    success: function (data) {
      window.location = 'rm_rulelist.php?rulesetid='+data.newrulesetid;
    },
    error: function(requestObject, error, errorThrown) {
            $('#loader').css('display','none');
            $('#ajax_err').css('display','block');
    }
  });
}

function edit_rule_name(rulesetid){
  if($('#rule_name').val() === ''){
    $('#edit_name_err').text('Rule name can not be left blank.');
  }else {
    $('#loader').css('display','block');
    $.ajax({
      type: 'POST',
      url: "appphp/rm_rulelist_backend.php",
      data: {op:'edit_rule_name',rulesetid:rulesetid,rulename:$('#rule_name').val()},
      dataType: "json",
      success: function (data) {
        window.location = 'rm_rulelist.php?rulesetid='+currentRulesetID;
      },
      error: function(requestObject, error, errorThrown) {
              $('#loader').css('display','none');
              $('#ajax_err').css('display','block');
      }
    });
  }
}
