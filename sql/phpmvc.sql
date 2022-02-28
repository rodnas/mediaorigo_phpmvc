-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: phpmvc
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `phpmvc`
--

/*!40000 DROP DATABASE IF EXISTS `phpmvc`*/;

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `phpmvc` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;

USE `phpmvc`;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `place` varchar(100) COLLATE utf8_bin NOT NULL,
  `cargo_weight` int(4) unsigned DEFAULT NULL,
  `transport_date` date DEFAULT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `core_languageID` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insertWhen` (`insertWhen`),
  KEY `insertUserId` (`insertUserID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'11. bikás park',1200,'2022-02-22',1,'HU',1,'2022-02-21 08:24:41',1,'2022-02-27 20:26:35');
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_groups`
--

DROP TABLE IF EXISTS `core_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT 'HU',
  `core_statusID` int(11) unsigned DEFAULT 1,
  `insertUserID` int(11) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` int(11) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_groups`
--

LOCK TABLES `core_groups` WRITE;
/*!40000 ALTER TABLE `core_groups` DISABLE KEYS */;
INSERT INTO `core_groups` VALUES (-2,'Anonymous','HU',1,NULL,NULL,NULL,NULL),(-1,'Administrator','HU',1,NULL,NULL,NULL,NULL),(0,'Default','HU',1,NULL,NULL,NULL,NULL),(1,'Rendszergazda','HU',1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `core_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_groups_permissions`
--

DROP TABLE IF EXISTS `core_groups_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_groups_permissions` (
  `core_groupsID` int(11) NOT NULL,
  `tablename` varchar(255) COLLATE utf8_bin NOT NULL,
  `permission` int(11) NOT NULL,
  PRIMARY KEY (`core_groupsID`,`tablename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_groups_permissions`
--

LOCK TABLES `core_groups_permissions` WRITE;
/*!40000 ALTER TABLE `core_groups_permissions` DISABLE KEYS */;
INSERT INTO `core_groups_permissions` VALUES (-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}cargo',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_groups',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_groups_permissions',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_language',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_status',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_users',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}driver',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}license_type',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}passanger',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}transport',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}vehicle',0),(-2,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}vehicle_type',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}cargo',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_groups',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_groups_permissions',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_language',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_status',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}core_users',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}driver',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}license_type',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}passanger',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}transport',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}vehicle',0),(0,'{B9C66494-4FCC-4FA7-9D65-FA09155B96BF}vehicle_type',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}cargo',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}core_groups',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}core_groups_permissions',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}core_language',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}core_status',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}core_users',0),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}driver',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}license_type',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}passanger',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}transport',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}vehicle',511),(1,'{28288783-E3B8-4152-BB03-BA57FA6729B8}vehicle_type',511);
/*!40000 ALTER TABLE `core_groups_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_language`
--

DROP TABLE IF EXISTS `core_language`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_language` (
  `id` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT 'HU',
  `imageURL` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `core_statusID` int(11) DEFAULT 1,
  `insertUserID` int(11) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` int(11) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_language`
--

LOCK TABLES `core_language` WRITE;
/*!40000 ALTER TABLE `core_language` DISABLE KEYS */;
INSERT INTO `core_language` VALUES ('HU',NULL,1,NULL,NULL,1,'2015-11-02 01:08:13'),('EN',NULL,1,1,'2015-11-02 01:07:47',NULL,NULL),('DE',NULL,1,1,'2015-11-02 01:07:59',NULL,NULL);
/*!40000 ALTER TABLE `core_language` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_status`
--

DROP TABLE IF EXISTS `core_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT 'HU',
  `core_statusID` int(11) unsigned DEFAULT 1,
  `insertUserID` int(11) unsigned NOT NULL DEFAULT 0,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` int(11) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_status`
--

LOCK TABLES `core_status` WRITE;
/*!40000 ALTER TABLE `core_status` DISABLE KEYS */;
INSERT INTO `core_status` VALUES (1,'Aktív','HU',1,0,NULL,NULL,NULL),(0,'Passzív','HU',1,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `core_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_users`
--

DROP TABLE IF EXISTS `core_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` varchar(40) COLLATE utf8_bin NOT NULL,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT 'HU',
  `core_statusID` int(11) unsigned DEFAULT 1,
  `lastLoginWhen` datetime DEFAULT NULL,
  `activationCode` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `regmailWhen` datetime DEFAULT NULL,
  `activationWhen` datetime DEFAULT NULL,
  `core_groupsID` int(11) NOT NULL DEFAULT 3,
  `insertUserID` int(11) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` int(11) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_users`
--

LOCK TABLES `core_users` WRITE;
/*!40000 ALTER TABLE `core_users` DISABLE KEYS */;
INSERT INTO `core_users` VALUES (1,'rodnas@uw.hu','rodnas','b3d97746dbb45e92dc083db205e1fd14','HU',1,NULL,NULL,NULL,NULL,-1,NULL,NULL,NULL,NULL),(2,'rodnas0204@gmail.com','admin','21232f297a57a5a743894a0e4a801fc3','HU',1,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `core_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `birth_year` int(4) unsigned DEFAULT NULL,
  `license_typeID` int(11) unsigned NOT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT '',
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insertWhen` (`insertWhen`),
  KEY `insertUserId` (`insertUserID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` VALUES (1,'Szabó Sándor',1961,1,1,'HU',1,'2022-02-27 15:42:41',1,'2022-02-27 17:25:23');
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `license_type`
--

DROP TABLE IF EXISTS `license_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `license_type` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `license_type`
--

LOCK TABLES `license_type` WRITE;
/*!40000 ALTER TABLE `license_type` DISABLE KEYS */;
INSERT INTO `license_type` VALUES (1,'B  - személyautó',1,2,'2022-02-17 16:17:33',1,'2022-02-27 17:33:15'),(2,'C - kisteherautó',1,2,'2022-02-17 16:17:55',NULL,NULL),(3,'D - nagyteherautó',1,2,'2022-02-17 16:18:13',NULL,NULL);
/*!40000 ALTER TABLE `license_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passanger`
--

DROP TABLE IF EXISTS `passanger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passanger` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `how_many_people` int(4) unsigned DEFAULT NULL,
  `transport_date` date DEFAULT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT '',
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insertWhen` (`insertWhen`),
  KEY `insertUserId` (`insertUserID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passanger`
--

LOCK TABLES `passanger` WRITE;
/*!40000 ALTER TABLE `passanger` DISABLE KEYS */;
INSERT INTO `passanger` VALUES (1,'Anonymus',5,'2022-02-08',1,'HU',2,'2022-02-21 08:25:10',1,'2022-02-27 20:34:03');
/*!40000 ALTER TABLE `passanger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transport` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicleID` int(11) unsigned DEFAULT NULL,
  `driverID` int(11) unsigned DEFAULT NULL,
  `cargoID` int(11) unsigned DEFAULT NULL,
  `passangerID` int(11) unsigned DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `core_languageID` varchar(2) COLLATE utf8_bin NOT NULL DEFAULT '',
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insertWhen` (`insertWhen`),
  KEY `insertUserId` (`insertUserID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transport`
--

LOCK TABLES `transport` WRITE;
/*!40000 ALTER TABLE `transport` DISABLE KEYS */;
INSERT INTO `transport` VALUES (1,1,1,1,1,'2022-02-06',1,'HU',2,'2022-02-21 08:54:20',1,'2022-02-27 20:32:44');
/*!40000 ALTER TABLE `transport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_typeID` int(11) unsigned DEFAULT NULL,
  `lpn` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `start_year` int(4) unsigned DEFAULT NULL,
  `person` int(11) DEFAULT NULL,
  `max_weight` int(11) DEFAULT NULL,
  `core_statusID` int(1) unsigned DEFAULT 1,
  `core_languageID` varchar(2) COLLATE utf8_bin DEFAULT '',
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `insertWhen` (`insertWhen`),
  KEY `insertUserId` (`insertUserID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (1,1,'PTH855',2018,5,400,1,'HU',1,'2022-02-27 14:54:32',1,'2022-02-27 17:22:56'),(2,2,'AAA111',1980,4,1200,1,'HU',1,'2022-02-27 20:41:18',1,'2022-02-27 21:25:24');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_type` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `core_statusID` int(11) unsigned DEFAULT 1,
  `insertUserID` bigint(20) unsigned DEFAULT NULL,
  `insertWhen` datetime DEFAULT NULL,
  `modifyUserID` bigint(20) unsigned DEFAULT NULL,
  `modifyWhen` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_type`
--

LOCK TABLES `vehicle_type` WRITE;
/*!40000 ALTER TABLE `vehicle_type` DISABLE KEYS */;
INSERT INTO `vehicle_type` VALUES (1,'személygépkocsi',1,1,'2022-02-27 17:20:48',1,'2022-02-27 17:20:48'),(2,'kisteherautó',1,2,'2022-02-17 14:12:44',NULL,NULL),(3,'nagy teherautó',1,2,'2022-02-17 14:13:02',NULL,NULL);
/*!40000 ALTER TABLE `vehicle_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-27 22:32:22
