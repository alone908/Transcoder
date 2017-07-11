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
        <span class="modal-title" id="myModalLabel" style="font-size:18px;">Records</span>
        <span class="modal-title" style="color:red;font-size:12px;">&nbsp;(maxmum 50 records)</span>
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


<!-- Delete Rule Modal -->
<div class="modal fade" id="delRuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Delete Rule</span>
      </div>
      <div class="modal-body">
        <span style="font-size:14px;color:red;">Are you sure you want to delete this rule ?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="del_rule" type="button" class="btn btn-lg-black">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Clone Rule Modal -->
<div class="modal fade" id="cloneRuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Clone Rule</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="">New Rule Name:</label>
          <input id="new_rule_name" type="text" class="form-control" placeholder="Rule Name">
        </div>
        <span id="clone_err_text" style="font-size:10px;color:red;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="clone_rule" type="button" class="btn btn-lg-black">Clone</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Rule Name Modal -->
<div class="modal fade" id="editRuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Edit Rule Name</span>
      </div>
      <div class="modal-body">
        <div class="form-group" style="margin-bottom:5px;">
          <label for="">New Rule Name:</label>
          <input id="rule_name" type="text" class="form-control" placeholder="Rule Name">
        </div>
        <span id="edit_name_err" style="font-size:14px;color:red;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="save_rule_name" type="button" class="btn btn-lg-black">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Insert Rule Row Modal -->
<div class="modal fade" id="insertRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Insert Row</span>
      </div>
      <div class="modal-body">
        <div class="form-group" style="height:50px;">

          <label class="col-sm-2">Type:</label>
          <input type="radio" id="inlineCheckbox1" name="type" value="regular"><span id="regular_radio_text" class="radio_text">Regular Line</span>
          <input type="radio" id="inlineCheckbox1" name="type" value="blank"><span id="blank_radio_text" class="radio_text">Blank Line</span>
          <br><br>
          <label class="col-sm-2">Position:</label>
          <input type="radio" id="inlineCheckbox1" name="position" value="before"><span id="before_radio_text" class="radio_text">Before</span>
          <input type="radio" id="inlineCheckbox1" name="position" value="after"><span id="after_radio_text" class="radio_text">After</span>

        </div>
        <span id="insert_err" style="display:inline-block;margin-left:15px;font-size:14px;color:red;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="insert" type="button" class="btn btn-lg-black">Insert</button>
      </div>
    </div>
  </div>
</div>
