-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: aurelius_salao
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `agendamentos`
--

LOCK TABLES `agendamentos` WRITE;
/*!40000 ALTER TABLE `agendamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `alertas_barbearia`
--

LOCK TABLES `alertas_barbearia` WRITE;
/*!40000 ALTER TABLE `alertas_barbearia` DISABLE KEYS */;
INSERT INTO `alertas_barbearia` VALUES (1,20,'???? ALERTA DE BOAS-VINDAS: O cliente Marod (925347372) reservou o serviço \'Gel\' e está a caminho!',1,'2026-07-16 14:29:58'),(2,20,'???? ALERTA DE BOAS-VINDAS: O cliente Marod (925347378) reservou o serviço \'Gel\' e está a caminho!',1,'2026-07-16 14:36:29'),(3,20,'???? ALERTA DE BOAS-VINDAS: O cliente Marod (926587454) reservou o serviço \'Gel\' e está a caminho!',1,'2026-07-16 14:36:36'),(4,20,'???? ALERTA DE BOAS-VINDAS: O cliente Marod (925347372) reservou o serviço \'Gel\' e está a caminho!',1,'2026-07-16 14:41:39'),(5,20,'???? ALERTA: O cliente Marod (925347370) reservou o serviço \'Gel\'!',1,'2026-07-16 14:58:01'),(6,20,'???? ALERTA DE REQUERIMENTO: O cliente Marod (925347372) reservou o serviço \'Gel\' e aguarda reconhecimento!',1,'2026-07-16 14:59:56'),(7,20,'???? ALERTA DE REQUERIMENTO: O cliente Marod (925347372) reservou o serviço \'Bom Corte\' e aguarda reconhecimento!',1,'2026-07-16 18:42:44'),(8,20,'???? ALERTA DE REQUERIMENTO: O cliente Marod (925347375) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',1,'2026-07-16 19:34:21'),(9,20,'???? ALERTA DE REQUERIMENTO: O cliente Alex (925347378) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-17 10:17:37'),(10,20,'???? ALERTA DE REQUERIMENTO: O cliente Alex (925347378) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-17 10:18:51'),(11,111,'???? ALERTA DE REQUERIMENTO: O cliente Marod (925347375) reservou o serviço \'Os putos\' e aguarda reconhecimento!',0,'2026-07-17 12:41:56'),(12,111,'???? ALERTA DE REQUERIMENTO: O cliente Alex (935627485) reservou o serviço \'Françês\' e aguarda reconhecimento!',0,'2026-07-17 13:06:51'),(13,20,'???? ALERTA DE REQUERIMENTO: O cliente Alex (925347375) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-17 13:07:25'),(14,20,'???? ALERTA DE REQUERIMENTO: O cliente Alex (935627485) reservou o serviço \'Françês\' e aguarda reconhecimento!',0,'2026-07-17 13:08:30'),(15,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Alex (925347372) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-21 10:06:34'),(16,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Alex (925347372) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-21 10:07:09'),(17,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Alex (925347372) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-21 10:07:26'),(18,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Alex (925347372) reservou o serviço \'Corte com barba\' e aguarda reconhecimento!',0,'2026-07-21 10:08:26'),(19,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Alex (935627485) reservou o serviço \'Gel\' e aguarda reconhecimento!',0,'2026-07-21 10:08:48'),(20,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Julio (926587454) reservou o serviço \'Gel\' e aguarda reconhecimento!',0,'2026-07-21 10:12:53'),(21,0,'🚨 ALERTA DE REQUERIMENTO: O cliente Julio (926587454) reservou o serviço \'Gel\' e aguarda reconhecimento!',0,'2026-07-21 10:13:18');
/*!40000 ALTER TABLE `alertas_barbearia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
INSERT INTO `anuncios` VALUES (19,'Corte com barba','foto_6a51651aa4f3c.jpg',NULL,NULL,0,0,0,0,0,0,0,20,'2026-07-13','foto'),(20,'Françês','foto_6a5165bb0b555.jpg',NULL,NULL,0,1,1,0,0,12,0,20,'2026-07-13','foto'),(25,'Bom Corte','galeria_6a551628c7313_1783961128.png',NULL,NULL,0,4,1,0,0,42,0,20,'2026-07-13','foto'),(26,'Gel','galeria_6a5530c327626_1783967939.jpg',NULL,NULL,0,22,5,0,0,218,10,20,'2026-07-13','foto'),(27,'Corte com barba','galeria_6a553ee142370_1783971553.jpg',NULL,NULL,0,13,4,0,0,138,5,20,'2026-07-13','foto'),(28,'Gel','galeria_6a5773470b3fb_1784116039.jpg',NULL,NULL,0,103,35,0,0,1100,35,20,'2026-07-15','foto'),(29,'Françês','galeria_6a57dc24e4a7b_1784142884.jpg',NULL,NULL,0,1,1,0,0,12,0,111,'2026-07-15','foto'),(30,'Bom Corte','galeria_6a58e18e582b4_1784209806.jpg',NULL,NULL,0,0,0,0,0,0,0,20,'2026-07-16','foto'),(31,'Festa','galeria_6a592f15ac433_1784229653.jpg',NULL,NULL,0,0,0,0,0,0,0,111,'2026-07-16','foto'),(32,'oko','vid_1784230426_6a59321a69955.mp4',NULL,NULL,0,5,1,0,4,20,0,20,'2026-07-16','video'),(33,'Bom demais','vid_1784234651_6a59429b39fc0.mp4',NULL,NULL,0,2,0,0,0,10,0,20,'2026-07-16','foto'),(34,'Aulas de cortes de cabelos','vid_1784234719_6a5942dfcba8a.mp4',NULL,NULL,0,0,0,0,0,10,0,20,'2026-07-16','foto'),(36,'Barba','galeria_6a59eb9407312_1784277908.jpg',NULL,NULL,0,0,0,0,0,0,0,111,'2026-07-17','foto'),(40,'Os putos','galeria_6a5a0131c8ec1_1784283441.jpg',NULL,NULL,0,0,0,0,0,0,0,111,'2026-07-17','foto'),(41,'Aula','vid_1784291937_6a5a226192286.mp4',NULL,NULL,0,7,4,0,0,56,0,231,'2026-07-17','video'),(42,'Vendemos tissagem','vid_1784291982_6a5a228e1a3a9.mp4',NULL,NULL,0,4,2,0,1,58,0,231,'2026-07-17','video'),(43,'Como aplicar cílios','vid_1784292030_6a5a22be67982.mp4',NULL,NULL,0,11,0,0,1,35,0,231,'2026-07-17','video'),(45,'Sombrancelhas','vid_1784292378_6a5a241a1f82b.mp4',NULL,NULL,0,6,4,0,3,10,0,231,'2026-07-17','video'),(46,'hh','galeria_6a5bf39f003cc_1784411039.jpg',NULL,NULL,0,0,0,0,0,0,0,1,'2026-07-18','foto'),(47,'Concorrente','vid_1784601160_6a5eda48dc107.mp4',NULL,NULL,0,27,1,0,0,58,0,20,'2026-07-21','video'),(48,'Corte com barba','galeria_6a67c65faf154_1785185887.jpg',NULL,NULL,0,0,0,0,0,0,0,241,'2026-07-27','foto'),(49,'Crianças 🧒 Felizes','vid_1786699085_6a7edd4d29755.mp4',NULL,NULL,1,2,0,0,0,10,0,20,'2026-08-14','video'),(50,'O Talento em Pessoa','vid_1786714911_6a7f1b1f39b75.mp4',NULL,NULL,1,2,1,0,0,28,0,20,'2026-08-14','video'),(51,'Toca Mano','vid_1786715293_6a7f1c9d5fd63.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-08-14','video'),(52,'São eles','vid_1786715549_6a7f1d9dea38a.mp4',NULL,NULL,1,2,0,0,0,30,0,20,'2026-08-14','video'),(53,'Avalie e dão Vossos Parecer','vid_1786716057_6a7f1f99b1c94.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-08-14','video'),(54,'Amém','vid_1786716645_6a7f21e5cda23.mp4',NULL,NULL,1,2,0,0,0,30,0,20,'2026-08-14','video'),(55,'Bom demais','vid_1786716910_6a7f22ee5b782.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-08-14','video'),(56,'O Rapaz 👦','vid_1786717850_6a7f269ae6b15.mp4',NULL,NULL,1,2,0,0,0,30,0,20,'2026-08-14','video'),(57,'Copiem','vid_1786718333_6a7f287d1c6d2.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-08-14','video'),(58,'ffffffffffffff','vid_1786719257_6a7f2c198001b.mp4',NULL,NULL,1,1,1,0,0,48,0,20,'2026-08-14','video'),(59,'nunca Mais','vid_1786719976_6a7f2ee823260.mp4',NULL,NULL,1,2,1,0,0,28,0,20,'2026-08-14','video'),(60,'É como??','vid_1786819752_6a80b4a88c229.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-08-15','video'),(61,'oko','vid_1786820171_6a80b64b5dd37.mp4',NULL,NULL,1,3,1,0,1,65,0,20,'2026-08-15','video'),(62,'Dafna','prod_1787444868_6a8a3e84b3aec.png',NULL,NULL,1,0,0,0,0,10,0,237,'2026-08-23','foto'),(63,'Avalia','prod_1788382060_6a988b6c11366.png',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','foto'),(64,'Avalia','prod_1788382201_6a988bf986ca3.jpg',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','foto'),(65,'hh','guardar-videos/video_1788385718_6a9899b6d5623.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','video'),(66,'Sikm senhor🙏🏻🙏🏻','guardar-videos/video_1788386737_6a989db168ce4.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','video'),(67,'Sikm senhor🙏🏻🙏🏻','guardar-videos/video_1788387246_6a989fae466bc.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','video'),(68,'Avo','guardar-videos/video_1788388556_6a98a4cc5b6c8.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-02','video'),(69,'Como é possível','guardar-videos/video_1788446343_6a998687431df.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-03','video'),(70,'O ja é Bom','vid_1788467362_6a99d8a280b17.mp4',NULL,NULL,1,0,0,0,0,10,0,20,'2026-09-03','video'),(71,'Sikm senhor🙏🏻🙏🏻','uploads/foto_1789066204_6aa2fbdc02a6e.png',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-10','foto'),(72,'hh','uploads/foto_1789066333_6aa2fc5dd80db.png',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-10','foto'),(73,'Avalia','uploads/video_1789066350_6aa2fc6eb85e3.mp4',NULL,NULL,1,0,0,0,0,10,0,237,'2026-09-10','video');
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `assinaturas`
--

LOCK TABLES `assinaturas` WRITE;
/*!40000 ALTER TABLE `assinaturas` DISABLE KEYS */;
INSERT INTO `assinaturas` VALUES (1,'Aurelio','mensal',1000.00,'2026-07-11 02:19:47','2026-08-10 02:19:47','Ativo','925347372','2026-07-11 01:19:47'),(2,'Aurelio','semestral',5000.00,'2026-07-11 02:20:14','2027-01-07 02:20:14','Ativo','925347370','2026-07-11 01:20:14'),(3,'Sacalumbo','mensal',1000.00,'2026-07-13 19:28:31','2026-08-12 19:28:31','Ativo','925347377','2026-07-13 18:28:31'),(4,'Aurélio Jb','ANUAL',15000.00,'2026-08-10 02:38:51','2027-08-10 02:38:51','Ativo','925525252','2026-08-10 01:38:51'),(5,'Mario','ANUAL',15000.00,'2026-08-10 02:40:20','2027-08-10 02:40:20','Ativo','985689587','2026-08-10 01:40:20'),(6,'Mario','ANUAL',15000.00,'2026-08-10 02:49:27','2027-08-10 02:49:27','Ativo','985689587','2026-08-10 01:49:27'),(7,'Albano','ANUAL',15000.00,'2026-08-10 02:50:18','2027-08-10 02:50:18','Ativo','949062514','2026-08-10 01:50:18'),(8,'Albano','ANUAL',15000.00,'2026-08-10 02:53:24','2027-08-10 02:53:24','Ativo','949062514','2026-08-10 01:53:24'),(9,'Albano','ANUAL',15000.00,'2026-08-10 02:56:50','2027-08-10 02:56:50','Ativo','949062514','2026-08-10 01:56:50'),(10,'Aurélio Jb','ANUAL',15000.00,'2026-08-10 03:33:50','2027-08-10 03:33:50','Ativo','925525252','2026-08-10 02:33:50'),(11,'Pepe','ANUAL',15000.00,'2026-08-10 03:34:33','2027-08-10 03:34:33','Ativo','949062514','2026-08-10 02:34:33'),(12,'Pepe','',15000.00,'2026-08-10 03:38:28','2027-08-10 03:38:28','Ativo','949062514','2026-08-10 02:38:28'),(13,'Gomes','mensal',1500.00,'2026-08-10 03:40:03','2026-09-10 03:40:03','Ativo','925868741','2026-08-10 02:40:03'),(14,'Gomes','mensal',1500.00,'2026-08-10 04:21:46','2027-08-10 04:21:46','Ativo','925868741','2026-08-10 02:52:39'),(15,'Loga','semestral',7500.00,'2026-08-10 03:53:21','2027-02-10 03:53:21','Pendente','925525200','2026-08-10 02:53:21'),(16,'Loga','semestral',7500.00,'2026-08-10 03:58:39','2027-02-10 03:58:39','Pendente','925525200','2026-08-10 02:58:39'),(17,'Kaka','semestral',7500.00,'2026-08-10 04:01:17','2027-02-10 04:01:17','Pendente','912457896','2026-08-10 03:01:17'),(18,'Kaka','semestral',7500.00,'2026-08-10 04:10:55','2027-02-10 04:10:55','Pendente','912457896','2026-08-10 03:10:55'),(19,'Jonas','semestral',7500.00,'2026-08-10 04:21:57','2027-08-10 04:21:57','Ativo','925625874','2026-08-10 03:11:27'),(20,'Jonas','semestral',7500.00,'2026-08-10 04:26:48','2027-02-10 04:26:48','Pendente','925625874','2026-08-10 03:26:48'),(21,'Marta','semestral',7500.00,'2026-08-10 04:27:20','2027-02-10 04:27:20','Pendente','925698741','2026-08-10 03:27:20'),(22,'Marta','semestral',7500.00,'2026-08-10 04:29:14','2027-02-10 04:29:14','Pendente','925698741','2026-08-10 03:29:14'),(23,'Marta','semestral',7500.00,'2026-08-10 04:33:55','2027-02-10 04:33:55','Pendente','925698741','2026-08-10 03:33:55'),(24,'Marta','semestral',7500.00,'2026-08-10 04:37:10','2027-02-10 04:37:10','Pendente','925698741','2026-08-10 03:37:10'),(25,'Marta','semestral',7500.00,'2026-08-10 04:37:58','2027-02-10 04:37:58','Pendente','925698741','2026-08-10 03:37:58'),(26,'Marta','semestral',7500.00,'2026-08-10 04:38:15','2027-02-10 04:38:15','Pendente','925698741','2026-08-10 03:38:15'),(27,'Marta','semestral',7500.00,'2026-08-10 04:38:21','2027-02-10 04:38:21','Pendente','925698741','2026-08-10 03:38:21'),(28,'Marta','semestral',7500.00,'2026-08-10 04:38:54','2027-02-10 04:38:54','Pendente','925698741','2026-08-10 03:38:54'),(29,'Marta','semestral',7500.00,'2026-08-25 22:37:36','2027-08-25 22:37:36','Ativo','925698741','2026-08-10 03:46:31'),(30,'Mateus','',15000.00,'2026-08-14 15:20:47','2027-08-14 15:20:47','Ativo','920202020','2026-08-14 14:20:47');
/*!40000 ALTER TABLE `assinaturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `atendimentos`
--

LOCK TABLES `atendimentos` WRITE;
/*!40000 ALTER TABLE `atendimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cargos_salarios`
--

LOCK TABLES `cargos_salarios` WRITE;
/*!40000 ALTER TABLE `cargos_salarios` DISABLE KEYS */;
INSERT INTO `cargos_salarios` VALUES (1,'Gerente Geral',150000.00),(2,'Sub-Gerente',110000.00),(3,'Supervisor de Turno',44500.00),(4,'Mestre Barbeiro',75000.00),(5,'Mestre Cabeleireiro',75000.00),(6,'Segurança Interno',60000.00),(7,'Motorista Executivo',65000.00),(8,'Auxiliar de Limpeza (Faxineiro)',45000.00),(9,'Recepcionista',50000.00);
/*!40000 ALTER TABLE `cargos_salarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `carteira_adiantamentos`
--

LOCK TABLES `carteira_adiantamentos` WRITE;
/*!40000 ALTER TABLE `carteira_adiantamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `carteira_adiantamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `carteira_saldos_clientes`
--

LOCK TABLES `carteira_saldos_clientes` WRITE;
/*!40000 ALTER TABLE `carteira_saldos_clientes` DISABLE KEYS */;
INSERT INTO `carteira_saldos_clientes` VALUES (1,'925347372','Aurélio Sacalumbo',481500.00,'2026-07-21 09:24:25'),(2,'925478596','Aurelio',26000.07,'2026-07-21 09:25:26'),(3,'920000000','Aurelio',37000.00,'2026-07-20 23:30:59'),(4,'920202020','Matias',900.00,'2026-09-03 17:34:10'),(5,'924232123','Madalena',42000.00,'2026-09-10 20:29:13'),(6,'915258574','Ngonguinho',1500.00,'2026-09-10 21:45:40'),(7,'925347370','Aurélio Sacalumbo',28400.00,'2026-09-10 22:07:03'),(8,'924232100','Jaime',0.01,'2026-09-10 23:02:53'),(9,'','Tatiana',10000.00,'2026-09-10 23:04:28');
/*!40000 ALTER TABLE `carteira_saldos_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Corte Cabelo'),(2,'Cuidados Barba'),(3,'Estética Facial'),(4,'Químicos & Tintura'),(5,'Tratamentos Capilares'),(6,'Manicura & Pedicura'),(7,'Combos Promocionais'),(8,'Infantil (Kids)'),(9,'Depilação Masculina'),(10,'Dia do Noivo / Premium'),(11,'Podologia & Saúde');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'Aurélio Jb','aureliosacalumboo@gmail.com','','925347372','São Luis','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(3,'Aurélio Jb','aureliosacaxlumbo@gmail.com','','925347372','Kavongue','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(4,'Aurélio Jb','aureliosacalumbbo@gmail.com','','925347372','Kapango','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(5,'Jambito','jambito@gmail.com','','925347372','São Luis','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(6,'Beto','beto@gmail.com','','925347372','sdrrer 33','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(7,'Aurélio Jb','branca@aurelius.com','','925347372','sdrrer 33','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(8,'Aurélio Jb','aureliosacalumbo@gmail.com','93b3e12b665ea455b9ef34bcf39dbd7e','','sdrrer 33','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(9,'Jambito','Jambito12@gmail.com','','925347372','São Luis','2026-07-12 23:00:00','Gratis',NULL,0,NULL,'Normal'),(10,'Aurélio Jb','aurelio123@gmail.com','4aa2e788f69ee44e52f353666fea214d','kjdkjdjdjdffjff','sdrrer 33','2026-07-13 23:00:00','Gratis',NULL,0,NULL,'Normal'),(11,'Aurélio Jb','aurelio1234@gmail.com','','925347372','sdrrer 33','2026-07-14 23:00:00','Gratis',NULL,0,NULL,'Normal'),(12,'Cliente Teste VIP','','','925347372',NULL,'2026-07-20 21:16:07','Gratis',NULL,0,NULL,'VIP'),(13,'Cliente Visitante','','123456','aurelio123@gmail.com',NULL,'2026-08-15 23:51:14','Gratis',NULL,0,NULL,'Regular'),(14,'Beto jb','beto123@gmail.com','14e1b600b1fd579f47433b88e8d85291','925347371','Kapango','2026-08-15 23:00:00','Gratis',NULL,0,NULL,'Normal'),(15,'Aurélio Jb','aurelip123@gmail.com','','925347372','sdrrer 33','2026-08-15 23:00:00','Gratis',NULL,0,NULL,'Normal'),(16,'Aurélio Jb','aurelio1ff23@gmail.com','14e1b600b1fd579f47433b88e8d85291','925347370','sdrrer 33','2026-08-15 23:00:00','Gratis',NULL,0,NULL,'Normal'),(17,'Aurélio Jb','aurelioxx123@gmail.com','14e1b600b1fd579f47433b88e8d85291','935627485','sdrrer 33','2026-08-15 23:00:00','Gratis',NULL,0,NULL,'Normal');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clientes_vip`
--

LOCK TABLES `clientes_vip` WRITE;
/*!40000 ALTER TABLE `clientes_vip` DISABLE KEYS */;
INSERT INTO `clientes_vip` VALUES (1,'Aurélio Jb','925282828','aureliojb013@gmail.com','Ativo','AUR-485890','2026-08-10 00:18:52'),(3,'Aurélio Jb','925525252','Jaimejb01@gmail.com','Ativo','AUR-252048','2026-08-10 00:32:05');
/*!40000 ALTER TABLE `clientes_vip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comentarios_reels`
--

LOCK TABLES `comentarios_reels` WRITE;
/*!40000 ALTER TABLE `comentarios_reels` DISABLE KEYS */;
INSERT INTO `comentarios_reels` VALUES (1,47,'Utilizador Aurelius','Um, dos melhores grupo ja existente😎👈','2026-07-21 08:44:44'),(2,47,'Utilizador Aurelius','@Resposta a Utilizador Aurelius:  Não é pra tanto...','2026-07-21 08:45:11'),(3,26,'Utilizador Aurelius','jhhhhjhj','2026-07-27 15:48:09'),(4,26,'Utilizador Aurelius','hjjjjjj','2026-07-27 15:48:13'),(5,49,'Utilizador Aurelius','Estes Rapazes👨🏼‍🦰😃😃😃😃','2026-08-14 09:20:51'),(6,49,'Utilizador Aurelius','@Resposta a Utilizador Aurelius:  Gostei dos Toks','2026-08-14 09:21:12'),(7,58,'Utilizador Aurelius','Este jovem é louco😂😂😂','2026-08-15 20:12:43'),(8,33,'Utilizador Aurelius','Muito Peixe Man','2026-08-16 00:32:16'),(9,27,'Utilizador Aurelius','Preciso de 4 Unidades de Unhas','2026-08-16 00:33:24'),(10,27,'Utilizador Aurelius','Preciso de 4 Unidades de Unhas','2026-08-16 00:33:33'),(11,58,'Utilizador Aurelius','fgggggfdf','2026-08-23 00:17:13'),(12,42,'Utilizador Aurelius','Essa moça, então é como???','2026-08-23 20:44:55');
/*!40000 ALTER TABLE `comentarios_reels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `configuracoes_plataforma`
--

LOCK TABLES `configuracoes_plataforma` WRITE;
/*!40000 ALTER TABLE `configuracoes_plataforma` DISABLE KEYS */;
INSERT INTO `configuracoes_plataforma` VALUES (1,'iban_plataforma','AO06.0040.0000.9068.8685.1014.8');
/*!40000 ALTER TABLE `configuracoes_plataforma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `depoimentos`
--

LOCK TABLES `depoimentos` WRITE;
/*!40000 ALTER TABLE `depoimentos` DISABLE KEYS */;
INSERT INTO `depoimentos` VALUES (26,'Aurélio Sacalumbo','uploads/avatar_6a51868d48a532.98646379.jpg',4,'O App está optimo, mais ou menos..','Opas, que bom Mano, vamos continuar trabalhando','2026-07-10 23:55:57'),(27,'sddssssds','uploads/avatar_6a54a2cfb22817.26341052.jpg',4,'Obas😋😊😊😊😊','Valeu,. muito obrigado pelo feedback😀😀','2026-07-13 08:33:19'),(28,'Marcos','uploads/avatar_6a55217c2702a7.04438593.jpg',1,'Péssimo, bem podre..., Tche, isso é que??','Valeu,. muito obrigado pelo feedback😀😀','2026-07-13 17:33:48'),(29,'Jambito','uploads/avatar_6a55dfc98f6b09.08731258.jpg',1,'Nãom Gostei','Sinto Muito mano','2026-07-14 07:05:45'),(30,'Mateus','uploads/avatar_6a55e691f23e02.28867221.jpg',5,'Muito bom, gostei de ver... parabéns pela iniciativa...','Sinto Muito mano','2026-07-14 07:34:41'),(31,'sddssssds','uploads/avatar_6a57dcee0c5fb7.96435761.jpg',5,'fdhdhdhdhdhdhdhdhdhdhdhdhdhdhdh','Valeu,. muito obrigado pelo feedback😀😀','2026-07-15 19:18:06'),(32,'sddssssds','uploads/avatar_6a59eac62acab4.56834593.jpg',5,'Gostei','Wauuuu','2026-07-17 08:41:42'),(33,'Tomas Silvino Nduva','uploads/avatar_6a85a7e6cde034.54573810.webp',3,'FFFFFFFFFFFFFFFG','GHGFGGHGHFHHGHG','2026-08-19 12:56:06'),(34,'Jpovem','uploads/avatar_6a8a35af6b6fa8.95240355.png',3,'Ya yesu','~zjhhsdfffff','2026-08-22 23:50:07'),(35,'Tomás','uploads/avatar_6a996e984db847.83666322.jpg',4,'Está bom, gostei de ver😍😍',NULL,'2026-09-03 12:56:56');
/*!40000 ALTER TABLE `depoimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `despesas_fluxo`
--

LOCK TABLES `despesas_fluxo` WRITE;
/*!40000 ALTER TABLE `despesas_fluxo` DISABLE KEYS */;
INSERT INTO `despesas_fluxo` VALUES (1,'Compra de Geles e Pomadas','Despesa',15000.00,'2026-06-24','2026-06-25 00:33:31'),(2,'Pagamento de Energia da Shop','Despesa',8500.00,'2026-06-25','2026-06-25 00:33:31'),(3,'Venda de Produtos de Barba','Entrada',12500.00,'2026-06-25','2026-06-25 00:33:31');
/*!40000 ALTER TABLE `despesas_fluxo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `encomendas_marketplace`
--

LOCK TABLES `encomendas_marketplace` WRITE;
/*!40000 ALTER TABLE `encomendas_marketplace` DISABLE KEYS */;
INSERT INTO `encomendas_marketplace` VALUES (1,232,'Cosmético Ativo / Tratamento',1,4000.00,1500.00,400.00,3600.00,5500.00,'AppyPay_Express','Período: Horario_Comercial | Notas: Kapango','Aguardando Confirmacao Push','2026-07-18 14:17:10'),(2,232,'Cosmético Ativo / Tratamento',1,4000.00,1500.00,400.00,3600.00,5500.00,'AppyPay_Express','Período: Horario_Comercial | Notas: ghghghghghghghghghghf','Aguardando Confirmacao Push','2026-07-18 14:18:05'),(3,232,'Cosmético Ativo / Tratamento',1,4000.00,1500.00,400.00,3600.00,5500.00,'AppyPay_Express','Período: Horario_Comercial | Notas: HGGGGF','Confirmado','2026-07-18 14:27:19');
/*!40000 ALTER TABLE `encomendas_marketplace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `estoque_produto_parceiros`
--

LOCK TABLES `estoque_produto_parceiros` WRITE;
/*!40000 ALTER TABLE `estoque_produto_parceiros` DISABLE KEYS */;
/*!40000 ALTER TABLE `estoque_produto_parceiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `faturamento_parceiros`
--

LOCK TABLES `faturamento_parceiros` WRITE;
/*!40000 ALTER TABLE `faturamento_parceiros` DISABLE KEYS */;
INSERT INTO `faturamento_parceiros` VALUES (1,238,8,15000.00,1500.00,13500.00,'Liquido_Transferido_Ao_Parceiro','2026-08-25 18:48:45'),(2,245,15,15000.00,1500.00,13500.00,'Aguardando_Liberacao_SaaS','2026-08-25 22:54:10'),(3,237,7,15000.00,1500.00,13500.00,'Aguardando_Liberacao_SaaS','2026-08-25 22:54:26');
/*!40000 ALTER TABLE `faturamento_parceiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `franquias_saas`
--

LOCK TABLES `franquias_saas` WRITE;
/*!40000 ALTER TABLE `franquias_saas` DISABLE KEYS */;
/*!40000 ALTER TABLE `franquias_saas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'Mestre Handanga','Disponível','Barbeiro',1,'func_1_1788894326.jpg'),(2,'Mestre Albino','Folga','Esteticista / Barbeiro / Manicure',1,NULL),(3,'Mestre Dalton','Atendimento','Manicure',1,NULL),(4,'Mestre Fernandinho','Ausente','Manucuri esteticísta',1,NULL),(5,'Mestre Aurélio','Disponível','Cabelereiro',1,'func_5_1788894355.jpg'),(6,'Mestre Raimundo','Disponível','Pedicure',1,NULL),(7,'Mestre Angelino','Atendimento','Cabelereiro',1,'func_7_1788894239.jpg'),(8,'Prof. Tuxa','Ausente','Cabelereira',1,NULL),(9,'Prof. Edna','Disponível','Cabelereira',1,NULL),(10,'Prof. Belma','Disponível','Cabelereira',1,NULL),(11,'Mestre Zidane','Ausente','Manicuri/Pedicuri',1,NULL),(12,'Prof. Magui','Atendimento','Esteticista',1,NULL),(29,'Jorge Calebe Gomesjhhhhhhhhhhhhhhh','Ausente',NULL,1,NULL),(30,'Mestre Alex','Ausente',NULL,1,NULL),(31,'Joana Lina','Atendimento',NULL,1,NULL),(32,'DADA','Atendimento',NULL,1,'func_32_1787182760.jpg');
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `funcionarios_dados_pessoais`
--

LOCK TABLES `funcionarios_dados_pessoais` WRITE;
/*!40000 ALTER TABLE `funcionarios_dados_pessoais` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionarios_dados_pessoais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `historico_vendas`
--

LOCK TABLES `historico_vendas` WRITE;
/*!40000 ALTER TABLE `historico_vendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `historico_vendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lojas`
--

LOCK TABLES `lojas` WRITE;
/*!40000 ALTER TABLE `lojas` DISABLE KEYS */;
INSERT INTO `lojas` VALUES (237,'AUR-5205','123456','Barbearia Branca','aureliosacalumbo42@gmail.com','915658574','Bairro Talatona (Luanda)','BarbeariaBranca','67d3fb556c8bfb41c8921fe01e002d87','Confirmado',1,'{\"quantidade_cadeiras\":3,\"sistema_agendamento\":\"Ativo\",\"gateway_pagamento\":\"MCX_Express\",\"categorias_marcadas\":[\"Cortes\",\"Estética\",\"Química\"],\"preco_taxa_acordada\":0.00}','2026-07-18','AO06.0000.0000.0000.0000.0'),(238,'123456','12345','Mamadu','mamadu@gmail.com','915658574','Zona Comercial (Benguela)','Mamadu','e10adc3949ba59abbe56e057f20f883e','Confirmado',1,'{\"escala_catalogo\":\"pequeno\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-07-18 23:13:21\"}','2026-07-18','AO06.0000.0000.0000.0000.0'),(239,'AUR-1876','123456','mamad2u@gmail.com','aureliosacalumboZ42@gmail.com','915658574','Benfica (Lubango, Namibe)','Mamad2ugmailcom','e10adc3949ba59abbe56e057f20f883e','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"premium_gold\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-07-19 11:41:30\"}','2026-07-19','AO06.0000.0000.0000.0000.0'),(240,'AUR-1762','123456','Loengo','loengo@gmail.com','925347375','Bairro de São Luís (Huambo)','Loengo','e10adc3949ba59abbe56e057f20f883e','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#ec05f0\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-07-20 14:14:07\"}','2026-07-20','AO06.0000.0000.0000.0000.0'),(241,'AUR-2185','123456','Angelino Comercial','Vendas@angelino.com','925347370','Kapango (Huambo, Huambo)','AngelinoComercial','c33367701511b4f6020ec61ded352059','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"clean_light\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#e70808\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-07-22 00:51:47\"}','2026-07-22','AO06.0000.0000.0000.0000.0'),(242,'AUR-4638','123456','Gráfica Soma','pauloangelinozeferinoruben@gmail.com','945852233','São Luis (Sede, Huambo)','GrficaSoma','a1be38a4ff266dfe19f4c9c6a2911d9a','Confirmado',1,'{\"escala_catalogo\":\"pequeno\",\"controlo_stock\":\"sob_encomenda\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#a1e708\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-08-19 13:12:11\"}','2026-08-19','AO06.0000.0000.0000.0000.0'),(243,'AUR-6637','123456','Loja Azul','azul@gmail.com','935627480','Rua das Madeiras (Lunda, Lunda Norte)','LojaAzul','150920ccedc34d24031cdd3711e43310','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-08-25 13:20:51\"}','2026-08-25','AO06.0000.0000.0000.0000.0'),(244,'AUR-9648','321123','ffffffffff','onjiva@gmail.com','925347350','Beco 9 (Onjiva, Cunene)','Ffffffffff','','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-08-25 13:35:23\"}','2026-08-25',''),(245,'AUR-8269','112233','Loja Marcante','lunde@gmail.com','925347300','Rua B (Lunde, Bengo)','LojaMarcante','','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-08-25 18:08:02\"}','2026-08-25','AO06 0040000023895432'),(246,'AUR-9717','111111','Loja Bate Bue','batte013@gmail.com','930258748','Luena (Luena, Moxico)','LojaBateBue','','Confirmado',1,'{\"escala_catalogo\":\"medio\",\"controlo_stock\":\"estrito\",\"calculo_frete\":\"a_cobrar_distancia\",\"metodos_entrega\":[\"Levantamento Local\",\"Estafeta Rapido\",\"Frete Interprovincial\"],\"pagamentos_loja\":[\"AppyPay_Express\",\"Unitel_Money\"],\"design_layout\":\"moderno_dark\",\"cor_primaria\":\"#1e3a8a\",\"cor_destaque\":\"#eab308\",\"modulo_produtos\":\"Sim\",\"comissao_retida\":10,\"data_criacao\":\"2026-08-25 18:25:50\"}','2026-08-25','AO06 004300003388772');
/*!40000 ALTER TABLE `lojas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `metodos_pagamento`
--

LOCK TABLES `metodos_pagamento` WRITE;
/*!40000 ALTER TABLE `metodos_pagamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `metodos_pagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
INSERT INTO `pagamentos` VALUES (1,240,'loja','Jaime','920000000','Venda Online (Loengo)','Venda Online (Loengo)','2026-07-20',NULL,'23:30:28','Unhas (MCX Express)',103000.00,'Confirmado','Concluido','920000000',0.00,92700.00,'2026-07-20 22:30:28',0,'PWA'),(2,240,'loja','Cliente Visitante','920000000','Venda Online (Loengo)','Venda Online (Loengo)','2026-07-20',NULL,'23:36:34','Unhas (MCX Express)',103000.00,'Confirmado','Concluido','920000000',0.00,92700.00,'2026-07-20 22:36:34',0,'PWA'),(3,240,'loja','Cliente Visitante','925478596','Venda Online (Loengo)','Venda Online (Loengo)','2026-07-20',NULL,'23:38:26','Unhas (MCX Express)',103000.00,'Confirmado','Pendente',NULL,0.00,92700.00,'2026-07-20 22:38:26',0,'PWA'),(4,240,'loja','Cliente Visitante','925857485','Venda Online (Loengo)','Venda Online (Loengo)','2026-07-20',NULL,'23:39:52','Unhas (MCX Express)',103000.00,'Confirmado','Pendente',NULL,0.00,92700.00,'2026-07-20 22:39:52',0,'PWA'),(5,238,'loja','Kaka','920000000','Venda Online (Mamadu)','Venda Online (Mamadu)','2026-07-20',NULL,'23:42:29','Forno (MCX Express)',4444.00,'Confirmado','Concluido','920000000',0.00,3999.60,'2026-07-20 22:42:29',0,'PWA'),(6,237,'loja','jj','925478596','Venda Online (Barbearia Branca)','Venda Online (Barbearia Branca)','2026-07-20',NULL,'23:46:57','unhas (MCX Express)',250.00,'Confirmado','Concluido','925478596',0.00,225.00,'2026-07-20 22:46:57',0,'PWA'),(7,0,'barbearia','Sacalumbo','900000000','Aurélio','Aurélio','2026-07-21','00:00:00','03:11:00','Maquilhagem Noiva',40000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-20 23:06:28',0,'PWA'),(8,0,'barbearia','Romeu','900000000','Raimundo','Raimundo','2026-07-21','00:00:00','04:12:00','Maquilhagem Social',15000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-20 23:07:47',0,'PWA'),(9,237,'barbearia','Aurelio','925478596','Balcão Técnico','Balcão Técnico','2026-07-21','00:00:00','00:29:04','Corte de Adultos (Unitel Money)',3000.00,'Confirmado','Pendente',NULL,300.00,2700.00,'2026-07-20 23:29:04',0,'PWA'),(10,0,'barbearia','Aurelio','900000000','Angelino','Angelino','2026-07-25','00:00:00','00:33:00','Maquilhagem Noiva',40000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-20 23:29:53',0,'PWA'),(11,237,'barbearia','Aurelio','920000000','Balcão Técnico','Balcão Técnico','2026-07-21','00:00:00','00:30:59','Corte de Adultos (MCX Express)',3000.00,'Confirmado','Pendente',NULL,300.00,2700.00,'2026-07-20 23:30:59',0,'PWA'),(12,240,'barbearia','Aurelio','925478596','Balcão','Balcão','2026-07-21',NULL,'00:37:20','Maquilhagem Noiva (Carteira Digital Aurelius)',40000.00,'Confirmado','Pendente',NULL,4000.00,36000.00,'2026-07-20 23:37:20',0,'PWA'),(13,0,'barbearia','Aurélio','925347372','Edna','Edna','2026-07-21','00:00:00','00:41:00','Design e Corte de Barba (MCX Express)',1500.00,'Confirmado','Pendente',NULL,0.00,1350.00,'2026-07-20 23:38:10',0,'PWA'),(14,240,'barbearia','Aurélio','925478594','Balcão','Balcão','2026-07-21',NULL,'00:39:19','Maquilhagem Noiva (Unitel Money)',40000.00,'Confirmado','Pendente',NULL,4000.00,36000.00,'2026-07-20 23:39:19',0,'PWA'),(15,240,'barbearia','Aurelio','925478596','Balcão','Balcão','2026-07-21',NULL,'00:49:04','Maquilhagem Noiva (Unitel Money)',40000.00,'Confirmado','Pendente',NULL,4000.00,36000.00,'2026-07-20 23:49:04',0,'PWA'),(16,237,'barbearia','Marod','925347372','Balcão','Balcão','2026-07-21',NULL,'00:55:11','Corte de Adultos (SALDO_INTERNO)',0.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-07-20 23:55:11',0,'PWA'),(17,0,'barbearia','Sacalumbo','900000000','Aurélio','Aurélio','2026-07-11','00:00:00','04:04:00','Corte de Crianças',800.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-21 00:01:45',0,'PWA'),(18,237,'barbearia','Sacalumbo','920000000','Balcão','Balcão','2026-07-21',NULL,'01:02:53','Corte de Adultos (SALDO_INTERNO)',0.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-07-21 00:02:53',0,'PWA'),(19,0,'barbearia','Pedro','920000000','Aurélio','Aurélio','2026-07-21','00:00:00','07:19:00','Queratina / Selagem (Unitel Money)',9000.00,'Confirmado','Pendente',NULL,0.00,8100.00,'2026-07-21 00:13:37',0,'PWA'),(20,237,'loja','Aurélio','925347372','Venda Online (Barbearia Branca)','Venda Online (Barbearia Branca)','2026-07-21',NULL,'09:43:50','unhas (MCX Express)',250.00,'Confirmado','Pendente',NULL,0.00,225.00,'2026-07-21 08:43:50',0,'PWA'),(21,0,'barbearia','Gomes','925478596','Dalton','Dalton','2026-07-21','00:00:00','12:09:00','Manutenção de Unhas (Unitel Money)',1000.00,'Confirmado','Pendente',NULL,0.00,900.00,'2026-07-21 09:09:34',0,'PWA'),(22,239,'loja','Cliente Visitante','925478596','Venda Online (mamad2u@gmail.com)','Venda Online (mamad2u@gmail.com)','2026-07-21',NULL,'10:11:53','Bolinhos (MCX Express)',5555.00,'Confirmado','Pendente',NULL,0.00,4999.50,'2026-07-21 09:11:53',0,'PWA'),(23,0,'barbearia','Gomes','920000000','Handanga','Handanga','2026-07-23','00:00:00','10:20:00','Hidratação Profunda (MCX Express)',5500.00,'Confirmado','Pendente',NULL,0.00,4950.00,'2026-07-21 09:16:49',0,'PWA'),(24,0,'barbearia','Gomes','925347372','Fernandinho','Fernandinho','2026-07-25','00:00:00','15:18:00','Aplicação de Henna (Unitel Money)',3600.00,'Confirmado','Pendente',NULL,900.00,3240.00,'2026-07-21 09:18:22',0,'PWA'),(25,0,'barbearia','Gomes','925347372','Tuxa','Tuxa','2026-07-23','00:00:00','14:25:00','Maquilhagem Noiva (MCX Express)',32000.00,'Confirmado','Pendente',NULL,8000.00,28800.00,'2026-07-21 09:20:22',0,'PWA'),(26,0,'barbearia','Gomes','925347372','Edna','Edna','2026-07-30','00:00:00','16:25:00','Maquilhagem Social (Unitel Money)',12000.00,'Confirmado','Pendente',NULL,3000.00,10800.00,'2026-07-21 09:21:43',0,'PWA'),(27,0,'barbearia','Gomes','925347372','Angelino','Angelino','2026-07-30','00:00:00','10:28:00','Hidratação Profunda (MCX Express)',4400.00,'Confirmado','Pendente',NULL,1100.00,3960.00,'2026-07-21 09:22:59',0,'PWA'),(28,0,'barbearia','Gomes','925347372','Dalton','Dalton','2026-07-21','00:00:00','10:28:00','Maquilhagem Noiva (Unitel Money)',32000.00,'Confirmado','Pendente',NULL,8000.00,28800.00,'2026-07-21 09:24:05',0,'PWA'),(29,0,'barbearia','Soma','925478596','Aurélio','Aurélio','2026-07-23','00:00:00','14:24:00','Maquilhagem Noiva (MCX Express)',40000.00,'Confirmado','Pendente',NULL,0.00,36000.00,'2026-07-21 09:25:03',0,'PWA'),(30,0,'barbearia','Soma','925478596','Aurélio','Aurélio','2026-07-24','00:00:00','15:25:00','Maquilhagem Social (Unitel Money)',15000.00,'Confirmado','Pendente',NULL,0.00,13500.00,'2026-07-21 09:25:50',0,'PWA'),(31,0,'barbearia','Sachitue','900000000','Fernandinho','Fernandinho','2026-07-22','00:00:00','05:45:00','Corte Careca',500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-22 00:41:33',0,'PWA'),(32,0,'barbearia','Sónia','900000000','Handanga','Handanga','2026-07-24','00:00:00','10:00:00','Aplicação de Henna',4500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-07-24 17:18:27',0,'PWA'),(33,238,'loja','Pepe','949062514','Venda Online (Mamadu)','Venda Online (Mamadu)','2026-08-10',NULL,'03:49:24','Postço (MCX Express)',3500.00,'Confirmado','Pendente',NULL,0.00,3150.00,'2026-08-10 02:49:24',0,'PWA'),(34,0,'barbearia','Mateus','920202020','5','5','2026-08-14','00:00:00','10:00:00','Tintura Geral (MCX Express)',4000.00,'Confirmado','Pendente',NULL,1000.00,3600.00,'2026-08-14 13:22:39',0,'PWA'),(35,0,'barbearia','Marcos','900000000','31','31','2026-08-15','00:00:00','10:00:00','Corte de Adultos',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-15 21:27:23',0,'PWA'),(36,20,'loja','Cliente Visitante','925347372','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'22:46:41','Bolinhos [BUSCAR]',52532.80,'Confirmado','',NULL,13133.20,47279.52,'2026-08-15 21:46:41',0,'PWA'),(37,20,'loja','Cliente Visitante','925698574','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'22:48:59','Bolinhos [BUSCAR]',52532.80,'Confirmado','',NULL,13133.20,47279.52,'2026-08-15 21:48:59',0,'PWA'),(38,20,'loja','Cliente Visitante','925698574','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'22:48:59','Bolinhos [BUSCAR]',52532.80,'Confirmado','',NULL,13133.20,47279.52,'2026-08-15 21:48:59',0,'PWA'),(39,20,'loja','Cliente Visitante','942565241','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'22:58:10','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 21:58:10',0,'PWA'),(40,20,'loja','Cliente Visitante','942565241','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'22:58:10','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 21:58:10',0,'PWA'),(41,20,'loja','Cliente Visitante','925857415','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:00:11','Bolinhos [BUSCAR]',52532.80,'Confirmado','',NULL,13133.20,47279.52,'2026-08-15 22:00:11',0,'PWA'),(42,20,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:12:26','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 22:12:26',0,'PWA'),(43,20,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:12:37','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 22:12:37',0,'PWA'),(44,20,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:12:43','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 22:12:43',0,'PWA'),(45,20,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:12:51','Bolinhos [BUSCAR]',65666.00,'Confirmado','',NULL,0.00,59099.40,'2026-08-15 22:12:51',0,'PWA'),(46,20,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:13:02','Bolinhos [BUSCAR]',0.00,'Confirmado','',NULL,0.00,0.00,'2026-08-15 22:13:02',0,'PWA'),(47,237,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:13:41','Pipoca [BUSCAR]',200.00,'Confirmado','',NULL,0.00,180.00,'2026-08-15 22:13:41',0,'PWA'),(48,20,'loja','Jonas','925654152','Adiantado PARCIAL','Adiantado PARCIAL','2026-08-15',NULL,'23:17:30','Bolinhos [LEVAR]',1500.00,'Confirmado','',NULL,0.00,1350.00,'2026-08-15 22:17:30',0,'PWA'),(49,20,'loja','Jonas','925347372','Adiantado PARCIAL','Adiantado PARCIAL','2026-08-15',NULL,'23:18:21','Bolinhos [LEVAR]',1500.00,'Confirmado','',NULL,0.00,1350.00,'2026-08-15 22:18:21',0,'PWA'),(50,239,'loja','Cliente Visitante','aurelio123@gmail.com','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:18:55','Bolinhos [BUSCAR]',5555.00,'Confirmado','',NULL,0.00,4999.50,'2026-08-15 22:18:55',0,'PWA'),(51,238,'loja','Cliente Visitante','925347372','Pago TOTAL','Pago TOTAL','2026-08-15',NULL,'23:29:15','Postço [LEVAR]',1900.00,'Confirmado','',NULL,100.00,1710.00,'2026-08-15 22:29:15',0,'PWA'),(52,238,'loja','Cliente Visitante','aurelio123@gmail.com','Adiantado PARCIAL','Adiantado PARCIAL','2026-08-16',NULL,'00:51:14','Postço [LEVAR]',11000.00,'Confirmado','',NULL,0.00,9900.00,'2026-08-15 23:51:14',0,'PWA'),(53,0,'barbearia','Mário','900000000','30','30','2026-08-16','00:00:00','04:28:00','Queratina / Selagem',9000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-16 01:29:27',0,'PWA'),(54,0,'barbearia','Luzia','900000000','2','2','2026-08-20','00:00:00','05:29:00','Aplicação Gel / Acrigel',3500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-16 01:30:30',0,'PWA'),(55,0,'barbearia','João','900000000','2','2','2026-08-19','00:00:00','04:42:00','Corte de Adultos',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-16 01:43:06',0,'PWA'),(56,242,'barbearia','fddd',NULL,'','Albino','2026-08-18',NULL,'04:17:00','Luzes Platinadas',7000.00,'Confirmado','Concluido',NULL,0.00,0.00,'2026-08-18 03:13:29',0,'Físico'),(57,242,'barbearia','fddd',NULL,'','Albino','2026-08-18',NULL,'04:17:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:13:36',0,'PWA'),(58,242,'barbearia','fdddfffff',NULL,'','Albino','2026-08-18',NULL,'04:17:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:13:41',0,'PWA'),(59,242,'barbearia','fdddfffff',NULL,'','Albino','2026-08-18',NULL,'04:17:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:13:51',0,'PWA'),(60,240,'barbearia','ssssssssss',NULL,'','Handanga','2026-08-18',NULL,'05:09:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:17:10',0,'PWA'),(61,240,'barbearia','Marta Gomes',NULL,'','Albino','2026-08-18',NULL,'06:20:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:20:32',0,'PWA'),(62,240,'barbearia','Marta Gomes',NULL,'','Albino','2026-08-18',NULL,'06:20:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:20:37',0,'PWA'),(63,240,'barbearia','ssss',NULL,'','Handanga','2026-08-18',NULL,'04:29:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:24:15',0,'PWA'),(64,240,'barbearia','frfr',NULL,'','Handanga','2026-08-18',NULL,'09:27:00','Coloração Total',4500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:27:16',0,'PWA'),(65,240,'barbearia','sssssssss',NULL,'','Albino','2026-08-18',NULL,'08:32:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:32:40',0,'PWA'),(66,240,'barbearia','cccccccccc',NULL,'','Handanga','2026-08-18',NULL,'08:34:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:34:42',0,'PWA'),(67,240,'barbearia','dsssssss',NULL,'','Albino','2026-08-18',NULL,'04:39:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:35:19',0,'PWA'),(68,240,'barbearia','fdddddd',NULL,'','Handanga','2026-08-18',NULL,'09:35:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:35:40',0,'PWA'),(69,240,'barbearia','sddddddddd',NULL,'','Handanga','2026-08-18',NULL,'08:39:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:39:42',0,'PWA'),(70,240,'barbearia','er',NULL,'','Albino','2026-08-18',NULL,'09:40:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:40:49',0,'PWA'),(71,240,'barbearia','fffffffffff',NULL,'','Albino','2026-08-18',NULL,'08:41:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:41:29',0,'PWA'),(72,240,'barbearia','gfffffff',NULL,'','Albino','2026-08-18',NULL,'04:41:00','Nutrição de Óleos',3500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:41:48',0,'PWA'),(73,240,'barbearia','fdddddddd',NULL,'','Handanga','2026-08-18',NULL,'08:42:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 03:42:45',0,'PWA'),(74,240,'barbearia','fdddddddd',NULL,'','Handanga','2026-08-18',NULL,'08:42:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:24:59',0,'PWA'),(75,240,'barbearia','ghfffff',NULL,'','Handanga','2026-08-18',NULL,'18:30:00','Nutrição de Óleos',3500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:30:16',0,'PWA'),(76,240,'barbearia','Marta',NULL,'','Handanga','2026-08-18',NULL,'17:32:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:33:01',0,'PWA'),(77,240,'barbearia','jaime',NULL,'','Albino','2026-08-18',NULL,'19:36:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:36:20',0,'PWA'),(78,240,'barbearia','gffffffffff',NULL,'','Handanga','2026-08-18',NULL,'19:36:00','Reconstrução Queratina',5000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:37:00',0,'PWA'),(79,240,'barbearia','Vola',NULL,'','Handanga','2026-08-18',NULL,'19:38:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:38:06',0,'PWA'),(80,240,'barbearia','fggg',NULL,'','Handanga','2026-08-18',NULL,'15:44:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:39:39',0,'PWA'),(81,242,'barbearia','ssssssssssss',NULL,'','Handanga','2026-08-18',NULL,'21:54:00','Luzes Platinadas',7000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 14:54:24',0,'PWA'),(82,242,'barbearia','Marco Antonia',NULL,'','Albino','2026-08-18',NULL,'20:01:00','Francês Adulto',2000.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 15:01:05',0,'PWA'),(84,242,'barbearia','sdfdfdfdfdfdfdfdf',NULL,'','Albino','2026-08-18',NULL,'22:27:00','Mechas Californianas',6500.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-18 15:27:34',0,'PWA'),(85,0,'barbearia','DDDDDDDDDDDFG','900000000','30','30','2026-08-19','00:00:00','15:30:00','Corte Francês Cheio',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-19 12:27:29',0,'PWA'),(86,0,'barbearia','DADA','924232123','31','31','2026-08-19','00:00:00','13:31:00','Maquilhagem Social (MCX Express)',15000.00,'Confirmado','Pendente',NULL,0.00,13500.00,'2026-08-19 12:31:42',0,'PWA'),(87,0,'barbearia','ZAZA','900000000','31','31','2026-08-19','00:00:00','14:34:00','Corte Francês Cheio',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-19 12:35:50',0,'PWA'),(88,0,'barbearia','Maluma','900000000','7','7','2026-08-20','00:00:00','00:40:00','Corte Careca',500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-19 23:41:45',0,'PWA'),(89,0,'barbearia','Mantonas','900000000','32','32','2026-08-21','00:00:00','10:00:00','Corte Careca',500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:00:36',0,'PWA'),(90,0,'barbearia','Job','900000000','5','5','2026-08-20','00:00:00','10:00:00','Design e Corte de Barba',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:12:10',0,'PWA'),(91,0,'barbearia','Maneca','900000000','5','5','2026-08-21','00:00:00','08:00:00','Mechas / Luzes',8000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:22:46',0,'PWA'),(92,0,'barbearia','Mateus','900000000','4','4','2026-08-21','00:00:00','10:20:00','Design e Corte de Barba',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:31:33',0,'PWA'),(93,0,'barbearia','gggggg','900000000','29','29','2026-08-20','00:00:00','16:01:00','Outros Estilos de Corte',3000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:35:37',0,'PWA'),(94,0,'barbearia','ddddddd','900000000','31','31','2026-08-20','00:00:00','11:50:00','Corte Francês Cheio',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:50:31',0,'PWA'),(95,0,'barbearia','tttttttt','900000000','30','30','2026-08-20','00:00:00','01:56:00','Corte de Adultos',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 00:57:15',0,'PWA'),(96,0,'barbearia','uuuuuuu','900000000','6','6','2026-08-20','00:00:00','16:00:00','Aplicação Gel / Acrigel',3500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 01:38:32',0,'PWA'),(97,0,'barbearia','rrrrrrr','900000000','30','30','2026-08-20','00:00:00','03:00:00','Corte Francês Vazio',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:00:26',0,'PWA'),(98,0,'barbearia','Noma','900000000','30','30','2026-08-21','00:00:00','16:00:00','Outros Estilos de Corte',3000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:04:56',0,'PWA'),(99,0,'barbearia','eeeeeeee','900000000','2','2','2026-08-20','00:00:00','03:10:00','Tintura Geral',5000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:10:55',0,'PWA'),(100,0,'barbearia','zzzzzzz','900000000','29','29','2026-08-20','00:00:00','03:13:00','Corte de Adultos',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:13:38',0,'PWA'),(101,0,'barbearia','Martinho','900000000','1','1','2026-08-20','00:00:00','03:15:00','Maquilhagem Social',15000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:16:11',0,'PWA'),(102,0,'barbearia','ppppppp','900000000','32','32','2026-08-20','00:00:00','10:00:00','Aplicação de Henna',4500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:22:11',0,'PWA'),(103,0,'barbearia','Bine','900000000','31','31','2026-08-20','00:00:00','03:28:00','Pedicure Simples',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:28:43',0,'PWA'),(104,0,'barbearia','fdddd','900000000','32','32','2026-08-20','00:00:00','03:28:00','Tintura Geral',5000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-20 02:29:08',0,'PWA'),(105,242,'loja','Mariano','925347372','Adiantado PARCIAL','Adiantado PARCIAL','2026-08-20',NULL,'21:53:44','Impressora HP26454 [LEVAR]',105500.00,'Confirmado','',NULL,26000.00,94950.00,'2026-08-20 20:53:44',0,'PWA'),(106,242,'loja','Mariano','925347322','Pago TOTAL','Pago TOTAL','2026-08-20',NULL,'21:55:47','Impressora HP26454 [BUSCAR]',52000.00,'Confirmado','',NULL,13000.00,46800.00,'2026-08-20 20:55:47',0,'PWA'),(107,242,'barbearia','Marcos',NULL,'','Albino','2026-08-23',NULL,'08:00:00','Corte Clássico',0.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-23 21:44:38',0,'PWA'),(108,242,'barbearia','Marcos',NULL,'','Albino','2026-08-29',NULL,'09:00:00','Corte Clássico',0.00,'Confirmado','Pendente',NULL,0.00,0.00,'2026-08-23 21:51:23',0,'PWA'),(109,245,'loja','Marcos','925347372','Adiantado PARCIAL','Adiantado PARCIAL','2026-08-25',NULL,'18:22:21','Forno Manual [LEVAR]',17500.00,'Confirmado','',NULL,4000.00,15750.00,'2026-08-25 17:22:21',0,'PWA'),(110,245,'loja','Marcos','925347371','Pago TOTAL','Pago TOTAL','2026-08-25',NULL,'18:33:34','Forno Manual [BUSCAR]',16000.00,'Confirmado','',NULL,4000.00,14400.00,'2026-08-25 17:33:34',0,'PWA'),(111,0,'barbearia','Jaime','900000000','31','31','2026-08-25','00:00:00','22:11:00','Design Simples',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-08-25 21:11:24',0,'PWA'),(112,245,'loja','Joias','925347372','Pago TOTAL','Pago TOTAL','2026-08-25',NULL,'22:53:45','Forno Manual [BUSCAR]',32000.00,'Confirmado','',NULL,8000.00,28800.00,'2026-08-25 21:53:45',0,'PWA'),(113,0,'barbearia','dddddd','900000000','4','4','2026-09-02','00:00:00','19:25:00','Corte Francês Vazio',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-02 18:27:04',0,'PWA'),(114,0,'barbearia','vbbbbbbb','900000000','3','3','2026-09-03','00:00:00','17:20:00','Tintura Geral',5000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-03 16:22:19',0,'PWA'),(115,0,'barbearia','Matias','920202020','9','9','2026-09-03','00:00:00','18:32:00','Aplicação de Henna (MCX Express)',3600.00,'Confirmado','Pendente',NULL,900.00,3240.00,'2026-09-03 17:32:32',0,'PWA'),(116,0,'barbearia','hgghf','900000000','31','31','2026-09-03','00:00:00','20:52:00','Pedicure Simples',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-03 19:53:01',0,'PWA'),(117,0,'barbearia','Lola','900000000','4','4','2026-09-04','00:00:00','13:51:00','Corte de Crianças',800.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-04 12:51:40',0,'PWA'),(118,0,'barbearia','Moma','900000000','3','3','2026-09-04','00:00:00','13:52:00','Corte Francês Vazio',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-04 12:52:55',0,'PWA'),(119,0,'barbearia','Artur','900000000','9','9','2026-09-08','00:00:00','19:00:00','Hidratação Profunda',5500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 16:43:31',0,'PWA'),(120,0,'barbearia','Arthur','900000000','6','6','2026-09-08','00:00:00','17:47:00','Corte Francês Cheio',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 16:48:21',0,'PWA'),(121,0,'barbearia','Marcos','900000000','32','32','2026-09-08','00:00:00','21:26:00','Corte de Crianças',800.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 20:26:50',0,'PWA'),(122,0,'barbearia','Jacinto','900000000','12','12','2026-09-08','00:00:00','21:47:00','Corte Francês Cheio',1500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 20:48:05',0,'PWA'),(123,0,'barbearia','Moma','900000000','9','9','2026-09-08','00:00:00','21:51:00','Maquilhagem Social',15000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 20:52:14',0,'PWA'),(124,0,'barbearia','Sónia','900000000','8','8','2026-09-08','00:00:00','22:00:00','Hidratação Profunda',7500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 21:01:28',0,'PWA'),(125,0,'barbearia','Malaquias','900000000','4','4','2026-09-08','00:00:00','22:04:00','Hidratação Profunda',8500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 21:04:55',0,'PWA'),(126,0,'barbearia','Meli','900000000','11','11','2026-09-08','00:00:00','22:36:00','Aplicação Gel / Acrigel',3500.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-08 21:36:28',0,'PWA'),(127,0,'barbearia','Bartolomeu','900000000','31','31','2026-09-10','00:00:00','19:21:00','Corte Francês Vazio',1000.00,'Pendente','Pendente',NULL,0.00,0.00,'2026-09-10 18:22:21',0,'PWA'),(128,0,'barbearia','Madalena','','32','32','2026-09-10','00:00:00','21:00:00','Corte Francês Cheio (MCX Express)',1500.00,'Confirmado','Concluido',NULL,0.00,1350.00,'2026-09-10 19:21:54',0,''),(129,0,'barbearia','Madalena','924232123','31','31','2026-09-10','00:00:00','22:00:00','Mechas / Luzes (MCX Express)',8000.00,'Confirmado','Concluido',NULL,0.00,7200.00,'2026-09-10 19:22:30',0,'PWA'),(130,0,'barbearia','Jojota','915258570','2','2','2026-09-10','00:00:00','22:00:00','Tintura Geral (Unitel Money)',5000.00,'Confirmado','Concluido',NULL,0.00,4500.00,'2026-09-10 19:27:26',0,'PWA'),(131,0,'barbearia','Jonas','925625874','10','10','2026-10-03','00:00:00','10:05:00','Corte Francês Cheio (Unitel Money)',1200.00,'Confirmado','Pendente',NULL,300.00,1080.00,'2026-09-10 21:16:57',0,'PWA'),(132,0,'barbearia','Aurélio Sacalumbo','900000000','6','6','2026-09-11','00:00:00','22:19:00','Maquilhagem Social',15000.00,'Confirmado','Concluido',NULL,0.00,0.00,'2026-09-10 21:20:46',0,'PWA'),(133,0,'barbearia','Aurélio Sacalumbo','925347370','3','3','2026-09-11','00:00:00','14:20:00','Aplicação de Henna (Unitel Money)',3600.00,'Confirmado','Pendente',NULL,900.00,3240.00,'2026-09-10 21:22:10',0,'PWA'),(134,0,'barbearia','Mykol','924202123','32','32','2026-09-10','00:00:00','22:32:00','Maquilhagem Social (MCX Express)',15000.00,'Confirmado','Concluido',NULL,0.00,13500.00,'2026-09-10 21:33:25',0,'PWA'),(135,0,'barbearia','Ngonguinho','915258574','11','11','2026-09-12','00:00:00','14:00:00','Aplicação Gel / Acrigel (Unitel Money)',3500.00,'Confirmado','Pendente',NULL,0.00,3150.00,'2026-09-10 21:44:54',0,'PWA'),(136,0,'barbearia','Jaime','924232100','9','9','2026-09-10','00:00:00','10:00:00','Aplicação de Henna (MCX Express)',4500.00,'Confirmado','Concluido',NULL,0.00,4050.00,'2026-09-10 23:01:26',0,''),(137,0,'barbearia','Tatiana','','12','12','2026-09-11','00:00:00','09:00:00','Maquilhagem Noiva (MCX Express)',40000.00,'Confirmado','Concluido',NULL,0.00,36000.00,'2026-09-10 23:03:42',0,'');
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pedidos_emprego`
--

LOCK TABLES `pedidos_emprego` WRITE;
/*!40000 ALTER TABLE `pedidos_emprego` DISABLE KEYS */;
INSERT INTO `pedidos_emprego` VALUES (1,0,'Marta','925347372',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(2,0,'Aurélio Jb','925347375',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(3,0,'Silvia','925347354',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(4,0,'Kaka','9253479698',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(5,0,'Mingo','925347374',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(6,0,'Toia','925347358',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(7,0,'Aurélio Jb','925347372',NULL,NULL,NULL,'','0000-00-00 00:00:00'),(8,0,'Jamba','925387372',NULL,NULL,NULL,'','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `pedidos_emprego` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `planos`
--

LOCK TABLES `planos` WRITE;
/*!40000 ALTER TABLE `planos` DISABLE KEYS */;
/*!40000 ALTER TABLE `planos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `produto_parceiros`
--

LOCK TABLES `produto_parceiros` WRITE;
/*!40000 ALTER TABLE `produto_parceiros` DISABLE KEYS */;
INSERT INTO `produto_parceiros` VALUES (1,1,'Empresa X',4500.00,'Tamanho X','Disponível',-12.77580000,15.73940000),(2,1,'Empresa Y',4800.00,'Tamanho X','Não Disponível',-12.76000000,15.75000000),(3,1,'Empresa Z',5000.00,'Tamanho F','Não Disponível',-12.80000000,15.72000000),(4,1,'Empresa Shoprite-Huambo',4500.00,'Tamanho X','Disponível',-12.77580000,15.73940000);
/*!40000 ALTER TABLE `produto_parceiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,232,'Mateus Limitado','EQP-2E9DB584','Aparelho / Máquina / 300ml','Dourado Imperial','2026-07-22',6,5000.00,'prod_6a5b6fd0d8c5f.jpg','2026-07-18 12:21:36'),(2,232,'Unha','COS-28C427CA','Estética de Unhas / 300ml','Rosa Estética','2026-07-19',12,8000.00,'prod_6a5b71dc591c8.jpg','2026-07-18 12:30:20'),(13,232,'Unhas Grandes','EQP-95FF6345','Aparelho / Máquina / 300ml','Transparente','2026-07-19',12,8000.00,'prod_6a5b852bde8a9.jpg','2026-07-18 13:52:43');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `produtos_cosmeticos`
--

LOCK TABLES `produtos_cosmeticos` WRITE;
/*!40000 ALTER TABLE `produtos_cosmeticos` DISABLE KEYS */;
INSERT INTO `produtos_cosmeticos` VALUES (15,20,'Cosmético Geral',0.00,0,'prod_1784223228_6a5915fc5405c.png',0,'Tam: 250ml | Cat: Geral | Cores: preto, branco, ve','Tem','Disponível','2026-08-14 14:49:53'),(18,20,'Bolinhos',65666.00,0,'prod_1784228591_6a592aef68d04.jpg',0,'Tam: 50ml | Cat: Acessorios | Cores: preto, branco','Tem','Disponível','2026-08-14 14:49:53'),(22,231,'Limpoh',5600.00,5,'prod_1784291680_6a5a2160a5c79.jpg',0,'Tam: 50ml | Cat: Oleos | Cores: preto, branco, ver','Tem','Disponível','2026-08-14 14:49:53'),(25,2,'Unhas Grandes',10000.00,6,'prod_6a5b9abade744.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(26,240,'Unhas',103000.00,54,'prod_6a5b9ae1d1e26.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(27,237,'unhas',250.00,2,'prod_6a5bf96ea5232.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(28,238,'Forno',4444.00,0,'prod_6a5e1fc3320d3.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(29,239,'Arroz',1000.00,0,'prod_6a5e203f7f5bc.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(30,238,'Funje',1500.00,0,'prod_6a5e2087c9f3a.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(31,239,'Bolinhos',5555.00,3,'prod_6a5ec2057dc9e.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(32,238,'Postço',500.00,18,'prod_6a5ec2389f5f9.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(33,241,'Carpas',2350.00,40,'prod_6a7f1d5a6dfc8.png',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(34,237,'PC a Venda sem defeitos',50000.00,5,'prod_6a7f1e7e6ac00.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(35,237,'Pipoca',200.00,999,'prod_6a7f2110ba7c0.jpg',0,'Padrão','Tem','Disponível','2026-08-14 14:49:53'),(36,242,'Impressora HP26454',65000.00,47,'prod_6a859edfc4fbc.jpg',0,'Padrão','Tem','Disponível','2026-08-19 12:17:35'),(37,245,'Forno Manual',20000.00,3,'prod_6a8dce0a59b73.jpg',0,'Padrão','Tem','Disponível','2026-08-25 17:16:58');
/*!40000 ALTER TABLE `produtos_cosmeticos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `profissionais`
--

LOCK TABLES `profissionais` WRITE;
/*!40000 ALTER TABLE `profissionais` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissionais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `saloes_parceiros`
--

LOCK TABLES `saloes_parceiros` WRITE;
/*!40000 ALTER TABLE `saloes_parceiros` DISABLE KEYS */;
/*!40000 ALTER TABLE `saloes_parceiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `saques_parceiros`
--

LOCK TABLES `saques_parceiros` WRITE;
/*!40000 ALTER TABLE `saques_parceiros` DISABLE KEYS */;
/*!40000 ALTER TABLE `saques_parceiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `servicos`
--

LOCK TABLES `servicos` WRITE;
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` VALUES (3,1,'Corte de Adultos',3000.00,NULL),(4,1,'Careca Completa',1500.00,NULL),(5,2,'Barba Simples / Alinhamento',2000.00,NULL),(7,2,'Design de Barba + Pigmentação',3500.00,NULL),(8,3,'Limpeza de Pele Profunda',6000.00,NULL),(9,3,'Máscara Negra de Carvão',2500.00,NULL),(10,3,'Design de Sobrancelhas',1500.00,NULL),(11,4,'Platinado / Nevou',8000.00,NULL),(12,4,'Luzes / Reflexos',5000.00,NULL),(13,4,'Alisamento Capilar',6000.00,NULL),(14,5,'Hidratação Profunda Ozonizada',4000.00,NULL),(15,5,'Cauterização de Fios',5500.00,NULL),(16,6,'Manicura Masculina Básica',2000.00,NULL),(17,6,'Pedicura Completa / Spa',3500.00,NULL),(18,7,'Combo: Corte + Barba Terapia',7000.00,NULL),(19,7,'Combo Imperial: Corte + Barba + Estética',11000.00,NULL),(20,8,'Corte Kids (Até 12 anos)',2000.00,NULL),(21,8,'Penteado Infantil Especial',1500.00,NULL),(22,9,'Depilação de Nariz com Cera',1000.00,NULL),(23,9,'Depilação de Ouvidos',1000.00,NULL),(24,10,'Pacote VIP Dia do Noivo',35000.00,NULL),(25,10,'Atendimento Exclusivo Domicílio',15000.00,NULL),(26,11,'Tratamento de Unha Encravada',5000.00,NULL),(27,11,'Remoção de Calosidades',4000.00,NULL),(700,8,'',0.00,NULL),(701,8,'Corte de Teste',2000.00,NULL),(703,8,'Corte de Teste',2000.00,NULL);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `subcategorias`
--

LOCK TABLES `subcategorias` WRITE;
/*!40000 ALTER TABLE `subcategorias` DISABLE KEYS */;
INSERT INTO `subcategorias` VALUES (1,1,'Cortes Tradicionais & Modernos'),(2,2,'Terapias & Alinhamentos'),(3,3,'Estética & Máscaras'),(4,4,'Colorimetria & Descoloração'),(5,5,'Cronograma Capilar'),(6,6,'Cuidados de Unhas'),(7,7,'Pacotes de Desconto'),(8,8,'Cortes Infantis'),(9,9,'Depilação Facial Masculina'),(10,10,'Serviços de Luxo e Noivos'),(11,11,'Tratamentos de Podologia');
/*!40000 ALTER TABLE `subcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tenant_notificacoes_multimedia`
--

LOCK TABLES `tenant_notificacoes_multimedia` WRITE;
/*!40000 ALTER TABLE `tenant_notificacoes_multimedia` DISABLE KEYS */;
INSERT INTO `tenant_notificacoes_multimedia` VALUES (1,16,'Bem-vindo ao Ecossistema Aurélius','Assista ao vídeo técnico de treinamento para configurar o seu caixa.','video','video_boas_vindas.mp4','2026-07-18 21:01:17');
/*!40000 ALTER TABLE `tenant_notificacoes_multimedia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `triagem_pedidos`
--

LOCK TABLES `triagem_pedidos` WRITE;
/*!40000 ALTER TABLE `triagem_pedidos` DISABLE KEYS */;
INSERT INTO `triagem_pedidos` VALUES (4,'Pendente Triagem','Balcao',0,243,NULL,'António Loengo','2026-08-25','Loja Azul','Rua das Madeiras, Lunda Norte','925347372','Candidatura direcionada para o departamento mercantil.'),(5,'Pendente Triagem','Balcao',0,244,NULL,'Carlos Manuel','2026-08-25','ffffffffff','Beco 9, Onjiva','931224455','Pedido de triagem de portefólio para integração logística.'),(6,'Pendente Triagem','Balcao',0,246,NULL,'António Loengo','2026-08-25','Loja Bate Bue','Luena, Moxico','930258748','Inscrição de triagem gerada automaticamente pelo sistema SaaS no ato de abertura da distribuidora mercantil.'),(7,'Aprovado_Aguardando_SaaS','Balcao',0,237,NULL,'António Loengo','2026-07-18','Barbearia Branca','Bairro Talatona (Luanda)','915658574','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(8,'Finalizado_Concluido','Balcao',0,238,NULL,'António Loengo','2026-07-18','Mamadu','Zona Comercial (Benguela)','915658574','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(9,'Pendente Triagem','Balcao',0,239,NULL,'António Loengo','2026-07-19','mamad2u@gmail.com','Benfica (Lubango, Namibe)','915658574','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(10,'Pendente Triagem','Balcao',0,240,NULL,'António Loengo','2026-07-20','Loengo','Bairro de São Luís (Huambo)','925347375','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(11,'Pendente Triagem','Balcao',0,241,NULL,'António Loengo','2026-07-22','Angelino Comercial','Kapango (Huambo, Huambo)','925347370','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(12,'Pendente Triagem','Balcao',0,242,NULL,'António Loengo','2026-08-19','Gráfica Soma','São Luis (Sede, Huambo)','945852233','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(13,'Pendente Triagem','Balcao',0,243,NULL,'António Loengo','2026-08-25','Loja Azul','Rua das Madeiras (Lunda, Lunda Norte)','935627480','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(14,'Pendente Triagem','Balcao',0,244,NULL,'António Loengo','2026-08-25','ffffffffff','Beco 9 (Onjiva, Cunene)','925347350','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(15,'Aprovado_Aguardando_SaaS','Balcao',0,245,NULL,'António Loengo','2026-08-25','Loja Marcante','Rua B (Lunde, Bengo)','925347300','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.'),(16,'Pendente Triagem','Balcao',0,246,NULL,'António Loengo','2026-08-25','Loja Bate Bue','Luena (Luena, Moxico)','930258748','Sincronização automática de dados legados realizada com sucesso para este parceiro Aurélius.');
/*!40000 ALTER TABLE `triagem_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (237,'','Barbearia Branca','Aurelio','aureliosacalumbo42@gmail.com','915658574','Huambo','Todos os serviços',80000.00,'Confirmado',1,'parceiro_hospedado','BarbeariaBranca',NULL,NULL,'OIP (6).webp','67d3fb556c8bfb41c8921fe01e002d87','2026-07-19','{\"quantidade_cadeiras\":3,\"sistema_agendamento\":\"Ativo\",\"gateway_pagamento\":\"MCX_Express\",\"categorias_marcadas\":[\"Cortes\",\"Estética\",\"Química\"],\"preco_taxa_acordada\":0.00}','AO06.0040.0000.9068.8685.1014.8'),(238,NULL,' Andira Fashion','Não preenchido','society1234@gmail.com','925347372','Huíla','Geral',30000.00,'Confirmado',1,'parceiro_hospedado','BarbeariaBranca',NULL,NULL,'OIP (6).webp','e10adc3949ba59abbe56e057f20f883e','2015-07-09',NULL,'AO06.0000.0000.0000.0000.0'),(239,'123321','FemmisAngola','Marta da Conceição','femisangola124@gmail.com','925241685','Lunda sul','Geral',20000.00,'Confirmado',1,'parceiro_hospedado','BarbeariaBranca',NULL,NULL,'1777757951670.jpg','e10adc3949ba59abbe56e057f20f883e','2026-04-12',NULL,'AO06.0000.0000.0000.0000.0'),(242,NULL,'BARBEARIA SO TRANÇAS','Fernando Gomes','fernando13@gmail.com','925347378','Huíla - Lubango','Geral',10000.00,'Pendente',0,'parceiro_hospedado','BarbeariaBranca','BF_849876484HO034.jpg','BV_849876484HO034.jpg','LOGO_1786401919_428.jpg','','2026-08-10','Corte Adulto Clássico, Corte Francês Cheio, Design de Barba e Contorno','AO06.0000.0000.0000.0000.0'),(243,NULL,'LOOK NOVO','Mariano Machado','mariano@gmail.com','925347375','Namibe - Kalandula','Geral',15000.00,'Pendente',0,'parceiro_hospedado','BarbeariaBranca','BF_849876484HO034.jpg','BV_849876484HO034.jpg','1776692182096.jpg','','2026-08-10','Corte Adulto Clássico, Corte Careca Total, Corte Francês Cheio, Corte Francês Vazio, Design de Barba e Contorno','AO06.0000.0000.0000.0000.0'),(256,NULL,'Aqyuas','Fofaba','aureliojzdddb013@gmail.com','925347372','Luanda','Geral',170000.00,'Pendente',0,'parceiro_hospedado','BarbeariaBranca',NULL,NULL,'OIP (6).webp',NULL,'2026-08-20',NULL,'AO06.0000.0000.0000.0000.0'),(262,NULL,'Aurelio Sacabi','Não preenchido','sacabi@gmail.com','925347372','Kapango','Geral',40000.00,'Pendente',0,'parceiro_hospedado','BarbeariaBranca',NULL,NULL,'OIP (6).webp','$2y$10$Zcz7kNUoUPZg4hBCvYOTb.6YJjpotdpPEYtQfgcpvTSWbIbVaA/K6','2026-08-25',NULL,'AO06.0000.0000.0000.0000.0'),(263,NULL,'Mariana Cabinda','Não preenchido','mariana@gmail.com','915658574','São Luis','Geral',0.00,'Pendente',0,'cliente','BarbeariaBranca',NULL,NULL,'OIP (6).webp','e10adc3949ba59abbe56e057f20f883e','2026-09-02',NULL,'AO06.0000.0000.0000.0000.0'),(264,NULL,'Aurelio gomes','Não preenchido','aurelio14@gmail.com','915658574','São Luis','Geral',0.00,'Pendente',0,'cliente','BarbeariaBranca',NULL,NULL,'OIP (6).webp','00a1f187721c63501356bf791e69382c','2026-09-03',NULL,'AO06.0000.0000.0000.0000.0');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `vagas_trabalho`
--

LOCK TABLES `vagas_trabalho` WRITE;
/*!40000 ALTER TABLE `vagas_trabalho` DISABLE KEYS */;
INSERT INTO `vagas_trabalho` VALUES (1,20,'Barbeiro Especialista','45% Comissão','Domínio de cortes modernos e pontualidade.','2026-07-16 21:57:38',0),(5,231,'Cortar cabelo','45000','Alguém que seja pontual','2026-07-17 10:43:54',1),(8,240,'rrrrrrri','5000','AAAAAAAA','2026-08-11 00:58:23',0),(9,240,'Manicuri','20000','Não queremos Palhaços, apenas pessoas sérias','2026-08-11 00:59:13',0),(14,237,'Manicuri/Pedicuri','8000','Apenas um que tenha todos os domínios','2026-08-11 01:33:40',1),(15,240,'Manicuri','20000','Precisamos com urgencia, por favor se cadastra já','2026-08-11 01:34:23',0),(18,238,'Manicuri/Pedicuri','5000','Pessoal a vaga é limitada','2026-08-11 01:35:42',0);
/*!40000 ALTER TABLE `vagas_trabalho` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-11 13:22:59
