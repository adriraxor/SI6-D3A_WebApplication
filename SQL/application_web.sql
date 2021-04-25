-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 15 fév. 2021 à 10:27
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `application_web`
--
CREATE DATABASE IF NOT EXISTS `application_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `application_web`;

-- --------------------------------------------------------

--
-- Structure de la table `d3a_ordinateur`
--

DROP TABLE IF EXISTS `d3a_ordinateur`;
CREATE TABLE IF NOT EXISTS `d3a_ordinateur` (
  `idOrdinateur` int(11) NOT NULL AUTO_INCREMENT,
  `Marque` varchar(10) DEFAULT NULL,
  `Refprduitconstructeur` varchar(50) DEFAULT NULL,
  `processeur` varchar(50) DEFAULT NULL,
  `memoire_vive` varchar(50) DEFAULT NULL,
  `carte_graphique` varchar(50) DEFAULT NULL,
  `systeme_exploitation` varchar(50) DEFAULT NULL,
  `idSalle` int(11) DEFAULT NULL,
  PRIMARY KEY (`idOrdinateur`),
  KEY `fk_ordinateur_salle` (`idSalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `d3a_salle`
--

DROP TABLE IF EXISTS `d3a_salle`;
CREATE TABLE IF NOT EXISTS `d3a_salle` (
  `idSalle` int(11) NOT NULL,
  `batimentSalle` varchar(10) DEFAULT NULL,
  `libelleSalle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idSalle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_salle`
--

INSERT INTO `d3a_salle` (`idSalle`, `batimentSalle`, `libelleSalle`) VALUES
(111, 'i', 'Salle de cours'),
(112, 'i', 'Salle SISR'),
(117, 'i', 'Salle SLAM'),
(113, 'i', 'Salle de cours'),
(404, 'e', 'Salle de Français'),
(316, 'e', 'Salle Anglais');

-- --------------------------------------------------------

--
-- Structure de la table `d3a_statut`
--

DROP TABLE IF EXISTS `d3a_statut`;
CREATE TABLE IF NOT EXISTS `d3a_statut` (
  `idStatut` int(11) NOT NULL AUTO_INCREMENT,
  `libelleStatut` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idStatut`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_statut`
--

INSERT INTO `d3a_statut` (`idStatut`, `libelleStatut`) VALUES
(1, 'Gestionnaire de Section'),
(2, 'Professeur principal'),
(3, 'Professeur'),
(4, 'Etudiant 2nd année'),
(5, 'Etudiant 1ère année');

-- --------------------------------------------------------

--
-- Structure de la table `d3a_ticket`
--

DROP TABLE IF EXISTS `d3a_ticket`;
CREATE TABLE IF NOT EXISTS `d3a_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expediteur` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `nom_salle` int(11) NOT NULL,
  `incidents` int(255) NOT NULL,
  `priorite_ticket` int(1) NOT NULL,
  `dateOuverture` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ticket_salle` (`nom_salle`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_ticket`
--

INSERT INTO `d3a_ticket` (`id`, `expediteur`, `destinataire`, `message`, `nom_salle`, `incidents`, `priorite_ticket`, `dateOuverture`) VALUES
(1, 'user', 'admin', 'Bonjour, nous constatons une panne rÃ©seau dans la salle 117.       \r\n                  ', 117, 1, 2, '2020-04-23'),
(2, 'admin', 'admin', 'Message test 28/04/2020\r\n                  ', 1, 2, 2, '2000-08-14'),
(4, 'admin', 'user', 'test\r\n                  ', 1, 2, 2, '1230-07-13'),
(5, 'Admin', 'user', 'Bonjour, je m\'appelle Lucas et je n\'arrive pas a me connecter Ã  votre ordinateur de la salle 116 (Pue sa grand mÃ¨re) ', 116, 0, 4, '2000-08-14'),
(6, 'Admin', 'admin', '\r\n                  Lucas', 1, 1, 4, '2202-12-14');

-- --------------------------------------------------------

--
-- Structure de la table `d3a_ticketresponse`
--

DROP TABLE IF EXISTS `d3a_ticketresponse`;
CREATE TABLE IF NOT EXISTS `d3a_ticketresponse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `expediteur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_ticketresponse`
--

INSERT INTO `d3a_ticketresponse` (`id`, `message`, `destinataire`, `expediteur`) VALUES
(1, 'Bonjour, nous sommes actuellement en train de traiter votre demande veuillez patientez. Merci.         ', 'user', 'admin'),
(2, '          response        ', 'user', 'admin'),
(3, '                  sdfgkld', 'admin', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `d3a_user`
--

DROP TABLE IF EXISTS `d3a_user`;
CREATE TABLE IF NOT EXISTS `d3a_user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `statut` int(1) NOT NULL COMMENT 'Plus le chiffre est faible plus il est important',
  PRIMARY KEY (`id`),
  KEY `fk_user_statut` (`statut`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_user`
--

INSERT INTO `d3a_user` (`id`, `pseudo`, `password`, `email`, `statut`) VALUES
(1, 'admin', 'toor', 'admin@gmail.com', 1),
(2, 'user', 'user', 'user@gmail.com', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
