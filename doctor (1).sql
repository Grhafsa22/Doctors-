-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 mai 2024 à 15:12
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `doctor`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,8) NOT NULL,
  `available` varchar(255) DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `doctors`
--

INSERT INTO `doctors` (`id`, `full_name`, `specialization`, `address`, `latitude`, `longitude`, `available`) VALUES
(1, 'Dr. Aicha El Alaoui', 'Cardiologist', '123 Rue Hassan II, Marrakech, Morocco', '31.02670000', '-9.57770000', 'available'),
(2, 'Dr. Omar Idrissi', 'Dermatologist', '45 Boulevard Mohammed V, Casablanca, Morocco', '33.57360000', '-7.61840000', 'available'),
(3, 'Dr. Nadia El Mazhary', 'General Surgeon', 'Avenue Hassan II, Quartier Gauthier, Casablanca, Morocco', '33.57500000', '-7.60330000', 'available'),
(4, 'Dr. Mehdi Alaoui', 'Cardiologist', 'Rue Mohammed Diouri, Maarif, Casablanca, Morocco', '33.56000000', '-7.59000000', 'available'),
(5, 'Dr. Khadija Bennani', 'Dermatologist', 'Boulevard Zerktouni, Centre Ville, Casablanca, Morocco', '33.55280000', '-7.60140000', 'available'),
(6, 'Dr. Souad Alaoui', 'Urologist', 'Avenue Hassan II, Quartier Gauthier, Casablanca, Morocco', '33.57830000', '-7.61500000', 'available'),
(7, 'Dr. Ahmed', NULL, '123 Rue Hassan II, Marrakech', '31.02670000', '-9.57770000', 'available'),
(8, 'Dr. Fatima', NULL, '45 Boulevard Mohammed V, Casablanca', '33.57360000', '-7.61840000', 'available'),
(9, 'Dr. Ahmed', NULL, '123 Rue Hassan II, Marrakech', '31.02670000', '-9.57770000', 'available'),
(10, 'Dr. Fatima', NULL, '45 Boulevard Mohammed V, Casablanca', '33.57360000', '-7.61840000', 'available');

-- --------------------------------------------------------

--
-- Structure de la table `operateur`
--

CREATE TABLE `operateur` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `operateur`
--

INSERT INTO `operateur` (`username`, `password`) VALUES
('admin', 'admin_66');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(40) NOT NULL,
  `statuts` varchar(50) DEFAULT 'urgent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id`, `first_name`, `last_name`, `gender`, `address`, `statuts`) VALUES
(1, 'hafsa', 'zouine', 'female', 'Sidi Maarouf-Casablanca', 'urgent'),
(2, 'mossab', 'blazer', 'male', 'Sidi Maarouf-Casablanca', 'urgent'),
(3, 'khadija', 'zouine', 'female', 'Hay Sadri-Casablanca', 'not urgent'),
(4, 'said', 'salim', 'male', 'Sidi Maarouf-Casablanca', 'urgent'),
(5, 'aziza', 'dani', 'female', 'Sidi Maarouf-Casablanca', 'urgent'),
(6, 'nacer', 'mohoub', 'male', 'casablanca ', 'not urgent'),
(7, 'sultan ', 'rifi', 'male', 'casablanca ', 'urgent'),
(8, 'nabil', 'sayrah', 'male', 'boulevard Taddart casablanca ', 'urgent'),
(9, 'forkan', 'darafi', 'male', 'Hay Sadri-Casablanca', 'urgent'),
(10, 'riyad', 'naim', 'male', 'Sidi Maarouf-Casablanca', 'urgent'),
(11, 'abrrar', 'zayn', 'female', 'centre ville casablanca ', 'urgent'),
(12, 'isslam', 'mono', 'male', 'boulvard anfa casablanca', 'urgent'),
(13, 'abdo', 'sayr', 'male', 'Sidi Maarouf-Casablanca', 'urgent'),
(14, 'jawad', 'massim', 'male', 'Waziz-casablanca', 'urgent'),
(15, 'arij', 'chakour', 'female', 'ain chock les terasses de californie-cas', 'not urgent'),
(16, 'reda', 'wazir', 'male', 'Ain chock-Casablanca', 'not urgent'),
(17, 'tarik', 'had', 'male', 'Sidi Maarouf-Casablanca', 'not urgent');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operateur`
--
ALTER TABLE `operateur`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
