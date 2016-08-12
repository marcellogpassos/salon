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
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compra` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data_compra` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cliente_id` bigint(20) NOT NULL,
  `valor_total` float NOT NULL,
  `desconto` float NOT NULL DEFAULT '0',
  `caixa_id` bigint(20) NOT NULL,
  `forma_pagamento_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cliente_compra_idx` (`cliente_id`),
  KEY `fk_forma_pagamento_compra_idx` (`forma_pagamento_id`),
  CONSTRAINT `fk_caixa_compra` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cliente_compra` FOREIGN KEY (`cliente_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_forma_pagamento_compra` FOREIGN KEY (`forma_pagamento_id`) REFERENCES `forma_pagamento` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_info`
--

LOCK TABLES `db_info` WRITE;
/*!40000 ALTER TABLE `db_info` DISABLE KEYS */;
INSERT INTO `db_info` VALUES (1,'1608091813','2016-08-09 21:13:54'),(2,'1608121030','2016-08-12 13:30:00');
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
INSERT INTO `forma_pagamento` VALUES (1,'DINHEIRO','2016-08-12 13:22:43','2016-08-12 13:22:43'),(2,'CARTÃO DE DÉBITO','2016-08-12 13:22:43','2016-08-12 13:22:43'),(3,'CARTÃO DE CRÉDITO','2016-08-12 13:22:43','2016-08-12 13:22:43'),(4,'TRANSFERÊNCIA BANCÁRIA','2016-08-12 13:22:43','2016-08-12 13:22:43'),(5,'CHEQUE','2016-08-12 13:22:43','2016-08-12 13:22:43');
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
  `funcionario_id` bigint(20) DEFAULT NULL,
  `valor_unitario_corrente` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_compra_idx` (`item_id`),
  KEY `fk_compra_item_idx` (`compra_id`),
  KEY `fk_funcionario_item_compra_idx` (`funcionario_id`),
  CONSTRAINT `fk_compra_item` FOREIGN KEY (`compra_id`) REFERENCES `compra` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_funcionario_item_compra` FOREIGN KEY (`funcionario_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_item_compra` FOREIGN KEY (`item_id`) REFERENCES `itens_venda` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_compra`
--

LOCK TABLES `item_compra` WRITE;
/*!40000 ALTER TABLE `item_compra` DISABLE KEYS */;
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
INSERT INTO `itens_venda` VALUES (1100,'1',15,'2016-06-15 21:35:25',NULL),(1101,'1',15,'2016-06-15 21:35:25',NULL),(1102,'1',15,'2016-06-15 21:35:25',NULL),(1103,'1',15,'2016-06-15 21:35:25',NULL),(1104,'1',15,'2016-06-15 21:35:25',NULL),(1105,'1',15,'2016-06-15 21:35:25',NULL),(1106,'1',15,'2016-06-15 21:35:25',NULL),(1107,'1',15,'2016-06-15 21:35:25',NULL),(1200,'1',153,'2016-06-15 21:35:25','2016-08-10 18:03:12'),(1201,'1',15,'2016-06-15 21:35:25',NULL),(1202,'1',15,'2016-06-15 21:35:25',NULL),(1203,'1',15,'2016-06-15 21:35:25',NULL),(1204,'1',15,'2016-06-15 21:35:25',NULL),(1205,'1',15,'2016-06-15 21:35:25',NULL),(1206,'1',500,'2016-07-29 17:53:26','2016-07-29 17:53:26'),(1207,'1',600,'2016-07-29 18:01:08','2016-07-29 18:01:08'),(1300,'1',15,'2016-06-15 21:35:25',NULL),(1301,'1',15,'2016-06-15 21:35:25',NULL),(1302,'1',15,'2016-06-15 21:35:25',NULL),(1400,'1',15,'2016-06-15 21:35:25',NULL),(1401,'1',15,'2016-06-15 21:35:25',NULL),(1402,'1',15,'2016-06-15 21:35:25',NULL),(1403,'1',15,'2016-06-15 21:35:25',NULL),(1404,'1',15,'2016-06-15 21:35:25',NULL),(1405,'1',15,'2016-06-15 21:35:25',NULL),(1406,'1',15,'2016-06-15 21:35:25',NULL),(1407,'1',15,'2016-06-15 21:35:25',NULL),(1408,'1',15,'2016-06-15 21:35:25',NULL),(1500,'1',15,'2016-06-15 21:35:25',NULL),(1501,'1',15,'2016-06-15 21:35:25',NULL),(1502,'1',15,'2016-06-15 21:35:25',NULL),(1503,'1',15,'2016-06-15 21:35:25',NULL),(1504,'1',15,'2016-06-15 21:35:25',NULL),(1505,'1',15,'2016-06-15 21:35:25',NULL),(1600,'1',15,'2016-06-15 21:35:25',NULL),(1601,'1',15,'2016-06-15 21:35:25',NULL),(1602,'1',15,'2016-06-15 21:35:25',NULL),(1603,'1',15,'2016-07-26 13:29:28',NULL),(2101,'1',15,'2016-06-15 21:35:25',NULL),(2102,'1',15,'2016-06-15 21:35:25',NULL),(2103,'1',15,'2016-06-15 21:35:25',NULL),(2104,'1',15,'2016-06-15 21:35:25',NULL),(2105,'1',15,'2016-06-15 21:35:25',NULL),(2106,'1',15,'2016-06-15 21:35:25',NULL),(2107,'1',15,'2016-06-15 21:35:25',NULL),(2108,'1',15,'2016-06-15 21:35:25',NULL),(2109,'1',15,'2016-06-15 21:35:25',NULL),(2111,'1',15,'2016-06-15 21:35:25',NULL),(2112,'1',15,'2016-06-15 21:35:25',NULL),(2113,'1',15,'2016-06-15 21:35:25',NULL),(2114,'1',15,'2016-06-15 21:35:25',NULL),(2115,'1',15,'2016-06-15 21:35:25',NULL),(2116,'1',23,'2016-07-29 18:02:00','2016-07-29 18:02:00'),(2120,'0',19.9,'2016-07-20 15:50:32','2016-07-20 15:50:43'),(2201,'1',15,'2016-06-15 21:35:25',NULL),(2202,'1',15,'2016-06-15 21:35:25',NULL),(2203,'1',15,'2016-06-15 21:35:25',NULL),(2204,'1',15,'2016-06-15 21:35:25',NULL),(2205,'1',15,'2016-06-15 21:35:25',NULL),(2206,'1',15,'2016-06-15 21:35:25',NULL),(2207,'1',15,'2016-06-15 21:35:25',NULL),(2208,'1',15,'2016-06-15 21:35:25',NULL),(2209,'1',15,'2016-06-15 21:35:25',NULL),(2210,'1',15,'2016-06-15 21:35:25',NULL),(2211,'1',15,'2016-06-15 21:35:25',NULL),(2212,'1',15,'2016-06-15 21:35:25',NULL),(2213,'1',15,'2016-06-15 21:35:25',NULL),(2214,'1',15,'2016-06-15 21:35:25',NULL),(2215,'1',15,'2016-06-15 21:35:25',NULL),(2216,'1',15,'2016-06-15 21:35:25',NULL),(2217,'1',15,'2016-06-15 21:35:25',NULL),(2218,'1',15,'2016-06-15 21:35:25',NULL),(2219,'1',15,'2016-06-15 21:35:25',NULL),(2220,'1',15,'2016-06-15 21:35:25',NULL),(2221,'1',15,'2016-06-15 21:35:25',NULL),(2222,'1',15,'2016-06-15 21:35:25',NULL),(2223,'1',15,'2016-06-15 21:35:25',NULL),(2224,'1',15,'2016-06-15 21:35:25',NULL),(2225,'1',15,'2016-06-15 21:35:25',NULL),(2226,'1',15,'2016-06-15 21:35:25',NULL),(2227,'1',15,'2016-06-15 21:35:25',NULL),(2228,'1',15,'2016-06-15 21:35:25',NULL),(2229,'1',15,'2016-06-15 21:35:25',NULL),(2230,'1',15,'2016-06-15 21:35:25',NULL),(2231,'1',15,'2016-06-15 21:35:25',NULL),(2232,'1',15,'2016-06-15 21:35:25',NULL),(2233,'1',15,'2016-06-15 21:35:25',NULL),(2234,'1',15,'2016-06-15 21:35:25',NULL),(2235,'1',15,'2016-06-15 21:35:25',NULL),(2236,'1',15,'2016-06-15 21:35:25',NULL),(2237,'1',15,'2016-06-15 21:35:25',NULL),(2238,'1',15,'2016-06-15 21:35:25',NULL),(2239,'1',15,'2016-06-15 21:35:25',NULL),(2240,'1',15,'2016-06-15 21:35:25',NULL),(2241,'1',15,'2016-06-15 21:35:25',NULL),(2242,'1',15,'2016-06-15 21:35:25',NULL),(2301,'1',200,'2016-06-15 21:35:25','2016-08-10 18:08:39'),(2302,'1',15,'2016-06-15 21:35:25',NULL),(2303,'1',15,'2016-06-15 21:35:25',NULL),(2304,'1',15,'2016-06-15 21:35:25',NULL),(2305,'1',15,'2016-06-15 21:35:25',NULL),(2306,'1',15,'2016-06-15 21:35:25',NULL),(2307,'1',15,'2016-06-15 21:35:25',NULL),(2308,'1',15,'2016-06-15 21:35:25',NULL),(2309,'1',15,'2016-06-15 21:35:25',NULL),(2310,'1',15,'2016-06-15 21:35:25',NULL),(2311,'1',15,'2016-06-15 21:35:25',NULL),(2312,'1',15,'2016-06-15 21:35:25',NULL),(2313,'1',15,'2016-06-15 21:35:25',NULL),(2401,'1',15,'2016-06-15 21:35:25',NULL),(2402,'1',15,'2016-06-15 21:35:25',NULL),(2403,'1',15,'2016-06-15 21:35:25',NULL),(2404,'1',15,'2016-06-15 21:35:25',NULL),(2405,'1',15,'2016-06-15 21:35:25',NULL),(2406,'1',15,'2016-06-15 21:35:25',NULL),(2407,'1',15,'2016-06-15 21:35:25',NULL),(2408,'1',15,'2016-06-15 21:35:25',NULL),(2409,'1',15,'2016-06-15 21:35:25',NULL);
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
INSERT INTO `produtos` VALUES (2102,'ANTIFRIZZ',1,2,0,'2016-06-15 21:40:06','2016-07-26 14:49:18'),(2103,'ATIVADOR DE CACHOS',1,3,1,'2016-06-15 21:40:06',NULL),(2104,'XAMPU NEUTRO',1,4,1,'2016-06-15 21:40:06',NULL),(2105,'XAMPU SECO',1,1,1,'2016-06-15 21:40:06',NULL),(2106,'VOLUMIZADOR',1,2,1,'2016-06-15 21:40:06',NULL),(2107,'POMADA',1,3,1,'2016-06-15 21:40:06',NULL),(2108,'HIDRATANTE COM COR',1,4,1,'2016-06-15 21:40:06',NULL),(2109,'MUSSE PARA MODELAR',1,1,1,'2016-06-15 21:40:06',NULL),(2111,'SÉRUM ANTIOXIDANTE',1,2,1,'2016-06-15 21:40:06',NULL),(2112,'SPRAY DE BRILHO',1,3,1,'2016-06-15 21:40:06',NULL),(2113,'SPRAY FIXADOR',1,4,1,'2016-06-15 21:40:06',NULL),(2114,'TINTURA CASEIRA',1,2,1,'2016-06-15 21:40:06',NULL),(2115,'TINTURA PARA RAIZ',1,3,1,'2016-06-15 21:40:06',NULL),(2116,'XAMPU SóLIDO',1,1,18,'2016-07-29 18:02:00','2016-07-29 18:02:00'),(2120,'BASE PARA OLHEIRAS',2,3,2,'2016-07-20 15:50:32','2016-07-20 15:50:32'),(2202,'BASE DE TRATAMENTO',2,1,1,'2016-06-15 21:40:06',NULL),(2203,'BASE EM PÓ',2,2,1,'2016-06-15 21:40:06',NULL),(2204,'BASE LÍQUIDA',2,3,1,'2016-06-15 21:40:06',NULL),(2205,'BASE MINERAL',2,4,1,'2016-06-15 21:40:06',NULL),(2206,'BATOM',2,1,1,'2016-06-15 21:40:06',NULL),(2207,'BATOM/GLOSS DE LONGA DURAÇÃO',2,2,1,'2016-06-15 21:40:06',NULL),(2208,'BB CREAM',2,3,1,'2016-06-15 21:40:06',NULL),(2209,'BLUSH EM CREME',2,4,1,'2016-06-15 21:40:06',NULL),(2210,'BLUSH EM PÓ',2,1,1,'2016-06-15 21:40:06',NULL),(2211,'CÍLIOS POSTIÇOS',2,2,1,'2016-06-15 21:40:06',NULL),(2212,'CORRETIVO',2,3,1,'2016-06-15 21:40:06',NULL),(2213,'CORRETOR DE COR',2,4,1,'2016-06-15 21:40:06',NULL),(2214,'CREME ANTIRRUGAS',2,1,1,'2016-06-15 21:40:06',NULL),(2215,'CREME NOTURNO',2,2,1,'2016-06-15 21:40:06',NULL),(2216,'CREME PARA OS OLHOS',2,3,1,'2016-06-15 21:40:06',NULL),(2217,'DELINEADOR LÍQUIDO OU EM GEL',2,4,1,'2016-06-15 21:40:06',NULL),(2218,'DEMAQUILANTE',2,1,1,'2016-06-15 21:40:06',NULL),(2219,'DEMAQUILANTE PARA OLHOS',2,2,1,'2016-06-15 21:40:06',NULL),(2220,'ESFOLIANTE',2,3,1,'2016-06-15 21:40:06',NULL),(2221,'GLOSS',2,4,1,'2016-06-15 21:40:06',NULL),(2222,'ILUMINADOR',2,1,1,'2016-06-15 21:40:06',NULL),(2223,'LÁPIS DE BOCA',2,2,1,'2016-06-15 21:40:06',NULL),(2224,'LÁPIS DELINEADOR',2,3,1,'2016-06-15 21:40:06',NULL),(2225,'LÁPIS PARA SOBRANCELHAS',2,4,1,'2016-06-15 21:40:06',NULL),(2227,'MÁSCARA DE CÍLIOS',2,2,1,'2016-06-15 21:40:06',NULL),(2228,'MÁSCARA DE CÍLIOS À PROVA DE ÁGUA',2,3,1,'2016-06-15 21:40:06',NULL),(2229,'MÁSCARA DE HIDRATAÇÃO',2,4,1,'2016-06-15 21:40:06',NULL),(2230,'MÁSCARA FACIAL',2,1,1,'2016-06-15 21:40:06',NULL),(2231,'ÓLEO OU SÉRUM PARA O ROSTO',2,2,1,'2016-06-15 21:40:06',NULL),(2232,'PALETA DE SOMBRAS',2,3,1,'2016-06-15 21:40:06',NULL),(2233,'PINÇA DE SOBRANCELHAS',2,4,1,'2016-06-15 21:40:06',NULL),(2234,'PINCEL DE BLUSH',2,1,1,'2016-06-15 21:40:06',NULL),(2235,'PINCEL DE SOMBRA',2,2,1,'2016-06-15 21:40:06',NULL),(2236,'PINCEL PARA BASE',2,3,1,'2016-06-15 21:40:06',NULL),(2237,'PÓ BRONZEADOR',2,4,1,'2016-06-15 21:40:06',NULL),(2238,'PÓ COMPACTO',2,1,1,'2016-06-15 21:40:06',NULL),(2239,'PREENCHEDOR DE LINHAS FINAS',2,2,1,'2016-06-15 21:40:06',NULL),(2240,'SABONETE PARA O ROSTO',2,3,1,'2016-06-15 21:40:06',NULL),(2241,'PROTETOR FACIAL',2,4,1,'2016-06-15 21:40:06',NULL),(2242,'PROTETOR FACIAL SEM ÓLEO',2,1,1,'2016-06-15 21:40:06',NULL),(2301,'AUTOBRONZEADOR PARA O CORPO',3,2,1,'2016-06-15 21:40:06',NULL),(2302,'AUTOBRONZEADOR PARA O ROSTO',3,3,1,'2016-06-15 21:40:06',NULL),(2303,'CREME PARA CELULITE',3,4,1,'2016-06-15 21:40:06',NULL),(2304,'CREME PARA O DIA COM PROTEÇÃO SOLAR',3,1,1,'2016-06-15 21:40:06',NULL),(2305,'SABONETE LÍQUIDO',3,NULL,1,'2016-06-15 21:40:06',NULL),(2306,'DESODORANTE',3,NULL,1,'2016-06-15 21:40:06',NULL),(2307,'SABÃO EM BARRA',3,NULL,1,'2016-06-15 21:40:06',NULL),(2308,'ESFOLIANTE CORPORAL',3,NULL,1,'2016-06-15 21:40:06',NULL),(2309,'HIDRATANTE CORPORAL',3,2,1,'2016-06-15 21:40:06',NULL),(2310,'LOÇÃO CORPORAL',3,4,1,'2016-06-15 21:40:06',NULL),(2311,'PROTETOR SOLAR PARA A PRÁTICA DE ESPORTES',3,2,1,'2016-06-15 21:40:06',NULL),(2312,'PROTETOR SOLAR PARA O CORPO',3,4,1,'2016-06-15 21:40:06',NULL),(2313,'PROTETOR TÉRMICO',3,3,1,'2016-06-15 21:40:06',NULL),(2401,'CREME PARA AS MÃOS',4,1,1,'2016-06-15 21:40:06',NULL),(2402,'CREME PARA OS PÉS',4,3,1,'2016-06-15 21:40:06',NULL),(2403,'ESMALTE ESCURO',4,1,1,'2016-06-15 21:40:06',NULL),(2404,'ESMALTE EXTRABRILHO',4,4,1,'2016-06-15 21:40:06',NULL),(2405,'ESMALTE NUDE',4,2,1,'2016-06-15 21:40:06',NULL),(2406,'ESMALTE VERMELHO',4,4,1,'2016-06-15 21:40:06',NULL),(2407,'HIDRATANTE DE CUTÍCULAS',4,2,1,'2016-06-15 21:40:06',NULL),(2408,'REMOVEDOR DE CUTÍCULAS',4,NULL,1,'2016-06-15 21:40:06',NULL),(2409,'REMOVEDOR DE ESMALTES',4,1,1,'2016-06-15 21:40:06',NULL);
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
INSERT INTO `servicos` VALUES (1100,'CORTE MASCULINO BÁSICO',1,'1','0','2016-06-15 21:41:31',NULL),(1101,'CORTE MASCULINO COM MÁQUINA',1,'1','0','2016-06-15 21:41:31',NULL),(1102,'CORTE FEMININO DEGRADÊ',1,'0','1','2016-06-15 21:41:31',NULL),(1103,'CORTE FEMININO DESFIADO',1,'0','1','2016-06-15 21:41:31',NULL),(1104,'CORTE FEMININO REPICADO',1,'0','1','2016-06-15 21:41:31',NULL),(1105,'CORTE FEMININO RETO (BÁSICO)',1,'0','1','2016-06-15 21:41:31',NULL),(1106,'CORTE CHANEL',1,'1','1','2016-06-15 21:41:31',NULL),(1107,'CORTE DE FRANJA',1,'1','1','2016-06-15 21:41:31',NULL),(1200,'ALISAMENTO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1201,'HIDRATAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1202,'COLORAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1203,'ONDULAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1204,'CAUTERIZAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1205,'QUERATINIZAÇÃO CAPILAR',2,'1','1','2016-06-15 21:41:31',NULL),(1206,'CAPIM CUBANO',2,'1','0','2016-07-29 17:53:26','2016-07-29 17:53:26'),(1207,'MEIA TONTA',2,'0','1','2016-07-29 18:01:08','2016-07-29 18:01:08'),(1300,'MANICURE',3,'1','1','2016-06-15 21:41:31',NULL),(1301,'PEDICURE',3,'1','1','2016-06-15 21:41:31',NULL),(1302,'PODOLOGIA',3,'1','1','2016-06-15 21:41:31',NULL),(1400,'DEPILAÇÃO À CERA',4,'0','1','2016-06-15 21:41:31',NULL),(1401,'DEPILAÇÃO À LASER',4,'0','1','2016-06-15 21:41:31',NULL),(1402,'DEPILAÇÃO COM LINHA',4,'0','1','2016-06-15 21:41:31',NULL),(1403,'DEPILAÇÃO ARTÍSTICA',4,'0','1','2016-06-15 21:41:31',NULL),(1404,'DEPILAÇÃO DAS PERNAS',4,'0','1','2016-06-15 21:41:31',NULL),(1405,'DEPILAÇÃO DA VIRILHA',4,'0','1','2016-06-15 21:41:31',NULL),(1406,'DEPILAÇÃO DAS AXILAS',4,'0','1','2016-06-15 21:41:31',NULL),(1407,'DEPILAÇÃO DE BUÇO',4,'0','1','2016-06-15 21:41:31',NULL),(1500,'MAQUIAGEM',5,'1','1','2016-06-15 21:41:31',NULL),(1501,'DESIGN DE SOBRANCELHAS',5,'1','1','2016-06-15 21:41:31',NULL),(1502,'LIMPEZA DE PELE',5,'1','1','2016-06-15 21:41:31',NULL),(1503,'PEELING FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1504,'DRENAGEM LINFÁTICA FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1505,'LASER FACIAL',5,'1','1','2016-06-15 21:41:31',NULL),(1600,'DRENAGEM LINFÁTICA CORPORAL',6,'0','1','2016-06-15 21:41:31',NULL),(1601,'MASSAGEM REDUTORA',6,'0','1','2016-06-15 21:41:31',NULL),(1602,'BRONZEAMENTO ARTIFICIAL',6,'0','1','2016-06-15 21:41:31',NULL),(1603,'BARBA E BIGODE',1,'1','0','2016-07-26 13:29:58',NULL);
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Marcello','Galdino Passos','marcellogpassos@gmail.com','$2y$10$s2TLmlXVjEP531gPgYIKYOeEuDNn49vTg0l2AwYFCV13NTIYt/G1S','racwi4A1rDsh8ArlfAKdzbp5k5wEbjuSM5S8fpweSAc8vteExrLXrjGwo57c','M','1990-05-04','08417523464','83996917109','58030060','25','07507','Rua Goiás','284','Estados','Apartamento 1703','2016-06-09 00:49:45','2016-08-01 19:38:01'),(2,'Ana Carolina','Sousa Alves Passos','carolasalves@gmail.com','$2y$10$pnjd09c3zNwQOxxaVSC5/ui.dkduZTInR2p7NLYsjy.F9Ih1zyVjC','fjPKdg6MakZhbJfwCxO7FTuHAoJVhiUZ3IOdRVGeADQT9RvQzx0OOsOLKG9I','F','1992-11-17','60480663092','83999649598','58030060','25','07507','Rua Goiás','284','Estados','até 415/416','2016-06-09 00:51:24','2016-06-21 21:12:12'),(3,'Márcio','Galdino Passos','marciogpassos@gmail.com','$2y$10$.jkLRvezxZ2ZIKxLipDVU.ZxJJ.baW3RrrRVa4xFo1/MpmZJjOzDC','8vwSp65mgxRb1OeJGBTunZZ1OtZV8PD6Pl4S79QZT5xARivXCPnxNwktRib7','M','1981-09-22','33834479608','61993086183','71919360','53','00108','Rua 37 Norte','Lote 1','Norte (Águas Claras)','Edifício Cezanne - Apto. 1404','2016-06-09 21:59:40','2016-06-16 00:06:16'),(4,'Luciano','Carvalho de Medeiros Júnior','lucamenor@gmail.com','$2y$10$2UO1zKCEnYpEOWv.VCretO.bNzCIiCXjlQSAihO1Faae4F7IQWSim',NULL,'M','1989-02-05','76371095340','11932834063','07085190','35','18800','Rua Noventa e Dois','40','Parque Continental','','2016-06-13 23:39:12','2016-06-13 23:40:41'),(5,'Tomás','Barbosa Martins','tomasbarbosamartins@inbound.plus','$2y$10$RAaFKDFNT0p3IxtC9A652OjDAerk8k3eDdvlL4NRoONvER5NjT0Yu','zwCBUrZf7Hnkb7NVP8nWrZWXNp9aptGKJF1gXlzHXMMHcM3koHhCjeUwqgVd','M','1969-10-25','36783485307','88985709151','03278030','35','50308','Rua Gustavo Stach','795','Vila Ema','','2016-06-15 23:47:19','2016-06-15 23:48:27'),(6,'Julieta','Sousa Rocha','julietasousarocha@inbound.plus','$2y$10$4Cotcoj1Y1bAL1AgSz2U9u1hTqczg8Ntstmae46.O0gUgVd5iuJ52','TvleZM3FaS3ngQcou8aEnPGYneYdKUjnOkQbjtQisg241557bxEsJtyMrkCc','F','1967-03-04','52343142513','16983142824','14055664','35','43402','Travessa Delelmo Mazzo','329','Ipiranga','','2016-06-15 23:57:46','2016-06-16 00:00:54'),(7,'João','Barbosa Cardoso','joaobarbosacardoso@armyspy.com','$2y$10$lqF/WKinrkykCvICbVi6heHQwW9fLiejfcCoOcqj/GTb0TF0yI5Xq',NULL,'M','1970-07-22','79327361962','2479289860','27520175','33','04201','Avenida General Afonseca','1039','Manejo','de 1140 ao fim - lado par','2016-08-01 19:42:21','2016-08-01 19:43:18');
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

-- Dump completed on 2016-08-12 10:28:24
