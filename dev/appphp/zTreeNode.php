<?php

echo json_encode( file_list(dirname(__DIR__),array()) );

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
