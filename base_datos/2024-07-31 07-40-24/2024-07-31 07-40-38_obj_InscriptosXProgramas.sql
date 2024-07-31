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

/*View structure for view InscriptosXProgramas */

/*!50001 DROP TABLE IF EXISTS `InscriptosXProgramas` */;
/*!50001 DROP VIEW IF EXISTS `InscriptosXProgramas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `InscriptosXProgramas` AS (select `programs`.`id` AS `ProgramaID`,`programs`.`name` AS `ProgramaNOMBRE`,`programs`.`programaTITULO` AS `ProgramaTITULO`,`programs`.`aimed_at` AS `ProgramaCONVOCATORIA`,`programs`.`deleted_at` AS `ProgramaELIMINADO`,`aplications`.`id` AS `InscripcionID`,`aplications`.`state` AS `InscripcionESTADOID`,`aplications`.`comments` AS `InscripcionCOMENTARIO`,`aplications`.`created_at` AS `InscripcionFECHA`,`aplications`.`updated_at` AS `InscripcionACTUALIZACION`,`aplications`.`deleted_at` AS `InscripcionELIMINADA`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADO`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADONOMBRE`,`aplications`.`company_id` AS `InscripcionEMPRESAID`,`companies`.`id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA` from (((`programs` left join `aplications` on((`programs`.`id` = `aplications`.`program_id`))) left join `companies` on(((`aplications`.`company_id` = `companies`.`id`) and (`aplications`.`company_id` <> 6)))) left join `InscripcionesEstados` on((`aplications`.`state` = `InscripcionesEstados`.`inscripcionEstadoID`))) where isnull(`programs`.`deleted_at`) order by `programs`.`name`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
