-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 08:18 PM
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
  `roomid` int(10) UNSIGNED DEFAULT NULL,
  `booking_submitted` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `userid`, `start`, `end`, `extras`, `price`, `status`, `roomid`, `booking_submitted`) VALUES
(10, 1, '2024-12-29', '2024-12-31', NULL, 200, 'neu', 4, '2024-12-29'),
(11, 1, '2024-12-29', '2024-12-31', NULL, 200, 'neu', 5, '2024-12-29'),
(12, 1, '2024-12-29', '2025-01-02', NULL, 400, 'neu', 1, '2024-12-29'),
(13, 1, '2024-12-30', '2024-12-31', NULL, 100, 'neu', 2, '2024-12-29'),
(14, 1, '2025-02-28', '2025-03-16', 'Parkplatz,Frühstück', 2096, 'neu', 3, '2024-12-29'),
(15, 1, '2024-12-29', '2024-12-31', NULL, 200, 'neu', 3, '2024-12-29'),
(16, 1, '2025-01-08', '2025-02-12', 'Parkplatz,Frühstück', 15085, 'neu', 12, '2024-12-29'),
(17, 1, '2024-12-30', '2024-12-31', NULL, 170, 'neu', 6, '2024-12-30'),
(18, 1, '2024-12-30', '2024-12-31', NULL, 170, 'neu', 7, '2024-12-30'),
(19, 1, '2024-12-30', '2024-12-31', NULL, 170, 'neu', 8, '2024-12-30'),
(20, 1, '2024-12-30', '2024-12-31', NULL, 170, 'neu', 9, '2024-12-30'),
(21, 10, '2025-01-01', '2025-01-02', NULL, 100, 'storniert', 2, '2024-12-30'),
(22, 10, '2025-01-01', '2025-01-02', NULL, 100, 'storniert', 2, '2024-12-30'),
(23, 10, '2025-01-01', '2025-01-02', NULL, 100, 'neu', 4, '2024-12-30'),
(24, 10, '2025-01-01', '2025-01-02', NULL, 100, 'neu', 5, '2024-12-30'),
(25, 10, '2025-01-01', '2025-01-02', NULL, 100, 'neu', 3, '2024-12-30'),
(26, 10, '2025-01-01', '2025-01-02', NULL, 100, 'bestätigt', 2, '2024-12-30'),
(27, 1, '2025-01-06', '2025-01-08', NULL, 200, 'neu', 1, '2025-01-05'),
(28, 1, '2025-01-06', '2025-01-08', NULL, 200, 'neu', 2, '2025-01-05'),
(29, 1, '2025-01-07', '2025-01-16', NULL, 900, 'neu', 4, '2025-01-05'),
(30, 1, '2025-01-06', '2025-01-09', NULL, 300, 'neu', 5, '2025-01-05'),
(31, 1, '2025-01-30', '2025-02-08', NULL, 900, 'neu', 1, '2025-01-05'),
(32, 1, '2025-02-03', '2025-02-09', NULL, 600, 'neu', 2, '2025-01-05');

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
(23, 'Neue Grafikkarten', '🚀 Upgrade-Zeit: Neue Nvidia RTX 4090 in unseren Gaming-PCs! 🎮🔥<br>\r\nUnser Gaming-Hotel erreicht ein neues Performance-Level! 💥...', '🚀 Upgrade-Zeit: Neue Nvidia RTX 4090 in unseren Gaming-PCs! 🎮🔥<br>\r\nUnser Gaming-Hotel erreicht ein neues Performance-Level! 💥 Wir freuen uns, euch mitteilen zu können, dass unsere Gaming-PCs ab sofort mit der brandneuen Nvidia RTX 4090 ausgestattet sind – der leistungsstärksten Grafikkarte auf dem Markt!<br>\r\nWas bedeutet das für euch?<br>\r\n<br>\r\n🌟 Unglaubliche Grafikqualität – Erlebt Raytracing in Perfektion und realistische Details wie nie zuvor.<br>\r\n⚡ Höchste Leistung – Egal, ob ihr AAA-Titel, kompetitive Games oder VR erleben wollt – die RTX 4090 liefert stets flüssige Framerates.<br>\r\n🎮 Maximales Spielerlebnis – Perfekt abgestimmt mit unseren Razer-Peripheriegeräten für ultimatives Gameplay.<br>\r\n<br>\r\nTaucht ein in eine neue Dimension des Gamings – mit einer Hardware, die keine Wünsche offen lässt. Unsere PCs sind bereit. Seid ihr es auch?<br>\r\n<br>\r\n📅 Jetzt buchen und die Power der RTX 4090 erleben!<br>', '../Public/uploads/thumbnails/rtx-4090.jpg', '2024-11-18'),
(24, 'Göppel Hotels Cash Cup: Neues Counter-Strike-Turnier!', 'Es ist wieder soweit – wir hosten ein neues Counter-Strike: Global Offensive Turnier! Bereitet euch vor auf spannende Matches,...', 'Göppel Hotels Cash Cup: Neues Counter-Strike-Turnier!<br>\r\n<br>\r\nEs ist wieder soweit – wir hosten ein neues Counter-Strike: Global Offensive Turnier! Bereitet euch vor auf spannende Matches, taktische Glanzmomente und epische Clutches.<br>\r\nTurnier-Infos:<br>\r\n<br>\r\nZu Beginn des neuen Jahres startet der Göppel Hotels Cash Cup, und ihr könnt dabei sein!<br>\r\n<br>\r\n📅 Turnier-Wochenenden:<br>\r\n<br>\r\n18.1 - 19.1<br>\r\n25.1 - 26.1<br>\r\n<br>\r\n💣 Spielmodi:<br>\r\n<br>\r\n5v5-Team-Modus: Stellt euer Team auf und tretet gegen andere an.<br>\r\nFree-for-All Deathmatch: Zeigt eure Skills im Solo-Format!<br>\r\n<br>\r\nAnmeldung:<br>\r\n<br>\r\nMeldet euch bis spätestens 10.1 an und sichert euch euren Platz!\r\nWas gibt es zu gewinnen?<br>\r\n<br>\r\nNeben Ruhm und Ehre winken fette Preise für die besten Spieler und Teams!<br>\r\n<br>\r\nJetzt heißt es: Trainiert eure Aim-Skills und plant eure Taktiken, denn der Göppel Hotels Cash Cup wird legendär. Seid dabei und zeigt, was ihr draufhabt! 🧨<br>', '../Public/uploads/thumbnails/esport_players.jpg', '2024-12-26'),
(26, 'Neue Ausrüstung - Kooperation mit Razer', 'Wir haben aufregende Neuigkeiten für alle Gaming-Enthusiasten! Dank unserer brandneuen Kooperation mit Razer, einem der ...', 'Wir haben aufregende Neuigkeiten für alle Gaming-Enthusiasten! Dank unserer brandneuen Kooperation mit Razer, einem der weltweit führenden Anbieter von Gaming-Peripherie, heben wir das Gaming-Erlebnis in unserem Hotel auf das nächste Level. <br>\r\nAb sofort erwarten euch an unseren Gaming-Stationen die neuesten Produkte von Razer: <br>\r\n✅Razer DeathAdder V3 Pro – Eine ultra-leichte Gaming-Maus für Präzision und Komfort <br>\r\n✅Razer Gigantus V2 XXL – Ein extra großes Mauspad für optimale Kontrolle und grenzenlose Bewegungsfreiheit <br>\r\n✅Razer BlackShark V2 – Ein Headset der Spitzenklasse mit THX Spatial Audio für immersiven Sound und klare Kommunikation. <br>\r\n📅 Jetzt reservieren und loslegen!', '../Public/uploads/thumbnails/chroma-2023-enjoy-1920x700.jpg', '2024-12-27'),
(27, 'Valorant Turnier 10.01.2024', '🎯🔥 Valorant-Turnier im Gaming-Hotel: Bist du bereit? 🔥🎯 <br>\r\nEs ist Zeit, eure Skills unter Beweis zu stellen! Wir lade...', '🎯🔥 Valorant-Turnier im Gaming-Hotel: Bist du bereit? 🔥🎯 <br>\r\nEs ist Zeit, eure Skills unter Beweis zu stellen! Wir laden euch herzlich zu unserem Valorant-Turnier ein – ein Event, das Adrenalin, Teamwork und eure besten Moves vereint!<br>\r\nDie Modi:<br>\r\n🛡️ 5v5-Team-Modus<br>\r\nStellt euer Team aus fünf Spielern zusammen und kämpft gegen andere Teams in spannenden Matches.<br>\r\nMaximal 5 Teams können teilnehmen – also meldet euch schnell an!<br>\r\n⚔️ Free for All Deathmatch<br>\r\nJeder gegen jeden! Testet eure Reflexe und dominiert das Match, um die Krone als ultimativer Valorant-Champion zu sichern.<br>\r\nDetails:<br>\r\n📅 Datum: 10.01.2024<br>\r\n⏰ Uhrzeit: 15:00 Uhr<br>\r\n<br>\r\nPreise:<br>\r\n🏆 Für die Siegerteams und den Free-for-All-Champion gibt es epische Preise, darunter Gaming-Goodies und Hotel-Gutscheine!<br>\r\nZeigt, was ihr draufhabt, und erlebt das ultimative Valorant-Feeling in unserer neuen Razer-optimierten Gaming-Arena. 💚<br>\r\n<br>\r\n👉 Anmeldung: Meldet euch und euer Team bis 7.01.2024 an! Plätze sind begrenzt!\r\n', '../Public/uploads/thumbnails/Valorant_Tournaments_1.jpeg', '2024-12-27');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` enum('single','duo','squad') NOT NULL
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
(6, 'duo'),
(7, 'duo'),
(8, 'duo'),
(9, 'duo'),
(10, 'squad'),
(11, 'squad'),
(12, 'squad'),
(13, 'squad'),
(14, 'squad'),
(15, 'squad');

--
-- Triggers `rooms`
--
DELIMITER $$
CREATE TRIGGER `ROOM DELETE` BEFORE DELETE ON `rooms` FOR EACH ROW UPDATE bookings
SET status = 'storniert'
WHERE roomid = OLD.id
$$
DELIMITER ;

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
(1, '$argon2id$v=19$m=65536,t=4,p=1$NUZVbGd0MUV3R2RJNkZxUw$nit6nhYSCetS4PWHNPHc+lFNDAIgirjX/c2a4Vtn1hk', '2025-01-13'),
(8, '$argon2id$v=19$m=65536,t=4,p=1$MURHRVRuelNDLlFhMGRJeg$q3PgWZnvRo9CyFR4HUfmqpzu2k6tVQEDNfy66zpLHMI', '2025-01-06'),
(10, '$argon2id$v=19$m=65536,t=4,p=1$M3ZYRC96ZFVTclRiQnpjOQ$PqOkNnclLfNk4rO7oVa7REIFMcBIJlPYxiie8sOeQeA', '2025-01-06');

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
  `rolle` enum('admin','user') NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `anrede`, `name`, `nachname`, `username`, `email`, `pwd`, `rolle`, `status`) VALUES
(1, 'herr', 'Lucjan', 'Lubomski', 'Luxor', 'lucjan.lubomski@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QVlZelNkazVISnRQckx5TQ$9NmKD0eQQRjf4M6hmMT+MI3vun/MKP0BHyV1amyuYKk', 'user', 'active'),
(2, 'herr', '123', '123', '123', '123@123', '$argon2id$v=19$m=65536,t=4,p=1$Sno0NTIybVBub0YydWw2RA$NYRCvte8KQwFV6uwoGEWm2AgTL8GyGR9Wiqe1DTOXjw', 'user', 'active'),
(8, 'herr', 'Admin', 'Admin', 'admin', 'admin@admin', '$argon2id$v=19$m=65536,t=4,p=1$L21MelBLci8wR2VTTEFEaQ$AXjCWn/HidYdbfzWRSEToQKsh5OrIxVtTiAyBGvEhj0', 'admin', 'active'),
(9, 'herr', 'Test', 'Test', 'test', 'test@test', '$argon2id$v=19$m=65536,t=4,p=1$V0IwejhOSWdwc0JKaldSMQ$G+6tlxi0RwuFbxlVDld+iGVN19Y6yZTOeGj3T/IffFw', 'user', 'inactive'),
(10, 'divers', 'Bombo', 'Claat', 'Bomboclaat', 'bombo.claat@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$Y2NURTFZQkZZL2RieTVubA$u5aVe+sKTrlZpGzSODdwnODf+qsZ5TnlfojNGS2CRZs', 'user', 'active');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `news_articles`
--
ALTER TABLE `news_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_roomid` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_expired_bookings` ON SCHEDULE EVERY 1 DAY STARTS '2024-12-29 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM bookings WHERE end < CURDATE()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
