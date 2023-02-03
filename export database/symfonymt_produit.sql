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
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `video1` longtext COLLATE utf8mb4_unicode_ci,
  `video2` longtext COLLATE utf8mb4_unicode_ci,
  `fiche_descriptive` longtext COLLATE utf8mb4_unicode_ci,
  `caracteristiques` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int DEFAULT NULL,
  `utilisation_id` int DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_miniature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avantages` longtext COLLATE utf8mb4_unicode_ci,
  `marque_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`),
  KEY `IDX_29A5EC27BCD54630` (`utilisation_id`),
  KEY `IDX_29A5EC274827B9B2` (`marque_id`),
  CONSTRAINT `FK_29A5EC274827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  CONSTRAINT `FK_29A5EC27BCD54630` FOREIGN KEY (`utilisation_id`) REFERENCES `utilisation` (`id`),
  CONSTRAINT `FK_29A5EC27BCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES (1,'Une description','Handbike City Max 20\'\'','Une description courte.','https://www.youtube.com/embed/MiAaHzh-lBA','https://www.youtube.com/embed/o0HDl-vqGOQ','La fiche descriptive','Nombre de roues :4; Freins  : Électriques; Poids: 35kg;Couleur:Bleue;Cadre:Carbonne;Garantie:2 ans',11,1,'handbike-city-max-20',NULL,NULL,NULL,NULL,NULL,'Manoeuvrable et léger;Stable et facile à diriger;Adultes;Sécuritaire et fonctionnel;Porte bagage;Robuste et élégant',1),(2,'description','Handbike City 7','short description','video 1','video 2','fiche descriptive','Nb de roues:5;Freins:électriques',11,1,'handbike-city-7',NULL,NULL,NULL,NULL,NULL,'Pratique;Léger;Ergonomique et robuste;Ultra rapide',1),(4,'Une description','Handbike hybdride wild 20\'\'','Une description pour le tricycle jean pierre','video','video',NULL,'Nb de roues:5;Freins:électriques',11,2,'handbike-hybdride-wild-20',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',1),(5,'e','Handbike Hybride Neodrives 20\'\'','e',NULL,NULL,NULL,'Nb de roues:5;Freins:électriques',11,2,'handbike-hybride-neodrives-20',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',1),(6,'e','Lomo 360 Micro 12\'\'','e',NULL,NULL,NULL,'Nb de roues:5;Freins:électriques',11,3,'lomo-360-Micro-12',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',2),(7,'e','Lomo 360 16\'\'','e',NULL,NULL,NULL,'Nb de roues:5;Freins:électriques',11,3,'lomo-360-16',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',2),(8,'e','Handbike Tout Électrique 8\'\'','e',NULL,NULL,NULL,'Nb de roues:5;Freins:électriques',11,4,'handbike-tout-electrique-8',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',3),(9,'e','Handbike Tout Électrique 12\'\'','e',NULL,NULL,NULL,'Nb de roues:5;Freins:électriques',11,4,'handbike-tout-electrique-12',NULL,NULL,NULL,NULL,NULL,'blablabla;bla;blabla;blabla',1);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
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
