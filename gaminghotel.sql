-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 06:39 PM
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
  `userid` int(10) UNSIGNED NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `extras` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `status` enum('neu','bestätigt','storniert') NOT NULL DEFAULT 'neu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `start`, `end`, `extras`, `price`, `status`) VALUES
(1, 1, '2024-12-14', '2024-12-19', NULL, 500, 'neu'),
(2, 1, '2024-12-16', '2024-12-19', NULL, 300, 'neu'),
(3, 1, '2024-12-20', '2024-12-27', 'Parkplatz,Frühstück', 917, 'neu'),
(4, 1, '2024-12-24', '2024-12-26', 'Frühstück,Haustiere', 256, 'neu'),
(5, 8, '2024-12-24', '2024-12-27', 'Parkplatz,Frühstück,Haustiere', 423, 'neu'),
(6, 1, '2024-12-16', '2024-12-20', 'Parkplatz,Frühstück', 524, 'neu'),
(7, 1, '2024-12-22', '2024-12-23', 'Parkplatz,Frühstück', 231, 'neu');

-- --------------------------------------------------------

--
-- Table structure for table `news_articles`
--

CREATE TABLE `news_articles` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sub` tinytext NOT NULL,
  `content` text NOT NULL,
  `img_path` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_articles`
--

INSERT INTO `news_articles` (`id`, `title`, `sub`, `content`, `img_path`) VALUES
(2, 'Test', 'Ich teste diesmal den sub aus und hoffe das ein Te', 'Ich teste diesmal den sub aus und hoffe das ein Teil vom Text in $sub gespeichert wird', '../Public/uploads/thumbnails/IMG-20230119-WA0012.jpg'),
(4, 'lorem', 'Lorem ipsum dolor sit amet, consetetur sadipscing ...', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '../Public/uploads/thumbnails/501st-stormtroopers-main_525e6786.jpeg'),
(5, 'Juhu', 'Es funktioniert alles!...', 'Es funktioniert alles!', '../Public/uploads/thumbnails/1200Oersted-Versuch_Versuchsaufbau_klein.jpg'),
(6, 'Counter-Strike Turnier', 'Es ist wieder soweit: Wir hosten ein neues Counter...', 'Es ist wieder soweit: Wir hosten ein neues Counter Strike Turnier! \r\nWann das Turnier stattfindet und wie ihr euch anmelden könnt, erfahrt ihr in diesem Artikel!', '../Public/uploads/thumbnails/esport_players.jpg'),
(7, 'Neue Grafikkarten', 'Für die beste performance und ein noch besserer Er...', 'Für die beste performance und ein noch besserer Erlebnis haben wir ab jetzt in allen PC\'s Nvidias RTX 4090er Grafikkarten eingebaut.', '../Public/uploads/thumbnails/rtx-4090.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userauth`
--

CREATE TABLE `userauth` (
  `userid` int(10) UNSIGNED NOT NULL,
  `tokenhash` varchar(97) NOT NULL,
  `token_expires` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userauth`
--

INSERT INTO `userauth` (`userid`, `tokenhash`, `token_expires`) VALUES
(1, '$argon2id$v=19$m=65536,t=4,p=1$cy4zemthLzJWNjh1ZGFIVw$AFQz8Tod9AAAJ25UMnaIyCxEJPgdWvDqN1A8vgJ4M98', '2024-12-29'),
(8, '$argon2id$v=19$m=65536,t=4,p=1$MHdqQXdxbkU5Q2JoYURERg$JVUIVzF6z4zgd7MgXZQnaPo16Ke/olifLRqIpKtEanI', '2025-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_articles`
--
ALTER TABLE `news_articles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
