SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";

--
-- Database: `takenlijst`
--
DROP DATABASE IF EXISTS `takenlijst`;
CREATE DATABASE IF NOT EXISTS `takenlijst` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `takenlijst`;

--
-- Tabel: `taken`
--

DROP TABLE IF EXISTS `taken`;
CREATE TABLE IF NOT EXISTS `taken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taak` varchar(255) NOT NULL,
  `taakgever` varchar(255) DEFAULT NULL,
  `beschrijving` varchar(255) DEFAULT NULL,
  `afdeling` enum('horeca', 'attracties', 'merchandise') NOT NULL,
  `voortgang` enum('todo', 'in progress', 'done') NOT NULL,
  `deadline` date DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `datum_aangemaakt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`naam`, `username`, `password`) VALUES ('Testgebruiker 1', 'user1', '$2y$10$XQwbcsOWgM0KvAbya2Ad2efBwTLra2CzeduJtAuY8.BW9EHx.cFKa');
INSERT INTO `users` (`naam`, `username`, `password`) VALUES ('Testgebruiker 2', 'user2', '$2y$10$HoDxSJa/4NcFcJ.U.kj9N.cSBgcm75IwUkdgxJhLjRXY/K2cP8Fl.');
INSERT INTO `users` (`naam`, `username`, `password`) VALUES ('Testgebruiker 3', 'user3', '$2y$10$M7vkYfdWMYqLzvCqjlOh7.nPc79zwDxtItUOh/91teGikS/XrpNuO');
