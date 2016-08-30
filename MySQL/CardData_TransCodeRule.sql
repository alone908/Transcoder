-- MySQL dump 10.13  Distrib 5.7.9, for osx10.9 (x86_64)
--
-- Host: localhost    Database: CardData
-- ------------------------------------------------------
-- Server version	5.7.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `TransCodeRule`
--

DROP TABLE IF EXISTS `TransCodeRule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TransCodeRule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RuleID` int(11) NOT NULL,
  `Section` varchar(45) DEFAULT NULL,
  `Subject` varchar(80) DEFAULT NULL,
  `Content` varchar(80) DEFAULT NULL,
  `Exp` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `DataCoding` varchar(45) DEFAULT NULL,
  `LSB` varchar(45) DEFAULT NULL,
  `UnixTime` varchar(45) DEFAULT NULL,
  `Rule` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RuleID_UNIQUE` (`RuleID`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TransCodeRule`
--

LOCK TABLES `TransCodeRule` WRITE;
/*!40000 ALTER TABLE `TransCodeRule` DISABLE KEYS */;
INSERT INTO `TransCodeRule` VALUES (1,1,'DataHead','Blank1','=====','=====',0,'undefined','false','false','undefined'),(2,2,'DataHead','Blank2','=====','=====',0,'undefined','false','false','undefined'),(3,3,'DataHead','Blank3','=====','=====',0,'undefined','false','false','undefined'),(4,4,'DataHead','HeadTitle','=====','==表頭==',0,'undefined','false','false','undefined'),(5,5,'DataHead','ITEM','ITEM','ITEM(資料項目)',4,'AN','false','false','AN'),(6,6,'DataHead','OPEN_DATE','OPEN_DATE','開班資料日期',8,'BIN','false','true','Decimal,UnixTime'),(7,7,'DataHead','SOURCE_DATE','SOURCE_DATE','結班資料日期',8,'BIN','false','true','Decimal,UnixTime'),(8,8,'DataHead','FILE_SEQ','FILE_SEQ','資料檔序號',12,'AN','false','false','AN'),(9,9,'DataHead','RECORD','RECORD','總筆數',20,'AN','false','false','AN'),(10,10,'DataHead','TXN_VALUE_AMOUNT','TXN_VALUE_AMOUNT','總交易票值',24,'AN','false','false','AN'),(11,11,'DataHead','TICKET_VALUE_AMOUNT','TICKET_VALUE_AMOUNT','總交易點數',24,'AN','false','false','AN'),(12,12,'DataHead','Device_ID','Device_ID','裝置編號',8,'BIN','false','false','Decimal'),(13,13,'DataHead','BV_Transaction_Bathch_No','BV_Transaction_Bathch_No','批號',4,'BIN','false','false','Decimal'),(14,14,'DataHead','Program_Version','Program_Version','程式版本',4,'BIN','false','false','Decimal'),(15,15,'DataHead','Black_List_Version','Black_List_Version','黑名單版本',8,'BIN','false','false','Decimal,UnixTime'),(16,16,'DataHead','Parameter_Version','Parameter_Version','驗票機參數版本',8,'BIN','false','false','Decimal'),(17,17,'DataBody','BodyTitle','=====','==表身==',0,'undefined','false','false','undefined'),(18,18,'DataBody','ITEM','ITEM','ITEM(資料項目)',4,'AN','false','false','AN'),(19,19,'DataBody','Mifare_ID','Mifare_ID','Mifare_ID',8,'BIN','false','false','Decimal'),(20,20,'DataBody','SECTOR_1_BEFORE','SECTOR_1_BEFORE','交易前Sector 1 Block 0/1/2資料',96,'BIN','false','false','Decimal'),(21,21,'DataBody','SECTOR_3_BEFORE','SECTOR_3_BEFORE','交易前Sector 3 Block 0/1/2資料',96,'BIN','false','false','Decimal'),(22,22,'DataBody','APP_SECTOR_BEFORE','APP_SECTOR_BEFORE','交易前個別交易應用扇區(sector)資料',96,'BIN','false','false','Decimal'),(23,23,'DataBody','TRANS_NO','TRANS_NO','卡片交易序號',4,'BIN','true','false','LSB,Decimal'),(24,24,'DataBody','TRANS_DATE','TRANS_DATE','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime'),(25,25,'DataBody','TRANS_TYPE','TRANS_TYPE','交易類別',2,'BIN','false','false','Decimal'),(26,26,'DataBody','BEFORE_BAL','BEFORE_BAL','交易前票值',4,'BIN','true','false','LSB,Decimal'),(27,27,'DataBody','TOPUP_AMT','TOPUP_AMT','交易票值',4,'BIN','true','false','LSB,Decimal'),(28,28,'DataBody','AFTER_BAL','AFTER_BAL','交易後票值',4,'BIN','true','false','LSB,Decimal'),(29,29,'DataBody','TRANS_SYS_NO','TRANS_SYS_NO','交易系統編號',2,'BIN','false','false','Decimal'),(30,30,'DataBody','LOC_ID','LOC_ID','交易地點/運輸業者',2,'BIN','false','false','Decimal'),(31,31,'DataBody','DEV_ID','DEV_ID','交易機器/OBU編號',8,'BIN','true','false','LSB,Decimal'),(32,32,'DataBody','PID_CODE','PID_CODE','PID_CODE',16,'BIN','false','false','Decimal'),(33,33,'DataBody','LADA_AMT','LADA_AMT','LADA_AMT',16,'AN','false','false','AN'),(34,34,'DataBody','LSNDSN_SEQ','LSNDSN_SEQ','LSNDSN_SEQ',16,'AN','false','false','AN'),(35,35,'DataBody','RN','RN','RN',16,'BIN','false','false','Decimal'),(36,36,'DataBody','LTAC_PTAC','LTAC_PTAC','LTAC_PTAC',16,'BIN','false','false','Decimal'),(37,37,'DataBody','SAM_OSN','SAM_OSN','SAM序號',16,'AN','false','false','AN'),(38,38,'DataBody','SAM_TRANS_SEQ','SAM_TRANS_SEQ','SAM的交易序號',12,'AN','false','false','AN'),(39,39,'DataBody','SAM_MAC','SAM_MAC','SAM的交易驗證碼',16,'BIN','false','false','Decimal'),(40,40,'DataBody','TERM_TX_SEQ','TERM_TX_SEQ','終端設備交易序號',12,'BIN','false','false','Decimal'),(41,41,'DataBody','TERM_TX_DATE','TERM_TX_DATE','終端設備交易時間',28,'AN','false','false','AN'),(42,42,'DataBody','TERM_ID','TERM_ID','終端設備編號',8,'BIN','false','false','Decimal'),(43,43,'DataBody','STORE_ID','STORE_ID','商店編號 /站別編號',30,'AN','false','false','AN'),(44,44,'DataBody','TRANS_NO_CANCEL','TRANS_NO_CANCEL','交易被取消之卡片交易序號',4,'BIN','true','false','LSB,Decimal'),(45,45,'DataBody','TRANS_DATE_CANCEL','TRANS_DATE_CANCEL','交易被取消之交易日期',8,'BIN','true','true','LSB,Decimal,UnixTime'),(46,46,'DataBody','APP_SECTOR_AFTER','APP_SECTOR_AFTER','交易後個別交易應用扇區(sector)資料',96,'BIN','false','false','Decimal'),(47,47,'DataBody','User_Type','User_Type','使用者型態',2,'BIN','false','false','Decimal'),(48,48,'DataBody','Transfer_Favor_AMT','Transfer_Favor_AMT','轉乘優惠金額',8,'BIN','false','false','Decimal'),(49,49,'DataBody','Original_Transaction_AMT','Original_Transaction_AMT','原票價金額',8,'BIN','false','false','Decimal'),(50,50,'DataBody','BV_Transaction_Bathch_No','BV_Transaction_Bathch_No','批號',4,'BIN','false','false','Decimal'),(51,51,'DataBody','in_Shuttle_Code','in_Shuttle_Code','去程之往返程代碼',2,'BIN','false','false','Decimal'),(52,52,'DataBody','Value_Boarding_stop_Code','Value_Boarding_stop_Code','去程計費站代碼',4,'BIN','false','false','Decimal'),(53,53,'DataBody','Boarding_Stop_Code','Boarding_Stop_Code','去程站序代碼(招呼站)',4,'BIN','false','false','Decimal'),(54,54,'DataBody','out_Shuttle_Code','out_Shuttle_Code','返程之往返程代碼',2,'BIN','false','false','Decimal'),(55,55,'DataBody','Value_Alighting_stop_Code','Value_Alighting_stop_Code','出計費站代碼',4,'BIN','false','false','Decimal'),(56,56,'DataBody','Alighting_Stop_Code','Alighting_Stop_Code','出站序代碼(招呼站)',4,'BIN','false','false','Decimal'),(57,57,'DataBody','Transfer_Flag','Transfer_Flag','當次交易轉程旗標',2,'BIN','false','false','Decimal'),(58,58,'DataBody','Cash_for_Insufficiunt','Cash_for_Insufficiunt','餘額不足收現金',4,'BIN','false','false','Decimal'),(59,59,'DataBody','Bus_Lincense_ID','Bus_Lincense_ID','車牌號碼',12,'AN','false','false','AN'),(60,60,'DataBody','Bus_Driver_ID','Bus_Driver_ID','駕駛編號/操作員編號',20,'AN','false','false','AN'),(61,61,'DataBody','Bus_Route_Doman','Bus_Route_Doman','路線編號簡稱',12,'AN','false','false','AN'),(62,62,'DataBody','cust_date','cust_date','日結日',8,'BIN','false','true','Decimal,UnixTime'),(63,63,'DataBody','cust_date_class','cust_date_class','當日班別',2,'BIN','false','false','Decimal'),(64,64,'DataBody','Total_Cash_Transaction_Amount','Total_Cash_Transaction_Amount','總現金錢包交易實扣額',4,'BIN','false','false','Decimal'),(65,65,'DataBody','FreeCode','FreeCode','中部公車使用',2,'BIN','false','false','Decimal'),(66,66,'DataBody','FreeBusRebate','FreeBusRebate','免費公車優待金額(中部公車使用)',4,'BIN','false','false','Decimal'),(67,67,'DataBody','price_margin','price_margin','票差優惠金額',4,'BIN','false','false','Decimal'),(68,68,'DataBody','Total_Transaction_Fare','Total_Transaction_Fare','總應交易應扣額',4,'BIN','false','false','Decimal'),(69,69,'DataBody','PID','PID','儲值檔識別碼',16,'BIN','false','false','Decimal'),(70,70,'DataBody','Card_Type','Card_Type','卡別',2,'BIN','false','false','Decimal'),(71,71,'DataBody','Premium_Provider','Premium_Provider','發卡企業編號',2,'BIN','false','false','Decimal'),(72,72,'DataBody','Special_Identity_Original_Counter_Amount','Special_Identity_Original_Counter/Amount','敬老及特種之實扣點數/實扣次數',8,'BIN','false','false','Decimal'),(73,73,'DataBody','Special_Identity_Usage_Counter_Accumulated_Amount','Special_Identity_Usage_Counter_Accumulated_Amount','敬老及特種之交易後點數/次數',8,'BIN','false','false','Decimal'),(74,74,'DataBody','Special_Identity_Reset_Date','Special_Identity_Reset_Date','敬老及特種之重置日期(Unix Time)',8,'BIN','false','true','Decimal,UnixTime'),(75,75,'DataBody','Special_Identity_Activation_Date','Special_Identity_Activation_Date','敬老及特種之起始日(Unix Time)',8,'BIN','false','true','Decimal,UnixTime'),(76,76,'DataBody','Special_Identity_Expiration_Date','Special_Identity_Expiration_Date','敬老及特種之有效期(Unix Time)',8,'BIN','false','true','Decimal,UnixTime'),(77,77,'DataBody','Special_Identity_Departure_Station','Special_Identity_Departure_Station','特種票起站代碼',8,'BIN','false','false','Decimal'),(78,78,'DataBody','Special_Identity_Arrival_Station','Special_Identity_Arrival_Station','特種票迄站代碼',8,'BIN','false','false','Decimal'),(79,79,'DataBody','Special_Identity_Route_ID','Special_Identity_Route_ID','特種票路線編號',8,'BIN','false','false','Decimal'),(80,80,'DataBody','Accumulated_Bonus_usage_status','Accumulated_Bonus_usage_status','紅利使用情形',2,'BIN','false','false','Decimal'),(81,81,'DataBody','Accumulated_Bonus_valid_date','Accumulated_Bonus_valid_date','紅利有效期限',8,'BIN','false','false','Decimal'),(82,82,'DataBody','Bonus_Purse_Sequence_Number','Bonus_Purse_Sequence_Number','紅利交易序號',4,'BIN','false','false','Decimal'),(83,83,'DataBody','Bonus_Transaction_Amount','Bonus_Transaction_Amount','紅利消費點數',4,'BIN','false','false','Decimal'),(84,84,'DataBody','Bonus_Remains','Bonus_Remains','紅利點數餘點',4,'BIN','false','false','Decimal'),(85,85,'DataBody','Transfer_Group','Transfer_Group','轉乘(Flag)',2,'BIN','false','false','Decimal'),(86,86,'DataBody','Space','Space','保留',58,'BIN','false','false','Decimal');
/*!40000 ALTER TABLE `TransCodeRule` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-31  0:46:14
