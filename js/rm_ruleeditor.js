var ruleList,tempID = 0,editor_rule_table,editor_rule_type = 'unknown',editor_rule_head_line = '-1',editor_rule_body_line = '-1',editor_rule_tail_line = '-1';

$(document).ready(function () {

    update_editor_rule_table();

    $('[data-toggle="tooltip"]').tooltip()

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

    $('#page-wrapper').css('width', ($(document).width() - 350).toString() + 'px');
    $('#editor').css('height', ($('#page-wrapper').height() - 135).toString() + 'px');
    $('#rule_row_container').css('height', ($('#editor').height() - 35).toString() + 'px');

    $('#rule_selector').ruleSelector({
        SelectedCallback: function (rulelist, selectedRuleID) {
            currentRuleSetID = selectedRuleID;
            window.location = 'rm_ruleeditor.php?rulesetid=' + selectedRuleID;
        }
    });

    $('#regular_radio_text').on('click', function (e) {
        $('input[value=regular]').prop("checked", true);
    })
    $('#blank_radio_text').on('click', function (e) {
        $('input[value=blank]').prop("checked", true);
    })
    $('#before_radio_text').on('click', function (e) {
        $('input[value=before]').prop("checked", true);
    })
    $('#after_radio_text').on('click', function (e) {
        $('input[value=after]').prop("checked", true);
    })

    $("#rule_row_container").sortable({
        handle: ".handle",
        start: function (event, ui) {
            start_sorting_color(event, ui);
        },
        stop: function (event, ui) {
            end_sorting_color(event, ui);
            sort_linenumber(event, ui);
            update_editor_rule_table();
        }
    });
    $("#rule_row_container").disableSelection();

    $('.rule_row').hover(function () {
        if ($(this).data('subject') !== 'Blank' && $(this).data('subject') !== 'HeadTitle' && $(this).data('subject') !== 'BodyTitle' && $(this).data('subject') !== 'TailTitle' && $(this).data('subject') !== 'JumpToRule'){
                $(this).css('background-color', '#e6e6e6');
        }
    }, function () {
        if ($(this).data('subject') !== 'Blank' && $(this).data('subject') !== 'HeadTitle' && $(this).data('subject') !== 'BodyTitle' && $(this).data('subject') !== 'TailTitle' && $(this).data('subject') !== 'JumpToRule'){
                $(this).css('background-color', '#fff');
        }
    })

    $('.detail_btn').on('click', function (e) {
        detail_btn_event(e, $(this));
    })

    $('.insert_btn').on('click', function (e) {
        insert_btn_event(e, $(this));
    })

    $('.set_btn').on('click', function (e) {
        set_btn_event(e, $(this));
    })

    $('#setrow_btn').on('click', function (e) {
        $('#setRowModal').modal('hide');
        $('#' + $(this).data('id') + ' .OnlyShowInBody').val($('#OnlyShowInBody').val())

        var jumpRuleCondition = '';
        var conditions = $('.jump_condi');
        for(var i=0; i<conditions.length; i++){
            var keyLine = $(conditions[i]).find('input[name=jump_condi_keyline]').val();
            var keyValue = $(conditions[i]).find('input[name=jump_condi_keyvalue]').val();
            var jumpRuleID = $(conditions[i]).find('select').val();
            if(keyLine !== '' && keyValue !== '' && jumpRuleID !== ''){
                jumpRuleCondition += keyLine + '-' + keyValue + '-' + jumpRuleID + ';'
            }
        }
        jumpRuleCondition = jumpRuleCondition.substr(0,jumpRuleCondition.length-1);
        $('#' + $(this).data('id') + ' .JumpRuleCondition').val(jumpRuleCondition);

    })

    $('#insert').on('click', function (e) {
        if ($('input[name=position]:checked').length === 0) {
            $('#insert_err').html('Please select position.');
        } else {
            $('#insertRowModal').modal('hide');
            $('#insert_err').html('');
            insert_row($(this).data('id'), $(this).data('linenumber'), $('#row_type_selector').val(), $('input[name=position]:checked').val());
            update_editor_rule_table();
        }
    })

    $('.del_btn').on('click', function (e) {
        del_btn_event(e, $(this));
    })

    $('#del_row').on('click', function (e) {
        $('#' + $(this).data('id')).css('display', 'none');
        $('#' + $(this).data('id')).removeClass('rule_row').addClass('rule_row_deleted');
        sort_linenumber(null, null);
        $('#delRowModal').modal('hide');
        update_editor_rule_table();
    })

    $('#save_btn').on('click', function (e) {
        save_rule_table(e, $(this));
    })

    $('#add_jump_condi').on('click', function (e) {
        add_jump_condi_event(e, $(this));
        $('.del_jump_condi').off('click').click(function(e){
            del_jump_condi_event(e,$(this));
        })
    })

    $('#saveRuleAnyway').click(function () {
        save_rule_anyway_event();
    })

    $('#setRowModal').on('hidden.bs.modal', function (e) {
        $('#OnlyShowInBodyCover').show()
        $('#JumpRuleCover').show()
    })

})

function start_sorting_color(event, ui) {
    var subject = ui.item[0].dataset.subject;
    $(ui.item).css('background-color', 'black');
    $(ui.item).css('color', 'white');
}

function end_sorting_color(event, ui) {
    var subject = ui.item[0].dataset.subject;
    if (subject === 'Blank') {
        $(ui.item).css('background-color', '#d9edf7');
    } else if (subject === 'HeadTitle' || subject === 'BodyTitle' || subject === 'TailTitle') {
        $(ui.item).css('background-color', '#B2E0F7');
    } else {
        $(ui.item).css('background-color', '#fff');
    }
    $(ui.item).css('color', '#000');
}

function sort_linenumber(event, ui) {
    $('.rule_row').each(function (index, row) {
        $('#' + $(this).attr('id') + ' .LineNumber').html(index + 1);
        $('#' + $(this).attr('id') + ' .insert_btn').attr('data-linenumber', index + 1);
        $('#' + $(this).attr('id') + ' .del_btn').attr('data-linenumber', index + 1);
        $('#' + $(this).attr('id') + ' .set_btn').attr('data-linenumber', index + 1);
        // $('#detail_'+$(this).attr('id')+' .detail_linenumber').html('LineNumber : '+(index+1).toString());
    })
}

function detail_btn_event(e, ele) {
    $('#detail_' + ele.data('id')).toggle('display');
}

function insert_btn_event(e, ele) {
    $('#insert').data('id', ele.data('id'));
    $('#insert').data('linenumber', ele.data('linenumber'));
}

function del_btn_event(e, ele) {
    $('#del_row').data('id', ele.data('id'));
    $('#del_row').data('linenumber', ele.data('linenumber'));
}

function set_btn_event(e, ele) {

    $('#setrow_btn').data('id', ele.data('id'));
    $('#OnlyShowInBody').val($('#' + ele.data('id') + ' .OnlyShowInBody').val());

    var jumpRuleConditionText = $('#' + ele.data('id') + ' .JumpRuleCondition').val();

    var jumpRuleCondition = (jumpRuleConditionText !== '') ?
    jumpRuleConditionText.split(';').map(function(condi,i){
        var factor = condi.split('-');
        return [factor[0],factor[1],factor[2]];
    }) : []

    var jump_condi_tpl = build_jump_condi_tpl(jumpRuleCondition)
    $('#jump_condi_container').html(jump_condi_tpl);

    $('.del_jump_condi').off('click').click(function(e){
        del_jump_condi_event(e,$(this));
    })

    //check available for OnlyShowInBody
    var LineNumber = $('#' + ele.data('id') + ' .LineNumber').html();
    var subject = $('#' + ele.data('id')).data('subject');
    if( (subject !== 'JumpToRule' && editor_rule_type === 'B' &&  Number(LineNumber) > Number(editor_rule_body_line) ) ||
    ( subject !== 'JumpToRule' && editor_rule_type === 'C' && Number(LineNumber) > Number(editor_rule_body_line) && Number(LineNumber) < Number(editor_rule_tail_line) ) ||
    ( subject !== 'JumpToRule' && editor_rule_type === 'D' && Number(LineNumber) > Number(editor_rule_body_line) && Number(LineNumber) < Number(editor_rule_tail_line) ) ){
        $('#OnlyShowInBodyCover').hide()
    }

    //check available for JumpLineCondition
    if( $('#' + ele.data('id')).data('subject') === 'JumpToRule'){
        $('#JumpRuleCover').hide()
    }

}

function del_jump_condi_event(e, ele){
    ele.parent().remove();
}

function add_jump_condi_event(e, ele){
    $('#jump_condi_container').append(build_jump_condi_tpl([['','','']]))
}

function build_jump_condi_tpl(jumpRuleCondition,keyLine,keyValue,jumpRuleID){

    var tpl = '';
    jumpRuleCondition.forEach(function(condi,i){
        var keyLine = condi[0], keyValue = condi[1], jumpRuleID = condi[2]
        var ruleOptionsTpl = rule_option_tpl(jumpRuleID);
        tpl += "\
        <div class='jump_condi' style='display:inline-block;width:95%;padding:5px 15px;margin:5px 15px 0px;border-radius:5px;background-color: #D5D5D6;'>\
            <div class='form-group' style='display:inline;'>\
              <label style='margin-bottom:0px;'>Key Line</label>\
              <input class='form-control' name='jump_condi_keyline' value='" + keyLine + "' style='display:inline;width:100px;vertical-align:text-bottom;padding:3px 6px;height:25px;'></input>\
            </div>\
            <div class='form-group' style='display:inline;'>\
              <label style='margin-bottom:0px;'>Key Value</label>\
              <input type='text' class='form-control' name='jump_condi_keyvalue' value='" + keyValue + "' style='display:inline;width:100px;vertical-align:text-bottom;padding:3px 6px;height:25px;'></input>\
            </div>\
            <div class='form-group' style='display:inline;'>\
              <label style='margin-bottom:0px;'>Jump to Rule</label>\
              <select class='form-control' style='display:inline;width:200px;cursor:pointer;vertical-align:text-bottom;padding:3px 6px;height:25px;'>" + ruleOptionsTpl + "</select>\
            </div>\
            <button class='btn btn-sm-black del_jump_condi' type='button' style='vertical-align:text-bottom;'><i class='fa fa-minus' aria-hidden='true'></i></button>\
        </div>"
    })

    return tpl;
}

function rule_option_tpl(selectedID){
    var tpl = '';
    for(var rulesetid in ruleList) {
        if(rulesetid === selectedID){
            tpl += '<option value="'+rulesetid+'" selected>'+ruleList[rulesetid]['RuleName']+'</option>';
        }else {
            tpl += '<option value="'+rulesetid+'">'+ruleList[rulesetid]['RuleName']+'</option>';
        }

    }
    return tpl;
}

function insert_row(id, linenumber, type, position) {

    tempID++;

    linenumber = (position === 'before') ? linenumber : linenumber + 1;

    if(type === 'head'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" style="background-color:#B2E0F7;" data-subject="HeadTitle">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;cursor:pointer;"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="HeadTitle"></i></span>\
            <span class="Exp editor_line_span" style="width:20%;border-bottom:1px solid black;">==表頭==</span>\
            <span class="Length editor_line_span" style="width:10%;">0</span>\
            <span class="DataCoding editor_line_span" style="width:10%;"></span>\
            <span class="LSB editor_line_span" style="width:5%;"></span>\
            <span class="UnixTime editor_line_span" style="width:10%;"></span>\
            <span class="TranscodeRule editor_line_span" style="width:20%;"></span>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
            </span>\
        </div>')
    }

    if(type === 'body'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" style="background-color:#B2E0F7;" data-subject="BodyTitle">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;cursor:pointer;"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="BodyTitle"></i></span>\
            <span class="Exp editor_line_span" style="width:20%;border-bottom:1px solid black;">==表身==</span>\
            <span class="Length editor_line_span" style="width:10%;">0</span>\
            <span class="DataCoding editor_line_span" style="width:10%;"></span>\
            <span class="LSB editor_line_span" style="width:5%;"></span>\
            <span class="UnixTime editor_line_span" style="width:10%;"></span>\
            <span class="TranscodeRule editor_line_span" style="width:20%;"></span>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
            </span>\
        </div>')
    }

    if(type === 'tail'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" style="background-color:#B2E0F7;" data-subject="TailTitle">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;cursor:pointer;"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="TailTitle"></i></span>\
            <span class="Exp editor_line_span" style="width:20%;border-bottom:1px solid black;">==表尾==</span>\
            <span class="Length editor_line_span" style="width:10%;">0</span>\
            <span class="DataCoding editor_line_span" style="width:10%;"></span>\
            <span class="LSB editor_line_span" style="width:5%;"></span>\
            <span class="UnixTime editor_line_span" style="width:10%;"></span>\
            <span class="TranscodeRule editor_line_span" style="width:20%;"></span>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
            </span>\
        </div>')
    }

    if(type === 'blank'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" style="background-color:#d9edf7;" data-subject="Blank">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;cursor:pointer;"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Blank"></i></span>\
            <input class="Exp editor_line_input" type="text" style="width:20%;" value="====="></input>\
            <span class="Length editor_line_span" style="width:10%;">0</span>\
            <span class="DataCoding editor_line_span" style="width:10%;"></span>\
            <span class="LSB editor_line_span" style="width:5%;"></span>\
            <span class="UnixTime editor_line_span" style="width:10%;"></span>\
            <span class="TranscodeRule editor_line_span" style="width:20%;"></span>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
            </span>\
        </div>')
    }

    if(type === 'jumptorule'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" style="background-color:#B2E0F7;" data-subject="JumpToRule">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;cursor:pointer;"><i class="fa fa-info-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="JumpToRule"></i></span>\
            <span class="Exp editor_line_span" style="width:20%;border-bottom:1px solid black;">==JumpToRule==</span>\
            <span class="Length editor_line_span" style="width:10%;">0</span>\
            <span class="DataCoding editor_line_span" style="width:10%;"></span>\
            <span class="LSB editor_line_span" style="width:5%;"></span>\
            <span class="UnixTime editor_line_span" style="width:10%;"></span>\
            <span class="TranscodeRule editor_line_span" style="width:20%;"></span>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black set_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#setRowModal"> <i class="fa fa-cogs" aria-hidden="true"></i> </button>\
            </span>\
        </div>')
    }

    if(type === 'regular'){
        var insertRow = $('\
        <div id="temp_' + tempID + '" class="rule_row" data-subject="RuleSet_' + currentRuleSetID + '_' + linenumber + '">\
            <span class="handle arrange_span"><i class="fa fa-exchange arrange_icon" aria-hidden="true"></i></span>\
            <span class="LineNumber editor_line_span" style="width:35px;">' + linenumber + '</span>\
            <span class="Info editor_line_span" style="width:26px;font-size:18px;color:#C3000E;"></span>\
            <input class="Exp editor_line_input" type="text" style="width:20%;" value=""></input>\
            <input class="Length editor_line_input" type="text" style="width:10%;" value="0"></input>\
            <input class="DataCoding editor_line_input" type="text" style="width:10%;" value=""></input>\
            <input class="LSB editor_line_input" type="text" style="width:5%;" value=""></input>\
            <input class="UnixTime editor_line_input" type="text" style="width:10%;" value=""></input>\
            <input class="TranscodeRule editor_line_input" type="text" style="width:20%;" value=""></input>\
            <input class="OnlyShowInBody editor_line_input" type="hidden" value=""></input>\
            <input class="JumpRuleCondition editor_line_input" type="hidden" value=""></input>\
            <span class="editor_line_span">\
                <button class="btn btn-sm-black insert_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#insertRowModal"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black del_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#delRowModal">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>\
                <button class="btn btn-sm-black set_btn" data-id="temp_' + tempID + '" data-linenumber="' + linenumber + '" data-toggle="modal" data-target="#setRowModal"> <i class="fa fa-cogs" aria-hidden="true"></i> </button>\
            </span>')
    }

    if(position === 'before'){
        insertRow.insertBefore('#' + id);
    }else if(position === 'after'){
        insertRow.insertAfter('#' + id);
    }

    sort_linenumber(null, null);

    $('[data-toggle="tooltip"]').tooltip();

    $('.insert_btn').off('click').on('click', function (e) {
        insert_btn_event(e, $(this));
    })

    $('.set_btn').on('click', function (e) {
        set_btn_event(e, $(this));
    })

    $('.del_btn').off('click').on('click', function (e) {
        del_btn_event(e, $(this));
    })

    $('.rule_row').hover(function () {
        if ($(this).data('subject') !== 'Blank' && $(this).data('subject') !== 'HeadTitle' && $(this).data('subject') !== 'BodyTitle' && $(this).data('subject') !== 'TailTitle' && $(this).data('subject') !== 'JumpToRule'){
                $(this).css('background-color', '#e6e6e6');
        }
    }, function () {
        if ($(this).data('subject') !== 'Blank' && $(this).data('subject') !== 'HeadTitle' && $(this).data('subject') !== 'BodyTitle' && $(this).data('subject') !== 'TailTitle' && $(this).data('subject') !== 'JumpToRule'){
                $(this).css('background-color', '#fff');
        }
    })

}

function save_rule_table() {

    update_editor_rule_table();

    if(editor_rule_type !== 'unknown'){
        $('#saveRuleAnyway').trigger('click');
    }else if(editor_rule_type === 'unknown'){
        $('#unknownRuleTypeModal').modal('show');
    }
}

function update_editor_rule_table(){
    editor_rule_table = [],editor_rule_head_line = '-1',editor_rule_body_line = '-1',editor_rule_tail_line = '-1';

    $('.rule_row').each(function (index, row) {
        editor_rule_table.push(get_row_value($(this).attr('id'), false));
    })

    $('.rule_row_deleted').each(function (index, row) {
        editor_rule_table.push(get_row_value($(this).attr('id'), true));
    })

    var tpl = [];
    editor_rule_table.forEach(function (row, number) {
        var subject = row['Subject'];
        var op = row['op'];
        if (op !== 'delete' && (subject === 'HeadTitle' || subject === 'BodyTitle' || subject === 'TailTitle'  || subject === 'JumpToRule')) {
            tpl.push(subject)
            if(subject === 'HeadTitle'){ editor_rule_head_line = row['LineNumber'] }
            if(subject === 'BodyTitle'){ editor_rule_body_line = row['LineNumber'] }
            if(subject === 'TailTitle'){ editor_rule_tail_line = row['LineNumber'] }
        }
    })
    editor_rule_type = rule_tpl_definition(tpl);
}

function save_rule_anyway_event(){
    $('#loader').css('display', 'block');
    $.ajax({
        type: 'POST',
        url: "appphp/rm_ruleeditor_backend.php",
        data: {op: 'save_rule_table', rulesetid: currentRuleSetID, ruleTable: editor_rule_table},
        dataType: "json",
        success: function (data) {
            location.reload();
        },
        error: function (requestObject, error, errorThrown) {
            $('#loader').css('display', 'none');
            $('#ajax_err').css('display', 'block');
        }
    });
}

function get_row_value(id, del) {

    if (!del) {
        if (id.indexOf('temp') >= 0) {
            var op = 'insert';
        } else {
            var op = 'update';
        }
    } else if (del) {
        var op = 'delete';
    }

    var LineNumber = $('#' + id + ' .LineNumber').html();

    var Subject = $('#' + id).data('subject');

    if ($('#' + id + ' .Exp').prop('tagName') === 'SPAN') {
        var Exp = $('#' + id + ' .Exp').html();
    } else if ($('#' + id + ' .Exp').prop('tagName') === 'INPUT') {
        var Exp = $('#' + id + ' .Exp').val();
    }

    if ($('#' + id + ' .Length').prop('tagName') === 'SPAN') {
        var Length = $('#' + id + ' .Length').html();
    } else if ($('#' + id + ' .Length').prop('tagName') === 'INPUT') {
        var Length = $('#' + id + ' .Length').val();
    }

    if ($('#' + id + ' .DataCoding').prop('tagName') === 'SPAN') {
        var DataCoding = $('#' + id + ' .DataCoding').html();
    } else if ($('#' + id + ' .DataCoding').prop('tagName') === 'INPUT') {
        var DataCoding = $('#' + id + ' .DataCoding').val();
    }

    if ($('#' + id + ' .LSB').prop('tagName') === 'SPAN') {
        var LSB = $('#' + id + ' .LSB').html();
    } else if ($('#' + id + ' .LSB').prop('tagName') === 'INPUT') {
        var LSB = $('#' + id + ' .LSB').val();
    }

    if ($('#' + id + ' .UnixTime').prop('tagName') === 'SPAN') {
        var UnixTime = $('#' + id + ' .UnixTime').html();
    } else if ($('#' + id + ' .UnixTime').prop('tagName') === 'INPUT') {
        var UnixTime = $('#' + id + ' .UnixTime').val();
    }

    if ($('#' + id + ' .TranscodeRule').prop('tagName') === 'SPAN') {
        var TranscodeRule = $('#' + id + ' .TranscodeRule').html();
    } else if ($('#' + id + ' .TranscodeRule').prop('tagName') === 'INPUT') {
        var TranscodeRule = $('#' + id + ' .TranscodeRule').val();
    }

    if ($('#' + id + ' .OnlyShowInBody').prop('tagName') === 'SPAN') {
        var OnlyShowInBody = $('#' + id + ' .OnlyShowInBody').html();
    } else if ($('#' + id + ' .OnlyShowInBody').prop('tagName') === 'INPUT') {
        var OnlyShowInBody = $('#' + id + ' .OnlyShowInBody').val();
    }

    if ($('#' + id + ' .JumpRuleCondition').prop('tagName') === 'SPAN') {
        var JumpRuleCondition = $('#' + id + ' .JumpRuleCondition').html();
    } else if ($('#' + id + ' .JumpRuleCondition').prop('tagName') === 'INPUT') {
        var JumpRuleCondition = $('#' + id + ' .JumpRuleCondition').val();
    }

    return {
        op: op,
        id: id,
        Subject: Subject,
        LineNumber: LineNumber,
        Exp: Exp,
        Length: Length,
        DataCoding: DataCoding,
        LSB: LSB,
        UnixTime: UnixTime,
        TranscodeRule: TranscodeRule,
        OnlyShowInBody: OnlyShowInBody,
        JumpRuleCondition: JumpRuleCondition
    }

}
