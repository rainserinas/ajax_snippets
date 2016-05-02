/*
Navicat MySQL Data Transfer

Source Server         : MY
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : stonecode

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-05-01 20:26:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tbl_audit_log`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_audit_log`;
CREATE TABLE `tbl_audit_log` (
  `log_date` datetime DEFAULT NULL,
  `log_type` varchar(100) DEFAULT NULL,
  `log_file` varchar(100) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_audit_log
-- ----------------------------
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 18:04:24', 'update', 'test|12|2016-04-29 18:03:30|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 20:40:06', 'delete', 'test|12|2016-04-29 18:03:30|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 20:40:06', 'delete', null, 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 20:40:06', 'delete', null, 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 20:42:39', 'delete', 'Hello World|100|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 21:20:18', 'update', '0|Component One|Component one description|0000-00-00 00:00:00|1', 'tbl_product_component', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 22:22:18', 'delete', 'er|46|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 22:22:18', 'delete', '3|er|ew|0000-00-00 00:00:00|1', 'tbl_product_component', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 23:48:49', 'delete', 'Test|345|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 23:48:49', 'delete', '2|erg|ert|0000-00-00 00:00:00|1', 'tbl_product_component', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-04-29 23:48:49', 'delete', '2|Hello Hello|World World|0000-00-00 00:00:00|1', 'tbl_product_component', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:47:29', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:47:54', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:47:58', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:49:44', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:49:49', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:49:55', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:50:02', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:50:06', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:52:36', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:53:15', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:53:19', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:53:29', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:53:42', 'update', 'Hello World|201|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:54:43', 'update', 'Hello World23|201333|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 19:54:48', 'update', 'Hello World23|333|0000-00-00 00:00:00|1', 'tbl_product', '1');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 20:10:40', 'delete', 'Jarrah|54|0000-00-00 00:00:00|3', 'tbl_product', '3');
INSERT INTO `tbl_audit_log` VALUES ('2016-05-01 20:10:40', 'delete', '2|Tes|Tes|0000-00-00 00:00:00|3', 'tbl_product_component', '3');

-- ----------------------------
-- Table structure for `tbl_product`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_code` int(11) DEFAULT NULL,
  `prod_name` varchar(255) DEFAULT NULL,
  `price` decimal(11,0) DEFAULT NULL,
  `insert_date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_deleted` int(5) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product
-- ----------------------------
INSERT INTO `tbl_product` VALUES ('1', '123', 'Hello World23', '4444', '0000-00-00 00:00:00', '1', '0');
INSERT INTO `tbl_product` VALUES ('3', '788', 'Jarrah', '67', '0000-00-00 00:00:00', '3', '0');

-- ----------------------------
-- Table structure for `tbl_product_component`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_product_component`;
CREATE TABLE `tbl_product_component` (
  `prod_cid` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `comp_desc` varchar(255) DEFAULT NULL,
  `insert_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `is_deleted` int(5) DEFAULT NULL,
  PRIMARY KEY (`prod_cid`),
  KEY `prod_id` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_product_component
-- ----------------------------
INSERT INTO `tbl_product_component` VALUES ('1', '1', 'Test Component Name', 'Test Component Desc', '0000-00-00 00:00:00', '1', null);
INSERT INTO `tbl_product_component` VALUES ('4', '1', 'Test 2', 'Test 2', '0000-00-00 00:00:00', '1', null);
INSERT INTO `tbl_product_component` VALUES ('6', '3', 'ERT', 'ERRT', '0000-00-00 00:00:00', '3', null);

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone_number` varbinary(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'raineirserinas@gmail.com', '193213f6b4ef5815b94d47f1358a98eb', 'upload/13081888_1377468268936053_1968826607_n.jpg', 'Raineir John', 'Serinas', 'Cobarrubias', 'Male', 0x313233347C353637387C);
INSERT INTO `tbl_user` VALUES ('2', 'raineirserinas.designblue@gmail.com', '193213f6b4ef5815b94d47f1358a98eb', 'upload/registration page.png', 'Raineir', 'Raineir', 'Raineir', 'Male', 0x313233347C);
INSERT INTO `tbl_user` VALUES ('3', 'jarrahserinas@yahoo.com', '193213f6b4ef5815b94d47f1358a98eb', 'upload/13081888_1377468268936053_1968826607_n.jpg', 'Jarrah', 'Serinas', 'Cobarrubias', 'Female', 0x32333435347C);
DROP TRIGGER IF EXISTS `trigger1`;
DELIMITER ;;
CREATE TRIGGER `trigger1` AFTER UPDATE ON `tbl_product` FOR EACH ROW INSERT INTO tbl_audit_log(log_date,log_type,log_file,table_name,user_id) VALUES(NOW(),'update',concat(old.prod_name,'|',old.price,'|',old.insert_date,'|',old.user_id),'tbl_product',old.user_id)
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger3`;
DELIMITER ;;
CREATE TRIGGER `trigger3` AFTER DELETE ON `tbl_product` FOR EACH ROW INSERT INTO tbl_audit_log(log_date,log_type,log_file,table_name,user_id) VALUES(NOW(),'delete',concat(old.prod_name,'|',old.price,'|',old.insert_date,'|',old.user_id),'tbl_product',old.user_id)
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger2`;
DELIMITER ;;
CREATE TRIGGER `trigger2` AFTER UPDATE ON `tbl_product_component` FOR EACH ROW INSERT INTO tbl_audit_log(log_date,log_type,log_file,table_name,user_id) VALUES(NOW(),'update',concat(old.prod_id,'|',old.comp_name,'|',old.comp_desc,'|',old.insert_date,'|',old.user_id),'tbl_product_component',old.user_id)
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `trigger4`;
DELIMITER ;;
CREATE TRIGGER `trigger4` AFTER DELETE ON `tbl_product_component` FOR EACH ROW INSERT INTO tbl_audit_log(log_date,log_type,log_file,table_name,user_id) VALUES(NOW(),'delete',concat(old.prod_id,'|',old.comp_name,'|',old.comp_desc,'|',old.insert_date,'|',old.user_id),'tbl_product_component',old.user_id)
;;
DELIMITER ;
