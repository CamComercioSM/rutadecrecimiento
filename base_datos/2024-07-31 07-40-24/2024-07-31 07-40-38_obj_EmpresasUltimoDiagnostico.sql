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

/*View structure for view EmpresasUltimoDiagnostico */

/*!50001 DROP TABLE IF EXISTS `EmpresasUltimoDiagnostico` */;
/*!50001 DROP VIEW IF EXISTS `EmpresasUltimoDiagnostico` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `EmpresasUltimoDiagnostico` AS (select `EMPRESAS`.`id` AS `empresaID`,`EMPRESAS`.`business_name` AS `empresaRAZONSOCIAL`,`EMPRESAS`.`nit` AS `empresaNIT`,`EMPRESAS`.`registration_number` AS `empresaMATRICULA`,`EMPRESAS`.`complete_diagnostic` AS `empresaDIAGNOSTICOCOMPLETO`,`etapaCALCULADA`.`id` AS `etapaCALCULADAID`,`etapaCALCULADA`.`name` AS `etapaCALCULADANOMBRE`,`DIAGNOSTICO`.`id` AS `diagnosticoID`,`DIAGNOSTICO`.`score` AS `diagnosticoPUNTAJE`,`DIAGNOSTICO`.`score` AS `diagnosticoRESULTADO`,`DIAGNOSTICO`.`created_at` AS `diagnosticoFCHCREADO`,`DIAGNOSTICO`.`updated_at` AS `diagnosticoFCHACTUALIZADO`,`DIAGNOSTICO`.`company_id` AS `company_id` from ((`companies` `EMPRESAS` left join `diagnostics` `DIAGNOSTICO` on(((`EMPRESAS`.`id` = `DIAGNOSTICO`.`company_id`) and (`DIAGNOSTICO`.`id` = (select max(`diagnostics`.`id`) from (`companies` left join `diagnostics` on((`companies`.`id` = `diagnostics`.`company_id`))) where (`companies`.`id` = `EMPRESAS`.`id`)))))) left join `stages` `etapaCALCULADA` on((`DIAGNOSTICO`.`score` between `etapaCALCULADA`.`score_inicial` and `etapaCALCULADA`.`score_final`))) where (`EMPRESAS`.`id` <> 6)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
