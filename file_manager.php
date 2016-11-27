<?php

/**
 * +-------------------------------------------------------------------+
 * |                    F I L E M A N A G E R   (v10.44)               |
 * |                                                                   |
 * | Copyright Gerd Tentler               www.gerd-tentler.de/tools    |
 * | Created: Dec. 7, 2006                Last modified: July 30, 2016 |
 * +-------------------------------------------------------------------+
 * | This program may be used and hosted free of charge by anyone for  |
 * | personal purpose as long as this copyright notice remains intact. |
 * |                                                                   |
 * | Obtain permission before selling the code for this program or     |
 * | hosting this software on a commercial website or redistributing   |
 * | this software over the Internet or in any other medium. In all    |
 * | cases copyright must remain intact.                               |
 * +-------------------------------------------------------------------+
 */

include_once('header.php');
include_once('fm/class/FileManager.php');

?>

<div class="container" style="margin:0px;">
<!-- Nav tabs -->
  <nav class="navbar navbar-inverse" style="margin:5px 0px;padding:10px 5px;min-height:0px;">
	  <a href="parser.php" class="btn btn-info" style="background-color:#0e61a7;"><i class='glyphicon glyphicon-arrow-left'></i>&nbsp;&nbsp;Go Back</a>
  </nav>

  <div class='header' style="padding: 5px;">
		<div class="pageTitle">
      <span style='color: #4f94cc'>File Manager</span>
    </div>
  </div>

  <div class="fmBody" style="">
			  <?php
          $FileManager = new FileManager(__DIR__. "/uploadfiles");
          print $FileManager->create();
        ?>
  </div>

</div>

</html>

<?php
//print_r( bin2hex(file_get_contents(__DIR__.'/uploadfiles/TXN_03_9080155E_20160815160337_01.dat')) );
?>
