-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 04 mars 2021 à 01:22
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ff7php`
--

-- --------------------------------------------------------

--
-- Structure de la table `infantryman`
--

CREATE TABLE `infantryman` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pv` int(11) NOT NULL,
  `atk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `infantryman`
--

INSERT INTO `infantryman` (`id`, `name`, `pv`, `atk`) VALUES
(1, 'Infantry Man 1', 130, 20);

-- --------------------------------------------------------

--
-- Structure de la table `materias`
--

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `pv` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `color` enum('green','blue') NOT NULL,
  `type` enum('atk','heal') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materias`
--

INSERT INTO `materias` (`id`, `name`, `pv`, `atk`, `color`, `type`) VALUES
(1, 'Fire', 0, 50, 'green', 'atk'),
(2, 'Fire2', 0, 100, 'green', 'atk'),
(3, 'Fire3', 0, 180, 'green', 'atk'),
(4, 'Restore', 60, 0, 'green', 'heal');

-- --------------------------------------------------------

--
-- Structure de la table `materias_owned`
--

CREATE TABLE `materias_owned` (
  `char_id` int(11) NOT NULL,
  `mat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `materias_owned`
--

INSERT INTO `materias_owned` (`char_id`, `mat_id`) VALUES
(1, 4),
(2, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `soldier`
--

CREATE TABLE `soldier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pv` int(11) NOT NULL,
  `atk` int(11) NOT NULL,
  `selsprite` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `soldier`
--

INSERT INTO `soldier` (`id`, `name`, `pv`, `atk`, `selsprite`) VALUES
(1, 'Cloud', 200, 40, 'c1.png'),
(2, 'SOLDIER 2nd Class', 150, 30, 'c2.png'),
(3, 'Sephiroth', 500, 120, 'c3.png'),
(4, 'Zack', 220, 60, 'c4.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `infantryman`
--
ALTER TABLE `infantryman`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materias_owned`
--
ALTER TABLE `materias_owned`
  ADD PRIMARY KEY (`char_id`,`mat_id`),
  ADD KEY `mat_id` (`mat_id`);

--
-- Index pour la table `soldier`
--
ALTER TABLE `soldier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `infantryman`
--
ALTER TABLE `infantryman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `materias`
--
ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `soldier`
--
ALTER TABLE `soldier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `materias_owned`
--
ALTER TABLE `materias_owned`
  ADD CONSTRAINT `materias_owned_ibfk_1` FOREIGN KEY (`char_id`) REFERENCES `soldier` (`id`),
  ADD CONSTRAINT `materias_owned_ibfk_2` FOREIGN KEY (`mat_id`) REFERENCES `materias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
