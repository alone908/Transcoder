<?php
/**
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
		deldir($pdfDir);
		if(!is_dir($pdfDir)) mkdir($pdfDir, 0777);

		$_FILES['files']['name'][0] = 'pdf.pdf';
		$upload_handler = new UploadHandler(array('upload_dir' => '../uploadPDF/'));

		echo json_encode( $upload_handler->response );

		break;

	case 'split_pdf':

		$pdf_folder = __DIR__ . '/../uploadPDF';
		$result = shell_exec('pdfseparate ' . $pdf_folder . '/pdf.pdf ' . $pdf_folder . '/pdf-%d.pdf');

		echo json_encode(array('done' => true));

		break;

	case 'parse_pdf':

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

					$file_fs = fopen($file,"r");
					while(! feof($file_fs) )
					{

						$line = fgets($file_fs);
						if(trim($line) === '') continue;

						if($getMonPro) {
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

						if(strpos($line, '品名') !== false){
							$getMonPro = true;
						} else{
							$getMonPro = false;
						}

					}

					$new_file_name = '';

					if (strpos($product_name, '行銷費') !== false) {
						$new_file_name = $month . '月份_累點發票_' . $company_n ;
					} else if (strpos($product_name, '行銷獎勵回饋') !== false) {
						$new_file_name = $month . '月份_兌點手續費發票_' . $company_n ;
					} else {
						$new_file_name = $product_name . '_' . $product_page;
					}

					if(in_array($new_file_name, $new_pdf_names)){
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

		$address = $_POST['address'];
		$new_address = '';

		// Find City.
		$sql = "select * from city_translation order by city_english desc";
		$conn->query('SET NAMES UTF8');
		$result = $conn->query($sql);

		while ($row = $result->fetch_assoc()) {
			$mail_code = $row['mail_code'];
			$city_chinese = trim($row['city_chinese']);
			$city_english = trim($row['city_english']);
			if (strpos($address, $city_chinese) !== false) {
				$address = str_replace($city_chinese, '', $address);
				$new_address .= $city_english . ', ' . $mail_code;
				break;
			}
		}


		// Find City.
		$sql = "select * from street_translation order by street_english desc;";
		$conn->query('SET NAMES UTF8');
		$result = $conn->query($sql);

		while ($row = $result->fetch_assoc()) {

			$street_chinese = trim($row['street_chinese']);
			$street_english = trim($row['street_english']);
			if (strpos($address, $street_chinese) !== false) {
				$address = str_replace($street_chinese, '', $address);
				$new_address = $street_english . ', ' . $new_address;
				break;
			}
		}

		// Find 幾號.
		$re = '/([0-9]*?)號/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if(count($matches) > 0){
			$address =  preg_replace('/[0-9]*?號/m', '', $address);
			$new_address = 'No. ' . $matches[0][1] . ', ' .$new_address;
		}


		// Find 幾樓之幾 first.
		$re = '/([0-9]*?)樓之([0-9]*)/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if(count($matches) > 0){
			$address =  preg_replace('/[0-9]*?樓之[0-9]*/m', '', $address);
			$new_address = $matches[0][1] . 'F-' . $matches[0][2] . ', ' .$new_address;
		}


		// Find 幾樓.
		$re = '/([0-9]*?)樓/m';
		preg_match_all($re, $address, $matches, PREG_SET_ORDER, 0);
		if(count($matches) > 0){
			$address =  str_replace('/[0-9]*?樓/m', '', $address);
			$new_address = $matches[0][1] . 'F, ' .$new_address;
		}

		$address = trim($address);

		echo json_encode(array('new_address' => $new_address, 'address' => $address));

		break;

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
	foreach ($names as $key => $name_cache){
		if(strpos($name_cache, $name) !== false) $count ++ ;
	}
	return '(' . $count . ')';
}

class HZip {

	private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
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

	public static function zipDir($sourcePath, $outZipPath) {
		$pathInfo = pathInfo($sourcePath);
		$z = new ZipArchive();
		$z->open($outZipPath, ZIPARCHIVE::CREATE);
		self::folderToZip($sourcePath, $z, strlen($sourcePath));
		$z->close();
	}

}