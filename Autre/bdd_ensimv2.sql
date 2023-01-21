-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 jan. 2023 à 12:19
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

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `nrue` varchar(255) NOT NULL,
  `typeRue` varchar(30) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codepostal` int NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `infoComp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code_client` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Déclencheurs `adresse`
--
DROP TRIGGER IF EXISTS `tr_adresse_code_client`;
DELIMITER $$
CREATE TRIGGER `tr_adresse_code_client` BEFORE INSERT ON `adresse` FOR EACH ROW BEGIN
DECLARE client_code VARCHAR(255);
DECLARE last_id INT;
SET last_id = (SELECT MAX(id) FROM client);
SET client_code = (SELECT code_client FROM client WHERE id = last_id);

SET NEW.code_client = client_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code_client` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Instagram` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `id_membership` int NOT NULL,
  `point` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_client` (`code_client`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Déclencheurs `client`
--
DROP TRIGGER IF EXISTS `auto_increment_code_client`;
DELIMITER $$
CREATE TRIGGER `auto_increment_code_client` BEFORE INSERT ON `client` FOR EACH ROW BEGIN
DECLARE num INT;
SELECT MAX(SUBSTRING(code_client,3,4)) INTO num FROM client;
SET num = num+1;
SET NEW.code_client = CONCAT(DATE_FORMAT(NOW(), '%y'),  LPAD(num,4,'0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL,
  `fdelivery` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fservice` double NOT NULL DEFAULT '0',
  `code_client` int NOT NULL,
  `id_con` int NOT NULL,
  PRIMARY KEY (`id_commande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `fdelivery`, `total`, `statut`, `note`, `date`, `fservice`, `code_client`, `id_con`) VALUES
(1, 10, 100, NULL, NULL, '2023-01-11', 10, 230001, 0),
(2, 20, 120, 'mlkjhgfds', NULL, '2023-01-08', 10, 0, 0),
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
-- Déclencheurs `commande`
--
DROP TRIGGER IF EXISTS `auto_Increment_Idcommane`;
DELIMITER $$
CREATE TRIGGER `auto_Increment_Idcommane` BEFORE INSERT ON `commande` FOR EACH ROW BEGIN
    DECLARE date_commande DATE;
    DECLARE num_commande INT;
    
    SET date_commande = CURDATE();
    SET num_commande =(SELECT COALESCE(MAX(SUBSTRING(id_commande, 7, 4)), 0) FROM commande WHERE DATE(date) = CURDATE());

    SET num_commande = num_commande + 1;
    SET NEW.id_commande = CONCAT(DATE_FORMAT(date_commande, '%d%m%y'), LPAD(num_commande, 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_con` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_con`, `nom`, `prenom`) VALUES
(0, 'aze', 'dfg');

-- --------------------------------------------------------

--
-- Structure de la table `envoie`
--

DROP TABLE IF EXISTS `envoie`;
CREATE TABLE IF NOT EXISTS `envoie` (
  `id_item` int NOT NULL,
  `id_livraison` int DEFAULT NULL,
  `id_commande` int NOT NULL,
  `Prix_remise` double NOT NULL DEFAULT '0',
  `statut` varchar(255) DEFAULT NULL,
  `quantité` int DEFAULT NULL,
  PRIMARY KEY (`id_item`,`id_commande`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `envoie`
--

INSERT INTO `envoie` (`id_item`, `id_livraison`, `id_commande`, `Prix_remise`, `statut`, `quantité`) VALUES
(0, 0, 211230002, 100, 'dfghjkh', 2),
(1, 0, 211230002, 0, 'ghjk', 3),
(3, NULL, 2101230008, 300, 'En stock', 1),
(5, 3, 2001230003, 350, 'En stock', 2);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_fact` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `id_commande` int NOT NULL,
  PRIMARY KEY (`id_fact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_fact`, `date`, `id_commande`) VALUES
('211230-MAQ-F002', '2023-01-19', 211230002),
('211230-MAQ-F02', '2023-01-19', 211230002);

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

--
-- Déchargement des données de la table `grillepoint`
--

INSERT INTO `grillepoint` (`id_membership`, `nom`, `minPoint`, `maxPoint`, `multiplication`) VALUES
(0, 'Silver', 0, 200, 1),
(1, 'Gold', 0, 200, 1),
(2, 'Platinium', 0, 200, 1),
(3, 'Ultimate', 0, 200, 1);

-- --------------------------------------------------------

--
-- Structure de la table `grilleregle`
--

DROP TABLE IF EXISTS `grilleregle`;
CREATE TABLE IF NOT EXISTS `grilleregle` (
  `id_regle` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `point` int NOT NULL,
  `valeur` double NOT NULL,
  `dateExp` date NOT NULL,
  `id_membership` int NOT NULL DEFAULT '0',
  `type` enum('Pourcentage','Réduction','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_regle`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `grilleregle`
--

INSERT INTO `grilleregle` (`id_regle`, `intitule`, `point`, `valeur`, `dateExp`, `id_membership`, `type`) VALUES
(1, 'zezae', 300, 100, '2023-01-31', 0, 'Réduction');

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
  `id_membership` int NOT NULL DEFAULT '0',
  `stock` int NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id_delivery` int NOT NULL AUTO_INCREMENT,
  `numeroColis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateLivrée` date DEFAULT NULL,
  `DateExpédié` date DEFAULT NULL,
  `id_adresse` int DEFAULT NULL,
  PRIMARY KEY (`id_delivery`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_delivery`, `numeroColis`, `dateLivrée`, `DateExpédié`, `id_adresse`) VALUES
(1, 'sqdgfhdsqsdfgh', NULL, NULL, 0),
(2, '24245', NULL, '2023-01-21', 28),
(3, '24245', '2023-01-22', '2023-01-21', 28);

-- --------------------------------------------------------

--
-- Structure de la table `moyen`
--

DROP TABLE IF EXISTS `moyen`;
CREATE TABLE IF NOT EXISTS `moyen` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaction`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `moyen`
--

INSERT INTO `moyen` (`id_transaction`, `nom`) VALUES
(1, 'Carte bancaire'),
(2, 'Cheque'),
(3, 'Points');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiment` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cout` double NOT NULL,
  `id_transaction` int NOT NULL,
  `id_commande` int NOT NULL,
  `id_regle` int DEFAULT NULL,
  PRIMARY KEY (`id_paiment`),
  KEY `fk_commande` (`id_commande`),
  KEY `id_regle` (`id_regle`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Déclencheurs `paiement`
--
DROP TRIGGER IF EXISTS `ajout_point`;
DELIMITER $$
CREATE TRIGGER `ajout_point` AFTER INSERT ON `paiement` FOR EACH ROW BEGIN
DECLARE id_client INT;
DECLARE multi INt ;
DECLARE regle INT;
SET id_client=(SELECT commande.code_client FROM commande INNER JOIN paiement ON commande.id_commande=paiement.id_commande WHERE id_paiment=NEW.id_paiment);
SET multi=(SELECT grillepoint.multiplication FROM grillepoint INNER JOIN client ON grillepoint.id_membership=client.id_membership WHERE client.code_client=id_client);
SET regle=(SELECT id_regle FROM paiement WHERE id_paiment=NEW.id_paiment);
UPDATE client
SET client.point=client.point+NEW.cout*multi WHERE client.code_client=id_client AND regle IS NULL ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id_point` int NOT NULL,
  `point` int NOT NULL,
  `dateExp` date NOT NULL,
  `code_client` int NOT NULL,
  PRIMARY KEY (`id_point`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_point`, `point`, `dateExp`, `code_client`) VALUES
(0, 300, '2023-01-10', 0),
(1, 5000, '0000-00-00', 1),
(3, 100, '2023-01-21', 230001);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_regle` FOREIGN KEY (`id_regle`) REFERENCES `grilleregle` (`id_regle`) ON DELETE RESTRICT ON UPDATE RESTRICT;

DELIMITER $$
--
-- Évènements
--
DROP EVENT IF EXISTS `check_exp_point`$$
CREATE DEFINER=`root`@`localhost` EVENT `check_exp_point` ON SCHEDULE EVERY 1 DAY STARTS '2023-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE client SET client.point=(client.point-(SELECT points.point FROM points WHERE points.dateExp=CURRENT_DATE)) WHERE client.code_client=(SELECT points.code_client FROM points WHERE points.dateExp=CURRENT_DATE)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
