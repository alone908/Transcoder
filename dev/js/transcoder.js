$(document).ready(function(){

  var wrapperHeight = $(document).innerHeight()-225;
  $('#wrapper').css('height',wrapperHeight.toString()+'px');

  $('#record-btn').on('click',function(e) { listRecords(); } );
  $('#recordModal').on('hidden.bs.modal', function (e) {  clearRecordsTable(); })

  $("#menu-toggle").click(function(e) { toggleMenu(e) });
  $('#form-tab').on('click',function(e){ showFormDataContainer(e) });
  $('#source-tab').on('click',function(e){ showSourceDataContainer(e) });
  $('#text-tab').on('click',function(e){ showTextDataContainer(e) });
  $('#log-tab').on('click',function(e){ showLogDataContainer(e) });

})


function listRecords(){
  $.ajax({
    type: 'POST',
    url: "appphp/getRecord.php",
    dataType: "json",
    success: function (data) {
      data.Records.forEach(function(record,index){
        var num = index+1;
        $('.record-table').append('<tr>\
                                    <td>'+num+'</td>\
                                    <td>'+record.SourceData+'</td>\
                                    <td>'+record.TimeStamp+'</td>\
                                    <td><button type="button" class="btn btn-black record" data-recordid="'+record.id+'">LOAD</button></td>\
                                  <tr>')
      })
      $('.record').click(function(){
          getSingleRecord($(this).data('recordid'));
          $('#recordModal').modal('hide');
      })
    }
  });
}

function clearRecordsTable(){
  $('.record-table').html('<tr>\
                            <th>#</th>\
                            <th>SourceData</th>\
                            <th>TimeStamp</th>\
                            <th>LOAD</th>\
                          <tr>')
}

function getSingleRecord(recordid){
 $.ajax({
   type: 'POST',
   url: "appphp/getSingleRecord.php",
   data: {recordid:recordid},
   dataType: "json",
   success: function (data) {
     parse_new_data(data.Record.SourceData,true,false);
   }
 });
}

function toggleMenu(e){
  e.preventDefault();
  $("#wrapper").toggleClass("toggled");
  $("#menu-toggle-div").toggleClass("toggled");
}

function showFormDataContainer(e){
    $('#form-data-container').css('display','block');
    $('#source-data-container').css('display','none');
    $('#text-data-container').css('display','none');
    $('#log-data-container').css('display','none');

    $('#form-tab > a').addClass('a-active');
    $('#source-tab > a').removeClass('a-active');
    $('#text-tab > a').removeClass('a-active');
    $('#log-tab > a').removeClass('a-active');

    toggleMenu(e);
}

function showSourceDataContainer(e){
  $('#form-data-container').css('display','none');
  $('#source-data-container').css('display','block');
  $('#text-data-container').css('display','none');
  $('#log-data-container').css('display','none');

  $('#form-tab > a').removeClass('a-active');
  $('#source-tab > a').addClass('a-active');
  $('#text-tab > a').removeClass('a-active');
  $('#log-tab > a').removeClass('a-active');

  toggleMenu(e);
}

function showTextDataContainer(e){
  $('#form-data-container').css('display','none');
  $('#source-data-container').css('display','none');
  $('#text-data-container').css('display','block');
  $('#log-data-container').css('display','none');

  $('#form-tab > a').removeClass('a-active');
  $('#source-tab > a').removeClass('a-active');
  $('#text-tab > a').addClass('a-active');
  $('#log-tab > a').removeClass('a-active');

  toggleMenu(e);
}

function showLogDataContainer(e){
  $('#form-data-container').css('display','none');
  $('#source-data-container').css('display','none');
  $('#text-data-container').css('display','none');
  $('#log-data-container').css('display','block');

  $('#form-tab > a').removeClass('a-active');
  $('#source-tab > a').removeClass('a-active');
  $('#text-tab > a').removeClass('a-active');
  $('#log-tab > a').addClass('a-active');

  toggleMenu(e);
}
