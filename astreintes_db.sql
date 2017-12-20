-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2016 at 08:41 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `astreintes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `chaines_escalades`
--

CREATE TABLE IF NOT EXISTS `chaines_escalades` (
  `chainesc_id` int(11) NOT NULL AUTO_INCREMENT,
  `chainesc_nom` varchar(200) NOT NULL,
  `chainesc_niv1` int(11) NOT NULL,
  `chainesc_niv2` int(11) DEFAULT NULL,
  `chainesc_niv3` int(11) DEFAULT NULL,
  PRIMARY KEY (`chainesc_id`),
  UNIQUE KEY `chainesc_nom` (`chainesc_nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `chaines_escalades`
--

INSERT INTO `chaines_escalades` (`chainesc_id`, `chainesc_nom`, `chainesc_niv1`, `chainesc_niv2`, `chainesc_niv3`) VALUES
(1, 'TMC(POOL FO & TMC)', 9, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `osi_bss_astreinte`
--

CREATE TABLE IF NOT EXISTS `osi_bss_astreinte` (
  `osi_bss_astreinte_weekend` varchar(200) NOT NULL,
  `osi_bss_astreinte_ressource` varchar(200) NOT NULL,
  `osi_bss_astreinte_periode_id` int(11) NOT NULL,
  PRIMARY KEY (`osi_bss_astreinte_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `osi_bss_permanance`
--

CREATE TABLE IF NOT EXISTS `osi_bss_permanance` (
  `osi_bss_permanance_samedi` date NOT NULL,
  `osi_bss_permanance_ressource` varchar(200) NOT NULL COMMENT 'j''ai pas mis les domaines, par ce qu''ils ne changent pas, je peux garder ça en statique dans le code HTML.',
  `osi_bss_permanance_periode_id` int(11) NOT NULL,
  PRIMARY KEY (`osi_bss_permanance_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE IF NOT EXISTS `periode` (
  `periode_id` int(11) NOT NULL AUTO_INCREMENT,
  `periode_debut_semaine` date NOT NULL,
  `periode_fin_semaine` date NOT NULL,
  PRIMARY KEY (`periode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`periode_id`, `periode_debut_semaine`, `periode_fin_semaine`) VALUES
(1, '2016-07-25', '2016-07-31'),
(2, '2016-08-01', '2016-08-07'),
(3, '2016-08-08', '2016-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `personnel_astreinte`
--

CREATE TABLE IF NOT EXISTS `personnel_astreinte` (
  `personnel_astreinte_id` int(11) NOT NULL AUTO_INCREMENT,
  `personnel_nom_prenom` varchar(200) NOT NULL,
  `personnel_contact` varchar(100) DEFAULT NULL,
  `personnel_localisation` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`personnel_astreinte_id`),
  UNIQUE KEY `personnel_nom_prenom_UNIQUE` (`personnel_nom_prenom`),
  UNIQUE KEY `personnel_contact` (`personnel_contact`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `personnel_astreinte`
--

INSERT INTO `personnel_astreinte` (`personnel_astreinte_id`, `personnel_nom_prenom`, `personnel_contact`, `personnel_localisation`) VALUES
(1, 'BIRROKI BIENVENU', '699949195', NULL),
(2, 'Alain MOUEN', '699949056', NULL),
(3, 'Belin TCHAMBA', '699949660', NULL),
(4, 'Serge NGOUFO', '699949279', NULL),
(5, 'Soffo Audrey', '693245455', NULL),
(6, 'Alexandre BISSOHONG', '699949783', NULL),
(7, 'Yannick BEYALA', '696608562', NULL),
(8, 'Onana Alphonse', '699949177', NULL),
(9, 'Jérémi BAYIHA', '699949570/654561503', NULL),
(10, 'Elie BOUOPDA', '699949487/654561502', NULL),
(11, 'Bienvenu Mandounde', '699949179', NULL),
(12, 'Bidias GUEHODAS', '699949178', NULL),
(13, 'Bertrand NDJOCK', '699949376', NULL),
(14, 'KINGUE Sandrine', '699946178', NULL),
(15, 'NDEBI Christian', '699949516', NULL),
(16, 'NGONO Roméo', '699949830', NULL),
(17, 'Michel MEKOULOU', '699949982', NULL),
(18, 'Achille TCHAPI ', '699949264', NULL),
(19, 'KEMAYOU Anicet', '699949581', NULL),
(20, 'PENDA EPANLO JOSE DOMINIQUE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smc_maintce_rotation`
--

CREATE TABLE IF NOT EXISTS `smc_maintce_rotation` (
  `smc_maintce_rotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `smc_maintce_rotation_periode_id` int(11) NOT NULL,
  `smc_maintce_rotation_heure` varchar(45) DEFAULT NULL COMMENT 'moment de la journee',
  `smc_maintce_rotation_heur_wknd` varchar(45) DEFAULT NULL,
  `lundi` int(11) DEFAULT NULL,
  `mardi` int(11) DEFAULT NULL,
  `mercredi` int(11) DEFAULT NULL,
  `Jeudi` int(11) DEFAULT NULL,
  `vendredi` int(11) DEFAULT NULL,
  `Samedi` int(11) DEFAULT NULL,
  `dimanche` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`smc_maintce_rotation_id`),
  KEY `periode_periode_id` (`smc_maintce_rotation_periode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `smc_maintce_rotation`
--

INSERT INTO `smc_maintce_rotation` (`smc_maintce_rotation_id`, `smc_maintce_rotation_periode_id`, `smc_maintce_rotation_heure`, `smc_maintce_rotation_heur_wknd`, `lundi`, `mardi`, `mercredi`, `Jeudi`, `vendredi`, `Samedi`, `dimanche`) VALUES
(1, 2, '8h00-15h00', '9h00-14h00', 20, 20, NULL, NULL, NULL, 15, '20'),
(2, 2, '15h00-22h00', '16h00-21h00', NULL, NULL, 20, 20, 20, NULL, 'Pilote de service d''astreinte'),
(3, 3, '8h00-15h00', '9h00-14h00', NULL, NULL, 20, 20, 20, 15, ''),
(4, 3, '15h00-22h00', '16h00-21h00', 20, 20, NULL, NULL, NULL, 20, 'Pilote de service d''astreinte');

-- --------------------------------------------------------

--
-- Table structure for table `smc_maintenance_reseau`
--

CREATE TABLE IF NOT EXISTS `smc_maintenance_reseau` (
  `smc_maintenance_reseau_niveau1` int(11) NOT NULL,
  `smc_maintenance_reseau_escalade` int(11) NOT NULL,
  `smc_maintenance_reseau_periode_id` int(11) NOT NULL,
  PRIMARY KEY (`smc_maintenance_reseau_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smc_maintenance_reseau`
--

INSERT INTO `smc_maintenance_reseau` (`smc_maintenance_reseau_niveau1`, `smc_maintenance_reseau_escalade`, `smc_maintenance_reseau_periode_id`) VALUES
(1, 19, 1),
(2, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `smc_management_admin_robot`
--

CREATE TABLE IF NOT EXISTS `smc_management_admin_robot` (
  `smc_management_niv1` varchar(200) NOT NULL,
  `smc_management_niv2` varchar(200) DEFAULT NULL,
  `smc_management_escalade` varchar(200) DEFAULT NULL,
  `smc_management_admin_robot_periode_id` int(11) NOT NULL,
  KEY `periode_id` (`smc_management_admin_robot_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smc_management_admin_robot`
--

INSERT INTO `smc_management_admin_robot` (`smc_management_niv1`, `smc_management_niv2`, `smc_management_escalade`, `smc_management_admin_robot_periode_id`) VALUES
('Equipe FO concernée', 'Rosalie MESSILA\r\n699 94 92 24', 'ASTREINTE MANAGERIALE SMC', 1),
('Equipe FO concernée', 'Rosalie MESSILA\r\n699 94 92 24', 'ASTREINTE MANAGERIALE SMC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `smc_management_admin_sav2000`
--

CREATE TABLE IF NOT EXISTS `smc_management_admin_sav2000` (
  `smc_management_admin_sav2000_niv1` varchar(200) NOT NULL,
  `smc_management_admin_sav2000_escalade` varchar(200) NOT NULL,
  `smc_management_admin_sav2000_periode_id` int(11) NOT NULL,
  KEY `periode_id` (`smc_management_admin_sav2000_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smc_management_admin_sav2000`
--

INSERT INTO `smc_management_admin_sav2000` (`smc_management_admin_sav2000_niv1`, `smc_management_admin_sav2000_escalade`, `smc_management_admin_sav2000_periode_id`) VALUES
('Rosalie MESSILA\r\n699 94 92 24', 'ASTREINTE MANAGERIALE SMC', 1),
('Rosalie MESSILA\r\n699 94 92 24', 'ASTREINTE MANAGERIALE SMC', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ssasbd`
--

CREATE TABLE IF NOT EXISTS `ssasbd` (
  `SSASBD_windows_et_messagerie` varchar(200) NOT NULL,
  `SSASBD_unix_linux` varchar(200) NOT NULL,
  `SSASBD_databases` varchar(200) NOT NULL,
  `SSASBD_escalade_niv1` varchar(200) NOT NULL,
  `SSASBD_escalade_niv2` varchar(200) DEFAULT NULL,
  `ssasbd_periode_id` int(11) NOT NULL,
  PRIMARY KEY (`ssasbd_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tmc-evt`
--

CREATE TABLE IF NOT EXISTS `tmc-evt` (
  `tmc_evt_metier` varchar(100) DEFAULT NULL,
  `tmc_evt_domaine` varchar(100) DEFAULT NULL,
  `tmc_evt_littoral_jour` int(11) DEFAULT NULL,
  `tmc_evt_littoral_nuit` int(11) DEFAULT NULL,
  `tmc_evt_centre_jour` int(11) DEFAULT NULL,
  `tmc_evt_centre_nuit` int(11) DEFAULT NULL,
  `tmc_evt_ouest` int(11) DEFAULT NULL,
  `tmc_evt_est` int(11) DEFAULT NULL,
  `tmc_evt_nord_extreme_nord` int(11) DEFAULT NULL,
  `tmc_evt_adamaoua` int(11) DEFAULT NULL,
  `tmc_evt_nord_ouest` int(11) DEFAULT NULL,
  `tmc_evt_periode_id` int(11) NOT NULL,
  PRIMARY KEY (`tmc_evt_periode_id`),
  KEY `fk_TMC-EVT_periode1_idx` (`tmc_evt_periode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tmc-evt`
--
ALTER TABLE `tmc-evt`
  ADD CONSTRAINT `fk_TMC-EVT_periode1` FOREIGN KEY (`tmc_evt_periode_id`) REFERENCES `periode` (`periode_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
