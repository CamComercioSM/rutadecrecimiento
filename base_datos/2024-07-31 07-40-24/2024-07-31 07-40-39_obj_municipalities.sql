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

/*View structure for view municipalities */

/*!50001 DROP TABLE IF EXISTS `municipalities` */;
/*!50001 DROP VIEW IF EXISTS `municipalities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `municipalities` AS (select `Municipios`.`municipioID` AS `id`,`Municipios`.`departamentoID` AS `department_id`,`Municipios`.`municipioNOMBREOFICIAL` AS `name`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioTITULO`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Municipios`.`municipioCONTABILIDAD` AS `municipioCONTABILIDAD`,`Municipios`.`departamentoID` AS `departamentoID`,`Municipios`.`municipioESTADISTICAS` AS `municipioESTADISTICAS` from `Municipios` where (`Municipios`.`municipioESTADISTICAS` = 'NO')) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;