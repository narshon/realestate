/*
SQLyog Community v11.51 (64 bit)
MySQL - 5.7.17-log : Database - rentkeny_realestate
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rentkeny_realestate` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `rentkeny_realestate`;

/*Table structure for table `re_account_chart` */

DROP TABLE IF EXISTS `re_account_chart`;

CREATE TABLE `re_account_chart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `fk_re_account_type` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `description` text,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` int(11) DEFAULT NULL,
  `modified_on` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_re_account_type` (`fk_re_account_type`),
  CONSTRAINT `re_account_chart_ibfk_1` FOREIGN KEY (`fk_re_account_type`) REFERENCES `re_account_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_chart` */

insert  into `re_account_chart`(`id`,`code`,`name`,`fk_re_account_type`,`status`,`description`,`created_by`,`modified_by`,`created_on`,`modified_on`) values (32,1101,'Cash',1,1,'Cash Account',1,NULL,NULL,NULL),(33,1102,'Bank',1,1,'Bank Account',1,NULL,NULL,NULL),(34,1103,'Accounts Receivable',1,1,'Accounts Receivable\r\n',1,NULL,NULL,NULL),(35,1104,'Accounts Payable',2,1,'Accounts Payable\r\n',1,NULL,NULL,NULL),(36,1105,'Rent Income',4,1,NULL,1,NULL,NULL,NULL),(37,1106,'Penalties Income',4,1,NULL,1,NULL,NULL,NULL),(38,1107,'Disbursement',2,1,'Disbursement account',1,NULL,NULL,NULL),(39,1108,'Imprest',2,1,'Imprest paid to landlords',1,NULL,NULL,NULL);

/*Table structure for table `re_account_entries` */

DROP TABLE IF EXISTS `re_account_entries`;

CREATE TABLE `re_account_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_account_chart` int(11) NOT NULL,
  `trasaction_type` enum('credit','debit') NOT NULL,
  `amount` double NOT NULL,
  `entry_date` date NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `origin_model` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_entries` */

insert  into `re_account_entries`(`id`,`fk_account_chart`,`trasaction_type`,`amount`,`entry_date`,`created_on`,`created_by`,`origin_id`,`origin_model`) values (1,38,'credit',7500,'2018-01-14','2018-01-14 16:42:47',1,7,'app\\models\\Disbursements'),(2,38,'credit',7000,'2018-01-14','2018-01-14 16:42:47',1,8,'app\\models\\Disbursements'),(3,38,'credit',7000,'2018-01-14','2018-01-14 16:42:47',1,9,'app\\models\\Disbursements'),(4,38,'credit',7000,'2018-01-14','2018-01-14 16:42:47',1,10,'app\\models\\Disbursements'),(5,38,'credit',7500,'2018-01-14','2018-01-22 01:13:19',1,7,'app\\models\\Disbursements'),(6,38,'credit',7000,'2018-01-14','2018-01-22 01:13:20',1,8,'app\\models\\Disbursements'),(7,38,'credit',7000,'2018-01-14','2018-01-22 01:13:20',1,9,'app\\models\\Disbursements'),(8,38,'credit',7000,'2018-01-14','2018-01-22 01:13:20',1,10,'app\\models\\Disbursements'),(9,38,'credit',7500,'2018-01-14','2018-02-02 18:16:54',1,7,'app\\models\\Disbursements'),(10,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,8,'app\\models\\Disbursements'),(11,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,9,'app\\models\\Disbursements'),(12,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,10,'app\\models\\Disbursements'),(13,38,'credit',7500,'2018-01-14','2018-02-02 18:16:54',1,7,'app\\models\\Disbursements'),(14,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,8,'app\\models\\Disbursements'),(15,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,9,'app\\models\\Disbursements'),(16,38,'credit',7000,'2018-01-14','2018-02-02 18:16:54',1,10,'app\\models\\Disbursements'),(17,38,'credit',7500,'2018-02-21','2018-02-21 17:59:30',1,11,'app\\models\\Disbursements'),(18,38,'credit',7000,'2018-02-21','2018-02-21 17:59:30',1,12,'app\\models\\Disbursements'),(19,38,'credit',7000,'2018-02-21','2018-02-21 17:59:30',1,13,'app\\models\\Disbursements'),(20,38,'credit',7000,'2018-02-21','2018-02-21 17:59:30',1,14,'app\\models\\Disbursements'),(21,38,'credit',7000,'2018-02-23','2018-02-23 19:43:52',1,15,'app\\models\\Disbursements'),(22,35,'debit',27500,'2018-02-28','2018-02-28 09:34:35',1,4,'app\\models\\LandlordImprest'),(23,32,'credit',27500,'2018-02-28','2018-02-28 09:34:35',1,4,'app\\models\\LandlordImprest'),(24,36,'debit',10000,'2018-02-28','2018-02-28 09:34:35',1,90,'app\\models\\OccupancyRent'),(25,34,'credit',10000,'2018-02-28','2018-02-28 09:34:35',1,90,'app\\models\\OccupancyRent'),(26,36,'debit',10000,'2018-02-28','2018-02-28 09:34:35',1,92,'app\\models\\OccupancyRent'),(27,34,'credit',10000,'2018-02-28','2018-02-28 09:34:35',1,92,'app\\models\\OccupancyRent'),(28,38,'debit',10000,'2018-02-28','2018-02-28 09:34:35',1,16,'app\\models\\Disbursements'),(29,35,'credit',10000,'2018-02-28','2018-02-28 09:34:35',1,16,'app\\models\\Disbursements'),(30,38,'debit',10000,'2018-02-28','2018-02-28 09:34:35',1,17,'app\\models\\Disbursements'),(31,35,'credit',10000,'2018-02-28','2018-02-28 09:34:35',1,17,'app\\models\\Disbursements'),(32,32,'debit',25000,'2018-02-28','2018-02-28 09:34:35',1,12,'app\\models\\OccupancyPayments'),(33,36,'credit',25000,'2018-02-28','2018-02-28 09:34:35',1,12,'app\\models\\OccupancyPayments'),(34,35,'debit',20000,'2018-02-28','2018-02-28 09:34:35',1,5,'app\\models\\LandlordImprest'),(35,32,'credit',20000,'2018-02-28','2018-02-28 09:34:35',1,5,'app\\models\\LandlordImprest'),(36,36,'debit',10000,'2018-02-27','2018-03-01 14:37:20',1,92,'app\\models\\OccupancyRent'),(37,34,'credit',10000,'2018-02-27','2018-03-01 14:37:20',1,92,'app\\models\\OccupancyRent');

/*Table structure for table `re_account_map` */

DROP TABLE IF EXISTS `re_account_map`;

CREATE TABLE `re_account_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_term` int(11) NOT NULL,
  `fk_account_chart` int(11) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_term` (`fk_term`),
  KEY `fk_account_chart` (`fk_account_chart`),
  CONSTRAINT `re_account_map_ibfk_1` FOREIGN KEY (`fk_term`) REFERENCES `re_term` (`id`),
  CONSTRAINT `re_account_map_ibfk_2` FOREIGN KEY (`fk_account_chart`) REFERENCES `re_account_chart` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_map` */

insert  into `re_account_map`(`id`,`fk_term`,`fk_account_chart`,`transaction_type`,`status`,`created_on`,`created_by`,`modified_on`,`modified_by`) values (1,1,36,'debit',1,'2017-12-18 15:00:25',NULL,NULL,NULL),(2,1,34,'credit',1,'2017-12-18 15:00:54',NULL,NULL,NULL),(3,3,38,'debit',1,NULL,NULL,NULL,NULL),(4,3,35,'credit',1,NULL,NULL,NULL,NULL),(5,20,35,'debit',1,NULL,NULL,NULL,NULL),(6,20,32,'credit',1,NULL,NULL,NULL,NULL),(7,19,32,'debit',1,NULL,NULL,NULL,NULL),(8,19,36,'credit',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_account_type` */

DROP TABLE IF EXISTS `re_account_type`;

CREATE TABLE `re_account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_type` */

insert  into `re_account_type`(`id`,`name`,`Description`,`created_by`,`modified_by`,`created_on`,`modified_on`) values (1,'Assets','Assets',1,1,NULL,NULL),(2,'Liabilities','Liabilities',1,1,NULL,NULL),(3,'Equity','Equity',1,1,NULL,NULL),(4,'Revenue','Revenue',1,1,NULL,NULL),(5,'Expenses','Expenses',1,1,NULL,NULL);

/*Table structure for table `re_accounts` */

DROP TABLE IF EXISTS `re_accounts`;

CREATE TABLE `re_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(100) DEFAULT NULL,
  `account_description` text,
  `account_no` decimal(10,0) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `bank_code` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_accounts` */

insert  into `re_accounts`(`id`,`account_name`,`account_description`,`account_no`,`bank_name`,`branch`,`bank_code`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'Petty Cash','','1','Petty Cash','001','001',NULL,NULL,NULL,NULL);

/*Table structure for table `re_accounts_transaction` */

DROP TABLE IF EXISTS `re_accounts_transaction`;

CREATE TABLE `re_accounts_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_journal` int(11) DEFAULT NULL,
  `fk_account` int(11) DEFAULT NULL,
  `fk_source` int(11) DEFAULT NULL,
  `dr` decimal(11,2) DEFAULT NULL,
  `cr` decimal(11,2) DEFAULT NULL,
  `running_balance` decimal(11,2) DEFAULT NULL,
  `details` text,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  `reconciled` int(11) DEFAULT NULL,
  `reconciled_amount` decimal(11,2) DEFAULT NULL,
  `reconciled_by` varchar(100) DEFAULT NULL,
  `reconciled_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_type` (`fk_account`),
  KEY `fk_journal` (`fk_journal`),
  KEY `fk_source` (`fk_source`),
  CONSTRAINT `ac_ibfk_2` FOREIGN KEY (`fk_journal`) REFERENCES `re_journal` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `ac_ibfk_3` FOREIGN KEY (`fk_source`) REFERENCES `re_source` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_accounts_transaction_ibfk_1` FOREIGN KEY (`fk_account`) REFERENCES `re_accounts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_accounts_transaction` */

/*Table structure for table `re_advert` */

DROP TABLE IF EXISTS `re_advert`;

CREATE TABLE `re_advert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `advert_name` varchar(200) DEFAULT NULL,
  `advert_desc` text,
  `advert_owner_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `image1` text,
  `image2` text,
  `image3` text,
  `image4` text,
  `image5` text,
  `contact_details` text,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `advert_fee` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `advert_owner_id` (`advert_owner_id`),
  CONSTRAINT `re_advert_ibfk_1` FOREIGN KEY (`advert_owner_id`) REFERENCES `re_management` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_advert` */

/*Table structure for table `re_advert_feature` */

DROP TABLE IF EXISTS `re_advert_feature`;

CREATE TABLE `re_advert_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_advert_id` int(11) DEFAULT NULL,
  `fk_feature_id` int(11) DEFAULT NULL,
  `feature_narration` text,
  `image1` text,
  `image2` text,
  `image3` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_advert_id` (`fk_advert_id`),
  KEY `fk_feature_id` (`fk_feature_id`),
  CONSTRAINT `re_advert_feature_ibfk_1` FOREIGN KEY (`fk_advert_id`) REFERENCES `re_advert` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_advert_feature_ibfk_2` FOREIGN KEY (`fk_feature_id`) REFERENCES `re_feature` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_advert_feature` */

/*Table structure for table `re_blog` */

DROP TABLE IF EXISTS `re_blog`;

CREATE TABLE `re_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) DEFAULT NULL,
  `blog_title` text,
  `blog_post` text,
  `posted_date` datetime DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `re_blog_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `re_blog` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_blog` */

/*Table structure for table `re_county` */

DROP TABLE IF EXISTS `re_county`;

CREATE TABLE `re_county` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `county_desc` text,
  `county_name` varchar(200) DEFAULT NULL,
  `county_lat` varchar(10) DEFAULT NULL,
  `county_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `re_county` */

insert  into `re_county`(`id`,`county_desc`,`county_name`,`county_lat`,`county_long`) values (5,'','kilifi',NULL,NULL);

/*Table structure for table `re_disbursements` */

DROP TABLE IF EXISTS `re_disbursements`;

CREATE TABLE `re_disbursements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_rent` int(11) NOT NULL,
  `fk_landlord` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `entry_date` date NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_landlord` (`fk_landlord`),
  KEY `fk_occupancy_rent` (`fk_occupancy_rent`),
  CONSTRAINT `re_disbursements_ibfk_1` FOREIGN KEY (`fk_landlord`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_disbursements_ibfk_2` FOREIGN KEY (`fk_occupancy_rent`) REFERENCES `re_occupancy_rent` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `re_disbursements` */

insert  into `re_disbursements`(`id`,`fk_occupancy_rent`,`fk_landlord`,`batch_id`,`amount`,`month`,`year`,`entry_date`,`created_on`,`created_by`,`_status`) values (7,7,16,NULL,7500,1,2018,'2018-01-14','2018-01-14 16:42:47',1,2),(8,9,16,NULL,7000,1,2018,'2018-01-14','2018-01-14 16:42:47',1,2),(9,11,16,NULL,7000,1,2018,'2018-01-14','2018-01-14 16:42:47',1,2),(10,13,16,NULL,7000,1,2018,'2018-01-14','2018-01-14 16:42:47',1,2),(11,19,16,4,7500,2,2018,'2018-02-21','2018-02-21 17:59:30',1,1),(12,20,16,4,7000,2,2018,'2018-02-21','2018-02-21 17:59:30',1,1),(13,21,16,4,7000,2,2018,'2018-02-21','2018-02-21 17:59:30',1,1),(14,22,16,4,7000,2,2018,'2018-02-21','2018-02-21 17:59:30',1,1),(15,88,16,4,7000,2,2018,'2018-02-23','2018-02-23 19:43:52',1,1),(16,90,223,5,10000,2,2018,'2018-02-27','2018-02-27 21:50:48',1,2),(17,92,223,5,10000,2,2018,'2018-02-27','2018-02-27 21:50:48',1,2);

/*Table structure for table `re_estate` */

DROP TABLE IF EXISTS `re_estate`;

CREATE TABLE `re_estate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_sub_location` int(11) DEFAULT NULL,
  `estate_name` varchar(200) DEFAULT NULL,
  `estate_desc` text,
  `estate_review` text,
  `estate_media` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `estate_lat` varchar(10) DEFAULT NULL,
  `estate_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sub_location` (`fk_sub_location`),
  CONSTRAINT `re_estate_ibfk_1` FOREIGN KEY (`fk_sub_location`) REFERENCES `re_sub_location` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `re_estate` */

insert  into `re_estate`(`id`,`fk_sub_location`,`estate_name`,`estate_desc`,`estate_review`,`estate_media`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`,`estate_lat`,`estate_long`) values (1,3,'kwa mike ','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,'Tumaini','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,2,'prisons','test estate','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,'Kichinjioni','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,4,'Unknown','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_feature` */

DROP TABLE IF EXISTS `re_feature`;

CREATE TABLE `re_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_name` varchar(200) DEFAULT NULL,
  `feature_desc` text,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `re_feature` */

insert  into `re_feature`(`id`,`feature_name`,`feature_desc`,`date_created`,`created_by`,`date_modified`,`modified_by`,`_status`) values (1,'gate',NULL,NULL,NULL,NULL,NULL,NULL),(2,'floor',NULL,NULL,NULL,NULL,NULL,NULL),(3,'roof',NULL,NULL,NULL,NULL,NULL,NULL),(4,'Water',NULL,NULL,NULL,NULL,NULL,NULL),(5,'Electricity',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Permanent',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Semi Permanent',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_group` */

DROP TABLE IF EXISTS `re_group`;

CREATE TABLE `re_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(200) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `re_group` */

insert  into `re_group`(`id`,`group_name`,`_status`) values (1,'Admin',1),(2,'Agent',1),(3,'Landlord',1),(4,'Tenant',1);

/*Table structure for table `re_journal` */

DROP TABLE IF EXISTS `re_journal`;

CREATE TABLE `re_journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `receipt_invoice_no` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `fk_occupancy_rent` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL,
  `account_type` int(11) DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL,
  `cheque_no` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `details` text CHARACTER SET latin1,
  `transacted_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_type` (`transaction_type`),
  KEY `account_type` (`account_type`),
  CONSTRAINT `re_journal_ibfk_1` FOREIGN KEY (`transaction_type`) REFERENCES `re_source` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `re_journal_ibfk_2` FOREIGN KEY (`account_type`) REFERENCES `re_accounts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `re_journal` */

/*Table structure for table `re_landlord_imprest` */

DROP TABLE IF EXISTS `re_landlord_imprest`;

CREATE TABLE `re_landlord_imprest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_landlord` int(11) DEFAULT NULL,
  `imprest_type` varchar(20) DEFAULT NULL,
  `amount` double NOT NULL,
  `entry_date` date NOT NULL,
  `settlement_id` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_landlord` (`fk_landlord`),
  CONSTRAINT `re_landlord_imprest_ibfk_1` FOREIGN KEY (`fk_landlord`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `re_landlord_imprest` */

insert  into `re_landlord_imprest`(`id`,`fk_landlord`,`imprest_type`,`amount`,`entry_date`,`settlement_id`,`created_on`,`created_by`,`_status`) values (1,16,'advance',5000,'2018-01-21',NULL,NULL,NULL,0),(2,16,'advance',3000,'2018-01-21',NULL,NULL,NULL,0),(3,16,'disbursement',27500,'2018-02-27',NULL,'2018-02-27 09:31:50',1,1),(4,16,'disbursement',27500,'2018-02-27',NULL,'2018-02-27 09:34:35',1,1),(5,223,'disbursement',20000,'2018-02-27',NULL,'2018-02-27 22:03:57',1,1);

/*Table structure for table `re_location` */

DROP TABLE IF EXISTS `re_location`;

CREATE TABLE `re_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_ward` int(11) DEFAULT NULL,
  `location_name` varchar(200) DEFAULT NULL,
  `location_desc` text,
  `location_lat` varchar(10) DEFAULT NULL,
  `location_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ward` (`fk_ward`),
  CONSTRAINT `re_location_ibfk_1` FOREIGN KEY (`fk_ward`) REFERENCES `re_ward` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `re_location` */

insert  into `re_location`(`id`,`fk_ward`,`location_name`,`location_desc`,`location_lat`,`location_long`) values (1,2,'kaya','test',NULL,NULL),(3,3,'pwani','test',NULL,NULL),(4,4,'Kichinjioni','',NULL,NULL),(5,4,'Unknown','',NULL,NULL);

/*Table structure for table `re_lookup` */

DROP TABLE IF EXISTS `re_lookup`;

CREATE TABLE `re_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_key` varchar(200) DEFAULT NULL,
  `_value` text,
  `category` int(11) DEFAULT NULL,
  `_order` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  CONSTRAINT `re_lookup_ibfk_1` FOREIGN KEY (`category`) REFERENCES `re_lookup_category` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup` */

insert  into `re_lookup`(`id`,`_key`,`_value`,`category`,`_order`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'1','Single Rooms',1,NULL,0,NULL,NULL,NULL,NULL),(2,'2','Double Rooms',1,NULL,NULL,NULL,NULL,NULL,NULL),(3,'m','Male',2,NULL,NULL,NULL,NULL,NULL,NULL),(4,'f','Female',2,NULL,NULL,NULL,NULL,NULL,NULL),(5,'1','ON',3,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2','OFF',3,NULL,NULL,NULL,NULL,NULL,NULL),(7,'3','Bed sitter',1,NULL,NULL,NULL,NULL,NULL,NULL),(8,'4','One Bedrooms',1,NULL,NULL,NULL,NULL,NULL,NULL),(9,'5','Two Bedrooms',1,NULL,NULL,NULL,NULL,NULL,NULL),(10,'6','Three Bedrooms',1,NULL,NULL,NULL,NULL,NULL,NULL),(11,'7','Maisonette',1,NULL,NULL,NULL,NULL,NULL,NULL),(12,'8','Bungalow',1,NULL,NULL,NULL,NULL,NULL,NULL),(13,'1','Cash',4,NULL,NULL,NULL,NULL,NULL,NULL),(14,'2','Mpesa',4,NULL,NULL,NULL,NULL,NULL,NULL),(15,'3','Cheque',4,NULL,NULL,NULL,NULL,NULL,NULL),(17,'1','Paid',5,NULL,NULL,NULL,NULL,NULL,NULL),(18,'0','Unmatched',6,NULL,NULL,NULL,NULL,NULL,NULL),(19,'1','Matched',6,NULL,NULL,NULL,NULL,NULL,NULL),(20,'1','Pending',7,NULL,NULL,NULL,NULL,NULL,NULL),(21,'2','Paid',7,NULL,NULL,NULL,NULL,NULL,NULL),(22,'1','Available',8,NULL,1,NULL,NULL,NULL,NULL),(23,'2','Not Available',8,NULL,1,NULL,NULL,NULL,NULL),(24,'1','Available',9,NULL,1,NULL,NULL,NULL,NULL),(25,'2','Not Available',9,NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_lookup_category` */

DROP TABLE IF EXISTS `re_lookup_category`;

CREATE TABLE `re_lookup_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup_category` */

insert  into `re_lookup_category`(`id`,`category_name`) values (1,'Property Type'),(2,'Gender'),(3,'Status'),(4,'Payment Method'),(5,'Payment Status'),(6,'Match Bills'),(7,'Disbursement Status'),(8,'Property Status'),(9,'Sublet Status');

/*Table structure for table `re_management` */

DROP TABLE IF EXISTS `re_management`;

CREATE TABLE `re_management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) DEFAULT NULL,
  `management_type` int(11) DEFAULT NULL,
  `management_name` varchar(200) DEFAULT NULL,
  `location` text,
  `address` text,
  `profile_desc` text,
  `featured_property` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `re_management_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `re_management` */

insert  into `re_management`(`id`,`fk_user_id`,`management_type`,`management_name`,`location`,`address`,`profile_desc`,`featured_property`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (2,NULL,1,'Jongeto Agency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_migration` */

DROP TABLE IF EXISTS `re_migration`;

CREATE TABLE `re_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `re_migration` */

/*Table structure for table `re_occupancy` */

DROP TABLE IF EXISTS `re_occupancy`;

CREATE TABLE `re_occupancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_sublet_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `notes` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_id` (`fk_property_id`),
  KEY `fk_sublet_id` (`fk_sublet_id`),
  KEY `fk_tenant_id` (`fk_user_id`),
  CONSTRAINT `re_occupancy_ibfk_1` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_ibfk_2` FOREIGN KEY (`fk_sublet_id`) REFERENCES `re_property_sublet` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_ibfk_3` FOREIGN KEY (`fk_user_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy` */

insert  into `re_occupancy`(`id`,`fk_property_id`,`fk_sublet_id`,`fk_user_id`,`start_date`,`end_date`,`notes`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (18,10,18,17,'2016-05-11',NULL,'',1,NULL,NULL,NULL,NULL),(19,10,19,19,'2017-02-21',NULL,'',1,NULL,NULL,NULL,NULL),(20,10,20,18,'2016-09-27',NULL,'',1,NULL,NULL,NULL,NULL),(21,10,21,20,'2017-07-20',NULL,'',1,NULL,NULL,NULL,NULL),(22,11,22,32,'2017-10-11',NULL,'',1,NULL,NULL,NULL,NULL),(23,11,23,29,'2017-10-06',NULL,'',1,NULL,NULL,NULL,NULL),(24,11,24,31,'2017-09-11',NULL,'',1,NULL,NULL,NULL,NULL),(25,11,25,28,'2017-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(26,11,26,22,'2017-05-19',NULL,'',1,NULL,NULL,NULL,NULL),(27,11,27,27,'2017-03-24',NULL,'',1,NULL,NULL,NULL,NULL),(28,11,28,30,'2017-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(29,11,29,26,'2017-01-10',NULL,'',1,NULL,NULL,NULL,NULL),(30,11,30,25,'2016-06-10',NULL,'',1,NULL,NULL,NULL,NULL),(31,11,31,23,'2016-09-13',NULL,'',1,NULL,NULL,NULL,NULL),(32,11,32,24,'2015-01-11',NULL,'',1,NULL,NULL,NULL,NULL),(33,12,34,34,'2010-01-15',NULL,'',1,NULL,NULL,NULL,NULL),(34,12,35,36,'2014-01-07',NULL,'',1,NULL,NULL,NULL,NULL),(35,12,36,35,'2014-02-06',NULL,'',1,NULL,NULL,NULL,NULL),(36,13,38,38,'2015-03-10',NULL,'',1,NULL,NULL,NULL,NULL),(37,13,39,40,'2016-03-15',NULL,'',1,NULL,NULL,NULL,NULL),(38,13,40,41,'2016-09-06',NULL,'',1,NULL,NULL,NULL,NULL),(39,13,41,42,'2017-08-06',NULL,'',1,NULL,NULL,NULL,NULL),(40,13,42,43,'2016-04-12',NULL,'',1,NULL,NULL,NULL,NULL),(41,13,43,39,'2013-10-15',NULL,'',1,NULL,NULL,NULL,NULL),(42,14,44,45,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(43,14,45,46,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(44,14,46,47,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(45,14,47,49,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(46,14,48,50,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(47,14,49,54,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(48,14,50,52,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(49,14,51,51,'2016-08-15',NULL,'',1,NULL,NULL,NULL,NULL),(50,14,52,48,'2017-05-31',NULL,'',1,NULL,NULL,NULL,NULL),(51,14,53,53,'2017-09-01',NULL,'',1,NULL,NULL,NULL,NULL),(52,14,54,55,'2017-10-05',NULL,'',1,NULL,NULL,NULL,NULL),(53,14,55,56,'2017-09-11',NULL,'',1,NULL,NULL,NULL,NULL),(54,15,56,63,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(55,15,57,62,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(56,15,58,59,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(57,15,59,61,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(58,15,60,58,'2016-11-29',NULL,'',1,NULL,NULL,NULL,NULL),(59,15,61,60,'2017-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(60,16,63,65,'2016-11-17',NULL,'',1,NULL,NULL,NULL,NULL),(61,17,64,67,'2016-06-09',NULL,'',1,NULL,NULL,NULL,NULL),(62,18,65,72,'2016-08-12',NULL,'',1,NULL,NULL,NULL,NULL),(63,18,66,71,'2015-02-09',NULL,'',1,NULL,NULL,NULL,NULL),(64,18,67,69,'2012-01-26',NULL,'',1,NULL,NULL,NULL,NULL),(65,18,68,70,'2014-11-12',NULL,'',1,NULL,NULL,NULL,NULL),(66,19,69,83,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(67,19,70,77,'2017-02-22',NULL,'',1,NULL,NULL,NULL,NULL),(68,19,71,82,'2017-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(69,19,72,78,'2012-05-15',NULL,'',1,NULL,NULL,NULL,NULL),(70,19,73,74,'2016-10-10',NULL,'',1,NULL,NULL,NULL,NULL),(71,19,74,81,'2015-12-23',NULL,'',1,NULL,NULL,NULL,NULL),(72,19,75,75,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(73,19,76,76,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(74,19,77,79,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(75,19,78,80,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(76,19,79,84,'2017-08-11',NULL,'',1,NULL,NULL,NULL,NULL),(77,20,83,97,'2017-10-12',NULL,'',1,NULL,NULL,NULL,NULL),(78,20,84,95,'2017-11-08',NULL,'',1,NULL,NULL,NULL,NULL),(79,20,85,96,'2017-10-10',NULL,'',1,NULL,NULL,NULL,NULL),(80,20,86,92,'2016-05-31',NULL,'',1,NULL,NULL,NULL,NULL),(81,20,87,86,'2015-08-21',NULL,'',1,NULL,NULL,NULL,NULL),(82,20,88,88,'2015-12-03',NULL,'',1,NULL,NULL,NULL,NULL),(83,20,89,94,'2016-08-02',NULL,'',1,NULL,NULL,NULL,NULL),(84,20,90,87,'2010-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(85,20,91,89,'2017-08-29',NULL,'',1,NULL,NULL,NULL,NULL),(86,20,92,90,NULL,NULL,'',1,NULL,NULL,NULL,NULL),(87,20,93,93,'2012-10-16',NULL,'',1,NULL,NULL,NULL,NULL),(88,21,97,103,'2017-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(89,21,98,99,'2017-07-05',NULL,'',1,NULL,NULL,NULL,NULL),(90,21,99,104,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(91,21,100,100,'2011-09-05',NULL,'',1,NULL,NULL,NULL,NULL),(92,21,101,102,'2011-08-08',NULL,'',1,NULL,NULL,NULL,NULL),(93,21,102,101,'2010-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(94,21,103,105,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(95,21,104,106,'2017-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(96,22,106,110,'2017-02-02',NULL,'',1,NULL,NULL,NULL,NULL),(97,22,107,113,'2016-05-10',NULL,'',1,NULL,NULL,NULL,NULL),(98,22,108,112,'2015-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(99,22,109,109,'2015-01-26',NULL,'',1,NULL,NULL,NULL,NULL),(100,22,110,108,'2016-02-03',NULL,'',1,NULL,NULL,NULL,NULL),(101,22,111,111,'2015-10-12',NULL,'',1,NULL,NULL,NULL,NULL),(102,22,112,114,'2016-08-09',NULL,'',1,NULL,NULL,NULL,NULL),(103,22,113,115,'2017-10-11',NULL,'',1,NULL,NULL,NULL,NULL),(104,23,117,118,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(105,23,118,117,'2012-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(106,23,119,119,'2017-05-05',NULL,'',1,NULL,NULL,NULL,NULL),(107,24,120,126,'2015-09-16',NULL,'',1,NULL,NULL,NULL,NULL),(108,24,121,124,'2011-03-18',NULL,'',1,NULL,NULL,NULL,NULL),(109,24,122,122,'2011-01-06',NULL,'',1,NULL,NULL,NULL,NULL),(110,24,123,123,'2010-02-11',NULL,'',1,NULL,NULL,NULL,NULL),(111,24,124,125,'2010-03-10',NULL,'',1,NULL,NULL,NULL,NULL),(112,24,125,121,'2016-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(113,25,126,129,'2016-07-12',NULL,'',1,NULL,NULL,NULL,NULL),(114,25,127,130,'2016-07-08',NULL,'',1,NULL,NULL,NULL,NULL),(115,25,128,131,'2017-08-18',NULL,'',1,NULL,NULL,NULL,NULL),(116,26,130,133,'2006-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(117,26,131,134,'2016-08-08',NULL,'',1,NULL,NULL,NULL,NULL),(118,26,132,135,'2016-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(119,26,133,136,'2016-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(120,27,137,138,'2016-12-13',NULL,'',1,NULL,NULL,NULL,NULL),(121,27,138,139,'2017-03-07',NULL,'',1,NULL,NULL,NULL,NULL),(122,27,139,140,'2015-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(123,27,140,141,'2015-04-08',NULL,'',1,NULL,NULL,NULL,NULL),(124,27,141,142,'2017-02-03',NULL,'',1,NULL,NULL,NULL,NULL),(125,27,142,143,'2017-10-09',NULL,'',1,NULL,NULL,NULL,NULL),(126,27,143,144,'2017-10-09',NULL,'',1,NULL,NULL,NULL,NULL),(127,28,145,146,'2016-09-25',NULL,'',1,NULL,NULL,NULL,NULL),(128,28,146,147,'2017-06-07',NULL,'',1,NULL,NULL,NULL,NULL),(129,28,147,148,'2012-04-24',NULL,'',1,NULL,NULL,NULL,NULL),(130,28,148,149,'2017-07-03',NULL,'',1,NULL,NULL,NULL,NULL),(131,28,149,150,'2017-11-17',NULL,'',1,NULL,NULL,NULL,NULL),(132,28,150,151,'2016-02-05',NULL,'',1,NULL,NULL,NULL,NULL),(133,28,151,152,'2016-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(134,28,152,154,'2017-08-11',NULL,'',1,NULL,NULL,NULL,NULL),(135,28,153,155,'2017-11-30',NULL,'',1,NULL,NULL,NULL,NULL),(136,29,157,157,'2010-11-08',NULL,'',1,NULL,NULL,NULL,NULL),(137,29,158,158,'2015-10-08',NULL,'',1,NULL,NULL,NULL,NULL),(138,29,159,159,'2016-04-05',NULL,'',1,NULL,NULL,NULL,NULL),(139,30,160,162,'2017-03-02',NULL,'',1,NULL,NULL,NULL,NULL),(140,30,161,163,'2017-02-06',NULL,'',1,NULL,NULL,NULL,NULL),(141,30,162,164,'2015-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(142,30,163,165,'2015-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(143,30,164,166,'2015-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(144,30,165,167,'2000-06-06',NULL,'',1,NULL,NULL,NULL,NULL),(145,30,166,168,'2013-11-05',NULL,'',1,NULL,NULL,NULL,NULL),(146,30,167,169,'2017-03-12',NULL,'',1,NULL,NULL,NULL,NULL),(147,30,168,170,'2017-03-12',NULL,'',1,NULL,NULL,NULL,NULL),(148,30,169,171,'2013-08-12',NULL,'',1,NULL,NULL,NULL,NULL),(149,30,170,172,'2013-07-09',NULL,'',1,NULL,NULL,NULL,NULL),(150,30,171,173,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(151,30,172,174,'2017-11-03',NULL,'',1,NULL,NULL,NULL,NULL),(152,31,173,176,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(153,32,175,178,'2008-06-10',NULL,'',1,NULL,NULL,NULL,NULL),(154,33,176,180,'2017-06-02',NULL,'',1,NULL,NULL,NULL,NULL),(155,33,177,181,'2017-06-05',NULL,'',1,NULL,NULL,NULL,NULL),(156,33,178,182,'2013-09-10',NULL,'',1,NULL,NULL,NULL,NULL),(157,33,179,183,'2015-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(158,33,180,184,'2013-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(159,33,181,185,'2015-05-04',NULL,'',1,NULL,NULL,NULL,NULL),(160,34,186,187,'2015-06-24',NULL,'',1,NULL,NULL,NULL,NULL),(161,34,187,188,'2013-05-06',NULL,'',1,NULL,NULL,NULL,NULL),(162,34,188,189,'2015-07-06',NULL,'',1,NULL,NULL,NULL,NULL),(163,34,189,191,'2016-07-27',NULL,'',1,NULL,NULL,NULL,NULL),(164,35,194,193,'2014-03-04',NULL,'',1,NULL,NULL,NULL,NULL),(165,35,195,194,'2013-11-04',NULL,'',1,NULL,NULL,NULL,NULL),(166,35,196,195,'2015-01-05',NULL,'',1,NULL,NULL,NULL,NULL),(167,36,200,197,'2014-05-07',NULL,'',1,NULL,NULL,NULL,NULL),(168,37,201,199,'2014-08-06',NULL,'',1,NULL,NULL,NULL,NULL),(169,38,202,201,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(170,38,203,202,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(171,38,204,203,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(172,38,205,204,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(173,38,206,205,'2017-11-03',NULL,'',1,NULL,NULL,NULL,NULL),(174,38,207,206,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(175,38,208,207,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(176,38,209,208,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(177,39,211,210,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(178,39,212,211,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(179,39,213,212,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(180,39,214,213,'2017-11-05',NULL,'',1,NULL,NULL,NULL,NULL),(181,39,215,214,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(182,39,216,215,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(183,39,217,216,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(184,39,218,217,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(185,39,219,218,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(186,39,220,219,'2017-10-31',NULL,'',1,NULL,NULL,NULL,NULL),(187,10,223,18,'2018-02-01',NULL,'',1,NULL,NULL,NULL,NULL),(188,17,224,92,'2018-02-01',NULL,'',1,NULL,NULL,NULL,NULL),(189,40,225,66,'2018-02-01',NULL,'',1,NULL,NULL,NULL,NULL),(190,40,226,224,'2018-02-01',NULL,'',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_occupancy_invoice` */

DROP TABLE IF EXISTS `re_occupancy_invoice`;

CREATE TABLE `re_occupancy_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `fk_occupancy_rent` int(11) NOT NULL,
  `created_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_invoice` */

insert  into `re_occupancy_invoice`(`id`,`invoice_no`,`fk_occupancy_rent`,`created_on`,`created_by`) values (1,'INV-10-13',158,'2017-12-11',1),(2,'INV-10-13',159,'2017-12-11',1),(3,'INV-10-13',160,'2017-12-11',1),(4,'INV-11-13',161,'2017-12-11',1),(5,'INV-11-13',162,'2017-12-11',1),(6,'INV-11-13',163,'2017-12-11',1),(7,'INV-13-13',164,'2017-12-11',1),(8,'INV-13-13',165,'2017-12-11',1),(9,'INV-13-13',166,'2017-12-11',1),(10,'INV-14-13',167,'2017-12-11',1),(11,'INV-14-13',168,'2017-12-11',1),(12,'INV-14-13',169,'2017-12-11',1),(13,'INV-15-13',170,'2017-12-11',1),(14,'INV-15-13',171,'2017-12-11',1),(15,'INV-15-13',172,'2017-12-11',1),(16,'INV-16-13',173,'2017-12-11',1),(17,'INV-16-13',174,'2017-12-11',1),(18,'INV-16-13',175,'2017-12-11',1),(19,'INV-10-13',2,'2018-01-03',1),(20,'INV-10-13',0,'2018-01-03',1),(21,'INV-10-13',0,'2018-01-03',1),(22,'INV-11-13',4,'2018-01-03',1),(23,'INV-11-13',0,'2018-01-03',1),(24,'INV-11-13',0,'2018-01-03',1),(25,'INV-13-13',6,'2018-01-03',1),(26,'INV-13-13',0,'2018-01-03',1),(27,'INV-13-13',0,'2018-01-03',1),(28,'INV-13-13',0,'2018-01-03',1),(29,'INV-14-13',8,'2018-01-03',1),(30,'INV-14-13',0,'2018-01-03',1),(31,'INV-14-13',0,'2018-01-03',1),(32,'INV-14-13',0,'2018-01-03',1),(33,'INV-15-13',10,'2018-01-03',1),(34,'INV-15-13',0,'2018-01-03',1),(35,'INV-15-13',0,'2018-01-03',1),(36,'INV-15-13',0,'2018-01-03',1),(37,'INV-16-13',12,'2018-01-03',1),(38,'INV-16-13',0,'2018-01-03',1),(39,'INV-16-13',0,'2018-01-03',1),(40,'INV-1-13',14,'2018-01-03',1),(41,'INV-8-13',16,'2018-01-03',1),(42,'INV-17-13',0,'2018-01-04',1),(43,'INV-17-13',0,'2018-01-04',1),(44,'INV-17-13',0,'2018-01-04',1),(45,'INV-17-13',0,'2018-01-04',1),(46,'INV-18-13',0,'2018-01-04',1),(47,'INV-18-13',0,'2018-01-05',15),(48,'INV-18-13',0,'2018-01-05',15),(49,'INV-19-13',0,'2018-01-05',15),(50,'INV-19-13',0,'2018-01-05',15),(51,'INV-20-13',0,'2018-01-05',15),(52,'INV-20-13',0,'2018-01-05',15),(53,'INV-21-13',0,'2018-01-05',15),(54,'INV-21-13',0,'2018-01-05',15),(55,'INV-60-13',0,'2018-01-05',15),(56,'INV-18-13',0,'2018-02-21',1),(57,'INV-19-13',0,'2018-02-21',1),(58,'INV-20-13',0,'2018-02-21',1),(59,'INV-21-13',0,'2018-02-21',1),(60,'INV-22-13',0,'2018-02-21',1),(61,'INV-22-13',0,'2018-02-21',1),(62,'INV-23-13',0,'2018-02-21',1),(63,'INV-23-13',0,'2018-02-21',1),(64,'INV-24-13',0,'2018-02-21',1),(65,'INV-24-13',0,'2018-02-21',1),(66,'INV-25-13',0,'2018-02-21',1),(67,'INV-25-13',0,'2018-02-21',1),(68,'INV-26-13',0,'2018-02-21',1),(69,'INV-26-13',0,'2018-02-21',1),(70,'INV-27-13',0,'2018-02-21',1),(71,'INV-27-13',0,'2018-02-21',1),(72,'INV-28-13',0,'2018-02-21',1),(73,'INV-28-13',0,'2018-02-21',1),(74,'INV-29-13',0,'2018-02-21',1),(75,'INV-29-13',0,'2018-02-21',1),(76,'INV-30-13',0,'2018-02-21',1),(77,'INV-30-13',0,'2018-02-21',1),(78,'INV-31-13',0,'2018-02-21',1),(79,'INV-31-13',0,'2018-02-21',1),(80,'INV-32-13',0,'2018-02-21',1),(81,'INV-32-13',0,'2018-02-21',1),(82,'INV-33-13',0,'2018-02-21',1),(83,'INV-33-13',0,'2018-02-21',1),(84,'INV-34-13',0,'2018-02-21',1),(85,'INV-34-13',0,'2018-02-21',1),(86,'INV-35-13',0,'2018-02-21',1),(87,'INV-35-13',0,'2018-02-21',1),(88,'INV-36-13',0,'2018-02-21',1),(89,'INV-36-13',0,'2018-02-21',1),(90,'INV-37-13',0,'2018-02-21',1),(91,'INV-37-13',0,'2018-02-21',1),(92,'INV-38-13',0,'2018-02-21',1),(93,'INV-38-13',0,'2018-02-21',1),(94,'INV-39-13',0,'2018-02-21',1),(95,'INV-39-13',0,'2018-02-21',1),(96,'INV-40-13',0,'2018-02-21',1),(97,'INV-40-13',0,'2018-02-21',1),(98,'INV-41-13',0,'2018-02-21',1),(99,'INV-41-13',0,'2018-02-21',1),(100,'INV-42-13',0,'2018-02-21',1),(101,'INV-42-13',0,'2018-02-21',1),(102,'INV-43-13',0,'2018-02-21',1),(103,'INV-43-13',0,'2018-02-21',1),(104,'INV-44-13',0,'2018-02-21',1),(105,'INV-44-13',0,'2018-02-21',1),(106,'INV-45-13',0,'2018-02-21',1),(107,'INV-45-13',0,'2018-02-21',1),(108,'INV-46-13',0,'2018-02-21',1),(109,'INV-46-13',0,'2018-02-21',1),(110,'INV-47-13',0,'2018-02-21',1),(111,'INV-47-13',0,'2018-02-21',1),(112,'INV-48-13',0,'2018-02-21',1),(113,'INV-48-13',0,'2018-02-21',1),(114,'INV-49-13',0,'2018-02-21',1),(115,'INV-49-13',0,'2018-02-21',1),(116,'INV-50-13',0,'2018-02-21',1),(117,'INV-50-13',0,'2018-02-21',1),(118,'INV-51-13',0,'2018-02-21',1),(119,'INV-51-13',0,'2018-02-21',1),(120,'INV-52-13',0,'2018-02-21',1),(121,'INV-52-13',0,'2018-02-21',1),(122,'INV-53-13',0,'2018-02-21',1),(123,'INV-53-13',0,'2018-02-21',1),(124,'INV-60-13',0,'2018-02-21',1),(125,'INV-187-13',0,'2018-02-23',1),(126,'INV-187-13',0,'2018-02-23',1),(127,'INV-189-20',25,'2018-02-27',1),(128,'INV-189-20',0,'2018-02-27',1),(129,'INV-190-20',27,'2018-02-27',1),(130,'INV-190-20',0,'2018-02-27',1);

/*Table structure for table `re_occupancy_issue` */

DROP TABLE IF EXISTS `re_occupancy_issue`;

CREATE TABLE `re_occupancy_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) DEFAULT NULL,
  `fk_related_term` int(11) DEFAULT NULL,
  `issue_type` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `desc` text,
  `status_remarks` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  KEY `fk_related_term` (`fk_related_term`),
  CONSTRAINT `re_occupancy_issue_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_issue_ibfk_2` FOREIGN KEY (`fk_related_term`) REFERENCES `re_occupancy_term` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_issue` */

/*Table structure for table `re_occupancy_payments` */

DROP TABLE IF EXISTS `re_occupancy_payments`;

CREATE TABLE `re_occupancy_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `payment_date` date NOT NULL,
  `fk_receipt_id` int(11) NOT NULL,
  `payment_method` int(11) NOT NULL,
  `ref_no` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  KEY `fk_receipt_id` (`fk_receipt_id`),
  CONSTRAINT `re_occupancy_payments_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`),
  CONSTRAINT `re_occupancy_payments_ibfk_2` FOREIGN KEY (`fk_receipt_id`) REFERENCES `re_receipt` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_payments` */

insert  into `re_occupancy_payments`(`id`,`fk_occupancy_id`,`amount`,`payment_date`,`fk_receipt_id`,`payment_method`,`ref_no`,`status`,`created_by`,`created_on`,`modified_by`,`modified_on`) values (6,18,7000,'2018-01-05',26,1,'',2,15,'2018-01-05',NULL,NULL),(7,18,7500,'2018-01-14',27,1,'',2,1,'2018-01-14',NULL,NULL),(8,18,10000,'2018-01-20',28,1,'',2,1,'2018-01-20',NULL,NULL),(9,18,10000,'2018-02-07',29,1,'',2,1,'2018-02-07',NULL,NULL),(10,187,15000,'2018-02-23',30,1,'',2,1,'2018-02-23',NULL,NULL),(11,190,20000,'2018-02-27',31,1,'',1,1,'2018-02-27',NULL,NULL),(12,190,25000,'2018-02-27',32,1,'',1,1,'2018-02-27',NULL,NULL);

/*Table structure for table `re_occupancy_payments_mapping` */

DROP TABLE IF EXISTS `re_occupancy_payments_mapping`;

CREATE TABLE `re_occupancy_payments_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_payment` int(11) DEFAULT NULL,
  `fk_occupancy_rent` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_payment` (`fk_occupancy_payment`),
  KEY `fk_occupancy_rent` (`fk_occupancy_rent`),
  CONSTRAINT `re_occupancy_payments_mapping_ibfk_1` FOREIGN KEY (`fk_occupancy_payment`) REFERENCES `re_occupancy_payments` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_payments_mapping_ibfk_2` FOREIGN KEY (`fk_occupancy_rent`) REFERENCES `re_occupancy_rent` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_payments_mapping` */

insert  into `re_occupancy_payments_mapping`(`id`,`fk_occupancy_payment`,`fk_occupancy_rent`,`amount`,`type`) values (1,6,16,'500.00','complete'),(2,6,17,'1000.00','complete'),(3,6,18,'2000.00','complete'),(4,10,88,'7000.00','complete'),(5,10,89,'7000.00','complete'),(6,11,92,'10000.00','complete'),(7,11,93,'10000.00','complete');

/*Table structure for table `re_occupancy_rent` */

DROP TABLE IF EXISTS `re_occupancy_rent`;

CREATE TABLE `re_occupancy_rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) DEFAULT NULL,
  `fk_term` int(11) DEFAULT NULL,
  `fk_source` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `amount` float(11,2) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  KEY `fk_source` (`fk_source`),
  KEY `fk_term` (`fk_term`),
  CONSTRAINT `re_occupancy_rent_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_rent_ibfk_2` FOREIGN KEY (`fk_source`) REFERENCES `re_source` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_rent_ibfk_3` FOREIGN KEY (`fk_term`) REFERENCES `re_term` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_rent` */

insert  into `re_occupancy_rent`(`id`,`fk_occupancy_id`,`fk_term`,`fk_source`,`month`,`year`,`amount`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (7,18,1,1,1,2018,7000.00,1,'2018-01-05 08:32:19',15,'2018-02-23 18:32:00',1),(8,18,4,19,1,2018,7000.00,1,'2018-01-05 08:32:19',15,'2018-02-23 18:32:01',1),(9,19,1,1,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(10,19,4,19,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(11,20,1,1,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(12,20,4,19,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(13,21,1,1,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(14,21,4,19,1,2018,7000.00,0,'2018-01-05 08:32:19',15,NULL,NULL),(15,60,1,1,1,2018,1500.00,0,'2018-01-05 08:32:20',15,NULL,NULL),(16,18,NULL,13,1,2018,500.00,1,'2018-01-14 20:39:25',1,'2018-02-23 18:44:30',1),(17,18,NULL,16,1,2018,1000.00,1,'2018-01-14 20:40:15',1,'2018-02-23 18:45:03',1),(18,18,NULL,15,1,2018,2000.00,1,'2018-02-04 16:24:02',1,'2018-02-23 18:47:55',1),(19,18,1,1,2,2018,7500.00,1,'2018-02-21 17:57:37',1,NULL,NULL),(20,19,1,1,2,2018,7000.00,1,'2018-02-21 17:57:37',1,NULL,NULL),(21,20,1,1,2,2018,7000.00,1,'2018-02-21 17:57:37',1,NULL,NULL),(22,21,1,1,2,2018,7000.00,1,'2018-02-21 17:57:37',1,NULL,NULL),(23,22,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(24,22,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(25,23,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(26,23,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(27,24,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(28,24,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(29,25,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(30,25,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(31,26,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(32,26,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(33,27,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(34,27,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(35,28,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(36,28,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(37,29,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(38,29,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(39,30,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(40,30,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(41,31,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(42,31,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(43,32,1,1,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(44,32,4,19,2,2018,2300.00,1,'2018-02-21 17:57:38',1,NULL,NULL),(45,33,1,1,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(46,33,4,19,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(47,34,1,1,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(48,34,4,19,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(49,35,1,1,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(50,35,4,19,2,2018,1500.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(51,36,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(52,36,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(53,37,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(54,37,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(55,38,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(56,38,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(57,39,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(58,39,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(59,40,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(60,40,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(61,41,1,1,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(62,41,4,19,2,2018,700.00,1,'2018-02-21 17:57:39',1,NULL,NULL),(63,42,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(64,42,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(65,43,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(66,43,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(67,44,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(68,44,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(69,45,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(70,45,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(71,46,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(72,46,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(73,47,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(74,47,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(75,48,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(76,48,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(77,49,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(78,49,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(79,50,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(80,50,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(81,51,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(82,51,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(83,52,1,1,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(84,52,4,19,2,2018,1300.00,1,'2018-02-21 17:57:40',1,NULL,NULL),(85,53,1,1,2,2018,1300.00,1,'2018-02-21 17:57:41',1,NULL,NULL),(86,53,4,19,2,2018,1300.00,1,'2018-02-21 17:57:41',1,NULL,NULL),(87,60,1,1,2,2018,1500.00,1,'2018-02-21 17:57:41',1,NULL,NULL),(88,187,1,1,2,2018,7000.00,1,'2018-02-23 19:25:31',1,'2018-02-23 19:30:43',1),(89,187,4,19,2,2018,7000.00,1,'2018-02-23 19:25:31',1,'2018-02-23 19:30:43',1),(90,189,1,1,2,2018,10000.00,0,'2018-02-27 21:41:49',1,NULL,NULL),(91,189,4,19,2,2018,10000.00,0,'2018-02-27 21:41:49',1,NULL,NULL),(92,190,1,1,2,2018,10000.00,1,'2018-02-27 21:41:49',1,'2018-03-01 14:37:20',1),(93,190,4,19,2,2018,10000.00,1,'2018-02-27 21:41:49',1,'2018-03-01 14:37:20',1);

/*Table structure for table `re_occupancy_term` */

DROP TABLE IF EXISTS `re_occupancy_term`;

CREATE TABLE `re_occupancy_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) DEFAULT NULL,
  `fk_property_term_id` int(11) DEFAULT NULL,
  `value` varchar(200) DEFAULT NULL,
  `term_date` date DEFAULT NULL,
  `date_signed` date DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  KEY `fk_property_term_id` (`fk_property_term_id`),
  CONSTRAINT `re_occupancy_term_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_term_ibfk_2` FOREIGN KEY (`fk_property_term_id`) REFERENCES `re_property_term` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_term` */

insert  into `re_occupancy_term`(`id`,`fk_occupancy_id`,`fk_property_term_id`,`value`,`term_date`,`date_signed`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,18,14,'7500','2018-01-01','2018-01-01',1,NULL,NULL,NULL,NULL),(2,18,15,'10','2018-01-01','2018-01-01',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_preference` */

DROP TABLE IF EXISTS `re_preference`;

CREATE TABLE `re_preference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_feature` int(11) DEFAULT NULL,
  `preference_title` varchar(200) DEFAULT NULL,
  `preference_desc` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feature` (`fk_feature`),
  CONSTRAINT `re_preference_ibfk_1` FOREIGN KEY (`fk_feature`) REFERENCES `re_feature` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_preference` */

/*Table structure for table `re_property` */

DROP TABLE IF EXISTS `re_property`;

CREATE TABLE `re_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `property_name` varchar(200) DEFAULT NULL,
  `property_desc` text,
  `fk_property_location` int(11) DEFAULT NULL,
  `property_type` int(11) DEFAULT NULL,
  `management_id` int(200) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `property_video_url` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `management_id` (`management_id`),
  KEY `owner_id` (`owner_id`),
  KEY `property_location` (`fk_property_location`),
  CONSTRAINT `re_property_ibfk_1` FOREIGN KEY (`management_id`) REFERENCES `re_management` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_ibfk_3` FOREIGN KEY (`fk_property_location`) REFERENCES `re_estate` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `re_property` */

insert  into `re_property`(`id`,`property_name`,`property_desc`,`fk_property_location`,`property_type`,`management_id`,`owner_id`,`property_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (10,'Maku Apartment','',4,4,2,16,NULL,1,NULL,NULL,NULL,NULL),(11,'Kajole Apartments','',1,1,2,21,NULL,1,NULL,NULL,NULL,NULL),(12,'Katiku Apartments','',5,1,2,33,NULL,1,NULL,NULL,NULL,NULL),(13,'Fatuma Apartments','',5,1,2,37,NULL,1,NULL,NULL,NULL,NULL),(14,'Goe Apartments','',5,1,2,44,NULL,1,NULL,NULL,NULL,NULL),(15,'Alice Apartments','',5,1,2,57,NULL,1,NULL,NULL,NULL,NULL),(16,'Kaingu Apartments','',5,1,2,64,NULL,2,NULL,NULL,NULL,NULL),(17,'Rosemary Apartments','',5,3,2,66,NULL,1,NULL,NULL,NULL,NULL),(18,'Patience Apartments','',5,1,2,68,NULL,1,NULL,NULL,NULL,NULL),(19,'Elizabeth Apartmet','',5,1,2,73,NULL,1,NULL,NULL,NULL,NULL),(20,'Kanyetta Apartment','',5,1,2,85,NULL,1,NULL,NULL,NULL,NULL),(21,'Monicah Apartment','',5,1,2,98,NULL,1,NULL,NULL,NULL,NULL),(22,'Jenni Apartments','',5,1,2,107,NULL,1,NULL,NULL,NULL,NULL),(23,'Ester Apartment','',5,1,2,116,NULL,1,NULL,NULL,NULL,NULL),(24,'Patience Apartments','',4,1,2,120,NULL,1,NULL,NULL,NULL,NULL),(25,'Mercy Apartments','',5,1,2,127,NULL,1,NULL,NULL,NULL,NULL),(26,'Omar Apartment','',5,1,2,132,NULL,1,NULL,NULL,NULL,NULL),(27,'Changawa Apartments','',5,1,2,137,NULL,1,NULL,NULL,NULL,NULL),(28,'Newton Apartment','',5,1,2,145,NULL,1,NULL,NULL,NULL,NULL),(29,'Mary Apartments','',5,1,2,156,NULL,1,NULL,NULL,NULL,NULL),(30,'Flo Apartment','',5,1,2,160,NULL,1,NULL,NULL,NULL,NULL),(31,'Linah Apartments','',5,1,2,175,NULL,1,NULL,NULL,NULL,NULL),(32,'Swaleh Apartment','',5,1,2,177,NULL,1,NULL,NULL,NULL,NULL),(33,'Nasoro Apartments','',5,1,2,179,NULL,1,NULL,NULL,NULL,NULL),(34,'Mundu Apartments','',5,1,2,186,NULL,1,NULL,NULL,NULL,NULL),(35,'Loyce Apartment','',5,1,2,192,NULL,1,NULL,NULL,NULL,NULL),(36,'Salama Apartment','',5,4,2,196,NULL,1,NULL,NULL,NULL,NULL),(37,'Jimmy Apartment','',5,1,2,198,NULL,1,NULL,NULL,NULL,NULL),(38,'lewa Apartment','',5,1,2,200,NULL,1,NULL,NULL,NULL,NULL),(39,'Lenox appartments','stable',5,1,2,209,NULL,1,NULL,NULL,NULL,NULL),(40,'Monkey Plaza','',4,5,2,223,NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_property_area` */

DROP TABLE IF EXISTS `re_property_area`;

CREATE TABLE `re_property_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_sub_location_id` int(11) DEFAULT NULL,
  `area_desc` text,
  `area_name` varchar(200) DEFAULT NULL,
  `fk_estate_id` int(200) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_id` (`fk_property_id`),
  KEY `fk_sub_location_id` (`fk_sub_location_id`),
  CONSTRAINT `re_property_area_ibfk_1` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_area_ibfk_2` FOREIGN KEY (`fk_sub_location_id`) REFERENCES `re_sub_location` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_property_area` */

/*Table structure for table `re_property_feature` */

DROP TABLE IF EXISTS `re_property_feature`;

CREATE TABLE `re_property_feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_feature` int(11) DEFAULT NULL,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_sublet_id` int(11) DEFAULT NULL,
  `feature_narration` text,
  `feature_video_url` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feature` (`fk_feature`),
  KEY `fk_property_id` (`fk_property_id`),
  KEY `fk_sublet_id` (`fk_sublet_id`),
  CONSTRAINT `re_property_feature_ibfk_1` FOREIGN KEY (`fk_feature`) REFERENCES `re_feature` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_feature_ibfk_2` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_feature_ibfk_3` FOREIGN KEY (`fk_sublet_id`) REFERENCES `re_property_sublet` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_feature` */

insert  into `re_property_feature`(`id`,`fk_feature`,`fk_property_id`,`fk_sublet_id`,`feature_narration`,`feature_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,4,11,18,'Free',NULL,1,NULL,NULL,NULL,NULL),(2,5,11,18,'',NULL,1,NULL,NULL,NULL,NULL),(3,6,11,18,'',NULL,1,NULL,NULL,NULL,NULL),(4,4,12,18,'',NULL,1,NULL,NULL,NULL,NULL),(5,5,13,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(6,5,16,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(7,5,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_property_feature_image` */

DROP TABLE IF EXISTS `re_property_feature_image`;

CREATE TABLE `re_property_feature_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_feature_id` int(11) DEFAULT NULL,
  `image_name` text,
  `image_url` text,
  `image_title` varchar(200) DEFAULT NULL,
  `image_caption` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_feature_id` (`fk_property_feature_id`),
  CONSTRAINT `re_property_feature_image_ibfk_1` FOREIGN KEY (`fk_property_feature_id`) REFERENCES `re_property_feature` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_property_feature_image` */

/*Table structure for table `re_property_sublet` */

DROP TABLE IF EXISTS `re_property_sublet`;

CREATE TABLE `re_property_sublet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `sublet_name` varchar(200) DEFAULT NULL,
  `sublet_desc` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_sublet` */

insert  into `re_property_sublet`(`id`,`fk_property_id`,`sublet_name`,`sublet_desc`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (18,10,'Unit 1','',1,NULL,NULL,NULL,NULL),(19,10,'Unit 2','',1,NULL,NULL,NULL,NULL),(20,10,'Unit 3','',1,NULL,NULL,NULL,NULL),(21,10,'Unit 4','',1,NULL,NULL,NULL,NULL),(22,11,'Unit 1','',1,NULL,NULL,NULL,NULL),(23,11,'Unit 2','',1,NULL,NULL,NULL,NULL),(24,11,'Unit 3','',1,NULL,NULL,NULL,NULL),(25,11,'Unit 4','',1,NULL,NULL,NULL,NULL),(26,11,'Unit 5','',1,NULL,NULL,NULL,NULL),(27,11,'Unit 6','',1,NULL,NULL,NULL,NULL),(28,11,'Unit 7','',1,NULL,NULL,NULL,NULL),(29,11,'Unit 8','',1,NULL,NULL,NULL,NULL),(30,11,'Unit 9','',1,NULL,NULL,NULL,NULL),(31,11,'Unit 10','',1,NULL,NULL,NULL,NULL),(32,11,'Unit 11','',1,NULL,NULL,NULL,NULL),(33,11,'Unit 12','',1,NULL,NULL,NULL,NULL),(34,12,'Unit 1','',1,NULL,NULL,NULL,NULL),(35,12,'Unit 2','',1,NULL,NULL,NULL,NULL),(36,12,'Unit 3','',1,NULL,NULL,NULL,NULL),(37,12,'Unit 4','',1,NULL,NULL,NULL,NULL),(38,13,'Unit 2','',1,NULL,NULL,NULL,NULL),(39,13,'Unit 3','',1,NULL,NULL,NULL,NULL),(40,13,'Unit 1','',1,NULL,NULL,NULL,NULL),(41,13,'Unit 4','',1,NULL,NULL,NULL,NULL),(42,13,'Unit 5','',1,NULL,NULL,NULL,NULL),(43,13,'Unit 6','',1,NULL,NULL,NULL,NULL),(44,14,'Unit 1','',1,NULL,NULL,NULL,NULL),(45,14,'Unit 2','',1,NULL,NULL,NULL,NULL),(46,14,'Unit 3','',1,NULL,NULL,NULL,NULL),(47,14,'Unit 6','',1,NULL,NULL,NULL,NULL),(48,14,'Unit 4','',1,NULL,NULL,NULL,NULL),(49,14,'Unit 5','',1,NULL,NULL,NULL,NULL),(50,14,'Unit 7','',1,NULL,NULL,NULL,NULL),(51,14,'Unit 10','',1,NULL,NULL,NULL,NULL),(52,14,'Unit 11','',1,NULL,NULL,NULL,NULL),(53,14,'Unit 12','',1,NULL,NULL,NULL,NULL),(54,14,'Unit 8','',1,NULL,NULL,NULL,NULL),(55,14,'Unit 9','',1,NULL,NULL,NULL,NULL),(56,15,'Unit 1','',1,NULL,NULL,NULL,NULL),(57,15,'Unit 2','',1,NULL,NULL,NULL,NULL),(58,15,'Unit 3','',1,NULL,NULL,NULL,NULL),(59,15,'Unit 4','',1,NULL,NULL,NULL,NULL),(60,15,'Unit 5','',1,NULL,NULL,NULL,NULL),(61,15,'Unit 6','',1,NULL,NULL,NULL,NULL),(62,15,'Unit 7','',1,NULL,NULL,NULL,NULL),(63,16,'Unit 1','',1,NULL,NULL,NULL,NULL),(64,17,'Unit 1','',1,NULL,NULL,NULL,NULL),(65,18,'Unit 1','',1,NULL,NULL,NULL,NULL),(66,18,'Unit 2','',1,NULL,NULL,NULL,NULL),(67,18,'Unit 3','',1,NULL,NULL,NULL,NULL),(68,18,'Unit 4','',1,NULL,NULL,NULL,NULL),(69,19,'Unit 1','',1,NULL,NULL,NULL,NULL),(70,19,'Unit 2','',1,NULL,NULL,NULL,NULL),(71,19,'Unit 3','',1,NULL,NULL,NULL,NULL),(72,19,'Unit 4','',1,NULL,NULL,NULL,NULL),(73,19,'Unit 5','',1,NULL,NULL,NULL,NULL),(74,19,'Unit 6','',1,NULL,NULL,NULL,NULL),(75,19,'unit','',1,NULL,NULL,NULL,NULL),(76,19,'Unit 7','',1,NULL,NULL,NULL,NULL),(77,19,'Unit 8','',1,NULL,NULL,NULL,NULL),(78,19,'Unit 9','',1,NULL,NULL,NULL,NULL),(79,19,'Unit 9','',1,NULL,NULL,NULL,NULL),(80,19,'Unit 10','',1,NULL,NULL,NULL,NULL),(81,19,'Unit 11','',1,NULL,NULL,NULL,NULL),(82,19,'Unit 12','',1,NULL,NULL,NULL,NULL),(83,20,'Unit 1','',1,NULL,NULL,NULL,NULL),(84,20,'Unit 2','',1,NULL,NULL,NULL,NULL),(85,20,'Unit 3','',1,NULL,NULL,NULL,NULL),(86,20,'Unit 4','',1,NULL,NULL,NULL,NULL),(87,20,'Unit 5','',1,NULL,NULL,NULL,NULL),(88,20,'Unit 6','',1,NULL,NULL,NULL,NULL),(89,20,'Unit 6','',1,NULL,NULL,NULL,NULL),(90,20,'Unit 7','',1,NULL,NULL,NULL,NULL),(91,20,'Unit 8','',1,NULL,NULL,NULL,NULL),(92,20,'Unit 9','',1,NULL,NULL,NULL,NULL),(93,20,'Unit 10','',1,NULL,NULL,NULL,NULL),(94,20,'Unit 11','',1,NULL,NULL,NULL,NULL),(95,20,'Unit 13','',1,NULL,NULL,NULL,NULL),(96,20,'Unit 12','',1,NULL,NULL,NULL,NULL),(97,21,'Unit 1','',1,NULL,NULL,NULL,NULL),(98,21,'Unit 2','',1,NULL,NULL,NULL,NULL),(99,21,'Unit 3','',1,NULL,NULL,NULL,NULL),(100,21,'Unit 4','',1,NULL,NULL,NULL,NULL),(101,21,'Unit 5','',1,NULL,NULL,NULL,NULL),(102,21,'Unit 6','',1,NULL,NULL,NULL,NULL),(103,21,'Unit 7','',1,NULL,NULL,NULL,NULL),(104,21,'Unit 8','',1,NULL,NULL,NULL,NULL),(105,21,'Unit 9','',1,NULL,NULL,NULL,NULL),(106,22,'Unit 5','',1,NULL,NULL,NULL,NULL),(107,22,'Unit 1','',1,NULL,NULL,NULL,NULL),(108,22,'Unit 2','',1,NULL,NULL,NULL,NULL),(109,22,'Unit 3','',1,NULL,NULL,NULL,NULL),(110,22,'Unit 4','',1,NULL,NULL,NULL,NULL),(111,22,'Unit 6','',1,NULL,NULL,NULL,NULL),(112,22,'Unit 7','',1,NULL,NULL,NULL,NULL),(113,22,'Unit 8','',1,NULL,NULL,NULL,NULL),(114,22,'Unit 9','',1,NULL,NULL,NULL,NULL),(115,22,'Unit 10','',1,NULL,NULL,NULL,NULL),(116,22,'Unit 11','',1,NULL,NULL,NULL,NULL),(117,23,'Unit 1','',1,NULL,NULL,NULL,NULL),(118,23,'Unit 2','',1,NULL,NULL,NULL,NULL),(119,23,'Unit 3','',1,NULL,NULL,NULL,NULL),(120,24,'Unit 2','',1,NULL,NULL,NULL,NULL),(121,24,'Unit 1','',1,NULL,NULL,NULL,NULL),(122,24,'Unit 3','',1,NULL,NULL,NULL,NULL),(123,24,'Unit 4','',1,NULL,NULL,NULL,NULL),(124,24,'Unit 5','',1,NULL,NULL,NULL,NULL),(125,24,'Unit 6','',1,NULL,NULL,NULL,NULL),(126,25,'Unit 1','',1,NULL,NULL,NULL,NULL),(127,25,'Unit 2','',1,NULL,NULL,NULL,NULL),(128,25,'Unit 4','',1,NULL,NULL,NULL,NULL),(129,25,'Unit 3','',1,NULL,NULL,NULL,NULL),(130,26,'Unit 1','',1,NULL,NULL,NULL,NULL),(131,26,'Unit 3','',1,NULL,NULL,NULL,NULL),(132,26,'Unit 2','',1,NULL,NULL,NULL,NULL),(133,26,'Unit 4','',1,NULL,NULL,NULL,NULL),(134,26,'Unit 5','',1,NULL,NULL,NULL,NULL),(135,26,'Unit 6','',1,NULL,NULL,NULL,NULL),(136,26,'Unit 7','',1,NULL,NULL,NULL,NULL),(137,27,'Unit 1','',1,NULL,NULL,NULL,NULL),(138,27,'Unit 2','',1,NULL,NULL,NULL,NULL),(139,27,'Unit 3','',1,NULL,NULL,NULL,NULL),(140,27,'Unit 4','',1,NULL,NULL,NULL,NULL),(141,27,'Unit 5','',1,NULL,NULL,NULL,NULL),(142,27,'Unit 6','',1,NULL,NULL,NULL,NULL),(143,27,'Unit 7','',1,NULL,NULL,NULL,NULL),(144,27,'Unit 8','',1,NULL,NULL,NULL,NULL),(145,28,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(146,28,'Unit 2','',NULL,NULL,NULL,NULL,NULL),(147,28,'Unit 3','',NULL,NULL,NULL,NULL,NULL),(148,28,'Unit 4','',NULL,NULL,NULL,NULL,NULL),(149,28,'Unit 5','',NULL,NULL,NULL,NULL,NULL),(150,28,'Unit 6','',NULL,NULL,NULL,NULL,NULL),(151,28,'Unit 7','',NULL,NULL,NULL,NULL,NULL),(152,28,'Unit 8','',NULL,NULL,NULL,NULL,NULL),(153,28,'Unit 9','',NULL,NULL,NULL,NULL,NULL),(154,28,'Unit 10','',NULL,NULL,NULL,NULL,NULL),(155,28,'Unit 10','',NULL,NULL,NULL,NULL,NULL),(156,28,'Unit 12','',NULL,NULL,NULL,NULL,NULL),(157,29,'Unit 1','',1,NULL,NULL,NULL,NULL),(158,29,'Unit 2','',1,NULL,NULL,NULL,NULL),(159,29,'Unit 3','',1,NULL,NULL,NULL,NULL),(160,30,'Unit 1','',1,NULL,NULL,NULL,NULL),(161,30,'Unit 2','',1,NULL,NULL,NULL,NULL),(162,30,'Unit 3','',1,NULL,NULL,NULL,NULL),(163,30,'Unit 4','',1,NULL,NULL,NULL,NULL),(164,30,'Unit 5','',1,NULL,NULL,NULL,NULL),(165,30,'Unit 6','',1,NULL,NULL,NULL,NULL),(166,30,'Unit 7','',1,NULL,NULL,NULL,NULL),(167,30,'Unit 8','',1,NULL,NULL,NULL,NULL),(168,30,'Unit 9','',1,NULL,NULL,NULL,NULL),(169,30,'Unit 10','',1,NULL,NULL,NULL,NULL),(170,30,'Unit 11','',1,NULL,NULL,NULL,NULL),(171,30,'Unit 13','',1,NULL,NULL,NULL,NULL),(172,30,'Unit 12','',1,NULL,NULL,NULL,NULL),(173,31,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(174,31,'ANNE','',NULL,NULL,NULL,NULL,NULL),(175,32,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(176,33,'Unit 1','',1,NULL,NULL,NULL,NULL),(177,33,'Unit 2','',1,NULL,NULL,NULL,NULL),(178,33,'Unit 3','',1,NULL,NULL,NULL,NULL),(179,33,'Unit 4','',1,NULL,NULL,NULL,NULL),(180,33,'Unit 5','',1,NULL,NULL,NULL,NULL),(181,33,'Unit 6','',1,NULL,NULL,NULL,NULL),(182,33,'Unit 7','',1,NULL,NULL,NULL,NULL),(183,33,'Unit 8','',1,NULL,NULL,NULL,NULL),(184,33,'Unit 8','',1,NULL,NULL,NULL,NULL),(185,33,'Unit 9','',1,NULL,NULL,NULL,NULL),(186,34,'Unit 1','',1,NULL,NULL,NULL,NULL),(187,34,'Unit 2','',1,NULL,NULL,NULL,NULL),(188,34,'Unit 3','',1,NULL,NULL,NULL,NULL),(189,34,'Unit 4','',1,NULL,NULL,NULL,NULL),(190,34,'Unit 5','',1,NULL,NULL,NULL,NULL),(191,34,'Unit 6','',1,NULL,NULL,NULL,NULL),(192,34,'Unit 7','',1,NULL,NULL,NULL,NULL),(193,34,'Unit 8','',1,NULL,NULL,NULL,NULL),(194,35,'Unit 2','',1,NULL,NULL,NULL,NULL),(195,35,'Unit 2','',1,NULL,NULL,NULL,NULL),(196,35,'Unit 5','',1,NULL,NULL,NULL,NULL),(197,35,'Unit 3','',1,NULL,NULL,NULL,NULL),(198,35,'Unit 1','',1,NULL,NULL,NULL,NULL),(199,35,'Unit 4','',1,NULL,NULL,NULL,NULL),(200,36,'Unit 1','',1,NULL,NULL,NULL,NULL),(201,37,'Unit 1','',1,NULL,NULL,NULL,NULL),(202,38,'Unit 1','',1,NULL,NULL,NULL,NULL),(203,38,'Unit 2','',1,NULL,NULL,NULL,NULL),(204,38,'Unit 3','',1,NULL,NULL,NULL,NULL),(205,38,'Unit 4','',1,NULL,NULL,NULL,NULL),(206,38,'Unit 5','',1,NULL,NULL,NULL,NULL),(207,38,'Unit 6','',1,NULL,NULL,NULL,NULL),(208,38,'Unit 8','',1,NULL,NULL,NULL,NULL),(209,38,'Unit 9','',1,NULL,NULL,NULL,NULL),(210,38,'Unit 7','',1,NULL,NULL,NULL,NULL),(211,39,'Unit 1','',1,NULL,NULL,NULL,NULL),(212,39,'Unit 2','',1,NULL,NULL,NULL,NULL),(213,39,'Unit 3','',1,NULL,NULL,NULL,NULL),(214,39,'Unit 4','',1,NULL,NULL,NULL,NULL),(215,39,'Unit 5','',1,NULL,NULL,NULL,NULL),(216,39,'Unit 6','',1,NULL,NULL,NULL,NULL),(217,39,'Unit 7','',1,NULL,NULL,NULL,NULL),(218,39,'Unit 8','',1,NULL,NULL,NULL,NULL),(219,39,'Unit 9','',1,NULL,NULL,NULL,NULL),(220,39,'Unit 10','',1,NULL,NULL,NULL,NULL),(221,39,'Unit 11','',1,NULL,NULL,NULL,NULL),(222,39,'Unit 12','',1,NULL,NULL,NULL,NULL),(223,10,'unit5','',1,NULL,NULL,NULL,NULL),(224,17,'Unit 2','',1,NULL,NULL,NULL,NULL),(225,40,'Unit 1','',1,NULL,NULL,NULL,NULL),(226,40,'Unit 2','',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_property_term` */

DROP TABLE IF EXISTS `re_property_term`;

CREATE TABLE `re_property_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_term_id` int(11) DEFAULT NULL,
  `term_title` varchar(200) DEFAULT NULL,
  `term_value` varchar(200) DEFAULT NULL,
  `term_narration` text,
  `action_handler` varchar(200) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_id` (`fk_property_id`),
  KEY `fk_term_id` (`fk_term_id`),
  CONSTRAINT `re_property_term_ibfk_1` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_term_ibfk_2` FOREIGN KEY (`fk_term_id`) REFERENCES `re_term` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_term` */

insert  into `re_property_term`(`id`,`fk_property_id`,`fk_term_id`,`term_title`,`term_value`,`term_narration`,`action_handler`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (14,10,1,'rent','7000','',NULL,1,NULL,NULL,NULL,NULL),(15,10,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(16,10,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(17,16,1,'rent','1500','',NULL,1,NULL,NULL,NULL,NULL),(18,10,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(19,10,4,'deposit','7000','',NULL,1,NULL,NULL,NULL,NULL),(20,10,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(21,11,1,'rent','2300','',NULL,1,NULL,NULL,NULL,NULL),(22,11,2,'Date rent due','7','',NULL,1,NULL,NULL,NULL,NULL),(23,11,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(24,11,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(25,11,4,'deposit','2300','',NULL,1,NULL,NULL,NULL,NULL),(26,11,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(27,12,1,'rent','1500','',NULL,1,NULL,NULL,NULL,NULL),(28,12,2,'Date rent due','7','',NULL,1,NULL,NULL,NULL,NULL),(29,12,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(30,12,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(31,12,4,'deposit','1500','',NULL,1,NULL,NULL,NULL,NULL),(32,12,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(33,13,1,'rent','700','',NULL,1,NULL,NULL,NULL,NULL),(34,13,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(35,13,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(36,13,10,'Penalty','7','',NULL,1,NULL,NULL,NULL,NULL),(37,13,4,'deposit','700','',NULL,1,NULL,NULL,NULL,NULL),(38,13,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(39,13,16,'agent','700','',NULL,1,NULL,NULL,NULL,NULL),(40,12,16,'agent','1500','',NULL,1,NULL,NULL,NULL,NULL),(41,11,16,'agent','2300','',NULL,1,NULL,NULL,NULL,NULL),(42,10,16,'agent','7000','',NULL,1,NULL,NULL,NULL,NULL),(43,14,1,'rent','1300','',NULL,1,NULL,NULL,NULL,NULL),(44,14,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(45,14,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(46,14,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(47,14,4,'deposit','1300','',NULL,1,NULL,NULL,NULL,NULL),(48,14,14,'Visit','','',NULL,1,NULL,NULL,NULL,NULL),(49,14,16,'agent','1300','',NULL,1,NULL,NULL,NULL,NULL),(50,10,3,NULL,'10','Date of disbursement',NULL,1,NULL,NULL,NULL,NULL),(51,40,1,NULL,'10000','',NULL,1,NULL,NULL,NULL,NULL),(52,40,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(53,40,3,NULL,'8','',NULL,1,NULL,NULL,NULL,NULL),(54,40,4,NULL,'10000','',NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_receipt` */

DROP TABLE IF EXISTS `re_receipt`;

CREATE TABLE `re_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `re_receipt` */

insert  into `re_receipt`(`id`,`receipt_no`,`date_created`,`created_by`) values (1,'jnr1','2017-12-13 08:32:06',1),(2,'jnr2','2017-12-13 08:36:48',1),(3,'jnr3','2017-12-13 08:49:28',1),(4,'jnr4','2017-12-27 16:52:55',1),(5,'jnr5','2017-12-27 16:53:11',1),(6,'jnr6','2017-12-28 09:55:05',1),(7,'jnr7','2018-01-03 08:38:26',1),(8,'jnr8','2018-01-03 14:20:17',1),(9,'jnr9','2018-01-03 14:24:16',1),(10,'jnr10','2018-01-04 18:48:40',1),(11,'jnr11','2018-01-04 18:48:53',1),(12,'jnr12','2018-01-04 18:49:42',1),(13,'jnr13','2018-01-04 18:50:08',1),(14,'jnr14','2018-01-04 18:50:31',1),(15,'jnr15','2018-01-04 18:51:40',1),(16,'jnr16','2018-01-05 08:34:07',15),(17,'jnr17','2018-01-05 08:43:40',15),(18,'jnr18','2018-01-05 08:47:58',15),(19,'jnr19','2018-01-05 08:54:48',15),(20,'jnr20','2018-01-05 08:54:59',15),(21,'jnr21','2018-01-05 08:55:07',15),(22,'jnr22','2018-01-05 09:03:41',15),(23,'jnr23','2018-01-05 09:04:08',15),(24,'jnr24','2018-01-05 09:04:16',15),(25,'jnr25','2018-01-05 09:05:14',15),(26,'jnr26','2018-01-05 09:20:22',15),(27,'jnr27','2018-01-14 17:51:41',1),(28,'jnr28','2018-01-20 20:19:20',1),(29,'jnr29','2018-02-07 16:46:10',1),(30,'jnr30','2018-02-23 19:26:24',1),(31,'jnr31','2018-02-27 21:56:44',1),(32,'jnr32','2018-02-27 22:01:28',1);

/*Table structure for table `re_role` */

DROP TABLE IF EXISTS `re_role`;

CREATE TABLE `re_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) DEFAULT NULL,
  `role_description` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_role` */

insert  into `re_role`(`id`,`role_name`,`role_description`,`date_created`,`createdby`,`date_modified`,`modified_by`) values (1,'agency admin','system administrator',NULL,NULL,NULL,NULL);

/*Table structure for table `re_source` */

DROP TABLE IF EXISTS `re_source`;

CREATE TABLE `re_source` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(50) DEFAULT NULL,
  `source_description` text,
  `source_type` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `re_source` */

insert  into `re_source`(`id`,`source_name`,`source_description`,`source_type`,`category`) values (1,'Rent','','Income','tenant'),(2,'Landlord Imprest','','Expense','landlord'),(3,'Disbursement','','Expense','landlord'),(4,'Agency Allowance','Rent collection allowances','Income','tenant'),(5,'Transport','','Expense','agent'),(6,'Lunch','','Expense','agent'),(7,'Bank Charges','','Expense','agent'),(8,'Salary','','Expense','agent'),(9,'Salary Advance','','Expense','agent'),(10,'Penalty Waiver','Penalty cancellation','Expense','tenant'),(11,'Penalty','Penalty incurred due to late payments','Income','tenant'),(13,'Storage Fees','Goods storage fees','Income','tenant'),(14,'Tenant Transport','Tenant Transport','Income','tenant'),(15,'Breaking Fees','Fees for breaking house','Income','tenant'),(16,'Visit Fees','','Income','tenant'),(17,'Locking Fees','Locking Fees','Income','tenant'),(18,'Agency Fee','Agency Fee','Income','tenant'),(19,'Rent Deposit','Rent Deposit','Income','tenant'),(20,'Water Deposit','Water Deposit','Income','tenant'),(21,'Electricity Deposit','Electricity Deposit','Income','tenant'),(22,'Water Bill','Water Bill','Income','tenant'),(23,'Electricity Bill','Electricity Bill','Income','tenant'),(24,'Garbage Collection','Garbage Collection Bills','Income','tenant'),(25,'assasas','asasasa','Income','tenant');

/*Table structure for table `re_sub_location` */

DROP TABLE IF EXISTS `re_sub_location`;

CREATE TABLE `re_sub_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_location` int(11) DEFAULT NULL,
  `sub_loc_name` varchar(200) DEFAULT NULL,
  `sub_loc_desc` text,
  `sub_loc_lat` varchar(10) DEFAULT NULL,
  `sub_loc_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_location` (`fk_location`),
  CONSTRAINT `re_sub_location_ibfk_1` FOREIGN KEY (`fk_location`) REFERENCES `re_location` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `re_sub_location` */

insert  into `re_sub_location`(`id`,`fk_location`,`sub_loc_name`,`sub_loc_desc`,`sub_loc_lat`,`sub_loc_long`) values (2,1,'kaya','test',NULL,NULL),(3,3,'kibaoni','test',NULL,NULL),(4,5,'Unknown','',NULL,NULL);

/*Table structure for table `re_subcounty` */

DROP TABLE IF EXISTS `re_subcounty`;

CREATE TABLE `re_subcounty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_county` int(11) DEFAULT NULL,
  `subcounty_name` varchar(200) DEFAULT NULL,
  `subcounty_desc` text,
  `subcounty_lat` varchar(10) DEFAULT NULL,
  `subcounty_long` varchar(10) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_county` (`fk_county`),
  CONSTRAINT `re_subcounty_ibfk_1` FOREIGN KEY (`fk_county`) REFERENCES `re_county` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `re_subcounty` */

insert  into `re_subcounty`(`id`,`fk_county`,`subcounty_name`,`subcounty_desc`,`subcounty_lat`,`subcounty_long`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (5,1,'kilifi north','test',NULL,NULL,NULL,NULL,NULL,NULL),(6,5,'Unknown','',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_tenant` */

DROP TABLE IF EXISTS `re_tenant`;

CREATE TABLE `re_tenant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) DEFAULT NULL,
  `tenant_desc` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`fk_user_id`),
  CONSTRAINT `re_tenant_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_tenant` */

/*Table structure for table `re_tenant_favourite` */

DROP TABLE IF EXISTS `re_tenant_favourite`;

CREATE TABLE `re_tenant_favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_tenant_id` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_property_id` (`fk_property_id`),
  KEY `fk_tenant_id` (`fk_tenant_id`),
  CONSTRAINT `re_tenant_favourite_ibfk_1` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_tenant_favourite_ibfk_2` FOREIGN KEY (`fk_tenant_id`) REFERENCES `re_tenant` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_tenant_favourite` */

/*Table structure for table `re_tenant_preference` */

DROP TABLE IF EXISTS `re_tenant_preference`;

CREATE TABLE `re_tenant_preference` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_tenant_id` int(11) DEFAULT NULL,
  `fk_pref_id` int(11) DEFAULT NULL,
  `pref_notes` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tenant_id` (`fk_tenant_id`),
  KEY `fk_pref_id` (`fk_pref_id`),
  CONSTRAINT `re_tenant_preference_ibfk_1` FOREIGN KEY (`fk_tenant_id`) REFERENCES `re_tenant` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_tenant_preference_ibfk_2` FOREIGN KEY (`fk_pref_id`) REFERENCES `re_preference` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_tenant_preference` */

/*Table structure for table `re_term` */

DROP TABLE IF EXISTS `re_term`;

CREATE TABLE `re_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_type` int(11) DEFAULT NULL,
  `term_name` varchar(200) DEFAULT NULL,
  `term_desc` text,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `actionhandler` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `re_term` */

insert  into `re_term`(`id`,`term_type`,`term_name`,`term_desc`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`,`actionhandler`) values (1,NULL,'Rent Amount','Rent payable monthly',1,NULL,NULL,NULL,NULL,'DateRentPay'),(2,NULL,'Date Rent Pay','Date rent due',1,NULL,NULL,NULL,NULL,''),(3,NULL,'Landlord Disbursment','Date of payments to landlord',1,NULL,NULL,NULL,NULL,'LandlordDisbursement'),(4,NULL,'Rent Deposit','Amount paid by tenant as deposit',1,NULL,NULL,NULL,NULL,'RentDeposit'),(5,NULL,'Watert Deposit','Amount paid by tenant as water bill deposit',1,NULL,NULL,NULL,NULL,'WaterDeposit'),(6,NULL,'Electricity Deposit','Amount paid as electricity deposit',1,NULL,NULL,NULL,NULL,'ElectricityDeposit'),(7,NULL,'Water Bills','Whether the agency will collect water bills.',1,NULL,NULL,NULL,NULL,'WaterBills'),(8,NULL,'Electricity Bills','Whether the agency will collect electricity bills',1,NULL,NULL,NULL,NULL,'ElectricityBills'),(9,NULL,'Security Times','Time security gate closes.',1,NULL,NULL,NULL,NULL,''),(10,NULL,'Penalty Date','Date penalty will be calculated.',1,NULL,NULL,NULL,NULL,'PenatlyDate'),(11,NULL,'Penalty Percentage','Percentage of the rent payable as penalty.',1,NULL,NULL,NULL,NULL,'PenaltyPercentage'),(13,NULL,'Agent Commission','A percentage of the rent paid to agent as commission.',1,NULL,NULL,NULL,NULL,'AgentCommission'),(14,NULL,'Visit Fees','Visit fees',1,NULL,NULL,NULL,NULL,NULL),(15,NULL,'Locking Fees','',1,NULL,NULL,NULL,NULL,NULL),(16,NULL,'Agency Fee','When entering the house',1,NULL,NULL,NULL,NULL,NULL),(17,NULL,'Breaking Fee','',1,NULL,NULL,NULL,NULL,NULL),(18,NULL,'Storage Fee','',1,NULL,NULL,NULL,NULL,NULL),(19,NULL,'Payment','',1,NULL,NULL,NULL,NULL,NULL),(20,NULL,'Imprest',NULL,1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_ward` */

DROP TABLE IF EXISTS `re_ward`;

CREATE TABLE `re_ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_subcounty` int(11) DEFAULT NULL,
  `ward_name` varchar(200) DEFAULT NULL,
  `ward_desc` text,
  `ward_lat` varchar(10) DEFAULT NULL,
  `ward_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcounty` (`fk_subcounty`),
  CONSTRAINT `re_ward_ibfk_1` FOREIGN KEY (`fk_subcounty`) REFERENCES `re_subcounty` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `re_ward` */

insert  into `re_ward`(`id`,`fk_subcounty`,`ward_name`,`ward_desc`,`ward_lat`,`ward_long`) values (2,5,'sokoni','test',NULL,NULL),(3,5,'kibarani','test',NULL,NULL),(4,6,'Unknown',NULL,NULL,NULL);

/*Table structure for table `re_ward_one` */

DROP TABLE IF EXISTS `re_ward_one`;

CREATE TABLE `re_ward_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_subcounty` int(11) DEFAULT NULL,
  `ward_name` varchar(200) DEFAULT NULL,
  `ward_desc` text,
  `ward_lat` varchar(10) DEFAULT NULL,
  `ward_long` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcounty` (`fk_subcounty`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `re_ward_one` */

insert  into `re_ward_one`(`id`,`fk_subcounty`,`ward_name`,`ward_desc`,`ward_lat`,`ward_long`) values (2,5,'sokoni','test',NULL,NULL),(3,5,'kibarani','test',NULL,NULL),(4,6,'Unknown','Hahahahah','',''),(5,5,'Chasimba','','','');

/*Table structure for table `sys_users` */

DROP TABLE IF EXISTS `sys_users`;

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_group_id` int(11) DEFAULT NULL,
  `fk_management_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `name1` varchar(200) DEFAULT NULL,
  `name2` varchar(200) DEFAULT NULL,
  `name3` varchar(200) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `id_number` varchar(50) DEFAULT NULL,
  `address` text,
  `date_added` datetime DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `color_code` varchar(100) DEFAULT NULL,
  `icon_id` varchar(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `residence` varchar(200) DEFAULT NULL,
  `occupation` varchar(200) DEFAULT NULL,
  `employer` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `fk_group_id` (`fk_group_id`),
  KEY `sys_users_ibfk_2` (`fk_management_id`),
  CONSTRAINT `sys_users_ibfk_1` FOREIGN KEY (`fk_group_id`) REFERENCES `re_group` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `sys_users_ibfk_2` FOREIGN KEY (`fk_management_id`) REFERENCES `re_management` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

/*Data for the table `sys_users` */

insert  into `sys_users`(`id`,`fk_group_id`,`fk_management_id`,`username`,`pass`,`name1`,`name2`,`name3`,`age`,`email`,`phone`,`id_number`,`address`,`date_added`,`gender`,`color_code`,`icon_id`,`position`,`residence`,`occupation`,`employer`) values (1,2,2,'karisa','$2y$13$vLlfRhW8Rb5JXww6WVvddewt7qZNVjkzICuYnVr6WIFzu/2WL3K.2','karisa','','nzaro',NULL,'','777748',NULL,'',NULL,'Male',NULL,NULL,NULL,NULL,NULL,NULL),(15,2,2,'anne','$2y$13$XFSFPm.3nvrYgU0tIJePg.3YXCQ4hoanP83rJelCgPq9m00azk.oG','Anne','Wangari','Njigua',NULL,'anne@test.com','723397330',NULL,'',NULL,'Female',NULL,NULL,NULL,NULL,NULL,NULL),(16,3,2,NULL,NULL,'Loice','Maku','Karisa',NULL,'','722393401','9876467','29, gede',NULL,'Female',NULL,NULL,NULL,'Matsangoni',NULL,NULL),(17,4,2,NULL,NULL,'Price','','Mabula',NULL,'','2147483647','22115315','',NULL,'Male',NULL,NULL,NULL,'Freetown',NULL,NULL),(18,4,2,NULL,NULL,'Delfina ','','Mkala',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(19,4,2,NULL,NULL,'Sifa','','Thoya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(20,4,2,NULL,NULL,'Josphine ','Andia','Baraka',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(21,3,2,NULL,NULL,'Kajole','Kadenge','Unda',NULL,'','713100672','0052387','',NULL,'Male',NULL,NULL,NULL,'kibaoni',NULL,NULL),(22,4,2,NULL,NULL,'Josphine ','','Chigamba',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(23,4,2,NULL,NULL,'Mukii','chebitok','Agnes',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(24,4,2,NULL,NULL,'Moses','','Masaai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(25,4,2,NULL,NULL,'Gladys','','mbuche',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(26,4,2,NULL,NULL,'Ester','','Wacheke',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(27,4,2,NULL,NULL,'Abdul','Ali','Hassan',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(28,4,2,NULL,NULL,'Brian','','isaac',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(29,4,2,NULL,NULL,'Japheth','Robinson','Mauya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(30,4,2,NULL,NULL,'Priscah','','Njeru',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(31,4,2,NULL,NULL,'Joyce','m','Makau',NULL,'','','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(32,4,2,NULL,NULL,'Brendah','kosgoi','Bernard',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(33,3,2,NULL,NULL,'Noyce','m','Katiku',NULL,'','722680560','','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(34,4,2,NULL,NULL,'Sidi','','Tsuma',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(35,4,2,NULL,NULL,'Salim','','Kaingu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(36,4,2,NULL,NULL,'Ester','Kadzo','Washe',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(37,3,2,NULL,NULL,'Fatuma','','Bakari',NULL,'','724915879','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(38,4,2,NULL,NULL,'Zawadi','','Kazungu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(39,4,2,NULL,NULL,'Ephron ','','Mwashimba                                                               ',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(40,4,2,NULL,NULL,'margeret','1','Karisa',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(41,4,2,NULL,NULL,'margeret','1','Karisa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(42,4,2,NULL,NULL,'margeret','3','Karisa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(43,4,2,NULL,NULL,'Jocktan','','Karisa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(44,3,2,NULL,NULL,'Josphat ','Goe','Chirume',NULL,'','721831913','','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(45,4,2,NULL,NULL,'Arnest ','','Kahindi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(46,4,2,NULL,NULL,'James','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(47,4,2,NULL,NULL,'Pole','Mwatua','Mwadzoya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(48,4,2,NULL,NULL,'Joshua','',' Kavutha',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(49,4,2,NULL,NULL,'Elina ','','Taura',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(50,4,2,NULL,NULL,'Neema','','Kazungu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(51,4,2,NULL,NULL,'Kima','Karisa','Kadenge',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(52,4,2,NULL,NULL,'Morris','','Idd',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(53,4,2,NULL,NULL,'Everlyne','',' Awino',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(54,4,2,NULL,NULL,'Mangale','','k',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(55,4,2,NULL,NULL,'Lasco ','Tzuma','Dominic',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(56,4,2,NULL,NULL,'Simon ','rukia','Kadzo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(57,3,2,NULL,NULL,'Alice','Ngala','Kamina',NULL,'','721571289','8656185','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(58,4,2,NULL,NULL,'Bwanaidi','','Wariojiouo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(59,4,2,NULL,NULL,'Stephen ','','Goe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(60,4,2,NULL,NULL,'Moses','n','Kombe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(61,4,2,NULL,NULL,'Peter','Mumbo','Rimba',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(62,4,2,NULL,NULL,'Teresia','','Fikirini',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(63,4,2,NULL,NULL,'DR','Ombati','Nyakundi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(64,3,2,NULL,NULL,'Paul ','','Kaingu',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(65,4,2,NULL,NULL,'Michael','','Kalume',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(66,3,2,NULL,NULL,'Rose','Mary','Mboja',NULL,'','720611923','2181849','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(67,4,2,NULL,NULL,'Juma','Ali','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(68,3,2,NULL,NULL,'Patience','Dhahabu','Charo',NULL,'','720906891','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(69,4,2,NULL,NULL,'Madina','Shida','Kenga',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(70,4,2,NULL,NULL,'Mary','','Tunje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(71,4,2,NULL,NULL,'Mdzomba ','Guyo','Chembe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(72,4,2,NULL,NULL,'Sakina','','Mwadzombo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(73,3,2,NULL,NULL,'Elizabeth','','Kasiwa',NULL,'','725234289','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(74,4,2,NULL,NULL,'Frankline ','','Muthaura',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(75,4,2,NULL,NULL,'Josehn','Stephen','Murima',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(76,4,2,NULL,NULL,'Kennedy','','Karisa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(77,4,2,NULL,NULL,'Jackson','m','Mwamuye',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(78,4,2,NULL,NULL,'Gladys','','Kombe',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(79,4,2,NULL,NULL,'Guzo','','Muta',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(80,4,2,NULL,NULL,'Jesca ','Charo','Shida',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(81,4,2,NULL,NULL,'Abdhulaziz','','Mohhamed',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(82,4,2,NULL,NULL,'Katana ','Karisa','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(83,4,2,NULL,NULL,'Muriuki','','Joseph',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(84,4,2,NULL,NULL,'Kai','','Kajembe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(85,3,2,NULL,NULL,'Killian','Mwatsuma','Kanyetta',NULL,'','733554280','4591261','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(86,4,2,NULL,NULL,'Parrick ','Charo','Ponda',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(87,4,2,NULL,NULL,'Shuhuli','','Mwamunda',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(88,4,2,NULL,NULL,'George','','Mwachondo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(89,4,2,NULL,NULL,'Samuel','','Mwau',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(90,4,2,NULL,NULL,'Nyawa','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(91,4,2,NULL,NULL,'Stephen','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(92,4,2,NULL,NULL,'AnnRose','','Karithi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(93,4,2,NULL,NULL,'Samuel','','Tsuma',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(94,4,2,NULL,NULL,'Godwins','Alfred','Mwai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(95,4,2,NULL,NULL,'Stephen',' Otieno','Fredrick',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(96,4,2,NULL,NULL,'Chirongo','','Mwangoka',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(97,4,2,NULL,NULL,'Beartice','','Koki',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(98,3,2,NULL,NULL,'Monicah ','','Mwananje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(99,4,2,NULL,NULL,'Salim','Bakari','Mweri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(100,4,2,NULL,NULL,'Nickson','m','Kiti',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(101,4,2,NULL,NULL,'Fatuma','','Karembo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(102,4,2,NULL,NULL,'Salim','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(103,4,2,NULL,NULL,'Sheila','','Anyango',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(104,4,2,NULL,NULL,'Everline ','','Wanjiku',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(105,4,2,NULL,NULL,'John','','Ngunjiri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(106,4,2,NULL,NULL,'Joseph','Odelo','Leaky',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(107,3,2,NULL,NULL,'Jenniffer','Mutheu','Mwamboi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(108,4,2,NULL,NULL,'John','Kithi','Ngombo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(109,4,2,NULL,NULL,'Chrispus','k','Kazungu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(110,4,2,NULL,NULL,'Mercy','','Katana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(111,4,2,NULL,NULL,'Carol','','Nzai',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(112,4,2,NULL,NULL,'Daniel','','Jele',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(113,4,2,NULL,NULL,'Milton','','Mbogo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(114,4,2,NULL,NULL,'Elizabeth','','Kitsao',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(115,4,2,NULL,NULL,'Rehema','','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(116,3,2,NULL,NULL,'Ester','P','Kea',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(117,4,2,NULL,NULL,'Christoper','','Nyale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(118,4,2,NULL,NULL,'Charles','','Mbuthia',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(119,4,2,NULL,NULL,'Emily','Hajilo','Buya',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(120,3,2,NULL,NULL,'Patience','Dhahabu','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(121,4,2,NULL,NULL,'Kaloleni','','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(122,4,2,NULL,NULL,'Aisha','','Msinda',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(123,4,2,NULL,NULL,'Kahindi','','Mitsanze',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(124,4,2,NULL,NULL,'Veronicah','k','Kenga',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(125,4,2,NULL,NULL,'Jumwa','','Wanje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(126,4,2,NULL,NULL,'Denis','','Mambo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(127,3,2,NULL,NULL,'Mercy','','Rodgers',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(128,4,2,NULL,NULL,'Maurice','',' Kapendezo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(129,4,2,NULL,NULL,'Amina','','Bakari',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(130,4,2,NULL,NULL,'Judith','','mbuche',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(131,4,2,NULL,NULL,'Peter','Mwamuye','Lewa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(132,3,2,NULL,NULL,'Hassan','','Omar',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(133,4,2,NULL,NULL,'Said','','Maitha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(134,4,2,NULL,NULL,'Joseph','','Nyamai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(135,4,2,NULL,NULL,'Gambari','','Mangale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(136,4,2,NULL,NULL,'Gambari','2','Mangale',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(137,3,2,NULL,NULL,'Richard','','Changawa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(138,4,2,NULL,NULL,'Agnes','Patience','Amina',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(139,4,2,NULL,NULL,'Tsuzi','','Ksiim',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(140,4,2,NULL,NULL,'Julius','','Kalama',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(141,4,2,NULL,NULL,'Joyce ','','Mnyazi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(142,4,2,NULL,NULL,'Elida','h','Lotan',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(143,4,2,NULL,NULL,'Salama','','Baraka',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(144,4,2,NULL,NULL,'Peter','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(145,3,2,NULL,NULL,'Newton','','Mwamoto',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(146,4,2,NULL,NULL,'Josphat','Tiongi','Mwema',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(147,4,2,NULL,NULL,'margeret','','Lewa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(148,4,2,NULL,NULL,'Judah','','Keah',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(149,4,2,NULL,NULL,'Kyalo','','Kimanzi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(150,4,2,NULL,NULL,'Onesmus','','Gona',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(151,4,2,NULL,NULL,'Kennedy','','Munyao',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(152,4,2,NULL,NULL,'Abisaki','','Nechesa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(153,4,2,NULL,NULL,'Bosire','Joshua','Omwenga',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(154,4,2,NULL,NULL,'John','','Saro',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(155,4,2,NULL,NULL,'Stephen','','Lindah',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(156,3,2,NULL,NULL,'Mary','Pendo','Mumba',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(157,4,2,NULL,NULL,'Fredrick','','Deche',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(158,4,2,NULL,NULL,'Everyne ','','Hawa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(159,4,2,NULL,NULL,'Peninah','','Fedha',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(160,3,2,NULL,NULL,'Florence','','Katana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(161,3,2,NULL,NULL,'Florence','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(162,4,2,NULL,NULL,'Emmanuel','','Kombe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(163,4,2,NULL,NULL,'Robert','Chivtsi','Mwatemo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(164,4,2,NULL,NULL,'James','Kombe','enock',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(165,4,2,NULL,NULL,'Rose','Mugii','Mbura',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(166,4,2,NULL,NULL,'Charo','','Kitsao',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(167,4,2,NULL,NULL,'Henry','','Sande',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(168,4,2,NULL,NULL,'Kalume','Ngumbao','Kithi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(169,4,2,NULL,NULL,'margeret','','Kaladze',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(170,4,2,NULL,NULL,'Slyvester','','Ronald',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(171,4,2,NULL,NULL,'Reuben','Mwatemo','Chivtsi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(172,4,2,NULL,NULL,'Ananiah','','Amani',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(173,4,2,NULL,NULL,'Jackson','','Hara',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(174,4,2,NULL,NULL,'Pauline','','K',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(175,3,2,NULL,NULL,'Linah','','Hiribae',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(176,4,2,NULL,NULL,'Anne','Wangari','Njigua',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(177,3,2,NULL,NULL,'Hassan','','Swaleh',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(178,4,2,NULL,NULL,'Khadijah','','Said',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(179,3,2,NULL,NULL,'Karisa','Katana','Nasoro',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(180,4,2,NULL,NULL,'Mary','Akinyi','Harriet',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(181,4,2,NULL,NULL,'Emmaculate','','Omolo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(182,4,2,NULL,NULL,'Ndolo','','Julius',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(183,4,2,NULL,NULL,'Juma','','Abdalla',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(184,4,2,NULL,NULL,'Victor','Kania','Mutuku',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(185,4,2,NULL,NULL,'Ochieng','','Stephen',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(186,3,2,NULL,NULL,'Edward','Mwatunza','Mundu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(187,4,2,NULL,NULL,'Salim','','Kithi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(188,4,2,NULL,NULL,'George','','Othuon',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(189,4,2,NULL,NULL,'Everlyne','Dama','Angore',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(190,4,2,NULL,NULL,'Saiboku','m','Mollel',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(191,4,2,NULL,NULL,'Agnes','Samini','Chefu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(192,3,2,NULL,NULL,'Loyce','Dhahabu','Mtwana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(193,4,2,NULL,NULL,'Nyiramafaranga ','','Adidja',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(194,4,2,NULL,NULL,'Philip','Onsase','Nyakundi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(195,4,2,NULL,NULL,'Ramadhani','Saidi','Ramadhani',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(196,3,2,NULL,NULL,'Salama','','Matano',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(197,4,2,NULL,NULL,'Peter','Muema','Maluki',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(198,3,2,NULL,NULL,'Jimmy','Mwambegu','Mumba',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(199,4,2,NULL,NULL,'Beatrice','','Jambo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(200,3,2,NULL,NULL,'Daniel','Lewa','Dzombo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(201,4,2,NULL,NULL,'Lavenda','','Ayoti',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(202,4,2,NULL,NULL,'Baraka','','Kazungu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(203,4,2,NULL,NULL,'Benson','Ruma','Mangale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(204,4,2,NULL,NULL,'Josphat','','Kiti',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(205,4,2,NULL,NULL,'Julius','','Katoto',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(206,4,2,NULL,NULL,'Susan','','Maluki',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(207,4,2,NULL,NULL,'Francis','','Chivatsi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(208,4,2,NULL,NULL,'Hamisi','','Mbura',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(209,3,2,NULL,NULL,'Lenox ','','Mkutanoni',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(210,4,2,NULL,NULL,'Dorah ','','Kinyeu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(211,4,2,NULL,NULL,'Shamsa','','Suleiman',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(212,4,2,NULL,NULL,'Laymax','','Mwamuye',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(213,4,2,NULL,NULL,'David','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(214,4,2,NULL,NULL,'Amos ','','Masha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(215,4,2,NULL,NULL,'James','','Iha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(216,4,2,NULL,NULL,'Nelson','','Mandela',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(217,4,2,NULL,NULL,'Davine','Irene','Amond',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(218,4,2,NULL,NULL,'Eric','','Mwangiri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(219,4,2,NULL,NULL,'Mark s. Ndurya','','Katana Mwango',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(220,2,2,'monky','$2y$13$jvuaY7CszVJobSZQD/.Nk.8UYNSnUm/osNmGisl.iA1aYFM1SEu96','the2010','','Monk',NULL,'the2010monk@gmail.com','0710202020',NULL,'',NULL,'Male',NULL,NULL,NULL,NULL,NULL,NULL),(221,3,2,NULL,NULL,'Anne','','Juma',NULL,'anne@juma.com','020202020','25123445','','2018-02-27 00:00:00','Female',NULL,NULL,NULL,'Malindi',NULL,NULL),(222,3,2,NULL,NULL,'Grace','','Katana',NULL,'anne1@juma.com','0710202021','251234453','','2018-02-27 18:16:07','Female',NULL,NULL,NULL,'Malindi',NULL,NULL),(223,3,2,NULL,NULL,'Majuto','','Kitukuu',NULL,'asasasa22@sasa.com','2322121222','234451617833','','2018-02-27 21:36:44','Male',NULL,NULL,NULL,'ssss',NULL,NULL),(224,4,2,NULL,NULL,'Bila','','Kerrow',NULL,'asasasa222@sasa.com','23221212225','23445161782222','','2018-02-27 21:41:14','Male',NULL,NULL,NULL,'MSA','clinical officer','county government');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
