-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 28 fév. 2024 à 22:10
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetgl`
--

-- --------------------------------------------------------

--
-- Structure de la table `ami`
--

DROP TABLE IF EXISTS `ami`;
CREATE TABLE IF NOT EXISTS `ami` (
  `id_utilisateur` int NOT NULL,
  `id_ami` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_publication` int NOT NULL,
  `texte_commentaire` text NOT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentaire`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_publication` (`id_publication`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentairef`
--

DROP TABLE IF EXISTS `commentairef`;
CREATE TABLE IF NOT EXISTS `commentairef` (
  `id_commentairef` int NOT NULL AUTO_INCREMENT,
  `id_utilisateurf` int NOT NULL,
  `id_publicationf` int NOT NULL,
  `texte_commentairef` text NOT NULL,
  `date_commentairef` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commentairef`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `id_discussion` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `texte_discussion` text NOT NULL,
  `date_discussion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sujet` text NOT NULL,
  PRIMARY KEY (`id_discussion`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `liste_amis`
--

DROP TABLE IF EXISTS `liste_amis`;
CREATE TABLE IF NOT EXISTS `liste_amis` (
  `id_utilisateur` int NOT NULL,
  `id_amis` int NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_amis`),
  KEY `id_amis` (`id_amis`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `id_voyage` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_voyage`,`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `id_publication` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `titre_publication` varchar(50) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description_publication` text NOT NULL,
  `img_publication` varchar(40) NOT NULL,
  `comment_pub` varchar(70) NOT NULL,
  `image_pub2` varchar(100) NOT NULL,
  `image_pub3` varchar(100) NOT NULL,
  PRIMARY KEY (`id_publication`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `num_tel` int NOT NULL,
  `pays` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `role` varchar(50) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `adress` varchar(200) NOT NULL,
  `img_profil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

DROP TABLE IF EXISTS `voyage`;
CREATE TABLE IF NOT EXISTS `voyage` (
  `id_utilisateur` varchar(20) NOT NULL,
  `titre_voyage` varchar(20) NOT NULL,
  `Description_voyage` text NOT NULL,
  `nb_participants` bigint NOT NULL,
  `date_voyage` date NOT NULL,
  `pays` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `date_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_voyage` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_voyage`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
