-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2021 at 11:15 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jamify`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `bio` varchar(4000) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date_of_birth` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `bio`, `gender`, `name`, `date_of_birth`) VALUES
(5, 'The Prodigy navigated the high wire, balancing artistic merit and mainstream visibility with more flair than any electronica act of the 1990s. Ably defeating the image-unconscious attitude of most electronic artists in favor of a focus on frontmen Keith Flint and Maxim Reality, the group crossed over to the mainstream of pop music with an incendiary live experience that approximated the original a', 'Male', 'Keith Flint', '1969-09-17'),
(7, 'Calvin Cordozar Broadus Jr. (born October 20, 1971), known professionally as Snoop Dogg (previously Snoop Doggy Dogg and briefly Snoop Lion),[note 1] is an American rapper, songwriter, media personality, actor, and businessman. His fame dates to 1992 when he featured on Dr. Dre\'s debut solo single, \"Deep Cover,\" and then on Dre\'s debut solo album, The Chronic. Broadus has since sold over 23 million albums in the United States and 35 million albums worldwide.[4][5]\r\n\r\nBroadus\' debut solo album, Doggystyle, produced by Dr. Dre, was released by Death Row Records in November 1993, and debuted at number one on the popular albums chart, the Billboard 200, and on Billboard\'s Top R&B/Hip-Hop Albums chart. Selling 800,000 copies in its first week, Doggystyle was certified quadruple-platinum in 1994 and bore several hit singles, including \"What\'s My Name?\" and \"Gin & Juice.\" In 1994, Death Row Records released a soundtrack, by Broadus, for the short film Murder Was the Case, starring Snoop. In 1996, his second album, Tha Doggfather, also debuted at number one on both charts, with \"Snoop\'s Upside Ya Head\" as the lead single. The next year, the album was certified double-platinum.', 'Male', 'Snoop Dogg', '1971-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Electropunk'),
(2, 'Rap');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `creation_date`, `user_id`) VALUES
(1, 'SailinThroughOuterSpace', '2021-11-12', 24),
(2, 'SmackItUp', '2021-11-12', 25);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_content`
--

CREATE TABLE `playlist_content` (
  `playlist_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `release_date` date NOT NULL,
  `artist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `category_id`, `release_date`, `artist_id`) VALUES
(26, 'Smack my bitch up', 1, '1997-11-17', 5),
(27, 'The Day Is My Enemy', 1, '2015-01-26', 5),
(28, 'Take Me to the Hospital', 1, '2009-08-31', 5),
(29, 'Vato', 2, '2006-08-30', 7),
(30, 'Holidae In', 2, '2003-08-25', 7),
(32, 'The Next Episode', 2, '2021-11-09', 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `mail`, `password`, `first_name`) VALUES
(24, 'O Reilly', 'joreilly@gmail.com', '1234', 'John'),
(25, 'Tiernan', 'ttiernan22@gmail.com', '3333', 'Tommy'),
(26, 'Redmond', 'jredmond@gmail.com', '1234', 'John'),
(27, 'Doherty', 'pdoherty@gmail.com', '4321', 'Pete');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD PRIMARY KEY (`playlist_id`,`song_id`),
  ADD KEY `song_id` (`song_id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlist_content`
--
ALTER TABLE `playlist_content`
  MODIFY `playlist_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD CONSTRAINT `playlist_content_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  ADD CONSTRAINT `playlist_content_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
