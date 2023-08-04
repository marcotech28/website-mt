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
  `libelle_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte_de_fin` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_B02A3C43BCF5E72D` (`categorie_id`),
  CONSTRAINT `FK_B02A3C43BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisation`
--

LOCK TABLES `utilisation` WRITE;
/*!40000 ALTER TABLE `utilisation` DISABLE KEYS */;
INSERT INTO `utilisation` VALUES (1,'Handbikes manuels','handbike-manuel.jpg','handbikes-manuels',11,'Découvrez notre sélection de handbikes manuels, des vélos adaptés pour tous ceux qui recherchent une expérience de conduite unique et pleine de liberté. Grâce à leur système de propulsion manuelle et leur design ergonomique, ces vélos sont conçus pour offrir une conduite fluide et agréable, que ce soit pour le sport ou les loisirs.','Handbikes manuels','test meta','t'),(2,'Handbikes hybrides','handbike-hybride.png','handbikes-hybrides',11,'Les handbikes hybrides','Handbikes hybrides','test meta','t'),(4,'Handbikes Tout Électrique','handbike-tout-elec.png','handbikes-tout-electrique',11,'Les handbikes tout électrique','Handbikes tout électrique','test meta','t'),(5,'Tricycles individuels','tricycle-vr.png','trycicles-vanraam-adule',12,'Les tricycles Vanraam Adulte.... à faire','Tricycles individuels VR','test meta','t'),(6,'Tricycles Tandem','tricycle-vr-tandem.png','tricycles-vanraam-tandem',12,'Les tricycles Van Raam Tandem','Tricycles tandem VR','test meta','t'),(7,'Tricycles Transport','tricycle-vr-transport.png','tricycles-vanraam-transport',12,'Les tricycles Van Raam Transport','Tricycles transport VR','test meta','t'),(8,'Lomo 360','lomo-360.png','lomo-360',11,'Découvrez nos Lomo 360 !','Lomo 360','test meta','t');
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

-- Dump completed on 2023-08-04 16:29:42
