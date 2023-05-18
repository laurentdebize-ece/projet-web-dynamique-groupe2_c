-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 17 mai 2023 à 14:40
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `Projet_info_ing2`
--

-- --------------------------------------------------------

--
-- Structure de la table `acquisition_competences`
--

CREATE TABLE `acquisition_competences` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acquisition_competences`
--

INSERT INTO `acquisition_competences` (`id`, `nom`) VALUES
(1, 'Non acquis'),
(2, 'En cours d\'acquisition'),
(3, 'Acquis');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `Id_administrateur` int(50) NOT NULL,
  `id_utilisateur` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`Id_administrateur`, `id_utilisateur`) VALUES
(1, 32),
(2, 43);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(50) NOT NULL,
  `nom_classe` varchar(50) NOT NULL,
  `id_promotion` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`, `id_promotion`) VALUES
(1, 'ING2GroupeA', 1),
(2, 'ING2GroupeC', 1),
(4, 'ING1GroupeB', 1),
(5, 'ING1GroupeC', 1);

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competences` int(50) NOT NULL,
  `nom_competences` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_competences`, `nom_competences`) VALUES
(1, 'savoir coder'),
(2, 'Connaitre ses dérivée'),
(3, 'Calculer une Integrale'),
(4, 'Test competence'),
(5, 'Test competence2'),
(6, 'lilian rage haha'),
(7, 'test nouveau code'),
(8, 'test nouveau code'),
(9, 'Test 10:58'),
(10, 'Test 11H00'),
(11, 'Test 11H00'),
(12, 'Test 11H11'),
(13, 'Test 11H21'),
(14, 'Test 11H26'),
(15, 'Test 11H28'),
(16, 'Test 11H32'),
(17, 'Test 11H51'),
(18, 'Test 11H54'),
(19, 'Test 11H55'),
(20, 'Test 11H59'),
(21, 'Test 12H00'),
(22, 'Test 12H01'),
(23, 'Test 12H02'),
(24, 'Test 12H04'),
(25, 'Test 12H08'),
(26, 'Test 12H08'),
(27, 'Test 12H11'),
(28, 'Test 12H14'),
(29, 'Test 12H23'),
(30, 'Test 12H24'),
(31, 'Test 12H26'),
(32, 'Test 12H31'),
(33, 'Test 12H34'),
(34, 'Test 12H35'),
(35, 'Test 12H39'),
(36, 'Test 12H39'),
(37, 'Test 12H41'),
(38, 'Test 12H41'),
(39, 'Test 12H41'),
(40, 'Test 12H41'),
(41, 'Test 12H43'),
(42, 'Test 12H44'),
(43, 'Test 12H49'),
(44, 'Test 13H31'),
(45, 'Test 13H34'),
(46, 'Test 13H35'),
(47, 'Test 13H37'),
(48, 'Test 13H38'),
(49, 'Test 13H40'),
(50, 'Test 13H45'),
(51, 'Test 13H47'),
(52, 'Test 13H50'),
(53, 'Test 13H58'),
(54, 'Test 13H59'),
(55, 'Test 14H01'),
(56, 'Test 14H02'),
(57, 'Test 14H04'),
(58, 'Test 14H05'),
(59, 'Test 14H06'),
(60, 'Competence eleve Maths'),
(61, 'Competence eleve  Info'),
(62, 'Competence eleve  Info2');

-- --------------------------------------------------------

--
-- Structure de la table `competences_etudiants`
--

CREATE TABLE `competences_etudiants` (
  `id_competence` int(50) NOT NULL,
  `id_etudiant` int(50) NOT NULL,
  `Id_niveau_acquisition` int(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_evaluation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences_etudiants`
--

INSERT INTO `competences_etudiants` (`id_competence`, `id_etudiant`, `Id_niveau_acquisition`, `commentaire`, `date_evaluation`) VALUES
(1, 1, 1, 'BIEN', '2023-05-03'),
(2, 1, 2, 'Peu mieux faire', '2023-05-07'),
(11, 1, 3, '', NULL),
(11, 2, 3, '', NULL),
(11, 3, 3, '', NULL),
(11, 4, 3, '', NULL),
(11, 5, 3, '', NULL),
(11, 6, 3, '', NULL),
(11, 7, 3, '', NULL),
(11, 8, 3, '', NULL),
(11, 9, 3, '', NULL),
(11, 10, 3, '', NULL),
(11, 11, 3, '', NULL),
(11, 12, 3, '', NULL),
(17, 1, 1, '', NULL),
(17, 2, 1, '', NULL),
(17, 3, 1, '', NULL),
(17, 4, 1, '', NULL),
(17, 5, 1, '', NULL),
(17, 6, 1, '', NULL),
(17, 7, 1, '', NULL),
(17, 8, 1, '', NULL),
(17, 9, 1, '', NULL),
(17, 10, 1, '', NULL),
(17, 11, 1, '', NULL),
(17, 12, 1, '', NULL),
(59, 2, 1, '', NULL),
(59, 12, 1, '', NULL),
(60, 1, 1, '', NULL),
(60, 3, 1, '', NULL),
(60, 4, 1, '', NULL),
(60, 5, 1, '', NULL),
(60, 6, 1, '', NULL),
(60, 7, 1, '', NULL),
(60, 8, 1, '', NULL),
(60, 9, 1, '', NULL),
(60, 10, 1, '', NULL),
(60, 11, 1, '', NULL),
(61, 2, 1, '', NULL),
(61, 12, 1, '', NULL),
(62, 2, 1, '', NULL),
(62, 12, 1, '', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `competences_matieres`
--

CREATE TABLE `competences_matieres` (
  `id_competence` int(50) NOT NULL,
  `id_matiere` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences_matieres`
--

INSERT INTO `competences_matieres` (`id_competence`, `id_matiere`) VALUES
(1, 1),
(2, 2),
(6, 2),
(7, 2),
(8, 2),
(11, 1),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(35, 2),
(59, 1),
(60, 2),
(61, 1),
(62, 1);

-- --------------------------------------------------------

--
-- Structure de la table `competences_transversales`
--

CREATE TABLE `competences_transversales` (
  `id_competence` int(50) NOT NULL,
  `nom_competences` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences_transversales`
--

INSERT INTO `competences_transversales` (`id_competence`, `nom_competences`) VALUES
(1, 'bien s\'exprimer a l\'oral'),
(2, 'uvhbn');

-- --------------------------------------------------------

--
-- Structure de la table `compet_trans_etudiant`
--

CREATE TABLE `compet_trans_etudiant` (
  `id_competence` int(50) NOT NULL,
  `id_etudiant` int(50) NOT NULL,
  `Id_niveau_acquisition` int(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_evaluation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compet_trans_etudiant`
--

INSERT INTO `compet_trans_etudiant` (`id_competence`, `id_etudiant`, `Id_niveau_acquisition`, `commentaire`, `date_evaluation`) VALUES
(1, 1, 3, 'test', '2023-05-08'),
(2, 1, 3, 'bnb,nnj', '2023-05-08');

-- --------------------------------------------------------

--
-- Structure de la table `compet_trans_matiere`
--

CREATE TABLE `compet_trans_matiere` (
  `id_competence` int(50) NOT NULL,
  `id_matiere` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compet_trans_matiere`
--

INSERT INTO `compet_trans_matiere` (`id_competence`, `id_matiere`) VALUES
(1, 2),
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(50) NOT NULL,
  `id_utilisateur` int(50) NOT NULL,
  `id_classe` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_utilisateur`, `id_classe`) VALUES
(1, 1, 1),
(2, 33, 2),
(3, 34, 1),
(4, 35, 1),
(5, 36, 1),
(6, 37, 1),
(7, 38, 1),
(8, 39, 1),
(9, 40, 1),
(10, 41, 1),
(11, 42, 1),
(12, 44, 2);

-- --------------------------------------------------------

--
-- Structure de la table `etudiiant_matiere`
--

CREATE TABLE `etudiiant_matiere` (
  `id_etudiant` int(50) NOT NULL,
  `id_matiere` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiiant_matiere`
--

INSERT INTO `etudiiant_matiere` (`id_etudiant`, `id_matiere`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id_matiere` int(50) NOT NULL,
  `nom_matiere` varchar(50) NOT NULL,
  `volume_horaire` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `nom_matiere`, `volume_horaire`) VALUES
(1, 'Info', '8'),
(2, 'Maths', '8'),
(3, 'Humanité', '2');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_professeur` int(50) NOT NULL,
  `id_utilisateur` int(50) NOT NULL,
  `Nom_prof` text NOT NULL,
  `id_classe` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_professeur`, `id_utilisateur`, `Nom_prof`, `id_classe`) VALUES
(2, 2, 'Bianchi', 1),
(74, 1, 'Debize', 2),
(77, 29, 'Lafontaine', 1),
(78, 48, 'Savard', NULL),
(79, 49, 'Prof', NULL),
(80, 50, 'Prof', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `professeur_matiere`
--

CREATE TABLE `professeur_matiere` (
  `id_professeur` int(50) NOT NULL,
  `id_matiere` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur_matiere`
--

INSERT INTO `professeur_matiere` (`id_professeur`, `id_matiere`) VALUES
(74, 1),
(2, 2),
(80, 3);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id_promotion` int(50) NOT NULL,
  `nom_promotion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id_promotion`, `nom_promotion`) VALUES
(1, '2026');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `Id_utilisateur` int(50) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mot_de_passe` varchar(50) NOT NULL,
  `Statut` text NOT NULL,
  `premiere_connexion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Id_utilisateur`, `Nom`, `Prenom`, `email`, `mot_de_passe`, `Statut`, `premiere_connexion`) VALUES
(1, 'TOS', 'TOSTOS', 'lilian.rage@edu.ece.fr', 'TOSANDO', 'Etudiant', 0),
(2, 'lol', 'loli', 'lilianclement69@gmail.com', '8754', 'Professeur', 0),
(3, 'lol', 'loli', 'lilianclement69@gmail.com', '54211', 'Administrateur', 0),
(4, 'lol', 'loli', 'lilianclement69@gmail.com', '8754', '', 0),
(5, 'lol', 'lolo', 'lilianclement69@gmail.com', '8754', '', 0),
(6, 'lol', 'lol', 'lilianclement69@gmail.com', '8754', '', 0),
(7, 'lol', 'lol', 'lilianclement69@gmail.com', '8754', '', 0),
(8, 'MUR', 'Matis', 'matis.mur@edu.ece.fr', 'matos', '', 0),
(9, 'a', 'b', 'Matisspams@gmail.com', 'mat', '', 0),
(10, 'decourselle', 'louise', 'louise.decourselle@edu.ece.fr', 'tas', '', 0),
(11, 'A', 'B', 'A@gmail.com', 'B', 'Etudiant', 0),
(29, 'Lafontaine', 'Franck', 'franck.lafontaine@edu.ece.fr', 'franck', 'Professeur', 0),
(32, 'MUR', 'Matis', 'mmatismails@gmail.com', 'Matis', 'Administrateur', 0),
(33, 'John', 'Joe', 'john@joe.fr', 'a', 'Etudiant', 0),
(34, 'eleve', 'num1', 'eleve@gmail.com', 'TXciPS3p', 'Etudiant', 1),
(35, 'eleve', 'num2', 'eleve2@gmail.com', 'fPBjAo9T', 'Etudiant', 1),
(36, 'eleve', 'num3', 'eleve3@gmail.com', 'DId1e5KA', 'Etudiant', 1),
(37, 'eleve', 'num4', 'eleve4@gmail.com', 'AYOXknoP', 'Etudiant', 1),
(38, 'eleve', 'num5', 'eleve5@gmail.com', 'e47Dw6H7', 'Etudiant', 1),
(39, 'eleve', 'num6', 'eleve6@gmail.com', 'sbatardelilian', 'Etudiant', 0),
(40, 'eleve', 'num7', 'eleve7@gmail.com', '1Z1B9iAL', 'Etudiant', 1),
(41, 'eleve', 'num7', 'eleve7@gmail.com', 'matisTest', 'Etudiant', 0),
(42, 'eleve', 'num8', 'eleve8@gmail.com', 'ntm lilian', 'Etudiant', 0),
(43, 'Decourselle', 'Louise', 'louise.decourselle@edu.ece.fr', 'louise', 'Administrateur', 0),
(44, 'lilan', 'lilan', 'lilan@lilan.com', 'filsdepute', 'Etudiant', 0),
(45, 'Savard', 'Mr', 'mr@savard.com', 'ypL2Dlam', 'Professeur', 1),
(46, 'Savard', 'Mr', 'mr@savard.com', '4P79Oi1v', 'Professeur', 1),
(47, 'Savard', 'Mr', 'mr@savard.com', 'LVfkEGVF', 'Professeur', 1),
(48, 'Savard', 'Mr', 'mr@savard.com', 'Va8qDxUt', 'Professeur', 1),
(49, 'Prof', 'Prof', 'Prof@prof.com', 'zFmBmk9x', 'Professeur', 1),
(50, 'Prof', 'Prof', 'Prof@prof.com', 'HIsbcdMx', 'Professeur', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acquisition_competences`
--
ALTER TABLE `acquisition_competences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`Id_administrateur`),
  ADD KEY `fk_Utilisateur` (`id_utilisateur`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `fk_Prom1` (`id_promotion`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competences`);

--
-- Index pour la table `competences_etudiants`
--
ALTER TABLE `competences_etudiants`
  ADD KEY `fk_competence2` (`id_competence`),
  ADD KEY `fk_Etudiant2` (`id_etudiant`),
  ADD KEY `fk_acquisition` (`Id_niveau_acquisition`);

--
-- Index pour la table `competences_matieres`
--
ALTER TABLE `competences_matieres`
  ADD KEY `fk_competence1` (`id_competence`),
  ADD KEY `fk_Matiere3` (`id_matiere`);

--
-- Index pour la table `competences_transversales`
--
ALTER TABLE `competences_transversales`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `compet_trans_etudiant`
--
ALTER TABLE `compet_trans_etudiant`
  ADD KEY `fk_Etudiant3` (`id_etudiant`),
  ADD KEY `fk_acquisition2` (`Id_niveau_acquisition`),
  ADD KEY `fk_compet_3` (`id_competence`);

--
-- Index pour la table `compet_trans_matiere`
--
ALTER TABLE `compet_trans_matiere`
  ADD KEY `fk_Matiere4` (`id_matiere`),
  ADD KEY `fk_compet_4` (`id_competence`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD KEY `fk_Utilisateur3` (`id_utilisateur`),
  ADD KEY `fk_Classe1` (`id_classe`);

--
-- Index pour la table `etudiiant_matiere`
--
ALTER TABLE `etudiiant_matiere`
  ADD KEY `fk_Etudiant1` (`id_etudiant`),
  ADD KEY `fk_Matiere2` (`id_matiere`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id_matiere`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_professeur`),
  ADD KEY `fk_Util` (`id_utilisateur`),
  ADD KEY `fk_classe4` (`id_classe`);

--
-- Index pour la table `professeur_matiere`
--
ALTER TABLE `professeur_matiere`
  ADD KEY `fk_Professeur1` (`id_professeur`),
  ADD KEY `fk_Matiere1` (`id_matiere`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id_promotion`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`Id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acquisition_competences`
--
ALTER TABLE `acquisition_competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `fk_Utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`Id_utilisateur`);

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `fk_Prom1` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`);

--
-- Contraintes pour la table `competences_etudiants`
--
ALTER TABLE `competences_etudiants`
  ADD CONSTRAINT `fk_Etudiant2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `fk_acquisition` FOREIGN KEY (`Id_niveau_acquisition`) REFERENCES `acquisition_competences` (`id`),
  ADD CONSTRAINT `fk_competence2` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competences`);

--
-- Contraintes pour la table `competences_matieres`
--
ALTER TABLE `competences_matieres`
  ADD CONSTRAINT `fk_Matiere3` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `fk_competence1` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competences`);

--
-- Contraintes pour la table `compet_trans_etudiant`
--
ALTER TABLE `compet_trans_etudiant`
  ADD CONSTRAINT `fk_Etudiant3` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `fk_acquisition2` FOREIGN KEY (`Id_niveau_acquisition`) REFERENCES `acquisition_competences` (`id`),
  ADD CONSTRAINT `fk_compet_3` FOREIGN KEY (`id_competence`) REFERENCES `competences_transversales` (`id_competence`);

--
-- Contraintes pour la table `compet_trans_matiere`
--
ALTER TABLE `compet_trans_matiere`
  ADD CONSTRAINT `fk_Matiere4` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `fk_compet_4` FOREIGN KEY (`id_competence`) REFERENCES `competences_transversales` (`id_competence`);

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_Classe1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `fk_Utilisateur3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`Id_utilisateur`);

--
-- Contraintes pour la table `etudiiant_matiere`
--
ALTER TABLE `etudiiant_matiere`
  ADD CONSTRAINT `fk_Etudiant1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `fk_Matiere2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `fk_Util` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`Id_utilisateur`),
  ADD CONSTRAINT `fk_classe4` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `professeur_matiere`
--
ALTER TABLE `professeur_matiere`
  ADD CONSTRAINT `fk_Matiere1` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `fk_Professeur1` FOREIGN KEY (`id_professeur`) REFERENCES `professeur` (`id_professeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
