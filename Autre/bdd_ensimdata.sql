-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 jan. 2023 à 17:03
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
-- Base de données : `bdd_ensim`
--

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `nrue`, `typeRue`, `rue`, `codepostal`, `ville`, `pays`, `infoComp`, `code_client`) VALUES
(22, '06', 'rue ', '     Jean Moulin1', 31000, 'Lemans1', 'Bre coucou    ', '', '230002'),
(23, '04', 'rue ', '     Jean bap', 72000, 'Montauban', 'Franc     ', '', '230002'),
(24, '50', 'Avenue ', '   Rouziere', 72000, 'bretagne', 'Bretagne bretagne ind   ', '', '230003'),
(25, '50', 'Avenue ', 'Rouziere', 72000, 'bretagne', 'Bretagne bretagne ind', '', '230004'),
(26, '04', 'rue ', 'Jean Moulin', 72000, 'Montauban', 'France', '', '230005'),
(27, '04', 'rue ', '  Jean Moulin', 81000, 'Montauban', 'France  ', '', '230001'),
(28, '04', 'rue ', ' Jean Moulin', 82000, 'Montauban', 'France ', '', '230001'),
(29, '20', 'rue ', 'Micjelle', 72000, 'Le mans', 'France', '', '230006'),
(30, '20', 'rue ', 'JEan', 72000, 'Le mans', 'France', '', '230007'),
(31, '20', 'rue ', 'JEan', 72000, 'Le mans', 'France', '', '230008'),
(32, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230009'),
(33, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230010'),
(34, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230011'),
(35, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230012'),
(36, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230013'),
(37, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230013'),
(38, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230014'),
(39, '20', 'rue ', 'Jean Moulin', 72000, 'Lemans', 'France', '', '230014'),
(40, '20', 'rue ', 'Jean', 72000, 'Lemans', 'France', '', '230015'),
(41, '20', 'rue ', 'Jean', 72000, 'Lemans', 'France', '', '230016');

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `code_client`, `name`, `Facebook`, `Instagram`, `Email`, `Phone`, `id_membership`, `point`) VALUES
(1, '230001', 'Florian', 'Baugé', '@florian', 'florianBauge@gmail.com', '0602', 3, 700),
(7, '230002', 'bap', '', 'bap', 'baptiste@gmail.com', '0620', 0, 0),
(8, '230003', 'Clément Jamelo', 'clément', 'clément', 'clement@gmail.com', '062023', 0, 0),
(9, '230004', 'clément ulti', 'aze', 'zae', 'clementulti@gmail.com', '0620231625', 3, 0),
(10, '230005', 'bap', '', 'ez', 'abeaa@gmail.com', '06', 0, 0),
(11, '230006', 'bap1', 'eza', 'ez', 'bap@gmail.com', '062023', 0, 0),
(12, '230007', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(13, '230008', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(14, '230009', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(15, '230010', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(16, '230011', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(17, '230012', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(18, '230013', 'eza', 'eza', 'zeza', 'eza@gmail.com', '5545', 0, 0),
(19, '230014', 'zeaez', 'eza', 'ze', 'zea@gmail.com', '0445', 0, 0),
(20, '230015', 'ezae', 'eza', 'zae', 'zea@gmail.Com', '0251', 0, 0),
(21, '230016', 'eza', 'eza', 'zea', 'eza@mail.com', '0152', 0, 0);

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `fdelivery`, `total`, `statut`, `note`, `date`, `fservice`, `code_client`, `id_con`) VALUES
(1, 10, 100, NULL, NULL, '2023-01-11', 10, 230001, 0),
(2, 20, 130, 'mlkjhgfds', NULL, '2023-01-08', 10, 0, 0),
(211230002, 10, 100, NULL, 'test', '2023-01-11', 10, 230001, 0),
(2001230002, 10, 100, NULL, NULL, '2023-01-20', 10, 230001, 0),
(2001230003, 10, 100, 'Test2', 'Test2', '2023-01-20', 10, 230001, 0),
(2001230004, 10, 100, 'Test3', NULL, '2023-01-20', 10, 230001, 0),
(2001230005, 0, 0, NULL, NULL, '2023-01-20', 0, 230001, 0),
(2001230006, 0, 0, NULL, NULL, '2023-01-20', 0, 230001, 0),
(2001230007, 0, 0, NULL, NULL, '2023-01-20', 0, 230001, 0),
(2001230008, 0, 0, NULL, NULL, '2023-01-20', 0, 230001, 0),
(2101230001, 0, 0, NULL, NULL, '2023-01-21', 0, 230002, 0),
(2101230002, 0, 0, NULL, NULL, '2023-01-21', 0, 230002, 0),
(2101230003, 0, 0, NULL, NULL, '2023-01-21', 0, 230004, 0),
(2101230004, 0, 0, NULL, NULL, '2023-01-21', 0, 230004, 0),
(2101230005, 0, 0, NULL, NULL, '2023-01-21', 0, 230003, 0),
(2101230006, 0, 0, NULL, NULL, '2023-01-21', 0, 230001, 0),
(2101230007, 0, 0, NULL, NULL, '2023-01-21', 0, 230001, 0),
(2101230008, 0, 0, NULL, NULL, '2023-01-21', 0, 230001, 0);

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_con`, `nom`, `prenom`) VALUES
(0, 'aze', 'dfg');

--
-- Déchargement des données de la table `envoie`
--

INSERT INTO `envoie` (`id_item`, `id_livraison`, `id_commande`, `Prix_remise`, `statut`, `quantité`) VALUES
(1, 0, 211230002, 0, 'ghjk', 3),
(2, 0, 211230002, 100, 'dfghjkh', 2),
(3, NULL, 2101230002, 500, 'En stock', 1),
(3, NULL, 2101230008, 300, 'En stock', 1),
(5, 3, 2001230003, 350, 'En stock', 2);

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_fact`, `date`, `id_commande`) VALUES
('1-MAQ-F', '2023-01-21', 1),
('200123-MAQ-F0003', '2023-01-21', 2001230003),
('210123-MAQ-F0002', '2023-01-21', 2101230002),
('211230-MAQ-F002', '2023-01-19', 211230002),
('211230-MAQ-F02', '2023-01-19', 211230002);

--
-- Déchargement des données de la table `grillepoint`
--

INSERT INTO `grillepoint` (`id_membership`, `nom`, `minPoint`, `maxPoint`, `multiplication`) VALUES
(0, 'Silver', 0, 1000, 1),
(1, 'Gold', 1000, 1500, 1),
(2, 'Platinium', 1500, 2000, 1),
(3, 'Ultimate', 0, 200, 1);

--
-- Déchargement des données de la table `grilleregle`
--

INSERT INTO `grilleregle` (`id_regle`, `intitule`, `point`, `valeur`, `dateExp`, `id_membership`, `type`) VALUES
(1, 'zezae', 300, 100, '2023-01-31', 0, 'Réduction');

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `prixachat`, `prixvente`, `nom`, `statut`, `id_membership`, `stock`) VALUES
(0, 200, 250, 'Parfum', 'En stock', 2, 2),
(1, 200, 250, 'Bombon', 'En stock', 3, 5),
(3, 200, 300, 'Clavier', 'En stock', 1, 20),
(4, 200, 400, 'ordi', 'En stock', 2, 50),
(5, 200, 400, 'Clément', 'En stock', 1, 5),
(6, 20, 0, '230001', '', 0, 0),
(7, 2101230008, 3, '1', '', 0, 0),
(8, 2101230008, 3, '1', '', 0, 0),
(9, 2101230008, 3, '1', '', 0, 0);

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_delivery`, `numeroColis`, `dateLivrée`, `DateExpédié`, `id_adresse`) VALUES
(1, 'sqdgfhdsqsdfgh', NULL, NULL, 0),
(2, '24245', NULL, '2023-01-21', 28),
(3, '24245', '2023-01-22', '2023-01-21', 28);

--
-- Déchargement des données de la table `moyen`
--

INSERT INTO `moyen` (`id_transaction`, `nom`) VALUES
(1, 'Carte bancaire'),
(2, 'Cheque'),
(3, 'Points');

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiment`, `date`, `cout`, `id_transaction`, `id_commande`, `id_regle`) VALUES
(9, '2023-01-21', 200, 1, 2001230003, NULL),
(10, '2023-01-21', 100, 3, 2101230008, 1),
(11, '2023-01-21', 100, 3, 2101230008, 1),
(12, '2023-01-21', 100, 1, 2101230008, NULL),
(13, '2023-01-21', 100, 2, 2101230008, NULL),
(14, '2023-01-21', 100, 3, 2101230008, 1),
(15, '2023-01-21', 100, 3, 2101230008, 1);

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_point`, `point`, `dateExp`, `code_client`) VALUES
(0, 700, '2023-01-31', 230002),
(1, 5000, '0000-00-00', 1),
(2, 300, '2023-01-10', 0),
(3, 100, '2023-01-21', 230001),
(6, 100, '2023-01-31', 230002);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
