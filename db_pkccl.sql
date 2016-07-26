-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2016 at 01:40 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pkccl`
--

-- --------------------------------------------------------

--
-- Table structure for table `easy_upload`
--

CREATE TABLE `easy_upload` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photos` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `easy_upload`
--

INSERT INTO `easy_upload` (`id`, `name`, `surname`, `photo`, `photos`) VALUES
(12, 'f', 's', '7aae5da3d079a3aa30f1715fcf067e41.jpg', NULL),
(13, 'a', 'a', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1469115612),
('m160721_153319_create_upload', 1469115617);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `h_news` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `h_news`, `detail`, `photo`) VALUES
(44, 'asd', '<p>asd</p>\r\n', '763f152dd1593eb01d4e7812a2147179.jpg'),
(45, 'ddddd', '<p><strong>nhhhhhhhh</strong></p>\r\n', '591cff3441cbffdf9b607b1dfad1f939.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `price_buy` float NOT NULL,
  `price_sale` float NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` enum('show','hide') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `price_buy`, `price_sale`, `img`, `status`, `created_at`) VALUES
(15, 'sssss', '<p>q</p>\r\n', 1, 1, 'images.jpg', 'show', '2016-07-20 12:07:58'),
(17, 'sssss1', '', 2221110000000, 111111000000000, '4KR-CLK00-03-BL.jpg', 'show', '2016-07-20 12:21:58'),
(19, 'รยสัทด่', '', 0, 333333, '20160720829651382jpg', 'show', '2016-07-20 12:47:33'),
(20, 'ddddd', '', 0, 2222, '20160720901448629jpg', 'show', '2016-07-20 12:47:52'),
(21, 'pod', '', 666, 6666, '20160720961267553jpg', 'show', '2016-07-20 12:48:15'),
(22, 'ssssssssssss', '', 2, 2, '20160720.747478475jpg', 'show', '2016-07-20 12:50:11'),
(23, '1', '<p>1</p>\r\n', 1, 1, '201607201583106551.jpg', 'show', '2016-07-20 12:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `files` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `title`, `content`, `image`, `files`) VALUES
(2, 'a', 'aaaa', '4KR-CLK00-03-BL.jpg', ''),
(3, 'hhh', '''''''dddd', 'images.jpg', ''),
(4, 'dddd', 'xxx', '4KR-CLK00-03-BL.jpg', ''),
(5, 'ddddddddd', '', 'images.jpg', ''),
(6, 'aaa', '', '4KR-CLK00-03-BL.jpg', ''),
(7, 'kkkkkk', '', '4KR-CLK00-03-BL.jpg', ''),
(8, 'fffffffffffffff', '', 'images.jpg', ''),
(9, 'hhhhhhhhhhhhhh', '', 'images.jpg', ''),
(10, 'xsazzzz', '', '', '373cb94dba59bdc.jpg,08a69376d62dea3.jpg'),
(11, 'fffffffffffffff', '', '4KR-CLK00-03-BL.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `usr` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `level` enum('admin','manager') NOT NULL,
  `status` enum('open','close') DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `usr`, `pwd`, `level`, `status`) VALUES
(1, 'พเยาว์  สนพลาย', 'admin', 'admin', 'admin', 'open'),
(2, 'u', 'q', 'q', 'manager', 'open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `easy_upload`
--
ALTER TABLE `easy_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `easy_upload`
--
ALTER TABLE `easy_upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
