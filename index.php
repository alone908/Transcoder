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
    <?php //if($noCover === 'false') require_once 'cover.php' ?>
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
    </div>

		<div class="tabs">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="<?php if($_GET['tab'] === 'form') echo 'active'; ?>"><a href="#form" aria-controls="form" role="tab" data-toggle="tab">FORM</a></li>
				<li role="presentation" class="<?php if($_GET['tab'] === 'text') echo 'active'; ?>"><a href="#text" aria-controls="text" role="tab" data-toggle="tab">TEXT</a></li>
				<li role="presentation" class="<?php if($_GET['tab'] === 'rule') echo 'active'; ?>"><a href="#ruleEditor" aria-controls="ruleEditor" role="tab" data-toggle="tab">Rule Editor</a></li>
				<li role="presentation" class="<?php if($_GET['tab'] === 'log') echo 'active'; ?>"><a href="#log" aria-controls="log" role="tab" data-toggle="tab">LOG</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">

				<div role="tabpanel" id="form" class="tab-pane <?php if($_GET['tab'] === 'form') echo 'active'; ?>" style="margin:10 0 0 0;">
					<div class="checkbox" style="">
						<label><input class="checkContent" type="checkbox" value="" checked>內容</label>
						<label><input class="checktransCode" type="checkbox" value="" checked>轉碼</label>
						<label><input class="checktranscodeRule" type="checkbox" value="" >轉碼規則</label>
					</div>
					<div class="mefTitle">
						<font style="font-weight:bold;">MEF01/MEF03/MEF08/MEF0B</font>
					</div>
					<div class = "dataForm">
					</div>
					<div class = "mefForm">
					</div>
				</div>

        <div role="tabpanel" class="tab-pane <?php if($_GET['tab'] === 'text') echo 'active'; ?>" id="text" style="margin:10 0 0 0;">
					<textarea type="text" class="form-control dataText" style="width:100%;height:650px;">
					</textarea>
				</div>

				<div role="tabpanel" class="tab-pane <?php if($_GET['tab'] === 'rule') echo 'active'; ?>" id="ruleEditor" style="margin:10 0 0 0;">
					<div class = "transCodeEditor">
						<h3 style="margin-top:0px;">轉碼規則編輯器(TranscodeRule Editor)</h3>
						<h5 style="color:red;">(i)支援規則有 : AN,LSB,Decimal,UnixTime. 不同規則請以逗點隔開，ex (LSB,Decimal) 或 (AN,Decimal,UnixTime).</h5>
						<h5 style="color:red;">(ii)順序會有影響，(LSB,Decimal) 和 (Decimal,LSB) 會產生不同結果.</h5>
						<h5 style="color:red;">(iii)點選規則號碼，選新增,刪除,或修改.</h5>
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
					<textarea type="text" class="form-control datalog" style="width:100%;height:650px;">
					</textarea>
				</div>
      </div>

    </div>

  </div>
</body>
</html>
