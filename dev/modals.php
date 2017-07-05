<!-- Import Modal -->

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="" style="font-weight:bold;">Import DAT File</h4>
      </div>
      <div class="modal-body">

        <font style="font-size:14px;font-weight:bold;">Select Local File:&nbsp;&nbsp;</font>
        <span class='btn btn-black fileinput-button' style="vertical-align:-2px;">
          <i class='glyphicon glyphicon-save'></i>
          <span>Select</span>
          <input id='localfile' type='file' name='files[]' style='display:block;width:100%;height:100%;cursor:pointer;'>
        </span>
        <br>

        <hr style="margin:5px 0px;">

        <font style="font-size:14px;font-weight:bold;">Upload File to Server:&nbsp;&nbsp;</font>
        <span class='btn btn-black fileinput-button' style="vertical-align:-2px;">
          <i class='glyphicon glyphicon-floppy-open'></i>
          <span>Upload</span>
          <input id='fileupload' type='file' name='files[]' style='display:block;width:100%;height:100%;cursor:pointer;'>
        </span>
        <br>
        <!-- The global progress bar -->
        <div id='progress' class='progress' style="display:none;">
          <div class='progress-bar progress-bar-success'></div>
        </div>
        <!-- The container for the uploaded files -->
        <div id='files' class='files'></div>

        <hr style="margin:5px 0px;">

        <font style="font-size:14px;font-weight:bold;">Select File on Server:</font>
        <div id="serverfilelist" style="border:1px solid #dadada;padding:5px;">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Record Modal -->
<div class="modal fade" id="recordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <span class="modal-title" id="myModalLabel">TransCode Record</span>
        <span class="modal-title" style="color:red">Maxmum 50 Records</span>
      </div>
      <div class="modal-body">
        <div class="records-container">
          <table class="table table-condensed table-hover record-table">
            <tr>
              <th>#</th>
              <th>SourceData</th>
              <th>TimeStamp</th>
              <th>LOAD</th>
            <tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  </div>
