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

/*View structure for view DiagnosticosXEmpresas */

/*!50001 DROP TABLE IF EXISTS `DiagnosticosXEmpresas` */;
/*!50001 DROP VIEW IF EXISTS `DiagnosticosXEmpresas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `DiagnosticosXEmpresas` AS (select `diagnostics`.`id` AS `diagnosticoID`,`diagnostics`.`score` AS `score`,`diagnostics`.`score` AS `diagnosticoRESULTADO`,`etapaCALCULADA`.`id` AS `etapaCALCULADAID`,`etapaCALCULADA`.`name` AS `etapaCALCULADANOMBRE`,`diagnostics`.`created_at` AS `diagnosticoFCHCREADO`,`diagnostics`.`updated_at` AS `diagnosticoFCHACTUALIZADO`,`diagnostics`.`company_id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA`,`companies`.`complete_diagnostic` AS `complete_diagnostic`,`companies`.`stage_id` AS `stage_id`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`companies`.`user_id` AS `user_id` from ((`companies` left join (`diagnostics` left join `stages` `etapaCALCULADA` on((`diagnostics`.`score` between `etapaCALCULADA`.`score_inicial` and `etapaCALCULADA`.`score_final`))) on((`diagnostics`.`company_id` = `companies`.`id`))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) where (`companies`.`id` <> 6)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
