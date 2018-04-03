<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['login_user']) || !isset($_SESSION['user_auth']) || $_SESSION['user_auth'] !== 'admin' || $_SESSION['user_enrollment'] !== 'going'){
    header('Location: index.php');
}
?>
<?php require_once 'appphp/sqldb.php';?>
<?php include_once 'header.php';?>
<?php include_once('fm/class/FileManager.php');?>
<?php $page = 'ad_fileexplorer.php' ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/ad_fileexplorer.js"></script>


<div id="wrapper">

    <?php include_once 'ad_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Advance</li>
          <li>File Explorer</li>
        </ol>
      </div>

      <div id="" class="container" style="width:100%;height:100%;padding:0px;">

          <div class="fmBody" style="">
        			  <?php
                  $FileManager = new FileManager(__DIR__);
                  print $FileManager->create();
                ?>
          </div>

      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
