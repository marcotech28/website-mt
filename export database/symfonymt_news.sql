-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: symfonymt
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `auteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (7,'Titre de mon actualité','2023-02-22','Antonin','sous titre','test2','test','blabla blabla\r\nblabla blalalllalaaaaa fre ,fr fre\r\ndfefrfrfrefre',NULL),(8,'Une deuxieme actu','2018-01-01','Bernard','sous titre','test3','test','contenu test',NULL),(9,'Une nouvelle actu','2023-02-23','Antoninn','sous titre','test4','test','contenu test',NULL),(10,'frefre','2018-01-01','ferfre','sous titre','test5','test','contenu test',NULL),(11,'erfre','2018-01-01','freferfer','sous titre','test6','testt','contenu test',NULL),(12,'Titre','2026-01-01','pierre','Sous titre','test','test','contenu test gtr gtr g\r\n\r\n\r\n\r\ntrg\r\ntr\r\ngtrgtrgtrg trgj rtjg jgtr.\r\ngtrgrtr.','dezdezdez'),(13,'Nouveau Scooter ATTO SPORT','2023-06-30','La rédaction','Le nouveau SCOOTER ATTO SPORT bientôt disponible !','test1','test','contenu test',NULL),(14,'dezdez','2018-01-01','dzedez','ez','dezde','zdezdez','contenu test',NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-04 16:29:42
