-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2020 at 08:35 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pername` varchar(60) NOT NULL,
  `addedBy` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `bio` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `datetime`, `username`, `password`, `pername`, `addedBy`, `image`, `bio`) VALUES
(18, 'Date : 2020/07/09 08:22:10pm', 'felix ', '12345', 'edward ', 'yasin', 'leon.jpg', 'gghghgh'),
(20, 'Date : 2020/07/09 08:30:06pm', 'Gondor ', '12345', 'Frodo ', 'yasin', '', ''),
(21, 'Date : 2020/07/09 08:31:46pm', 'gandalf2', '12345', 'leon ', 'yasin', 'Gandalf.jpg', '                                                                                                                                                                                    i am php developer and i am working on laravel right now thanks for reading my bio.                                                                                                                                                                                                                                             '),
(22, 'Date : 2020/07/09 08:32:14pm', 'gandalf 2', '12345', 'gandalf ', 'yasin', 'Gandalf.jpg', '                                                                                                                                                        You can\'t pass here. ..                                                                                                                                                                                         '),
(23, 'Date : 2020/07/10 08:16:18pm', 'sauron ', '12345', 'cabbar ', 'matrix ', '', ''),
(24, 'Date : 2020/07/12 03:47:05pm', 'ysncmc', '12345', 'yasin ', 'matrix ', '', '                                                            This is my status                                                                                                 ');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(2, 'Temizlik Ürünleri ', 'yasin', 'Date : 2020/06/24 --  04:50:29pm'),
(4, 'Teknoloji Urunleri', 'yasin', 'Date : 2020/06/24 --  05:37:23pm'),
(5, 'kategori', 'yasin', 'Date : 2020/06/24 --  08:28:51pm'),
(8, 'Giysi ', 'yasin', 'Date : 2020/06/26 --  10:58:31pm'),
(10, 'Bilgisayarlar ', 'yasin', 'Date : 2020/07/07 --  12:18:27am'),
(12, 'Game computers ', 'Gondor ', 'Date : 2020/07/10 --  08:28:14pm'),
(13, 'Esarplar ', 'Saruman_xx', 'Date : 2020/07/10 --  08:54:56pm'),
(14, 'Gomlekler ', 'matrix ', 'Date : 2020/07/12 --  02:58:44pm'),
(16, 'NewCategory ', 'matrix ', 'Date : 2020/07/13 --  02:46:38pm'),
(17, 'Telefonlar ', 'matrix ', 'Date : 2020/07/13 --  07:45:10pm');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `com_id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` varchar(700) NOT NULL,
  `approvedBy` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`com_id`, `datetime`, `name`, `email`, `comment`, `approvedBy`, `status`, `post_id`) VALUES
(7, '2020-07-06 09:44:51am', 'Hanna ', 'hanna2017@gmail.com', 'this is for hanna ', 'pending', 'off', 20),
(12, '2020-07-06 10:52:41am', 'Yasin Cimic', 'yasincmc2017@gmail.com', 'vd jnvjdnjvdnvn', 'matrix ', 'on', 13),
(15, '2020-07-06 10:44:01pm', 'Tina ', 'tina@yahoo.com', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'matrix ', 'off', 13),
(18, '2020-07-06 10:47:30pm', 'Sarah', 'sarah@gmail.com', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', 'matrix ', 'on', 13),
(20, '2020-07-10 12:28:56pm', 'yasin Cimic', 'yasincmc2012@gmail.com', 'flmlfdmvkmkmk mkfmvkmfkmvkmf mmkmk na mkfm', 'matrix ', 'on', 5),
(21, '2020-07-14 12:04:10pm', 'yasin Cimic', 'yasincmc2012@gmail.com', 'bsdjsbabdhsbd', 'matrix ', 'on', 2),
(22, '2020-07-16 07:41:34pm', 'Ekrem ', 'ovali ', 'this is post', 'gandalf2', 'on', 11);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `date`, `title`, `category`, `author`, `image`, `post`) VALUES
(2, 'Date : 2020/06/24 05:36:07pm', 'Example3', 'Beyaz Esya', 'yasin', 'street.jpg', 'This is text'),
(4, 'Date : 2020/06/25 09:59:46pm', 'Araba hakkinda ', 'Arabalar', 'yasin', 'birdonthetree.jpg', 'This text is about cars.'),
(5, 'Date : 2020/06/26 09:02:39pm', 'example 5', 'Teknoloji Urunleri', 'yasin', 'jar.jpg', 'This is text'),
(8, 'Date : 2020/06/26 11:10:40pm', 'jhbhbsd', 'kategori', 'yasin', 'glass.jpg', 'bsdhjbdshjbd'),
(9, 'Date : 2020/06/27 01:17:02pm', 'Bu baslik deneme icin kullanilacaktir', 'Takı Esyalari', 'yasin', 'jar.jpg', 'This is text'),
(10, 'Date : 2020/06/27 01:35:58pm', 'About Garden Stufss ', 'Garden Stuffs', 'yasinxxxxxxxxxxx', 'glass.jpg', 'This text is about garden stuffs'),
(11, 'Date : 2020/06/28 08:27:08pm', 'Lorem ipsum dolor sit amet', 'Temizlik Ürünleri', 'yasinxxxxxxxxxxx', 'street.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat rutrum lacus, ac efficitur justo congue quis. Praesent eget nisl nibh. Curabitur porta turpis vel ipsum viverra ornare. Etiam vel purus in erat mollis porttitor a a justo. Praesent dui elit, pulvinar quis fermentum luctus, tincidunt eget libero. Sed malesuada mi a urna scelerisque interdum. '),
(13, 'Date : 2020/06/28 09:04:47pm', 'postTitle ', 'Takı Esyalari', 'yasin', 'street.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat rutrum lacus, ac efficitur justo congue quis. Praesent eget nisl nibh. Curabitur porta turpis vel ipsum viverra ornare. Etiam vel purus in erat mollis porttitor a a justo. Praesent dui elit, pulvinar quis fermentum luctus, tincidunt eget libero. '),
(20, 'Date : 2020/07/04 02:11:06pm', 'sdjsdjnsd', 'Takı Esyalari', 'yasin', 'plane.jpg', 'shdjhsdjhsjd'),
(23, 'Date : 2020/07/04 03:49:07pm', 'jsjnsjdnjs', 'Araclar', 'yasin', 'arm.jpg', 'sddssdsd'),
(27, 'Date : 2020/07/14 05:03:42pm', 'this is new post ', 'Giysi', 'matrix ', 'ingi-haraldss-XnkK88K2bao-unsplash.jpg', 'i will use this page for trying ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `foreign_relation` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
