-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2020 at 05:50 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lunch`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `best_before` date NOT NULL,
  `use_by` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `title`, `best_before`, `use_by`) VALUES
(1, 'Ham', '2019-03-25', '2019-03-27'),
(2, 'Butter', '2020-03-13', '2020-03-16'),
(3, 'Cheese', '2020-03-14', '2020-03-17'),
(4, 'Bread', '2020-03-14', '2020-03-17'),
(5, 'Bacon', '2020-03-15', '2020-03-17'),
(6, 'Eggs', '2020-03-15', '2020-03-17'),
(7, 'Mushrooms', '2020-03-14', '2020-03-16'),
(8, 'Sausage', '2020-03-14', '2020-03-17'),
(9, 'Hotdog Bun', '2020-03-14', '2020-03-17'),
(10, 'Mustard', '2020-03-16', '2020-03-17'),
(11, 'Lettuce', '2020-03-16', '2020-03-17'),
(12, 'Tomato', '2020-03-15', '2020-03-17'),
(13, 'Cucumber', '2020-03-14', '2020-03-17'),
(14, 'Beetroot', '2020-03-13', '2020-03-16'),
(15, 'Ketchup', '2020-03-16', '2020-03-17'),
(16, 'Salad Dressing', '2020-03-16', '2020-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `ingredients`) VALUES
(1, 'Ham and Cheese Toastie', 'a:4:{i:0;s:3:\"Ham\";i:1;s:6:\"Cheese\";i:2;s:5:\"Bread\";i:3;s:6:\"Butter\";}'),
(2, 'Fry-up', 'a:6:{i:0;s:5:\"Bacon\";i:1;s:4:\"Eggs\";i:2;s:11:\"Baked Beans\";i:3;s:9:\"Mushrooms\";i:4;s:7:\"Sausage\";i:5;s:5:\"Bread\";}'),
(3, 'Salad', 'a:5:{i:0;s:7:\"Lettuce\";i:1;s:6:\"Tomato\";i:2;s:8:\"Cucumber\";i:3;s:8:\"Beetroot\";i:4;s:14:\"Salad Dressing\";}'),
(4, 'Hotdog', 'a:4:{i:0;s:10:\"Hotdog Bun\";i:1;s:7:\"Sausage\";i:2;s:7:\"Ketchup\";i:3;s:7:\"Mustard\";}');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
