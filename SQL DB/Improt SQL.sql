-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 07, 2024 at 09:42 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IWT`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(3) NOT NULL,
  `adminFname` varchar(20) NOT NULL,
  `adminLname` varchar(20) NOT NULL,
  `adminEmail` varchar(60) NOT NULL,
  `adminPwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFname`, `adminLname`, `adminEmail`, `adminPwd`) VALUES
(1, 'Dilmith', 'Shemil', 'dilmithsemal@gmail.com', '1234'),
(2, 'Methmi', 'Dilshara', 'methmi@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_address` text NOT NULL,
  `emergency_contact` varchar(100) NOT NULL,
  `emergency_phone` varchar(20) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_month` int(11) NOT NULL,
  `expiry_year` int(11) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `flight_id`, `user_name`, `user_email`, `user_phone`, `user_address`, `emergency_contact`, `emergency_phone`, `card_number`, `expiry_month`, `expiry_year`, `cvv`, `booking_date`) VALUES
(1, 1, 'yasira', 'yasiradamsara@gmail.com', '746763764', 'sgadhgsdhs', 'yasira', '0766791010', '162361253633', 2, 2025, '625', '2024-10-05 12:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `subject`, `message`, `submission_date`) VALUES
(5, 'dilmith', 'dilmithsemal@gmail.com', 'badd', 'service bad', '2024-10-04 03:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flight_id` int(11) NOT NULL,
  `flight_number` varchar(10) DEFAULT NULL,
  `departure_city` varchar(50) DEFAULT NULL,
  `arrival_city` varchar(50) DEFAULT NULL,
  `departure_time` datetime DEFAULT NULL,
  `arrival_time` datetime DEFAULT NULL,
  `seats_available` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flight_id`, `flight_number`, `departure_city`, `arrival_city`, `departure_time`, `arrival_time`, `seats_available`) VALUES
(1, '12', 'Colombo', 'Mumbai', '2024-10-08 15:28:19', '2024-10-09 15:28:19', 450);

-- --------------------------------------------------------

--
-- Table structure for table `managebook`
--

CREATE TABLE `managebook` (
  `fid` int(11) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managebook`
--

INSERT INTO `managebook` (`fid`, `origin`, `destination`, `price`) VALUES
(2, 'Chicago', 'Miami', 150),
(3, 'San Francisco', 'Seattle', 200),
(4, 'Houston', 'Atlanta', 250),
(5, 'Dallas', 'New York', 280),
(6, 'Las Vegas', 'San Diego', 180),
(7, 'Philadelphia', 'Boston', 120),
(8, 'Denver', 'Phoenix', 220),
(9, 'Orlando', 'San Francisco', 350),
(10, 'Washington, D.C.', 'Chicago', 200),
(101, 'New York', 'London', 400),
(104, 'Chicago', 'Dubai', 800),
(108, 'Colombo', 'Mumbaii', 180),
(111, 'Mattala', 'london', 800);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(12) NOT NULL,
  `fName` varchar(16) NOT NULL,
  `lName` varchar(16) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `email` varchar(60) NOT NULL,
  `uPwd` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `fName`, `lName`, `age`, `gender`, `email`, `uPwd`) VALUES
(2, 'Dinitha', 'Ranketh', 22, 'Male', 'dinitha@gmail.com', '$2y$10$wXuX/ieZnQFh4dmz83Nsx.OKt6RV0m4pSyZLJaHP4Aasy0r.qxOmW'),
(3, 'Dilmith', 'Pathirana', 21, 'Male', 'dilmithsemal@gmail.com', '$2y$10$vlMU391g4oy50Ch.s5jt8.4ImQ5zoXbzonftY9YmiT36Pd1pbYz4u'),
(4, 'Hasitha', 'Lakshan', 22, 'Male', 'hasi@gmail.com', '$2y$10$kNIxXQul99JP2oJxri/APuqTPm67QGMAtgtoPB4JC34OBVd9LxRs2'),
(5, 'ashwin', 'indeewara', 23, 'Male', 'ashwin@gmail.com', '$2y$10$bXbpU4GagSmIuB6G4G0FquEHUg1iTKGwYZjUDESSkXQWFvndI59N2'),
(6, 'vishwa', 'madusanka', 20, 'Male', 'vishmi@outlook.com', '$2y$10$.M8Xk7M0jmfOVcvgFtr7Mu8d1N/tFRf44g/9hj2frq0ZKhTKMCNqK'),
(7, 'methmi', 'dilshara', 21, 'Female', 'methmi@outlook.com', '$2y$10$C6/cXcD6rYTO16hK7ktAS.ZritohwmpxJ47Bdud3FjJ5PTilIJP9G');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flight_id`);

--
-- Indexes for table `managebook`
--
ALTER TABLE `managebook`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `managebook`
--
ALTER TABLE `managebook`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
