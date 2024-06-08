-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2024 at 05:06 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040045`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_table`
--

CREATE TABLE `data_table` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `film` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `actors` varchar(255) NOT NULL,
  `directors` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `film`, `genre`, `actors`, `directors`, `image`) VALUES
(1, 'fast and the furious', 'action, crime', 'vin diesel, paul walker, michelle rodriguez, jordana brewster, johnny strong, matt schulze, chad lindberg', 'rob cohen', 'ff1.jpg'),
(2, '2 fast 2 furious', 'action, crime', 'paul walker, tyrese gibson, devon aoki, cole hauser, eva mendes, ludacris', 'john singleton', 'ff2.jpg'),
(3, ' tokyo drift', 'action, crime', 'lucas black, sung kang, brian tee, nathalie kelley, bow wow ', 'justin lin', 'tokyodrift.jpg'),
(4, 'fast & furious 4', 'action, crime', 'vin diesel, paul walker, jordana brewster, gal gadot, sung kang', 'justin lin', 'ff4.jpg'),
(5, 'fast five', 'action, crime', 'vin diesel, paul walker,gal gadot, elsa pataky, jordana brewster, dwayne johnson, sung kang', 'justin lin', 'fastfive.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `movie_id` int DEFAULT NULL,
  `review` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '$2y$10$rWSXHsezBnWLQ/F5UR.83OQVwAqL9KgX50Okn5UUF4QU8alq70aP6', 'admin'),
(7, 'registrasi1', '$2y$10$xH4ZWW4X0VPtY75cLqNm.O9/L0Yvhjn5muWJZDSJ/eXFb/BG.Bboq', 'admin'),
(8, 'registrasi1', '$2y$10$.AvmhncNKrhmr.SAnpNLmuxrdM/8AWee1hpG4h78Ccoqd6t.6Q3za', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_table`
--
ALTER TABLE `data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_table`
--
ALTER TABLE `data_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
