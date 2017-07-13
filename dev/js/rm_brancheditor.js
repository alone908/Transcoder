$(document).ready(function(){

  $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );

})

var branch;
$.ajax({
  type: 'POST',
  url: "appphp/rm_brancheditor_backend.php",
  data: {op:'get_branch',rulesetid:currentRulesetID},
  dataType: "json",
  success: function (data) {
    branch = data.branch;
    console.log(branch);
  }
})
