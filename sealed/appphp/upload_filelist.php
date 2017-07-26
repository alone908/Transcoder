<?php

$path = $_POST['path'];
$folderArray = [];
$fileArray = [];

if (file_exists($path)) {
	$handle = opendir($path);
	while ($file = readdir($handle)) {
		if ($file !== '.' && $file !== '..') {
      $ext = (is_file($path.'/'.$file)) ? pathinfo($file,PATHINFO_EXTENSION) : '';
      if(is_dir($path.'/'.$file)){
				$folderArray[$file] = array("fileName" => $file,"fileType" => "folder","path" => $path.'/'.$file);
			}
			if($ext === 'dat' || $ext === 'DAT'){
				$fileArray[$file] = array("fileName" => $file,"fileType" => "file","path" => $path.'/'.$file);				
			}
		}
	}
}

echo json_encode(array_merge($folderArray,$fileArray));
