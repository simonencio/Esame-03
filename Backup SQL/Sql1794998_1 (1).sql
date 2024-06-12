-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 31.11.39.154:3306
-- Creato il: Giu 12, 2024 alle 16:02
-- Versione del server: 8.0.36-28
-- Versione PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Sql1794998_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `portfolio`
--

CREATE TABLE `portfolio` (
  `id` bigint NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `elenco_image_url` varchar(255) DEFAULT NULL,
  `elenco_image_title` varchar(255) DEFAULT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `portfolio`
--

INSERT INTO `portfolio` (`id`, `nome`, `elenco_image_url`, `elenco_image_title`, `cancellato`) VALUES
(1, 'progetto 1', 'immagini/webdesign.jpg', 'vai al progetto 1', 0),
(2, 'progetto 2', 'immagini/webdesign.jpg', 'vai al progetto 2', 0),
(3, 'progetto 3', 'immagini/webdesign.jpg', 'vai al progetto 3', 0),
(4, 'progetto 4', 'immagini/webdesign.jpg', 'vai al progetto 4', 0),
(5, 'progetto 5', 'immagini/webdesign.jpg', 'vai al progetto 5', 0),
(6, 'progetto 6', 'immagini/webdesign.jpg', 'vai al progetto 6', 0),
(10, 'Progetto 10', 'immagini/webdesign.jpg', 'vai al progetto 7', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `progetti`
--

CREATE TABLE `progetti` (
  `id` bigint NOT NULL,
  `nome` varchar(255) NOT NULL,
  `progetto_img` varchar(255) NOT NULL,
  `progetto_title` varchar(255) NOT NULL,
  `descrizione` longtext NOT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `progetti`
--

INSERT INTO `progetti` (`id`, `nome`, `progetto_img`, `progetto_title`, `descrizione`, `cancellato`) VALUES
(1, 'progetto 1', 'immagini/16683353_5757453.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(2, 'progetto 2', 'immagini/Backend-Development.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(3, 'progetto 3', 'immagini/be-your-react-front-end-developer.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(4, 'progetto 4', 'immagini/Figma0.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(5, 'progetto 5', 'immagini/Photoshop-logo.jpeg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(6, 'progetto 6', 'immagini/realizzazione-siti-web-alberto-pozzi-monza.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0),
(10, 'Progetto 12', 'immagini/prova.jpg', 'Creazione di siti web responsive', 'Uno tra i tanti lavori che effettuiamo consiste nella creazione di siti web responsive, cioè in grado di adattarsi a computer, smartphone e tablet. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industries standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `recapiti`
--

CREATE TABLE `recapiti` (
  `id` bigint NOT NULL,
  `nome` varchar(100) NOT NULL,
  `indirizzo` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `recapiti`
--

INSERT INTO `recapiti` (`id`, `nome`, `indirizzo`, `email`, `telefono`, `cancellato`) VALUES
(1, 'Primo Recapito', 'Via dai piedi,1 <br> 58100 Grosseto (GR)<br> Italia', 'miosito@gmail.com', '+391234567890', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `sezioni`
--

CREATE TABLE `sezioni` (
  `id` bigint NOT NULL,
  `titolo_link` varchar(50) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `img` varchar(50) DEFAULT NULL,
  `title_img` varchar(50) DEFAULT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `sezioni`
--

INSERT INTO `sezioni` (`id`, `titolo_link`, `link`, `img`, `title_img`, `cancellato`) VALUES
(1, 'Modifica Utenti', './utenti.php', './immagini/iconaUtente.jpg', 'Modifica Utenti', 0),
(2, 'Modifica Portfolio', './portfolio.php', './immagini/iconaPortfolio.jpg', 'Modifica Portfolio', 0),
(3, 'Modifica Progetti', './progetti.php', './immagini/iconaProgetti.jpg', 'Modifica Progetti', 0),
(4, 'Modifica Recapiti', './recapiti.php', './immagini/iconaContatti.jpg', 'Modifica Recapiti', 0),
(5, 'Modifica Social', './social.php', './immagini/iconaSocial.jpg', 'Modifica Social', 0),
(6, 'Modifica Dati Clienti', './datiClienti.php', './immagini/iconaCliente.jpg', 'Modifica Dati Clienti', 0),
(7, 'Modifica Sezioni', './sezioni.php', './immagini/iconaSezioni.jpg', 'Modifica Sezioni', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `social`
--

CREATE TABLE `social` (
  `id` bigint NOT NULL,
  `social` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `social`
--

INSERT INTO `social` (`id`, `social`, `link`, `title`, `cancellato`) VALUES
(1, 'Facebook', 'https://www.facebook.com/?locale=it_IT', 'Seguici su Facebook', 0),
(2, 'Instagram', 'https://www.instagram.com/', 'Seguici su Instagram', 0),
(3, 'Twitter', 'https://twitter.com/?lang=it', 'Seguici su Twitter', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `idUtente` bigint NOT NULL,
  `username` varchar(50) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `cancellato` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`idUtente`, `username`, `psw`, `cancellato`) VALUES
(1, 'simone', '$2y$10$s/JSl3az1OWOIA5k9WxVZ.WUwTLdntrIGIqU371jUymlyoR.9joxi', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `progetti`
--
ALTER TABLE `progetti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `recapiti`
--
ALTER TABLE `recapiti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sezioni`
--
ALTER TABLE `sezioni`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `progetti`
--
ALTER TABLE `progetti`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `recapiti`
--
ALTER TABLE `recapiti`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `sezioni`
--
ALTER TABLE `sezioni`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `social`
--
ALTER TABLE `social`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `idUtente` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
