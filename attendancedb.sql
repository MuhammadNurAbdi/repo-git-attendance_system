/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.17-MariaDB : Database - attendancedb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`attendancedb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `attendancedb`;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `akun` */

insert  into `akun`(`username`,`password`,`level`) values 
('12345','202cb962ac59075b964b07152d234b70',2),
('12346','202cb962ac59075b964b07152d234b70',2),
('1910817110002','202cb962ac59075b964b07152d234b70',3),
('1910817110008','202cb962ac59075b964b07152d234b70',3),
('1910817310007','202cb962ac59075b964b07152d234b70',3),
('admin','21232f297a57a5a743894a0e4a801fc3',1),
('zeventier','202cb962ac59075b964b07152d234b70',1);

/*Table structure for table `dosen` */

DROP TABLE IF EXISTS `dosen`;

CREATE TABLE `dosen` (
  `nip_dosen` varchar(18) NOT NULL,
  `nama_dosen` varchar(25) NOT NULL,
  `email_dosen` varchar(254) NOT NULL,
  `gender_dosen` varchar(10) NOT NULL,
  `alamat_dosen` varchar(255) NOT NULL,
  `fakultas_dosen` varchar(20) NOT NULL,
  `prodi_dosen` varchar(30) NOT NULL,
  PRIMARY KEY (`nip_dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dosen` */

insert  into `dosen`(`nip_dosen`,`nama_dosen`,`email_dosen`,`gender_dosen`,`alamat_dosen`,`fakultas_dosen`,`prodi_dosen`) values 
('12345','Siti','siti@gmail.com','Perempuan','jl. sini','teknik','sipil'),
('12346','Irvan','irvanaulialuthfi@gmail.com','Laki-laki','Jl. Kebenaran','Teknik','Teknologi Informasi');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `kode_kelas` varchar(5) NOT NULL,
  `nama_kelas` varchar(16) NOT NULL,
  `hari` varchar(16) NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `ruang` varchar(20) NOT NULL,
  `nip_dosen` varchar(18) NOT NULL,
  PRIMARY KEY (`kode_kelas`),
  KEY `fk_kelas_nip` (`nip_dosen`),
  CONSTRAINT `fk_kelas_nip` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip_dosen`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

/*Table structure for table `mahasiswa` */

DROP TABLE IF EXISTS `mahasiswa`;

CREATE TABLE `mahasiswa` (
  `nim_mahasiswa` varchar(13) NOT NULL,
  `nama_mahasiswa` varchar(25) NOT NULL,
  `email_mahasiswa` varchar(254) NOT NULL,
  `gender_mahasiswa` varchar(10) NOT NULL,
  `alamat_mahasiswa` varchar(255) NOT NULL,
  `fakultas_mahasiswa` varchar(20) NOT NULL,
  `prodi_mahasiswa` varchar(30) NOT NULL,
  PRIMARY KEY (`nim_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mahasiswa` */

insert  into `mahasiswa`(`nim_mahasiswa`,`nama_mahasiswa`,`email_mahasiswa`,`gender_mahasiswa`,`alamat_mahasiswa`,`fakultas_mahasiswa`,`prodi_mahasiswa`) values 
('1910817110002','Siti','siti@gmail.com','Laki-laki','disana','Teknik','Teknologi Informasi'),
('1910817110008','Muhammad Nur Abdi','1910817110008@mhs.ulm.ac.id','Laki-laki','disini','Teknik','Teknologi Informasi'),
('1910817310007','Irvan Aulia Luthfi','1910817310005@mhs.ulm.ac.id','Laki-laki','Jl. Budi Utomo','Teknik','Teknologi Informasi');

/*Table structure for table `presensi` */

DROP TABLE IF EXISTS `presensi`;

CREATE TABLE `presensi` (
  `kode_presensi` varchar(10) NOT NULL,
  `pertemuan` int(11) NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_akhir` datetime NOT NULL,
  `kode_kelas` varchar(5) NOT NULL,
  PRIMARY KEY (`kode_presensi`),
  KEY `fk_presensi_kode_kelas` (`kode_kelas`),
  CONSTRAINT `fk_presensi_kode_kelas` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `presensi` */

/*Table structure for table `status_presensi` */

DROP TABLE IF EXISTS `status_presensi`;

CREATE TABLE `status_presensi` (
  `kode_status_presensi` varchar(10) NOT NULL,
  `status_presensi` varchar(20) NOT NULL,
  `nim_mahasiswa` varchar(13) NOT NULL,
  `kode_presensi` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_status_presensi`),
  KEY `fk_status_nim` (`nim_mahasiswa`),
  KEY `fk_status_kode_presensi` (`kode_presensi`),
  CONSTRAINT `fk_status_kode_presensi` FOREIGN KEY (`kode_presensi`) REFERENCES `presensi` (`kode_presensi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_nim` FOREIGN KEY (`nim_mahasiswa`) REFERENCES `mahasiswa` (`nim_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `status_presensi` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
