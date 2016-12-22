<?php

$url = $_POST['url'];
$lines = [];

$file = fopen($url,"r");
while(! feof($file))
  {
    $lines[] = fgets($file);
    if(feof($file)) break;
  }
fclose($file);
print_r($lines);
echo json_encode( $lines );

?>
