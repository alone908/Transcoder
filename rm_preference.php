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
<?php include_once 'appphp/rule_list_array.php';?>
<?php $page = 'rm_preference.php' ?>
<?php $defaultRuleSetID = 1 ?>

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">
<!-- Custom JS -->
<script src="js/rm_preference.js"></script>

<div id="wrapper">

    <?php include_once 'rm_sidebar.php';?>

    <div id="page-wrapper" style="position:absolute;width:100%;height:100%;">

      <div style="margin-top:10px;">
        <ol class="breadcrumb" style="margin-bottom:10px;">
          <li><a href="index.php">Home</a></li>
          <li>Rule Manager</li>
          <li>Preference</li>
        </ol>
      </div>

    </div>

</div>

<?php include_once 'footer.php';?>
