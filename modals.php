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
          <table class="table table-hover record-table">
            <tbody>
            <tr>
              <th>#</th>
              <th>SourceData</th>
              <th>TimeStamp</th>
              <th>LOAD</th>
            <tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Calculator Modal -->
<div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <span class="modal-title" id="myModalLabel" style="font-size:18px;">Summarize Line</span>

            </div>
            <div class="modal-body">

                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Summarize Line</label>
                        <div class="col-sm-6">
                            <input id="summarize-line" type="text" class="form-control" placeholder="Line Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total</label>
                        <div class="col-sm-6">
                            <span id="line-total" class="" style="display: inline-block;width: 269px; height: 26px; border-bottom: 1px solid black;"></span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="sumup-line" type="button" class="btn btn-lg-black">Summarize</button>
            </div>
        </div>
    </div>
</div>


<!-- Add Rule Modal -->
<div class="modal fade" id="addRuleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Add Rule</span>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label class="col-sm-5" style="padding:0px 6px;">Rule Name:</label>
          <input id="name_of_rule" type="text" class="form-control" placeholder="Rule Name" style="width:300px">
        </div>

        <div class="form-group">
        <label class="col-sm-5" style="padding:0px 6px;">Rule Type:</label>
          <input type="radio" name="ruletype" value="MainRule" checked><span id="mainrule_radio_text" class="radio_text">Main Rule</span>
          <input type="radio" name="ruletype" value="SubRule" ><span id="subrule_radio_text" class="radio_text" >Sub Rule</span>
        </div>

        <div id="mainrule_op" class="form-group">
          <label class="col-sm-5" style="padding:0px 6px;">How many lines in rule head:</label>
          <input id="lines_in_head" type="text" class="form-control" placeholder="0" style="width:100px">
          <br>
          <label class="col-sm-5" style="padding:0px 6px;">How many lines in rule body:</label>
          <input id="lines_in_body" type="text" class="form-control" placeholder="0" style="width:100px">
        </div>

        <div id="subrule_op" class="form-group" style="display:none;">
          <label class="col-sm-5" style="padding:0px 6px;">How many lines in rule:</label>
          <input id="lines_in_rule" type="text" class="form-control" placeholder="0" style="width:100px">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_rule" type="button" class="btn btn-lg-black">Add</button>
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

<!-- Delete Rule Row Modal -->
<div class="modal fade" id="delRowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Delete Row</span>
      </div>
      <div class="modal-body">
        <span style="font-size:14px;color:red;">Are you sure you want to delete this row ?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="del_row" type="button" class="btn btn-lg-black">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Add Branch Modal -->
<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Add Branch</span>
      </div>
      <div class="modal-body">
        <div class="form-group" style="height:70px;">

          <label class="col-sm-3">Branch :</label>
          <select id="add_branch_select" class="form-control" style="display:inline-block;width:250px;cursor:pointer">
          </select>
          <br><br>
          <label class="col-sm-3">Branch Type:</label>
          <input type="radio" name="branchtype" value="nocondi" checked><span id="nocondi_radio_text" class="radio_text">No Condition</span>
          <input type="radio" name="branchtype" value="withcondi" style="display:none;"><span id="withcondi_radio_text" class="radio_text" style="display:none;">With Condition</span>

        </div>
        <span id="add_branch_err" style="display:inline-block;margin-left:15px;font-size:14px;color:red;"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_branch" type="button" class="btn btn-lg-black">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Branch Modal -->
<div class="modal fade" id="delBranchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" style="font-size:18px;font-weight:bold;">Delete Branch</span>
      </div>
      <div class="modal-body">
        <span style="font-size:14px;color:red;">Are you sure you want to delete this branch ?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="del_branch" type="button" class="btn btn-lg-black">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- Log In Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-size:18px;font-weight:bold;">Login</span>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="inputUser" class="col-sm-2 col-form-label" style="margin-top: 5px;">User</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputUser" placeholder="User">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label" style="margin-top: 5px;">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                </form>
                <span id="login_err_text" style="font-size:10px;color:red;"></span>
            </div>
            <div class="modal-footer">
                <button id="login_btn" type="button" class="btn btn-lg-black">Login</button>
            </div>
        </div>
    </div>
</div>

<!-- Not Admin Modal -->
<div class="modal fade" id="notAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" style="font-size:18px;font-weight:bold;">Sorry!</span>
            </div>
            <div class="modal-body">
                <span style="font-size:10px;color:red;">You need to login as admin to use this feature.</span>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal -->
<div class="modal fade bd-example-modal-lg" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>
