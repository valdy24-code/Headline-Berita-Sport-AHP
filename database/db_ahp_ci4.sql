/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_ahp_ci4
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_ahp_ci4` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_ahp_ci4`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`id_admin`,`username`,`password`) values 
(1,'admin','admin');

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(55) DEFAULT NULL,
  `nama_alternatif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_alternatif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_alternatif` */

insert  into `tb_alternatif`(`id_alternatif`,`kode_alternatif`,`nama_alternatif`) values 
(1,'A01','Alternatif 1'),
(2,'A02','Alternatif 2'),
(3,'A03','Alternatif 3');

/*Table structure for table `tb_kriteria` */

DROP TABLE IF EXISTS `tb_kriteria`;

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(55) DEFAULT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_kriteria` */

insert  into `tb_kriteria`(`id_kriteria`,`kode_kriteria`,`nama_kriteria`) values 
(1,'C01','Kriteria 1'),
(2,'C02','Kriteria 2'),
(3,'C03','Kriteria 3');

/*Table structure for table `tb_rel_alternatif` */

DROP TABLE IF EXISTS `tb_rel_alternatif`;

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode1` varchar(255) DEFAULT NULL,
  `kode2` varchar(255) DEFAULT NULL,
  `kode_kriteria` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_rel_alternatif` */

insert  into `tb_rel_alternatif`(`ID`,`kode1`,`kode2`,`kode_kriteria`,`nilai`) values 
(1,'A01','A01','C01',1),
(2,'A01','A02','C01',3),
(3,'A01','A03','C01',7),
(4,'A02','A01','C01',0.33333333333333),
(5,'A02','A02','C01',1),
(6,'A02','A03','C01',5),
(7,'A03','A01','C01',0.14285714285714),
(8,'A03','A02','C01',0.2),
(9,'A03','A03','C01',1),
(10,'A01','A01','C02',1),
(11,'A01','A02','C02',2),
(12,'A01','A03','C02',1),
(13,'A02','A01','C02',0.5),
(14,'A02','A02','C02',1),
(15,'A02','A03','C02',1),
(16,'A03','A01','C02',1),
(17,'A03','A02','C02',1),
(18,'A03','A03','C02',1),
(19,'A01','A01','C03',1),
(20,'A01','A02','C03',1),
(21,'A01','A03','C03',1),
(22,'A02','A01','C03',1),
(23,'A02','A02','C03',1),
(24,'A02','A03','C03',1),
(25,'A03','A01','C03',1),
(26,'A03','A02','C03',1),
(27,'A03','A03','C03',1);

/*Table structure for table `tb_rel_kriteria` */

DROP TABLE IF EXISTS `tb_rel_kriteria`;

CREATE TABLE `tb_rel_kriteria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID1` varchar(255) DEFAULT NULL,
  `ID2` varchar(255) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_rel_kriteria` */

insert  into `tb_rel_kriteria`(`ID`,`ID1`,`ID2`,`nilai`) values 
(1,'C01','C01',1),
(2,'C02','C01',0.33333333333333),
(3,'C01','C02',3),
(4,'C02','C02',1),
(5,'C03','C01',0.25),
(6,'C01','C03',4),
(7,'C03','C02',1),
(8,'C02','C03',1),
(9,'C03','C03',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
