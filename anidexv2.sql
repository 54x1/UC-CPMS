-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2020 at 10:03 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anidexv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `anibase`
--

CREATE TABLE `anibase` (
  `animeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `animename` varchar(255) NOT NULL,
  `episodes` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `imageup` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anibase`
--

INSERT INTO `anibase` (`animeid`, `userid`, `animename`, `episodes`, `image`, `imageup`) VALUES
(62, 1, 'bleach', 1, 'uploads/bleach.png', ''),
(63, 1, 'ouran high school host club', 1, 'uploads/download.jpg', ''),
(64, 1, 'nana', 1, 'uploads/nana.jpg', ''),
(65, 1, 'FMA', 1, 'uploads/images.jpg', ''),
(66, 1, 'naruto', 1, 'uploads/naruto.jpg', ''),
(67, 1, 'one piece', 1, 'uploads/one.jpeg', ''),
(68, 1, 'K', 1, 'https://879ed873-madman-com-au.akamaized.net/media/Series/17312/17312-763276.jpg', ''),
(69, 1, 'Psycho-Pass', 1, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcS1tvp8B_kGlyW-OMWI0HFS0ZWJ0HUB3mDrzn3fkJTRODonYbnL', ''),
(73, 3, 'ouran high school host club', 0, 'uploads/download.jpg', ''),
(78, 3, 'The God of High School', 1, 'https://cdn.myanimelist.net/images/anime/1722/107269.jpg', ''),
(84, 3, 'from the new world', 1, 'https://cdn.myanimelist.net/s/common/store/cover/1762/eb1d88201446f394ce5ec0337aa750a1648fc49ad659877c4ea252e48f8b148d/l.jpg', ''),
(90, 3, 'ouran high school host club', 50, 'https://m.media-amazon.com/images/M/MV5BOTg5NTE2ODA2Nl5BMl5BanBnXkFtZTcwNzY3NDg5MQ@@._V1_UY1200_CR111,0,630,1200_AL_.jpg', ''),
(126, 3, 'Deca-Dence', 50, 'https://cdn.myanimelist.net/images/anime/1627/107552.jpg', '0'),
(132, 3, 'Deca-Dencev2', 21, 'https://cdn.myanimelist.net/images/anime/1627/107552.jpg', '0'),
(133, 3, 'Deca-Dencev1', 200, 'https://cdn.myanimelist.net/images/anime/1627/107552.jpg', '0'),
(134, 3, 'googleurltest', 50, 'www.google.com', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$10$m7QTIT6pyFXVfLD3SExeEOdViI6mg7akbYjf.WB6UP.cHh6knEksC'),
(2, 'test2', '$2y$10$wG.G10.Rjrerc2gGQJb2qOSvNAtjrNz.H9TpXFd9v8yofw.sgtPli'),
(3, 'new', '$2y$10$0nvhaw2yDREdkSlkmsR.gO1sJTNvcOfT.Wq7tBRNYVKntfXZiJyy.'),
(4, 'new2', '$2y$10$RJM4vnPHA3gbz0t30P7FceL6DpdupQGUCQHnpCwfBCC3p2LmilkHu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anibase`
--
ALTER TABLE `anibase`
  ADD PRIMARY KEY (`animeid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anibase`
--
ALTER TABLE `anibase`
  MODIFY `animeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
