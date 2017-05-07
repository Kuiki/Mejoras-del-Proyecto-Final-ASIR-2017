-- MySQL dump 10.13  Distrib 5.7.17, for Linux (i686)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `CATEGORIAS`
--

DROP TABLE IF EXISTS `CATEGORIAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORIAS` (
  `CodCategoria` char(6) NOT NULL,
  `NombreCategoria` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`CodCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORIAS`
--

LOCK TABLES `CATEGORIAS` WRITE;
/*!40000 ALTER TABLE `CATEGORIAS` DISABLE KEYS */;
INSERT INTO `CATEGORIAS` VALUES ('AND004','Android'),('LIN001','GNU/Linux'),('PCS005','PCs'),('RAS003','Raspberry'),('WIN002','Windows');
/*!40000 ALTER TABLE `CATEGORIAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COMENTARIOS`
--

DROP TABLE IF EXISTS `COMENTARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMENTARIOS` (
  `CodUsuario` char(7) NOT NULL,
  `IdEntrada` char(7) NOT NULL,
  `Comentario` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`CodUsuario`,`IdEntrada`),
  KEY `en_co` (`IdEntrada`),
  CONSTRAINT `en_co` FOREIGN KEY (`IdEntrada`) REFERENCES `ENTRADAS` (`IdEntrada`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `us_co` FOREIGN KEY (`CodUsuario`) REFERENCES `USUARIOS` (`CodUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COMENTARIOS`
--

LOCK TABLES `COMENTARIOS` WRITE;
/*!40000 ALTER TABLE `COMENTARIOS` DISABLE KEYS */;
/*!40000 ALTER TABLE `COMENTARIOS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENTRADAS`
--

DROP TABLE IF EXISTS `ENTRADAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENTRADAS` (
  `IdEntrada` char(7) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `FechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Contenido` blob,
  `Publicado` char(1) DEFAULT NULL,
  `FechaPublicacion` datetime DEFAULT NULL,
  `UltimaModificacion` datetime DEFAULT NULL,
  `Visitas` int(5) DEFAULT NULL,
  `CodUsuario` char(7) NOT NULL,
  PRIMARY KEY (`IdEntrada`,`CodUsuario`),
  KEY `us_en` (`CodUsuario`),
  CONSTRAINT `us_en` FOREIGN KEY (`CodUsuario`) REFERENCES `USUARIOS` (`CodUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENTRADAS`
--

LOCK TABLES `ENTRADAS` WRITE;
/*!40000 ALTER TABLE `ENTRADAS` DISABLE KEYS */;
/*!40000 ALTER TABLE `ENTRADAS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PERTENECE`
--

DROP TABLE IF EXISTS `PERTENECE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERTENECE` (
  `IdEntrada` char(7) NOT NULL,
  `CodCategoria` char(6) NOT NULL,
  PRIMARY KEY (`IdEntrada`,`CodCategoria`),
  KEY `ca_pe` (`CodCategoria`),
  CONSTRAINT `ca_pe` FOREIGN KEY (`CodCategoria`) REFERENCES `CATEGORIAS` (`CodCategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `en_pe` FOREIGN KEY (`IdEntrada`) REFERENCES `ENTRADAS` (`IdEntrada`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PERTENECE`
--

LOCK TABLES `PERTENECE` WRITE;
/*!40000 ALTER TABLE `PERTENECE` DISABLE KEYS */;
/*!40000 ALTER TABLE `PERTENECE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USUARIOS`
--

DROP TABLE IF EXISTS `USUARIOS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USUARIOS` (
  `CodUsuario` char(7) NOT NULL,
  `Alias` varchar(25) DEFAULT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Apellidos` varchar(50) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `CorreoElectronico` varchar(100) DEFAULT NULL,
  `TipoUsuario` varchar(13) DEFAULT NULL,
  `Contraseña` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`CodUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIOS`
--

LOCK TABLES `USUARIOS` WRITE;
/*!40000 ALTER TABLE `USUARIOS` DISABLE KEYS */;
INSERT INTO `USUARIOS` VALUES ('ANME002','anita96','Ana','Meleiro Sanchez','M','1997-03-04','ana97@gmail.com','Estandar','786d67fd42a7c49d159cba262f3ddb75'),('FEMO004','Felipe','Felipe','Montes Sierra','H','1996-06-01','feli91@hotmail.com','Estandar','81dc9bdb52d04dc20036dbd8313ed055'),('lual001','Kuiki','Luigui','Alvarez Ramirez','H','1995-07-28','luigui916@gmail.com','Administrador','4cea49b56f08bcdcfc92844186c20ca6'),('MACA004','alpachilo','Manuel','Carrasco Gomez','H','2017-02-17','alpachilo12@gmail.com','Estandar','81dc9bdb52d04dc20036dbd8313ed055');
/*!40000 ALTER TABLE `USUARIOS` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-10 19:32:01
