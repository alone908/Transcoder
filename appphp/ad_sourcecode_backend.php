<?php

switch ($_POST['op']) {
  case 'get_zTree_node':

  echo json_encode( file_list(dirname(__DIR__),array()) );

    break;

  case 'get_file_content':

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
    
    break;

  case 'save_file':

  $content = $_POST['content'];
  $url = $_POST['url'];

  $myfile = fopen( $url, "w") or die("Unable to open file!");

  fwrite($myfile, $content);

  fclose($myfile);

  echo json_encode(array('result'=>'good'));

    break;

}

function file_list($dir,$treeNode){

    $entry = [];
    $files = scandir($dir);
    foreach ( $files as $index => $file  ){

      if(is_file($dir .'/'. $file) && !in_array($file,['.','..','.git'])){

        $entry[] = ['name'=>$file,'filetype'=>'file','path'=>$dir .'/'. $file];

      }elseif (is_dir($dir .'/'. $file) && !in_array($file,['.','..','.git'])) {

        $treeNode[] = ['name'=>$file,'open'=>false,'filetype'=>'dir','children'=>[]];
        $enterKey = count($treeNode)-1;
        $returnNode = file_list( $dir.'/'.$file, $treeNode[$enterKey]['children'] );
        $treeNode[$enterKey]['children'] = $returnNode;

      }
    }

    $treeNode = array_merge($treeNode,$entry);

  return $treeNode;
}


 ?>
