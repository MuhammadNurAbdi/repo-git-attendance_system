/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - noveldb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`noveldb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `noveldb`;

/*Table structure for table `novel` */

DROP TABLE IF EXISTS `novel`;

CREATE TABLE `novel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `rilis` year(4) NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `novel` */

insert  into `novel`(`id`,`judul`,`status`,`rilis`,`rating`) values 
(2,'Everyone Else is a Returnee','Tamat',2016,4.3),
(4,'Kumo Desu ga, Nani ka?','Ongoing',2015,4.5),
(5,'Release that Witch','Tamat',2016,4.5),
(6,'The Legendary Moonlight Sculptor','Tamat',2007,4.3),
(7,'I Shall Seal the Heavens','Tamat',2014,4.4),
(8,'Overgeared','Ongoing',2014,3.9),
(9,'Overlord (LN)','Ongoing',2010,4.5),
(10,'Solo Leveling','Tamat',2016,4),
(11,'The Book Eating Magician','Tamat',2017,4),
(12,'A Will Eternal','Tamat',2016,4.4),
(13,'The Kingâ€™s Avatar','Tamat',2011,4.3),
(14,'Library of Heavenâ€™s Path','Tamat',2016,3.7),
(15,'Throne of Magical Arcana','Tamat',2013,4.1),
(3005,'Kidnapped Dragons','Tamat',2019,4.6),
(6199,'Emperorâ€™s Domination','Ongoing',2014,3.9),
(61999,'The Regressed Demon Lord is Kind','Ongoing',2020,4.4),
(63933,'Tes Delete','Hiatus',2100,5),
(72970,'Clearing an Isekai with the Zero-Believers Goddess â€“ The Weakest Mage among the Classmates (WN)','Ongoing',2018,4.3),
(90412,'Tes Data','Ongoing',2025,5);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
