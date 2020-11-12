-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 08, 2020 at 01:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dc_exercice`
--
CREATE DATABASE IF NOT EXISTS `dc_exercice` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dc_exercice`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `create_date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `enum`
--

CREATE TABLE `enum` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `slug` tinytext NOT NULL,
  `label` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enum`
--

INSERT INTO `enum` (`id`, `parent_id`, `slug`, `label`) VALUES
(1, 0, 'OBJECT_TYPE', 'Type d\'objet'),
(2, 1, 'OBJECT_TYPE.WEAPON', 'Arme'),
(3, 1, 'OBJECT_TYPE.FOOD', 'Nourriture'),
(4, 0, 'PERSONAGE_TYPE', 'Type de personnage'),
(5, 4, 'PERSONAGE_TYPE.USER', 'Utilisateur'),
(6, 4, 'PERSONAGE_TYPE.BOT', 'Bot'),
(7, 0, 'PERSONAGE_BREED', 'Race'),
(8, 7, 'PERSONAGE_BREED.GOBLIN', 'Goblin'),
(9, 7, 'PERSONAGE_BREED.DRAGON', 'Dragon'),
(10, 7, 'PERSONAGE_BREED.HUMAN', 'Human'),
(11, 7, 'PERSONAGE_BREED.ELFE', 'Elfe'),
(12, 0, 'PERSONAGE_CLASS', 'Classe'),
(13, 12, 'PERSONAGE_CLASS.MAGE', 'Mage'),
(14, 12, 'PERSONAGE_CLASS.WARRIOR', 'Guerrier'),
(15, 12, 'PERSONAGE_CLASS.THIEF', 'Voleur'),
(16, 0, 'PERSONAGE_SKILL', 'Skill'),
(17, 16, 'PERSONAGE_SKILL.GUERRISEUR', 'Guérisseur'),
(18, 16, 'PERSONAGE_SKILL.MENTOR', 'Meneur'),
(19, 0, 'PERSONAGE__OBJECT_STATUS', 'Statut de l\'object'),
(20, 19, 'PERSONAGE__OBJECT_STATUS.STANDBY', 'En attente d\'utilisation'),
(21, 19, 'PERSONAGE__OBJECT_STATUS.USED', 'Utilisé'),
(22, 19, 'PERSONAGE__OBJECT_STATUS.BROKEN', 'Cassé'),
(23, 0, 'STORE_STATUS', 'Statut du magasin'),
(24, 23, 'STORE_STATUS.OPEN', 'Ouvert'),
(25, 23, 'STORE_STATUS.CLOSED', 'Fermé'),
(26, 23, 'STORE_STATUS.DESTRUCTED', 'Détruit'),
(27, 0, 'VEHICULE_TYPE', 'Type de véhicule'),
(28, 27, 'VEHICULE_TYPE.DRAGON', 'Dragon'),
(29, 27, 'VEHICULE_TYPE.CAR', 'Voiture'),
(30, 27, 'VEHICULE_TYPE.MOTO', 'Moto');

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `position_x` tinyint(4) NOT NULL,
  `position_y` tinyint(4) NOT NULL,
  `store_id` int(11) NOT NULL,
  `enemy_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personage`
--

CREATE TABLE `personage` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `name` varchar(25) NOT NULL,
  `class_id` int(11) NOT NULL,
  `breed_id` int(11) NOT NULL,
  `skill_ids` tinytext NOT NULL,
  `health` tinyint(4) NOT NULL,
  `attack` tinyint(4) NOT NULL,
  `map_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personage__object`
--

CREATE TABLE `personage__object` (
  `id` int(11) NOT NULL,
  `personage_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `acquire_date` datetime NOT NULL,
  `used_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `store__object`
--

CREATE TABLE `store__object` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `object_Id` int(11) NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `personage_id` int(11) NOT NULL,
  `acquire_date` datetime NOT NULL,
  `name` varchar(25) NOT NULL,
  `type` int(11) NOT NULL,
  `health` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enum`
--
ALTER TABLE `enum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personage`
--
ALTER TABLE `personage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personage__object`
--
ALTER TABLE `personage__object`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store__object`
--
ALTER TABLE `store__object`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enum`
--
ALTER TABLE `enum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personage`
--
ALTER TABLE `personage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personage__object`
--
ALTER TABLE `personage__object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store__object`
--
ALTER TABLE `store__object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
