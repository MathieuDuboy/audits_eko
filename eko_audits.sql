-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 24 sep. 2018 à 16:40
-- Version du serveur :  5.6.35
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `eko_audits`
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

-- --------------------------------------------------------

--
-- Structure de la table `audits2018_liste_elements`
--

CREATE TABLE `audits2018_liste_elements` (
  `id` int(12) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `audits2018_fichiers`
--
ALTER TABLE `audits2018_fichiers`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
