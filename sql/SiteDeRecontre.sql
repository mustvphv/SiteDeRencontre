-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 07 jan. 2019 à 17:00
-- Version du serveur :  10.1.37-MariaDB
-- Version de PHP :  7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `SiteDeRecontre`
--

-- --------------------------------------------------------

--
-- Structure de la table `Localisation`
--

CREATE TABLE `Localisation` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `departement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Localisation`
--

INSERT INTO `Localisation` (`ID`, `pseudo`, `region`, `departement`) VALUES
(1, 'Matthieu', 'IDF', '92'),
(2, 'Julie', 'IDF', '94'),
(3, 'Alexandre', 'BFC', '21'),
(4, 'Romain', 'IDF', '92'),
(5, 'Laura', 'IDF', '94'),
(6, 'Cassandra', 'BFC', '25'),
(7, 'Quentin', 'IDF', '91'),
(8, 'Anna', 'IDF', '94'),
(9, 'Nathan', 'IDF', '93');

-- --------------------------------------------------------

--
-- Structure de la table `Physique`
--

CREATE TABLE `Physique` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `clientgenre` varchar(255) NOT NULL,
  `clientpoids` varchar(255) NOT NULL,
  `clientcouleurspeaux` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Physique`
--

INSERT INTO `Physique` (`ID`, `pseudo`, `clientgenre`, `clientpoids`, `clientcouleurspeaux`) VALUES
(1, 'Matthieu', 'homme', '85', 'tres blanche'),
(2, 'Julie', 'femme', '65', 'tres blanche'),
(3, 'Alexandre', 'homme', '60', 'claire'),
(4, 'Romain', 'homme', '75', 'mate'),
(5, 'Laura', 'femme', '55', 'claire'),
(6, 'Cassandra', 'femme', '65', 'mate'),
(7, 'Quentin', 'homme', '70', 'tres blanche'),
(8, 'Anna', 'femme', '60', 'tres blanche'),
(9, 'Nathan', 'homme', '80', 'claire');

-- --------------------------------------------------------

--
-- Structure de la table `Preferences`
--

CREATE TABLE `Preferences` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `prefgenre` varchar(255) NOT NULL,
  `prefcouleurspeaux` varchar(255) NOT NULL,
  `prefpoids` varchar(255) NOT NULL,
  `prefcouleurschx` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Preferences`
--

INSERT INTO `Preferences` (`ID`, `pseudo`, `prefgenre`, `prefcouleurspeaux`, `prefpoids`, `prefcouleurschx`) VALUES
(1, 'Matthieu', 'femme', 'tres blanche', '60', 'brun'),
(2, 'Julie', 'homme', 'claire', '80', 'brun'),
(3, 'Alexandre', 'femme', 'mate', '60', 'brun'),
(4, 'Romain', 'femme', 'claire', '65', 'roux'),
(5, 'Laura', 'homme', 'tres blanche', '70', 'blond'),
(6, 'Cassandra', 'homme', 'mate', '75', 'brun'),
(7, 'Quentin', 'femme', 'claire', '60', 'blond'),
(8, 'Anna', 'homme', 'tres blanche', '90', 'brun'),
(9, 'Nathan', 'femme', 'claire', '60', 'brun');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `ID` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `User`
--

INSERT INTO `User` (`ID`, `pseudo`, `password`, `email`) VALUES
(1, 'Matthieu', 'f5e088d29801ebb822251d7751bc4b8ff28c50132d8b0a95614b5f048a1d01b6', '1.1@gmail.com'),
(2, 'Julie', 'abaa68c541efe0fc9bdc55fedf664487cf572ec27dbeb35223bdb4f8faa2e709', '2.2@gmail.com'),
(3, 'Alexandre', '13e15721c9d4ad58d34983344dfba265a90d80f63db77c2eb3804379d9608889', '3.3@gmail.com'),
(4, 'Romain', 'f756f8e149a361333893ff10e22ff7d6b6217918c8c0390cff8623042702a432', '4.4@gmail.com'),
(5, 'Laura', 'f0b8649dbd8cc269a6a9f57166490602cb5e17344007e29c1591f6cdad29aa37', '5.5@gmail.com'),
(6, 'Cassandra', 'e3297e400dff12fe3f696f70a6c42c1104e870c7b22410af512d7a504270131b', '6.6@gmail.com'),
(7, 'Quentin', 'ad0daff398ec5475ccaf25d21766af127476a122ae775b00c92ddc5d630f21a2', '7.7@gmail.com'),
(8, 'Anna', 'bf4fccd616251b678c56b9cb7a46819b1266853c180637642f5bc7d6b01f5554', '8.8@gmail.com'),
(9, 'Nathan', '8deb4b3c2abc4c7f65a03ec0ed5c08c6faf624ab1be59bb1c95218ee24b527c7', '9.9@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Localisation`
--
ALTER TABLE `Localisation`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Physique`
--
ALTER TABLE `Physique`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Preferences`
--
ALTER TABLE `Preferences`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Localisation`
--
ALTER TABLE `Localisation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Physique`
--
ALTER TABLE `Physique`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Preferences`
--
ALTER TABLE `Preferences`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
