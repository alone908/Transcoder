var branch,totalLines,ruleList,branch_basket;

$(document).ready(function(){

    add_branch_select_option();

    $('#page-wrapper').css('width', ($(document).width()-350).toString()+'px' );

    $('#rule_selector').ruleSelector({
        SelectedCallback: function (rulelist, selectedRuleID) {
            currentRulesetID = selectedRuleID;
            window.location = 'rm_brancheditor.php?rulesetid=' + selectedRuleID;
        }
    });

    $('#branch_select').on('change',function(e){ select_branch( Number( $(this).val() ) ) });

    $('.del_condi_btn').off('click').on('click',function(e){
        del_condi(e,$(this));
    })

    $('#add_condi_btn').off('click').on('click',function(e){
        add_condi(e,$(this));
        $('.del_condi_btn').off('click').on('click',function(e){
            del_condi(e,$(this));
        })
    })

    $('#del_branch_btn').on('click',function(e){});

    $('#del_branch').on('click',function(e){
        del_branch(e,$(this));
        $('#delBranchModal').modal('hide');
    })

    $('#save_branch_btn').on('click',function(e){
        save_branch();
    })

    $('#nocondi_radio_text').on('click',function(e){ $('input[value=nocondi]').prop("checked", true); });

    $('#add_branch_btn').on('click',function(e){  });

    $('#add_branch').on('click',function(e){ add_branch(e,$(this)) });

    $('#add_branch_select').on('change',function(e){
        if( $('#add_branch_select').val() === '1' ){
            $('input[value=withcondi]').css('display','none');
            $('#withcondi_radio_text').css('display','none');
            $('input[value=nocondi]').prop("checked", true);
        }else {
            $('input[value=withcondi]').css('display','inline');
            $('#withcondi_radio_text').css('display','inline');
            $('#withcondi_radio_text').on('click',function(e){ $('input[value=withcondi]').prop("checked", true); });
        }
    })

    $.ajax({
        type: 'POST',
        url: "appphp/rm_brancheditor_backend.php",
        data: {op:'get_branch',rulesetid:currentRulesetID},
        dataType: "json",
        success: function (data) {

            if(data.supported){

                branch = data.branch;
                totalLines = data.total_lines;
                branch_basket = data.branch_basket;

                $('#branch_select').html( branch_select_option() );

                select_branch( Number( $('#branch_select').val() ) );

                $('#add_branch_select').html( add_branch_select_option() );

            }else if (!data.supported) {

                not_supported_tpl(data.ruleInfo);

            }

        },
        error: function(requestObject, error, errorThrown) {
            $('#ajax_err').css('display','block');
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
    },
    error: function(requestObject, error, errorThrown) {
        $('#ajax_err').css('display','block');
    }
});

function del_condi(e,ele){
    branch[$(ele).data('branchid')]['condition_array'].splice($(ele).data('condikey'),1);
    select_branch( Number( $('#branch_select').val() ) );
}

function add_condi(e,ele){
    branch[$('#branch_select').val()]['condition_array'].push({
        childset:'',
        condi_val:'',
        op:'update',
        pre_line:'null'
    })
    select_branch( Number( $('#branch_select').val() ) );
}

function del_branch(e,ele){
    branch[$('#branch_select').val()]['op'] = 'del';
    $('#branch_select option[value="'+$('#branch_select').val()+'"]').remove();
    select_branch( Number( $('#branch_select').val() ) )
}

function add_branch(e,ele){
    var valid = true;
    $('#branch_select option').each(function(key,op){
        if( $(op).val() === $('#add_branch_select').val() ){
            valid = false
        }
    })

    if(!valid){
        $('#add_branch_err').html('This branch has already existed.');
    }else if (valid) {
        $('#add_branch_err').html('');
        $('#addBranchModal').modal('hide');
        $('#branch_select').append('<option value="'+$('#add_branch_select').val()+'">'+$('#add_branch_select option:selected').html()+'</option>')

        if($('input[name=branchtype]:checked').val() === 'nocondi'){

            branch[Number( $('#add_branch_select').val() )] = {
                id:$('#add_branch_select').val(),
                op:'update',
                LineNumber:branch_basket[Number( $('#add_branch_select').val() )]['LineNumber'],
                ChildRule:'',
                Condition:'',
                Marked:'false',
                PreConditionLine:null,
                condition_array:[{
                    childset:'',
                    condi_val:'',
                    op:'update',
                    pre_line:null
                }]
            }

        }else if ($('input[name=branchtype]:checked').val() === 'withcondi') {

            branch[Number( $('#add_branch_select').val() )] = {
                id:$('#add_branch_select').val(),
                op:'update',
                LineNumber:branch_basket[Number( $('#add_branch_select').val() )]['LineNumber'],
                ChildRule:'',
                Condition:'',
                Marked:'false',
                PreConditionLine:null,
                condition_array:[{
                    childset:'',
                    condi_val:'',
                    op:'update',
                    pre_line:'null'
                }]
            }

        }

        $('#branch_select option[value='+$('#add_branch_select').val()+']').prop('selected',true);
        select_branch( Number( $('#branch_select').val() ) )
    }
}

function save_branch(){
    $('#loader').css('display','block');
    $.ajax({
        type: 'POST',
        url: "appphp/rm_brancheditor_backend.php",
        data: {op:'save_branch',branch:branch,rulesetid:currentRulesetID},
        dataType: "json",
        success: function (data) {
            location.reload();
        },
        error: function(requestObject, error, errorThrown) {
            $('#ajax_err').css('display','block');
        }
    })
}

function branch_select_option(){
    var tpl = '';

    for(var key in branch){
        tpl += '<option value="'+branch[key]['id']+'" data-linenumber="'+branch[key]['LineNumber']+'">Line : '+branch[key]['LineNumber']+'</option>';
    }

    return tpl;
}

function add_branch_select_option(){
    var tpl = '';

    for(var id in branch_basket){
        tpl += '<option value="'+branch_basket[id]['id']+'" data-linenumber="'+branch_basket[id]['LineNumber']+'">Line : '+branch_basket[id]['LineNumber']+'</option>';
    }

    return tpl;
}

function select_branch(id){

    $('#conditions_div').html( condi_div_tpl(id) );
    toggle_add_condi_btn();
    attach_event_to_condi_div();

}

function condi_div_tpl(id){

    var tpl = '';

    branch[id]['condition_array'].forEach(function(condi,key){

        if(condi['pre_line'] !== null && condi['pre_line'] !== ''){

            var del_valid = (key === 0) ? false : true;
            tpl += condition_line_tpl(id,key,condi,del_valid);


        }else if (condi['pre_line'] === null || condi['pre_line'] === '') {

            tpl += no_condi_line_tpl(id,key);

        }

    })

    return tpl;
}

function attach_event_to_condi_div(){

    $('.del_condi_btn').off('click').on('click',function(e){
        del_condi(e,$(this));
    })

    $('.condi_preline').off('change').on('change',function(e){

        branch[Number($(this).data('branchid'))]['condition_array'][Number($(this).data('condikey'))]['pre_line'] =
            $(this).val();

    })

    $('.condi_val').off('change').on('change',function(e){

        branch[Number($(this).data('branchid'))]['condition_array'][Number($(this).data('condikey'))]['condi_val'] =
            $(this).val();

    })

    $('.condi_childset').off('change').on('change',function(e){

        branch[Number($(this).data('branchid'))]['condition_array'][Number($(this).data('condikey'))]['childset'] =
            $(this).val();

    })

}

function toggle_add_condi_btn(){
    if(branch[Number($('#branch_select').val())]['condition_array'][0]['pre_line'] === null ||
        branch[Number($('#branch_select').val())]['condition_array'][0]['pre_line'] === ''){
        $('#add_condi_btn').css('display','none');
    }else {
        $('#add_condi_btn').css('display','inline-block');
    }
}

function condition_line_tpl(id,condi_key,condi,del_valid){
    var tpl = '';

    if(del_valid){
        var del_btn = '&nbsp;<button class="btn btn-lg-black del_condi_btn" data-branchid="'+id+'" data-condikey="'+condi_key+'" style="vertical-align:top;"><i class="fa fa-minus-square-o" aria-hidden="true"></i></button>';
    }else {
        var del_btn = '';
    }

    tpl += "\
  <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
      <div class='form-group' style='display:inline;'>\
        <label style='font-size:18px;'>Previous&nbsp;&nbsp;Line&nbsp;&nbsp;</label>\
        <select class='form-control condi_preline' data-branchid=\""+id+"\" data-condikey=\""+condi_key+"\" style='display:inline;width:100px;cursor:pointer;vertical-align:text-bottom;'>"+pre_line_option(id,condi_key)+"\
        </select>\
      </div>\
      <div class='form-group' style='display:inline;'>\
        <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Equals&nbsp;&nbsp;Value&nbsp;&nbsp;</label>\
        <input type='text' class='form-control condi_val' placeholder='value' value='"+condi['condi_val']+"' data-branchid=\""+id+"\" data-condikey=\""+condi_key+"\" style='display:inline;width:100px;vertical-align:text-bottom;'>\
      </div>\
      <div class='form-group' style='display:inline;'>\
        <label style='font-size:18px;'><i class='fa fa-long-arrow-right' aria-hidden='true'></i>&nbsp;&nbsp;Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
        <select class='form-control condi_childset' data-branchid=\""+id+"\" data-condikey=\""+condi_key+"\" style='display:inline;width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,condi_key)+"\
        </select>\
      </div>"
        +del_btn+"\
  </div>";

    return tpl;
}

function no_condi_line_tpl(id,condi_key,condi,del_valid){
    var tpl = '';

    tpl += "\
  <div class='condi_container' style='margin-top:10px;background-color:#f5f5f5;border-radius:5px;padding:10px;'>\
      <div class='form-group' style='display:inline;'>\
        <label style='font-size:18px;'>Apply&nbsp;&nbsp;Rule&nbsp;&nbsp;</label>\
        <select class='form-control condi_childset' data-branchid=\""+id+"\" data-condikey=\""+condi_key+"\" style='display:inline;width:200px;cursor:pointer;vertical-align:text-bottom;'>"+childset_option(id,condi_key)+"\
        </select>\
      </div>\
  </div>";

    return tpl;

}

function pre_line_option(id,key){
    var tpl = '<option value="">--None--</option>';

    for(var index in branch_basket){
        var preLine = branch[id]['condition_array'][key]['pre_line'];
        if( Number(branch_basket[index]['LineNumber']) < Number( branch_basket[$('#branch_select').val()]['LineNumber'])  ){
            if(branch_basket[index]['LineNumber'] == preLine){
                tpl += '<option value="'+branch_basket[index]['LineNumber']+'" selected>'+branch_basket[index]['LineNumber']+'</option>';
            }else if( index !== preLine){
                tpl += '<option value="'+branch_basket[index]['LineNumber']+'">'+branch_basket[index]['LineNumber']+'</option>';
            }

        }
    }
    return tpl;
}

function childset_option(id,key){
    var tpl = '<option value="">--No Selected--</option>';
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

function not_supported_tpl(ruleInfo){
    var infoTpl = '';
    for(var key in ruleInfo){
        infoTpl += '<span style="font-size:18px">'+key+' : '+ruleInfo[key]+'</span><br>';
    }
    $('#brancheditor-container').html('\
  <h3>This rule is not supported by Branch Editor.</h3>\
  <div id="rule-info">'+
        infoTpl+'\
  </div>');
}
