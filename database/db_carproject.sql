CREATE DATABASE `carproject`;

USE `carproject`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `ADMIN_ID` VARCHAR(255) NOT NULL,
  `ADMIN_PASSWORD` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ADMIN_ID`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

INSERT  INTO `admin`(`ADMIN_ID`,`ADMIN_PASSWORD`) VALUES 
('ADMIN','ADMIN');

/*Table structure for table `cars` */

DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `CAR_ID` INT NOT NULL AUTO_INCREMENT,
  `CAR_NAME` VARCHAR(255) NOT NULL,
  `FUEL_TYPE` VARCHAR(255) NOT NULL,
  `CAPACITY` INT NOT NULL,
  `PRICE` INT NOT NULL,
  `CAR_IMG` VARCHAR(255) NOT NULL,
  `AVAILABLE` VARCHAR(255) NOT NULL,
  `LATE_CHARGE` INT DEFAULT NULL,
  `CREATED` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `DELETED` DATETIME DEFAULT NULL,
  PRIMARY KEY (`CAR_ID`)
) ENGINE=INNODB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cars` */

INSERT  INTO `cars`(`CAR_ID`,`CAR_NAME`,`FUEL_TYPE`,`CAPACITY`,`PRICE`,`CAR_IMG`,`AVAILABLE`,`LATE_CHARGE`,`CREATED`,`DELETED`) VALUES 
(1,'FERRAI','PETROL',5,5000,'ferrari.jpg','Y',NULL,'2025-06-08 05:24:50',NULL),
(2,'LAMBORGINI','DEISEL',6,7000,'lamborghini.webp','Y',NULL,'2025-06-08 05:24:50',NULL),
(3,'PORSCHE','GAS',4,3000,'porsche.jpg','Y',NULL,'2025-06-08 05:24:50',NULL),
(20,'SWIFT','DEISEL',22,1000,'IMG-6239c94ea8a4a0.51789849.jpg','Y',NULL,'2025-06-08 05:24:50',NULL);


/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `FNAME` VARCHAR(255) NOT NULL,
  `LNAME` VARCHAR(255) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `DOMICILE` VARCHAR(255) NOT NULL,
  `NIK` VARCHAR(16) NOT NULL,
  `PHONE_NUMBER` BIGINT NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `GENDER` VARCHAR(255) NOT NULL,
  `nik_photo` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`EMAIL`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

INSERT  INTO `users`(`FNAME`,`LNAME`,`EMAIL`,`DOMICILE`,`NIK`,`PHONE_NUMBER`,`PASSWORD`,`GENDER`,`nik_photo`) VALUES 
('a','a','a@a.com','a','1234567891011121',321,'afdd0b4ad2ec172c586e2150770fbf9e','male','IMG-68451edc51e3e4.31055006.png'),
('Swasthik','Jain','swasthik@gmail.com','B2343','4829301914120002',9845687555,'c788b480e4a3c807a14b6f3f4b1a1ae6','male',NULL),
('Varshith','Hegde','varshithvh@gmail.com','B3uudh4','4829301131400002',6363549133,'e6235c884414e320c8781c22b0c38c9b','male',NULL),
('Varshith','hegde','varshithvhegde@gmail.com','ghhdhd','1523142704250001',6363549133,'e6235c884414e320c8781c22b0c38c9b','male',NULL);

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `BOOK_ID` INT NOT NULL AUTO_INCREMENT,
  `CAR_ID` INT NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `BOOK_PLACE` VARCHAR(255) DEFAULT NULL,
  `BOOK_DATE` DATE NOT NULL,
  `DURATION` INT NOT NULL,
  `PHONE_NUMBER` BIGINT NOT NULL,
  `DESTINATION` VARCHAR(255) DEFAULT NULL,
  `RETURN_DATE` DATE NOT NULL,
  `PRICE` INT NOT NULL,
  `BOOK_STATUS` VARCHAR(255) NOT NULL DEFAULT 'UNDER PROCESSING',
  `TAKE_METHOD` VARCHAR(10) NOT NULL,
  `ADDRESS` VARCHAR(100) DEFAULT NULL,
  `TRANSACTION_ID` VARCHAR(255) DEFAULT NULL,
  `PAYMENT_METHOD` VARCHAR(255) DEFAULT 'midtrans',
  `PAYMENT_STATUS` VARCHAR(255) DEFAULT 'pending',
  `SNAP_TOKEN` VARCHAR(255) DEFAULT NULL,
  `CREATED_AT` TIMESTAMP NULL DEFAULT NULL,
  `UPDATED_AT` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`BOOK_ID`),
  KEY `CAR_ID` (`CAR_ID`),
  KEY `EMAIL` (`EMAIL`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4;

/*Data for the table `booking` */

INSERT  INTO `booking`(`BOOK_ID`,`CAR_ID`,`EMAIL`,`BOOK_PLACE`,`BOOK_DATE`,`DURATION`,`PHONE_NUMBER`,`DESTINATION`,`RETURN_DATE`,`PRICE`,`BOOK_STATUS`,`TAKE_METHOD`,`ADDRESS`,`TRANSACTION_ID`,`PAYMENT_METHOD`,`PAYMENT_STATUS`,`SNAP_TOKEN`,`CREATED_AT`,`UPDATED_AT`) VALUES 
(66,2,'swasthik@gmail.com','bangalore','2022-03-22',5,6363549133,'moodabidri','2022-04-09',35000,'UNDER PROCESSING','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(68,1,'varshithvh@gmail.com','mysore','2022-03-22',10,6363549133,'moodabidri','2022-04-02',50000,'RETURNED','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(69,1,'varshithvhegde@gmail.com','bangalore','2022-03-24',10,6363549133,'moodabidri','2022-03-31',50000,'RETURNED','',NULL,NULL,'midtrans','pending',NULL,NULL,NULL),
(71,2,'a@a.com','123 mt everest','2025-06-11',5,321,'bali','2025-06-16',35000,'PENDING PAYMENT','pickup','qqq','CAR-1749360566-5959','midtrans','pending','22fd9871-4ba4-459d-81aa-da6e50d8e270',NULL,'2025-06-08 12:30:41'),
(72,1,'a@a.com','qwdq','2025-06-10',2,321,'bali','2025-06-12',10000,'CONFIRMED','pickup','qdqw','CAR-1749360701-9596','midtrans','paid','8a8d6477-352a-4199-b935-e33c26019e32',NULL,'2025-06-08 12:32:26'),
(73,1,'a@a.com','123 mt everest','2025-06-10',11,321,'123','2025-06-21',55000,'CONFIRMED','pickup','2qsdqwd','CAR-1749361034-4500','midtrans','paid','b867a508-7db0-4cc0-b2b5-f88a16a7ea92',NULL,'2025-06-08 12:38:44'),
(74,1,'a@a.com','123 mt everest','2025-06-12',6,321,'qwd','2025-06-18',30000,'CONFIRMED','pickup','qwdq','CAR-1749361139-5869','midtrans','paid','8328d61e-7b4d-415c-aab7-7392b210a6e2',NULL,'2025-06-08 12:39:13');
INSERT INTO `booking` 
(`CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`, `TAKE_METHOD`, `ADDRESS`, `TRANSACTION_ID`, `PAYMENT_METHOD`, `PAYMENT_STATUS`, `SNAP_TOKEN`, `CREATED_AT`, `UPDATED_AT`)
VALUES
(1, 'swasthik@gmail.com', 'Bangalore', '2025-04-05', 3, 9876543210, 'Mysore', '2025-04-08', 450000, 'CONFIRMED', 'pickup', 'MG Road', 'TXN001', 'midtrans', 'settlement', 'snap001', '2025-04-01 10:00:00', '2025-04-01 10:00:00'),
(2, 'varshithvh@gmail.com', 'Hyderabad', '2025-04-15', 2, 9876500000, 'Chennai', '2025-04-17', 300000, 'UNDER PROCESSING', 'delivery', 'Jubilee Hills', 'TXN002', 'midtrans', 'pending', 'snap002', '2025-04-10 12:00:00', '2025-04-10 12:00:00'),
(3, 'varshithvhegde@gmail.com', 'Mumbai', '2025-05-10', 5, 9876541111, 'Goa', '2025-05-15', 650000, 'CONFIRMED', 'pickup', 'Andheri West', 'TXN003', 'midtrans', 'settlement', 'snap003', '2025-05-01 09:00:00', '2025-05-01 09:00:00'),
(1, 'varshithvh@gmail.com', 'Pune', '2025-05-20', 1, 9876542222, 'Lonavala', '2025-05-21', 100000, 'CANCELLED', 'pickup', 'Shivaji Nagar', 'TXN004', 'midtrans', 'failed', 'snap004', '2025-05-15 15:00:00', '2025-05-15 15:00:00'),
(20, 'swasthik@gmail.com', 'Delhi', '2025-06-01', 4, 9876549999, 'Agra', '2025-06-05', 500000, 'CONFIRMED', 'delivery', 'Karol Bagh', 'TXN005', 'midtrans', 'settlement', 'snap005', '2025-06-01 08:30:00', '2025-06-01 08:30:00'),
(3, 'varshithvhegde@gmail.com', 'Chennai', '2025-06-08', 2, 9876512345, 'Pondicherry', '2025-06-10', 250000, 'UNDER PROCESSING', 'pickup', 'T. Nagar', 'TXN006', 'midtrans', 'pending', 'snap006', '2025-06-05 11:00:00', '2025-06-05 11:00:00');

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `FED_ID` INT NOT NULL AUTO_INCREMENT,
  `EMAIL` VARCHAR(255) NOT NULL,
  `COMMENT` TEXT NOT NULL,
  PRIMARY KEY (`FED_ID`),
  KEY `TEST` (`EMAIL`),
  CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `feedback` */

INSERT  INTO `feedback`(`FED_ID`,`EMAIL`,`COMMENT`) VALUES 
(10,'varshithvh@gmail.com','hai I am satisfied with your service .But need to know whether is there any other options\r\n');

/*Table structure for table `fuel_type` */

DROP TABLE IF EXISTS `fuel_type`;

CREATE TABLE `fuel_type` (
  `fuel_id` INT NOT NULL AUTO_INCREMENT,
  `fuel_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`fuel_id`)
) ENGINE=INNODB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `fuel_type` */

INSERT  INTO `fuel_type`(`fuel_id`,`fuel_name`) VALUES 
(1,'Gas'),
(2,'Petrol'),
(3,'Diesel'),
(4,'Solar');

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `supplier_id` INT NOT NULL AUTO_INCREMENT,
  `supplier_name` VARCHAR(100) NOT NULL,
  `contact_name` VARCHAR(100) DEFAULT NULL,
  `phone_number` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `address` TEXT,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

/*Data for the table `suppliers` */
INSERT INTO `suppliers` 
(`supplier_name`, `contact_name`, `phone_number`, `email`, `address`) 
VALUES
('Fresh Produce Co.', 'Alice Johnson', '+1-202-555-0101', 'alice@freshproduce.com', '123 Greenfield Ave, Springfield'),
('Global Spices Ltd.', 'Raj Patel', '+44-20-7946-0990', 'raj.patel@globalspices.co.uk', '88 Spice Road, London, UK'),
('Tech Supplies Inc.', 'Jennifer Lee', '+1-415-555-0112', 'jlee@techsupplies.com', '900 Tech Drive, San Jose, CA'),
('Ocean Foods', 'Hiro Tanaka', '+81-3-1234-5678', 'hiro.t@oceanfoods.jp', '5-2-1 Shibuya, Tokyo, Japan'),
('Sunshine Dairy', 'Carlos Mendoza', '+52-55-1234-5678', 'carlos@sunshinedairy.mx', 'Av. Reforma 250, Mexico City'),
('Quick Paper Goods', 'Laura Smith', '+1-718-555-0123', 'laura@quickpaper.com', '42 Industrial Blvd, Brooklyn, NY'),
('Garden Hardware', 'Mike O’Brien', '+61-2-9999-8888', 'mike@gardenhardware.au', '76 Tool St, Sydney, Australia'),
('Bella Wines', 'Giulia Rossi', '+39-06-123-4567', 'giulia@bellawines.it', 'Via Roma 45, Rome, Italy'),
('Nordic Shipping', 'Lars Andersen', '+47-22-333-444', 'lars@nordicshipping.no', 'Harbor St. 12, Oslo, Norway'),
('Asian Textiles', 'Mei Wong', '+86-10-5555-6666', 'mei@asiantextiles.cn', 'No. 88 Textile Rd, Beijing, China');


/*Table structure for table `master_spareparts` */

DROP TABLE IF EXISTS `master_spareparts`;

CREATE TABLE `master_spareparts` (
  `sparepart_id` INT NOT NULL AUTO_INCREMENT,
  `sparepart_name` VARCHAR(100) NOT NULL,
  `DESCRIPTION` TEXT,
  `price` DECIMAL(10,2) NOT NULL,
  `stock` INT NOT NULL DEFAULT '0',
  `supplier_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sparepart_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `master_spareparts_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`) ON DELETE SET NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

/*Data for the table `master_spareparts` */
INSERT INTO `master_spareparts` 
(`sparepart_name`, `DESCRIPTION`, `price`, `stock`, `supplier_id`) 
VALUES
('Oil Filter', 'High-quality oil filter suitable for various car models', 207840.00, 100, 1),
('Brake Pad Set', 'Durable ceramic brake pads with enhanced stopping power', 728000.00, 60, 2),
('Spark Plug', 'Platinum-tipped spark plug for improved ignition performance', 124000.00, 200, 3),
('Air Filter', 'Reusable air filter with high airflow efficiency', 400000.00, 80, 4),
('Timing Belt', 'Long-life timing belt compatible with most 4-cylinder engines', 894400.00, 40, 5),
('Fuel Pump', 'Electric fuel pump with high pressure for performance vehicles', 1583840.00, 30, 6),
('Radiator Hose', 'Flexible and heat-resistant radiator hose', 227200.00, 150, 7),
('Alternator', 'High output alternator for reliable charging system', 1920000.00, 25, 8),
('Clutch Kit', 'Complete clutch kit with pressure plate and disc', 2812000.00, 15, 9),
('Battery', '12V maintenance-free car battery with long lifespan', 1369600.00, 50, 10);
INSERT INTO `master_spareparts` 
(`sparepart_name`, `DESCRIPTION`, `price`, `stock`, `supplier_id`, `created_at`) 
VALUES
('Oil Filter', 'Used for engine cleaning', 75000, 20, 1, '2025-04-05 10:23:00'),
('Air Filter', 'Improves air intake', 120000, 15, 2, '2025-04-12 14:45:00'),
('Brake Pads', 'High performance brake pads', 180000, 10, 3, '2025-04-22 09:30:00'),
('Spark Plug', 'Long-lasting spark plug', 45000, 30, 1, '2025-05-03 11:10:00'),
('Radiator', 'High efficiency radiator', 350000, 5, 2, '2025-05-15 08:50:00'),
('Battery', '12V automotive battery', 750000, 3, 1, '2025-05-27 13:00:00'),
('Timing Belt', 'Rubber belt for camshaft timing', 250000, 6, 2, '2025-06-01 10:10:00'),
('Fuel Pump', 'Electric fuel pump', 400000, 4, 3, '2025-06-08 16:30:00'),
('Alternator', 'Charges the car battery', 850000, 2, 1, '2025-06-08 17:00:00');


/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `PAY_ID` INT NOT NULL AUTO_INCREMENT,
  `BOOK_ID` INT NOT NULL,
  `CARD_NO` VARCHAR(255) NOT NULL,
  `EXP_DATE` VARCHAR(255) NOT NULL,
  `CVV` INT NOT NULL,
  `PRICE` INT NOT NULL,
  `TRANSACTION_ID` VARCHAR(255) DEFAULT NULL,
  `PAYMENT_METHOD` VARCHAR(255) DEFAULT 'midtrans',
  `PAYMENT_STATUS` VARCHAR(255) DEFAULT 'pending',
  `CREATED_AT` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`PAY_ID`),
  UNIQUE KEY `BOOK_ID` (`BOOK_ID`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment` */

INSERT  INTO `payment`(`PAY_ID`,`BOOK_ID`,`CARD_NO`,`EXP_DATE`,`CVV`,`PRICE`,`TRANSACTION_ID`,`PAYMENT_METHOD`,`PAYMENT_STATUS`,`CREATED_AT`) VALUES 
(24,68,'4444444444444444','11/22',333,50000,NULL,'midtrans','pending',NULL);

ALTER TABLE carproject.users
ADD `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() AFTER `nik_photo`, ADD `deleted` DATETIME AFTER `created`;

