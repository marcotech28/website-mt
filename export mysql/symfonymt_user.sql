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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complement_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `nom_societe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_confirmed` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'acavanne@campus28.fr','[\"ROLE_ADMIN\"]','$2y$13$/Wl/.GPyqYbtx1U6lz2ZRecn0.0J2OfvcGsG6vbBVtzWKneVOAcJK','Antoine','Cavanne','0630320078','France','5 rue des camomilles',NULL,'Chartres','28000',0,'fefre','frffrefre',0),(2,'antodedeznin.cavanne@outlook.fr','[]','$2y$13$8Qb0CJn6mzBF0it.sPAi7unko5C5rOgaCFQaVpz0HdqtzUu35f19S','jean','bernard','060606','France','Une adresse','Un complement','Chartres','28000',0,'060606','une fonction',0),(3,'antonin.cavanne@outlook.fr','[]','$2y$13$kzr18HHj4JESgG2unoL75.WF2v6g3oft1kcZBZk8pQW7rUS4jCBmu','compte','pro','06060606','France','Une adresse','Un complement adresse','Chartres','28000',1,'Pierre','ggrt',1),(4,'erfer@frefrfrefree','[]','$2y$13$BztKKV/HNqdYq02OcYOipu9YPK/BiJlaQ/EhzEqufJS97qzytHIAC','frefre','ferf','frefre','frefre','frefre','frefre','frefre','frefre',1,'frefre','frefre',1),(5,'frfrefre@frfrefre','[]','$2y$13$h42LdNRqSx3/XjW00glCrun8Y1bgqTdGYP8vWz9NboVTCN.XVQ8JW','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre',1,'frfrefre','frfrefre',1),(6,'frfrefre@frfrefrededez','[]','$2y$13$F4yl/skD0/n09p9WiVhDfe3zcxLuDffMeCYYI1psqERd2hQHW01ke','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre','frfrefre',1,'frfrefre','frfrefre',1),(7,'fefre@fefrefrefrefrefrejfreiofreoifjerifjreofjeroijfreojfriejfrefrefre','[]','$2y$13$83KqRf82BqmwIi0VpMqE/ecfdHlssv2vM8Io4p2xnNYuYHybknJLi','fefre','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'fefre','fefre',1),(8,'fefre@fefred','[]','$2y$13$O/3y7DEIqJV8nPjTtOr.SOUqrPwZWYMBl2gvqlipuV0R8plt6Jt3W','fefre','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'fefre','fefre',0),(9,'frefrefre.com','[]','$2y$13$alcHhDzgKSlNMcTjiCkBNexHmSVEtR1bkXguh2S1zs8eNHqZC63re','fefre','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'aaaaa','fefre',1),(10,'fefrefrefre@fefredffff','[]','$2y$13$HvvFXQYWPDdBLlqctHnAxOihxrkcl9X9genXrdrYqbjXpY5WqMshy','fefre','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'aaaaa','fefre',1),(11,'frefreferfefrefrefre@fefredffff','[]','$2y$13$FVhvM.TDFwUu6dFnBfRddOQeugm5LmKmw7rizhjTvnfJX6zb1f52G','PRENOM','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'aaaaa','fefre',1),(12,'frefreferfefrefrefre@feffredffff','[]','$2y$13$uaTI7HSCKPwkkaFaFLYdrOHalJZjfExk1gw2VVbFWetrtBZU4V9Gq','zzzzzzzzPRENOMzzzzzzzzz','fefre','fefre','fefre','fefre','fefre','fefre','fefre',1,'aaaaa','fefre',1),(13,'rfrefre@rfrefre','[]','$2y$13$qweDXlj1gnceT523jaROkOpFHnf8cXdvndwQS1ZZxR9oRjmKrEH56','rfrefre','rfrefre','rfrefre','rfrefre','rfrefre','rfrefre','rfrefre','rfrefre',1,'rfrefre','rfrefre',0),(14,'frefrefr@frefrefr','[]','$2y$13$QCWcat5j/HPfLC.okQ7tle8VRWxnZ3T8mTIPmQyGhbfku3sJ/mD5.','frefrefr','frefrefr','frefrefr','frefrefr','frefrefr','frefrefr','frefrefr','frefrefr',1,'frefrefr','frefrefr',1),(15,'FREFRE@FREFREFREFRE','[]','$2y$13$ih/SlY1D1yF5o3essDTZVO8w02Q7UI/13UX0YpHNL2ApfSJQ0z5LW','FREFRE','FREFRE','errtg4','errtg4','errtg4','errtg4','errtg4','errtg4',1,'FREFRE','FREFRE',1),(16,'freferfrhh@freferfrhh','[]','$2y$13$B25uAP3ug5.Lvgs60UvTFONuol4T4FjqDTSlMn.pDvE9yx7/u6Fxi','freferfrhh','freferfrhh','freferfrhh','freferfrhh','freferfrhh','freferfrhh','freferfrhh','freferfrhh',1,'freferfrhh','freferfrhh',0),(17,'rfrtg@rfrtgcfrfre','[]','$2y$13$6zcxFN/i1QKp45vXNUKdUOZ69Jlg5.c9qrKpg.AR89Zq6/LrH.pyu','rfrtg','rfrtg','rfrtg','rfrtg','rfrtg','rfrtg','rfrtg','rfrtg',1,'rfrtg','rfrtg',0),(18,'rggtr@rggtrpllp','[]','$2y$13$r2ThLroTIaNMiY6X2euxhOnKqmBCkSfZraYhzxYPyOdUmlNyKDV7e','rggtr','rggtr','rggtr','rggtr','rggtr','rggtr','rggtr','rggtr',1,'rggtr','rggtr',0),(19,'rggtrgtrgr@rggtrgtrgr','[]','$2y$13$ls3LaEAiNn1nzkAzFabivOm7Wa6ClZuCbdrdueeUw2LzJjxgqYiIC','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr','rggtrgtrgr',1,'rggtrgtrgr','rggtrgtrgr',1),(20,'frefrefre@erfrefre','[]','$2y$13$0Kg9giBrs9LgxY3dNyPO/OCt8RcIUxVnC8/dnQr.Mi8a1g8sUyZ0i','frefrefre','frefrefre','dederfre','ferfre','frefrefrefre','ferfre','ferfre','ferfre',1,'ferfref','reffrefre',0),(21,'ergregrg@ergregrg','[]','$2y$13$b/916nPO1E.kHjuQx24CaeVnXTfOWLURPL1NzWdwJY06E5kwTJ376','ergregrg','ergregrg','ergregrg','ergregrg','ergregrg','ergregrg','ergregrg','ergregrg',1,'ergregrg','ergregrg',0),(22,'grtgtrgtr@grtgtrgtr','[]','$2y$13$ZtQ.UYUl.1LdbtYyZqVQ5OD6Q9vijTTtYh6crIFRGq9s/6.IMqPa2','grtgtrgtr','grtgtrgtr','grtgtrgtr','grtgtrgtr','grtgtrgtr','grtgtrgtr','grtgtrgtr','grtgtrgtr',1,'grtgtrgtr','grtgtrgtr',0),(23,'frefre@frefre','[]','$2y$13$3/PijSfLc5YXwfHKfCr6RO.M0kg.UQhB0qRrUcWGbx6ixUQP0RMzO','frefre','frefre','frefre','frefre','frefre','frefre','frefre','frefre',1,'frefre','frefre',0),(24,'frefre@frefrekjjk','[]','$2y$13$grYmroJ6A1qo6hgTz06z6uy2gz5MQd2KQxYNP1yxFn/82QP3Ixevu','frefre','frefre','frefre','frefre','frefre','frefre','frefre','frefre',1,'frefre','frefre',0),(25,'rfrfer@rfrfer','[]','$2y$13$iveWdLycUi5JNNqkSeU0iONAywxFuRUfA.X7GSg0Vec9o.OgvFe3C','rfrfer','rfrfer','rfrfer','rfrfer','rfrfer','rfrfer','rfrfer','rfrfer',1,'rfrfer','rfrfer',0),(26,'frefrefrefer@frefrefrefer','[]','$2y$13$GzC2uIABJQGB7kvtsPc9qOTT6oxKv0kIM7D55FuImtAxHfhlsV66K','frefrefrefer','frefrefrefer','frefrefrefer','frefrefrefer','frefrefrefer','frefrefrefer','frefrefrefer','frefrefrefer',1,'frefrefrefer','frefrefrefer',0),(27,'gtrgtrg@gtrgtrg','[]','$2y$13$8gXjG8uvNb8fmKm30GpEE.FxpX/3/HLaG/DJIjmr8JiDHWxFeA8JC','gtrgtrg','gtrgtrg','gtrgtrg','gtrgtrg','gtrgtrg','gtrgtrg','gtrgtrg','gtrgtrg',1,'gtrgtrg','gtrgtrg',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-20 15:50:32
