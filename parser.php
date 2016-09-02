<html>
<head>
	<meta charset=utf-8>
	<title>陳嘟嘟作弊神器</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/parser.css" rel="stylesheet">

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-editable.js"></script>
	<script src="js/parser.js"></script>

</head>

<body>

	<?php	require_once 'TranscodeRule.php';	?>
	<?php	if( !isset($_GET['tab']) ) $_GET['tab'] = 'form';	?>

	<script>var TranscodeRule = <?php echo $transcodeRuleJSON; ?></script>

  <div class="container">

		<?php	require_once 'parserModal.php';	?>

		<h1 style="display:inline-block; font-weight:700;">陳嘟嘟作弊神器</h1>

		<button type="button" class="btn btn-info start" style="vertical-align:6px;">Start</button>

		<div class="checkbox" style="display:inline-block; vertical-align:6px;">
      <label>
        <input class="checkContent" type="checkbox" value="" checked>內容
      </label>
			<label>
				<input class="transCode" type="checkbox" value="" checked>轉碼
			</label>
			<label>
				<input class="transcodeRule" type="checkbox" value="" >轉碼規則
			</label>
    </div>

    <button type="button" class="btn btn-info clear" style="vertical-align:6px;">Clear</button>

		<button type="button" class="btn btn-info record" style="vertical-align:6px;" data-toggle="modal" data-target="#myModal">
		  Load Record
		</button>

		<br>

    <div style="display:inline-block; width:25%; margin:-3 0 0 0;">
			<h3>Data Source</h3>
      <textarea type="text" class="form-control originalDATA" style="width:100%; height:800px;">
      </textarea>
    </div>

		<div class="tabs">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#form" aria-controls="form" role="tab" data-toggle="tab">FORM</a></li>
				<li role="presentation"><a href="#text" aria-controls="text" role="tab" data-toggle="tab">TEXT</a></li>
				<li role="presentation"><a href="#ruleEditor" aria-controls="ruleEditor" role="tab" data-toggle="tab">Rule Editor</a></li>
				<li role="presentation"><a href="#log" aria-controls="log" role="tab" data-toggle="tab">LOG</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">

				<div role="tabpanel" id="form" class="tab-pane <?php if($_GET['tab'] === 'form') echo 'active'; ?>" style="margin:10 0 0 0;">
					<div class = "dataForm">
					</div>
				</div>

        <div role="tabpanel" class="tab-pane <?php if($_GET['tab'] === 'text') echo 'active'; ?>" id="text" style="margin:10 0 0 0;">
					<textarea type="text" class="form-control dataText" style="width:100%;height:800px;">
					</textarea>
				</div>

				<div role="tabpanel" class="tab-pane <?php if($_GET['tab'] === 'rule') echo 'active'; ?>" id="ruleEditor" style="margin:10 0 0 0;">
					<div class = "transCodeEditor" style="font-family:font-family: ‘Noto Sans TC’, sans-serif;font-weight:400;">
						<h3 style="margin-top:0px;">轉碼規則編輯器(TranscodeRule Editor)</h3>
						<h5 style="color:red;">(i)修改規則將影響轉碼結果，請小心使用.</h5>
						<h5 style="color:red;">(ii)順序會有影響，(LSB,Decimal) 和 (Decimal,LSB) 會產生不同結果.</h5>
						<h5 style="color:red;">(iii)不同規則請以逗點隔開，ex (LSB,Decimal) 或 (AN,Decimal,UnixTime).</h5>
						<h5 style="color:red;">(iv)支援規則有 : AN,LSB,Decimal,UnixTime.</h5>
						<h5 style="color:red;">(v)點選規則號碼，選新增,刪除,或修改.</h5>
						<div class="rules">

							<table class="table table-hover">
								<tr>
									<th>#</th>
									<th>Section</th>
									<th>Content</th>
									<th>Exp</th>
									<th style="width:6%;">Length</th>
									<th style="width:8.5%;">DataCoding</th>
									<th style="width:6%;">LSB</th>
									<th style="width:6%;">UnixTime</th>
									<th>Rule</th>
									<th style="width:135px;">CreateTime</th>
								</tr>
								<?php
								$sql = "select * from TransCodeRule order by RuleID";
								$conn->query('SET NAMES UTF8');
								$result = $conn->query($sql);

								if($result->num_rows > 0) {
									while($row = $result->fetch_assoc()) {
                    if($row['Subject'] !== 'Blank1' && $row['Subject'] !== 'Blank2' &&
										   $row['Subject'] !== 'Blank3' && $row['Subject'] !== 'HeadTitle' &&
										   $row['Subject'] !== 'BodyTitle'){

												 echo '<tr>
												 <td class="td RuleID" data-ruleid="'.$row['RuleID'].'">'.(integer) $row['RuleID'].'</td>
												 <td class="td rule'.$row['RuleID'].'" data-type="Section">'.$row['Section'].'</td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['Content'].'" data-type="Content"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['Exp'].'" data-type="Exp"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['Length'].'" data-type="Length"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['DataCoding'].'" data-type="DataCoding"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['LSB'].'" data-type="LSB"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['UnixTime'].'" data-type="UnixTime"></input></td>
												 <td class="td"><input class="rule'.$row['RuleID'].'" type="text" value="'.$row['Rule'].'" data-type="Rule"></input></td>
												 <td class="td rule'.$row['RuleID'].'" style="width:135px; font-size:12px; padding:2px;" data-type="CreateTime">'.$row['CreateTime'].'</td>
												 </tr>';
										}
									}
								}else {

								}
								?>
              </table>

						</div>
					</div>
				</div>

				<div role="tabpanel" class="tab-pane <?php if($_GET['tab'] === 'log') echo 'active'; ?>" id="log" style="margin:10 0 0 0;">
					<textarea type="text" class="form-control datalog" style="width:100%;height:800px;">
					</textarea>
				</div>
      </div>

    </div>

  </div>
</body>
</html>
