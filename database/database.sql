-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: ALQUILER_COCHES
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ASIGNACION`
--

DROP TABLE IF EXISTS `ASIGNACION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ASIGNACION` (
  `usuario` varchar(20) NOT NULL,
  `vehiculo` varchar(10) NOT NULL,
  PRIMARY KEY (`usuario`,`vehiculo`),
  KEY `vehiculo` (`vehiculo`),
  CONSTRAINT `ASIGNACION_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `USUARIO` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ASIGNACION_ibfk_2` FOREIGN KEY (`vehiculo`) REFERENCES `COCHES` (`matricula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ASIGNACION`
--

LOCK TABLES `ASIGNACION` WRITE;
/*!40000 ALTER TABLE `ASIGNACION` DISABLE KEYS */;
/*!40000 ALTER TABLE `ASIGNACION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COCHES`
--

DROP TABLE IF EXISTS `COCHES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `COCHES` (
  `matricula` varchar(10) NOT NULL,
  `modelo` varchar(25) DEFAULT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `estado` enum('nuevo','seminuevo') DEFAULT NULL,
  `kilometraje` int DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COCHES`
--

LOCK TABLES `COCHES` WRITE;
/*!40000 ALTER TABLE `COCHES` DISABLE KEYS */;
/*!40000 ALTER TABLE `COCHES` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USUARIO`
--

DROP TABLE IF EXISTS `USUARIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `USUARIO` (
  `Nombre` varchar(30) DEFAULT NULL,
  `Apellido` varchar(30) DEFAULT NULL,
  `DNI` char(8) NOT NULL,
  `Telefono` int DEFAULT NULL,
  `FechaNcto` date DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `pswd` varchar(20) DEFAULT NULL,
  `usuario` varchar(20) NOT NULL,
  PRIMARY KEY (`DNI`),
  UNIQUE KEY `ClaveUnica` (`email`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USUARIO`
--

LOCK TABLES `USUARIO` WRITE;
/*!40000 ALTER TABLE `USUARIO` DISABLE KEYS */;
/*!40000 ALTER TABLE `USUARIO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-29 21:26:07