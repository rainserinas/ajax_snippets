-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 07:14 AM
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
-- Table structure for table `about_tbl`
--

CREATE TABLE `about_tbl` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `about_text` text,
  `side_img_url` varchar(200) DEFAULT NULL,
  `tagline` varchar(200) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_tbl`
--

INSERT INTO `about_tbl` (`id`, `title`, `about_text`, `side_img_url`, `tagline`, `datetimestamp`) VALUES
(1, 'Innovating Transport and Logistic Industry', 'Journey Tech is part of a group of companies that are involved in IT, risk management, business consultancy and outsourced business processing. Journey Tech is an IT company that provides innovative business solutions to the motoring, transport and logistics industry. Our Management Team has solid local and international experience which gives them the expertise to offer world class services.\r\n\r\nOur products and services are pioneers in its field which enables our customers to offer better services. We aim to transform business issues to opportunities by integrating process and providing better internal controls thereby enhance their company image and build customer loyalty.\r\n\r\nWe differentiate ourselves by getting involved in every stage from learning the business cycle, identifying the requirement, develop the IT solution, project management, IT systems design, implementation to support and ensure that all expectations are met.\r\n\r\nWe are all about partnership - understanding our customer, designing the right solution and delivering results.', 'about/About_us.png', 'No Tagline', '2016-02-29 16:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `careers_tbl`
--

CREATE TABLE `careers_tbl` (
  `id` int(11) NOT NULL,
  `career_img_url` varchar(200) DEFAULT NULL,
  `job_title` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `careers_tbl`
--

INSERT INTO `careers_tbl` (`id`, `career_img_url`, `job_title`, `status`, `datetimestamp`) VALUES
(5, 'careers/Lighthouse.jpg', 'This is the job title', 1, '2016-02-29 17:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `clients_tbl`
--

CREATE TABLE `clients_tbl` (
  `id` int(11) NOT NULL,
  `client_img_url` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients_tbl`
--

INSERT INTO `clients_tbl` (`id`, `client_img_url`, `status`, `datetimestamp`) VALUES
(2, 'clients/deadpool-keep-calm-and-kill-everyone.jpg', 1, '2016-02-29 18:09:01'),
(3, 'clients/6973463-batman-hd-wallpaper.jpg', 1, '2016-02-29 18:09:07'),
(4, 'clients/12248141_10153395221433585_6303502925689868254_o.jpg', 0, '2016-03-02 03:29:56');

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
(4, 'home/homebanner.png', 'Heading', 'Lorem Ipsum', 'simply dummy text of the printing and typesetting industry', 'home/1.png', 'Lorem Ipsum', 'simply dummy text of the printing and typesetting industry', 'home/2.png', 'Lorem Ipsum', 'simply dummy text of the printing and typesetting industry', 'home/3.png', 'Desc', 'Desc Text', '2016-02-28 16:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`id`, `username`, `password`, `status`, `datetimestamp`) VALUES
(1, 'admin', 'admin', 1, '2016-02-29 18:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `pageview_tbl`
--

CREATE TABLE `pageview_tbl` (
  `id` int(11) NOT NULL,
  `page_count` int(11) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pageview_tbl`
--

INSERT INTO `pageview_tbl` (`id`, `page_count`, `datetimestamp`) VALUES
(1, 3, '2016-03-04 05:35:06');

-- --------------------------------------------------------

--
-- Table structure for table `pas_tbl`
--

CREATE TABLE `pas_tbl` (
  `id` int(11) NOT NULL,
  `product_img_url` varchar(200) DEFAULT NULL,
  `product_description` text,
  `status` int(11) DEFAULT NULL,
  `datetimestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pas_tbl`
--

INSERT INTO `pas_tbl` (`id`, `product_img_url`, `product_description`, `status`, `datetimestamp`) VALUES
(1, 'pas/Jellyfish.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 0, '2016-02-29 17:14:06'),
(2, 'pas/Desert.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, '2016-02-29 17:15:34'),
(3, 'pas/ampslogo.png', 'AMPS', 1, '2016-02-29 22:41:57'),
(4, 'pas/attslogo.jpg', 'ATTS', 1, '2016-02-29 22:42:15'),
(5, 'pas/bikeprotect.png', 'Bike Proctect', 1, '2016-02-29 22:42:30'),
(6, 'pas/marklogo.png', 'MARK', 1, '2016-02-29 22:42:44'),
(7, 'pas/trucargo.png', 'Tru Cargo', 1, '2016-02-29 22:42:56'),
(8, 'pas/hulibus.png', 'HULIBUS', 0, '2016-02-29 22:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_tbl`
--
ALTER TABLE `about_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers_tbl`
--
ALTER TABLE `careers_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_tbl`
--
ALTER TABLE `clients_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_tbl`
--
ALTER TABLE `home_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pageview_tbl`
--
ALTER TABLE `pageview_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pas_tbl`
--
ALTER TABLE `pas_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_tbl`
--
ALTER TABLE `about_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `careers_tbl`
--
ALTER TABLE `careers_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clients_tbl`
--
ALTER TABLE `clients_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `home_tbl`
--
ALTER TABLE `home_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pageview_tbl`
--
ALTER TABLE `pageview_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pas_tbl`
--
ALTER TABLE `pas_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
