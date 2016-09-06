-- MySQL dump 10.16  Distrib 10.1.9-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: oceanstyxx
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB

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
-- Table structure for table `car_type`
--

DROP TABLE IF EXISTS `car_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `car_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_type`
--

LOCK TABLES `car_type` WRITE;
/*!40000 ALTER TABLE `car_type` DISABLE KEYS */;
INSERT INTO `car_type` VALUES (1,'Automatic'),(2,'Manual'),(3,'Both');
/*!40000 ALTER TABLE `car_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(126) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_registration`
--

DROP TABLE IF EXISTS `customer_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_registration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(126) NOT NULL DEFAULT '',
  `phone` varchar(126) NOT NULL DEFAULT '',
  `email` varchar(126) NOT NULL DEFAULT '',
  `password` varchar(126) NOT NULL DEFAULT '',
  `remember_password` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_registration`
--

LOCK TABLES `customer_registration` WRITE;
/*!40000 ALTER TABLE `customer_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_review`
--

DROP TABLE IF EXISTS `customer_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_review` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drive_req_id` int(10) unsigned NOT NULL DEFAULT '0',
  `rating` int(10) unsigned NOT NULL DEFAULT '0',
  `review` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_customer_review_drive_req_id` (`drive_req_id`),
  CONSTRAINT `FK_customer_review_drive_req_id` FOREIGN KEY (`drive_req_id`) REFERENCES `drive_request` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_review`
--

LOCK TABLES `customer_review` WRITE;
/*!40000 ALTER TABLE `customer_review` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drive_request`
--

DROP TABLE IF EXISTS `drive_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drive_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drive_code` varchar(100) NOT NULL DEFAULT '',
  `customer_id` int(11) DEFAULT NULL,
  `driver_id` int(10) unsigned zerofill DEFAULT NULL,
  `pickup_venue` varchar(126) NOT NULL DEFAULT '',
  `pickup_location` varchar(256) NOT NULL DEFAULT '',
  `drop_point` varchar(512) DEFAULT NULL,
  `status` varchar(45) NOT NULL DEFAULT '',
  `device_id` varchar(126) DEFAULT NULL,
  `booking_date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `drive_start_time` datetime DEFAULT NULL,
  `drive_end_time` datetime DEFAULT NULL,
  `total_drive_rate` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_drive_request_driver_id` (`driver_id`),
  CONSTRAINT `FK_drive_request_driver_id` FOREIGN KEY (`driver_id`) REFERENCES `driver_registration` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drive_request`
--

LOCK TABLES `drive_request` WRITE;
/*!40000 ALTER TABLE `drive_request` DISABLE KEYS */;
INSERT INTO `drive_request` VALUES (1,'VDRb902',0,0000000002,'pickuppoint','','droppoint','Assigned','deviceid','0000-00-00 00:00:00','2016-09-05 10:33:52',NULL,NULL,NULL),(2,'VDRdd0b',0,0000000001,'pickuppoint','','droppoint','Assigned','deviceid','0000-00-00 00:00:00','2016-09-05 10:32:31',NULL,NULL,NULL),(3,'VDR2c9d',0,0000000002,'pickuppoint','','droppoint','Requested','deviceid','0000-00-00 00:00:00','2016-09-05 10:33:06','2016-09-04 01:43:49',NULL,NULL);
/*!40000 ALTER TABLE `drive_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_address`
--

DROP TABLE IF EXISTS `driver_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver_id` int(10) unsigned NOT NULL DEFAULT '0',
  `address1` varchar(256) NOT NULL DEFAULT '',
  `address2` varchar(256) DEFAULT NULL,
  `city` varchar(60) NOT NULL DEFAULT '',
  `pincode` int(10) unsigned NOT NULL DEFAULT '0',
  `state` varchar(126) NOT NULL DEFAULT '0',
  `country` varchar(126) NOT NULL DEFAULT '0',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_driver_address_driver_code` (`driver_id`),
  KEY `FK_driver_address_state_id` (`state`) USING BTREE,
  KEY `FK_driver_address_country_id` (`country`) USING BTREE,
  CONSTRAINT `FK_driver_address_driver_code` FOREIGN KEY (`driver_id`) REFERENCES `driver_registration` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_address`
--

LOCK TABLES `driver_address` WRITE;
/*!40000 ALTER TABLE `driver_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `driver_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_registration`
--

DROP TABLE IF EXISTS `driver_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_registration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `driver_code` varchar(24) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) NOT NULL DEFAULT '0',
  `email_id` varchar(126) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `licence_no` varchar(45) NOT NULL DEFAULT '',
  `car_type` varchar(45) NOT NULL DEFAULT '0',
  `profile_image` varchar(256) DEFAULT NULL,
  `dl_upload` varchar(256) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address_proof_upload` varchar(256) DEFAULT NULL,
  `id_proof_upload` varchar(256) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_driver_registration_car_type` (`car_type`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_registration`
--

LOCK TABLES `driver_registration` WRITE;
/*!40000 ALTER TABLE `driver_registration` DISABLE KEYS */;
INSERT INTO `driver_registration` VALUES (1,'12sd','RRRRR','LLLL','22222222','AA@AA.COM','Online',NULL,'','0',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'eeee','343434','3434','344',NULL,'Online',NULL,'','0',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `driver_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settlement`
--

DROP TABLE IF EXISTS `settlement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settlement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `drive_request_id` int(10) unsigned NOT NULL DEFAULT '0',
  `total_travel_time` varchar(15) DEFAULT NULL,
  `total_rate` double NOT NULL DEFAULT '0',
  `payment_status` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_settlement_drive_req_id` (`drive_request_id`),
  CONSTRAINT `FK_settlement_drive_req_id` FOREIGN KEY (`drive_request_id`) REFERENCES `drive_request` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settlement`
--

LOCK TABLES `settlement` WRITE;
/*!40000 ALTER TABLE `settlement` DISABLE KEYS */;
/*!40000 ALTER TABLE `settlement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state_name` varchar(60) NOT NULL DEFAULT '',
  `country_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_state_1` (`country_id`),
  CONSTRAINT `FK_state_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_configuration`
--

DROP TABLE IF EXISTS `system_configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(126) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_configuration`
--

LOCK TABLES `system_configuration` WRITE;
/*!40000 ALTER TABLE `system_configuration` DISABLE KEYS */;
/*!40000 ALTER TABLE `system_configuration` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-06 11:35:36
