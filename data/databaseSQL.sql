-- phpMyAdmin SQL Dump
-- version 5.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `Event`;
USE `Event`;

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_creation` date NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `personnes_maximum` int(11) NOT NULL,
  `lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `inscriptions` (
  `id` int(11) NOT NULL,
  `evenement_id` int(11) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evenement_id` (`evenement_id`);

ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`evenement_id`) REFERENCES `evenements` (`id`);

COMMIT;

CREATE USER IF NOT EXISTS 'event_user'@'localhost' IDENTIFIED BY 'motdepasseEvent123.';
GRANT ALL PRIVILEGES ON Event.* TO 'event_user'@'localhost';
FLUSH PRIVILEGES;