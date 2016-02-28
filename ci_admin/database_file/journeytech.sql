-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2016 at 01:08 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `journeytech`
--

-- --------------------------------------------------------

--
-- Table structure for table `home_tbl`
--

CREATE TABLE `home_tbl` (
  `id` int(11) NOT NULL,
  `heading_img_url` varchar(200) DEFAULT NULL,
  `heading_text` text,
  `news_one_title` varchar(200) DEFAULT NULL,
  `news_one_text` text,
  `news_img_url` varchar(200) DEFAULT NULL,
  `news_two_title` varchar(200) DEFAULT NULL,
  `news_two_text` text,
  `news_two_img_url` varchar(200) DEFAULT NULL,
  `news_three_title` varchar(200) DEFAULT NULL,
  `news_three_text` text,
  `news_three_img_url` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `description_text` text,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home_tbl`
--

INSERT INTO `home_tbl` (`id`, `heading_img_url`, `heading_text`, `news_one_title`, `news_one_text`, `news_img_url`, `news_two_title`, `news_two_text`, `news_two_img_url`, `news_three_title`, `news_three_text`, `news_three_img_url`, `description`, `description_text`, `datetimestamp`) VALUES
(1, 'test/test', 'This is the heading text', 'This is the news one title', 'This is the news one text', 'This is the news one image url', 'This is the news two title', 'This is the news two text', 'This is the news two image url', 'This is the news three title', 'This is the news three text', 'This is the news three image url', 'This is the description', 'This is the description URl', '2016-02-27 23:45:30'),
(4, 'Chrysanthemum.jpg', 'This is the heading text', 'This is the news one title', 'This is the news one text', 'Desert.jpg', 'This is the news two title', 'This is the news two text', 'Desert.jpg', 'This is the news three title', 'This is the news three text', 'Hydrangeas.jpg', 'This is the description', 'This is the description text', '2016-02-28 00:07:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `home_tbl`
--
ALTER TABLE `home_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home_tbl`
--
ALTER TABLE `home_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
