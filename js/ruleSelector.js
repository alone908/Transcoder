$.fn.ruleSelector = function (options) {

    // default configuration properties
    var defaults = {
        RuleType:'all',
        SelectedCallback:function(rulelist,value){}
    };

    var options = $.extend(defaults, options);
    var selector = $(this).attr('id');

    $.ajax({
        type: 'POST',
        url: "appphp/TranscodeRule.php",
        data: {op: 'get_rule_list'},
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

        for (var RuleSetID in rulelist) {
            if(options.RuleType === rulelist[RuleSetID]['RuleType'] || options.RuleType === 'all'){
                if(parseInt(RuleSetID) === currentRulesetID){
                    $('#'+selector+' > select').append('<option value="'+RuleSetID+'" selected>'+rulelist[RuleSetID]['RuleName']+'</option>')
                }else {
                    $('#'+selector+' > select').append('<option value="'+RuleSetID+'">'+rulelist[RuleSetID]['RuleName']+'</option>')
                }
            }
        }

        $('#'+selector+' > select').on('change',function (e) {
            options.SelectedCallback(rulelist,$('#'+selector+' > select').val());
        })

    }

};