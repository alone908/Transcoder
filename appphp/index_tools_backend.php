<?php
/*/**
 * Created by PhpStorm.
 * User: Chung
 * Date: 2021-12-13
 * Time: 15:48
 */

require_once 'sqldb.php';
require_once 'UploadHandler.php';

switch ($_POST['op']) {

	case 'upload_pdf':

		$pdfDir = __DIR__ . '/../uploadPDF/';
		if (!is_dir($pdfDir)) mkdir($pdfDir, 0777);
		if (is_file($pdfDir . '/pdf.pdf')) {
			unlink($pdfDir . '/pdf.pdf');
		}

		$_FILES['files']['name'][0] = 'pdf.pdf';
		$upload_handler = new UploadHandler(array('upload_dir' => '../uploadPDF/'));

		echo json_encode($upload_handler->response);

		break;

	case 'upload_txt':

		$txtDir = __DIR__ . '/../uploadPDF/';
		if (!is_dir($txtDir)) mkdir($txtDir, 0777);
		if (is_file($txtDir . '/pdf.txt')) {
			unlink($txtDir . '/pdf.txt');
		}

		$_FILES['files']['name'][0] = 'pdf.txt';
		$upload_handler = new UploadHandler(array('upload_dir' => '../uploadPDF/'));

		file_put_contents($txtDir . '/pdf.txt', str_replace("\r\n", "\n", file_get_contents($txtDir . '/pdf.txt')));

		echo json_encode($upload_handler->response);

		break;

	case 'split_pdf':

		$pdf_folder = __DIR__ . '/../uploadPDF';
		$result = shell_exec('pdfseparate ' . $pdf_folder . '/pdf.pdf ' . $pdf_folder . '/pdf-%d.pdf');

		echo json_encode(array('done' => true));

		break;

	case 'parse_pdf':

		$pdf_folder = __DIR__ . '/../uploadPDF';

		// Pare pdf content text file and rename pdf files. ------------------------------
		$page = 0;
		$company_n = '';
		$new_file_name = '';

		$file = $pdf_folder . '/pdf.txt';
		$file_fs = fopen($file, "r");
		while (!feof($file_fs)) {

			$line = fgets($file_fs);
			if (trim($line) === '') continue;

			if (strpos($line, '電子發票證明聯') !== false) {
				$page++;
			}

			// Get company number
			if (strpos($line, '統一編號') !== false && $company_n === '') {
				preg_match_all('/([0-9]*?)第/m', $line, $matches, PREG_SET_ORDER, 0);
				$company_n = $matches[0][1];
			}

			// Get Date and Product.
			if (strpos($line, '品名數量單價金額備註') !== false) {
				$line = fgets($file_fs);
				$date = substr($line, 0, 6);
				$month = substr($date, 4);
				$product_name = preg_replace('/[0-9]|,/', '', $line);
				$product_name = trim($product_name);
				$product_name = trim($product_name, '-');
				$product_name = preg_replace('/\s/', '-', $product_name);
				$check_point_2 = true;

				if (strpos($product_name, '行銷費') !== false) {
					$new_file_name = $month . '月份_累點發票_' . $company_n;
				} else if (strpos($product_name, '行銷獎勵回饋') !== false) {
					$new_file_name = $month . '月份_兌點手續費發票_' . $company_n;
				} else {
					$new_file_name = $product_name . '_' . $page;
				}

			}

			// The end of page.
			if (strpos($line, '') !== false) {

				if (is_file($pdf_folder . '/pdf-' . $page . '.pdf')) {
					rename($pdf_folder . '/pdf-' . $page . '.pdf', $pdf_folder . '/' . $new_file_name . '.pdf');
				}

				$company_n = '';
				$new_file_name = '';

			}

		}
		fclose($file_fs);

		unlink($pdf_folder . '/pdf.pdf');
		unlink($pdf_folder . '/pdf.txt');

		echo json_encode(array('done' => true));

		break;

	case 'parse_pdf_old':

		$pdf_folder = __DIR__ . '/../uploadPDF';

		// Get PDF Contents to the text file. --------------------------------------------
		$src_fs = opendir($pdf_folder);
		while ($entryname = readdir($src_fs)) {
			$file = "${pdf_folder}/${entryname}";
			if (is_file($file) and ($entryname != "." and $entryname != "..")) {
				$file_name = pathinfo($file, PATHINFO_FILENAME);
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);
				$text_file = $pdf_folder . '/' . $file_name . '-target.txt';
				if (strpos($file_name, 'pdf-') === 0 && $file_ext === 'pdf') {
					$result = shell_exec('pdftotext -layout ' . $file . ' ' . $text_file);
				}
			}
		}
		closedir($src_fs);


		// Pare pdf content text file and rename pdf files. ------------------------------
		$src_fs = opendir($pdf_folder);
		while ($entryname = readdir($src_fs)) {
			$file = "${pdf_folder}/${entryname}";
			if (is_file($file) and ($entryname != "." and $entryname != "..")) {

				$file_name = pathinfo($file, PATHINFO_FILENAME);
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);

				if (strpos($file_name, 'pdf-') === 0 && $file_ext === 'txt') {

					$pdf_file_name = substr($file_name, 0, strpos($file_name, '-target'));
					$product_page = substr($pdf_file_name, 4);

					$new_pdf_names = array();
					$getMonPro = false;
					$company_n = '';

					$file_fs = fopen($file, "r");
					while (!feof($file_fs)) {

						$line = fgets($file_fs);
						if (trim($line) === '') continue;

						if ($getMonPro) {
							$date = substr($line, 0, 6);
							$month = substr($date, 4);
							$product_name = preg_replace('/[0-9]|,/', '', $line);
							$product_name = trim($product_name);
							$product_name = trim($product_name, '-');
							$product_name = preg_replace('/\s/', '-', $product_name);
						}

						if (strpos($line, '統一編號') !== false && $company_n === '') {
							preg_match_all('/統一編號：([0-9]*)\s/m', $line, $matches, PREG_SET_ORDER, 0);
							$company_n = $matches[0][1];
						}

						if (strpos($line, '品名') !== false) {
							$getMonPro = true;
						} else {
							$getMonPro = false;
						}

					}

					$new_file_name = '';

					if (strpos($product_name, '行銷費') !== false) {
						$new_file_name = $month . '月份_累點發票_' . $company_n;
					} else if (strpos($product_name, '行銷獎勵回饋') !== false) {
						$new_file_name = $month . '月份_兌點手續費發票_' . $company_n;
					} else {
						$new_file_name = $product_name . '_' . $product_page;
					}

					if (in_array($new_file_name, $new_pdf_names)) {
						$new_file_name = $new_file_name . '_' . getNameNumber($new_file_name, $new_pdf_names);
					}

					$new_pdf_names[] = $new_file_name;
					rename($pdf_folder . '/' . $pdf_file_name . '.pdf', $pdf_folder . '/' . $new_file_name . '.pdf');
					fclose($file_fs);
					unlink($file);

				}

			}

		}
		unlink($pdf_folder . '/pdf.pdf');

		echo json_encode(array('done' => true));

		break;

	case 'zip_pdf':

		$pdf_folder = __DIR__ . '/../uploadPDF';
		if (is_file($pdf_folder . '/pdf.zip')) unlink($pdf_folder . '/pdf.zip');
		HZip::zipDir($pdf_folder, $pdf_folder . '/pdf.zip');

		// Remove single pdfs.
		$src_fs = opendir($pdf_folder);
		while ($entryname = readdir($src_fs)) {
			$file = "${pdf_folder}/${entryname}";
			if (is_file($file) and ($entryname != "." and $entryname != "..")) {
				$file_ext = pathinfo($file, PATHINFO_EXTENSION);
				if ($file_ext === 'pdf') {
					unlink($file);
				}
			}
		}
		closedir($src_fs);

		echo json_encode(array('done' => true));

		break;

	case 'translate_address':

		$address = convertNumberToHalf(trim($_POST['address']));
		$new_address = 'Taiwan (R.O.C.)';

		// Find City.
		$isFind = false;
		$target = $address;
		while (!$isFind && strlen($target) > 0) {
			$sql = "select * from city_translation where city_chinese='" . $target . "' limit 1;";
			$conn->query('SET NAMES UTF8');
			if ($result = $conn->query($sql)) {
				if ($result->num_rows === 1) {
					$row = $result->fetch_assoc();
					$mail_code = $row['mail_code'];
					$city_chinese = trim($row['city_chinese']);
					$city_english = trim($row['city_english']);
					$address = str_replace($city_chinese, '', $address);
					$new_address = $city_english . ' ' . $mail_code . ', ' . $new_address;
					$isFind = true;
				} else {
					// Try one character shorter again.
					$target = substr($target, 0, strlen($target) - 1);
				}
			};
		}

		// Find Street.
		$isFind = false;
		$target = $address;
		while (!$isFind && strlen($target) > 0) {
			$sql = "select * from street_translation where street_chinese_half='" . $target . "' limit 1;";
			$conn->query('SET NAMES UTF8');
			if ($result = $conn->query($sql)) {
				if ($result->num_rows === 1) {
					$row = $result->fetch_assoc();
					$street_chinese = trim($row['street_chinese_half']);
					$street_english = trim($row['street_english']);
					$address = str_replace($street_chinese, '', $address);
					$new_address = $street_english . ', ' . $new_address;
					$isFind = true;
				} else {
					// Try one character shorter again.
					$target = substr($target, 0, strlen($target) - 1);
				}
			};
		}


		// Find 幾巷.
		$re = '/([0-9]*?)巷/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?巷/m', '', $address);
			$new_address = 'Ln. ' . $matches[0][1] . ', ' . $new_address;
		}


		// Find 幾之幾號 first.
		$re = '/([0-9]*?)之([0-9]*?)號/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?之[0-9]*?號/m', '', $address);
			$new_address = 'No. ' . $matches[0][1] . '-' . $matches[0][2] . ', ' . $new_address;
		}

		// Find 幾號之幾 second.
		$re = '/([0-9]*?)號之([0-9]*)/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?號之[0-9]*/m', '', $address);
			$new_address = 'No. ' . $matches[0][1] . '-' . $matches[0][2] . ', ' . $new_address;
		}


		// Find 幾號.
		$re = '/([0-9]*?)號/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?號/m', '', $address);
			$new_address = 'No. ' . $matches[0][1] . ', ' . $new_address;
		}


		// Find 幾樓之幾 first.
		$re = '/([0-9]*?)樓之([0-9]*)/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?樓之[0-9]*/m', '', $address);
			$new_address = $matches[0][1] . 'F-' . $matches[0][2] . ', ' . $new_address;
		}


		// Find 幾樓.
		$re = '/([0-9]*?)樓/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?樓/m', '', $address);
			$new_address = $matches[0][1] . 'F, ' . $new_address;
		}


		// Find 幾室.
		$re = '/([0-9]*?)室/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if (count($matches) > 0) {
			$address = preg_replace('/[0-9]*?室/m', '', $address);
			$new_address = 'Rm. ' . $matches[0][1] . ', ' . $new_address;
		}

		$address = trim($address);

		echo json_encode(array('new_address' => $new_address, 'address' => $address));

		break;

}

function convertNumberToHalf($string)
{
	// 將數字轉換為半形英數字
	return str_replace(array('０', '１', '２', '３', '４', '５', '６', '７', '８', '９', '零', '一', '二', '三', '四', '五', '六', '七', '八', '九'), array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), $string);

}

function insertAddressTable()
{

	global $conn;

	$file = 'street_translation.csv';
	$file_fs = fopen($file, "r");
	$lineN = 0;

	while (!feof($file_fs)) {
		$lineN++;
		$line = fgets($file_fs);

		$parts = explode(',', str_replace('"', '', $line));

		$chinese = trim(substr($line, 0, strpos($line, ',')));
		$english = trim(str_replace('"', '', substr($line, strpos($line, ',') + 1)));

		echo $lineN . ': ' . $chinese . ' ::: ' . $english . '<br>';

		$query = "INSERT INTO `street_translation` (street_chinese, street_chinese_half,street_english) VALUES ('" . mysqli_escape_string($conn, $chinese) . "','" . mysqli_escape_string($conn, convertNumberToHalf($chinese)) . "','" . mysqli_escape_string($conn, $english) . "')";

		$conn->query('SET NAMES UTF8');
		$conn->query($query);

		if ($conn->error !== '' && $conn->error !== null) {
			echo 'Error: ' . $conn->error . '<br>';
		}

		ob_flush();
		flush();

	}

}

function deldir($dir)
{
	$current_dir = opendir($dir);
	while ($entryname = readdir($current_dir)) {
		if (is_dir("$dir/$entryname") and ($entryname != "." and $entryname != "..")) {
			deldir("${dir}/${entryname}");
		} elseif ($entryname != "." and $entryname != "..") {
			unlink("${dir}/${entryname}");
		}
	}
	closedir($current_dir);
	rmdir($dir);
}

function getNameNumber($name, $names)
{
	$count = 1;
	foreach ($names as $key => $name_cache) {
		if (strpos($name_cache, $name) !== false) $count++;
	}
	return '(' . $count . ')';
}

class HZip
{

	private static function folderToZip($folder, &$zipFile, $exclusiveLength)
	{
		$handle = opendir($folder);
		while (false !== $f = readdir($handle)) {
			if ($f != '.' && $f != '..') {
				$filePath = "$folder/$f";
				$localPath = substr($filePath, $exclusiveLength + 1);
				if (is_file($filePath)) {
					$zipFile->addFile($filePath, $localPath);
				} elseif (is_dir($filePath)) {
					$zipFile->addEmptyDir($localPath);
					self::folderToZip($filePath, $zipFile, $exclusiveLength);
				}
			}
		}
		closedir($handle);
	}

	public static function zipDir($sourcePath, $outZipPath)
	{
		$pathInfo = pathInfo($sourcePath);
		$z = new ZipArchive();
		$z->open($outZipPath, ZIPARCHIVE::CREATE);
		self::folderToZip($sourcePath, $z, strlen($sourcePath));
		$z->close();
	}

}