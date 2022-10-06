-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: proyectos_de_grado
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `Codigo_Adm` int(15) NOT NULL,
  `Nombre_Adm` varchar(50) NOT NULL,
  `Apellidos_Adm` varchar(50) NOT NULL,
  `Cedula_Adm` int(15) NOT NULL,
  `Cel_Adm` int(15) NOT NULL,
  `Correo_Adm` varchar(40) NOT NULL,
  PRIMARY KEY (`Codigo_Adm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (0,'admin','admin',0,123456789,'admin@admin.co'),(123456789,'Secretaria','Estudiantil',123456789,2147483647,'secretaria@udenar.edu.co'),(217036022,'Santiago','Coral',1088219264,2147483647,'santiagocoral80@gmail.com');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docentes`
--

DROP TABLE IF EXISTS `docentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docentes` (
  `Codigo_Doc` int(15) NOT NULL,
  `Cedula_Doc` int(11) NOT NULL,
  `Nombre_Doc` varchar(50) NOT NULL,
  `Apellidos_Doc` varchar(50) NOT NULL,
  `Cel_Doc` int(15) NOT NULL,
  `Correo_Doc` varchar(50) NOT NULL,
  `Codigo_Est` int(15) DEFAULT NULL,
  `Cod_proyecto` int(15) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Doc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes`
--

LOCK TABLES `docentes` WRITE;
/*!40000 ALTER TABLE `docentes` DISABLE KEYS */;
INSERT INTO `docentes` VALUES (111,111,'Pablo','Paez',222222,'alejogq28@gmail.com',222,32),(456,1088219264,'Jorge','Arévalo',123456789,'alexandererazo184@gmail.com',123,30),(555,555,'Juan','Perez',11111111,'alejogq28@gmail.com',333,31),(1000,1088219264,'Otro','Docente',13245679,'alexandererazo184@gmail.com',123,30),(1001,1088219264,'Santiago S','Coral',235645623,'santiagocoral80@gmail.com',0,0);
/*!40000 ALTER TABLE `docentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiantes` (
  `Codigo_Est` int(15) NOT NULL,
  `Cedula_Est` int(11) NOT NULL,
  `Nombre_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos_Est` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `Programa_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Correo_Est` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Cel_Est` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `Sede_Est` enum('Ipiales','Tuquerres','Tumaco','Pasto') COLLATE utf8_spanish_ci NOT NULL,
  `Codigo_Doc` int(15) DEFAULT NULL,
  `Cod_proyecto` int(15) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Est`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiantes`
--

LOCK TABLES `estudiantes` WRITE;
/*!40000 ALTER TABLE `estudiantes` DISABLE KEYS */;
INSERT INTO `estudiantes` VALUES (123,1088219264,'Santiago Alejandro','Coral','ingenieria de sistemas','santiagocoral80@gmail.com','321548526','Tuquerres',456,30),(222,222,'Diana','Gomez','Ingenieria','alejogq28@gmail.com','55555','Ipiales',111,32),(333,333,'Alejandro','Guerrero','Ingenieria','alejogq28@gmail.com','88888','Ipiales',555,31);
/*!40000 ALTER TABLE `estudiantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `Cod_proyecto` int(15) NOT NULL AUTO_INCREMENT,
  `Nombre_proyecto` varchar(50) NOT NULL,
  `url_proy` varchar(500) NOT NULL,
  `Cod_Est` int(15) NOT NULL,
  `comentarios` varchar(1000) DEFAULT NULL,
  `calificaciones` varchar(50) NOT NULL DEFAULT 'NO APROBADO',
  `Codigo_Doc` int(15) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `url_aval` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`Cod_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` VALUES (30,'Prueba','documentos/123/Cosmovision.docx',123,'. Primer comentario.\n Segundo comentario.\n .\n ','APROBADO',456,'2022-09-09 14:51:22','documentos/456/Cosmovision3.docx'),(31,'Sistema Operativo','documentos/333/Actividad cosmovision.docx',333,'','APROBADO',555,'2022-10-03 23:30:30','documentos/555/Actividad analisis1.docx'),(32,'Proyecto Aplicacion','documentos/222/BLANCA FLOR.docx',222,'','APROBADO',111,'2022-10-04 22:41:16','documentos/111/Cosmovision.docx');
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre_Usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Tipo_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`Id_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2147483648 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (5,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin',1),(111,'111','6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2','DOCENTE',3),(123,'123','4a22af727c7201f7d3a7632d0b13e9d805753c3d','ESTUDIANTE',2),(222,'222','1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9','ESTUDIANTE',2),(333,'333','43814346e21444aaf4f70841bf7ed5ae93f55a9d','ESTUDIANTE',2),(456,'456','4a22af727c7201f7d3a7632d0b13e9d805753c3d','DOCENTE',3),(555,'555','cfa1150f1787186742a9a884b73a43d8cf219f9b','DOCENTE',3),(1001,'1001','4a22af727c7201f7d3a7632d0b13e9d805753c3d','DOCENTE',3),(123456789,'123456789','f7c3bc1d808e04732adf679965ccc34ca7ae3441','ADMINISTRADOR',1),(217036022,'217036022','4a22af727c7201f7d3a7632d0b13e9d805753c3d','ADMINISTRADOR',1),(218036062,'1000','4a22af727c7201f7d3a7632d0b13e9d805753c3d','DOCENTE',3),(2147483647,'2148798756','4c042bd61f45cd872c79519c4e8f9c52066bf662','ESTUDIANTE',2);
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

-- Dump completed on 2022-10-06  0:38:24
