-- MySQL dump 10.15  Distrib 10.0.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: clibras
-- ------------------------------------------------------
-- Server version	10.0.38-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `cl_module`
--
create database clibras;

-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
-- Criando o usuário para acesso ao banco
--
CREATE USER 'clibrasbbb'@'localhost' IDENTIFIED BY 'CLibras@019';
GRANT ALL PRIVILEGES ON clibras.* TO 'clibrasbbb'@'localhost';
CREATE USER 'clibrasbbb'@'%' IDENTIFIED BY 'CLibras@019';
GRANT ALL PRIVILEGES ON clibras.* TO 'clibrasbbb'@'%';

FLUSH PRIVILEGES;

use clibras;

DROP TABLE IF EXISTS 'cl_module';
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cl_module` (
  `idModule` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Módulo',
  `code` varchar(9) NOT NULL COMMENT 'Código',
  `name` varchar(60) NOT NULL COMMENT 'Descrição do Módulo',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Modulo do sistema',
  `active` datetime DEFAULT NULL COMMENT 'Módulo ativo (data de ativação)',
  PRIMARY KEY (`idModule`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `cl_ix_module_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cl_module`
--

LOCK TABLES `cl_module` WRITE;
/*!40000 ALTER TABLE `cl_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `cl_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cl_schedule`
--

DROP TABLE IF EXISTS `cl_schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cl_schedule` (
  `idSchedule` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Agenda',
  `idUser` int(10) unsigned NOT NULL COMMENT 'ID Usuário',
  `dateEvent` date NOT NULL COMMENT 'Data do Evento',
  `Subject` varchar(200) NOT NULL COMMENT 'Assunto',
  PRIMARY KEY (`idSchedule`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `cl_schedule_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `cl_user` (`iduser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cl_schedule`
--

LOCK TABLES `cl_schedule` WRITE;
/*!40000 ALTER TABLE `cl_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `cl_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cl_user`
--

DROP TABLE IF EXISTS `cl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cl_user` (
  `iduser` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID Usuário',
  `name` varchar(60) NOT NULL COMMENT 'Nome Completo',
  `code` varchar(60) NOT NULL COMMENT 'Usuário',
  `avatar` varchar(100) DEFAULT NULL COMMENT 'Avatar - Local de Imagem do Usuário',
  `active` datetime DEFAULT NULL COMMENT 'Usuário Ativo (data de bloqueio)',
  `socialName` varchar(60) DEFAULT NULL COMMENT 'Nome Social',
  `register` varchar(60) NOT NULL COMMENT 'Código de Registro (GRR, Código do Aluno, Matrícula...)',
  `cpf` varchar(20) DEFAULT NULL COMMENT 'CPF - Chave para integração com o sistema externo',
  `email` varchar(100) NOT NULL COMMENT 'Email de Registro',
  `emailAlternative` varchar(100) DEFAULT NULL COMMENT 'Email Alternativo',
  `phone` varchar(15) DEFAULT NULL COMMENT 'Telefone de Contato',
  `updatePassword` tinyint(1) NOT NULL COMMENT 'Força a atualização da senha',
  `password` varchar(100) NOT NULL COMMENT 'Senha',
  `datePassword` datetime DEFAULT NULL COMMENT 'Data de alteração da senha',
  `dateRegister` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de Registro',
  `dateRefresh` datetime DEFAULT NULL COMMENT 'Data/Hora do último acesso ao sistema',
  `master` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuário Mestre',
  `libras` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuário Surdo',
  `braile` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuário Cego',
  `daltonico` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuário Daltônico',
  `session` varchar(60) DEFAULT NULL COMMENT 'Sessão para recuperar o usuário',
  `sessionDate` datetime DEFAULT NULL COMMENT 'Data de validade da sessão',
  `skin` varchar(60) DEFAULT NULL COMMENT 'Skin do sistema, se em branco utiliza o padrão',
  `hash` varchar(60) NOT NULL COMMENT 'Código HASH do usuário',
  `iconAnimated` tinyint(1) DEFAULT '0' COMMENT 'Exibir Ícone Animado',
  `videoAutoplay` tinyint(1) DEFAULT '1' COMMENT 'Auto - Play nos Vídeos',
  `videoMute` tinyint(1) DEFAULT '1' COMMENT 'Vídeo no Mudo',
  `notification` tinyint(1) DEFAULT '0' COMMENT 'Ativar Notificações',
  `geolocation` tinyint(1) DEFAULT '0' COMMENT 'Usar Geolocalização',
  PRIMARY KEY (`iduser`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `register` (`register`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cl_ix_user_usucde` (`code`),
  UNIQUE KEY `cl_ix_user_usurge` (`register`),
  UNIQUE KEY `cl_ix_user_usueml` (`email`),
  UNIQUE KEY `cl_ix_user_usuhsh` (`hash`),
  UNIQUE KEY `emailAlternative` (`emailAlternative`),
  UNIQUE KEY `session` (`session`),
  UNIQUE KEY `cl_ix_user_usuema` (`emailAlternative`),
  UNIQUE KEY `cl_ix_user_ususes` (`session`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cl_user`
--

LOCK TABLES `cl_user` WRITE;
/*!40000 ALTER TABLE `cl_user` DISABLE KEYS */;
INSERT INTO `cl_user` VALUES (1,'ADMINISTRADOR','ADMIN',NULL,NULL,NULL,'ADMIN',NULL,'admin@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:17',NULL,1,0,0,0,NULL,NULL,NULL,'b21e37e823768603ce200e543f608a92',0,1,1,0,0),(2,'Rodrigo Dittmar','rdittmar','img/avt/1ba13f1d8947e9490da8d9186207f183.png',NULL,NULL,'GRR20192649','02916273905','dittmar@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:18',NULL,1,0,0,0,NULL,NULL,NULL,'1ba13f1d8947e9490da8d9186207f183',0,1,1,0,0),(3,'Mauro Hiroto Suzuki','maurohs',NULL,NULL,NULL,'maurohs',NULL,'maurohs@ufpr.br ',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:18',NULL,1,0,0,0,NULL,NULL,NULL,'3ccab38b5e6f1bf00f2b4d31bfc83564',0,1,1,0,0),(4,'Alexandre Carneiro','alexandrecarneiro',NULL,NULL,NULL,'GRR20166359',NULL,'alexandrecarneiro@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:18',NULL,1,0,0,0,NULL,NULL,NULL,'c314017178e8501413801051e704a860',0,1,1,0,0),(5,'Leonardo Stefan','leo.stefan',NULL,NULL,NULL,'leo.stefan',NULL,'leo.stefan@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:18',NULL,1,0,0,0,NULL,NULL,NULL,'810c9caee18050b33d498e5af8d8a459',0,1,1,0,0),(6,'Julia Ponnick','juliaponnick','img/avt/abb08f387ad16c04f2fbd46782e18c26.jpg',NULL,NULL,'GRR20176597',NULL,'juliaponnick@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:18',NULL,1,0,0,0,NULL,NULL,NULL,'abb08f387ad16c04f2fbd46782e18c26',0,1,1,0,0),(7,'Patrick Lacerda','patricklacerda',NULL,NULL,NULL,'GRR20161708','08409268981','patricklacerda@ufpr.br',NULL,NULL,1,'43462781a76fc16b09da04c2b889ecb8',NULL,'2019-10-04 10:20:19',NULL,1,0,0,0,NULL,NULL,NULL,'8c5fc75138a572b7484381fa44787f3d',0,1,1,0,0);
/*!40000 ALTER TABLE `cl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cl_userprofile`
--

DROP TABLE IF EXISTS `cl_userprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cl_userprofile` (
  `iduserProfile` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID do Perfil',
  `name` varchar(60) NOT NULL COMMENT 'Nome do Grupo/Perfil',
  `master` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Usuário Mestre',
  PRIMARY KEY (`iduserProfile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cl_userprofile`
--

LOCK TABLES `cl_userprofile` WRITE;
/*!40000 ALTER TABLE `cl_userprofile` DISABLE KEYS */;
INSERT INTO `cl_userprofile` VALUES (1,'Master',1),(2,'Intérprete',1),(3,'Aluno',1);
/*!40000 ALTER TABLE `cl_userprofile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-25 13:16:41
