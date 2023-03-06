-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           10.10.3-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour koppagenda
CREATE DATABASE IF NOT EXISTS `koppagenda` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `koppagenda`;

-- Listage de la structure de table koppagenda. calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_calendar_user_idx` (`user_id`),
  CONSTRAINT `fk_calendar_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table koppagenda.calendar : ~2 rows (environ)
DELETE FROM `calendar`;
INSERT INTO `calendar` (`id`, `title`, `description`, `user_id`) VALUES
	(1, 'test1', 'ceci est le test 1', 3),
	(2, 'test2', 'ceci est le test 2', 3),
	(3, 'Mon Agenda', 'c\'est le mien', 1);

-- Listage de la structure de table koppagenda. calendar_has_event
CREATE TABLE IF NOT EXISTS `calendar_has_event` (
  `calendar_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`calendar_id`,`event_id`),
  KEY `fk_calendar_has_event_event1_idx` (`event_id`),
  KEY `fk_calendar_has_event_calendar1_idx` (`calendar_id`),
  CONSTRAINT `fk_calendar_has_event_calendar1` FOREIGN KEY (`calendar_id`) REFERENCES `calendar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_calendar_has_event_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table koppagenda.calendar_has_event : ~2 rows (environ)
DELETE FROM `calendar_has_event`;
INSERT INTO `calendar_has_event` (`calendar_id`, `event_id`) VALUES
	(1, 1),
	(2, 2);

-- Listage de la structure de table koppagenda. event
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `place` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table koppagenda.event : ~2 rows (environ)
DELETE FROM `event`;
INSERT INTO `event` (`id`, `title`, `description`, `start`, `end`, `place`) VALUES
	(1, 'test1', 'ce test 1', '2023-03-03 11:06:36', '2023-03-03 21:06:37', 'ici'),
	(2, 'test2', 'ce test 2', '2023-03-04 02:30:12', '2023-03-06 12:30:17', 'la');

-- Listage de la structure de table koppagenda. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `token` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Listage des données de la table koppagenda.user : ~5 rows (environ)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `email`, `name`, `password`, `token`) VALUES
	(1, 'sebastien@moraz.net', 'seb', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '12344567'),
	(2, 'kevin@gomes.net', 'kevin', '1234', '1235'),
	(3, 'testuser@exemple.com', 'test', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', 'exemple_token'),
	(4, 'testCreate@demo.com', 'testCreate', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '2f75d8d6bcf247c08c08437e51681d53f57e26acb4f69562535fcd602b8c3c45'),
	(5, 'jonatan@perret.ch', 'jojo', 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', '9a2d9f967b429954ea99e3322717e63bfab51ea48f7d64fc023ac96f281e4290');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
