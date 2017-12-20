-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2016 at 03:36 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `catalog_service_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `arch-platform`
--

CREATE TABLE IF NOT EXISTS `arch-platform` (
  `ap-plateforme_id` int(11) NOT NULL,
  `ap-architectur_id` int(11) NOT NULL,
  PRIMARY KEY (`ap-plateforme_id`,`ap-architectur_id`),
  KEY `fk_Plateforme_has_Architecture_Architecture1_idx` (`ap-architectur_id`),
  KEY `fk_arch_platform_plateforme1_idx` (`ap-plateforme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `architecture`
--

CREATE TABLE IF NOT EXISTS `architecture` (
  `architectur_id` int(11) NOT NULL AUTO_INCREMENT,
  `architectur_nom_srvc` varchar(150) NOT NULL,
  `architecture_desc` varchar(150) DEFAULT NULL,
  `architectur_version` varchar(3) DEFAULT NULL,
  `architectur_datemodif` date DEFAULT NULL,
  `architecure-responsabl_id` int(11) DEFAULT NULL,
  `file_path` varchar(500) DEFAULT NULL COMMENT 'chemin du fichier contenant le model de cette architecture',
  PRIMARY KEY (`architectur_id`),
  KEY `fk_Architecture_responsable1_idx` (`architecure-responsabl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `architecture`
--

INSERT INTO `architecture` (`architectur_id`, `architectur_nom_srvc`, `architecture_desc`, `architectur_version`, `architectur_datemodif`, `architecure-responsabl_id`, `file_path`) VALUES
(1, 'Absolute', NULL, NULL, NULL, NULL, 'Absolute.json'),
(2, 'Orange money', NULL, NULL, NULL, NULL, 'Orange_money.json');

-- --------------------------------------------------------

--
-- Table structure for table `chaine_escalade`
--

CREATE TABLE IF NOT EXISTS `chaine_escalade` (
  `chainesc_id` int(11) NOT NULL AUTO_INCREMENT,
  `chainesc_groupesout_id` int(11) NOT NULL,
  `chainesc_description` varchar(250) DEFAULT NULL COMMENT 'description de la chaine, BH ou non BH par exemple',
  `esc1` int(11) DEFAULT NULL,
  `esc2` int(11) DEFAULT NULL,
  `esc3` int(11) DEFAULT NULL,
  `esc4` int(11) DEFAULT NULL,
  `esc5` int(11) DEFAULT NULL,
  `esc6` int(11) DEFAULT NULL,
  `esc7` int(11) DEFAULT NULL,
  PRIMARY KEY (`chainesc_id`),
  KEY `id_chainesout_idx` (`chainesc_groupesout_id`),
  KEY `esc1` (`esc1`),
  KEY `esc2` (`esc2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `chaine_escalade`
--

INSERT INTO `chaine_escalade` (`chainesc_id`, `chainesc_groupesout_id`, `chainesc_description`, `esc1`, `esc2`, `esc3`, `esc4`, `esc5`, `esc6`, `esc7`) VALUES
(1, 1, NULL, 6, 3, 15, NULL, NULL, NULL, NULL),
(2, 3, NULL, 1, 2, 3, 4, 5, NULL, NULL),
(4, 2, 'Business hours', 19, 20, NULL, NULL, NULL, NULL, NULL),
(5, 5, 'Business hours', 1, 3, 15, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chaine_soutien`
--

CREATE TABLE IF NOT EXISTS `chaine_soutien` (
  `chainesout_id` int(11) NOT NULL AUTO_INCREMENT,
  `chainesout_nom` varchar(150) NOT NULL,
  `chainesout_niv1` int(11) NOT NULL COMMENT 'il faut au moins 1 ninveau dans la chaine',
  `chainesout_niv2` int(11) DEFAULT NULL,
  `chainesout_niv3` int(11) DEFAULT NULL,
  `chainesout_niv4` int(11) DEFAULT NULL,
  `chainesout_niv5` int(11) DEFAULT NULL,
  `chainesout_niv6` int(11) DEFAULT NULL,
  `chainesout_niv7` int(11) DEFAULT NULL,
  PRIMARY KEY (`chainesout_id`),
  UNIQUE KEY `chainesout_type_UNIQUE` (`chainesout_nom`),
  KEY `chainesout_niv1` (`chainesout_niv1`),
  KEY `chainesout_niv2` (`chainesout_niv2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `chaine_soutien`
--

INSERT INTO `chaine_soutien` (`chainesout_id`, `chainesout_nom`, `chainesout_niv1`, `chainesout_niv2`, `chainesout_niv3`, `chainesout_niv4`, `chainesout_niv5`, `chainesout_niv6`, `chainesout_niv7`) VALUES
(1, 'Mi Orange', 1, 2, NULL, NULL, NULL, NULL, NULL),
(2, 'Orange Money', 1, 5, 3, 4, NULL, NULL, NULL),
(3, 'SSPO', 5, 3, NULL, NULL, NULL, NULL, NULL),
(4, 'SMC', 4, 2, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupes_de_soutien`
--

CREATE TABLE IF NOT EXISTS `groupes_de_soutien` (
  `groupe_de_soutien_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_de_soutien_nom` varchar(200) NOT NULL,
  `groupe_de_soutien_pays` varchar(200) DEFAULT NULL,
  `groupe_de_soutien_details` text,
  `groupe_de_soutien_disponibility` text,
  PRIMARY KEY (`groupe_de_soutien_id`),
  UNIQUE KEY `groupe_de_soutien_nom` (`groupe_de_soutien_nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `groupes_de_soutien`
--

INSERT INTO `groupes_de_soutien` (`groupe_de_soutien_id`, `groupe_de_soutien_nom`, `groupe_de_soutien_pays`, `groupe_de_soutien_details`, `groupe_de_soutien_disponibility`) VALUES
(1, 'SMC', 'Cameroun', NULL, 'lundi à vendredi 8h-18h'),
(2, 'SSPO', 'Belgique', NULL, 'Lundi à vendredi 9h-18h.'),
(3, 'TMC', 'Cameroun', NULL, 'Lundi à Vendredi 8h-18h'),
(4, 'GOS', NULL, NULL, NULL),
(5, 'GNOC', 'Cote d''ivoire', 'Groupe intermediaire avec le fournisseur', 'Monday to Friday 8am to 6am');

-- --------------------------------------------------------

--
-- Table structure for table `groupsout_chainesc`
--

CREATE TABLE IF NOT EXISTS `groupsout_chainesc` (
  `groupsout_chainesc_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupsout_chainesc_groupsout_id` int(11) NOT NULL,
  `groupsout_chainesc_niv1` int(11) NOT NULL,
  `groupsout_chainesc_niv2` int(11) NOT NULL,
  `groupsout_chainesc_niv3` int(11) DEFAULT NULL,
  `groupsout_chainesc_niv4` int(11) DEFAULT NULL,
  `groupsout_chainesc_niv5` int(11) DEFAULT NULL,
  `groupsout_chainesc_niv6` int(11) DEFAULT NULL,
  `groupsout_chainesc_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`groupsout_chainesc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `groupsout_chainesc`
--

INSERT INTO `groupsout_chainesc` (`groupsout_chainesc_id`, `groupsout_chainesc_groupsout_id`, `groupsout_chainesc_niv1`, `groupsout_chainesc_niv2`, `groupsout_chainesc_niv3`, `groupsout_chainesc_niv4`, `groupsout_chainesc_niv5`, `groupsout_chainesc_niv6`, `groupsout_chainesc_desc`) VALUES
(1, 1, 3, 15, NULL, NULL, NULL, NULL, ''),
(2, 2, 8, 19, 20, NULL, NULL, NULL, 'Business hours'),
(3, 2, 8, 21, 20, NULL, NULL, NULL, 'Non business hours');

-- --------------------------------------------------------

--
-- Table structure for table `outil`
--

CREATE TABLE IF NOT EXISTS `outil` (
  `outil_id` int(11) NOT NULL AUTO_INCREMENT,
  `outil_nom` varchar(100) NOT NULL,
  PRIMARY KEY (`outil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `outil`
--

INSERT INTO `outil` (`outil_id`, `outil_nom`) VALUES
(1, 'OCEANE'),
(2, 'SWAN');

-- --------------------------------------------------------

--
-- Table structure for table `plateforme`
--

CREATE TABLE IF NOT EXISTS `plateforme` (
  `plateforme_id` int(11) NOT NULL AUTO_INCREMENT,
  `plateforme_nom` varchar(45) NOT NULL,
  `plateforme_fournisseur` varchar(200) DEFAULT NULL,
  `plateforme_outil_supervision` varchar(100) DEFAULT NULL,
  `plateforme_chainesout_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`plateforme_id`,`plateforme_chainesout_id`),
  UNIQUE KEY `plateforme_nom_UNIQUE` (`plateforme_nom`),
  KEY `fk_plateforme_chaine_soutien1_idx` (`plateforme_chainesout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `plateforme`
--

INSERT INTO `plateforme` (`plateforme_id`, `plateforme_nom`, `plateforme_fournisseur`, `plateforme_outil_supervision`, `plateforme_chainesout_id`) VALUES
(1, 'USSD MVAS', 'HUAWEI', 'I2000', 1),
(2, 'Zebra', 'COMVIVA', '', 3),
(3, 'Tango', 'COMVIVA', NULL, 3),
(4, 'SMSC', 'HUAWEI', 'I2000, NEST', 3);

-- --------------------------------------------------------

--
-- Table structure for table `responsable`
--

CREATE TABLE IF NOT EXISTS `responsable` (
  `responsable_id` int(11) NOT NULL AUTO_INCREMENT,
  `responsable_fonct` varchar(150) DEFAULT NULL,
  `responsable_nomprenom` varchar(150) NOT NULL,
  `responsable_email` varchar(100) NOT NULL,
  `responsable_tel1` varchar(45) DEFAULT 'N/A',
  `responsable_tel2` varchar(45) DEFAULT 'N/A',
  `responsable_eds` varchar(150) DEFAULT NULL,
  `responsable_disponibilite` varchar(45) NOT NULL,
  `responsable_pswd` varchar(100) NOT NULL,
  `responsable_privilege` int(11) NOT NULL,
  PRIMARY KEY (`responsable_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `responsable`
--

INSERT INTO `responsable` (`responsable_id`, `responsable_fonct`, `responsable_nomprenom`, `responsable_email`, `responsable_tel1`, `responsable_tel2`, `responsable_eds`, `responsable_disponibilite`, `responsable_pswd`, `responsable_privilege`) VALUES
(1, NULL, 'supervision_reseau', 'supervision_reseau@orange.cm', '+237 699941307', NULL, '530070', '24/7', '1234', 1),
(2, NULL, 'ocm business support', 'ocm.businesssupport@orange.com', 'N/A', NULL, NULL, 'BH', '1234', 1),
(3, NULL, 'Achille Tchapi', 'achille.tchapi@orange.com', '+237 699949264', NULL, NULL, 'BH', '1234', 2),
(4, NULL, 'VAS Team', 'dti_dps_sva@orange.com', '+237 699949989', NULL, NULL, '24/7', '1234', 1),
(5, 'GOS L2', 'aristide bekroundjo', 'aristide.bekroundjo.orange-cit.ci\r\nguy-serge.affechi@orange-cit.ci', '+22521239098', NULL, NULL, '', '1234', 1),
(6, 'GOS SPOC', 'supervision_gos', 'supervision.gos@orange-cit.ci', NULL, NULL, '555402', '24/7', '1234', 1),
(7, 'TMC Application', 'Michel herve', 'herve.takoundjou@orange-cit.ci', '+22549216529', NULL, NULL, '', '123', 2),
(8, 'SPOC team for incidents', 'SSPO Front Office', 'sspo.incident@orange.com', '+40 374 44 1200', 'N/A', '505010', '24/7', '', 1),
(12, 'Monitoring team', 'Incident support service ', 'supervision_reseau@orange.cm', '699941307', 'N/A', 'OCEANE: 530070', '24/7', '', 0),
(13, 'service maintenance team', 'Change management validator ', 'ocm.businesssupport@orange.com', 'N/A', 'N/A', 'SWAN: 530047', 'BH', '', 0),
(14, NULL, 'NDOUMBE Emmanuel', 'emmanuel.ndoumbe@orange.com', '', 'N/A', NULL, '24/7', '', 1),
(15, NULL, 'MEKOULOU Michel', 'michel.mekoulou@orange.com', '+237 699949982', 'N/A', NULL, 'BH', '', 1),
(16, NULL, 'MVONDO Cyril', 'cyril.mvondo@orange.com', '699949485', 'N/A', NULL, 'BH', '', 1),
(17, NULL, 'LAMBERTY Gilles', 'gilles.lamberty@orange.com', '', 'N/A', NULL, 'BH', '', 0),
(18, 'SPOC team for changes', 'SSPO Front Office', 'sspo.change@orange.com', '+40 374 44 1200', 'N/A', '505012', 'BH Ro', '', 1),
(19, 'Head of Front Office', 'Ionut Birzu', 'ionut.birzu@orange.com', '+40 374 44 1350', '+40 747 44 1312(mob)', NULL, 'BH Ro', '', 1),
(20, 'SSPO Director', 'Stefan Ionescu', 'stefan.ionescu@orange.com', '+40 744 44 1065(mob)', 'N/A', NULL, 'BH Ro', '', 1),
(21, NULL, 'Manager on Call', 'sspo.oncall.manager@orange.com', '+40 374 44 1290', 'N/A', NULL, 'Non BH Ro', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_nom` varchar(45) NOT NULL,
  `service_desc` text,
  `icon_url` varchar(200) DEFAULT 'service_default_ico.png' COMMENT 'service''s icon location',
  `service_chainesout_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`,`service_chainesout_id`),
  UNIQUE KEY `service_nom_UNIQUE` (`service_nom`),
  KEY `service_chainesout_id` (`service_chainesout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_nom`, `service_desc`, `icon_url`, `service_chainesout_id`) VALUES
(1, 'Mi Orange', 'Service de gestion des comptes personnels', 'myorange.png', 1),
(2, 'Orange money', 'Service de paiement mobile', 'orangemoney.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `service-arch`
--

CREATE TABLE IF NOT EXISTS `service-arch` (
  `sa_architecture_id` int(11) NOT NULL,
  `sa_service_id` int(11) NOT NULL,
  PRIMARY KEY (`sa_architecture_id`,`sa_service_id`),
  KEY `fk_servc_arch_architecture1_idx` (`sa_architecture_id`),
  KEY `fk_service_arch_service1_idx` (`sa_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service-arch`
--

INSERT INTO `service-arch` (`sa_architecture_id`, `sa_service_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service-outil`
--

CREATE TABLE IF NOT EXISTS `service-outil` (
  `so_outil_id` int(11) NOT NULL,
  `so_service_id` int(11) NOT NULL,
  PRIMARY KEY (`so_outil_id`,`so_service_id`),
  KEY `fk_service_outil_service1_idx` (`so_service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service-outil`
--

INSERT INTO `service-outil` (`so_outil_id`, `so_service_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service-plateforme`
--

CREATE TABLE IF NOT EXISTS `service-plateforme` (
  `sp_plateform_id` int(11) NOT NULL,
  `sp_service_id` int(11) NOT NULL,
  PRIMARY KEY (`sp_plateform_id`,`sp_service_id`),
  KEY `fk_plateforme_has_service_service1_idx` (`sp_service_id`),
  KEY `fk_plateforme_has_service_plateforme1_idx` (`sp_plateform_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service-plateforme`
--

INSERT INTO `service-plateforme` (`sp_plateform_id`, `sp_service_id`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arch-platform`
--
ALTER TABLE `arch-platform`
  ADD CONSTRAINT `fk_arch_platform_plateforme1` FOREIGN KEY (`ap-plateforme_id`) REFERENCES `plateforme` (`plateforme_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Plateforme_has_Architecture_Architecture1` FOREIGN KEY (`ap-architectur_id`) REFERENCES `architecture` (`architectur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `architecture`
--
ALTER TABLE `architecture`
  ADD CONSTRAINT `fk_Architecture_responsable1` FOREIGN KEY (`architecure-responsabl_id`) REFERENCES `responsable` (`responsable_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chaine_escalade`
--
ALTER TABLE `chaine_escalade`
  ADD CONSTRAINT `id_groupsout` FOREIGN KEY (`chainesc_groupesout_id`) REFERENCES `groupes_de_soutien` (`groupe_de_soutien_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chainesc_chainesout_esc1_resp` FOREIGN KEY (`esc1`) REFERENCES `responsable` (`responsable_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `chainesc_chainesout_niv2_resp` FOREIGN KEY (`esc2`) REFERENCES `responsable` (`responsable_id`);

--
-- Constraints for table `chaine_soutien`
--
ALTER TABLE `chaine_soutien`
  ADD CONSTRAINT `chainesout_niv2-groupsout_id` FOREIGN KEY (`chainesout_niv2`) REFERENCES `groupes_de_soutien` (`groupe_de_soutien_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chainesout_niv1-groupsout_id` FOREIGN KEY (`chainesout_niv1`) REFERENCES `groupes_de_soutien` (`groupe_de_soutien_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plateforme`
--
ALTER TABLE `plateforme`
  ADD CONSTRAINT `fk_plateforme_chaine_soutien1` FOREIGN KEY (`plateforme_chainesout_id`) REFERENCES `chaine_soutien` (`chainesout_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `fk_service_chaine_soutien1` FOREIGN KEY (`service_chainesout_id`) REFERENCES `chaine_soutien` (`chainesout_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service-arch`
--
ALTER TABLE `service-arch`
  ADD CONSTRAINT `fk_servc_arch_architecture1` FOREIGN KEY (`sa_architecture_id`) REFERENCES `architecture` (`architectur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_service_arch_service1` FOREIGN KEY (`sa_service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service-outil`
--
ALTER TABLE `service-outil`
  ADD CONSTRAINT `fk_service_outils_Outils1` FOREIGN KEY (`so_outil_id`) REFERENCES `outil` (`outil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_service_outil_service1` FOREIGN KEY (`so_service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service-plateforme`
--
ALTER TABLE `service-plateforme`
  ADD CONSTRAINT `fk_plateforme_has_service_plateforme1` FOREIGN KEY (`sp_plateform_id`) REFERENCES `plateforme` (`plateforme_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plateforme_has_service_service1` FOREIGN KEY (`sp_service_id`) REFERENCES `service` (`service_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
