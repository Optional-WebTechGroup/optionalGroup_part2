-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 02:33 AM
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
-- Database: `optional_group_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_number` int(11) NOT NULL,
  `job_reference_number` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` char(3) NOT NULL,
  `postcode` char(4) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `technical_skills` varchar(255) NOT NULL,
  `other_skills` text DEFAULT NULL,
  `experience_title` varchar(100) DEFAULT NULL,
  `experience_company` varchar(100) DEFAULT NULL,
  `experience_description` text DEFAULT NULL,
  `experience_from_date` date DEFAULT NULL,
  `experience_to_date` date DEFAULT NULL,
  `currently_working` tinyint(1) NOT NULL DEFAULT 0,
  `education_institution` varchar(100) DEFAULT NULL,
  `education_degree` varchar(100) DEFAULT NULL,
  `education_major` varchar(100) DEFAULT NULL,
  `education_description` text DEFAULT NULL,
  `education_from_date` date DEFAULT NULL,
  `education_to_date` date DEFAULT NULL,
  `currently_attending` tinyint(1) NOT NULL DEFAULT 0,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `personal_website` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `message_for_us` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`eoi_number`, `job_reference_number`, `first_name`, `last_name`, `birthdate`, `gender`, `street_address`, `suburb`, `state`, `postcode`, `email_address`, `phone_number`, `technical_skills`, `other_skills`, `experience_title`, `experience_company`, `experience_description`, `experience_from_date`, `experience_to_date`, `currently_working`, `education_institution`, `education_degree`, `education_major`, `education_description`, `education_from_date`, `education_to_date`, `currently_attending`, `linkedin`, `twitter`, `github`, `personal_website`, `resume`, `message_for_us`, `status`) VALUES
(1, '5KC3U', 'Alice', 'Smith', '1998-05-14', 'female', '12 King St', 'Sydney', 'NSW', '2000', 'alice.smith@email.com', '0412345678', 'python,java', 'Fast learner', 'Software Engineer', 'TechCorp', 'Developed web applications and led a small team.', '2021-01-01', '2023-12-31', 0, 'University of Sydney', 'BSc Computer Science', 'Software Engineering', 'Graduated with distinction.', '2016-02-01', '2019-11-30', 0, 'https://linkedin.com/in/alicesmith', NULL, 'https://github.com/alicesmith', NULL, 'alice_smith_1747473926.pdf', 'I am excited to join your innovative team!', 'New'),
(2, 'PXUB6', 'Bob', 'Lee', '2001-11-23', 'male', '34 Queen Ave', 'Melbourne', 'VIC', '3000', 'bob.lee@email.com', '0398765432', 'networking,switching', 'Fluent in Mandarin', 'Network Technician', 'NetSolutions', 'Maintained enterprise networks.', '2022-03-01', NULL, 1, 'RMIT University', 'Diploma of IT Networking', NULL, NULL, '2020-02-01', '2021-12-15', 0, 'https://linkedin.com/in/boblee', 'https://twitter.com/boblee', NULL, NULL, 'bob_lee_1747473976.pdf', 'Looking forward to contributing my network skills.', 'New'),
(3, '5KC3U', 'Carol', 'Johnson', '1995-02-02', 'female', '56 Prince Rd', 'Brisbane', 'QLD', '4000', 'carol.j@email.com', '0734567890', 'assembly,python', 'Cybersecurity basics', 'Security Analyst', 'SafeData', 'Monitored and analyzed security threats.', '2019-06-01', '2024-05-01', 0, 'QUT', 'Bachelor of IT', 'Cybersecurity', 'Completed major projects in threat analysis.', '2015-03-01', '2018-11-30', 0, NULL, NULL, 'https://github.com/carolj', NULL, 'carol_johnson_1747474926.pdf', 'Security is my passion!', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_reference_number` varchar(5) NOT NULL,
  `position_name` varchar(2000) NOT NULL,
  `summary` varchar(2000) NOT NULL,
  `essential_qualifications` varchar(2000) NOT NULL,
  `preferred_qualifications` varchar(2000) NOT NULL,
  `salary_and_benefits` varchar(2000) NOT NULL,
  `title_to_report_to` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_reference_number`, `position_name`, `summary`, `essential_qualifications`, `preferred_qualifications`, `salary_and_benefits`, `title_to_report_to`) VALUES
('5KC3U', 'Eco-Tech Sales Executive', 'As a Eco-Tech Sales Executiveselling you will be selling environmentally friendly or sustainable technology solutions, requiring strong sales skills, product knowledge, and an understanding of the environmental market.', '- great communication skills\r\n- knowledge in sales\r\n- technical expertise\r\n- can explain technical concepts in a clear and understandable manner to clients.\r\n- is well organized/good time management skills', 'Years of experience\r\n   1. 6 years (ideal)\r\n   2. 4 years (also ideal)\r\n   3. 2 to 3 years (minimum)\r\n- industry knowledge\r\n- great leadership skills (in case of promotion)\r\n- great negotiation skills', 'Salary when hired will be: $75,000 to $95,000 annually\r\n\r\nAs a eco-tech sales executive you will obtain the following benefits,a competitive salary, potentially including bonuses and commissions, a company vehicle, and opportunities for career growth within a dynamic and fast-paced industry', 'You will report to the senior eco-tech sales executive/manager of your division'),
('PXUB6', 'Network Administrator', 'As a network administrator, you will develop, maintain and improve our computer networks within the business to help it operate smoothly. You will also control user management, system maintenance, and manage the network infrastructure.', '- knowledge in cisco units\r\n- networking\r\n- switching\r\n- routing\r\n- assembly, python and java knowledge\r\n- being able to manage and organize large sets of data\r\n- good time management', 'Years of experience\r\n    1. 6 years (ideal)\r\n    2. 4 years (also ideal)\r\n    3. 2 years (minimum)\r\n- great communication skills\r\n- ability to adapt when needed\r\n- understanding of cloud networking concepts and services', 'Salary when hired will be: $90,000 to $110,000, if promoted to senior Network Administrator then salary will change to $135,000.\r\n\r\nAs a network administrator, you benefit from high demand in the IT industry, opportunities for career advancement, and the chance to work with cutting-edge technologies, while also developing valuable problem-solving and communication skills.', 'If hired you will report to the senior Network Administrator.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `status`) VALUES
(1, 'admin', '$2y$10$WhVq3foxyFX07JYaCVaSDuY4x9r5HszH3Ic3uju6vXH3jWCY3JcOi', 0),
(2, 'Nikolas', '$2y$10$vDdF7g51NOhwnz93fQ62xOeyP0n2zLK6SiWoS3871YwjkNCFjlqee', 0),
(3, 'test', '$2y$10$i/qCUufxK1Rg.HtyZ8cU0.OXUcHknnZ.caROEW7Cl7avC2JJez.3K', 0),
(4, 'user', '$2y$10$ECcctAPdU.gIN6EbUkoot.w2bsi8ktkgm2Jwp46QhiLeVPApKxAb2', 1),
(5, 'new', '$2y$10$9/UfkBUPPZ8pEuG441h1rO25XxX3NLwM/9zjaRrf05FeLxdYmwPhK', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_number`),
  ADD KEY `job_reference_number` (`job_reference_number`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_reference_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `eoi_ibfk_1` FOREIGN KEY (`job_reference_number`) REFERENCES `jobs` (`job_reference_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
