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
-- Database: `Sql1794998_2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `dati_clienti`
--

CREATE TABLE `dati_clienti` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dati_personali` smallint DEFAULT NULL,
  `messaggio` varchar(255) NOT NULL,
  `cancellato` smallint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `dati_clienti`
--

INSERT INTO `dati_clienti` (`id`, `nome`, `cognome`, `email`, `dati_personali`, `messaggio`, `cancellato`) VALUES
(1, 'Simone', 'Nencioni', 'miosito@gmail.com', 0, 'ciao!', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dati_clienti`
--
ALTER TABLE `dati_clienti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dati_clienti`
--
ALTER TABLE `dati_clienti`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
