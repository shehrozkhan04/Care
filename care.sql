-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 01:00 PM
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
-- Database: `care`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `date` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `time` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `email`, `phone`, `department`, `doctor`, `date`, `message`, `time`) VALUES
(1, 'shehrozkhan', 'shehrozkhan@gmail.com', '1234567890', 'Cardiology', 'Shehroz khan', '0000-00-00', 'ajkhajkHSAKJHJKSA', '2025-01-29 15:12:10');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  `experience` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `bio` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `specialization`, `experience`, `city`, `time`, `bio`, `email`, `password`, `picture`, `status`) VALUES
(2, 'shayan', 'cardiologist', '', '', '', 'I am a doctor', 'shayan@gmail.com', '12345678', 'author2.jpg', 'accepted'),
(3, 'shehrozkhan', 'Cardiologist', '3', '', '', 'aihhiahia', 'shehrozkhan@gmail.com', '12345', 'about-img.jpg', 'accepted'),
(4, 'shehrozkhan', 'cardiologist', '3 years', '', '', 'aaaaaaaaaa', 'shehrozkhan@gmail.com', '12345', 'author2.jpg', 'accepted'),
(5, 'shehrozkhan', 'Cardiologist', '3 years', 'Islamabad', '5 AM to 6 AM', 'aasdddd', 'sgahga@gmail.com', '$2y$10$3HE4MQiP0lVm2eXz6UZP2uvZbGI3fPNo5Ar.Lp.3ARLDkWXv7khqO', 'author3.jpg', 'accepted'),
(6, 'shehrozkhan', 'Dermatologist', '3 years', 'Islamabad', '5 AM to 6 AM', 'aasdddd', 'sgahga@gmail.com', '$2y$10$/iqO/Y1HL/UPjC0uiHrmxOiCHqaPfJU9mWRqy2JCJs5Vly3.DBVQq', 'author3.jpg', 'accepted'),
(7, 'shehrozkhan', 'Cardiologist', '0.1 years', 'Islamabad', '5 AM to 6 AM', 'aaaaaaaaa', 'shayan@gmail.com', '$2y$10$ZzJIHXV1sf9OZL.aqCfIJeUMnVRE.ncnf3r41I.nITZ7ftQR/3rX.', 'author2.jpg', 'accepted'),
(8, 'shehrozkhan', 'Cardiologist', '0.1 years', 'Islamabad', '5 AM to 6 AM', '', 'shayan@gmail.com', '', 'author2.jpg', 'pending'),
(9, 'shehrozkhan', 'hahush', '3 years', 'Islamabad', '5 AM to 6 AM', 'aaaaaaaaaaa', 'shehrozkhan@gmail.com', '$2y$10$87pUpQNJ5pGM4DQXTYY5OO.Pj9iNPUYV.pc5WEPmoYNs2a/ljyqii', 'author1.jpg', 'accepted'),
(10, 'shehrozkhan', 'hahush', '3 years', 'islamabad', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(11, 'shehrozkhan', 'hahush', '3 years', 'Islamabad', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'accepted'),
(12, 'shehrozkhan', 'hahush', '3 years', 'Islamabad', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'accepted'),
(13, 'shehrozkhan', 'hahush', '3 years', 'Islamabad', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'accepted'),
(14, 'shehrozkhan', 'hahush', '3 years', 'Islamabad', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(15, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', 'aaaaaaaaaaaa', 'shehrozkhan@gmail.com', '$2y$10$ZYqYF12MPiK6FceLKuvnYegKhYfw38K2/Azh.PJKs1QEIf2g0sEr6', 'author1.jpg', 'accepted'),
(16, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(17, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', 'aaaaaaaaaaaa', 'shehrozkhan@gmail.com', '$2y$10$0Oc0amghCNqpznXqQ87gE.3F9dMHzPGS0e8XLgeV8Vbi86DouqRbe', 'author1.jpg', 'accepted'),
(18, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', 'aaaaaaaaaaaa', 'shehrozkhan@gmail.com', '$2y$10$hXR7qBwmQOAJjhF8aC7.z.sJpmw60HUeWqmuOS/bUzY33iJmToN5G', 'author1.jpg', 'accepted'),
(19, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', 'aaaaaaaaaaaa', 'shehrozkhan@gmail.com', '$2y$10$q2p5dIMmHrKPvf2sVdIzheyf7aqAPNADjbTVuiRdh6wsaUnR.pSNe', 'author1.jpg', 'accepted'),
(20, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(21, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(22, 'shehrozkhan', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shehrozkhan@gmail.com', '', 'author1.jpg', 'pending'),
(23, 'Ibrahim', 'Dermatologist', '3 years', 'karachi', '5 AM to 6 AM', 'aaaaaaaaaaaaa', 'shayan@gmail.com', '$2y$10$Bu.vFazD/8LqDWGsioJgSu2y6VNeuaa7OCK87UpcnUUKx9ato.TXm', 'author1.jpg', 'accepted'),
(24, 'Ibrahim', 'Dermatologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shayan@gmail.com', '', 'author1.jpg', 'pending'),
(25, 'shehrozkhan', 'cardiologist', '3 years', 'Lahore', '5 AM to 6 AM`', 'wwwwwwwwwwww', 'sgahga@gmail.com', '$2y$10$mD28wKzmlg5NjUFCyKCtseE.XWu9Ox43tTEDZRwEIaqHVH30mZedu', 'author2.jpg', 'accepted'),
(26, 'shehrozkhan', 'cardiologist', '3 years', 'Lahore', '5 AM to 6 AM`', '', 'sgahga@gmail.com', '', 'author2.jpg', 'accepted'),
(27, 'shehrozkhan', 'cardiologist', '3 years', 'Lahore', '5 AM to 6 AM`', '', 'sgahga@gmail.com', '', 'author2.jpg', 'accepted'),
(31, 'shehrozkhan', 'cardiologist', '3 years', 'Lahore', '5 AM to 6 AM`', '', 'sgahga@gmail.com', '', 'author2.jpg', 'pending'),
(33, 'Ibrahim', 'cardiologist', '3 years', 'karachi', '5 AM to 6 AM', '', 'shehroz@gmail.com', '', 'author2.jpg', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `medical_history` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `medical_reports` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `name`, `age`, `gender`, `medical_history`, `email`, `password`, `medical_reports`) VALUES
(2, 'shehrozkhan', 18, 'Male', 'tyrytrty', 'shayan@gmail.com', '$2y$10$vL/HQf8B9c.6Ktq/ot4nbOvE9dvTPqh5MwQ9tzJYNkMKJB9smHNAC', 'Screenshot 2025-01-14 143248.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
