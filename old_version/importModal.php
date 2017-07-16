
<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="" style="font-weight:bold;">Import Data from DAT File</h4>
      </div>
      <div class="modal-body">

        <font style="font-size:14px;font-weight:bold;">Import from Local:&nbsp;&nbsp;</font>
        <span class='btn btn-info fileinput-button' style="padding:3px 6px;vertical-align:-2px;corsur:pointer;background-color:#0e61a7;">
          <i class='glyphicon glyphicon-save'></i>
          <span>Import</span>
          <input id='localfile' type='file' name='files[]' style='display:block;width:100%;height:100%;corsur:pointer;'>
        </span>
        <br>

        <hr style="margin:5px 0px;">

        <font style="font-size:14px;font-weight:bold;">Upload New File:&nbsp;&nbsp;</font>
        <span class='btn btn-info fileinput-button' style="padding:3px 6px;vertical-align:-2px;corsur:pointer;background-color:#0e61a7;">
          <i class='glyphicon glyphicon-floppy-open'></i>
          <span>Upload</span>
          <input id='fileupload' type='file' name='files[]' style='display:block;width:100%;height:100%;corsur:pointer;'>
        </span>
        <br>
        <!-- The global progress bar -->
        <div id='progress' class='progress' style="display:none;">
          <div class='progress-bar progress-bar-success'></div>
        </div>
        <!-- The container for the uploaded files -->
        <div id='files' class='files'></div>

        <hr style="margin:5px 0px;">

        <font style="font-size:14px;font-weight:bold;">Select File from Server:</font>
        <div id="serverfilelist" style="border:1px solid #dadada;padding:5px;">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
