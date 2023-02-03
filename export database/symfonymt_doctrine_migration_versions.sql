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
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20221129150310','2022-11-29 15:03:15',60),('DoctrineMigrations\\Version20221201093114','2022-12-01 09:31:23',36),('DoctrineMigrations\\Version20221201102514','2022-12-01 10:28:11',59),('DoctrineMigrations\\Version20221205081757','2022-12-05 08:18:08',33),('DoctrineMigrations\\Version20221205083137','2022-12-05 08:31:50',32),('DoctrineMigrations\\Version20221205083417','2022-12-05 08:34:25',20),('DoctrineMigrations\\Version20221206110644','2022-12-06 11:06:57',101),('DoctrineMigrations\\Version20221209081319','2022-12-09 08:13:38',41),('DoctrineMigrations\\Version20221219082600','2022-12-19 08:26:10',38),('DoctrineMigrations\\Version20221219083215','2022-12-19 08:32:26',25),('DoctrineMigrations\\Version20230123083443','2023-01-23 08:34:51',39),('DoctrineMigrations\\Version20230123092044','2023-01-23 09:20:53',27),('DoctrineMigrations\\Version20230123101132','2023-01-23 10:11:38',88),('DoctrineMigrations\\Version20230127124048','2023-01-27 12:41:00',28),('DoctrineMigrations\\Version20230127155153','2023-01-27 15:52:24',39),('DoctrineMigrations\\Version20230127155218','2023-02-01 11:19:10',16),('DoctrineMigrations\\Version20230201111532','2023-02-01 11:19:10',55),('DoctrineMigrations\\Version20230201144143','2023-02-01 14:46:13',42);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
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
