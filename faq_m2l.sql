-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 22 sep. 2022 à 14:51
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `faq_m2l`
--

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `idfaq` int(11) NOT NULL,
  `question` varchar(300) NOT NULL,
  `datequestion` datetime NOT NULL DEFAULT current_timestamp(),
  `reponse` varchar(300) NOT NULL,
  `datereponse` datetime DEFAULT NULL,
  `idutilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idfaq`, `question`, `datequestion`, `reponse`, `datereponse`, `idutilisateur`) VALUES
(18, 'Pourquoi les joueurs ne portent-ils pas leurs noms sur leurs maillots ?\r\n', '2022-09-21 22:12:40', 'Car leur numéro dans le dos correspond à leur poste contrairement au foot.', NULL, 3),
(19, 'Quel est le club de rugby le plus titré en France ?', '2022-09-21 23:59:34', 'C’est le Stade Toulousain, qui est également le club le plus titré au niveau mondial', NULL, 3),
(20, 'Pourquoi les joueurs sont appelés des trois-quarts, des demis, etc .. ? ', '2022-09-22 00:00:30', '', NULL, 3),
(21, 'Quelle est l\'origine du judo ?', '2022-09-22 10:54:17', 'Le Judo est un art martial d’origine japonaise, créé en 1882 par Maître Jigoro Kano. Il est arrivé en France dans les années 30.', NULL, 6),
(22, ' pourquoi compte-t-on 15, 30, 40 au tennis ?', '2022-09-22 14:25:48', 'Ce décompte particulier vient du jeu de paume, ancêtre du tennis. Il était pratiqué sur un terrain rectangulaire séparé en deux parties longues de 60 pieds par un filet. Parallèlement à ce filet étaient tracées des lignes numérotées 15, 30 et 40.', NULL, 9),
(23, 'Que faire, ou à quel condition, puis-je avoir le sponsor d\'une marque de tennis ?', '2022-09-22 14:27:02', 'Le classement régional/départemental voire national peut influencer les sponsors', NULL, 9),
(24, 'Comment fonctionne le système de classement au tennis ? ', '2022-09-22 14:30:21', '', NULL, 10);

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `idligue` int(11) NOT NULL,
  `libligue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`idligue`, `libligue`) VALUES
(1, 'toutes les ligues'),
(3, 'Ligue de tennis'),
(4, 'Ligue de judo'),
(5, 'Ligue de rugby');

-- --------------------------------------------------------

--
-- Structure de la table `type_util`
--

CREATE TABLE `type_util` (
  `idtype` int(11) NOT NULL,
  `lib_utilisateur` varchar(50) NOT NULL,
  `description_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_util`
--

INSERT INTO `type_util` (`idtype`, `lib_utilisateur`, `description_type`) VALUES
(1, 'Utilisateur', 'Utilisateur de base'),
(2, 'Admin', 'Administrateur de ligue'),
(3, 'Super admin', 'Administrateur de toute les ligues');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idutilisateur` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `idtype` int(11) NOT NULL,
  `idligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `pseudo`, `mdp`, `mail`, `idtype`, `idligue`) VALUES
(2, 'adminrugby', '$2y$10$mt4dDbrB9c.7CKW06s4U/.caE2w3hRRBZN9F5csPiC.AK7ZeHN66m', 'adminrugby@m2l.fr', 2, 5),
(3, 'userugby1', '$2y$10$C8jgVUzW/e9kTsr1WgeZmu5ssEszTElFXmklv73i18cFpwd5BJz/S', 'userugby1@m2l.fr', 1, 5),
(4, 'userugby2', '$2y$10$/dn9zU0lV2srQlnKKA9CO.YeJSYJ4HfMCsv.RX.A4Ko835T3fBiZK', 'userugby2@m2l.fr', 1, 5),
(5, 'adminjudo', '$2y$10$GUZPH9zxIoH78WtZ7UzDTOK8XFYbeoW9t0B42ziy5Q1y6N271aC1K', 'adminjudo@m2l.fr', 2, 4),
(6, 'userjudo1', '$2y$10$2VTep5qJecK0UUl8RFeguOAu2PyJiNtr/uF8p1ZrEgOovxK78E0eW', 'userjudo1@m2l.fr', 1, 4),
(7, 'userjudo2', '$2y$10$DfZNJ9schXC/chlZaAzLFe0b/l7XoKHX7SJ9Pb4GXl6yvAinzbVGe', 'userjudo2@m2l.fr', 1, 4),
(8, 'admintennis', '$2y$10$Ym43d.uLI6S6uCVHBuYs6.T1.vHm1ZeZKIsKkvvOd/mNTrnPlnVfO', 'admintennis@m2l.fr', 2, 3),
(9, 'usertennis1', '$2y$10$beaDJa3XwUq0EZDDPkGr2eSwBNe2EFmq/zx8Vg1zuP4Yb3QZB6pUS', 'usertennis1@m2l.fr', 1, 3),
(10, 'usertennis2', '$2y$10$Adw2feBYJy38r3d54AJt6.lxMX3kGXAbaIw76i3uEtnriwJmGXDG.', 'usertennis2@m2l.fr', 1, 3),
(36, 'superadmin', '$2y$10$m7Vr0wXyIx4ZaeJJDZ.FD.ndbETZGnu75InQlsiEyIzkDoqE4ksX6', 'superadmin@m2l.fr', 3, 5);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idfaq`),
  ADD KEY `faq_utilisateur_FK` (`idutilisateur`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`idligue`);

--
-- Index pour la table `type_util`
--
ALTER TABLE `type_util`
  ADD PRIMARY KEY (`idtype`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idutilisateur`),
  ADD KEY `utilisateur_ligue0_FK` (`idligue`),
  ADD KEY `utilisateur_type_util_FK` (`idtype`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `idfaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `idligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `type_util`
--
ALTER TABLE `type_util`
  MODIFY `idtype` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idutilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `faq`
--
ALTER TABLE `faq`
  ADD CONSTRAINT `faq_utilisateur_FK` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ligue0_FK` FOREIGN KEY (`idligue`) REFERENCES `ligue` (`idligue`),
  ADD CONSTRAINT `utilisateur_type_utilsateur_FK` FOREIGN KEY (`idtype`) REFERENCES `type_util` (`idtype`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
