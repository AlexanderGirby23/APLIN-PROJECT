/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 8.0.30 : Database - carproject
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`carproject` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `carproject`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL,
  PRIMARY KEY (`ADMIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `admin` */

insert  into `admin`(`ADMIN_ID`,`ADMIN_PASSWORD`) values 
('ADMIN','ADMIN');

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `BOOK_ID` int NOT NULL AUTO_INCREMENT,
  `CAR_ID` int NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) DEFAULT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int NOT NULL,
  `PHONE_NUMBER` bigint NOT NULL,
  `DESTINATION` varchar(255) DEFAULT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING',
  `TAKE_METHOD` varchar(10) NOT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `TRANSACTION_ID` varchar(255) DEFAULT NULL,
  `PAYMENT_METHOD` varchar(255) DEFAULT 'midtrans',
  `PAYMENT_STATUS` varchar(255) DEFAULT 'pending',
  `SNAP_TOKEN` varchar(255) DEFAULT NULL,
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  `UPDATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`BOOK_ID`),
  KEY `CAR_ID` (`CAR_ID`),
  KEY `EMAIL` (`EMAIL`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `booking` */

insert  into `booking`(`BOOK_ID`,`CAR_ID`,`EMAIL`,`BOOK_PLACE`,`BOOK_DATE`,`DURATION`,`PHONE_NUMBER`,`DESTINATION`,`RETURN_DATE`,`PRICE`,`BOOK_STATUS`,`TAKE_METHOD`,`ADDRESS`,`TRANSACTION_ID`,`PAYMENT_METHOD`,`PAYMENT_STATUS`,`SNAP_TOKEN`,`CREATED_AT`,`UPDATED_AT`) values 
(66,2,'swasthik@gmail.com','bangalore','2022-03-22',5,6363549133,'moodabidri','2022-04-09',35000,'UNDER PROCESSING','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(68,1,'varshithvh@gmail.com','mysore','2022-03-22',10,6363549133,'moodabidri','2022-04-02',50000,'RETURNED','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(69,1,'varshithvhegde@gmail.com','bangalore','2022-03-24',10,6363549133,'moodabidri','2022-03-31',50000,'RETURNED','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(71,2,'a@a.com','123 mt everest','2025-06-11',5,321,'bali','2025-06-16',35000,'PENDING PAYMENT','pickup','qqq','CAR-1749360566-5959','midtrans','pending','22fd9871-4ba4-459d-81aa-da6e50d8e270',NULL,'2025-06-08 12:30:41'),
(72,1,'a@a.com','qwdq','2025-06-10',2,321,'bali','2025-06-12',10000,'CONFIRMED','pickup','qdqw','CAR-1749360701-9596','midtrans','paid','8a8d6477-352a-4199-b935-e33c26019e32',NULL,'2025-06-08 12:32:26'),
(73,1,'a@a.com','123 mt everest','2025-06-10',11,321,'123','2025-06-21',55000,'CONFIRMED','pickup','2qsdqwd','CAR-1749361034-4500','midtrans','paid','b867a508-7db0-4cc0-b2b5-f88a16a7ea92',NULL,'2025-06-08 12:38:44'),
(74,1,'a@a.com','123 mt everest','2025-06-12',6,321,'qwd','2025-06-18',30000,'CONFIRMED','pickup','qwdq','CAR-1749361139-5869','midtrans','paid','8328d61e-7b4d-415c-aab7-7392b210a6e2',NULL,'2025-06-08 12:39:13');

/*Table structure for table `cars` */

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `CAR_ID` int NOT NULL AUTO_INCREMENT,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int NOT NULL,
  `PRICE` int NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL,
  `LATE_CHARGE` int DEFAULT NULL,
  `CREATED` datetime DEFAULT CURRENT_TIMESTAMP,
  `DELETED` datetime DEFAULT NULL,
  PRIMARY KEY (`CAR_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cars` */

insert  into `cars`(`CAR_ID`,`CAR_NAME`,`FUEL_TYPE`,`CAPACITY`,`PRICE`,`CAR_IMG`,`AVAILABLE`,`LATE_CHARGE`,`CREATED`,`DELETED`) values 
(1,'FERRAI','PETROL',5,5000,'ferrari.jpg','Y',NULL,'2025-06-08 05:24:50',NULL),
(2,'LAMBORGINI','DEISEL',6,7000,'lamborghini.webp','Y',NULL,'2025-06-08 05:24:50',NULL),
(3,'PORSCHE','GAS',4,3000,'porsche.jpg','Y',NULL,'2025-06-08 05:24:50',NULL),
(20,'SWIFT','DEISEL',22,1000,'IMG-6239c94ea8a4a0.51789849.jpg','Y',NULL,'2025-06-08 05:24:50',NULL);

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `FED_ID` int NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL,
  PRIMARY KEY (`FED_ID`),
  KEY `TEST` (`EMAIL`),
  CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `feedback` */

insert  into `feedback`(`FED_ID`,`EMAIL`,`COMMENT`) values 
(10,'varshithvh@gmail.com','hai I am satisfied with your service .But need to know whether is there any other options\r\n');

/*Table structure for table `fuel_type` */

DROP TABLE IF EXISTS `fuel_type`;

CREATE TABLE `fuel_type` (
  `fuel_id` int NOT NULL AUTO_INCREMENT,
  `fuel_name` varchar(255) NOT NULL,
  PRIMARY KEY (`fuel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `fuel_type` */

insert  into `fuel_type`(`fuel_id`,`fuel_name`) values 
(1,'Gas'),
(2,'Petrol'),
(3,'Diesel'),
(4,'Solar');

/*Table structure for table `master_spareparts` */

DROP TABLE IF EXISTS `master_spareparts`;

CREATE TABLE `master_spareparts` (
  `sparepart_id` int NOT NULL AUTO_INCREMENT,
  `sparepart_name` varchar(100) NOT NULL,
  `DESCRIPTION` text,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `supplier_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sparepart_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `master_spareparts_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `master_spareparts` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `PAY_ID` int NOT NULL AUTO_INCREMENT,
  `BOOK_ID` int NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int NOT NULL,
  `PRICE` int NOT NULL,
  `TRANSACTION_ID` varchar(255) DEFAULT NULL,
  `PAYMENT_METHOD` varchar(255) DEFAULT 'midtrans',
  `PAYMENT_STATUS` varchar(255) DEFAULT 'pending',
  `CREATED_AT` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PAY_ID`),
  UNIQUE KEY `BOOK_ID` (`BOOK_ID`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `payment` */

insert  into `payment`(`PAY_ID`,`BOOK_ID`,`CARD_NO`,`EXP_DATE`,`CVV`,`PRICE`,`TRANSACTION_ID`,`PAYMENT_METHOD`,`PAYMENT_STATUS`,`CREATED_AT`) values 
(24,68,'4444444444444444','11/22',333,50000,NULL,'midtrans','pending',NULL);

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(100) NOT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `suppliers` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `DOMICILE` varchar(255) NOT NULL,
  `NIK` varchar(16) NOT NULL,
  `PHONE_NUMBER` bigint NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL,
  `nik_photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `users` */

insert  into `users`(`FNAME`,`LNAME`,`EMAIL`,`DOMICILE`,`NIK`,`PHONE_NUMBER`,`PASSWORD`,`GENDER`,`nik_photo`) values 
('a','a','a@a.com','a','1234567891011121',321,'afdd0b4ad2ec172c586e2150770fbf9e','male','IMG-68451edc51e3e4.31055006.png'),
('Swasthik','Jain','swasthik@gmail.com','B2343','4829301914120002',9845687555,'c788b480e4a3c807a14b6f3f4b1a1ae6','male',NULL),
('Varshith','Hegde','varshithvh@gmail.com','B3uudh4','4829301131400002',6363549133,'e6235c884414e320c8781c22b0c38c9b','male',NULL),
('Varshith','hegde','varshithvhegde@gmail.com','ghhdhd','1523142704250001',6363549133,'e6235c884414e320c8781c22b0c38c9b','male',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
