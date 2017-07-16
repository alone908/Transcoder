<?php

include_once 'UploadHandler.php';

$upload_handler = new UploadHandler(array('upload_dir' => '../uploadfiles/'));

$upload_handler->response['files']['0']->content =
bin2hex(file_get_contents('../uploadfiles/'.$upload_handler->response['files']['0']->name));

echo json_encode( $upload_handler->response );
