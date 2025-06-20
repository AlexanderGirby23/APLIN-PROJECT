-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2022 at 08:41 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carproject`
--

-- CREATE OR REPLACE DATABASE carproject;
USE carproject;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` VARCHAR(255) NOT NULL,
  `ADMIN_PASSWORD` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` INT(11) NOT NULL,
  `CAR_ID` INT(11) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `BOOK_PLACE` VARCHAR(255),
  `BOOK_DATE` DATE NOT NULL,
  `DURATION` INT(11) NOT NULL,
  `PHONE_NUMBER` BIGINT(20) NOT NULL,
  `DESTINATION` VARCHAR(255),
  `RETURN_DATE` DATE NOT NULL,
  `PRICE` INT(11) NOT NULL,
  `BOOK_STATUS` VARCHAR(255) NOT NULL DEFAULT 'UNDER PROCESSING',
  `TAKE_METHOD` VARCHAR(10) NOT NULL,
  `ADDRESS` VARCHAR(100)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

SELECT DATE_ADD("2025-05-05", INTERVAL 10 DAY);
--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`) VALUES
(66, 2, 'swasthik@gmail.com', 'bangalore', '2022-03-22', 5, 6363549133, 'moodabidri', '2022-04-09', 35000, 'UNDER PROCESSING'),
(68, 1, 'varshithvh@gmail.com', 'mysore', '2022-03-22', 10, 6363549133, 'moodabidri', '2022-04-02', 50000, 'RETURNED'),
(69, 1, 'varshithvhegde@gmail.com', 'bangalore', '2022-03-24', 10, 6363549133, 'moodabidri', '2022-03-31', 50000, 'RETURNED');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` INT(11) NOT NULL,
  `CAR_NAME` VARCHAR(255) NOT NULL,
  `FUEL_TYPE` VARCHAR(255) NOT NULL,
  `CAPACITY` INT(11) NOT NULL,
  `PRICE` INT(11) NOT NULL,
  `CAR_IMG` VARCHAR(255) NOT NULL,
  `AVAILABLE` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`) VALUES
(1, 'FERRAI', 'PETROL', 5, 5000, 'ferrari.jpg', 'Y'),
(2, 'LAMBORGINI', 'DEISEL', 6, 7000, 'lamborghini.webp', 'Y'),
(3, 'PORSCHE', 'GAS', 4, 3000, 'porsche.jpg', 'Y'),
(20, 'SWIFT', 'DEISEL', 22, 1000, 'IMG-6239c94ea8a4a0.51789849.jpg', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` INT(11) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `COMMENT` TEXT NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`) VALUES
(10, 'varshithvh@gmail.com', 'hai I am satisfied with your service .But need to know whether is there any other options\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` INT(11) NOT NULL,
  `BOOK_ID` INT(11) NOT NULL,
  `CARD_NO` VARCHAR(255) NOT NULL,
  `EXP_DATE` VARCHAR(255) NOT NULL,
  `CVV` INT(11) NOT NULL,
  `PRICE` INT(11) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAY_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(24, 68, '4444444444444444', '11/22', 333, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` VARCHAR(255) NOT NULL,
  `LNAME` VARCHAR(255) NOT NULL,
  `EMAIL` VARCHAR(255) NOT NULL,
  `DOMICILE` VARCHAR(255) NOT NULL, -- Domicile address, where the customer lives
  `NIK` VARCHAR(16) NOT NULL, -- NIK
  `PHONE_NUMBER` BIGINT(11) NOT NULL,
  `PASSWORD` VARCHAR(255) NOT NULL,
  `GENDER` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `DOMICILE`, `NIK`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`) VALUES
('Swasthik', 'Jain', 'swasthik@gmail.com', 'B2343', '4829301914120002' , 9845687555, 'c788b480e4a3c807a14b6f3f4b1a1ae6', 'male'),
('Varshith', 'Hegde', 'varshithvh@gmail.com', 'B3uudh4', '4829301131400002' ,6363549133, 'e6235c884414e320c8781c22b0c38c9b', 'male'),
('Varshith', 'hegde', 'varshithvhegde@gmail.com', 'ghhdhd', '1523142704250001', 6363549133,'e6235c884414e320c8781c22b0c38c9b', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE cars 
ADD LATE_CHARGE INT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY, -- ID unik untuk supplier
    supplier_name VARCHAR(100) NOT NULL,       -- Nama supplier
    contact_name VARCHAR(100),                 -- Nama kontak utama di supplier
    phone_number VARCHAR(20),                  -- Nomor telepon supplier
    email VARCHAR(100),                        -- Email supplier
    address TEXT,                              -- Alamat lengkap supplier
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Waktu pembuatan data
);

CREATE TABLE master_spareparts (
    sparepart_id INT AUTO_INCREMENT PRIMARY KEY,
    sparepart_name VARCHAR(100) NOT NULL,
    DESCRIPTION TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    supplier_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id) ON DELETE SET NULL
);

CREATE TABLE fuel_type (
	fuel_id INT AUTO_INCREMENT PRIMARY KEY,
	fuel_name VARCHAR(255) NOT NULL
);
INSERT INTO `carproject`.`fuel_type` (`fuel_name`) VALUES ('Gas'); 
INSERT INTO `carproject`.`fuel_type` (`fuel_name`) VALUES ('Petrol'); 
INSERT INTO `carproject`.`fuel_type` (`fuel_name`) VALUES ('Diesel'); 
INSERT INTO `carproject`.`fuel_type` (`fuel_name`) VALUES ('Solar'); 


ALTER TABLE cars
ADD `CREATED` DATETIME DEFAULT CURRENT_TIMESTAMP AFTER `LATE_CHARGE`,
ADD `DELETED` DATETIME DEFAULT NULL AFTER `CREATED`;

ALTER TABLE users add nik_photo VARCHAR(255)
