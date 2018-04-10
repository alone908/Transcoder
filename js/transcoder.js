var new_rule, ruleList, ruleTplType={}, defaultRuleSetID = 1, currentRulesetID= 1;

get_rule_list();

$(document).ready(function () {

    var wrapperHeight = $(document).innerHeight() - 160;
    $('#wrapper').css('height', wrapperHeight.toString() + 'px');

    $('#rule_selector').ruleSelector({
        RuleType:'MainRule',
        SelectedCallback:function(rulelist,selectedRuleID){
            currentRulesetID = selectedRuleID;

            $('#rule-list-table > tbody > tr').removeClass('info');
            $('#rule-list-table > tbody > tr').each(function(index,tr){
                if($(this).data('rulesetid').toString() === selectedRuleID ){
                    $(this).addClass('info');
                }
            })

            $('#rule-info').html('');
            for (var key in ruleList[selectedRuleID]) {
                $('#rule-info').append('<span style="font-size:18px">' + key + ' : ' + ruleList[selectedRuleID][key] + '</span><br>');
            }
            $('#rule-title-li').text('Transcoder - ' + ruleList[selectedRuleID]['RuleName']);
            var script = 'new_rule = ' + ruleList[selectedRuleID]['RuleVar'];
            eval(script);
        }
    });

    $('.start').on('click', function (e) {
        parse_new_data($('.originalDATA').val(), false, true);
        if ($("#wrapper").hasClass('toggled')) {
            showFormDataContainer(e, true);
        }
        else {
            showFormDataContainer(e, false)
        }
    })

    $('.clear').on('click', function (e) {
        $('.originalDATA').val('');
        $('.dataForm').html('');
        $('.mefForm').html('');
        $('.datalog').val('');
        $('.dataText').val('');
        if ($("#wrapper").hasClass('toggled')) {
            showFormDataContainer(e, true);
        }
        else {
            showFormDataContainer(e, false)
        }
    })

    $('#import-btn').on('click', function (e) {
        serverfilelist('../uploadfiles');
        if ($("#wrapper").hasClass('toggled')) {
            showFormDataContainer(e, true);
        }
        else {
            showFormDataContainer(e, false)
        }
    })

    $('#importModal').on('hidden.bs.modal', function (e) {
        $('.progress').css('display', 'none');
        $('#progress .progress-bar').css('width', '0%');
        $('#files').html('');
        $('#serverfilelist').html('');
    })

    $('#localfile').on('change', function (e) {
        parse_local_file()
    });

    $('#record-btn').on('click', function (e) {
        listRecords();
        if ($("#wrapper").hasClass('toggled')) {
            showFormDataContainer(e, true);
        }
        else {
            showFormDataContainer(e, false)
        }
    });

    $('#recordModal').on('hidden.bs.modal', function (e) {
        clearRecordsTable();
    })

    $('.checkExp').on('click', function (e) {
        if ($('.checkExp').prop('checked')) {
            $('.description').css('display', 'inline-block');
        }
        else {
            $('.description').css('display', 'none');
        }
    })

    $('.checktransCode').on('click', function (e) {
        if ($('.checktransCode').prop('checked')) {
            $('.transCode').css('display', 'inline');
        } else {
            $('.transCode').css('display', 'none');
        }
    })

    $('.checktranscodeRule').on('click', function (e) {
        if ($('.checktranscodeRule').prop('checked')) {
            $('.transCodeRule').css('display', 'inline');
        } else {
            $('.transCodeRule').css('display', 'none');
        }
    })

    $('#rule-list-table > tbody > tr').on('click', function (e) {
        select_rule(e, $(this));
    })

    $("#sumup-line").on('click', function(e) {
        if($('#summarize-line').val() !== ''){
            var sum = 0;
            $('.'+$('#summarize-line').val()+' .transCode').each(function (index,node) {
                sum += parseInt(node.textContent);
            })
            $('#line-total').html(sum);
        }
    });

    $('#calculatorModal').on('hidden.bs.modal', function (e) {
        $('#summarize-line').val('');
        $('#line-total').html('');
    })

    $("#menu-toggle").on('click', function (e) {
        toggleMenu(e)
    });
    $('#form-tab').on('click', function (e) {
        showFormDataContainer(e, true)
    });
    $('#source-tab').on('click', function (e) {
        showSourceDataContainer(e,true)
    });
    $('#text-tab').on('click', function (e) {
        showTextDataContainer(e,true)
    });
    $('#log-tab').on('click', function (e) {
        showLogDataContainer(e, true)
    });
    $('#rule-tab').on('click', function (e) {
        showRuleTabContainer(e, true)
    });

    //***** Upload Course ZIP file **********************
    $('#fileupload').fileupload({
        url: 'appphp/upload_file.php',
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(txt|dat)$/i,
        disableImageResize: false,
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {

        $('.progress').css('display', 'block');
        data.context = $('<div id="filelist"/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>').append($('<span/>').text('uploading... ' + file.name));
            if (!index) {
                node.append('<br>');
            }
            node.appendTo(data.context);
        });

    }).on('fileuploadprocessalways', function (e, data) {

        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);

        if (file.error) {
            node.append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }

    }).on('fileuploadprogressall', function (e, data) {

        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css('width', progress + '%');

    }).on('fileuploaddone', function (e, data) {

        setTimeout(function () {
            $('#importModal').modal('hide');
            $('.progress').css('display', 'none');
            $('#progress .progress-bar').css('width', '0%');
            $('#files').html('');
            parse_new_data(data.result.files[0].content, true, true);
        }, 500);

    }).on('fileuploadfail', function (e, data) {

    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

    //****************************************************************************

})

////////////////////////////////////////////////////////////////////////////////
function select_rule(e, ele) {
    $('#rule-list-table > tbody > tr').removeClass('info');
    ele.addClass('info');
    $('#rule-info').html('');
    var RuleSetID = ele.data('rulesetid');

    for (var key in ruleList[RuleSetID]) {
        $('#rule-info').append('<span style="font-size:18px">' + key + ' : ' + ruleList[RuleSetID][key] + '</span><br>');
    }
    $('#rule-title-li').text('Transcoder - ' + ruleList[RuleSetID]['RuleName']);
    var script = 'new_rule = ' + ele.data('rulevar');
    eval(script);
}

////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

function get_rule_list() {
    $.ajax({
        type: 'POST',
        url: "appphp/TranscodeRule.php",
        data: {op: 'get_rule_list'},
        dataType: "json",
        success: function (data) {
            ruleList = data.ruleList;
            for (var RuleSetID in data.ruleList) {
                get_rule_obj(RuleSetID, data.ruleList[RuleSetID].RuleVar);
            }
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });
}

function get_rule_obj(RuleSetID, RuleVar) {
    $.ajax({
        type: 'POST',
        url: "appphp/TranscodeRule.php",
        data: {op: 'get_rule_obj', RuleSetID: RuleSetID},
        dataType: "json",
        success: function (data) {
            var script = RuleVar + '=data.new_rule';
            eval(script);
            if (Number(RuleSetID) === defaultRuleSetID) {
                var script = 'new_rule = ' + RuleVar + ';';
                eval(script);
            }
            check_rule_tpl_type(RuleSetID.toString(),data.new_rule);
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });
}

function check_rule_tpl_type(ruleSetID,ruleObj){
    var tplType = 'unknown', hasHead = false, hasBody = false, hasTail = false;
    for (var index in ruleObj) {
        var subject = ruleObj[index]['Subject'];
        if (subject === 'HeadTitle') {hasHead = true;}
        if (subject === 'BodyTitle') {hasBody = true;}
        if (subject === 'TailTitle') {hasTail = true;}
    }
    if(!hasHead && !hasBody && !hasTail){ tplType = 'A' }
    if(hasHead && hasBody && !hasTail){ tplType = 'B' }
    if(hasHead && hasBody && hasTail){ tplType = 'C' }

    ruleTplType[ruleSetID] = tplType;
}

////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

function parse_new_data(originalDATA, replaceOriginalDATA, insertRecord) {

    originalDATA = originalDATA.replace(/\r?\n|\r/g, '');
    originalDATA = originalDATA.replace(/\s/g, '');

    var linesArray = split_origin_data(originalDATA);
    var data = build_tpl(linesArray);

    if (replaceOriginalDATA) {
        $('.originalDATA').val(originalDATA);
    }
    $('.dataForm').html('');
    $('.mefForm').html('');

    $('.dataForm').append(data.lineHtml);
    $('.dataText').val(data.lineText);
    $('.datalog').val(data.lineLog);

    $('.childdata').on('click', function () {
        parse_child_rule($(this).data('childruleset'), $(this).data('childdata'));
        $('#subrule_title').html('Sub Rule : ' + ruleList[$(this).data('childruleset')]['RuleName']);
    })

    if (insertRecord) {
        var datapost = {
            op: 'insert_record',
            sourceData: originalDATA,
            transCodeLog: data.lineLog,
            ruleSetID: currentRulesetID
        }

        $.ajax({
            type: 'POST',
            url: "appphp/transcoder_backend.php",
            data: datapost,
            dataType: "json",
            success: function (data) {

            }
        });
    }

}

function split_origin_data(originalDATA) {

    switch (ruleTplType[currentRulesetID]) {
        case 'A':   //no HeadTitle, no BodyTitle, no TailTitle

        var linesArray = [];
        var startPOS = 0;
        var dataLength = originalDATA.length;

        while (startPOS < dataLength) {

            for (var i = 0; i < new_rule.length; i++) {

                var subject = new_rule[i]['Subject'];
                var length = new_rule[i]['Length'];
                var obj = {};
                for (var key in new_rule[i]) {
                    obj[key] = new_rule[i][key];
                }
                obj.Data = originalDATA.substring(startPOS, startPOS + length);
                linesArray.push(obj);
                startPOS += length;

            }

        }

            break;

        case 'B':   //has HeadTitle, has BodyTitle, no TailTitle

        var linesArray = [];
        var startPOS = 0;
        var bodyCount = 0;
        var dataLength = originalDATA.length;
        
        var headStartIndex = 0;
        for (var index in new_rule) {
            var subject = new_rule[index]['Subject'];
            if (subject === 'BodyTitle') {
                var headEndIndex = index - 1;
                var bodyStartIndex = index;
            }
        }
        var bodyEndIndex = new_rule.length - 1;

        for (var i = 0; i <= headEndIndex; i++) {

            var subject = new_rule[i]['Subject'];
            var length = new_rule[i]['Length'];
            var exp = new_rule[i]['Exp'];
            var obj = new_rule[i];

            obj.Data = originalDATA.substring(startPOS, startPOS + length);
            linesArray.push(obj);
            startPOS += length;

        }

        while (startPOS < dataLength) {
            bodyCount ++;
            for (var i = bodyStartIndex; i <= bodyEndIndex; i++) {

                var subject = new_rule[i]['Subject'];
                var length = new_rule[i]['Length'];
                var obj = {};

                if(new_rule[i]['OnlyShowInBody'].indexOf(bodyCount.toString()) !== -1 || new_rule[i]['OnlyShowInBody'].length === 0){
                    for (var key in new_rule[i]) {
                        obj[key] = new_rule[i][key];
                    }
                    obj.Data = originalDATA.substring(startPOS, startPOS + length);
                    linesArray.push(obj);
                    startPOS += length;
                }

            }

        }

            break;

        case 'C':   //has HeadTitle, has BodyTitle, has TailTitle

        var linesArray = [];
        var startPOS = 0;
        var dataLength = originalDATA.length;
        var bodyCount = 0;
        var bodyLength = 0;

        var headStartIndex = 0;
        for (var index in new_rule) {
            var subject = new_rule[index]['Subject'];
            if (subject === 'BodyTitle') {
                var headEndIndex = index - 1;
                var bodyStartIndex = index;
            }
            if (subject === 'TailTitle') {
                var bodyEndIndex = index - 1;
                var tailStartIndex = index;
            }
        }
        var tailEndIndex = new_rule.length - 1;

        for (var i = 0; i <= headEndIndex; i++) {

            var subject = new_rule[i]['Subject'];
            var length = new_rule[i]['Length'];
            var exp = new_rule[i]['Exp'];
            var obj = new_rule[i];

            obj.Data = originalDATA.substring(startPOS, startPOS + length);
            linesArray.push(obj);
            startPOS += length;

        }

        while (startPOS < dataLength && dataLength-startPOS > bodyLength) {
            bodyCount ++;
            for (var i = bodyStartIndex; i <= bodyEndIndex; i++) {

                var subject = new_rule[i]['Subject'];
                var length = new_rule[i]['Length'];
                if(bodyCount === 1) bodyLength += length;
                var obj = {};

                if(new_rule[i]['OnlyShowInBody'].indexOf(bodyCount.toString()) !== -1 || new_rule[i]['OnlyShowInBody'].length === 0){
                    for (var key in new_rule[i]) {
                        obj[key] = new_rule[i][key];
                    }
                    obj.Data = originalDATA.substring(startPOS, startPOS + length);
                    linesArray.push(obj);
                    startPOS += length;
                }

            }

        }

        for (var i = tailStartIndex; i <= tailEndIndex; i++) {

            var subject = new_rule[i]['Subject'];
            var length = new_rule[i]['Length'];
            var exp = new_rule[i]['Exp'];
            var obj = new_rule[i];

            obj.Data = originalDATA.substring(startPOS, startPOS + length);
            linesArray.push(obj);
            startPOS += length;

        }

            break;

        default:

            return [];

    }

    return linesArray;

}

function build_tpl(linesArray) {

    var lineHtml = '';
    var lineText = '';
    var lineLog = '';
    var bustype;
    var markedValue = {};
    var bodyCount = 0;

    linesArray.forEach(function (line, key) {

        var subject = line['Subject'];
        var sourceData = line['Data'];
        var lineNumber = line['LineNumber'];
        var exp = line['Exp'];
        var lsb = line['LSB'];
        var dataCoding = line['DataCoding'];
        var unixTime = line['UnixTime'];
        var rulesCount = line['TranscodeRule'].length;
        var transCode = sourceData;
        var ruleText = '';
        var marked = line['Marked'];
        var childRule = line['ChildRule'];
        var preConditionLine = line['PreConditionLine'];
        var condition = line['Condition'];
        var childRuleSet = '';

        //count body number
        if (subject === 'BodyTitle') bodyCount++;
        //**************************************************************************

        //add zero afront of line number text
        if (parseInt(lineNumber) < 10) {
            lineNumText = '00' + lineNumber.toString();
        } else if (parseInt(lineNumber) < 99) {
            lineNumText = '0' + lineNumber.toString();
        } else if (parseInt(lineNumber) >= 100) {
            lineNumText = lineNumber.toString();
        }
        //**************************************************************************

        lineLog += lineNumText + ' ' + exp + ' ' + sourceData + ' -->';

        //Loop and transcode *******************************************************

        line['TranscodeRule'].forEach(function (rule, index) {
            transCode = transcode_basedon_rule(rule, transCode);
            if (index !== rulesCount - 1) lineLog += transCode + '-->';
            if (index === rulesCount - 1) lineLog += transCode + ' ';

            if (index === 0) {
                if (rulesCount === 1) ruleText += rule;
                if (rulesCount > 1) ruleText += rule + '-->';
            }

            if (index !== 0 && index !== rulesCount - 1) {
                ruleText += rule + '-->';
            }
            if (index === rulesCount - 1 && index !== 0) {
                ruleText += rule;
            }

        })

        lineLog += ruleText + ' ';
        //**************************************************************************

        //Mark precondition line value *********************************************
        if (marked === 'true') {
            markedValue[lineNumber] = transCode;
        }

        if (condition !== null && condition !== '') {
            eval(condition);
        }

        //**************************************************************************

        //Write lineText ***********************************************************
        lineText += sourceData + ' ';
        lineText += ruleText;
        //**************************************************************************

        //Write lineHtml ***********************************************************
        lineHtml += '<div class="lineDiv ' + parseInt(lineNumText) + '" >';

        //************************line number span *********************************
        lineHtml += '<span class="lineNumber">' + lineNumText + '</span>';

        //************************line content span ********************************
        if ($('.checkExp').prop('checked')) {

            if (childRule !== null && childRule !== '') {
                lineHtml += '<span class="description" style="display:inline-block;">\
                      <a class="childdata" data-childruleset="' + childRuleSet + '" data-childdata="' + sourceData + '">' + exp + '</a>\
                    </span>';
            } else {
                lineHtml += '<span class="description" style="display:inline-block;">' + exp + '</span>';
            }

        } else {

            if (childRule !== null && childRule !== '') {
                lineHtml += '<span class="description" style="display:none;">\
                      <a class="childdata" data-childruleset="' + childRuleSet + '" data-childdata="' + sourceData + '">' + exp + '</a>\
                    </span>';
            } else {
                lineHtml += '<span class="description" style="display:none;">' + exp + '</span>';
            }

        }

        //************************line sourceDat span ******************************
        lineHtml += '<span class="lineData">' + sourceData + '</span>';

        //************************line transCode span ******************************
        if ($('.checktransCode').prop('checked')) {
            if (transCode === null) {
                if(subject === 'BodyTitle'){
                    lineHtml += '<span class="blankspan" style="display:inline;">==表身 (no. ' + bodyCount + ' )==</span>';
                }else {
                    lineHtml += '<span class="blankspan" style="display:inline;">' + exp + '</span>';
                }
            } else {
                lineHtml += '<span class="transCode" style="display:inline;">' + transCode + '</span>';
            }
        } else {
            if (transCode === null) {
                if(subject === 'BodyTitle'){
                    lineHtml += '<span class="blankspan" style="display:inline;">==表身 (no. ' + bodyCount + ' )==</span>';
                }else {
                    lineHtml += '<span class="blankspan" style="display:none;">' + exp + '</span>';
                }
            } else {
                lineHtml += '<span class="transCode" style="display:none;">' + transCode + '</span>';
            }
        }

        //************************line ruleText span **********************************
        if ($('.checktranscodeRule').prop('checked')) {
            lineHtml += '<span class="transCodeRule" style="display:inline;">' + ruleText + '</span>';
        } else {
            lineHtml += '<span class="transCodeRule" style="display:none;">' + ruleText + '</span>';
        }

        //**************************************************************************

        lineHtml += '</div>';
        lineText += "\n";
        lineLog += "\n";
    })

    return {lineHtml: lineHtml, lineText: lineText, lineLog: lineLog};

}

function transcode_basedon_rule(rule, data) {

    var transCode;
    if (rule.indexOf('Binary') === 0) {
        var bitStart = rule.split('-')[1];
        var bitEnd = rule.split('-')[2];
        var lsb = rule.split('-')[3];
        rule = 'Binary';
    }

    switch (rule) {
        case 'AN':

            //create array with each two number in line
            var twoNumArray = eachTwoNum(data);
            var antext = '';
            twoNumArray.forEach(function (value, index) {
                if (typeof an[parseInt(value, 16)] !== 'undefined') {
                    antext += an[parseInt(value, 16)];
                } else if (typeof an[parseInt(value, 16)] === 'undefined') {
                    antext += '[' + value + '?]';
                }
            })

            transCode = antext;

            break;

        case 'LSB':

            //create array with each two number in line
            var twoNumArray = eachTwoNum(data);
            transCode = twoNumArray.reverse().join('');

            break;

        case 'Decimal':

            transCode = parseInt(data, 16);

            break;

        case 'UnixTime':

            var d = new Date((Number(data) * 1000) - 28800000);
            transCode = d.getFullYear() + '/' + (d.getMonth() + 1) + '/' + d.getDate() + ' ' +
                d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();

            break;

        case 'Binary':

            var firstInt = data.split('')[0];
            var secondInt = data.split('')[1];

            if (parseInt(firstInt, 16).toString(2).length === 4) {
                var firstBinaryString = parseInt(firstInt, 16).toString(2);
            } else if (parseInt(firstInt, 16).toString(2).length === 3) {
                var firstBinaryString = '0' + parseInt(firstInt, 16).toString(2);
            } else if (parseInt(firstInt, 16).toString(2).length === 2) {
                var firstBinaryString = '00' + parseInt(firstInt, 16).toString(2);
            } else if (parseInt(firstInt, 16).toString(2).length === 1) {
                var firstBinaryString = '000' + parseInt(firstInt, 16).toString(2);
            }

            if (parseInt(secondInt, 16).toString(2).length === 4) {
                var secondBinaryString = parseInt(secondInt, 16).toString(2);
            } else if (parseInt(secondInt, 16).toString(2).length === 3) {
                var secondBinaryString = '0' + parseInt(secondInt, 16).toString(2);
            } else if (parseInt(secondInt, 16).toString(2).length === 2) {
                var secondBinaryString = '00' + parseInt(secondInt, 16).toString(2);
            } else if (parseInt(secondInt, 16).toString(2).length === 1) {
                var secondBinaryString = '000' + parseInt(secondInt, 16).toString(2);
            }

            if (lsb === 'LSB') {
                var binaryString = secondBinaryString + firstBinaryString;  //Reverse binary string
            } else {
                var binaryString = firstBinaryString + secondBinaryString
            }

            transCode = binaryString.substring(bitStart, bitEnd);

            break;

        case null:
        case '':

            transCode = null;

            break;

        default:

    }

    return transCode;
}

function eachTwoNum(sourceData) {

    var twoNumArray = [];
    var twoNumber = '';
    sourceData.split('').forEach(function (value, index) {
        twoNumber += value;
        if (index % 2 === 1) {
            twoNumArray.push(twoNumber);
            twoNumber = '';
        }
    })
    return twoNumArray;
}

function parse_child_rule(childRuleSet, data) {

    $('.mefForm').html('');
    var html = '';
    var splitStart = 0;
    var bitaddup = 0;

    eval('var ruleObj = ' + ruleList[childRuleSet].RuleVar + ';');

    ruleObj.forEach(function (ruleObj, index) {

        var exp = ruleObj['Exp'];
        var rule = ruleObj['TranscodeRule'];

        if (ruleObj['Length'].toString().indexOf('.') < 0) {
            var Length = ruleObj['Length'];
            var splitEnd = splitStart + Length;
        } else if (ruleObj['Length'].toString().indexOf('.') >= 0) {
            splitStart = ruleObj['Length'].toString().split('.')[0];
            var splitEnd = ruleObj['Length'].toString().split('.')[1];
        }

        var splitdata = data.substring(splitStart, splitEnd);

        var transCode = splitdata;
        if (rule !== null) {
            rule.forEach(function (rule, key) {
                transCode = transcode_basedon_rule(rule, transCode);
            })
        } else {
            transCode = null;
        }

        html += '<div class="lineDiv" >';
        html += '<span class="mef_description" style="display:inline-block;">' + exp + '</span>';
        html += '<span class="lineData">' + splitdata + '</span>';
        if (transCode !== null) {
            html += '<span class="transCode" style="display:inline;">' + transCode + '</span>';
        } else if (transCode === null) {
            html += '<span class="blankspan" style="display:inline;">----------' + exp + '----------</span>';
        }
        html += '</div>';

        $('.mefForm').html(html);
        splitStart = Number(splitEnd);

    })

}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////

//***** Import from local file **********************

function serverfilelist(path) {

    $.ajax({
        type: 'POST',
        url: "appphp/transcoder_backend.php",
        data: {op: 'upload_filelist', path: path},
        dataType: "json",
        success: function (data) {

            if (path !== '../uploadfiles') {
                $('#serverfilelist').append('<span class="fileline" data-type="folder" data-url="' + path.substring(0, path.lastIndexOf('/')) + '"><i class="glyphicon glyphicon-folder-open"></i><span class="serverfile">&nbsp;&nbsp;...</span></span>')
            }

            for (var index in data) {
                if (data[index].fileType === 'folder') {
                    $('#serverfilelist').append('<span class="fileline" data-type="' + data[index].fileType + '" data-url="' + data[index].path + '"><i class="glyphicon glyphicon-folder-close"></i><span class="serverfile">&nbsp;&nbsp;' + index + '</span></span>')
                } else if (data[index].fileType === 'file') {
                    $('#serverfilelist').append('<span class="fileline" data-type="' + data[index].fileType + '" data-url="' + data[index].path + '"><i class="glyphicon glyphicon-file"></i><span class="serverfile">&nbsp;&nbsp;' + index + '</span></span>')
                }
            }

            $('.fileline').on('click', function (e) {
                if (e.currentTarget.dataset.type === 'folder') {
                    $('#serverfilelist').html('');
                    serverfilelist(e.currentTarget.dataset.url);
                } else if (e.currentTarget.dataset.type === 'file') {
                    $('#importModal').modal('hide');
                    parse_file_onServer(e.currentTarget.dataset.url);
                }
            })

        },
        // error: function(requestObject, error, errorThrown) {
        //         $('#ajax_err').css('display','block');
        // }
    });

}

function parse_file_onServer(path) {

    $.ajax({
        type: 'POST',
        url: "appphp/transcoder_backend.php",
        data: {op: 'parse_file_onServer', path: path},
        dataType: "json",
        success: function (data) {
            parse_new_data(data.sourceData, true, true);
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });

}

String.prototype.convertToHex = function (delim) {
    return this.split("").map(function (c) {
        return ("0" + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(delim || "");
};

function parse_local_file(e) {

    var file = $('#localfile')[0].files[0];
    var reader = new FileReader();

    reader.onload = function (e) {
        parse_new_data(reader.result.convertToHex(), true, true);
    }

    reader.readAsBinaryString(file);
    $('#importModal').modal('hide');

}

////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
function listRecords() {
    $.ajax({
        type: 'POST',
        url: "appphp/transcoder_backend.php",
        data: {op: 'list_records'},
        dataType: "json",
        success: function (data) {
            data.Records.forEach(function (record, index) {
                var num = index + 1;
                var ruleName = (record.RuleSetID !== '-1') ? ruleList[record.RuleSetID]['RuleName'] : '';
                $('.record-table tbody').append('<tr>\
                                    <td>' + num + '</td>\
                                    <td>' + ruleName + '</td>\
                                    <td>' + record.TimeStamp + '</td>\
                                    <td><button type="button" class="btn btn-black record" data-recordid="' + record.id + '">LOAD</button></td>\
                                  <tr>')
            })
            $('.record').click(function () {
                getSingleRecord($(this).data('recordid'));
                $('#recordModal').modal('hide');
            })
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });
}

function clearRecordsTable() {
    $('.record-table tbody').html('<tr>\
                            <th>#</th>\
                            <th>SourceData</th>\
                            <th>TimeStamp</th>\
                            <th>LOAD</th>\
                          <tr>')
}

function getSingleRecord(recordid) {
    $.ajax({
        type: 'POST',
        url: "appphp/transcoder_backend.php",
        data: {op: 'get_single_record', recordid: recordid},
        dataType: "json",
        success: function (data) {
            parse_new_data(data.Record.SourceData, true, false);
        },
        error: function (requestObject, error, errorThrown) {
            $('#ajax_err').css('display', 'block');
        }
    });
}
////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
function toggleMenu(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $("#menu-toggle-div").toggleClass("toggled");
}

function showFormDataContainer(e, toggle) {
    $('#form-data-container').css('display', 'block');
    $('#source-data-container').css('display', 'none');
    $('#text-data-container').css('display', 'none');
    $('#log-data-container').css('display', 'none');
    $('#rule-tab-container').css('display', 'none');

    $('#form-tab > a').addClass('a-active');
    $('#source-tab > a').removeClass('a-active');
    $('#text-tab > a').removeClass('a-active');
    $('#log-tab > a').removeClass('a-active');
    $('#rule-tab > a').removeClass('a-active');

    if (toggle) toggleMenu(e);
}

function showSourceDataContainer(e, toggle) {
    $('#form-data-container').css('display', 'none');
    $('#source-data-container').css('display', 'block');
    $('#text-data-container').css('display', 'none');
    $('#log-data-container').css('display', 'none');
    $('#rule-tab-container').css('display', 'none');

    $('#form-tab > a').removeClass('a-active');
    $('#source-tab > a').addClass('a-active');
    $('#text-tab > a').removeClass('a-active');
    $('#log-tab > a').removeClass('a-active');
    $('#rule-tab > a').removeClass('a-active');

    if (toggle) toggleMenu(e);
}

function showTextDataContainer(e, toggle) {
    $('#form-data-container').css('display', 'none');
    $('#source-data-container').css('display', 'none');
    $('#text-data-container').css('display', 'block');
    $('#log-data-container').css('display', 'none');
    $('#rule-tab-container').css('display', 'none');

    $('#form-tab > a').removeClass('a-active');
    $('#source-tab > a').removeClass('a-active');
    $('#text-tab > a').addClass('a-active');
    $('#log-tab > a').removeClass('a-active');
    $('#rule-tab > a').removeClass('a-active');

    if (toggle) toggleMenu(e);
}

function showLogDataContainer(e, toggle) {
    $('#form-data-container').css('display', 'none');
    $('#source-data-container').css('display', 'none');
    $('#text-data-container').css('display', 'none');
    $('#log-data-container').css('display', 'block');
    $('#rule-tab-container').css('display', 'none');

    $('#form-tab > a').removeClass('a-active');
    $('#source-tab > a').removeClass('a-active');
    $('#text-tab > a').removeClass('a-active');
    $('#log-tab > a').addClass('a-active');
    $('#rule-tab > a').removeClass('a-active');

    if (toggle) toggleMenu(e);
}

function showRuleTabContainer(e, toggle) {
    $('#form-data-container').css('display', 'none');
    $('#source-data-container').css('display', 'none');
    $('#text-data-container').css('display', 'none');
    $('#log-data-container').css('display', 'none');
    $('#rule-tab-container').css('display', 'block');

    $('#form-tab > a').removeClass('a-active');
    $('#source-tab > a').removeClass('a-active');
    $('#text-tab > a').removeClass('a-active');
    $('#log-tab > a').removeClass('a-active');
    $('#rule-tab > a').addClass('a-active');

    if (toggle) toggleMenu(e);
}
////////////////////////////////////////////////////////////////////////////////
