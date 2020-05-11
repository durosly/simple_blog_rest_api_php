-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 06:31 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Fashion', '2020-05-08 13:52:15'),
(2, 'Sport', '2020-05-08 13:52:15'),
(3, 'Technology', '2020-05-08 13:52:15'),
(4, 'Farming', '2020-05-08 13:52:15'),
(5, 'Cooking', '2020-05-08 13:52:15'),
(6, 'Fiction', '2020-05-08 13:52:15'),
(7, 'News', '2020-05-11 09:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `author`, `body`, `category_id`, `created_at`) VALUES
(1, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 2, '2019-06-03 04:22:05'),
(3, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 4, '2020-02-11 14:07:18'),
(4, 'Working with php', 'duro sly', 'PHP is a great languange. It\\\'s great to work with PHP as it makes you more efficient with programming at a general level', 3, '2020-02-29 04:20:07'),
(5, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 2, '2020-05-08 13:58:20'),
(6, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 6, '2020-05-08 13:58:21'),
(9, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 4, '2020-05-08 13:59:00'),
(10, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 1, '2020-05-08 13:59:00'),
(11, 'lorem ip sum', 'gucci', 'Lorem ip sum and the rest of the world trying to make it a better place by being a good programmer and try out some new stuff and building an api with a simple postman tool on a windows 7 machine.', 3, '2020-05-08 13:59:00'),
(12, 'Working with php', 'duro sly', 'PHP is a great languange. It\\\'s great to work with PHP as it makes you more efficient with programming at a general level', 3, '2020-05-09 12:46:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_2` (`name`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
