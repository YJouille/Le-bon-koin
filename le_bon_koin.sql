-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 03 nov. 2021 à 22:48
-- Version du serveur : 5.7.36-0ubuntu0.18.04.1
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `le_bon_koin`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(11) NOT NULL,
  `titre_annonce` varchar(255) NOT NULL,
  `desc_annonce` longtext NOT NULL,
  `prix_annonce` decimal(10,0) NOT NULL,
  `adresse_annonce` varchar(255) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id_annonce`, `titre_annonce`, `desc_annonce`, `prix_annonce`, `adresse_annonce`, `id_categorie`, `id_user`) VALUES
(2, 'Chat névrotique', 'Peu servi...', '30', '39110 - Bracon', 1, 3),
(7, 'Clio 3', 'Clio 3 essence année 2013.', '3000', '75000 - Paris', 2, 3),
(19, 'Stella', 'chat ayant peut servit \r\ndort beaucoup \r\nmange énormement', '41', '39110 - La Chapelle-sur-Furieuse', 31, 3),
(20, 'Service de porcelaine ', '74 pieces de porcelaine ( dont 4 ébrechés) \r\nPorcelaine datant de Louis 14\r\nEtat moyen ', '155', '39110 - LA CHAPELLE SUR FURIEUSE', 31, 3),
(21, 'Portée de 4 chatons', '4 chatons adorables ( mais hyperactifs )\r\n4 choix de couleurs : blanc / noir /noir et blanc / gris ', '0', '25000 - BESANCON', 31, 3),
(22, 'Cabane dans les arbres', '2 planches ( mal ) accrochées dans un arbre (un pommier ) et une chaise inaccessible\r\nPas de toit, des poulie et une échelle', '3', '39110 - LA CHAPELLE SUR FURIEUSE onay', 1, 3),
(23, 'Télephone portable ', 'Télephone portable :\r\nSamsung galaxy 9\r\nplus coque licorne avec des paillettes \r\n ', '150', '85520 - JARD SUR MER rue des essard ', 33, 3),
(24, 'Manette de console', 'Manette de console, convient aussi pour un ordinateur \r\nPossibilité de mettre des piles rechargeables  ', '80', '21000 - DIJON', 32, 3),
(25, 'Vélo du tour de FRANCE ', 'Vélo ayant été perdu par les dépanneurs du tour de france\r\nTaille: adulte \r\nCouleur : Bleu et jaune \r\nType : vélo de route ( roues très fines )', '95', '39100 - DOLE ', 2, 3),
(26, 'Gameboy', 'Gameboy couleur \r\n5 jeux fourni à l\'achat\r\npossibilité d\'autre jeu \r\n', '50', '57000 - METZ', 32, 3),
(27, 'Appartement 35m2', 'Appartement 4 pièces, quartier très calme. Libre début décembre.', '300', '39110 - LA CHAPELLE SUR FURIEUSE', 1, 3),
(28, 'Caravane', 'Caravane de 6m2 ( 2m 50 de haut ) avec eau, électricité et chauffage ', '10000', '39110 - LA CHAPELLE SUR FURIEUSE onay rue du chateau d\'eau ', 2, 3),
(31, 'Gameboy color', 'fdsfsd sfsf ', '3', '21000 - DIJON', 31, 3),
(32, 'Gameboy color', 'fdsfsd sfsf ', '3', '21000 - DIJON', 31, 3);

-- --------------------------------------------------------

--
-- Structure de la table `critere`
--

CREATE TABLE `critere` (
  `id_critere` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `nom_critere` varchar(255) NOT NULL,
  `valeur_critere` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `critere`
--

INSERT INTO `critere` (`id_critere`, `id_annonce`, `nom_critere`, `valeur_critere`) VALUES
(19, 7, 'marque', 'Renault'),
(20, 7, 'modele', 'Clio'),
(21, 7, 'km', '120000'),
(22, 7, 'carburant', 'Essence'),
(23, 7, 'boite-de-vitesse', 'Manuelle'),
(24, 7, 'couleur', 'Rouge'),
(25, 7, 'nb-de-portes', '5'),
(26, 7, 'puissance', '6'),
(27, 7, 'nb-de-places', '5'),
(47, 19, 'etat', 'Très bon état'),
(48, 20, 'etat', 'Etat satisfaisant'),
(49, 21, 'etat', 'Pour pièces'),
(50, 22, 'type-de-bien', 'Maison'),
(51, 22, 'surface', '1'),
(52, 22, 'nombre-de-pieces', '2'),
(53, 23, 'marque', 'Samsung '),
(54, 23, 'modele', 'Samsung galaxy 9'),
(55, 23, 'couleur', 'Rouge et bleu'),
(56, 23, 'capacite-de-stockage', '12'),
(57, 23, 'etat', 'Très bon état'),
(58, 24, 'type', 'Accessoires'),
(59, 24, 'marque', 'nintendo '),
(60, 24, 'modele', 'nintendo switch '),
(61, 24, 'etat', 'Bon état'),
(62, 25, 'marque', 'Décatlon '),
(63, 25, 'modele', 'Mx 43'),
(64, 25, 'km', '40'),
(65, 25, 'carburant', 'Electrique'),
(66, 25, 'boite-de-vitesse', 'Automatique'),
(67, 25, 'couleur', 'Rouge et bleu'),
(68, 25, 'nb-de-portes', '0'),
(69, 25, 'puissance', '0'),
(70, 25, 'nb-de-places', '1'),
(71, 26, 'type', 'Console'),
(72, 26, 'marque', 'nintendo'),
(73, 26, 'modele', 'Gameboy color '),
(74, 26, 'etat', 'Bon état'),
(75, 27, 'type-de-bien', 'Appartement'),
(76, 27, 'surface', '32'),
(77, 27, 'nombre-de-pieces', '4'),
(78, 28, 'marque', 'Renault'),
(79, 28, 'modele', 'Megane '),
(80, 28, 'km', '5000'),
(81, 28, 'carburant', 'Essence'),
(82, 28, 'boite-de-vitesse', 'Automatique'),
(83, 28, 'couleur', 'Blanc'),
(84, 28, 'nb-de-portes', '4'),
(85, 28, 'puissance', '250'),
(86, 28, 'nb-de-places', '6'),
(89, 31, 'etat', 'Neuf'),
(90, 32, 'etat', 'Neuf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`id_critere`),
  ADD KEY `id_annonce` (`id_annonce`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `id_critere` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `critere`
--
ALTER TABLE `critere`
  ADD CONSTRAINT `critere_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id_annonce`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
