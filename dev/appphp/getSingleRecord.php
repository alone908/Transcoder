<?php

require_once 'sqldb.php';

$sql = "select * from DataRecord where id=".(integer) $_POST['recordid'];
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);

if($result->num_rows === 1) {
  while($row = $result->fetch_assoc()) {
    $record = array('id'=>$row['id'],'SourceData'=>$row['SourceData']);
  }
}else {

}

echo json_encode(array('result'=>'good','Record'=>$record));

 ?>
