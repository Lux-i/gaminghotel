-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2024 at 05:49 PM
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
-- Database: `gaminghotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `extras` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `status` enum('neu','bestätigt','storniert') NOT NULL DEFAULT 'neu',
  `roomid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `start`, `end`, `extras`, `price`, `status`, `roomid`) VALUES
(1, 1, '2024-12-14', '2024-12-19', NULL, 500, 'neu', NULL),
(2, 1, '2024-12-16', '2024-12-19', NULL, 300, 'neu', NULL),
(3, 1, '2024-12-20', '2024-12-27', 'Parkplatz,Frühstück', 917, 'neu', NULL),
(4, 1, '2024-12-24', '2024-12-26', 'Frühstück,Haustiere', 256, 'neu', NULL),
(5, 8, '2024-12-24', '2024-12-27', 'Parkplatz,Frühstück,Haustiere', 423, 'neu', NULL),
(6, 1, '2024-12-16', '2024-12-20', 'Parkplatz,Frühstück', 524, 'neu', NULL),
(7, 1, '2024-12-22', '2024-12-23', 'Parkplatz,Frühstück', 231, 'neu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

CREATE TABLE `news_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub` tinytext NOT NULL,
  `content` text NOT NULL,
  `img_path` tinytext NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_articles`
--

INSERT INTO `news_articles` (`id`, `title`, `sub`, `content`, `img_path`, `upload_date`) VALUES
(23, 'Neue Grafikkarten', 'Für die beste performance und ein noch besserer Erlebnis haben wir ab jetzt in allen PC\'s Nvidias RTX 4090er Grafikkarte...', 'Für die beste performance und ein noch besserer Erlebnis haben wir ab jetzt in allen PC\'s Nvidias RTX 4090er Grafikkarten eingebaut.', '../Public/uploads/thumbnails/rtx-4090.jpg', '2024-11-18'),
(24, 'Counter-Strike Turnier', 'Es ist wieder soweit: Wir hosten ein neues Counter Strike Turnier! \r\nWann das Turnier stattfindet und wie ihr euch anmel...', 'Es ist wieder soweit: Wir hosten ein neues Counter Strike Turnier! \r\nWann das Turnier stattfindet und wie ihr euch anmelden könnt, erfahrt ihr in diesem Artikel!\r\n<br>\r\nZu Anfang des neuen Jahres gibt es wieder einen Göppel Hotels Cash Cup. Gespielt wird in den Wochenenden<br>18.1 - 19.1<br>25.1 - 26.1<br>\r\nAnmeldungen finden bis zum 10.1 statt.', '../Public/uploads/thumbnails/esport_players.jpg', '2024-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('single','double','squad') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `type`) VALUES
(1, 'single'),
(2, 'single'),
(3, 'single'),
(4, 'single'),
(5, 'single'),
(6, 'double'),
(7, 'double'),
(8, 'double'),
(9, 'double'),
(10, 'squad'),
(11, 'squad'),
(12, 'squad'),
(13, 'squad'),
(14, 'squad'),
(15, 'squad');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `userid` int(11) UNSIGNED NOT NULL,
  `tokenhash` varchar(97) NOT NULL,
  `token_expires` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`userid`, `tokenhash`, `token_expires`) VALUES
(1, '$argon2id$v=19$m=65536,t=4,p=1$SkZaRy80VjJPVGxuTm5oWQ$DISn2taceWzUSVaMqRYsp1ZRFn4Xnc11rfq+O54c7zY', '2025-01-03'),
(8, '$argon2id$v=19$m=65536,t=4,p=1$MkpHem1Cb2hFQm94akVlMg$BbLM+aU//G+8+psqX6VRgvhx+/sjstzpvoue5K0gv68', '2025-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `anrede` enum('herr','frau','divers') NOT NULL,
  `name` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `rolle` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `anrede`, `name`, `nachname`, `username`, `email`, `pwd`, `rolle`) VALUES
(1, 'herr', 'Lucjan', 'Lubomski', 'Luxor', 'lucjan.lubomski@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVlZelNkazVISnRQckx5TQ$9NmKD0eQQRjf4M6hmMT+MI3vun/MKP0BHyV1amyuYKk', 'user'),
(2, 'herr', '123', '123', '123', '123@123', '$argon2id$v=19$m=65536,t=4,p=1$Sno0NTIybVBub0YydWw2RA$NYRCvte8KQwFV6uwoGEWm2AgTL8GyGR9Wiqe1DTOXjw', 'user'),
(8, 'herr', 'Admin', 'Admin', 'admin', 'admin@admin', '$argon2id$v=19$m=65536,t=4,p=1$L21MelBLci8wR2VTTEFEaQ$AXjCWn/HidYdbfzWRSEToQKsh5OrIxVtTiAyBGvEhj0', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roomid` (`roomid`),
  ADD KEY `fk_userid` (`userid`);

--
-- Indexes for table `news_articles`
--
ALTER TABLE `news_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userauth`
--
ALTER TABLE `userauth`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_roomid` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
