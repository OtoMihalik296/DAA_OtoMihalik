-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 10:44 AM
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
-- Database: `databazove_mihalik`
--

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazov` varchar(50) NOT NULL,
  `popis` varchar(250) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazov`, `popis`, `cena`) VALUES
(1, 'Auto Renault', 'Kvalitný kovový model auta Renault', 56),
(2, 'Auto Renault', 'Kvalitný kovový model auta Renault', 56),
(3, 'Auto Kia', 'Kvaliný kovový model Kia', 99),
(4, 'Auto Kia', 'Kvaliný kovový model Kia', 99);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `meno` varchar(30) NOT NULL,
  `heslo` varchar(200) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `meno`, `heslo`, `email`) VALUES
(1, 'Ahoj', '$2y$10$QL/TIwz282.UTSZTkMbLzef', 'otomihalik100@gmail.com'),
(2, 'ddasd', '$2y$10$0/wXHDN/rYOz4UdrWd9Ej.r', 'otomihalik100@gmail.com'),
(3, 'a', '$2y$10$Kw5BNoA3Pk6Ot/EU.lXsneV', 'otomihalik100@gmail.com'),
(4, 'aa', '$2y$10$HpCa9i6zLnSYNa7PobcrsuY', 'testing@gmail.com'),
(5, 'aaaa', 'aaaa', 'testing@gmail.com'),
(6, 'aaaa', 'aaaa', 'OO@gmail.com'),
(7, 'aaa', 'aaa', 'oo@gmail.com'),
(8, 'bb', 'bb', 'testing@gmail.com'),
(9, 'bbb', '$2y$10$ffTUNlX8.XUFhgyKZvvwWO4', 'testing@gmail.com'),
(10, 'o', 'o', 'OO@gmail.com'),
(11, 'p', '148de9c5a7a44d19e56cd9ae1a554b', 'testing@gmail.com'),
(12, 'm', '62c66a7a5dd70c3146618063c344e531e6d4b59e379808443ce962b3abd63c5a', 'anton.nalakovic@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
