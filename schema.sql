-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Mar 16 Février 2016 à 19:51
-- Version du serveur :  5.1.73
-- Version de PHP :  5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `concoursphotosesgi`
--

-- --------------------------------------------------------

--
-- Structure de la table `concours`
--

CREATE TABLE `concours` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `description` text NOT NULL,
  `award` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ranking` text,
  `logo` varchar(255) DEFAULT NULL,
  `font` varchar(255) DEFAULT NULL,
  `font_family` varchar(255) DEFAULT NULL,
  `font_color` varchar(24) DEFAULT NULL,
  `background_color` varchar(24) DEFAULT NULL,
  `max_per_page` int(255) DEFAULT NULL,
  `methode_notification` varchar(20) DEFAULT NULL,
  `is_notify` int(255) DEFAULT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `concours`
--

INSERT INTO `concours` (`id`, `name`, `description`, `award`, `start_date`, `end_date`, `status`, `ranking`, `logo`, `font`, `font_family`, `font_color`, `background_color`, `max_per_page`) VALUES
(1, 'yrdy', '<p>ytr</p>\r\n', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'N;', NULL, NULL, NULL, '', '', 8);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `id_participant` bigint(20) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `participant`
--

INSERT INTO `participant` (`id`, `id_participant`, `first_name`, `last_name`, `gender`, `email`, `birthdate`, `city`) VALUES
(1, 10208518914714290, 'Pierre', 'Gr', 1, 'philgranger@orange.fr', '1991-08-30', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id` bigint(20) NOT NULL,
  `id_concours` int(11) NOT NULL,
  `id_participant` bigint(20) NOT NULL,
  `id_photo` bigint(20) NOT NULL,
  `id_photo_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `logo_societe` text NOT NULL,
  `nom_societe` varchar(60) NOT NULL,
  `mail_host` varchar(80) NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_username` varchar(80) NOT NULL,
  `mail_password` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `logo_societe`, `nom_societe`, `mail_host`, `mail_port`, `mail_username`, `mail_password`) VALUES
(1, '/fichiers/f4bad8e9a3dda4899a1af56d5151cdb07de6a7d0.png', 'Societe Client', 'concoursphotosesgi.com', 80, 'test@concoursphotosesgi.com', 'motdepasse');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `concours`
--
ALTER TABLE `concours`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id_participant`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concours` (`id_concours`),
  ADD KEY `id_participant` (`id_participant`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `concours`
--
ALTER TABLE `concours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `participation_ibfk_1` FOREIGN KEY (`id_concours`) REFERENCES `concours` (`id`),
  ADD CONSTRAINT `participation_ibfk_2` FOREIGN KEY (`id_participant`) REFERENCES `participant` (`id_participant`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
