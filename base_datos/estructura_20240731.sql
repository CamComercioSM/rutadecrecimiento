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

/*Table structure for table `Departamentos` */

DROP TABLE IF EXISTS `Departamentos`;

CREATE TABLE `Departamentos` (
  `departamentoID` int(11) NOT NULL AUTO_INCREMENT,
  `departamentoCODIGO` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoNOMBRE` varchar(255) CHARACTER SET utf8 NOT NULL,
  `departamentoNOMBREOFICIAL` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoCAPITAL` int(11) DEFAULT NULL,
  `departamentoSUPERFICIE` decimal(10,2) DEFAULT NULL,
  `departamentoMUNICIPIOS` int(11) DEFAULT NULL,
  `departamentoCODIGOCGN` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `paisID` int(11) DEFAULT NULL,
  `regionID` int(11) DEFAULT NULL,
  `departamentoESTADISTICAS` enum('SI','NO') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`departamentoID`)
) ENGINE=InnoDB AUTO_INCREMENT=1000000001 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `InscripcionesEstados` */

DROP TABLE IF EXISTS `InscripcionesEstados`;

CREATE TABLE `InscripcionesEstados` (
  `inscripcionEstadoID` int(11) NOT NULL AUTO_INCREMENT,
  `inscripcionEstadoCODIGO` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `inscripcionEstadoNOMBRE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `inscripcionEstadoCOLOR` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`inscripcionEstadoID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `MacroSectores` */

DROP TABLE IF EXISTS `MacroSectores`;

CREATE TABLE `MacroSectores` (
  `sectorID` int(11) NOT NULL AUTO_INCREMENT,
  `sectorCODIGO` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `sectorNOMBRE` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`sectorID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

/*Table structure for table `Municipios` */

DROP TABLE IF EXISTS `Municipios`;

CREATE TABLE `Municipios` (
  `municipioID` int(11) NOT NULL AUTO_INCREMENT,
  `municipioCODIGO` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioCODIGODANE` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioTITULO` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `municipioNOMBREOFICIAL` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `municipioCONTABILIDAD` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `departamentoID` int(11) NOT NULL,
  `municipioESTADISTICAS` enum('SI','NO') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`municipioID`)
) ENGINE=InnoDB AUTO_INCREMENT=1133 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `TamanoPersona` */

DROP TABLE IF EXISTS `TamanoPersona`;

CREATE TABLE `TamanoPersona` (
  `tamanoID` int(11) NOT NULL AUTO_INCREMENT,
  `tamanoCODIGO` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tamanoNOMBRE` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`tamanoID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

/*Table structure for table `TipoAfiliacion` */

DROP TABLE IF EXISTS `TipoAfiliacion`;

CREATE TABLE `TipoAfiliacion` (
  `tipoAfiliadoID` int(11) NOT NULL AUTO_INCREMENT,
  `tipoAfiliadoCODIGO` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tipoAfiliadoNOMBRE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`tipoAfiliadoID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `TiposPersonas` */

DROP TABLE IF EXISTS `TiposPersonas`;

CREATE TABLE `TiposPersonas` (
  `tipoPersonaID` int(11) NOT NULL AUTO_INCREMENT,
  `tipoPersonaCODIGO` varchar(50) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tipoPersonaNOMBRE` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`tipoPersonaID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

/*Table structure for table `VentasAnuales` */

DROP TABLE IF EXISTS `VentasAnuales`;

CREATE TABLE `VentasAnuales` (
  `ventasAnualesID` int(11) NOT NULL AUTO_INCREMENT,
  `sectorCODIGO` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ventasAnualesCODIGO` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ventasAnualesNOMBRE` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ventasAnualesINICIO` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `ventasAnualesFINAL` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`ventasAnualesID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `_departments` */

DROP TABLE IF EXISTS `_departments`;

CREATE TABLE `_departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Table structure for table `_municipalities` */

DROP TABLE IF EXISTS `_municipalities`;

CREATE TABLE `_municipalities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'identificador del municipio',
  `department_id` int(10) unsigned NOT NULL COMMENT 'identificador de la region',
  `name` varchar(50) NOT NULL COMMENT 'nombre del municipio',
  `type_id` int(10) unsigned NOT NULL COMMENT 'identificador del tipo de municipio',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `department` (`department_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1054 DEFAULT CHARSET=latin1 COMMENT='almacena los municipios de un departamaneto';

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

/*Table structure for table `alerts` */

DROP TABLE IF EXISTS `alerts`;

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `kind` int(11) NOT NULL,
  `comments` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1857 DEFAULT CHARSET=latin1;

/*Table structure for table `answers` */

DROP TABLE IF EXISTS `answers`;

CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `diagnostic_id` int(11) DEFAULT NULL COMMENT 'Si esta vinculado a un diagnostico',
  `aplication_id` int(11) DEFAULT NULL COMMENT 'Si esta vinculado a un programa',
  `variable_id` int(11) NOT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31484 DEFAULT CHARSET=latin1;

/*Table structure for table `aplications` */

DROP TABLE IF EXISTS `aplications`;

CREATE TABLE `aplications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `state` char(1) NOT NULL DEFAULT '0',
  `comments` text,
  `file` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1933 DEFAULT CHARSET=latin1;

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `text_button` varchar(200) DEFAULT NULL,
  `url` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Table structure for table `capsules` */

DROP TABLE IF EXISTS `capsules`;

CREATE TABLE `capsules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `url_video` text,
  `image` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Table structure for table `ciiu_actividades` */

DROP TABLE IF EXISTS `ciiu_actividades`;

CREATE TABLE `ciiu_actividades` (
  `ciiuActividadID` int(11) NOT NULL AUTO_INCREMENT,
  `ciiuVIGENCIA` enum('ACTIVA','DESAGREGADO','RECLASIFICADO','MODIFICADO','ELIMINADO','DESACTIVO') COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'ACTIVA',
  `ciiuActividadPADRE` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuActividadCODIGO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuActividadTITULO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuActividadDESCRIPCION` text COLLATE utf8_spanish2_ci,
  `ciiuSeccionID` int(11) DEFAULT NULL,
  `macroSectorID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ciiuActividadID`)
) ENGINE=InnoDB AUTO_INCREMENT=841 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

/*Table structure for table `ciiu_secciones` */

DROP TABLE IF EXISTS `ciiu_secciones`;

CREATE TABLE `ciiu_secciones` (
  `ciiuSeccionID` int(11) NOT NULL AUTO_INCREMENT,
  `macroSectorID` int(11) DEFAULT NULL,
  `ciiuSeccionCODIGO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuSeccionTITULO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuSeccionTITULOCORTO` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `ciiuSeccionDESCRIPCION` text COLLATE utf8_spanish2_ci,
  PRIMARY KEY (`ciiuSeccionID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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

/*Table structure for table `diagnostics` */

DROP TABLE IF EXISTS `diagnostics`;

CREATE TABLE `diagnostics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `score` float NOT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2134 DEFAULT CHARSET=latin1;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `histories` */

DROP TABLE IF EXISTS `histories`;

CREATE TABLE `histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `video_url` text,
  `image` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `leads` */

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `document` varchar(48) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(28) DEFAULT NULL,
  `description` text,
  `department` char(2) DEFAULT NULL,
  `municipality` char(4) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=377 DEFAULT CHARSET=latin1;

/*Table structure for table `links` */

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` char(1) NOT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `url` text,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `program_has_variables` */

DROP TABLE IF EXISTS `program_has_variables`;

CREATE TABLE `program_has_variables` (
  `program_id` int(11) NOT NULL,
  `variable_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `program_id` (`program_id`,`variable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `programs` */

DROP TABLE IF EXISTS `programs`;

CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `logo` text,
  `benefits` text,
  `requirements` text,
  `duration` varchar(255) DEFAULT NULL,
  `aimed_at` text,
  `objective` text,
  `determinants` text,
  `image_procedure` text,
  `required_tools` text,
  `is_virtual` char(1) DEFAULT NULL,
  `person_charge` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `telephone` varchar(48) DEFAULT NULL,
  `input_info` text,
  `website` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `programaTITULO` varchar(255) DEFAULT NULL,
  `convocatoriaFCHAPERTURA` timestamp NULL DEFAULT NULL,
  `convocatoriaFCHCIERRE` timestamp NULL DEFAULT NULL,
  `convocatoriaTIEMPOACTIVIDAD` int(11) DEFAULT NULL COMMENT 'EN MESES',
  `convocatoriaCONMATRICULA` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(48) NOT NULL,
  `h1` text,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text,
  `video_url` text,
  `data` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL,
  `value` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `stage_has_programs` */

DROP TABLE IF EXISTS `stage_has_programs`;

CREATE TABLE `stage_has_programs` (
  `stage_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `stage_id` (`stage_id`,`program_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `identification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cedula',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'apellido',
  `email` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cargo',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1998 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `variables` */

DROP TABLE IF EXISTS `variables`;

CREATE TABLE `variables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` char(1) NOT NULL,
  `values` text,
  `variable_group` char(1) DEFAULT NULL,
  `dimension` char(1) DEFAULT NULL,
  `percentage` int(3) DEFAULT NULL,
  `related_to` char(1) DEFAULT '0',
  `related_to_sells` char(1) NOT NULL DEFAULT '0',
  `program_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

/*Table structure for table `AfiliadosEmpresasCompleto` */

DROP TABLE IF EXISTS `AfiliadosEmpresasCompleto`;

/*!50001 DROP VIEW IF EXISTS `AfiliadosEmpresasCompleto` */;
/*!50001 DROP TABLE IF EXISTS `AfiliadosEmpresasCompleto` */;

/*!50001 CREATE TABLE  `AfiliadosEmpresasCompleto`(
 `id` bigint(20) ,
 `company_id` bigint(20) ,
 `EmpresaID` bigint(20) ,
 `business_name` varchar(255) ,
 `EmpresaNOMBRE` varchar(255) ,
 `description` text ,
 `nit` varchar(30) ,
 `registration_number` varchar(100) ,
 `EmpresaMATRICULA` varchar(100) ,
 `registration_date` date ,
 `registration_email` varchar(48) ,
 `size` char(1) ,
 `type_person` char(1) ,
 `sector` char(1) ,
 `anual_sales` char(1) ,
 `comercial_activity` varchar(255) ,
 `name_legal_representative` varchar(200) ,
 `affiliated` char(1) ,
 `department_id` char(4) ,
 `department_viejo` char(4) ,
 `municipality_id` char(4) ,
 `municipality_viejo` char(4) ,
 `address` text ,
 `geolocation` varchar(200) ,
 `telephone` varchar(15) ,
 `mobile` varchar(15) ,
 `website` text ,
 `social_instagram` text ,
 `social_facebook` text ,
 `social_linkedin` text ,
 `contact_person` varchar(255) ,
 `contact_position` varchar(255) ,
 `contact_email` varchar(255) ,
 `contact_phone` varchar(15) ,
 `stage_id` int(11) ,
 `update_info` char(1) ,
 `complete_diagnostic` char(1) ,
 `show_poll` char(1) ,
 `logo` text ,
 `user_id` int(11) ,
 `created_at` timestamp ,
 `updated_at` timestamp ,
 `deleted_at` timestamp ,
 `tamanoNOMBRE` varchar(255) ,
 `tipoPersonaNOMBRE` varchar(255) ,
 `sectorNOMBRE` varchar(255) ,
 `ventasAnualesNOMBRE` varchar(255) ,
 `ventasAnualesINICIO` varchar(50) ,
 `ventasAnualesFINAL` varchar(50) ,
 `tipoAfiliadoNOMBRE` varchar(255) ,
 `etapaID` int(11) ,
 `etapaRUTAC` varchar(200) ,
 `usuarioID` bigint(20) unsigned ,
 `usuarioCEDULA` varchar(100) ,
 `usuarioNOMBRE` varchar(255) ,
 `usuarioAPELLIDO` varchar(200) ,
 `usuarioEMAIL` varchar(190) ,
 `departamentoID` int(11) ,
 `departamentoCODIGO` varchar(10) ,
 `departamentoNOMBRE` varchar(255) ,
 `departamentoNOMBREOFICIAL` varchar(255) ,
 `municipioID` int(11) ,
 `municipioCODIGO` varchar(50) ,
 `municipioCODIGODANE` varchar(50) ,
 `municipioTITULO` varchar(255) ,
 `municipioNOMBRE` varchar(255) ,
 `municipioNOMBREOFICIAL` varchar(255) ,
 `regionID` int(11) ,
 `paisID` int(11) 
)*/;

/*Table structure for table `AfiliadosInscriptosXProgramas` */

DROP TABLE IF EXISTS `AfiliadosInscriptosXProgramas`;

/*!50001 DROP VIEW IF EXISTS `AfiliadosInscriptosXProgramas` */;
/*!50001 DROP TABLE IF EXISTS `AfiliadosInscriptosXProgramas` */;

/*!50001 CREATE TABLE  `AfiliadosInscriptosXProgramas`(
 `ProgramaID` int(11) ,
 `ProgramaNOMBRE` varchar(255) ,
 `ProgramaCONVOCATORIA` text ,
 `ProgramaELIMINADO` timestamp ,
 `InscripcionID` int(11) ,
 `InscripcionESTADOID` char(1) ,
 `InscripcionCOMENTARIO` text ,
 `InscripcionFECHA` timestamp ,
 `InscripcionACTUALIZACION` timestamp ,
 `InscripcionELIMINADA` timestamp ,
 `InscripcionESTADO` varchar(255) ,
 `InscripcionESTADONOMBRE` varchar(255) ,
 `InscripcionEMPRESAID` int(11) ,
 `company_id` bigint(20) ,
 `EmpresaID` bigint(20) ,
 `business_name` varchar(255) ,
 `EmpresaNOMBRE` varchar(255) ,
 `description` text ,
 `nit` varchar(30) ,
 `registration_number` varchar(100) ,
 `EmpresaMATRICULA` varchar(100) 
)*/;

/*Table structure for table `AfiliadosProgramasXInscriptos` */

DROP TABLE IF EXISTS `AfiliadosProgramasXInscriptos`;

/*!50001 DROP VIEW IF EXISTS `AfiliadosProgramasXInscriptos` */;
/*!50001 DROP TABLE IF EXISTS `AfiliadosProgramasXInscriptos` */;

/*!50001 CREATE TABLE  `AfiliadosProgramasXInscriptos`(
 `id` bigint(20) ,
 `company_id` bigint(20) ,
 `EmpresaID` bigint(20) ,
 `business_name` varchar(255) ,
 `EmpresaNOMBRE` varchar(255) ,
 `description` text ,
 `nit` varchar(30) ,
 `registration_number` varchar(100) ,
 `EmpresaMATRICULA` varchar(100) ,
 `registration_date` date ,
 `registration_email` varchar(48) ,
 `size` char(1) ,
 `type_person` char(1) ,
 `sector` char(1) ,
 `anual_sales` char(1) ,
 `comercial_activity` varchar(255) ,
 `name_legal_representative` varchar(200) ,
 `affiliated` char(1) ,
 `department_id` char(4) ,
 `department_viejo` char(4) ,
 `municipality_id` char(4) ,
 `municipality_viejo` char(4) ,
 `address` text ,
 `geolocation` varchar(200) ,
 `telephone` varchar(15) ,
 `mobile` varchar(15) ,
 `website` text ,
 `social_instagram` text ,
 `social_facebook` text ,
 `social_linkedin` text ,
 `contact_person` varchar(255) ,
 `contact_position` varchar(255) ,
 `contact_email` varchar(255) ,
 `contact_phone` varchar(15) ,
 `stage_id` int(11) ,
 `update_info` char(1) ,
 `complete_diagnostic` char(1) ,
 `show_poll` char(1) ,
 `logo` text ,
 `user_id` int(11) ,
 `created_at` timestamp ,
 `updated_at` timestamp ,
 `deleted_at` timestamp ,
 `tamanoNOMBRE` varchar(255) ,
 `tipoPersonaNOMBRE` varchar(255) ,
 `sectorNOMBRE` varchar(255) ,
 `ventasAnualesNOMBRE` varchar(255) ,
 `ventasAnualesINICIO` varchar(50) ,
 `ventasAnualesFINAL` varchar(50) ,
 `tipoAfiliadoNOMBRE` varchar(255) ,
 `etapaID` int(11) ,
 `etapaRUTAC` varchar(200) ,
 `usuarioID` bigint(20) unsigned ,
 `usuarioCEDULA` varchar(100) ,
 `usuarioNOMBRE` varchar(255) ,
 `usuarioAPELLIDO` varchar(200) ,
 `usuarioEMAIL` varchar(190) ,
 `departamentoID` int(11) ,
 `departamentoCODIGO` varchar(10) ,
 `departamentoNOMBRE` varchar(255) ,
 `departamentoNOMBREOFICIAL` varchar(255) ,
 `municipioID` int(11) ,
 `municipioCODIGO` varchar(50) ,
 `municipioCODIGODANE` varchar(50) ,
 `municipioTITULO` varchar(255) ,
 `municipioNOMBRE` varchar(255) ,
 `municipioNOMBREOFICIAL` varchar(255) ,
 `regionID` int(11) ,
 `paisID` int(11) ,
 `ProgramaID` int(11) ,
 `ProgramaNOMBRE` varchar(255) ,
 `InscripcionID` int(11) ,
 `InscripcionESTADOID` char(1) ,
 `InscripcionESTADONOMBRE` varchar(255) 
)*/;

/*Table structure for table `DiagnosticosXEmpresas` */

DROP TABLE IF EXISTS `DiagnosticosXEmpresas`;

/*!50001 DROP VIEW IF EXISTS `DiagnosticosXEmpresas` */;
/*!50001 DROP TABLE IF EXISTS `DiagnosticosXEmpresas` */;

/*!50001 CREATE TABLE  `DiagnosticosXEmpresas`(
 `diagnosticoID` int(11) ,
 `score` float ,
 `diagnosticoRESULTADO` float ,
 `etapaCALCULADAID` int(11) ,
 `etapaCALCULADANOMBRE` varchar(200) ,
 `diagnosticoFCHCREADO` timestamp ,
 `diagnosticoFCHACTUALIZADO` timestamp ,
 `company_id` int(11) ,
 `EmpresaID` bigint(20) ,
 `business_name` varchar(255) ,
 `EmpresaNOMBRE` varchar(255) ,
 `description` text ,
 `nit` varchar(30) ,
 `registration_number` varchar(100) ,
 `EmpresaMATRICULA` varchar(100) ,
 `complete_diagnostic` char(1) ,
 `stage_id` int(11) ,
 `etapaID` int(11) ,
 `etapaRUTAC` varchar(200) ,
 `user_id` int(11) 
)*/;

/*Table structure for table `EmpresasCompleto` */

DROP TABLE IF EXISTS `EmpresasCompleto`;

/*!50001 DROP VIEW IF EXISTS `EmpresasCompleto` */;
/*!50001 DROP TABLE IF EXISTS `EmpresasCompleto` */;

/*!50001 CREATE TABLE  `EmpresasCompleto`(
 `empresaID` bigint(20) ,
 `empresaRAZONSOCIAL` varchar(255) ,
 `empresaDESCRIPCION` text ,
 `empresaNIT` varchar(30) ,
 `empresaMATRICULA` varchar(100) ,
 `empresaFECHADEMATRICULA` date ,
 `empresaEMAIL` varchar(48) ,
 `empresaTAMANOCODIGO` char(1) ,
 `empresaTIPODEPERSONAID` char(1) ,
 `empresaMACROSECTORID` char(1) ,
 `empresaVENTASANUALESID` char(1) ,
 `empresaCIIU` varchar(255) ,
 `empresaREPRESESNTANTELEGAL` varchar(200) ,
 `empresaAFILIADOID` char(1) ,
 `empresaDEPARTAMENTOID` char(4) ,
 `empresaDEPARTAMENTOVIEJOID` char(4) ,
 `empresaMUNICIPIOID` char(4) ,
 `empresaMUNICIPIOVIEJOID` char(4) ,
 `empresaDIRECCION` text ,
 `empresaGEOLOCALIZACION` varchar(200) ,
 `empresaTELEFONO` varchar(15) ,
 `empresaCELULAR` varchar(15) ,
 `empresaSITIOWEB` text ,
 `empresaINSTAGRAM` text ,
 `empresaFACEBOOK` text ,
 `empresaLINKEDIN` text ,
 `empresaPERSONACONTACTO` varchar(255) ,
 `empresaCARGOCONTACTO` varchar(255) ,
 `empresaEMAILCONTACTO` varchar(255) ,
 `empresaTELEFONOCONTACTO` varchar(15) ,
 `empresaETAPAID` int(11) ,
 `empresaDATOSCONTACTOCOMPLETO` char(1) ,
 `empresaDIAGNOSTICOCOMPLETO` char(1) ,
 `empresaLOGO` text ,
 `empresaUSUARIOID` int(11) ,
 `empresaFECHADECREACIONREGISTRORUTAC` timestamp ,
 `empresaFECHADEACTUALIZACIONREGISTRORUTAC` timestamp ,
 `empresaFECHADEELIMINACIONREGISTRORUTAC` timestamp ,
 `tamanoID` int(11) ,
 `tamanoNOMBRE` varchar(255) ,
 `tipopersonaNOMBRE` varchar(255) ,
 `sectorNOMBRE` varchar(255) ,
 `ventasAnualesNOMBRE` varchar(255) ,
 `ventasAnualesINICIO` varchar(50) ,
 `ventasAnualesFINAL` varchar(50) ,
 `tipoAfiliadoNOMBRE` varchar(255) ,
 `etapaID` int(11) ,
 `etapaRUTAC` varchar(200) ,
 `usuarioID` bigint(20) unsigned ,
 `usuarioCEDULA` varchar(100) ,
 `usuarioNOMBRE` varchar(255) ,
 `usuarioAPELLIDO` varchar(200) ,
 `usuarioEMAIL` varchar(190) ,
 `departamentoID` int(11) ,
 `departamentoCODIGO` varchar(10) ,
 `departamentoNOMBRE` varchar(255) ,
 `departamentoNOMBREOFICIAL` varchar(255) ,
 `municipioID` int(11) ,
 `municipioCODIGO` varchar(50) ,
 `municipioCODIGODANE` varchar(50) ,
 `municipioNOMBRE` varchar(255) ,
 `municipioNOMBREOFICIAL` varchar(255) ,
 `regionID` int(11) ,
 `paisID` int(11) 
)*/;

/*Table structure for table `EmpresasUltimoDiagnostico` */

DROP TABLE IF EXISTS `EmpresasUltimoDiagnostico`;

/*!50001 DROP VIEW IF EXISTS `EmpresasUltimoDiagnostico` */;
/*!50001 DROP TABLE IF EXISTS `EmpresasUltimoDiagnostico` */;

/*!50001 CREATE TABLE  `EmpresasUltimoDiagnostico`(
 `empresaID` bigint(20) ,
 `empresaRAZONSOCIAL` varchar(255) ,
 `empresaNIT` varchar(30) ,
 `empresaMATRICULA` varchar(100) ,
 `empresaDIAGNOSTICOCOMPLETO` char(1) ,
 `etapaCALCULADAID` int(11) ,
 `etapaCALCULADANOMBRE` varchar(200) ,
 `diagnosticoID` int(11) ,
 `diagnosticoPUNTAJE` float ,
 `diagnosticoRESULTADO` float ,
 `diagnosticoFCHCREADO` timestamp ,
 `diagnosticoFCHACTUALIZADO` timestamp ,
 `company_id` int(11) 
)*/;

/*Table structure for table `InscriptosXProgramas` */

DROP TABLE IF EXISTS `InscriptosXProgramas`;

/*!50001 DROP VIEW IF EXISTS `InscriptosXProgramas` */;
/*!50001 DROP TABLE IF EXISTS `InscriptosXProgramas` */;

/*!50001 CREATE TABLE  `InscriptosXProgramas`(
 `ProgramaID` int(11) ,
 `ProgramaNOMBRE` varchar(255) ,
 `ProgramaTITULO` varchar(255) ,
 `ProgramaCONVOCATORIA` text ,
 `ProgramaELIMINADO` timestamp ,
 `InscripcionID` int(11) ,
 `InscripcionESTADOID` char(1) ,
 `InscripcionCOMENTARIO` text ,
 `InscripcionFECHA` timestamp ,
 `InscripcionACTUALIZACION` timestamp ,
 `InscripcionELIMINADA` timestamp ,
 `InscripcionESTADO` varchar(255) ,
 `InscripcionESTADONOMBRE` varchar(255) ,
 `InscripcionEMPRESAID` int(11) ,
 `company_id` bigint(20) ,
 `EmpresaID` bigint(20) ,
 `business_name` varchar(255) ,
 `EmpresaNOMBRE` varchar(255) ,
 `description` text ,
 `nit` varchar(30) ,
 `registration_number` varchar(100) ,
 `EmpresaMATRICULA` varchar(100) 
)*/;

/*Table structure for table `PreguntasConOpcionesRespuesta` */

DROP TABLE IF EXISTS `PreguntasConOpcionesRespuesta`;

/*!50001 DROP VIEW IF EXISTS `PreguntasConOpcionesRespuesta` */;
/*!50001 DROP TABLE IF EXISTS `PreguntasConOpcionesRespuesta` */;

/*!50001 CREATE TABLE  `PreguntasConOpcionesRespuesta`(
 `preguntaID` int(11) ,
 `preguntaTITULO` varchar(255) ,
 `respuestaOPCIONvalor1` longtext ,
 `respuestaOPCIONporcentaje1` decimal(5,2) ,
 `respuestaOPCIONvalor2` longtext ,
 `respuestaOPCIONporcentaje2` decimal(5,2) ,
 `respuestaOPCIONvalor3` longtext ,
 `respuestaOPCIONporcentaje3` decimal(5,2) ,
 `respuestaOPCIONvalor4` longtext ,
 `respuestaOPCIONporcentaje4` decimal(5,2) ,
 `respuestaOPCIONvalor5` longtext ,
 `respuestaOPCIONporcentaje5` decimal(5,2) ,
 `respuestaOPCIONvalor6` longtext ,
 `respuestaOPCIONporcentaje6` decimal(5,2) ,
 `values` text 
)*/;

/*Table structure for table `departments` */

DROP TABLE IF EXISTS `departments`;

/*!50001 DROP VIEW IF EXISTS `departments` */;
/*!50001 DROP TABLE IF EXISTS `departments` */;

/*!50001 CREATE TABLE  `departments`(
 `id` int(11) ,
 `name` varchar(255) ,
 `departamentoID` int(11) ,
 `departamentoCODIGO` varchar(10) ,
 `departamentoNOMBRE` varchar(255) ,
 `departamentoNOMBREOFICIAL` varchar(255) ,
 `departamentoCAPITAL` int(11) ,
 `departamentoSUPERFICIE` decimal(10,2) ,
 `departamentoMUNICIPIOS` int(11) ,
 `departamentoCODIGOCGN` varchar(50) ,
 `paisID` int(11) ,
 `regionID` int(11) 
)*/;

/*Table structure for table `municipalities` */

DROP TABLE IF EXISTS `municipalities`;

/*!50001 DROP VIEW IF EXISTS `municipalities` */;
/*!50001 DROP TABLE IF EXISTS `municipalities` */;

/*!50001 CREATE TABLE  `municipalities`(
 `id` int(11) ,
 `department_id` int(11) ,
 `name` varchar(255) ,
 `municipioID` int(11) ,
 `municipioCODIGO` varchar(50) ,
 `municipioCODIGODANE` varchar(50) ,
 `municipioTITULO` varchar(255) ,
 `municipioNOMBREOFICIAL` varchar(255) ,
 `municipioCONTABILIDAD` varchar(50) ,
 `departamentoID` int(11) ,
 `municipioESTADISTICAS` enum('SI','NO') 
)*/;

/*View structure for view AfiliadosEmpresasCompleto */

/*!50001 DROP TABLE IF EXISTS `AfiliadosEmpresasCompleto` */;
/*!50001 DROP VIEW IF EXISTS `AfiliadosEmpresasCompleto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `AfiliadosEmpresasCompleto` AS (select `companies`.`id` AS `id`,`companies`.`id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA`,`companies`.`registration_date` AS `registration_date`,`companies`.`registration_email` AS `registration_email`,`companies`.`size` AS `size`,`companies`.`type_person` AS `type_person`,`companies`.`sector` AS `sector`,`companies`.`anual_sales` AS `anual_sales`,`companies`.`comercial_activity` AS `comercial_activity`,`companies`.`name_legal_representative` AS `name_legal_representative`,`companies`.`affiliated` AS `affiliated`,`companies`.`department_id` AS `department_id`,`companies`.`department_viejo` AS `department_viejo`,`companies`.`municipality_id` AS `municipality_id`,`companies`.`municipality_viejo` AS `municipality_viejo`,`companies`.`address` AS `address`,`companies`.`geolocation` AS `geolocation`,`companies`.`telephone` AS `telephone`,`companies`.`mobile` AS `mobile`,`companies`.`website` AS `website`,`companies`.`social_instagram` AS `social_instagram`,`companies`.`social_facebook` AS `social_facebook`,`companies`.`social_linkedin` AS `social_linkedin`,`companies`.`contact_person` AS `contact_person`,`companies`.`contact_position` AS `contact_position`,`companies`.`contact_email` AS `contact_email`,`companies`.`contact_phone` AS `contact_phone`,`companies`.`stage_id` AS `stage_id`,`companies`.`update_info` AS `update_info`,`companies`.`complete_diagnostic` AS `complete_diagnostic`,`companies`.`show_poll` AS `show_poll`,`companies`.`logo` AS `logo`,`companies`.`user_id` AS `user_id`,`companies`.`created_at` AS `created_at`,`companies`.`updated_at` AS `updated_at`,`companies`.`deleted_at` AS `deleted_at`,`TamanoPersona`.`tamanoNOMBRE` AS `tamanoNOMBRE`,`TiposPersonas`.`tipoPersonaNOMBRE` AS `tipoPersonaNOMBRE`,`MacroSectores`.`sectorNOMBRE` AS `sectorNOMBRE`,`VentasAnuales`.`ventasAnualesNOMBRE` AS `ventasAnualesNOMBRE`,`VentasAnuales`.`ventasAnualesINICIO` AS `ventasAnualesINICIO`,`VentasAnuales`.`ventasAnualesFINAL` AS `ventasAnualesFINAL`,`TipoAfiliacion`.`tipoAfiliadoNOMBRE` AS `tipoAfiliadoNOMBRE`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`users`.`id` AS `usuarioID`,`users`.`identification` AS `usuarioCEDULA`,`users`.`name` AS `usuarioNOMBRE`,`users`.`lastname` AS `usuarioAPELLIDO`,`users`.`email` AS `usuarioEMAIL`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioTITULO`,`Municipios`.`municipioTITULO` AS `municipioNOMBRE`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Departamentos`.`regionID` AS `regionID`,`Departamentos`.`paisID` AS `paisID` from (((((((((`companies` left join `TamanoPersona` on((`companies`.`size` = `TamanoPersona`.`tamanoCODIGO`))) left join `TiposPersonas` on((`companies`.`type_person` = `TiposPersonas`.`tipoPersonaCODIGO`))) left join `MacroSectores` on((`companies`.`sector` = `MacroSectores`.`sectorCODIGO`))) left join `VentasAnuales` on(((`companies`.`sector` = `VentasAnuales`.`sectorCODIGO`) and (`companies`.`anual_sales` = `VentasAnuales`.`ventasAnualesCODIGO`)))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) left join `TipoAfiliacion` on((`companies`.`affiliated` = `TipoAfiliacion`.`tipoAfiliadoCODIGO`))) left join `users` on((`companies`.`user_id` = `users`.`id`))) left join `Departamentos` on((`companies`.`department_id` = `Departamentos`.`departamentoID`))) left join `Municipios` on((`companies`.`municipality_id` = `Municipios`.`municipioID`))) where ((`companies`.`affiliated` = 1) and (`companies`.`id` <> 6))) */;

/*View structure for view AfiliadosInscriptosXProgramas */

/*!50001 DROP TABLE IF EXISTS `AfiliadosInscriptosXProgramas` */;
/*!50001 DROP VIEW IF EXISTS `AfiliadosInscriptosXProgramas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `AfiliadosInscriptosXProgramas` AS (select `programs`.`id` AS `ProgramaID`,`programs`.`name` AS `ProgramaNOMBRE`,`programs`.`aimed_at` AS `ProgramaCONVOCATORIA`,`programs`.`deleted_at` AS `ProgramaELIMINADO`,`aplications`.`id` AS `InscripcionID`,`aplications`.`state` AS `InscripcionESTADOID`,`aplications`.`comments` AS `InscripcionCOMENTARIO`,`aplications`.`created_at` AS `InscripcionFECHA`,`aplications`.`updated_at` AS `InscripcionACTUALIZACION`,`aplications`.`deleted_at` AS `InscripcionELIMINADA`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADO`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADONOMBRE`,`aplications`.`company_id` AS `InscripcionEMPRESAID`,`companies`.`id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA` from (((`programs` left join `aplications` on((`programs`.`id` = `aplications`.`program_id`))) left join `companies` on((`aplications`.`company_id` = `companies`.`id`))) left join `InscripcionesEstados` on((`aplications`.`state` = `InscripcionesEstados`.`inscripcionEstadoID`))) where (isnull(`programs`.`deleted_at`) and (`aplications`.`company_id` <> 6) and (`companies`.`affiliated` = 1)) order by `programs`.`name`) */;

/*View structure for view AfiliadosProgramasXInscriptos */

/*!50001 DROP TABLE IF EXISTS `AfiliadosProgramasXInscriptos` */;
/*!50001 DROP VIEW IF EXISTS `AfiliadosProgramasXInscriptos` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `AfiliadosProgramasXInscriptos` AS (select `AfiliadosEmpresasCompleto`.`id` AS `id`,`AfiliadosEmpresasCompleto`.`company_id` AS `company_id`,`AfiliadosEmpresasCompleto`.`EmpresaID` AS `EmpresaID`,`AfiliadosEmpresasCompleto`.`business_name` AS `business_name`,`AfiliadosEmpresasCompleto`.`EmpresaNOMBRE` AS `EmpresaNOMBRE`,`AfiliadosEmpresasCompleto`.`description` AS `description`,`AfiliadosEmpresasCompleto`.`nit` AS `nit`,`AfiliadosEmpresasCompleto`.`registration_number` AS `registration_number`,`AfiliadosEmpresasCompleto`.`EmpresaMATRICULA` AS `EmpresaMATRICULA`,`AfiliadosEmpresasCompleto`.`registration_date` AS `registration_date`,`AfiliadosEmpresasCompleto`.`registration_email` AS `registration_email`,`AfiliadosEmpresasCompleto`.`size` AS `size`,`AfiliadosEmpresasCompleto`.`type_person` AS `type_person`,`AfiliadosEmpresasCompleto`.`sector` AS `sector`,`AfiliadosEmpresasCompleto`.`anual_sales` AS `anual_sales`,`AfiliadosEmpresasCompleto`.`comercial_activity` AS `comercial_activity`,`AfiliadosEmpresasCompleto`.`name_legal_representative` AS `name_legal_representative`,`AfiliadosEmpresasCompleto`.`affiliated` AS `affiliated`,`AfiliadosEmpresasCompleto`.`department_id` AS `department_id`,`AfiliadosEmpresasCompleto`.`department_viejo` AS `department_viejo`,`AfiliadosEmpresasCompleto`.`municipality_id` AS `municipality_id`,`AfiliadosEmpresasCompleto`.`municipality_viejo` AS `municipality_viejo`,`AfiliadosEmpresasCompleto`.`address` AS `address`,`AfiliadosEmpresasCompleto`.`geolocation` AS `geolocation`,`AfiliadosEmpresasCompleto`.`telephone` AS `telephone`,`AfiliadosEmpresasCompleto`.`mobile` AS `mobile`,`AfiliadosEmpresasCompleto`.`website` AS `website`,`AfiliadosEmpresasCompleto`.`social_instagram` AS `social_instagram`,`AfiliadosEmpresasCompleto`.`social_facebook` AS `social_facebook`,`AfiliadosEmpresasCompleto`.`social_linkedin` AS `social_linkedin`,`AfiliadosEmpresasCompleto`.`contact_person` AS `contact_person`,`AfiliadosEmpresasCompleto`.`contact_position` AS `contact_position`,`AfiliadosEmpresasCompleto`.`contact_email` AS `contact_email`,`AfiliadosEmpresasCompleto`.`contact_phone` AS `contact_phone`,`AfiliadosEmpresasCompleto`.`stage_id` AS `stage_id`,`AfiliadosEmpresasCompleto`.`update_info` AS `update_info`,`AfiliadosEmpresasCompleto`.`complete_diagnostic` AS `complete_diagnostic`,`AfiliadosEmpresasCompleto`.`show_poll` AS `show_poll`,`AfiliadosEmpresasCompleto`.`logo` AS `logo`,`AfiliadosEmpresasCompleto`.`user_id` AS `user_id`,`AfiliadosEmpresasCompleto`.`created_at` AS `created_at`,`AfiliadosEmpresasCompleto`.`updated_at` AS `updated_at`,`AfiliadosEmpresasCompleto`.`deleted_at` AS `deleted_at`,`AfiliadosEmpresasCompleto`.`tamanoNOMBRE` AS `tamanoNOMBRE`,`AfiliadosEmpresasCompleto`.`tipoPersonaNOMBRE` AS `tipoPersonaNOMBRE`,`AfiliadosEmpresasCompleto`.`sectorNOMBRE` AS `sectorNOMBRE`,`AfiliadosEmpresasCompleto`.`ventasAnualesNOMBRE` AS `ventasAnualesNOMBRE`,`AfiliadosEmpresasCompleto`.`ventasAnualesINICIO` AS `ventasAnualesINICIO`,`AfiliadosEmpresasCompleto`.`ventasAnualesFINAL` AS `ventasAnualesFINAL`,`AfiliadosEmpresasCompleto`.`tipoAfiliadoNOMBRE` AS `tipoAfiliadoNOMBRE`,`AfiliadosEmpresasCompleto`.`etapaID` AS `etapaID`,`AfiliadosEmpresasCompleto`.`etapaRUTAC` AS `etapaRUTAC`,`AfiliadosEmpresasCompleto`.`usuarioID` AS `usuarioID`,`AfiliadosEmpresasCompleto`.`usuarioCEDULA` AS `usuarioCEDULA`,`AfiliadosEmpresasCompleto`.`usuarioNOMBRE` AS `usuarioNOMBRE`,`AfiliadosEmpresasCompleto`.`usuarioAPELLIDO` AS `usuarioAPELLIDO`,`AfiliadosEmpresasCompleto`.`usuarioEMAIL` AS `usuarioEMAIL`,`AfiliadosEmpresasCompleto`.`departamentoID` AS `departamentoID`,`AfiliadosEmpresasCompleto`.`departamentoCODIGO` AS `departamentoCODIGO`,`AfiliadosEmpresasCompleto`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`AfiliadosEmpresasCompleto`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`AfiliadosEmpresasCompleto`.`municipioID` AS `municipioID`,`AfiliadosEmpresasCompleto`.`municipioCODIGO` AS `municipioCODIGO`,`AfiliadosEmpresasCompleto`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`AfiliadosEmpresasCompleto`.`municipioTITULO` AS `municipioTITULO`,`AfiliadosEmpresasCompleto`.`municipioNOMBRE` AS `municipioNOMBRE`,`AfiliadosEmpresasCompleto`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`AfiliadosEmpresasCompleto`.`regionID` AS `regionID`,`AfiliadosEmpresasCompleto`.`paisID` AS `paisID`,`AfiliadosInscriptosXProgramas`.`ProgramaID` AS `ProgramaID`,`AfiliadosInscriptosXProgramas`.`ProgramaNOMBRE` AS `ProgramaNOMBRE`,`AfiliadosInscriptosXProgramas`.`InscripcionID` AS `InscripcionID`,`AfiliadosInscriptosXProgramas`.`InscripcionESTADOID` AS `InscripcionESTADOID`,`AfiliadosInscriptosXProgramas`.`InscripcionESTADONOMBRE` AS `InscripcionESTADONOMBRE` from (`AfiliadosEmpresasCompleto` left join `AfiliadosInscriptosXProgramas` on((`AfiliadosEmpresasCompleto`.`company_id` = `AfiliadosInscriptosXProgramas`.`company_id`)))) */;

/*View structure for view DiagnosticosXEmpresas */

/*!50001 DROP TABLE IF EXISTS `DiagnosticosXEmpresas` */;
/*!50001 DROP VIEW IF EXISTS `DiagnosticosXEmpresas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `DiagnosticosXEmpresas` AS (select `diagnostics`.`id` AS `diagnosticoID`,`diagnostics`.`score` AS `score`,`diagnostics`.`score` AS `diagnosticoRESULTADO`,`etapaCALCULADA`.`id` AS `etapaCALCULADAID`,`etapaCALCULADA`.`name` AS `etapaCALCULADANOMBRE`,`diagnostics`.`created_at` AS `diagnosticoFCHCREADO`,`diagnostics`.`updated_at` AS `diagnosticoFCHACTUALIZADO`,`diagnostics`.`company_id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA`,`companies`.`complete_diagnostic` AS `complete_diagnostic`,`companies`.`stage_id` AS `stage_id`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`companies`.`user_id` AS `user_id` from ((`companies` left join (`diagnostics` left join `stages` `etapaCALCULADA` on((`diagnostics`.`score` between `etapaCALCULADA`.`score_inicial` and `etapaCALCULADA`.`score_final`))) on((`diagnostics`.`company_id` = `companies`.`id`))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) where (`companies`.`id` <> 6)) */;

/*View structure for view EmpresasCompleto */

/*!50001 DROP TABLE IF EXISTS `EmpresasCompleto` */;
/*!50001 DROP VIEW IF EXISTS `EmpresasCompleto` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `EmpresasCompleto` AS (select `companies`.`id` AS `empresaID`,`companies`.`business_name` AS `empresaRAZONSOCIAL`,`companies`.`description` AS `empresaDESCRIPCION`,`companies`.`nit` AS `empresaNIT`,`companies`.`registration_number` AS `empresaMATRICULA`,`companies`.`registration_date` AS `empresaFECHADEMATRICULA`,`companies`.`registration_email` AS `empresaEMAIL`,`companies`.`size` AS `empresaTAMANOCODIGO`,`companies`.`type_person` AS `empresaTIPODEPERSONAID`,`companies`.`sector` AS `empresaMACROSECTORID`,`companies`.`anual_sales` AS `empresaVENTASANUALESID`,`companies`.`comercial_activity` AS `empresaCIIU`,`companies`.`name_legal_representative` AS `empresaREPRESESNTANTELEGAL`,`companies`.`affiliated` AS `empresaAFILIADOID`,`companies`.`department_id` AS `empresaDEPARTAMENTOID`,`companies`.`department_viejo` AS `empresaDEPARTAMENTOVIEJOID`,`companies`.`municipality_id` AS `empresaMUNICIPIOID`,`companies`.`municipality_viejo` AS `empresaMUNICIPIOVIEJOID`,`companies`.`address` AS `empresaDIRECCION`,`companies`.`geolocation` AS `empresaGEOLOCALIZACION`,`companies`.`telephone` AS `empresaTELEFONO`,`companies`.`mobile` AS `empresaCELULAR`,`companies`.`website` AS `empresaSITIOWEB`,`companies`.`social_instagram` AS `empresaINSTAGRAM`,`companies`.`social_facebook` AS `empresaFACEBOOK`,`companies`.`social_linkedin` AS `empresaLINKEDIN`,`companies`.`contact_person` AS `empresaPERSONACONTACTO`,`companies`.`contact_position` AS `empresaCARGOCONTACTO`,`companies`.`contact_email` AS `empresaEMAILCONTACTO`,`companies`.`contact_phone` AS `empresaTELEFONOCONTACTO`,`companies`.`stage_id` AS `empresaETAPAID`,`companies`.`update_info` AS `empresaDATOSCONTACTOCOMPLETO`,`companies`.`complete_diagnostic` AS `empresaDIAGNOSTICOCOMPLETO`,`companies`.`logo` AS `empresaLOGO`,`companies`.`user_id` AS `empresaUSUARIOID`,`companies`.`created_at` AS `empresaFECHADECREACIONREGISTRORUTAC`,`companies`.`updated_at` AS `empresaFECHADEACTUALIZACIONREGISTRORUTAC`,`companies`.`deleted_at` AS `empresaFECHADEELIMINACIONREGISTRORUTAC`,`TamanoPersona`.`tamanoID` AS `tamanoID`,`TamanoPersona`.`tamanoNOMBRE` AS `tamanoNOMBRE`,`TiposPersonas`.`tipoPersonaNOMBRE` AS `tipopersonaNOMBRE`,`MacroSectores`.`sectorNOMBRE` AS `sectorNOMBRE`,`VentasAnuales`.`ventasAnualesNOMBRE` AS `ventasAnualesNOMBRE`,`VentasAnuales`.`ventasAnualesINICIO` AS `ventasAnualesINICIO`,`VentasAnuales`.`ventasAnualesFINAL` AS `ventasAnualesFINAL`,`TipoAfiliacion`.`tipoAfiliadoNOMBRE` AS `tipoAfiliadoNOMBRE`,`stages`.`id` AS `etapaID`,`stages`.`name` AS `etapaRUTAC`,`users`.`id` AS `usuarioID`,`users`.`identification` AS `usuarioCEDULA`,`users`.`name` AS `usuarioNOMBRE`,`users`.`lastname` AS `usuarioAPELLIDO`,`users`.`email` AS `usuarioEMAIL`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioNOMBRE`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Departamentos`.`regionID` AS `regionID`,`Departamentos`.`paisID` AS `paisID` from (((((((((`companies` left join `TamanoPersona` on((`companies`.`size` = `TamanoPersona`.`tamanoCODIGO`))) left join `TiposPersonas` on((`companies`.`type_person` = `TiposPersonas`.`tipoPersonaCODIGO`))) left join `MacroSectores` on((`companies`.`sector` = `MacroSectores`.`sectorCODIGO`))) left join `VentasAnuales` on(((`companies`.`sector` = `VentasAnuales`.`sectorCODIGO`) and (`companies`.`anual_sales` = `VentasAnuales`.`ventasAnualesCODIGO`)))) left join `stages` on((`companies`.`stage_id` = `stages`.`id`))) left join `TipoAfiliacion` on((`companies`.`affiliated` = `TipoAfiliacion`.`tipoAfiliadoCODIGO`))) left join `users` on((`companies`.`user_id` = `users`.`id`))) left join `Departamentos` on((`companies`.`department_id` = `Departamentos`.`departamentoID`))) left join `Municipios` on((`companies`.`municipality_id` = `Municipios`.`municipioID`))) where (`companies`.`id` <> 6)) */;

/*View structure for view EmpresasUltimoDiagnostico */

/*!50001 DROP TABLE IF EXISTS `EmpresasUltimoDiagnostico` */;
/*!50001 DROP VIEW IF EXISTS `EmpresasUltimoDiagnostico` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `EmpresasUltimoDiagnostico` AS (select `EMPRESAS`.`id` AS `empresaID`,`EMPRESAS`.`business_name` AS `empresaRAZONSOCIAL`,`EMPRESAS`.`nit` AS `empresaNIT`,`EMPRESAS`.`registration_number` AS `empresaMATRICULA`,`EMPRESAS`.`complete_diagnostic` AS `empresaDIAGNOSTICOCOMPLETO`,`etapaCALCULADA`.`id` AS `etapaCALCULADAID`,`etapaCALCULADA`.`name` AS `etapaCALCULADANOMBRE`,`DIAGNOSTICO`.`id` AS `diagnosticoID`,`DIAGNOSTICO`.`score` AS `diagnosticoPUNTAJE`,`DIAGNOSTICO`.`score` AS `diagnosticoRESULTADO`,`DIAGNOSTICO`.`created_at` AS `diagnosticoFCHCREADO`,`DIAGNOSTICO`.`updated_at` AS `diagnosticoFCHACTUALIZADO`,`DIAGNOSTICO`.`company_id` AS `company_id` from ((`companies` `EMPRESAS` left join `diagnostics` `DIAGNOSTICO` on(((`EMPRESAS`.`id` = `DIAGNOSTICO`.`company_id`) and (`DIAGNOSTICO`.`id` = (select max(`diagnostics`.`id`) from (`companies` left join `diagnostics` on((`companies`.`id` = `diagnostics`.`company_id`))) where (`companies`.`id` = `EMPRESAS`.`id`)))))) left join `stages` `etapaCALCULADA` on((`DIAGNOSTICO`.`score` between `etapaCALCULADA`.`score_inicial` and `etapaCALCULADA`.`score_final`))) where (`EMPRESAS`.`id` <> 6)) */;

/*View structure for view InscriptosXProgramas */

/*!50001 DROP TABLE IF EXISTS `InscriptosXProgramas` */;
/*!50001 DROP VIEW IF EXISTS `InscriptosXProgramas` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `InscriptosXProgramas` AS (select `programs`.`id` AS `ProgramaID`,`programs`.`name` AS `ProgramaNOMBRE`,`programs`.`programaTITULO` AS `ProgramaTITULO`,`programs`.`aimed_at` AS `ProgramaCONVOCATORIA`,`programs`.`deleted_at` AS `ProgramaELIMINADO`,`aplications`.`id` AS `InscripcionID`,`aplications`.`state` AS `InscripcionESTADOID`,`aplications`.`comments` AS `InscripcionCOMENTARIO`,`aplications`.`created_at` AS `InscripcionFECHA`,`aplications`.`updated_at` AS `InscripcionACTUALIZACION`,`aplications`.`deleted_at` AS `InscripcionELIMINADA`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADO`,`InscripcionesEstados`.`inscripcionEstadoNOMBRE` AS `InscripcionESTADONOMBRE`,`aplications`.`company_id` AS `InscripcionEMPRESAID`,`companies`.`id` AS `company_id`,`companies`.`id` AS `EmpresaID`,`companies`.`business_name` AS `business_name`,`companies`.`business_name` AS `EmpresaNOMBRE`,`companies`.`description` AS `description`,`companies`.`nit` AS `nit`,`companies`.`registration_number` AS `registration_number`,`companies`.`registration_number` AS `EmpresaMATRICULA` from (((`programs` left join `aplications` on((`programs`.`id` = `aplications`.`program_id`))) left join `companies` on(((`aplications`.`company_id` = `companies`.`id`) and (`aplications`.`company_id` <> 6)))) left join `InscripcionesEstados` on((`aplications`.`state` = `InscripcionesEstados`.`inscripcionEstadoID`))) where isnull(`programs`.`deleted_at`) order by `programs`.`name`) */;

/*View structure for view PreguntasConOpcionesRespuesta */

/*!50001 DROP TABLE IF EXISTS `PreguntasConOpcionesRespuesta` */;
/*!50001 DROP VIEW IF EXISTS `PreguntasConOpcionesRespuesta` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `PreguntasConOpcionesRespuesta` AS (select `variables`.`id` AS `preguntaID`,`variables`.`name` AS `preguntaTITULO`,cast(json_unquote(json_extract(`variables`.`values`,'$[0].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor1`,cast(json_unquote(json_extract(`variables`.`values`,'$[0].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje1`,cast(json_unquote(json_extract(`variables`.`values`,'$[1].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor2`,cast(json_unquote(json_extract(`variables`.`values`,'$[1].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje2`,cast(json_unquote(json_extract(`variables`.`values`,'$[2].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor3`,cast(json_unquote(json_extract(`variables`.`values`,'$[2].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje3`,cast(json_unquote(json_extract(`variables`.`values`,'$[3].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor4`,cast(json_unquote(json_extract(`variables`.`values`,'$[3].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje4`,cast(json_unquote(json_extract(`variables`.`values`,'$[4].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor5`,cast(json_unquote(json_extract(`variables`.`values`,'$[4].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje5`,cast(json_unquote(json_extract(`variables`.`values`,'$[5].attributes.variable_response')) as char charset utf8) AS `respuestaOPCIONvalor6`,cast(json_unquote(json_extract(`variables`.`values`,'$[5].attributes.percentage')) as decimal(5,2)) AS `respuestaOPCIONporcentaje6`,`variables`.`values` AS `values` from `variables`) */;

/*View structure for view departments */

/*!50001 DROP TABLE IF EXISTS `departments` */;
/*!50001 DROP VIEW IF EXISTS `departments` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `departments` AS (select `Departamentos`.`departamentoID` AS `id`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `name`,`Departamentos`.`departamentoID` AS `departamentoID`,`Departamentos`.`departamentoCODIGO` AS `departamentoCODIGO`,`Departamentos`.`departamentoNOMBRE` AS `departamentoNOMBRE`,`Departamentos`.`departamentoNOMBREOFICIAL` AS `departamentoNOMBREOFICIAL`,`Departamentos`.`departamentoCAPITAL` AS `departamentoCAPITAL`,`Departamentos`.`departamentoSUPERFICIE` AS `departamentoSUPERFICIE`,`Departamentos`.`departamentoMUNICIPIOS` AS `departamentoMUNICIPIOS`,`Departamentos`.`departamentoCODIGOCGN` AS `departamentoCODIGOCGN`,`Departamentos`.`paisID` AS `paisID`,`Departamentos`.`regionID` AS `regionID` from `Departamentos` where (`Departamentos`.`departamentoESTADISTICAS` = 'NO')) */;

/*View structure for view municipalities */

/*!50001 DROP TABLE IF EXISTS `municipalities` */;
/*!50001 DROP VIEW IF EXISTS `municipalities` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`rutacrecimiento`@`%` SQL SECURITY DEFINER VIEW `municipalities` AS (select `Municipios`.`municipioID` AS `id`,`Municipios`.`departamentoID` AS `department_id`,`Municipios`.`municipioNOMBREOFICIAL` AS `name`,`Municipios`.`municipioID` AS `municipioID`,`Municipios`.`municipioCODIGO` AS `municipioCODIGO`,`Municipios`.`municipioCODIGODANE` AS `municipioCODIGODANE`,`Municipios`.`municipioTITULO` AS `municipioTITULO`,`Municipios`.`municipioNOMBREOFICIAL` AS `municipioNOMBREOFICIAL`,`Municipios`.`municipioCONTABILIDAD` AS `municipioCONTABILIDAD`,`Municipios`.`departamentoID` AS `departamentoID`,`Municipios`.`municipioESTADISTICAS` AS `municipioESTADISTICAS` from `Municipios` where (`Municipios`.`municipioESTADISTICAS` = 'NO')) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
