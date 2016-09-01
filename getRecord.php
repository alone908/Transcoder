<?php

require_once 'sqldb.php';

$sql = "select * from DataRecord order by id desc LIMIT 50";
$conn->query('SET NAMES UTF8');
$result = $conn->query($sql);

$records = [];

if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $sourceData = substr($row['SourceData'],0,15).'.....';
    $records[] = array('id'=>$row['id'],'SourceData'=>$sourceData,'TimeStamp'=>$row['TaiwanTime']);
  }
}else {

}

echo json_encode(array('result'=>'good','Records'=>$records));

?>
