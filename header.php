<?php
if(!isset($_SESSION)){
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Transcoder</title>

    <!-- jQuery -->
    <script src="appjs/jquery-3.2.1.min.js"></script>
    <script src="appjs/jquery.ui.widget.js"></script>
    <script src="appjs/jquery-ui.min.js"></script>
    <script src="appjs/jquery.fileupload.js"></script>
    <script src="appjs/jquery.fileupload-process.js"></script>
    <script src="appjs/jquery.fileupload-validate.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="appjs/bootstrap.min.js"></script>

    <!-- Custom JS -->
    <script src="js/ruleSelector.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/jquery.fileupload.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

<script>
    var login_user = <?php if(isset($_SESSION['login_user'])){ echo '\''.$_SESSION['login_user'].'\''; }else{echo 'null';}; ?>;
    var user_auth = <?php if(isset($_SESSION['user_auth'])){ echo '\''.$_SESSION['user_auth'].'\''; }else{echo 'null';}; ?>;
</script>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top topnav" role="navigation" style="margin-bottom:10px;">
    <div class="container topnav" style="padding-left:15px;padding-right:50px;width:100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="index.php">CJ&nbsp;Studio - Transcoder</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a id="login" data-target="#loginModal" style="cursor: pointer;">
                        <?php
                        if (isset($_SESSION['login_user'])) {
                            echo $_SESSION['login_user'];
                        } else {
                            echo 'Log in';
                        } ?>
                    </a>
                </li>
                <li>
                    <a>|</a>
                </li>
                <li>
                    <a href="appphp/logout.php">Log out</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
