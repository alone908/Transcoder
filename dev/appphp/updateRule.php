<?php

require_once 'sqldb.php';

$op = $_POST['op'];
$ruleid = (integer) $_POST['ruleid'];
$data = $_POST['data'];

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));

switch ($op) {
  case 'plus':

    $sql = "SELECT * from TransCodeRule where RuleID > ".(integer) $ruleid." order by RuleID desc";
    $conn->query('SET NAMES UTF8');
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $newRuleID = (integer) $row['RuleID']+1;
        $sql = "UPDATE TransCodeRule SET RuleID=".$newRuleID."
                where RuleID = ".(integer) $row['RuleID'];

        $conn->query('SET NAMES UTF8');
        $conn->query($sql);

      }
    }else {

    }

    $sql = "INSERT INTO TransCodeRule(RuleID,Section,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,Rule,CreateTime)
            VALUES ($ruleid+1,'".$data['Section']."','undefined','undefined','未定義',0,'undefined','undefined','undefined','undefined','".$localTime."')";

    $conn->query('SET NAMES UTF8');
    $conn->query($sql);

    echo json_encode(array('result'=>'good','message'=>'Insert Rule','NewRule'=> $ruleid+1));

    break;

  case 'minus':

    $sql = "DELETE FROM TransCodeRule WHERE RuleID=".$ruleid;

    $conn->query('SET NAMES UTF8');
    $conn->query($sql);

    $sql = "SELECT * from TransCodeRule where RuleID > ".(integer) $ruleid." order by RuleID";
    $conn->query('SET NAMES UTF8');
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

        $newRuleID = (integer) $row['RuleID']-1;
        $sql = "UPDATE TransCodeRule SET RuleID=".$newRuleID."
                where RuleID = ".(integer) $row['RuleID'];

        $conn->query('SET NAMES UTF8');
        $conn->query($sql);

      }
    }else {

    }

    echo json_encode(array('result'=>'good','message'=>'Delete Rule','DeleteRule'=> $ruleid));

    break;

  case 'update':

    $sql = "UPDATE TransCodeRule SET Section='".$data['Section']."',
                   Subject='".$data['Content']."',Content='".$data['Content']."',
                   Exp='".$data['Exp']."',Length=".(integer) $data['Length'].",
                   DataCoding='".$data['DataCoding']."',LSB='".$data['LSB']."',
                   UnixTime='".$data['UnixTime']."',Rule='".$data['Rule']."',
                   CreateTime='".$localTime."' where RuleID = ".$ruleid;

    $conn->query('SET NAMES UTF8');
    $result = $conn->query($sql);

    echo json_encode(array('result'=>'good','message'=>'Update Rule','UpdateRule'=> $ruleid));

    break;

}


 ?>
