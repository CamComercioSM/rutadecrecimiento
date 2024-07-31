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

/*View structure for view departments */

/*!50001 DROP TABLE IF EXISTS `departments` */;
/*!50001 DROP VIEW IF EXISTS `departments` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `departments` AS (select `Departamentos`.`departamentoID` AS `id`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `name`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Departamentos`.`departamentoCAPITAL` AS `departamentoCAPITAL`,`Departamentos`.`departamentoSUPERFICIE` AS `departamentoSUPERFICIE`,`Departamentos`.`departamentoMUNICIPIOS` AS `departamentoMUNICIPIOS`,`Departamentos`.`departamentoCODIGOCGN` AS `departamentoCODIGOCGN`,`Departamentos`.`paisID` AS `paisID`,`Departamentos`.`regionID` AS `regionID` from `Departamentos` where (`Departamentos`.`departamentoESTADISTICAS` = 'NO')) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
