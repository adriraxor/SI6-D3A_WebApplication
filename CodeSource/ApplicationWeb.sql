CREATE DATABASE IF NOT EXISTS `application_web`
 DEFAULT CHARACTER SET utf8
COLLATE utf8_general_ci ;

USE `application_web`;


--
-- Structure de la table `d3a_ticket`
--

DROP TABLE IF EXISTS `d3a_ticket`;
CREATE TABLE IF NOT EXISTS `d3a_ticket` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `expediteur` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `nom_salle` int NOT NULL,
  `incidents` int(255) NOT NULL,
  `priorite_ticket` int(1) NOT NULL,
  `dateOuverture` date NOT NULL,
  CONSTRAINT fk_ticket_salle FOREIGN KEY (`nom_salle`) REFERENCES `d3a_salle` (`idSalle`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_ticket`
--

INSERT INTO `d3a_ticket` (`id`, `expediteur`, `destinataire`, `message`, `nom_salle`, `incidents`, `priorite_ticket`, `dateOuverture`) VALUES
(1, 'user', 'admin', 'Bonjour, nous constatons une panne rÃ©seau dans la salle 117.       \r\n                  ', 117, 1, 2, '2020-04-23');

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_ticketresponse`
--

INSERT INTO `d3a_ticketresponse` (`id`, `message`, `destinataire`, `expediteur`) VALUES
(1, 'Bonjour, nous sommes actuellement en train de traiter votre demande veuillez patientez. Merci.         ', 'user', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `d3a_user`
--

DROP TABLE IF EXISTS `d3a_user`;
CREATE TABLE IF NOT EXISTS `d3a_user` (
  `id` int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `statut` int(1) NOT NULL COMMENT 'Plus le chiffre est faible plus il est important',
  CONSTRAINT fk_user_statut FOREIGN KEY (`statut`) REFERENCES `d3a_statut` (`idStatut`)

) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `d3a_user`
--

INSERT INTO `d3a_user` (`id`, `pseudo`, `password`, `email`, `statut`) VALUES
(1, 'admin', 'toor', 'admin@gmail.com', 1),
(2, 'user', 'user', 'user@gmail.com', 5);




DROP TABLE IF EXISTS `d3a_statut`;
CREATE TABLE `d3a_statut`
(
  `idStatut` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `libelleStatut` varchar(50)
)
ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `d3a_statut`(`idStatut` , `libelleStatut`) VALUES
(1, 'Gestionnaire de Section'),
(2, 'Professeur principal'),
(3, 'Professeur'),
(4, 'Etudiant 2nd année'),
(5, 'Etudiant 1ère année');


DROP TABLE IF EXISTS `d3a_salle`;
CREATE TABLE `d3a_salle`
(
  `idSalle` int NOT NULL PRIMARY KEY,
  `batimentSalle` varchar(10),
  `libelleSalle` varchar(50)
)
ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `d3a_salle`(`idSalle` , `batimentSalle` ,  `libelleSalle`) VALUES
(111, 'i' , 'Salle de cours'),
(112, 'i' , 'Salle SISR'),
(117, 'i' , 'Salle SLAM'),
(113, 'i' , 'Salle de cours'),
(404, 'e' , 'Salle de Français'),
(316, 'e' , 'Salle Anglais');


DROP TABLE IF EXISTS `d3a_ordinateur`;
CREATE TABLE `d3a_ordinateur`
(
  `idOrdinateur` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `Marque` varchar(10),
  `Refprduitconstructeur` varchar(50),
  `processeur` varchar(50),
  `memoire_vive` varchar(50),
  `carte_graphique` varchar(50),
  `systeme_exploitation` varchar(50),
  `idSalle` int,
  CONSTRAINT fk_ordinateur_salle FOREIGN KEY (`idSalle`) REFERENCES `d3a_salle` (`idSalle`)
)
ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `d3a_ordinateur`(`Marque` ,  `Refprduitconstructeur` , `processeur` , `mémoire_vive` , `carte_graphique` , `système_exploitation`, `idSalle`) VALUES
('DEL', 'SIO-BdG_0001' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 111),
('DEL', 'SIO-BdG_0002' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 111),
('DEL', 'SIO-BdG_0003' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 111),
('DEL', 'SIO-BdG_0004' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 117),
('DEL', 'SIO-BdG_0005' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 117),
('DEL', 'SIO-BdG_0006' , 'Intel Core i3-9100F' , '2x8Go 2400Mhz', 'Asus GeForce GTX 1650 ROG STRIX 4G' , 'Windows Pro' , 117);
