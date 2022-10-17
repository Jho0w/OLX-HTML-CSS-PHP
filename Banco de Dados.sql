-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: olx
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncio` (
  `idAnuncio` int(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) DEFAULT NULL,
  `descricaoAnuncio` varchar(500) DEFAULT NULL,
  `preco` decimal(15,2) DEFAULT NULL,
  `idCategoria` int(4) DEFAULT NULL,
  `idUser` int(4) DEFAULT NULL,
  `anuncioAtivo` tinyint(1) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  PRIMARY KEY (`idAnuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio`
--

LOCK TABLES `anuncio` WRITE;
/*!40000 ALTER TABLE `anuncio` DISABLE KEYS */;
INSERT INTO `anuncio` VALUES (1,'Primeiro','Esse',180.00,5,20,1,'icone-excluir.png'),(2,'Esse','anuncio',6452.00,0,20,1,'icone-excluir.png'),(3,'teste','',0.00,0,20,0,''),(4,'testeste','',0.00,0,20,0,''),(5,'Anuncio','Todos',18.00,21,32,1,'qrcode_www.instagram.com.png');
/*!40000 ALTER TABLE `anuncio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(4) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (5,'Notebook'),(8,'Mercearia'),(12,'Alimentos'),(20,'Carro'),(21,'Celular');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `idLog` int(5) NOT NULL AUTO_INCREMENT,
  `idUser` int(4) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `descricao1` varchar(50) DEFAULT NULL,
  `descricao2` varchar(50) DEFAULT NULL,
  `descricao3` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (1,20,'2022-10-17 01:10:26','inseriu','user',NULL),(2,20,'2022-10-17 01:10:51','inseriu','user',NULL),(3,20,'2022-10-17 01:10:57','inseriu','user',NULL),(4,20,'2022-10-17 01:10:42','editou','anuncio',NULL),(5,20,'2022-10-17 02:10:54','editou','categoria',NULL);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `idUser` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `idade` date DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  `avatar` blob DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (18,'teste','1997-09-15','123','202cb962ac59075b964b07152d234b70',2,''),(19,'teste','1335-03-12','123456','e10adc3949ba59abbe56e057f20f883e',2,''),(20,'admin','9997-12-18','admin','21232f297a57a5a743894a0e4a801fc3',1,''),(21,'user','1997-12-18','user','ee11cbb19052e40b07aac0ca060c23ee',2,''),(22,'Carolzita','1999-01-14','carol_zita','4de35585e43001e7436de75dae44b67f',2,'coracao.png'),(23,'teste1234','1997-12-18','123654','733d7be2196ff70efaf6913fc8bdcabf',1,''),(24,'teste1234','1997-12-18','123654','733d7be2196ff70efaf6913fc8bdcabf',1,''),(25,'Julio do Nascimento','1972-10-01','julio','81dc9bdb52d04dc20036dbd8313ed055',2,''),(26,'teste','1997-12-18','123','912ec803b2ce49e4a541068d495ab570',2,''),(27,'teste','1997-12-18','123','912ec803b2ce49e4a541068d495ab570',2,''),(28,'asdf','1997-12-18','asdf','912ec803b2ce49e4a541068d495ab570',1,''),(29,'asdf','1997-12-18','asdf','912ec803b2ce49e4a541068d495ab570',1,''),(30,'Janete','1965-08-15','janetesogra','25f9e794323b453885f5181f1b624d0b',2,''),(31,'Jhonnatan','1997-12-18','adminjhow','21232f297a57a5a743894a0e4a801fc3',1,'nossobrigs.png'),(32,'Jane','1977-10-22','jane','5844a15e76563fedd11840fd6f40ea7b',2,'coracao.png'),(33,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',1,''),(34,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',1,''),(35,'teste 2','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',1,''),(36,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',2,''),(37,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',2,''),(38,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',2,''),(39,'teste','1997-09-15','123','d41d8cd98f00b204e9800998ecf8427e',1,'');
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

-- Dump completed on 2022-10-16 21:53:56
