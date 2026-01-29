-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 29, 2026 at 10:36 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gazetka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `in_month` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `content`
--

CREATE TABLE `content` (
  `title` text DEFAULT NULL,
  `title_desc` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `e_mail` text DEFAULT NULL,
  `footer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`title`, `title_desc`, `about`, `contact`, `e_mail`, `footer`) VALUES
('Parafia Świętej Rodziny', 'Gazetka Parafialna: Głos Naszej Wspólnoty', 'Nasza gazetka parafialna jest owocem wspólnej pracy i pragnienia budowania więzi wewnątrz Parafii Świętej Rodziny. Każde wydanie to nie tylko kronika wydarzeń, ale przede wszystkim przestrzeń do pogłębiania wiary, dzielenia się Słowem Bożym i świadectwem życia chrześcijańskiego.', 'Zachęcamy do przesyłania propozycji artykułów, zdjęć oraz świadectw. Państwa głos jest dla nas niezwykle cenny.', 'gazetka@parafiaretkinia.pl', '© 2026 Parafia Świętej Rodziny. Piękno tradycji w służbie wspólnocie.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `editors`
--

CREATE TABLE `editors` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `editors`
--

INSERT INTO `editors` (`id`, `role_id`, `name`) VALUES
(1, 1, 'Ks. proboszcz Ireneusz Węgrzyn'),
(2, 2, 'Marcin Mikołajczyk'),
(3, 3, 'Młodzi z duszpasterstwa \"El Retkinio\"'),
(4, 3, 'Każdy chętny Parafianin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Opieka duchowa'),
(2, 'Główny koordynator'),
(3, 'Redaktorzy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$mesq2Bz4gsdV7hWWeZGYCOdz9qdfC9hC0rJB/BQXT5TIBojhXiPKK');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editors`
--
ALTER TABLE `editors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `editors`
--
ALTER TABLE `editors`
  ADD CONSTRAINT `editors_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
