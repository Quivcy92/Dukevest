-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2023 at 09:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dukevest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_investment`
--

CREATE TABLE `client_investment` (
  `region` varchar(100) NOT NULL,
  `industry` varchar(100) NOT NULL,
  `income` int(50) NOT NULL,
  `risk_level` int(1) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='client_investment';

--
-- Dumping data for table `client_investment`
--

INSERT INTO `client_investment` (`region`, `industry`, `income`, `risk_level`, `create_date`, `id`, `client_id`) VALUES
('canada', 'medicare', 40000, 4, '2023-04-23 15:11:34', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `client_product`
--

CREATE TABLE `client_product` (
  `id` int(11) NOT NULL,
  `client_fk` int(11) NOT NULL,
  `product_fk` int(11) NOT NULL,
  `rm_fk` int(11) NOT NULL,
  `date_mapped` timestamp NOT NULL DEFAULT current_timestamp(),
  `accepted` tinyint(1) NOT NULL DEFAULT 0,
  `date_accepted` timestamp NULL DEFAULT NULL,
  `investment_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_product`
--

INSERT INTO `client_product` (`id`, `client_fk`, `product_fk`, `rm_fk`, `date_mapped`, `accepted`, `date_accepted`, `investment_fk`) VALUES
(4, 2, 2, 6, '2023-04-23 15:14:04', 1, '2023-04-23 15:18:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `Industry` varchar(50) NOT NULL,
  `RiskLevel` int(1) NOT NULL,
  `Region` varchar(30) NOT NULL,
  `EntryPrice` int(11) NOT NULL,
  `Currency` varchar(3) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `ProductName`, `Industry`, `RiskLevel`, `Region`, `EntryPrice`, `Currency`, `CreatedAt`) VALUES
(1, 'Bionics Test', 'Medicare', 5, 'United Kingdom', 30000, 'GBP', '2023-04-23 14:54:35'),
(2, 'Bionics', 'Health', 5, 'USA', 30000, 'USD', '2023-04-23 14:54:41'),
(3, 'Crypto', 'Finance', 5, 'United Kingdom', 35000, 'GBP', '2023-04-23 14:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `accountType` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`firstName`, `lastName`, `email`, `phoneNumber`, `address`, `password`, `accountType`, `id`) VALUES
('John', 'Doe', 'jdoe@test.com', '+4457851231234', '24 Lonely Lane', '912ec803b2ce49e4a541068d495ab570', 'CLIENT', 1),
('John', 'Doe', 'jdoe@gmail.com', '+4457851231234', '24 Lonely Lane', '912ec803b2ce49e4a541068d495ab570', 'CLIENT', 2),
('John', 'Doe', 'jdoe@admin.com', '+4457851231234', 'Address 1', '912ec803b2ce49e4a541068d495ab570', 'ADMIN', 3),
('John', 'Doe', 'jdoe@test1.com', '+4457851231234', 'Address 1 Addressss', '81dc9bdb52d04dc20036dbd8313ed055', 'CLIENT', 4),
('John', 'Doe', 'jdoe@test2.com', '+4457851231234', 'Lonely Lane', '81dc9bdb52d04dc20036dbd8313ed055', 'CLIENT', 5),
('John', 'Doe', 'jdoe@rm.com', '+4457851231234', 'Address 1 Addressss', '81dc9bdb52d04dc20036dbd8313ed055', 'RM', 6),
('Kanayo', 'Okanayo', 'sacrifice@gmail.com', '+4457851237785', 'Evelyn Street', '912ec803b2ce49e4a541068d495ab570', 'CLIENT', 7),
('jerry', 'jane', 'jane@gmail.com', '08035621996', 'sylvia street', '81dc9bdb52d04dc20036dbd8313ed055', 'CLIENT', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_investment`
--
ALTER TABLE `client_investment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`client_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client_product`
--
ALTER TABLE `client_product`
  ADD UNIQUE KEY `client_product` (`id`),
  ADD KEY `client_fk` (`client_fk`,`product_fk`,`rm_fk`,`investment_fk`),
  ADD KEY `rm_fk` (`rm_fk`),
  ADD KEY `investment_fk` (`investment_fk`),
  ADD KEY `product_fk` (`product_fk`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD UNIQUE KEY `ProductID` (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD UNIQUE KEY `ID` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_investment`
--
ALTER TABLE `client_investment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_product`
--
ALTER TABLE `client_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_investment`
--
ALTER TABLE `client_investment`
  ADD CONSTRAINT `client_investment_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `client_product`
--
ALTER TABLE `client_product`
  ADD CONSTRAINT `client_product_ibfk_1` FOREIGN KEY (`rm_fk`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `client_product_ibfk_2` FOREIGN KEY (`investment_fk`) REFERENCES `client_investment` (`id`),
  ADD CONSTRAINT `client_product_ibfk_3` FOREIGN KEY (`product_fk`) REFERENCES `product` (`ID`),
  ADD CONSTRAINT `client_product_ibfk_4` FOREIGN KEY (`client_fk`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
