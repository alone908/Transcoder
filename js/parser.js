$(document).ready(function(){

$('.start').click(function(){

  $('.newDATA').val('');
  $('.dataForm').html('');

  var originalDATA = $('.originalDATA').val();
  originalDATA = originalDATA.replace(/\r?\n|\r/g,'');
  originalDATA = originalDATA.replace(/\s/g,'');

  var sortData = newTextData(originalDATA);

  var data = newFormData(sortData);

  $('.dataForm').append(data.lineHtml);
  $('.dataText').val(data.lineText);
  $('.datalog').val(data.lineLog);

  var datapost = {
    sourceData:originalDATA,
    transCodeLog:data.lineLog,
  }

 $.ajax({
   type: 'POST',
   url: "record.php",
   data: datapost,
   dataType: "json",
   success: function (data) {

   }
 });

})

$('.clear').click(function(){
  $('.originalDATA').val('');
  $('.dataForm').html('');
  $('.datalog').val('');
  $('.dataText').val('');
})

function newTextData(originalDATA){

  var dataLength = originalDATA.length;
  var startPOS = 0;

  var dataLines = [
    ['Blank1',''],
    ['Blank2',''],
    ['Blank3',''],
    ['HeadTitle','=====表頭=====']
  ];

  for(var index in TranscodeRule.DataHead){
    if(index !== 'Blank1' && index !== 'Blank2' && index !== 'Blank3' && index !== 'HeadTitle'){
      dataLines.push( [index,originalDATA.substring(startPOS,startPOS+TranscodeRule.DataHead[index].length)] );
      startPOS += TranscodeRule.DataHead[index].length;
    }
  }

  dataLines.push(['BodyTitle','=====第1表身=====']);

  var bodyCount = 1
  while(startPOS < dataLength){

    for(var index in TranscodeRule.DataBody){
      if(index !== 'BodyTitle'){
        dataLines.push( [index,originalDATA.substring(startPOS,startPOS+TranscodeRule.DataBody[index].length)] );
        startPOS += TranscodeRule.DataBody[index].length;
      }
    }

    bodyCount ++;

    dataLines.push(['BodyTitle','=====第'+bodyCount+'表身=====']);
  }

  return dataLines;
}

function newFormData(sortData){

  var lineHtml = '';
  var lineText = '';
  var lineLog = '';
  var linesText = [];

  sortData.forEach(function(value,lineNumber){

    var index = value[0];
    var sourceData = value[1];
    var headCount = Object.keys(TranscodeRule.DataHead).length;
    var bodyCount = Object.keys(TranscodeRule.DataBody).length;

    //re-calculate line number
    lineNumber ++;

    var section = (lineNumber <= headCount) ? 'DataHead' : 'DataBody';

    if(lineNumber > headCount){
      if( (lineNumber-headCount)%bodyCount !== 0 ){
        lineNumber = (lineNumber-headCount)%bodyCount+headCount;
      }else if ( (lineNumber-headCount)%bodyCount === 0 ) {
        lineNumber = bodyCount+headCount;
      }
    }

    //add zero afront of number
    if(lineNumber < 10){
      lineNumText = '00'+lineNumber.toString();
      lineLog += lineNumText+' ';
    }else if (lineNumber < 99) {
      lineNumText = '0'+lineNumber.toString();
      lineLog += lineNumText+' ';
    }else if (lineNumber >= 100) {
      lineNumText = lineNumber.toString();
      lineLog += lineNumText+' ';
    }

    var exp = TranscodeRule[section][index].Exp;
    var lsb = TranscodeRule[section][index].LSB;
    var dataCoding = TranscodeRule[section][index].dataCoding;
    var unixTime = TranscodeRule[section][index].UnixTime;

    //start writing line html
    //line DIV
    lineHtml +='<div class="lineDiv" >';
    //line number span
    lineHtml +='<span class="lineNumber">'+lineNumText+'</span>';
    //line number span
    if($('.checkContent').prop('checked')){
      lineHtml +='<span class="description">'+exp+'</span>';
      lineLog += exp+' ';
    }
    //sourceData span
    lineHtml +='<span class="lineData">'+sourceData+'</span>';
    lineText += sourceData+' ';
    lineLog += sourceData+' ';

    if($('.transCode').prop('checked')){

      var transCode = sourceData;
      var rulesCount = TranscodeRule[section][index].Rule.length;
      lineLog += '-->';

      TranscodeRule[section][index].Rule.forEach(function(rule,index){

        if(rule === 'AN'){
            //create array with each second number in line
            var secondNumArray = [];
            sourceData.split('').forEach(function(value,index){
              if(index%2 === 1){
                secondNumArray.push(value);
              }
            })

           transCode = secondNumArray.join('');

           if(index !== rulesCount -1) lineLog += transCode+'-->';
           if(index === rulesCount -1) lineLog += transCode+' ';

        }

        if(rule === 'LSB'){

            //create array with each two number in line
            var twoNumArray = [];
            var twoNumber = '';
            sourceData.split('').forEach(function(value,index){
              twoNumber += value;
              if(index%2 === 1){
                twoNumArray.push(twoNumber);
                twoNumber = '';
              }
            })

            transCode = twoNumArray.reverse().join('');

            if(index !== rulesCount -1) lineLog += transCode+'-->';
            if(index === rulesCount -1) lineLog += transCode+' ';

        }

        if(rule === 'Decimal'){
            transCode = parseInt(transCode,16);

            if(index !== rulesCount -1) lineLog += transCode+'-->';
            if(index === rulesCount -1) lineLog += transCode+' ';

        }

        if(rule === 'UnixTime'){
            var d = new Date( (Number(transCode)*1000)-28800000 );
            transCode = d.getFullYear()+'/'+(d.getMonth()+1)+'/'+d.getDate()+' '+
                        d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();

            if(index !== rulesCount -1) lineLog += transCode+'-->';
            if(index === rulesCount -1) lineLog += transCode+' ';

        }
      })
      lineHtml +='<span class="transCode">'+transCode+'</span>';

    }

    if($('.transCodeRule').prop('checked')){

      var rules = '';
      var rulesCount = TranscodeRule[section][index].Rule.length;

      TranscodeRule[section][index].Rule.forEach(function(rule,key){

        if(key === 0){
          if(rulesCount === 1)  rules += rule;
          if(rulesCount > 1)  rules += rule+'-->'
        }

        if(key !== 0 && key !== rulesCount-1){
          rules += rule+'-->';
        }

        if(key === rulesCount-1 && key !== 0){
          rules += rule;
        }
      })

      lineHtml +='<span class="transCodeRule">'+rules+'</span>';
      lineText += rules;
      lineLog += rules+' ';

    }

    lineHtml +='</div>';
    lineText += "\n";
    lineLog += "\n";
  })

  return {lineHtml:lineHtml,lineText:lineText,lineLog:lineLog};
}

$('.RuleID').editable({
  mode:'popup',
  type:'text',
  title:'Change Rule',
  emptytext:null,
  placement:'top',
  container:'body',
})

$('.RuleID').on('shown',function(e, params){

  $('.editable-input > input').css('display','none');

  $('.editable-buttons').prepend('\
  <button class="btn btn-default btn-sm btn-minus">\
  <i class="glyphicon glyphicon-minus"></i>\
  </button>');

  $('.editable-buttons').prepend('\
  <button class="btn btn-default btn-sm btn-plus" style="position:relative;left:5px;">\
    <i class="glyphicon glyphicon-plus"></i>\
  </button>');

  $('.btn-minus').on('click',function(){
    updateRule('minus',e.target.dataset.ruleid,getRuleData(e.target.dataset.ruleid))
  })

  $('.btn-plus').on('click',function(){
    updateRule('plus',e.target.dataset.ruleid,getRuleData(e.target.dataset.ruleid))
  })

  $('.editable-submit').on('click',function(){
    updateRule('update',e.target.dataset.ruleid,getRuleData(e.target.dataset.ruleid))
  })

})

function getRuleData(ruleid){
  var data = {};
  $('.rule'+ruleid).each(function(){
    if($(this).data('type') !== 'Section') data[$(this).data('type')] = $(this).val();
    if($(this).data('type') === 'Section') data.Section = $(this).html();
  })
  return data;
}

function updateRule(op,ruleid,data){

 $.ajax({
   type: 'POST',
   url: "updateRule.php",
   data: {op:op,ruleid:ruleid,data:data},
   dataType: "json",
   success: function (data) {
     window.location = 'parser.php?tab=rule';
   }
 });

}

})
