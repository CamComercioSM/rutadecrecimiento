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

/*Table structure for table `stages` */

DROP TABLE IF EXISTS `stages`;

CREATE TABLE `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `name` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL COMMENT 'nombre de la etabla',
  `image` text COLLATE utf8mb4_spanish2_ci,
  `description` text COLLATE utf8mb4_spanish2_ci COMMENT 'desdcripcion de la etapa',
  `previous_stage_id` int(11) DEFAULT NULL COMMENT 'etapa que precede a la etapa actual, si es principal el campo sera nulo',
  `next_stage_id` int(11) DEFAULT NULL COMMENT 'indica cual es la siguiente etapa, si la etapa actual es la final este campo es nulo',
  `score_inicial` float(8,4) DEFAULT NULL,
  `score_final` float(8,4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `previous_stage_id` (`previous_stage_id`),
  KEY `next_stage_id` (`next_stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='contiene las etapas en las que puede estar una empresa';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
