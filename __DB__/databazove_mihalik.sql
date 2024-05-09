-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 11:50 AM
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
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `kategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `kategoria`) VALUES
(1, 'Herný'),
(2, 'Pracovný'),
(3, 'Bežný');

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazov` varchar(50) NOT NULL,
  `popis` varchar(250) NOT NULL,
  `cena` int(11) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `id_kategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazov`, `popis`, `cena`, `image_url`, `id_kategorie`) VALUES
(12, 'Macbook Air 13\" M1 Vesmírne sivý SK 2020', 'MacBook – Apple M1, 13,3\" IPS lesklý 2560 × 1600 px, RAM 8GB, Apple M1 7-jadrová GPU, SSD 256GB, podsvietená klávesnica, webkamera, USB-C, čítačka odtlačkov prstov, WiFi 6, hmotnosť 1,25 kg, macOS', 949, 'https://image.alza.cz/products/NL244a1a1/NL244a1a1.jpg?width=500&height=500', 3),
(13, 'Macbook Air 13\" M2 SK 2022 Temne atramentový', 'MacBook – Apple M2 (8jádrový), 13,6\" IPS lesklý 2560 × 1664 px, RAM 8GB, Apple M2 8-jadrová GPU, SSD 256GB, podsvietená klávesnica, webkamera, USB-C, WiFi 6, hmotnosť 1,24 kg, macOS', 1099, 'https://image.alza.cz/products/NL245b1a1/NL245b1a1.jpg?width=500&height=500', 2),
(14, 'Lenovo Legion Pro 5 16IRX8 Onyx Grey kovový', 'Herný notebook – Intel Core i9 13900HX Raptor Lake, 15.6\" IPS antireflexný 2560 × 1600 240Hz, RAM 32GB DDR5, NVIDIA GeForce RTX 4060 8GB 140 W (MUX Switch), SSD 1000GB, numerická klávesnica, podsvietená RGB klávesnica, webkamera, USB 3.2 Gen 1, USB-C', 1779, 'https://image.alza.cz/products/NT379k08q8/NT379k08q8.jpg?width=500&height=500', 1),
(15, 'ASUS Vivobook Go 15 E1504GA-BQ133WS Mixed Black', 'Notebook – Intel Processor N100, 15.6\" IPS antireflexný 1920 × 1080, RAM 4GB DDR4, Intel UHD Graphics, Flash 128GB, numerická klávesnica, webkamera, USB 3.2 Gen 1, USB-C, WiFi 5, Bluetooth, hmotnosť 1,63 kg, Windows 11 S', 289, 'https://image.alza.cz/products/NAB519B1/NAB519B1.jpg?width=500&height=500', 3),
(16, 'HP 14-em0920nc Natural Silver', 'Notebook – AMD Ryzen 5 7520U, 14\" IPS antireflexný 1920 × 1080, RAM 16GB LPDDR5, AMD Radeon 610M Graphics, SSD 1000GB, webkamera, USB 3.2 Gen 1, USB-C, WiFi 6, hmotnosť 1,4 kg, Windows 11 Home', 675, 'https://image.alza.cz/products/HPCN1002j2/HPCN1002j2.jpg?width=500&height=500', 3),
(17, 'ASUS Vivobook 15 X1504ZA-BQ147W Cool Silver', 'Notebook – Intel Core i5 1235U Alder Lake, 15.6\" IPS antireflexný 1920 × 1080, RAM 16GB DDR4, Intel Iris Xe Graphics, SSD 512GB, numerická klávesnica, podsvietená klávesnica, webkamera, USB 3.2 Gen 1, USB-C, WiFi 5, Bluetooth, hmotnosť 1,7 kg, Window', 479, 'https://image.alza.cz/products/NA567g52j2a/NA567g52j2a.jpg?width=500&height=500', 3),
(18, 'Acer Nitro V15 Shale Black', 'Herný notebook – Intel Core i5 13420H Raptor Lake, 15.6\" IPS antireflexný 1920 × 1080 144Hz, RAM 16GB DDR5, NVIDIA GeForce RTX 2050 4GB, SSD 1000GB, podsvietená klávesnica, webkamera, USB 3.2 Gen 1, USB-C, čítačka odtlačkov prstov, WiFi 6, hmotnosť 2', 749, 'https://image.alza.cz/products/NC108c7i09c1/NC108c7i09c1.jpg?width=500&height=500', 1),
(19, 'Acer Nitro 5 Obsidian Black', 'Herný notebook – Intel Core i9 12900H Alder Lake, 17.3\" IPS antireflexný 2560 × 1440 165Hz, RAM 32GB DDR5, NVIDIA GeForce RTX 4060 8GB 140 W (MUX Switch), SSD 1000GB, podsvietená RGB klávesnica, webkamera, USB 3.2 Gen 1, USB 3.2 Gen 2, WiFi 6, hmotno', 1499, 'https://image.alza.cz/products/NC108c7i06x2/NC108c7i06x2.jpg?width=500&height=500', 1),
(20, 'ASUS ROG Strix G16 G614JZ-N3001W Eclipse Gray kovo', 'Herný notebook – Intel Core i7 13650HX Raptor Lake, 16\" IPS antireflexný 1920 × 1200 165Hz, RAM 16GB DDR5, NVIDIA GeForce RTX 4080 12GB 175 W (MUX Switch), SSD 512GB, podsvietená RGB klávesnica, webkamera, USB 3.2 Gen 2, USB-C, WiFi 6, WiFi, Bluetoot', 1999, 'https://image.alza.cz/products/NA683x60p2/NA683x60p2.jpg?width=500&height=500', 1),
(21, 'ASUS TUF Gaming F15 FX506HF-HN004 Graphite Black', 'Herný notebook – Intel Core i5 11400H Tiger Lake, 15.6\" IPS antireflexný 1920 × 1080 144Hz, RAM 16GB DDR4, NVIDIA GeForce RTX 2050 4GB 70 W, SSD 512GB, numerická klávesnica, podsvietená RGB klávesnica, webkamera, USB 3.2 Gen 1, WiFi 6, hmotnosť 2,3 k', 739, 'https://image.alza.cz/products/NA667d90j5a/NA667d90j5a.jpg?width=500&height=500', 1);

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
(12, 'm', '62c66a7a5dd70c3146618063c344e531e6d4b59e379808443ce962b3abd63c5a', 'anton.nalakovic@gmail.com'),
(13, 'd', '18ac3e7343f016890c510e93f935261169d9e3f565436429830faf0934f4f8e4', 'testing@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
