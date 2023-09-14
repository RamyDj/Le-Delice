-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 sep. 2023 à 07:38
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `resto`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_client` int NOT NULL,
  `nomClient` varchar(255) NOT NULL,
  `prenomClient` varchar(255) NOT NULL,
  `nbClient` float NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `id_client`, `nomClient`, `prenomClient`, `nbClient`, `date`) VALUES
(21, 3, 'cranel', 'bell', 2, '2023-09-13 12:00:00'),
(22, 3, 'cranel', 'bell', 7, '2023-09-14 12:20:00');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `id_role` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `mail`, `password`, `id_role`) VALUES
(1, 'ramy', 'Djebassi', 'ramyto.rd@gmail.com', '$2y$10$sBY.LBmxJKzwMj58RVu5bO2FIunsjbFsTcAgnq7AWybCm86Lv8BWe', 2),
(2, 'djebassi', 'Djebassi', 'ramyto.rd@gmail.fr', '$2y$10$XF6gMGWfkGaNrPVNjooqJet83dZLLOnMO2cdeEV9o0S4GBtklUyqS', 1),
(3, 'cranel', 'bell', 'bcranel@gmail.com', '$2y$10$D5s7468lDZ/OvBjCKUNswO570a7lR6trIKYBeWhcr/QLgE1eWwvUG', 2),
(4, 'kurosaki', 'ichigo', 'ikurosaki@gmail.com', '$2y$10$rA3gMpNaBvjub.JCHDyZLOD7L3aTQK0ZH0xaHU46AO9kJ5f9XF6hK', 2);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) NOT NULL,
  `contenu` text NULL,
  `prix` decimal(10,2) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id`, `titre`, `contenu`, `prix`, `categorie`) VALUES
(15, 'CAESAR', 'salade romaine, poulet pané, croûtons, tomates, parmesan, oeuf poché, sauce Caesar et gressin', '18.00', 'INSALATA'),
(14, 'VIA ROMA', 'burrata à la truffe, quartiers de tomates de couleurs et jambon de Parme', '19.00', 'INSALATA'),
(13, 'PIATTO D’ANTIPASTI', 'camembert di bufala, stracciatella, pecorino, coppa, jambon blanc truffé, jambon de Parme, artichauts frits, poivrons à l’anchois, frites de polenta', '26.00', 'ANTIPASTI / À PARTAGER'),
(12, ' SALADE DE SEICHES EN PERSILLADE', 'tomates, roquette et sauce tartare', '16.00', 'ANTIPASTI / À PARTAGER'),
(11, 'BURRATA ET SON PAIN AU CHARBON ', ' huile d’olive à la truffe et pignons', '16.00', 'ANTIPASTI / À PARTAGER'),
(16, 'MAMMA', 'tartare de tomates anciennes, burrata et vinaigrette au basilic', '17.00', 'INSALATA'),
(19, 'CAPRA', 'mélange de salades, tomates anciennes, 4 toasts de chèvre chaud et jambon de Parme', '17.00', 'INSALATA'),
(18, 'GRECA', 'petit épeautre, concombres, tomates, féta, menthe et olives noires', '17.00', 'INSALATA'),
(20, 'VEGETARIANA', 'tartare de tomates, tagliatelles de courgettes, purée d’avocat, pignons et basilic frais', '16.00', 'INSALATA'),
(21, 'LASAGNES DE BOEUF', 'salade verte', '18.00', 'PASTA'),
(22, 'SPAGHETTI ALLA BOLOGNESE', '', '16.00', 'PASTA'),
(23, 'SPAGHETTI ALLE VONGOLE', '', '23.00', 'PASTA'),
(24, 'SPAGHETTI ALLA CARBONARA', '', '18.00', 'PASTA'),
(25, 'LINGUINI AL PESTO', '', '16.00', 'PASTA'),
(26, 'LINGUINI AI FRUTTI DI MARE', 'moules, gambas, palourdes, calamars et Saint-Jacques', '27.00', 'PASTA'),
(27, 'GNOCCHI FRAIS, PESTO MAISON, BURRATA, PIGNONS', '', '21.00', 'PASTA'),
(28, 'GNOCCHI FRAIS, GORGONZOLA ET NOIX', '', '18.00', 'PASTA'),
(29, 'GNOCCHI FRAIS À LA TRUFFE', 'sauce truffe et copeaux de truffe', '25.00', 'PASTA'),
(30, 'RAVIOLI FRAIS À LA TRUFFE', 'sauce truffe et copeaux de truffe', '25.00', 'PASTA'),
(31, 'CANNELLONI BROUSSE & ÉPINARDS', 'salade verte', '18.00', 'PASTA'),
(32, 'CALABRIA', 'orecchiette, tomates confites, tartare d’olives, stracciatella, huile citronnée', '18.00', 'PASTA'),
(33, 'TOMATO & CO', 'mafaldine, sauce tomate, tomates datterino, ricotta, basilic', '18.00', 'PASTA'),
(34, 'LIMONE', 'linguine au citron, tomates confites, huile d’olive, piment d’Espelette, stracciatella fumée', '22.00', 'PASTA'),
(35, 'BOCCA GORGONZOLA', 'paccheri, sauce vin rouge et gorgonzola, champignons, persil, noix, copeaux de parmesan, huile d’olive, trévise, jambon de Parme', '26.00', 'PASTA'),
(36, 'TOSCANA', 'paccheri, saucisse italienne, oignons, sauce tomate, graines de fenouil, pecorino', '24.00', 'PASTA'),
(37, 'TARTUFO TI AMO', 'mafaldine, sauce truffe noire, copeaux de truffe', '28.00', 'PASTA'),
(38, 'PISTACCHIO', 'paccheri, pesto de pistaches, stracciatella, pistaches torréfiées, parmesan', '22.00', 'PASTA'),
(39, 'CACIO E PEPE', 'linguine, artichauts, menthe, crème de pecorino, poivre de Kampot', '23.00', 'PASTA'),
(40, 'COZZE', 'linguine aux moules, persillade, coriandre, oignons, vin blanc, crème, piment d’Espelette', '26.00', 'PASTA'),
(41, 'MARGHERITA', 'sauce tomate, mozza di bufala, origan et olives taggiasche', '14.00', 'PIZZA'),
(42, 'ACCHIUGHE', 'sauce tomate, anchois et origan', '14.00', 'PIZZA'),
(43, 'PROSCIUTTO', 'sauce tomate, jambon et origan', '15.00', 'PIZZA'),
(44, 'FORMAGGIO', 'sauce tomate, fromage et origan', '13.00', 'PIZZA'),
(45, 'NAPOLI', 'sauce tomate, mozza fior di latte, anchois, tomates cerises, olives taggiasche, ail, origan et frutti di cappero', '16.00', 'PIZZA'),
(46, '5 FORMAGGI', 'sauce tomate, mozza fior di latte, gorgonzola, scamorza, parmesan, pecorino et origan', '17.00', 'PIZZA'),
(47, 'PARMA', 'sauce tomate, mozza di bufala, jambon de Parme et origan', '17.00', 'PIZZA'),
(48, 'STRACCIATELLA', 'stracciatella, tomates fraîches, roquette et jambon de Parme', '17.00', 'PIZZA'),
(49, 'TARTUFO', 'crème de truffe, mozza di bufala et copeaux de truffe fraîche', '20.00', 'PIZZA'),
(50, 'MELANZANA', 'sauce tomate, mozza fior di latte, aubergines grillées, pesto, copeaux de parmesan et origan', '16.00', 'PIZZA'),
(51, 'ANDREA E LOUISA', 'sauce tomate, jambon à la truffe, champignons, cebette, copeaux de parmesan et origan', '17.00', 'PIZZA'),
(52, 'SEICHES EN PERSILLADE', '', '22.00', 'PESCE'),
(53, 'TARTARE DE SAUMON', 'avocat et huile citronnée', '21.00', 'PESCE'),
(54, 'PAVÉ DE SAUMON', 'sauce citronnée', '22.00', 'PESCE'),
(55, 'MI-CUIT DE THON FRAIS AU SÉSAME', '', '22.00', 'PESCE'),
(56, 'ITALIANO', 'crémeux de parmesan, petits pois, jambon de Parme et tuile de parmesan', '20.00', 'RISOTTO'),
(57, 'FORESTIERA', 'crémeux de parmesan, poulet et champignons', '22.00', 'RISOTTO'),
(58, 'TARTARE DE BOEUF ITALIEN AU COUTEAU', 'olives noires, échalotes, pignons, tomates confites et copeaux de parmesan', '21.00', 'CARNE'),
(59, 'BURGER À L’ITALIENNE', 'pain au charbon, boeuf, tomates cerises, pecorino et basilic', '19.00', 'CARNE'),
(60, 'ENTRECÔTE DU PIÉMONT', '', '26.00', 'CARNE'),
(61, 'SCALOPPINA ALLA MILANESE', 'linguini à la tomate et au basilic CARPACCIO ANGUS, fines tranches de bœuf, huile d’olive, basilic, parmesan', '21.00', 'CARNE'),
(62, 'TAGLIATA DE BOEUF SIMMENTAL', 'roquette, parmesan, pesto et frites', '23.00', 'CARNE'),
(63, 'SALTIMBOCCA SAPORITO', 'escalope de veau gratinée à la mozza, crème de sauge et jambon blanc à la truffe', '24.00', 'CARNE'),
(64, 'FILET DE BOEUF', 'sauce à la truffe', '32.00', 'CARNE'),
(65, 'CARPACCIO ANGUS', 'fines tranches de bœuf, huile d’olive, basilic, parmesan', '25.00', 'CARNE'),
(66, 'TIRAMISU MINUTE', 'préparé à la table', '10.00', 'DOLCI DELLA CASA'),
(67, 'PANNA COTTA', 'coulis de fruits rouges', '9.00', 'DOLCI DELLA CASA'),
(68, 'MOUSSE AU CHOCOLAT', '', '9.00', 'DOLCI DELLA CASA'),
(69, 'CRÈME BRÛLÉE', 'à la vanille', '9.00', 'DOLCI DELLA CASA'),
(70, 'PAVLOVA', 'coulis de fruits rouges', '9.00', 'DOLCI DELLA CASA'),
(71, 'DESSERT DU JOUR', '', '9.00', 'DOLCI DELLA CASA'),
(72, 'CAFÉ GOURMAND', '', '10.00', 'DOLCI DELLA CASA'),
(73, 'SORBET TARENTINA', 'fraise / menthe / citron / mojito / melon', '8.00', 'DOLCI DELLA CASA'),
(74, 'GLACE TARENTINA', 'kinder / noisette du Piémont IGP / vanille de Madagascar / chocolat / caramel beurre salé / stracciatella', '8.00', 'DOLCI DELLA CASA'),
(75, 'SORBETS', 'CITRON DE SICILE / FRAMBOISE / LIMONCELLO / MOJITO HAVANA / ANANAS', '8.00', 'GELATO'),
(76, 'GLACES', 'BANANE / COOKIE / BARBE À PAPA / CHOCOLAT / CAFÉ / VANILLE MADAGASCAR / LAVANDE MIEL / FRAISE BONBON', '6.00', 'GELATO'),
(77, 'COUPE MOJITO ', '2 boules sorbet mojito havana, rhum havana, menthe, citron vert', '11.00', 'GELATO'),
(78, 'COUPE COLONNEL', '3 boules sorbet citron, vodka', '11.00', 'GELATO'),
(79, 'COUPE EXOTIQUE', '1 boule sorbet melon, 1 boule sorbet framboise, framboises, melon', '8.00', 'GELATO'),
(80, 'COUPE NUTELLA', '1 boule glace banane, 1 boule glace vanille de Madagascar, 1 boule glace cookie, nutella, chantilly', '10.00', 'GELATO'),
(81, 'MOJITO CLASSIQUE', '', '10.00', 'COCKTAILS'),
(82, 'MOJITO FRAMBOISE / FRAISE / PASSION', '', '11.00', 'COCKTAILS'),
(83, 'SPRITZ', '', '10.00', 'COCKTAILS'),
(84, 'LILLET BLANC / TONIC / FRAMBOISE', '', '9.00', 'COCKTAILS'),
(85, 'LILLET ROSÉ / TONIC', '', '9.00', 'COCKTAILS'),
(86, 'PIÑA COLADA', '', '10.00', 'COCKTAILS'),
(87, 'SEX ON THE BEACH', '', '10.00', 'COCKTAILS'),
(88, 'AMORE MIO', 'gin infusé à la rose, jus de citron, sucre de canne', '10.00', 'COCKTAILS'),
(89, 'BISSAP', 'vodka infusée aux fleurs d’hibiscus, sirop de cerise, jus de citron jaune', '10.00', 'COCKTAILS'),
(90, 'VANILLA', 'rhum épicé, mangue, vanille, jus de citron, sucre de canne', '10.00', 'COCKTAILS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
