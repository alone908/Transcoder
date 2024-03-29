<!-- Header -->
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>
<?php if(isset($_GET['hasPaid'])){?>
<script>var hasPaid=<?php echo $_GET['hasPaid']; ?></script>
<?php }else{ ?>
<script>var hasPaid=null</script>
<?php } ?>

<!-- Custom JS -->
<script src="js/index.js"></script>

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
                        <h5 style="font-family:'Gloria Hallelujah'">Upload or copy paste your machine hexadecimal data, then use transcdoer decode data become human readable text, and also you can customize your decoding rule by rule manager.</h5>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a id="transcoder" class="btn btn-default btn-lg"><i class="fa fa-calculator" aria-hidden="true"></i> <span class="network-name">Transcoder</span></a>
                            </li>
                            <li>
                                <a id="rule_manager" class="btn btn-default btn-lg"><i class="fa fa-cogs" aria-hidden="true"></i></i> <span class="network-name">Rule Manager</span></a>
                            </li>
                            <li>
                                <a id="advance" class="btn btn-default btn-lg"><i class="fa fa-cubes" aria-hidden="true"></i> <span class="network-name">Advance</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

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
                    <h2>Contact us</h2>
                </div>
                <div class="col-lg-6">
                    <ul class="list-inline banner-social-buttons">
                        <!-- <li>
                            <a href="https://twitter.com/SBootstrap" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li> -->
                        <li>
                            <a href="mailto:alone908@hotmail.com" class="btn btn-default btn-lg"><i class="fa fa-envelope"></i><span class="">&nbsp;&nbsp;&nbsp;alone908@hotmail.com</span></a>
                        </li>
<!--                        <li>-->
<!--                            <a href="https://github.com/alone908/CardTranscoder" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>-->
<!--                        </li>-->
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
