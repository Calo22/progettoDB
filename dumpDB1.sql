-- MySQL dump 10.19  Distrib 10.3.31-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: applicazione1
-- ------------------------------------------------------
-- Server version	10.3.31-MariaDB-0+deb10u1

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
-- Table structure for table `Candidato`
--

DROP TABLE IF EXISTS `Candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Candidato` (
  `Id_candidato` int(11) NOT NULL AUTO_INCREMENT,
  `Privato` int(11) NOT NULL,
  `Disponibilita_mobilita` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id_candidato`),
  UNIQUE KEY `Privato_2` (`Privato`),
  KEY `Privato` (`Privato`),
  CONSTRAINT `Candidato_ibfk_1` FOREIGN KEY (`Privato`) REFERENCES `Privato` (`Id_privato`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Candidato`
--

LOCK TABLES `Candidato` WRITE;
/*!40000 ALTER TABLE `Candidato` DISABLE KEYS */;
INSERT INTO `Candidato` VALUES (28,23,0);
/*!40000 ALTER TABLE `Candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Candidatura`
--

DROP TABLE IF EXISTS `Candidatura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Candidatura` (
  `Id_candidatura` int(11) NOT NULL AUTO_INCREMENT,
  `Posizione_aperta` int(11) NOT NULL,
  `Candidato` int(11) NOT NULL,
  `Data_ora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_candidatura`),
  KEY `Posizione_aperta` (`Posizione_aperta`),
  KEY `Candidato` (`Candidato`),
  CONSTRAINT `Candidatura_ibfk_3` FOREIGN KEY (`Posizione_aperta`) REFERENCES `Posizione_aperta` (`Id_PosizioneAperta`) ON DELETE CASCADE,
  CONSTRAINT `Candidatura_ibfk_4` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE,
  CONSTRAINT `CHK_Status` CHECK (`Status` = 'In attesa' or `Status` = 'Accettata' or `Status` = 'Rifiutata')
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Candidatura`
--

LOCK TABLES `Candidatura` WRITE;
/*!40000 ALTER TABLE `Candidatura` DISABLE KEYS */;
INSERT INTO `Candidatura` VALUES (9,9,28,'2021-09-03 11:57:14','Rifiutata'),(10,14,28,'2021-09-03 11:59:38','Accettata'),(11,13,28,'2021-09-03 11:59:13','In attesa'),(12,9,28,'2021-09-04 16:38:36','In attesa');
/*!40000 ALTER TABLE `Candidatura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cliente`
--

DROP TABLE IF EXISTS `Cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cliente` (
  `Id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `Privato` int(11) NOT NULL,
  PRIMARY KEY (`Id_cliente`),
  UNIQUE KEY `Privato_2` (`Privato`),
  KEY `Privato` (`Privato`),
  CONSTRAINT `Cliente_ibfk_1` FOREIGN KEY (`Privato`) REFERENCES `Privato` (`Id_privato`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cliente`
--

LOCK TABLES `Cliente` WRITE;
/*!40000 ALTER TABLE `Cliente` DISABLE KEYS */;
INSERT INTO `Cliente` VALUES (15,23);
/*!40000 ALTER TABLE `Cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comune`
--

DROP TABLE IF EXISTS `Comune`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comune` (
  `Id_comune` int(11) NOT NULL AUTO_INCREMENT,
  `Provincia` varchar(25) NOT NULL,
  `Citta` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_comune`),
  UNIQUE KEY `Provincia` (`Provincia`,`Citta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comune`
--

LOCK TABLES `Comune` WRITE;
/*!40000 ALTER TABLE `Comune` DISABLE KEYS */;
INSERT INTO `Comune` VALUES (3,'Bologna','Bologna'),(2,'Bologna','Imola'),(18,'Catania','Catania'),(19,'Livorno','Livorno'),(1,'Messina','Messina'),(7,'Milano','Cologno Monzese'),(4,'Milano','Milano'),(6,'Milano','Sesto San Giovanni'),(9,'Modena','Carpi'),(11,'Modena','Maranello'),(8,'Modena','Modena'),(10,'Modena','Sassuolo'),(12,'Napoli','Napoli'),(13,'Napoli','Pozzuoli'),(17,'Palermo','Palermo'),(15,'Roma','Fiumicino'),(14,'Roma','Guidonia'),(16,'Roma','Pomezia');
/*!40000 ALTER TABLE `Comune` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `Consigliato_media_vista`
--

DROP TABLE IF EXISTS `Consigliato_media_vista`;
/*!50001 DROP VIEW IF EXISTS `Consigliato_media_vista`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `Consigliato_media_vista` (
  `Servizio` tinyint NOT NULL,
  `Somma_Consigliato` tinyint NOT NULL,
  `Conteggio` tinyint NOT NULL,
  `Media_consigliato` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Contatto`
--

DROP TABLE IF EXISTS `Contatto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contatto` (
  `Id_contatto` int(11) NOT NULL AUTO_INCREMENT,
  `Utente` int(11) NOT NULL,
  `Telefono` decimal(25,0) NOT NULL,
  `eMail` varchar(60) NOT NULL,
  PRIMARY KEY (`Id_contatto`),
  KEY `Utente` (`Utente`),
  CONSTRAINT `Contatto_ibfk_1` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Id_utente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contatto`
--

LOCK TABLES `Contatto` WRITE;
/*!40000 ALTER TABLE `Contatto` DISABLE KEYS */;
INSERT INTO `Contatto` VALUES (44,49,159753456,'s1@mail.it'),(45,50,852741963,'s2@mail.it');
/*!40000 ALTER TABLE `Contatto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contratto`
--

DROP TABLE IF EXISTS `Contratto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contratto` (
  `Id_contratto` int(11) NOT NULL AUTO_INCREMENT,
  `Posizione_aperta` int(11) NOT NULL,
  `Tipo_contratto` varchar(35) NOT NULL,
  `Stipendio_mensile` smallint(6) NOT NULL,
  `Descrizione_contratto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id_contratto`),
  KEY `Posizione_aperta` (`Posizione_aperta`),
  CONSTRAINT `Contratto_ibfk_2` FOREIGN KEY (`Posizione_aperta`) REFERENCES `Posizione_aperta` (`Id_PosizioneAperta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contratto`
--

LOCK TABLES `Contratto` WRITE;
/*!40000 ALTER TABLE `Contratto` DISABLE KEYS */;
INSERT INTO `Contratto` VALUES (6,9,'Non specificato',1200,'Da discutere con il recruiter'),(10,13,'Tempo determinato',1400,'Contratto a termine, periodo 10 mesi'),(11,14,'Tempo indeterminato',1500,'');
/*!40000 ALTER TABLE `Contratto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `Disponibilita_professionista_media_vista`
--

DROP TABLE IF EXISTS `Disponibilita_professionista_media_vista`;
/*!50001 DROP VIEW IF EXISTS `Disponibilita_professionista_media_vista`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `Disponibilita_professionista_media_vista` (
  `Servizio` tinyint NOT NULL,
  `Somma_Disponibilita_pro` tinyint NOT NULL,
  `Conteggio` tinyint NOT NULL,
  `Media_Disponibilita_pro` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Esperienza`
--

DROP TABLE IF EXISTS `Esperienza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Esperienza` (
  `Id_esperienza` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione_esp` varchar(255) NOT NULL,
  `Candidato` int(11) NOT NULL,
  `Settore_esp` int(11) NOT NULL,
  `Presso` varchar(40) NOT NULL,
  `Ruolo_esp` varchar(40) NOT NULL,
  PRIMARY KEY (`Id_esperienza`),
  KEY `Candidato` (`Candidato`),
  KEY `Esperienza_ibfk_2` (`Settore_esp`),
  CONSTRAINT `Esperienza_ibfk_3` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE,
  CONSTRAINT `Esperienza_ibfk_4` FOREIGN KEY (`Settore_esp`) REFERENCES `Settore` (`Id_settore`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Esperienza`
--

LOCK TABLES `Esperienza` WRITE;
/*!40000 ALTER TABLE `Esperienza` DISABLE KEYS */;
INSERT INTO `Esperienza` VALUES (6,'Descrizione_1_ca28',28,8,'Azienda_1_c28','Ruolo_passato_1_ca28'),(7,'Descrizione_2_ca28',28,3,'Azienda_2_ca28','Ruolo_passato_2_ca28'),(8,'Descrizione_3_ca28',28,1,'Azienda_3_ca28','Ruolo_passato_3_ca28');
/*!40000 ALTER TABLE `Esperienza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `Generale_media_vista`
--

DROP TABLE IF EXISTS `Generale_media_vista`;
/*!50001 DROP VIEW IF EXISTS `Generale_media_vista`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `Generale_media_vista` (
  `Servizio` tinyint NOT NULL,
  `Somma_generale` tinyint NOT NULL,
  `Conteggio` tinyint NOT NULL,
  `Media_generale` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Offerta_lavoro`
--

DROP TABLE IF EXISTS `Offerta_lavoro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Offerta_lavoro` (
  `Id_OffertaLavoro` int(11) NOT NULL AUTO_INCREMENT,
  `Professionista` int(11) NOT NULL,
  `Candidato` int(11) NOT NULL,
  `Posizione_aperta` int(11) NOT NULL,
  `Data_ora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_OffertaLavoro`),
  KEY `Professionista` (`Professionista`),
  KEY `Candidato` (`Candidato`),
  KEY `Posizione_aperta` (`Posizione_aperta`),
  CONSTRAINT `Offerta_lavoro_ibfk_4` FOREIGN KEY (`Professionista`) REFERENCES `Professionista` (`Id_professionista`) ON DELETE CASCADE,
  CONSTRAINT `Offerta_lavoro_ibfk_5` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE,
  CONSTRAINT `Offerta_lavoro_ibfk_6` FOREIGN KEY (`Posizione_aperta`) REFERENCES `Posizione_aperta` (`Id_PosizioneAperta`) ON DELETE CASCADE,
  CONSTRAINT `CHK_Status` CHECK (`Status` = 'In attesa' or `Status` = 'Accettata' or `Status` = 'Rifiutata')
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Offerta_lavoro`
--

LOCK TABLES `Offerta_lavoro` WRITE;
/*!40000 ALTER TABLE `Offerta_lavoro` DISABLE KEYS */;
INSERT INTO `Offerta_lavoro` VALUES (17,27,28,13,'2021-09-03 11:49:26','Accettata'),(18,27,28,9,'2021-09-03 11:49:03','Rifiutata'),(19,27,28,14,'2021-09-03 11:48:46','In attesa'),(20,27,28,9,'2021-09-04 16:33:30','In attesa');
/*!40000 ALTER TABLE `Offerta_lavoro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posizione_aperta`
--

DROP TABLE IF EXISTS `Posizione_aperta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Posizione_aperta` (
  `Id_PosizioneAperta` int(11) NOT NULL AUTO_INCREMENT,
  `Comune` int(11) NOT NULL,
  `Professionista` int(11) NOT NULL,
  `Descrizione` varchar(150) NOT NULL,
  `Ruolo` varchar(35) NOT NULL,
  `Posti_disponibili` smallint(6) NOT NULL,
  PRIMARY KEY (`Id_PosizioneAperta`),
  KEY `Comune` (`Comune`),
  KEY `Professionista` (`Professionista`),
  CONSTRAINT `Posizione_aperta_ibfk_1` FOREIGN KEY (`Comune`) REFERENCES `Comune` (`Id_comune`),
  CONSTRAINT `Posizione_aperta_ibfk_3` FOREIGN KEY (`Professionista`) REFERENCES `Professionista` (`Id_professionista`) ON DELETE CASCADE,
  CONSTRAINT `CONSTRAINT_1` CHECK (`Posti_disponibili` >= 1)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posizione_aperta`
--

LOCK TABLES `Posizione_aperta` WRITE;
/*!40000 ALTER TABLE `Posizione_aperta` DISABLE KEYS */;
INSERT INTO `Posizione_aperta` VALUES (9,13,27,'Descrizione_1','Ruolo_1',2),(13,16,27,'Descrizione_3','Ruolo_3',1),(14,15,27,'Descrizione_2','Ruolo_2',3);
/*!40000 ALTER TABLE `Posizione_aperta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Prestazione`
--

DROP TABLE IF EXISTS `Prestazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Prestazione` (
  `Id_prestazione` int(11) NOT NULL AUTO_INCREMENT,
  `Cliente` int(11) NOT NULL,
  `Servizio` int(11) NOT NULL,
  `DataOra_UltimoAggiornamento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_prestazione`),
  KEY `Cliente` (`Cliente`),
  KEY `Servizio` (`Servizio`),
  CONSTRAINT `Prestazione_ibfk_3` FOREIGN KEY (`Cliente`) REFERENCES `Cliente` (`Id_cliente`) ON DELETE CASCADE,
  CONSTRAINT `Prestazione_ibfk_4` FOREIGN KEY (`Servizio`) REFERENCES `Servizio` (`Id_servizio`) ON DELETE CASCADE,
  CONSTRAINT `CONSTRAINT_1` CHECK (`Status` = 'In attesa' or `Status` = 'In corso' or `Status` = 'Terminata')
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Prestazione`
--

LOCK TABLES `Prestazione` WRITE;
/*!40000 ALTER TABLE `Prestazione` DISABLE KEYS */;
INSERT INTO `Prestazione` VALUES (6,15,7,'2021-09-04 16:44:12','Terminata'),(7,15,5,'2021-09-04 17:05:20','In corso'),(9,15,6,'2021-09-04 17:05:40','Terminata');
/*!40000 ALTER TABLE `Prestazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Privato`
--

DROP TABLE IF EXISTS `Privato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Privato` (
  `Id_privato` int(11) NOT NULL AUTO_INCREMENT,
  `Utente` int(11) NOT NULL,
  `Nome` varchar(25) NOT NULL,
  `Cognome` varchar(25) NOT NULL,
  `Data_nascita` date NOT NULL,
  `Residenza` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_privato`),
  KEY `Utente` (`Utente`),
  CONSTRAINT `Privato_ibfk_1` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Id_utente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Privato`
--

LOCK TABLES `Privato` WRITE;
/*!40000 ALTER TABLE `Privato` DISABLE KEYS */;
INSERT INTO `Privato` VALUES (23,50,'Mario','Bianchi ','1990-07-12','Modena');
/*!40000 ALTER TABLE `Privato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Professionista`
--

DROP TABLE IF EXISTS `Professionista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Professionista` (
  `Id_professionista` int(11) NOT NULL AUTO_INCREMENT,
  `Utente` int(11) NOT NULL,
  `Descrizione_societa` varchar(255) NOT NULL,
  `Datore_lavoro` tinyint(1) NOT NULL,
  `Fornitore_servizi` tinyint(1) NOT NULL,
  `Sede` varchar(25) NOT NULL,
  `Settore` int(11) NOT NULL,
  `Nome_societa` varchar(25) NOT NULL,
  `Intestatario` varchar(25) NOT NULL,
  PRIMARY KEY (`Id_professionista`),
  KEY `Utente` (`Utente`),
  KEY `Professionista_ibfk_2` (`Settore`),
  CONSTRAINT `Professionista_ibfk_3` FOREIGN KEY (`Utente`) REFERENCES `Utente` (`Id_utente`) ON DELETE CASCADE,
  CONSTRAINT `Professionista_ibfk_4` FOREIGN KEY (`Settore`) REFERENCES `Settore` (`Id_settore`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Professionista`
--

LOCK TABLES `Professionista` WRITE;
/*!40000 ALTER TABLE `Professionista` DISABLE KEYS */;
INSERT INTO `Professionista` VALUES (27,49,'Descrizione_test1',1,1,'Carpi',3,'Societa_1','Giovanni Rossi');
/*!40000 ALTER TABLE `Professionista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Qualifica_posseduta`
--

DROP TABLE IF EXISTS `Qualifica_posseduta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Qualifica_posseduta` (
  `Id_qualifica_posseduta` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione_qual_poss` varchar(50) NOT NULL,
  `Candidato` int(11) NOT NULL,
  PRIMARY KEY (`Id_qualifica_posseduta`),
  KEY `Candidato` (`Candidato`),
  CONSTRAINT `Qualifica_posseduta_ibfk_1` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Qualifica_posseduta`
--

LOCK TABLES `Qualifica_posseduta` WRITE;
/*!40000 ALTER TABLE `Qualifica_posseduta` DISABLE KEYS */;
INSERT INTO `Qualifica_posseduta` VALUES (6,'Attestato_1_ca28',28),(7,'Attestato_2_ca28',28);
/*!40000 ALTER TABLE `Qualifica_posseduta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Qualifica_richiesta`
--

DROP TABLE IF EXISTS `Qualifica_richiesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Qualifica_richiesta` (
  `Id_qualifica_richiesta` int(11) NOT NULL AUTO_INCREMENT,
  `Descrizione` varchar(100) NOT NULL,
  `Requisito` int(11) NOT NULL,
  PRIMARY KEY (`Id_qualifica_richiesta`),
  KEY `Requisito` (`Requisito`),
  CONSTRAINT `Qualifica_richiesta_ibfk_2` FOREIGN KEY (`Requisito`) REFERENCES `Requisito` (`Id_requisito`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Qualifica_richiesta`
--

LOCK TABLES `Qualifica_richiesta` WRITE;
/*!40000 ALTER TABLE `Qualifica_richiesta` DISABLE KEYS */;
INSERT INTO `Qualifica_richiesta` VALUES (8,'Qualifica_1',8),(12,'Attestato_3',11),(13,'Qualifica_2',12);
/*!40000 ALTER TABLE `Qualifica_richiesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `Rapporto_QualitaPrezzo_medio_vista`
--

DROP TABLE IF EXISTS `Rapporto_QualitaPrezzo_medio_vista`;
/*!50001 DROP VIEW IF EXISTS `Rapporto_QualitaPrezzo_medio_vista`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `Rapporto_QualitaPrezzo_medio_vista` (
  `Servizio` tinyint NOT NULL,
  `Somma_Rapporto_qp` tinyint NOT NULL,
  `Conteggio` tinyint NOT NULL,
  `Media_Rapporto_qp` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `Recensione`
--

DROP TABLE IF EXISTS `Recensione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recensione` (
  `Id_recensione` int(11) NOT NULL AUTO_INCREMENT,
  `Servizio` int(11) NOT NULL,
  `Cliente` int(11) NOT NULL,
  `Data_ora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Descrizione` varchar(400) NOT NULL,
  PRIMARY KEY (`Id_recensione`),
  KEY `Servizio` (`Servizio`),
  KEY `Cliente` (`Cliente`),
  CONSTRAINT `Recensione_ibfk_3` FOREIGN KEY (`Servizio`) REFERENCES `Servizio` (`Id_servizio`) ON DELETE CASCADE,
  CONSTRAINT `Recensione_ibfk_4` FOREIGN KEY (`Cliente`) REFERENCES `Cliente` (`Id_cliente`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recensione`
--

LOCK TABLES `Recensione` WRITE;
/*!40000 ALTER TABLE `Recensione` DISABLE KEYS */;
INSERT INTO `Recensione` VALUES (3,7,15,'2021-09-04 17:01:47','Recensione_1_ca28'),(4,6,15,'2021-09-04 17:06:24','Recensione_2_ca28');
/*!40000 ALTER TABLE `Recensione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Requisito`
--

DROP TABLE IF EXISTS `Requisito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Requisito` (
  `Id_requisito` int(11) NOT NULL AUTO_INCREMENT,
  `Posizione_aperta` int(11) NOT NULL,
  `Esperienza` varchar(150) NOT NULL,
  PRIMARY KEY (`Id_requisito`),
  KEY `Posizione_aperta` (`Posizione_aperta`),
  CONSTRAINT `Requisito_ibfk_2` FOREIGN KEY (`Posizione_aperta`) REFERENCES `Posizione_aperta` (`Id_PosizioneAperta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Requisito`
--

LOCK TABLES `Requisito` WRITE;
/*!40000 ALTER TABLE `Requisito` DISABLE KEYS */;
INSERT INTO `Requisito` VALUES (8,9,'Esperienza_1'),(11,13,'Esperienza_3'),(12,14,'Esperienza_test');
/*!40000 ALTER TABLE `Requisito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ruolo_ricercato`
--

DROP TABLE IF EXISTS `Ruolo_ricercato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ruolo_ricercato` (
  `Id_ruolo_ricercato` int(11) NOT NULL AUTO_INCREMENT,
  `Ruolo` varchar(40) NOT NULL,
  `Candidato` int(11) NOT NULL,
  `Descrizione_ruolo` varchar(255) DEFAULT NULL,
  `Settore` int(11) NOT NULL,
  PRIMARY KEY (`Id_ruolo_ricercato`),
  KEY `Candidato` (`Candidato`),
  KEY `Ruolo_ricercato_ibfk_2` (`Settore`),
  CONSTRAINT `Ruolo_ricercato_ibfk_3` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE,
  CONSTRAINT `Ruolo_ricercato_ibfk_4` FOREIGN KEY (`Settore`) REFERENCES `Settore` (`Id_settore`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ruolo_ricercato`
--

LOCK TABLES `Ruolo_ricercato` WRITE;
/*!40000 ALTER TABLE `Ruolo_ricercato` DISABLE KEYS */;
INSERT INTO `Ruolo_ricercato` VALUES (5,'Ruolo_1_ca28',28,'Descrizione_ruolo_1_ca28',2),(6,'Ruolo_2_ca28',28,'Descrizione_ruolo_2_ca28',4),(7,'Ruolo_3_ca28',28,'Descrizione_ruolo_3_ca28',8);
/*!40000 ALTER TABLE `Ruolo_ricercato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Servizio`
--

DROP TABLE IF EXISTS `Servizio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Servizio` (
  `Id_servizio` int(11) NOT NULL AUTO_INCREMENT,
  `Professionista` int(11) NOT NULL,
  `Descrizione` varchar(250) NOT NULL,
  `Prezzo` smallint(6) NOT NULL,
  `Disponibilita` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_servizio`),
  KEY `Professionista` (`Professionista`),
  CONSTRAINT `Servizio_ibfk_1` FOREIGN KEY (`Professionista`) REFERENCES `Professionista` (`Id_professionista`) ON DELETE CASCADE,
  CONSTRAINT `CONSTRAINT_1` CHECK (`Disponibilita` = 'Immediata' or `Disponibilita` = 'Non immediata' or `Disponibilita` = 'Non specificata')
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Servizio`
--

LOCK TABLES `Servizio` WRITE;
/*!40000 ALTER TABLE `Servizio` DISABLE KEYS */;
INSERT INTO `Servizio` VALUES (5,27,'Descrizione_servizio_1',70,'Immediata'),(6,27,'Descrizione_servizio_2',100,'Non immediata'),(7,27,'Descrizione_servizio_3',50,'Non specificata');
/*!40000 ALTER TABLE `Servizio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Settore`
--

DROP TABLE IF EXISTS `Settore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Settore` (
  `Id_settore` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_settore` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_settore`),
  UNIQUE KEY `Nome` (`Nome_settore`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Settore`
--

LOCK TABLES `Settore` WRITE;
/*!40000 ALTER TABLE `Settore` DISABLE KEYS */;
INSERT INTO `Settore` VALUES (7,'Benessere'),(3,'Economia'),(2,'Elettronica'),(5,'Giurisprudenza'),(1,'Idraulica'),(4,'Informatica'),(8,'Ingegneria'),(6,'Sport');
/*!40000 ALTER TABLE `Settore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Titolo_posseduto`
--

DROP TABLE IF EXISTS `Titolo_posseduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Titolo_posseduto` (
  `Id_titolo_posseduto` int(11) NOT NULL AUTO_INCREMENT,
  `Candidato` int(11) NOT NULL,
  `Tipologia` varchar(70) NOT NULL,
  `Descrizione_titolo` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_titolo_posseduto`),
  KEY `Candidato` (`Candidato`),
  CONSTRAINT `Titolo_posseduto_ibfk_1` FOREIGN KEY (`Candidato`) REFERENCES `Candidato` (`Id_candidato`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Titolo_posseduto`
--

LOCK TABLES `Titolo_posseduto` WRITE;
/*!40000 ALTER TABLE `Titolo_posseduto` DISABLE KEYS */;
INSERT INTO `Titolo_posseduto` VALUES (3,28,'laurea_triennale','Laurea_1_ca28'),(4,28,'specialistica','Laurea_2_ca28');
/*!40000 ALTER TABLE `Titolo_posseduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Titolo_richiesto`
--

DROP TABLE IF EXISTS `Titolo_richiesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Titolo_richiesto` (
  `Id_titolo_richiesto` int(11) NOT NULL AUTO_INCREMENT,
  `Requisito` int(11) NOT NULL,
  `Tipologia` varchar(70) NOT NULL,
  `Descrizione_titolo` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_titolo_richiesto`),
  KEY `Requisito` (`Requisito`),
  CONSTRAINT `Titolo_richiesto_ibfk_2` FOREIGN KEY (`Requisito`) REFERENCES `Requisito` (`Id_requisito`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Titolo_richiesto`
--

LOCK TABLES `Titolo_richiesto` WRITE;
/*!40000 ALTER TABLE `Titolo_richiesto` DISABLE KEYS */;
INSERT INTO `Titolo_richiesto` VALUES (8,8,'laurea_triennale','Dettaglio_1'),(12,11,'laurea_triennale','Dettaglio_3'),(13,12,'specialistica','Dettaglio_2');
/*!40000 ALTER TABLE `Titolo_richiesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utente`
--

DROP TABLE IF EXISTS `Utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Utente` (
  `Id_utente` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_utente`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`Categoria` = 'Professionista' or `Categoria` = 'Privato')
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utente`
--

LOCK TABLES `Utente` WRITE;
/*!40000 ALTER TABLE `Utente` DISABLE KEYS */;
INSERT INTO `Utente` VALUES (49,'Professionista'),(50,'Privato');
/*!40000 ALTER TABLE `Utente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Valutazione`
--

DROP TABLE IF EXISTS `Valutazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Valutazione` (
  `Id_valutazione` int(11) NOT NULL AUTO_INCREMENT,
  `Servizio` int(11) NOT NULL,
  `Cliente` int(11) NOT NULL,
  `Rapporto_QualitaPrezzo` decimal(2,1) NOT NULL,
  `Disponibilita_professionista` decimal(2,1) NOT NULL,
  `Consigliato` decimal(2,1) NOT NULL,
  `Generale` decimal(3,2) NOT NULL DEFAULT ((`Rapporto_QualitaPrezzo` + `Disponibilita_professionista` + `Consigliato`) / 3),
  `Data_ora` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_valutazione`),
  KEY `Servizio` (`Servizio`),
  KEY `Cliente` (`Cliente`),
  CONSTRAINT `Valutazione_ibfk_3` FOREIGN KEY (`Servizio`) REFERENCES `Servizio` (`Id_servizio`) ON DELETE CASCADE,
  CONSTRAINT `Valutazione_ibfk_4` FOREIGN KEY (`Cliente`) REFERENCES `Cliente` (`Id_cliente`) ON DELETE CASCADE,
  CONSTRAINT `CONSTRAINT_1` CHECK (`Rapporto_QualitaPrezzo` >= 0.5 and `Rapporto_QualitaPrezzo` <= 5),
  CONSTRAINT `CONSTRAINT_2` CHECK (`Disponibilita_professionista` >= 0.5 and `Disponibilita_professionista` <= 5),
  CONSTRAINT `CONSTRAINT_3` CHECK (`Consigliato` >= 0.5 and `Consigliato` <= 5)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Valutazione`
--

LOCK TABLES `Valutazione` WRITE;
/*!40000 ALTER TABLE `Valutazione` DISABLE KEYS */;
INSERT INTO `Valutazione` VALUES (9,7,15,4.0,3.5,4.0,3.83,'2021-09-04 17:02:39'),(10,6,15,3.0,4.0,3.0,3.33,'2021-09-04 17:07:04');
/*!40000 ALTER TABLE `Valutazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `Consigliato_media_vista`
--

/*!50001 DROP TABLE IF EXISTS `Consigliato_media_vista`*/;
/*!50001 DROP VIEW IF EXISTS `Consigliato_media_vista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Consigliato_media_vista` AS select `Valutazione`.`Servizio` AS `Servizio`,sum(`Valutazione`.`Consigliato`) AS `Somma_Consigliato`,count(0) AS `Conteggio`,sum(`Valutazione`.`Consigliato`) / count(0) AS `Media_consigliato` from `Valutazione` group by `Valutazione`.`Servizio` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `Disponibilita_professionista_media_vista`
--

/*!50001 DROP TABLE IF EXISTS `Disponibilita_professionista_media_vista`*/;
/*!50001 DROP VIEW IF EXISTS `Disponibilita_professionista_media_vista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Disponibilita_professionista_media_vista` AS select `Valutazione`.`Servizio` AS `Servizio`,sum(`Valutazione`.`Disponibilita_professionista`) AS `Somma_Disponibilita_pro`,count(0) AS `Conteggio`,sum(`Valutazione`.`Disponibilita_professionista`) / count(0) AS `Media_Disponibilita_pro` from `Valutazione` group by `Valutazione`.`Servizio` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `Generale_media_vista`
--

/*!50001 DROP TABLE IF EXISTS `Generale_media_vista`*/;
/*!50001 DROP VIEW IF EXISTS `Generale_media_vista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Generale_media_vista` AS select `Valutazione`.`Servizio` AS `Servizio`,sum(`Valutazione`.`Generale`) AS `Somma_generale`,count(0) AS `Conteggio`,sum(`Valutazione`.`Generale`) / count(0) AS `Media_generale` from `Valutazione` group by `Valutazione`.`Servizio` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `Rapporto_QualitaPrezzo_medio_vista`
--

/*!50001 DROP TABLE IF EXISTS `Rapporto_QualitaPrezzo_medio_vista`*/;
/*!50001 DROP VIEW IF EXISTS `Rapporto_QualitaPrezzo_medio_vista`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `Rapporto_QualitaPrezzo_medio_vista` AS select `Valutazione`.`Servizio` AS `Servizio`,sum(`Valutazione`.`Rapporto_QualitaPrezzo`) AS `Somma_Rapporto_qp`,count(0) AS `Conteggio`,sum(`Valutazione`.`Rapporto_QualitaPrezzo`) / count(0) AS `Media_Rapporto_qp` from `Valutazione` group by `Valutazione`.`Servizio` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-01 20:29:52
