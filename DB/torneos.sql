-- MySQL dump 10.13  Distrib 5.5.27, for Win64 (x86)
--
-- Host: localhost    Database: torneos
-- ------------------------------------------------------
-- Server version	5.5.27

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
-- Table structure for table `equipo`
--

DROP TABLE IF EXISTS `equipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipo` (
  `IdEquipo` int(8) NOT NULL AUTO_INCREMENT,
  `NombreEquipo` text COLLATE latin1_general_ci NOT NULL,
  `IdCapitan` int(8) NOT NULL,
  PRIMARY KEY (`IdEquipo`),
  UNIQUE KEY `IdCapitan` (`IdCapitan`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipo`
--

LOCK TABLES `equipo` WRITE;
/*!40000 ALTER TABLE `equipo` DISABLE KEYS */;
INSERT INTO `equipo` VALUES (1,'Real Madrid',11294320),(2,'Manchester City',10871401),(3,'Liverpool',10325493),(4,'Barcelona',10874569);
/*!40000 ALTER TABLE `equipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equiposportorneos`
--

DROP TABLE IF EXISTS `equiposportorneos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equiposportorneos` (
  `IdEquipo` int(8) NOT NULL,
  `IdTorneo` int(8) NOT NULL,
  UNIQUE KEY `IdEquipo` (`IdEquipo`,`IdTorneo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equiposportorneos`
--

LOCK TABLES `equiposportorneos` WRITE;
/*!40000 ALTER TABLE `equiposportorneos` DISABLE KEYS */;
INSERT INTO `equiposportorneos` VALUES (1,1),(1,2),(1,3),(1,4);
/*!40000 ALTER TABLE `equiposportorneos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faltaspartidos`
--

DROP TABLE IF EXISTS `faltaspartidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faltaspartidos` (
  `IdPartido` int(8) NOT NULL,
  `IdEquipo` int(8) NOT NULL,
  `IdJugador` int(8) NOT NULL,
  `TipoFalta` text COLLATE latin1_general_ci NOT NULL COMMENT 'Amarilla/Roja',
  `NumeroAmarrillas` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faltaspartidos`
--

LOCK TABLES `faltaspartidos` WRITE;
/*!40000 ALTER TABLE `faltaspartidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `faltaspartidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `golespartidos`
--

DROP TABLE IF EXISTS `golespartidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `golespartidos` (
  `IdPartido` int(8) NOT NULL,
  `IdEquipo` int(8) NOT NULL,
  `IdJugador` int(8) NOT NULL,
  `NumeroGoles` int(4) NOT NULL,
  KEY `IdPartido` (`IdPartido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `golespartidos`
--

LOCK TABLES `golespartidos` WRITE;
/*!40000 ALTER TABLE `golespartidos` DISABLE KEYS */;
INSERT INTO `golespartidos` VALUES (1,1,1,1),(1,2,2,2),(2,3,3,3),(2,3,6,2),(2,4,5,3),(2,4,11,1),(3,4,16,4),(3,4,17,1),(3,1,18,4),(3,1,22,2),(4,3,12,3),(4,2,19,3),(4,2,24,2),(5,2,13,2),(5,2,7,2),(5,2,2,2),(5,4,4,2),(6,1,10,5),(6,1,15,4),(6,3,20,4),(6,3,28,2),(6,3,14,2);
/*!40000 ALTER TABLE `golespartidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugadores` (
  `Id Jugador` int(8) NOT NULL AUTO_INCREMENT,
  `Id Equipo` int(8) NOT NULL,
  `Id Torneo` int(8) NOT NULL,
  `Nombre` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `Correo` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `Telefono` text COLLATE latin1_general_ci NOT NULL,
  `Fecha Nacimineto` date NOT NULL,
  `Cuenta` varchar(8) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id Jugador`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugadores`
--

LOCK TABLES `jugadores` WRITE;
/*!40000 ALTER TABLE `jugadores` DISABLE KEYS */;
INSERT INTO `jugadores` VALUES (1,1,1,'Claudio Castellanos','prueba_@gmail.com','93146559','1991-01-01','11294320'),(2,2,1,'Javier Espinal','prueba_@gmail.com','97401938','1991-01-01','11190979'),(3,3,1,'Jafet Baquedano','prueba_@gmail.com','93878258','1991-01-01','10851131'),(4,4,1,'Marco Flores','prueba_@gmail.com','97525789','1991-01-01','11304670'),(5,4,1,'Fernando Pineda','prueba_@gmail.com','97433796','1991-01-01','10565707'),(6,3,1,'Ricardo Zacapa','prueba_@gmail.com','92079436','1991-01-01','10275306'),(7,2,1,'Jose Landa','prueba_@gmail.com','99808941','1991-01-01','11092871'),(8,1,1,'Luis Cordoba','prueba_@gmail.com','99773031','1991-01-01','10937063'),(9,2,1,'Armando Pineda','prueba_@gmail.com','98817305','1991-01-01','10151455'),(10,1,1,'Barner Rodriguez','prueba_@gmail.com','95885065','1991-01-01','10792097'),(11,4,1,'Max Baires','prueba_@gmail.com','97079046','1991-01-01','11126457'),(12,3,1,'Carlos Calderon','prueba_@gmail.com','96113083','1991-01-01','11326647'),(13,2,1,'Erwin Boquin','prueba_@gmail.com','95287384','1991-01-01','10672181'),(14,3,1,'Miguel Calderon','prueba_@gmail.com','97911992','1991-01-01','10315583'),(15,1,1,'Oscar Aguirre','prueba_@gmail.com','94226139','1991-01-01','11092339'),(16,4,1,'Gerrardo Midence','prueba_@gmail.com','93104625','1991-01-01','10626370'),(17,4,1,'Angel Hernandez','prueba_@gmail.com','91870606','1991-01-01','10794150'),(18,1,1,'Martin Pastora','prueba_@gmail.com','92244786','1991-01-01','11216665'),(19,2,1,'Mario Portillo','prueba_@gmail.com','99919052','1991-01-01','10871401'),(20,3,1,'Denis Lardizabal','prueba_@gmail.com','95798983','1991-01-01','10607529'),(21,3,1,'Manuel Gomez','prueba_@gmail.com','98343787','1991-01-01','10325493'),(22,1,1,'Rodolfo Fonseca','prueba_@gmail.com','98382144','1991-01-01','10217690'),(23,4,1,'Anselmo Jaramillo','prueba_@gmail.com','95602112','1991-01-01','10912500'),(24,2,1,'Roberto Figueroa','prueba_@gmail.com','91112929','1991-01-01','10230371'),(25,2,1,'Juan Perez','prueba_@gmail.com','92795964','1991-01-01','10675767'),(26,1,1,'Swammy Antunez','prueba_@gmail.com','93645883','1991-01-01','10478855'),(27,4,1,'Edgar Hernandez','prueba_@gmail.com','96651362','1991-01-01','10770741'),(28,3,1,'Luis Benda?a','prueba_@gmail.com','94219058','1991-01-01','10669444');
/*!40000 ALTER TABLE `jugadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidos`
--

DROP TABLE IF EXISTS `partidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidos` (
  `IdPartido` int(8) NOT NULL AUTO_INCREMENT,
  `IdEquipoA` int(8) NOT NULL,
  `IdEquipoB` int(8) NOT NULL,
  `FechaPartido` date NOT NULL,
  `Lugar` text COLLATE latin1_general_ci NOT NULL,
  `Jornada` int(4) NOT NULL,
  `GolesA` int(4) NOT NULL,
  `GolesB` int(4) NOT NULL,
  PRIMARY KEY (`IdPartido`),
  UNIQUE KEY `IdEquipoA` (`IdEquipoA`,`IdEquipoB`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidos`
--

LOCK TABLES `partidos` WRITE;
/*!40000 ALTER TABLE `partidos` DISABLE KEYS */;
INSERT INTO `partidos` VALUES (1,1,2,'0000-00-00','Canchita ',1,1,2),(2,3,4,'0000-00-00','Canchita ',1,2,4),(3,4,1,'0000-00-00','Canchita ',1,5,6),(4,3,2,'0000-00-00','Canchita ',2,3,5),(5,2,4,'0000-00-00','Canchita ',2,6,2),(6,1,3,'0000-00-00','Canchita ',2,9,8);
/*!40000 ALTER TABLE `partidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `torneo`
--

DROP TABLE IF EXISTS `torneo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `torneo` (
  `IdTorneo` int(8) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE latin1_general_ci NOT NULL,
  `FechaLimiteInscripcion` date NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaLimiteCambios` date NOT NULL,
  `FechaFinal` date NOT NULL,
  `Rama` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`IdTorneo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `torneo`
--

LOCK TABLES `torneo` WRITE;
/*!40000 ALTER TABLE `torneo` DISABLE KEYS */;
INSERT INTO `torneo` VALUES (1,'Emprendedores','0000-00-00','0000-00-00','0000-00-00','0000-00-00','Masculina');
/*!40000 ALTER TABLE `torneo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `IdUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `Usuario` text COLLATE latin1_general_ci NOT NULL,
  `Password` text COLLATE latin1_general_ci NOT NULL,
  `NombreUsuario` text COLLATE latin1_general_ci NOT NULL,
  `ApellidoUsuario` text COLLATE latin1_general_ci NOT NULL,
  `CuentaUsuario` text COLLATE latin1_general_ci NOT NULL,
  `CorreoUsuario` text COLLATE latin1_general_ci NOT NULL,
  `TelefonoUsuario` text COLLATE latin1_general_ci NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `EsAdmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `Usuario` (`Usuario`(30))
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'usuario1','12345','Jafet','Baquedano','11063983','ba@hotmail.com','98745867','0000-00-00',0),(2,'usuario2','12345','Alexis','Sanchez','11030195','A_san@gmail.com','35647859','0000-00-00',1),(3,'usuario3','12345','Raul','Gonzalez','10715105','R_G@unitec.edu','87958485','0000-00-00',0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-06-09  2:40:09
