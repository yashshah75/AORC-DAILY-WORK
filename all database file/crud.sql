-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `ID` int(100) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`ID`, `photo`, `username`, `email`, `password`, `confirm_password`, `mobile`, `reset_token`) VALUES
(10, '', 'pathik', 'p@gmail.com', 'P@123', 'P@123', '7575062903', 'bfeh'),
(26, 'images/ChatGPT Image Mar 31, 2025, 05_44_05 PM.png', 'test', 'yashphp.aorc@gmail.com', '$2y$10$28WFrrXWjqmGRkzll.PwdOVy6iQm..IaZzlQb7CMJOBg4JDSqcFhW', '$2y$10$1iJgOoOPtIyq4VjP0YHqOuCRScEwiJ292zrsai.duPwVp..C65oa.', '9874563210', NULL),
(27, 'images/Screenshot (3).png', 'Yash', 'yashshah29034@gmail.com', '$2y$10$x138AHP54OzHL8m86px.8OGWJ.BrKm7AG8732BPtoRXMNaaMqjoKi', '$2y$10$aTkHAQEh6vjcPN5HRE.ixOB.FAFper099WwpY0AZUlxDikxO4j.Ui', '9874563212', NULL),
(28, 'images/Screenshot (24).png', 'yashh', 'yashshah928685@gmail.com', '$2y$10$Wgz0PX9wsu08Ad0YPgUktOG2bMi0XYD0nfc5NsLIC0s6f2aXXSEiq', '$2y$10$4QRjOWIW.zrx8ZVKK1jzL.qQrjME1atstpq3YNpcD6bMW5Uk.5992', '+917575062903', NULL),
(30, 'ab.jpg', 'abc', 'a@mail.com', 'A@123', 'A@123', '9874563210', 'abcd'),
(31, 'abc.jpg', 'abcd', 'abcd@mail.com', 'A@123', 'A@123', '9874563211', 'abcde');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `reset_token` (`reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
