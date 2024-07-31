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

/*Table structure for table `programs` */

DROP TABLE IF EXISTS `programs`;

CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `logo` text,
  `benefits` text,
  `requirements` text,
  `duration` varchar(255) DEFAULT NULL,
  `aimed_at` text,
  `objective` text,
  `determinants` text,
  `image_procedure` text,
  `required_tools` text,
  `is_virtual` char(1) DEFAULT NULL,
  `person_charge` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `telephone` varchar(48) DEFAULT NULL,
  `input_info` text,
  `website` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `programaTITULO` varchar(255) DEFAULT NULL,
  `convocatoriaFCHAPERTURA` timestamp NULL DEFAULT NULL,
  `convocatoriaFCHCIERRE` timestamp NULL DEFAULT NULL,
  `convocatoriaTIEMPOACTIVIDAD` int(11) DEFAULT NULL COMMENT 'EN MESES',
  `convocatoriaCONMATRICULA` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
