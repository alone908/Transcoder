<?php
/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 2022-01-04
 * Time: 15:04
 */

require_once 'appphp/sqldb.php';

$file = 'street2_translation.csv';
$file_fs = fopen($file,"r");
$lineN = 0;

while(!feof($file_fs) )
{
	$lineN ++ ;
	$line = fgets($file_fs);

	$parts = explode(',', str_replace('"', '', $line));

	$chinese = trim(substr($line, 0, strpos($line, ',')));
	$english = trim(str_replace('"', '', substr($line, strpos($line, ',') + 1)));

	echo $lineN . ': ' . $chinese . ' ::: ' . $english . '<br>';

	$query = "INSERT INTO `street_translation` (street_chinese, street_chinese_half,street_english) VALUES ('".mysqli_escape_string($conn, $chinese)."','".mysqli_escape_string($conn, convertNumberToHalf($chinese))."','".mysqli_escape_string($conn, $english)."')";

	$conn->query('SET NAMES UTF8');
	$conn->query($query);

	if($conn->error !== '' && $conn->error !== null){
		echo 'Error: ' . $conn->error . '<br>';
	}

	ob_flush();
	flush();

}

function convertNumberToHalf($string){
	// 將數字轉換為半形英數字
	return str_replace(array('０', '１', '２', '３', '４', '５', '６', '７', '８', '９', '零', '一', '二', '三', '四', '五', '六', '七', '八', '九'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $string);

}
