/*
SQLyog Community v11.51 (64 bit)
MySQL - 5.7.17-log : Database - real_estate2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`real_estate2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `real_estate2`;

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

insert  into `re_account_chart`(`id`,`code`,`name`,`fk_re_account_type`,`status`,`description`,`created_by`,`modified_by`,`created_on`,`modified_on`) values (32,1101,'Cash',1,1,'Cash Account',1,NULL,NULL,NULL),(33,1102,'Bank',1,1,'Bank Account',1,NULL,NULL,NULL),(34,1103,'Accounts Receivable',1,1,'Accounts Receivable\r\n',1,NULL,NULL,NULL),(35,1104,'Accounts Payable',2,1,'Accounts Payable\r\n',1,NULL,NULL,NULL),(36,1105,'Rent Income',4,1,NULL,1,NULL,NULL,NULL),(37,1106,'Penalties Income',4,1,NULL,1,NULL,NULL,NULL),(38,1107,'Disbursement',2,1,'Disbursement account',1,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_entries` */

insert  into `re_account_entries`(`id`,`fk_account_chart`,`trasaction_type`,`amount`,`entry_date`,`created_on`,`created_by`,`origin_id`,`origin_model`) values (27,36,'debit',3000,'2018-01-06','2018-01-06 13:27:48',1,208,'app\\models\\OccupancyRent'),(28,34,'credit',3000,'2018-01-06','2018-01-06 13:27:48',1,208,'app\\models\\OccupancyRent'),(29,36,'debit',3000,'2018-01-06','2018-01-06 13:27:48',1,209,'app\\models\\OccupancyRent'),(30,34,'credit',3000,'2018-01-06','2018-01-06 13:27:48',1,209,'app\\models\\OccupancyRent'),(31,36,'debit',3000,'2018-01-06','2018-01-06 13:27:48',1,213,'app\\models\\OccupancyRent'),(32,34,'credit',3000,'2018-01-06','2018-01-06 13:27:48',1,213,'app\\models\\OccupancyRent'),(33,36,'debit',5000,'2018-01-06','2018-01-06 13:27:48',1,214,'app\\models\\OccupancyRent'),(34,34,'credit',5000,'2018-01-06','2018-01-06 13:27:48',1,214,'app\\models\\OccupancyRent'),(35,36,'debit',5000,'2018-01-06','2018-01-06 13:27:48',1,216,'app\\models\\OccupancyRent'),(36,34,'credit',5000,'2018-01-06','2018-01-06 13:27:48',1,216,'app\\models\\OccupancyRent'),(37,38,'debit',5000,'2018-01-06','2018-01-06 13:28:47',1,5,'app\\models\\Disbursements'),(38,35,'credit',5000,'2018-01-06','2018-01-06 13:28:47',1,5,'app\\models\\Disbursements'),(39,38,'debit',5000,'2018-01-06','2018-01-06 13:28:47',1,6,'app\\models\\Disbursements'),(40,35,'credit',5000,'2018-01-06','2018-01-06 13:28:47',1,6,'app\\models\\Disbursements');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_map` */

insert  into `re_account_map`(`id`,`fk_term`,`fk_account_chart`,`transaction_type`,`status`,`created_on`,`created_by`,`modified_on`,`modified_by`) values (1,1,36,'debit',1,'2017-12-18 15:00:25',NULL,NULL,NULL),(2,1,34,'credit',1,'2017-12-18 15:00:54',NULL,NULL,NULL),(3,3,38,'debit',1,NULL,NULL,NULL,NULL),(4,3,35,'credit',1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `re_accounts_transaction` */

insert  into `re_accounts_transaction`(`id`,`fk_journal`,`fk_account`,`fk_source`,`dr`,`cr`,`running_balance`,`details`,`date_created`,`created_by`,`date_modified`,`modified_by`,`reconciled`,`reconciled_amount`,`reconciled_by`,`reconciled_date`) values (1,1,1,8,NULL,'1000.00','-1000.00',NULL,NULL,NULL,NULL,NULL,1,NULL,'karisa  nzaro','2017-11-09 18:36:51'),(2,2,1,5,NULL,'1000.00','-2000.00',NULL,NULL,NULL,NULL,NULL,1,NULL,'karisa  nzaro','2017-12-02 09:41:10'),(3,3,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,5,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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

insert  into `re_county`(`id`,`county_desc`,`county_name`,`county_lat`,`county_long`) values (1,'tetststs','Kilifi',NULL,NULL),(2,'test','Lamu',NULL,NULL),(3,'test.test','mombasa',NULL,NULL),(4,'test','kwale',NULL,NULL),(5,'tetts','Test',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `re_disbursements` */

insert  into `re_disbursements`(`id`,`fk_occupancy_rent`,`fk_landlord`,`batch_id`,`amount`,`month`,`year`,`entry_date`,`created_on`,`created_by`,`_status`) values (5,214,3,NULL,5000,1,2018,'2018-01-06','2018-01-06 13:28:47',1,1),(6,216,3,NULL,5000,1,2018,'2018-01-06','2018-01-06 13:28:47',1,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_estate` */

insert  into `re_estate`(`id`,`fk_sub_location`,`estate_name`,`estate_desc`,`estate_review`,`estate_media`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`,`estate_lat`,`estate_long`) values (1,3,'kwa mike ','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,2,'Tumaini','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,2,'prisons','test estate','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_feature` */

insert  into `re_feature`(`id`,`feature_name`,`feature_desc`,`date_created`,`created_by`,`date_modified`,`modified_by`,`_status`) values (1,'Gate',NULL,NULL,NULL,NULL,NULL,1),(2,'Door',NULL,NULL,NULL,NULL,NULL,1),(3,'Room',NULL,NULL,NULL,NULL,NULL,1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `re_journal` */

insert  into `re_journal`(`id`,`date`,`receipt_invoice_no`,`fk_occupancy_rent`,`fk_user`,`account_type`,`transaction_type`,`cheque_no`,`details`,`transacted_by`,`date_created`,`created_by`,`date_modified`,`modified_by`,`amount`,`post_status`) values (1,'2017-11-01','050',NULL,NULL,1,8,'004','asasas','1','2017-11-09 18:36:31','1',NULL,NULL,1000.00,1),(2,'2017-11-01','212',NULL,NULL,1,5,'12121','sasasas','1','2017-11-14 14:45:03','1',NULL,NULL,1000.00,1),(3,'2017-12-05','569548',29,12,1,1,'','','1','2017-12-05 08:38:16','1',NULL,NULL,NULL,1),(4,'2017-12-05','56954',29,12,1,1,'','','1','2017-12-05 08:43:46','1',NULL,NULL,NULL,1),(5,'2017-12-13','1',1,17,1,NULL,NULL,NULL,'1','2017-12-13 08:32:08','1',NULL,NULL,NULL,NULL),(6,'2017-12-13','2',2,17,1,NULL,NULL,NULL,'1','2017-12-13 08:36:51','1',NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_location` */

insert  into `re_location`(`id`,`fk_ward`,`location_name`,`location_desc`,`location_lat`,`location_long`) values (1,2,'kaya','test',NULL,NULL),(2,2,'mabirikani','test',NULL,NULL),(3,3,'pwani','test',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup` */

insert  into `re_lookup`(`id`,`_key`,`_value`,`category`,`_order`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'1','Single Rooms',1,NULL,0,NULL,NULL,NULL,NULL),(2,'2','Double Rooms',1,NULL,NULL,NULL,NULL,NULL,NULL),(3,'m','Male',2,NULL,NULL,NULL,NULL,NULL,NULL),(4,'f','Female',2,NULL,NULL,NULL,NULL,NULL,NULL),(5,'1','ON',3,NULL,NULL,NULL,NULL,NULL,NULL),(6,'2','OFF',3,NULL,NULL,NULL,NULL,NULL,NULL),(7,'1','Cash',4,NULL,1,NULL,NULL,NULL,NULL),(8,'2','Cheque',4,NULL,1,NULL,NULL,NULL,NULL),(9,'1','Pending',5,NULL,1,NULL,NULL,NULL,NULL),(10,'2','Paid',5,NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_lookup_category` */

DROP TABLE IF EXISTS `re_lookup_category`;

CREATE TABLE `re_lookup_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup_category` */

insert  into `re_lookup_category`(`id`,`category_name`) values (1,'Property Type'),(2,'Gender'),(3,'Status'),(4,'Payment Method'),(5,'Payment Status'),(6,'sss');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `re_management` */

insert  into `re_management`(`id`,`fk_user_id`,`management_type`,`management_name`,`location`,`address`,`profile_desc`,`featured_property`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,1,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,1,'Jongeto Agency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,'','','','',NULL,NULL,NULL,NULL,NULL,NULL),(4,2,NULL,'Jongeto','Kibarani','Some address','Some description',2,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy` */

insert  into `re_occupancy`(`id`,`fk_property_id`,`fk_sublet_id`,`fk_user_id`,`start_date`,`end_date`,`notes`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,3,1,4,'2017-10-31','2017-10-31',NULL,1,NULL,NULL,NULL,NULL),(2,4,3,5,'2017-10-05','2017-11-27','',2,NULL,NULL,NULL,NULL),(3,4,2,5,'2017-10-10','2017-11-29','sasasas',2,NULL,NULL,NULL,NULL),(4,4,2,1,'2017-11-01',NULL,'sasasas',2,NULL,NULL,NULL,NULL),(5,4,1,2,'2017-11-01',NULL,'sasasas',2,NULL,NULL,NULL,NULL),(6,4,3,2,'2017-11-01',NULL,'sasasa',2,NULL,NULL,NULL,NULL),(7,4,4,2,'2017-11-01',NULL,'',2,NULL,NULL,NULL,NULL),(8,3,5,12,'2017-11-01',NULL,'asasas',2,NULL,NULL,NULL,NULL),(9,4,1,1,'2017-11-01',NULL,'asas',2,NULL,NULL,NULL,NULL),(10,5,6,1,'2017-11-01',NULL,'',2,NULL,NULL,NULL,NULL),(11,5,7,13,'2017-11-02',NULL,'',2,NULL,NULL,NULL,NULL),(12,6,10,1,'2017-11-01',NULL,'New home for him',2,NULL,NULL,NULL,NULL),(13,7,12,15,'2016-12-02',NULL,'',2,NULL,NULL,NULL,NULL),(14,7,13,1,'2017-11-01',NULL,'xzss',2,NULL,NULL,NULL,NULL),(15,7,14,7,'2017-12-01',NULL,'',2,NULL,NULL,NULL,NULL),(16,5,15,17,'2017-10-01','2018-05-31','',2,NULL,NULL,NULL,NULL),(17,7,12,15,'2018-01-03',NULL,'asaa',1,NULL,NULL,NULL,NULL),(18,3,5,6,'2018-01-03',NULL,'',1,NULL,NULL,NULL,NULL),(19,6,10,8,'2018-01-01',NULL,'',1,NULL,NULL,NULL,NULL),(20,1,11,9,'2018-01-01',NULL,'sasasa',1,NULL,NULL,NULL,NULL),(21,1,16,16,'2018-01-01',NULL,'',1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_occupancy_invoice` */

DROP TABLE IF EXISTS `re_occupancy_invoice`;

CREATE TABLE `re_occupancy_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `fk_occupancy_rent` int(11) NOT NULL,
  `created_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_invoice` */

insert  into `re_occupancy_invoice`(`id`,`invoice_no`,`fk_occupancy_rent`,`created_on`,`created_by`) values (1,'INV-10-13',158,'2017-12-11',1),(2,'INV-10-13',159,'2017-12-11',1),(3,'INV-10-13',160,'2017-12-11',1),(4,'INV-11-13',161,'2017-12-11',1),(5,'INV-11-13',162,'2017-12-11',1),(6,'INV-11-13',163,'2017-12-11',1),(7,'INV-13-13',164,'2017-12-11',1),(8,'INV-13-13',165,'2017-12-11',1),(9,'INV-13-13',166,'2017-12-11',1),(10,'INV-14-13',167,'2017-12-11',1),(11,'INV-14-13',168,'2017-12-11',1),(12,'INV-14-13',169,'2017-12-11',1),(13,'INV-15-13',170,'2017-12-11',1),(14,'INV-15-13',171,'2017-12-11',1),(15,'INV-15-13',172,'2017-12-11',1),(16,'INV-16-13',173,'2017-12-11',1),(17,'INV-16-13',174,'2017-12-11',1),(18,'INV-16-13',175,'2017-12-11',1),(19,'INV-10-13',2,'2018-01-03',1),(20,'INV-10-13',0,'2018-01-03',1),(21,'INV-10-13',0,'2018-01-03',1),(22,'INV-11-13',4,'2018-01-03',1),(23,'INV-11-13',0,'2018-01-03',1),(24,'INV-11-13',0,'2018-01-03',1),(25,'INV-13-13',6,'2018-01-03',1),(26,'INV-13-13',0,'2018-01-03',1),(27,'INV-13-13',0,'2018-01-03',1),(28,'INV-13-13',0,'2018-01-03',1),(29,'INV-14-13',8,'2018-01-03',1),(30,'INV-14-13',0,'2018-01-03',1),(31,'INV-14-13',0,'2018-01-03',1),(32,'INV-14-13',0,'2018-01-03',1),(33,'INV-15-13',10,'2018-01-03',1),(34,'INV-15-13',0,'2018-01-03',1),(35,'INV-15-13',0,'2018-01-03',1),(36,'INV-15-13',0,'2018-01-03',1),(37,'INV-16-13',12,'2018-01-03',1),(38,'INV-16-13',0,'2018-01-03',1),(39,'INV-16-13',0,'2018-01-03',1),(40,'INV-1-13',14,'2018-01-03',1),(41,'INV-8-13',16,'2018-01-03',1),(42,'INV-17-13',0,'2018-01-04',1),(43,'INV-17-13',0,'2018-01-04',1),(44,'INV-17-13',0,'2018-01-04',1),(45,'INV-17-13',0,'2018-01-04',1),(46,'INV-18-13',0,'2018-01-04',1),(47,'INV-20-13',18,'2018-01-06',1),(48,'INV-20-13',0,'2018-01-06',1),(49,'INV-17-5',20,'2018-01-06',1),(50,'INV-21-13',24,'2018-01-06',1),(51,'INV-21-13',0,'2018-01-06',1),(52,'INV-1-13',28,'2018-01-06',1),(53,'INV-17-13',30,'2018-01-06',1),(54,'INV-17-13',0,'2018-01-06',1),(55,'INV-17-13',0,'2018-01-06',1),(56,'INV-17-13',0,'2018-01-06',1),(57,'INV-18-13',32,'2018-01-06',1),(58,'INV-20-13',34,'2018-01-06',1),(59,'INV-20-13',0,'2018-01-06',1),(60,'INV-21-13',36,'2018-01-06',1),(61,'INV-21-13',0,'2018-01-06',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_payments` */

insert  into `re_occupancy_payments`(`id`,`fk_occupancy_id`,`amount`,`payment_date`,`fk_receipt_id`,`payment_method`,`ref_no`,`status`,`created_by`,`created_on`,`modified_by`,`modified_on`) values (1,16,10000,'2017-12-13',1,1,'',2,1,'2017-12-13',NULL,NULL),(2,16,10000,'2017-12-13',2,1,'',2,1,'2017-12-13',NULL,NULL),(3,16,10000,'2017-12-13',3,1,'',2,1,'2017-12-13',NULL,NULL),(4,18,3000,'2018-01-04',13,1,'001',2,1,'2018-01-04',NULL,NULL);

/*Table structure for table `re_occupancy_rent` */

DROP TABLE IF EXISTS `re_occupancy_rent`;

CREATE TABLE `re_occupancy_rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) NOT NULL,
  `fk_term` int(11) NOT NULL,
  `fk_source` int(11) NOT NULL,
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
  CONSTRAINT `re_occupancy_rent_ibfk_3` FOREIGN KEY (`fk_term`) REFERENCES `re_term` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_rent` */

insert  into `re_occupancy_rent`(`id`,`fk_occupancy_id`,`fk_term`,`fk_source`,`month`,`year`,`amount`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (208,1,1,1,1,2018,3000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(209,17,1,1,1,2018,3000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(210,17,4,19,1,2018,3000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(211,17,5,20,1,2018,1000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(212,17,6,21,1,2018,2000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(213,18,1,1,1,2018,3000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(214,20,1,1,1,2018,5000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(215,20,4,19,1,2018,5000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(216,21,1,1,1,2018,5000.00,1,'2018-01-06 13:27:48',1,NULL,NULL),(217,21,4,19,1,2018,5000.00,1,'2018-01-06 13:27:48',1,NULL,NULL);

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
  `frequency` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  KEY `fk_property_term_id` (`fk_property_term_id`),
  CONSTRAINT `re_occupancy_term_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_term_ibfk_2` FOREIGN KEY (`fk_property_term_id`) REFERENCES `re_property_term` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_term` */

insert  into `re_occupancy_term`(`id`,`fk_occupancy_id`,`fk_property_term_id`,`value`,`term_date`,`date_signed`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`,`frequency`) values (1,11,1,'1000','2017-11-01','2017-11-15',1,NULL,NULL,NULL,NULL,NULL),(2,13,4,'3500','2017-11-01','2017-11-01',1,NULL,NULL,NULL,NULL,NULL),(3,16,14,'10000','2017-12-01','2017-12-01',1,NULL,NULL,NULL,NULL,NULL),(4,16,15,'20000','2017-12-01','2017-12-01',1,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `re_property` */

insert  into `re_property`(`id`,`property_name`,`property_desc`,`fk_property_location`,`property_type`,`management_id`,`owner_id`,`property_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'bungalow','www',1,1,2,3,NULL,1,NULL,NULL,NULL,NULL),(2,'massionates','sssssefgr',1,2,2,3,NULL,2,NULL,NULL,NULL,NULL),(3,'Monk Villa','asaasa',3,2,2,3,NULL,1,NULL,NULL,NULL,NULL),(4,'Miguna Island','Island of merci',2,2,2,4,NULL,1,NULL,NULL,NULL,NULL),(5,'Hayes','',1,1,2,4,NULL,1,NULL,NULL,NULL,NULL),(6,'ssss','aaa',1,1,2,2,NULL,1,NULL,NULL,NULL,NULL),(7,'Monkey Villa','sdsdsds  s dsds ds s sfsds s ssds s sssd sdsd',1,2,2,14,NULL,1,NULL,NULL,NULL,NULL);

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

insert  into `re_property_feature`(`id`,`fk_feature`,`fk_property_id`,`fk_sublet_id`,`feature_narration`,`feature_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,1,4,1,'Strong',NULL,1,NULL,NULL,NULL,NULL),(2,2,2,2,'ssss',NULL,1,NULL,NULL,NULL,NULL),(3,1,2,1,'ss',NULL,1,NULL,NULL,NULL,NULL),(4,2,6,2,'aa',NULL,2,NULL,NULL,NULL,NULL),(5,2,6,2,'Metallic',NULL,1,NULL,NULL,NULL,NULL),(6,1,7,2,'Metalic Gate',NULL,1,NULL,NULL,NULL,NULL),(7,1,3,NULL,'asasa',NULL,1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_sublet` */

insert  into `re_property_sublet`(`id`,`fk_property_id`,`sublet_name`,`sublet_desc`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,4,'RM 1','sasaasa',1,NULL,NULL,NULL,NULL),(2,4,'RM 2','',1,NULL,NULL,NULL,NULL),(3,4,'RM3','sasasas',2,NULL,NULL,NULL,NULL),(4,4,'RM 4','asasasa',1,NULL,NULL,NULL,NULL),(5,3,'RM 1','sasas',1,NULL,NULL,NULL,NULL),(6,5,'RM 1','',1,NULL,NULL,NULL,NULL),(7,5,'Unit 2','',1,NULL,NULL,NULL,NULL),(8,2,'rum2','test',1,NULL,NULL,NULL,NULL),(9,2,'rum3','trregefd',2,NULL,NULL,NULL,NULL),(10,6,'RM 1','',1,NULL,NULL,NULL,NULL),(11,1,'ee','sss',1,NULL,NULL,NULL,NULL),(12,7,'RM 1','sasa',1,NULL,NULL,NULL,NULL),(13,7,'RM 2','asaas',1,NULL,NULL,NULL,NULL),(14,7,'RM3','',1,NULL,NULL,NULL,NULL),(15,5,'RM3','',1,NULL,NULL,NULL,NULL),(16,1,'RM 2','',1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `re_property_term` */

insert  into `re_property_term`(`id`,`fk_property_id`,`fk_term_id`,`term_title`,`term_value`,`term_narration`,`action_handler`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,4,1,'Rent Amount',NULL,'3500','',1,NULL,NULL,NULL,NULL),(2,4,3,'Disbursement',NULL,'10000',NULL,1,NULL,NULL,NULL,NULL),(3,2,2,'weee',NULL,'xxxx',NULL,1,NULL,NULL,NULL,NULL),(4,7,1,'Rent per unit','3000','asasasas',NULL,1,NULL,NULL,NULL,NULL),(5,7,3,'Date of disbursement','10','A given day of the month',NULL,1,NULL,NULL,NULL,NULL),(6,7,2,'Date of rent due','1','Day of rent due',NULL,1,NULL,NULL,NULL,NULL),(7,7,4,'Rent Deposit','3000','Rent Deposit',NULL,1,NULL,NULL,NULL,NULL),(8,7,5,'Water Deposit','1000','',NULL,1,NULL,NULL,NULL,NULL),(9,7,6,'Electricity Deposit','2000','',NULL,1,NULL,NULL,NULL,NULL),(10,7,13,'Commission','10','commission in percentage',NULL,1,NULL,NULL,NULL,NULL),(11,7,10,'Date of penalty','5','',NULL,1,NULL,NULL,NULL,NULL),(12,7,11,'Penalty Percentage','20','',NULL,1,NULL,NULL,NULL,NULL),(13,7,9,'Time for closing the gate','9PM','',NULL,1,NULL,NULL,NULL,NULL),(14,5,2,'Rent','10000','Rent Paid Monthly',NULL,1,NULL,NULL,NULL,NULL),(15,5,4,'Rent 2 Months Deposit','20000','2 Month Rent Deposit - Refundable ',NULL,1,NULL,NULL,NULL,NULL),(16,5,5,'Water Deposit','1000','',NULL,1,NULL,NULL,NULL,NULL),(17,3,1,'Rent Amount','3000','',NULL,1,NULL,NULL,NULL,NULL),(18,3,2,'Date of rent due','1','',NULL,1,NULL,NULL,NULL,NULL),(19,1,1,NULL,'5000','sasasa',NULL,1,NULL,NULL,NULL,NULL),(20,1,3,NULL,'5','asasasa',NULL,1,NULL,NULL,NULL,NULL),(21,1,4,NULL,'5000','',NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_receipt` */

DROP TABLE IF EXISTS `re_receipt`;

CREATE TABLE `re_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `re_receipt` */

insert  into `re_receipt`(`id`,`receipt_no`,`date_created`,`created_by`) values (1,'jnr1','2017-12-13 08:32:06',1),(2,'jnr2','2017-12-13 08:36:48',1),(3,'jnr3','2017-12-13 08:49:28',1),(4,'jnr4','2017-12-27 16:52:55',1),(5,'jnr5','2017-12-27 16:53:11',1),(6,'jnr6','2017-12-28 09:55:05',1),(7,'jnr7','2018-01-03 08:38:26',1),(8,'jnr8','2018-01-03 14:20:17',1),(9,'jnr9','2018-01-03 14:24:16',1),(10,'jnr10','2018-01-04 18:48:40',1),(11,'jnr11','2018-01-04 18:48:53',1),(12,'jnr12','2018-01-04 18:49:42',1),(13,'jnr13','2018-01-04 18:50:08',1),(14,'jnr14','2018-01-04 18:50:31',1),(15,'jnr15','2018-01-04 18:51:40',1),(16,'jnr16','2018-01-05 10:55:24',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `re_role` */

insert  into `re_role`(`id`,`role_name`,`role_description`,`date_created`,`createdby`,`date_modified`,`modified_by`) values (1,'agency admin','system administrator',NULL,NULL,NULL,NULL),(2,'normal','normal user',NULL,NULL,NULL,NULL),(3,'chairman',NULL,NULL,NULL,NULL,NULL),(4,'group leader',NULL,NULL,NULL,NULL,NULL),(5,'secretary',NULL,NULL,NULL,NULL,NULL),(6,'IT coodinator',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `re_source` */

DROP TABLE IF EXISTS `re_source`;

CREATE TABLE `re_source` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(50) DEFAULT NULL,
  `source_description` text,
  `source_type` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `re_source` */

insert  into `re_source`(`id`,`source_name`,`source_description`,`source_type`,`category`) values (1,'Rent','','Income','tenant'),(2,'Landlord Imprest','','Expense','landlord'),(3,'Disbursement','','Expense','landlord'),(4,'Agency Allowance','Rent collection allowances','Income','tenant'),(5,'Transport','','Expense','agent'),(6,'Lunch','','Expense','agent'),(7,'Bank Charges','','Expense','agent'),(8,'Salary','','Expense','agent'),(9,'Salary Advance','','Expense','agent'),(10,'Penalty Waiver','Penalty cancellation','Expense','tenant'),(11,'Penalty','Penalty incurred due to late payments','Income','tenant'),(13,'Storage Fees','Goods storage fees','Income','tenant'),(14,'Tenant Transport','Tenant Transport','Income','tenant'),(15,'Breaking Fees','Fees for breaking house','Income','tenant'),(16,'Visit Fees','','Income','tenant'),(17,'Locking Fees','Locking Fees','Income','tenant'),(18,'Agency Fee','Agency Fee','Income','tenant'),(19,'Rent Deposit','Rent Deposit','Income','tenant'),(20,'Water Deposit','Water Deposit','Income','tenant'),(21,'Electricity Deposit','Electricity Deposit','Income','tenant'),(22,'Water Bill','Water Bill','Income','tenant'),(23,'Electricity Bill','Electricity Bill','Income','tenant'),(24,'Garbage Collection','Garbage Collection Bills','Income','tenant');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_sub_location` */

insert  into `re_sub_location`(`id`,`fk_location`,`sub_loc_name`,`sub_loc_desc`,`sub_loc_lat`,`sub_loc_long`) values (1,1,'pwani','test',NULL,NULL),(2,1,'kaya','test',NULL,NULL),(3,3,'kibaoni','test',NULL,NULL);

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

insert  into `re_subcounty`(`id`,`fk_county`,`subcounty_name`,`subcounty_desc`,`subcounty_lat`,`subcounty_long`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,1,'Ganze','',NULL,NULL,NULL,NULL,NULL,NULL),(2,1,'rabai','',NULL,NULL,NULL,NULL,NULL,NULL),(3,1,'kaloleni','test',NULL,NULL,NULL,NULL,NULL,NULL),(4,3,'nyali','test',NULL,NULL,NULL,NULL,NULL,NULL),(5,1,'kilifi north','test',NULL,NULL,NULL,NULL,NULL,NULL),(6,2,'Mokowe','',NULL,NULL,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `re_term` */

insert  into `re_term`(`id`,`term_type`,`term_name`,`term_desc`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`,`actionhandler`) values (1,NULL,'Rent Amount','Rent payable monthly',1,NULL,NULL,NULL,NULL,'DateRentPay'),(2,NULL,'Date Rent Pay','Date rent due',1,NULL,NULL,NULL,NULL,''),(3,NULL,'Landlord Disbursment','Date of payments to landlord',1,NULL,NULL,NULL,NULL,'LandlordDisbursement'),(4,NULL,'Rent Deposit','Amount paid by tenant as deposit',1,NULL,NULL,NULL,NULL,'RentDeposit'),(5,NULL,'Watert Deposit','Amount paid by tenant as water bill deposit',1,NULL,NULL,NULL,NULL,'WaterDeposit'),(6,NULL,'Electricity Deposit','Amount paid as electricity deposit',1,NULL,NULL,NULL,NULL,'ElectricityDeposit'),(7,NULL,'Water Bills','Whether the agency will collect water bills.',1,NULL,NULL,NULL,NULL,'WaterBills'),(8,NULL,'Electricity Bills','Whether the agency will collect electricity bills',1,NULL,NULL,NULL,NULL,'ElectricityBills'),(9,NULL,'Security Times','Time security gate closes.',1,NULL,NULL,NULL,NULL,''),(10,NULL,'Penalty Date','Date penalty will be calculated.',1,NULL,NULL,NULL,NULL,'PenatlyDate'),(11,NULL,'Penalty Percentage','Percentage of the rent payable as penalty.',1,NULL,NULL,NULL,NULL,'PenaltyPercentage'),(12,NULL,'Rent Due Date','Date rent is due',1,NULL,NULL,NULL,NULL,'RentDueDate'),(13,NULL,'Agent Commission','A percentage of the rent paid to agent as commission.',1,NULL,NULL,NULL,NULL,'AgentCommission');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_ward` */

insert  into `re_ward`(`id`,`fk_subcounty`,`ward_name`,`ward_desc`,`ward_lat`,`ward_long`) values (1,5,'hosipital','test',NULL,NULL),(2,5,'sokoni','test',NULL,NULL),(3,5,'kibarani','test',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `sys_users` */

insert  into `sys_users`(`id`,`fk_group_id`,`fk_management_id`,`username`,`pass`,`name1`,`name2`,`name3`,`age`,`email`,`phone`,`id_number`,`address`,`date_added`,`gender`,`color_code`,`icon_id`,`position`,`residence`,`occupation`,`employer`) values (1,2,2,'karisa','$2y$13$vLlfRhW8Rb5JXww6WVvddewt7qZNVjkzICuYnVr6WIFzu/2WL3K.2','karisa','','nzaro',NULL,'','777748',NULL,'',NULL,'Male',NULL,NULL,NULL,NULL,NULL,NULL),(2,3,2,'naija','$2y$13$vLlfRhW8Rb5JXww6WVvddewt7qZNVjkzICuYnVr6WIFzu/2WL3K.2','naija','fatma','njoroge',NULL,'pneema@neema.com','2147483647 / 0710202020 / 08282828','34455444','hiii',NULL,'Female',NULL,NULL,NULL,'ssss',NULL,NULL),(3,3,2,NULL,NULL,'Grace','Dama','Katana',NULL,'asasasa@sasa.com','2322121','34333333','',NULL,'Female',NULL,NULL,NULL,'kilifi',NULL,NULL),(4,3,2,NULL,NULL,'Fatuma','K','Karisa',NULL,'asasasa@sasa.com','722123456','43333222','',NULL,'Female',NULL,NULL,NULL,'kilifi',NULL,NULL),(5,4,2,NULL,NULL,'Jane','Dama','Smith',NULL,'asasasa@sasa.com','232212167 / 071919120','2344516178','1225',NULL,'Female',NULL,NULL,NULL,'kilifi','clinical officer','county government'),(6,4,2,NULL,NULL,'John','Diego','Smith',NULL,'asasasa@sasa.com','2322125','33637378','',NULL,'Male',NULL,NULL,NULL,'kilifi',NULL,NULL),(7,4,2,NULL,NULL,'Neema','','John',NULL,'pneema@neema.com','711992929','356677727','',NULL,'Female',NULL,NULL,NULL,'kilifi',NULL,NULL),(8,4,2,NULL,NULL,'Narsh','','Ngao',NULL,'narshon@gmail.com','711992924','4562627','',NULL,'Male',NULL,NULL,NULL,'kilifi',NULL,NULL),(9,4,2,NULL,NULL,'Eunice','','Mbeyu',NULL,'narshon@gmail.com','2322122','6777888','',NULL,'Female',NULL,NULL,NULL,'kilifi',NULL,NULL),(10,4,2,NULL,NULL,'Test2','asa','sasasa',NULL,'asasa@assa.com','21212112','90288382','',NULL,'Female',NULL,NULL,NULL,'MSA',NULL,NULL),(11,4,2,NULL,NULL,'asasa','sasa','asa',NULL,'asasasa@sasa.com','711992926','67272288','',NULL,'Male',NULL,NULL,NULL,'sas',NULL,NULL),(12,4,2,NULL,NULL,'katana','charo','wamae',NULL,'charo@katana.com','710202020','30555511','',NULL,'Male',NULL,NULL,NULL,'kilifi',NULL,NULL),(13,4,2,NULL,NULL,'Dama','','Charo',NULL,'dama@dm.com','2202929','30666672','',NULL,'Female',NULL,NULL,NULL,'asasa',NULL,NULL),(14,3,2,NULL,NULL,'Hassan','','Omar',NULL,'hassan@gmail.com','711992928','25123445','P.o Box 1234 Kilifi',NULL,'Male',NULL,NULL,NULL,'Malindi',NULL,NULL),(15,4,2,NULL,NULL,'Bila','','Asha',NULL,'narshon5@gmail.com','711992920','25123445','',NULL,'Female',NULL,NULL,NULL,'kilifi',NULL,NULL),(16,3,2,NULL,NULL,'neema','','priscillar',NULL,'nee@gmail.com','887272383','44445','22',NULL,'Female',NULL,NULL,NULL,'wer',NULL,NULL),(17,4,2,NULL,NULL,'nicky','Test','kusumu',NULL,'test@gmail.com',NULL,'','',NULL,'Male',NULL,NULL,NULL,'',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
