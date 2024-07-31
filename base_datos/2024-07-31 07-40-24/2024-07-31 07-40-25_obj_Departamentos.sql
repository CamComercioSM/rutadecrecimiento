/*
SQLyog Ultimate v13.2.0 (64 bit)
MySQL - 5.7.44-log : Database - rutacrecimiento_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rutacrecimiento_crm` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `rutacrecimiento_crm`;

/*Table structure for table `Departamentos` */

DROP TABLE IF EXISTS `Departamentos`;

CREATE TABLE `Departamentos` (
  `departamentoID` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoCODIGO` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoNOMBRE` varchar(255) CHARACTER SET utf8 NOT NULL,
  `departamentoNOMBREOFICIAL` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoCAPITAL` int(11) DEFAULT NULL,
  `departamentoSUPERFICIE` decimal(10,2) DEFAULT NULL,
  `departamentoMUNICIPIOS` int(11) DEFAULT NULL,
  `departamentoCODIGOCGN` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paisID` int(11) DEFAULT NULL,
  `regionID` int(11) DEFAULT NULL,
  `departamentoESTADISTICAS` enum('SI','NO') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`departamentoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000001 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
