-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Mars 2017 à 15:52
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Livre'),
(2, 'Jeu vidéo'),
(3, 'Musique'),
(4, 'Objet divers'),
(5, 'DVD/Blu-Ray');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `pdt_id` int(11) NOT NULL,
  `pdt_title` varchar(255) NOT NULL,
  `pdt_description` text NOT NULL,
  `pdt_ref` varchar(255) NOT NULL,
  `pdt_ht` varchar(255) NOT NULL,
  `pdt_tva` varchar(255) NOT NULL,
  `pdt_price` varchar(255) NOT NULL,
  `pdt_picture` varchar(255) NOT NULL,
  `pdt_cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `products`
--

INSERT INTO `products` (`pdt_id`, `pdt_title`, `pdt_description`, `pdt_ref`, `pdt_ht`, `pdt_tva`, `pdt_price`, `pdt_picture`, `pdt_cat_id`) VALUES
(1, 'Pokemon', 'pokemon soleil, vesion de la 7è generation', '2318A', '35', '0.5', '36,75', 'uploads/picture_58b9b91e60fe4.png', 2),
(2, 'GTA V', 'Jeux d\'aventure libertain où tu peux faire tout ce que tu veux du braquage au meurtre', '', '85', '0.1', '93,5', 'uploads/picture_58b9c241060f2.png', 2),
(3, 'Docteur Strange', 'Doctor Strange suit l\'histoire du Docteur Stephen Strange, talentueux neurochirurgien qui, après un tragique accident de voiture, doit mettre son égo de côté et apprendre les secrets d\'un monde caché de mysticisme et de dimensions alternatives. Basé à New York, dans le quartier de Greenwich Village, Doctor Strange doit jouer les intermédiaires entre le monde réel et ce qui se trouve au-delà, en utlisant un vaste éventail d\'aptitudes métaphysiques et d\'artefacts pour protéger le Marvel Cinematic Universe.', 'sgfhvsh', '60', '0.2', '72', 'uploads/picture_58b9c37b657a5.jpg', 5),
(4, 'The divine comedy - inferno', 'This is the first volume of a new prose translation of Dante\'s epic - the first in twenty-five years. Robert Durling\'s translation brings a new power and accuracy to the rendering of Dante\'s extraordinary vision of Hell, with its terror, pathos, and sardonic humour, and its penetrating analyses of the psychology of sin and the ills that plague society. A newly edited version of the Italian text can be on facing pages, and this edition includes fully comprehensive notes as well as sixteen essays on special subjects.', '0195087445', '11', '0.05', '11.55', 'uploads/picture_58bd675f607d1.jpg', 1),
(5, 'air max classic', 'paire de chaussure nike', '0159363545', '150€', '0.2', '180', 'uploads/picture_58bd6ea2a5383.jpg', 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_firstname` varchar(255) NOT NULL,
  `usr_lastname` varchar(255) NOT NULL,
  `usr_email` varchar(255) NOT NULL,
  `usr_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`usr_id`, `usr_firstname`, `usr_lastname`, `usr_email`, `usr_password`) VALUES
(1, 'Ruddy', 'MARIE-LUCE', 'kai972@live.fr', '$2y$10$o2VmiK2.tl/T/RhB45SsNeMb9uRkwd73mjQSlMnkgjAAeKscmBRMC'),
(4, 'Ruddy', 'MARIE-LUCE', 'ruddy.marieluce@gmail.com', '$2y$10$iG8AXmg1RicQYyq/qlPvOOvISKNoTnMrZVI7CR8wntQOIKvggBsKm'),
(5, 'test', 'test', 'test@test.co', '$2y$10$5TovRH8F9J0vJTQIIquMLeBbhFFgBu1fUWBgoHUcSPVSa4d/n4Fdu');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pdt_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_email` (`usr_email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `pdt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
