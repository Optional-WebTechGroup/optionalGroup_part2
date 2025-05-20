-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2025 at 08:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Project_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE `Jobs` (
  `Job_id` int(11) NOT NULL,
  `Name of position` varchar(2000) NOT NULL,
  `Summary` varchar(2000) NOT NULL,
  `Essential Qualification` varchar(2000) NOT NULL,
  `Preferred Qualifications` varchar(2000) NOT NULL,
  `Salary range/benefit` varchar(2000) NOT NULL,
  `Title to report to` varchar(2000) NOT NULL,
  `Job reference number` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Jobs`
--

INSERT INTO `Jobs` (`Job_id`, `Name of position`, `Summary`, `Essential Qualification`, `Preferred Qualifications`, `Salary range/benefit`, `Title to report to`, `Job reference number`) VALUES
(1, 'Network Administrator:', 'Job Summary/Responsibilities:\r\nAs a network administrator, you will develop, maintain and improve our computer networks within the business to help it operate smoothly. you will also control user management, system maintenance, and manage the network infrastructure.\r\n\r\n', 'Essential skills for role:\r\n - knowledge in cisco units\r\n    - networking\r\n    - switching\r\n    - routing\r\n- assembly, python and java knowledge\r\n- being able to manage and organize large sets of data\r\n- good time management', 'Preferred skills for the role:\r\n- years of experience\r\n    1. 6 years (ideal)\r\n    2. 4 years (also ideal)\r\n    3. 2 years (minimum)\r\n- great communication skills\r\n- ability to adapt when needed\r\n- Understanding of cloud networking concepts and services', 'Salary range and Benefits:\r\nSalary when hired will be: $90,000 to $110,000, if promoted to senior Network Administrator then salary will change to $135,000.\r\n\r\nAs a network administrator, you benefit from high demand in the IT industry, opportunities for career advancement, and the chance to work with cutting-edge technologies, while also developing valuable problem-solving and communication skills.', 'Title to report to:\r\nIf hired you will report to the senior Network Administrator.', 'Job reference number:\r\nPXUB6'),
(2, 'Eco-Tech Sales Executive:', 'Job Summary/Responsibilities:\r\nAs a Eco-Tech Sales Executiveselling you will be selling environmentally friendly or sustainable technology solutions, requiring strong sales skills, product knowledge, and an understanding of the environmental market.\r\n\r\n', 'Essential skills for role:\r\n- great communication skills\r\n- knowledge in sales\r\n- technical expertise - can explain technical concepts in a clear and understandable manner to clients.\r\n- is well organized/good time management skills', 'Preferred skills for role:\r\n- years of experience\r\n   1. 6 years (ideal)\r\n   2. 4 years (also ideal)\r\n   3. 2 to 3 years (minimum)\r\n- industry knowledge\r\n- great leadership skills (in case of promotion)\r\ngreat negotiation skills', 'Salary range and Benefits:\r\nSalary when hired will be: $75,000 to $95,000 annually\r\n\r\nAs a eco-tech sales executive you will obtain the following benefits,a competitive salary, potentially including bonuses and commissions, a company vehicle, and opportunities for career growth within a dynamic and fast-paced industry', 'Title to report to:\r\nyou will report to the senior eco-tech sales executive/manager of your division', 'Job reference number:\r\n5KC3U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Jobs`
--
ALTER TABLE `Jobs`
  ADD PRIMARY KEY (`Job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Jobs`
--
ALTER TABLE `Jobs`
  MODIFY `Job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
