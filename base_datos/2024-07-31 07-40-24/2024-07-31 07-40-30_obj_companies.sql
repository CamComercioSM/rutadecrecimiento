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

/*Table structure for table `companies` */

DROP TABLE IF EXISTS `companies`;

CREATE TABLE `companies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `business_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL COMMENT 'Razon social ',
  `description` text COLLATE utf8mb4_spanish2_ci,
  `nit` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL COMMENT 'Nit',
  `registration_number` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Numero de matricula ',
  `registration_date` date NOT NULL COMMENT 'Fecha de matricula',
  `registration_email` varchar(48) COLLATE utf8mb4_spanish2_ci NOT NULL COMMENT 'Email registrado en camara de comercio',
  `size` char(1) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'tamaño (micro - pequeña - mediana - gran empresa)',
  `type_person` char(1) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Tipo de persona ( 0=>natural o 1=>establecieminto, 2 => juridica)',
  `sector` char(1) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Sector (Comercio, Servicios, Manofactura)',
  `anual_sales` char(1) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `comercial_activity` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Actividad comercial',
  `name_legal_representative` varchar(200) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Nombre representante legal',
  `affiliated` char(1) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '0' COMMENT 'Indica si esta afiliada a la camara de comercio',
  `department_id` char(4) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `department_viejo` char(4) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `municipality_id` char(4) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `municipality_viejo` char(4) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_spanish2_ci,
  `geolocation` varchar(200) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'ubicacion geografica',
  `telephone` varchar(15) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Telefono',
  `mobile` varchar(15) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'Celular',
  `website` text COLLATE utf8mb4_spanish2_ci COMMENT 'Sitio web',
  `social_instagram` text COLLATE utf8mb4_spanish2_ci COMMENT 'Redes sociales',
  `social_facebook` text COLLATE utf8mb4_spanish2_ci,
  `social_linkedin` text COLLATE utf8mb4_spanish2_ci,
  `contact_person` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'persona de contacto',
  `contact_position` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'cargo contacto',
  `contact_email` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'email de contacto ',
  `contact_phone` varchar(15) COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT 'celular de contacto',
  `stage_id` int(11) DEFAULT NULL COMMENT 'indica la etapa en la que se encuentra la empresa',
  `update_info` char(1) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '0',
  `complete_diagnostic` char(1) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '0',
  `show_poll` char(1) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '1',
  `logo` text COLLATE utf8mb4_spanish2_ci,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `camara_comercio` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT '32',
  `tipo_registro_rutac` enum('IDEA','INFORMAL','FORMAL_EXTERNO','FORMAL_MAGDALENA') COLLATE utf8mb4_spanish2_ci DEFAULT 'FORMAL_MAGDALENA',
  `tipo_identificacion` varchar(10) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `identificacion` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `etapa_intervencion` enum('CRECIMIENTO','TRANSFORMADA','INTERVENCION','FALLECIMIENTO') COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'CRECIMIENTO',
  `transformada_fecha` timestamp NULL DEFAULT NULL,
  `transformada_en` int(11) DEFAULT NULL,
  `transformada_desde` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stage_id` (`stage_id`),
  CONSTRAINT `fk_company_stages` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1987 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci COMMENT='almacena la informacion de una empresa';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
