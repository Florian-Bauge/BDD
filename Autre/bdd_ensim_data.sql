-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 jan. 2023 à 08:51
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

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`code_client`, `name`, `Facebook`, `Instagram`, `Email`, `Phone`, `id_membership`, `point`) VALUES
(0, 'Bernard', 'qsdd', 'sdf', 'sdfg', 'qsdf', 0, 100);

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `fdelivery`, `total`, `statut`, `note`, `date`, `fservice`, `code_client`, `id_con`) VALUES
(1, 10, 100, NULL, NULL, '2023-01-11', 10, 0, 0),
(2, 20, 120, 'mlkjhgfds', NULL, '2023-01-08', 10, 0, 0);

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_con`, `nom`, `prenom`) VALUES
(0, 'aze', 'dfg');

--
-- Déchargement des données de la table `envoie`
--

INSERT INTO `envoie` (`id_item`, `id_livraison`, `id_commande`, `Prix_remise`, `statut`, `quantité`) VALUES
(0, 0, 1, 100, 'dfghjkh', 2),
(1, 0, 1, 10, 'ghjk', 3);

--
-- Déchargement des données de la table `grillepoint`
--

INSERT INTO `grillepoint` (`id_membership`, `nom`, `minPoint`, `maxPoint`, `multiplication`) VALUES
(0, 'Silver', 0, 200, 1);

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `prixachat`, `prixvente`, `nom`, `statut`, `id_membership`, `stock`) VALUES
(1, 200, 250, 'Test1', '', 0, 2);

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_delivery`, `numeroColis`, `dateVoulu`, `dateLivrée`, `DateExpédié`, `status`, `id_adresse`) VALUES
(0, 'sqdgfhdsqsdfgh', NULL, NULL, NULL, 'sdgffd', 0);

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiment`, `date`, `cout`, `id_transaction`, `id_commande`) VALUES
(0, '2023-01-11', 20, 0, 1),
(1, '2023-01-17', 30, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
