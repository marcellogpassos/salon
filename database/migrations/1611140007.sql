-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: blank
-- ------------------------------------------------------
-- Server version	5.6.30

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
-- Table structure for table `bandeira_cartao`
--

DROP TABLE IF EXISTS `bandeira_cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bandeira_cartao` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bandeira_cartao`
--

LOCK TABLES `bandeira_cartao` WRITE;
/*!40000 ALTER TABLE `bandeira_cartao` DISABLE KEYS */;
INSERT INTO `bandeira_cartao` VALUES (1,'MASTERCARD','2016-10-03 19:08:08','2016-10-03 19:08:08'),(2,'VISA','2016-10-03 19:08:08','2016-10-03 19:08:08'),(3,'HIPERCARD','2016-10-03 19:08:08','2016-10-03 19:08:08'),(4,'AMERICAN EXPRESS','2016-10-03 19:08:08','2016-10-03 19:08:08'),(5,'ELO','2016-10-03 19:08:08','2016-10-03 19:08:08');
/*!40000 ALTER TABLE `bandeira_cartao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_produtos`
--

DROP TABLE IF EXISTS `categorias_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_produtos`
--

LOCK TABLES `categorias_produtos` WRITE;
/*!40000 ALTER TABLE `categorias_produtos` DISABLE KEYS */;
INSERT INTO `categorias_produtos` VALUES (1,'PARA OS CABELOS','2016-06-15 21:37:57',NULL),(2,'PARA O ROSTO','2016-06-15 21:37:57',NULL),(3,'PARA O CORPO','2016-06-15 21:37:57',NULL),(4,'PARA MÃOS / PÉS','2016-06-15 21:37:57',NULL);
/*!40000 ALTER TABLE `categorias_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias_servicos`
--

DROP TABLE IF EXISTS `categorias_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias_servicos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_servicos`
--

LOCK TABLES `categorias_servicos` WRITE;
/*!40000 ALTER TABLE `categorias_servicos` DISABLE KEYS */;
INSERT INTO `categorias_servicos` VALUES (1,'CORTES DE CABELO','2016-06-15 21:37:15',NULL),(2,'TRATAMENTOS DE CABELO','2016-06-15 21:37:15',NULL),(3,'MANICURE / PEDICURE','2016-06-15 21:37:15',NULL),(4,'DEPILAÇÃO','2016-06-15 21:37:15',NULL),(5,'ESTÉTICA FACIAL','2016-06-15 21:37:15',NULL),(6,'ESTÉTICA CORPORAL','2016-06-15 21:37:15',NULL),(7,'OUTROS','2016-06-15 21:37:15',NULL);
/*!40000 ALTER TABLE `categorias_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compras` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cliente_id` bigint(20) DEFAULT NULL,
  `valor_total` float NOT NULL,
  `desconto` float NOT NULL DEFAULT '0',
  `caixa_id` bigint(20) NOT NULL,
  `forma_pagamento_id` bigint(20) NOT NULL,
  `bandeira_cartao_id` bigint(20) DEFAULT NULL,
  `codigo_validacao` char(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_validacao_UNIQUE` (`codigo_validacao`),
  KEY `fk_cliente_compra_idx` (`cliente_id`),
  KEY `fk_forma_pagamento_compra_idx` (`forma_pagamento_id`),
  KEY `fk_caixa_compra_idx` (`caixa_id`),
  KEY `fk_bandeira_compra_idx` (`bandeira_cartao_id`),
  CONSTRAINT `fk_bandeira_compra` FOREIGN KEY (`bandeira_cartao_id`) REFERENCES `bandeira_cartao` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_caixa_compra` FOREIGN KEY (`caixa_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_compra` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_forma_pagamento_compra` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,'2016-10-10 14:33:16',6,90,9,1,2,1,'168FEB','2016-10-07 21:17:01','2016-10-07 21:17:01'),(4,'2016-10-10 14:33:16',6,84,4,1,2,1,'5CDD07','2016-10-10 02:11:47','2016-10-10 02:11:47'),(5,'2016-10-11 14:25:49',NULL,90,9,1,1,NULL,'40C608','2016-10-11 14:25:49','2016-10-11 14:25:49'),(24,'2016-10-15 00:33:02',2,60,6,1,2,1,'BE29C2','2016-10-15 00:33:02','2016-10-15 00:33:02'),(25,'2016-10-18 01:39:50',NULL,30,0,1,1,NULL,'ACHVRR','2016-10-18 01:39:50','2016-10-18 01:39:50'),(26,'2016-10-22 16:43:24',6,45,0,1,2,1,'TSGPCB','2016-10-22 16:43:24','2016-10-22 16:43:24'),(27,'2016-11-14 03:01:03',222,60,0,1,1,NULL,'LMVVHV','2016-11-14 03:01:03','2016-11-14 03:01:03');
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_info`
--

DROP TABLE IF EXISTS `db_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `versao` char(10) NOT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_info`
--

LOCK TABLES `db_info` WRITE;
/*!40000 ALTER TABLE `db_info` DISABLE KEYS */;
INSERT INTO `db_info` VALUES (1,'1608091813','2016-08-09 21:13:54'),(2,'1608121030','2016-08-12 13:30:00'),(3,'1611140007','2016-11-14 03:07:27');
/*!40000 ALTER TABLE `db_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forma_pagamento` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `pede_bandeira_cartao` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descricao_UNIQUE` (`descricao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forma_pagamento`
--

LOCK TABLES `forma_pagamento` WRITE;
/*!40000 ALTER TABLE `forma_pagamento` DISABLE KEYS */;
INSERT INTO `forma_pagamento` VALUES (1,'DINHEIRO','0','2016-08-12 13:22:43','2016-08-12 13:22:43'),(2,'CARTÃO DE DÉBITO','1','2016-08-12 13:22:43','2016-08-12 13:22:43'),(3,'CARTÃO DE CRÉDITO','1','2016-08-12 13:22:43','2016-08-12 13:22:43'),(4,'TRANSFERÊNCIA BANCÁRIA','0','2016-08-12 13:22:43','2016-08-12 13:22:43'),(5,'CHEQUE','0','2016-08-12 13:22:43','2016-08-12 13:22:43');
/*!40000 ALTER TABLE `forma_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_compra`
--

DROP TABLE IF EXISTS `item_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_compra` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(20) NOT NULL,
  `compra_id` bigint(20) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '1',
  `valor_unitario_corrente` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_compra_idx` (`item_id`),
  KEY `fk_compra_item_idx` (`compra_id`),
  CONSTRAINT `fk_compra_item` FOREIGN KEY (`compra_id`) REFERENCES `compras` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_item_compra` FOREIGN KEY (`item_id`) REFERENCES `itens_venda` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_compra`
--

LOCK TABLES `item_compra` WRITE;
/*!40000 ALTER TABLE `item_compra` DISABLE KEYS */;
INSERT INTO `item_compra` VALUES (1,1300,1,1,15,'2016-10-07 21:17:01','2016-10-07 21:17:01'),(2,1301,1,1,15,'2016-10-07 21:17:01','2016-10-07 21:17:01'),(3,2403,1,1,15,'2016-10-07 21:17:01','2016-10-07 21:17:01'),(4,2405,1,3,15,'2016-10-07 21:17:01','2016-10-07 21:17:01'),(5,1105,4,1,15,'2016-10-10 02:11:47','2016-10-10 02:11:47'),(6,2116,4,3,23,'2016-10-10 02:11:47','2016-10-10 02:11:47'),(7,1300,5,1,15,'2016-10-11 14:25:49','2016-10-11 14:25:49'),(8,1301,5,1,15,'2016-10-11 14:25:49','2016-10-11 14:25:49'),(9,2403,5,1,15,'2016-10-11 14:25:49','2016-10-11 14:25:49'),(10,2409,5,1,15,'2016-10-11 14:25:49','2016-10-11 14:25:49'),(11,2405,5,2,15,'2016-10-11 14:25:49','2016-10-11 14:25:49'),(12,1300,24,1,15,'2016-10-15 00:33:02','2016-10-15 00:33:02'),(13,1301,24,1,15,'2016-10-15 00:33:02','2016-10-15 00:33:02'),(14,2403,24,2,15,'2016-10-15 00:33:02','2016-10-15 00:33:02'),(15,1603,25,1,15,'2016-10-18 01:39:50','2016-10-18 01:39:50'),(16,1100,25,1,15,'2016-10-18 01:39:50','2016-10-18 01:39:50'),(17,2230,26,1,15,'2016-10-22 16:43:24','2016-10-22 16:43:24'),(18,2240,26,2,15,'2016-10-22 16:43:24','2016-10-22 16:43:24'),(19,1400,27,1,15,'2016-11-14 03:01:03','2016-11-14 03:01:03'),(20,2107,27,1,15,'2016-11-14 03:01:03','2016-11-14 03:01:03'),(21,1300,27,1,15,'2016-11-14 03:01:03','2016-11-14 03:01:03'),(22,1301,27,1,15,'2016-11-14 03:01:03','2016-11-14 03:01:03');
/*!40000 ALTER TABLE `item_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itens_venda`
--

DROP TABLE IF EXISTS `itens_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itens_venda` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ativo` char(1) NOT NULL DEFAULT '1',
  `valor` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2410 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens_venda`
--

LOCK TABLES `itens_venda` WRITE;
/*!40000 ALTER TABLE `itens_venda` DISABLE KEYS */;
INSERT INTO `itens_venda` VALUES (1100,'1',15,'2016-06-15 21:35:25',NULL),(1101,'1',15,'2016-06-15 21:35:25',NULL),(1102,'1',15,'2016-06-15 21:35:25',NULL),(1103,'1',15,'2016-06-15 21:35:25',NULL),(1105,'1',15,'2016-06-15 21:35:25',NULL),(1106,'1',15,'2016-06-15 21:35:25',NULL),(1107,'1',15,'2016-06-15 21:35:25',NULL),(1200,'1',153,'2016-06-15 21:35:25','2016-08-10 18:03:12'),(1201,'1',15,'2016-06-15 21:35:25',NULL),(1202,'1',15,'2016-06-15 21:35:25',NULL),(1203,'1',15,'2016-06-15 21:35:25',NULL),(1204,'1',15,'2016-06-15 21:35:25',NULL),(1205,'1',15,'2016-06-15 21:35:25',NULL),(1206,'1',500,'2016-07-29 17:53:26','2016-07-29 17:53:26'),(1207,'1',600,'2016-07-29 18:01:08','2016-07-29 18:01:08'),(1300,'1',15,'2016-06-15 21:35:25',NULL),(1301,'1',15,'2016-06-15 21:35:25',NULL),(1302,'1',15,'2016-06-15 21:35:25',NULL),(1400,'1',15,'2016-06-15 21:35:25',NULL),(1401,'1',15,'2016-06-15 21:35:25',NULL),(1402,'1',15,'2016-06-15 21:35:25',NULL),(1403,'1',15,'2016-06-15 21:35:25',NULL),(1404,'1',15,'2016-06-15 21:35:25',NULL),(1405,'1',15,'2016-06-15 21:35:25',NULL),(1406,'1',15,'2016-06-15 21:35:25',NULL),(1407,'1',15,'2016-06-15 21:35:25',NULL),(1408,'1',15,'2016-06-15 21:35:25',NULL),(1500,'1',15,'2016-06-15 21:35:25',NULL),(1501,'1',15,'2016-06-15 21:35:25',NULL),(1502,'1',15,'2016-06-15 21:35:25',NULL),(1503,'1',15,'2016-06-15 21:35:25',NULL),(1504,'1',15,'2016-06-15 21:35:25',NULL),(1505,'1',15,'2016-06-15 21:35:25',NULL),(1600,'1',15,'2016-06-15 21:35:25',NULL),(1601,'1',15,'2016-06-15 21:35:25',NULL),(1602,'1',15,'2016-06-15 21:35:25',NULL),(1603,'1',15,'2016-07-26 13:29:28',NULL),(2101,'1',15,'2016-06-15 21:35:25',NULL),(2102,'1',15,'2016-06-15 21:35:25',NULL),(2103,'1',15,'2016-06-15 21:35:25',NULL),(2104,'1',15,'2016-06-15 21:35:25',NULL),(2105,'1',15,'2016-06-15 21:35:25',NULL),(2106,'1',15,'2016-06-15 21:35:25',NULL),(2107,'1',15,'2016-06-15 21:35:25',NULL),(2108,'1',15,'2016-06-15 21:35:25',NULL),(2109,'1',15,'2016-06-15 21:35:25',NULL),(2111,'1',15,'2016-06-15 21:35:25',NULL),(2112,'1',15,'2016-06-15 21:35:25',NULL),(2113,'1',15,'2016-06-15 21:35:25',NULL),(2114,'1',15,'2016-06-15 21:35:25',NULL),(2115,'1',15,'2016-06-15 21:35:25',NULL),(2116,'1',23,'2016-07-29 18:02:00','2016-07-29 18:02:00'),(2120,'0',19.9,'2016-07-20 15:50:32','2016-07-20 15:50:43'),(2201,'1',15,'2016-06-15 21:35:25',NULL),(2202,'1',15,'2016-06-15 21:35:25',NULL),(2203,'1',15,'2016-06-15 21:35:25',NULL),(2204,'1',15,'2016-06-15 21:35:25',NULL),(2205,'1',15,'2016-06-15 21:35:25',NULL),(2206,'1',15,'2016-06-15 21:35:25',NULL),(2207,'1',15,'2016-06-15 21:35:25',NULL),(2208,'1',15,'2016-06-15 21:35:25',NULL),(2209,'1',15,'2016-06-15 21:35:25',NULL),(2210,'1',15,'2016-06-15 21:35:25',NULL),(2211,'1',15,'2016-06-15 21:35:25',NULL),(2212,'1',15,'2016-06-15 21:35:25',NULL),(2213,'1',15,'2016-06-15 21:35:25',NULL),(2214,'1',15,'2016-06-15 21:35:25',NULL),(2215,'1',15,'2016-06-15 21:35:25',NULL),(2216,'1',15,'2016-06-15 21:35:25',NULL),(2217,'1',15,'2016-06-15 21:35:25',NULL),(2218,'1',15,'2016-06-15 21:35:25',NULL),(2219,'1',15,'2016-06-15 21:35:25',NULL),(2220,'1',15,'2016-06-15 21:35:25',NULL),(2221,'1',15,'2016-06-15 21:35:25',NULL),(2222,'1',15,'2016-06-15 21:35:25',NULL),(2223,'1',15,'2016-06-15 21:35:25',NULL),(2224,'1',15,'2016-06-15 21:35:25',NULL),(2225,'1',15,'2016-06-15 21:35:25',NULL),(2226,'1',15,'2016-06-15 21:35:25',NULL),(2227,'1',15,'2016-06-15 21:35:25',NULL),(2228,'1',15,'2016-06-15 21:35:25',NULL),(2229,'1',15,'2016-06-15 21:35:25',NULL),(2230,'1',15,'2016-06-15 21:35:25',NULL),(2231,'1',15,'2016-06-15 21:35:25',NULL),(2232,'1',15,'2016-06-15 21:35:25',NULL),(2233,'1',15,'2016-06-15 21:35:25',NULL),(2234,'1',15,'2016-06-15 21:35:25',NULL),(2235,'1',15,'2016-06-15 21:35:25',NULL),(2236,'1',15,'2016-06-15 21:35:25',NULL),(2237,'1',15,'2016-06-15 21:35:25',NULL),(2238,'1',15,'2016-06-15 21:35:25',NULL),(2239,'1',15,'2016-06-15 21:35:25',NULL),(2240,'1',15,'2016-06-15 21:35:25',NULL),(2241,'1',15,'2016-06-15 21:35:25',NULL),(2242,'1',15,'2016-06-15 21:35:25',NULL),(2301,'1',200,'2016-06-15 21:35:25','2016-08-10 18:08:39'),(2302,'1',15,'2016-06-15 21:35:25',NULL),(2303,'1',15,'2016-06-15 21:35:25',NULL),(2304,'1',15,'2016-06-15 21:35:25',NULL),(2305,'1',15,'2016-06-15 21:35:25',NULL),(2306,'1',15,'2016-06-15 21:35:25',NULL),(2307,'1',15,'2016-06-15 21:35:25',NULL),(2308,'1',15,'2016-06-15 21:35:25',NULL),(2309,'1',15,'2016-06-15 21:35:25',NULL),(2310,'1',15,'2016-06-15 21:35:25',NULL),(2311,'1',15,'2016-06-15 21:35:25',NULL),(2312,'1',15,'2016-06-15 21:35:25',NULL),(2313,'1',15,'2016-06-15 21:35:25',NULL),(2401,'1',15,'2016-06-15 21:35:25',NULL),(2402,'1',15,'2016-06-15 21:35:25',NULL),(2403,'1',15,'2016-06-15 21:35:25',NULL),(2404,'1',15,'2016-06-15 21:35:25',NULL),(2405,'1',15,'2016-06-15 21:35:25',NULL),(2406,'1',15,'2016-06-15 21:35:25',NULL),(2407,'1',15,'2016-06-15 21:35:25',NULL),(2408,'1',15,'2016-06-15 21:35:25',NULL),(2409,'1',15,'2016-06-15 21:35:25',NULL);
/*!40000 ALTER TABLE `itens_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas_produtos`
--

DROP TABLE IF EXISTS `marcas_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas_produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `nome_fornecedor` varchar(255) DEFAULT NULL,
  `telefone_fornecedor` char(12) DEFAULT NULL,
  `email_fornecedor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas_produtos`
--

LOCK TABLES `marcas_produtos` WRITE;
/*!40000 ALTER TABLE `marcas_produtos` DISABLE KEYS */;
INSERT INTO `marcas_produtos` VALUES (1,'MIRRA COSMÉTICOS','http://www.mirracosmeticos.com/','Carolline Passos','83987456321','carolline@mirra.com.br','2016-06-27 20:52:28','2016-07-14 22:25:29'),(2,'L\'OREAL','http://www.loreal.com.br/','Yasmin Ribeiro Cunha','5441996845','yasmin@loreal.com','2016-06-27 20:56:58',NULL),(3,'AVON PRODUCTS','http://www.avoncompany.com/','Larissa Rocha Araujo','5133632483','larissa@avon.com','2016-06-27 20:56:58',NULL),(4,'CHANEL','http://www.chanel.com/pt_BR/','Amanda Dias Martins','1163687350','amandadias@chanel.com','2016-06-27 20:56:58','2016-06-30 20:45:29');
/*!40000 ALTER TABLE `marcas_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `categoria_id` bigint(20) NOT NULL,
  `marca_id` bigint(20) DEFAULT NULL,
  `quantidade` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_produto_idx` (`categoria_id`),
  KEY `fk_marca_produto_idx` (`marca_id`),
  CONSTRAINT `fk_categoria_produto` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_produtos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_item_venda_produto` FOREIGN KEY (`id`) REFERENCES `itens_venda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_marca_produto` FOREIGN KEY (`marca_id`) REFERENCES `marcas_produtos` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2410 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (2102,'ANTIFRIZZ',1,2,20,'2016-06-15 21:40:06','2016-07-26 14:49:18'),(2103,'ATIVADOR DE CACHOS',1,3,20,'2016-06-15 21:40:06',NULL),(2104,'XAMPU NEUTRO',1,4,20,'2016-06-15 21:40:06',NULL),(2105,'XAMPU SECO',1,1,20,'2016-06-15 21:40:06',NULL),(2106,'VOLUMIZADOR',1,2,20,'2016-06-15 21:40:06',NULL),(2107,'POMADA',1,3,19,'2016-06-15 21:40:06','2016-11-14 03:01:03'),(2108,'HIDRATANTE COM COR',1,4,20,'2016-06-15 21:40:06',NULL),(2109,'MUSSE PARA MODELAR',1,1,20,'2016-06-15 21:40:06',NULL),(2111,'SÉRUM ANTIOXIDANTE',1,2,20,'2016-06-15 21:40:06',NULL),(2112,'SPRAY DE BRILHO',1,3,20,'2016-06-15 21:40:06',NULL),(2113,'SPRAY FIXADOR',1,4,20,'2016-06-15 21:40:06',NULL),(2114,'TINTURA CASEIRA',1,2,20,'2016-06-15 21:40:06',NULL),(2115,'TINTURA PARA RAIZ',1,3,20,'2016-06-15 21:40:06',NULL),(2116,'XAMPU SóLIDO',1,1,17,'2016-07-29 18:02:00','2016-10-10 02:11:47'),(2120,'BASE PARA OLHEIRAS',2,3,20,'2016-07-20 15:50:32','2016-07-20 15:50:32'),(2202,'BASE DE TRATAMENTO',2,1,20,'2016-06-15 21:40:06',NULL),(2203,'BASE EM PÓ',2,2,20,'2016-06-15 21:40:06',NULL),(2204,'BASE LÍQUIDA',2,3,20,'2016-06-15 21:40:06',NULL),(2205,'BASE MINERAL',2,4,20,'2016-06-15 21:40:06',NULL),(2206,'BATOM',2,1,20,'2016-06-15 21:40:06',NULL),(2207,'BATOM/GLOSS DE LONGA DURAÇÃO',2,2,20,'2016-06-15 21:40:06',NULL),(2208,'BB CREAM',2,3,20,'2016-06-15 21:40:06',NULL),(2209,'BLUSH EM CREME',2,4,20,'2016-06-15 21:40:06',NULL),(2210,'BLUSH EM PÓ',2,1,20,'2016-06-15 21:40:06',NULL),(2211,'CÍLIOS POSTIÇOS',2,2,20,'2016-06-15 21:40:06',NULL),(2212,'CORRETIVO',2,3,20,'2016-06-15 21:40:06',NULL),(2213,'CORRETOR DE COR',2,4,20,'2016-06-15 21:40:06',NULL),(2214,'CREME ANTIRRUGAS',2,1,20,'2016-06-15 21:40:06',NULL),(2215,'CREME NOTURNO',2,2,20,'2016-06-15 21:40:06',NULL),(2216,'CREME PARA OS OLHOS',2,3,20,'2016-06-15 21:40:06',NULL),(2217,'DELINEADOR LÍQUIDO OU EM GEL',2,4,20,'2016-06-15 21:40:06',NULL),(2218,'DEMAQUILANTE',2,1,20,'2016-06-15 21:40:06',NULL),(2219,'DEMAQUILANTE PARA OLHOS',2,2,20,'2016-06-15 21:40:06',NULL),(2220,'ESFOLIANTE',2,3,20,'2016-06-15 21:40:06',NULL),(2221,'GLOSS',2,NULL,20,'2016-06-15 21:40:06',NULL),(2222,'ILUMINADOR',2,1,20,'2016-06-15 21:40:06',NULL),(2223,'LÁPIS DE BOCA',2,2,20,'2016-06-15 21:40:06',NULL),(2224,'LÁPIS DELINEADOR',2,3,20,'2016-06-15 21:40:06',NULL),(2225,'LÁPIS PARA SOBRANCELHAS',2,4,20,'2016-06-15 21:40:06',NULL),(2227,'MÁSCARA DE CÍLIOS',2,2,20,'2016-06-15 21:40:06',NULL),(2228,'MÁSCARA DE CÍLIOS À PROVA DE ÁGUA',2,3,20,'2016-06-15 21:40:06',NULL),(2229,'MÁSCARA DE HIDRATAÇÃO',2,4,20,'2016-06-15 21:40:06',NULL),(2230,'MÁSCARA FACIAL',2,1,19,'2016-06-15 21:40:06','2016-10-22 16:43:24'),(2231,'ÓLEO OU SÉRUM PARA O ROSTO',2,2,20,'2016-06-15 21:40:06',NULL),(2232,'PALETA DE SOMBRAS',2,3,20,'2016-06-15 21:40:06',NULL),(2233,'PINÇA DE SOBRANCELHAS',2,4,20,'2016-06-15 21:40:06',NULL),(2234,'PINCEL DE BLUSH',2,1,20,'2016-06-15 21:40:06',NULL),(2235,'PINCEL DE SOMBRA',2,2,20,'2016-06-15 21:40:06',NULL),(2236,'PINCEL PARA BASE',2,3,20,'2016-06-15 21:40:06',NULL),(2237,'PÓ BRONZEADOR',2,4,20,'2016-06-15 21:40:06',NULL),(2238,'PÓ COMPACTO',2,1,20,'2016-06-15 21:40:06',NULL),(2239,'PREENCHEDOR DE LINHAS FINAS',2,2,20,'2016-06-15 21:40:06',NULL),(2240,'SABONETE PARA O ROSTO',2,3,18,'2016-06-15 21:40:06','2016-10-22 16:43:24'),(2241,'PROTETOR FACIAL',2,4,20,'2016-06-15 21:40:06',NULL),(2242,'PROTETOR FACIAL SEM ÓLEO',2,1,20,'2016-06-15 21:40:06',NULL),(2301,'AUTOBRONZEADOR PARA O CORPO',3,2,20,'2016-06-15 21:40:06',NULL),(2302,'AUTOBRONZEADOR PARA O ROSTO',3,3,20,'2016-06-15 21:40:06',NULL),(2303,'CREME PARA CELULITE',3,4,20,'2016-06-15 21:40:06',NULL),(2304,'CREME PARA O DIA COM PROTEÇÃO SOLAR',3,1,20,'2016-06-15 21:40:06',NULL),(2305,'SABONETE LÍQUIDO',3,2,20,'2016-06-15 21:40:06',NULL),(2306,'DESODORANTE',3,2,20,'2016-06-15 21:40:06',NULL),(2307,'SABÃO EM BARRA',3,2,20,'2016-06-15 21:40:06',NULL),(2308,'ESFOLIANTE CORPORAL',3,3,20,'2016-06-15 21:40:06',NULL),(2309,'HIDRATANTE CORPORAL',3,2,20,'2016-06-15 21:40:06',NULL),(2310,'LOÇÃO CORPORAL',3,4,20,'2016-06-15 21:40:06',NULL),(2311,'PROTETOR SOLAR PARA A PRÁTICA DE ESPORTES',3,2,20,'2016-06-15 21:40:06',NULL),(2312,'PROTETOR SOLAR PARA O CORPO',3,4,20,'2016-06-15 21:40:06',NULL),(2313,'PROTETOR TÉRMICO',3,3,20,'2016-06-15 21:40:06',NULL),(2401,'CREME PARA AS MÃOS',4,1,20,'2016-06-15 21:40:06',NULL),(2402,'CREME PARA OS PÉS',4,3,20,'2016-06-15 21:40:06',NULL),(2403,'ESMALTE ESCURO',4,1,16,'2016-06-15 21:40:06','2016-10-15 00:33:02'),(2404,'ESMALTE EXTRABRILHO',4,4,20,'2016-06-15 21:40:06',NULL),(2405,'ESMALTE NUDE',4,2,15,'2016-06-15 21:40:06','2016-10-11 14:25:49'),(2406,'ESMALTE VERMELHO',4,4,20,'2016-06-15 21:40:06',NULL),(2407,'HIDRATANTE DE CUTÍCULAS',4,2,20,'2016-06-15 21:40:06',NULL),(2408,'REMOVEDOR DE CUTÍCULAS',4,1,20,'2016-06-15 21:40:06',NULL),(2409,'REMOVEDOR DE ESMALTES',4,1,19,'2016-06-15 21:40:06','2016-10-11 14:25:49');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `fk_role_user_idx` (`role_id`),
  KEY `fk_user_role_idx` (`user_id`),
  CONSTRAINT `fk_role_user` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_role` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,'2016-08-01 16:32:53'),(2,3,'2016-08-01 16:32:53'),(3,2,'2016-08-01 16:32:53'),(4,2,'2016-08-01 16:32:53'),(6,7,NULL),(7,1,'2016-08-01 16:32:53'),(7,3,'2016-08-01 16:32:53');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `sigla` char(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador(a)','ADMIN','2016-06-15 21:40:51',NULL),(2,'Cabelereiro(a)','CABLR','2016-06-15 21:40:51',NULL),(3,'Maquiador(a)','MAQDR','2016-06-15 21:40:51',NULL),(4,'Esteticista','ESTCT','2016-06-15 21:40:51',NULL),(5,'Manicure / Pedicure','MANPE','2016-06-15 21:40:51',NULL),(6,'Caixa','CAIXA','2016-06-15 21:40:51',NULL),(7,'Barbeiro(a)','BARBR','2016-06-21 19:02:54',NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico_user`
--

DROP TABLE IF EXISTS `servico_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico_user` (
  `servico_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`servico_id`,`user_id`),
  KEY `fk_user_servico_idx` (`user_id`),
  CONSTRAINT `fk_servico_user` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_servico` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico_user`
--

LOCK TABLES `servico_user` WRITE;
/*!40000 ALTER TABLE `servico_user` DISABLE KEYS */;
INSERT INTO `servico_user` VALUES (1200,2,NULL),(1200,7,NULL);
/*!40000 ALTER TABLE `servico_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicos`
--

DROP TABLE IF EXISTS `servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `categoria_id` bigint(20) NOT NULL,
  `masculino` char(1) NOT NULL DEFAULT '0',
  `feminino` char(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_servico_idx` (`categoria_id`),
  CONSTRAINT `fk_categoria_servico` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_servicos` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_item_venda_servico` FOREIGN KEY (`id`) REFERENCES `itens_venda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1604 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (1100,'CORTE MASCULINO BÁSICO',1,'1','0','2016-06-15 21:41:31',NULL),(1101,'CORTE MASCULINO COM MÁQUINA',1,'1','0','2016-06-15 21:41:31',NULL),(1102,'CORTE FEMININO DEGRADÊ',1,'0','1','2016-06-15 21:41:31',NULL),(1103,'CORTE FEMININO DESFIADO',1,'0','1','2016-06-15 21:41:31',NULL),(1105,'CORTE FEMININO RETO (BÁSICO)',1,'0','1','2016-06-15 21:41:31',NULL),(1106,'CORTE CHANEL',1,'1','1','2016-06-15 21:41:31',NULL),(1107,'CORTE DE FRANJA',1,'1','1','2016-06-15 21:41:31',NULL),(1200,'ALISAMENTO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1201,'HIDRATAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1202,'COLORAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1203,'ONDULAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1204,'CAUTERIZAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1205,'QUERATINIZAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1206,'CAPIM CUBANO',2,'1','0','2016-07-29 17:53:26','2016-07-29 17:53:26'),(1207,'MEIA TONTA',2,'0','1','2016-07-29 18:01:08','2016-07-29 18:01:08'),(1300,'MANICURE',3,'1','1','2016-06-15 21:41:31',NULL),(1301,'PEDICURE',3,'1','1','2016-06-15 21:41:31',NULL),(1302,'PODOLOGIA',3,'1','1','2016-06-15 21:41:31',NULL),(1400,'DEPILAÇÃO À CERA',4,'0','1','2016-06-15 21:41:31',NULL),(1401,'DEPILAÇÃO À LASER',4,'0','1','2016-06-15 21:41:31',NULL),(1402,'DEPILAÇÃO COM LINHA',4,'0','1','2016-06-15 21:41:31',NULL),(1403,'DEPILAÇÃO ARTÍSTICA',4,'0','1','2016-06-15 21:41:31',NULL),(1404,'DEPILAÇÃO DAS PERNAS',4,'0','1','2016-06-15 21:41:31',NULL),(1405,'DEPILAÇÃO DA VIRILHA',4,'0','1','2016-06-15 21:41:31',NULL),(1406,'DEPILAÇÃO DAS AXILAS',4,'0','1','2016-06-15 21:41:31',NULL),(1407,'DEPILAÇÃO DE BUÇO',4,'0','1','2016-06-15 21:41:31',NULL),(1500,'MAQUIAGEM',5,'1','1','2016-06-15 21:41:31',NULL),(1501,'DESIGN DE SOBRANCELHAS',5,'1','1','2016-06-15 21:41:31',NULL),(1502,'LIMPEZA DE PELE',5,'1','1','2016-06-15 21:41:31',NULL),(1503,'PEELING FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1504,'DRENAGEM LINFÁTICA FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1505,'LASER FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1600,'DRENAGEM LINFÁTICA CORPORAL',6,'0','1','2016-06-15 21:41:31',NULL),(1601,'MASSAGEM REDUTORA',6,'0','1','2016-06-15 21:41:31',NULL),(1602,'BRONZEAMENTO ARTIFICIAL',6,'0','1','2016-06-15 21:41:31',NULL),(1603,'BARBA E BIGODE',1,'1','0','2016-07-26 13:29:58',NULL);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `cpf` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` char(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` char(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `municipio` char(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` char(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ativo` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=408 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Marcello','Galdino Passos','marcellogpassos@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S','2s6yT0E1VpREFBUBYfUMoXlNXDkJmDBTiOQAtQRSnxrGm9dB2yDMbqkAxD1x','M','1990-05-04','08417523464','83996917109','58030060','25','07507','Rua Goiás','284','Estados','Apartamento 1703','1','2016-06-09 00:49:45','2016-08-12 19:59:39'),(2,'Ana Carolina','Sousa Alves Passos','carolasalves@gmail.com','$2y$10$pnjd09c3zNwQOxxaVSC5/ui.dkduZTInR2p7NLYsjy.F9Ih1zyVjC','fjPKdg6MakZhbJfwCxO7FTuHAoJVhiUZ3IOdRVGeADQT9RvQzx0OOsOLKG9I','F','1992-11-17','60480663092','83999649598','58030060','25','07507','Rua Goiás','284','Estados','até 415/416','1','2016-06-09 00:51:24','2016-06-21 21:12:12'),(3,'Márcio','Galdino Passos','marciogpassos@gmail.com','$2y$10$.jkLRvezxZ2ZIKxLipDVU.ZxJJ.baW3RrrRVa4xFo1/MpmZJjOzDC','8vwSp65mgxRb1OeJGBTunZZ1OtZV8PD6Pl4S79QZT5xARivXCPnxNwktRib7','M','1981-09-22','33834479608','61993086183','71919360','53','00108','Rua 37 Norte','Lote 1','Norte (Águas Claras)','Edifício Cezanne - Apto. 1404','1','2016-06-09 21:59:40','2016-06-16 00:06:16'),(4,'Luciano','Carvalho de Medeiros Júnior','lucamenor@gmail.com','$2y$10$2UO1zKCEnYpEOWv.VCretO.bNzCIiCXjlQSAihO1Faae4F7IQWSim',NULL,'M','1989-02-05','76371095340','11932834063','07085190','35','18800','Rua Noventa e Dois','40','Parque Continental','','1','2016-06-13 23:39:12','2016-06-13 23:40:41'),(5,'Tomás','Barbosa Martins','tomasbarbosamartins@inbound.plus','$2y$10$RAaFKDFNT0p3IxtC9A652OjDAerk8k3eDdvlL4NRoONvER5NjT0Yu','zwCBUrZf7Hnkb7NVP8nWrZWXNp9aptGKJF1gXlzHXMMHcM3koHhCjeUwqgVd','M','1969-10-25','36783485307','88985709151','03278030','35','50308','Rua Gustavo Stach','795','Vila Ema','','0','2016-06-15 23:47:19','2016-06-15 23:48:27'),(6,'Julieta','Sousa Rocha','julietasousarocha@inbound.plus','$2y$10$4Cotcoj1Y1bAL1AgSz2U9u1hTqczg8Ntstmae46.O0gUgVd5iuJ52','TvleZM3FaS3ngQcou8aEnPGYneYdKUjnOkQbjtQisg241557bxEsJtyMrkCc','F','1967-03-04','52343142513','16983142824','14055664','35','43402','Travessa Delelmo Mazzo','329','Ipiranga','','1','2016-06-15 23:57:46','2016-06-16 00:00:54'),(7,'João','Barbosa Cardoso','joaobarbosacardoso@armyspy.com','$2y$10$lqF/WKinrkykCvICbVi6heHQwW9fLiejfcCoOcqj/GTb0TF0yI5Xq',NULL,'M','1970-07-22','79327361962','2479289860','27520175','33','04201','Avenida General Afonseca','1039','Manejo','de 1140 ao fim - lado par','1','2016-08-01 19:42:21','2016-08-01 19:43:18'),(208,'Sofia','Cardoso','sofia_cardoso1@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1948-06-12','50320986128','5185644030','58034820','25','07507','RUA EDMUNDO FILHO','5803','SÃO JOSÉ',NULL,'1',NULL,NULL),(209,'Nicolas','Cunha','nicolas_cunha2@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1966-12-19','99356049696','2127489977','58038420','25','07507','RUA SILVINO CHAVES','3952','MANAÍRA',NULL,'1',NULL,NULL),(210,'Marina','Fernandes','marina_fernandes3@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1936-11-04','84754082141','8185639572','58034149','25','07507','RUA PROFESSOR OSCAR DE CASTRO','8509','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(211,'Isabela','Castro','isabela_castro4@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1976-03-03','57223018763','8566348860','58050550','25','07507','RUA DORGIVAL MARQUES PORDEUS','6469','CASTELO BRANCO',NULL,'1',NULL,NULL),(212,'Sofia','Rocha','sofia_rocha5@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1973-06-27','28324605266','6577006744','58042110','25','07507','RUA VANDIK PINTO FILGUEIRAS','7125','TAMBAUZINHO',NULL,'1',NULL,NULL),(213,'Isabela','Ribeiro','isabela_ribeiro6@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1931-08-04','49507380701','2433833944','58030060','25','07507','AVENIDA GOIAS','942','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(214,'Evelyn','Martins','evelyn_martins7@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1920-10-19','90721152600','6860305967','58040290','25','07507','AVENIDA MIGUEL SANTA CRUZ','5594','TORRE',NULL,'1',NULL,NULL),(215,'Arthur','Ferreira','arthur_ferreira8@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1984-10-24','97317071315','4773887197','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','3673','JARDIM OCEANIA',NULL,'1',NULL,NULL),(216,'Luan','Melo','luan_melo9@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1931-02-08','29616210548','4733034286','58046095','25','07507','RUA MARIA DAS DORES SOUZA','222','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(217,'Igor','Pinto','igor_pinto10@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1985-09-15','62185096648','2739834522','58036873','25','07507','RUA ADÃO VIANA DA ROSA','236','AEROCLUBE',NULL,'1',NULL,NULL),(218,'Breno','Almeida','breno_almeida11@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1946-10-09','13786030367','6157194278','58038381','25','07507','AVENIDA SAPÉ','5868','MANAÍRA',NULL,'1',NULL,NULL),(219,'Thaís','Carvalho','thaís_carvalho12@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1923-10-01','23802933338','3353399463','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','779','JARDIM OCEANIA',NULL,'1',NULL,NULL),(220,'Bianca','Rocha','bianca_rocha13@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1942-12-20','30908008708','8631489895','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','6319','TREZE DE MAIO',NULL,'1',NULL,NULL),(221,'Fábio','Rodrigues','fábio_rodrigues14@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1944-12-16','72950738842','5549824408','58036873','25','07507','RUA ADÃO VIANA DA ROSA','442','AEROCLUBE',NULL,'1',NULL,NULL),(222,'Mariana','Barbosa','mariana_barbosa15@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1947-10-31','57444081859','1195866163','58030280','25','07507','AVENIDA GUANABARA','8604','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(223,'Guilherme','Sousa','guilherme_sousa16@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1990-09-12','65354414156','4154352571','58041030','25','07507','RUA PROFESSOR JOAQUIM SANTIAGO','8528','EXPEDICIONÁRIOS',NULL,'1',NULL,NULL),(224,'Fernanda','Cavalcanti','fernanda_cavalcanti17@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1967-06-07','32646946970','2797249804','58038241','25','07507','AVENIDA POMBAL','3984','MANAÍRA',NULL,'1',NULL,NULL),(225,'Igor','Silva','igor_silva18@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1929-09-13','42317760671','9130803650','58039021','25','07507','RUA JOSÉ AUGUSTO TRINDADE','7089','TAMBAÚ',NULL,'1',NULL,NULL),(226,'Letícia','Souza','letícia_souza19@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1928-09-19','26173890577','8666522682','58038280','25','07507','AVENIDA ESPERANÇA','8853','MANAÍRA',NULL,'1',NULL,NULL),(227,'Vinicius','Castro','vinicius_castro20@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1968-02-06','56754780274','3198163437','58039040','25','07507','RUA TABELIÃO VENÂNCIO SANTIAGO','8871','TAMBAÚ',NULL,'1',NULL,NULL),(228,'Erick','Azevedo','erick_azevedo21@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1998-06-28','80915412608','2137254767','58038470','25','07507','RUA DOUTOR SEVERINO SÍLVIO GUERRA','1276','MANAÍRA',NULL,'1',NULL,NULL),(229,'Martim','Araujo','martim_araujo22@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1991-07-15','89462403856','6181245442','58074050','25','07507','RUA VIOLONISTA RAFAEL RABELO','2964','JOSÉ AMÉRICO DE ALMEIDA',NULL,'1',NULL,NULL),(230,'Gabriel','Goncalves','gabriel_goncalves23@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1994-12-26','73089585669','1992869938','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','1752','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(231,'Estevan','Almeida','estevan_almeida24@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1926-01-30','88200707741','3772732433','58038330','25','07507','RUA SÃO GONÇALO','1497','MANAÍRA',NULL,'1',NULL,NULL),(232,'Sophia','Dias','sophia_dias25@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1957-07-03','21943893349','4220312104','58036840','25','07507','RUA MARIA ROSA PADILHA','8531','AEROCLUBE',NULL,'1',NULL,NULL),(233,'Gabriela','Dias','gabriela_dias26@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1999-07-23','90241334241','1136307248','58034133','25','07507','RUA PROFESSOR JOFRE BORGES ALBUQUERQUE','6083','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(234,'Arthur','Cunha','arthur_cunha27@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1918-07-25','36016816175','1384988361','58038151','25','07507','AVENIDA FRANCA FILHO','2159','MANAÍRA',NULL,'1',NULL,NULL),(235,'Lara','Rodrigues','lara_rodrigues28@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1948-02-01','86272963246','1178608220','58038242','25','07507','AVENIDA POMBAL','1639','MANAÍRA',NULL,'1',NULL,NULL),(236,'Kaua','Araujo','kaua_araujo29@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1940-09-23','13592305484','1194558624','58038242','25','07507','AVENIDA POMBAL','3739','MANAÍRA',NULL,'1',NULL,NULL),(237,'Kauê','Gomes','kauê_gomes30@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1989-06-03','97167270113','1697044029','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','6558','BRISAMAR',NULL,'1',NULL,NULL),(238,'Sarah','Araujo','sarah_araujo31@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1943-05-13','87138612710','1284708722','58034820','25','07507','RUA EDMUNDO FILHO','9124','SÃO JOSÉ',NULL,'1',NULL,NULL),(239,'Kauã','Santos','kauã_santos32@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1993-07-29','35071008009','1977057059','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','7005','BRISAMAR',NULL,'1',NULL,NULL),(240,'Alice','Rodrigues','alice_rodrigues33@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1940-04-09','35676811099','4238788852','58031110','25','07507','RUA ALFREDO COUTINHO DE LIRA','1398','PEDRO GONDIM',NULL,'1',NULL,NULL),(241,'Beatriz','Ribeiro','beatriz_ribeiro34@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1955-03-20','95966196753','3399266626','58034820','25','07507','RUA EDMUNDO FILHO','4499','SÃO JOSÉ',NULL,'1',NULL,NULL),(242,'Aline','Rocha','aline_rocha35@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1944-04-20','68819871106','1543758097','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','1687','TORRE',NULL,'1',NULL,NULL),(243,'Beatriz','Cavalcanti','beatriz_cavalcanti36@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1993-07-16','19416071790','7194712817','58031080','25','07507','RUA JOÃO VIEIRA CARNEIRO','1049','PEDRO GONDIM',NULL,'1',NULL,NULL),(244,'Melissa','Araujo','melissa_araujo37@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1935-01-14','93886092631','8127718260','58050660','25','07507','RUA JOSÉ DIONÍZIO DA SILVA','7317','CASTELO BRANCO',NULL,'1',NULL,NULL),(245,'Beatriz','Cardoso','beatriz_cardoso38@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1985-12-17','91597686301','3122455517','58074050','25','07507','RUA VIOLONISTA RAFAEL RABELO','6510','JOSÉ AMÉRICO DE ALMEIDA',NULL,'1',NULL,NULL),(246,'Kauã','Dias','kauã_dias39@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1997-07-28','62132624585','1964475005','58042110','25','07507','RUA VANDIK PINTO FILGUEIRAS','3265','TAMBAUZINHO',NULL,'1',NULL,NULL),(247,'Douglas','Pinto','douglas_pinto40@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1997-08-12','16725253148','1153479035','58053175','25','07507','RUA ANTÔNIO VIEIRA DA SILVA','5278','JARDIM SÃO PAULO',NULL,'1',NULL,NULL),(248,'Tomás','Carvalho','tomás_carvalho41@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1982-02-19','15752249252','1625673039','58046040','25','07507','RUA OLIVÉRIO MAVIGNIER DE NORONHA','3078','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(249,'Douglas','Souza','douglas_souza42@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1962-10-02','92535734222','8179577024','58046088','25','07507','RUA BANCÁRIO ELIAS FELICIANO MADRUGA','4740','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(250,'Thaís','Silva','thaís_silva43@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1951-06-21','86506921412','4755477710','58038241','25','07507','AVENIDA POMBAL','6458','MANAÍRA',NULL,'1',NULL,NULL),(251,'Maria','Almeida','maria_almeida44@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1965-07-11','32099611661','8183473300','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','3253','AEROCLUBE',NULL,'1',NULL,NULL),(252,'Thiago','Martins','thiago_martins45@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1997-11-27','95127222752','6129577079','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','5939','AEROCLUBE',NULL,'1',NULL,NULL),(253,'Otávio','Azevedo','otávio_azevedo46@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1934-04-21','92648564985','9181696231','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','1363','BRISAMAR',NULL,'1',NULL,NULL),(254,'Kauan','Pinto','kauan_pinto47@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1948-03-19','35004840423','1174149609','58038142','25','07507','AVENIDA GUARABIRA','6797','MANAÍRA',NULL,'1',NULL,NULL),(255,'Vinicius','Cunha','vinicius_cunha48@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1930-05-22','42352802288','6461083834','58034140','25','07507','PRAÇA MANOEL COLAÇO SOBRINHO','2822','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(256,'Luana','Almeida','luana_almeida49@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1942-03-10','53410991417','8124769055','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','7877','TREZE DE MAIO',NULL,'1',NULL,NULL),(257,'Diego','Rodrigues','diego_rodrigues50@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1962-03-20','11739164237','5156003826','58034825','25','07507','RUA DO RIO','8163','SÃO JOSÉ',NULL,'1',NULL,NULL),(258,'Erick','Carvalho','erick_carvalho51@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1974-10-01','19129775400','5332045365','58038381','25','07507','AVENIDA SAPÉ','9493','MANAÍRA',NULL,'1',NULL,NULL),(259,'Aline','Araujo','aline_araujo52@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1934-10-24','26904533129','5128845209','58053175','25','07507','RUA ANTÔNIO VIEIRA DA SILVA','497','JARDIM SÃO PAULO',NULL,'1',NULL,NULL),(260,'Cauã','Souza','cauã_souza53@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1958-08-08','62315979544','3239312852','58041000','25','07507','AVENIDA JÚLIA FREIRE','8593','TAMBAUZINHO',NULL,'1',NULL,NULL),(261,'Bianca','Ferreira','bianca_ferreira54@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1947-04-15','34767990262','2144923073','58038420','25','07507','RUA SILVINO CHAVES','590','MANAÍRA',NULL,'1',NULL,NULL),(262,'Leila','Lima','leila_lima55@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1918-04-26','78177543814','1951424112','58038580','25','07507','RUA VIGOLVINO FLORENTINO COSTA','7728','MANAÍRA',NULL,'1',NULL,NULL),(263,'Diogo','Cardoso','diogo_cardoso56@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1955-03-21','67412935747','5437325033','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','678','TORRE',NULL,'1',NULL,NULL),(264,'Anna','Cavalcanti','anna_cavalcanti57@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1965-08-04','30678656770','2493154968','58038142','25','07507','AVENIDA GUARABIRA','2767','MANAÍRA',NULL,'1',NULL,NULL),(265,'Ana','Rodrigues','ana_rodrigues58@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1925-05-21','23493112440','5185274283','58038521','25','07507','RUA FRANCISCO BRANDÃO','2705','MANAÍRA',NULL,'1',NULL,NULL),(266,'Breno','Cavalcanti','breno_cavalcanti59@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1971-08-31','88697237122','1666197064','58043320','25','07507','RUA MARIETA STEIMBACH SILVA','1724','MIRAMAR',NULL,'1',NULL,NULL),(267,'Leonor','Melo','leonor_melo60@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1953-10-12','92914348843','2776574991','58030060','25','07507','AVENIDA GOIAS','4686','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(268,'Tiago','Araujo','tiago_araujo61@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1917-06-14','44529262669','5144617886','58032110','25','07507','RUA GIACOMO PORTO','3393','MIRAMAR',NULL,'1',NULL,NULL),(269,'Vitor','Rocha','vitor_rocha62@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1975-03-11','25198987808','1141769138','58034822','25','07507','RUA FÁBIO SILVA LIMA','6068','SÃO JOSÉ',NULL,'1',NULL,NULL),(270,'Paulo','Pereira','paulo_pereira63@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1985-05-19','50054908760','2136049954','58032110','25','07507','RUA GIACOMO PORTO','9921','MIRAMAR',NULL,'1',NULL,NULL),(271,'João','Sousa','joão_sousa64@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1942-08-06','34038921905','8154323535','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','4393','TREZE DE MAIO',NULL,'1',NULL,NULL),(272,'Caio','Souza','caio_souza65@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1954-03-09','64845043505','1959946740','58037000','25','07507','AVENIDA GOVERNADOR FLÁVIO RIBEIRO COUTINHO','5843','MANAÍRA',NULL,'1',NULL,NULL),(273,'Luan','Silva','luan_silva66@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1990-07-23','79129972299','3241563267','58039081','25','07507','RUA HELENA MEIRA LIMA','6801','TAMBAÚ',NULL,'1',NULL,NULL),(274,'Alex','Azevedo','alex_azevedo67@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1923-07-29','49730394466','1470389959','58038680','25','07507','RUA MANOEL ARRUDA CAVALCANTI','8686','MANAÍRA',NULL,'1',NULL,NULL),(275,'Murilo','Ferreira','murilo_ferreira68@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1957-11-26','77526421696','4171629061','58038620','25','07507','RUA DA CANDELÁRIA','2747','MANAÍRA',NULL,'1',NULL,NULL),(276,'Kauã','Fernandes','kauã_fernandes69@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1974-10-31','39249863802','2180603454','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','8176','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(277,'Leonor','Rodrigues','leonor_rodrigues70@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1973-08-13','36499552615','9295556470','58046088','25','07507','RUA BANCÁRIO ELIAS FELICIANO MADRUGA','2953','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(278,'Alice','Sousa','alice_sousa71@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1979-06-03','76521029010','8781954477','58039021','25','07507','RUA JOSÉ AUGUSTO TRINDADE','2970','TAMBAÚ',NULL,'1',NULL,NULL),(279,'Eduarda','Araujo','eduarda_araujo72@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1935-04-04','54998142364','2141553855','58031110','25','07507','RUA ALFREDO COUTINHO DE LIRA','4268','PEDRO GONDIM',NULL,'1',NULL,NULL),(280,'Thaís','Ribeiro','thaís_ribeiro73@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1925-05-05','85187627155','7143928135','58034820','25','07507','RUA EDMUNDO FILHO','1654','SÃO JOSÉ',NULL,'1',NULL,NULL),(281,'Renan','Araujo','renan_araujo74@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1966-03-10','39298224664','7563276527','58034140','25','07507','PRAÇA MANOEL COLAÇO SOBRINHO','9584','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(282,'Giovana','Castro','giovana_castro75@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1968-07-09','53639471024','1931855877','58038519','25','07507','RUA CONSTRUTOR HUMBERTO RUFFO','4571','MANAÍRA',NULL,'1',NULL,NULL),(283,'Sarah','Martins','sarah_martins76@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1991-09-25','86686926078','2124529717','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','1436','TREZE DE MAIO',NULL,'1',NULL,NULL),(284,'Julieta','Ferreira','julieta_ferreira77@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1982-07-21','57926919241','1182818405','58038151','25','07507','AVENIDA FRANCA FILHO','7252','MANAÍRA',NULL,'1',NULL,NULL),(285,'Ágatha','Barros','ágatha_barros78@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1920-01-28','18156544730','4461022910','58038242','25','07507','AVENIDA POMBAL','9930','MANAÍRA',NULL,'1',NULL,NULL),(286,'Emily','Souza','emily_souza79@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1991-03-21','91060810964','4129014491','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','3871','AEROCLUBE',NULL,'1',NULL,NULL),(287,'Larissa','Rodrigues','larissa_rodrigues80@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1935-10-13','80020901364','1198275084','58039130','25','07507','AVENIDA PROFA. MARIA SALES','2776','TAMBAÚ',NULL,'1',NULL,NULL),(288,'Vitór','Barbosa','vitór_barbosa81@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1979-05-09','18699499272','1156672129','58030280','25','07507','AVENIDA GUANABARA','64','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(289,'Vitoria','Ribeiro','vitoria_ribeiro82@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1931-01-19','63460432934','1962093691','58041030','25','07507','RUA PROFESSOR JOAQUIM SANTIAGO','8939','EXPEDICIONÁRIOS',NULL,'1',NULL,NULL),(290,'Carlos','Correia','carlos_correia83@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1990-05-05','27843567798','3132405906','58036873','25','07507','RUA ADÃO VIANA DA ROSA','3484','AEROCLUBE',NULL,'1',NULL,NULL),(291,'André','Cunha','andré_cunha84@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1981-09-18','26467771087','1195853508','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','6761','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(292,'Joao','Correia','joao_correia85@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1951-07-29','56702119950','9148012676','58034822','25','07507','RUA FÁBIO SILVA LIMA','4244','SÃO JOSÉ',NULL,'1',NULL,NULL),(293,'Evelyn','Barros','evelyn_barros86@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1959-08-29','75658284759','2720352725','58038151','25','07507','AVENIDA FRANCA FILHO','5492','MANAÍRA',NULL,'1',NULL,NULL),(294,'Bianca','Gomes','bianca_gomes87@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1946-06-12','96135615440','1199697371','58038241','25','07507','AVENIDA POMBAL','8308','MANAÍRA',NULL,'1',NULL,NULL),(295,'Vitór','Cunha','vitór_cunha88@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1978-09-24','29952680716','2432976464','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','3273','JARDIM OCEANIA',NULL,'1',NULL,NULL),(296,'Thiago','Gomes','thiago_gomes89@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1981-01-07','57396989876','1120576968','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','4078','TORRE',NULL,'1',NULL,NULL),(297,'Julia','Silva','julia_silva90@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1980-07-11','89434681642','6122927575','58030280','25','07507','AVENIDA GUANABARA','788','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(298,'Matheus','Araujo','matheus_araujo91@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1931-06-06','21851347879','1627482645','58038420','25','07507','RUA SILVINO CHAVES','7326','MANAÍRA',NULL,'1',NULL,NULL),(299,'Nicole','Correia','nicole_correia92@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1942-09-07','82598748905','1155664260','58039130','25','07507','AVENIDA PROFA. MARIA SALES','4605','TAMBAÚ',NULL,'1',NULL,NULL),(300,'Thaís','Araujo','thaís_araujo93@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1963-11-03','65905032149','4145997806','58030280','25','07507','AVENIDA GUANABARA','3337','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(301,'Isabella','Cavalcanti','isabella_cavalcanti94@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1917-06-10','15940142133','9481718567','58030280','25','07507','AVENIDA GUANABARA','6794','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(302,'Nicolas','Castro','nicolas_castro95@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1918-09-25','54183423392','2139153884','58038381','25','07507','AVENIDA SAPÉ','1911','MANAÍRA',NULL,'1',NULL,NULL),(303,'Rafaela','Gomes','rafaela_gomes96@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1939-06-20','48775886120','6581677252','58038381','25','07507','AVENIDA SAPÉ','5604','MANAÍRA',NULL,'1',NULL,NULL),(304,'Rebeca','Souza','rebeca_souza97@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1920-04-22','31409972640','3496729482','58034822','25','07507','RUA FÁBIO SILVA LIMA','5956','SÃO JOSÉ',NULL,'1',NULL,NULL),(305,'Laura','Cardoso','laura_cardoso98@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1997-03-29','76532419729','1126656938','58034820','25','07507','RUA EDMUNDO FILHO','4422','SÃO JOSÉ',NULL,'1',NULL,NULL),(306,'Melissa','Cavalcanti','melissa_cavalcanti99@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1930-10-13','59561347393','6197698836','58068345','25','07507','RUA EPITÁIO COSTA DO AMARAL','4543','GRAMAME',NULL,'1',NULL,NULL),(307,'Diogo','Ribeiro','diogo_ribeiro100@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1997-11-19','36902491399','1725727718','58038241','25','07507','AVENIDA POMBAL','7236','MANAÍRA',NULL,'1',NULL,NULL),(308,'Fábio','Barros','fábio_barros101@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1983-10-09','18568162738','4287979438','58041000','25','07507','AVENIDA JÚLIA FREIRE','1545','TAMBAUZINHO',NULL,'1',NULL,NULL),(309,'Sofia','Carvalho','sofia_carvalho102@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1918-10-20','86058941210','2189818850','58042070','25','07507','RUA DEPUTADO JÁDER MEDEIROS','8770','TAMBAUZINHO',NULL,'1',NULL,NULL),(310,'Júlia','Melo','júlia_melo103@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1956-12-30','48050766314','2191099973','58046088','25','07507','RUA BANCÁRIO ELIAS FELICIANO MADRUGA','7287','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(311,'Beatriz','Azevedo','beatriz_azevedo104@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1920-05-15','14525272023','7167452774','58068345','25','07507','RUA EPITÁIO COSTA DO AMARAL','4168','GRAMAME',NULL,'1',NULL,NULL),(312,'Gabrielly','Goncalves','gabrielly_goncalves105@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1996-05-01','69313070456','6785646027','58074050','25','07507','RUA VIOLONISTA RAFAEL RABELO','1069','JOSÉ AMÉRICO DE ALMEIDA',NULL,'1',NULL,NULL),(313,'Gabriel','Pinto','gabriel_pinto106@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1960-09-06','35749060560','8533948600','58034820','25','07507','RUA EDMUNDO FILHO','4697','SÃO JOSÉ',NULL,'1',NULL,NULL),(314,'Eduardo','Castro','eduardo_castro107@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1909-01-04','89315095707','4899067584','58038420','25','07507','RUA SILVINO CHAVES','8802','MANAÍRA',NULL,'1',NULL,NULL),(315,'Vitor','Ferreira','vitor_ferreira108@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1949-03-10','18380437802','6622124813','58034149','25','07507','RUA PROFESSOR OSCAR DE CASTRO','5001','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(316,'Lavinia','Barros','lavinia_barros109@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1954-05-07','77850567498','9139678942','58050550','25','07507','RUA DORGIVAL MARQUES PORDEUS','3745','CASTELO BRANCO',NULL,'1',NULL,NULL),(317,'Isabelle','Castro','isabelle_castro110@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1953-04-23','10284256781','2143575886','58042110','25','07507','RUA VANDIK PINTO FILGUEIRAS','7942','TAMBAUZINHO',NULL,'1',NULL,NULL),(318,'Rebeca','Carvalho','rebeca_carvalho111@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1989-05-15','52499617543','1143092869','58030060','25','07507','AVENIDA GOIAS','5878','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(319,'Nicole','Cavalcanti','nicole_cavalcanti112@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1928-10-24','81083282760','2164499359','58040290','25','07507','AVENIDA MIGUEL SANTA CRUZ','780','TORRE',NULL,'1',NULL,NULL),(320,'Luis','Goncalves','luis_goncalves113@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1951-08-18','38696006240','3770806327','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','9424','JARDIM OCEANIA',NULL,'1',NULL,NULL),(321,'Camila','Dias','camila_dias114@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1916-12-17','45959899701','6748176941','58046095','25','07507','RUA MARIA DAS DORES SOUZA','1328','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(322,'Rafaela','Lima','rafaela_lima115@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1941-01-15','96325216849','4741305752','58036873','25','07507','RUA ADÃO VIANA DA ROSA','5628','AEROCLUBE',NULL,'1',NULL,NULL),(323,'Leonor','Cardoso','leonor_cardoso116@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1985-10-26','11780441738','1163145180','58038381','25','07507','AVENIDA SAPÉ','1288','MANAÍRA',NULL,'1',NULL,NULL),(324,'Gabrielle','Ribeiro','gabrielle_ribeiro117@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1924-10-06','75484004896','4577714016','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','1719','JARDIM OCEANIA',NULL,'1',NULL,NULL),(325,'Igor','Almeida','igor_almeida118@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1925-12-17','65858255434','1184929888','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','8236','TREZE DE MAIO',NULL,'1',NULL,NULL),(326,'Gabrielly','Oliveira','gabrielly_oliveira119@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1999-06-05','23100031075','1180824139','58036873','25','07507','RUA ADÃO VIANA DA ROSA','4068','AEROCLUBE',NULL,'1',NULL,NULL),(327,'Isabelle','Melo','isabelle_melo120@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1947-09-26','58067574804','1249312961','58030280','25','07507','AVENIDA GUANABARA','2809','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(328,'Tiago','Costa','tiago_costa121@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1937-11-05','80046034757','4334986209','58041030','25','07507','RUA PROFESSOR JOAQUIM SANTIAGO','4359','EXPEDICIONÁRIOS',NULL,'1',NULL,NULL),(329,'Diego','Lima','diego_lima122@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1990-10-20','41458360490','5187599940','58038241','25','07507','AVENIDA POMBAL','3307','MANAÍRA',NULL,'1',NULL,NULL),(330,'Vitor','Pinto','vitor_pinto123@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1987-01-26','40843827793','8377554969','58039021','25','07507','RUA JOSÉ AUGUSTO TRINDADE','2799','TAMBAÚ',NULL,'1',NULL,NULL),(331,'Bruna','Sousa','bruna_sousa124@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1991-05-13','96922518454','1972213292','58038280','25','07507','AVENIDA ESPERANÇA','3387','MANAÍRA',NULL,'1',NULL,NULL),(332,'Emilly','Lima','emilly_lima125@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1983-05-19','23871551813','1931312959','58039040','25','07507','RUA TABELIÃO VENÂNCIO SANTIAGO','7938','TAMBAÚ',NULL,'1',NULL,NULL),(333,'Marisa','Cavalcanti','marisa_cavalcanti126@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1975-12-15','70087865149','1189468505','58038470','25','07507','RUA DOUTOR SEVERINO SÍLVIO GUERRA','1481','MANAÍRA',NULL,'1',NULL,NULL),(334,'Melissa','Barbosa','melissa_barbosa127@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1917-09-27','64755946956','1194622258','58074050','25','07507','RUA VIOLONISTA RAFAEL RABELO','4307','JOSÉ AMÉRICO DE ALMEIDA',NULL,'1',NULL,NULL),(335,'Manuela','Dias','manuela_dias128@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1954-10-30','10479525560','3431146931','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','3880','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(336,'Luís','Almeida','luís_almeida129@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1961-07-18','63607440310','4239915947','58038330','25','07507','RUA SÃO GONÇALO','5503','MANAÍRA',NULL,'1',NULL,NULL),(337,'Joao','Oliveira','joao_oliveira130@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1954-10-21','12358447226','9231222445','58036840','25','07507','RUA MARIA ROSA PADILHA','1036','AEROCLUBE',NULL,'1',NULL,NULL),(338,'Vinícius','Melo','vinícius_melo131@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1979-06-30','49734929143','3128307577','58034133','25','07507','RUA PROFESSOR JOFRE BORGES ALBUQUERQUE','7164','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(339,'Vinicius','Pereira','vinicius_pereira132@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1962-07-19','78728870883','1951344384','58038151','25','07507','AVENIDA FRANCA FILHO','9360','MANAÍRA',NULL,'1',NULL,NULL),(340,'Yasmin','Ribeiro','yasmin_ribeiro133@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1926-05-30','20773174770','8223966890','58038242','25','07507','AVENIDA POMBAL','9482','MANAÍRA',NULL,'1',NULL,NULL),(341,'Gustavo','Azevedo','gustavo_azevedo134@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1962-07-31','39062806597','1948147266','58038242','25','07507','AVENIDA POMBAL','9984','MANAÍRA',NULL,'1',NULL,NULL),(342,'Julieta','Pereira','julieta_pereira135@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1994-08-24','70495880329','5194477855','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','6265','BRISAMAR',NULL,'1',NULL,NULL),(343,'Daniel','Lima','daniel_lima136@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1960-04-15','37785162131','2169268980','58034820','25','07507','RUA EDMUNDO FILHO','5631','SÃO JOSÉ',NULL,'1',NULL,NULL),(344,'Kai','Fernandes','kai_fernandes137@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1942-05-02','78343285735','9452766386','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','3468','BRISAMAR',NULL,'1',NULL,NULL),(345,'Otávio','Dias','otávio_dias138@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1919-02-19','83402518805','1198237124','58031110','25','07507','RUA ALFREDO COUTINHO DE LIRA','968','PEDRO GONDIM',NULL,'1',NULL,NULL),(346,'Rodrigo','Melo','rodrigo_melo139@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1956-09-14','65153219020','9959712635','58034820','25','07507','RUA EDMUNDO FILHO','8557','SÃO JOSÉ',NULL,'1',NULL,NULL),(347,'Leila','Alves','leila_alves140@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1940-12-10','25628786713','4157608017','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','8308','TORRE',NULL,'1',NULL,NULL),(348,'Amanda','Cunha','amanda_cunha141@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1964-04-02','76918975706','9296259219','58031080','25','07507','RUA JOÃO VIEIRA CARNEIRO','7701','PEDRO GONDIM',NULL,'1',NULL,NULL),(349,'Julian','Correia','julian_correia142@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1925-07-07','16159453939','4190913043','58050660','25','07507','RUA JOSÉ DIONÍZIO DA SILVA','2459','CASTELO BRANCO',NULL,'1',NULL,NULL),(350,'Eduardo','Rodrigues','eduardo_rodrigues143@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1999-01-27','68261771024','6187486247','58074050','25','07507','RUA VIOLONISTA RAFAEL RABELO','9403','JOSÉ AMÉRICO DE ALMEIDA',NULL,'1',NULL,NULL),(351,'Enzo','Pereira','enzo_pereira144@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1975-07-08','88593964508','2428816970','58042110','25','07507','RUA VANDIK PINTO FILGUEIRAS','1193','TAMBAUZINHO',NULL,'1',NULL,NULL),(352,'Nicole','Santos','nicole_santos145@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1936-12-23','64486485777','9421646459','58053175','25','07507','RUA ANTÔNIO VIEIRA DA SILVA','5429','JARDIM SÃO PAULO',NULL,'1',NULL,NULL),(353,'Tânia','Barbosa','tânia_barbosa146@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1948-04-19','37539621044','1284498269','58046040','25','07507','RUA OLIVÉRIO MAVIGNIER DE NORONHA','3077','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(354,'André','Sousa','andré_sousa147@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1975-08-08','64220135669','5395633925','58046088','25','07507','RUA BANCÁRIO ELIAS FELICIANO MADRUGA','5792','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(355,'Martim','Silva','martim_silva148@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1978-02-25','68975052427','1152609260','58038241','25','07507','AVENIDA POMBAL','9162','MANAÍRA',NULL,'1',NULL,NULL),(356,'Sophia','Azevedo','sophia_azevedo149@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1968-06-29','35271752291','1198242283','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','9571','AEROCLUBE',NULL,'1',NULL,NULL),(357,'Vitória','Pereira','vitória_pereira150@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1938-11-03','75186784702','2145865306','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','8398','AEROCLUBE',NULL,'1',NULL,NULL),(358,'Fernanda','Melo','fernanda_melo151@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1940-08-31','70411544594','5542264607','58033390','25','07507','RUA PROFESSOR FRANCISCO OLIVEIRA PORTO','2250','BRISAMAR',NULL,'1',NULL,NULL),(359,'Eduardo','Ribeiro','eduardo_ribeiro152@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1926-11-07','57853557361','3125799739','58038142','25','07507','AVENIDA GUARABIRA','7619','MANAÍRA',NULL,'1',NULL,NULL),(360,'Amanda','Almeida','amanda_almeida153@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1957-11-28','12883691231','1882013596','58034140','25','07507','PRAÇA MANOEL COLAÇO SOBRINHO','8955','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(361,'Luana','Almeida','luana_almeida154@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1984-04-24','51556461208','3179984394','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','6869','TREZE DE MAIO',NULL,'1',NULL,NULL),(362,'Daniel','Lima','daniel_lima155@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1949-11-03','16493503094','1154735002','58034825','25','07507','RUA DO RIO','8766','SÃO JOSÉ',NULL,'1',NULL,NULL),(363,'Murilo','Cavalcanti','murilo_cavalcanti156@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1969-06-01','93751935940','2423249620','58038381','25','07507','AVENIDA SAPÉ','2194','MANAÍRA',NULL,'1',NULL,NULL),(364,'Yasmin','Silva','yasmin_silva157@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1997-07-14','68847977975','8196449387','58053175','25','07507','RUA ANTÔNIO VIEIRA DA SILVA','7706','JARDIM SÃO PAULO',NULL,'1',NULL,NULL),(365,'Giovanna','Fernandes','giovanna_fernandes158@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1941-05-17','59323705306','1999015434','58041000','25','07507','AVENIDA JÚLIA FREIRE','2991','TAMBAUZINHO',NULL,'1',NULL,NULL),(366,'Beatriz','Martins','beatriz_martins159@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1978-04-23','54548257357','8626986114','58038420','25','07507','RUA SILVINO CHAVES','4141','MANAÍRA',NULL,'1',NULL,NULL),(367,'Júlio','Rocha','júlio_rocha160@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1932-09-06','22697627545','1158815029','58038580','25','07507','RUA VIGOLVINO FLORENTINO COSTA','829','MANAÍRA',NULL,'1',NULL,NULL),(368,'Marisa','Carvalho','marisa_carvalho161@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1982-05-05','66419313821','8353768606','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','1963','TORRE',NULL,'1',NULL,NULL),(369,'Caio','Souza','caio_souza162@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1916-08-21','68715318826','4797243870','58038142','25','07507','AVENIDA GUARABIRA','2596','MANAÍRA',NULL,'1',NULL,NULL),(370,'Camila','Souza','camila_souza163@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1920-12-03','58016861008','5486134591','58038521','25','07507','RUA FRANCISCO BRANDÃO','100','MANAÍRA',NULL,'1',NULL,NULL),(371,'Erick','Barbosa','erick_barbosa164@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1962-07-31','56431735900','8138682303','58043320','25','07507','RUA MARIETA STEIMBACH SILVA','9295','MIRAMAR',NULL,'1',NULL,NULL),(372,'Rafael','Rocha','rafael_rocha165@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1918-11-17','30641667515','4469123708','58030060','25','07507','AVENIDA GOIAS','6499','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(373,'Vinicius','Dias','vinicius_dias166@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1996-08-18','13654517200','4781317136','58032110','25','07507','RUA GIACOMO PORTO','6651','MIRAMAR',NULL,'1',NULL,NULL),(374,'Douglas','Correia','douglas_correia167@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1982-08-09','71022304518','8566422705','58034822','25','07507','RUA FÁBIO SILVA LIMA','6187','SÃO JOSÉ',NULL,'1',NULL,NULL),(375,'Marisa','Santos','marisa_santos168@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1966-03-08','87048189380','3122894711','58032110','25','07507','RUA GIACOMO PORTO','1181','MIRAMAR',NULL,'1',NULL,NULL),(376,'Breno','Cardoso','breno_cardoso169@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1960-02-28','72524280365','3190712733','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','9305','TREZE DE MAIO',NULL,'1',NULL,NULL),(377,'Miguel','Santos','miguel_santos170@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1922-09-07','84227383765','3186205818','58037000','25','07507','AVENIDA GOVERNADOR FLÁVIO RIBEIRO COUTINHO','9603','MANAÍRA',NULL,'1',NULL,NULL),(378,'Felipe','Castro','felipe_castro171@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1955-12-23','88902243478','3588344373','58039081','25','07507','RUA HELENA MEIRA LIMA','171','TAMBAÚ',NULL,'1',NULL,NULL),(379,'Melissa','Ribeiro','melissa_ribeiro172@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1954-09-26','13784972608','4223497310','58038680','25','07507','RUA MANOEL ARRUDA CAVALCANTI','263','MANAÍRA',NULL,'1',NULL,NULL),(380,'Eduarda','Lima','eduarda_lima173@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1997-10-07','56276801640','2168535048','58038620','25','07507','RUA DA CANDELÁRIA','7626','MANAÍRA',NULL,'1',NULL,NULL),(381,'Vitoria','Oliveira','vitoria_oliveira174@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1962-06-08','35074455065','1493109891','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','9863','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(382,'Paulo','Ribeiro','paulo_ribeiro175@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1945-09-18','73983097758','1251093070','58046088','25','07507','RUA BANCÁRIO ELIAS FELICIANO MADRUGA','7392','ALTIPLANO CABO BRANCO',NULL,'1',NULL,NULL),(383,'Maria','Pereira','maria_pereira176@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1973-12-07','96033220242','8559323210','58039021','25','07507','RUA JOSÉ AUGUSTO TRINDADE','4839','TAMBAÚ',NULL,'1',NULL,NULL),(384,'Matilde','Sousa','matilde_sousa177@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1963-04-06','51995642690','1596447123','58031110','25','07507','RUA ALFREDO COUTINHO DE LIRA','388','PEDRO GONDIM',NULL,'1',NULL,NULL),(385,'Laura','Ferreira','laura_ferreira178@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1967-11-18','36603717182','6184489982','58034820','25','07507','RUA EDMUNDO FILHO','7958','SÃO JOSÉ',NULL,'1',NULL,NULL),(386,'Estevan','Gomes','estevan_gomes179@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1976-12-10','12854124197','2198815546','58034140','25','07507','PRAÇA MANOEL COLAÇO SOBRINHO','9365','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(387,'Fernanda','Barros','fernanda_barros180@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1937-01-09','22182615881','8546776071','58038519','25','07507','RUA CONSTRUTOR HUMBERTO RUFFO','1748','MANAÍRA',NULL,'1',NULL,NULL),(388,'Carlos','Pinto','carlos_pinto181@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1990-02-04','39158949070','1182979937','58025650','25','07507','RUA CAPITÃO FRANCISCO MOURA','8432','TREZE DE MAIO',NULL,'1',NULL,NULL),(389,'Nicolash','Pinto','nicolash_pinto182@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1960-07-05','84733635583','1932364008','58038151','25','07507','AVENIDA FRANCA FILHO','260','MANAÍRA',NULL,'1',NULL,NULL),(390,'Carla','Silva','carla_silva183@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1991-08-29','66531588292','8430558679','58038242','25','07507','AVENIDA POMBAL','6856','MANAÍRA',NULL,'1',NULL,NULL),(391,'Vitór','Ribeiro','vitór_ribeiro184@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1982-08-18','86084475922','3175146569','58036828','25','07507','RUA ESTUDANTE JOSÉ KLEAN PEREIRA MOURA','1809','AEROCLUBE',NULL,'1',NULL,NULL),(392,'Eduardo','Cavalcanti','eduardo_cavalcanti185@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1964-11-20','41920077545','1173403931','58039130','25','07507','AVENIDA PROFA. MARIA SALES','4627','TAMBAÚ',NULL,'1',NULL,NULL),(393,'Rodrigo','Fernandes','rodrigo_fernandes186@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1945-08-19','87162755194','5584844653','58030280','25','07507','AVENIDA GUANABARA','9885','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(394,'Luan','Gomes','luan_gomes187@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1922-10-31','77279302963','8142549225','58041030','25','07507','RUA PROFESSOR JOAQUIM SANTIAGO','9030','EXPEDICIONÁRIOS',NULL,'1',NULL,NULL),(395,'Miguel','Almeida','miguel_almeida188@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1980-03-23','19062580157','6186057148','58036873','25','07507','RUA ADÃO VIANA DA ROSA','5718','AEROCLUBE',NULL,'1',NULL,NULL),(396,'Tomás','Araujo','tomás_araujo189@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1981-05-22','52653760975','7197398542','58034050','25','07507','RUA VALDA CRUZ CORDEIRO','6918','JOÃO AGRIPINO',NULL,'1',NULL,NULL),(397,'Caio','Dias','caio_dias190@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1980-11-27','32075841446','2868953054','58034822','25','07507','RUA FÁBIO SILVA LIMA','1704','SÃO JOSÉ',NULL,'1',NULL,NULL),(398,'Emily','Oliveira','emily_oliveira191@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1946-12-05','37363907501','8572926301','58038151','25','07507','AVENIDA FRANCA FILHO','1948','MANAÍRA',NULL,'1',NULL,NULL),(399,'Maria','Sousa','maria_sousa192@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1926-06-29','67225728890','1288686821','58038241','25','07507','AVENIDA POMBAL','2286','MANAÍRA',NULL,'1',NULL,NULL),(400,'Mariana','Pinto','mariana_pinto193@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1977-01-28','41506622747','1666362021','58037695','25','07507','RUA ALBERTINO ALFREDO DE ARAÚJO FILHO','7736','JARDIM OCEANIA',NULL,'1',NULL,NULL),(401,'Carla','Almeida','carla_almeida194@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1924-08-26','51632440008','9141973668','58040530','25','07507','RUA ETELVINA MACEDO DE MENDONÇA','6388','TORRE',NULL,'1',NULL,NULL),(402,'Aline','Ferreira','aline_ferreira195@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1964-06-20','56493057817','1942368116','58030280','25','07507','AVENIDA GUANABARA','8661','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(403,'Guilherme','Pinto','guilherme_pinto196@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1954-10-21','35724245779','6187066546','58038420','25','07507','RUA SILVINO CHAVES','3393','MANAÍRA',NULL,'1',NULL,NULL),(404,'Emily','Martins','emily_martins197@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1966-04-20','90878302034','1177147650','58039130','25','07507','AVENIDA PROFA. MARIA SALES','9790','TAMBAÚ',NULL,'1',NULL,NULL),(405,'Kauã','Goncalves','kauã_goncalves198@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'M','1986-10-16','45751026365','4120517617','58030280','25','07507','AVENIDA GUANABARA','1831','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(406,'Carolina','Castro','carolina_castro199@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1983-04-08','85301317202','1148466527','58030280','25','07507','AVENIDA GUANABARA','6432','BAIRRO DOS ESTADOS',NULL,'1',NULL,NULL),(407,'Beatriz','Martins','beatriz_martins200@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S',NULL,'F','1949-07-22','18470214411','2193743134','58038381','25','07507','AVENIDA SAPÉ','1838','MANAÍRA',NULL,'1',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-14  0:08:01
