-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.17-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema db_asianland
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ db_asianland;
USE db_asianland;

--
-- Table structure for table `db_asianland`.`ref_account_info`
--

DROP TABLE IF EXISTS `ref_account_info`;
CREATE TABLE `ref_account_info` (
  `AccountInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` int(11) NOT NULL,
  `AccountPicture` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  PRIMARY KEY (`AccountInfoID`),
  KEY `account_info_id` (`AccountInfoID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`ref_account_info`
--

/*!40000 ALTER TABLE `ref_account_info` DISABLE KEYS */;
INSERT INTO `ref_account_info` (`AccountInfoID`,`AccountID`,`AccountPicture`,`FirstName`,`LastName`) VALUES 
 (1,1,'1.jpg','Dayne','Banzon'),
 (2,2,'2.jpg','John','Doe'),
 (3,3,'3.jpg','Johann','Merle');
/*!40000 ALTER TABLE `ref_account_info` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`ref_account_type`
--

DROP TABLE IF EXISTS `ref_account_type`;
CREATE TABLE `ref_account_type` (
  `AccountTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountType` varchar(255) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`AccountTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`ref_account_type`
--

/*!40000 ALTER TABLE `ref_account_type` DISABLE KEYS */;
INSERT INTO `ref_account_type` (`AccountTypeID`,`AccountType`,`DateCreated`) VALUES 
 (1,'Developer','2015-08-11 16:38:25'),
 (2,'Administrator','2015-08-11 16:38:25'),
 (3,'Moderator','2015-08-11 16:38:34');
/*!40000 ALTER TABLE `ref_account_type` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`ref_support_comment`
--

DROP TABLE IF EXISTS `ref_support_comment`;
CREATE TABLE `ref_support_comment` (
  `SupportCommentID` int(11) NOT NULL AUTO_INCREMENT,
  `SupportID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `Message` text NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SupportCommentID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`ref_support_comment`
--

/*!40000 ALTER TABLE `ref_support_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `ref_support_comment` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_about`
--

DROP TABLE IF EXISTS `tbl_about`;
CREATE TABLE `tbl_about` (
  `AboutID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MainTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Image1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`AboutID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_about`
--

/*!40000 ALTER TABLE `tbl_about` DISABLE KEYS */;
INSERT INTO `tbl_about` (`AboutID`,`MainTitle`,`Description`,`Image1`,`Image2`,`Image3`,`Image4`,`Image5`,`DateCreated`,`DateModified`) VALUES 
 (1,'Land is a Lifetime Investment','<p style=\"line-height: 17.1429px;\"><span style=\"line-height: 17.1429px;\">Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in.Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dola</span><br></p>','image-0156a9a4bddd57d.jpg','image-0256a9a54789caf.jpg','image-0356a9a55a3e561.jpg','image-0456a9a5658991d.jpg','image-0556a9a565959be.jpg','2015-11-04 11:14:23','2016-02-19 18:36:41');
/*!40000 ALTER TABLE `tbl_about` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_account`
--

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE `tbl_account` (
  `AccountID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountTypeID` int(11) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `SessionID` varchar(255) NOT NULL,
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AccountID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`tbl_account`
--

/*!40000 ALTER TABLE `tbl_account` DISABLE KEYS */;
INSERT INTO `tbl_account` (`AccountID`,`AccountTypeID`,`EmailAddress`,`Password`,`SessionID`,`DateModified`,`DateCreated`) VALUES 
 (1,1,'designblueac@gmail.com','21232f297a57a5a743894a0e4a801fc3','1c171c9e23b5bc331abe26fa71f3d0fe','2016-03-17 13:36:54','2015-08-12 18:36:42'),
 (2,2,'johndoe@gmail.com','21232f297a57a5a743894a0e4a801fc3','feedc18b5756d8906c1e6f68727fb91d','2015-08-13 04:53:27','2015-08-13 03:16:50'),
 (3,1,'johann.dbmanila@gmail.com','ef6f4f71613915829cba79f76fadbc03','1d62730ac27c419cc3e82c24fd0bfd22','2016-02-03 14:41:08','2015-11-03 15:56:58');
/*!40000 ALTER TABLE `tbl_account` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_careers`
--

DROP TABLE IF EXISTS `tbl_careers`;
CREATE TABLE `tbl_careers` (
  `CareerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Position` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Responsibilities` text COLLATE utf8_unicode_ci NOT NULL,
  `Requirements` text COLLATE utf8_unicode_ci NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`CareerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_careers`
--

/*!40000 ALTER TABLE `tbl_careers` DISABLE KEYS */;
INSERT INTO `tbl_careers` (`CareerID`,`Position`,`Responsibilities`,`Requirements`,`DateCreated`,`DateModified`,`Status`) VALUES 
 (1,'Project Manager','<div><ul style=\"line-height: 17.1429px;\"><li>Supervise all land development projects and subdivision amenities</li><li>Coordinate with Technical Design Division regarding discrepancies on working plan and during construction.</li><li>Monitor all on going construction (private and in house construction) and prepare reports for back out units and units for turn over.</li></ul></div>','<ul>\r\n	<li>\r\n		Licensed Male Civil Engineer</li>\r\n	<li>\r\n		Not more than 35 years old, with Driver’s License</li>\r\n	<li>\r\n		Willing to work overtime with minimal supervision</li>\r\n	<li>\r\n		Willing to be assigned in different projects</li>\r\n	<li>\r\n		Hardworking and trustworthy</li>\r\n	<li>\r\n		With at least 1 year experience as Field Engineer</li>\r\n</ul>\r\n','2015-11-02 00:00:00','2016-02-19 18:30:39',0),
 (2,'Manager','<ul>\r\n	<li>\r\n		Supervise all land development projects and subdivision amenities</li>\r\n	<li>\r\n		Coordinate with Technical Design Division regarding discrepancies on working plan and during construction.</li>\r\n	<li>\r\n		Monitor all on going construction (private and in house construction) and prepare reports for back out units and units for turn over.</li>\r\n</ul>\r\n','<ul>\r\n	<li>\r\n		Licensed Male Civil Engineer</li>\r\n	<li>\r\n		Not more than 35 years old, with Driver&rsquo;s License</li>\r\n	<li>\r\n		Willing to work overtime with minimal supervision</li>\r\n	<li>\r\n		Willing to be assigned in different projects</li>\r\n	<li>\r\n		Hardworking and trustworthy</li>\r\n	<li>\r\n		With at least 1 year experience as Field Engineer</li>\r\n</ul>\r\n','2015-11-02 00:00:00','2015-11-11 10:52:00',0),
 (3,'Project Supervisor','<ul>\r\n	<li>\r\n		Supervise all land development projects and subdivision amenities</li>\r\n	<li>\r\n		Coordinate with Technical Design Division regarding discrepancies on working plan and during construction.</li>\r\n	<li>\r\n		Monitor all on going construction (private and in house construction) and prepare reports for back out units and units for turn over.</li>\r\n</ul>\r\n','<ul>\r\n	<li>\r\n		Licensed Male Civil Engineer</li>\r\n	<li>\r\n		Not more than 35 years old, with Driver&rsquo;s License</li>\r\n	<li>\r\n		Willing to work overtime with minimal supervision</li>\r\n	<li>\r\n		Willing to be assigned in different projects</li>\r\n	<li>\r\n		Hardworking and trustworthy</li>\r\n	<li>\r\n		With at least 1 year experience as Field Engineer</li>\r\n</ul>\r\n','2015-11-02 11:22:38','2015-11-11 10:50:59',0);
INSERT INTO `tbl_careers` (`CareerID`,`Position`,`Responsibilities`,`Requirements`,`DateCreated`,`DateModified`,`Status`) VALUES 
 (4,'Sales Expert','<ul>\r\n	<li>\r\n		Supervise all land development projects and subdivision amenities</li>\r\n	<li>\r\n		Coordinate with Technical Design Division regarding discrepancies on working plan and during construction.</li>\r\n	<li>\r\n		Monitor all on going construction (private and in house construction) and prepare reports for back out units and units for turn over.</li>\r\n</ul>\r\n','<ul>\r\n	<li>\r\n		Licensed Male Civil Engineer</li>\r\n	<li>\r\n		Not more than 35 years old, with Driver&rsquo;s License</li>\r\n	<li>\r\n		Willing to work overtime with minimal supervision</li>\r\n	<li>\r\n		Willing to be assigned in different projects</li>\r\n	<li>\r\n		Hardworking and trustworthy</li>\r\n	<li>\r\n		With at least 1 year experience as Field Engineer</li>\r\n</ul>\r\n','2015-11-02 11:56:04','2015-11-11 10:51:53',0),
 (5,'Property Consultant','<ul>\r\n	<li>\r\n		Supervise all land development projects and subdivision amenities</li>\r\n	<li>\r\n		Coordinate with Technical Design Division regarding discrepancies on working plan and during construction.</li>\r\n	<li>\r\n		Monitor all on going construction (private and in house construction) and prepare reports for back out units and units for turn over.</li>\r\n</ul>\r\n','<ul>\r\n	<li>\r\n		Licensed Male Civil Engineer</li>\r\n	<li>\r\n		Not more than 35 years old, with Driver&rsquo;s License</li>\r\n	<li>\r\n		Willing to work overtime with minimal supervision</li>\r\n	<li>\r\n		Willing to be assigned in different projects</li>\r\n	<li>\r\n		Hardworking and trustworthy</li>\r\n	<li>\r\n		With at least 1 year experience as Field Engineer</li>\r\n</ul>\r\n','2015-11-02 11:58:22','2016-01-14 16:47:47',1);
/*!40000 ALTER TABLE `tbl_careers` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_community`
--

DROP TABLE IF EXISTS `tbl_community`;
CREATE TABLE `tbl_community` (
  `CommunityID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `Description` text CHARACTER SET latin1 NOT NULL,
  `Amenities` text CHARACTER SET latin1 NOT NULL,
  `Latitude` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Longtitude` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Logo1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Logo2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ThumbBanner` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SubBanner1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SubBanner2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DateCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` datetime NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ResidencesName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`CommunityID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_community`
--

/*!40000 ALTER TABLE `tbl_community` DISABLE KEYS */;
INSERT INTO `tbl_community` (`CommunityID`,`Name`,`Description`,`Amenities`,`Latitude`,`Longtitude`,`Logo1`,`Logo2`,`Banner`,`ThumbBanner`,`SubBanner1`,`SubBanner2`,`DateCreated`,`DateModified`,`Status`,`ResidencesName`) VALUES 
 (1,'Grand Royale','<p>\r\n	Come home to Asian Land\'s most expansive project, where nature and architecture merge into the ultimate abode.</p>\r\n','<ul>	<li>		A well planned community</li>	<li>		Wide Landscaped entrance</li>	<li>		Multi-purpose clubhouse</li>	<li>		Bicycle lane/jogging lane</li>	<li>		Swimming pool with Picnic Area Parks and Playground</li>	<li>		Basketball court</li>	<li>		Volleyball court</li>	<li>		Chapel</li>	<li>		24-hour security service</li>	<li>		24-hour transportation facilities</li>	<li>		Medical clinic with ambulance</li>	<li>		Fire alarm system</li>	<li>		Fire Station Perimeter Fence</li>	<li>		Wide concrete road networks</li>	<li>		Concrete curbs and gutters</li>	<li>		Concrete sidewalks</li>	<li>		Centralized and Adequate water system</li>	<li>		Elevated water tank</li>	<li>		Underground drainage and waterline system</li>	<li>		Complete electrical facilities</li></ul>','14.8675458','120.8026691','logo-img-1.png','logo-img2-1.png','banner-img-1.jpg','thumb-banner-img-1.jpg','sub-banner1-1.jpg','sub-banner2-1.jpg','2015-11-05 00:00:00','2016-02-24 14:12:42',0,'The Residences'),
 (2,'Dream Crest','<p>\r\n	Transform the dream of your ideal-size home into a tangible reality. Create the perfect household with aptly sized spaces for your starting family.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-2.png','logo-img2-2.png','banner-img-2.jpg','thumb-banner-img-2.jpg','sub-banner1-2.jpg','sub-banner2-2.jpg','2015-11-06 11:24:26','2016-01-25 15:10:48',0,'The Residences');
INSERT INTO `tbl_community` (`CommunityID`,`Name`,`Description`,`Amenities`,`Latitude`,`Longtitude`,`Logo1`,`Logo2`,`Banner`,`ThumbBanner`,`SubBanner1`,`SubBanner2`,`DateCreated`,`DateModified`,`Status`,`ResidencesName`) VALUES 
 (3,'Woodlands','<p>\r\n	Escape from the everyday hustle and bustle in contemporary and cabin-style houses nestled at the heart of the city, where a serene community is a place you call home.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-3.png','logo-img2-3.png','banner-img-3.jpg','thumb-banner-img-3.jpg','sub-banner1-3.jpg','sub-banner2-3.jpg','2015-11-06 11:42:39','2016-01-25 15:11:20',0,'0'),
 (4,'The Meadows','<p>\r\n	Be instantly charmed by these exquisite American-style suburban houses, within an exclusive location of picturesque views, vast landscapes and rolling hills.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-4.png','logo-img2-4.png','banner-img-4.jpg','thumb-banner-img-4.jpg','sub-banner1-4.jpg','sub-banner2-4.jpg','2015-11-06 14:51:51','2016-01-25 15:11:50',0,'0');
INSERT INTO `tbl_community` (`CommunityID`,`Name`,`Description`,`Amenities`,`Latitude`,`Longtitude`,`Logo1`,`Logo2`,`Banner`,`ThumbBanner`,`SubBanner1`,`SubBanner2`,`DateCreated`,`DateModified`,`Status`,`ResidencesName`) VALUES 
 (5,'Casa Bueña','<p>\r\n	Get swept away by the elegance of Spanish inspired architecture in this exceptional home design, especially created for those with discerning tastes.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-5.png','logo-img2-5.png','banner-img-5.jpg','thumb-banner-img-5.jpg','sub-banner1-5.jpg','sub-banner2-5.jpg','2015-11-06 15:28:20','2016-01-25 15:12:09',0,'Casa Buena Residences'),
 (6,'The Villas','<p>\r\n	Retreat to a hidden sanctuary where we put a high premium on exclusivity. In this distinct location, your privacy is our utmost priority.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-6.png','logo-img2-6.png','banner-img-6.jpg','thumb-banner-img-6.jpg','sub-banner1-6.jpg','sub-banner2-6.jpg','2015-11-06 15:46:37','2016-01-25 15:12:27',0,'0');
INSERT INTO `tbl_community` (`CommunityID`,`Name`,`Description`,`Amenities`,`Latitude`,`Longtitude`,`Logo1`,`Logo2`,`Banner`,`ThumbBanner`,`SubBanner1`,`SubBanner2`,`DateCreated`,`DateModified`,`Status`,`ResidencesName`) VALUES 
 (7,'Casa Royale','<p>\r\n	Enjoy the convenience of being rent-free at an economical cost, and elevate your living standards without compromising comfort, quality and practicality.</p>\r\n','<ul>\r\n	<li>\r\n		A well planned community</li>\r\n	<li>\r\n		Wide Landscaped entrance</li>\r\n	<li>\r\n		Multi-purpose clubhouse</li>\r\n	<li>\r\n		Bicycle lane/jogging lane</li>\r\n	<li>\r\n		Swimming pool with Picnic Area Parks and Playground</li>\r\n	<li>\r\n		Basketball court</li>\r\n	<li>\r\n		Volleyball court</li>\r\n	<li>\r\n		Chapel</li>\r\n	<li>\r\n		24-hour security service</li>\r\n	<li>\r\n		24-hour transportation facilities</li>\r\n	<li>\r\n		Medical clinic with ambulance</li>\r\n	<li>\r\n		Fire alarm system</li>\r\n	<li>\r\n		Fire Station Perimeter Fence</li>\r\n	<li>\r\n		Wide concrete road networks</li>\r\n	<li>\r\n		Concrete curbs and gutters</li>\r\n	<li>\r\n		Concrete sidewalks</li>\r\n	<li>\r\n		Centralized and Adequate water system</li>\r\n	<li>\r\n		Elevated water tank</li>\r\n	<li>\r\n		Underground drainage and waterline system</li>\r\n	<li>\r\n		Complete electrical facilities</li>\r\n</ul>\r\n','14.8675458','120.8026691','logo-img-7.png','logo-img2-7.png','banner-img-7.jpg','thumb-banner-img-7.jpg','sub-banner1-7.jpg','sub-banner2-7.jpg','2015-11-06 16:42:45','2016-01-25 15:12:50',0,'0');
/*!40000 ALTER TABLE `tbl_community` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_contents`
--

DROP TABLE IF EXISTS `tbl_contents`;
CREATE TABLE `tbl_contents` (
  `ContentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ContentCode` text COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ContentID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_contents`
--

/*!40000 ALTER TABLE `tbl_contents` DISABLE KEYS */;
INSERT INTO `tbl_contents` (`ContentID`,`ContentCode`,`Content`,`DateModified`) VALUES 
 (1,'project_content','Temporio et venihil ipiet officipsum eum aut lant et as si acestruptas excest, sus dolorem et faccaborum que volest faccullupti re praecum inte nis et la dit faccaeri autemporrum vel illest ve illest.','2016-02-19 18:33:03'),
 (2,'careers_content','What better way to contribute to your fellow Filipino than by helping them find their ideal home? Asian Land is looking for You! If you’d like to be part of our team, fill up the application form below or email us at personnel@asianland.com.ph<br>','2016-02-19 18:19:15'),
 (3,'contact_content','<p><span style=\"line-height: 17.1429px;\">Have you seen your dream unit? Haven’t decided on a bungalow or two-storey house? If you have any concerns or follow up questions on you previous inquiries, you can reach out to us by filling up the form below.</span><br></p>','2016-02-19 18:15:55'),
 (4,'bulacan_content','<p><span style=\"font-weight: bold;\">Asian Land Corporate Center:</span></p><p>Grand Royale Subdivision, Bulihan, Malolos City, Bulacan, Philippines</p><p><br></p><p><span style=\"font-weight: bold;\">Telephone Numbers:</span></p><p>+63-44-791-2508 / +63-44-791-2509 / +63-44-791-5537</p><p><br></p><p><span style=\"font-weight: bold;\">Fax Number:</span></p><p>+63-44-791-5539</p>','2016-02-19 18:15:55'),
 (5,'caloocan_content','<p><span style=\"font-weight: bold;\">Asian Land Branch Office:</span></p><p>No. 490, EDSA, Barangay 95, Zone 9, District 2, Caloocan City, Philippines</p><p><br></p><p><span style=\"font-weight: bold;\">Telephone Numbers:</span></p><p>+63-2-365-6812 / +63-2-362-2297 / +63-2-364-4227</p><p><span style=\"line-height: 1.42857;\">+63-2-365-4174 / +63-2-365-4380 / +63-2-366-8850</span></p><p><span style=\"line-height: 1.42857;\"><br></span></p><p><span style=\"line-height: 1.42857;\"><span style=\"font-weight: bold;\">Fax Number:</span></span></p><p><span style=\"line-height: 1.42857;\">+63-2-362-1462</span></p><p><span style=\"line-height: 1.42857;\"><br></span></p><p><span style=\"line-height: 1.42857;\"><span style=\"font-weight: bold;\">Email:</span></span></p><p><span style=\"line-height: 1.42857;\">marketing@asianland.com.ph</span></p>','2016-02-19 18:15:55');
/*!40000 ALTER TABLE `tbl_contents` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_gallery`
--

DROP TABLE IF EXISTS `tbl_gallery`;
CREATE TABLE `tbl_gallery` (
  `GalleryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CommunityID` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`GalleryID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`tbl_gallery`
--

/*!40000 ALTER TABLE `tbl_gallery` DISABLE KEYS */;
INSERT INTO `tbl_gallery` (`GalleryID`,`Name`,`DateCreated`,`CommunityID`) VALUES 
 (1,'para-1.jpg','2015-11-10 15:51:07',1),
 (2,'para-2.jpg','2015-11-10 15:51:14',2),
 (3,'para-3.jpg','2015-11-10 15:51:21',3),
 (4,'para-7.jpg','2015-11-10 15:51:28',7),
 (5,'para-4.jpg','2015-11-10 15:51:37',4),
 (6,'para-5.jpg','2015-11-10 15:51:47',5),
 (7,'para-6.jpg','2015-11-10 15:51:53',6),
 (8,'para-21.jpg','2015-11-10 17:19:48',2),
 (9,'para-11.jpg','2015-11-10 17:20:33',1),
 (10,'thumb1-img.jpg','2016-01-25 18:58:06',1),
 (11,'thumb1-img1.jpg','2016-01-25 19:14:31',1);
/*!40000 ALTER TABLE `tbl_gallery` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_houses`
--

DROP TABLE IF EXISTS `tbl_houses`;
CREATE TABLE `tbl_houses` (
  `HouseID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CommunityID` int(10) unsigned NOT NULL DEFAULT '0',
  `Type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1- Model Houses, 2 - Residences',
  `ModelName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ModelDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `EstimatedPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Classification` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FloorArea` decimal(5,2) NOT NULL DEFAULT '0.00',
  `Bedroom` int(10) unsigned NOT NULL DEFAULT '0',
  `Bath` int(10) unsigned NOT NULL DEFAULT '0',
  `Image1` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image2` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image3` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image4` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image5` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image6` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `LotArea` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`HouseID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_houses`
--

/*!40000 ALTER TABLE `tbl_houses` DISABLE KEYS */;
INSERT INTO `tbl_houses` (`HouseID`,`CommunityID`,`Type`,`ModelName`,`ModelDescription`,`Location`,`EstimatedPrice`,`Classification`,`FloorArea`,`Bedroom`,`Bath`,`Image1`,`Image2`,`Image3`,`Image4`,`Image5`,`Image6`,`DateCreated`,`DateModified`,`Status`,`LotArea`) VALUES 
 (1,1,1,'Casa Amanda','Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in Peruptatur mossum remped magni officab is estrunt eliam aliquiassi tecturi con poris prem porumeturiNam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in Peruptatur mossum remped magni officab is estrunt eliam aliquiassi tecturi con poris prem porumeturialore nam ataa','1','4000000.00','Two-Storey','134.00',0,3,'house-img1-1.jpg','house-img2-1.jpg','house-img3-1.jpg','house-img4-1.jpg','house-img5-1.jpg','house-img6-1.jpg','2016-01-25 15:21:51','2016-02-19 18:45:49',0,'132.00'),
 (2,1,1,'Casa Amor','Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in Peruptatur mossum remped magni officab is estrunt eliam aliquiassi tecturi con poris prem porumeturi','2','3000000.00','Two-Storey','117.53',4,3,'house-img1-2.jpg','house-img2-2.jpg','house-img3-2.jpg','house-img4-2.jpg','house-img5-2.jpg','house-img6-2.jpg','2016-01-25 15:23:09','2016-01-25 15:44:21',0,'120.00');
INSERT INTO `tbl_houses` (`HouseID`,`CommunityID`,`Type`,`ModelName`,`ModelDescription`,`Location`,`EstimatedPrice`,`Classification`,`FloorArea`,`Bedroom`,`Bath`,`Image1`,`Image2`,`Image3`,`Image4`,`Image5`,`Image6`,`DateCreated`,`DateModified`,`Status`,`LotArea`) VALUES 
 (3,1,1,'Casa Consuelo','Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in Peruptatur mossum remped magni officab is estrunt eliam aliquiassi tecturi con poris prem porumeturi','3','3000000.00','Two-Storey','84.00',4,2,'house-img1-3.jpg','house-img2-3.jpg','house-img3-3.jpg','house-img4-3.jpg','house-img5-3.jpg','house-img6-3.jpg','2016-01-25 15:24:25','2016-01-25 15:44:36',0,'96.00'),
 (4,1,2,'Casa Cristina','Nam quatibus quia vellaut harum iur, sum, seque ducillo comnisto in re prore nis eum faccum im alique dolupti orpossin non nia ducieni aspicient ut rem lanimaio. Biscias voloresequam int. Solorem cumquodit landaepudam dolupti dolore dollitiis asite autatem quaspel istecatempel ium, si di niminct usdamet volore nam atiis aspisimus autem quunt.Acius suntur, evenderi velitas et rem vid ulla in Peruptatur mossum remped magni officab is estrunt eliam aliquiassi tecturi con poris prem porumeturi','3','5000000.00','Bungalow','51.00',3,1,'house-img1-4.jpg','house-img2-4.jpg','house-img3-4.jpg','house-img4-4.jpg','house-img5-4.jpg','house-img6-4.jpg','2016-01-25 15:25:52','2016-01-25 15:44:45',0,'96.00');
/*!40000 ALTER TABLE `tbl_houses` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE `tbl_location` (
  `LocationID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `LocationName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`LocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_location`
--

/*!40000 ALTER TABLE `tbl_location` DISABLE KEYS */;
INSERT INTO `tbl_location` (`LocationID`,`LocationName`) VALUES 
 (1,'Malolos, Bulacan'),
 (2,'Pulilan, Bulacan'),
 (3,'San Ildefonso, Bulacan');
/*!40000 ALTER TABLE `tbl_location` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_news_events`
--

DROP TABLE IF EXISTS `tbl_news_events`;
CREATE TABLE `tbl_news_events` (
  `NewsID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Schedule` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Location` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `Banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `ThumbBanner` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`NewsID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_news_events`
--

/*!40000 ALTER TABLE `tbl_news_events` DISABLE KEYS */;
INSERT INTO `tbl_news_events` (`NewsID`,`Title`,`Schedule`,`Location`,`Description`,`DateCreated`,`DateModified`,`Status`,`Banner`,`ThumbBanner`) VALUES 
 (1,'News 1','November 12, 2015','La Consolacion University','<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n','2015-11-03 17:06:05','2015-11-12 11:03:51',0,'banner-img-1.jpg','thumb-banner-img-1.jpg'),
 (2,'News 2','December 24, 2015','BGC','<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n','2015-11-10 13:13:57','2015-11-12 11:04:01',0,'banner-img-2.jpg','thumb-banner-img-2.jpg');
INSERT INTO `tbl_news_events` (`NewsID`,`Title`,`Schedule`,`Location`,`Description`,`DateCreated`,`DateModified`,`Status`,`Banner`,`ThumbBanner`) VALUES 
 (3,'News 3','December 8, 2015','Makati','<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n','2015-11-10 13:14:14','2015-11-12 11:04:07',0,'banner-img-3.jpg','thumb-banner-img-3.jpg'),
 (4,'News 4','November 30, 2015','SM NorthEdsa','<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n','2015-11-10 13:33:01','2015-11-12 11:04:13',0,'banner-img-4.jpg','thumb-banner-img-4.jpg');
INSERT INTO `tbl_news_events` (`NewsID`,`Title`,`Schedule`,`Location`,`Description`,`DateCreated`,`DateModified`,`Status`,`Banner`,`ThumbBanner`) VALUES 
 (5,'News 5','December 30, 2015','SM Mall of Asia','<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>\r\n','2015-11-10 14:03:18','2015-11-12 11:04:19',0,'banner-img-5.jpg','thumb-banner-img-5.jpg'),
 (6,'News 1',NULL,'South GMA','<div style=\"line-height: 17.1429px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div><div style=\"line-height: 17.1429px;\">&nbsp;</div><div style=\"line-height: 17.1429px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>','2016-02-24 14:55:17','2016-02-24 14:55:17',0,'banner-img-6.jpg','thumb-banner-img-6.jpg');
INSERT INTO `tbl_news_events` (`NewsID`,`Title`,`Schedule`,`Location`,`Description`,`DateCreated`,`DateModified`,`Status`,`Banner`,`ThumbBanner`) VALUES 
 (7,'Paying is easy',NULL,'South GMA','<div style=\"line-height: 17.1429px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div><div style=\"line-height: 17.1429px;\">&nbsp;</div><div style=\"line-height: 17.1429px;\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</div>','2016-02-24 14:57:29','2016-02-24 14:57:29',0,'banner-img-7.jpg','thumb-banner-img-7.jpg');
/*!40000 ALTER TABLE `tbl_news_events` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_newsletters`
--

DROP TABLE IF EXISTS `tbl_newsletters`;
CREATE TABLE `tbl_newsletters` (
  `NewsletterID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Message` text COLLATE utf8_unicode_ci NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `DateSent` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`NewsletterID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_newsletters`
--

/*!40000 ALTER TABLE `tbl_newsletters` DISABLE KEYS */;
INSERT INTO `tbl_newsletters` (`NewsletterID`,`Subject`,`Message`,`DateCreated`,`DateModified`,`DateSent`,`Status`) VALUES 
 (1,'Welcome','<p>\r\n	Welcome to Asianland!</p>\r\n<p>\r\n	&nbsp;</p>\r\n','2015-11-05 11:16:02','2015-11-12 11:16:02','2015-11-12 14:51:32',1),
 (2,'Announcement','<p>\r\n	Important Announcement to all subscribers.</p>\r\n','2015-11-05 14:57:23','2015-11-05 15:00:11','2015-12-07 11:04:16',1),
 (3,'Announcement','Important Announcement to all subscribers.','2016-01-18 17:11:59','2016-01-18 17:11:59','2016-02-29 12:25:07',1);
/*!40000 ALTER TABLE `tbl_newsletters` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_pages`
--

DROP TABLE IF EXISTS `tbl_pages`;
CREATE TABLE `tbl_pages` (
  `PageID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Page` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DateModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`PageID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_pages`
--

/*!40000 ALTER TABLE `tbl_pages` DISABLE KEYS */;
INSERT INTO `tbl_pages` (`PageID`,`Page`,`Image`,`DateModified`,`Description`) VALUES 
 (1,'Careers','career-img.jpg','2016-01-25 14:03:10',''),
 (2,'News','news-img.jpg','2016-01-25 13:54:20',''),
 (3,'About','about-img.jpg','2016-01-25 14:08:15',''),
 (4,'Contact','contact-img.jpg','2016-01-25 12:49:35',''),
 (5,'Property Finder','property-img56c535debef2e.jpg','2016-02-19 18:11:58','Choose among our variety of model houses.'),
 (6,'Newsletters','newsletter-img56a5fbf2843d0.jpg','2016-02-19 18:11:09','Subscribe to our newsletter to get the latest news and updates from Asian Land.');
/*!40000 ALTER TABLE `tbl_pages` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_subscribers`
--

DROP TABLE IF EXISTS `tbl_subscribers`;
CREATE TABLE `tbl_subscribers` (
  `SubscriberID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`SubscriberID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `db_asianland`.`tbl_subscribers`
--

/*!40000 ALTER TABLE `tbl_subscribers` DISABLE KEYS */;
INSERT INTO `tbl_subscribers` (`SubscriberID`,`Email`,`DateCreated`,`Status`) VALUES 
 (1,'johann.dbmanila@gmail.com','2015-11-16 10:27:40',0),
 (2,'test@email.com','2015-11-16 11:18:09',0),
 (3,'admin@admin.com','2015-11-16 11:18:41',0);
/*!40000 ALTER TABLE `tbl_subscribers` ENABLE KEYS */;


--
-- Table structure for table `db_asianland`.`tbl_support`
--

DROP TABLE IF EXISTS `tbl_support`;
CREATE TABLE `tbl_support` (
  `SupportID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` int(11) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Priority` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Open',
  `DateCreated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastUpdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SupportID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_asianland`.`tbl_support`
--

/*!40000 ALTER TABLE `tbl_support` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_support` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
