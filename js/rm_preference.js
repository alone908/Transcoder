$(document).ready(function () {

    $('#page-wrapper').css('width', ($(document).width() - 350).toString() + 'px');

    $('.selectAll').click(function () {
        var ruleSelectorType = $(this).data('ruleselectortype');
        if($(this).prop('checked')){
            $('input[name=\''+ruleSelectorType+'\']').prop('checked', true);
        }else {
            $('input[name=\''+ruleSelectorType+'\']').prop('checked', false);
        }
    })

    $('#save_preference').click(function () {

        var ruleHasSelectorType = {},
            rule_selector_types = [
                'InTranscoder',
                'InRuleEditor',
                'InAdvanceEditor',
                'InRuleBranch',
                'InBranchEditor'
            ];

        rule_selector_types.forEach(function (type, index) {
            $('input[name=\''+type+'\']').each(function () {
                if(typeof ruleHasSelectorType['RuleSetID_'+$(this).val()] === 'undefined'){
                    ruleHasSelectorType['RuleSetID_'+$(this).val()] = '';
                }
                if($(this).prop('checked')){
                    ruleHasSelectorType['RuleSetID_'+$(this).val()] += type+',';
                }
            })
        })

        $.ajax({
            type: 'POST',
            url: "appphp/rm_preference_backend.php",
            data: {
                op: 'save_preference',
                ruleHasSelectorType: ruleHasSelectorType
            },
            dataType: "json",
            beforeSend: function () {
                $('#loader').show();
            },
            success: function (data) {
                $('#loader').hide();
            },
            error: function (requestObject, error, errorThrown) {
                $('#loader').css('display', 'none');
                $('#ajax_err').css('display', 'block');
            }
        });

    })

})
