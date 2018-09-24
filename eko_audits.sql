-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 24 sep. 2018 à 21:15
-- Version du serveur :  5.6.35-cll-lve
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `of2ds84i_wp587`
--

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_affectation_element`
--

CREATE TABLE `audits2018_affectation_element` (
  `id` int(12) NOT NULL,
  `id_audit` varchar(12) NOT NULL,
  `id_element` varchar(12) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `ordre` varchar(12) NOT NULL,
  `nb` varchar(12) NOT NULL DEFAULT '1',
  `commentaires` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_affectation_element`
--

INSERT INTO `audits2018_affectation_element` (`id`, `id_audit`, `id_element`, `tag`, `categorie`, `ordre`, `nb`, `commentaires`) VALUES
(3, '1', '6', '', 'Postes de travail', '', '2', 'petit commentaire sur element PT'),
(4, '1', '11', '', 'Connexions Internet', '', '1', 'petit comment sur CI'),
(5, '1', '12', '', 'Téléphonie Fixe', '', '2', 'petit comment TF'),
(6, '1', '13', '', 'Téléphonie Mobile', '', '2', 'petit comment TM'),
(7, '1', '9', '', 'Réseau', '', '1', 'petit commentaire R'),
(8, '1', '8', '', 'Messagerie', '', '1', 'petit comment M'),
(9, '1', '7', '', 'Partage documentaire', '', '1', 'petit commentaire PD'),
(10, '1', '10', '', 'Logiciel', '', '2', 'petit commentaire L'),
(11, '1', '14', '', 'Antivirus', '', '2', 'petit commentaire A'),
(13, '1', '15', '', 'Sauvegarde', '', '1', 'petit commentaire S'),
(14, '1', '6', '', 'Postes de travail', '', '3', 'commentaire sur le deuxieme element PT');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_affectation_pts_forts_faibles`
--

CREATE TABLE `audits2018_affectation_pts_forts_faibles` (
  `id` int(12) NOT NULL,
  `id_audit` varchar(255) NOT NULL,
  `id_pts_forts_faibles` varchar(12) NOT NULL,
  `type` varchar(55) NOT NULL,
  `commentaires` text NOT NULL,
  `ordre` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_affectation_pts_forts_faibles`
--

INSERT INTO `audits2018_affectation_pts_forts_faibles` (`id`, `id_audit`, `id_pts_forts_faibles`, `type`, `commentaires`, `ordre`) VALUES
(1, '1', '', 'fort', 'Comment on Bonne structure', ''),
(2, '1', '2', 'fort', 'azeaze', ''),
(3, '1', '1', 'fort', 'aze ok', ''),
(4, '1', '3', 'faible', 'azeaze', '');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_affectation_specification`
--

CREATE TABLE `audits2018_affectation_specification` (
  `id` int(12) NOT NULL,
  `id_audit` varchar(12) NOT NULL,
  `id_affectation_element` varchar(12) NOT NULL,
  `id_specification` varchar(12) NOT NULL,
  `valeur` varchar(255) NOT NULL,
  `ordre` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_affectation_specification`
--

INSERT INTO `audits2018_affectation_specification` (`id`, `id_audit`, `id_affectation_element`, `id_specification`, `valeur`, `ordre`) VALUES
(1, '1', '0', '15', '', '1'),
(2, '1', '0', '16', '', '2'),
(3, '1', '0', '17', '', '3'),
(4, '1', '0', '18', '', '4'),
(5, '1', '0', '19', '', '5'),
(16, '1', '3', '25', 'aze', '1'),
(17, '1', '3', '26', 'aze', '2'),
(18, '1', '3', '27', 'aze', '3'),
(19, '1', '3', '28', 'aze', '4'),
(20, '1', '3', '29', 'aze', '5'),
(21, '1', '3', '30', '23%', '6'),
(22, '1', '3', '31', 'aze', '7'),
(23, '1', '3', '32', 'aze', '8'),
(24, '1', '4', '53', 'aze', '1'),
(25, '1', '4', '54', 'aze', '2'),
(26, '1', '4', '55', 'aze', '3'),
(27, '1', '4', '56', 'aze', '4'),
(28, '1', '4', '57', 'aze', '5'),
(29, '1', '5', '58', 'aze', '1'),
(30, '1', '5', '59', 'aze', '2'),
(31, '1', '5', '60', 'aze', '3'),
(32, '1', '5', '61', 'aze', '4'),
(33, '1', '5', '62', 'aze', '5'),
(34, '1', '6', '63', 'aze', '1'),
(35, '1', '6', '64', 'aze', '2'),
(36, '1', '6', '65', 'aze', '3'),
(37, '1', '6', '66', 'aze', '4'),
(38, '1', '7', '43', 'aze', '1'),
(39, '1', '7', '44', 'aze', '2'),
(40, '1', '7', '45', 'aze', '3'),
(41, '1', '7', '46', 'aze', '4'),
(42, '1', '7', '47', 'aze', '5'),
(43, '1', '8', '38', 'aze', '1'),
(44, '1', '8', '39', 'aze', '2'),
(45, '1', '8', '40', 'aze', '3'),
(46, '1', '8', '41', 'aze', '4'),
(47, '1', '8', '42', 'aze', '5'),
(48, '1', '9', '33', 'aze', '1'),
(49, '1', '9', '34', 'aze', '2'),
(50, '1', '9', '35', 'aze', '3'),
(51, '1', '9', '36', 'aze', '4'),
(52, '1', '9', '37', 'aze', '5'),
(53, '1', '10', '48', 'ae', '1'),
(54, '1', '10', '49', 'aze', '2'),
(55, '1', '10', '50', 'aze', '3'),
(56, '1', '10', '51', 'aze', '4'),
(57, '1', '10', '52', 'aze', '5'),
(58, '1', '11', '67', 'aze', '1'),
(59, '1', '11', '68', 'aze', '2'),
(60, '1', '11', '69', 'aze', '3'),
(61, '1', '11', '70', 'aze', '4'),
(67, '1', '13', '71', 'aze', '1'),
(68, '1', '13', '72', 'aze', '2'),
(69, '1', '13', '73', 'aze', '3'),
(70, '1', '13', '74', 'aze', '4'),
(71, '1', '13', '75', 'aze', '5'),
(72, '1', '14', '25', 'aze2', '1'),
(73, '1', '14', '26', '', '2'),
(74, '1', '14', '27', '', '3'),
(75, '1', '14', '28', 'ae2', '4'),
(76, '1', '14', '29', '', '5'),
(77, '1', '14', '30', '', '6'),
(78, '1', '14', '31', '', '7'),
(79, '1', '14', '32', '', '8');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_affectation_tarif`
--

CREATE TABLE `audits2018_affectation_tarif` (
  `id` int(12) NOT NULL,
  `id_audit` varchar(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `tarif` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `commentaires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_affectation_tarif`
--

INSERT INTO `audits2018_affectation_tarif` (`id`, `id_audit`, `nom`, `tarif`, `type`, `commentaires`) VALUES
(1, '1', 'recommandation Obligatoire 1', '1000', 'OBLIGATOIRE', 'Petit commentaire sur recommandation 1'),
(2, '1', 'Reco recom', '1200', 'RECOMMANDE', 'test'),
(3, '1', 'reco confort', '234', 'CONFORT', 'AZEAZEAZEAZE');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_audits`
--

CREATE TABLE `audits2018_audits` (
  `id` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `id_client` varchar(12) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `id_manager` varchar(12) NOT NULL,
  `nom_manager` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `url_pdf` varchar(1000) NOT NULL,
  `date_ajout` varchar(255) NOT NULL,
  `commentaires` varchar(5000) NOT NULL,
  `note` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_audits`
--

INSERT INTO `audits2018_audits` (`id`, `nom`, `id_client`, `nom_client`, `id_manager`, `nom_manager`, `etat`, `url_pdf`, `date_ajout`, `commentaires`, `note`) VALUES
(1, 'Nom de l\'audit de test', '5', 'EUROPE MUSICALS', '1', 'Mathieu Gonzalez', 'En cours Plan Action', '', '20/09/2018', 'Ceci est un commentaire général sur l\'audit', 'Ceci est la note sur l\'audit !'),
(2, 'test vide 2', '91', 'JDT Coaching', '206', 'Mathieu Duboy', 'Initialisé', '', '24/09/2018', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_fichiers`
--

CREATE TABLE `audits2018_fichiers` (
  `id` int(12) NOT NULL,
  `chemin` varchar(500) NOT NULL,
  `id_audit` varchar(12) NOT NULL,
  `date_depot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_fichiers`
--

INSERT INTO `audits2018_fichiers` (`id`, `chemin`, `id_audit`, `date_depot`) VALUES
(2, '/audits/uploads/1/Capture d’écran 2018-09-24 à 12.00.53.png', '1', '1537802870'),
(3, '/audits/uploads/1/Capture d’écran 2018-09-24 à 12.00.53.png', '1', '1537802890'),
(4, '/audits/uploads/1/Capture d’écran 2018-09-24 à 09.00.16.png', '1', '1537802908');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_liste_elements`
--

CREATE TABLE `audits2018_liste_elements` (
  `id` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_liste_elements`
--

INSERT INTO `audits2018_liste_elements` (`id`, `nom`, `categorie`) VALUES
(1, 'PC', 'Poste de travail'),
(2, 'MAC', 'Poste de travail'),
(3, 'Connexion A', 'Connexions Internet'),
(4, 'Télephones Fixes', 'Téléphonie Fixe'),
(5, 'Iphones 4G', 'Téléphonie Mobile'),
(6, 'Element de test PT', 'Postes de travail'),
(7, 'Element de test PD', 'Partage documentaire'),
(8, 'Element de test M', 'Messagerie'),
(9, 'Element de test R', 'Réseau'),
(10, 'Element de test L', 'Logiciel'),
(11, 'Element de test CI', 'Connexions Internet'),
(12, 'Element de test TF', 'Téléphonie Fixe'),
(13, 'Element de test TM', 'Téléphonie Mobile'),
(14, 'Element de test A', 'Antivirus'),
(15, 'Element de test S', 'Sauvegarde');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_liste_specifications`
--

CREATE TABLE `audits2018_liste_specifications` (
  `id` int(12) NOT NULL,
  `id_element` varchar(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `ordre` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_liste_specifications`
--

INSERT INTO `audits2018_liste_specifications` (`id`, `id_element`, `nom`, `ordre`) VALUES
(1, '1', 'Marque', '1'),
(2, '1', 'Format', '2'),
(3, '1', 'Processeur', '3'),
(4, '1', 'RAM', '4'),
(5, '1', 'Type DD', '5'),
(6, '1', 'Capacité DD', '6'),
(7, '1', 'Tx Occupation DD', '7'),
(8, '2', 'Marque', '1'),
(9, '2', 'Format', '2'),
(10, '2', 'Processeur', '3'),
(11, '2', 'RAM', '4'),
(12, '2', 'Type DD', '5'),
(13, '2', 'Capacité DD', '6'),
(14, '2', 'Tx Occupation DD', '7'),
(15, '3', 'Opérateur', '1'),
(16, '3', 'Techno', '2'),
(17, '3', 'Débit', '3'),
(18, '3', 'Forfait', '4'),
(19, '3', 'Tarif', '5'),
(20, '4', 'Opérateur', '1'),
(21, '4', 'Techno', '2'),
(22, '4', 'Nb postes', '3'),
(23, '4', 'Forfait', '4'),
(24, '4', 'Tarif', '5'),
(25, '6', 'PTBrand', '1'),
(26, '6', 'PTFactor', '2'),
(27, '6', 'PTProc', '3'),
(28, '6', 'PTRAM', '4'),
(29, '6', 'PTDDType', '5'),
(30, '6', 'PTDDCapa', '6'),
(31, '6', 'PTDDOccup', '7'),
(32, '6', 'PTScreen', '8'),
(33, '7', 'PDType', '1'),
(34, '7', 'PDFC', '2'),
(35, '7', 'PDC', '3'),
(36, '7', 'PDU', '4'),
(37, '7', 'PDGD', '5'),
(38, '8', 'MF', '1'),
(39, '8', 'MMA', '2'),
(40, '8', 'MC', '3'),
(41, '8', 'MU', '4'),
(42, '8', 'MA', '5'),
(43, '9', 'RMarque', '1'),
(44, '9', 'RType', '2'),
(45, '9', 'RDebit', '3'),
(46, '9', 'RNB', '4'),
(47, '9', 'RNBCo', '5'),
(48, '10', 'LE', '1'),
(49, '10', 'LM', '2'),
(50, '10', 'LNBC', '3'),
(51, '10', 'LTH', '4'),
(52, '10', 'LSO', '5'),
(53, '11', 'CIOpe', '1'),
(54, '11', 'CITech', '2'),
(55, '11', 'CIDebit', '3'),
(56, '11', 'CIFF', '4'),
(57, '11', 'CITarif', '5'),
(58, '12', 'TFOpe', '1'),
(59, '12', 'TFTech', '2'),
(60, '12', 'TFNB', '3'),
(61, '12', 'TFFF', '4'),
(62, '12', 'TFTarif', '5'),
(63, '13', 'TMOpe', '1'),
(64, '13', 'TMTerminal', '2'),
(65, '13', 'TMFF', '3'),
(66, '13', 'TMTarif', '4'),
(67, '14', 'AType', '1'),
(68, '14', 'ANBL', '2'),
(69, '14', 'ATarif', '3'),
(70, '14', 'AMan', '4'),
(71, '15', 'SSupport', '1'),
(72, '15', 'SLog', '2'),
(73, '15', 'SMon', '3'),
(74, '15', 'SAuto', '4'),
(75, '15', 'SPer', '5');

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_pts_forts_faibles`
--

CREATE TABLE `audits2018_pts_forts_faibles` (
  `id` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `audits2018_pts_forts_faibles`
--

INSERT INTO `audits2018_pts_forts_faibles` (`id`, `nom`, `type`) VALUES
(1, 'Bonne structure', 'fort'),
(2, 'Bonne gestion', 'fort'),
(3, 'Mauvaise structure', 'faible'),
(4, 'Mauvaise gestion', 'faible');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `audits2018_affectation_element`
--
ALTER TABLE `audits2018_affectation_element`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_affectation_pts_forts_faibles`
--
ALTER TABLE `audits2018_affectation_pts_forts_faibles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_affectation_specification`
--
ALTER TABLE `audits2018_affectation_specification`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_affectation_tarif`
--
ALTER TABLE `audits2018_affectation_tarif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_audits`
--
ALTER TABLE `audits2018_audits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_fichiers`
--
ALTER TABLE `audits2018_fichiers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_liste_elements`
--
ALTER TABLE `audits2018_liste_elements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_liste_specifications`
--
ALTER TABLE `audits2018_liste_specifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `audits2018_pts_forts_faibles`
--
ALTER TABLE `audits2018_pts_forts_faibles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `audits2018_affectation_element`
--
ALTER TABLE `audits2018_affectation_element`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `audits2018_affectation_pts_forts_faibles`
--
ALTER TABLE `audits2018_affectation_pts_forts_faibles`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `audits2018_affectation_specification`
--
ALTER TABLE `audits2018_affectation_specification`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `audits2018_affectation_tarif`
--
ALTER TABLE `audits2018_affectation_tarif`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `audits2018_audits`
--
ALTER TABLE `audits2018_audits`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `audits2018_fichiers`
--
ALTER TABLE `audits2018_fichiers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `audits2018_liste_elements`
--
ALTER TABLE `audits2018_liste_elements`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `audits2018_liste_specifications`
--
ALTER TABLE `audits2018_liste_specifications`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `audits2018_pts_forts_faibles`
--
ALTER TABLE `audits2018_pts_forts_faibles`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
