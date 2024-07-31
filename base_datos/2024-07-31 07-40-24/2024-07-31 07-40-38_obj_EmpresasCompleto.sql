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

/*View structure for view EmpresasCompleto */

/*!50001 DROP TABLE IF EXISTS `EmpresasCompleto` */;
/*!50001 DROP VIEW IF EXISTS `EmpresasCompleto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `EmpresasCompleto` AS (select `companies`.`id` AS `empresaID`,`companies`.`business_name` AS `empresaRAZONSOCIAL`,`companies`.`description` AS `empresaDESCRIPCION`,`companies`.`nit` AS `empresaNIT`,`companies`.`registration_number` AS `empresaMATRICULA`,`companies`.`registration_date` AS `empresaFECHADEMATRICULA`,`companies`.`registration_email` AS `empresaEMAIL`,`companies`.`size` AS `empresaTAMANOCODIGO`,`companies`.`type_person` AS `empresaTIPODEPERSONAID`,`companies`.`sector` AS `empresaMACROSECTORID`,`companies`.`anual_sales` AS `empresaVENTASANUALESID`,`companies`.`comercial_activity` AS `empresaCIIU`,`companies`.`name_legal_representative` AS `empresaREPRESESNTANTELEGAL`,`companies`.`affiliated` AS `empresaAFILIADOID`,`companies`.`department_id` AS `empresaDEPARTAMENTOID`,`companies`.`department_viejo` AS `empresaDEPARTAMENTOVIEJOID`,`companies`.`municipality_id` AS `empresaMUNICIPIOID`,`companies`.`municipality_viejo` AS `empresaMUNICIPIOVIEJOID`,`companies`.`address` AS `empresaDIRECCION`,`companies`.`geolocation` AS `empresaGEOLOCALIZACION`,`companies`.`telephone` AS `empresaTELEFONO`,`companies`.`mobile` AS `empresaCELULAR`,`companies`.`website` AS `empresaSITIOWEB`,`companies`.`social_instagram` AS `empresaINSTAGRAM`,`companies`.`social_facebook` AS `empresaFACEBOOK`,`companies`.`social_linkedin` AS `empresaLINKEDIN`,`companies`.`contact_person` AS `empresaPERSONACONTACTO`,`companies`.`contact_position` AS `empresaCARGOCONTACTO`,`companies`.`contact_email` AS `empresaEMAILCONTACTO`,`companies`.`contact_phone` AS `empresaTELEFONOCONTACTO`,`companies`.`stage_id` AS `empresaETAPAID`,`companies`.`update_info` AS `empresaDATOSCONTACTOCOMPLETO`,`companies`.`complete_diagnostic` AS `empresaDIAGNOSTICOCOMPLETO`,`companies`.`logo` AS `empresaLOGO`,`companies`.`user_id` AS `empresaUSUARIOID`,`companies`.`created_at` AS `empresaFECHADECREACIONREGISTRORUTAC`,`companies`.`updated_at` AS `empresaFECHADEACTUALIZACIONREGISTRORUTAC`,`companies`.`deleted_at` AS `empresaFECHADEELIMINACIONREGISTRORUTAC`,`TamanoPersona`.`tamanoID` AS `tamanoID`,`TamanoPersona`.`tamanoNOMBRE` AS `tamanoNOMBRE`,`TiposPersonas`.`tipoPersonaNOMBRE` AS `tipopersonaNOMBRE`,`MacroSectores`.`sectorNOMBRE` AS `sectorNOMBRE`,`VentasAnuales`.`ventasAnualesNOMBRE` AS `ventasAnualesNOMBRE`,`VentasAnuales`.`ventasAnualesINICIO` AS `ventasAnualesINICIO`,`VentasAnuales`.`ventasAnualesFINAL` AS `ventasAnualesFINAL`,`TipoAfiliacion`.`tipoAfiliadoNOMBRE` AS `tipoAfiliadoNOMBRE`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`users`.`id` AS `usuarioID`,`users`.`identification` AS `usuarioCEDULA`,`users`.`name` AS `usuarioNOMBRE`,`users`.`lastname` AS `usuarioAPELLIDO`,`users`.`email` AS `usuarioEMAIL`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioNOMBRE`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Departamentos`.`regionID` AS `regionID`,`Departamentos`.`paisID` AS `paisID` from (((((((((`companies` left join `TamanoPersona` on((`companies`.`size` = `TamanoPersona`.`tamanoCODIGO`))) left join `TiposPersonas` on((`companies`.`type_person` = `TiposPersonas`.`tipoPersonaCODIGO`))) left join `MacroSectores` on((`companies`.`sector` = `MacroSectores`.`sectorCODIGO`))) left join `VentasAnuales` on(((`companies`.`sector` = `VentasAnuales`.`sectorCODIGO`) and (`companies`.`anual_sales` = `VentasAnuales`.`ventasAnualesCODIGO`)))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) left join `TipoAfiliacion` on((`companies`.`affiliated` = `TipoAfiliacion`.`tipoAfiliadoCODIGO`))) left join `users` on((`companies`.`user_id` = `users`.`id`))) left join `Departamentos` on((`companies`.`department_id` = `Departamentos`.`departamentoID`))) left join `Municipios` on((`companies`.`municipality_id` = `Municipios`.`municipioID`))) where (`companies`.`id` <> 6)) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
