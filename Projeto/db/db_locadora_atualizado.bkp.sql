-- MySQL dump 10.13  Distrib 8.0.11, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_estaciona_facil
-- ------------------------------------------------------
-- Server version	8.0.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_cidade` (
  `cod_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `cidade` varchar(100) NOT NULL,
  `cod_estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_cidade`),
  KEY `fk_cidade_estado` (`cod_estado`),
  CONSTRAINT `fk_cidade_estado` FOREIGN KEY (`cod_estado`) REFERENCES `tbl_estado` (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
INSERT INTO `tbl_cidade` VALUES (1,'JANDIRA',1);
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_endereco`
--

DROP TABLE IF EXISTS `tbl_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_endereco` (
  `cod_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(55) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `cod_cidade` int(11) NOT NULL,
  PRIMARY KEY (`cod_endereco`),
  KEY `fk_endereco_cidade` (`cod_cidade`),
  CONSTRAINT `fk_endereco_cidade` FOREIGN KEY (`cod_cidade`) REFERENCES `tbl_cidade` (`cod_cidade`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_endereco`
--

LOCK TABLES `tbl_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_endereco` DISABLE KEYS */;
INSERT INTO `tbl_endereco` VALUES (1,'Rua Antonio gomes dos santos','03','Parque dos logos','06622345',1);
/*!40000 ALTER TABLE `tbl_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_estado` (
  `cod_estado` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,'SÃO PAULO');
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fabricante`
--

DROP TABLE IF EXISTS `tbl_fabricante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_fabricante` (
  `cod_fabricante` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_fabricante`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fabricante`
--

LOCK TABLES `tbl_fabricante` WRITE;
/*!40000 ALTER TABLE `tbl_fabricante` DISABLE KEYS */;
INSERT INTO `tbl_fabricante` VALUES (1,'HYUNDAI'),(2,'MAZDA'),(3,'MUSTANG');
/*!40000 ALTER TABLE `tbl_fabricante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mensalista`
--

DROP TABLE IF EXISTS `tbl_mensalista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_mensalista` (
  `cod_mensalista` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  PRIMARY KEY (`cod_mensalista`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalista`
--

LOCK TABLES `tbl_mensalista` WRITE;
/*!40000 ALTER TABLE `tbl_mensalista` DISABLE KEYS */;
INSERT INTO `tbl_mensalista` VALUES (1,'David Silva Souza','david@terra.com','435-423-668/03');
/*!40000 ALTER TABLE `tbl_mensalista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mensalista_endereco`
--

DROP TABLE IF EXISTS `tbl_mensalista_endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_mensalista_endereco` (
  `cod_mensalista_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `cod_mensalista` int(11) NOT NULL,
  `cod_endereco` int(11) NOT NULL,
  PRIMARY KEY (`cod_mensalista_endereco`),
  KEY `fk_mensalista_endereco` (`cod_endereco`),
  KEY `fk_endereco_mensalista` (`cod_mensalista`),
  CONSTRAINT `fk_endereco_mensalista` FOREIGN KEY (`cod_mensalista`) REFERENCES `tbl_mensalista` (`cod_mensalista`),
  CONSTRAINT `fk_mensalista_endereco` FOREIGN KEY (`cod_endereco`) REFERENCES `tbl_endereco` (`cod_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalista_endereco`
--

LOCK TABLES `tbl_mensalista_endereco` WRITE;
/*!40000 ALTER TABLE `tbl_mensalista_endereco` DISABLE KEYS */;
INSERT INTO `tbl_mensalista_endereco` VALUES (1,1,1);
/*!40000 ALTER TABLE `tbl_mensalista_endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mensalista_telefone`
--

DROP TABLE IF EXISTS `tbl_mensalista_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_mensalista_telefone` (
  `cod_mensalista_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `cod_mensalista` int(11) NOT NULL,
  `cod_telefone` int(11) NOT NULL,
  PRIMARY KEY (`cod_mensalista_telefone`),
  KEY `fk_mensalista_telefone` (`cod_telefone`),
  KEY `fk_telefone_mensalista` (`cod_mensalista`),
  CONSTRAINT `fk_mensalista_telefone` FOREIGN KEY (`cod_telefone`) REFERENCES `tbl_telefone` (`cod_telefone`),
  CONSTRAINT `fk_telefone_mensalista` FOREIGN KEY (`cod_mensalista`) REFERENCES `tbl_mensalista` (`cod_mensalista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mensalista_telefone`
--

LOCK TABLES `tbl_mensalista_telefone` WRITE;
/*!40000 ALTER TABLE `tbl_mensalista_telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mensalista_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_movimentacao`
--

DROP TABLE IF EXISTS `tbl_movimentacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_movimentacao` (
  `cod_movimento` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(8) NOT NULL,
  `modelo_carro` varchar(15) NOT NULL,
  `data_hora_entrada` datetime NOT NULL,
  `data_hora_saida` datetime DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `tempo_permanencia` int(11) NOT NULL DEFAULT '0',
  `valor_pago` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`cod_movimento`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_movimentacao`
--

LOCK TABLES `tbl_movimentacao` WRITE;
/*!40000 ALTER TABLE `tbl_movimentacao` DISABLE KEYS */;
INSERT INTO `tbl_movimentacao` VALUES (8,'JGN-7852','Crossfox','2019-05-23 16:16:54',NULL,'A',0,0.00);
/*!40000 ALTER TABLE `tbl_movimentacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_preco`
--

DROP TABLE IF EXISTS `tbl_preco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_preco` (
  `cod_preco` int(11) NOT NULL AUTO_INCREMENT,
  `valor_primeira_hora` decimal(5,2) NOT NULL,
  `valor_demais_horas` decimal(5,2) NOT NULL,
  `tempo_tolerancia` int(11) NOT NULL,
  `data_fim` datetime DEFAULT NULL,
  PRIMARY KEY (`cod_preco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_preco`
--

LOCK TABLES `tbl_preco` WRITE;
/*!40000 ALTER TABLE `tbl_preco` DISABLE KEYS */;
INSERT INTO `tbl_preco` VALUES (4,5.00,3.00,5,NULL);
/*!40000 ALTER TABLE `tbl_preco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_telefone`
--

DROP TABLE IF EXISTS `tbl_telefone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_telefone` (
  `cod_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cod_telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_telefone`
--

LOCK TABLES `tbl_telefone` WRITE;
/*!40000 ALTER TABLE `tbl_telefone` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_telefone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_veiculo`
--

DROP TABLE IF EXISTS `tbl_veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tbl_veiculo` (
  `cod_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  `placa` varchar(7) NOT NULL,
  `modelo_carro` varchar(30) NOT NULL,
  `cod_fabricante` int(11) NOT NULL,
  `cod_mensalista` int(11) NOT NULL,
  PRIMARY KEY (`cod_veiculo`),
  KEY `fk_veiculo_fabricante` (`cod_fabricante`),
  KEY `fk_veiculo_mensalista_idx` (`cod_mensalista`),
  CONSTRAINT `fk_veiculo_fabricante` FOREIGN KEY (`cod_fabricante`) REFERENCES `tbl_fabricante` (`cod_fabricante`),
  CONSTRAINT `fk_veiculo_mensalista` FOREIGN KEY (`cod_mensalista`) REFERENCES `tbl_mensalista` (`cod_mensalista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_veiculo`
--

LOCK TABLES `tbl_veiculo` WRITE;
/*!40000 ALTER TABLE `tbl_veiculo` DISABLE KEYS */;
INSERT INTO `tbl_veiculo` VALUES (1,'ABC1234','FUSCA',1,1);
/*!40000 ALTER TABLE `tbl_veiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-24 14:51:05
