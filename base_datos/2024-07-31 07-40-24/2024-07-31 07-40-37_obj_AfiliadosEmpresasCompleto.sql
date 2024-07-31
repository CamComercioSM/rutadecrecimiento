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

/*View structure for view AfiliadosEmpresasCompleto */

/*!50001 DROP TABLE IF EXISTS `AfiliadosEmpresasCompleto` */;
/*!50001 DROP VIEW IF EXISTS `AfiliadosEmpresasCompleto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `AfiliadosEmpresasCompleto` AS (select `companies`.`id` AS `id`,`companies`.`id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA`,`companies`.`registration_date` AS `registration_date`,`companies`.`registration_email` AS `registration_email`,`companies`.`size` AS `size`,`companies`.`type_person` AS `type_person`,`companies`.`sector` AS `sector`,`companies`.`anual_sales` AS `anual_sales`,`companies`.`comercial_activity` AS `comercial_activity`,`companies`.`name_legal_representative` AS `name_legal_representative`,`companies`.`affiliated` AS `affiliated`,`companies`.`department_id` AS `department_id`,`companies`.`department_viejo` AS `department_viejo`,`companies`.`municipality_id` AS `municipality_id`,`companies`.`municipality_viejo` AS `municipality_viejo`,`companies`.`address` AS `address`,`companies`.`geolocation` AS `geolocation`,`companies`.`telephone` AS `telephone`,`companies`.`mobile` AS `mobile`,`companies`.`website` AS `website`,`companies`.`social_instagram` AS `social_instagram`,`companies`.`social_facebook` AS `social_facebook`,`companies`.`social_linkedin` AS `social_linkedin`,`companies`.`contact_person` AS `contact_person`,`companies`.`contact_position` AS `contact_position`,`companies`.`contact_email` AS `contact_email`,`companies`.`contact_phone` AS `contact_phone`,`companies`.`stage_id` AS `stage_id`,`companies`.`update_info` AS `update_info`,`companies`.`complete_diagnostic` AS `complete_diagnostic`,`companies`.`show_poll` AS `show_poll`,`companies`.`logo` AS `logo`,`companies`.`user_id` AS `user_id`,`companies`.`created_at` AS `created_at`,`companies`.`updated_at` AS `updated_at`,`companies`.`deleted_at` AS `deleted_at`,`TamanoPersona`.`tamanoNOMBRE` AS `tamanoNOMBRE`,`TiposPersonas`.`tipoPersonaNOMBRE` AS `tipoPersonaNOMBRE`,`MacroSectores`.`sectorNOMBRE` AS `sectorNOMBRE`,`VentasAnuales`.`ventasAnualesNOMBRE` AS `ventasAnualesNOMBRE`,`VentasAnuales`.`ventasAnualesINICIO` AS `ventasAnualesINICIO`,`VentasAnuales`.`ventasAnualesFINAL` AS `ventasAnualesFINAL`,`TipoAfiliacion`.`tipoAfiliadoNOMBRE` AS `tipoAfiliadoNOMBRE`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`users`.`id` AS `usuarioID`,`users`.`identification` AS `usuarioCEDULA`,`users`.`name` AS `usuarioNOMBRE`,`users`.`lastname` AS `usuarioAPELLIDO`,`users`.`email` AS `usuarioEMAIL`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioTITULO`,`Municipios`.`municipioTITULO` AS `municipioNOMBRE`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Departamentos`.`regionID` AS `regionID`,`Departamentos`.`paisID` AS `paisID` from (((((((((`companies` left join `TamanoPersona` on((`companies`.`size` = `TamanoPersona`.`tamanoCODIGO`))) left join `TiposPersonas` on((`companies`.`type_person` = `TiposPersonas`.`tipoPersonaCODIGO`))) left join `MacroSectores` on((`companies`.`sector` = `MacroSectores`.`sectorCODIGO`))) left join `VentasAnuales` on(((`companies`.`sector` = `VentasAnuales`.`sectorCODIGO`) and (`companies`.`anual_sales` = `VentasAnuales`.`ventasAnualesCODIGO`)))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) left join `TipoAfiliacion` on((`companies`.`affiliated` = `TipoAfiliacion`.`tipoAfiliadoCODIGO`))) left join `users` on((`companies`.`user_id` = `users`.`id`))) left join `Departamentos` on((`companies`.`department_id` = `Departamentos`.`departamentoID`))) left join `Municipios` on((`companies`.`municipality_id` = `Municipios`.`municipioID`))) where ((`companies`.`affiliated` = 1) and (`companies`.`id` <> 6))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
