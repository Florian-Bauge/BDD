-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 jan. 2023 à 15:54
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
  `code_client` int NOT NULL REFERENCES client(code_client) ON DELETE CASCADE,
  PRIMARY KEY (`id_adresse`),
  KEY (code_client)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `code_client` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `Facebook` varchar(255) DEFAULT NULL,
  `Instagram` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `id_membership` int NOT NULL REFERENCES grilleregle(grilleregle) ON DELETE CASCADE,
  `point` int DEFAULT '0',
  PRIMARY KEY (`id`),
    KEY(code_client),
  KEY(id_membership)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `code_client` int NOT NULL REFERENCES client(code_client) ON DELETE CASCADE,
  `id_con` int NOT NULL REFERENCES concierge(id_con) ON DELETE CASCADE,
  PRIMARY KEY (`id_commande`),
  KEY(code_client),
  KEY(id_con)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `envoie`
--

DROP TABLE IF EXISTS `envoie`;
CREATE TABLE IF NOT EXISTS `envoie` (
  `id_envoie` int NOT NULL AUTO_INCREMENT,
  `id_item` int NOT NULL REFERENCES item(id_item) ON DELETE CASCADE,
  `id_livraison` int DEFAULT NULL REFERENCES livraison(id_delivery) ON DELETE CASCADE,
  `id_commande` int NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
  `Prix_remise` double NOT NULL DEFAULT '0',
  `statut` varchar(255) DEFAULT NULL,
  `quantité` int DEFAULT NULL,
  PRIMARY KEY (`id_envoie`),
  KEY(id_item),
  KEY(id_livraison),
  KEY(id_commande)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_fact` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `id_commande` int NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
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
  `id_regle` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `point` int NOT NULL,
  `valeur` double NOT NULL,
  `dateExp` date NOT NULL,
  `id_membership` int NOT NULL DEFAULT '0',
  `type` enum('Pourcentage','Réduction','','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_regle`),
  KEY(id_membership)
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
  `id_membership` int NOT NULL DEFAULT '0' REFERENCES grillepoint(id_membership) ON DELETE CASCADE,
  `stock` int NOT NULL,
  PRIMARY KEY (`id_item`),
  KEY(id_membership)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id_adresse` int DEFAULT NULL REFERENCES adresse(id_adresse) ON DELETE CASCADE,
  PRIMARY KEY (`id_delivery`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moyen`
--

DROP TABLE IF EXISTS `moyen`;
CREATE TABLE IF NOT EXISTS `moyen` (
  `id_transaction` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

DROP TABLE IF EXISTS `paiement`;
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_paiment` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `cout` double NOT NULL,
  `id_transaction` int NOT NULL REFERENCES moyen(id_transaction) ON DELETE CASCADE,
  `id_commande` int NOT NULL REFERENCES commande(id_commande) ON DELETE CASCADE,
  `id_regle` int DEFAULT NULL REFERENCES grilleregle(id_regle) ON DELETE CASCADE,
  PRIMARY KEY (`id_paiment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresse`
--
ALTER TABLE `adresse`
  ADD CONSTRAINT `fk_adresse_code_client` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_membership` FOREIGN KEY (`id_membership`) REFERENCES `grilleregle` (`id_membership`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_code_client` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_commande_id_con` FOREIGN KEY (`id_con`) REFERENCES `concierge` (`id_con`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `envoie`
--
ALTER TABLE `envoie`
  ADD CONSTRAINT `fk_envoie_id_item` FOREIGN KEY (`id_item`) REFERENCES `item` (`id_item`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_envoie_id_livraison` FOREIGN KEY (`id_livraison`) REFERENCES `livraison` (`id_delivery`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_envoie_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE ON UPDATE RESTRICT;

  --
-- Contraintes pour la table `grilleregle`
--
ALTER TABLE `grilleregle`
  ADD CONSTRAINT `fk_grilleregle_id_membership` FOREIGN KEY (`id_membership`) REFERENCES `grillepoint` (`id_membership`) ON DELETE CASCADE ON UPDATE RESTRICT;
   

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_item_id_membership` FOREIGN KEY (`id_membership`) REFERENCES `grillepoint` (`id_membership`) ON DELETE CASCADE ON UPDATE RESTRICT;
   
 

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `fk_livraison_id_adresse` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`id_adresse`) ON DELETE CASCADE ON UPDATE RESTRICT;
   


--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `fk_paiement_id_commande` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_paiement_id_transaction` FOREIGN KEY (`id_transaction`) REFERENCES `moyen` (`id_transaction`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_paiement_id_regle` FOREIGN KEY (`id_regle`) REFERENCES `grilleregle` (`id_regle`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
