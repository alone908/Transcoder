<?php

require_once '../appphp/sqldb.php';

date_default_timezone_set("Asia/Taipei");
$localTime = str_replace(',','',(string) date(DATE_RFC850));

$json_string = '{"mef03_0":{"Content":"mef03_0","Exp":"卡片交易狀態資料","length":0,"dataCoding":"undefined","LSB":"false","UnixTime":"false","Rule":["Blank"]},"mef03_1":{"Content":"mef03_1","Exp":"卡片交易序號","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_2":{"Content":"mef03_2","Exp":"交易紀錄指標","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_3":{"Content":"mef03_3","Exp":"優惠積點數","length":4,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_4":{"Content":"mef03_4","Exp":"優惠積點交易序號","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_5":{"Content":"mef03_5","Exp":"鎖卡旗標","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_6":{"Content":"mef03_6","Exp":"進出閘門口編號","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_7":{"Content":"mef03_7","Exp":"進出閘門口時間","length":8,"dataCoding":"BIN","LSB":"true","UnixTime":"true","Rule":["LSB","Decimal","UnixTime"]},"mef03_8":{"Content":"mef03_8","Exp":"轉乘Flag(交易類別)","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_9":{"Content":"mef03_9","Exp":"轉乘Flag(交易群組)","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_10":{"Content":"mef03_10","Exp":"最近兩筆閘門交易紀錄(1)","length":0,"dataCoding":"undefined","LSB":"false","UnixTime":"false","Rule":["Blank"]},"mef03_11":{"Content":"mef03_11","Exp":"交易序號","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_12":{"Content":"mef03_12","Exp":"交易時間","length":8,"dataCoding":"BIN","LSB":"true","UnixTime":"true","Rule":["LSB","Decimal","UnixTime"]},"mef03_13":{"Content":"mef03_13","Exp":"交易類別","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_14":{"Content":"mef03_14","Exp":"交易票值","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_15":{"Content":"mef03_15","Exp":"交易後票值","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_16":{"Content":"mef03_16","Exp":"交易系統編號","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_17":{"Content":"mef03_17","Exp":"交易地點/運輸業者","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_18":{"Content":"mef03_18","Exp":"交易機器","length":8,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_19":{"Content":"mef03_19","Exp":"最近兩筆閘門交易紀錄(2)","length":0,"dataCoding":"undefined","LSB":"false","UnixTime":"false","Rule":["Blank"]},"mef03_20":{"Content":"mef03_20","Exp":"交易序號","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_21":{"Content":"mef03_21","Exp":"交易時間","length":8,"dataCoding":"BIN","LSB":"true","UnixTime":"true","Rule":["LSB","Decimal","UnixTime"]},"mef03_22":{"Content":"mef03_22","Exp":"交易類別","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_23":{"Content":"mef03_23","Exp":"交易票值","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_24":{"Content":"mef03_24","Exp":"交易後票值","length":4,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]},"mef03_25":{"Content":"mef03_25","Exp":"交易系統編號","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_26":{"Content":"mef03_26","Exp":"交易地點/運輸業者","length":2,"dataCoding":"BIN","LSB":"false","UnixTime":"false","Rule":["Decimal"]},"mef03_27":{"Content":"mef03_27","Exp":"交易機器","length":8,"dataCoding":"BIN","LSB":"true","UnixTime":"false","Rule":["LSB","Decimal"]}}';

$obj = json_decode($json_string);

$row_num = 0;
foreach ($obj as $Subject => $value) {

  $row_num ++;
  echo 'Subject: '.$Subject.'<br>';

  foreach ($value as $key => $value) {
    if(gettype($value) !== 'array'){

      echo $key.' : '.$value.'<br>';

      if($key === 'Content') $content = $value;
      if($key === 'Exp') $exp = $value;
      if($key === 'length') $length = $value;
      if($key === 'dataCoding') $data_coding = $value;
      if($key === 'LSB') $lsb = $value;
      if($key === 'UnixTime') $unixtime = $value;

    }elseif (gettype($value) === 'array') {

      $Rule = '';
      foreach ($value as $key => $rule) {
        if($key === count($value)-1){
          $Rule .= $rule;
        }else {
          $Rule .= $rule.',';
        }
      }

      echo 'Rule : '.$Rule.'<br>';

    }

  }



  $query = "INSERT INTO mef03(RuleID,Subject,Content,Exp,Length,DataCoding,LSB,UnixTime,Rule,CreateTime) VALUES (".$row_num.",'".$Subject."','".$content."','".$exp."',".$length.",'".$data_coding."','".$lsb."','".$unixtime."','".$Rule."','".$localTime."')";

  echo $query.'<br>';

  $conn->query('SET NAMES UTF8');
  $conn->query($query);


  echo '======================================================================<br>';
}

 ?>
