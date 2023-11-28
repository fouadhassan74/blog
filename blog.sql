-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 06:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(3, 'wild life', 'undomesticated animal species, but has come to include all organisms that grow or live wild in an area without being introduced by humans'),
(4, 'Travel', 'the movement of people between distant geographical locations'),
(5, 'science &amp; technology', 'the pursuit and application of knowledge and understanding of the natural and social world following a systematic methodology based on evidence.'),
(7, 'Music', 'an art of sound in time that expresses ideas and emotions in significant forms through the elements of rhythm, melody, harmony, and color'),
(8, 'Uncategorised', 'this is a test');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `thumbnails` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `date_time`, `thumbnails`, `category_id`, `author_id`, `is_featured`) VALUES
(7, 'post1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, ad accusantium? Fugiat aliquid sunt quod, aperiam ab nisi rem omnis accusantium officia quidem vero soluta quos facilis, expedita consectetur accusamus.\r\n', '2023-11-27 13:45:20', '1701092720blog1.jpg', 3, 1700832613, 0),
(9, 'nooo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi corrupti ea ex molestias facilis placeat,\r\nperspiciatis ad? Ullam, iusto officia esse, delectus consectetur, tenetur sint non perferendis dolorem mollitia natus!', '2023-11-27 15:33:38', '1701099218avatar17.jpg', 4, 1700832613, 0),
(10, 'nnnoooooo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi corrupti ea ex molestias facilis placeat,\r\nperspiciatis ad? Ullam, iusto officia esse, delectus consectetur, tenetur sint non perferendis dolorem mollitia natus!', '2023-11-27 15:34:01', '1701099241blog21.jpg', 7, 1701092179, 0),
(11, 'nooooo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi corrupti ea ex molestias facilis placeat,\r\nperspiciatis ad? Ullam, iusto officia esse, delectus consectetur, tenetur sint non perferendis dolorem mollitia natus!', '2023-11-27 15:34:17', '1701099257blog15.jpg', 5, 1700832613, 0),
(12, 'noooooooo', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi corrupti ea ex molestias facilis placeat,\r\nperspiciatis ad? Ullam, iusto officia esse, delectus consectetur, tenetur sint non perferendis dolorem mollitia natus!', '2023-11-27 15:34:45', '1701099285blog14.jpg', 7, 1700832613, 0),
(13, 'nnnnnn', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi corrupti ea ex molestias facilis placeat,\r\nperspiciatis ad? Ullam, iusto officia esse, delectus consectetur, tenetur sint non perferendis dolorem mollitia natus!', '2023-11-27 15:35:06', '1701099306blog11.jpg', 3, 1700832613, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `avatar`, `is_admin`) VALUES
(1700832613, 'Fouad', 'Hassan', 'fouadhassan74', 'fuad16020@gmail.com', '$2y$10$oUzDismswcqowgq.mqzsKeFxk9Cxdw7InMBmGFXBCPJtH3zYoTdlq', '1701091912avatar11.jpg', 1),
(1701092179, 'Fouad2', 'Hassan', 'fouadhassan1', 'fuad1@gmail.com', '$2y$10$06bCl.As86OwRZqx8rdct.odZTb73xT4oLd.vRsUatsdlZ4KjnFSK', '1701092179avatar8.jpg', 1),
(1701092180, 'Fouad3', 'Hassan', 'fouadhassan3', 'fuad3@gmail.com', '$2y$10$.2CGqIR2QJ.Z66Z/esu9h.k4G8sfESAihVUCXq5cP5wkdszLywUjS', '1701092271avatar15.jpg', 1),
(1701092181, 'Fouad4', 'Hassan', 'fouadhassan4', 'fuad4@gmail.com', '$2y$10$rorjHuRtraxwfRpgvnRKme4lklg95UqaXmM0sTfdelFntNr1gkQYq', '1701092397avatar10.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_blog_category` (`category_id`),
  ADD KEY `FK_blog_author` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1701092182;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_blog_author` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_blog_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
