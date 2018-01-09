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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_entries` */

insert  into `re_account_entries`(`id`,`fk_account_chart`,`trasaction_type`,`amount`,`entry_date`,`created_on`,`created_by`,`origin_id`,`origin_model`) values (1,36,'debit',10000,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(2,34,'credit',10000,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(3,36,'debit',10000,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(4,34,'credit',10000,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(5,36,'debit',1,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(6,34,'credit',1,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(7,36,'debit',1,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(8,34,'credit',1,'2018-01-03','2018-01-03 14:19:36',1,NULL,NULL),(9,36,'debit',1,'2018-01-03','2018-01-03 14:19:37',1,NULL,NULL),(10,34,'credit',1,'2018-01-03','2018-01-03 14:19:37',1,NULL,NULL),(11,36,'debit',10000,'2018-01-03','2018-01-03 14:19:37',1,NULL,NULL),(12,34,'credit',10000,'2018-01-03','2018-01-03 14:19:37',1,NULL,NULL),(13,36,'debit',1,'2018-01-03','2018-01-03 14:23:05',1,NULL,NULL),(14,34,'credit',1,'2018-01-03','2018-01-03 14:23:05',1,NULL,NULL),(15,36,'debit',1,'2018-01-03','2018-01-03 14:23:05',1,NULL,NULL),(16,34,'credit',1,'2018-01-03','2018-01-03 14:23:05',1,NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `re_account_map` */

insert  into `re_account_map`(`id`,`fk_term`,`fk_account_chart`,`transaction_type`,`status`,`created_on`,`created_by`,`modified_on`,`modified_by`) values (1,2,36,'debit',1,'2017-12-18 15:00:25',NULL,NULL,NULL),(2,2,34,'credit',1,'2017-12-18 15:00:54',NULL,NULL,NULL),(3,3,38,'credit',1,NULL,NULL,NULL,NULL);

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

/*Table structure for table `re_disbursements` */

DROP TABLE IF EXISTS `re_disbursements`;

CREATE TABLE `re_disbursements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_rent` int(11) NOT NULL,
  `fk_landlord` int(11) DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `entry_date` date NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_landlord` (`fk_landlord`),
  KEY `fk_occupancy_rent` (`fk_occupancy_rent`),
  CONSTRAINT `re_disbursements_ibfk_1` FOREIGN KEY (`fk_landlord`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_disbursements_ibfk_2` FOREIGN KEY (`fk_occupancy_rent`) REFERENCES `re_occupancy_rent` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `re_disbursements` */

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

/*Table structure for table `re_occupancy_invoice` */

DROP TABLE IF EXISTS `re_occupancy_invoice`;

CREATE TABLE `re_occupancy_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(100) NOT NULL,
  `fk_occupancy_rent` int(11) NOT NULL,
  `created_on` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `re_occupancy_invoice` */

insert  into `re_occupancy_invoice`(`id`,`invoice_no`,`fk_occupancy_rent`,`created_on`,`created_by`) values (1,'INV-10-13',158,'2017-12-11',1),(2,'INV-10-13',159,'2017-12-11',1),(3,'INV-10-13',160,'2017-12-11',1),(4,'INV-11-13',161,'2017-12-11',1),(5,'INV-11-13',162,'2017-12-11',1),(6,'INV-11-13',163,'2017-12-11',1),(7,'INV-13-13',164,'2017-12-11',1),(8,'INV-13-13',165,'2017-12-11',1),(9,'INV-13-13',166,'2017-12-11',1),(10,'INV-14-13',167,'2017-12-11',1),(11,'INV-14-13',168,'2017-12-11',1),(12,'INV-14-13',169,'2017-12-11',1),(13,'INV-15-13',170,'2017-12-11',1),(14,'INV-15-13',171,'2017-12-11',1),(15,'INV-15-13',172,'2017-12-11',1),(16,'INV-16-13',173,'2017-12-11',1),(17,'INV-16-13',174,'2017-12-11',1),(18,'INV-16-13',175,'2017-12-11',1),(19,'INV-10-13',2,'2018-01-03',1),(20,'INV-10-13',0,'2018-01-03',1),(21,'INV-10-13',0,'2018-01-03',1),(22,'INV-11-13',4,'2018-01-03',1),(23,'INV-11-13',0,'2018-01-03',1),(24,'INV-11-13',0,'2018-01-03',1),(25,'INV-13-13',6,'2018-01-03',1),(26,'INV-13-13',0,'2018-01-03',1),(27,'INV-13-13',0,'2018-01-03',1),(28,'INV-13-13',0,'2018-01-03',1),(29,'INV-14-13',8,'2018-01-03',1),(30,'INV-14-13',0,'2018-01-03',1),(31,'INV-14-13',0,'2018-01-03',1),(32,'INV-14-13',0,'2018-01-03',1),(33,'INV-15-13',10,'2018-01-03',1),(34,'INV-15-13',0,'2018-01-03',1),(35,'INV-15-13',0,'2018-01-03',1),(36,'INV-15-13',0,'2018-01-03',1),(37,'INV-16-13',12,'2018-01-03',1),(38,'INV-16-13',0,'2018-01-03',1),(39,'INV-16-13',0,'2018-01-03',1),(40,'INV-1-13',14,'2018-01-03',1),(41,'INV-8-13',16,'2018-01-03',1),(42,'INV-17-13',0,'2018-01-04',1),(43,'INV-17-13',0,'2018-01-04',1),(44,'INV-17-13',0,'2018-01-04',1),(45,'INV-17-13',0,'2018-01-04',1),(46,'INV-18-13',0,'2018-01-04',1);

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

/*Table structure for table `re_receipt` */

DROP TABLE IF EXISTS `re_receipt`;

CREATE TABLE `re_receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_no` varchar(50) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `re_receipt` */

insert  into `re_receipt`(`id`,`receipt_no`,`date_created`,`created_by`) values (1,'jnr1','2017-12-13 08:32:06',1),(2,'jnr2','2017-12-13 08:36:48',1),(3,'jnr3','2017-12-13 08:49:28',1),(4,'jnr4','2017-12-27 16:52:55',1),(5,'jnr5','2017-12-27 16:53:11',1),(6,'jnr6','2017-12-28 09:55:05',1),(7,'jnr7','2018-01-03 08:38:26',1),(8,'jnr8','2018-01-03 14:20:17',1),(9,'jnr9','2018-01-03 14:24:16',1),(10,'jnr10','2018-01-04 18:48:40',1),(11,'jnr11','2018-01-04 18:48:53',1),(12,'jnr12','2018-01-04 18:49:42',1),(13,'jnr13','2018-01-04 18:50:08',1),(14,'jnr14','2018-01-04 18:50:31',1),(15,'jnr15','2018-01-04 18:51:40',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
