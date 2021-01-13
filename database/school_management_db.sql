-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 nov. 2020 à 08:20
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `school_management_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `tb_pm_aide`
--

CREATE TABLE `tb_pm_aide` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` text,
  `issue` text,
  `date_logged` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_pm_assets`
--

CREATE TABLE `tb_pm_assets` (
  `id_asset` int(11) NOT NULL,
  `asset_name` varchar(40) NOT NULL,
  `asset_username` varchar(50) DEFAULT NULL,
  `asset_password` varchar(60) DEFAULT NULL,
  `asset_email` varchar(50) DEFAULT NULL,
  `asset_departement` varchar(50) DEFAULT NULL,
  `asset_type` varchar(20) DEFAULT 'agent',
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_connected` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) DEFAULT '1',
  `password_save` int(1) DEFAULT '0',
  `groupe` varchar(50) NOT NULL DEFAULT 'administrator'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_pm_assets`
--

INSERT INTO `tb_pm_assets` (`id_asset`, `asset_name`, `asset_username`, `asset_password`, `asset_email`, `asset_departement`, `asset_type`, `date_ajout`, `date_connected`, `status`, `password_save`, `groupe`) VALUES
(20, 'Sarah Kapinga Kabongo', 'kapinga', '$2y$12$wP.fXn/7nLYcI4WhYXBnsOpRvr00bjfQRhaOScgDo4ifSWaf0Md36', 'kapinga@congoagile.net', 'Enseignement', 'utilisateur', '2020-02-25 13:02:24', '2019-11-23 07:37:32', '1', 1, 'administratif'),
(82, 'elie mwez rubuz', 'eliemwez', '$2y$12$97qRcd3L7/du0TkDiZ8xguLN1BQscLmRpb3vPTWHDMqVaW1l3pbFC', 'mwez.rubuz@congoagile.net', 'Administration', 'administrator', '2020-02-25 10:47:57', '2020-02-23 10:57:33', '1', 0, 'administrator'),
(83, 'erick banze wa banze', 'erickbanze', '$2y$12$g/XOtLgjNxL/gWUEP0FRaudC7Sz2DETs35n65KbTPZM8wxDA71p32', 'erickbanze@congoagile.net', 'Finance', 'utilisateur', '2020-02-26 18:46:15', '2020-02-23 11:06:17', '1', 0, 'financier');

-- --------------------------------------------------------

--
-- Structure de la table `tb_pm_logs`
--

CREATE TABLE `tb_pm_logs` (
  `log_id` int(11) NOT NULL,
  `log_username` varchar(75) NOT NULL,
  `log_contenu` text,
  `log_statut` varchar(75) NOT NULL DEFAULT 'online',
  `log_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_pm_reset_passsword`
--

CREATE TABLE `tb_pm_reset_passsword` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_pm_services`
--

CREATE TABLE `tb_pm_services` (
  `id_service` int(11) NOT NULL,
  `service_code` varchar(25) NOT NULL,
  `service_nom` varchar(75) NOT NULL,
  `service_lieu` varchar(75) NOT NULL,
  `service_cout` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_actualites`
--

CREATE TABLE `tb_school_actualites` (
  `id_actualite` int(11) NOT NULL,
  `title_actualite` varchar(75) NOT NULL,
  `contenu` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_actualites`
--

INSERT INTO `tb_school_actualites` (`id_actualite`, `title_actualite`, `contenu`, `date_created`) VALUES
(1, 'Vacances de noel', 'Tous les eleves de la sixieme des humanités sont priés de restés poursuivre les cours tout au long de la vacances.', '2020-02-24 09:00:22');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_assets`
--

CREATE TABLE `tb_school_assets` (
  `id_asset` int(11) NOT NULL,
  `asset_name` varchar(40) NOT NULL,
  `asset_username` varchar(50) DEFAULT NULL,
  `asset_password` varchar(60) DEFAULT NULL,
  `asset_email` varchar(50) DEFAULT NULL,
  `asset_departement` varchar(50) DEFAULT NULL,
  `asset_type` varchar(20) DEFAULT 'agent',
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_connected` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(1) DEFAULT '1',
  `password_save` int(1) DEFAULT '0',
  `groupe` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_assets`
--

INSERT INTO `tb_school_assets` (`id_asset`, `asset_name`, `asset_username`, `asset_password`, `asset_email`, `asset_departement`, `asset_type`, `date_ajout`, `date_connected`, `status`, `password_save`, `groupe`) VALUES
(77, 'Administrateur', 'admin', '$2y$12$RA8IFVRydB6V8IW5Kf4VpumkJrn0jmgXGuZt2nNsDrQj3xJ3gmv2C', 'admin@gmail.com', 'ADMINISTRATION', 'administrator', '2020-11-03 06:28:59', '2020-01-26 10:32:36', '1', 0, 'financier'),
(78, 'elie mwez', 'eliemwez', '$2y$12$bNfPgbr5.81K1Laucgsd8uyp30Pb2VVnU3j2xLv2V0EHAV6iODO8i', 'eliemwez@gmail.com', 'Finance', 'utilisateur', '2020-11-04 20:52:14', '2020-03-22 00:10:09', '1', 0, 'financier'),
(81, 'kazadi henoc', 'hen.kazadi', '$2y$12$QeHO2Ef6NhAgoy5ANxFMk.yz7sIkalos/WNlWjn2av3baIPI5aaa6', 'kazadi.henoc@school.com', 'Administration', 'utilisateur', '2020-11-04 20:52:22', '2020-09-05 08:15:03', '1', 0, 'administratif'),
(82, 'doudou k', 'doudou', '$2y$12$QWfyYxQA5vL4dILgMw2uz.6i.pQxp/G1ZskD5SQq4zHNyr6oDUJ4i', 'd.k@gmail.com', 'Finance et comptabilité', 'utilisateur', '2020-11-03 07:42:39', '2020-09-05 09:35:57', '1', 0, 'financier');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_classes`
--

CREATE TABLE `tb_school_classes` (
  `id_classe` int(11) NOT NULL,
  `nom_classe` varchar(50) DEFAULT NULL,
  `effectif` int(11) DEFAULT NULL,
  `seuil` int(11) DEFAULT NULL,
  `cycle` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_classes`
--

INSERT INTO `tb_school_classes` (`id_classe`, `nom_classe`, `effectif`, `seuil`, `cycle`, `date_created`) VALUES
(1, '1ère primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(2, '2ème primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(3, '3ème primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(4, '4ème primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(5, '5ème primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(6, '6ème primaire', NULL, NULL, 'primaire', '2020-02-22 10:59:06'),
(7, '7ème EB', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(8, '8ème EB', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(9, '3ème humanités', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(10, '4ème humanités', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(11, '5ème humanités', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(12, '6ème humanités', NULL, NULL, 'secondaire', '2020-02-22 10:59:06'),
(13, '1ère maternelle', NULL, NULL, 'maternel', '2020-02-22 10:59:06'),
(14, '2ème maternelle', NULL, NULL, 'maternel', '2020-02-22 10:59:06'),
(15, '3ème maternelle', NULL, NULL, 'maternel', '2020-02-22 10:59:06'),
(16, 'CLASSE TESTE', 200, NULL, 'primaire', '2020-02-22 10:59:06');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_comptes`
--

CREATE TABLE `tb_school_comptes` (
  `id` int(11) NOT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `solde_courant` float DEFAULT NULL,
  `total_entree` float DEFAULT NULL,
  `total_sortie` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_comptes`
--

INSERT INTO `tb_school_comptes` (`id`, `devise`, `solde_courant`, `total_entree`, `total_sortie`) VALUES
(1, 'CDF', 165000000, 165000000, 0),
(2, 'USD', 265, 265, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_documents`
--

CREATE TABLE `tb_school_documents` (
  `id_document` int(11) NOT NULL,
  `numero_document` varchar(75) NOT NULL,
  `matricule_eleve` varchar(50) NOT NULL,
  `nom_document` varchar(75) NOT NULL,
  `lieu_delivrance` varchar(75) NOT NULL,
  `date_delivrance` date NOT NULL,
  `contenu` text NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_documents`
--

INSERT INTO `tb_school_documents` (`id_document`, `numero_document`, `matricule_eleve`, `nom_document`, `lieu_delivrance`, `date_delivrance`, `contenu`, `date_created`) VALUES
(1, 'D01-2019-BS3HP', 'EL-2018-2019-008', 'BULLETIN 3 EME HP', 'LUBUMBASHI', '2019-07-02', 'RAS', '2020-02-24 09:34:50');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_eleves`
--

CREATE TABLE `tb_school_eleves` (
  `id_eleve` int(11) NOT NULL,
  `matricule_eleve` varchar(50) DEFAULT NULL,
  `nom_complet` varchar(75) DEFAULT NULL,
  `genre` varchar(10) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(50) DEFAULT NULL,
  `adresse_eleve` text,
  `contact_eleve` varchar(15) DEFAULT NULL,
  `nom_pere` varchar(75) DEFAULT NULL,
  `nom_mere` varchar(75) DEFAULT NULL,
  `nom_tuteur` varchar(75) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `statut_eleve` varchar(25) NOT NULL DEFAULT 'online',
  `profession_parent` varchar(75) DEFAULT NULL,
  `code_sernie` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_eleves`
--

INSERT INTO `tb_school_eleves` (`id_eleve`, `matricule_eleve`, `nom_complet`, `genre`, `date_naissance`, `lieu_naissance`, `adresse_eleve`, `contact_eleve`, `nom_pere`, `nom_mere`, `nom_tuteur`, `email`, `statut_eleve`, `profession_parent`, `code_sernie`) VALUES
(7, 'EL-2018-2019-007', 'kanzeu mubenga lumière', 'feminin', '2007-07-28', 'lubumbashi', '1134, bel air, kampemba', '0973305330', 'kazadi', 'mujinga', 'nday jp', 'lulu@gmail.com', 'online', NULL, NULL),
(8, 'EL-2018-2019-008', 'kabedi kalala daniella', 'feminin', '2009-03-13', 'lubumbashi', '29, kasapa, lubumbashi', '0973305330', 'kalala jeremie', 'kabedi lea', 'mubenga guy', 'kabdan@gmail.com', 'online', NULL, NULL),
(10, 'EL-2018-2019-010', 'bilema mandungu marie mercedes', 'feminin', '2005-03-13', 'lubumbashi', '1134, bel air, kampemba', '0820050664', 'kazadi', 'mujinga', 'nday jp', 'bilmmm@gmail.com', 'online', NULL, NULL),
(11, 'EL-2018-2019-011', 'mulumba kalala pascal', 'masculin', '2005-04-24', 'lubumbashi', '243, kaleja kampemba', '0895336281', 'kalala', 'kabedi', 'joflamme LK', 'pasco@gmail.com', 'online', NULL, NULL),
(13, 'EL-2019-2020-013', 'mwape ruth', 'feminin', '2015-09-14', 'likasi', '52, katuba, lubumbashi, haut-katanga', '0906717688', 'ngoie kinsenda', 'Carine yelele', 'ngoie yamba', 'mwaru@gmail.com', 'offline', NULL, NULL),
(14, 'EL-2020-2021-014', 'françois cheche chipeng', 'masculin', '2002-12-12', 'luanda, angola', '25, de rosier, bel-air, kampemba, lubumbashi, haut-katanga', '0858533285', 'chipeng Joseph', 'melanie chirene', 'elie mwez rubuz', 'francois.cheche@congoagile.net', 'offline', NULL, NULL),
(15, 'EL-2020-2021-00', 'melanie chirene', 'feminin', '2010-10-05', 'likasi', '25, savonnier, bel-air, kampemba, rdc', '0858533285', 'Mohamed Rub', 'melanie', 'LEA Moha', 'rumbu@trecazad.com', 'online', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_frais`
--

CREATE TABLE `tb_school_frais` (
  `id` int(11) NOT NULL,
  `type_frais` varchar(50) DEFAULT NULL,
  `montant_fixe` float DEFAULT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `taux_change` float DEFAULT NULL,
  `cycle` varchar(50) DEFAULT NULL,
  `annee_scolaire` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_frais`
--

INSERT INTO `tb_school_frais` (`id`, `type_frais`, `montant_fixe`, `devise`, `taux_change`, `cycle`, `annee_scolaire`) VALUES
(1, 'minerval', 100, 'USD', 1650, 'primaire', '2020-2021'),
(2, 'minerval', 100, 'USD', 1950, 'secondaire', '2020-2021'),
(3, 'inscription', 75, 'USD', 1650, 'primaire', '2019-2020'),
(4, 'inscription', 150, 'USD', 1950, 'secondaire', '2019-2020'),
(5, 'frais_connexes', 120000, 'CDF', 1650, 'primaire', '2019-2020'),
(6, 'frais-connexes', 150000, 'CDF', 1650, 'secondaire', '2019-2020'),
(8, 'frais_connexes', 100000, 'CDF', 1650, 'maternelle', '2018-2019'),
(10, 'inscription', 55, 'USD', 1650, 'maternelle', '2019-2020'),
(11, 'minerval', 120, 'USD', 1600, 'maternelle', '2018-2019');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_groupes`
--

CREATE TABLE `tb_school_groupes` (
  `id_groupe` int(11) NOT NULL,
  `nom_groupe` varchar(75) NOT NULL,
  `privilege_groupe` varchar(75) NOT NULL,
  `statut_groupe` varchar(75) NOT NULL DEFAULT 'online',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_inscriptions`
--

CREATE TABLE `tb_school_inscriptions` (
  `id_inscription` int(11) NOT NULL,
  `date_inscription` date DEFAULT NULL,
  `annee_scolaire` varchar(10) DEFAULT NULL,
  `matricule_eleve` varchar(50) DEFAULT NULL,
  `nom_classe` varchar(50) DEFAULT NULL,
  `nom_option` varchar(50) DEFAULT NULL,
  `nom_section` varchar(50) DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `etat_inscription` varchar(50) DEFAULT NULL,
  `cycle` varchar(50) DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_inscriptions`
--

INSERT INTO `tb_school_inscriptions` (`id_inscription`, `date_inscription`, `annee_scolaire`, `matricule_eleve`, `nom_classe`, `nom_option`, `nom_section`, `date_demande`, `etat_inscription`, `cycle`, `date_validation`) VALUES
(6, '2019-09-18', '2018-2019', 'EL-2018-2019-007', '7ème EB', NULL, NULL, '2018-09-11', 'validé', 'secondaire', NULL),
(7, '2019-09-11', '2020-2021', 'EL-2018-2019-008', '6ème primaire', NULL, NULL, '2018-09-11', 'en attente', 'primaire', NULL),
(9, '2019-08-21', '2018-2019', 'EL-2018-2019-010', '3ème humanités', 'latin-philo', NULL, '2018-09-11', 'validé', 'secondaire', '2020-02-26 13:42:40'),
(10, '2019-09-11', '2018-2019', 'EL-2018-2019-011', '3ème humanités', 'électricité', 'technique', '2018-09-11', 'en attente', 'secondaire', NULL),
(11, '2019-09-25', '2019-2020', 'EL-2018-2019-007', '8ème EB', '', NULL, '2019-09-11', 'validé', 'secondaire', NULL),
(13, '2019-10-10', '2019-2020', 'EL-2019-2020-013', '3ème maternelle', NULL, NULL, '2019-09-18', 'validé', 'maternel', NULL),
(14, '2020-02-26', '2020-2021', 'EL-2020-2021-014', '4ème humanités', 'Industrielle', 'Technique', '2020-02-26', 'en attente', 'secondaire', NULL),
(15, '2020-10-27', '2020-2021', 'EL-2020-2021-00', '3ème primaire', NULL, NULL, '2020-10-27', 'en attente', 'primaire', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_mois`
--

CREATE TABLE `tb_school_mois` (
  `id` int(11) NOT NULL,
  `mois` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_mois`
--

INSERT INTO `tb_school_mois` (`id`, `mois`) VALUES
(7, 'avril'),
(3, 'decembre'),
(5, 'fevrier'),
(4, 'janvier'),
(9, 'juin'),
(8, 'mai'),
(6, 'mars'),
(2, 'novembre'),
(1, 'octobre'),
(10, 'septembre');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_options`
--

CREATE TABLE `tb_school_options` (
  `id_option` int(11) NOT NULL,
  `nom_option` varchar(50) DEFAULT NULL,
  `id_section` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_options`
--

INSERT INTO `tb_school_options` (`id_option`, `nom_option`, `id_section`, `date_created`) VALUES
(1, 'math-physique', 0, '2020-02-23 05:38:00'),
(2, 'biochimie', 1, '2020-02-23 05:38:00'),
(3, 'mécanique générale', 0, '2020-02-23 05:38:00'),
(4, 'électronique', 0, '2020-02-23 05:38:00'),
(5, 'commerciale informatique', 0, '2020-02-23 05:38:00'),
(6, 'latin-philo', 0, '2020-02-23 05:38:00'),
(7, 'Agronomie', 2, '2020-02-23 05:38:00'),
(8, 'électricité', 0, '2020-02-23 05:38:00'),
(9, 'industrielle', 2, '2020-02-23 06:22:26');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_paiements`
--

CREATE TABLE `tb_school_paiements` (
  `id` int(11) NOT NULL,
  `code_validation` varchar(50) DEFAULT NULL,
  `date_paiement` date NOT NULL,
  `date_validation` date DEFAULT NULL,
  `montant_paye` double DEFAULT NULL,
  `devise` varchar(10) DEFAULT NULL,
  `type_frais` varchar(50) DEFAULT NULL,
  `mois` varchar(50) DEFAULT NULL,
  `matricule_eleve` varchar(50) DEFAULT NULL,
  `montant_restant` float DEFAULT NULL,
  `montant_complet` varchar(50) DEFAULT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL,
  `statut_paiement` varchar(50) DEFAULT NULL,
  `annee_scolaire` varchar(10) DEFAULT NULL,
  `numero_expediteur` varchar(50) DEFAULT NULL,
  `nom_expediteur` varchar(50) DEFAULT NULL,
  `date_envoi` datetime DEFAULT NULL,
  `service_mobile` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_paiements`
--

INSERT INTO `tb_school_paiements` (`id`, `code_validation`, `date_paiement`, `date_validation`, `montant_paye`, `devise`, `type_frais`, `mois`, `matricule_eleve`, `montant_restant`, `montant_complet`, `mode_paiement`, `statut_paiement`, `annee_scolaire`, `numero_expediteur`, `nom_expediteur`, `date_envoi`, `service_mobile`) VALUES
(3, 'xpJ|:ys6gI', '2018-09-11', '2018-09-11', 70, 'USD', 'inscription', NULL, 'EL-2018-2019-008', 0, NULL, 'local', 'validé', '2018-2019', NULL, NULL, NULL, NULL),
(5, 'tghri02', '2019-05-18', NULL, 90, 'USD', 'minerval', 'octobre', 'EL-2018-2019-007', 0, NULL, 'en ligne', 'en attente', '2018-2019', '0854449890', 'lulu kanzeu', '2019-09-18 17:00:00', '0840000000 | Orange Money'),
(6, ',CLG\\Y8Z--', '2019-09-18', '2020-02-19', 165000000, 'CDF', 'frais_connexes', NULL, 'EL-2018-2019-008', 0, NULL, 'en ligne', 'amorcé', '2018-2019', '0820050664', 'kasongo', '2019-09-18 12:05:00', '0820000000 | MPSA'),
(7, 'uG36pU#XE7', '2019-09-18', '2019-09-18', 75, 'USD', 'inscription', NULL, 'EL-2018-2019-007', 0, NULL, 'en ligne', 'validé', '2019-2020', 'lulu kanzeu', '0973305330', '2019-09-17 17:00:00', '0990000000 | Airtel Money'),
(8, 'hkbhyl', '2020-02-10', '2020-02-11', 120, 'USD', 'inscription', NULL, 'EL-2020-2021-014', 0, NULL, 'local', 'en attente', '2020-2021', NULL, NULL, NULL, NULL),
(9, 'RNQYqkrgBb', '2020-11-04', '2020-11-04', 80, 'USD', 'minerval', 'novembre', 'EL-2020-2021-00', 0, '100 USD', 'local', 'validé', '2020-2021', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_periodes`
--

CREATE TABLE `tb_school_periodes` (
  `id` int(11) NOT NULL,
  `annee_scolaire` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_periodes`
--

INSERT INTO `tb_school_periodes` (`id`, `annee_scolaire`, `date_created`) VALUES
(1, '2019-2020', '2019-02-25 19:45:04'),
(2, '2018-2019', '2018-02-25 19:45:04'),
(3, '2020-2021', '2020-02-25 19:45:04');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_resultats`
--

CREATE TABLE `tb_school_resultats` (
  `id` int(11) NOT NULL,
  `matricule_eleve` varchar(50) DEFAULT NULL,
  `annee_scolaire` varchar(10) DEFAULT NULL,
  `nom_classe` varchar(50) DEFAULT NULL,
  `nom_option` varchar(50) DEFAULT NULL,
  `nom_section` varchar(50) DEFAULT NULL,
  `cycle` varchar(50) DEFAULT NULL,
  `pourcentage` float DEFAULT NULL,
  `place` int(11) DEFAULT NULL,
  `nombre_echec` int(11) DEFAULT NULL,
  `mention` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_resultats`
--

INSERT INTO `tb_school_resultats` (`id`, `matricule_eleve`, `annee_scolaire`, `nom_classe`, `nom_option`, `nom_section`, `cycle`, `pourcentage`, `place`, `nombre_echec`, `mention`) VALUES
(1, 'EL-2018-2019-007', '2018-2019', '7ème EB', 'latin-philo', NULL, 'secondaire', 48.8, 39, 0, 'reprendre la même classe'),
(2, 'EL-2019-2020-004', '2018-2019', '8ème EB', NULL, NULL, 'secondaire', 61, 20, 2, 'passer en classe supérieure');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_sections`
--

CREATE TABLE `tb_school_sections` (
  `id_section` int(11) NOT NULL,
  `nom_section` varchar(50) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_sections`
--

INSERT INTO `tb_school_sections` (`id_section`, `nom_section`, `date_created`) VALUES
(1, 'Scientifique', '2020-02-22 22:37:22'),
(2, 'technique', '2020-02-22 22:37:22'),
(3, 'Pédagogique', '2020-02-23 05:53:43');

-- --------------------------------------------------------

--
-- Structure de la table `tb_school_services`
--

CREATE TABLE `tb_school_services` (
  `id` int(11) NOT NULL,
  `nom_service` varchar(50) DEFAULT NULL,
  `numero_service` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tb_school_services`
--

INSERT INTO `tb_school_services` (`id`, `nom_service`, `numero_service`) VALUES
(1, 'MPSA', '0820000000'),
(2, 'Airtel Money', '0990000000'),
(3, 'Orange Money', '0840000000'),
(4, 'Africell Money', '0900000000');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_school_eleves_inscrits`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_school_eleves_inscrits` (
`id_eleve` int(11)
,`matricule_eleve` varchar(50)
,`nom_complet` varchar(75)
,`genre` varchar(10)
,`date_naissance` date
,`lieu_naissance` varchar(50)
,`adresse_eleve` text
,`contact_eleve` varchar(15)
,`nom_pere` varchar(75)
,`nom_mere` varchar(75)
,`nom_tuteur` varchar(75)
,`email` varchar(50)
,`date_inscription` date
,`annee_scolaire` varchar(10)
,`nom_classe` varchar(50)
,`nom_option` varchar(50)
,`nom_section` varchar(50)
,`cycle` varchar(50)
,`date_demande` date
,`etat_inscription` varchar(50)
,`id_inscription` int(11)
,`statut_eleve` varchar(25)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `view_school_paiements`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `view_school_paiements` (
`id` int(11)
,`code_validation` varchar(50)
,`date_paiement` date
,`date_validation` date
,`montant_paye` double
,`devise` varchar(10)
,`type_frais` varchar(50)
,`mois` varchar(50)
,`montant_restant` float
,`montant_complet` varchar(50)
,`mode_paiement` varchar(50)
,`statut_paiement` varchar(50)
,`annee_scolaire` varchar(10)
,`numero_expediteur` varchar(50)
,`nom_expediteur` varchar(50)
,`date_envoi` datetime
,`service_mobile` varchar(50)
,`id_eleve` int(11)
,`matricule_eleve` varchar(50)
,`nom_complet` varchar(75)
,`statut_eleve` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure de la vue `view_school_eleves_inscrits`
--
DROP TABLE IF EXISTS `view_school_eleves_inscrits`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_school_eleves_inscrits`  AS  select `tb_school_eleves`.`id_eleve` AS `id_eleve`,`tb_school_eleves`.`matricule_eleve` AS `matricule_eleve`,`tb_school_eleves`.`nom_complet` AS `nom_complet`,`tb_school_eleves`.`genre` AS `genre`,`tb_school_eleves`.`date_naissance` AS `date_naissance`,`tb_school_eleves`.`lieu_naissance` AS `lieu_naissance`,`tb_school_eleves`.`adresse_eleve` AS `adresse_eleve`,`tb_school_eleves`.`contact_eleve` AS `contact_eleve`,`tb_school_eleves`.`nom_pere` AS `nom_pere`,`tb_school_eleves`.`nom_mere` AS `nom_mere`,`tb_school_eleves`.`nom_tuteur` AS `nom_tuteur`,`tb_school_eleves`.`email` AS `email`,`tb_school_inscriptions`.`date_inscription` AS `date_inscription`,`tb_school_inscriptions`.`annee_scolaire` AS `annee_scolaire`,`tb_school_inscriptions`.`nom_classe` AS `nom_classe`,`tb_school_inscriptions`.`nom_option` AS `nom_option`,`tb_school_inscriptions`.`nom_section` AS `nom_section`,`tb_school_inscriptions`.`cycle` AS `cycle`,`tb_school_inscriptions`.`date_demande` AS `date_demande`,`tb_school_inscriptions`.`etat_inscription` AS `etat_inscription`,`tb_school_inscriptions`.`id_inscription` AS `id_inscription`,`tb_school_eleves`.`statut_eleve` AS `statut_eleve` from (`tb_school_inscriptions` join `tb_school_eleves`) where (`tb_school_eleves`.`matricule_eleve` = `tb_school_inscriptions`.`matricule_eleve`) group by `tb_school_eleves`.`nom_complet` order by `tb_school_inscriptions`.`date_inscription` ;

-- --------------------------------------------------------

--
-- Structure de la vue `view_school_paiements`
--
DROP TABLE IF EXISTS `view_school_paiements`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_school_paiements`  AS  select `tb_school_paiements`.`id` AS `id`,`tb_school_paiements`.`code_validation` AS `code_validation`,`tb_school_paiements`.`date_paiement` AS `date_paiement`,`tb_school_paiements`.`date_validation` AS `date_validation`,`tb_school_paiements`.`montant_paye` AS `montant_paye`,`tb_school_paiements`.`devise` AS `devise`,`tb_school_paiements`.`type_frais` AS `type_frais`,`tb_school_paiements`.`mois` AS `mois`,`tb_school_paiements`.`montant_restant` AS `montant_restant`,`tb_school_paiements`.`montant_complet` AS `montant_complet`,`tb_school_paiements`.`mode_paiement` AS `mode_paiement`,`tb_school_paiements`.`statut_paiement` AS `statut_paiement`,`tb_school_paiements`.`annee_scolaire` AS `annee_scolaire`,`tb_school_paiements`.`numero_expediteur` AS `numero_expediteur`,`tb_school_paiements`.`nom_expediteur` AS `nom_expediteur`,`tb_school_paiements`.`date_envoi` AS `date_envoi`,`tb_school_paiements`.`service_mobile` AS `service_mobile`,`tb_school_eleves`.`id_eleve` AS `id_eleve`,`tb_school_eleves`.`matricule_eleve` AS `matricule_eleve`,`tb_school_eleves`.`nom_complet` AS `nom_complet`,`tb_school_eleves`.`statut_eleve` AS `statut_eleve` from (`tb_school_paiements` join `tb_school_eleves`) where (`tb_school_eleves`.`matricule_eleve` = `tb_school_paiements`.`matricule_eleve`) order by `tb_school_paiements`.`date_validation` desc ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tb_pm_aide`
--
ALTER TABLE `tb_pm_aide`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tb_pm_assets`
--
ALTER TABLE `tb_pm_assets`
  ADD PRIMARY KEY (`id_asset`),
  ADD UNIQUE KEY `asset_username` (`asset_username`,`asset_email`);

--
-- Index pour la table `tb_pm_logs`
--
ALTER TABLE `tb_pm_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Index pour la table `tb_pm_reset_passsword`
--
ALTER TABLE `tb_pm_reset_passsword`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tb_pm_services`
--
ALTER TABLE `tb_pm_services`
  ADD PRIMARY KEY (`id_service`),
  ADD UNIQUE KEY `code_service` (`service_code`);

--
-- Index pour la table `tb_school_actualites`
--
ALTER TABLE `tb_school_actualites`
  ADD PRIMARY KEY (`id_actualite`);

--
-- Index pour la table `tb_school_assets`
--
ALTER TABLE `tb_school_assets`
  ADD PRIMARY KEY (`id_asset`),
  ADD UNIQUE KEY `asset_username` (`asset_username`,`asset_email`);

--
-- Index pour la table `tb_school_classes`
--
ALTER TABLE `tb_school_classes`
  ADD PRIMARY KEY (`id_classe`),
  ADD UNIQUE KEY `nom_classe` (`nom_classe`),
  ADD KEY `cycle` (`cycle`);

--
-- Index pour la table `tb_school_comptes`
--
ALTER TABLE `tb_school_comptes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tb_school_documents`
--
ALTER TABLE `tb_school_documents`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `matricule_eleve` (`matricule_eleve`);

--
-- Index pour la table `tb_school_eleves`
--
ALTER TABLE `tb_school_eleves`
  ADD PRIMARY KEY (`id_eleve`),
  ADD UNIQUE KEY `matricule_eleve` (`matricule_eleve`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `tb_school_eleves` ADD FULLTEXT KEY `profession_parent` (`profession_parent`,`code_sernie`);

--
-- Index pour la table `tb_school_frais`
--
ALTER TABLE `tb_school_frais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_section` (`cycle`),
  ADD KEY `type_frais` (`type_frais`),
  ADD KEY `annee_scolaire` (`annee_scolaire`);

--
-- Index pour la table `tb_school_groupes`
--
ALTER TABLE `tb_school_groupes`
  ADD PRIMARY KEY (`id_groupe`),
  ADD UNIQUE KEY `groupe_name` (`nom_groupe`);

--
-- Index pour la table `tb_school_inscriptions`
--
ALTER TABLE `tb_school_inscriptions`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `annee_scolaire` (`annee_scolaire`),
  ADD KEY `matricule_eleve` (`matricule_eleve`),
  ADD KEY `nom_classe` (`nom_classe`),
  ADD KEY `nom_option` (`nom_option`),
  ADD KEY `nom_section` (`nom_section`),
  ADD KEY `cycle` (`cycle`);

--
-- Index pour la table `tb_school_mois`
--
ALTER TABLE `tb_school_mois`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mois` (`mois`);

--
-- Index pour la table `tb_school_options`
--
ALTER TABLE `tb_school_options`
  ADD PRIMARY KEY (`id_option`),
  ADD UNIQUE KEY `nom_option` (`nom_option`);

--
-- Index pour la table `tb_school_paiements`
--
ALTER TABLE `tb_school_paiements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_validation` (`code_validation`),
  ADD KEY `type_frais` (`type_frais`),
  ADD KEY `matricule_eleve` (`matricule_eleve`),
  ADD KEY `annee_scolaire` (`annee_scolaire`);

--
-- Index pour la table `tb_school_periodes`
--
ALTER TABLE `tb_school_periodes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee_scolaire` (`annee_scolaire`);

--
-- Index pour la table `tb_school_resultats`
--
ALTER TABLE `tb_school_resultats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricule_eleve` (`matricule_eleve`),
  ADD KEY `annee_scolaire` (`annee_scolaire`),
  ADD KEY `nom_classe` (`nom_classe`),
  ADD KEY `nom_option` (`nom_option`),
  ADD KEY `nom_section` (`nom_section`),
  ADD KEY `cycle` (`cycle`);

--
-- Index pour la table `tb_school_sections`
--
ALTER TABLE `tb_school_sections`
  ADD PRIMARY KEY (`id_section`),
  ADD UNIQUE KEY `nom_section` (`nom_section`);

--
-- Index pour la table `tb_school_services`
--
ALTER TABLE `tb_school_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tb_pm_aide`
--
ALTER TABLE `tb_pm_aide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_pm_assets`
--
ALTER TABLE `tb_pm_assets`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `tb_pm_logs`
--
ALTER TABLE `tb_pm_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_pm_reset_passsword`
--
ALTER TABLE `tb_pm_reset_passsword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_pm_services`
--
ALTER TABLE `tb_pm_services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_school_actualites`
--
ALTER TABLE `tb_school_actualites`
  MODIFY `id_actualite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tb_school_assets`
--
ALTER TABLE `tb_school_assets`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT pour la table `tb_school_classes`
--
ALTER TABLE `tb_school_classes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `tb_school_comptes`
--
ALTER TABLE `tb_school_comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tb_school_documents`
--
ALTER TABLE `tb_school_documents`
  MODIFY `id_document` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tb_school_eleves`
--
ALTER TABLE `tb_school_eleves`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tb_school_frais`
--
ALTER TABLE `tb_school_frais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `tb_school_groupes`
--
ALTER TABLE `tb_school_groupes`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tb_school_inscriptions`
--
ALTER TABLE `tb_school_inscriptions`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `tb_school_mois`
--
ALTER TABLE `tb_school_mois`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `tb_school_options`
--
ALTER TABLE `tb_school_options`
  MODIFY `id_option` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tb_school_paiements`
--
ALTER TABLE `tb_school_paiements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `tb_school_periodes`
--
ALTER TABLE `tb_school_periodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tb_school_resultats`
--
ALTER TABLE `tb_school_resultats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `tb_school_sections`
--
ALTER TABLE `tb_school_sections`
  MODIFY `id_section` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tb_school_services`
--
ALTER TABLE `tb_school_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tb_school_documents`
--
ALTER TABLE `tb_school_documents`
  ADD CONSTRAINT `tb_school_documents_ibfk_1` FOREIGN KEY (`matricule_eleve`) REFERENCES `tb_school_eleves` (`matricule_eleve`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
