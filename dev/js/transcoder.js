$(document).ready(function(){

  $('.record').on('click',function(e) { listRecords(); } );
  $('#recordModal').on('hidden.bs.modal', function (e) {  clearRecordsTable(); })

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
                                    <td><button type="button" class="btn btn-black record'+num+'" data-recordid="'+record.id+'">LOAD</button></td>\
                                  <tr>')
      })
      for(var i=1;i<=50;i++){
        $('.record'+i).click(function(){
          getSingleRecord($(this).data('recordid'));
          $('#recordModal').modal('hide');
        })
      }
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
