/*
SQLyog Community v11.2 (64 bit)
MySQL - 5.7.11 : Database - real_estate
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `real_estate`;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_county` */

insert  into `re_county`(`id`,`county_desc`,`county_name`) values (1,'Kilifi County','Kilifi');

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
  PRIMARY KEY (`id`),
  KEY `fk_sub_location` (`fk_sub_location`),
  CONSTRAINT `re_estate_ibfk_1` FOREIGN KEY (`fk_sub_location`) REFERENCES `re_sub_location` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_estate` */

insert  into `re_estate`(`id`,`fk_sub_location`,`estate_name`,`estate_desc`,`estate_review`,`estate_media`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,1,'saaa','asasa','asasa','',NULL,NULL,NULL,NULL,NULL);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_feature` */

/*Table structure for table `re_group` */

DROP TABLE IF EXISTS `re_group`;

CREATE TABLE `re_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(200) DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_group` */

insert  into `re_group`(`id`,`group_name`,`_status`) values (1,'Public',1),(2,'Agent',1),(3,'Administrator',1);

/*Table structure for table `re_location` */

DROP TABLE IF EXISTS `re_location`;

CREATE TABLE `re_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_ward` int(11) DEFAULT NULL,
  `location_name` varchar(200) DEFAULT NULL,
  `location_desc` text,
  PRIMARY KEY (`id`),
  KEY `fk_ward` (`fk_ward`),
  CONSTRAINT `re_location_ibfk_1` FOREIGN KEY (`fk_ward`) REFERENCES `re_ward` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_location` */

insert  into `re_location`(`id`,`fk_ward`,`location_name`,`location_desc`) values (1,1,'Hospital','sasas');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup` */

insert  into `re_lookup`(`id`,`_key`,`_value`,`category`,`_order`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'1','Bed Sitter',1,NULL,1,NULL,NULL,NULL,NULL),(2,'2','Single Room',1,NULL,1,NULL,NULL,NULL,NULL),(3,'3','One Bedroom',1,NULL,1,NULL,NULL,NULL,NULL),(4,'0','Off',3,NULL,1,NULL,NULL,NULL,NULL),(5,'1','On',3,NULL,1,NULL,NULL,NULL,NULL),(6,'Owner','Owner',2,NULL,1,NULL,NULL,NULL,NULL),(7,'Agent','Agent',2,NULL,1,NULL,NULL,NULL,NULL);

/*Table structure for table `re_lookup_category` */

DROP TABLE IF EXISTS `re_lookup_category`;

CREATE TABLE `re_lookup_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `re_lookup_category` */

insert  into `re_lookup_category`(`id`,`category_name`) values (1,'Property Type'),(2,'Management Type'),(3,'Status');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_management` */

/*Table structure for table `re_migration` */

DROP TABLE IF EXISTS `re_migration`;

CREATE TABLE `re_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `re_migration` */

insert  into `re_migration`(`version`,`apply_time`) values ('m000000_000000_base',1470310525),('m160804_111210_create_re_advert',1470316669),('m160804_114001_create_re_advert_feature',1470316669),('m160804_122926_create_re_blog',1470316669),('m160804_132327_create_re_county',1470317089),('m160804_132519_create_re_estate',1470317304),('m160804_133259_create_re_feature',1470317662),('m160804_133520_create_re_group',1470317928),('m160804_133926_create_re_location',1470318057),('m160804_134146_create_re_lookup',1470318261),('m160804_134448_create_re_lookup_category',1470318347),('m160804_135008_create_re_management',1470318896),('m160804_135535_create_re_occupancy',1470319127),('m160804_135947_create_re_occupancy_issue',1470319657),('m160804_135957_create_re_occupancy_rent',1470319657),('m160804_140005_create_re_occupancy_term',1470319657),('m160804_140956_create_re_ward',1470319873),('m160804_141149_create_re_term',1470319992),('m160804_170816_create_re_tenant',1470330620),('m160804_195241_create_re_tenant_preference',1470341597),('m160804_195553_create_re_tenant_favourite',1470341597),('m160804_195829_create_sys_users',1470341597),('m160804_201354_create_re_subcounty',1470342169),('m160804_201430_create_re_sub_location',1470342169),('m160804_201936_create_re_preference',1470342169),('m160804_202434_create_re_property',1470343911),('m160804_202446_create_re_property_area',1470343911),('m160804_202505_create_re_property_feature',1470343911),('m160804_202517_create_re_property_feature_image',1470343911),('m160804_202532_create_re_property_sublet',1470343911),('m160804_202550_create_re_property_term',1470343911);

/*Table structure for table `re_occupancy` */

DROP TABLE IF EXISTS `re_occupancy`;

CREATE TABLE `re_occupancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_sublet_id` int(11) DEFAULT NULL,
  `fk_tenant_id` int(11) DEFAULT NULL,
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
  KEY `fk_tenant_id` (`fk_tenant_id`),
  CONSTRAINT `re_occupancy_ibfk_1` FOREIGN KEY (`fk_property_id`) REFERENCES `re_property` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_ibfk_2` FOREIGN KEY (`fk_sublet_id`) REFERENCES `re_property_sublet` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_occupancy_ibfk_3` FOREIGN KEY (`fk_tenant_id`) REFERENCES `re_tenant` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy` */

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

/*Table structure for table `re_occupancy_rent` */

DROP TABLE IF EXISTS `re_occupancy_rent`;

CREATE TABLE `re_occupancy_rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `pay_rent_due` varchar(200) DEFAULT NULL,
  `balance_due` double DEFAULT NULL,
  `_status` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_occupancy_id` (`fk_occupancy_id`),
  CONSTRAINT `re_occupancy_rent_ibfk_1` FOREIGN KEY (`fk_occupancy_id`) REFERENCES `re_occupancy` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_rent` */

/*Table structure for table `re_occupancy_term` */

DROP TABLE IF EXISTS `re_occupancy_term`;

CREATE TABLE `re_occupancy_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_occupancy_id` int(11) DEFAULT NULL,
  `fk_property_term_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_occupancy_term` */

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
  `property_location` text,
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
  CONSTRAINT `re_property_ibfk_1` FOREIGN KEY (`management_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `re_property_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `sys_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_property` */

insert  into `re_property`(`id`,`property_name`,`property_desc`,`property_location`,`property_type`,`management_id`,`owner_id`,`property_video_url`,`_status`,`date_created`,`created_by`,`date_modified`,`modified_by`) values (1,'Test','asasasa','asasasa',1,NULL,NULL,'',1,NULL,NULL,NULL,NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_property_feature` */

/*Table structure for table `re_property_feature_image` */

DROP TABLE IF EXISTS `re_property_feature_image`;

CREATE TABLE `re_property_feature_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_feature_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_property_sublet` */

/*Table structure for table `re_property_term` */

DROP TABLE IF EXISTS `re_property_term`;

CREATE TABLE `re_property_term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_property_id` int(11) DEFAULT NULL,
  `fk_term_id` int(11) DEFAULT NULL,
  `term_title` varchar(200) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_property_term` */

/*Table structure for table `re_sub_location` */

DROP TABLE IF EXISTS `re_sub_location`;

CREATE TABLE `re_sub_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_location` int(11) DEFAULT NULL,
  `sub_loc_name` varchar(200) DEFAULT NULL,
  `sub_loc_desc` text,
  PRIMARY KEY (`id`),
  KEY `fk_location` (`fk_location`),
  CONSTRAINT `re_sub_location_ibfk_1` FOREIGN KEY (`fk_location`) REFERENCES `re_location` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `re_sub_location` */

insert  into `re_sub_location`(`id`,`fk_location`,`sub_loc_name`,`sub_loc_desc`) values (1,1,'Mabirikani','assaasa');

/*Table structure for table `re_subcounty` */

DROP TABLE IF EXISTS `re_subcounty`;

CREATE TABLE `re_subcounty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_county` int(11) DEFAULT NULL,
  `subcounty_name` varchar(200) DEFAULT NULL,
  `subcounty_desc` text,
  PRIMARY KEY (`id`),
  KEY `fk_county` (`fk_county`),
  CONSTRAINT `re_subcounty_ibfk_1` FOREIGN KEY (`fk_county`) REFERENCES `re_county` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `re_subcounty` */

insert  into `re_subcounty`(`id`,`fk_county`,`subcounty_name`,`subcounty_desc`) values (1,1,'Kilifi North','assas'),(2,1,'Kilifi South','asasa');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `re_term` */

/*Table structure for table `re_ward` */

DROP TABLE IF EXISTS `re_ward`;

CREATE TABLE `re_ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_subcounty` int(11) DEFAULT NULL,
  `ward_name` varchar(200) DEFAULT NULL,
  `ward_desc` text,
  PRIMARY KEY (`id`),
  KEY `fk_subcounty` (`fk_subcounty`),
  CONSTRAINT `re_ward_ibfk_1` FOREIGN KEY (`fk_subcounty`) REFERENCES `re_subcounty` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `re_ward` */

insert  into `re_ward`(`id`,`fk_subcounty`,`ward_name`,`ward_desc`) values (1,2,'Sokoni','sasa'),(2,1,'Mnarani','asasasa');

/*Table structure for table `sys_users` */

DROP TABLE IF EXISTS `sys_users`;

CREATE TABLE `sys_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_group_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `name1` varchar(200) DEFAULT NULL,
  `name2` varchar(200) DEFAULT NULL,
  `name3` varchar(200) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` text,
  `date_added` datetime DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `color_code` varchar(100) DEFAULT NULL,
  `icon_id` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`),
  KEY `fk_group_id` (`fk_group_id`),
  CONSTRAINT `sys_users_ibfk_1` FOREIGN KEY (`fk_group_id`) REFERENCES `re_group` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sys_users` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
