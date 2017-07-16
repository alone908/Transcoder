CREATE DATABASE  IF NOT EXISTS `CardData` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `CardData`;
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
-- Table structure for table `DataRecord`
--

DROP TABLE IF EXISTS `DataRecord`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DataRecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SourceData` longtext NOT NULL,
  `TransCodeLog` longtext CHARACTER SET utf8 NOT NULL,
  `TaiwanTime` longtext CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idData_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DataRecord`
--

LOCK TABLES `DataRecord` WRITE;
/*!40000 ALTER TABLE `DataRecord` DISABLE KEYS */;
/*!40000 ALTER TABLE `DataRecord` ENABLE KEYS */;
UNLOCK TABLES;

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
  `CreateTime` varchar(80) DEFAULT NULL,
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
INSERT INTO `TransCodeRule` VALUES (1,1,'DataHead','Blank1','=====','=====',0,'undefined','false','false','undefined',NULL),(2,2,'DataHead','Blank2','=====','=====',0,'undefined','false','false','undefined',NULL),(3,3,'DataHead','Blank3','=====','=====',0,'undefined','false','false','undefined',NULL),(4,4,'DataHead','HeadTitle','=====','==表頭==',0,'undefined','false','false','undefined',NULL),(5,5,'DataHead','ITEM','ITEM','ITEM(資料項目)',4,'AN','false','false','AN','Friday 23-Dec-16 16:37:47 CST'),(6,6,'DataHead','OPEN_DATE','OPEN_DATE','開班資料日期',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:26:04 CST'),(7,7,'DataHead','SOURCE_DATE','SOURCE_DATE','結班資料日期',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:26:07 CST'),(8,8,'DataHead','FILE_SEQ','FILE_SEQ','資料檔序號',12,'AN','false','false','AN','Thursday 01-Sep-16 13:26:14 CST'),(9,9,'DataHead','RECORD','RECORD','總筆數',20,'AN','false','false','AN','Thursday 01-Sep-16 13:26:18 CST'),(10,10,'DataHead','TXN_VALUE_AMOUNT','TXN_VALUE_AMOUNT','總交易票值',24,'AN','false','false','AN','Thursday 01-Sep-16 13:26:20 CST'),(11,11,'DataHead','TICKET_VALUE_AMOUNT','TICKET_VALUE_AMOUNT','總交易點數',24,'AN','false','false','AN','Thursday 01-Sep-16 13:26:26 CST'),(12,12,'DataHead','Device_ID','Device_ID','裝置編號',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:26:30 CST'),(13,13,'DataHead','BV_Transaction_Bathch_No','BV_Transaction_Bathch_No','批號',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:26:34 CST'),(14,14,'DataHead','Program_Version','Program_Version','程式版本',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:26:37 CST'),(15,15,'DataHead','Black_List_Version','Black_List_Version','黑名單版本',8,'BIN','false','false','Decimal,UnixTime','Thursday 01-Sep-16 13:26:40 CST'),(16,16,'DataHead','Parameter_Version','Parameter_Version','驗票機參數版本',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:26:47 CST'),(17,17,'DataBody','BodyTitle','=====','==表身==',0,'undefined','false','false','undefined',NULL),(18,18,'DataBody','ITEM','ITEM','ITEM(資料項目)',4,'AN','false','false','AN','Thursday 01-Sep-16 13:26:56 CST'),(19,19,'DataBody','Mifare_ID','Mifare_ID','Mifare_ID',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:03 CST'),(20,20,'DataBody','SECTOR_1_BEFORE','SECTOR_1_BEFORE','交易前Sector 1 Block 0/1/2資料',96,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:07 CST'),(21,21,'DataBody','SECTOR_3_BEFORE','SECTOR_3_BEFORE','交易前Sector 3 Block 0/1/2資料',96,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:16 CST'),(22,22,'DataBody','APP_SECTOR_BEFORE','APP_SECTOR_BEFORE','交易前個別交易應用扇區(sector)資料',96,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:22 CST'),(23,23,'DataBody','TRANS_NO','TRANS_NO','卡片交易序號',4,'BIN','true','false','LSB,Decimal','Thursday 01-Sep-16 13:27:26 CST'),(24,24,'DataBody','TRANS_DATE','TRANS_DATE','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Thursday 01-Sep-16 13:27:30 CST'),(25,25,'DataBody','TRANS_TYPE','TRANS_TYPE','交易類別',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:34 CST'),(26,26,'DataBody','BEFORE_BAL','BEFORE_BAL','交易前票值',4,'BIN','true','false','LSB,Decimal','Thursday 01-Sep-16 13:27:39 CST'),(27,27,'DataBody','TOPUP_AMT','TOPUP_AMT','交易票值',4,'BIN','true','false','LSB,Decimal','Thursday 01-Sep-16 13:27:46 CST'),(28,28,'DataBody','AFTER_BAL','AFTER_BAL','交易後票值',4,'BIN','true','false','LSB,Decimal','Thursday 01-Sep-16 13:27:53 CST'),(29,29,'DataBody','TRANS_SYS_NO','TRANS_SYS_NO','交易系統編號',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:27:58 CST'),(30,30,'DataBody','LOC_ID','LOC_ID','交易地點/運輸業者',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:02 CST'),(31,31,'DataBody','DEV_ID','DEV_ID','交易機器/OBU編號',8,'BIN','true','false','LSB','Wednesday 07-Sep-16 12:09:19 CST'),(32,32,'DataBody','PID_CODE','PID_CODE','PID_CODE',16,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:14 CST'),(33,33,'DataBody','Bus_Lincense_ID','Bus_Lincense_ID','車牌號碼',16,'AN','false','false','AN','Tuesday 06-Sep-16 19:39:28 CST'),(34,34,'DataBody','LSNDSN_SEQ','LSNDSN_SEQ','LSNDSN_SEQ',16,'AN','false','false','AN','Thursday 01-Sep-16 13:28:24 CST'),(35,35,'DataBody','RN','RN','RN',16,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:28 CST'),(36,36,'DataBody','LTAC_PTAC','LTAC_PTAC','LTAC_PTAC',16,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:33 CST'),(37,37,'DataBody','SAM_OSN','SAM_OSN','SAM序號',16,'BIN','false','false','Decimal','Monday 26-Sep-16 16:30:40 CST'),(38,38,'DataBody','SAM_TRANS_SEQ','SAM_TRANS_SEQ','SAM的交易序號',12,'AN','false','false','AN','Thursday 01-Sep-16 13:28:44 CST'),(39,39,'DataBody','SAM_MAC','SAM_MAC','SAM的交易驗證碼',16,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:51 CST'),(40,40,'DataBody','TERM_TX_SEQ','TERM_TX_SEQ','終端設備交易序號',12,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:28:57 CST'),(41,41,'DataBody','TERM_TX_DATE','TERM_TX_DATE','終端設備交易時間',28,'AN','false','false','AN','Thursday 01-Sep-16 13:29:01 CST'),(42,42,'DataBody','TERM_ID','TERM_ID','終端設備編號',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:08 CST'),(43,43,'DataBody','STORE_ID','STORE_ID','商店編號 /站別編號',30,'AN','false','false','AN','Thursday 01-Sep-16 13:29:14 CST'),(44,44,'DataBody','TRANS_NO_CANCEL','TRANS_NO_CANCEL','交易被取消之卡片交易序號',4,'BIN','true','false','LSB,Decimal','Thursday 01-Sep-16 13:29:20 CST'),(45,45,'DataBody','TRANS_DATE_CANCEL','TRANS_DATE_CANCEL','交易被取消之交易日期',8,'BIN','true','true','LSB,Decimal,UnixTime','Thursday 01-Sep-16 13:29:24 CST'),(46,46,'DataBody','APP_SECTOR_AFTER','APP_SECTOR_AFTER','交易後個別交易應用扇區(sector)資料',96,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:28 CST'),(47,47,'DataBody','User_Type','User_Type','使用者型態',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:33 CST'),(48,48,'DataBody','Transfer_Favor_AMT','Transfer_Favor_AMT','轉乘優惠金額',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:39 CST'),(49,49,'DataBody','Original_Transaction_AMT','Original_Transaction_AMT','原票價金額',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:44 CST'),(50,50,'DataBody','BV_Transaction_Bathch_No','BV_Transaction_Bathch_No','批號',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:29:57 CST'),(51,51,'DataBody','in_Shuttle_Code','in_Shuttle_Code','去程之往返程代碼',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:02 CST'),(52,52,'DataBody','Value_Boarding_stop_Code','Value_Boarding_stop_Code','去程計費站代碼',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:12 CST'),(53,53,'DataBody','Boarding_Stop_Code','Boarding_Stop_Code','去程站序代碼(招呼站)',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:21 CST'),(54,54,'DataBody','out_Shuttle_Code','out_Shuttle_Code','返程之往返程代碼',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:29 CST'),(55,55,'DataBody','Value_Alighting_stop_Code','Value_Alighting_stop_Code','出計費站代碼',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:34 CST'),(56,56,'DataBody','Alighting_Stop_Code','Alighting_Stop_Code','出站序代碼(招呼站)',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:40 CST'),(57,57,'DataBody','Transfer_Flag','Transfer_Flag','當次交易轉程旗標',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:49 CST'),(58,58,'DataBody','Cash_for_Insufficiunt','Cash_for_Insufficiunt','餘額不足收現金',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:30:57 CST'),(59,59,'DataBody','Space','Space','保留',12,'AN','false','false','AN','Wednesday 07-Sep-16 13:16:33 CST'),(60,60,'DataBody','Bus_Driver_ID','Bus_Driver_ID','駕駛編號/操作員編號',20,'AN','false','false','AN','Thursday 01-Sep-16 13:31:09 CST'),(61,61,'DataBody','Bus_Route_Doman','Bus_Route_Doman','路線編號簡稱',12,'AN','false','false','AN','Thursday 01-Sep-16 13:31:18 CST'),(62,62,'DataBody','cust_date','cust_date','日結日',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:31:23 CST'),(63,63,'DataBody','cust_date_class','cust_date_class','當日班別',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:31:30 CST'),(64,64,'DataBody','Total_Cash_Transaction_Amount','Total_Cash_Transaction_Amount','總現金錢包交易實扣額',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:31:36 CST'),(65,65,'DataBody','FreeCode','FreeCode','免費乘車代碼',2,'BIN','false','false','Decimal','Thursday 03-Nov-16 15:31:54 CST'),(66,66,'DataBody','FreeBusRebate','FreeBusRebate','免費公車優待金額(中南部公車使用)',4,'BIN','false','false','Decimal','Tuesday 22-Nov-16 17:28:04 CST'),(67,67,'DataBody','price_margin','price_margin','票差優惠金額',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:01 CST'),(68,68,'DataBody','Total_Transaction_Fare','Total_Transaction_Fare','總應交易應扣額',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:08 CST'),(69,69,'DataBody','PID','PID','儲值檔識別碼',16,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:16 CST'),(70,70,'DataBody','Card_Type','Card_Type','卡別',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:23 CST'),(71,71,'DataBody','Premium_Provider','Premium_Provider','發卡企業編號',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:28 CST'),(72,72,'DataBody','Special_Identity_Original_Counter/Amount','Special_Identity_Original_Counter/Amount','敬老及特種之實扣點數/實扣次數',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:34 CST'),(73,73,'DataBody','Special_Identity_Usage_Counter_Accumulated_Amount','Special_Identity_Usage_Counter_Accumulated_Amount','敬老及特種之交易後點數/次數',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:32:40 CST'),(74,74,'DataBody','Special_Identity_Reset_Date','Special_Identity_Reset_Date','敬老及特種之重置日期(Unix Time)',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:32:48 CST'),(75,75,'DataBody','Special_Identity_Activation_Date','Special_Identity_Activation_Date','敬老及特種之起始日(Unix Time)',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:32:54 CST'),(76,76,'DataBody','Special_Identity_Expiration_Date','Special_Identity_Expiration_Date','敬老及特種之有效期(Unix Time)',8,'BIN','false','true','Decimal,UnixTime','Thursday 01-Sep-16 13:33:00 CST'),(77,77,'DataBody','Special_Identity_Departure_Station','Special_Identity_Departure_Station','特種票起站代碼',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:06 CST'),(78,78,'DataBody','Special_Identity_Arrival_Station','Special_Identity_Arrival_Station','特種票迄站代碼',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:11 CST'),(79,79,'DataBody','Special_Identity_Route_ID','Special_Identity_Route_ID','特種票路線編號',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:17 CST'),(80,80,'DataBody','Accumulated_Bonus_usage_status','Accumulated_Bonus_usage_status','紅利使用情形',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:21 CST'),(81,81,'DataBody','Accumulated_Bonus_valid_date','Accumulated_Bonus_valid_date','紅利有效期限',8,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:26 CST'),(82,82,'DataBody','Bonus_Purse_Sequence_Number','Bonus_Purse_Sequence_Number','紅利交易序號',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:32 CST'),(83,83,'DataBody','Bonus_Transaction_Amount','Bonus_Transaction_Amount','紅利消費點數',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:37 CST'),(84,84,'DataBody','Bonus_Remains','Bonus_Remains','紅利點數餘點',4,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:42 CST'),(85,85,'DataBody','Transfer_Group','Transfer_Group','轉乘(Flag)',2,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:47 CST'),(86,86,'DataBody','Space','Space','保留',58,'BIN','false','false','Decimal','Thursday 01-Sep-16 13:33:53 CST');
/*!40000 ALTER TABLE `TransCodeRule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mef01`
--

DROP TABLE IF EXISTS `mef01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mef01` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RuleID` int(11) NOT NULL,
  `Subject` varchar(80) DEFAULT NULL,
  `Content` varchar(80) DEFAULT NULL,
  `Exp` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `DataCoding` varchar(45) DEFAULT NULL,
  `LSB` varchar(45) DEFAULT NULL,
  `UnixTime` varchar(45) DEFAULT NULL,
  `Rule` varchar(45) DEFAULT NULL,
  `CreateTime` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RuleID_UNIQUE` (`RuleID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mef01`
--

LOCK TABLES `mef01` WRITE;
/*!40000 ALTER TABLE `mef01` DISABLE KEYS */;
INSERT INTO `mef01` VALUES (1,1,'mef01_0','mef01_0','發行管理資料',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:44:51 CST'),(2,2,'mef01_1','mef01_1','發卡單位編號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(3,3,'mef01_2','mef01_2','發卡設備編號',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(4,4,'mef01_3','mef01_3','發行批號',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(5,5,'mef01_4','mef01_4','發出日期',8,'BIN','false','true','Decimal,UnixTime','Monday 03-Jul-17 21:44:51 CST'),(6,6,'mef01_5','mef01_5','有效日期',8,'BIN','false','true','Decimal,UnixTime','Monday 03-Jul-17 21:44:51 CST'),(7,7,'mef01_6','mef01_6','卡片格式版本',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(8,8,'mef01_7','mef01_7','卡片狀態',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(9,9,'mef01_8','mef01_8','檢查碼',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(10,10,'mef01_9','mef01_09','票值管理資料',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:44:51 CST'),(11,11,'mef01_10','mef01_10','自動加值設定',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(12,12,'mef01_11','mef01_11','自動加值票值數額',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(13,13,'mef01_12','mef01_12','儲存最大票值數額',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(14,14,'mef01_13','mef01_13','每筆可加減最大票值數額',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(15,15,'mef01_14','mef01_14','指定加值設定',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(16,16,'mef01_15','mef01_15','指定加值票值數額',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(17,17,'mef01_16','mef01_16','自動加值日期',4,'BIN','false','true','Decimal,UnixTime','Monday 03-Jul-17 21:44:51 CST'),(18,18,'mef01_17','mef01_17','連續離線自動加值次數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(19,19,'mef01_18','mef01_18','連續自動加值次數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(20,20,'mef01_19','mef01_19','連續指定加值次數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(21,21,'mef01_20','mef01_20','檢查碼',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST'),(22,22,'mef01_21','mef01_21','卡片防偽驗證資料',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:44:51 CST'),(23,23,'mef01_22','mef01_22','防偽驗證資料',32,'BIN','false','false','Decimal','Monday 03-Jul-17 21:44:51 CST');
/*!40000 ALTER TABLE `mef01` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mef03`
--

DROP TABLE IF EXISTS `mef03`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mef03` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RuleID` int(11) NOT NULL,
  `Subject` varchar(80) DEFAULT NULL,
  `Content` varchar(80) DEFAULT NULL,
  `Exp` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `DataCoding` varchar(45) DEFAULT NULL,
  `LSB` varchar(45) DEFAULT NULL,
  `UnixTime` varchar(45) DEFAULT NULL,
  `Rule` varchar(45) DEFAULT NULL,
  `CreateTime` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RuleID_UNIQUE` (`RuleID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mef03`
--

LOCK TABLES `mef03` WRITE;
/*!40000 ALTER TABLE `mef03` DISABLE KEYS */;
INSERT INTO `mef03` VALUES (1,1,'mef03_0','mef03_0','卡片交易狀態資料',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:59:52 CST'),(2,2,'mef03_1','mef03_1','卡片交易序號',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(3,3,'mef03_2','mef03_2','交易紀錄指標',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(4,4,'mef03_3','mef03_3','優惠積點數',4,'BIN','false','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(5,5,'mef03_4','mef03_4','優惠積點交易序號',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(6,6,'mef03_5','mef03_5','鎖卡旗標',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(7,7,'mef03_6','mef03_6','進出閘門口編號',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(8,8,'mef03_7','mef03_7','進出閘門口時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:59:52 CST'),(9,9,'mef03_8','mef03_8','轉乘Flag(交易類別)',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(10,10,'mef03_9','mef03_9','轉乘Flag(交易群組)',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(11,11,'mef03_10','mef03_10','最近兩筆閘門交易紀錄(1)',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:59:52 CST'),(12,12,'mef03_11','mef03_11','交易序號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(13,13,'mef03_12','mef03_12','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:59:52 CST'),(14,14,'mef03_13','mef03_13','交易類別',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(15,15,'mef03_14','mef03_14','交易票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(16,16,'mef03_15','mef03_15','交易後票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(17,17,'mef03_16','mef03_16','交易系統編號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(18,18,'mef03_17','mef03_17','交易地點/運輸業者',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(19,19,'mef03_18','mef03_18','交易機器',8,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(20,20,'mef03_19','mef03_19','最近兩筆閘門交易紀錄(2)',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:59:52 CST'),(21,21,'mef03_20','mef03_20','交易序號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(22,22,'mef03_21','mef03_21','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:59:52 CST'),(23,23,'mef03_22','mef03_22','交易類別',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(24,24,'mef03_23','mef03_23','交易票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(25,25,'mef03_24','mef03_24','交易後票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST'),(26,26,'mef03_25','mef03_25','交易系統編號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(27,27,'mef03_26','mef03_26','交易地點/運輸業者',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:59:52 CST'),(28,28,'mef03_27','mef03_27','交易機器',8,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:59:52 CST');
/*!40000 ALTER TABLE `mef03` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mef08`
--

DROP TABLE IF EXISTS `mef08`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mef08` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RuleID` int(11) NOT NULL,
  `Subject` varchar(80) DEFAULT NULL,
  `Content` varchar(80) DEFAULT NULL,
  `Exp` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `DataCoding` varchar(45) DEFAULT NULL,
  `LSB` varchar(45) DEFAULT NULL,
  `UnixTime` varchar(45) DEFAULT NULL,
  `Rule` varchar(45) DEFAULT NULL,
  `CreateTime` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RuleID_UNIQUE` (`RuleID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mef08`
--

LOCK TABLES `mef08` WRITE;
/*!40000 ALTER TABLE `mef08` DISABLE KEYS */;
INSERT INTO `mef08` VALUES (1,1,'mef08_0','mef08_0','里程客運進出站交易管理資料',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:56:51 CST'),(2,2,'mef08_1','mef08_1','客運公司編號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(3,3,'mef08_2','mef08_2','最後一次上/下車碼',-2,'BIN','false','false','Binary-0-1-LSB','Monday 03-Jul-17 21:56:51 CST'),(4,4,'mef08_3','mef08_3','里程特種票類別代碼',-2,'BIN','false','false','Binary-1-4-LSB','Monday 03-Jul-17 21:56:51 CST'),(5,5,'mef08_4','mef08_4','保留',-2,'BIN','false','false','Binary-4-8-LSB','Monday 03-Jul-17 21:56:51 CST'),(6,6,'mef08_5','mef08_5','里程特種票原始可用次數/額度',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(7,7,'mef08_6','mef08_6','里程特種票剩餘可用次數/額度',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(8,8,'mef08_7','mef08_7','里程特種票有效日期',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(9,9,'mef08_8','mef08_8','里程特種票有效天數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(10,10,'mef08_9','mef08_9','里程特種票有效起站',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(11,11,'mef08_10','mef08_10','里程特種票有效迄站',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(12,12,'mef08_11','mef08_11','當日累積里程交易日期',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(13,13,'mef08_12','mef08_12','當日累積里程搭乘金額',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(14,14,'mef08_13','mef08_13','最後一次搭乘路線編號',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(15,15,'mef08_14','mef08_14','里程計費上車交易紀錄',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:56:51 CST'),(16,16,'mef08_15','mef08_15','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:56:51 CST'),(17,17,'mef08_16','mef08_16','交易票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(18,18,'mef08_17','mef08_17','交易後票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(19,19,'mef08_18','mef08_18','交易類別',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(20,20,'mef08_19','mef08_19','上車站別ID',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(21,21,'mef08_20','mef08_20','交易序號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(22,22,'mef08_21','mef08_21','交易地點/運輸業者(DEV_ID)',8,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(23,23,'mef08_22','mef08_22','行駛方向(往程:1返程:2循環:3)',-2,'BIN','false','false','Binary-0-4-LSB','Monday 03-Jul-17 21:56:51 CST'),(24,24,'mef08_23','mef08_23','保留',-2,'BIN','false','false','Binary-4-8-LSB','Monday 03-Jul-17 21:56:51 CST'),(25,25,'mef08_24','mef08_24','里程計費下車交易紀錄',0,'undefined','false','false','Blank','Monday 03-Jul-17 21:56:51 CST'),(26,26,'mef08_25','mef08_25','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:56:51 CST'),(27,27,'mef08_26','mef08_26','交易票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(28,28,'mef08_27','mef08_27','交易後票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(29,29,'mef08_28','mef08_28','交易類別',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(30,30,'mef08_29','mef08_29','上車站別ID',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(31,31,'mef08_30','mef08_30','交易序號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:56:51 CST'),(32,32,'mef08_31','mef08_31','交易地點/運輸業者(DEV_ID)',8,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:56:51 CST'),(33,33,'mef08_32','mef08_32','行駛方向(往程:1返程:2循環:3)',-2,'BIN','false','false','Binary-0-4-LSB','Monday 03-Jul-17 21:56:51 CST'),(34,34,'mef08_33','mef08_33','保留',-2,'BIN','false','false','Binary-4-8-LSB','Monday 03-Jul-17 21:56:51 CST');
/*!40000 ALTER TABLE `mef08` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mef0b`
--

DROP TABLE IF EXISTS `mef0b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mef0b` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `RuleID` int(11) NOT NULL,
  `Subject` varchar(80) DEFAULT NULL,
  `Content` varchar(80) DEFAULT NULL,
  `Exp` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `Length` int(11) DEFAULT NULL,
  `DataCoding` varchar(45) DEFAULT NULL,
  `LSB` varchar(45) DEFAULT NULL,
  `UnixTime` varchar(45) DEFAULT NULL,
  `Rule` varchar(45) DEFAULT NULL,
  `CreateTime` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `RuleID_UNIQUE` (`RuleID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mef0b`
--

LOCK TABLES `mef0b` WRITE;
/*!40000 ALTER TABLE `mef0b` DISABLE KEYS */;
INSERT INTO `mef0b` VALUES (1,1,'mef0b_0','mef0b_0','段次公車/客運特種票資料區',0,'BIN','false','false','Blank','Monday 03-Jul-17 21:53:27 CST'),(2,2,'mef0b_1','mef0b_1','段次特種票識別單位',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(3,3,'mef0b_2','mef0b_2','段次特種票類別代碼',-2,'BIN','false','false','Binary-0-3-LSB','Monday 03-Jul-17 21:53:27 CST'),(4,4,'mef0b_3','mef0b_3','保留',-2,'BIN','false','false','Binary-3-8-LSB','Monday 03-Jul-17 21:53:27 CST'),(5,5,'mef0b_4','mef0b_4','段次特種票原始可用次數/額度',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(6,6,'mef0b_5','mef0b_5','段次特種票剩餘可用次數/額度',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(7,7,'mef0b_6','mef0b_6','段次特種票有效日期',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(8,8,'mef0b_7','mef0b_7','段次特種票有效天數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(9,9,'mef0b_8','mef0b_8','段次特種票有效起站',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(10,10,'mef0b_9','mef0b_9','段次特種票有效迄站',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(11,11,'mef0b_10','mef0b_10','段次特種票保留',10,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(12,12,'mef0b_11','mef0b_11','段次公車/客運交易資料',0,'BIN','false','false','Blank','Monday 03-Jul-17 21:53:27 CST'),(13,13,'mef0b_12','mef0b_12','路線編號',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:53:27 CST'),(14,14,'mef0b_13','mef0b_13','交易時間',8,'BIN','true','true','LSB,Decimal,UnixTime','Monday 03-Jul-17 21:53:27 CST'),(15,15,'mef0b_14','mef0b_14','交易票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:53:27 CST'),(16,16,'mef0b_15','mef0b_15','交易後票值',4,'BIN','true','false','LSB,Decimal','Monday 03-Jul-17 21:53:27 CST'),(17,17,'mef0b_16','mef0b_16','交易類別',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(18,18,'mef0b_17','mef0b_17','交易地點/運輸業者(DEV_ID)',8,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(19,19,'mef0b_18','mef0b_18','段號',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(20,20,'mef0b_19','mef0b_19','保留',0,'BIN','false','false','Blank','Monday 03-Jul-17 21:53:27 CST'),(21,21,'mef0b_20','mef0b_20','當日累積段次交易日期',4,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(22,22,'mef0b_21','mef0b_21','當日累積段次搭乘次數',2,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST'),(23,23,'mef0b_22','mef0b_22','保留',26,'BIN','false','false','Decimal','Monday 03-Jul-17 21:53:27 CST');
/*!40000 ALTER TABLE `mef0b` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-03 22:16:49
