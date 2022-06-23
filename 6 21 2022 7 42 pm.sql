/*
SQLyog Professional v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - crm_2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `activity_log` */

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cities` */

insert  into `cities`(`id`,`title`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Karachi','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL),
(2,'Lahore','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL),
(3,'Rawalpindi','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL),
(4,'Sewan','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL),
(5,'Islamabad','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL),
(6,'Peshawar','2022-04-23 09:39:54','2022-04-23 09:39:54',NULL);

/*Table structure for table `currencies` */

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `currencies` */

insert  into `currencies`(`id`,`currency`,`code`,`rate`,`created_at`,`updated_at`) values 
(1,'GBP','GBP',0.79,NULL,'2022-05-30 13:49:14'),
(2,'USD','USD',1.00,NULL,'2022-05-30 13:49:14'),
(3,'Taka','BDT',87.03,NULL,'2022-05-30 13:49:14'),
(4,'Canadian Dollar','CAD',1.27,NULL,'2022-05-30 13:49:14'),
(5,'Euro','EUR',0.93,NULL,'2022-05-30 13:49:14'),
(6,'Indian Rupee','INR',77.62,NULL,'2022-05-30 13:49:14'),
(7,'Pakistani Rupee','PKR',200.18,NULL,'2022-05-30 13:49:14'),
(12,'popp','1231',123.00,'2022-05-21 08:36:39','2022-05-21 08:36:39');

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_private` tinyint(4) NOT NULL DEFAULT 0,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `documents` */

insert  into `documents`(`id`,`user_id`,`name`,`url`,`is_private`,`file_type`,`created_at`,`updated_at`,`deleted_at`) values 
(1,NULL,'order files','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_1/order-data-20220616122119.docx',0,'docx','2022-06-16 00:00:00','2022-06-16 12:21:19',NULL),
(2,NULL,'order invoices','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_1/order-invoice-data-20220616122119.docx',0,'docx','2022-06-16 00:00:00','2022-06-16 12:21:19',NULL),
(3,NULL,'task uploaded document','http://localhost/crm_updated/crm_2/storage/app/task_files/order_1/task-data-20220617120728.docx',0,'docx','2022-06-17 00:00:00','2022-06-17 12:07:28',NULL),
(4,NULL,'task uploaded document','http://localhost/crm_updated/crm_2/storage/app/task_files/order_1/task-data-20220617120728.docx',0,'docx','2022-06-17 00:00:00','2022-06-17 12:07:28',NULL),
(5,NULL,'order files','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_2/order-data-20220620055238.docx',0,'docx','2022-06-20 00:00:00','2022-06-20 05:52:38',NULL),
(6,NULL,'order invoices','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_2/order-invoice-data-20220620055238.jpeg',0,'jpeg','2022-06-20 00:00:00','2022-06-20 05:52:38',NULL),
(7,NULL,'order files','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_3/order-data-20220620060422.docx',0,'docx','2022-06-20 00:00:00','2022-06-20 06:04:22',NULL),
(8,NULL,'order invoices','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_3/order-invoice-data-20220620060422.webp',0,'webp','2022-06-20 00:00:00','2022-06-20 06:04:22',NULL),
(9,NULL,'order files','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_4/order-data-20220620060621.ppt',0,'ppt','2022-06-20 00:00:00','2022-06-20 06:06:21',NULL),
(10,NULL,'order invoices','http://localhost/crm_updated/crm_2/storage/app/orders_files/order_4/order-invoice-data-20220620060621.jpg',0,'jpg','2022-06-20 00:00:00','2022-06-20 06:06:21',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `files` */

DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `files` */

insert  into `files`(`id`,`user_id`,`name`,`original_name`,`type`,`directory`,`created_at`,`updated_at`) values 
(1,NULL,'leads-data-20220616121144.ppt','task-data-20220606105655 (1).ppt','ppt','http://localhost/crm_updated/crm_2/storage/app/leads_files/lead_1','2022-06-16 12:11:44','2022-06-16 12:11:44'),
(2,NULL,'leads-data-20220620060116.ppt','task-data-20220606105655.ppt','ppt','http://localhost/crm_updated/crm_2/storage/app/leads_files/lead_2','2022-06-20 06:01:16','2022-06-20 06:01:16');

/*Table structure for table `lead_documents` */

DROP TABLE IF EXISTS `lead_documents`;

CREATE TABLE `lead_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` bigint(20) NOT NULL,
  `file_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lead_documents` */

insert  into `lead_documents`(`id`,`lead_id`,`file_id`,`created_at`,`updated_at`) values 
(1,1,1,'2022-06-16 12:11:44','2022-06-16 12:11:44'),
(2,2,2,'2022-06-20 06:01:16','2022-06-20 06:01:16');

/*Table structure for table `lead_issues` */

DROP TABLE IF EXISTS `lead_issues`;

CREATE TABLE `lead_issues` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `issue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT 'INACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lead_issues` */

insert  into `lead_issues`(`id`,`issue`,`created_at`,`updated_at`,`deleted_at`,`status`) values 
(1,'money','2022-06-17 13:52:09','2022-06-17 13:52:09',NULL,'ACTIVE');

/*Table structure for table `lead_transfers` */

DROP TABLE IF EXISTS `lead_transfers`;

CREATE TABLE `lead_transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `lead_transfers` */

/*Table structure for table `leads` */

DROP TABLE IF EXISTS `leads`;

CREATE TABLE `leads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint(20) DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `lead_status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `lead_issue_id` bigint(20) DEFAULT NULL,
  `lead_id` char(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfered_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `leads` */

insert  into `leads`(`id`,`created_by`,`first_name`,`last_name`,`email`,`phone_number`,`url`,`description`,`created_at`,`updated_at`,`deleted_at`,`lead_status`,`lead_issue_id`,`lead_id`,`transfered_id`) values 
(1,337,'hasnain','khan','hansain.khan@gmail.com','123456789','1','addresssss','2022-06-16 12:11:44','2022-06-16 12:11:44',NULL,'Paid',NULL,'LEAD-1',337),
(2,338,'hasnain leadd','khan','hasnain.leads.khan@gmail.com','123456789','1','address','2022-06-20 06:01:16','2022-06-20 06:01:16',NULL,'Paid',NULL,'LEAD-2',338);

/*Table structure for table `manager_employees` */

DROP TABLE IF EXISTS `manager_employees`;

CREATE TABLE `manager_employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `manager_employees` */

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `chat_user_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hand_shake` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `messages` */

insert  into `messages`(`id`,`created_at`,`updated_at`,`user_id`,`chat_user_id`,`message`,`hand_shake`,`read`) values 
(1,'2022-06-16 10:21:42','2022-06-16 10:21:42',101,306,'address','{\"user_id\":306,\"send_user_id\":101}',0),
(2,'2022-06-16 10:33:41','2022-06-16 10:33:41',101,306,'abcdasfasdf','{\"user_id\":101,\"send_user_id\":306}',0),
(3,'2022-06-17 06:45:38','2022-06-17 06:45:38',101,306,'sdafasdf','{\"user_id\":101,\"send_user_id\":306}',0),
(4,'2022-06-17 06:51:32','2022-06-17 06:51:32',101,306,'asdfasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(5,'2022-06-17 06:51:34','2022-06-17 06:51:34',101,306,'asdf','{\"user_id\":101,\"send_user_id\":306}',0),
(6,'2022-06-17 06:54:13','2022-06-17 06:54:13',101,306,'asdfasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(7,'2022-06-17 06:54:17','2022-06-17 06:54:17',101,306,'asdfasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(8,'2022-06-17 06:54:23','2022-06-17 06:54:23',101,306,'sadfasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(9,'2022-06-17 06:59:33','2022-06-17 06:59:33',101,306,'asdfasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(10,'2022-06-17 06:59:38','2022-06-17 06:59:38',101,306,'hasnain','{\"user_id\":306,\"send_user_id\":101}',0),
(11,'2022-06-17 06:59:42','2022-06-17 06:59:42',101,306,'asdffasdf','{\"user_id\":306,\"send_user_id\":101}',0),
(12,'2022-06-17 06:59:53','2022-06-17 06:59:53',101,306,'hasnain','{\"user_id\":306,\"send_user_id\":101}',0),
(13,'2022-06-17 11:58:48','2022-06-17 11:58:48',101,306,'hasnain',NULL,0);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2021_05_21_204512_create_notifications_table',1),
(6,'2021_05_22_000000_create_sale_orders_table',1),
(7,'2021_05_22_000000_create_statuses_table',1),
(8,'2021_05_22_000003_create_sale_order_documents_table',1),
(9,'2021_05_22_000004_create_writer_work_timelines_table',1),
(10,'2021_05_22_000005_create_manager_employees_table',1),
(11,'2021_05_22_000006_create_sale_order_status_table',1),
(12,'2021_05_22_000007_create_sale_order_subjects_table',1),
(13,'2021_05_22_000008_create_order_assigns_table',1),
(14,'2021_05_22_000009_create_documents_table',1),
(15,'2021_05_22_000010_create_subjects_table',1),
(16,'2021_05_22_000011_create_user_roles_table',1),
(17,'2021_05_24_185900_create_currencies_table',1),
(18,'2021_05_28_091705_create_files_table',1),
(19,'2021_05_28_201447_create_order_assign_documents_table',1),
(20,'2021_05_29_090503_create_cities_table',1),
(21,'2021_06_04_161321_create_order_assign_writer_submissions_table',1),
(22,'2021_06_05_060123_create_leads_table',1),
(23,'2021_06_05_091142_create_notices_table',1),
(24,'2021_06_05_123654_create_notice_users_table',1),
(25,'2021_08_06_175700_alter_order_assign_documents_table_add_column',1),
(26,'2021_08_07_090146_create_order_final_documents_table',1),
(27,'2021_08_07_102323_create_order_messages_table',1),
(28,'2021_08_07_102334_create_order_message_documents_table',1),
(29,'2021_08_07_180042_create_order_message_reads_table',1),
(30,'2021_08_15_102342_create_lead_issues_table',1),
(31,'2021_08_15_102525_alter_leads_table_add_columns',1),
(32,'2021_08_15_110553_create_lead_documents_table',1),
(33,'2021_08_22_115320_create_order_view_writers_table',1),
(34,'2022_04_19_062120_create_permission_tables',1),
(35,'2022_04_21_081151_create_modules_table',1),
(36,'2022_05_12_132128_create_lead_transfers_table',2),
(37,'2022_05_18_133820_create_websites_table',3),
(38,'2022_05_21_124231_create_activity_log_table',3),
(39,'2022_05_21_124232_add_event_column_to_activity_log_table',3),
(40,'2022_05_21_124233_add_batch_uuid_column_to_activity_log_table',3),
(41,'2022_06_16_100345_create_messages_table',4);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',101),
(15,'App\\Models\\User',302),
(15,'App\\Models\\User',307),
(15,'App\\Models\\User',315),
(15,'App\\Models\\User',316),
(15,'App\\Models\\User',326),
(15,'App\\Models\\User',331),
(15,'App\\Models\\User',336),
(15,'App\\Models\\User',337),
(16,'App\\Models\\User',306),
(16,'App\\Models\\User',309),
(16,'App\\Models\\User',310),
(16,'App\\Models\\User',314),
(16,'App\\Models\\User',320),
(16,'App\\Models\\User',324),
(16,'App\\Models\\User',325),
(16,'App\\Models\\User',335),
(16,'App\\Models\\User',338),
(17,'App\\Models\\User',311),
(17,'App\\Models\\User',313),
(17,'App\\Models\\User',321),
(17,'App\\Models\\User',327),
(17,'App\\Models\\User',332),
(18,'App\\Models\\User',319),
(18,'App\\Models\\User',322),
(18,'App\\Models\\User',323),
(18,'App\\Models\\User',328),
(18,'App\\Models\\User',329),
(18,'App\\Models\\User',330),
(18,'App\\Models\\User',333),
(18,'App\\Models\\User',334);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`url`,`created_at`,`updated_at`) values 
(1,'user','/','2022-04-22 10:07:18','2022-04-22 10:07:18'),
(2,'role','/','2022-04-22 10:07:18','2022-04-22 10:07:18'),
(3,'permission','/','2022-04-22 10:07:18','2022-04-22 10:07:18'),
(7,'leads','/','2022-04-22 10:07:18','2022-04-22 10:07:18'),
(8,'orders','/',NULL,NULL),
(9,'currency','/',NULL,NULL),
(10,'issue','/',NULL,NULL),
(11,'subjects','/',NULL,NULL),
(12,'websites','/',NULL,NULL),
(13,'tasks','/',NULL,NULL),
(14,'noticeboard','/',NULL,NULL);

/*Table structure for table `notice_users` */

DROP TABLE IF EXISTS `notice_users`;

CREATE TABLE `notice_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `notice_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notice_users` */

/*Table structure for table `notices` */

DROP TABLE IF EXISTS `notices`;

CREATE TABLE `notices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_by` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notices` */

insert  into `notices`(`id`,`created_by`,`title`,`description`,`sent_type`,`created_at`,`updated_at`,`deleted_at`) values 
(1,101,'adfasdf','<p>asdfasdf</p>','all','2022-05-30 13:48:46',NULL,NULL);

/*Table structure for table `notifications` */

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notifications` */

/*Table structure for table `order_assign_documents` */

DROP TABLE IF EXISTS `order_assign_documents`;

CREATE TABLE `order_assign_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `order_assign_id` bigint(20) DEFAULT NULL,
  `file_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submission_type` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_assign_documents` */

/*Table structure for table `order_assign_writer_submissions` */

DROP TABLE IF EXISTS `order_assign_writer_submissions`;

CREATE TABLE `order_assign_writer_submissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `order_assign_id` bigint(20) DEFAULT NULL,
  `file_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_assign_writer_submissions` */

/*Table structure for table `order_assigns` */

DROP TABLE IF EXISTS `order_assigns`;

CREATE TABLE `order_assigns` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `sale_order_id` bigint(20) NOT NULL,
  `status_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `completed` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_assigns` */

insert  into `order_assigns`(`id`,`user_id`,`sale_order_id`,`status_id`,`created_at`,`updated_at`,`deleted_at`,`completed`,`created_by`) values 
(15,328,4,'Pending','2022-06-20 17:30:25','2022-06-20 17:30:25',NULL,'0',101),
(21,332,4,'Pending','2022-06-20 17:59:56','2022-06-20 17:59:56',NULL,'0',101),
(22,327,4,'Pending','2022-06-20 18:00:02','2022-06-20 18:00:02',NULL,'0',101),
(23,334,3,'Pending','2022-06-21 16:49:44','2022-06-21 16:49:44',NULL,'0',332);

/*Table structure for table `order_feedback` */

DROP TABLE IF EXISTS `order_feedback`;

CREATE TABLE `order_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `order_feedback` */

insert  into `order_feedback`(`id`,`order_id`,`feedback`,`created_at`,`created_by`) values 
(1,NULL,'Feedback','2022-06-04 08:17:10',101),
(2,NULL,'Feedback','2022-06-04 08:18:52',101),
(3,NULL,'Feedback','2022-06-04 08:20:01',101),
(4,42,'Feedbac','2022-06-04 08:20:41',101),
(5,42,'Feedbac','2022-06-04 08:22:10',101),
(6,42,'Feedbac','2022-06-04 08:22:36',101),
(7,15,'feedback added','2022-06-04 08:57:54',101),
(8,15,'feedback added','2022-06-04 08:57:58',101),
(9,15,'feedback added','2022-06-04 08:57:59',101),
(10,4,'adress feedback','2022-06-16 11:09:00',101),
(11,4,'adress feedback','2022-06-16 11:09:04',101),
(12,3,'sdfasdfasdf','2022-06-16 11:11:13',101),
(13,3,'asdfasdfasdf','2022-06-16 11:13:16',101),
(14,3,'asdfasdfasdf','2022-06-16 11:18:08',101),
(15,13,'sdfasdfasdf','2022-06-16 11:19:40',101),
(16,13,'asdfasdfasdf','2022-06-16 11:20:12',101),
(17,13,'asdfasdfasdf','2022-06-16 11:20:48',101),
(18,13,'asdfasdfasdfasdf','2022-06-16 11:21:28',101),
(19,13,'asdfasdfasdfasdf','2022-06-16 11:21:51',101),
(20,13,'asdfasdfasdf','2022-06-16 11:22:37',101),
(21,2,'asdfasdfasdfasdfasdfasdfasdfasdfasdfsdfsadfsfsafd','2022-06-16 11:46:37',337);

/*Table structure for table `order_final_documents` */

DROP TABLE IF EXISTS `order_final_documents`;

CREATE TABLE `order_final_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_assign_id` bigint(20) NOT NULL,
  `manager_id` bigint(20) DEFAULT NULL,
  `file_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_final_documents` */

/*Table structure for table `order_message_documents` */

DROP TABLE IF EXISTS `order_message_documents`;

CREATE TABLE `order_message_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `order_message_id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `file_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_message_documents` */

insert  into `order_message_documents`(`id`,`order_id`,`order_message_id`,`sender_id`,`file_id`,`created_at`,`updated_at`,`file_name`) values 
(15,1,36,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg','2022-06-21 14:53:45','2022-06-21 14:53:45','WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg'),
(16,1,36,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (4).jpeg','2022-06-21 14:53:45','2022-06-21 14:53:45','WhatsApp Image 2021-10-04 at 5.07.48 PM (4).jpeg'),
(17,1,36,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg','2022-06-21 14:53:45','2022-06-21 14:53:45','WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg'),
(18,1,37,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/leads-data-20220511114406 (3).jpg','2022-06-21 15:03:38','2022-06-21 15:03:38','leads-data-20220511114406 (3).jpg'),
(19,1,37,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/leads-data-20220511114406.jpg','2022-06-21 15:03:38','2022-06-21 15:03:38','leads-data-20220511114406.jpg'),
(20,1,38,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/leads-data-20220511114406 (3).jpg','2022-06-21 15:04:53','2022-06-21 15:04:53','leads-data-20220511114406 (3).jpg'),
(21,1,38,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/leads-data-20220511114406.jpg','2022-06-21 15:04:53','2022-06-21 15:04:53','leads-data-20220511114406.jpg'),
(22,1,38,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/leads-data-20220511114434.pdf','2022-06-21 15:04:53','2022-06-21 15:04:53','leads-data-20220511114434.pdf'),
(23,1,38,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/Draft Agreement - V5.3.pdf','2022-06-21 15:04:53','2022-06-21 15:04:53','Draft Agreement - V5.3.pdf'),
(24,4,39,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/WhatsApp Image 2021-10-04 at 5.07.48 PM (1).jpeg','2022-06-21 15:20:14','2022-06-21 15:20:14','WhatsApp Image 2021-10-04 at 5.07.48 PM (1).jpeg'),
(25,4,40,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg','2022-06-21 15:21:49','2022-06-21 15:21:49','WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg'),
(26,4,41,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg','2022-06-21 15:22:41','2022-06-21 15:22:41','WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg'),
(27,3,43,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Crm QA scoring.docx','2022-06-21 15:27:56','2022-06-21 15:27:56','Crm QA scoring.docx'),
(28,3,44,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/task-data-20220606105655.ppt','2022-06-21 15:28:56','2022-06-21 15:28:56','task-data-20220606105655.ppt'),
(29,4,46,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/Crm QA scoring.docx','2022-06-21 16:16:10','2022-06-21 16:16:10','Crm QA scoring.docx'),
(30,1,50,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg','2022-06-21 16:28:21','2022-06-21 16:28:21','WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg'),
(31,1,50,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (4).jpeg','2022-06-21 16:28:21','2022-06-21 16:28:21','WhatsApp Image 2021-10-04 at 5.07.48 PM (4).jpeg'),
(32,1,50,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg','2022-06-21 16:28:21','2022-06-21 16:28:21','WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg'),
(33,1,50,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (1).jpeg','2022-06-21 16:28:21','2022-06-21 16:28:21','WhatsApp Image 2021-10-04 at 5.07.48 PM (1).jpeg'),
(34,1,50,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg','2022-06-21 16:28:21','2022-06-21 16:28:21','WhatsApp Image 2021-10-04 at 5.07.48 PM.jpeg'),
(35,1,51,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg','2022-06-21 16:30:41','2022-06-21 16:30:41','WhatsApp Image 2021-10-04 at 5.07.48 PM (2).jpeg'),
(36,1,53,337,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/Crm QA scoring.docx','2022-06-21 16:32:05','2022-06-21 16:32:05','Crm QA scoring.docx'),
(37,1,60,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_1/task-data-20220606105655 (1).ppt','2022-06-21 16:39:31','2022-06-21 16:39:31','task-data-20220606105655 (1).ppt'),
(38,3,64,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/task-data-20220606105655 (1).ppt','2022-06-21 17:38:21','2022-06-21 17:38:21','task-data-20220606105655 (1).ppt'),
(39,4,65,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg','2022-06-21 17:44:32','2022-06-21 17:44:32','WhatsApp Image 2021-10-04 at 5.07.48 PM (3).jpeg'),
(40,4,67,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_4/task-data-20220606105655 (1).ppt','2022-06-21 17:53:31','2022-06-21 17:53:31','task-data-20220606105655 (1).ppt'),
(41,3,68,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/WhatsApp Image 2021-10-04 at 5.07.48 PM (5).jpeg','2022-06-21 18:41:50','2022-06-21 18:41:50','WhatsApp Image 2021-10-04 at 5.07.48 PM (5).jpeg'),
(42,3,69,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 18:41:58','2022-06-21 18:41:58','Introduction to PHP (Hindi).mp4'),
(43,3,73,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 19:00:27','2022-06-21 19:00:27','Introduction to PHP (Hindi).mp4'),
(44,3,74,101,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Crm QA scoring.docx','2022-06-21 19:05:19','2022-06-21 19:05:19','Crm QA scoring.docx'),
(45,3,75,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/meeting points 6 18 2022 4 47.txt','2022-06-21 19:05:36','2022-06-21 19:05:36','meeting points 6 18 2022 4 47.txt'),
(46,3,76,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 19:11:35','2022-06-21 19:11:35','Introduction to PHP (Hindi).mp4'),
(47,3,77,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 19:13:02','2022-06-21 19:13:02','Introduction to PHP (Hindi).mp4'),
(48,3,79,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 19:15:12','2022-06-21 19:15:12','Introduction to PHP (Hindi).mp4'),
(49,3,80,332,'http://localhost/crm_updated/crm_2/storage/app/order_message_docs/order_3/Introduction to PHP (Hindi).mp4','2022-06-21 19:23:01','2022-06-21 19:23:01','Introduction to PHP (Hindi).mp4');

/*Table structure for table `order_message_reads` */

DROP TABLE IF EXISTS `order_message_reads`;

CREATE TABLE `order_message_reads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `order_message_id` bigint(20) NOT NULL,
  `reader_id` bigint(20) NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_message_reads` */

/*Table structure for table `order_messages` */

DROP TABLE IF EXISTS `order_messages`;

CREATE TABLE `order_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `reciever_id` bigint(20) DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_messages` */

insert  into `order_messages`(`id`,`order_id`,`sender_id`,`reciever_id`,`message`,`created_at`,`updated_at`,`deleted_at`) values 
(36,1,101,NULL,'address','2022-06-21 14:53:45','2022-06-21 14:53:45',NULL),
(37,1,5,NULL,'karachi pakistan sindh','2022-06-21 15:03:38','2022-06-21 15:03:38',NULL),
(38,1,101,NULL,'addresssdfasdfasdf asdf asdf','2022-06-21 15:04:53','2022-06-21 15:04:53',NULL),
(39,4,101,NULL,'addresss','2022-06-21 15:20:14','2022-06-21 15:20:14',NULL),
(40,4,101,NULL,'dddd','2022-06-21 15:21:49','2022-06-21 15:21:49',NULL),
(41,4,101,NULL,'dddd','2022-06-21 15:22:41','2022-06-21 15:22:41',NULL),
(42,1,101,NULL,'brown mondey','2022-06-21 15:26:26','2022-06-21 15:26:26',NULL),
(43,3,101,NULL,'karachi pakistan','2022-06-21 15:27:56','2022-06-21 15:27:56',NULL),
(44,3,101,NULL,'karachi pakistan','2022-06-21 15:28:56','2022-06-21 15:28:56',NULL),
(45,1,337,NULL,'i am also here pleasee dont forget me','2022-06-21 15:35:17','2022-06-21 15:35:17',NULL),
(46,4,101,NULL,'address','2022-06-21 16:16:10','2022-06-21 16:16:10',NULL),
(47,1,101,NULL,'karachi pakistan','2022-06-21 16:16:39','2022-06-21 16:16:39',NULL),
(48,1,101,NULL,'yahoooo','2022-06-21 16:16:53','2022-06-21 16:16:53',NULL),
(49,1,101,NULL,'brown mondey','2022-06-21 16:27:32','2022-06-21 16:27:32',NULL),
(50,1,101,NULL,'message with documents','2022-06-21 16:28:21','2022-06-21 16:28:21',NULL),
(51,1,101,NULL,'text files','2022-06-21 16:30:41','2022-06-21 16:30:41',NULL),
(52,1,337,NULL,'information technology','2022-06-21 16:31:07','2022-06-21 16:31:07',NULL),
(53,1,337,NULL,'this is my destiney','2022-06-21 16:32:05','2022-06-21 16:32:05',NULL),
(54,1,101,NULL,'no this is my destiney','2022-06-21 16:32:19','2022-06-21 16:32:19',NULL),
(55,1,101,NULL,'messages  only','2022-06-21 16:33:41','2022-06-21 16:33:41',NULL),
(56,1,337,NULL,'my message is this is the data','2022-06-21 16:33:49','2022-06-21 16:33:49',NULL),
(57,1,337,NULL,'messages','2022-06-21 16:38:14','2022-06-21 16:38:14',NULL),
(58,1,101,NULL,'this is my message','2022-06-21 16:38:34','2022-06-21 16:38:34',NULL),
(59,1,101,NULL,'what','2022-06-21 16:38:52','2022-06-21 16:38:52',NULL),
(60,1,101,NULL,'lahori message','2022-06-21 16:39:31','2022-06-21 16:39:31',NULL),
(61,1,337,NULL,'okay thats it','2022-06-21 16:39:54','2022-06-21 16:39:54',NULL),
(62,1,101,NULL,'great keep it up please complete task before given time','2022-06-21 16:40:17','2022-06-21 16:40:17',NULL),
(63,1,337,NULL,'latest message here','2022-06-21 17:29:01','2022-06-21 17:29:01',NULL),
(64,3,332,NULL,'messages','2022-06-21 17:38:21','2022-06-21 17:38:21',NULL),
(65,4,332,NULL,'latest message here','2022-06-21 17:44:32','2022-06-21 17:44:32',NULL),
(66,4,332,NULL,'what about my life you lier i hat you i hat you','2022-06-21 17:45:04','2022-06-21 17:45:04',NULL),
(67,4,332,NULL,'asdfasdfasdfsdf asdf asdf','2022-06-21 17:53:31','2022-06-21 17:53:31',NULL),
(68,3,332,NULL,'asdfasdfasdf','2022-06-21 18:41:50','2022-06-21 18:41:50',NULL),
(69,3,332,NULL,'address','2022-06-21 18:41:58','2022-06-21 18:41:58',NULL),
(70,3,332,NULL,'sadfasdf','2022-06-21 18:49:13','2022-06-21 18:49:13',NULL),
(71,3,332,NULL,'fazsdfasdf','2022-06-21 18:49:29','2022-06-21 18:49:29',NULL),
(72,3,332,NULL,'asdfasdfasdf','2022-06-21 18:51:31','2022-06-21 18:51:31',NULL),
(73,3,332,NULL,'asdfasdf','2022-06-21 19:00:27','2022-06-21 19:00:27',NULL),
(74,3,101,NULL,'address','2022-06-21 19:05:19','2022-06-21 19:05:19',NULL),
(75,3,332,NULL,'address123','2022-06-21 19:05:36','2022-06-21 19:05:36',NULL),
(76,3,332,NULL,'hasnain 123123123','2022-06-21 19:11:35','2022-06-21 19:11:35',NULL),
(77,3,332,NULL,'dacing start','2022-06-21 19:13:02','2022-06-21 19:13:02',NULL),
(78,3,101,NULL,'humayun khan 2221','2022-06-21 19:13:28','2022-06-21 19:13:28',NULL),
(79,3,332,NULL,'sadfasdfasdf','2022-06-21 19:15:12','2022-06-21 19:15:12',NULL),
(80,3,332,NULL,'fazil kha n2225','2022-06-21 19:23:01','2022-06-21 19:23:01',NULL);

/*Table structure for table `order_view_writers` */

DROP TABLE IF EXISTS `order_view_writers`;

CREATE TABLE `order_view_writers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `order_view_writers` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values 
(1,'user-view','web','2022-04-22 09:48:39','2022-04-22 09:48:39'),
(2,'user-add','web','2022-04-22 09:48:45','2022-04-22 09:48:45'),
(3,'user-edit','web','2022-04-22 09:48:50','2022-04-22 09:48:50'),
(4,'user-delete','web','2022-04-22 09:48:54','2022-04-22 09:48:54'),
(5,'role-view','web','2022-04-22 09:48:54','2022-04-22 09:48:54'),
(6,'role-add','web','2022-04-22 09:48:54','2022-04-22 09:48:54'),
(7,'role-edit','web','2022-04-22 09:48:54','2022-04-22 09:48:54'),
(8,'role-delete','web','0000-00-00 00:00:00','2022-04-22 09:48:54'),
(18,'permission','web','2022-04-27 10:01:17','2022-04-27 10:01:17'),
(19,'leads-view','web','2022-04-27 10:01:17','2022-04-27 10:01:17'),
(21,'leads-add','web','2022-04-27 10:01:17','2022-04-27 10:01:17'),
(22,'leads-edit','web','2022-04-27 10:01:17','2022-04-27 10:01:17'),
(23,'leads-delete','web','2022-04-27 10:01:17','2022-04-27 10:01:17'),
(24,'orders-view','web',NULL,NULL),
(25,'orders-add','web',NULL,NULL),
(26,'orders-edit','web',NULL,NULL),
(27,'orders-delete','web',NULL,NULL),
(28,'issue-view','web',NULL,NULL),
(29,'issue-add','web',NULL,NULL),
(30,'issue-edit','web',NULL,NULL),
(31,'issue-delete','web',NULL,NULL),
(32,'currency-view','web',NULL,NULL),
(33,'currency-add','web',NULL,NULL),
(34,'currency-edit','web',NULL,NULL),
(35,'currency-delete','web',NULL,NULL),
(36,'subjects-view','web',NULL,NULL),
(37,'subjects-add','web',NULL,NULL),
(38,'subjects-edit','web',NULL,NULL),
(39,'subjects-delete','web',NULL,NULL),
(40,'leads-archieved','web',NULL,NULL),
(41,'leads-transfer','web',NULL,NULL),
(44,'orders-archieved','web',NULL,NULL),
(45,'websites-view','web',NULL,NULL),
(46,'websites-add','web',NULL,NULL),
(47,'websites-edit','web',NULL,NULL),
(48,'websites-delete','web',NULL,NULL),
(49,'tasks-view','web',NULL,NULL),
(50,'noticeboard-view','web',NULL,NULL),
(51,'noticeboard-add','web',NULL,NULL),
(52,'noticeboard-edit','web',NULL,NULL);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,1),
(1,15),
(1,16),
(1,17),
(2,1),
(2,16),
(2,17),
(3,1),
(3,16),
(3,17),
(4,1),
(4,16),
(4,17),
(5,1),
(5,16),
(5,17),
(6,1),
(6,16),
(6,17),
(7,1),
(7,16),
(7,17),
(8,1),
(8,16),
(8,17),
(18,1),
(18,16),
(18,17),
(19,1),
(19,15),
(19,16),
(19,18),
(21,1),
(21,15),
(21,16),
(21,18),
(22,1),
(22,16),
(23,1),
(23,15),
(23,16),
(24,1),
(24,15),
(24,16),
(25,1),
(25,15),
(25,16),
(26,1),
(26,15),
(26,16),
(27,1),
(27,16),
(28,1),
(28,15),
(28,16),
(28,17),
(29,1),
(29,16),
(29,17),
(30,1),
(30,16),
(30,17),
(31,1),
(31,16),
(31,17),
(32,1),
(32,15),
(32,16),
(32,17),
(33,1),
(33,16),
(33,17),
(34,1),
(34,16),
(34,17),
(35,1),
(35,16),
(35,17),
(36,1),
(36,15),
(36,16),
(36,17),
(37,1),
(37,16),
(37,17),
(38,1),
(38,16),
(38,17),
(39,1),
(39,16),
(39,17),
(40,1),
(40,15),
(40,16),
(41,1),
(41,15),
(44,1),
(45,1),
(45,15),
(45,16),
(45,17),
(46,1),
(46,16),
(46,17),
(47,1),
(47,16),
(47,17),
(48,1),
(48,17),
(49,1),
(49,17),
(49,18),
(50,1),
(50,15),
(50,17),
(51,1),
(51,15),
(51,17),
(52,1),
(52,15),
(52,17);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`,`type`) values 
(1,'Admin','web','2022-04-21 10:06:07','2022-04-22 09:36:24','web'),
(15,'Sale Manager','web','2022-04-23 08:56:36','2022-05-23 07:35:39','manager'),
(16,'Sale Agent','web','2022-04-23 09:25:33','2022-04-23 09:25:33','agent'),
(17,'Writer Manager','web','2022-04-23 09:26:02','2022-04-23 09:26:02','manager'),
(18,'Writer','web','2022-04-23 09:26:17','2022-04-25 10:38:54','agent'),
(19,'IT','web','2022-04-23 09:26:25','2022-04-23 09:26:25','it'),
(20,'HR','web','2022-04-23 09:26:28','2022-04-23 09:26:28','hr'),
(23,'sdfsdf','web','2022-05-14 08:59:46','2022-05-14 08:59:46',NULL),
(24,'general manager','web','2022-06-20 14:02:08','2022-06-20 14:02:08','manager');

/*Table structure for table `sale_failed` */

DROP TABLE IF EXISTS `sale_failed`;

CREATE TABLE `sale_failed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `sale_failed` */

/*Table structure for table `sale_order_documents` */

DROP TABLE IF EXISTS `sale_order_documents`;

CREATE TABLE `sale_order_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sale_order_id` bigint(20) unsigned NOT NULL,
  `document_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `task_type` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_order_documents` */

insert  into `sale_order_documents`(`id`,`sale_order_id`,`document_id`,`created_at`,`updated_at`,`deleted_at`,`task_type`,`created_by`,`document_name`,`doc_status`) values 
(0,12,86,'2022-06-14 12:08:49','2022-06-14 12:08:49',NULL,NULL,NULL,NULL,'Failed'),
(1,8,6,'2022-05-17 08:18:50','2022-05-17 08:18:50',NULL,NULL,NULL,NULL,NULL),
(2,8,7,'2022-05-17 08:18:50','2022-05-17 08:18:50',NULL,NULL,NULL,NULL,NULL),
(3,9,8,'2022-05-17 08:19:28','2022-05-17 08:19:28',NULL,NULL,NULL,NULL,NULL),
(4,9,9,'2022-05-17 08:19:28','2022-05-17 08:19:28',NULL,NULL,NULL,NULL,NULL),
(5,15,10,'2022-05-17 08:40:11','2022-05-17 08:40:11',NULL,NULL,NULL,NULL,NULL),
(6,15,11,'2022-05-17 08:40:11','2022-05-17 08:40:11',NULL,NULL,NULL,NULL,NULL),
(7,23,12,'2022-05-19 07:07:22','2022-05-19 07:07:22',NULL,NULL,NULL,NULL,NULL),
(8,23,13,'2022-05-19 07:07:22','2022-05-19 07:07:22',NULL,NULL,NULL,NULL,NULL),
(9,34,14,'2022-05-26 07:34:20','2022-05-26 07:34:20',NULL,NULL,NULL,NULL,NULL),
(10,34,15,'2022-05-26 07:34:20','2022-05-26 07:34:20',NULL,NULL,NULL,NULL,NULL),
(11,35,16,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(12,35,17,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(13,35,18,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(14,35,19,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(15,35,20,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(16,35,21,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(17,35,22,'2022-05-26 07:46:53','2022-05-26 07:46:53',NULL,NULL,NULL,NULL,NULL),
(18,36,23,'2022-05-26 09:53:24','2022-05-26 09:53:24',NULL,NULL,NULL,NULL,NULL),
(19,36,24,'2022-05-26 09:53:24','2022-05-26 09:53:24',NULL,NULL,NULL,NULL,NULL),
(20,36,25,'2022-05-27 13:30:14','2022-05-27 13:30:14',NULL,NULL,NULL,NULL,NULL),
(21,36,26,'2022-05-27 13:43:31','2022-05-27 13:43:31',NULL,NULL,NULL,NULL,NULL),
(22,36,27,'2022-05-27 13:43:38','2022-05-27 13:43:38',NULL,NULL,NULL,NULL,NULL),
(23,36,28,'2022-05-27 13:43:48','2022-05-27 13:43:48',NULL,NULL,NULL,NULL,NULL),
(24,36,29,'2022-05-27 13:43:48','2022-05-27 13:43:48',NULL,NULL,NULL,NULL,NULL),
(25,36,30,'2022-05-27 13:43:48','2022-05-27 13:43:48',NULL,NULL,NULL,NULL,NULL),
(26,37,31,'2022-05-27 13:46:47','2022-05-27 13:46:47',NULL,NULL,NULL,NULL,NULL),
(27,37,32,'2022-05-27 13:46:47','2022-05-27 13:46:47',NULL,NULL,NULL,NULL,NULL),
(28,38,33,'2022-05-27 13:57:37','2022-05-27 13:57:37',NULL,NULL,NULL,NULL,NULL),
(29,38,34,'2022-05-27 13:57:37','2022-05-27 13:57:37',NULL,NULL,NULL,NULL,NULL),
(30,38,35,'2022-05-27 13:57:37','2022-05-27 13:57:37',NULL,NULL,NULL,NULL,NULL),
(31,38,36,'2022-05-27 13:57:37','2022-05-27 13:57:37',NULL,NULL,NULL,NULL,NULL),
(32,38,37,'2022-05-27 13:57:37','2022-05-27 13:57:37',NULL,NULL,NULL,NULL,NULL),
(33,38,38,'2022-05-28 05:27:59','2022-05-28 05:27:59',NULL,NULL,NULL,NULL,NULL),
(34,38,39,'2022-05-28 05:27:59','2022-05-28 05:27:59',NULL,NULL,NULL,NULL,NULL),
(35,38,40,'2022-05-28 05:27:59','2022-05-28 05:27:59',NULL,NULL,NULL,NULL,NULL),
(36,38,41,'2022-05-28 05:29:58','2022-05-28 05:29:58',NULL,NULL,NULL,'asdfasdf',NULL),
(37,38,46,'2022-05-28 05:33:40','2022-05-28 05:33:40',NULL,NULL,NULL,'asdfasdf',NULL),
(38,38,47,'2022-05-28 05:48:25','2022-05-28 05:48:25',NULL,NULL,NULL,'sdfsdfsdf',NULL),
(39,38,48,'2022-05-28 05:53:33','2022-05-28 05:53:33',NULL,NULL,NULL,'sdf',NULL),
(40,38,49,'2022-05-28 05:54:17','2022-05-28 05:54:17',NULL,NULL,NULL,'This documnet is not valid I have to change this urgently',NULL),
(41,38,50,'2022-05-28 06:01:39','2022-05-28 06:01:39',NULL,NULL,NULL,'This documnet is not valid I have to change this urgently',NULL),
(42,38,51,'2022-05-28 06:05:36','2022-05-28 06:05:36',NULL,NULL,NULL,'test documents',NULL),
(43,38,52,'2022-05-28 06:09:56','2022-05-28 06:09:56',NULL,NULL,NULL,'sdfasdfasdf',NULL),
(44,38,53,'2022-05-28 06:19:04','2022-05-28 06:19:04',NULL,NULL,NULL,'asdfasdf',NULL),
(45,38,54,'2022-05-28 06:19:14','2022-05-28 06:19:14',NULL,NULL,NULL,'abcd',NULL),
(46,38,55,'2022-05-28 06:19:57','2022-05-28 06:19:57',NULL,NULL,NULL,'abcd',NULL),
(47,38,56,'2022-05-28 06:20:07','2022-05-28 06:20:07',NULL,NULL,NULL,'defadsfasdf',NULL),
(48,38,57,'2022-05-28 06:24:03','2022-05-28 06:24:03',NULL,NULL,NULL,'defghifjklmnopqrstuvwxyz',NULL),
(49,38,58,'2022-05-28 06:26:02','2022-05-28 06:26:02',NULL,NULL,NULL,'hasnain',NULL),
(50,39,59,'2022-05-28 06:28:02','2022-05-28 06:28:02',NULL,NULL,NULL,NULL,NULL),
(51,39,60,'2022-05-28 06:28:02','2022-05-28 06:28:02',NULL,NULL,NULL,NULL,NULL),
(52,40,61,'2022-05-28 06:33:23','2022-05-28 06:33:23',NULL,NULL,NULL,NULL,NULL),
(53,40,62,'2022-05-28 06:33:23','2022-05-28 06:33:23',NULL,NULL,NULL,NULL,NULL),
(54,40,63,'2022-05-28 06:36:50','2022-05-28 06:36:50',NULL,NULL,NULL,'Your all Status is wrong',NULL),
(55,40,64,'2022-05-28 06:37:10','2022-05-28 06:37:10',NULL,NULL,NULL,'Please Check again sir',NULL),
(56,40,65,'2022-05-28 06:45:04','2022-05-28 06:45:04',NULL,NULL,NULL,'Your all Status is wrong',NULL),
(57,40,66,'2022-05-28 06:46:25','2022-05-28 06:46:25',NULL,NULL,NULL,'Your all Status is wrong',NULL),
(58,40,67,'2022-05-28 07:11:37','2022-05-28 07:11:37',NULL,NULL,NULL,'ding dong bubble gum',NULL),
(59,40,68,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(60,40,69,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(61,40,70,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(62,40,71,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(63,40,72,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(64,40,73,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(65,40,74,'2022-05-28 07:14:02','2022-05-28 07:14:02',NULL,NULL,NULL,'boom boom bubble gum again',NULL),
(66,38,75,'2022-05-28 07:52:36','2022-05-28 07:52:36',NULL,NULL,NULL,'Task started on the same date',NULL),
(67,40,76,'2022-05-28 08:00:58','2022-05-28 08:00:58',NULL,NULL,NULL,'test documents 20222',NULL),
(68,38,77,'2022-05-28 09:07:35','2022-05-28 09:07:35',NULL,NULL,NULL,'test documents',NULL),
(69,41,78,'2022-05-28 10:33:12','2022-05-28 10:33:12',NULL,NULL,NULL,NULL,NULL),
(70,41,79,'2022-05-28 10:33:12','2022-05-28 10:33:12',NULL,NULL,NULL,NULL,NULL),
(71,41,80,'2022-05-28 10:33:12','2022-05-28 10:33:12',NULL,NULL,NULL,NULL,NULL),
(72,40,81,'2022-05-28 11:04:28','2022-05-28 11:04:28',NULL,NULL,NULL,'dsfgdsfg',NULL),
(73,40,82,'2022-05-28 11:05:05','2022-05-28 11:05:05',NULL,NULL,NULL,'writee manager fixed the point metion in the doc',NULL),
(74,5,83,'2022-06-01 08:03:04','2022-06-01 08:03:04',NULL,NULL,NULL,'asdfasdf',NULL),
(75,5,84,'2022-06-01 08:03:26','2022-06-01 08:03:26',NULL,NULL,NULL,'asdfasdf',NULL),
(76,5,85,'2022-06-01 08:04:44','2022-06-15 10:19:33',NULL,NULL,NULL,'aaa','Sent'),
(77,42,86,'2022-06-01 09:16:51','2022-06-01 09:16:51',NULL,NULL,NULL,NULL,NULL),
(78,42,87,'2022-06-01 09:16:51','2022-06-01 09:16:51',NULL,NULL,NULL,NULL,NULL),
(79,42,88,'2022-06-01 09:16:51','2022-06-01 09:16:51',NULL,NULL,NULL,NULL,NULL),
(80,42,89,'2022-06-01 09:31:57','2022-06-01 09:31:57',NULL,NULL,NULL,'dfasdf',NULL),
(81,42,90,'2022-06-01 09:46:53','2022-06-01 09:46:53',NULL,NULL,NULL,'asdfasdfasdf',NULL),
(82,42,91,'2022-06-01 09:47:08','2022-06-01 09:47:08',NULL,NULL,NULL,'sdfasdf',NULL),
(83,42,92,'2022-06-01 12:21:47','2022-06-01 12:21:47',NULL,NULL,NULL,'asdfasdf',NULL),
(84,42,93,'2022-06-01 12:23:56','2022-06-01 12:23:56',NULL,NULL,NULL,'sdfasdf',NULL),
(85,42,94,'2022-06-01 12:25:07','2022-06-01 12:25:07',NULL,NULL,NULL,'asdfsdf',NULL),
(86,42,95,'2022-06-01 12:25:30','2022-06-01 12:25:30',NULL,NULL,NULL,'aaaaaaaaaaaaaaa',NULL),
(87,42,96,'2022-06-01 12:26:20','2022-06-01 12:26:20',NULL,NULL,NULL,'bbbbbbbbbbbbbbbb',NULL),
(88,42,97,'2022-06-01 12:28:59','2022-06-01 12:28:59',NULL,NULL,NULL,'dddddddddddddddd',NULL),
(89,42,98,'2022-06-01 12:29:39','2022-06-01 12:29:39',NULL,NULL,NULL,'dddddddddddddddd',NULL),
(90,42,99,'2022-06-01 12:30:11','2022-06-01 12:30:11',NULL,NULL,NULL,'sdafasdf',NULL),
(91,42,100,'2022-06-01 12:30:42','2022-06-01 12:30:42',NULL,NULL,NULL,'sdafasdf',NULL),
(92,42,101,'2022-06-01 12:32:59','2022-06-01 12:32:59',NULL,NULL,NULL,'asdfasdf',NULL),
(93,42,102,'2022-06-01 12:34:36','2022-06-01 12:34:36',NULL,NULL,NULL,'abcd',NULL),
(94,42,103,'2022-06-01 12:36:00','2022-06-01 12:36:00',NULL,NULL,NULL,'my task is completed here the files',NULL),
(95,42,104,'2022-06-01 12:36:49','2022-06-01 12:36:49',NULL,NULL,NULL,'my task is completed here the files',NULL),
(96,42,105,'2022-06-01 12:37:23','2022-06-01 12:37:23',NULL,NULL,NULL,'asdfasdf',NULL),
(97,42,106,'2022-06-02 09:41:43','2022-06-02 09:41:43',NULL,NULL,NULL,'asdfasdf',NULL),
(98,42,107,'2022-06-02 09:42:08','2022-06-02 09:42:08',NULL,NULL,NULL,'asdfasdf',NULL),
(99,42,108,'2022-06-02 11:24:24','2022-06-02 11:24:24',NULL,NULL,NULL,'asdfasdf',NULL),
(100,5,109,'2022-06-02 12:08:01','2022-06-02 12:08:01',NULL,NULL,NULL,'asdfasdf',NULL),
(101,43,110,'2022-06-02 12:11:39','2022-06-02 12:11:39',NULL,NULL,NULL,NULL,NULL),
(102,43,111,'2022-06-02 12:11:39','2022-06-02 12:11:39',NULL,NULL,NULL,NULL,NULL),
(103,43,112,'2022-06-02 12:17:36','2022-06-02 12:17:36',NULL,NULL,NULL,'asdfasdf',NULL),
(104,43,113,'2022-06-02 12:17:57','2022-06-02 12:17:57',NULL,NULL,NULL,'asdfasdfasdf',NULL),
(105,43,114,'2022-06-02 12:20:14','2022-06-02 12:20:14',NULL,NULL,NULL,'my task is completed here the files',NULL),
(106,15,115,'2022-06-02 12:47:06','2022-06-02 12:47:06',NULL,NULL,NULL,'sdfasdf',NULL),
(107,15,116,'2022-06-02 12:48:47','2022-06-02 12:48:47',NULL,NULL,NULL,'asdfasdf',NULL),
(108,15,117,'2022-06-02 12:49:08','2022-06-02 12:49:08',NULL,NULL,NULL,'asdfasdf',NULL),
(109,41,118,'2022-06-03 07:04:35','2022-06-03 07:04:35',NULL,NULL,NULL,'abcd',NULL),
(110,41,119,'2022-06-03 07:05:21','2022-06-03 07:05:21',NULL,NULL,NULL,'asdfasdf',NULL),
(111,41,120,'2022-06-03 07:06:56','2022-06-03 07:06:56',NULL,NULL,NULL,'asdfasdf',NULL),
(112,44,121,'2022-06-03 13:23:39','2022-06-03 13:23:39',NULL,NULL,NULL,NULL,NULL),
(113,44,122,'2022-06-03 13:23:39','2022-06-03 13:23:39',NULL,NULL,NULL,NULL,NULL),
(114,15,123,'2022-06-03 13:29:13','2022-06-03 13:29:13',NULL,NULL,NULL,'asdfasdf',NULL),
(115,15,124,'2022-06-03 13:29:24','2022-06-03 13:29:24',NULL,NULL,NULL,'asdfasdf',NULL),
(116,15,125,'2022-06-03 14:37:55','2022-06-03 14:37:55',NULL,NULL,NULL,'asf',NULL),
(117,5,126,'2022-06-04 07:07:26','2022-06-04 07:07:26',NULL,NULL,NULL,'my task is completed here the files',NULL),
(118,42,127,'2022-06-04 07:08:23','2022-06-04 07:08:23',NULL,NULL,NULL,'sfasdf',NULL),
(119,5,128,'2022-06-04 10:19:43','2022-06-04 10:19:43',NULL,NULL,NULL,'asdfasdf',NULL),
(120,5,129,'2022-06-04 10:19:49','2022-06-04 10:19:49',NULL,NULL,NULL,'asdfasdf',NULL),
(121,5,130,'2022-06-04 10:20:33','2022-06-04 10:20:33',NULL,NULL,NULL,'New Document Name',NULL),
(122,44,131,'2022-06-04 10:25:30','2022-06-04 10:25:30',NULL,NULL,NULL,'abcd',NULL),
(123,5,132,'2022-06-06 10:22:47','2022-06-06 10:22:47',NULL,NULL,NULL,'asdfasdf',NULL),
(124,5,133,'2022-06-06 10:23:44','2022-06-06 10:23:44',NULL,NULL,NULL,'asf',NULL),
(125,16,134,'2022-06-06 10:56:55','2022-06-06 10:56:55',NULL,NULL,NULL,'asf',NULL),
(126,16,135,'2022-06-06 11:02:47','2022-06-06 11:02:47',NULL,NULL,NULL,'address',NULL),
(127,1,1,'2022-06-08 13:44:38','2022-06-08 13:44:38',NULL,NULL,NULL,NULL,NULL),
(128,1,2,'2022-06-08 13:44:38','2022-06-08 13:44:38',NULL,NULL,NULL,NULL,NULL),
(129,1,3,'2022-06-09 08:05:47','2022-06-17 12:07:57',NULL,NULL,NULL,'address','Sent'),
(130,1,4,'2022-06-09 08:08:45','2022-06-17 12:07:57',NULL,NULL,NULL,'abcdeeedf','Sent'),
(131,1,5,'2022-06-09 08:09:24','2022-06-09 08:09:24',NULL,NULL,NULL,'addressss',NULL),
(132,1,6,'2022-06-09 08:10:11','2022-06-09 08:10:11',NULL,NULL,NULL,'addresssss',NULL),
(133,1,7,'2022-06-09 08:10:24','2022-06-09 08:10:24',NULL,NULL,NULL,'addressssseeeed',NULL),
(134,1,8,'2022-06-09 08:10:54','2022-06-09 08:10:54',NULL,NULL,NULL,'dddddd',NULL),
(135,1,9,'2022-06-09 08:11:09','2022-06-09 08:11:09',NULL,NULL,NULL,'ddddddeeeef',NULL),
(136,1,10,'2022-06-09 08:55:24','2022-06-09 08:55:24',NULL,NULL,NULL,'ddresssaddressssssdfasdfasdf',NULL),
(137,1,11,'2022-06-09 08:55:29','2022-06-09 08:55:29',NULL,NULL,NULL,'ddresssaddressssssdfasdfasdf',NULL),
(138,1,12,'2022-06-09 08:55:55','2022-06-09 08:55:55',NULL,NULL,NULL,'ddresssaddressssssdfasdfasdf',NULL),
(139,1,13,'2022-06-09 08:57:21','2022-06-10 14:48:19',NULL,NULL,NULL,'ddresssss','Sent'),
(140,1,14,'2022-06-09 09:14:22','2022-06-10 14:48:19',NULL,NULL,NULL,'ddressss','Sent'),
(141,1,15,'2022-06-09 09:15:01','2022-06-10 14:48:19',NULL,NULL,NULL,'address 265','Sent'),
(142,1,16,'2022-06-09 09:16:34','2022-06-10 14:48:19',NULL,NULL,NULL,'my task is completed here the files','Sent'),
(143,2,17,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(144,2,18,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(145,2,19,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(146,2,20,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(147,2,21,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(148,2,22,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(149,2,23,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(150,2,24,'2022-06-10 07:56:44','2022-06-10 07:56:44',NULL,NULL,NULL,NULL,NULL),
(151,2,25,'2022-06-10 09:34:41','2022-06-16 11:44:02',NULL,NULL,101,'addresss','Sent'),
(152,3,26,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(153,3,27,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(154,3,28,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(155,3,29,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(156,3,30,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(157,3,31,'2022-06-10 11:13:20','2022-06-10 11:13:20',NULL,NULL,NULL,NULL,NULL),
(158,3,32,'2022-06-10 11:33:28','2022-06-10 11:33:28',NULL,NULL,334,'hasnain uploaded by hasnain.khan khan',NULL),
(159,3,33,'2022-06-10 11:33:28','2022-06-10 12:06:04',NULL,NULL,334,'hasnain uploaded by hasnain.khan khan','Sent'),
(160,3,34,'2022-06-10 11:33:28','2022-06-10 12:06:04',NULL,NULL,334,'hasnain uploaded by hasnain.khan khan','Sent'),
(161,3,35,'2022-06-10 11:33:28','2022-06-10 12:06:04',NULL,NULL,334,'hasnain uploaded by hasnain.khan khan','Sent'),
(162,3,36,'2022-06-10 11:33:28','2022-06-10 12:06:04',NULL,NULL,334,'hasnain uploaded by hasnain.khan khan','Sent'),
(163,4,37,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(164,4,38,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(165,4,39,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(166,4,40,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(167,4,41,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(168,4,42,'2022-06-10 13:20:01','2022-06-10 13:20:01',NULL,NULL,NULL,NULL,NULL),
(169,5,43,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(170,5,44,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(171,5,45,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(172,5,46,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(173,5,47,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(174,5,48,'2022-06-10 13:29:01','2022-06-10 13:29:01',NULL,NULL,NULL,NULL,NULL),
(175,1,49,'2022-06-10 13:35:30','2022-06-10 13:35:30',NULL,NULL,NULL,NULL,NULL),
(176,1,50,'2022-06-10 13:35:30','2022-06-10 13:35:30',NULL,NULL,NULL,NULL,NULL),
(177,1,51,'2022-06-10 13:35:30','2022-06-10 13:35:30',NULL,NULL,NULL,NULL,NULL),
(178,1,52,'2022-06-10 13:35:30','2022-06-10 13:35:30',NULL,NULL,NULL,NULL,NULL),
(179,1,53,'2022-06-10 13:35:30','2022-06-10 13:35:30',NULL,NULL,NULL,NULL,NULL),
(180,2,54,'2022-06-10 13:55:15','2022-06-10 13:55:15',NULL,NULL,NULL,NULL,NULL),
(181,2,55,'2022-06-10 13:55:15','2022-06-10 13:55:15',NULL,NULL,NULL,NULL,NULL),
(182,3,56,'2022-06-11 06:10:18','2022-06-11 06:10:18',NULL,NULL,NULL,NULL,NULL),
(183,3,57,'2022-06-11 06:10:18','2022-06-11 06:10:18',NULL,NULL,NULL,NULL,NULL),
(184,4,58,'2022-06-11 06:13:17','2022-06-11 06:13:17',NULL,NULL,NULL,NULL,NULL),
(185,4,59,'2022-06-11 06:13:17','2022-06-11 06:13:17',NULL,NULL,NULL,NULL,NULL),
(186,5,60,'2022-06-11 06:46:45','2022-06-11 06:46:45',NULL,NULL,NULL,NULL,NULL),
(187,5,61,'2022-06-11 06:46:45','2022-06-11 06:46:45',NULL,NULL,NULL,NULL,NULL),
(188,4,62,'2022-06-11 07:34:52','2022-06-11 07:40:43',NULL,NULL,330,'check the documents','Sent'),
(189,4,63,'2022-06-11 07:34:52','2022-06-11 07:40:43',NULL,NULL,330,'check the documents','Sent'),
(190,6,64,'2022-06-13 07:19:21','2022-06-13 07:19:21',NULL,NULL,NULL,NULL,NULL),
(191,6,65,'2022-06-13 07:19:21','2022-06-13 07:19:21',NULL,NULL,NULL,NULL,NULL),
(192,6,66,'2022-06-13 07:20:34','2022-06-13 07:20:34',NULL,NULL,101,'my task is completed here the files',NULL),
(193,6,67,'2022-06-13 07:20:34','2022-06-13 07:20:34',NULL,NULL,101,'my task is completed here the files',NULL),
(194,6,68,'2022-06-13 07:20:34','2022-06-13 07:20:34',NULL,NULL,101,'my task is completed here the files',NULL),
(195,6,69,'2022-06-13 07:20:34','2022-06-13 07:20:34',NULL,NULL,101,'my task is completed here the files',NULL),
(196,6,70,'2022-06-13 07:20:34','2022-06-15 10:14:37',NULL,NULL,101,'my task is completed here the files','Sent'),
(197,6,71,'2022-06-13 07:20:34','2022-06-15 10:14:37',NULL,NULL,101,'my task is completed here the files','Sent'),
(198,7,72,'2022-06-13 11:33:22','2022-06-13 11:33:22',NULL,NULL,NULL,NULL,NULL),
(199,7,73,'2022-06-13 11:33:22','2022-06-13 11:33:22',NULL,NULL,NULL,NULL,NULL),
(200,8,74,'2022-06-13 11:41:27','2022-06-13 11:41:27',NULL,NULL,NULL,NULL,NULL),
(201,8,75,'2022-06-13 11:41:27','2022-06-13 11:41:27',NULL,NULL,NULL,NULL,NULL),
(202,9,76,'2022-06-13 13:17:13','2022-06-13 13:17:13',NULL,NULL,NULL,NULL,NULL),
(203,9,77,'2022-06-13 13:17:13','2022-06-13 13:17:13',NULL,NULL,NULL,NULL,NULL),
(204,10,78,'2022-06-13 13:19:58','2022-06-13 13:19:58',NULL,NULL,NULL,NULL,NULL),
(205,10,79,'2022-06-13 13:19:58','2022-06-13 13:19:58',NULL,NULL,NULL,NULL,NULL),
(206,11,80,'2022-06-13 13:23:23','2022-06-13 13:23:23',NULL,NULL,NULL,NULL,NULL),
(207,11,81,'2022-06-13 13:23:23','2022-06-13 13:23:23',NULL,NULL,NULL,NULL,NULL),
(208,12,82,'2022-06-14 09:55:12','2022-06-14 09:55:12',NULL,NULL,NULL,NULL,NULL),
(209,12,83,'2022-06-14 09:55:12','2022-06-14 09:55:12',NULL,NULL,NULL,NULL,NULL),
(210,12,84,'2022-06-14 10:01:10','2022-06-14 10:04:19',NULL,NULL,334,'asdfasdf','Sent'),
(211,12,85,'2022-06-14 10:01:10','2022-06-14 10:04:19',NULL,NULL,334,'asdfasdf','Sent'),
(213,12,87,'2022-06-14 12:29:35','2022-06-14 12:29:35',NULL,NULL,334,'faild document','Failed'),
(214,12,88,'2022-06-14 12:29:35','2022-06-14 12:29:35',NULL,NULL,334,'faild document','Failed'),
(215,12,89,'2022-06-14 12:29:35','2022-06-14 12:29:35',NULL,NULL,NULL,NULL,'Sent'),
(216,12,90,'2022-06-14 12:34:50','2022-06-14 12:34:50',NULL,NULL,NULL,'failed document by sale user','Failed'),
(217,12,91,'2022-06-14 12:38:41','2022-06-14 12:38:41',NULL,NULL,NULL,'failed document by sale user','Failed'),
(218,12,92,'2022-06-14 12:39:57','2022-06-14 12:39:57',NULL,NULL,NULL,'failed document by sale user','Failed'),
(219,1,93,'2022-06-14 12:54:28','2022-06-14 12:54:28',NULL,NULL,NULL,'failed document by sale user','Failed'),
(220,1,94,'2022-06-14 12:55:50','2022-06-14 12:55:50',NULL,NULL,NULL,'failed document by sale user','Failed'),
(221,13,95,'2022-06-15 07:33:18','2022-06-15 07:33:18',NULL,NULL,NULL,NULL,NULL),
(222,13,96,'2022-06-15 07:33:18','2022-06-15 07:33:18',NULL,NULL,NULL,NULL,NULL),
(223,13,97,'2022-06-15 08:30:44','2022-06-15 08:39:50',NULL,NULL,329,'addresss','Sent'),
(224,13,98,'2022-06-15 08:31:00','2022-06-15 08:39:50',NULL,NULL,329,'dressss','Sent'),
(225,13,99,'2022-06-15 08:42:44','2022-06-15 08:43:00',NULL,NULL,332,'aaaa','Sent'),
(226,13,100,'2022-06-15 08:44:15','2022-06-15 08:44:33',NULL,NULL,332,'asdfasdf','Sent'),
(227,13,101,'2022-06-15 08:45:43','2022-06-15 08:45:55',NULL,NULL,332,'asdfasdf','Sent'),
(228,13,102,'2022-06-15 08:47:05','2022-06-15 09:31:06',NULL,NULL,332,'sasdfasdf','Sent'),
(229,13,103,'2022-06-15 09:32:24','2022-06-15 09:32:32',NULL,NULL,332,'asdfasdf','Sent'),
(230,11,104,'2022-06-15 10:00:45','2022-06-15 10:00:45',NULL,NULL,330,'address',NULL),
(231,10,105,'2022-06-15 10:05:53','2022-06-15 10:11:53',NULL,NULL,333,'adfsdfasdf','Sent'),
(232,10,106,'2022-06-15 10:12:55','2022-06-15 10:13:02',NULL,NULL,333,'asdf','Sent'),
(233,2,107,'2022-06-16 11:44:54','2022-06-16 11:45:08',NULL,NULL,332,'asdf','Sent'),
(234,1,1,'2022-06-16 12:21:19','2022-06-16 12:21:19',NULL,NULL,NULL,NULL,NULL),
(235,1,2,'2022-06-16 12:21:19','2022-06-16 12:21:19',NULL,NULL,NULL,NULL,NULL),
(236,1,4,'2022-06-17 12:07:28','2022-06-17 12:07:57',NULL,NULL,332,'asdfasdf','Sent'),
(237,1,3,'2022-06-17 12:07:28','2022-06-17 12:07:57',NULL,NULL,332,'asdfasdf','Sent'),
(238,2,5,'2022-06-20 05:52:38','2022-06-20 05:52:38',NULL,NULL,NULL,NULL,NULL),
(239,2,6,'2022-06-20 05:52:38','2022-06-20 05:52:38',NULL,NULL,NULL,NULL,NULL),
(240,3,7,'2022-06-20 06:04:22','2022-06-20 06:04:22',NULL,NULL,NULL,NULL,NULL),
(241,3,8,'2022-06-20 06:04:22','2022-06-20 06:04:22',NULL,NULL,NULL,NULL,NULL),
(242,4,9,'2022-06-20 06:06:21','2022-06-20 06:06:21',NULL,NULL,NULL,NULL,NULL),
(243,4,10,'2022-06-20 06:06:21','2022-06-20 06:06:21',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `sale_order_subjects` */

DROP TABLE IF EXISTS `sale_order_subjects`;

CREATE TABLE `sale_order_subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subject_id` bigint(20) NOT NULL,
  `sale_order_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_order_subjects` */

/*Table structure for table `sale_orders` */

DROP TABLE IF EXISTS `sale_orders`;

CREATE TABLE `sale_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_user_id` bigint(20) NOT NULL,
  `word_count` bigint(20) DEFAULT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `currency` decimal(8,2) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_type` enum('EXISTING','NEW','REFFERAL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `amount_received` bigint(20) DEFAULT NULL,
  `deadline` timestamp NULL DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_notes` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_file_id` bigint(20) DEFAULT NULL,
  `start_date_time` timestamp NULL DEFAULT NULL,
  `end_date_time` timestamp NULL DEFAULT NULL,
  `payment_status` enum('PAID','UNPAID','PARTIALLY PAID') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','DISABLED','PENDING') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_urgent` tinyint(4) DEFAULT 0,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `order_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dollar_amount` decimal(8,2) DEFAULT NULL,
  `feedback` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_orders` */

insert  into `sale_orders`(`id`,`title`,`created_by_user_id`,`word_count`,`currency_id`,`currency`,`customer_name`,`customer_email`,`customer_type`,`amount`,`amount_received`,`deadline`,`notes`,`additional_notes`,`invoice_file_id`,`start_date_time`,`end_date_time`,`payment_status`,`status`,`is_urgent`,`website`,`created_at`,`updated_at`,`deleted_at`,`order_id`,`lead_id`,`subject_id`,`order_status`,`dollar_amount`,`feedback`) values 
(1,'hasnain lead 1 order',337,100,4,NULL,'billal ahmed','billal.ahmed.sale.manager@gmail.com','EXISTING',10,7,'2022-06-18 17:20:00','addressa','address',NULL,NULL,NULL,'PARTIALLY PAID',NULL,0,'1','2022-06-16 12:21:19','2022-06-17 14:13:08',NULL,'ORDER-1',1,1,'Delivered',7.87,0),
(2,'hasnain khan',101,23123,2,NULL,'hasnain khan','hansain.khan@gmail.com','EXISTING',23,NULL,'2022-06-21 10:52:00','address','address',NULL,NULL,NULL,'PAID',NULL,1,'1','2022-06-20 05:52:38','2022-06-20 05:52:38',NULL,'ORDER-2',1,1,'New',23.00,0),
(3,'teting orders',338,9987,2,NULL,'hasnain leadd khan','hasnain.leads.khan@gmail.com','EXISTING',11110,NULL,'2022-06-21 11:01:00','address','addresss',NULL,NULL,NULL,'PAID',NULL,0,'1','2022-06-20 06:04:22','2022-06-21 16:49:44',NULL,'ORDER-3',2,1,'Pending',11110.00,0),
(4,'address',338,123123123,1,NULL,'hasnain leadd khan','hasnain.leads.khan@gmail.com','EXISTING',8000,1000,'2022-06-20 11:05:00','adderss','address',NULL,NULL,NULL,'PARTIALLY PAID',NULL,1,'1','2022-06-20 06:06:21','2022-06-20 17:30:25',NULL,'ORDER-4',1,1,'Pending',10126.58,0);

/*Table structure for table `statuses` */

DROP TABLE IF EXISTS `statuses`;

CREATE TABLE `statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `order` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `statuses` */

insert  into `statuses`(`id`,`type`,`title`,`is_active`,`order`,`created_at`,`updated_at`,`created_by`) values 
(1,'task','New',1,1,'2022-06-16 12:21:19','2022-06-16 12:21:19',337),
(2,'task','Ready to QA',1,1,'2022-06-17 12:05:48','2022-06-17 12:05:48',101),
(3,'task','QA Approved',1,1,'2022-06-17 12:07:57','2022-06-17 12:07:57',332),
(4,'task','Delivered',1,1,'2022-06-17 14:13:08','2022-06-17 14:13:08',NULL),
(5,'task','New',1,2,'2022-06-20 05:52:38','2022-06-20 05:52:38',101),
(6,'task','New',1,3,'2022-06-20 06:04:22','2022-06-20 06:04:22',338),
(7,'task','New',1,4,'2022-06-20 06:06:21','2022-06-20 06:06:21',338),
(8,'task','Pending',1,4,'2022-06-20 17:30:25','2022-06-20 17:30:25',101),
(9,'task','Pending',1,3,'2022-06-21 16:49:44','2022-06-21 16:49:44',332);

/*Table structure for table `subjects` */

DROP TABLE IF EXISTS `subjects`;

CREATE TABLE `subjects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subjects` */

insert  into `subjects`(`id`,`name`,`parent_id`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Englsh',NULL,'2022-06-10 00:00:00','2022-06-10 13:34:27',NULL);

/*Table structure for table `task_working_status` */

DROP TABLE IF EXISTS `task_working_status`;

CREATE TABLE `task_working_status` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `task_working_status` */

/*Table structure for table `tutorial` */

DROP TABLE IF EXISTS `tutorial`;

CREATE TABLE `tutorial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `doc` text NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` varchar(256) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` varchar(256) NOT NULL,
  `screen_name` varchar(25) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tutorial` */

insert  into `tutorial`(`id`,`title`,`doc`,`created_at`,`created_by`,`updated_at`,`updated_by`,`screen_name`,`image`) values 
(3,'asdf','1655534467.mp4','2022-06-18 06:41:07','101','2022-06-18 06:41:07','101','home','1655534467.jpeg'),
(4,'hasaf','1655534716.mp4','2022-06-18 06:45:16','101','2022-06-18 06:45:16','101','home','1655534716.jpg'),
(5,'hasnain','1655534830.mp4','2022-06-18 06:47:10','101','2022-06-18 06:47:10','101','home','1655534830.jpeg'),
(6,'asdfasdf','1655534945.mp4','2022-06-18 06:49:05','101','2022-06-18 06:49:05','101','home','1655534945.jpeg'),
(7,'dsdfasdf','1655535624.mp4','2022-06-18 07:00:24','101','2022-06-18 07:00:24','101','home','1655535624.jpeg'),
(8,'asdfasdf','1655535647.mp4','2022-06-18 07:00:47','101','2022-06-18 07:00:47','101','home','1655535647.jpeg'),
(9,'asdfasdf','1655536193.jpeg','2022-06-18 07:09:53','101','2022-06-18 07:09:53','101','home','1655536193.jpg');

/*Table structure for table `user_order_task_details` */

DROP TABLE IF EXISTS `user_order_task_details`;

CREATE TABLE `user_order_task_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `completed` int(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_order_task_details` */

insert  into `user_order_task_details`(`id`,`user_id`,`order_id`,`status`,`completed`,`created_at`,`updated_at`,`text`,`created_by`) values 
(1,328,1,'In Progress',NULL,'2022-06-10 13:45:58','2022-06-10 13:45:58','User Status changed In Progress, ',327),
(2,330,1,'Ready to QA',NULL,'2022-06-10 14:15:08','2022-06-10 14:15:08','User Status changed Ready to QA, ',330),
(3,330,1,NULL,50,'2022-06-10 14:23:58','2022-06-10 14:23:58','User Progress updated 50%, ',330),
(4,330,1,NULL,49,'2022-06-10 14:24:16','2022-06-10 14:24:16','User Progress updated 49%, ',327),
(5,330,1,NULL,90,'2022-06-10 14:24:20','2022-06-10 14:24:20','User Progress updated 90%, ',327),
(6,330,1,'QA Approved',NULL,'2022-06-10 14:36:17','2022-06-10 14:36:17','User Status changed QA Approved, ',332),
(7,330,1,'Ready to QA',NULL,'2022-06-10 14:48:12','2022-06-10 14:48:12','User Status changed Ready to QA, ',332),
(8,330,1,'QA Approved',NULL,'2022-06-10 14:49:29','2022-06-10 14:49:29','User Status changed QA Approved, ',332),
(9,330,4,'In Progress',NULL,'2022-06-11 06:42:33','2022-06-11 06:42:33','User Status changed In Progress, ',330),
(10,330,4,'In Progress',50,'2022-06-11 06:42:40','2022-06-11 06:42:40','User Status changed In Progress, Progress updated 50%, ',330),
(11,330,4,'Ready to QA',NULL,'2022-06-11 07:33:29','2022-06-11 07:33:29','User Status changed Ready to QA, ',330),
(12,334,4,'Ready to QA',NULL,'2022-06-11 07:34:13','2022-06-11 07:34:13','User Status changed Ready to QA, ',101),
(13,334,4,'Ready to QA',100,'2022-06-11 07:34:17','2022-06-11 07:34:17','User Status changed Ready to QA, Progress updated 100%, ',101),
(14,334,4,'Ready to QA',100,'2022-06-11 07:34:21','2022-06-11 07:34:21','User Status changed Ready to QA, Progress updated 100%, ',101),
(15,330,1,NULL,100,'2022-06-11 07:52:25','2022-06-11 07:52:25','User Progress updated 100%, ',337),
(16,330,1,NULL,100,'2022-06-11 07:52:30','2022-06-11 07:52:30','User Progress updated 100%, ',337),
(17,327,6,'In Progress',NULL,'2022-06-13 07:36:14','2022-06-13 07:36:14','User Status changed In Progress, ',327),
(18,327,6,'In Progress',80,'2022-06-13 07:36:19','2022-06-13 07:36:19','User Status changed In Progress, Progress updated 80%, ',327),
(19,327,6,NULL,99,'2022-06-13 07:41:17','2022-06-13 07:41:17','User Progress updated 99%, ',327),
(20,327,6,NULL,100,'2022-06-13 07:41:23','2022-06-13 07:41:23','User Progress updated 100%, ',327),
(21,327,6,'Ready to QA',100,'2022-06-13 07:41:39','2022-06-13 07:41:39','User Status changed Ready to QA, Progress updated 100%, ',327),
(22,328,10,'Ready to QA',NULL,'2022-06-14 09:10:01','2022-06-14 09:10:01','User Status changed Ready to QA, ',101),
(23,334,12,'In Progress',NULL,'2022-06-14 10:00:48','2022-06-14 10:00:48','User Status changed In Progress, ',334),
(24,334,12,'Ready to QA',NULL,'2022-06-14 10:01:23','2022-06-14 10:01:23','User Status changed Ready to QA, ',334),
(25,329,13,'Ready to QA',NULL,'2022-06-15 08:31:15','2022-06-15 08:31:15','User Status changed Ready to QA, ',329),
(26,329,13,'In Progress',NULL,'2022-06-15 09:22:17','2022-06-15 09:22:17','User Status changed In Progress, ',332),
(27,329,13,'Ready to QA',NULL,'2022-06-15 09:23:53','2022-06-15 09:23:53','User Status changed Ready to QA, ',332),
(28,330,11,'In Progress',NULL,'2022-06-15 09:44:19','2022-06-15 09:44:19','User Status changed In Progress, ',330),
(29,330,11,'Ready to QA',NULL,'2022-06-15 10:01:07','2022-06-15 10:01:07','User Status changed Ready to QA, ',330),
(30,330,11,'In Progress',NULL,'2022-06-15 10:03:36','2022-06-15 10:03:36','User Status changed In Progress, ',333),
(31,330,11,'Ready to QA',NULL,'2022-06-15 10:04:31','2022-06-15 10:04:31','User Status changed Ready to QA, ',333),
(32,328,10,'QA Approved',NULL,'2022-06-15 10:06:19','2022-06-15 10:06:19','User Status changed QA Approved, ',333),
(33,328,6,'Ready to QA',NULL,'2022-06-15 10:14:11','2022-06-15 10:14:11','User Status changed Ready to QA, ',333),
(34,328,6,'Ready to QA',100,'2022-06-15 10:14:19','2022-06-15 10:14:19','User Status changed Ready to QA, Progress updated 100%, ',333),
(35,330,5,'Ready to QA',NULL,'2022-06-15 10:15:35','2022-06-15 10:15:35','User Status changed Ready to QA, ',333),
(36,330,5,'Ready to QA',100,'2022-06-15 10:15:38','2022-06-15 10:15:38','User Status changed Ready to QA, Progress updated 100%, ',333),
(37,330,5,'QA Approved',NULL,'2022-06-15 10:19:31','2022-06-15 10:19:31','User Status changed QA Approved, ',333),
(38,329,2,'Ready to QA',NULL,'2022-06-16 11:43:41','2022-06-16 11:43:41','User Status changed Ready to QA, ',332),
(39,329,2,'Ready to QA',100,'2022-06-16 11:43:45','2022-06-16 11:43:45','User Status changed Ready to QA, Progress updated 100%, ',332),
(40,329,2,'QA Approved',NULL,'2022-06-16 11:45:01','2022-06-16 11:45:01','User Status changed QA Approved, ',332),
(41,330,1,'Ready to QA',NULL,'2022-06-17 12:05:44','2022-06-17 12:05:44','User Status changed Ready to QA, ',101),
(42,330,1,'QA Approved',NULL,'2022-06-17 12:07:54','2022-06-17 12:07:54','User Status changed QA Approved, ',332);

/*Table structure for table `user_ratings` */

DROP TABLE IF EXISTS `user_ratings`;

CREATE TABLE `user_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `rating` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_ratings` */

insert  into `user_ratings`(`id`,`user_id`,`order_id`,`rating`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,330,1,'{\"compliance_and_relevance\":4,\"overall_quality_of_the_content\":4,\"referencing\":4}','2022-06-17 12:08:09','2022-06-17 12:08:09',332,NULL);

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_roles` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `assigned_to` bigint(20) unsigned DEFAULT NULL,
  `profile_image_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE','DISABLED','PENDING') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_lead` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `is_qa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=339 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`first_name`,`last_name`,`email`,`designation`,`phone_number`,`alternate_phone_number`,`salary`,`city_id`,`dob`,`assigned_to`,`profile_image_id`,`email_verified_at`,`password`,`status`,`remember_token`,`created_at`,`updated_at`,`deleted_at`,`nickname`,`is_lead`,`lead_id`,`is_qa`) values 
(1,'Fay Champlin',NULL,NULL,'darryl.franecki@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BxgAfywJ56','2022-04-21 10:06:06','2022-04-21 10:06:06',NULL,NULL,NULL,NULL,NULL),
(2,'Vicky Rogahn',NULL,NULL,'alden.barrows@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fCDkSaEN6S','2022-04-21 10:06:06','2022-06-13 08:10:29','2022-06-13 08:10:29',NULL,NULL,NULL,NULL),
(3,'Erin D\'Amore',NULL,NULL,'tatyana.pagac@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'MVLP0ygecE','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(4,'Dr. Sherwood Fay',NULL,NULL,'braun.kenna@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0e4JzW3j07','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(5,'Prof. Alexander Rohan',NULL,NULL,'saige.rohan@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'1H3If5ZFVL','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(6,'Regan Conn',NULL,NULL,'dabbott@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'78yVUZxPQS','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(7,'Casey Monahan MD',NULL,NULL,'boehm.celestine@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'gjiQlwhiRZ','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(8,'Mallie Harris',NULL,NULL,'william.hyatt@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'iWYPukpUji','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(9,'Alphonso Dicki',NULL,NULL,'fritsch.jade@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'AmuJx8J6VC','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(10,'Rosamond Welch',NULL,NULL,'ebert.mike@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'TCMateZ9uU','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(11,'Denis West PhD',NULL,NULL,'hilma88@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nsb2MPVOFf','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(12,'Tanya Kub',NULL,NULL,'wmertz@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'5hUohgwUUf','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(13,'Edwina Predovic',NULL,NULL,'rbednar@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JA4FaHa19c','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(14,'Miss Destiny Jacobson',NULL,NULL,'cristian.lesch@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'VtXEY9m3wF','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(15,'Mrs. Bernadine Wiza',NULL,NULL,'dhartmann@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tMd6qXrKnW','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(16,'Arianna Rogahn IV',NULL,NULL,'skylar.hodkiewicz@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ifNDPbx2Fe','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(17,'Josephine Lesch',NULL,NULL,'jadyn.homenick@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'N6wWSxOpye','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(18,'Amya Graham',NULL,NULL,'michale.zboncak@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'61OKQmVNaP','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(19,'Vivianne Schaden PhD',NULL,NULL,'reed20@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'XdzCpnzW95','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(20,'Gilda Stokes',NULL,NULL,'trenton.borer@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'dKETzZjJqj','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(21,'Erna Kovacek IV',NULL,NULL,'sanford.kirstin@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vx8O3YSUFk','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(22,'Rosalind Blanda',NULL,NULL,'garett17@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'HJK732HXbl','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(23,'Marielle Flatley III',NULL,NULL,'aufderhar.louisa@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'IO52YJjmmj','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(24,'Keara Terry V',NULL,NULL,'uriah53@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mIZ1XGKuct','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(25,'Prof. Libbie Conn',NULL,NULL,'fbernhard@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'NXzqgPKk1S','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(26,'Dr. Ena Osinski V',NULL,NULL,'prohaska.aurelia@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EJ45CH9gPe','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(27,'Lizzie Simonis',NULL,NULL,'schulist.ruthie@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'MGNCzUXJr1','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(28,'Prof. Zackary Russel',NULL,NULL,'vonrueden.uriel@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'7mOv4X25lF','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(29,'Kristopher Hoppe',NULL,NULL,'hermiston.adelia@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'73JNB51IG1','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(30,'Ms. Kathlyn Dach I',NULL,NULL,'nienow.anastacio@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'svfkQ5f52G','2022-04-21 10:06:07','2022-05-24 07:15:32','2022-05-24 07:15:32',NULL,NULL,NULL,NULL),
(31,'Mr. Foster Pfannerstill III',NULL,NULL,'lacey.borer@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'dyhTqqHg6Z','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(32,'Rhianna Hand',NULL,NULL,'shaniya19@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'B6yllxAGVs','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(33,'Prof. Misael Mohr III',NULL,NULL,'swaniawski.ariane@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'HiQCadPjQJ','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(34,'Imelda Hammes',NULL,NULL,'pleuschke@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JQWuvnCkBS','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(35,'Thea Pfannerstill Sr.',NULL,NULL,'sauer.angus@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'wIuIpf5GMd','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(36,'Stephanie O\'Reilly',NULL,NULL,'abdullah.hessel@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'OJ3957UjMt','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(37,'Alfred Kub',NULL,NULL,'guillermo35@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'LTaXxFY1sg','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(38,'Nelle Olson',NULL,NULL,'rkoss@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'migcZytia1','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(39,'Nia Grimes',NULL,NULL,'alex.rippin@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'gdDQH3ip5z','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(40,'Laverne Lesch Sr.',NULL,NULL,'mariam.altenwerth@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'5BswDgk77T','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(41,'Dr. Eldred Spencer III',NULL,NULL,'frida66@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'WgSqRnyDHS','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(42,'Barrett Bartell',NULL,NULL,'rigoberto.steuber@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'6lxPh1EMZh','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(43,'Felipa Schoen DVM',NULL,NULL,'west.julianne@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RppL8ff5l4','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(44,'Mr. Carter Ortiz',NULL,NULL,'emory57@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0bs9XuCqEd','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(45,'Evan Schaefer',NULL,NULL,'presley90@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vNtU8WipRy','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(46,'Mr. Micah Kessler V',NULL,NULL,'wanda76@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JJDl7xQUR0','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(47,'Jessie Hyatt',NULL,NULL,'schiller.abdullah@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'4LmBSqU2EV','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(48,'Isabell Bartoletti',NULL,NULL,'roob.jannie@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'SGDBXbR5YU','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(49,'Bart VonRueden',NULL,NULL,'fhirthe@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Bu4EZCChKU','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(50,'Julia Trantow',NULL,NULL,'mozell.von@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JLaVUqnUMR','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(51,'Nelda Hauck',NULL,NULL,'fsmitham@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Q1XWzGrKSk','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(52,'Muhammad Emmerich',NULL,NULL,'lucienne92@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vK4qgXak2W','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(53,'Whitney Brown',NULL,NULL,'wdoyle@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'NSblRaekdB','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(54,'Casimer Torphy',NULL,NULL,'vbeahan@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'J87cdXr5uA','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(55,'Rae Gerhold DVM',NULL,NULL,'karelle07@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0qTLtNXFi1','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(56,'Ignacio Steuber II',NULL,NULL,'rbernhard@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tRtRgRGRtG','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(57,'Prof. Breana Hirthe',NULL,NULL,'lehner.claude@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BXUJULYfX3','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(58,'Mr. Muhammad Grady',NULL,NULL,'alize.prohaska@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ieoW3SpBO4','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(59,'Arno Dare',NULL,NULL,'wwuckert@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'VtTuyYRlzr','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(60,'Stella Casper',NULL,NULL,'merl76@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tGw418HpAL','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(61,'Mr. Ferne Barrows',NULL,NULL,'audrey.jakubowski@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vB8cwEp5ye','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(62,'Dereck O\'Kon PhD',NULL,NULL,'camila64@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'7qji89ctTc','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(63,'Olaf Rau',NULL,NULL,'dejuan52@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'zb497fZSHU','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(64,'Roosevelt Wunsch',NULL,NULL,'ctreutel@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'uDDW5c1Fsi','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(65,'Shanon Moore',NULL,NULL,'burdette98@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'z92gLdruTo','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(66,'Haven Nader',NULL,NULL,'hettie.wisozk@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2niThhED1S','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(67,'Cristina Weimann',NULL,NULL,'misty.boyer@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'s8hJYEycDx','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(68,'Jeanne Welch',NULL,NULL,'uflatley@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'g6KwgIrAJE','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(69,'Palma Purdy',NULL,NULL,'josefa.mante@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'hZk5bIOoua','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(70,'Teresa Pollich',NULL,NULL,'darrin.schmeler@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'4fLndStAQr','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(71,'Merl Hammes',NULL,NULL,'yabernathy@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vUu7jW5wkL','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(72,'Forrest Wiza DVM',NULL,NULL,'gerson63@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'wX5G5OXSOg','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(73,'Ms. Leta Kling III',NULL,NULL,'tkiehn@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'G9cWS5hDAR','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(74,'Rosetta Mraz',NULL,NULL,'mathew.boyle@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'PszBQusWJQ','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(75,'Eliseo Paucek',NULL,NULL,'freida.tremblay@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'GzoddZ2llz','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(76,'Lilla Rice I',NULL,NULL,'dietrich.bettie@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Q68oJasj7F','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(77,'Mr. Buck Beer',NULL,NULL,'heidenreich.lia@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tC4RJwyYnF','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(78,'Mrs. Audie Tremblay I',NULL,NULL,'jevon42@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'7CSZUl50Kf','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(79,'Mireya Goodwin',NULL,NULL,'marietta30@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'KrKF7Ecr4G','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(80,'Brooks Hermann',NULL,NULL,'marisa.hayes@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ZMrIUz9aJe','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(81,'Oleta Kuhn',NULL,NULL,'zpollich@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'3X18jzniAp','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(82,'Prof. Jayme Padberg PhD',NULL,NULL,'bartell.alivia@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'uDsPzdoIEO','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(83,'Columbus Bernier',NULL,NULL,'treinger@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'FLNqJCyHSt','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(84,'Devin Stamm',NULL,NULL,'lynch.ebony@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'CI8f0roFVh','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(85,'Connor Marvin',NULL,NULL,'camylle.watsica@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'x00SLaCYIZ','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(86,'Chadd Mohr',NULL,NULL,'mayer.octavia@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'GNrGQbPs8R','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(87,'Brooke Will',NULL,NULL,'tberge@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'WNbFR0IK8O','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(88,'Matilda Goyette',NULL,NULL,'kattie57@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'kJ7KzPfhgR','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(89,'Dakota Abernathy Jr.',NULL,NULL,'rory09@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RBAgYAOYkg','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(90,'Lesly Rutherford',NULL,NULL,'horacio51@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'qx8V0j3Z03','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(91,'Murray Cummerata',NULL,NULL,'osporer@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'upmTo6vVad','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(92,'Norene Gusikowski',NULL,NULL,'wendy63@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'UP0TOZgwUr','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(93,'Marcelle Kulas',NULL,NULL,'emmy54@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'y7ZINwVSGw','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(94,'Cathy Rodriguez',NULL,NULL,'casimir.nienow@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'gRrj2boyno','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(95,'Christa Bergstrom',NULL,NULL,'flatley.nicole@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'9femCZaNFC','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(96,'Caleigh Schulist',NULL,NULL,'oframi@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'B3vNyZvcOV','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(97,'Prof. Jean Pfeffer V',NULL,NULL,'constantin46@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vJQWMBiBH7','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(98,'Vergie Emard',NULL,NULL,'rice.aniya@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'m4gogOOyNn','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(99,'Prof. Madison Gibson Sr.',NULL,NULL,'fisher.alvena@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'KCU6PjIHY9','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(100,'Ansel Weissnat',NULL,NULL,'xsenger@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-21 10:06:06','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8EqbgtNNxK','2022-04-21 10:06:07','2022-04-21 10:06:07',NULL,NULL,NULL,NULL,NULL),
(101,'admin','Admin','admin','admin@admin.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'profile_images/user_101/profile-image-20220621123245.jpg',NULL,'$2y$10$uEUjtYbhz2v2SpLqICp1VedJr4bJdzcp5FCkDvMAQuiqdc7Taphi6','ACTIVE',NULL,'2022-04-21 10:06:07','2022-06-21 12:32:45',NULL,NULL,NULL,NULL,NULL),
(102,'Wendell Rau',NULL,NULL,'litzy.ferry@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pYzPjQKeYd','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(103,'Jaden Durgan Sr.',NULL,NULL,'leon.hegmann@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fgFhF4LBRr','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(104,'Rita Heller',NULL,NULL,'josianne97@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'YySzVg83Rj','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(105,'Letha Schmitt MD',NULL,NULL,'mueller.robin@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'II9k3MATYk','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(106,'Prof. Tracey Rowe PhD',NULL,NULL,'reichel.natasha@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'W7S1pcH4ng','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(107,'Mrs. Beaulah Bosco MD',NULL,NULL,'jaydon22@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'O9Q8IXqwpX','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(108,'Mr. Moses Lindgren V',NULL,NULL,'blaise83@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'FSy1oqC0EV','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(109,'Angela Waelchi',NULL,NULL,'dkoepp@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'AzHEXVoywL','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(110,'Miss Marlen Robel',NULL,NULL,'mmorar@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RL30Ti9Lbe','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(111,'Mrs. Leanne Bode III',NULL,NULL,'kaylee.mclaughlin@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BxyVnMP3gV','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(112,'Ali Bashirian',NULL,NULL,'rosanna74@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'9o5H6YAUaa','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(113,'Lori Orn',NULL,NULL,'grant.adeline@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Bksm7dUGb2','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(114,'Angus Sauer',NULL,NULL,'kohler.loren@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'d2mE7vrdEg','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(115,'Delfina Blick',NULL,NULL,'samara.runte@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nUkUifu2ng','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(116,'Dr. Frederik Sporer MD',NULL,NULL,'jyost@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'s8QfeLByRi','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(117,'Griffin Langosh',NULL,NULL,'patience77@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ntG8escOZ1','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(118,'Mortimer Herzog',NULL,NULL,'ricky90@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mlba7eRoTS','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(119,'Abel Reynolds',NULL,NULL,'eriberto.daniel@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'REo0gMN82U','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(120,'Arlene Graham',NULL,NULL,'alf91@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'IkEtxTIRzr','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(121,'Prof. Larry Erdman Jr.',NULL,NULL,'nikolaus.kamille@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QEjB6KFTY9','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(122,'Aubrey Emmerich',NULL,NULL,'tcrona@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'lBN5pUVW4e','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(123,'Miss Asa Monahan',NULL,NULL,'adela.dibbert@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2una7GsBkm','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(124,'Reid Lind II',NULL,NULL,'tavares44@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'v9JNXxG5aP','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(125,'Dixie Wintheiser',NULL,NULL,'jadon.grady@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'61r5FMj22A','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(126,'Emmitt Larson',NULL,NULL,'rolfson.jany@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EEv74Ha4uK','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(127,'Dion Bernhard',NULL,NULL,'emard.brenda@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RKhUW2mPBJ','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(128,'Pauline Yundt',NULL,NULL,'olangosh@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mKo5CNTiOx','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(129,'Miss Queen Cummings DVM',NULL,NULL,'myrl55@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'zwAj1SGIxw','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(130,'Prof. Mavis Kreiger IV',NULL,NULL,'justyn56@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8Zda2J3QL8','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(131,'Prof. Hattie Sawayn DVM',NULL,NULL,'lklein@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'3nkesecZjj','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(132,'Miss Vivienne Maggio',NULL,NULL,'ehauck@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pFgN4AVjuA','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(133,'Alfreda Erdman',NULL,NULL,'jcassin@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'3rghaSpcXQ','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(134,'Zetta Leffler DVM',NULL,NULL,'mekhi.schaden@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mkvJKY4oCN','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(135,'Cleve Langworth',NULL,NULL,'huel.karley@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'6S33zSpVlg','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(136,'Antonio Dooley',NULL,NULL,'vena.reichert@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ubuU6LWaai','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(137,'Justen Lebsack',NULL,NULL,'milan.tillman@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Tqp9fMbKVo','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(138,'Antonina D\'Amore III',NULL,NULL,'ymohr@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'H5y9UcK3GV','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(139,'Linnea Kreiger',NULL,NULL,'oward@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Dt1zVcYBCb','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(140,'Mr. Giovani Shanahan',NULL,NULL,'eichmann.clifton@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'zL2NqjePvK','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(141,'Rasheed Emmerich III',NULL,NULL,'modesto.kunde@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'od1Pxk8exv','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(142,'Kaylah Mills DVM',NULL,NULL,'giovanni45@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'lfzWJFNUIt','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(143,'Hayley Schamberger',NULL,NULL,'jbartoletti@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'AzSJiVC45H','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(144,'Isobel Okuneva',NULL,NULL,'von.rosemary@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'iM4AVS1eSX','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(145,'Prof. Cathryn Bednar Jr.',NULL,NULL,'ustark@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'TQ4zpPkvXw','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(146,'Dorcas McLaughlin DDS',NULL,NULL,'lela31@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'dSeyzdFn76','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(147,'Melvin Marks',NULL,NULL,'baron73@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BC28nhiJL9','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(148,'Dr. Loren Johns',NULL,NULL,'rodger49@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'CrmssF6Xnv','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(149,'Enrico Effertz',NULL,NULL,'einar.haag@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'IiRFaMqmMn','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(150,'Erica Windler MD',NULL,NULL,'kling.roderick@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'UhK5hQFvtT','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(151,'Dr. Keshaun Emmerich',NULL,NULL,'thelma85@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2JW0Brh3X0','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(152,'Dr. Lonny Dietrich V',NULL,NULL,'abbott.lexie@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nNDjhk1j5X','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(153,'Aimee Schaden',NULL,NULL,'gibson.conrad@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'3xGkHf651a','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(154,'Dr. Justine Ruecker',NULL,NULL,'mathew93@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'FHxXEHlXtg','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(155,'Prof. Gunner Gleichner III',NULL,NULL,'schowalter.oswaldo@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fm0Rqp5Wzo','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(156,'Johnson Bashirian',NULL,NULL,'darmstrong@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'NBpkc6trGd','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(157,'Cortez Kris',NULL,NULL,'kathryne.bosco@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'cqxpoks5pW','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(158,'Pearline Conn',NULL,NULL,'sabina33@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'FbuTZHLHT3','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(159,'Herbert Towne',NULL,NULL,'chalvorson@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'u2hcargZUK','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(160,'Mariela Tromp',NULL,NULL,'callie22@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'YA0W9rjTTR','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(161,'Prof. Miracle Crist',NULL,NULL,'toy.bailey@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'VkIgdZmanX','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(162,'Prof. Jovany Corwin II',NULL,NULL,'kgorczany@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'H0IpcyBQ7T','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(163,'Olin Wuckert',NULL,NULL,'morris60@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ETYyCoAFL2','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(164,'Prof. Ila Dare MD',NULL,NULL,'qquigley@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'OtRzAJgJJw','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(165,'Ms. Amanda Breitenberg',NULL,NULL,'carlo.oconnell@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8UnK7o3CKT','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(166,'Horace Gulgowski',NULL,NULL,'abigale81@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RQ8I5VZAD0','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(167,'Alena Champlin',NULL,NULL,'jolson@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'A36obZ51UJ','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(168,'Johanna Cassin',NULL,NULL,'dare.octavia@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'SwUfA9i1tK','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(169,'Prof. Neha Lakin',NULL,NULL,'carole03@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'XhgbHFNETV','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(170,'Ari Oberbrunner',NULL,NULL,'vinnie.runolfsson@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'J2RahPqQw8','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(171,'Kolby Abshire',NULL,NULL,'reba.feil@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'rIEAaf1IVM','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(172,'Virginie Gleason',NULL,NULL,'nsipes@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ToFY4AQDwY','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(173,'Jess Prosacco',NULL,NULL,'fwalter@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fD4jDIY7f1','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(174,'Andy Kirlin',NULL,NULL,'darrel.homenick@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EaTZw1L4L0','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(175,'Dr. Grayson Huels PhD',NULL,NULL,'charlie48@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'za1AjtcKbT','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(176,'Faye Nolan',NULL,NULL,'pkeeling@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pdH1MbAokM','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(177,'Mona Marks Jr.',NULL,NULL,'zackary.hartmann@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nSR1xPMB6g','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(178,'Bettye Runolfsdottir',NULL,NULL,'hyman38@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'AgNtGoC96S','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(179,'Dr. Reginald Streich',NULL,NULL,'lyda.crona@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tNkaBlIOKg','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(180,'Krystel Hills',NULL,NULL,'herta44@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'okCQgniLx6','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(181,'Frederic O\'Hara',NULL,NULL,'steuber.jed@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'965KiELMuV','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(182,'Brandyn Keebler',NULL,NULL,'fweimann@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'OAvIWLpJyB','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(183,'Wava Rosenbaum II',NULL,NULL,'jeff.johnson@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ks326qt7C8','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(184,'Dr. Edwardo Stracke DDS',NULL,NULL,'deja73@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'dJ8eKDrPhR','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(185,'Dolores Schumm PhD',NULL,NULL,'juliana.adams@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'rTROC3bYpg','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(186,'Mr. Dallin Williamson I',NULL,NULL,'abshire.durward@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ncUyrz60lT','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(187,'Hallie Leffler',NULL,NULL,'gaston.gutmann@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'CUYQ5xyhpo','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(188,'Miss Alvera Waters',NULL,NULL,'hyman.batz@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EfTbephRSY','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(189,'Tyshawn Cole',NULL,NULL,'king.greyson@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8cf8BgGDrS','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(190,'Ellsworth Zemlak',NULL,NULL,'christina.lockman@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RE6Jrq2WVO','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(191,'Verdie Stokes Sr.',NULL,NULL,'christy.green@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'KoGDc18Gyc','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(192,'Jan Kub PhD',NULL,NULL,'bahringer.halie@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'p2BJjxPcGB','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(193,'Aileen Walsh',NULL,NULL,'floy.rau@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0sHCEUv0n1','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(194,'Jonatan Zulauf DDS',NULL,NULL,'rjast@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8edvu83zsb','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(195,'Ms. Roselyn Wolf PhD',NULL,NULL,'augustine52@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fim5AqodyG','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(196,'Prof. Amely McKenzie IV',NULL,NULL,'christophe00@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BX6KxhLTkX','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(197,'Tillman Kautzer',NULL,NULL,'gabrielle68@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'C2GvzBdB3o','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(198,'Dr. Alexie Marks I',NULL,NULL,'alexys.jerde@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0P2OmKpcG8','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(199,'Letitia Kreiger',NULL,NULL,'gerlach.gustave@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'XYzFRF5gBI','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(200,'Ollie Bernier',NULL,NULL,'karen10@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RlajevBFax','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(201,'Clifton Batz',NULL,NULL,'kimberly03@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:06:39','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'8rNKHWGlfm','2022-04-22 10:06:39','2022-04-22 10:06:39',NULL,NULL,NULL,NULL,NULL),
(203,'Prof. Kaleb Collins III',NULL,NULL,'reichert.augustine@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'dwjaTupUOE','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(204,'Rosina Stamm',NULL,NULL,'katlynn50@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'n2Q4qVaarL','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(205,'Dudley Mills',NULL,NULL,'qsatterfield@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'hu7JcC7w7E','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(206,'Noble Pagac',NULL,NULL,'lturcotte@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'GZcbjvzqMb','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(207,'Kira Daugherty',NULL,NULL,'powlowski.hertha@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'VsNPUaGPbo','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(208,'Ashtyn Durgan',NULL,NULL,'zprosacco@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'u629AfhLkm','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(209,'Joesph Johns',NULL,NULL,'camille17@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'9lnc89BpTw','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(210,'Philip Streich',NULL,NULL,'marisa21@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'kxdZ7mReSB','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(211,'Claude Mraz',NULL,NULL,'etorphy@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'N1pweTBEMx','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(212,'Prof. Leon Reinger V',NULL,NULL,'gulgowski.kris@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0e5SKXngz2','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(213,'Crystel Lang',NULL,NULL,'justen55@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'p5dXsnnp2Y','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(214,'Larry Doyle',NULL,NULL,'bergnaum.hildegard@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'blxhuF1ay2','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(215,'Suzanne Doyle',NULL,NULL,'torey87@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vS7ELdE6sb','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(216,'Jane Purdy',NULL,NULL,'aking@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'SXkBInvl16','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(217,'Aliyah Hodkiewicz DDS',NULL,NULL,'glover.christopher@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'KZqhrOdaWX','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(218,'Ima Kris',NULL,NULL,'mueller.elmer@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2hASWkEGRF','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(219,'Magnus Doyle',NULL,NULL,'kiley.pouros@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'V0gDwnodu7','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(220,'Seamus Dietrich',NULL,NULL,'mia31@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EGaopNu8n8','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(221,'Prof. Eleazar Ullrich IV',NULL,NULL,'uvandervort@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ahIiASMrOc','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(222,'Delpha Balistreri',NULL,NULL,'lbosco@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'sY4rjhKG7n','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(223,'Prof. Mayra Towne DVM',NULL,NULL,'otorp@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'rR7mzhXKvt','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(224,'Andre Smith DVM',NULL,NULL,'lschimmel@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'51jlokUWvE','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(225,'Destiny O\'Reilly',NULL,NULL,'weber.kelly@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'3L2kF5sIvS','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(226,'Dr. Josie Walter',NULL,NULL,'macejkovic.tamara@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'IUepv5Ujih','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(227,'Desmond Schultz',NULL,NULL,'stehr.merlin@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'szHEJ7HFvp','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(228,'Horace Osinski DDS',NULL,NULL,'owalter@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Or7afWca5M','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(229,'Prof. Kelsie Parisian DDS',NULL,NULL,'pschimmel@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pjLTn6owIy','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(230,'Cassidy Nitzsche II',NULL,NULL,'blanda.frederique@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vu54b3Xq38','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(231,'Prof. Efren Howe PhD',NULL,NULL,'lebsack.lacey@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'fMQ73pZymU','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(232,'Jermain Kerluke DDS',NULL,NULL,'marques70@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'2zpaIca4Zk','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(233,'Elouise Baumbach',NULL,NULL,'eliane68@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vSMgVb7Txh','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(234,'Ebba Mills',NULL,NULL,'zack01@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ptW0Sx4pfo','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(235,'Travon Block Sr.',NULL,NULL,'heller.walton@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'YoBxYhHFCY','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(236,'Kayleigh Hickle V',NULL,NULL,'roslyn16@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'hOigOWR4dI','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(237,'Rahsaan Metz V',NULL,NULL,'onikolaus@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'zXCsWRfSRc','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(238,'Carmelo Dietrich',NULL,NULL,'toy.jazmyn@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'N32Jh6bBuO','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(239,'Rogelio Rice V',NULL,NULL,'rosie.fisher@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mZVNiFmTOm','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(240,'Jace Mann',NULL,NULL,'pgibson@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'GfKclY8sQH','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(241,'Dr. Fletcher Schamberger III',NULL,NULL,'furman89@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'0unS2hmpTD','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(242,'Dr. Dakota Hickle DVM',NULL,NULL,'wisoky.alfredo@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'MAcvpXCwmy','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(243,'Germaine Brakus',NULL,NULL,'ezequiel.welch@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QkfJOgEwDR','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(244,'Felton Mante',NULL,NULL,'runolfsson.abigayle@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'wOxYWqFe3G','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(245,'Virginie McCullough',NULL,NULL,'aurelio.runolfsdottir@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'S0TVGULzWz','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(246,'Casandra Bailey',NULL,NULL,'goldner.lizeth@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'mtAJPZUdQm','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(247,'Cicero Cruickshank',NULL,NULL,'nitzsche.khalil@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'bKaskRgdmK','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(248,'Keira Schneider',NULL,NULL,'lowe.jermey@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'qyzB4Y4RrO','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(249,'Jensen Crist',NULL,NULL,'tate.kunze@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'bykOcWUEMx','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(250,'Prof. Hilda Flatley IV',NULL,NULL,'okuneva.gregory@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QFcGSKnBG3','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(251,'Salma Lakin',NULL,NULL,'ublock@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'neuymgJlOx','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(252,'Mozell Walker',NULL,NULL,'xokon@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'9cCz9r6i0K','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(253,'Shawn Hamill',NULL,NULL,'hermiston.fabiola@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'B0NttGv86C','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(254,'Mr. Favian Runolfsdottir',NULL,NULL,'otha.nitzsche@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RRWW6Xzagq','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(255,'Mr. Kayden Gleichner PhD',NULL,NULL,'ivory03@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QtMv9e6y6z','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(256,'Mrs. Minnie Bashirian MD',NULL,NULL,'kub.moises@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','RAYCujrglr','2022-04-22 10:07:18','2022-04-30 08:32:04',NULL,NULL,NULL,NULL,NULL),
(257,'Lempi Kirlin',NULL,NULL,'dschuster@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'5x0lISANVI','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(258,'Christop Roberts',NULL,NULL,'zack17@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'iYlBUjfKGP','2022-04-22 10:07:18','2022-06-13 08:10:36','2022-06-13 08:10:36',NULL,NULL,NULL,NULL),
(259,'Maximilian Wehner PhD',NULL,NULL,'rbogisich@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'RC4wAeZFSW','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(260,'Violette Morar',NULL,NULL,'schoen.marilie@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nR8jteHyCJ','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(261,'Ms. Nannie O\'Keefe',NULL,NULL,'maufderhar@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','qTdbnfPDMC','2022-04-22 10:07:18','2022-05-09 08:02:04',NULL,NULL,NULL,NULL,NULL),
(262,'Nya Wyman',NULL,NULL,'moore.uriah@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','mGqwgnzpUB','2022-04-22 10:07:18','2022-05-09 08:02:04',NULL,NULL,NULL,NULL,NULL),
(263,'Ms. Annamae Hoppe',NULL,NULL,'bridie22@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','xhV5iMq53a','2022-04-22 10:07:18','2022-05-09 08:02:04',NULL,NULL,NULL,NULL,NULL),
(264,'Ms. Sarah Thiel V',NULL,NULL,'okertzmann@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'PlIKEBDMpc','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(265,'Emilie Larkin',NULL,NULL,'jackeline.robel@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Oew5pd54zL','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(266,'Nannie Stiedemann',NULL,NULL,'nschuppe@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JeeCPwvAvE','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(267,'Naomie Jakubowski',NULL,NULL,'bsanford@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'BQglb3tfSa','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(268,'Gillian Kemmer',NULL,NULL,'rempel.laurel@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QQuIoVFCre','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(269,'Mrs. Dolly Brakus DVM',NULL,NULL,'burnice.dicki@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'QYnoS4jgvY','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(270,'Kayleigh Armstrong',NULL,NULL,'usipes@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'nb2ehlmkCp','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(271,'Dulce Fay II',NULL,NULL,'hansen.asa@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:17','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'xOWabrLDLP','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(272,'Myrtis Deckow',NULL,NULL,'pfeffer.logan@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'lIc9myTD1E','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(273,'Dr. Graham VonRueden',NULL,NULL,'izulauf@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ovYm72FSCs','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(274,'Mable Gorczany',NULL,NULL,'epowlowski@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'v940VLKfB7','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(275,'Roscoe Hessel',NULL,NULL,'tracy43@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'FBwichq8Sa','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(276,'Miss Fae Bauch',NULL,NULL,'trantow.whitney@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'kjISME4RRs','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(277,'Chelsea Jacobi',NULL,NULL,'jacobson.carmel@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vVsEfMb2hL','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(278,'Dr. Lenora Nienow I',NULL,NULL,'bruen.leonora@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'4VmNoxCENR','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(279,'Lelia Bosco',NULL,NULL,'fabiola81@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'JJwXD5A5S7','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(280,'Stefan Spinka',NULL,NULL,'mina.carter@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ha6BxZopxF','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(281,'Major Medhurst',NULL,NULL,'irving.west@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'tfT30ycp9g','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(282,'Hailee Quitzon',NULL,NULL,'littel.vito@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'h0BUiDXnxy','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(283,'Trinity Wisozk',NULL,NULL,'jailyn.mckenzie@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'EciyrsKzC5','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(284,'Theodore Hills',NULL,NULL,'blanda.meredith@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'V59senfju6','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(285,'Fausto Wunsch',NULL,NULL,'bednar.reina@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ERYg0y29Vb','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(286,'Delia Konopelski',NULL,NULL,'schroeder.keely@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'ojvOLbLnY5','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(287,'Ms. Amber Swaniawski',NULL,NULL,'wstokes@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'cL7bHpgJzx','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(288,'Prof. Norris Marks III',NULL,NULL,'gennaro98@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pGEwc5dEvt','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(289,'Zachariah Jones',NULL,NULL,'schoen.morton@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'vpGJwzpYHB','2022-04-22 10:07:18','2022-04-22 10:07:18',NULL,NULL,NULL,NULL,NULL),
(290,'Mr. Jordi Simonis PhD',NULL,NULL,'walker.brannon@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','0bZ2Ohe77i','2022-04-22 10:07:18','2022-05-18 08:07:41',NULL,NULL,NULL,NULL,NULL),
(291,'Buster Bechtelar',NULL,NULL,'djones@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','oYGvGSZ7uR','2022-04-22 10:07:18','2022-05-09 13:07:29',NULL,NULL,NULL,NULL,NULL),
(292,'Dr. Leif Schaden I',NULL,NULL,'gusikowski.annabel@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','sj8GsWMXji','2022-04-22 10:07:18','2022-05-09 13:07:28',NULL,NULL,NULL,NULL,NULL),
(293,'Mrs. Leonora Braun PhD',NULL,NULL,'gladys.waters@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','leV7qdPcfN','2022-04-22 10:07:18','2022-05-09 13:07:27',NULL,NULL,NULL,NULL,NULL),
(294,'Vern Berge Jr.',NULL,NULL,'maddison.shanahan@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'O0tEapCTQE','2022-04-22 10:07:18','2022-05-07 06:18:29','2022-05-07 06:18:29',NULL,NULL,NULL,NULL),
(295,'Kendra Schneider',NULL,NULL,'xkoss@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'pHLNJtsccK','2022-04-22 10:07:18','2022-05-07 06:13:30','2022-05-07 06:13:30',NULL,NULL,NULL,NULL),
(296,'Dr. Jedidiah Jacobson',NULL,NULL,'will.elva@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'Q85gal2Zt2','2022-04-22 10:07:18','2022-05-07 06:13:08','2022-05-07 06:13:08',NULL,NULL,NULL,NULL),
(297,'Orin Ortiz',NULL,NULL,'raheem85@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'owKk2pu3Z1','2022-04-22 10:07:18','2022-05-07 06:12:18','2022-05-07 06:12:18',NULL,NULL,NULL,NULL),
(298,'Hilbert Mueller',NULL,NULL,'lavina01@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'jjA0eOpWyb','2022-04-22 10:07:18','2022-05-07 06:11:36','2022-05-07 06:11:36',NULL,NULL,NULL,NULL),
(299,'Antonietta Hudson PhD',NULL,NULL,'thiel.thea@example.net',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','ACTIVE','Vz5rZxqqsZ','2022-04-22 10:07:18','2022-05-07 06:10:36','2022-05-07 06:10:36',NULL,NULL,NULL,NULL),
(300,'Angelica Cremin MD',NULL,NULL,'idoyle@example.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'cVLO5kECMz','2022-04-22 10:07:18','2022-05-07 06:07:48','2022-05-07 06:07:48',NULL,NULL,NULL,NULL),
(301,'Prof. Alphonso Wehner',NULL,NULL,'johnnie.runte@example.org',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,'1XucHSASHX','2022-04-22 10:07:18','2022-05-07 06:06:22','2022-05-07 06:06:22',NULL,NULL,NULL,NULL),
(302,'Miss Genevieve DuBuque','dd','dsdsdsds','gkunze@example.com','15','2121','212121','1212122121','1',NULL,NULL,NULL,'2022-04-22 10:07:18','$2y$10$Lzg3xzG5WOT89CRaqp7fkevMQWBuewzOGc2tsj1F/.jTRhcgEVNCS','INACTIVE','w8ZwVspJh5','2022-04-22 10:07:18','2022-05-07 06:05:41','2022-05-07 06:05:41',NULL,NULL,NULL,NULL),
(303,NULL,'Sale Manager','User','sale_manager@management.com','administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$W2Q2lagHXlAufwmnYmnaeedLnqUl/or9Z/oYNtWgf0HlVDNjV5nbm','ACTIVE','$2y$10$/Yxi0WYYITfeEy/uEbeN.OX//kGRWONjsTt0wTWVmXTm0KAkklxIq','2022-04-23 00:00:00','2022-05-07 06:04:54','2022-05-07 06:04:54',NULL,NULL,NULL,NULL),
(304,NULL,'Sale Agent','User','sale_agent@management.com','administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$yDKeAvNbfW/SUqoBHi3c7ebxvU3ZJNv2l8C.LLRsCtTJ5ilA8svf.','ACTIVE','$2y$10$lOTvYaRTKOULIcxlmP.5mOrHUshYWhod4X63g.8218bVkDBfBqclC','2022-04-23 00:00:00','2022-05-07 06:04:41','2022-05-07 06:04:41',NULL,NULL,NULL,NULL),
(305,NULL,'Writer Manager','User','writer_manager@management.com','administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$NcvpTVv9N.yP0aHfxwYfS.QUJ69OM5YIdLBtZdD3IMGymux0/bbUO','INACTIVE','$2y$10$YxqMmu5.tE3o5uKfyYet7udOb11bu7x3TaFFhhmz7L4juKoKR5tJi','2022-04-23 00:00:00','2022-05-07 06:04:27','2022-05-07 06:04:27',NULL,NULL,NULL,NULL),
(306,NULL,'Sales agent','agent','sales.agents@management.com','16','123123','123123123','123123','1',NULL,307,NULL,NULL,'$2y$10$U3Etx4h/Wdwpmw4tcgmBTej8GTqDoCqjQOTMjt/Sz474y14POWL..','ACTIVE','$2y$10$GoAPX6GuCjRfN9y61umhj.jQXbN7ZiGogmWCLxY2sdB5OaBz9MxOG','2022-04-23 00:00:00','2022-05-23 13:55:19',NULL,'sdfsdfsdf',NULL,NULL,NULL),
(307,NULL,'saifi','ulla','saifi@gmail.com','15','123123','123123','123123','1',NULL,307,'profile_images/user_307/profile-image-20220512134415.jfif',NULL,'$2y$10$7WG7CtbkXvpQSO1Ucvc15.O/AsJd.2361LMCM2usbwOdp.RnXWDCW','ACTIVE','65uzLeZ5L7sq89hBHWRAwe3fJwRC6u6jEy30WN5KUsRHuJye7CbYYGyBBRpJ','2022-04-23 00:00:00','2022-06-10 13:03:46',NULL,'saifi',NULL,NULL,NULL),
(308,NULL,'HR','User','hr@management.com','administrator',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'$2y$10$kpARw.trY640p2imuq3EueEejvDtDZ.7IERsHBZ3ExjqXKzXy8I2.','INACTIVE','$2y$10$m7wM668bQay3GWcp05m4guoNfcCP37KYN1kkP4.2IN.2zA76Hre5e','2022-04-23 00:00:00','2022-04-28 11:36:23','2022-04-28 11:36:23',NULL,NULL,NULL,NULL),
(309,NULL,'hasnain','khan','admin123123@management.com','16','123456789','123456789','1000','1','2022-05-13',307,NULL,NULL,'$2y$10$MTFeRE3tjedKMARz4Gl/VeYehVQFC8wk7leXqwKC3E0ptrphERDga','ACTIVE',NULL,'2022-04-25 06:41:47','2022-05-13 15:06:51','2022-05-13 15:06:51','vxvxcvxcv',NULL,325,NULL),
(310,NULL,'hasnain123','khan 2222','hasnain111@mailinator.com','16','123123123','123123123','123123123','1',NULL,307,'profile_images/user_310/profile-image-20220509073945.jfif',NULL,'$2y$10$TlN95tsKWOT2CkaA55Pshewa3G7sEg28ynBgB9By3EITaJ28Q8jrG','ACTIVE',NULL,'2022-04-25 06:49:47','2022-05-13 15:06:42','2022-05-13 15:06:42','123123',NULL,314,NULL),
(311,NULL,'hasnainkhan','khan','hansainhkan@gmail.com','17','123123123','123123123','12123123','1',NULL,313,NULL,NULL,'$2y$10$.bOPtMGvZX3yVZfDczC1Xuu.nl4/qsLLwXCESq5HyHRo5m5qbNb.K','ACTIVE',NULL,'2022-04-25 06:50:44','2022-05-07 06:24:13','2022-05-07 06:24:13',NULL,NULL,NULL,NULL),
(312,NULL,'hasnain','khan123','hasnain123123@mailinator.com','15','123123','123123','123123','1',NULL,NULL,NULL,NULL,'123456789','ACTIVE',NULL,'2022-04-25 06:52:02','2022-04-28 11:36:53','2022-04-28 11:36:53',NULL,NULL,NULL,NULL),
(313,NULL,'hasnainkhan','khanaa','khaaan@gmail.com','17','123123','123123','10000',NULL,NULL,NULL,NULL,NULL,'123456789','INACTIVE',NULL,'2022-04-25 06:55:12','2022-04-27 09:05:09','2022-04-27 09:05:09',NULL,NULL,NULL,NULL),
(314,NULL,'hammayoon','khan','hamayon.khan@gmail.com','16','123123','123123','123123','1',NULL,307,'profile_images/user_316/profile-image-20220425070054.jpg',NULL,'$2y$10$V.gCphW6E3f6E2g33TGt7O9EbEE8Wh6WV5cJjWRyj6Q.xK9DrUnpO','ACTIVE',NULL,'2022-04-25 06:56:45','2022-05-13 15:06:27',NULL,'hamayon.khan',NULL,325,NULL),
(315,NULL,'hasnainkhan','hansainkhan','khankhan@gmail.com','15','123123','123123123','123123',NULL,NULL,NULL,NULL,NULL,'123456789','INACTIVE',NULL,'2022-04-25 06:59:49','2022-05-07 06:24:04','2022-05-07 06:24:04',NULL,NULL,NULL,NULL),
(316,NULL,'hasnain','khan 2222','admin123123123@admin.com','15','123123123','123123123','123123123',NULL,NULL,NULL,'profile_images/user_316/profile-image-20220425070054.jpg',NULL,'123123123','INACTIVE',NULL,'2022-04-25 07:00:54','2022-04-28 11:36:10','2022-04-28 11:36:10',NULL,NULL,NULL,NULL),
(317,NULL,'hasnain123123123123123','sdsdf123123','admin121113123123@management.com','14','123456789','123123123','1000',NULL,NULL,NULL,NULL,NULL,'123456789','ACTIVE',NULL,'2022-04-25 07:10:46','2022-04-30 07:47:36','2022-04-30 07:47:36',NULL,NULL,NULL,NULL),
(318,NULL,'hasnain123','sdsdf','admin123123123@management.com','14','123456789','123123123','1000',NULL,NULL,NULL,NULL,NULL,NULL,'INACTIVE',NULL,'2022-04-25 08:44:11','2022-04-28 11:36:05','2022-04-28 11:36:05',NULL,NULL,NULL,NULL),
(319,NULL,'hasnain123123','sdsdf123','admin123123123@management.com','18','123456789','123123123','1000','1','2022-04-26',313,'profile_images/user_319/profile-image-20220426063750.jfif',NULL,'$2y$10$UK73ink8/wbRDv484CHnYu4udBINBkIN1scWW6a89O28QcFsThTMq','INACTIVE',NULL,'2022-04-25 08:44:20','2022-04-28 11:36:17','2022-04-28 11:36:17',NULL,NULL,NULL,NULL),
(320,NULL,'hasnain123123','sdsdf123123','admin123123123@management.com','16','123456789','123123123','1000','2','2022-04-12',316,'profile_images/user_320/profile-image-20220425112847.jfif',NULL,NULL,'INACTIVE',NULL,'2022-04-25 08:44:24','2022-04-30 07:47:49','2022-04-30 07:47:49',NULL,NULL,NULL,NULL),
(321,NULL,'sale','manager','salemanager@gmail.com','17','123456789','123456789','1000','1','2022-04-26',NULL,'profile_images/user_321/profile-image-20220425115457.jfif',NULL,'$2y$10$fhxunpflhRFpInMS9O2tE.Rgk.cZwijsaBMHIwn/9czQReQZMvxe2','ACTIVE',NULL,'2022-04-25 08:49:04','2022-04-27 09:17:10','2022-04-27 09:17:10',NULL,NULL,NULL,NULL),
(322,NULL,'hasnain khan','hasnain khan 25','hasnainkhan252@gmail.com','18','123123123','123123','123123','1',NULL,311,'profile_images/user_322/profile-image-20220427061706.jfif',NULL,'$2y$10$xdgGlCLujIFKW2tc9vhuqO6rbRXLqdRc8OJ0p20yeo1SpddfLc4Zu','INACTIVE',NULL,'2022-04-25 09:54:00','2022-05-07 06:22:13','2022-05-07 06:22:13',NULL,NULL,NULL,NULL),
(323,NULL,'hasnain','khan','hasnain@gmail.com','18','123456789','12356789','1000','1','2022-04-29',311,'profile_images/user_323/profile-image-20220430074154.jfif',NULL,'$2y$10$d2O5lb.0ZEqdQSwZHBJFr.vDq7BGWVZpezinRGhFbpYnhOKZZ.UXS','INACTIVE',NULL,'2022-04-29 10:56:01','2022-05-07 06:22:07','2022-05-07 06:22:07',NULL,NULL,NULL,NULL),
(324,NULL,'Hasnain','khan','hasnain.khan@gmail.com','16','123123','1232123','123123','1','2022-05-09',307,'profile_images/user_324/profile-image-20220510060950.webp',NULL,'$2y$10$7ddodxJO5pwcSUPXV/nxO.6ngzUIFZK0lO1oP6Qx59nkmjuY.QkIG','ACTIVE',NULL,'2022-05-09 07:46:27','2022-05-18 08:07:36',NULL,'hasnain.khan',NULL,325,NULL),
(325,NULL,'Bilal','Ahmed','billal.ahmed@gmail.com','16','123123','123123123','123','3',NULL,307,'profile_images/user_325/profile-image-20220510060930.jpg',NULL,'$2y$10$8ZlL0Xd0DW9z9F/Thc5hTebuh9nRweoGqLSJ9NXsBN/iUsie9SxWq','ACTIVE',NULL,'2022-05-09 10:00:31','2022-06-13 07:16:33',NULL,'billal.ahmed',1,NULL,1),
(326,NULL,'safiullah','abbasi2','sma@ymail.com','15','03339767831','1','1','1','2022-05-20',326,NULL,NULL,'$2y$10$Mi.mzcO76AhgQ/sLuw.aYOjURBghctbsE4MQyj9/a5FvgFRI/ztXS','ACTIVE',NULL,'2022-05-20 11:42:41','2022-06-15 07:06:13',NULL,'Safiullah',NULL,NULL,NULL),
(327,NULL,'Writer','Manager','writer.manager@gmail.com','17','123123234234','234234','234','1',NULL,327,NULL,NULL,'$2y$10$hCeszIfib6XsW37VFGXOpeLMdLtiVfGvj8PR9OiF3NwLFrMs3oBg6','ACTIVE',NULL,'2022-05-23 11:09:47','2022-06-13 07:34:57',NULL,'writer nick',NULL,NULL,NULL),
(328,NULL,'Writer','Agent','writer.agent@gmail.com','18','123456789','12456789','123123','1',NULL,327,NULL,NULL,'$2y$10$Bn6ZpOo7maoCjH18MLf6lesYB/eXd/Ey/FXbGoErlrlZp52ggxPFC','ACTIVE',NULL,'2022-05-23 11:10:35','2022-06-09 09:41:33',NULL,'writer.agent',1,NULL,1),
(329,NULL,'writer','agent 2','writer.agent2@gmail.com','18','123456789','12123456','123123','2',NULL,327,NULL,NULL,'$2y$10$IKxu2C4AeX8AaMEiSZTVw.0FjEO7MLfXTPCfyaCR/YZkwzV0z6ZTe','INACTIVE',NULL,'2022-05-23 11:11:17','2022-06-17 07:31:46',NULL,'writer agent 2',NULL,328,NULL),
(330,NULL,'writer','agent3','writer.agent3@gmail.com','18','123456789','123456789','123123','1',NULL,327,NULL,NULL,'$2y$10$xvXbh9FLxDqWfC.bEKcrCePrnCURjLqkHxOmDZLFjFawwhKG1nTLu','ACTIVE',NULL,'2022-05-23 11:11:49','2022-05-23 11:11:49',NULL,'writer agent 3',NULL,328,NULL),
(331,NULL,'hasnain','sales.manager','hasnain.sales.manager@gmail.com','15','23321456','14564564','1000','1','2022-06-16',331,NULL,NULL,'$2y$10$6cHDHlppj3U6YQ/RF1wDfuoMy5GOtK1kGgq6EvESQHtFEGFxrZ.Jm','ACTIVE',NULL,'2022-06-01 08:53:19','2022-06-13 10:30:54',NULL,'hasnain.sales.manager',NULL,NULL,NULL),
(332,NULL,'hasnain','writer.manager','hasnain.writer.manager@gmail.com','17','1231231','23123123','123','1','2022-06-15',332,NULL,NULL,'$2y$10$uEUjtYbhz2v2SpLqICp1VedJr4bJdzcp5FCkDvMAQuiqdc7Taphi6','ACTIVE',NULL,'2022-06-01 09:22:05','2022-06-14 09:57:57',NULL,'hasnain.writer.manager',NULL,NULL,1),
(333,NULL,'hasnain','writer.agent.lead','hasnain.writer.agent.lead@gmail.com','18','123456789','123123123','123','1',NULL,332,NULL,NULL,'$2y$10$pAOjSnTheY2kZo3fCcGV7OSyttfyx78JGd/pjH3Lni3GrmKSpEL8K','ACTIVE',NULL,'2022-06-01 09:25:19','2022-06-11 07:39:16',NULL,'hasnain.writer.agent',1,NULL,1),
(334,NULL,'hasnain','writer.agent','hasnain.writer.agent@gmail.com','18','123456789','123456789','123123','1',NULL,332,NULL,NULL,'$2y$10$MEPXPEL/qOJhYQMPKotxFOmKL41Rz3aDE.9IVS.fN.jkWHUlbwg6m','ACTIVE',NULL,'2022-06-01 10:22:37','2022-06-01 10:22:37',NULL,'hasnain.writer.agent',NULL,333,NULL),
(335,NULL,'hasnain','khan','hasnain.khan.12@gmail.com','16','123123','123123','123','3',NULL,326,'profile_images/user_335/profile-image-20220608054822.jpg',NULL,'$2y$10$Mk.yP37SkG.j3kyCy50O2.z.dYZniDHdsDf2.ZiqL2tlacqZq/wa2','ACTIVE',NULL,'2022-06-08 05:48:22','2022-06-15 07:10:05',NULL,'hasnain.khan',1,NULL,1),
(336,NULL,'Sales Manager','Hasnain','sales.manager.hasnain12@gmail.com','15','123456789','123456789','123123123','1','1995-01-08',336,NULL,NULL,'$2y$10$popVtm3rVw3vtWXD4d0.0.RZSTIBG2zT7ewUFSzsXqmLCSoZdhMbC','ACTIVE',NULL,'2022-06-08 11:15:17','2022-06-10 13:04:39',NULL,'sales.manager.hasnain12',NULL,NULL,NULL),
(337,NULL,'billal','ahmed','billal.ahmed.sale.manager@gmail.com','15','123123','123123','123123','1','2022-06-10',337,NULL,NULL,'$2y$10$RaVcvP2ZZOvGuc9SEDLPS.AXFlbIj8zmklIVZNcO3JRQGC1dQkIdi','ACTIVE',NULL,'2022-06-10 12:59:33','2022-06-10 12:59:33',NULL,'self_assign_manager',NULL,NULL,1),
(338,NULL,'humayun','saeeed','humayunsaeed@gmail.com','16','123123','123123','123123','1','2022-06-13',326,NULL,NULL,'$2y$10$Vlaon2If741Y.he3TzrF1Oq5Y/o4PzKhMUeZIEbCj6FCA2TCNcudm','ACTIVE',NULL,'2022-06-13 09:07:06','2022-06-15 07:07:31',NULL,'humayunsaeed',1,NULL,NULL);

/*Table structure for table `website` */

DROP TABLE IF EXISTS `website`;

CREATE TABLE `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(25) DEFAULT 'INACTIVE',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `website` */

insert  into `website`(`id`,`name`,`status`,`created_at`,`updated_at`) values 
(1,'https://www.google.com','ACTIVE','2022-06-10 13:34:00','2022-06-17 13:55:27'),
(2,'www.google.net','ACTIVE','2022-06-17 13:55:53','2022-06-17 13:55:53');

/*Table structure for table `websites` */

DROP TABLE IF EXISTS `websites`;

CREATE TABLE `websites` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `websites` */

/*Table structure for table `writer_work_timelines` */

DROP TABLE IF EXISTS `writer_work_timelines`;

CREATE TABLE `writer_work_timelines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `sale_order_id` bigint(20) NOT NULL,
  `sale_order_status_id` bigint(20) NOT NULL,
  `start_date_time` timestamp NULL DEFAULT NULL,
  `end_date_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `writer_work_timelines` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
