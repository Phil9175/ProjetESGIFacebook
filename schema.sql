-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Lun 07 Décembre 2015 à 10:50
-- Version du serveur :  5.5.42-log
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `concoursphotos`
--

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE `concours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `award` text NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `status` boolean NOT NULL,
  `ranking` text NULL,
  `logo` varchar(255) NULL,
  `font` varchar(255) NULL,
  `font_family` varchar(255) NULL,
  PRIMARY KEY(id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` bigint NOT NULL,
  `name` varchar(75) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `gender` boolean NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` DATETIME NULL,
  `city` varchar(50) NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY(id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id_concours` int(11) NOT NULL,
  `id_participant` bigint NOT NULL,
  `id_photo` bigint NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,

  PRIMARY KEY(`id_concours`,`id_participant`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;


ALTER TABLE participation add foreign key (id_concours) References concours(id);
ALTER TABLE participation add foreign key (id_participant) References participant(id);