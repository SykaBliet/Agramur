-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 05 mars 2020 à 01:14
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db`
--

-- --------------------------------------------------------

--
-- Structure de la table `userphotos`
--

CREATE TABLE `userphotos` (
  `photoid` int(11) NOT NULL,
  `idUsers` text NOT NULL,
  `uidUsers` text NOT NULL,
  `photo` text NOT NULL,
  `dates` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `userphotos`
--

INSERT INTO `userphotos` (`photoid`, `idUsers`, `uidUsers`, `photo`, `dates`) VALUES
(9, '1', 'aurele', 'images/aurele/20200305123101.png', '2020-03-05 12:31:01'),
(10, '1', 'aurele', 'images/aurele/20200305123121.png', '2020-03-05 12:31:21'),
(11, '1', 'aurele', 'images/aurele/20200305123134.png', '2020-03-05 12:31:34'),
(12, '2', 'aurele123', 'images/aurele123/20200305125653.png', '2020-03-05 12:56:54');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `userphotos`
--
ALTER TABLE `userphotos`
  ADD PRIMARY KEY (`photoid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `userphotos`
--
ALTER TABLE `userphotos`
  MODIFY `photoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
