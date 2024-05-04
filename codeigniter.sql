-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 10:04 AM
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
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `SortDelete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`ID`, `Name`, `Description`, `SortDelete`) VALUES
(1, 'Python', 'Python là một ngôn ngữ lập trình thông dịch, có mục tiêu đọc dễ hiểu, cú pháp đơn giản, thân thiện với người mới học.', 0),
(2, 'JavaScript', 'JavaScript là một ngôn ngữ lập trình phía client, thường được sử dụng để làm các tương tác trên trang web.', 0),
(3, 'Java', 'Java là một ngôn ngữ lập trình phổ biến, được sử dụng rộng rãi trong việc phát triển ứng dụng trên nhiều nền tảng.', 0),
(4, 'C++', 'C++ là một ngôn ngữ lập trình hướng đối tượng, mạnh mẽ và linh hoạt, thường được sử dụng trong việc phát triển phần mềm.', 0),
(5, 'C#', 'C# là một ngôn ngữ lập trình phổ biến của Microsoft, thường được sử dụng trong việc phát triển ứng dụng trên nền tảng Windows.', 0),
(6, 'PHP', 'PHP là một ngôn ngữ lập trình phía server, thường được sử dụng để phát triển các trang web động.', 0),
(7, 'Ruby', 'Ruby là một ngôn ngữ lập trình linh hoạt và dễ đọc, thường được sử dụng trong việc phát triển các ứng dụng web.', 0),
(8, 'Go', 'Go là một ngôn ngữ lập trình được Google phát triển, được thiết kế để có hiệu suất cao và dễ dàng sử dụng.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_log`
--

CREATE TABLE `failed_log` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `time` datetime NOT NULL,
  `counts` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `failed_log`
--

INSERT INTO `failed_log` (`ID`, `email`, `ip_address`, `time`, `counts`) VALUES
(7, 'hug@gmail.com', '::1', '2024-05-03 11:54:17', 1),
(8, 'hug@gmail.com', '::1', '2024-05-03 11:54:36', 1),
(9, 'w@gmail.com', '::1', '2024-05-03 12:25:43', 1),
(10, 'hug@gmail.com', '::1', '2024-05-03 12:29:45', 1),
(11, 'w@gmail.com', '::1', '2024-05-03 12:29:55', 1),
(12, 'hugsdsccccc@gmail.com', '::1', '2024-05-03 12:30:17', 1),
(13, 'hugsdsccccc@gmail.com', '::1', '2024-05-03 12:30:51', 1),
(14, 'wsdasdsd@gmail.com', '::1', '2024-05-03 12:31:29', 1),
(15, 'wsdasdsd@gmail.com', '::1', '2024-05-03 12:31:43', 1),
(16, 'w@gmail.com', '::1', '2024-05-03 12:32:09', 1),
(17, 'hug@gmail.com', '::1', '2024-05-03 12:39:13', 1),
(18, 'hug1231232@gmail.com', '::1', '2024-05-03 12:44:31', 1),
(19, 'hug@gmail.com', '::1', '2024-05-03 12:44:49', 1),
(20, 'hug1231232@gmail.com', '::1', '2024-05-03 12:45:04', 1),
(21, 'delete@gmail.com', '::1', '2024-05-04 14:51:54', 1),
(22, 'delete@gmail.com', '::1', '2024-05-04 14:52:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ID` int(11) NOT NULL,
  `img_path` varchar(200) NOT NULL,
  `upload_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ID`, `img_path`, `upload_time`) VALUES
(3, '8f75ac001edb53614113f4ebf10d3e08.png', '2024-04-29 04:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissionID` int(11) NOT NULL,
  `permissionName` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissionID`, `permissionName`, `description`) VALUES
(1, 'View', 'Quyền xem dữ liệu'),
(2, 'Delete', 'Quyền xoá dữ liệu'),
(3, 'Edit', 'Quyền sửa dữ liệu');

-- --------------------------------------------------------

--
-- Table structure for table `userpermissions`
--

CREATE TABLE `userpermissions` (
  `userID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpermissions`
--

INSERT INTO `userpermissions` (`userID`, `permissionID`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `password`, `status`) VALUES
(1, 'Mr.ALL', 'all@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'Mr. VIEW', 'view@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(3, 'MR.UPDATE', 'update@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
(4, 'thaihung', 'hug@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(11, 'abc', 'abc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `failed_log`
--
ALTER TABLE `failed_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionID`),
  ADD UNIQUE KEY `permissionName` (`permissionName`);

--
-- Indexes for table `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD PRIMARY KEY (`userID`,`permissionID`),
  ADD KEY `permissionID` (`permissionID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_log`
--
ALTER TABLE `failed_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permissionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userpermissions`
--
ALTER TABLE `userpermissions`
  ADD CONSTRAINT `userpermissions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `userpermissions_ibfk_2` FOREIGN KEY (`permissionID`) REFERENCES `permissions` (`permissionID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
