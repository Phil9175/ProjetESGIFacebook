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
  `description` varchar(255) NOT NULL,
  `award` int(11) NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `status` varchar(25) NOT NULL,
  `ranking` text NULL,
  'logo' varchar(255) NOT NULL
  PRIMARY KEY(id)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `firstname` varchar(75) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` DATETIME NOT NULL,
  `city` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY(id)) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id_concours` int(11) NOT NULL,
  `id_participant` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  PRIMARY KEY(`id_concours`,`id_participant`)) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE participation add foreign key (id_concours) References concours(id);
ALTER TABLE participation add foreign key (id_participant) References participant(id);