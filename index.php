<<<<<<< HEAD
	<?php	require_once 'header.php';	?>
	<?php	require_once 'appphp/TranscodeRule.php';	?>
	<?php	if( !isset($_GET['tab']) ) $_GET['tab'] = 'form';	?>
	<?php	$noCover = (isset($_GET['noCover'])) ? $_GET['noCover'] : 'false' ;?>
	<?php	$versionModal = (isset($_GET['vM'])) ? 'false' : 'true' ;?>

	<script src="js/index.js"></script>
	<script src="js/TranscodeRule.js"></script>
	<script>var TranscodeRule = '<?php echo $transcodeRuleJSON; ?>'</script>

  <div class="container" style="">

    <!-- Add welcome cover in the beggining -->
    <?php if($noCover === 'false') require_once 'cover.php' ?>
		<!-- Add welcome cover in the beggining -->

		<?php	require_once 'recordModal.php';	?>
		<?php	require_once 'importModal.php';	?>
		<?php	require_once 'versionModal.php';	?>

		<nav class="navbar navbar-inverse" style="margin:5px 0px;padding:10px 5px;min-height:0px;">
			<button type="button" class="btn btn-info start" style="background-color:#0e61a7;">Start</button>
			<button type="button" class="btn btn-info clear" style="background-color:#0e61a7;">Clear</button>
			<button type="button" class="btn btn-info record" style="background-color:#0e61a7;" data-toggle="modal" data-target="#recordModal"><i class='glyphicon glyphicon-list-alt'></i>&nbsp;&nbsp;Records</button>
			<button type="button" class="btn btn-info import" style="background-color:#0e61a7;" data-toggle="modal" data-target="#importModal"><i class='glyphicon glyphicon-save'></i>&nbsp;&nbsp;Import</button>
			<a href="file_manager.php" class="btn btn-info fm" style="background-color:#0e61a7;"><i class='glyphicon glyphicon-folder-open'></i>&nbsp;&nbsp;File Manager</a>
			<a href="sourceCode.php" class="btn btn-info fm" style="background-color:#0e61a7;"><i class='glyphicon glyphicon-barcode'></i>&nbsp;&nbsp;Source Code</a>
		</nav>

    <div style="display:inline-block; width:10%; margin:-3 0 0 0;">
			<h4>Source Data</h4>
      <textarea type="text" class="form-control originalDATA" style="width:100%; height:500px;">
      </textarea>
=======
<!-- Header -->
<?php include_once 'header.php';?>

<!-- Custom CSS -->
<link href="css/landing-page.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- <a name="about"></a> -->
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                        <h1 style="font-family:'Gloria Hallelujah'">Transcoder</h1>
                        <h3 style="font-family:'Gloria Hallelujah'">A simple transcoder makes your work easier.</h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <!-- <li>
                                <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                            </li> -->
                            <li>
                                <a href="https://github.com/alone908/CardTranscoder" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <!-- <li>
                                <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

>>>>>>> development
    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->

    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Simple Use Transcoder</h2>
                    <p class="lead">Just click start button, let Transcoder does the work for you. Transcoder is designed for saving your life.<br>You can import data from file or simply copy and paste it.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/transcoder.png" alt="">
                </div>
            </div>

        </div>

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Powerful Rule Editor</h2>
                    <p class="lead">Customize your rule, rearrange or insert rule, modify field value, you can even apply multiple rules to trnascoder.<br>Everything is in Rule Editor.</p>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="img/ruleeditor.png" alt="">
                </div>
            </div>

        </div>

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Rule Branch Feature</h2>
                    <p class="lead">Apply sub rule to any line you want, even better, you can decide witch sub rule should be applied under certain conditions.<br>Start with rule branch editor.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="img/rulebranch.png" alt="">
                </div>
            </div>

        </div>

    </div>
    <!-- /.content-section-a -->

    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <h2>Connect to Transcoder</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <!-- <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li> -->
                        <li>
                            <a href="https://github.com/alone908/CardTranscoder" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                        </li>
                        <!-- <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-linkedin fa-fw"></i> <span class="network-name">Linkedin</span></a>
                        </li> -->
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- /.banner -->

<!-- Footer -->
<?php include_once 'footer.php';?>
