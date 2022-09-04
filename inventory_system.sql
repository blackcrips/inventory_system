-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 09:45 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTableNames` (IN `tableName` VARCHAR(255))   SELECT
  	COLUMN_NAME
FROM
  	INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = tableName$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `clients_details`
--

CREATE TABLE `clients_details` (
  `id` int(10) NOT NULL,
  `store_name` varchar(150) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients_details`
--

INSERT INTO `clients_details` (`id`, `store_name`, `contact_person`, `contact_no`, `address`, `added_at`) VALUES
(2, 'Melitha store', '', '09456604655', '', '2022-06-10 21:18:26'),
(4, 'asdf', 'asdf', '5416545', '321', '2022-06-10 22:49:38'),
(5, 'asdf', 'asdf', '564654', '21321', '2022-06-10 22:52:46'),
(6, '231', '2323', '12315648', '2', '2022-06-10 22:55:10'),
(7, 'Melitha', 'Almerante', '0927222222', '2', '2022-06-10 22:55:33'),
(8, '1231231', '21321', '111111112', '2', '2022-06-10 23:00:05'),
(9, '321', '3211', '09276469652', '123456', '2022-06-10 23:03:21'),
(10, '21321331', '132213312', '09254554545', 'a', '2022-06-10 23:34:49'),
(23, 'Jimmy\'s Store', 'Jimmy', '09276469661', 'Katuparan Taguig', '2022-06-11 20:34:03'),
(24, 'hguiy', 'ygfuyfgf', '098087445', 'uftyddit7d7d87', '2022-06-11 20:59:21'),
(28, 'Kapuring Store', 'Aling puring', '24685768', 'Tondo manila', '2022-08-28 01:03:03');

-- --------------------------------------------------------

--
-- Table structure for table `lending`
--

CREATE TABLE `lending` (
  `id` int(6) NOT NULL,
  `borrower_name` varchar(50) NOT NULL,
  `borrow_date` varchar(50) NOT NULL,
  `borrow_amount` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lending`
--

INSERT INTO `lending` (`id`, `borrower_name`, `borrow_date`, `borrow_amount`, `status`, `added_at`) VALUES
(1, 'Joffrey', '2022-09-04', '500', 'active', '2022-09-04 00:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `products_name`
--

CREATE TABLE `products_name` (
  `id` int(20) NOT NULL,
  `category` varchar(150) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_description` varchar(150) NOT NULL,
  `product_code` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_name`
--

INSERT INTO `products_name` (`id`, `category`, `product_name`, `product_description`, `product_code`) VALUES
(2, 'Shampoo', 'Sunsilk', 'Green 3pcs', '123456'),
(6, 'Body wash', 'Safeguard', 'White 50ml', 'yhKXm'),
(9, 'Body wash', 'Safeguard', 'Goods :D', 'pCkAX'),
(16, 'Shampoo', 'Clear', 'Clear blue 3pcs per sachet', 'yZWJp'),
(18, 'Shampoo', 'Sunsilk', 'Green 3pcs per sachet', 'pmzjR'),
(19, 'Hard Disk', 'Seagate', '1TB', 'nIeCk'),
(22, 'Hard Disk', 'Toshiba', '500gb', 'am88Z'),
(23, 'Hard Disk', 'Toshiba', '1TB', 'Fvjyv'),
(24, 'Hard Disk', 'Seagate', '2TB', 'VxBVY'),
(25, 'Hard Disk', 'Toshiba', '3 TB', 'HfG3G'),
(26, 'Hard Disk', 'Toshiba', '3 TB', 'n8TK4'),
(27, 'Hard Disk', 'Toshiba', '4 TB', 'aUWw1'),
(28, 'Hard Disk', 'Toshiba', '5 TB', 'wuY1K');

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE `products_orders` (
  `id` int(10) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `price` int(10) NOT NULL,
  `product_code` varchar(25) NOT NULL,
  `client_id` varchar(25) NOT NULL,
  `remarks` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `added_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_orders`
--

INSERT INTO `products_orders` (`id`, `order_id`, `product_name`, `quantity`, `price`, `product_code`, `client_id`, `remarks`, `status`, `added_at`) VALUES
(1, '991453034466', 'Safeguard Goods :D', 'pCkAX', 1, '20.0055.00', '23', '', '', '2022-07-03'),
(2, '123831241115', 'Safeguard Goods :D', 'pCkAX', 1, '20.0055.00', '23', '', '', '2022-07-03'),
(3, '376928477344', 'Sunsilk Green 3pcs', '12345', 1, '55.0055.00', '23', '', '', '2022-07-03'),
(4, '034272143613', 'Sunsilk Green 3pcs', '12345', 1, '55.0055.00', '23', '', '', '2022-07-03'),
(5, '112318529478', 'Safeguard White 50ml', 'yhKXm', 1, '20.0050.00', '23', '', '', '2022-07-03'),
(6, '716322604218', 'Safeguard White 50ml', 'yhKXm', 1, '20.0050.00', '23', '', '', '2022-07-03'),
(7, '207458708551', 'Safeguard White 50ml', 'yhKXm', 1, '20.0055.00', '23', '', '', '2022-07-03'),
(8, '616654349748', 'Safeguard White 50ml', 'yhKXm', 1, '20.0055.00', '23', '', '', '2022-07-03'),
(9, '348195085309', 'Sunsilk Green 3pcs', '12345', 1, '55.0050.00', '23', '', '', '2022-07-04'),
(10, '348195085309', 'Sunsilk Green 3pcs', '12345', 1, '55.0050.00', '23', '', '', '2022-07-04'),
(11, '563108553973', 'Sunsilk Green 3pcs', '12345', 1, '55.0020.00', '23', '', '', '2022-07-06'),
(12, '496961654942', 'Sunsilk Green 3pcs', '12345', 1, '55.0020.00', '23', '', '', '2022-07-03'),
(13, '183299007726', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(14, '614999901548', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(15, '309785877813', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-03'),
(16, '956904204493', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-30'),
(17, '132911184191', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-12'),
(18, '175406505305', 'Clear Clear blue 3pcs per sachet', 'yZWJp', 1, '50.00', '23', '', '', '2022-07-06'),
(19, '175406505305', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-30'),
(20, '175406505305', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-30'),
(21, '894809849192', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-06'),
(22, '894809849192', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-06'),
(23, '783781844598', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(24, '339850115051', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(25, '170170903726', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(26, '791653475491', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(27, '416739337853', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(28, '869364028315', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(29, '336840260001', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(30, '091354424417', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(31, '923191341011', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(32, '923191341011', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(33, '931549545728', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(34, '515942493988', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(35, '502324164488', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(36, '502324164488', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(37, '721833728089', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(38, '795423730387', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(39, '919177586301', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(40, '254488890708', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-03'),
(41, '435122382893', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(42, '255107590302', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(43, '255107590302', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(44, '069848192005', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(45, '442138506471', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(46, '442138506471', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(47, '469205226226', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(48, '469205226226', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(49, '469205226226', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(50, '667448664239', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(51, '272266404212', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(52, '272266404212', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(53, '789790792998', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(54, '649815511984', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(55, '269209463466', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(56, '740485554696', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(57, '732823192416', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(58, '732823192416', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(59, '345499135595', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(60, '345499135595', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(61, '345499135595', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(62, '603822895664', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(63, '931581825187', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(64, '433487198989', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(65, '433487198989', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(66, '941265594363', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(67, '142871202719', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-03'),
(68, '917050202201', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(69, '993436964962', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(70, '789542724268', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(71, '486138682728', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(72, '044804312933', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(73, '044804312933', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(74, '317401717688', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(75, '808211633678', 'Sunsilk Green 3pcs', '12345', 1, '55.00', '23', '', '', '2022-07-03'),
(76, '938210057582', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '7', '', '', '2022-07-03'),
(77, '454517889686', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '2', '', '', '2022-07-03'),
(78, '316957842139', 'Safeguard White 50ml', 'yhKXm', 2, '40.00', '9', '', '', '2022-07-06'),
(79, '583115800901', 'Safeguard White 50ml', 'yhKXm', 2, '40.00', '23', '', '', '2022-07-03'),
(80, '595865706873', 'Safeguard White 50ml', 'yhKXm', 1, '20.00', '23', '', '', '2022-07-03'),
(81, '446668410812', 'Clear Clear blue 3pcs per sachet', '1', 50, 'yZWJp', '7', '', '', '2022-07-03'),
(82, '969613075900', 'Safeguard White 50ml', '1', 20, 'yhKXm', '7', '', '', '2022-07-03'),
(83, '779988864841', 'Safeguard White 50ml', '1', 20, 'yhKXm', '7', '', '', '2022-07-03'),
(84, '886343962977', 'Safeguard White 50ml', '1', 20, 'yhKXm', '7', '', '', '2022-07-03'),
(85, '634058370859', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(86, '135364315547', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(87, '458557534830', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(88, '197137635937', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(90, '323104892831', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(91, '709844363039', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(92, '480539508054', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(93, '480539508054', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(94, '845507077163', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(95, '429105153911', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(96, '109638132143', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(97, '109638132143', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(98, '224992171496', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(99, '547535759323', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(100, '997332047304', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(101, '997332047304', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(102, '668560351834', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(103, '668560351834', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(104, '668560351834', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(105, '808801442427', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(106, '808801442427', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(107, '808801442427', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(108, '808801442427', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(109, '623642147715', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(110, '954384998959', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(111, '954384998959', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(112, '053839746570', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(113, '053839746570', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(114, '053839746570', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(115, '071858142329', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(116, '071858142329', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(117, '071858142329', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(118, '071858142329', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(119, '032618237341', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(120, '032618237341', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(121, '032618237341', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(122, '032618237341', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(123, '032618237341', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(124, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(125, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(126, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(127, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(128, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(129, '009996591557', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(130, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(131, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(132, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(133, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(134, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(135, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(136, '735796555952', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(137, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(138, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(139, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(140, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(141, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(142, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(143, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(144, '696434072515', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(145, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(146, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(147, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(148, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(149, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(150, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(151, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(152, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(153, '197463931175', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(164, '151739590824', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(165, '012769958493', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(166, '308474885210', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(167, '835874452527', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(168, '714871791006', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(169, '714871791006', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(170, '007936811230', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', 'delivered', '2022-08-07'),
(171, '007936811230', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', 'delivered', '2022-07-31'),
(172, '007936811230', 'Safeguard White 50ml', '5', 100, 'yhKXm', '23', '', 'delivered', '2022-07-03'),
(173, '601008851006', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(174, '601008851006', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(175, '601008851006', 'Safeguard White 50ml', '5', 100, 'yhKXm', '23', '', '', '2022-07-03'),
(176, '601008851006', 'Safeguard White 50ml', '3', 60, 'yhKXm', '23', '', '', '2022-07-03'),
(177, '675128230472', 'Safeguard White 50ml', '10', 200, 'yhKXm', '23', '', '', '2022-07-03'),
(178, '356991942315', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(179, '478553335236', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(180, '551019123986', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', '', '2022-07-03'),
(181, '334209196194', 'Safeguard White 50ml', '1', 20, 'yhKXm', '23', '', 'delivered', '2022-08-07'),
(182, '680095959916', 'Kopiko Brown Twin pack', '1', 80, 'MyYQV', '7', '', 'delivered', '2022-07-31'),
(183, '680095959916', 'Sunsilk Green 3pcs per sachet', '1', 55, 'pmzjR', '7', '', 'delivered', '2022-07-31'),
(189, '561029775730', 'Toshiba 500gb', '1', 400, '400', '28', '', 'pending', '2022-09-03'),
(190, '778356010124', 'Toshiba 500gb', '1', 400, 'am88Z', '28', 'pending', '', '2022-09-03'),
(191, '778356010124', 'Toshiba 500gb', '1', 500, 'am88Z', '28', 'pending', '', '2022-09-03'),
(192, '345075504955', 'Toshiba 500gb', '1', 123, 'am88Z', '28', '', 'pending', '2022-09-03'),
(193, '345075504955', 'Toshiba 500gb', '1', 500, 'am88Z', '28', '', 'pending', '2022-09-03'),
(194, '656580709134', 'Toshiba 500gb', '1', 12312312, 'am88Z', '28', '', 'pending', '2022-09-03'),
(195, '656580709134', 'Toshiba 500gb', '1', 500, 'am88Z', '28', '', 'pending', '2022-09-03'),
(196, '935794804599', 'Toshiba 500gb', '1', 300, 'am88Z', '28', 'Binarat', 'pending', '2022-09-03'),
(197, '348510480241', 'Toshiba 500gb', '1', 200, 'am88Z', '23', 'Sobrang tawad', 'pending', '2022-09-03'),
(198, '348510480241', 'Toshiba 500gb', '1', 500, 'am88Z', '23', '', 'pending', '2022-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `products_price`
--

CREATE TABLE `products_price` (
  `id` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `reseller_price` varchar(50) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `supplier_price` varchar(50) NOT NULL,
  `store_code` varchar(20) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_price`
--

INSERT INTO `products_price` (`id`, `price`, `reseller_price`, `quantity`, `supplier_price`, `store_code`, `added_at`) VALUES
('123456', '55', '50', '28', '', '', '2022-06-02 21:22:52'),
('am88Z', '500', '', '-7', '200', 'Default Online', '2022-08-31 22:25:07'),
('aUWw1', '3000', '', '6', '700', 'Default Online', '2022-09-02 10:27:35'),
('Fvjyv', '5000', '', '5', '600', 'Default Online', '2022-08-31 23:03:10'),
('fYlei', '55', '55', '30', '34', '2y8JU', '2022-06-09 19:41:01'),
('HfG3G', '2000', '', '4', '600', 'Default Online', '2022-09-02 10:25:44'),
('MyYQV', '80', '50', '80', '50', 'YGt3Q', '2022-06-09 19:33:59'),
('n8TK4', '2000', '', '4', '600', 'Default Online', '2022-09-02 10:26:55'),
('nIeCk', '1000', '', '1', '500', 'YGt3Q', '2022-08-28 14:05:17'),
('pCkAX', '20', '15', '20', '', '1', '2022-06-08 00:10:09'),
('pmzjR', '55', '50', '28', '32', 'YGt3Q', '2022-06-09 19:45:01'),
('VxBVY', '1000', '', '5', '400', 'f8ukg', '2022-09-02 10:12:06'),
('wuY1K', '7000', '', '8', '800', 'Default Online', '2022-09-02 10:30:14'),
('yhKXm', '20', '25', '16', '', '1', '2022-06-08 00:11:38'),
('yZWJp', '50', '12', '42', '32', 'YGt3Q', '2022-06-09 19:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `products_supplier`
--

CREATE TABLE `products_supplier` (
  `supplier_code` varchar(20) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL,
  `supplier_address` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `PHPSESSION` varchar(100) NOT NULL,
  `COOKIESESSION` varchar(100) NOT NULL,
  `date_created` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `username`, `PHPSESSION`, `COOKIESESSION`, `date_created`, `added_at`) VALUES
(1, '0', 'LPQ6abTJ2tN5DnRklB3TWSJhfNHu8EaW91DlBAIZr7fw46k2vBmM4Sh2mhxj', 'LPQ6abTJ2tN5DnRklB3TWSJhfNHu8EaW91DlBAIZr7fw46k2vBmM4Sh2mhxj', '', '0000-00-00 00:00:00'),
(2, '0', 'ZFgVVRmc5N43Dp3Jv1FKjKPiUaYTqXtF5wBy43RWFFL2PGyNKvPv3OBdww5O', 'ZFgVVRmc5N43Dp3Jv1FKjKPiUaYTqXtF5wBy43RWFFL2PGyNKvPv3OBdww5O', '', '2022-05-30 23:17:44'),
(3, '0', 'U7Lgk5Lo2DqsSEY4AX3PJyP81OYNfLcGpQ4iOHFD1v33TOHBtfK1sE6exQZ8', 'U7Lgk5Lo2DqsSEY4AX3PJyP81OYNfLcGpQ4iOHFD1v33TOHBtfK1sE6exQZ8', '', '2022-06-01 20:29:09'),
(4, 'test3@email.com', 'vbRMduucnztMAYfkBRmP1IE5G8ja6CucFWqbwd9P9qw52BmPIn2kCPYSUqlI', 'vbRMduucnztMAYfkBRmP1IE5G8ja6CucFWqbwd9P9qw52BmPIn2kCPYSUqlI', '', '2022-06-01 21:19:50'),
(6, 'test3@email.com', 't7UIl9uWL4NUtBeFWC5sj5WrNWXIXxKHJ2ib2Fk7ZIZGOwnCuRW14cYGj6NB', 't7UIl9uWL4NUtBeFWC5sj5WrNWXIXxKHJ2ib2Fk7ZIZGOwnCuRW14cYGj6NB', '', '2022-06-01 22:32:44'),
(7, 'test3@email.com', 'oS15aJQnbyYXBPv64A2gUgrZFJjHprYtij2rraecHezDEMXK2glfabYHgPSA', 'oS15aJQnbyYXBPv64A2gUgrZFJjHprYtij2rraecHezDEMXK2glfabYHgPSA', '', '2022-06-01 22:32:51'),
(8, 'test3@email.com', 'FwAC3Ae1GH3CChQVMK6GtVWUUiGzlsuUsAFRHUOlqfrxqdBcND1vmq8HTcxS', 'FwAC3Ae1GH3CChQVMK6GtVWUUiGzlsuUsAFRHUOlqfrxqdBcND1vmq8HTcxS', '', '2022-06-01 22:42:15'),
(9, 'test3@email.com', 'Fjl7kwnCxQYleYVY7Io3sMgDKDZ78O5GgwBvAgtCqu7JZeJ1yQAxU3aZHM86', 'Fjl7kwnCxQYleYVY7Io3sMgDKDZ78O5GgwBvAgtCqu7JZeJ1yQAxU3aZHM86', '2022-06-02 00-10-56', '2022-06-02 00:07:05'),
(10, 'test3@email.com', 'TTUvcNjbH4JntwPqIZKgtuLJHX2hNNRvzZe1iw51DX63vuEXCpvEDNMTclgS', 'TTUvcNjbH4JntwPqIZKgtuLJHX2hNNRvzZe1iw51DX63vuEXCpvEDNMTclgS', '2022-06-07 19-28-23', '2022-06-02 00:11:43'),
(11, 'test3@email.com', 'j8f8UsbINAqpWghkR8ILVEfbjGureY8QurpbIXqVQA766xCF1cahIcevNOVr', 'j8f8UsbINAqpWghkR8ILVEfbjGureY8QurpbIXqVQA766xCF1cahIcevNOVr', '2022-06-11 20-56-21', '2022-06-04 22:59:11'),
(12, 'test3@email.com', 'FFzkF7D5CuVOqkcYwYpV4fASY7eaZ5528sOFQn4YUZOrXsgckfbqdgIbmHKQ', 'FFzkF7D5CuVOqkcYwYpV4fASY7eaZ5528sOFQn4YUZOrXsgckfbqdgIbmHKQ', '2022-06-07 19-28-50', '2022-06-07 19:28:50'),
(13, 'test3@email.com', 'XRfvh5CQdfvFhkyUPmObMvEiRJE2i8fo5HlRIu7SwUrOWEliGc7QRBNuRvVt', 'XRfvh5CQdfvFhkyUPmObMvEiRJE2i8fo5HlRIu7SwUrOWEliGc7QRBNuRvVt', '2022-06-07 23-38-40', '2022-06-07 23:38:40'),
(14, 'test3@email.com', 'I5wmiFLbdr3yT6aW8ldLEbDmd8tqJC9HFXlBpdB8KQvhwe4dKSlXuLYMxVqqQ', 'I5wmiFLbdr3yT6aW8ldLEbDmd8tqJC9HFXlBpdB8KQvhwe4dKSlXuLYMxVqqQ', '2022-06-07 23-51-15', '2022-06-07 23:51:15'),
(15, 'test3@email.com', 'nYxTIUdDVKhzWDMS9PHvb2BNtavEuraGZXW5h8z3hkbyEKvbdQwx2a5LdkrHLa', 'nYxTIUdDVKhzWDMS9PHvb2BNtavEuraGZXW5h8z3hkbyEKvbdQwx2a5LdkrHLa', '2022-06-08 00-16-06', '2022-06-08 00:15:33'),
(16, 'test3@email.com', 'qmwfhfB2AAe8peQVW9A21O4PQV3VpB1ITVNnlP4PSA7a1EPeOwFJXHpjyYNF2r', 'qmwfhfB2AAe8peQVW9A21O4PQV3VpB1ITVNnlP4PSA7a1EPeOwFJXHpjyYNF2r', '2022-06-08 20-34-57', '2022-06-08 20:34:57'),
(17, 'test3@email.com', 'uR2nx8vwgXNDNd8VQ7APO1Gke8zFBRNIecCJSXRsWKtCdzu9bycXlRFeFZP8iJ', 'uR2nx8vwgXNDNd8VQ7APO1Gke8zFBRNIecCJSXRsWKtCdzu9bycXlRFeFZP8iJ', '2022-06-09 18-57-21', '2022-06-09 18:57:21'),
(18, 'test3@email.com', 'dRTg6Gvxnrj32UctbuGclqKynbk7bSHgZF2FFCw9t4gh6KTvvzG1PuRjYoIklY', 'dRTg6Gvxnrj32UctbuGclqKynbk7bSHgZF2FFCw9t4gh6KTvvzG1PuRjYoIklY', '2022-06-10 17-24-09', '2022-06-10 17:24:09'),
(19, 'test3@email.com', 'A6pW1aHEXubiQYIudADTgzFjUtLYOqlJuOvgCwIN1TgQrOIessxuj4zgRYAeiu', 'A6pW1aHEXubiQYIudADTgzFjUtLYOqlJuOvgCwIN1TgQrOIessxuj4zgRYAeiu', '2022-06-10 23-52-55', '2022-06-10 23:52:55'),
(20, 'test3@email.com', 'XVROb9qK3EqBFvTQmQOrzMqjxeA7JtOhFSRLrTwHTWB91CeVp3ZWGBLcMHGwBf', 'XVROb9qK3EqBFvTQmQOrzMqjxeA7JtOhFSRLrTwHTWB91CeVp3ZWGBLcMHGwBf', '2022-06-11 15-09-28', '2022-06-11 15:09:28'),
(21, 'test3@email.com', 'KUljF5sAHQn7kAU69Rj8jSp4ltywCxsvVVRqRMguv89eqfjmjO8JXGFEhR5VCi', 'KUljF5sAHQn7kAU69Rj8jSp4ltywCxsvVVRqRMguv89eqfjmjO8JXGFEhR5VCi', '2022-06-12 16-45-22', '2022-06-12 16:45:22'),
(22, 'test3@email.com', 'kt8BrmSCMRy8eKZNmOZsuetThBiaDSMAkxdvgDemEfskX4UFppGbIjy97QnnDi', 'kt8BrmSCMRy8eKZNmOZsuetThBiaDSMAkxdvgDemEfskX4UFppGbIjy97QnnDi', '2022-06-12 23-22-05', '2022-06-12 23:22:05'),
(23, 'test3@email.com', 'T1FGIulOckmV4LSC9tOmPN9ri3oJ1glgEKqjaC2WIkEVsoy8UHMnTf6Bcbqi15', 'T1FGIulOckmV4LSC9tOmPN9ri3oJ1glgEKqjaC2WIkEVsoy8UHMnTf6Bcbqi15', '2022-06-13 19-17-01', '2022-06-13 19:17:01'),
(24, 'test3@email.com', 'xku1Jsp9jCORz9qOJIBuT8RWoRjDDOHNFNpn4rvlxQsiOIb3MWTzxZfEfdGM7s', 'xku1Jsp9jCORz9qOJIBuT8RWoRjDDOHNFNpn4rvlxQsiOIb3MWTzxZfEfdGM7s', '2022-06-14 19-27-32', '2022-06-14 19:27:32'),
(25, 'test3@email.com', 'RHrYokiWa5RLLvqj17DdSFkadptwI9uobcXABCdbap6loEueWmA6rGqgh4d5tZ', 'RHrYokiWa5RLLvqj17DdSFkadptwI9uobcXABCdbap6loEueWmA6rGqgh4d5tZ', '2022-06-15 19-38-45', '2022-06-15 19:38:45'),
(26, 'test3@email.com', '5g93sI8f8WAi7d2mj5MrRzHC46F4EDVNCJIqCPz1ghoma2hE4iixOhPOFQkgvk', '5g93sI8f8WAi7d2mj5MrRzHC46F4EDVNCJIqCPz1ghoma2hE4iixOhPOFQkgvk', '2022-06-16 19-55-06', '2022-06-16 19:55:06'),
(27, 'test3@email.com', 'aHmPoHCOK7LUbkRXMyOw9W5IkRGALntrXXQHKjwBRapFk4qIlKo3KjoPUBOcE2', 'aHmPoHCOK7LUbkRXMyOw9W5IkRGALntrXXQHKjwBRapFk4qIlKo3KjoPUBOcE2', '2022-06-17 19-36-56', '2022-06-17 19:36:56'),
(28, 'test3@email.com', 'y7LrudAJZUaBJQOh58U2uSid6IlErpZxHe69FAjwtHe3m4HTsTU7KA8rsFUbh9', 'y7LrudAJZUaBJQOh58U2uSid6IlErpZxHe69FAjwtHe3m4HTsTU7KA8rsFUbh9', '2022-06-18 17-24-25', '2022-06-18 17:24:25'),
(29, 'test3@email.com', 'xipPFcYhaa7dvsWXBUwCgpDiZeWQJiIg7tHFnw52L54etd1AreFrZXFUUrZ1Tl', 'xipPFcYhaa7dvsWXBUwCgpDiZeWQJiIg7tHFnw52L54etd1AreFrZXFUUrZ1Tl', '2022-06-23 18-48-25', '2022-06-21 18:47:24'),
(30, 'test3@email.com', 'mEjNpfm8HMjdnycEbDxI4bxCbXKCdXpVJasepwwiKrWQvzpCM1mbB9RaM5ChPo', 'mEjNpfm8HMjdnycEbDxI4bxCbXKCdXpVJasepwwiKrWQvzpCM1mbB9RaM5ChPo', '2022-06-26 23-07-51', '2022-06-26 23:07:51'),
(31, 'test3@email.com', 'ByM7TCqx9OEaG3TMapd5ray8ZGp2rLyCO7finSV6xI7p4bhOzaJQNP3D65Ch23', 'ByM7TCqx9OEaG3TMapd5ray8ZGp2rLyCO7finSV6xI7p4bhOzaJQNP3D65Ch23', '2022-06-27 19-20-03', '2022-06-27 19:20:03'),
(32, 'test3@email.com', 'GJ12I2sX4Mg6iOCZHXeufwupXo1vxXCBSCiybP6gFt3OR4xriOobnWssmE1i2I', 'GJ12I2sX4Mg6iOCZHXeufwupXo1vxXCBSCiybP6gFt3OR4xriOobnWssmE1i2I', '2022-07-01 23-04-53', '2022-07-01 23:04:53'),
(33, 'test3@email.com', '6ooF8DPshCF4lrwVIOmfeF7CuOmtHcZotNBD5wQeSWwAqLUcjpCsqGSxrFQ5wo', '6ooF8DPshCF4lrwVIOmfeF7CuOmtHcZotNBD5wQeSWwAqLUcjpCsqGSxrFQ5wo', '2022-07-02 22-11-58', '2022-07-02 22:11:58'),
(34, 'test3@email.com', '9g3gX57NtJyfP7yHEWXBuyFZILrCXgSPoq8roqdOtH3oxgbsB5WLEKZHn3lpnl', '9g3gX57NtJyfP7yHEWXBuyFZILrCXgSPoq8roqdOtH3oxgbsB5WLEKZHn3lpnl', '2022-07-03 10-58-02', '2022-07-03 10:58:02'),
(35, 'test3@email.com', 'jFlQs1HMrm8z6IWj5aSMbrg8YoHIt12CjPNKpDzWfVbji7rfswAmntVgDyCwG4', 'jFlQs1HMrm8z6IWj5aSMbrg8YoHIt12CjPNKpDzWfVbji7rfswAmntVgDyCwG4', '2022-07-03 17-50-28', '2022-07-03 17:50:28'),
(36, 'test3@email.com', '87BCCMaw2GiED47jHruWekMUHUIhHRqHVzbbBemHjw4MI1A1C6DZiq2tVGXifp', '87BCCMaw2GiED47jHruWekMUHUIhHRqHVzbbBemHjw4MI1A1C6DZiq2tVGXifp', '2022-07-04 19-39-22', '2022-07-04 19:39:22'),
(37, 'test3@email.com', 'DLyCprJbZxk4KhFjdoWIN9mCcZZanFhAv4IZYN8yMYKqTuwxv53pXFUdOxuDK7', 'DLyCprJbZxk4KhFjdoWIN9mCcZZanFhAv4IZYN8yMYKqTuwxv53pXFUdOxuDK7', '2022-07-05 19-40-01', '2022-07-05 19:40:01'),
(38, 'test3@email.com', '9dib1aBU6kZlcEKnsIgTFOUnJuGegQZaxIjqSzbtYIyprhhnPMHQCx9SLQ1ZP4', '9dib1aBU6kZlcEKnsIgTFOUnJuGegQZaxIjqSzbtYIyprhhnPMHQCx9SLQ1ZP4', '2022-07-06 19-10-08', '2022-07-06 19:10:08'),
(39, 'test3@email.com', 'y1RrTLhTa5nZhZ3mam59RgpxLENP3RA9XOscD1aCKOEjtRCGAjVLOl9dI1fcUT', 'y1RrTLhTa5nZhZ3mam59RgpxLENP3RA9XOscD1aCKOEjtRCGAjVLOl9dI1fcUT', '2022-07-06 20-29-41', '2022-07-06 20:29:41'),
(40, 'test3@email.com', 'kWoh5vR2x4rhaHaM9D1TCNeIVS166KSZzCGad8uOsxfVhgzRiORJAApxo82f6x', 'kWoh5vR2x4rhaHaM9D1TCNeIVS166KSZzCGad8uOsxfVhgzRiORJAApxo82f6x', '2022-07-12 21-38-41', '2022-07-12 21:38:41'),
(41, 'test3@email.com', 'kUR6y3vGoe8W7Q8BSK1yakKfryaZ8sP75rElZGeXGZNro2RNdWJ64a7L3bCtKL', 'kUR6y3vGoe8W7Q8BSK1yakKfryaZ8sP75rElZGeXGZNro2RNdWJ64a7L3bCtKL', '2022-07-31 07-01-15', '2022-07-30 21:45:46'),
(42, 'test3@email.com', '7jM2F2li2p7YZGFZD8T1JQfSfMi2z2tT29LNNXBOGky25iJhmQNf2tozB3TtxC', '7jM2F2li2p7YZGFZD8T1JQfSfMi2z2tT29LNNXBOGky25iJhmQNf2tozB3TtxC', '2022-07-31 14-15-07', '2022-07-31 14:15:07'),
(43, 'test3@email.com', 'xNN2ly1luHdUr98c6ksVcCTwMC9mv4nbASafUfUWhv4jJ243xbmdJjyNps5QeI', 'xNN2ly1luHdUr98c6ksVcCTwMC9mv4nbASafUfUWhv4jJ243xbmdJjyNps5QeI', '2022-08-01 21-41-20', '2022-08-01 21:41:20'),
(44, 'test3@email.com', '6NfSGWF7sYDoJnGrvi2NOTwt7qbDX1EaRkgbYpZpztOXNMWddj5wGgGm9WaRxI', '6NfSGWF7sYDoJnGrvi2NOTwt7qbDX1EaRkgbYpZpztOXNMWddj5wGgGm9WaRxI', '2022-08-01 21-51-20', '2022-08-01 21:51:20'),
(45, 'test3@email.com', 'xSvbWFxYJmWexJB3AC8wqwUV7U9EYvIHatqzXJclweEaFiPb5wYXdrVIMhanbz', 'xSvbWFxYJmWexJB3AC8wqwUV7U9EYvIHatqzXJclweEaFiPb5wYXdrVIMhanbz', '2022-08-02 08-50-40', '2022-08-01 22:45:03'),
(46, 'test3@email.com', 'O5VydoSfvpT8cNH9tJYiOMN1sGHWPaBspcYgmcQekmmVG2z9QyhZy7kJqiOs8e', 'O5VydoSfvpT8cNH9tJYiOMN1sGHWPaBspcYgmcQekmmVG2z9QyhZy7kJqiOs8e', '2022-08-02 08-54-43', '2022-08-02 08:54:43'),
(47, 'test3@email.com', 'te1bQMwcndHF1td1l3zjrhvLwOvQ5bSKNMK7UkslQfoe5dpS9gXBJNnP6dUCyP', 'te1bQMwcndHF1td1l3zjrhvLwOvQ5bSKNMK7UkslQfoe5dpS9gXBJNnP6dUCyP', '2022-08-02 21-32-51', '2022-08-02 21:32:51'),
(48, 'test3@email.com', 'twHgn6ugsDfwyNzpGmbFAEZuGv9fxzMQvzPTSGwuDvdafLytRDCbaLWWeTiGON', 'twHgn6ugsDfwyNzpGmbFAEZuGv9fxzMQvzPTSGwuDvdafLytRDCbaLWWeTiGON', '2022-08-02 22-46-56', '2022-08-02 22:46:56'),
(49, 'test3@email.com', 'HBfk2pxZE5kgSvADnDKH4wKQQIQK9bkAXoEXXfMwiTK3pV4cRTNZG3jNawPiYx', 'HBfk2pxZE5kgSvADnDKH4wKQQIQK9bkAXoEXXfMwiTK3pV4cRTNZG3jNawPiYx', '2022-08-03 08-35-22', '2022-08-03 08:35:22'),
(50, 'test3@email.com', 'jp3oN8XRf3h6moQsMgdehPZmXkMYhgEArVh4oDEA1YrMOVlkG7Nd4nngfLlkuW', 'jp3oN8XRf3h6moQsMgdehPZmXkMYhgEArVh4oDEA1YrMOVlkG7Nd4nngfLlkuW', '2022-08-03 09-54-11', '2022-08-03 09:54:11'),
(51, 'test3@email.com', 'SEVwO4drkmWUNsi48i2pQWoMSij1A4BwXVwLev9LdBdYOF882sXLlaVxtIMnia', 'SEVwO4drkmWUNsi48i2pQWoMSij1A4BwXVwLev9LdBdYOF882sXLlaVxtIMnia', '2022-08-03 09-57-31', '2022-08-03 09:57:31'),
(52, 'test3@email.com', 'n8SrkiEcFqWsd4BIUUcOQSksobKKWYqnFit6UTRxVzLxuWDrZ8ZJ1PptSUpcgf', 'n8SrkiEcFqWsd4BIUUcOQSksobKKWYqnFit6UTRxVzLxuWDrZ8ZJ1PptSUpcgf', '2022-08-03 10-03-59', '2022-08-03 10:03:59'),
(53, 'test3@email.com', 'BCp8sWB6RyKYGFc5QhwTHIkoXZtTKu4KJgbUei2WTpritU7PEDIxBGBjDMsZp2', 'BCp8sWB6RyKYGFc5QhwTHIkoXZtTKu4KJgbUei2WTpritU7PEDIxBGBjDMsZp2', '2022-08-03 22-24-07', '2022-08-03 22:24:07'),
(54, 'test3@email.com', 'wbgTYJUOWnsGoPhfBTqnIRUelgAMznF9aK26ikfn1TmEdf9lv3Jj5Fjn8a8nBp', 'wbgTYJUOWnsGoPhfBTqnIRUelgAMznF9aK26ikfn1TmEdf9lv3Jj5Fjn8a8nBp', '2022-08-04 20-56-48', '2022-08-04 20:56:48'),
(55, 'test3@email.com', 'VovrF6RsEg5xNIRIHrsR4jXzSmsrNuvUiI27e5npQ1bUbUZSgnfDH1JWKpg5gh', 'VovrF6RsEg5xNIRIHrsR4jXzSmsrNuvUiI27e5npQ1bUbUZSgnfDH1JWKpg5gh', '2022-08-04 21-00-20', '2022-08-04 21:00:20'),
(56, 'test3@email.com', 'rqoJssA4LtJXRFKiBX3FYsG89X6UIBZ5y3j7FxOIXtEYVoRMiabsuPEEMIOGHg', 'rqoJssA4LtJXRFKiBX3FYsG89X6UIBZ5y3j7FxOIXtEYVoRMiabsuPEEMIOGHg', '2022-08-05 10-25-47', '2022-08-05 10:25:47'),
(57, 'test3@email.com', 'oPWYeFO2pwR19lx2U87gaNpkt7ACb3uX9WM9pNDXCwXJ7dVtKSvHq8ct3Yy6xP', 'oPWYeFO2pwR19lx2U87gaNpkt7ACb3uX9WM9pNDXCwXJ7dVtKSvHq8ct3Yy6xP', '2022-08-06 17-14-06', '2022-08-06 17:14:06'),
(58, 'test3@email.com', 'AkH6OeZOBW4L7guH3QodGU8YEeFEKTqW4vPqw8izk78v12v2xB756tjycqNVti', 'AkH6OeZOBW4L7guH3QodGU8YEeFEKTqW4vPqw8izk78v12v2xB756tjycqNVti', '2022-08-07 05-32-47', '2022-08-07 05:32:47'),
(59, 'test3@email.com', 'L8PYaHMwCl6iJsrkSY38kdMSoMoSqRbNUVecCOjfAbrUxd1VkPLsnfohflHKqa', 'L8PYaHMwCl6iJsrkSY38kdMSoMoSqRbNUVecCOjfAbrUxd1VkPLsnfohflHKqa', '2022-08-07 17-19-37', '2022-08-07 17:19:37'),
(60, 'test3@email.com', 'm64hckkZeGU1OTdfYLkDNZEef4Gb2OIqH3pmzOg6KmSszulRtqcXQcA3jo3f9G', 'm64hckkZeGU1OTdfYLkDNZEef4Gb2OIqH3pmzOg6KmSszulRtqcXQcA3jo3f9G', '2022-08-07 17-23-52', '2022-08-07 17:23:52'),
(61, 'test3@email.com', '1dYJ94l6LkJAm6tVNIGZRRLPRwMAhpXLyDNoLwOFYnNOviTswMzQR1PokYDLRP', '1dYJ94l6LkJAm6tVNIGZRRLPRwMAhpXLyDNoLwOFYnNOviTswMzQR1PokYDLRP', '2022-08-07 21-06-33', '2022-08-07 21:06:33'),
(62, 'test3@email.com', 'sypjXhviyjEnOVShbd9rURFM1AQOEkCtobrCVkvkV38ZcNeHijudSibIQhPra5', 'sypjXhviyjEnOVShbd9rURFM1AQOEkCtobrCVkvkV38ZcNeHijudSibIQhPra5', '2022-08-08 22-48-14', '2022-08-08 22:48:14'),
(63, 'test3@email.com', 'cIjMG7Z7mutlyrTFEgpDjnT3qYLhxDzDWj2crnCDrHUsPhyaiiXK6JwfVaIVdY', 'cIjMG7Z7mutlyrTFEgpDjnT3qYLhxDzDWj2crnCDrHUsPhyaiiXK6JwfVaIVdY', '2022-08-15 21-07-19', '2022-08-15 21:07:19'),
(64, 'test3@email.com', 'IAuEAdyfeBkdD6kMg5EmxgksUcnWBFnJGwx1R1msfqiYonskbzK6Z62zRGhrTt', 'IAuEAdyfeBkdD6kMg5EmxgksUcnWBFnJGwx1R1msfqiYonskbzK6Z62zRGhrTt', '2022-08-16 23-39-10', '2022-08-16 23:39:10'),
(65, 'test3@email.com', 'MPEvAZoUVQ71SIJAJTsa9BWXSTedoOSDU7hVSFm3uPSWlKWcfB5jHmuTOtDGAQ', 'MPEvAZoUVQ71SIJAJTsa9BWXSTedoOSDU7hVSFm3uPSWlKWcfB5jHmuTOtDGAQ', '2022-08-28 00-39-27', '2022-08-28 00:39:27'),
(66, 'test3@email.com', 'XG8qke6xVCSZEiNMmDhahesRLTiPjQcsmbI88qqM9h5t5P3yodnzEdpQRC3AxG', 'XG8qke6xVCSZEiNMmDhahesRLTiPjQcsmbI88qqM9h5t5P3yodnzEdpQRC3AxG', '2022-08-28 11-55-14', '2022-08-28 11:55:14'),
(67, 'test3@email.com', 'fLut5rCXox1lUDYrU9xSec8vcX1bfl6HmKJhy7FiEase5tPixAMDZzkGV5kmnI', 'fLut5rCXox1lUDYrU9xSec8vcX1bfl6HmKJhy7FiEase5tPixAMDZzkGV5kmnI', '2022-08-28 14-00-05', '2022-08-28 14:00:05'),
(68, 'test3@email.com', '6m1zDKooryNWFjTEiQCEX6u34X48oAu5hpRiEV9dxpiukGJbC1kS9Z9cbRuk83', '6m1zDKooryNWFjTEiQCEX6u34X48oAu5hpRiEV9dxpiukGJbC1kS9Z9cbRuk83', '2022-08-30 07-39-11', '2022-08-29 22:10:49'),
(69, 'test3@email.com', 'dxfULTIt5pmwTYKR87ZHsmdGi8UM3nnk8T1WN8Akv8bqPPvMpVGRCxpoHoTWWO', 'dxfULTIt5pmwTYKR87ZHsmdGi8UM3nnk8T1WN8Akv8bqPPvMpVGRCxpoHoTWWO', '2022-08-31 21-43-51', '2022-08-31 21:43:51'),
(70, 'test3@email.com', 'fawyQIwKZqfFxcU7d3Mv9hL9i5yEgbZgY57pYvopvHDpxvvcgNVTyeOTLUAcqd', 'fawyQIwKZqfFxcU7d3Mv9hL9i5yEgbZgY57pYvopvHDpxvvcgNVTyeOTLUAcqd', '2022-09-01 09-12-26', '2022-09-01 09:12:26'),
(71, 'test3@email.com', 'RDt5hN486t1UaeUFTeDGHGNA3ksblpkezhU6v6PSsZexlDZIlgv9Vf7GbJmMfS', 'RDt5hN486t1UaeUFTeDGHGNA3ksblpkezhU6v6PSsZexlDZIlgv9Vf7GbJmMfS', '2022-09-01 21-06-07', '2022-09-01 21:06:07'),
(72, 'test3@email.com', 'LPYk3L9T8Lc4q6OBaQqnRzdarNTfjFmRT6T6W4ZslCTpcLM5ctSGT7KIz6yJFm', 'LPYk3L9T8Lc4q6OBaQqnRzdarNTfjFmRT6T6W4ZslCTpcLM5ctSGT7KIz6yJFm', '2022-09-02 09-46-27', '2022-09-02 09:46:27'),
(73, 'test3@email.com', 'gskx4GHWTPUdEzvAFEs2Y8eTPbSuY8hkwgjuEodfX2Z6vNHUWdutblC35fkutL', 'gskx4GHWTPUdEzvAFEs2Y8eTPbSuY8hkwgjuEodfX2Z6vNHUWdutblC35fkutL', '2022-09-02 22-20-10', '2022-09-02 22:20:10'),
(74, 'test3@email.com', 'xpIGlxKflVrPRjrUZNgX2OJGfuU4ovdGrNdVZqsPpmRKrWU1aA61ocvg9QK2cu', 'xpIGlxKflVrPRjrUZNgX2OJGfuU4ovdGrNdVZqsPpmRKrWU1aA61ocvg9QK2cu', '2022-09-04 00-55-28', '2022-09-03 21:51:12'),
(75, 'test3@email.com', 'oCePL2Fx2V3GPZlSPigm2CHQzVtY5dvxkcin8kpEj7v6ZEobRXYGhiiXMYrHlO', 'oCePL2Fx2V3GPZlSPigm2CHQzVtY5dvxkcin8kpEj7v6ZEobRXYGhiiXMYrHlO', '2022-09-04 11-51-56', '2022-09-04 11:51:56'),
(76, 'test3@email.com', 'wojCgza5hioB4XSZ86IizypvCvr189IlQbfWlXtjpOwJV5ICQAaFFjAebQRcCy', 'wojCgza5hioB4XSZ86IizypvCvr189IlQbfWlXtjpOwJV5ICQAaFFjAebQRcCy', '2022-09-04 14-31-42', '2022-09-04 14:31:42'),
(77, 'test3@email.com', 'ZdDiakhkCx8oKsOEheFsoQD1oMLKjd2kteUazws3hU5AYhK1Ds8XVOltQpN7N4', 'ZdDiakhkCx8oKsOEheFsoQD1oMLKjd2kteUazws3hU5AYhK1Ds8XVOltQpN7N4', '2022-09-04 15-19-49', '2022-09-04 15:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `store_code` varchar(50) NOT NULL,
  `supplier_name` varchar(150) NOT NULL,
  `supplier_address` text NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `secondary_no` varchar(50) NOT NULL,
  `contact_person` varchar(150) NOT NULL,
  `products` text NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`store_code`, `supplier_name`, `supplier_address`, `contact_no`, `secondary_no`, `contact_person`, `products`, `added_at`) VALUES
('2y8JU', 'Asiong Store', 'Katuparan Taguig', '123456', '2468910', 'Asion', 'Cosmetics Again', '2022-06-09 19:00:05'),
('9WXnQ', 'Kevin', 'North daang hari taguig', '0956747172', 'none', 'Kevin Rosal', 'Titan gel', '2022-08-03 22:52:35'),
('f8ukg', 'Default Online', 'Online', '00', '00', 'None', 'Random\r\n\r\n', '2022-08-28 14:07:15'),
('q2EZo', 'Joffrey', 'taguig', '09267929831', 'none', 'Kevin Rosal', 'LuckyMe Beef', '2022-08-03 22:56:16'),
('suRvO', 'Asiong Store', 'Katuparan Taguig', '123456', '2468910', 'Asion', 'Cosmetics', '2022-06-08 21:38:12'),
('YGt3Q', 'Magdalene', 'Katuparan Taguig', '546879879', '513215649787', 'Elijah', 'Detergent', '2022-06-09 18:58:46');

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_files`
--

CREATE TABLE `uploaded_files` (
  `file_name` varchar(250) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `extension` varchar(25) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `added_at` varchar(50) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `status`, `token`, `added_at`) VALUES
(1, 'Jimmy', 'Baruc', 'Consulta', 'jimmyconsulta@yahoo.com', '123456', '', '', ''),
(2, 'Jimmy', 'Baruc', 'Consulta', 'test@email.com', '$2y$10$KRcsNA4O9/iNcvH26IR6XeSsnCS8AhVw0hnX4MZiJQ6jj7Z8V0gZW', '', '', '2022-05-29 17:09:19'),
(3, 'Jimmy', 'Baruc', 'Consulta', 'test2@email.com', '$2y$10$H1gXMoEEHkOA5CaOnvY7FusmkGJ7OpTYkGeBvzIJXV5Pkbnk1cXfW', '', '', '2022-05-29 17:10:25'),
(4, 'Jimmy', 'Baruc', 'Consulta', 'test3@email.com', '$2y$10$B5QounJ9c7Uu0xD3ytwdJOSQue5eaBCR7sjIHpx5O8a2jpwvxXMGC', '', '', '2022-05-29 18:55:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients_details`
--
ALTER TABLE `clients_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lending`
--
ALTER TABLE `lending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_name`
--
ALTER TABLE `products_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_price`
--
ALTER TABLE `products_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_supplier`
--
ALTER TABLE `products_supplier`
  ADD PRIMARY KEY (`supplier_code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`store_code`);

--
-- Indexes for table `uploaded_files`
--
ALTER TABLE `uploaded_files`
  ADD PRIMARY KEY (`file_name`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients_details`
--
ALTER TABLE `clients_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lending`
--
ALTER TABLE `lending`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products_name`
--
ALTER TABLE `products_name`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
