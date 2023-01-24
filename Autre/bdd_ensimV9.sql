-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 jan. 2023 à 08:09
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
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `nrue` varchar(255) NOT NULL,
  `typeRue` varchar(30) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codepostal` int NOT NULL,
  `ville` varchar(255) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `infoComp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `code_client` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `code_client` (`code_client`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`id_adresse`, `nrue`, `typeRue`, `rue`, `codepostal`, `ville`, `pays`, `infoComp`, `code_client`) VALUES
(3, '20', 'rue ', '          Jean Moulin', 72000, 'le Mans', 'FRANCE          ', '', 230001),
(4, '20', 'rue ', 'Jean Moulin', 72000, ' lemans', 'FRANCE', '', 230002),
(5, '20', 'rue ', 'Jean Moulin', 72000, ' lemans', 'FRANCE', '', 230002),
(6, '22', 'rue ', '   Jean Moulin', 72000, 'le Mans', 'FRANCE   ', '', 230001),
(7, '24', 'rue ', 'Jean Moulin', 72000, 'le Mans', 'FRANCE', '', 230001),
(8, '94', 'cours ', 'Marechal Joffre', 69150, 'decine charpieux', 'France', '', 230003),
(9, '56', 'rue ', 'gouin de beauchesne', 91240, 'SAINT MICHEL SUR ORGE', 'FRANCE', '', 230004);

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
  `code_client` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Instagram` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `id_membership` int NOT NULL,
  `point` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `code_client` (`code_client`),
  KEY `id_membership` (`id_membership`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `code_client`, `name`, `Facebook`, `Instagram`, `Email`, `Phone`, `id_membership`, `point`) VALUES
(2, 230001, 'Yolande Paquet', 'Yolande Paquet', 'Yolande Paquet', 'Yolande.Paquet@gmail.com', '0211132936', 1, 53),
(3, 230002, 'Ophelia Audibert', 'Ophelia Audibert', 'Ophelia Audibert', 'Ophelia.Audibert@gmail.com', '0158045182', 0, 0),
(4, 230003, 'Gill Brochu', 'Gill Brochu', 'Gill Brochu', 'Gill.Brochu@gmail.com', '0106883562', 0, 25),
(5, 230004, 'Isabelle Caisse', 'Isabelle Caisse', 'Isabelle Caisse', 'Isabelle.Caisse@gmail.com', '0169325065', 0, 0);

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
  `id_commande` int UNSIGNED NOT NULL,
  `fdelivery` double NOT NULL DEFAULT '0',
  `total` double NOT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `fservice` double NOT NULL DEFAULT '0',
  `code_client` int UNSIGNED NOT NULL,
  `id_con` int NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `code_client` (`code_client`),
  KEY `id_con` (`id_con`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `fdelivery`, `total`, `statut`, `note`, `date`, `fservice`, `code_client`, `id_con`) VALUES
(2201230001, 50, 235, NULL, NULL, '2023-01-22', 10, 230001, 1),
(2401230002, 50, 125, NULL, NULL, '2023-01-24', 10, 230003, 1);

--
-- Déclencheurs `commande`
--
DROP TRIGGER IF EXISTS `auto_Increment_Idcommane`;
DELIMITER $$
CREATE TRIGGER `auto_Increment_Idcommane` BEFORE INSERT ON `commande` FOR EACH ROW BEGIN

 DECLARE date_commande DATE;
    DECLARE num_commande INT;
    
    SET date_commande = CURDATE();
    SET num_commande =(SELECT COALESCE(MAX(SUBSTRING(id_commande, 7, 4)), 1) FROM commande WHERE DATE(date) = CURDATE());

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
(1, 'Jetté', 'Maureen');

-- --------------------------------------------------------

--
-- Structure de la table `envoie`
--

DROP TABLE IF EXISTS `envoie`;
CREATE TABLE IF NOT EXISTS `envoie` (
  `id_envoie` int NOT NULL AUTO_INCREMENT,
  `id_item` int NOT NULL,
  `id_livraison` int DEFAULT NULL,
  `id_commande` int UNSIGNED NOT NULL,
  `Prix_remise` double NOT NULL DEFAULT '0',
  `statut` varchar(255) DEFAULT NULL,
  `quantité` int DEFAULT NULL,
  PRIMARY KEY (`id_envoie`),
  KEY `id_item` (`id_item`),
  KEY `id_livraison` (`id_livraison`),
  KEY `id_commande` (`id_commande`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `envoie`
--

INSERT INTO `envoie` (`id_envoie`, `id_item`, `id_livraison`, `id_commande`, `Prix_remise`, `statut`, `quantité`) VALUES
(16, 4, 5, 2201230001, 110, 'In stock', 1),
(17, 5, NULL, 2201230001, 15, 'Available', 1),
(18, 6, 5, 2201230001, 0, 'free gift', 1),
(19, 8, 4, 2401230002, 55, 'Available', 1),
(20, 7, NULL, 2401230002, 35, 'In stock', 2),
(21, 4, 5, 2201230001, 110, 'In stock', 1);

--
-- Déclencheurs `envoie`
--
DROP TRIGGER IF EXISTS `update_stock`;
DELIMITER $$
CREATE TRIGGER `update_stock` AFTER INSERT ON `envoie` FOR EACH ROW BEGIN
DECLARE Item_id INT;
DECLARE Item_nb INT;
DECLARE Quantite INT ;
SET Item_id=(SELECT envoie.id_item FROM envoie WHERE envoie.id_envoie=NEW.id_envoie);
SET Item_nb=(SELECT envoie.quantité FROM envoie WHERE envoie.id_envoie=NEW.id_envoie);

UPDATE item SET item.stock=item.stock-Item_nb WHERE item.id_item=Item_id;
SET Quantite=(SELECT item.stock FROM item WHERE item.id_item=NEW.id_item);

IF(Quantite<=0)
THEN 
UPDATE item SET item.statut="Indisponible" WHERE item.id_item=NEW.id_item;
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_stock_onDelete`;
DELIMITER $$
CREATE TRIGGER `update_stock_onDelete` BEFORE DELETE ON `envoie` FOR EACH ROW BEGIN
DECLARE Item_id INT;
DECLARE Item_nb INT;
SET Item_id=(SELECT envoie.id_item FROM envoie WHERE envoie.id_envoie=OLD.id_envoie);
SET Item_nb=(SELECT envoie.quantité FROM envoie WHERE envoie.id_envoie=OLD.id_envoie);
UPDATE item SET item.stock=item.stock+Item_nb WHERE item.id_item=Item_id;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_total_commande`;
DELIMITER $$
CREATE TRIGGER `update_total_commande` AFTER INSERT ON `envoie` FOR EACH ROW BEGIN
DECLARE prix DOUBLE;
DECLARE idCOmmande INT UNSIGNED;
SET prix=(SELECT Prix_remise*quantité FROM envoie WHERE id_envoie=NEW.id_envoie);
SET idCOmmande=(SELECT id_commande FROM envoie WHERE id_envoie=NEW.id_envoie);
UPDATE commande SET commande.total=commande.total+prix WHERE commande.id_commande=idCOmmande;

END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_total_commande_onDelete`;
DELIMITER $$
CREATE TRIGGER `update_total_commande_onDelete` BEFORE DELETE ON `envoie` FOR EACH ROW BEGIN
DECLARE prix DOUBLE;
DECLARE idCOmmande INT UNSIGNED;
SET prix=(SELECT Prix_remise*quantité FROM envoie WHERE id_envoie=OLD.id_envoie);
SET idCOmmande=(SELECT id_commande FROM envoie WHERE id_envoie=OLD.id_envoie);
UPDATE commande SET commande.total=commande.total-prix WHERE commande.id_commande=idCOmmande;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_fact` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `id_commande` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_fact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_fact`, `date`, `id_commande`) VALUES
('220123-MAQ-F0001', '2023-01-22', 2201230001);

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
(0, 'Silver', 0, 1000, 1),
(1, 'Gold', 1000, 1500, 1),
(2, 'Platinium', 1500, 2000, 1),
(3, 'Ultimate', -1, -1, 1);

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
  `type` enum('Pourcentage','Réduction') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_regle`),
  KEY `id_membership` (`id_membership`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `grilleregle`
--

INSERT INTO `grilleregle` (`id_regle`, `intitule`, `point`, `valeur`, `dateExp`, `id_membership`, `type`) VALUES
(1, 'Réduction 250 -> 5€', 250, 5, '2023-01-31', 0, 'Réduction'),
(2, 'Réduction 400 -> 10€', 400, 10, '2023-03-30', 0, 'Réduction'),
(3, 'Pourcentage 400 -> 5%', 400, 5, '2023-03-31', 0, 'Pourcentage'),
(4, 'Free gift 400', 400, 0, '2023-03-31', 1, 'Réduction'),
(5, 'Réduction 250 -> 20€', 250, 20, '2022-12-21', 0, 'Réduction');

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
  PRIMARY KEY (`id_item`),
  KEY `id_membership` (`id_membership`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id_item`, `prixachat`, `prixvente`, `nom`, `statut`, `id_membership`, `stock`) VALUES
(4, 80, 110, 'Montblanc Explorer EDP 100ml', 'In stock', 0, 8),
(5, 10, 15, 'Yves Rocher Roll', 'Indisponible', 0, -1),
(6, 5, 0, 'Trousse Dior', 'free gift', 1, 4),
(7, 15, 30, 'Caudalie Lotion Vinopure 200ml', 'Indisponible', 0, -1),
(8, 25, 56, 'Yves Rocher watch', 'Indisponible', 0, -1);

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
  PRIMARY KEY (`id_delivery`),
  KEY `fk_livraison_id_adresse` (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id_delivery`, `numeroColis`, `dateLivrée`, `DateExpédié`, `id_adresse`) VALUES
(2, '25852585', '2023-01-11', '2023-01-12', 3),
(3, '545421548754', '2023-01-24', '2023-01-26', 3),
(4, '9854236985369', NULL, '2023-01-20', 8),
(5, '58525485695', NULL, '2023-01-23', 6);

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
  `id_commande` int UNSIGNED NOT NULL,
  `id_regle` int DEFAULT NULL,
  PRIMARY KEY (`id_paiment`),
  KEY `fk_paiement_id_commande` (`id_commande`),
  KEY `fk_paiement_id_regle` (`id_regle`),
  KEY `fk_paiement_id_transaction` (`id_transaction`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiment`, `date`, `cout`, `id_transaction`, `id_commande`, `id_regle`) VALUES
(18, '2023-01-22', 2, 1, 2201230001, NULL),
(19, '2023-01-22', 2, 1, 2201230001, NULL),
(20, '2023-01-22', 2, 2, 2201230001, NULL),
(21, '2023-01-22', 4, 1, 2201230001, NULL),
(22, '2023-01-22', 2, 1, 2201230001, NULL),
(23, '2023-01-22', 5, 2, 2201230001, NULL),
(24, '2023-01-22', 100, 3, 2201230001, 1),
(25, '2023-01-22', 12, 1, 2201230001, NULL),
(26, '2023-01-22', 3, 1, 2201230001, NULL),
(27, '2023-01-22', 10, 1, 2201230001, NULL),
(28, '2023-01-22', 5, 1, 2201230001, NULL),
(29, '2023-01-22', 1, 1, 2201230001, NULL),
(31, '2023-01-24', 25, 2, 2401230002, NULL);

--
-- Déclencheurs `paiement`
--
DROP TRIGGER IF EXISTS `ajout_point`;
DELIMITER $$
CREATE TRIGGER `ajout_point` AFTER INSERT ON `paiement` FOR EACH ROW BEGIN
DECLARE id_client INT;
DECLARE multi INt ;
DECLARE regle INT;
SET FOREIGN_KEY_CHECKS=0;
SET id_client=(SELECT commande.code_client FROM commande INNER JOIN paiement ON commande.id_commande=paiement.id_commande WHERE id_paiment=NEW.id_paiment);
SET multi=(SELECT grillepoint.multiplication FROM grillepoint INNER JOIN client ON grillepoint.id_membership=client.id_membership WHERE client.code_client=id_client);
SET regle=(SELECT id_regle FROM paiement WHERE id_paiment=NEW.id_paiment);
INSERT INTO points (id_point, point, dateExp, code_client) VALUES (NULL,NEW.cout*multi, CURRENT_DATE + interval '1' year, id_client);
UPDATE client
SET client.point=client.point+NEW.cout*multi WHERE client.code_client=id_client AND regle IS NULL ;
SET FOREIGN_KEY_CHECKS=1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id_point` int NOT NULL AUTO_INCREMENT,
  `point` int NOT NULL,
  `dateExp` date NOT NULL,
  `code_client` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_point`),
  KEY `code_client` (`code_client`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_point`, `point`, `dateExp`, `code_client`) VALUES
(13, 15, '2023-01-21', 230001),
(14, 15, '2023-01-21', 230001),
(15, 15, '2023-01-21', 230001),
(16, 15, '2023-01-21', 230001),
(17, 15, '2023-01-21', 230001),
(18, 15, '2023-01-21', 230001),
(19, 15, '2023-01-21', 230001),
(20, 12, '2024-01-22', 230001),
(21, 3, '2024-01-22', 230001),
(22, 10, '2024-01-22', 230001),
(23, 5, '2024-01-22', 230001),
(24, 1, '2024-01-22', 230001),
(25, 5, '2024-01-24', 230001),
(26, 25, '2024-01-24', 230003);

--
-- Déclencheurs `points`
--
DROP TRIGGER IF EXISTS `update_Membership`;
DELIMITER $$
CREATE TRIGGER `update_Membership` AFTER INSERT ON `points` FOR EACH ROW BEGIN 
DECLARE totalpoints INT;
DECLARE Membershipid INT ;
DECLARE ClientCode INT ;
DECLARE InitialMembership INT;
SET ClientCode=(SELECT code_client FROM points WHERE points.id_point=NEW.id_point);
SET InitialMembership=(SELECT client.id_membership FROM client WHERE client.code_client=ClientCode);
IF(InitialMembership!=3)
THEN
SET totalpoints=(SELECT SUM(points.point) FROM points WHERE points.code_client=ClientCode);
SET Membershipid=(SELECT MAX(grillepoint.id_membership) FROM grillepoint WHERE grillepoint.minPoint<=totalpoints AND totalpoints<=grillepoint.maxPoint);


UPDATE client SET client.id_membership=Membershipid WHERE client.code_client=ClientCode;
END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `fk_adresse_code_client` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_code_client` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_commande_id_con` FOREIGN KEY (`id_con`) REFERENCES `concierge` (`id_con`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `envoie`
--
ALTER TABLE `envoie`
  ADD CONSTRAINT `fk_envoie_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_envoie_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_envoie_id_livraison` FOREIGN KEY (`id_livraison`) REFERENCES `livraison` (`id_delivery`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `grilleregle`
--
ALTER TABLE `grilleregle`
  ADD CONSTRAINT `fk_grilleregle_id_membership` FOREIGN KEY (`id_membership`) REFERENCES `grillepoint` (`id_membership`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_id_membership` FOREIGN KEY (`id_membership`) REFERENCES `grillepoint` (`id_membership`) ON DELETE CASCADE;

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `fk_livraison_id_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_paiement_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paiement_id_regle` FOREIGN KEY (`id_regle`) REFERENCES `grilleregle` (`id_regle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_paiement_id_transaction` FOREIGN KEY (`id_transaction`) REFERENCES `moyen` (`id_transaction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `fk_point_code_client` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Évènements
--
DROP EVENT `check_exp_point`$$
CREATE DEFINER=`root`@`localhost` EVENT `check_exp_point` ON SCHEDULE EVERY 1 DAY STARTS '2023-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE client SET client.point=(client.point-(SELECT points.point FROM points WHERE points.dateExp=CURRENT_DATE)) WHERE client.code_client=(SELECT points.code_client FROM points WHERE points.dateExp=CURRENT_DATE)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
