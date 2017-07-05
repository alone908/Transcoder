<!-- Header -->
<?php include_once 'header.php';?>
<?php include_once 'modals.php';?>

<!-- Page Content -->
<div class="" style="padding:0px 10px;">

    <div style="margin-top:60px;">
      <ol class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li class="active">Transcoder</li>
        &nbsp;&nbsp;&nbsp;
        <span id="import-btn" class="btn btn-black import" data-toggle="modal" data-target="#importModal"><i class='glyphicon glyphicon-save'></i>&nbsp;&nbsp;IMPORT</span>
        <span id="record-btn" class="btn btn-black record" data-toggle="modal" data-target="#recordModal"><i class='glyphicon glyphicon-list-alt'></i>&nbsp;&nbsp;RECORDS</button>
        &nbsp;
      </ol>

    </div>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li><a href="#">SOURCE</a></li>
                <li><a href="#">FORM</a></li>
                <li><a href="#">TEXT</a></li>
                <li><a href="#">LOG</a></li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div id="menu-toggle-div">
                <a href="#menu-toggle" id="menu-toggle"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
            </div>
            <div id="page-content">

                    <h1>Simple Sidebar</h1>
                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                    <h1>Simple Sidebar</h1>
                    <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                    <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>                    

            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

</div>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $("#menu-toggle-div").toggleClass("toggled");
    });

    $(document).ready(function(){
      var wrapperHeight = $(document).innerHeight()-225;
      $('#wrapper').css('height',wrapperHeight.toString()+'px');
    })
</script>

<!-- Footer -->
<?php include_once 'footer.php';?>
