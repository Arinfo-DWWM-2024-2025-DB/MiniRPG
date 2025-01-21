-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 jan. 2025 à 11:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `minirpg`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `nom`) VALUES
(1, 'Guerrier'),
(2, 'Civil'),
(3, 'Mage'),
(4, 'Archer'),
(5, 'Bandit');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `type_equipement` varchar(256) NOT NULL,
  `puissance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `nom`, `type_equipement`, `puissance`) VALUES
(1, 'Épée', 'Une main', 10),
(2, 'Masse', 'Deux mains', 15),
(3, 'Bâton', 'Une main', 2),
(4, 'Arc avec 2 élastiques et un stabilo', 'Longue distance', 3),
(5, 'Couteau', 'Une main', 7),
(6, 'Arbalète', 'Longue distance', 12),
(7, 'Arc', 'Longue distance', 9),
(8, 'Arc des enfers', 'Longue distance', 66),
(9, 'Matraque électrique', 'Une main', 8),
(10, 'M4A1-S', 'Longue distance', 45),
(11, 'Boule de feu', 'Magique', 12),
(12, 'Télékinésie', 'Magique', 8);

-- --------------------------------------------------------

--
-- Structure de la table `equipement_classe`
--

CREATE TABLE `equipement_classe` (
  `classe_id` int(11) NOT NULL,
  `equipement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement_classe`
--

INSERT INTO `equipement_classe` (`classe_id`, `equipement_id`) VALUES
(4, 6),
(4, 7),
(4, 4),
(4, 8),
(2, 3),
(5, 5),
(1, 10),
(4, 10),
(1, 2),
(1, 9),
(2, 9),
(1, 1),
(3, 12),
(3, 11);

-- --------------------------------------------------------

--
-- Structure de la table `monstre`
--

CREATE TABLE `monstre` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `pv` int(11) NOT NULL,
  `equipement_id` int(11) NOT NULL,
  `puissance` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monstre`
--

INSERT INTO `monstre` (`id`, `nom`, `pv`, `equipement_id`, `puissance`) VALUES
(1, 'Zombie', 100, 3, 1),
(2, 'David Lafarge', 24, 4, 3),
(3, 'Brachiosaurus', 224, 11, 2),
(4, 'Brendon Desvaux', 1337, 8, -1),
(5, 'Fiddlesticks', 5, 10, 1),
(6, 'Vampire', 66, 1, 1),
(7, 'Gordon Freeman', 400, 9, 3),
(8, 'dragon blanc aux yeux bleus', 1000, 11, 1),
(9, 'Golem', 200, 2, 2),
(10, 'Loup-garou', 150, 6, 2),
(11, 'Troll', 100, 3, 1),
(12, 'Archer des enfers', 350, 8, 2),
(13, 'Spectre de la Nuit', 50, 10, 1),
(14, 'David Baszucki', 123, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `classe_id` int(11) NOT NULL,
  `pv` int(11) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipement_classe`
--
ALTER TABLE `equipement_classe`
  ADD KEY `ec_classe` (`classe_id`),
  ADD KEY `ec_equipement` (`equipement_id`);

--
-- Index pour la table `monstre`
--
ALTER TABLE `monstre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_contrainte_cbon_jen_ai_marre` (`equipement_id`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_classe` (`classe_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `monstre`
--
ALTER TABLE `monstre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipement_classe`
--
ALTER TABLE `equipement_classe`
  ADD CONSTRAINT `ec_classe` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`),
  ADD CONSTRAINT `ec_equipement` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`);

--
-- Contraintes pour la table `monstre`
--
ALTER TABLE `monstre`
  ADD CONSTRAINT `m_contrainte_cbon_jen_ai_marre` FOREIGN KEY (`equipement_id`) REFERENCES `equipement` (`id`);

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `p_classe` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
