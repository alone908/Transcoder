<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 2021-12-13
 * Time: 15:32
 */
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Linda - Separate PDF</title>

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
		<script src="js/global_func_of_proj.js"></script>
		<script src="js/header.js"></script>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="css/jquery.fileupload.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
		      type="text/css">

	</head>

<body>


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
			<a class="navbar-brand topnav" href="index_tools.php">Linda - Separate PDF</a>
		</div>
	</div>
	<!-- /.container -->
</nav>


<!-- Page Content -->
<div class="" style="padding:0px 10px;">

	<?php include_once 'loader_err.php'; ?>

	<div style="margin-top:60px;">
		<ol class="breadcrumb" style="margin-bottom:10px;">
			<li><a href="#">Home</a></li>
			<span id="import-btn" class="btn btn-black import" data-toggle="modal" data-target="#importModal">
				<i class='glyphicon glyphicon-floppy-open'></i>&nbsp;&nbsp;UPLOAD
			</span>
		</ol>
	</div>

	<div id="splitPDF">
		<h3 class="splitInfo" style="display: none;">1. 開始分割PDF頁面到獨立的檔案。 <i class="fa fa-spinner fa-spin"></i></h3>
		<h3 class="parseInfo" style="display: none;">2. 開始解析PDF頁面內容。 <i class="fa fa-spinner fa-spin"></i></h3>
		<h3 class="zipInfo" style="display: none;">3. 開始壓縮PDF檔案。 <i class="fa fa-spinner fa-spin"></i></h3>
		<h3 class="downloadInfo" style="display: none;"><a href="uploadPDF/pdf.zip" target="_blank">下載PDF</a></h3>
	</div>

	<!-- /#wrapper -->

</div>


<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="" style="font-weight:bold;">Upload PDF File</h4>
			</div>
			<div class="modal-body">
				<font style="font-size:14px;font-weight:bold;">Upload File to Server:&nbsp;&nbsp;</font>
				<span class='btn btn-black fileinput-button' style="vertical-align:-2px;">
          <i class='glyphicon glyphicon-floppy-open'></i>
          <span>Upload</span>
          <input id='fileupload' type='file' name='files[]'
								 style='display:block;width:100%;height:100%;cursor:pointer;'>
        </span>
				<br>
				<!-- The global progress bar -->
				<div id='progress' class='progress' style="display:none;">
					<div class='progress-bar progress-bar-success'></div>
				</div>
				<!-- The container for the uploaded files -->
				<div id='files' class='files'></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<!-- Footer -->
<?php include_once 'footer.php'; ?>

<script>
	$(document).ready(function () {

		$('#import-btn').on('click', function(e){
			$('.splitInfo').hide();
			$('.splitInfo .fa').show();
			$('.parseInfo').hide();
			$('.parseInfo .fa').show();
			$('.zipInfo').hide();
			$('.zipInfo .fa').show();
			$('.downloadInfo').hide();
		})

		$('#importModal').on('hidden.bs.modal', function (e) {
			$('.progress').css('display', 'none');
			$('#progress .progress-bar').css('width', '0%');
			$('#files').html('');
		})


		//***** Upload Course ZIP file **********************
		$('#fileupload').fileupload({
			url: 'appphp/separate_pdf_backend.php',
			dataType: 'json',
			formData: {op: 'upload_pdf'},
			autoUpload: true,
			acceptFileTypes: /(\.|\/)(pdf)$/i,
			disableImageResize: false,
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		}).on('fileuploadadd', function (e, data) {

			$('.progress').css('display', 'block');
			data.context = $('<div id="filelist"/>').appendTo('#files');
			$.each(data.files, function (index, file) {
				var node = $('<p/>').append($('<span/>').text('uploading... ' + file.name));
				if (!index) {
					node.append('<br>');
				}
				node.appendTo(data.context);
			});

		}).on('fileuploadprocessalways', function (e, data) {

			var index = data.index,
				file = data.files[index],
				node = $(data.context.children()[index]);

			if (file.error) {
				node.append('<br>')
					.append($('<span class="text-danger"/>').text(file.error));
			}

		}).on('fileuploadprogressall', function (e, data) {

			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css('width', progress + '%');

		}).on('fileuploaddone', function (e, data) {

			setTimeout(function () {
				$('#importModal').modal('hide');
				$('.progress').css('display', 'none');
				$('#progress .progress-bar').css('width', '0%');
				$('#files').html('');
				splitPDF();
			}, 500);

		}).on('fileuploadfail', function (e, data) {

		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');

		//****************************************************************************

	})

	function splitPDF() {
		$.ajax({
			type: 'POST',
			url: "appphp/separate_pdf_backend.php",
			data: {op: 'split_pdf'},
			dataType: "json",
			beforeSend: function(){
				$('.splitInfo').show();
				$('.splitInfo .fa').show();
			},
			success: function (data) {
				$('.splitInfo .fa').hide();
				parsePDF();
			}
		});
	}

	function parsePDF() {
		$.ajax({
			type: 'POST',
			url: "appphp/separate_pdf_backend.php",
			data: {op: 'parse_pdf'},
			dataType: "json",
			beforeSend: function(){
				$('.parseInfo').show();
				$('.parseInfo .fa').show();
			},
			success: function (data) {
				$('.parseInfo .fa').hide();
				zipPDF();
			}
		});
	}

	function zipPDF() {
		$.ajax({
			type: 'POST',
			url: "appphp/separate_pdf_backend.php",
			data: {op: 'zip_pdf'},
			dataType: "json",
			beforeSend: function(){
				$('.zipInfo').show();
				$('.zipInfo .fa').show();
			},
			success: function (data) {
				$('.zipInfo .fa').hide();
				$('.downloadInfo').show();
			}
		});
	}


</script>
