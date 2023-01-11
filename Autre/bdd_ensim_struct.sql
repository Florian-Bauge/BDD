-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 jan. 2023 à 08:57
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_ensim`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int NOT NULL,
  `nrue` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codepostal` int NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `infoComp` varchar(255) DEFAULT NULL,
  `code_client` int DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `code_client` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Instagram` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `id_membership` int NOT NULL,
  `point` int DEFAULT '0',
  PRIMARY KEY (`code_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL,
  `fdelivery` double NOT NULL,
  `total` double DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fservice` double DEFAULT NULL,
  `code_client` int DEFAULT NULL,
  `id_con` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_con` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `envoie`
--

DROP TABLE IF EXISTS `envoie`;
CREATE TABLE IF NOT EXISTS `envoie` (
  `id_item` int NOT NULL,
  `id_livraison` int NOT NULL,
  `id_commande` int NOT NULL,
  `Prix_remise` double DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `quantité` int DEFAULT NULL,
  PRIMARY KEY (`id_item`,`id_livraison`,`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_fact` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_fact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grillepoint`
--

DROP TABLE IF EXISTS `grillepoint`;
CREATE TABLE IF NOT EXISTS `grillepoint` (
  `id_membership` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `minPoint` int NOT NULL,
  `maxPoint` int NOT NULL,
  `multiplication` double NOT NULL,
  PRIMARY KEY (`id_membership`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `grilleregle`
--

DROP TABLE IF EXISTS `grilleregle`;
CREATE TABLE IF NOT EXISTS `grilleregle` (
  `id_regle` int NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `point` int NOT NULL,
  `valeur` double NOT NULL,
  `dateExp` date NOT NULL,
  `id_membership` int DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id_regle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int NOT NULL AUTO_INCREMENT,
  `prixachat` double NOT NULL,
  `prixvente` double NOT NULL,
  `nom` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `id_membership` int DEFAULT '0',
  `stock` int NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id_delivery` int NOT NULL,
  `numeroColis` varchar(255) DEFAULT NULL,
  `dateVoulu` date DEFAULT NULL,
  `dateLivrée` date DEFAULT NULL,
  `DateExpédié` date DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `id_adresse` int DEFAULT NULL,
  PRIMARY KEY (`id_delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moyen`
--

DROP TABLE IF EXISTS `moyen`;
CREATE TABLE IF NOT EXISTS `moyen` (
  `id_transaction` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiment` int NOT NULL,
  `date` date NOT NULL,
  `cout` double NOT NULL,
  `id_transaction` int DEFAULT NULL,
  `id_commande` int NOT NULL,
  PRIMARY KEY (`id_paiment`),
  KEY `fk_commande` (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id_point` int NOT NULL,
  `point` int NOT NULL,
  `dateExp` date DEFAULT NULL,
  `code_client` int DEFAULT NULL,
  PRIMARY KEY (`id_point`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
