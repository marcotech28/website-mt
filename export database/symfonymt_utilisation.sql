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
-- Table structure for table `utilisation`
--

DROP TABLE IF EXISTS `utilisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilisation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` int DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_B02A3C43BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_B02A3C43BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisation`
--

LOCK TABLES `utilisation` WRITE;
/*!40000 ALTER TABLE `utilisation` DISABLE KEYS */;
INSERT INTO `utilisation` VALUES (1,'Handbikes manuels','a','handbikes-manuels',11,'Les handbikes manuels'),(2,'Handbikes hybrides','a','handbikes-hybrides',11,'Les handbikes hybrides'),(3,'Lomo 360','a','lomo-360',12,'Les lomo 360'),(4,'Handbikes Tout Électrique','a','handbikes-tout-electrique',12,'Les handbikes tout électrique'),(5,'Tricycles Van Raam Adulte','a','trycicles-vanraam-adule',13,'Les trycicles Van Raam Adulte'),(6,'Tricycles Van Raam Tandem','a','tricycles-vanraam-tandem',14,'Les tricycles Van Raam Tandem'),(7,'Tricycles Van Raam Transport','a','tricycles-vanraam-transport',15,'Les tricycles Van Raam Transport'),(8,'Tricycles Draisin Adulte','a','tricycles-draisin-adulte',16,'Les tricycles Draisin Adulte'),(9,'Tricycles Draisin Sénior','a','tricycles-draisin-senior',16,'Les tricycles Draisin Sénior'),(10,'Vélo - Tricycles Tandem Draisin','a','velo-tricycles-tandem-draisin',16,'Les Vélo et Tricycles Tandem Draisin');
/*!40000 ALTER TABLE `utilisation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-03 16:53:46
