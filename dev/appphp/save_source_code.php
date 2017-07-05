<?php

$content = $_POST['content'];
$url = $_POST['url'];

$myfile = fopen( $url, "w") or die("Unable to open file!");

fwrite($myfile, $content);

fclose($myfile);

echo json_encode(array('result'=>'good'));
