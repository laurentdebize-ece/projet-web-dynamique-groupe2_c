-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 23 mai 2023 à 21:43
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
-- Structure de la table `acquisition_competences2`
--

CREATE TABLE `acquisition_competences2` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(50) NOT NULL,
  `nom_classe` varchar(50) NOT NULL,
  `id_promotion` int(50) DEFAULT NULL,
  `id_ecole` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`, `id_promotion`, `id_ecole`) VALUES
(1, 'ING1Groupe1', 3, 1),
(2, 'ING1Groupe2', 3, 1),
(3, 'ING1Groupe3', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

CREATE TABLE `competences` (
  `id_competences` int(50) NOT NULL,
  `nom_competences` varchar(50) NOT NULL,
  `id_professeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id_competences`, `nom_competences`, `id_professeur`) VALUES
(1, 'Calculer une Integrale - Bianchi', 1),
(2, 'Calculer fonction inverse - Bianchi', 1),
(3, 'Calculer fonction complexe - Thieulin', 5),
(4, 'Calculer flux - Dedecker', 2),
(5, 'Calculer Pointing - Dedecker', 2),
(6, 'Code php - Debize', 3),
(7, 'Code css - Debize', 3),
(8, 'Code C - Hintzy', 6),
(9, 'Diagramme de Bode - Savard', 4),
(10, 'Algebre de Bool - Hedli', 7);

-- --------------------------------------------------------

--
-- Structure de la table `competences_etudiants`
--

CREATE TABLE `competences_etudiants` (
  `id_competence` int(50) NOT NULL,
  `id_etudiant` int(50) NOT NULL,
  `Id_niveau_acquisition` int(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_evaluation` date DEFAULT NULL,
  `validation_prof` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences_etudiants`
--

INSERT INTO `competences_etudiants` (`id_competence`, `id_etudiant`, `Id_niveau_acquisition`, `commentaire`, `date_evaluation`, `validation_prof`) VALUES
(1, 1, 1, '', NULL, 0),
(1, 2, 1, '', NULL, 0),
(1, 3, 1, '', NULL, 0),
(1, 4, 1, '', NULL, 0),
(1, 5, 1, '', NULL, 0),
(1, 6, 1, '', NULL, 0),
(1, 7, 1, '', NULL, 0),
(2, 1, 1, '', '2023-05-23', 0),
(2, 2, 1, 'pour ce jour', '2023-05-23', 0),
(2, 3, 1, 'pour ce jour', '2023-05-23', 0),
(2, 4, 1, 'pour ce jour', '2023-05-23', 0),
(2, 5, 1, '', NULL, 0),
(2, 6, 1, '', NULL, 0),
(2, 7, 1, '', NULL, 0),
(3, 8, 1, '', NULL, 0),
(3, 9, 2, '', NULL, 0),
(3, 10, 1, '', NULL, 0),
(4, 1, 1, '', NULL, 0),
(4, 2, 1, '', NULL, 0),
(4, 3, 1, '', NULL, 0),
(4, 4, 1, '', NULL, 0),
(4, 5, 1, '', NULL, 0),
(4, 6, 1, '', NULL, 0),
(4, 7, 1, '', NULL, 0),
(4, 8, 1, '', NULL, 0),
(4, 9, 1, '', NULL, 0),
(4, 10, 1, '', NULL, 0),
(5, 1, 1, '', NULL, 0),
(5, 2, 1, '', NULL, 0),
(5, 3, 1, '', NULL, 0),
(5, 4, 1, '', NULL, 0),
(5, 5, 1, '', NULL, 0),
(5, 6, 1, '', NULL, 0),
(5, 7, 1, '', NULL, 0),
(5, 8, 1, '', NULL, 0),
(5, 9, 1, '', NULL, 0),
(5, 10, 1, '', NULL, 0),
(6, 5, 1, '', NULL, 0),
(6, 6, 1, '', NULL, 0),
(6, 7, 1, '', NULL, 0),
(6, 8, 1, '', NULL, 0),
(6, 9, 1, '', NULL, 0),
(6, 10, 1, '', NULL, 0),
(7, 5, 1, '', NULL, 0),
(7, 6, 1, '', NULL, 0),
(7, 7, 1, '', NULL, 0),
(7, 8, 1, '', NULL, 0),
(7, 9, 1, '', NULL, 0),
(7, 10, 1, '', NULL, 0),
(8, 1, 1, '', NULL, 0),
(8, 2, 1, '', NULL, 0),
(8, 3, 1, '', NULL, 0),
(8, 4, 1, '', NULL, 0),
(9, 1, 1, '', NULL, 0),
(9, 2, 1, '', NULL, 0),
(9, 3, 1, '', NULL, 0),
(9, 4, 1, '', NULL, 0),
(9, 8, 1, '', NULL, 0),
(9, 9, 1, '', NULL, 0),
(9, 10, 1, '', NULL, 0),
(10, 5, 1, '', NULL, 0),
(10, 6, 1, '', NULL, 0),
(10, 7, 1, '', NULL, 0);

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
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 3),
(7, 3),
(8, 3),
(9, 4),
(10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `competences_transversales`
--

CREATE TABLE `competences_transversales` (
  `id_competence` int(50) NOT NULL,
  `nom_competences` text NOT NULL,
  `id_professeur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competences_transversales`
--

INSERT INTO `competences_transversales` (`id_competence`, `nom_competences`, `id_professeur`) VALUES
(2, 'Participation', 2),
(3, 'Prise de parole en public', 3),
(4, 'Capacité à travailler en groupe', 4),
(5, 'Participation2', 5);

-- --------------------------------------------------------

--
-- Structure de la table `compet_trans_etudiant`
--

CREATE TABLE `compet_trans_etudiant` (
  `id_competence` int(50) NOT NULL,
  `id_etudiant` int(50) NOT NULL,
  `Id_niveau_acquisition` int(50) NOT NULL,
  `commentaire` text NOT NULL,
  `date_evaluation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compet_trans_etudiant`
--

INSERT INTO `compet_trans_etudiant` (`id_competence`, `id_etudiant`, `Id_niveau_acquisition`, `commentaire`, `date_evaluation`) VALUES
(2, 1, 1, '', NULL),
(2, 2, 1, '', NULL),
(2, 3, 1, '', NULL),
(2, 4, 1, '', NULL),
(2, 5, 1, '', NULL),
(2, 6, 1, '', NULL),
(2, 7, 1, '', NULL),
(2, 8, 1, '', NULL),
(2, 9, 3, '', NULL),
(2, 10, 1, '', NULL),
(3, 5, 1, '', NULL),
(3, 6, 1, '', NULL),
(3, 7, 1, '', NULL),
(3, 8, 1, '', NULL),
(3, 9, 1, '', NULL),
(3, 10, 1, '', NULL),
(4, 1, 1, '', NULL),
(4, 2, 1, '', NULL),
(4, 3, 1, '', NULL),
(4, 4, 1, '', NULL),
(4, 8, 1, '', NULL),
(4, 9, 1, '', NULL),
(4, 10, 1, '', NULL),
(5, 8, 1, '', NULL),
(5, 9, 1, '', NULL),
(5, 10, 1, '', NULL);

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
(2, 2),
(3, 3),
(4, 4),
(5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `id_ecole` int(50) NOT NULL,
  `Nom_ecole` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ecole`
--

INSERT INTO `ecole` (`id_ecole`, `Nom_ecole`) VALUES
(1, 'ECE'),
(2, 'INSEEC');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(50) NOT NULL,
  `id_utilisateur` int(50) NOT NULL,
  `id_classe` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `id_utilisateur`, `id_classe`) VALUES
(1, 9, 1),
(2, 10, 1),
(3, 11, 1),
(4, 12, 1),
(5, 13, 2),
(6, 14, 2),
(7, 15, 2),
(8, 16, 3),
(9, 17, 3),
(10, 20, 3);

-- --------------------------------------------------------

--
-- Structure de la table `etudiiant_matiere`
--

CREATE TABLE `etudiiant_matiere` (
  `id_etudiant` int(50) NOT NULL,
  `id_matiere` int(50) NOT NULL,
  `id_prof` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiiant_matiere`
--

INSERT INTO `etudiiant_matiere` (`id_etudiant`, `id_matiere`, `id_prof`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(1, 2, 2),
(2, 2, 2),
(3, 2, 2),
(4, 2, 2),
(1, 3, 6),
(2, 3, 6),
(3, 3, 6),
(4, 3, 6),
(1, 4, 4),
(2, 4, 4),
(3, 4, 4),
(4, 4, 4),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(5, 2, 2),
(6, 2, 2),
(7, 2, 2),
(5, 3, 3),
(6, 3, 3),
(7, 3, 3),
(5, 4, 7),
(6, 4, 7),
(7, 4, 7),
(8, 1, 5),
(9, 1, 5),
(10, 1, 5),
(8, 2, 2),
(9, 2, 2),
(10, 2, 2),
(8, 3, 3),
(9, 3, 3),
(10, 3, 3),
(8, 4, 4),
(9, 4, 4),
(10, 4, 4);

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
(1, 'Mathematiques', '6'),
(2, 'Physique', '4'),
(3, 'Informatique', '4'),
(4, 'Electronique', '4');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_professeur` int(50) NOT NULL,
  `id_utilisateur` int(50) NOT NULL,
  `Nom_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id_professeur`, `id_utilisateur`, `Nom_prof`) VALUES
(1, 5, 'Bianchi'),
(2, 6, 'Dedecker'),
(3, 7, 'Debize'),
(4, 8, 'Savard'),
(5, 18, 'Thieulin'),
(6, 19, 'Hintzy'),
(7, 21, 'Hedli');

-- --------------------------------------------------------

--
-- Structure de la table `professeur_classe`
--

CREATE TABLE `professeur_classe` (
  `id_professeur` int(50) NOT NULL,
  `id_classe` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `professeur_classe`
--

INSERT INTO `professeur_classe` (`id_professeur`, `id_classe`) VALUES
(1, 1),
(2, 1),
(4, 1),
(6, 1),
(1, 2),
(2, 2),
(3, 2),
(7, 2),
(2, 3),
(3, 3),
(4, 3),
(5, 3);

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
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 1),
(6, 3),
(7, 4);

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
(1, '2025'),
(2, '2026'),
(3, '2027');

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
(1, 'Admin1', 'Matis', 'Matis.mur@edu.ece.fr', 'matis', 'Administrateur', 0),
(2, 'Admin2', 'Lilian', 'lilian.rage@edu.ece.fr', 'cfMZkUjj', 'Administrateur', 1),
(3, 'Admin3', 'Louise', 'louise.decourselle@edu.ece.fr', 'xvXxBhdW', 'Administrateur', 1),
(4, 'Admin4', 'Antoine', 'antoine.dejesus@edu.ece.fr', 'ZcFheVQq', 'Administrateur', 1),
(5, 'Bianchi', 'Celine', 'celine@bianchi.com', 'celine', 'Professeur', 0),
(6, 'Dedecker', 'Samira', 'samira@dedecker.com', 'samira', 'Professeur', 0),
(7, 'Debize', 'Laurent', 'laurent@debize.com', 'Gq558zHc', 'Professeur', 1),
(8, 'Savard', 'Christophe', 'christophe@savard.com', 'IXSiLt7a', 'Professeur', 1),
(9, 'MUR', 'Matis', 'matis@mur.com', 'matis', 'Etudiant', 0),
(10, 'Decourselle', 'Louise', 'louise@decourselle.com', 'lXzoB0Gg', 'Etudiant', 1),
(11, 'De Jesus', 'Antoine', 'antoine@dejesus.com', 'hH6Tyv9l', 'Etudiant', 1),
(12, 'Rage', 'Lilian', 'lilian@rage.com', 'dVNPkQp9', 'Etudiant', 1),
(13, 'Toto', 'ElevClass2', 'toto@ElevClass2.com', 'dONuRIpE', 'Etudiant', 1),
(14, 'tata', 'ElevClass2', 'tata@ElevClass2.com', '2VUoe5e9', 'Etudiant', 1),
(15, 'titi', 'ElevClass2', 'titi@ElevClass2.com', 'hAr6sfOn', 'Etudiant', 1),
(16, 'Uno', 'Un', 'uno@un.com', 'JS790HNO', 'Etudiant', 1),
(17, 'Dos', 'Deux', 'dos@deux.com', 'AIs9IL8V', 'Etudiant', 1),
(18, 'Thieulin', 'Coralie', 'coralie@thieulin.com', 'YJrzykD1', 'Professeur', 1),
(19, 'Hintzy', 'Antoine', 'antoine@hintzy.com', 'fQHZ0M7v', 'Professeur', 1),
(20, 'Tres', 'Trois', 'tres@trois.com', 'T54E2rQ7', 'Etudiant', 1),
(21, 'Hedli', 'Afef', 'afef@hedli.com', 'yduLHLrL', 'Professeur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `validation_prof`
--

CREATE TABLE `validation_prof` (
  `id_validation` int(50) NOT NULL,
  `nom_validation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `validation_prof`
--

INSERT INTO `validation_prof` (`id_validation`, `nom_validation`) VALUES
(0, 'Aucune validation du professeur'),
(1, 'Validé'),
(2, 'Non validé');

-- --------------------------------------------------------

--
-- Structure de la table `validation_prof2`
--

CREATE TABLE `validation_prof2` (
  `id_validation` int(50) NOT NULL,
  `nom_validation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acquisition_competences`
--
ALTER TABLE `acquisition_competences`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `acquisition_competences2`
--
ALTER TABLE `acquisition_competences2`
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
  ADD KEY `fk_Prom1` (`id_promotion`),
  ADD KEY `fk_Ecole` (`id_ecole`);

--
-- Index pour la table `competences`
--
ALTER TABLE `competences`
  ADD PRIMARY KEY (`id_competences`),
  ADD KEY `fk_competences_professeur` (`id_professeur`);

--
-- Index pour la table `competences_etudiants`
--
ALTER TABLE `competences_etudiants`
  ADD KEY `fk_competence2` (`id_competence`),
  ADD KEY `fk_Etudiant2` (`id_etudiant`),
  ADD KEY `fk_acquisition` (`Id_niveau_acquisition`),
  ADD KEY `fk_ValidProf` (`validation_prof`);

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
  ADD PRIMARY KEY (`id_competence`),
  ADD KEY `fk_competences_professeur2` (`id_professeur`);

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
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`id_ecole`);

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
  ADD KEY `fk_Util` (`id_utilisateur`);

--
-- Index pour la table `professeur_classe`
--
ALTER TABLE `professeur_classe`
  ADD PRIMARY KEY (`id_professeur`,`id_classe`),
  ADD KEY `id_classe` (`id_classe`);

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
-- Index pour la table `validation_prof`
--
ALTER TABLE `validation_prof`
  ADD PRIMARY KEY (`id_validation`);

--
-- Index pour la table `validation_prof2`
--
ALTER TABLE `validation_prof2`
  ADD PRIMARY KEY (`id_validation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acquisition_competences`
--
ALTER TABLE `acquisition_competences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `acquisition_competences2`
--
ALTER TABLE `acquisition_competences2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_Ecole` FOREIGN KEY (`id_ecole`) REFERENCES `ecole` (`id_ecole`),
  ADD CONSTRAINT `fk_Prom1` FOREIGN KEY (`id_promotion`) REFERENCES `promotion` (`id_promotion`);

--
-- Contraintes pour la table `competences`
--
ALTER TABLE `competences`
  ADD CONSTRAINT `fk_competences_professeur` FOREIGN KEY (`id_professeur`) REFERENCES `professeur` (`id_professeur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `competences_etudiants`
--
ALTER TABLE `competences_etudiants`
  ADD CONSTRAINT `fk_Etudiant2` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `fk_ValidProf` FOREIGN KEY (`validation_prof`) REFERENCES `validation_prof` (`id_validation`),
  ADD CONSTRAINT `fk_acquisition` FOREIGN KEY (`Id_niveau_acquisition`) REFERENCES `acquisition_competences` (`id`),
  ADD CONSTRAINT `fk_competence2` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competences`);

--
-- Contraintes pour la table `competences_matieres`
--
ALTER TABLE `competences_matieres`
  ADD CONSTRAINT `fk_Matiere3` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `fk_competence1` FOREIGN KEY (`id_competence`) REFERENCES `competences` (`id_competences`);

--
-- Contraintes pour la table `competences_transversales`
--
ALTER TABLE `competences_transversales`
  ADD CONSTRAINT `fk_competences_professeur2` FOREIGN KEY (`id_professeur`) REFERENCES `professeur` (`id_professeur`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_Util` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`Id_utilisateur`);

--
-- Contraintes pour la table `professeur_classe`
--
ALTER TABLE `professeur_classe`
  ADD CONSTRAINT `professeur_classe_ibfk_1` FOREIGN KEY (`id_professeur`) REFERENCES `professeur` (`id_professeur`) ON DELETE CASCADE,
  ADD CONSTRAINT `professeur_classe_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE;

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
