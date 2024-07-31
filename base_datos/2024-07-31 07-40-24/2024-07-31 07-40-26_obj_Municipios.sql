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

/*Table structure for table `Municipios` */

DROP TABLE IF EXISTS `Municipios`;

CREATE TABLE `Municipios` (
  `municipioID` int(11) NOT NULL AUTO_INCREMENT,
  `municipioCODIGO` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioCODIGODANE` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioTITULO` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `municipioNOMBREOFICIAL` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioCONTABILIDAD` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoID` int(11) NOT NULL,
  `municipioESTADISTICAS` enum('SI','NO') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`municipioID`)
) ENGINE=InnoDB AUTO_INCREMENT=1133 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
