<?php

$file = $_POST['path'];

$sourceData = bin2hex(file_get_contents( $file ));

echo json_encode( array('sourceData'=>$sourceData) );
