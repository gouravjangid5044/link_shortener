-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2023 at 07:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `link`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int(11) UNSIGNED NOT NULL,
  `short_url` varchar(7) NOT NULL,
  `original_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `short_url`, `original_url`) VALUES
(2, 'ANvTx0', 'https://gouravjangid.com'),
(3, 'Fp1x1o', 'https://gouravjangid.com'),
(4, 'Wqx6XI', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(5, 'QFuwQn', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(6, 'mgNKGr', 'https://gouravjangid.com'),
(7, 'b1y6wx', 'https://gouravjangid.com'),
(8, 'SZziGy', 'https://gouravjangid.com'),
(9, 's2T0X2', 'https://gouravjangid.com'),
(10, '5sEeeA', 'https://gouravjangid.com'),
(11, 'rnbE6A', 'https://gouravjangid.com'),
(12, '5p3VRh', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(13, '7WDV4w', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(14, 'uFrlRs', 'https://gouravjangid.com'),
(15, 'Ku7ztn', 'https://gouravjangid.com'),
(16, 'Caf1NO', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(17, 'C5fWtp', 'https://gouravjangid.com'),
(18, 'zHVQol', 'https://gouravjangid.com'),
(19, '9tMSgt', 'https://www.youtube.com/results?search_query=chillerlan%2Fphp-qrcode'),
(22, 'Q1C(Tb', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov'),
(23, '56qDSK', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov'),
(24, 'EDuzTj', 'https://www.calculatorsoup.com/calculators/discretemathematics/combinations.php'),
(25, 'e8B$P2', 'https://www.calculatorsoup.com/calculators/discretemathematics/combinations.php'),
(27, 'V$cOxs', 'https://www.calculatorsoup.com/calculators/discretemathematics/combinations.php'),
(28, 'v@cE4b', 'https://www.youtube.com/watch?v=7QdDsHVLxgg'),
(29, 'a=WT@)', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov'),
(30, 'ZuS=M1f', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(31, 'YW(c92k', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov'),
(32, 'zdgZww6', 'https://codecanyon.net/item/belink-ultimate-url-shortener/24354590'),
(33, 'NZ@P(ll', 'https://www.calculatorsoup.com/calculators/discretemathematics/combinations.php'),
(34, 'WpB-OUs', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov'),
(35, 'YblZ$bf', 'https://stackoverflow.com/questions/29856126/styling-a-inputs-background-color-and-removing-the-disabled-red-circle-when-hov');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `short_url` (`short_url`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
