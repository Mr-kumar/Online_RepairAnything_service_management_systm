-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2024 at 11:40 AM
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
-- Database: `service`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `admin_id` int(11) NOT NULL,
  `admin_login` varchar(60) NOT NULL,
  `admin_email` varchar(60) NOT NULL,
  `admin_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`admin_id`, `admin_login`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'Manish123@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `assignwork_tb`
--

CREATE TABLE `assignwork_tb` (
  `tech_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `assign_date` date DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `tech_email` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignwork_tb`
--

INSERT INTO `assignwork_tb` (`tech_id`, `request_id`, `assign_date`, `request_date`, `tech_email`, `status`) VALUES
(9, 21, '2024-05-09', '2024-05-08', 'kunari@gmail.com', 'Approved'),
(12, 22, '2024-05-19', '2024-05-09', 'meri112@gmail.com', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobile_number` int(67) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `feedback_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `feedback_text` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `technician_tb`
--

CREATE TABLE `technician_tb` (
  `tech_id` int(11) NOT NULL,
  `tech_name` varchar(60) NOT NULL,
  `tach_city` varchar(60) NOT NULL,
  `tech_mob` bigint(20) NOT NULL,
  `tech_email` varchar(60) NOT NULL,
  `tech_password` varchar(255) DEFAULT NULL,
  `online_status` int(11) DEFAULT 0,
  `tech_specification` varchar(255) DEFAULT NULL,
  `availability` varchar(20) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technician_tb`
--

INSERT INTO `technician_tb` (`tech_id`, `tech_name`, `tach_city`, `tech_mob`, `tech_email`, `tech_password`, `online_status`, `tech_specification`, `availability`) VALUES
(9, 'manish kumar ', 'sitamarhi', 95088680209, 'kunari@gmail.com', '123456', 0, 'Electronics Repair', 'Not Free'),
(10, 'bhaskar kumar ', 'sitamarhi ', 8690368770, 'bhaskar@gmail.com', '212345', 0, 'Electronics Repair', 'Available'),
(11, 'kumari shalini', 'sitamarhi', 7657848439, 'meri@gmail.com', '4567', 1, 'Electronics Repair', 'not free'),
(12, 'merikumari', 'raichur', 765432345, 'meri112@gmail.com', '3214', 1, 'Plumbing Repair', 'Not Free');

-- --------------------------------------------------------

--
-- Table structure for table `userrequest_tb`
--

CREATE TABLE `userrequest_tb` (
  `request_id` int(11) NOT NULL,
  `request_info` text NOT NULL,
  `request_desc` text NOT NULL,
  `requester_name` varchar(60) NOT NULL,
  `requester_add1` text NOT NULL,
  `requester_add2` text NOT NULL,
  `requester_state` varchar(60) NOT NULL,
  `requester_city` varchar(100) NOT NULL,
  `requester_zip` int(11) NOT NULL,
  `requester_email` varchar(255) DEFAULT NULL,
  `requester_mobile` bigint(20) NOT NULL,
  `request_date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userrequest_tb`
--

INSERT INTO `userrequest_tb` (`request_id`, `request_info`, `request_desc`, `requester_name`, `requester_add1`, `requester_add2`, `requester_state`, `requester_city`, `requester_zip`, `requester_email`, `requester_mobile`, `request_date`, `user_id`) VALUES
(20, 'my tv again not working what to do', 'by mistake water is pouring the water into the ', 'kuamr', 'kumar gali', 'naranga bela', 'bihar', 'sitamarhi', 843324, 'harsh@gmail.com', 9508868029, '2024-05-07', 24),
(21, 'my washing machine is not working ', 'due to the socket fails that things happen', 'merinam', 'ajkfjhfd', '343f', 'karnataak', 'ditama', 34555, 'gt5kumaranhdh@gmail.com', 9876543212, '2024-05-08', 23),
(22, 'my cooler is not working and cause to failaure ', 'wire it not good so that this things happen', 'shanti priya', 'mei gali meinn', 'kumri gali meun ', 'bihar', 'motihari', 675422, 'naman@gmail.com', 9508868067, '2024-05-08', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_mobile` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mobile`) VALUES
(20, 'kumari', 'kunari@gmail.com', '123456789', '95088680209'),
(21, 'naman', 'naman@gmail.com', '1234567', '9508868067'),
(22, 'kajal kumari', 'kajal@gmail.com', 'kumari@123', '8690368770'),
(23, 'manish raja ', 'gt5kumaranhdh@gmail.com', '23456', '9876543212'),
(24, 'harsh', 'harsh@gmail.com', 'mqniswh@123', '9508868029');

-- --------------------------------------------------------

--
-- Table structure for table `user_work_history`
--

CREATE TABLE `user_work_history` (
  `work_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `request_info` varchar(255) DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `tech_id` int(11) DEFAULT NULL,
  `tech_name` varchar(100) DEFAULT NULL,
  `tech_email` varchar(100) DEFAULT NULL,
  `work_status` enum('Completed','Pending','Cancelled') DEFAULT NULL,
  `completion_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_report_tb`
--

CREATE TABLE `work_report_tb` (
  `work_report_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `assign_date` date DEFAULT NULL,
  `request_date` date DEFAULT NULL,
  `tech_email` varchar(255) DEFAULT NULL,
  `tech_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_report_tb`
--

INSERT INTO `work_report_tb` (`work_report_id`, `request_id`, `assign_date`, `request_date`, `tech_email`, `tech_id`, `status`) VALUES
(1, 20, '2024-05-09', '2024-05-07', 'bhaskar@gmail.com', 10, 'Completed'),
(2, 20, '2024-05-09', '2024-05-08', 'bhaskar@gmail.com', 10, 'Completed'),
(3, 20, '2024-05-09', '2024-05-08', 'bhaskar@gmail.com', 10, 'Completed'),
(4, 20, '2024-05-09', '2024-05-08', 'bhaskar@gmail.com', 10, 'Completed'),
(5, 22, '2024-05-08', '2024-05-08', 'meri112@gmail.com', 12, 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  ADD PRIMARY KEY (`tech_id`,`request_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `technician_tb`
--
ALTER TABLE `technician_tb`
  ADD PRIMARY KEY (`tech_id`);

--
-- Indexes for table `userrequest_tb`
--
ALTER TABLE `userrequest_tb`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_work_history`
--
ALTER TABLE `user_work_history`
  ADD PRIMARY KEY (`work_id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `tech_id` (`tech_id`);

--
-- Indexes for table `work_report_tb`
--
ALTER TABLE `work_report_tb`
  ADD PRIMARY KEY (`work_report_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `technician_tb`
--
ALTER TABLE `technician_tb`
  MODIFY `tech_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `userrequest_tb`
--
ALTER TABLE `userrequest_tb`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_work_history`
--
ALTER TABLE `user_work_history`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_report_tb`
--
ALTER TABLE `work_report_tb`
  MODIFY `work_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignwork_tb`
--
ALTER TABLE `assignwork_tb`
  ADD CONSTRAINT `assignwork_tb_ibfk_1` FOREIGN KEY (`tech_id`) REFERENCES `technician_tb` (`tech_id`),
  ADD CONSTRAINT `assignwork_tb_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `userrequest_tb` (`request_id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`);

--
-- Constraints for table `userrequest_tb`
--
ALTER TABLE `userrequest_tb`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_login` (`user_id`);

--
-- Constraints for table `user_work_history`
--
ALTER TABLE `user_work_history`
  ADD CONSTRAINT `user_work_history_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `userrequest_tb` (`request_id`),
  ADD CONSTRAINT `user_work_history_ibfk_2` FOREIGN KEY (`tech_id`) REFERENCES `technician_tb` (`tech_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
