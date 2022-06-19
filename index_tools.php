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

	<title>Linda - Tools</title>

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
			<a class="navbar-brand topnav" href="index_tools.php">Linda - Tools</a>
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
			<!--			<span id="import-btn" class="btn btn-black import" data-toggle="modal" data-target="#importModal">-->
			<!--				<i class='glyphicon glyphicon-floppy-open'></i>&nbsp;&nbsp;上傳分割 PDF 檔-->
			<!--			</span>-->
			<span id="import-btn2" class="btn btn-black import" data-toggle="modal" data-target="#importModal2">
				<i class='glyphicon glyphicon-floppy-open'></i>&nbsp;&nbsp;分割 PDF 檔案
			</span>
		</ol>
	</div>

	<div class="row">

		<div class="col-6 col-sm-6 col-md-6 col-lg-6">

			<div id="addressTranslation">
				<div class="form-group">
					<label for="chineseAddress" style="font-size: 16px; font-weight: bold;">翻譯中文地址</label>
					<input type="text" class="form-control" id="chineseAddress" placeholder="">
					<span class="help-block">1. 地址前<span style="color: red;">不要加郵遞區號</span>。例如: <span
							style="color: red;">260</span>宜蘭縣宜蘭市健康路三段</span>
					<span class="help-block">2. 若是有<span style="color: red;">沒翻譯的路段</span>，表示可能資料庫中無資料。</span>
					<span class="help-block">3. <span style="color: red;">免責聲明: </span>翻譯結果僅供參考，東西寄丟不負責。</span>
				</div>
				<button id="addressSubmitBtn" type="button" class="btn btn-default">翻譯</button>

				<br>
				<span id="addressResult" class="text-primary" style="font-size: 16px;"></span>
				<br>
				<span id="unTranslate" class="text-primary" style="font-size: 16px;"></span>
			</div>

		</div>

		<div class="col-6 col-sm-6 col-md-6 col-lg-6">

			<div id="splitPDF">
				<h3 class="splitInfo" style="display: none;">1. 開始分割PDF。 <i class="fa fa-spinner fa-spin"></i></h3>
				<h3 class="parseInfo" style="display: none;">2. 開始分析PDF內容並且命名檔案。 <i class="fa fa-spinner fa-spin"></i></h3>
				<h3 class="zipInfo" style="display: none;">3. 開始壓縮PDF檔案。 <i class="fa fa-spinner fa-spin"></i></h3>
				<h3 class="downloadInfo" style="display: none;"><a href="uploadPDF/pdf.zip" target="_blank">下載PDF</a></h3>
			</div>

		</div>
	</div>
</div>


<!-- Import Modal -->
<div class="modal fade" id="importModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="" style="font-weight:bold;">分割PDF檔案</h4>
			</div>
			<div class="modal-body">
				<span style="font-size:14px;font-weight:bold;">上傳檔案:&nbsp;&nbsp;</span>

				<span id="pdf-upload-btn" class='btn btn-black fileinput-button' style="vertical-align:-2px;">
          <i class='glyphicon glyphicon-floppy-open'></i>
          <span>上傳PDF</span>
          <input class='fileupload' type='file' name='files[]' accept=".pdf"
                 style='display:block;width:100%;height:100%;cursor:pointer;'>
        </span>
				<span id="txt-upload-btn" class='btn btn-black fileinput-button' style="vertical-align:-2px;">
          <i class='glyphicon glyphicon-floppy-open'></i>
          <span>上傳TXT</span>
					<input class='fileupload' type='file' name='files[]' accept=".txt"
					       style='display:block;width:100%;height:100%;cursor:pointer;'>
        </span>

				<br><br>

				<!-- The container for the uploaded files -->
				<div id="pdf-file">
					<span class="file"></span><br>
					<div class="progress" style="display:none;">
						<div class="progress-bar progress-bar-success"></div>
					</div>
				</div>

				<br>

				<!-- The container for the uploaded files -->
				<div id="txt-file">
					<span class="file"></span><br>
					<div class="progress" style="display:none;">
						<div class="progress-bar progress-bar-success"></div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button id="start-upload" type="button" class="btn btn-default">開始上傳</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
			</div>
		</div>
	</div>
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

	var task = '';

	$(document).ready(function () {

		$('#import-btn').on('click', function (e) {
			$('.splitInfo').hide();
			$('.splitInfo .fa').show();
			$('.parseInfo').hide();
			$('.parseInfo .fa').show();
			$('.zipInfo').hide();
			$('.zipInfo .fa').show();
			$('.downloadInfo').hide();
		});

		$('#importModal').on('hidden.bs.modal', function (e) {
			$('.progress').css('display', 'none');
			$('#progress .progress-bar').css('width', '0%');
			$('#files').html('');
		});

		$('#import-btn2').on('click', function (e) {
			$('.splitInfo').hide();
			$('.splitInfo .fa').show();
			$('.parseInfo').hide();
			$('.parseInfo .fa').show();
			$('.zipInfo').hide();
			$('.zipInfo .fa').show();
			$('.downloadInfo').hide();
		})

		$('#importModal2').on('hidden.bs.modal', function (e) {
			$('#importModal2 .progress').css('display', 'none');
			$('#importModal2 .progress .progress-bar').css('width', '0%');
			$('#pdf-file .file').html('');
			$('#txt-file .file').html('');
		})


		//***** Upload PDF file **********************
		var uploadDone = {pdf: false, txt: false};
		var uploadTimer = null;
		var pdfUpload = null;
		var txtUpload = null;

		$('#start-upload').click(function (e) {
			if (pdfUpload !== null && txtUpload !== null) {
				setUploadTimer();
				task = 'linda-split';
				pdfUpload.submit();
				txtUpload.submit();
			} else if (pdfUpload !== null && txtUpload === null) {
				setUploadTimer();
				task = 'max-split';
				pdfUpload.submit();
			}
		});

		function setUploadTimer() {
			uploadTimer = window.setInterval(function () {
				if ((task === 'linda-split' && uploadDone.pdf && uploadDone.txt) || (task === 'max-split' && uploadDone.pdf)) {
					$('#importModal2').modal('hide');
					$('#importModal2 .progress').css('display', 'none');
					$('#importModal2 .progress .progress-bar').css('width', '0%');
					$('#importModal2 .file').html('');
					clearInterval(uploadTimer);
					uploadDone = {pdf: false, txt: false};
					uploadTimer = null;
					pdfUpload = null;
					txtUpload = null;
					splitPDF();
				}
			}, 500);
		}

		$('#pdf-upload-btn').fileupload({
			url: 'appphp/index_tools_backend.php',
			dataType: 'json',
			formData: {op: 'upload_pdf'},
			autoUpload: false,
			acceptFileTypes: /(\.|\/)(pdf)$/i,
			disableImageResize: false,
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		}).on('fileuploadadd', function (e, data) {

			$('#pdf-file .progress').css('display', 'block');
			$.each(data.files, function (index, file) {
				$('#pdf-file .file').html(file.name);
			});

			pdfUpload = data;

		}).on('fileuploadprocessalways', function (e, data) {

		}).on('fileuploadprogressall', function (e, data) {

			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#pdf-file .progress .progress-bar').css('width', progress + '%');

		}).on('fileuploaddone', function (e, data) {

			uploadDone.pdf = true;

		}).on('fileuploadfail', function (e, data) {

		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');


		$('#txt-upload-btn').fileupload({
			url: 'appphp/index_tools_backend.php',
			dataType: 'json',
			formData: {op: 'upload_txt'},
			autoUpload: false,
			acceptFileTypes: /(\.|\/)(txt)$/i,
			disableImageResize: false,
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		}).on('fileuploadadd', function (e, data) {

			$('#txt-file .progress').css('display', 'block');
			$.each(data.files, function (index, file) {
				$('#txt-file .file').html(file.name);
			});

			txtUpload = data;

		}).on('fileuploadprocessalways', function (e, data) {

		}).on('fileuploadprogressall', function (e, data) {

			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#txt-file .progress .progress-bar').css('width', progress + '%');

		}).on('fileuploaddone', function (e, data) {

			uploadDone.txt = true;

		}).on('fileuploadfail', function (e, data) {

		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');

		//****************************************************************************


		//***** Upload PDF file **********************
		$('#importModal #fileupload').fileupload({
			url: 'appphp/index_tools_backend.php',
			dataType: 'json',
			formData: {op: 'upload_pdf'},
			autoUpload: true,
			acceptFileTypes: /(\.|\/)(pdf)$/i,
			disableImageResize: false,
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		}).on('fileuploadadd', function (e, data) {

			$('#importModal .progress').css('display', 'block');

		}).on('fileuploadprocessalways', function (e, data) {

		}).on('fileuploadprogressall', function (e, data) {

			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#importModal #progress .progress-bar').css('width', progress + '%');

		}).on('fileuploaddone', function (e, data) {

			setTimeout(function () {
				$('#importModal').modal('hide');
				$('#importModal .progress').css('display', 'none');
				$('#importModal #progress .progress-bar').css('width', '0%');
				$('#importModal #files').html('');
				splitPDF();
			}, 500);

		}).on('fileuploadfail', function (e, data) {

		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');

		//****************************************************************************

		$('#addressSubmitBtn').on('click', function (e) {
			translateAddress();
		});

		$('#chineseAddress').on('keyup', function (e) {
			if (e.keyCode === 13) {
				translateAddress();
			}
		})

	})

	function translateAddress() {
		$.ajax({
			type: 'POST',
			url: "appphp/index_tools_backend.php",
			data: {op: 'translate_address', address: $('#chineseAddress').val()},
			dataType: "json",
			beforeSend: function () {
				$('#addressResult').html('');
				$('#unTranslate').html('');
			},
			success: function (data) {
				$('#addressResult').html(data.new_address);
				$('#unTranslate').html('<span class="text-danger">未翻譯的部分:</span> ' + data.address);
			}
		});
	}

	function splitPDF() {
		$.ajax({
			type: 'POST',
			url: "appphp/index_tools_backend.php",
			data: {op: 'split_pdf'},
			dataType: "json",
			beforeSend: function () {
				$('.splitInfo').show();
				$('.splitInfo .fa').show();
			},
			success: function (data) {
				$('.splitInfo .fa').hide();
				if (task === 'linda-split') {
					parsePDF();
				} else if (task === 'max-split') {
					zipPDF();
				}
			}
		});
	}

	function parsePDF() {
		$.ajax({
			type: 'POST',
			url: "appphp/index_tools_backend.php",
			data: {op: 'parse_pdf'},
			dataType: "json",
			beforeSend: function () {
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
			url: "appphp/index_tools_backend.php",
			data: {op: 'zip_pdf'},
			dataType: "json",
			beforeSend: function () {
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
