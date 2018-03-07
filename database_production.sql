/*
SQLyog Community v11.51 (64 bit)
MySQL - 5.7.17-log : Database - real_production
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`real_production` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `real_production`;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_chart` */

insert  into `re_account_chart`(`id`,`code`,`name`,`fk_re_account_type`,`status`,`description`,`created_by`,`modified_by`,`created_on`,`modified_on`) values (32,1101,'Cash',1,1,'Cash Account',1,NULL,NULL,NULL),(33,1102,'Bank',1,1,'Bank Account',1,NULL,NULL,NULL),(34,1103,'Accounts Receivable',1,1,'Accounts Receivable\r\n',1,NULL,NULL,NULL),(35,1104,'Accounts Payable',2,1,'Accounts Payable\r\n',1,NULL,NULL,NULL),(36,1105,'Rent Income',4,1,NULL,1,NULL,NULL,NULL),(38,1107,'Disbursement',2,1,'Disbursement account',1,NULL,NULL,NULL),(39,1108,'Imprest',2,1,'Imprest paid to landlords',1,NULL,NULL,NULL),(40,1109,'Commission',4,1,NULL,1,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_entries` */

insert  into `re_account_entries`(`id`,`fk_account_chart`,`trasaction_type`,`amount`,`entry_date`,`created_on`,`created_by`,`origin_id`,`origin_model`) values (1,32,'debit',7000,'2018-03-08','2018-03-08 00:31:36',1,11,'app\\models\\OccupancyPayments'),(2,36,'credit',7000,'2018-03-08','2018-03-08 00:31:36',1,11,'app\\models\\OccupancyPayments'),(3,40,'debit',1400,'2018-03-08','2018-03-08 00:33:49',1,18,'app\\models\\OccupancyRent'),(4,36,'credit',1400,'2018-03-08','2018-03-08 00:33:49',1,18,'app\\models\\OccupancyRent'),(5,36,'debit',7000,'2018-03-08','2018-03-08 00:43:04',1,351,'app\\models\\OccupancyRent'),(6,34,'credit',7000,'2018-03-08','2018-03-08 00:43:04',1,351,'app\\models\\OccupancyRent'),(7,40,'debit',1400,'2018-03-08','2018-03-08 00:46:07',1,351,'app\\models\\OccupancyRent'),(8,36,'credit',1400,'2018-03-08','2018-03-08 00:46:07',1,351,'app\\models\\OccupancyRent');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_map` */

insert  into `re_account_map`(`id`,`fk_term`,`fk_account_chart`,`transaction_type`,`status`,`created_on`,`created_by`,`modified_on`,`modified_by`) values (1,1,36,'debit',1,'2017-12-18 15:00:25',NULL,NULL,NULL),(2,1,34,'credit',1,'2017-12-18 15:00:54',NULL,NULL,NULL),(3,3,38,'debit',1,NULL,NULL,NULL,NULL),(4,3,35,'credit',1,NULL,NULL,NULL,NULL),(5,20,35,'debit',1,NULL,NULL,NULL,NULL),(6,20,32,'credit',1,NULL,NULL,NULL,NULL),(7,19,32,'debit',1,NULL,NULL,NULL,NULL),(8,19,36,'credit',1,NULL,NULL,NULL,NULL),(9,13,40,'debit',1,NULL,NULL,NULL,NULL),(10,13,36,'credit',1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `re_disbursements` */

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
  `amount` double NOT NULL,
  `entry_date` date NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_landlord` (`fk_landlord`),
  CONSTRAINT `re_landlord_imprest_ibfk_1` FOREIGN KEY (`fk_landlord`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `re_landlord_imprest` */

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
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy` */

insert  into `re_occupancy`(`id`,`fk_property_id`,`fk_sublet_id`,`fk_user_id`,`start_date`,`end_date`,`notes`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (18,10,18,17,'2016-05-11',NULL,'',1,NULL,NULL,NULL,NULL),(19,10,19,19,'2017-02-21',NULL,'',1,NULL,NULL,NULL,NULL),(20,10,20,18,'2016-09-27',NULL,'',1,NULL,NULL,NULL,NULL),(21,10,21,20,'2017-07-20',NULL,'',1,NULL,NULL,NULL,NULL),(22,11,22,32,'2017-10-11',NULL,'',1,NULL,NULL,NULL,NULL),(23,11,23,29,'2017-10-06',NULL,'',1,NULL,NULL,NULL,NULL),(24,11,24,31,'2017-09-11',NULL,'',1,NULL,NULL,NULL,NULL),(25,11,25,28,'2017-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(26,11,26,22,'2017-05-19',NULL,'',1,NULL,NULL,NULL,NULL),(27,11,27,27,'2017-03-24',NULL,'',1,NULL,NULL,NULL,NULL),(28,11,28,30,'2017-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(29,11,29,26,'2017-01-10',NULL,'',1,NULL,NULL,NULL,NULL),(30,11,30,25,'2016-06-10',NULL,'',1,NULL,NULL,NULL,NULL),(31,11,31,23,'2016-09-13',NULL,'',1,NULL,NULL,NULL,NULL),(32,11,32,24,'2015-01-11',NULL,'',1,NULL,NULL,NULL,NULL),(33,12,34,34,'2010-01-15',NULL,'',1,NULL,NULL,NULL,NULL),(34,12,35,36,'2014-01-07',NULL,'',1,NULL,NULL,NULL,NULL),(35,12,36,35,'2014-02-06',NULL,'',1,NULL,NULL,NULL,NULL),(36,13,38,38,'2015-03-10',NULL,'',1,NULL,NULL,NULL,NULL),(37,13,39,40,'2016-03-15',NULL,'',1,NULL,NULL,NULL,NULL),(38,13,40,41,'2016-09-06',NULL,'',1,NULL,NULL,NULL,NULL),(39,13,41,42,'2017-08-06',NULL,'',1,NULL,NULL,NULL,NULL),(40,13,42,43,'2016-04-12',NULL,'',1,NULL,NULL,NULL,NULL),(41,13,43,39,'2013-10-15',NULL,'',1,NULL,NULL,NULL,NULL),(42,14,44,45,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(43,14,45,46,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(44,14,46,47,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(45,14,47,49,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(46,14,48,50,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(47,14,49,54,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(48,14,50,52,'2016-04-20',NULL,'',1,NULL,NULL,NULL,NULL),(49,14,51,51,'2016-08-15',NULL,'',1,NULL,NULL,NULL,NULL),(50,14,52,48,'2017-05-31',NULL,'',1,NULL,NULL,NULL,NULL),(51,14,53,53,'2017-09-01',NULL,'',1,NULL,NULL,NULL,NULL),(52,14,54,55,'2017-10-05',NULL,'',1,NULL,NULL,NULL,NULL),(53,14,55,56,'2017-09-11',NULL,'',1,NULL,NULL,NULL,NULL),(54,15,56,63,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(55,15,57,62,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(56,15,58,59,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(57,15,59,61,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(58,15,60,58,'2016-11-29',NULL,'',1,NULL,NULL,NULL,NULL),(59,15,61,60,'2017-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(60,16,63,65,'2016-11-17',NULL,'',1,NULL,NULL,NULL,NULL),(61,17,64,67,'2016-06-09',NULL,'',1,NULL,NULL,NULL,NULL),(62,18,65,72,'2016-08-12',NULL,'',1,NULL,NULL,NULL,NULL),(63,18,66,71,'2015-02-09',NULL,'',1,NULL,NULL,NULL,NULL),(64,18,67,69,'2012-01-26',NULL,'',1,NULL,NULL,NULL,NULL),(65,18,68,70,'2014-11-12',NULL,'',1,NULL,NULL,NULL,NULL),(66,19,69,83,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(67,19,70,77,'2017-02-22',NULL,'',1,NULL,NULL,NULL,NULL),(68,19,71,82,'2017-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(69,19,72,78,'2012-05-15',NULL,'',1,NULL,NULL,NULL,NULL),(70,19,73,74,'2016-10-10',NULL,'',1,NULL,NULL,NULL,NULL),(71,19,74,81,'2015-12-23',NULL,'',1,NULL,NULL,NULL,NULL),(72,19,75,75,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(73,19,76,76,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(74,19,77,79,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(75,19,78,80,'2015-11-27',NULL,'',1,NULL,NULL,NULL,NULL),(76,19,79,84,'2017-08-11',NULL,'',1,NULL,NULL,NULL,NULL),(77,20,83,97,'2017-10-12',NULL,'',1,NULL,NULL,NULL,NULL),(78,20,84,95,'2017-11-08',NULL,'',1,NULL,NULL,NULL,NULL),(79,20,85,96,'2017-10-10',NULL,'',1,NULL,NULL,NULL,NULL),(80,20,86,92,'2016-05-31',NULL,'',1,NULL,NULL,NULL,NULL),(81,20,87,86,'2015-08-21',NULL,'',1,NULL,NULL,NULL,NULL),(82,20,88,88,'2015-12-03',NULL,'',1,NULL,NULL,NULL,NULL),(83,20,89,94,'2016-08-02',NULL,'',1,NULL,NULL,NULL,NULL),(84,20,90,87,'2010-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(85,20,91,89,'2017-08-29',NULL,'',1,NULL,NULL,NULL,NULL),(86,20,92,90,NULL,NULL,'',1,NULL,NULL,NULL,NULL),(87,20,93,93,'2012-10-16',NULL,'',1,NULL,NULL,NULL,NULL),(88,21,97,103,'2017-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(89,21,98,99,'2017-07-05',NULL,'',1,NULL,NULL,NULL,NULL),(90,21,99,104,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(91,21,100,100,'2011-09-05',NULL,'',1,NULL,NULL,NULL,NULL),(92,21,101,102,'2011-08-08',NULL,'',1,NULL,NULL,NULL,NULL),(93,21,102,101,'2010-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(94,21,103,105,'2017-08-31',NULL,'',1,NULL,NULL,NULL,NULL),(95,21,104,106,'2017-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(96,22,106,110,'2017-02-02',NULL,'',1,NULL,NULL,NULL,NULL),(97,22,107,113,'2016-05-10',NULL,'',1,NULL,NULL,NULL,NULL),(98,22,108,112,'2015-09-04',NULL,'',1,NULL,NULL,NULL,NULL),(99,22,109,109,'2015-01-26',NULL,'',1,NULL,NULL,NULL,NULL),(100,22,110,108,'2016-02-03',NULL,'',1,NULL,NULL,NULL,NULL),(101,22,111,111,'2015-10-12',NULL,'',1,NULL,NULL,NULL,NULL),(102,22,112,114,'2016-08-09',NULL,'',1,NULL,NULL,NULL,NULL),(103,22,113,115,'2017-10-11',NULL,'',1,NULL,NULL,NULL,NULL),(104,23,117,118,'2016-08-30',NULL,'',1,NULL,NULL,NULL,NULL),(105,23,118,117,'2012-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(106,23,119,119,'2017-05-05',NULL,'',1,NULL,NULL,NULL,NULL),(107,24,120,126,'2015-09-16',NULL,'',1,NULL,NULL,NULL,NULL),(108,24,121,124,'2011-03-18',NULL,'',1,NULL,NULL,NULL,NULL),(109,24,122,122,'2011-01-06',NULL,'',1,NULL,NULL,NULL,NULL),(110,24,123,123,'2010-02-11',NULL,'',1,NULL,NULL,NULL,NULL),(111,24,124,125,'2010-03-10',NULL,'',1,NULL,NULL,NULL,NULL),(112,24,125,121,'2016-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(113,25,126,129,'2016-07-12',NULL,'',1,NULL,NULL,NULL,NULL),(114,25,127,130,'2016-07-08',NULL,'',1,NULL,NULL,NULL,NULL),(115,25,128,131,'2017-08-18',NULL,'',1,NULL,NULL,NULL,NULL),(116,26,130,133,'2006-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(117,26,131,134,'2016-08-08',NULL,'',1,NULL,NULL,NULL,NULL),(118,26,132,135,'2016-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(119,26,133,136,'2016-08-04',NULL,'',1,NULL,NULL,NULL,NULL),(120,27,137,138,'2016-12-13',NULL,'',1,NULL,NULL,NULL,NULL),(121,27,138,139,'2017-03-07',NULL,'',1,NULL,NULL,NULL,NULL),(122,27,139,140,'2015-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(123,27,140,141,'2015-04-08',NULL,'',1,NULL,NULL,NULL,NULL),(124,27,141,142,'2017-02-03',NULL,'',1,NULL,NULL,NULL,NULL),(125,27,142,143,'2017-10-09',NULL,'',1,NULL,NULL,NULL,NULL),(126,27,143,144,'2017-10-09',NULL,'',1,NULL,NULL,NULL,NULL),(127,28,145,146,'2016-09-25',NULL,'',1,NULL,NULL,NULL,NULL),(128,28,146,147,'2017-06-07',NULL,'',1,NULL,NULL,NULL,NULL),(129,28,147,148,'2012-04-24',NULL,'',1,NULL,NULL,NULL,NULL),(130,28,148,149,'2017-07-03',NULL,'',1,NULL,NULL,NULL,NULL),(131,28,149,150,'2017-11-17',NULL,'',1,NULL,NULL,NULL,NULL),(132,28,150,151,'2016-02-05',NULL,'',1,NULL,NULL,NULL,NULL),(133,28,151,152,'2016-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(134,28,152,154,'2017-08-11',NULL,'',1,NULL,NULL,NULL,NULL),(135,28,153,155,'2017-11-30',NULL,'',1,NULL,NULL,NULL,NULL),(136,29,157,157,'2010-11-08',NULL,'',1,NULL,NULL,NULL,NULL),(137,29,158,158,'2015-10-08',NULL,'',1,NULL,NULL,NULL,NULL),(138,29,159,159,'2016-04-05',NULL,'',1,NULL,NULL,NULL,NULL),(139,30,160,162,'2017-03-02',NULL,'',1,NULL,NULL,NULL,NULL),(140,30,161,163,'2017-02-06',NULL,'',1,NULL,NULL,NULL,NULL),(141,30,162,164,'2015-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(142,30,163,165,'2015-09-07',NULL,'',1,NULL,NULL,NULL,NULL),(143,30,164,166,'2015-04-06',NULL,'',1,NULL,NULL,NULL,NULL),(144,30,165,167,'2000-06-06',NULL,'',1,NULL,NULL,NULL,NULL),(145,30,166,168,'2013-11-05',NULL,'',1,NULL,NULL,NULL,NULL),(146,30,167,169,'2017-03-12',NULL,'',1,NULL,NULL,NULL,NULL),(147,30,168,170,'2017-03-12',NULL,'',1,NULL,NULL,NULL,NULL),(148,30,169,171,'2013-08-12',NULL,'',1,NULL,NULL,NULL,NULL),(149,30,170,172,'2013-07-09',NULL,'',1,NULL,NULL,NULL,NULL),(150,30,171,173,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(151,30,172,174,'2017-11-03',NULL,'',1,NULL,NULL,NULL,NULL),(152,31,173,176,'2017-08-07',NULL,'',1,NULL,NULL,NULL,NULL),(153,32,175,178,'2008-06-10',NULL,'',1,NULL,NULL,NULL,NULL),(154,33,176,180,'2017-06-02',NULL,'',1,NULL,NULL,NULL,NULL),(155,33,177,181,'2017-06-05',NULL,'',1,NULL,NULL,NULL,NULL),(156,33,178,182,'2013-09-10',NULL,'',1,NULL,NULL,NULL,NULL),(157,33,179,183,'2015-06-08',NULL,'',1,NULL,NULL,NULL,NULL),(158,33,180,184,'2013-12-02',NULL,'',1,NULL,NULL,NULL,NULL),(159,33,181,185,'2015-05-04',NULL,'',1,NULL,NULL,NULL,NULL),(160,34,186,187,'2015-06-24',NULL,'',1,NULL,NULL,NULL,NULL),(161,34,187,188,'2013-05-06',NULL,'',1,NULL,NULL,NULL,NULL),(162,34,188,189,'2015-07-06',NULL,'',1,NULL,NULL,NULL,NULL),(163,34,189,191,'2016-07-27',NULL,'',1,NULL,NULL,NULL,NULL),(164,35,194,193,'2014-03-04',NULL,'',1,NULL,NULL,NULL,NULL),(165,35,195,194,'2013-11-04',NULL,'',1,NULL,NULL,NULL,NULL),(166,35,196,195,'2015-01-05',NULL,'',1,NULL,NULL,NULL,NULL),(167,36,200,197,'2014-05-07',NULL,'',1,NULL,NULL,NULL,NULL),(168,37,201,199,'2014-08-06',NULL,'',1,NULL,NULL,NULL,NULL),(169,38,202,201,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(170,38,203,202,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(171,38,204,203,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(172,38,205,204,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(173,38,206,205,'2017-11-03',NULL,'',1,NULL,NULL,NULL,NULL),(174,38,207,206,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(175,38,208,207,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(176,38,209,208,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(177,39,211,210,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(178,39,212,211,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(179,39,213,212,'2017-11-01',NULL,'',1,NULL,NULL,NULL,NULL),(180,39,214,213,'2017-11-05',NULL,'',1,NULL,NULL,NULL,NULL),(181,39,215,214,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(182,39,216,215,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(183,39,217,216,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(184,39,218,217,'2017-11-02',NULL,'',1,NULL,NULL,NULL,NULL),(185,39,219,218,'2017-11-06',NULL,'',1,NULL,NULL,NULL,NULL),(186,39,220,219,'2017-10-31',NULL,'',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_occupancy_invoice` */

DROP TABLE IF EXISTS `re_occupancy_invoice`;

CREATE TABLE `re_occupancy_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `fk_occupancy_rent` int(11) NOT NULL,
  `created_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_invoice` */

insert  into `re_occupancy_invoice`(`id`,`invoice_no`,`fk_occupancy_rent`,`created_on`,`created_by`) values (1,'INV-10-13',158,'2017-12-11',1),(2,'INV-10-13',159,'2017-12-11',1),(3,'INV-10-13',160,'2017-12-11',1),(4,'INV-11-13',161,'2017-12-11',1),(5,'INV-11-13',162,'2017-12-11',1),(6,'INV-11-13',163,'2017-12-11',1),(7,'INV-13-13',164,'2017-12-11',1),(8,'INV-13-13',165,'2017-12-11',1),(9,'INV-13-13',166,'2017-12-11',1),(10,'INV-14-13',167,'2017-12-11',1),(11,'INV-14-13',168,'2017-12-11',1),(12,'INV-14-13',169,'2017-12-11',1),(13,'INV-15-13',170,'2017-12-11',1),(14,'INV-15-13',171,'2017-12-11',1),(15,'INV-15-13',172,'2017-12-11',1),(16,'INV-16-13',173,'2017-12-11',1),(17,'INV-16-13',174,'2017-12-11',1),(18,'INV-16-13',175,'2017-12-11',1),(19,'INV-10-13',2,'2018-01-03',1),(20,'INV-10-13',0,'2018-01-03',1),(21,'INV-10-13',0,'2018-01-03',1),(22,'INV-11-13',4,'2018-01-03',1),(23,'INV-11-13',0,'2018-01-03',1),(24,'INV-11-13',0,'2018-01-03',1),(25,'INV-13-13',6,'2018-01-03',1),(26,'INV-13-13',0,'2018-01-03',1),(27,'INV-13-13',0,'2018-01-03',1),(28,'INV-13-13',0,'2018-01-03',1),(29,'INV-14-13',8,'2018-01-03',1),(30,'INV-14-13',0,'2018-01-03',1),(31,'INV-14-13',0,'2018-01-03',1),(32,'INV-14-13',0,'2018-01-03',1),(33,'INV-15-13',10,'2018-01-03',1),(34,'INV-15-13',0,'2018-01-03',1),(35,'INV-15-13',0,'2018-01-03',1),(36,'INV-15-13',0,'2018-01-03',1),(37,'INV-16-13',12,'2018-01-03',1),(38,'INV-16-13',0,'2018-01-03',1),(39,'INV-16-13',0,'2018-01-03',1),(40,'INV-1-13',14,'2018-01-03',1),(41,'INV-8-13',16,'2018-01-03',1),(42,'INV-17-13',0,'2018-01-04',1),(43,'INV-17-13',0,'2018-01-04',1),(44,'INV-17-13',0,'2018-01-04',1),(45,'INV-17-13',0,'2018-01-04',1),(46,'INV-18-13',0,'2018-01-04',1),(47,'INV-18-13',0,'2018-01-05',15),(48,'INV-18-13',0,'2018-01-05',15),(49,'INV-19-13',0,'2018-01-05',15),(50,'INV-19-13',0,'2018-01-05',15),(51,'INV-20-13',0,'2018-01-05',15),(52,'INV-20-13',0,'2018-01-05',15),(53,'INV-21-13',0,'2018-01-05',15),(54,'INV-21-13',0,'2018-01-05',15),(55,'INV-60-13',0,'2018-01-05',15),(56,'INV-18-13',0,'2017-08-01',15),(57,'INV-19-13',0,'2017-08-01',15),(58,'INV-20-13',0,'2017-08-01',15),(59,'INV-21-13',0,'2017-08-01',15),(60,'INV-22-13',0,'2017-08-01',15),(61,'INV-22-13',0,'2017-08-01',15),(62,'INV-23-13',0,'2017-08-01',15),(63,'INV-23-13',0,'2017-08-01',15),(64,'INV-24-13',0,'2017-08-01',15),(65,'INV-24-13',0,'2017-08-01',15),(66,'INV-25-13',0,'2017-08-01',15),(67,'INV-25-13',0,'2017-08-01',15),(68,'INV-26-13',0,'2017-08-01',15),(69,'INV-26-13',0,'2017-08-01',15),(70,'INV-27-13',0,'2017-08-01',15),(71,'INV-27-13',0,'2017-08-01',15),(72,'INV-28-13',0,'2017-08-01',15),(73,'INV-28-13',0,'2017-08-01',15),(74,'INV-29-13',0,'2017-08-01',15),(75,'INV-29-13',0,'2017-08-01',15),(76,'INV-30-13',0,'2017-08-01',15),(77,'INV-30-13',0,'2017-08-01',15),(78,'INV-31-13',0,'2017-08-01',15),(79,'INV-31-13',0,'2017-08-01',15),(80,'INV-32-13',0,'2017-08-01',15),(81,'INV-32-13',0,'2017-08-01',15),(82,'INV-33-13',0,'2017-08-01',15),(83,'INV-33-13',0,'2017-08-01',15),(84,'INV-34-13',0,'2017-08-01',15),(85,'INV-34-13',0,'2017-08-01',15),(86,'INV-35-13',0,'2017-08-01',15),(87,'INV-35-13',0,'2017-08-01',15),(88,'INV-36-13',0,'2017-08-01',15),(89,'INV-36-13',0,'2017-08-01',15),(90,'INV-37-13',0,'2017-08-01',15),(91,'INV-37-13',0,'2017-08-01',15),(92,'INV-38-13',0,'2017-08-01',15),(93,'INV-38-13',0,'2017-08-01',15),(94,'INV-39-13',0,'2017-08-01',15),(95,'INV-39-13',0,'2017-08-01',15),(96,'INV-40-13',0,'2017-08-01',15),(97,'INV-40-13',0,'2017-08-01',15),(98,'INV-41-13',0,'2017-08-01',15),(99,'INV-41-13',0,'2017-08-01',15),(100,'INV-42-13',0,'2017-08-01',15),(101,'INV-42-13',0,'2017-08-01',15),(102,'INV-43-13',0,'2017-08-01',15),(103,'INV-43-13',0,'2017-08-01',15),(104,'INV-44-13',0,'2017-08-01',15),(105,'INV-44-13',0,'2017-08-01',15),(106,'INV-45-13',0,'2017-08-01',15),(107,'INV-45-13',0,'2017-08-01',15),(108,'INV-46-13',0,'2017-08-01',15),(109,'INV-46-13',0,'2017-08-01',15),(110,'INV-47-13',0,'2017-08-01',15),(111,'INV-47-13',0,'2017-08-01',15),(112,'INV-48-13',0,'2017-08-01',15),(113,'INV-48-13',0,'2017-08-01',15),(114,'INV-49-13',0,'2017-08-01',15),(115,'INV-49-13',0,'2017-08-01',15),(116,'INV-50-13',0,'2017-08-01',15),(117,'INV-50-13',0,'2017-08-01',15),(118,'INV-51-13',0,'2017-08-01',15),(119,'INV-51-13',0,'2017-08-01',15),(120,'INV-52-13',0,'2017-08-01',15),(121,'INV-52-13',0,'2017-08-01',15),(122,'INV-53-13',0,'2017-08-01',15),(123,'INV-53-13',0,'2017-08-01',15),(124,'INV-54-13',0,'2017-08-01',15),(125,'INV-54-13',0,'2017-08-01',15),(126,'INV-55-13',0,'2017-08-01',15),(127,'INV-55-13',0,'2017-08-01',15),(128,'INV-56-13',0,'2017-08-01',15),(129,'INV-56-13',0,'2017-08-01',15),(130,'INV-57-13',0,'2017-08-01',15),(131,'INV-57-13',0,'2017-08-01',15),(132,'INV-58-13',0,'2017-08-01',15),(133,'INV-58-13',0,'2017-08-01',15),(134,'INV-59-13',0,'2017-08-01',15),(135,'INV-59-13',0,'2017-08-01',15),(136,'INV-60-13',0,'2017-08-01',15),(137,'INV-60-13',0,'2017-08-01',15),(138,'INV-61-13',0,'2017-08-01',15),(139,'INV-61-13',0,'2017-08-01',15),(140,'INV-62-13',0,'2017-08-01',15),(141,'INV-62-13',0,'2017-08-01',15),(142,'INV-63-13',0,'2017-08-01',15),(143,'INV-63-13',0,'2017-08-01',15),(144,'INV-64-13',0,'2017-08-01',15),(145,'INV-64-13',0,'2017-08-01',15),(146,'INV-65-13',0,'2017-08-01',15),(147,'INV-65-13',0,'2017-08-01',15),(148,'INV-66-13',0,'2017-08-01',15),(149,'INV-66-13',0,'2017-08-01',15),(150,'INV-67-13',0,'2017-08-01',15),(151,'INV-67-13',0,'2017-08-01',15),(152,'INV-68-13',0,'2017-08-01',15),(153,'INV-68-13',0,'2017-08-01',15),(154,'INV-69-13',0,'2017-08-01',15),(155,'INV-69-13',0,'2017-08-01',15),(156,'INV-70-13',0,'2017-08-01',15),(157,'INV-70-13',0,'2017-08-01',15),(158,'INV-71-13',0,'2017-08-01',15),(159,'INV-71-13',0,'2017-08-01',15),(160,'INV-72-13',0,'2017-08-01',15),(161,'INV-72-13',0,'2017-08-01',15),(162,'INV-73-13',0,'2017-08-01',15),(163,'INV-73-13',0,'2017-08-01',15),(164,'INV-74-13',0,'2017-08-01',15),(165,'INV-74-13',0,'2017-08-01',15),(166,'INV-75-13',0,'2017-08-01',15),(167,'INV-75-13',0,'2017-08-01',15),(168,'INV-76-13',0,'2017-08-01',15),(169,'INV-76-13',0,'2017-08-01',15),(170,'INV-77-13',0,'2017-08-01',15),(171,'INV-77-13',0,'2017-08-01',15),(172,'INV-78-13',0,'2017-08-01',15),(173,'INV-78-13',0,'2017-08-01',15),(174,'INV-79-13',0,'2017-08-01',15),(175,'INV-79-13',0,'2017-08-01',15),(176,'INV-80-13',0,'2017-08-01',15),(177,'INV-80-13',0,'2017-08-01',15),(178,'INV-81-13',0,'2017-08-01',15),(179,'INV-81-13',0,'2017-08-01',15),(180,'INV-82-13',0,'2017-08-01',15),(181,'INV-82-13',0,'2017-08-01',15),(182,'INV-83-13',0,'2017-08-01',15),(183,'INV-83-13',0,'2017-08-01',15),(184,'INV-84-13',0,'2017-08-01',15),(185,'INV-84-13',0,'2017-08-01',15),(186,'INV-85-13',0,'2017-08-01',15),(187,'INV-85-13',0,'2017-08-01',15),(188,'INV-86-13',0,'2017-08-01',15),(189,'INV-86-13',0,'2017-08-01',15),(190,'INV-87-13',0,'2017-08-01',15),(191,'INV-87-13',0,'2017-08-01',15),(192,'INV-88-13',0,'2017-08-01',15),(193,'INV-88-13',0,'2017-08-01',15),(194,'INV-89-13',0,'2017-08-01',15),(195,'INV-89-13',0,'2017-08-01',15),(196,'INV-90-13',0,'2017-08-01',15),(197,'INV-90-13',0,'2017-08-01',15),(198,'INV-91-13',0,'2017-08-01',15),(199,'INV-91-13',0,'2017-08-01',15),(200,'INV-92-13',0,'2017-08-01',15),(201,'INV-92-13',0,'2017-08-01',15),(202,'INV-93-13',0,'2017-08-01',15),(203,'INV-93-13',0,'2017-08-01',15),(204,'INV-94-13',0,'2017-08-01',15),(205,'INV-94-13',0,'2017-08-01',15),(206,'INV-95-13',0,'2017-08-01',15),(207,'INV-95-13',0,'2017-08-01',15),(208,'INV-96-13',0,'2017-08-01',15),(209,'INV-96-13',0,'2017-08-01',15),(210,'INV-97-13',0,'2017-08-01',15),(211,'INV-97-13',0,'2017-08-01',15),(212,'INV-98-13',0,'2017-08-01',15),(213,'INV-98-13',0,'2017-08-01',15),(214,'INV-99-13',0,'2017-08-01',15),(215,'INV-99-13',0,'2017-08-01',15),(216,'INV-100-13',0,'2017-08-01',15),(217,'INV-100-13',0,'2017-08-01',15),(218,'INV-101-13',0,'2017-08-01',15),(219,'INV-101-13',0,'2017-08-01',15),(220,'INV-102-13',0,'2017-08-01',15),(221,'INV-102-13',0,'2017-08-01',15),(222,'INV-103-13',0,'2017-08-01',15),(223,'INV-103-13',0,'2017-08-01',15),(224,'INV-104-13',0,'2017-08-01',15),(225,'INV-104-13',0,'2017-08-01',15),(226,'INV-105-13',0,'2017-08-01',15),(227,'INV-105-13',0,'2017-08-01',15),(228,'INV-106-13',0,'2017-08-01',15),(229,'INV-106-13',0,'2017-08-01',15),(230,'INV-107-13',0,'2017-08-01',15),(231,'INV-107-13',0,'2017-08-01',15),(232,'INV-108-13',0,'2017-08-01',15),(233,'INV-108-13',0,'2017-08-01',15),(234,'INV-109-13',0,'2017-08-01',15),(235,'INV-109-13',0,'2017-08-01',15),(236,'INV-110-13',0,'2017-08-01',15),(237,'INV-110-13',0,'2017-08-01',15),(238,'INV-111-13',0,'2017-08-01',15),(239,'INV-111-13',0,'2017-08-01',15),(240,'INV-112-13',0,'2017-08-01',15),(241,'INV-112-13',0,'2017-08-01',15),(242,'INV-113-13',0,'2017-08-01',15),(243,'INV-113-13',0,'2017-08-01',15),(244,'INV-114-13',0,'2017-08-01',15),(245,'INV-114-13',0,'2017-08-01',15),(246,'INV-115-13',0,'2017-08-01',15),(247,'INV-115-13',0,'2017-08-01',15),(248,'INV-116-13',0,'2017-08-01',15),(249,'INV-116-13',0,'2017-08-01',15),(250,'INV-117-13',0,'2017-08-01',15),(251,'INV-117-13',0,'2017-08-01',15),(252,'INV-118-13',0,'2017-08-01',15),(253,'INV-118-13',0,'2017-08-01',15),(254,'INV-119-13',0,'2017-08-01',15),(255,'INV-119-13',0,'2017-08-01',15),(256,'INV-120-13',0,'2017-08-01',15),(257,'INV-120-13',0,'2017-08-01',15),(258,'INV-121-13',0,'2017-08-01',15),(259,'INV-121-13',0,'2017-08-01',15),(260,'INV-122-13',0,'2017-08-01',15),(261,'INV-122-13',0,'2017-08-01',15),(262,'INV-123-13',0,'2017-08-01',15),(263,'INV-123-13',0,'2017-08-01',15),(264,'INV-124-13',0,'2017-08-01',15),(265,'INV-124-13',0,'2017-08-01',15),(266,'INV-125-13',0,'2017-08-01',15),(267,'INV-125-13',0,'2017-08-01',15),(268,'INV-126-13',0,'2017-08-01',15),(269,'INV-126-13',0,'2017-08-01',15),(270,'INV-127-13',0,'2017-08-01',15),(271,'INV-127-13',0,'2017-08-01',15),(272,'INV-128-13',0,'2017-08-01',15),(273,'INV-128-13',0,'2017-08-01',15),(274,'INV-129-13',0,'2017-08-01',15),(275,'INV-129-13',0,'2017-08-01',15),(276,'INV-130-13',0,'2017-08-01',15),(277,'INV-130-13',0,'2017-08-01',15),(278,'INV-131-13',0,'2017-08-01',15),(279,'INV-131-13',0,'2017-08-01',15),(280,'INV-132-13',0,'2017-08-01',15),(281,'INV-132-13',0,'2017-08-01',15),(282,'INV-133-13',0,'2017-08-01',15),(283,'INV-133-13',0,'2017-08-01',15),(284,'INV-134-13',0,'2017-08-01',15),(285,'INV-134-13',0,'2017-08-01',15),(286,'INV-135-13',0,'2017-08-01',15),(287,'INV-135-13',0,'2017-08-01',15),(288,'INV-136-13',0,'2017-08-01',15),(289,'INV-136-13',0,'2017-08-01',15),(290,'INV-137-13',0,'2017-08-01',15),(291,'INV-137-13',0,'2017-08-01',15),(292,'INV-138-13',0,'2017-08-01',15),(293,'INV-138-13',0,'2017-08-01',15),(294,'INV-139-13',0,'2017-08-01',15),(295,'INV-139-13',0,'2017-08-01',15),(296,'INV-140-13',0,'2017-08-01',15),(297,'INV-140-13',0,'2017-08-01',15),(298,'INV-141-13',0,'2017-08-01',15),(299,'INV-141-13',0,'2017-08-01',15),(300,'INV-142-13',0,'2017-08-01',15),(301,'INV-142-13',0,'2017-08-01',15),(302,'INV-143-13',0,'2017-08-01',15),(303,'INV-143-13',0,'2017-08-01',15),(304,'INV-144-13',0,'2017-08-01',15),(305,'INV-144-13',0,'2017-08-01',15),(306,'INV-145-13',0,'2017-08-01',15),(307,'INV-145-13',0,'2017-08-01',15),(308,'INV-146-13',0,'2017-08-01',15),(309,'INV-146-13',0,'2017-08-01',15),(310,'INV-147-13',0,'2017-08-01',15),(311,'INV-147-13',0,'2017-08-01',15),(312,'INV-148-13',0,'2017-08-01',15),(313,'INV-148-13',0,'2017-08-01',15),(314,'INV-149-13',0,'2017-08-01',15),(315,'INV-149-13',0,'2017-08-01',15),(316,'INV-150-13',0,'2017-08-01',15),(317,'INV-150-13',0,'2017-08-01',15),(318,'INV-151-13',0,'2017-08-01',15),(319,'INV-151-13',0,'2017-08-01',15),(320,'INV-152-13',0,'2017-08-01',15),(321,'INV-152-13',0,'2017-08-01',15),(322,'INV-153-13',0,'2017-08-01',15),(323,'INV-153-13',0,'2017-08-01',15),(324,'INV-154-13',0,'2017-08-01',15),(325,'INV-154-13',0,'2017-08-01',15),(326,'INV-155-13',0,'2017-08-01',15),(327,'INV-155-13',0,'2017-08-01',15),(328,'INV-156-13',0,'2017-08-01',15),(329,'INV-156-13',0,'2017-08-01',15),(330,'INV-157-13',0,'2017-08-01',15),(331,'INV-157-13',0,'2017-08-01',15),(332,'INV-158-13',0,'2017-08-01',15),(333,'INV-158-13',0,'2017-08-01',15),(334,'INV-159-13',0,'2017-08-01',15),(335,'INV-159-13',0,'2017-08-01',15),(336,'INV-160-13',0,'2017-08-01',15),(337,'INV-160-13',0,'2017-08-01',15),(338,'INV-161-13',0,'2017-08-01',15),(339,'INV-161-13',0,'2017-08-01',15),(340,'INV-162-13',0,'2017-08-01',15),(341,'INV-162-13',0,'2017-08-01',15),(342,'INV-163-13',0,'2017-08-01',15),(343,'INV-163-13',0,'2017-08-01',15),(344,'INV-164-13',0,'2017-08-01',15),(345,'INV-164-13',0,'2017-08-01',15),(346,'INV-165-13',0,'2017-08-01',15),(347,'INV-165-13',0,'2017-08-01',15),(348,'INV-166-13',0,'2017-08-01',15),(349,'INV-166-13',0,'2017-08-01',15),(350,'INV-167-13',0,'2017-08-01',15),(351,'INV-167-13',0,'2017-08-01',15),(352,'INV-168-13',0,'2017-08-01',15),(353,'INV-168-13',0,'2017-08-01',15),(354,'INV-169-13',0,'2017-08-01',15),(355,'INV-169-13',0,'2017-08-01',15),(356,'INV-170-13',0,'2017-08-01',15),(357,'INV-170-13',0,'2017-08-01',15),(358,'INV-171-13',0,'2017-08-01',15),(359,'INV-171-13',0,'2017-08-01',15),(360,'INV-172-13',0,'2017-08-01',15),(361,'INV-172-13',0,'2017-08-01',15),(362,'INV-173-13',0,'2017-08-01',15),(363,'INV-173-13',0,'2017-08-01',15),(364,'INV-174-13',0,'2017-08-01',15),(365,'INV-174-13',0,'2017-08-01',15),(366,'INV-175-13',0,'2017-08-01',15),(367,'INV-175-13',0,'2017-08-01',15),(368,'INV-176-13',0,'2017-08-01',15),(369,'INV-176-13',0,'2017-08-01',15),(370,'INV-177-13',0,'2017-08-01',15),(371,'INV-177-13',0,'2017-08-01',15),(372,'INV-178-13',0,'2017-08-01',15),(373,'INV-178-13',0,'2017-08-01',15),(374,'INV-179-13',0,'2017-08-01',15),(375,'INV-179-13',0,'2017-08-01',15),(376,'INV-180-13',0,'2017-08-01',15),(377,'INV-180-13',0,'2017-08-01',15),(378,'INV-181-13',0,'2017-08-01',15),(379,'INV-181-13',0,'2017-08-01',15),(380,'INV-182-13',0,'2017-08-01',15),(381,'INV-182-13',0,'2017-08-01',15),(382,'INV-183-13',0,'2017-08-01',15),(383,'INV-183-13',0,'2017-08-01',15),(384,'INV-184-13',0,'2017-08-01',15),(385,'INV-184-13',0,'2017-08-01',15),(386,'INV-185-13',0,'2017-08-01',15),(387,'INV-185-13',0,'2017-08-01',15),(388,'INV-186-13',0,'2017-08-01',15),(389,'INV-186-13',0,'2017-08-01',15);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_payments` */

insert  into `re_occupancy_payments`(`id`,`fk_occupancy_id`,`amount`,`payment_date`,`fk_receipt_id`,`payment_method`,`ref_no`,`status`,`created_by`,`created_on`,`modified_by`,`modified_on`) values (6,18,7000,'2018-01-05',26,1,'',2,15,'2018-01-05',NULL,NULL),(7,97,1100,'2017-08-04',27,1,'',2,15,'2017-08-04',NULL,NULL),(8,30,1500,'2017-08-01',28,1,'',2,15,'2017-08-01',NULL,NULL),(9,34,3000,'2017-08-01',29,1,'',2,15,'2017-08-01',NULL,NULL),(10,18,15000,'2017-08-19',30,1,'0',2,15,'2017-08-19',NULL,NULL),(11,20,7000,'2018-03-08',31,1,'',1,1,'2018-03-08',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_payments_mapping` */

insert  into `re_occupancy_payments_mapping`(`id`,`fk_occupancy_payment`,`fk_occupancy_rent`,`amount`,`type`) values (11,14,139,'7000.00','complete'),(12,14,138,'7500.00','complete'),(13,15,142,'7000.00','complete'),(14,15,143,'7000.00','complete'),(17,11,351,'7000.00','complete');

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
  `_status` int(11) DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_rent` */

insert  into `re_occupancy_rent`(`id`,`fk_occupancy_id`,`fk_term`,`fk_source`,`month`,`year`,`amount`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (7,18,1,1,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(8,18,4,19,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(9,19,1,1,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(10,19,4,19,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(11,20,1,1,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(12,20,4,19,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(13,21,1,1,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(14,21,4,19,1,2018,7000.00,1,'2018-01-05 08:32:19',15,NULL,NULL),(15,60,1,1,1,2018,1500.00,1,'2018-01-05 08:32:20',15,NULL,NULL),(16,18,1,1,8,2017,7500.00,1,'2017-08-01 16:14:11',15,'2017-08-19 12:57:20',15),(17,19,1,1,8,2017,7000.00,0,'2017-08-01 16:14:11',15,NULL,NULL),(18,20,1,1,8,2017,7000.00,1,'2017-08-01 16:14:11',15,'2018-03-08 00:33:49',1),(19,21,1,1,8,2017,7000.00,0,'2017-08-01 16:14:11',15,NULL,NULL),(20,22,1,1,8,2017,2300.00,0,'2017-08-01 16:14:11',15,NULL,NULL),(21,22,4,19,8,2017,2300.00,0,'2017-08-01 16:14:11',15,NULL,NULL),(22,23,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(23,23,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(24,24,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(25,24,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(26,25,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(27,25,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(28,26,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(29,26,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(30,27,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(31,27,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(32,28,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(33,28,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(34,29,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(35,29,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(36,30,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(37,30,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(38,31,1,1,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(39,31,4,19,8,2017,2300.00,0,'2017-08-01 16:14:12',15,NULL,NULL),(40,32,1,1,8,2017,2300.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(41,32,4,19,8,2017,2300.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(42,33,1,1,8,2017,1500.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(43,33,4,19,8,2017,1500.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(44,34,1,1,8,2017,1500.00,1,'2017-08-01 16:14:13',15,'2017-08-01 16:21:02',15),(45,34,4,19,8,2017,1500.00,1,'2017-08-01 16:14:13',15,'2017-08-01 16:21:02',15),(46,35,1,1,8,2017,1500.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(47,35,4,19,8,2017,1500.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(48,36,1,1,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(49,36,4,19,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(50,37,1,1,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(51,37,4,19,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(52,38,1,1,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(53,38,4,19,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(54,39,1,1,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(55,39,4,19,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(56,40,1,1,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(57,40,4,19,8,2017,700.00,0,'2017-08-01 16:14:13',15,NULL,NULL),(58,41,1,1,8,2017,700.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(59,41,4,19,8,2017,700.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(60,42,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(61,42,4,19,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(62,43,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(63,43,4,19,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(64,44,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(65,44,4,19,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(66,45,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(67,45,4,19,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(68,46,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(69,46,4,19,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(70,47,1,1,8,2017,1300.00,0,'2017-08-01 16:14:14',15,NULL,NULL),(71,47,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(72,48,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(73,48,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(74,49,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(75,49,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(76,50,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(77,50,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(78,51,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(79,51,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(80,52,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(81,52,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(82,53,1,1,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(83,53,4,19,8,2017,1300.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(84,54,1,1,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(85,54,4,19,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(86,55,1,1,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(87,55,4,19,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(88,56,1,1,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(89,56,4,19,8,2017,2000.00,0,'2017-08-01 16:14:15',15,NULL,NULL),(90,57,1,1,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(91,57,4,19,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(92,58,1,1,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(93,58,4,19,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(94,59,1,1,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(95,59,4,19,8,2017,2000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(96,60,1,1,8,2017,1500.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(97,60,4,19,8,2017,3000.00,0,'2017-08-01 16:14:16',15,NULL,NULL),(98,61,1,1,8,2017,5000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(99,61,4,19,8,2017,5000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(100,62,1,1,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(101,62,4,19,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(102,63,1,1,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(103,63,4,19,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(104,64,1,1,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(105,64,4,19,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(106,65,1,1,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(107,65,4,19,8,2017,1000.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(108,66,1,1,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(109,66,4,19,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(110,67,1,1,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(111,67,4,19,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(112,68,1,1,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(113,68,4,19,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(114,69,1,1,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(115,69,4,19,8,2017,1500.00,0,'2017-08-01 16:14:17',15,NULL,NULL),(116,70,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(117,70,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(118,71,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(119,71,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(120,72,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(121,72,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(122,73,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(123,73,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(124,74,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(125,74,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(126,75,1,1,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(127,75,4,19,8,2017,1500.00,0,'2017-08-01 16:14:18',15,NULL,NULL),(128,76,1,1,8,2017,1500.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(129,76,4,19,8,2017,1500.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(130,77,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(131,77,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(132,78,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(133,78,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(134,79,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(135,79,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(136,80,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(137,80,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(138,81,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(139,81,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(140,82,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(141,82,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(142,83,1,1,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(143,83,4,19,8,2017,2000.00,0,'2017-08-01 16:14:19',15,NULL,NULL),(144,84,1,1,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(145,84,4,19,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(146,85,1,1,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(147,85,4,19,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(148,86,1,1,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(149,86,4,19,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(150,87,1,1,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(151,87,4,19,8,2017,2000.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(152,88,1,1,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(153,88,4,19,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(154,89,1,1,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(155,89,4,19,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(156,90,1,1,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(157,90,4,19,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(158,91,1,1,8,2017,1800.00,0,'2017-08-01 16:14:20',15,NULL,NULL),(159,91,4,19,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(160,92,1,1,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(161,92,4,19,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(162,93,1,1,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(163,93,4,19,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(164,94,1,1,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(165,94,4,19,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(166,95,1,1,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(167,95,4,19,8,2017,1800.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(168,96,1,1,8,2017,1200.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(169,96,4,19,8,2017,1200.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(170,97,1,1,8,2017,1200.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(171,97,4,19,8,2017,1200.00,0,'2017-08-01 16:14:21',15,NULL,NULL),(172,98,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(173,98,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(174,99,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(175,99,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(176,100,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(177,100,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(178,101,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(179,101,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(180,102,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(181,102,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(182,103,1,1,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(183,103,4,19,8,2017,1200.00,0,'2017-08-01 16:14:22',15,NULL,NULL),(184,104,1,1,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(185,104,4,19,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(186,105,1,1,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(187,105,4,19,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(188,106,1,1,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(189,106,4,19,8,2017,1000.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(190,107,1,1,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(191,107,4,19,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(192,108,1,1,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(193,108,4,19,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(194,109,1,1,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(195,109,4,19,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(196,110,1,1,8,2017,800.00,0,'2017-08-01 16:14:23',15,NULL,NULL),(197,110,4,19,8,2017,800.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(198,111,1,1,8,2017,800.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(199,111,4,19,8,2017,800.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(200,112,1,1,8,2017,800.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(201,112,4,19,8,2017,800.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(202,113,1,1,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(203,113,4,19,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(204,114,1,1,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(205,114,4,19,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(206,115,1,1,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(207,115,4,19,8,2017,1000.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(208,116,1,1,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(209,116,4,19,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(210,117,1,1,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(211,117,4,19,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(212,118,1,1,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(213,118,4,19,8,2017,2500.00,0,'2017-08-01 16:14:24',15,NULL,NULL),(214,119,1,1,8,2017,2500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(215,119,4,19,8,2017,2500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(216,120,1,1,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(217,120,4,19,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(218,121,1,1,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(219,121,4,19,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(220,122,1,1,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(221,122,4,19,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(222,123,1,1,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(223,123,4,19,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(224,124,1,1,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(225,124,4,19,8,2017,1500.00,0,'2017-08-01 16:14:25',15,NULL,NULL),(226,125,1,1,8,2017,1500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(227,125,4,19,8,2017,1500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(228,126,1,1,8,2017,1500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(229,126,4,19,8,2017,1500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(230,127,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(231,127,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(232,128,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(233,128,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(234,129,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(235,129,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(236,130,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(237,130,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(238,131,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(239,131,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(240,132,1,1,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(241,132,4,19,8,2017,2500.00,0,'2017-08-01 16:14:26',15,NULL,NULL),(242,133,1,1,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(243,133,4,19,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(244,134,1,1,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(245,134,4,19,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(246,135,1,1,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(247,135,4,19,8,2017,2500.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(248,136,1,1,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(249,136,4,19,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(250,137,1,1,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(251,137,4,19,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(252,138,1,1,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(253,138,4,19,8,2017,1800.00,0,'2017-08-01 16:14:27',15,NULL,NULL),(254,139,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(255,139,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(256,140,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(257,140,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(258,141,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(259,141,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(260,142,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(261,142,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(262,143,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(263,143,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(264,144,1,1,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(265,144,4,19,8,2017,1000.00,0,'2017-08-01 16:14:28',15,NULL,NULL),(266,145,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(267,145,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(268,146,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(269,146,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(270,147,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(271,147,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(272,148,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(273,148,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(274,149,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(275,149,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(276,150,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(277,150,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(278,151,1,1,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(279,151,4,19,8,2017,1000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(280,152,1,1,8,2017,3000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(281,152,4,19,8,2017,3000.00,0,'2017-08-01 16:14:29',15,NULL,NULL),(282,153,1,1,8,2017,2000.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(283,153,4,19,8,2017,2000.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(284,154,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(285,154,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(286,155,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(287,155,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(288,156,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(289,156,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(290,157,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(291,157,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(292,158,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(293,158,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(294,159,1,1,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(295,159,4,19,8,2017,2500.00,0,'2017-08-01 16:14:30',15,NULL,NULL),(296,160,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(297,160,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(298,161,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(299,161,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(300,162,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(301,162,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(302,163,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(303,163,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(304,164,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(305,164,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(306,165,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(307,165,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(308,166,1,1,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(309,166,4,19,8,2017,2000.00,0,'2017-08-01 16:14:31',15,NULL,NULL),(310,167,1,1,8,2017,8000.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(311,167,4,19,8,2017,8000.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(312,168,1,1,8,2017,1800.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(313,168,4,19,8,2017,1800.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(314,169,1,1,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(315,169,4,19,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(316,170,1,1,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(317,170,4,19,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(318,171,1,1,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(319,171,4,19,8,2017,2200.00,0,'2017-08-01 16:14:32',15,NULL,NULL),(320,172,1,1,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(321,172,4,19,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(322,173,1,1,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(323,173,4,19,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(324,174,1,1,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(325,174,4,19,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(326,175,1,1,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(327,175,4,19,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(328,176,1,1,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(329,176,4,19,8,2017,2200.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(330,177,1,1,8,2017,2800.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(331,177,4,19,8,2017,2800.00,0,'2017-08-01 16:14:33',15,NULL,NULL),(332,178,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(333,178,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(334,179,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(335,179,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(336,180,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(337,180,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(338,181,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(339,181,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(340,182,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(341,182,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(342,183,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(343,183,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(344,184,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(345,184,4,19,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(346,185,1,1,8,2017,2800.00,0,'2017-08-01 16:14:34',15,NULL,NULL),(347,185,4,19,8,2017,2800.00,0,'2017-08-01 16:14:35',15,NULL,NULL),(348,186,1,1,8,2017,2800.00,0,'2017-08-01 16:14:35',15,NULL,NULL),(349,186,4,19,8,2017,2800.00,0,'2017-08-01 16:14:35',15,NULL,NULL),(350,34,NULL,18,8,2017,1500.00,0,'2017-08-01 16:33:39',15,NULL,NULL),(351,20,1,NULL,7,2017,7000.00,1,'2018-03-08 00:43:04',1,'2018-03-08 00:46:06',1);

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

insert  into `re_property`(`id`,`property_name`,`property_desc`,`fk_property_location`,`property_type`,`management_id`,`owner_id`,`property_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (10,'Maku Apartment','',4,4,2,16,NULL,1,NULL,NULL,NULL,NULL),(11,'Kajole Apartments','',1,1,2,21,NULL,1,NULL,NULL,NULL,NULL),(12,'Katiku Apartments','',5,1,2,33,NULL,1,NULL,NULL,NULL,NULL),(13,'Fatuma Apartments','',5,1,2,37,NULL,1,NULL,NULL,NULL,NULL),(14,'Goe Apartments','',5,1,2,44,NULL,1,NULL,NULL,NULL,NULL),(15,'Alice Apartments','',5,1,2,57,NULL,1,NULL,NULL,NULL,NULL),(16,'Kaingu Apartments','',5,1,2,64,NULL,1,NULL,NULL,NULL,NULL),(17,'Rosemary Apartments','',5,3,2,66,NULL,1,NULL,NULL,NULL,NULL),(18,'Patience Apartments','',5,1,2,68,NULL,1,NULL,NULL,NULL,NULL),(19,'Elizabeth Apartmet','',5,1,2,73,NULL,1,NULL,NULL,NULL,NULL),(20,'Kanyetta Apartment','',5,1,2,85,NULL,1,NULL,NULL,NULL,NULL),(21,'Monicah Apartment','',5,1,2,98,NULL,1,NULL,NULL,NULL,NULL),(22,'Jenni Apartments','',5,1,2,107,NULL,1,NULL,NULL,NULL,NULL),(23,'Ester Apartment','',5,1,2,116,NULL,1,NULL,NULL,NULL,NULL),(24,'Patience Apartments','',4,1,2,120,NULL,1,NULL,NULL,NULL,NULL),(25,'Mercy Apartments','',5,1,2,127,NULL,1,NULL,NULL,NULL,NULL),(26,'Omar Apartment','',5,1,2,132,NULL,1,NULL,NULL,NULL,NULL),(27,'Changawa Apartments','',5,1,2,137,NULL,1,NULL,NULL,NULL,NULL),(28,'Newton Apartment','',5,1,2,145,NULL,1,NULL,NULL,NULL,NULL),(29,'Mary Apartments','',5,1,2,156,NULL,1,NULL,NULL,NULL,NULL),(30,'Flo Apartment','',5,1,2,160,NULL,1,NULL,NULL,NULL,NULL),(31,'Linah Apartments','',5,1,2,175,NULL,1,NULL,NULL,NULL,NULL),(32,'Swaleh Apartment','',5,1,2,177,NULL,1,NULL,NULL,NULL,NULL),(33,'Nasoro Apartments','',5,1,2,179,NULL,1,NULL,NULL,NULL,NULL),(34,'Mundu Apartments','',5,1,2,186,NULL,1,NULL,NULL,NULL,NULL),(35,'Loyce Apartment','',5,1,2,192,NULL,1,NULL,NULL,NULL,NULL),(36,'Salama Apartment','',5,4,2,196,NULL,1,NULL,NULL,NULL,NULL),(37,'Jimmy Apartment','',5,1,2,198,NULL,1,NULL,NULL,NULL,NULL),(38,'lewa Apartment','',5,1,2,200,NULL,1,NULL,NULL,NULL,NULL),(39,'Lenox appartments','stable',5,1,2,209,NULL,1,NULL,NULL,NULL,NULL),(40,'Agnes apartment','',4,1,2,221,NULL,1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_feature` */

insert  into `re_property_feature`(`id`,`fk_feature`,`fk_property_id`,`fk_sublet_id`,`feature_narration`,`feature_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,4,11,18,'Free',NULL,1,NULL,NULL,NULL,NULL),(2,5,11,18,'',NULL,1,NULL,NULL,NULL,NULL),(3,6,11,18,'',NULL,1,NULL,NULL,NULL,NULL),(4,4,12,18,'',NULL,1,NULL,NULL,NULL,NULL),(5,5,13,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(6,5,16,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(7,1,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(8,2,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(9,3,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(10,5,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL),(11,6,40,NULL,'',NULL,1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_sublet` */

insert  into `re_property_sublet`(`id`,`fk_property_id`,`sublet_name`,`sublet_desc`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (18,10,'Unit 1','',1,NULL,NULL,NULL,NULL),(19,10,'Unit 2','',1,NULL,NULL,NULL,NULL),(20,10,'Unit 3','',1,NULL,NULL,NULL,NULL),(21,10,'Unit 4','',1,NULL,NULL,NULL,NULL),(22,11,'Unit 1','',1,NULL,NULL,NULL,NULL),(23,11,'Unit 2','',1,NULL,NULL,NULL,NULL),(24,11,'Unit 3','',1,NULL,NULL,NULL,NULL),(25,11,'Unit 4','',1,NULL,NULL,NULL,NULL),(26,11,'Unit 5','',1,NULL,NULL,NULL,NULL),(27,11,'Unit 6','',1,NULL,NULL,NULL,NULL),(28,11,'Unit 7','',1,NULL,NULL,NULL,NULL),(29,11,'Unit 8','',1,NULL,NULL,NULL,NULL),(30,11,'Unit 9','',1,NULL,NULL,NULL,NULL),(31,11,'Unit 10','',1,NULL,NULL,NULL,NULL),(32,11,'Unit 11','',1,NULL,NULL,NULL,NULL),(33,11,'Unit 12','',1,NULL,NULL,NULL,NULL),(34,12,'Unit 1','',1,NULL,NULL,NULL,NULL),(35,12,'Unit 2','',1,NULL,NULL,NULL,NULL),(36,12,'Unit 3','',1,NULL,NULL,NULL,NULL),(37,12,'Unit 4','',1,NULL,NULL,NULL,NULL),(38,13,'Unit 2','',1,NULL,NULL,NULL,NULL),(39,13,'Unit 3','',1,NULL,NULL,NULL,NULL),(40,13,'Unit 1','',1,NULL,NULL,NULL,NULL),(41,13,'Unit 4','',1,NULL,NULL,NULL,NULL),(42,13,'Unit 5','',1,NULL,NULL,NULL,NULL),(43,13,'Unit 6','',1,NULL,NULL,NULL,NULL),(44,14,'Unit 1','',1,NULL,NULL,NULL,NULL),(45,14,'Unit 2','',1,NULL,NULL,NULL,NULL),(46,14,'Unit 3','',1,NULL,NULL,NULL,NULL),(47,14,'Unit 6','',1,NULL,NULL,NULL,NULL),(48,14,'Unit 4','',1,NULL,NULL,NULL,NULL),(49,14,'Unit 5','',1,NULL,NULL,NULL,NULL),(50,14,'Unit 7','',1,NULL,NULL,NULL,NULL),(51,14,'Unit 10','',1,NULL,NULL,NULL,NULL),(52,14,'Unit 11','',1,NULL,NULL,NULL,NULL),(53,14,'Unit 12','',1,NULL,NULL,NULL,NULL),(54,14,'Unit 8','',1,NULL,NULL,NULL,NULL),(55,14,'Unit 9','',1,NULL,NULL,NULL,NULL),(56,15,'Unit 1','',1,NULL,NULL,NULL,NULL),(57,15,'Unit 2','',1,NULL,NULL,NULL,NULL),(58,15,'Unit 3','',1,NULL,NULL,NULL,NULL),(59,15,'Unit 4','',1,NULL,NULL,NULL,NULL),(60,15,'Unit 5','',1,NULL,NULL,NULL,NULL),(61,15,'Unit 6','',1,NULL,NULL,NULL,NULL),(62,15,'Unit 7','',1,NULL,NULL,NULL,NULL),(63,16,'Unit 1','',1,NULL,NULL,NULL,NULL),(64,17,'Unit 1','',1,NULL,NULL,NULL,NULL),(65,18,'Unit 1','',1,NULL,NULL,NULL,NULL),(66,18,'Unit 2','',1,NULL,NULL,NULL,NULL),(67,18,'Unit 3','',1,NULL,NULL,NULL,NULL),(68,18,'Unit 4','',1,NULL,NULL,NULL,NULL),(69,19,'Unit 1','',1,NULL,NULL,NULL,NULL),(70,19,'Unit 2','',1,NULL,NULL,NULL,NULL),(71,19,'Unit 3','',1,NULL,NULL,NULL,NULL),(72,19,'Unit 4','',1,NULL,NULL,NULL,NULL),(73,19,'Unit 5','',1,NULL,NULL,NULL,NULL),(74,19,'Unit 6','',1,NULL,NULL,NULL,NULL),(75,19,'unit','',1,NULL,NULL,NULL,NULL),(76,19,'Unit 7','',1,NULL,NULL,NULL,NULL),(77,19,'Unit 8','',1,NULL,NULL,NULL,NULL),(78,19,'Unit 9','',1,NULL,NULL,NULL,NULL),(79,19,'Unit 9','',1,NULL,NULL,NULL,NULL),(80,19,'Unit 10','',1,NULL,NULL,NULL,NULL),(81,19,'Unit 11','',1,NULL,NULL,NULL,NULL),(82,19,'Unit 12','',1,NULL,NULL,NULL,NULL),(83,20,'Unit 1','',1,NULL,NULL,NULL,NULL),(84,20,'Unit 2','',1,NULL,NULL,NULL,NULL),(85,20,'Unit 3','',1,NULL,NULL,NULL,NULL),(86,20,'Unit 4','',1,NULL,NULL,NULL,NULL),(87,20,'Unit 5','',1,NULL,NULL,NULL,NULL),(88,20,'Unit 6','',1,NULL,NULL,NULL,NULL),(89,20,'Unit 6','',1,NULL,NULL,NULL,NULL),(90,20,'Unit 7','',1,NULL,NULL,NULL,NULL),(91,20,'Unit 8','',1,NULL,NULL,NULL,NULL),(92,20,'Unit 9','',1,NULL,NULL,NULL,NULL),(93,20,'Unit 10','',1,NULL,NULL,NULL,NULL),(94,20,'Unit 11','',1,NULL,NULL,NULL,NULL),(95,20,'Unit 13','',1,NULL,NULL,NULL,NULL),(96,20,'Unit 12','',1,NULL,NULL,NULL,NULL),(97,21,'Unit 1','',1,NULL,NULL,NULL,NULL),(98,21,'Unit 2','',1,NULL,NULL,NULL,NULL),(99,21,'Unit 3','',1,NULL,NULL,NULL,NULL),(100,21,'Unit 4','',1,NULL,NULL,NULL,NULL),(101,21,'Unit 5','',1,NULL,NULL,NULL,NULL),(102,21,'Unit 6','',1,NULL,NULL,NULL,NULL),(103,21,'Unit 7','',1,NULL,NULL,NULL,NULL),(104,21,'Unit 8','',1,NULL,NULL,NULL,NULL),(105,21,'Unit 9','',1,NULL,NULL,NULL,NULL),(106,22,'Unit 5','',1,NULL,NULL,NULL,NULL),(107,22,'Unit 1','',1,NULL,NULL,NULL,NULL),(108,22,'Unit 2','',1,NULL,NULL,NULL,NULL),(109,22,'Unit 3','',1,NULL,NULL,NULL,NULL),(110,22,'Unit 4','',1,NULL,NULL,NULL,NULL),(111,22,'Unit 6','',1,NULL,NULL,NULL,NULL),(112,22,'Unit 7','',1,NULL,NULL,NULL,NULL),(113,22,'Unit 8','',1,NULL,NULL,NULL,NULL),(114,22,'Unit 9','',1,NULL,NULL,NULL,NULL),(115,22,'Unit 10','',1,NULL,NULL,NULL,NULL),(116,22,'Unit 11','',1,NULL,NULL,NULL,NULL),(117,23,'Unit 1','',1,NULL,NULL,NULL,NULL),(118,23,'Unit 2','',1,NULL,NULL,NULL,NULL),(119,23,'Unit 3','',1,NULL,NULL,NULL,NULL),(120,24,'Unit 2','',1,NULL,NULL,NULL,NULL),(121,24,'Unit 1','',1,NULL,NULL,NULL,NULL),(122,24,'Unit 3','',1,NULL,NULL,NULL,NULL),(123,24,'Unit 4','',1,NULL,NULL,NULL,NULL),(124,24,'Unit 5','',1,NULL,NULL,NULL,NULL),(125,24,'Unit 6','',1,NULL,NULL,NULL,NULL),(126,25,'Unit 1','',1,NULL,NULL,NULL,NULL),(127,25,'Unit 2','',1,NULL,NULL,NULL,NULL),(128,25,'Unit 4','',1,NULL,NULL,NULL,NULL),(129,25,'Unit 3','',1,NULL,NULL,NULL,NULL),(130,26,'Unit 1','',1,NULL,NULL,NULL,NULL),(131,26,'Unit 3','',1,NULL,NULL,NULL,NULL),(132,26,'Unit 2','',1,NULL,NULL,NULL,NULL),(133,26,'Unit 4','',1,NULL,NULL,NULL,NULL),(134,26,'Unit 5','',1,NULL,NULL,NULL,NULL),(135,26,'Unit 6','',1,NULL,NULL,NULL,NULL),(136,26,'Unit 7','',1,NULL,NULL,NULL,NULL),(137,27,'Unit 1','',1,NULL,NULL,NULL,NULL),(138,27,'Unit 2','',1,NULL,NULL,NULL,NULL),(139,27,'Unit 3','',1,NULL,NULL,NULL,NULL),(140,27,'Unit 4','',1,NULL,NULL,NULL,NULL),(141,27,'Unit 5','',1,NULL,NULL,NULL,NULL),(142,27,'Unit 6','',1,NULL,NULL,NULL,NULL),(143,27,'Unit 7','',1,NULL,NULL,NULL,NULL),(144,27,'Unit 8','',1,NULL,NULL,NULL,NULL),(145,28,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(146,28,'Unit 2','',NULL,NULL,NULL,NULL,NULL),(147,28,'Unit 3','',NULL,NULL,NULL,NULL,NULL),(148,28,'Unit 4','',NULL,NULL,NULL,NULL,NULL),(149,28,'Unit 5','',NULL,NULL,NULL,NULL,NULL),(150,28,'Unit 6','',NULL,NULL,NULL,NULL,NULL),(151,28,'Unit 7','',NULL,NULL,NULL,NULL,NULL),(152,28,'Unit 8','',NULL,NULL,NULL,NULL,NULL),(153,28,'Unit 9','',NULL,NULL,NULL,NULL,NULL),(154,28,'Unit 10','',NULL,NULL,NULL,NULL,NULL),(155,28,'Unit 10','',NULL,NULL,NULL,NULL,NULL),(156,28,'Unit 12','',NULL,NULL,NULL,NULL,NULL),(157,29,'Unit 1','',1,NULL,NULL,NULL,NULL),(158,29,'Unit 2','',1,NULL,NULL,NULL,NULL),(159,29,'Unit 3','',1,NULL,NULL,NULL,NULL),(160,30,'Unit 1','',1,NULL,NULL,NULL,NULL),(161,30,'Unit 2','',1,NULL,NULL,NULL,NULL),(162,30,'Unit 3','',1,NULL,NULL,NULL,NULL),(163,30,'Unit 4','',1,NULL,NULL,NULL,NULL),(164,30,'Unit 5','',1,NULL,NULL,NULL,NULL),(165,30,'Unit 6','',1,NULL,NULL,NULL,NULL),(166,30,'Unit 7','',1,NULL,NULL,NULL,NULL),(167,30,'Unit 8','',1,NULL,NULL,NULL,NULL),(168,30,'Unit 9','',1,NULL,NULL,NULL,NULL),(169,30,'Unit 10','',1,NULL,NULL,NULL,NULL),(170,30,'Unit 11','',1,NULL,NULL,NULL,NULL),(171,30,'Unit 13','',1,NULL,NULL,NULL,NULL),(172,30,'Unit 12','',1,NULL,NULL,NULL,NULL),(173,31,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(174,31,'ANNE','',NULL,NULL,NULL,NULL,NULL),(175,32,'Unit 1','',NULL,NULL,NULL,NULL,NULL),(176,33,'Unit 1','',1,NULL,NULL,NULL,NULL),(177,33,'Unit 2','',1,NULL,NULL,NULL,NULL),(178,33,'Unit 3','',1,NULL,NULL,NULL,NULL),(179,33,'Unit 4','',1,NULL,NULL,NULL,NULL),(180,33,'Unit 5','',1,NULL,NULL,NULL,NULL),(181,33,'Unit 6','',1,NULL,NULL,NULL,NULL),(182,33,'Unit 7','',1,NULL,NULL,NULL,NULL),(183,33,'Unit 8','',1,NULL,NULL,NULL,NULL),(184,33,'Unit 8','',1,NULL,NULL,NULL,NULL),(185,33,'Unit 9','',1,NULL,NULL,NULL,NULL),(186,34,'Unit 1','',1,NULL,NULL,NULL,NULL),(187,34,'Unit 2','',1,NULL,NULL,NULL,NULL),(188,34,'Unit 3','',1,NULL,NULL,NULL,NULL),(189,34,'Unit 4','',1,NULL,NULL,NULL,NULL),(190,34,'Unit 5','',1,NULL,NULL,NULL,NULL),(191,34,'Unit 6','',1,NULL,NULL,NULL,NULL),(192,34,'Unit 7','',1,NULL,NULL,NULL,NULL),(193,34,'Unit 8','',1,NULL,NULL,NULL,NULL),(194,35,'Unit 2','',1,NULL,NULL,NULL,NULL),(195,35,'Unit 2','',1,NULL,NULL,NULL,NULL),(196,35,'Unit 5','',1,NULL,NULL,NULL,NULL),(197,35,'Unit 3','',1,NULL,NULL,NULL,NULL),(198,35,'Unit 1','',1,NULL,NULL,NULL,NULL),(199,35,'Unit 4','',1,NULL,NULL,NULL,NULL),(200,36,'Unit 1','',1,NULL,NULL,NULL,NULL),(201,37,'Unit 1','',1,NULL,NULL,NULL,NULL),(202,38,'Unit 1','',1,NULL,NULL,NULL,NULL),(203,38,'Unit 2','',1,NULL,NULL,NULL,NULL),(204,38,'Unit 3','',1,NULL,NULL,NULL,NULL),(205,38,'Unit 4','',1,NULL,NULL,NULL,NULL),(206,38,'Unit 5','',1,NULL,NULL,NULL,NULL),(207,38,'Unit 6','',1,NULL,NULL,NULL,NULL),(208,38,'Unit 8','',1,NULL,NULL,NULL,NULL),(209,38,'Unit 9','',1,NULL,NULL,NULL,NULL),(210,38,'Unit 7','',1,NULL,NULL,NULL,NULL),(211,39,'Unit 1','',1,NULL,NULL,NULL,NULL),(212,39,'Unit 2','',1,NULL,NULL,NULL,NULL),(213,39,'Unit 3','',1,NULL,NULL,NULL,NULL),(214,39,'Unit 4','',1,NULL,NULL,NULL,NULL),(215,39,'Unit 5','',1,NULL,NULL,NULL,NULL),(216,39,'Unit 6','',1,NULL,NULL,NULL,NULL),(217,39,'Unit 7','',1,NULL,NULL,NULL,NULL),(218,39,'Unit 8','',1,NULL,NULL,NULL,NULL),(219,39,'Unit 9','',1,NULL,NULL,NULL,NULL),(220,39,'Unit 10','',1,NULL,NULL,NULL,NULL),(221,39,'Unit 11','',1,NULL,NULL,NULL,NULL),(222,39,'Unit 12','',1,NULL,NULL,NULL,NULL),(223,40,'Unit 1','',1,NULL,NULL,NULL,NULL),(224,40,'Unit 2','',1,NULL,NULL,NULL,NULL),(225,40,'Unit 3','',1,NULL,NULL,NULL,NULL),(226,40,'Unit 4','',1,NULL,NULL,NULL,NULL),(227,40,'Unit 5','',1,NULL,NULL,NULL,NULL),(228,40,'Unit 6','',1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_term` */

insert  into `re_property_term`(`id`,`fk_property_id`,`fk_term_id`,`term_title`,`term_value`,`term_narration`,`action_handler`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (14,10,1,'rent','7000','',NULL,1,NULL,NULL,NULL,NULL),(15,10,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(16,10,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(17,16,1,'rent','1500','',NULL,1,NULL,NULL,NULL,NULL),(18,10,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(19,10,4,'deposit','7000','',NULL,1,NULL,NULL,NULL,NULL),(20,10,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(21,11,1,'rent','2300','',NULL,1,NULL,NULL,NULL,NULL),(22,11,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(23,11,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(24,11,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(25,11,4,'deposit','2300','',NULL,1,NULL,NULL,NULL,NULL),(26,11,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(27,12,1,'rent','1500','',NULL,1,NULL,NULL,NULL,NULL),(28,12,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(29,12,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(30,12,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(31,12,4,'deposit','1500','',NULL,1,NULL,NULL,NULL,NULL),(32,12,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(33,13,1,'rent','700','',NULL,1,NULL,NULL,NULL,NULL),(34,13,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(35,13,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(36,13,10,'Penalty','7','',NULL,1,NULL,NULL,NULL,NULL),(37,13,4,'deposit','700','',NULL,1,NULL,NULL,NULL,NULL),(38,13,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(39,13,16,'agent','700','',NULL,1,NULL,NULL,NULL,NULL),(40,12,16,'agent','1500','',NULL,1,NULL,NULL,NULL,NULL),(41,11,16,'agent','2300','',NULL,1,NULL,NULL,NULL,NULL),(42,10,16,'agent','7000','',NULL,1,NULL,NULL,NULL,NULL),(43,14,1,'rent','1300','',NULL,1,NULL,NULL,NULL,NULL),(44,14,2,'Date rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(45,14,11,'Penalty','20','',NULL,1,NULL,NULL,NULL,NULL),(46,14,10,'Penalty date','7','',NULL,1,NULL,NULL,NULL,NULL),(47,14,4,'deposit','1300','',NULL,1,NULL,NULL,NULL,NULL),(48,14,14,'Visit','200','',NULL,1,NULL,NULL,NULL,NULL),(49,14,16,'agent','1300','',NULL,1,NULL,NULL,NULL,NULL),(50,15,1,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(51,15,3,NULL,'8','',NULL,1,NULL,NULL,NULL,NULL),(52,15,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(53,15,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(54,15,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(55,15,4,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(56,15,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(57,15,16,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(58,16,1,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(59,16,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(60,16,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(61,16,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(62,16,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(63,16,4,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(64,16,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(65,16,16,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(66,17,1,NULL,'5000','',NULL,1,NULL,NULL,NULL,NULL),(67,17,4,NULL,'5000','',NULL,1,NULL,NULL,NULL,NULL),(68,17,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(69,17,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(70,17,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(71,17,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(72,17,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(73,17,16,NULL,'5000','',NULL,1,NULL,NULL,NULL,NULL),(74,18,1,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(75,18,4,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(76,18,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(77,18,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(78,18,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(79,18,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(80,18,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(81,18,16,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(82,19,1,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(83,19,4,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(84,19,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(85,19,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(86,19,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(87,19,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(88,19,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(89,19,16,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(90,20,1,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(91,20,4,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(92,20,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(93,20,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(94,20,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(95,20,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(96,20,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(97,20,16,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(98,21,1,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(99,21,4,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(100,21,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(101,21,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(102,21,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(103,21,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(104,21,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(105,21,16,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(106,22,1,NULL,'1200','',NULL,1,NULL,NULL,NULL,NULL),(107,22,4,NULL,'1200','',NULL,1,NULL,NULL,NULL,NULL),(108,22,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(109,22,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(110,22,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(111,22,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(112,22,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(113,22,16,NULL,'1200','',NULL,1,NULL,NULL,NULL,NULL),(114,23,1,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(115,23,4,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(116,23,16,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(117,23,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(118,23,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(119,23,2,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(120,23,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(121,23,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(122,24,1,NULL,'800','',NULL,1,NULL,NULL,NULL,NULL),(123,24,4,NULL,'800','',NULL,1,NULL,NULL,NULL,NULL),(124,24,16,NULL,'800','',NULL,1,NULL,NULL,NULL,NULL),(125,24,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(126,24,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(127,24,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(128,24,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(129,24,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(130,25,1,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(131,25,4,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(132,25,16,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(133,25,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(134,25,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(135,25,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(136,25,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(137,26,1,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(138,26,4,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(139,26,16,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(140,26,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(141,26,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(142,26,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(143,26,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(144,26,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(145,27,1,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(146,27,4,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(147,27,16,NULL,'1500','',NULL,1,NULL,NULL,NULL,NULL),(148,27,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(149,27,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(150,27,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(151,27,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(152,27,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(153,28,1,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(154,28,4,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(155,28,16,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(156,28,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(157,28,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(158,28,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(159,28,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(160,28,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(161,29,1,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(162,29,4,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(163,29,16,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(164,29,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(165,29,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(166,29,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(167,29,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(168,29,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(169,30,1,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(170,30,4,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(171,30,16,NULL,'1000','',NULL,1,NULL,NULL,NULL,NULL),(172,30,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(173,30,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(174,30,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(175,30,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(176,30,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(177,31,1,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(178,31,4,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(179,31,16,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(180,31,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(181,31,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(182,31,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(183,31,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(184,31,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(185,32,1,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(186,32,4,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(187,32,16,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(188,32,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(189,32,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(190,32,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(191,32,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(192,32,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(193,33,1,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(194,33,4,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(195,33,16,NULL,'2500','',NULL,1,NULL,NULL,NULL,NULL),(196,33,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(197,33,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(198,33,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(199,33,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(200,33,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(201,34,1,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(202,34,4,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(203,34,16,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(204,34,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(205,34,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(206,34,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(207,34,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(208,34,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(209,35,1,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(210,35,4,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(211,35,16,NULL,'2000','',NULL,1,NULL,NULL,NULL,NULL),(212,35,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(213,35,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(214,35,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(215,35,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(216,35,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(217,36,1,NULL,'8000','',NULL,1,NULL,NULL,NULL,NULL),(218,36,4,NULL,'8000','',NULL,1,NULL,NULL,NULL,NULL),(219,36,16,NULL,'8000','',NULL,1,NULL,NULL,NULL,NULL),(220,36,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(221,36,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(222,36,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(223,36,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(224,37,1,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(225,37,4,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(226,37,16,NULL,'1800','',NULL,1,NULL,NULL,NULL,NULL),(227,37,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(228,37,3,NULL,'9','',NULL,1,NULL,NULL,NULL,NULL),(229,37,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(230,37,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(231,38,1,NULL,'2200','',NULL,1,NULL,NULL,NULL,NULL),(232,38,4,NULL,'2200','',NULL,1,NULL,NULL,NULL,NULL),(233,38,16,NULL,'2200','',NULL,1,NULL,NULL,NULL,NULL),(234,38,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(235,38,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(236,38,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(237,38,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(238,38,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(239,37,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(240,36,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(241,39,1,NULL,'2800','',NULL,1,NULL,NULL,NULL,NULL),(242,39,4,NULL,'2800','',NULL,1,NULL,NULL,NULL,NULL),(243,39,16,NULL,'2800','',NULL,1,NULL,NULL,NULL,NULL),(244,39,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(245,39,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(246,39,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL),(247,39,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(248,39,14,NULL,'200','',NULL,1,NULL,NULL,NULL,NULL),(249,12,3,NULL,'8','day of paying landlord',NULL,1,NULL,NULL,NULL,NULL),(250,13,3,NULL,'8','',NULL,1,NULL,NULL,NULL,NULL),(251,10,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(252,11,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(253,14,3,NULL,'8','',NULL,1,NULL,NULL,NULL,NULL),(254,40,1,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(255,40,2,NULL,'1','',NULL,1,NULL,NULL,NULL,NULL),(256,40,3,NULL,'10','',NULL,1,NULL,NULL,NULL,NULL),(257,40,4,NULL,'3000','',NULL,1,NULL,NULL,NULL,NULL),(258,40,5,NULL,'500','',NULL,1,NULL,NULL,NULL,NULL),(259,40,11,NULL,'20','',NULL,1,NULL,NULL,NULL,NULL),(260,40,10,NULL,'7','',NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_receipt` */

DROP TABLE IF EXISTS `re_receipt`;

CREATE TABLE `re_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `re_receipt` */

insert  into `re_receipt`(`id`,`receipt_no`,`date_created`,`created_by`) values (1,'jnr1','2017-12-13 08:32:06',1),(2,'jnr2','2017-12-13 08:36:48',1),(3,'jnr3','2017-12-13 08:49:28',1),(4,'jnr4','2017-12-27 16:52:55',1),(5,'jnr5','2017-12-27 16:53:11',1),(6,'jnr6','2017-12-28 09:55:05',1),(7,'jnr7','2018-01-03 08:38:26',1),(8,'jnr8','2018-01-03 14:20:17',1),(9,'jnr9','2018-01-03 14:24:16',1),(10,'jnr10','2018-01-04 18:48:40',1),(11,'jnr11','2018-01-04 18:48:53',1),(12,'jnr12','2018-01-04 18:49:42',1),(13,'jnr13','2018-01-04 18:50:08',1),(14,'jnr14','2018-01-04 18:50:31',1),(15,'jnr15','2018-01-04 18:51:40',1),(16,'jnr16','2018-01-05 08:34:07',15),(17,'jnr17','2018-01-05 08:43:40',15),(18,'jnr18','2018-01-05 08:47:58',15),(19,'jnr19','2018-01-05 08:54:48',15),(20,'jnr20','2018-01-05 08:54:59',15),(21,'jnr21','2018-01-05 08:55:07',15),(22,'jnr22','2018-01-05 09:03:41',15),(23,'jnr23','2018-01-05 09:04:08',15),(24,'jnr24','2018-01-05 09:04:16',15),(25,'jnr25','2018-01-05 09:05:14',15),(26,'jnr26','2018-01-05 09:20:22',15),(27,'jnr27','2017-08-04 16:16:06',15),(28,'jnr28','2017-08-01 15:15:12',15),(29,'jnr29','2017-08-01 16:19:02',15),(30,'jnr30','2017-08-19 12:55:24',15),(31,'jnr31','2018-03-08 00:31:36',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;

/*Data for the table `sys_users` */

insert  into `sys_users`(`id`,`fk_group_id`,`fk_management_id`,`username`,`pass`,`name1`,`name2`,`name3`,`age`,`email`,`phone`,`id_number`,`address`,`date_added`,`gender`,`color_code`,`icon_id`,`position`,`residence`,`occupation`,`employer`) values (1,2,2,'karisa','$2y$13$vLlfRhW8Rb5JXww6WVvddewt7qZNVjkzICuYnVr6WIFzu/2WL3K.2','karisa','','nzaro',NULL,'','777748',NULL,'',NULL,'Male',NULL,NULL,NULL,NULL,NULL,NULL),(15,2,2,'anne','$2y$13$vLlfRhW8Rb5JXww6WVvddewt7qZNVjkzICuYnVr6WIFzu/2WL3K.2','Anne','Wangari','Njigua',NULL,'anne@test.com','723397330',NULL,'',NULL,'Female',NULL,NULL,NULL,NULL,NULL,NULL),(16,3,2,NULL,NULL,'Loice','Maku','Karisa',NULL,'','722393401','9876467','29, gede',NULL,'Female',NULL,NULL,NULL,'Matsangoni',NULL,NULL),(17,4,2,NULL,NULL,'Price','','Mabula',NULL,'','2147483647','22115315','',NULL,'Male',NULL,NULL,NULL,'Freetown',NULL,NULL),(18,4,2,NULL,NULL,'Delfina ','','Mkala',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(19,4,2,NULL,NULL,'Sifa','','Thoya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(20,4,2,NULL,NULL,'Josphine ','Andia','Baraka',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(21,3,2,NULL,NULL,'Kajole','Kadenge','Unda',NULL,'','713100672','0052387','',NULL,'Male',NULL,NULL,NULL,'kibaoni',NULL,NULL),(22,4,2,NULL,NULL,'Josphine ','','Chigamba',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(23,4,2,NULL,NULL,'Mukii','chebitok','Agnes',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(24,4,2,NULL,NULL,'Moses','','Masaai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(25,4,2,NULL,NULL,'Gladys','','mbuche',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(26,4,2,NULL,NULL,'Ester','','Wacheke',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(27,4,2,NULL,NULL,'Abdul','Ali','Hassan',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(28,4,2,NULL,NULL,'Brian','','isaac',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(29,4,2,NULL,NULL,'Japheth','Robinson','Mauya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(30,4,2,NULL,NULL,'Priscah','','Njeru',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(31,4,2,NULL,NULL,'Joyce','m','Makau',NULL,'','','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(32,4,2,NULL,NULL,'Brendah','kosgoi','Bernard',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(33,3,2,NULL,NULL,'Noyce','m','Katiku',NULL,'','722680560','','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(34,4,2,NULL,NULL,'Sidi','','Tsuma',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(35,4,2,NULL,NULL,'Salim','','Kaingu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(36,4,2,NULL,NULL,'Ester','Kadzo','Washe',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(37,3,2,NULL,NULL,'Fatuma','','Bakari',NULL,'','724915879','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(38,4,2,NULL,NULL,'Zawadi','','Kazungu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(39,4,2,NULL,NULL,'Ephron ','','Mwashimba                                                               ',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(40,4,2,NULL,NULL,'margeret','1','Karisa',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(41,4,2,NULL,NULL,'margeret','1','Karisa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(42,4,2,NULL,NULL,'margeret','3','Karisa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(43,4,2,NULL,NULL,'Jocktan','','Karisa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(44,3,2,NULL,NULL,'Josphat ','Goe','Chirume',NULL,'','721831913','','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(45,4,2,NULL,NULL,'Arnest ','','Kahindi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(46,4,2,NULL,NULL,'James','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(47,4,2,NULL,NULL,'Pole','Mwatua','Mwadzoya',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(48,4,2,NULL,NULL,'Joshua','',' Kavutha',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(49,4,2,NULL,NULL,'Elina ','','Taura',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(50,4,2,NULL,NULL,'Neema','','Kazungu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(51,4,2,NULL,NULL,'Kima','Karisa','Kadenge',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(52,4,2,NULL,NULL,'Morris','','Idd',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(53,4,2,NULL,NULL,'Everlyne','',' Awino',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(54,4,2,NULL,NULL,'Mangale','','k',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(55,4,2,NULL,NULL,'Lasco ','Tzuma','Dominic',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(56,4,2,NULL,NULL,'Simon ','rukia','Kadzo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(57,3,2,NULL,NULL,'Alice','Ngala','Kamina',NULL,'','721571289','8656185','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(58,4,2,NULL,NULL,'Bwanaidi','','Wariojiouo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(59,4,2,NULL,NULL,'Stephen ','','Goe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(60,4,2,NULL,NULL,'Moses','n','Kombe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(61,4,2,NULL,NULL,'Peter','Mumbo','Rimba',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(62,4,2,NULL,NULL,'Teresia','','Fikirini',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(63,4,2,NULL,NULL,'DR','Ombati','Nyakundi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(64,3,2,NULL,NULL,'Paul ','','Kaingu',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(65,4,2,NULL,NULL,'Michael','','Kalume',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(66,3,2,NULL,NULL,'Rose','Mary','Mboja',NULL,'','720611923','2181849','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(67,4,2,NULL,NULL,'Juma','Ali','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(68,3,2,NULL,NULL,'Patience','Dhahabu','Charo',NULL,'','720906891','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(69,4,2,NULL,NULL,'Madina','Shida','Kenga',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(70,4,2,NULL,NULL,'Mary','','Tunje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(71,4,2,NULL,NULL,'Mdzomba ','Guyo','Chembe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(72,4,2,NULL,NULL,'Sakina','','Mwadzombo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(73,3,2,NULL,NULL,'Elizabeth','','Kasiwa',NULL,'','725234289','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(74,4,2,NULL,NULL,'Frankline ','','Muthaura',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(75,4,2,NULL,NULL,'Josehn','Stephen','Murima',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(76,4,2,NULL,NULL,'Kennedy','','Karisa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(77,4,2,NULL,NULL,'Jackson','m','Mwamuye',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(78,4,2,NULL,NULL,'Gladys','','Kombe',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(79,4,2,NULL,NULL,'Guzo','','Muta',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(80,4,2,NULL,NULL,'Jesca ','Charo','Shida',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(81,4,2,NULL,NULL,'Abdhulaziz','','Mohhamed',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(82,4,2,NULL,NULL,'Katana ','Karisa','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(83,4,2,NULL,NULL,'Muriuki','','Joseph',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(84,4,2,NULL,NULL,'Kai','','Kajembe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(85,3,2,NULL,NULL,'Killian','Mwatsuma','Kanyetta',NULL,'','733554280','4591261','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(86,4,2,NULL,NULL,'Parrick ','Charo','Ponda',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(87,4,2,NULL,NULL,'Shuhuli','','Mwamunda',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(88,4,2,NULL,NULL,'George','','Mwachondo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(89,4,2,NULL,NULL,'Samuel','','Mwau',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(90,4,2,NULL,NULL,'Nyawa','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(91,4,2,NULL,NULL,'Stephen','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(92,4,2,NULL,NULL,'AnnRose','','Karithi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(93,4,2,NULL,NULL,'Samuel','','Tsuma',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(94,4,2,NULL,NULL,'Godwins','Alfred','Mwai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(95,4,2,NULL,NULL,'Stephen',' Otieno','Fredrick',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(96,4,2,NULL,NULL,'Chirongo','','Mwangoka',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(97,4,2,NULL,NULL,'Beartice','','Koki',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(98,3,2,NULL,NULL,'Monicah ','','Mwananje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(99,4,2,NULL,NULL,'Salim','Bakari','Mweri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(100,4,2,NULL,NULL,'Nickson','m','Kiti',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(101,4,2,NULL,NULL,'Fatuma','','Karembo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(102,4,2,NULL,NULL,'Salim','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(103,4,2,NULL,NULL,'Sheila','','Anyango',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(104,4,2,NULL,NULL,'Everline ','','Wanjiku',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(105,4,2,NULL,NULL,'John','','Ngunjiri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(106,4,2,NULL,NULL,'Joseph','Odelo','Leaky',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(107,3,2,NULL,NULL,'Jenniffer','Mutheu','Mwamboi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(108,4,2,NULL,NULL,'John','Kithi','Ngombo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(109,4,2,NULL,NULL,'Chrispus','k','Kazungu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(110,4,2,NULL,NULL,'Mercy','','Katana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(111,4,2,NULL,NULL,'Carol','','Nzai',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(112,4,2,NULL,NULL,'Daniel','','Jele',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(113,4,2,NULL,NULL,'Milton','','Mbogo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(114,4,2,NULL,NULL,'Elizabeth','','Kitsao',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(115,4,2,NULL,NULL,'Rehema','','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(116,3,2,NULL,NULL,'Ester','P','Kea',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(117,4,2,NULL,NULL,'Christoper','','Nyale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(118,4,2,NULL,NULL,'Charles','','Mbuthia',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(119,4,2,NULL,NULL,'Emily','Hajilo','Buya',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(120,3,2,NULL,NULL,'Patience','Dhahabu','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(121,4,2,NULL,NULL,'Kaloleni','','Charo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(122,4,2,NULL,NULL,'Aisha','','Msinda',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(123,4,2,NULL,NULL,'Kahindi','','Mitsanze',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(124,4,2,NULL,NULL,'Veronicah','k','Kenga',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(125,4,2,NULL,NULL,'Jumwa','','Wanje',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(126,4,2,NULL,NULL,'Denis','','Mambo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(127,3,2,NULL,NULL,'Mercy','','Rodgers',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(128,4,2,NULL,NULL,'Maurice','',' Kapendezo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(129,4,2,NULL,NULL,'Amina','','Bakari',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(130,4,2,NULL,NULL,'Judith','','mbuche',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(131,4,2,NULL,NULL,'Peter','Mwamuye','Lewa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(132,3,2,NULL,NULL,'Hassan','','Omar',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(133,4,2,NULL,NULL,'Said','','Maitha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(134,4,2,NULL,NULL,'Joseph','','Nyamai',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(135,4,2,NULL,NULL,'Gambari','','Mangale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(136,4,2,NULL,NULL,'Gambari','2','Mangale',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(137,3,2,NULL,NULL,'Richard','','Changawa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(138,4,2,NULL,NULL,'Agnes','Patience','Amina',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(139,4,2,NULL,NULL,'Tsuzi','','Ksiim',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(140,4,2,NULL,NULL,'Julius','','Kalama',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(141,4,2,NULL,NULL,'Joyce ','','Mnyazi',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(142,4,2,NULL,NULL,'Elida','h','Lotan',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(143,4,2,NULL,NULL,'Salama','','Baraka',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(144,4,2,NULL,NULL,'Peter','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(145,3,2,NULL,NULL,'Newton','','Mwamoto',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(146,4,2,NULL,NULL,'Josphat','Tiongi','Mwema',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(147,4,2,NULL,NULL,'margeret','','Lewa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(148,4,2,NULL,NULL,'Judah','','Keah',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(149,4,2,NULL,NULL,'Kyalo','','Kimanzi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(150,4,2,NULL,NULL,'Onesmus','','Gona',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(151,4,2,NULL,NULL,'Kennedy','','Munyao',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(152,4,2,NULL,NULL,'Abisaki','','Nechesa',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(153,4,2,NULL,NULL,'Bosire','Joshua','Omwenga',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(154,4,2,NULL,NULL,'John','','Saro',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(155,4,2,NULL,NULL,'Stephen','','Lindah',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(156,3,2,NULL,NULL,'Mary','Pendo','Mumba',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(157,4,2,NULL,NULL,'Fredrick','','Deche',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(158,4,2,NULL,NULL,'Everyne ','','Hawa',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(159,4,2,NULL,NULL,'Peninah','','Fedha',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(160,3,2,NULL,NULL,'Florence','','Katana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(161,3,2,NULL,NULL,'Florence','','Katana',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(162,4,2,NULL,NULL,'Emmanuel','','Kombe',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(163,4,2,NULL,NULL,'Robert','Chivtsi','Mwatemo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(164,4,2,NULL,NULL,'James','Kombe','enock',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(165,4,2,NULL,NULL,'Rose','Mugii','Mbura',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(166,4,2,NULL,NULL,'Charo','','Kitsao',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(167,4,2,NULL,NULL,'Henry','','Sande',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(168,4,2,NULL,NULL,'Kalume','Ngumbao','Kithi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(169,4,2,NULL,NULL,'margeret','','Kaladze',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(170,4,2,NULL,NULL,'Slyvester','','Ronald',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(171,4,2,NULL,NULL,'Reuben','Mwatemo','Chivtsi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(172,4,2,NULL,NULL,'Ananiah','','Amani',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(173,4,2,NULL,NULL,'Jackson','','Hara',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(174,4,2,NULL,NULL,'Pauline','','K',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(175,3,2,NULL,NULL,'Linah','','Hiribae',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(176,4,2,NULL,NULL,'Anne','Wangari','Njigua',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(177,3,2,NULL,NULL,'Hassan','','Swaleh',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(178,4,2,NULL,NULL,'Khadijah','','Said',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(179,3,2,NULL,NULL,'Karisa','Katana','Nasoro',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(180,4,2,NULL,NULL,'Mary','Akinyi','Harriet',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(181,4,2,NULL,NULL,'Emmaculate','','Omolo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(182,4,2,NULL,NULL,'Ndolo','','Julius',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(183,4,2,NULL,NULL,'Juma','','Abdalla',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(184,4,2,NULL,NULL,'Victor','Kania','Mutuku',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(185,4,2,NULL,NULL,'Ochieng','','Stephen',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(186,3,2,NULL,NULL,'Edward','Mwatunza','Mundu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(187,4,2,NULL,NULL,'Salim','','Kithi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(188,4,2,NULL,NULL,'George','','Othuon',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(189,4,2,NULL,NULL,'Everlyne','Dama','Angore',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(190,4,2,NULL,NULL,'Saiboku','m','Mollel',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(191,4,2,NULL,NULL,'Agnes','Samini','Chefu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(192,3,2,NULL,NULL,'Loyce','Dhahabu','Mtwana',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(193,4,2,NULL,NULL,'Nyiramafaranga ','','Adidja',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(194,4,2,NULL,NULL,'Philip','Onsase','Nyakundi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(195,4,2,NULL,NULL,'Ramadhani','Saidi','Ramadhani',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(196,3,2,NULL,NULL,'Salama','','Matano',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(197,4,2,NULL,NULL,'Peter','Muema','Maluki',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(198,3,2,NULL,NULL,'Jimmy','Mwambegu','Mumba',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(199,4,2,NULL,NULL,'Beatrice','','Jambo',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(200,3,2,NULL,NULL,'Daniel','Lewa','Dzombo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(201,4,2,NULL,NULL,'Lavenda','','Ayoti',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(202,4,2,NULL,NULL,'Baraka','','Kazungu',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(203,4,2,NULL,NULL,'Benson','Ruma','Mangale',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(204,4,2,NULL,NULL,'Josphat','','Kiti',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(205,4,2,NULL,NULL,'Julius','','Katoto',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(206,4,2,NULL,NULL,'Susan','','Maluki',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(207,4,2,NULL,NULL,'Francis','','Chivatsi',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(208,4,2,NULL,NULL,'Hamisi','','Mbura',NULL,'',NULL,'','',NULL,'',NULL,NULL,NULL,'',NULL,NULL),(209,3,2,NULL,NULL,'Lenox ','','Mkutanoni',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(210,4,2,NULL,NULL,'Dorah ','','Kinyeu',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(211,4,2,NULL,NULL,'Shamsa','','Suleiman',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(212,4,2,NULL,NULL,'Laymax','','Mwamuye',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(213,4,2,NULL,NULL,'David','','Charo',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(214,4,2,NULL,NULL,'Amos ','','Masha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(215,4,2,NULL,NULL,'James','','Iha',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(216,4,2,NULL,NULL,'Nelson','','Mandela',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(217,4,2,NULL,NULL,'Davine','Irene','Amond',NULL,'',NULL,'','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(218,4,2,NULL,NULL,'Eric','','Mwangiri',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(219,4,2,NULL,NULL,'Mark s. Ndurya','','Katana Mwango',NULL,'',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL),(221,3,2,NULL,NULL,'Agnes','bendera','Nzai',NULL,'','0723397330','','',NULL,'Female',NULL,NULL,NULL,'',NULL,NULL),(223,4,2,NULL,NULL,'Rehema','','luwali',NULL,'','0712829419','','','2017-08-26 12:18:47','Female',NULL,NULL,NULL,'','',''),(224,4,2,NULL,NULL,'agnes ','luvuno','munga',NULL,'','0721531069','','','2017-08-26 12:23:03','Female',NULL,NULL,NULL,'','',''),(225,4,2,NULL,NULL,'mama','','zuberi',NULL,'','0721531664','','','2017-08-26 12:23:55','Female',NULL,NULL,NULL,'','',''),(226,4,2,NULL,NULL,'mtunga','','m',NULL,'','0721554044','','','2017-08-26 12:27:39','Male',NULL,NULL,NULL,'','','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
