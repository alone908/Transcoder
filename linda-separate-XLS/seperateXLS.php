<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 2022-04-29
 * Time: 14:30
 */

//header('Content-Type: text/html; charset=utf-8');

$file = 'details.csv';
$file_fs = fopen($file, "r");


$content = '';
$customer_name = '';
$file_name = '';
$sep = ",";

//$title = "客戶代號,客戶簡稱,日 期,發票號碼,付款條件代號,付款條件名稱,預計收款日,預計兌現日,INVOICE_NO,L/C_NO,幣別,匯率,應收帳款,營業稅額,未收帳款,未收稅額,本幣應收金額,本幣營業稅額,本幣未收帳款,本幣未收稅額,業務員,結帳單號,憑證號碼,貨款金額,備註,項目,專案代號,專案名稱,原始客戶代號,交易日";


$title = '';

$lineN = 0;
while (!feof($file_fs)) {

	$lineN ++ ;
	$line = fgets($file_fs);

	$columns = explode(',', $line);

	if($lineN == 1) {
		$title = $line;
		continue;
	}

	if($columns[1] !== $customer_name) {



		if ($lineN > 2) {
			echo $content;

			file_put_contents('files/' . $file_name, $content);

			echo '<br><br><br>';
		}


		$customer_name = $columns[1];
		$file_name = $customer_name . '_彙整.xls';

		echo '===============' . $customer_name . '================' . '<br>';
		echo '===============' . $file_name . '================' . '<br>';
		echo $lineN . '<br>';
		echo $line . '<br>';

		$content = '';
		$content .= $title;

		$content .= implode($sep, $columns);

	} else {

		echo $lineN . '<br>';
		echo $line . '<br>';

		$content .= implode($sep, $columns);

	}



}