-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: deesynlab_db
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `tblchat_message`
--

DROP TABLE IF EXISTS `tblchat_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblchat_message` (
  `chat_ID` int(255) NOT NULL AUTO_INCREMENT,
  `to_user_ID` varchar(13) NOT NULL,
  `from_user_ID` varchar(13) NOT NULL,
  `chat_sms` varchar(900) NOT NULL,
  `status` int(11) NOT NULL,
  `last_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_ID`),
  KEY `tbl_user_message_to` (`to_user_ID`),
  KEY `tbl_user_message_from` (`from_user_ID`),
  CONSTRAINT `tbl_user_message_from` FOREIGN KEY (`from_user_ID`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_user_message_to` FOREIGN KEY (`to_user_ID`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblchat_message`
--

LOCK TABLES `tblchat_message` WRITE;
/*!40000 ALTER TABLE `tblchat_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblchat_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcontact`
--

DROP TABLE IF EXISTS `tblcontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcontact` (
  `cont_ID` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `sms` varchar(900) NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cont_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcontact`
--

LOCK TABLES `tblcontact` WRITE;
/*!40000 ALTER TABLE `tblcontact` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcontact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcourse`
--

DROP TABLE IF EXISTS `tblcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcourse` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(20) NOT NULL,
  `coursename` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcourse`
--

LOCK TABLES `tblcourse` WRITE;
/*!40000 ALTER TABLE `tblcourse` DISABLE KEYS */;
INSERT INTO `tblcourse` VALUES (1,'CSS 111','INTRODUCTION TO COMPUTER STYSTEM'),(2,'CSS 114','DATABASE MANAGEMENT '),(3,'ICT 112','HIGH LEVEL PROGRAMMING C#'),(4,'CSS 119','ELEMENTARY STATISTIC'),(5,'COM 101','COMMUNICATION SKILLS'),(6,'DST 100','DEVELOPMENT STUDIES');
/*!40000 ALTER TABLE `tblcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbleducation`
--

DROP TABLE IF EXISTS `tbleducation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbleducation` (
  `ed_ID` int(255) NOT NULL AUTO_INCREMENT,
  `regnumber` varchar(13) NOT NULL,
  `ed_description` varchar(100) NOT NULL,
  PRIMARY KEY (`ed_ID`,`regnumber`,`ed_description`),
  KEY `tbl_user_education_regno` (`regnumber`),
  CONSTRAINT `tbl_user_education_regno` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbleducation`
--

LOCK TABLES `tbleducation` WRITE;
/*!40000 ALTER TABLE `tbleducation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbleducation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfile`
--

DROP TABLE IF EXISTS `tblfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfile` (
  `fileID` int(20) NOT NULL AUTO_INCREMENT,
  `filename` varchar(20) NOT NULL,
  `dateUp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `regnumber` varchar(13) NOT NULL,
  `ID` int(255) NOT NULL,
  `read_in` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`fileID`),
  KEY `tbl_course_user_regno` (`regnumber`),
  KEY `tbl_course_file_id` (`ID`),
  CONSTRAINT `tbl_course_file_id` FOREIGN KEY (`ID`) REFERENCES `tblcourse` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_course_user_regno` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfile`
--

LOCK TABLES `tblfile` WRITE;
/*!40000 ALTER TABLE `tblfile` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbllogin_detail`
--

DROP TABLE IF EXISTS `tbllogin_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbllogin_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` varchar(13) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `tbl_user_login_detail_regno` (`user_ID`),
  CONSTRAINT `tbl_user_login_detail_regno` FOREIGN KEY (`user_ID`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbllogin_detail`
--

LOCK TABLES `tbllogin_detail` WRITE;
/*!40000 ALTER TABLE `tbllogin_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbllogin_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpro_user`
--

DROP TABLE IF EXISTS `tblpro_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpro_user` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `prof_ID` int(100) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
  PRIMARY KEY (`ID`,`prof_ID`,`regnumber`),
  KEY `tbl_profesional_pro_user_ID` (`prof_ID`),
  KEY `tbl_user_pro_user_regno` (`regnumber`),
  CONSTRAINT `tbl_profesional_pro_user_ID` FOREIGN KEY (`prof_ID`) REFERENCES `tblprofesional` (`prof_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_user_pro_user_regno` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpro_user`
--

LOCK TABLES `tblpro_user` WRITE;
/*!40000 ALTER TABLE `tblpro_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpro_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblprofesional`
--

DROP TABLE IF EXISTS `tblprofesional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblprofesional` (
  `prof_ID` int(100) NOT NULL AUTO_INCREMENT,
  `prof_name` varchar(255) NOT NULL,
  PRIMARY KEY (`prof_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblprofesional`
--

LOCK TABLES `tblprofesional` WRITE;
/*!40000 ALTER TABLE `tblprofesional` DISABLE KEYS */;
INSERT INTO `tblprofesional` VALUES (1,'Founder & C.E.O'),(2,'Chief Manager'),(3,'Human Resource(HR)'),(4,'Marketing Officer');
/*!40000 ALTER TABLE `tblprofesional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblskills`
--

DROP TABLE IF EXISTS `tblskills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblskills` (
  `skill_ID` int(100) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(255) NOT NULL,
  PRIMARY KEY (`skill_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblskills`
--

LOCK TABLES `tblskills` WRITE;
/*!40000 ALTER TABLE `tblskills` DISABLE KEYS */;
INSERT INTO `tblskills` VALUES (1,'UI Designer'),(2,'DB Designer'),(3,'Graphics  Designer'),(4,'Security Designer'),(5,'Network Designer'),(6,'Programing(coding)');
/*!40000 ALTER TABLE `tblskills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblskills_user`
--

DROP TABLE IF EXISTS `tblskills_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblskills_user` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `skill_ID` int(100) NOT NULL,
  `regnumber` varchar(13) NOT NULL,
  PRIMARY KEY (`ID`,`skill_ID`,`regnumber`),
  KEY `tbl_user_skills_skill_ID` (`skill_ID`),
  KEY `tbl_user_skills_user_regno` (`regnumber`),
  CONSTRAINT `tbl_user_skills_skill_ID` FOREIGN KEY (`skill_ID`) REFERENCES `tblskills` (`skill_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_user_skills_user_regno` FOREIGN KEY (`regnumber`) REFERENCES `tbluser` (`regnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblskills_user`
--

LOCK TABLES `tblskills_user` WRITE;
/*!40000 ALTER TABLE `tblskills_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblskills_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbluser` (
  `regnumber` varchar(13) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `typeID` int(1) NOT NULL,
  `parmision_status` int(1) NOT NULL DEFAULT '0',
  `location` varchar(100) NOT NULL,
  `regdate` date NOT NULL,
  PRIMARY KEY (`regnumber`),
  KEY `tbl_user_typeid_id` (`typeID`),
  CONSTRAINT `tbl_user_typeid_id` FOREIGN KEY (`typeID`) REFERENCES `tblusertype` (`typeID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbluser`
--

LOCK TABLES `tbluser` WRITE;
/*!40000 ALTER TABLE `tbluser` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbluser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblusertype`
--

DROP TABLE IF EXISTS `tblusertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblusertype` (
  `typeID` int(1) NOT NULL AUTO_INCREMENT,
  `typename` varchar(10) NOT NULL,
  PRIMARY KEY (`typeID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblusertype`
--

LOCK TABLES `tblusertype` WRITE;
/*!40000 ALTER TABLE `tblusertype` DISABLE KEYS */;
INSERT INTO `tblusertype` VALUES (1,'admin'),(2,'user');
/*!40000 ALTER TABLE `tblusertype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-27 10:02:43
