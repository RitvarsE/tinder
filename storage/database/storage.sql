-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tinder
CREATE DATABASE IF NOT EXISTS `tinder` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `tinder`;

-- Dumping structure for table tinder.favorites
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `favorite_id` int(11) NOT NULL,
  `favorite` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tinder.favorites: ~0 rows (approximately)
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
INSERT INTO `favorites` (`id`, `user_id`, `favorite_id`, `favorite`) VALUES
	(36, 19, 29, 1),
	(37, 19, 30, 1),
	(38, 19, 31, 1),
	(39, 19, 32, 0),
	(40, 19, 33, 1),
	(41, 19, 34, 0),
	(42, 19, 35, 1),
	(43, 19, 36, 0),
	(44, 19, 37, 1),
	(45, 19, 38, 0),
	(46, 25, 29, 1),
	(47, 38, 21, 1),
	(48, 38, 20, 1),
	(49, 38, 19, 0),
	(50, 38, 22, 0),
	(51, 38, 28, 0),
	(52, 38, 25, 1),
	(53, 38, 24, 1),
	(54, 38, 23, 1),
	(55, 38, 27, 0),
	(56, 38, 26, 0);
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;

-- Dumping structure for table tinder.images
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `original_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`image_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tinder.images: ~1 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`image_id`, `user_id`, `original_name`, `path`) VALUES
	(27, 0, 'NoAvatar.jpg', 'images/noAvatar.jpg'),
	(61, 19, 'man1.jpg', '/images/bx/3q/rlbx3qwoeP.BA1619382209.jpeg'),
	(62, 19, 'man2.jpg', '/images/rD/x7/rlrDx7VB2bXqA1619382225.jpeg'),
	(63, 30, 'woman2.jpg', '/images/Tn/VC/rlTnVCe.SXcwE1619382248.jpeg'),
	(64, 30, 'woman3.jpg', '/images/yE/UT/rlyEUTFYcZKZo1619382262.jpeg'),
	(65, 20, 'man2.jpg', '/images/rD/x7/rlrDx7VB2bXqA1619382300.jpeg'),
	(66, 21, 'man3.jpg', '/images/vW/8p/rlvW8pE5CCH7Q1619382339.jpeg'),
	(67, 22, 'man4.jpg', '/images/78/m6/rl78m6MEDwtuE1619382359.jpeg'),
	(68, 23, 'man5.jpg', '/images/49/vX/rl49vXHEtLrRY1619382386.jpeg'),
	(69, 24, 'man6.jpg', '/images/iy/Fu/rliyFuYZvXnFA1619382407.jpeg'),
	(70, 25, 'man7.jpg', '/images/7q/RW/rl7qRWIJSICZA1619382480.jpeg'),
	(71, 26, 'man8.jpg', '/images/gq/ek/rlgqekLLYI9bI1619382502.jpeg'),
	(72, 27, 'man10.jpg', '/images/of/W4/rlofW4ZdNu4zs1619382522.jpeg'),
	(73, 29, 'woman3.jpg', '/images/yE/UT/rlyEUTFYcZKZo1619382665.jpeg'),
	(74, 31, 'woman4.jpg', '/images/Sw/jo/rlSwjoMY9eqIE1619382691.jpeg'),
	(75, 32, 'woman6.jpg', '/images/pf/Me/rlpfMeEJ2l86.1619382781.jpeg'),
	(76, 33, 'woman7.jpg', '/images/Dp/Io/rlDpIoG3RpZO.1619382800.jpeg'),
	(77, 34, 'woman8.jpg', '/images/uv/Xi/rluvXiRvBiM5M1619382819.jpeg'),
	(78, 35, 'woman9.jpg', '/images/O7/5K/rlO75K95MpBeI1619382834.jpeg'),
	(79, 36, 'woman10.jpg', '/images/AA/8f/rlAA8fGpJPP0o1619382850.jpeg'),
	(80, 38, 'women1.jpg', '/images/p1/kQ/rlp1kQo3igp.U1619382869.jpeg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for table tinder.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `profile_picture` int(11) NOT NULL DEFAULT '27',
  `gender` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table tinder.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `password`, `age`, `profile_picture`, `gender`, `date_created`) VALUES
	(19, 'Ritvars', '$2y$10$QQHVv7wPz7AEtkGhNTvghuooawKOq/2nH6nn1TNENBEyRPQdlH5w6', 25, 61, 1, '2021-04-25 23:02:35'),
	(20, 'Arturs', '$2y$10$m55zKj6NjdyFzbyZJLrT.uizJeUON8cewMqmZJjpjBXXzQLx2WqQ2', 25, 65, 1, '2021-04-25 23:11:01'),
	(21, 'Karlis', '$2y$10$SSAFNXFmDCy1HcZbJ74JiuYZD0tNegpJuC6afl7x.VH5L/EO9ww7u', 25, 66, 1, '2021-04-25 23:11:15'),
	(22, 'Janis', '$2y$10$INxH14e2cgPyaSiZN.JQO.r/qXD7ye/wy.Orz.tngqNT3Y.I7AycS', 25, 67, 1, '2021-04-25 23:11:58'),
	(23, 'Aivars', '$2y$10$Sd/6g0bSR3WmybE6g7X8aO4UJT7AWgXrcNrRg9ma0ZtpFltKArYXK', 25, 68, 1, '2021-04-25 23:18:50'),
	(24, 'VitÄlijs', '$2y$10$5Jenad/qjb5rVNADK45e2eNWEwizi1iTGs1.ceScyoC6WAHCYS0ZO', 25, 69, 1, '2021-04-25 23:20:16'),
	(25, 'Zigurds', '$2y$10$ZI00x9jpD9g3j4qo4V/oqufg/ssD21f8zVt6tjZS0nZcD1KTHQAWa', 25, 70, 1, '2021-04-25 23:21:08'),
	(26, 'Ivars', '$2y$10$eP7mBLfM6dKHqpjFq1Xxd.RtPCUhlEo.cnh5Khx7R1NWuGXwz/Uh6', 25, 71, 1, '2021-04-25 23:21:08'),
	(27, 'Deniss', '$2y$10$.s2W18tlu596FvIMtX31Xuc.orgwGm/6pNQl0HSyNu01yNFyCUZm2', 25, 72, 1, '2021-04-25 23:21:08'),
	(28, 'Reinis', '$2y$10$0AzBrQ8WjCocAIGAcZIrA.NwSGlYgtYCAhRoNrpNvUKqftlPh5DHC', 25, 27, 1, '2021-04-25 23:21:08'),
	(29, 'Daiga', '$2y$10$AFxkNxkncJcv0SOrtk7Nx.DEp1NPSxxH5qfqGUFNnIrrq9DnDHHQy', 25, 73, 0, '2021-04-25 23:22:45'),
	(30, 'Agnese', '$2y$10$Taxhrc3mG4ekaSekaZmAbeWskGAc.4cuiH9VKoPT12oaMTIfAMMei', 25, 63, 0, '2021-04-25 23:22:45'),
	(31, 'Inese', '$2y$10$04DUuojmIt4t9td9R14EV.p7Kl/6JBkbgNyt8Em2ZRpZvUBZJ.qnm', 25, 74, 0, '2021-04-25 23:22:45'),
	(32, 'Rasa', '$2y$10$K6L7AFPsqBPy1ii6SZdH6.Mmjbc3THd0XPGpivDDfR1hBPoQSQ8Nu', 25, 75, 0, '2021-04-25 23:22:45'),
	(33, 'RegÄ«na', '$2y$10$TI6A/A4picUytYMD5XNHyOymgyflNtUHR7OA02kMoetuKcVUFKFLu', 25, 76, 0, '2021-04-25 23:22:45'),
	(34, 'KarÄ«na', '$2y$10$wNy1Bgl.3rIcY3I06HtAjuVQ1UOJZKpNfbUSMcOfdKsQtjuSFR.Le', 25, 77, 0, '2021-04-25 23:22:45'),
	(35, 'Laila', '$2y$10$F8Yf2i.vWmKo8.UY0S3ycuIq9QcnxWHhdKSts.bDTodjxB7EMeZcq', 25, 78, 0, '2021-04-25 23:22:45'),
	(36, 'KristÄ«ne', '$2y$10$zDZTyKj3fyRBVtoMn4pw3euBQRAKtVmGA5ZIVcANSaA1AgzNZVmj6', 25, 79, 0, '2021-04-25 23:22:46'),
	(37, 'JÅ«lija', '$2y$10$yPo1LkKIVc26YBSIUsMCsuBQS0G6/zhrK0JgUx4zHDZQu/4zW/47K', 25, 27, 0, '2021-04-25 23:22:46'),
	(38, 'DiÄna', '$2y$10$FSrch4BqOr5KCb3Jho.2judGJciMC8A.pKISllovonTY2k8xoXVQu', 25, 80, 0, '2021-04-25 23:22:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
