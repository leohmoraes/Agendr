-- MySQL dump 10.13  Distrib 5.5.39, for Linux (x86_64)
--
-- Host: localhost    Database: whatwhen
-- ------------------------------------------------------
-- Server version	5.5.39-log

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
-- Table structure for table `what_milestones`
--

DROP TABLE IF EXISTS `what_milestones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `what_milestones` (
  `milestone_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `milestone_title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `milestone_desc` text CHARACTER SET latin1 NOT NULL,
  `milestone_due` date NOT NULL,
  `milestone_done` int(11) NOT NULL DEFAULT '0',
  `milestone_archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`milestone_id`),
  UNIQUE KEY `milestone_id` (`milestone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `what_projects`
--

DROP TABLE IF EXISTS `what_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `what_projects` (
  `project_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `project_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `project_start` date NOT NULL,
  `project_due` date NOT NULL,
  `project_done` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `project_id` (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `what_users`
--

DROP TABLE IF EXISTS `what_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `what_users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_password` varchar(128) CHARACTER SET latin1 NOT NULL,
  `user_salt` varchar(64) CHARACTER SET latin1 NOT NULL,
  `user_apikey` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `user_confirmed` int(11) NOT NULL DEFAULT '0',
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_street` text COLLATE utf8_unicode_ci NOT NULL,
  `user_state` text COLLATE utf8_unicode_ci NOT NULL,
  `user_country` text COLLATE utf8_unicode_ci NOT NULL,
  `user_postcode` text COLLATE utf8_unicode_ci NOT NULL,
  `user_tel` text COLLATE utf8_unicode_ci NOT NULL,
  `user_maxprojects` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`user_email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-16 19:59:24
