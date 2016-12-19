<!-- Modal -->
<div class="modal fade" id="version" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="versionLabel">Version History</h4>
      </div>
      <div class="modal-body" style="height:450px;overflow-y:scroll;">
        <?php
          $file = fopen("versionLog.txt","r");

          while(! feof($file)){
             $line = fgets($file);
            if(strpos($line,'version') === 0){
              echo '<h4 style="margin:0px;color:blue;">'.$line.'</h4>';
            }else {
              echo '<font>&nbsp;&nbsp;&nbsp;'.$line.'</font><br>';
            }
            }

           fclose($file);
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
