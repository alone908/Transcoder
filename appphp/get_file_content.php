<?php

$url = $_POST['url'];
$lines = [];

$file = fopen($url,"r");
while(! feof($file))
  {
    $lines[] = fgets($file);
  }
fclose($file);

unset($lines[count($lines)-1]);

echo json_encode( $lines );

?>
