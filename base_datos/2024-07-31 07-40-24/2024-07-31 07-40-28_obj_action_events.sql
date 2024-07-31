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

/*Table structure for table `action_events` */

DROP TABLE IF EXISTS `action_events`;

CREATE TABLE `action_events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_type` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionable_id` bigint(20) unsigned NOT NULL,
  `target_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned DEFAULT NULL,
  `fields` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'running',
  `exception` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `original` mediumtext COLLATE utf8mb4_unicode_ci,
  `changes` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `action_events_actionable_type_actionable_id_index` (`actionable_type`,`actionable_id`),
  KEY `action_events_batch_id_model_type_model_id_index` (`batch_id`,`model_type`,`model_id`),
  KEY `action_events_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4062 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
