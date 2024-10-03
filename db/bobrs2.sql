-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2024 at 03:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bobrs2`
--

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text DEFAULT NULL,
  `pwdResetSelector` text DEFAULT NULL,
  `pwdResetToken` longtext DEFAULT NULL,
  `pwdResetExpires` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(6, 'jvpastorillo@gmail.com', '75b4de3115e811e7', '$2y$10$Y0wccGbGymKGK3uPoxB5WeKytTIeEojc7u7hhhjo8FqEnh51uAHnO', '1720274827');

-- --------------------------------------------------------

--
-- Table structure for table `tblbook`
--

CREATE TABLE `tblbook` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `seat_num` varchar(150) NOT NULL,
  `payment_status` varchar(150) NOT NULL,
  `total` varchar(150) NOT NULL,
  `book_date` datetime NOT NULL DEFAULT current_timestamp(),
  `book_reference` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbook`
--

INSERT INTO `tblbook` (`id`, `schedule_id`, `passenger_id`, `seat_num`, `payment_status`, `total`, `book_date`, `book_reference`) VALUES
(39, 52, 9, '1', 'pending', '250', '2024-07-11 18:27:10', 'Ceb-Ban_0052001'),
(47, 62, 9, '39', 'cancel', '200', '2024-07-17 05:30:31', 'Ceb-Ban_00620039'),
(48, 62, 9, '40', 'confirmed', '200', '2024-07-17 06:14:37', 'Ceb-Ban_00620040'),
(49, 68, 9, '40', 'pending', '200', '2024-07-18 22:57:04', 'Ban-Ceb_00680040');

-- --------------------------------------------------------

--
-- Table structure for table `tblbus`
--

CREATE TABLE `tblbus` (
  `id` int(11) NOT NULL,
  `bus_num` varchar(150) NOT NULL,
  `bus_type` varchar(50) NOT NULL,
  `rate_km` double NOT NULL,
  `bus_code` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbus`
--

INSERT INTO `tblbus` (`id`, `bus_num`, `bus_type`, `rate_km`, `bus_code`) VALUES
(2, 'Ceres Bus', 'Air conditioned', 0, '555'),
(10, 'Ceres Bus', 'Regular', 0, '556');

-- --------------------------------------------------------

--
-- Table structure for table `tblconductor`
--

CREATE TABLE `tblconductor` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `liscenseNum` varchar(100) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `driver_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblconductor`
--

INSERT INTO `tblconductor` (`id`, `name`, `liscenseNum`, `phone`, `address`, `driver_id`) VALUES
(2, 'Dianna Lyn Cena', '02384508', '09153312395', 'Putian', 0),
(10, 'Joann Rebamonte', '', '09153312395', 'Kodia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldriver`
--

CREATE TABLE `tbldriver` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `liscenseNum` varchar(100) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldriver`
--

INSERT INTO `tbldriver` (`id`, `name`, `liscenseNum`, `phone`, `address`) VALUES
(2, 'Robert Azarcon', '03829048', '09153312395', 'Tarong'),
(10, 'John Carlo Jagdon', '', '09153312395', 'Mancilang');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE `tbllocation` (
  `id` int(11) NOT NULL,
  `location_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`id`, `location_name`) VALUES
(1, 'Madridejos'),
(2, 'Bantayan'),
(5, 'Cebu'),
(8, 'Bogo City'),
(9, 'Carmen'),
(10, 'Consolacion'),
(11, 'Hagnaya');

-- --------------------------------------------------------

--
-- Table structure for table `tblpassenger`
--

CREATE TABLE `tblpassenger` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `verification_code` text NOT NULL,
  `email_verified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpassenger`
--

INSERT INTO `tblpassenger` (`id`, `first_name`, `last_name`, `email`, `address`, `password`, `verification_code`, `email_verified_at`) VALUES
(2, 'Ezel', 'Dela Pena', 'delapenaezel847+test1@gmail.com', 'Tarong', '$2y$10$73/hEp3qUegbzQX.WYRmtetli4RJelF4wcZ9FXPThaq/j7du4CEmG', '239576', '0000-00-00 00:00:00'),
(3, 'Jossin', 'Ygoña', 'jossygonia@gmail.com', 'Kaongkod, New York', '$2y$10$bb3sCZQCHglZSzvBcuQmXOrHSyK6GbHmvodzxHWdB4LJ86CohUAse', '547899', '2022-04-24 15:16:15'),
(4, 'Niño', 'Sevillejo', 'sevillejoonin18@gmail.com', 'Ticad, Bantayan, Cebu', '$2y$10$RlDd49hi8gdq0DyZpHjR4un30Na5zIi3Nj1z/84oDXKfpdAtGizW.', '275893', '2022-04-24 20:23:46'),
(6, 'Ezel', 'Pena', 'delapenaezel847@gmail.com', 'Tarong', '$2y$10$CbWn0aPi2myl6urTk3yJruVUElsLa8o7I2yBACUmR8UZ7VAAfjlWq', '191318', '2022-04-27 11:24:22'),
(11, 'James', 'Pastorillo', 'jamespastorillo@gmail.com', 'Kabac, Bantayan, Cebu', '$2y$10$.EYW.syqeeVSunzpRWjmpuSM1wv1ZRR44wv97bs8AOFGgunjEC/Ou', '240497', '0000-00-00 00:00:00'),
(12, 'James', 'Pastorillo', 'jvpastorillo@gmail.com', 'Kabac, Bantayan, Cebu', '$2y$10$pmiNITJeQacESswl26qUcuBq61t91/K9/QK9xcKIaxOlb1NXxbmsW', '295267', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblroute`
--

CREATE TABLE `tblroute` (
  `id` int(11) NOT NULL,
  `route_from` int(11) NOT NULL,
  `route_to` int(11) NOT NULL,
  `distance` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblroute`
--

INSERT INTO `tblroute` (`id`, `route_from`, `route_to`, `distance`) VALUES
(2, 2, 5, '500'),
(7, 1, 10, ''),
(8, 2, 9, ''),
(10, 2, 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `departure` time NOT NULL,
  `arrival` time NOT NULL,
  `bus_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `conductor_id` int(11) NOT NULL,
  `fare` decimal(10,0) NOT NULL,
  `status` varchar(150) NOT NULL,
  `vessel_id` int(11) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `bus_code_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`id`, `route_id`, `schedule_date`, `departure`, `arrival`, `bus_id`, `driver_id`, `conductor_id`, `fare`, `status`, `vessel_id`, `discount`, `bus_code_id`) VALUES
(67, 7, '2024-07-19', '05:00:00', '09:00:00', 2, 2, 2, 300, 'waiting', 0, 0, 0),
(69, 2, '2024-07-20', '05:00:00', '09:00:00', 2, 10, 10, 250, 'waiting', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `verification_code` text NOT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fullname`, `username`, `email`, `password`, `status`, `date_created`, `verification_code`, `email_verified_at`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '$2y$10$orIyzP.kfA9tLzuHCh.MS.7JFlVroxvpOBDCFFOPGIRFYieblZlL.', 1, '2022-03-22 14:50:51', '331016', '2022-03-22 14:53:04'),
(2, 'test', 'test', 'test@gmail.com', '$2y$10$8Tp31i0/1.CMhb1.F.RpieZ.7QTviaN7bXYlp4SP5KH0dbn5LMNy6', 1, '2022-03-22 16:56:43', '353416', NULL),
(5, 'dela pena', 'saling', 'delapenaezel847@gmail.com', '$2y$10$oHHekKN2wZzETil1G6CdE.UC/HSoxpvdp.CTHAgr8AamRSWKhcVWa', 1, '2022-04-25 13:48:59', '328219', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblvessel`
--

CREATE TABLE `tblvessel` (
  `id` int(11) NOT NULL,
  `vessel_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblvessel`
--

INSERT INTO `tblvessel` (`id`, `vessel_name`) VALUES
(3, 'Island shipping'),
(4, 'Shuttle');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `tblbook`
--
ALTER TABLE `tblbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbus`
--
ALTER TABLE `tblbus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblconductor`
--
ALTER TABLE `tblconductor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldriver`
--
ALTER TABLE `tbldriver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpassenger`
--
ALTER TABLE `tblpassenger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblroute`
--
ALTER TABLE `tblroute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblvessel`
--
ALTER TABLE `tblvessel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblbook`
--
ALTER TABLE `tblbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tblbus`
--
ALTER TABLE `tblbus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblconductor`
--
ALTER TABLE `tblconductor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbldriver`
--
ALTER TABLE `tbldriver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbllocation`
--
ALTER TABLE `tbllocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblpassenger`
--
ALTER TABLE `tblpassenger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblroute`
--
ALTER TABLE `tblroute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblschedule`
--
ALTER TABLE `tblschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblvessel`
--
ALTER TABLE `tblvessel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
