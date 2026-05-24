-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2026 at 08:46 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `subject_id` int NOT NULL,
  `status` varchar(20) NOT NULL,
  `attendance_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(20) NOT NULL,
  `user_id` int NOT NULL,
  `matric_id` varchar(10) NOT NULL,
  `course` varchar(50) NOT NULL,
  `semester` int NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `credit_hour` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `credit_hour`) VALUES
(1, 'IMS562 ', 'Web Development with CakePHP', 3),
(2, 'IMS552 ', 'Database Management Systems', 3),
(3, 'IMS502 ', ' Information Security Awareness', 4),
(4, 'IMS456', ' Integrated Media Applications', 4),
(5, 'IMS552 ', 'Web Development with CakePHP', 6),
(6, 'IMS888', 'Information Security', 1),
(7, 'IMS552 ', 'information padu', 5),
(8, 'IMS556', 'information padu', 4),
(9, 'IMS552 ', 'Web Development with CakePHP', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `ic_number` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `faculty` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `student_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile_image`, `ic_number`, `phone`, `faculty`, `course`, `semester`, `password`, `created`, `student_id`) VALUES
(1, 'bro faiq', 'faiqhakim1412@gmail.comm', NULL, '101412121997', '01177755568', 'business', 'business managment', '7', 'Bky1340#', NULL, '2025234662'),
(2, 'MOHAMAD FAIQ HAKIM BIN AZRI', 'iman@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'TsaE_j8fgDk', '2026-05-20 08:43:55', NULL),
(3, 'iman', 'ioiman@gmail.com', NULL, '041215101336', NULL, 'sains maklumat', 'pengurusan sistem', '4', '123456789', NULL, '20589546'),
(4, 'haryth', 'harythperdana@gmail.com', NULL, '041014107569', '0189652345', 'sains maklumat', 'pengurusan sistem', '4', 'TsaE_j8fgDk', NULL, '2569852'),
(5, 'akmal', 'akmal@gmail.com', NULL, '041010031558', '012345678', 'sains maklumat', 'halal management', '6', 'akmalhenasem', NULL, '2026985647'),
(6, 'akmal', 'koi@gmail.com', NULL, '041215101234', '0123456954', 'sains maklumat', 'pengurusan sistem', '8', 'koihgrdfg', NULL, '2024236589'),
(7, 'farhan', 'kuy@gmail.com', NULL, '891015101889', '018965742', 'sains maklumat', 'pengurusan sistem', '4', 'faiqhkim', NULL, '36985475'),
(8, 'pijoy', 'ok@gmail.com', NULL, '75698345621', '0123456954', 'sains maklumat', 'halal management', '8', 'Koplaksmsj x', NULL, '25896547423'),
(9, 'acap', 'capmelan@gmail.com', 'user_9_1779522603.jpg', '010203148777', '0196557095', 'business', 'business managment', '7', 'capmelan', NULL, '2023184449'),
(10, 'iman tony', '2025240338@student.uitm.edu.my', NULL, '040209140271', '0129763369', 'sains maklumat', 'information system management', '4', '1234', NULL, '2025240338'),
(12, 'Hamid', 'hamid@student.com', 'user_12_1779523106.jpg', '190506141337', '0198887652', 'business', 'business transport', '1', '123456789', NULL, '202891154'),
(13, 'akmal san', 'akmalsan@gmail.com', 'user_13_1779599281.jpg', '041015131665', '0176557094', 'sains maklumat', 'halal management', '6', 'akmalsan', NULL, '202215487');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `FK_attendance_subject` (`subject_id`),
  ADD KEY `FK_attendance_student` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk1` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `FK_attendance_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `FK_attendance_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
