-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 17 jan. 2026 à 17:09
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chat2`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `idMessage` int(11) NOT NULL,
  `idSender` int(11) NOT NULL,
  `idReceiver` int(11) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`idMessage`, `idSender`, `idReceiver`, `contenu`) VALUES
(10, 2, 1, 'salut'),
(11, 1, 2, 'salut an'),
(12, 1, 2, 'cava ve'),
(13, 2, 1, 'cava ka'),
(14, 2, 1, 'hayy'),
(15, 2, 6, 'salut'),
(16, 2, 6, 'cava ve'),
(17, 2, 1, 'ddd'),
(18, 6, 2, 'cava ka'),
(19, 8, 6, 'kaiza'),
(20, 6, 8, 'kaiza2'),
(21, 1, 3, 'df'),
(22, 1, 8, 'kaiza'),
(23, 1, 5, 'kaiza'),
(24, 1, 2, 'de aona'),
(25, 1, 8, 'hhh'),
(26, 1, 2, 'ao ve'),
(27, 1, 2, 'ao soa'),
(28, 8, 1, 'kaiza'),
(29, 8, 1, 'de aona ny kajy ao'),
(30, 1, 8, 'otrany tsy misy kajy ah'),
(31, 8, 1, 'kozy ve😅'),
(32, 1, 8, 'de aona e asio toaka any moa😄'),
(33, 1, 6, 'salama oh'),
(34, 1, 7, 'kaiza koto'),
(35, 7, 5, 'salama rabary'),
(36, 7, 1, 'de aona manoy'),
(37, 1, 7, 'ao tsara ve'),
(38, 7, 1, 'yah lty ao tsara ka'),
(39, 1, 7, 'de aona asio revy any🤣'),
(40, 7, 1, 'tairo asio any aloha e😎'),
(41, 1, 7, 'tsika mbola tsisy mintsy ah😂'),
(42, 7, 1, 'aiza ahh aza ato anzany ee😄'),
(43, 7, 2, 'salut meme'),
(44, 2, 7, 'salut ah'),
(45, 7, 2, 'cava ve?'),
(46, 2, 7, 'oui cava'),
(47, 2, 7, 'tsara zant'),
(48, 2, 1, 'zaza io'),
(49, 1, 2, 'djadja io ai'),
(50, 2, 1, 'aona ai'),
(51, 1, 2, 'kolokoloko ai'),
(52, 1, 6, 'sss'),
(53, 6, 1, 'salut'),
(54, 1, 6, 'gggg'),
(55, 1, 8, 'hahaha'),
(56, 5, 1, 'kaiza2'),
(57, 1, 5, 'cava ve?'),
(58, 5, 1, 'yaya cava tsara ka'),
(59, 1, 8, 'rr');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text DEFAULT NULL,
  `date_inscription` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUsers`, `pseudo`, `email`, `password`, `image`, `date_inscription`) VALUES
(1, 'manoy', 'manoy@gmail.com', '$2y$10$mDAtH.YRKEwY/qYNL/CMM.NgqSsFnhxGeW4HmmT5WUpGmhw/4Q1GW', NULL, '2025-12-19 23:42:43'),
(2, 'mendrika', 'mendrika@gmail.com', '$2y$10$ZVpVJc4uKFCqTcngFGyUkeEQn/h2Fif8xYHGDyH3/aE2x0ugIe5Ii', 'mendrika69594791269ac6.29999490.jpg', '2025-12-19 23:44:20'),
(3, 'rasoa', 'rasoa@gmail.com', '$2y$10$jm2ByZkUeYBIu13LY17uJOaWbynK7V96gSJgPzYrv.Z6xRzPdSL3S', NULL, '2025-12-19 23:49:20'),
(4, 'rabe', 'rabe@gmail.com', '$2y$10$eph49Emwm4/VLImvETm54u1p7qOlfcR9uTAOLRUVuhw6ouI54TNqW', NULL, '2025-12-19 23:49:43'),
(5, 'rabary', 'rabary@gmail.com', '$2y$10$eG8EkvG0GRdVBgO1IKdJZ.PMtulAAAUQsCm2rA8CWpza6U3HEHEvu', NULL, '2025-12-19 23:50:14'),
(6, 'rasalama', 'rasalama@gmail.com', '$2y$10$G/KjPVLWY1Fkb.Lgmt1YyOoDVqyEuVt2Z9MWLzrW8y0/T6dP/K.ES', NULL, '2025-12-19 23:50:45'),
(7, 'rakoto', 'rakoto@gmail.com', '$2y$10$V7Sw/DEpLyTS5H5W7brva.VEZhFnUdh9hF59ntVNIGr8meDYr0iaO', NULL, '2025-12-19 23:51:10'),
(8, 'faniry', 'faniry@gmail.com', '$2y$10$BSTH0P7ik22xLEV4VZilBe89Dh.EiTbeHepSTOYgdb9eIiSNMb34K', 'faniry695944a94dd867.70567062.jpg', '2025-12-29 09:39:29');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
