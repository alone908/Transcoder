$.fn.ruleSelector = function (options) {

    // default configuration properties
    var defaults = {
        SelectedCallback:function(rulelist,value){},
        RuleSelectorType:''
    };

    var options = $.extend(defaults, options);
    var selector = $(this).attr('id');

    $.ajax({
        type: 'POST',
        url: "appphp/TranscodeRule.php",
        data: {op: 'get_rule_list_for_ruleSelector'},
        dataType: "json",
        success: function (data) {
            buildSelector(data.ruleList);
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });

    function buildSelector(rulelist) {

        $('#'+selector).append('<select class="btn-black" style="height: 28px;"></select>')

        for (var objKey in rulelist) {
            if(rulelist[objKey]['RuleSelectorType'].indexOf(options.RuleSelectorType) !== -1){
                if(parseInt(rulelist[objKey]['RuleSetID']) === currentRuleSetID){
                    $('#'+selector+' > select').append('<option value="'+rulelist[objKey]['RuleSetID']+'" selected>'+rulelist[objKey]['RuleName']+'</option>')
                }else {
                    $('#'+selector+' > select').append('<option value="'+rulelist[objKey]['RuleSetID']+'">'+rulelist[objKey]['RuleName']+'</option>')
                }
            }
        }

        $('#'+selector+' > select').on('change',function (e) {
            options.SelectedCallback(rulelist,$('#'+selector+' > select').val());
        })

    }

    function updateSelector(){
        $('#'+selector+' > select > option').removeAtrr('selected');
    }

};
