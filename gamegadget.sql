-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2021 at 08:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_gadget`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_brand` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM brand WHERE brand_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_category` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM category WHERE cate_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_categorydetail` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM categorydetail WHERE cated_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_employee` (IN `id` VARCHAR(20))  NO SQL
BEGIN
DELETE FROM employees WHERE emp_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_product` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM product WHERE pro_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_rate` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM rate WHERE rate_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_supplier` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM suppliers WHERE sup_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_unit` (IN `id` VARCHAR(11))  NO SQL
BEGIN
DELETE FROM unit WHERE unit_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_order` ()  NO SQL
BEGIN
SELECT max(order_id) + 1 as order_id FROM orders;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sell` ()  NO SQL
BEGIN
SELECT max(sell_id) + 1 as sell_id FROM sell;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_employee` (IN `emp_ids` VARCHAR(20), IN `emp_names` VARCHAR(50), IN `emp_surnames` VARCHAR(50), IN `genders` VARCHAR(20), IN `dobs` VARCHAR(20), IN `addresss` VARCHAR(250), IN `tels` VARCHAR(50), IN `emails` VARCHAR(100), IN `passes` VARCHAR(100), IN `statuss` VARCHAR(10), IN `pro_imgs` VARCHAR(100))  NO SQL
BEGIN
insert into employees(emp_id,emp_name,emp_surname,gender,dob,address,tel,email,pass,status,img_path) values(emp_ids,emp_names,emp_surnames,genders,dobs,addresss,tels,emails,md5(passes),statuss,pro_imgs);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `emails` VARCHAR(100), IN `passed` VARCHAR(100))  NO SQL
BEGIN
SELECT * FROM employees WHERE email=emails and BINARY pass=passed;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login_customer` (IN `emails` VARCHAR(100), IN `passed` VARCHAR(100))  NO SQL
BEGIN
SELECT * FROM customers WHERE email=emails and BINARY pass=passed;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_product` (IN `search` VARCHAR(100))  NO SQL
BEGIN
select p.pro_id,pro_name,brand_name,p.status,promotion,p.promotion,cated_name,cate_name,p.price,p.img_path,p.price-promotion as newprice,(promotion/p.price) * 100 as persen from product p left join brand b on p.brand_id=b.brand_id left join categorydetail d on p.cated_id=d.cated_id left join category c on d.cate_id=c.cate_id where cated_name like search or brand_name like search or pro_name like search or p.pro_id like search and qty != '0' order by p.pro_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_bill` (IN `sell_ids` INT(11))  NO SQL
BEGIN
SELECT sell_id,emp_name,cus_name,getmoney,sell_date,sell_time,delivery FROM sell s LEFT JOIN employees e ON s.emp_id=e.emp_id LEFT JOIN customers c ON s.cus_id=c.cus_id WHERE s.sell_id=sell_ids GROUP BY sell_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_billdetail` (IN `sell_ids` INT(11))  NO SQL
BEGIN
SELECT d.pro_id,pro_name,d.qty,d.price,d.qty*d.price as total,unit_name,brand_name,cated_name,p.img_path FROM selldetail d LEFT JOIN product p ON d.pro_id=p.pro_id LEFT JOIN unit u ON p.unit_id=u.unit_id LEFT JOIN brand b ON p.brand_id=b.brand_id LEFT JOIN categorydetail c ON p.cated_id=c.cated_id WHERE d.sell_id=sell_ids;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_brand` ()  NO SQL
BEGIN
SELECT * FROM brand WHERE brand_id ORDER BY brand_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_category` ()  NO SQL
BEGIN
select * from category order by cate_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_categorydetail` ()  NO SQL
BEGIN
select cated_id,cated_name,c.cate_id,cate_name from categorydetail d left join category c on d.cate_id=c.cate_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_employee` ()  NO SQL
BEGIN
select emp_id,emp_name,emp_surname,gender,dob,address,tel,email,md5(pass) as pass,e.status,name,work_start,end_work,img_path,DATEDIFF('$Date',dob)/365 AS age from employees e left join status s on e.status=s.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_product` ()  NO SQL
BEGIN
select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,cate_name,guarantee,type,promotion,qtyalert,p.img_path,p.status from product p left join categorydetail d on p.cated_id=d.cated_id left join category c on d.cate_id=c.cate_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id ORDER BY pro_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_product_alert` ()  NO SQL
BEGIN
select pro_id,pro_name,p.qty,price,p.cated_id,cated_name,p.unit_id,unit_name,p.brand_id,brand_name,cate_name,guarantee,type,promotion,qtyalert,p.img_path,p.status from product p left join categorydetail d on p.cated_id=d.cated_id left join category c on d.cate_id=c.cate_id left join unit u on p.unit_id=u.unit_id left join brand b on p.brand_id=b.brand_id WHERE p.qty<p.qtyalert ORDER BY pro_name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_rate` ()  NO SQL
BEGIN
SELECT * FROM rate ORDER BY rate_id ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_supplier` ()  NO SQL
BEGIN
SELECT * FROM suppliers ORDER BY company ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_unit` ()  NO SQL
BEGIN
SELECT * FROM unit ORDER BY unit_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_pay` ()  NO SQL
BEGIN
select date_format(imp_date,'%M') as month,sum(qty*price) as amount from imports where year(imp_date) = date_format(now(),'%Y') group by month(imp_date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_pay_year` ()  NO SQL
BEGIN
select date_format(imp_date,'%Y') as year,sum(qty*price) as amount from imports group by year(imp_date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_revenue` ()  NO SQL
BEGIN
select date_format(sell_date,'%M') as month,sum(amount) as amount from sell where year(sell_date) = date_format(now(),'%Y') group by month(sell_date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_revenue_year` ()  NO SQL
BEGIN
select date_format(sell_date,'%Y') as year,sum(amount) as amount from sell group by year(sell_date);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_employee` (IN `emp_ids` VARCHAR(20), IN `emp_names` VARCHAR(50), IN `emp_surnames` VARCHAR(50), IN `genders` VARCHAR(20), IN `dobs` VARCHAR(20), IN `addresss` VARCHAR(250), IN `tels` VARCHAR(50), IN `emails` VARCHAR(100), IN `passes` VARCHAR(100), IN `statuss` VARCHAR(20), IN `img_paths` VARCHAR(100))  NO SQL
BEGIN
UPDATE employees SET emp_name=emp_names,emp_surname=emp_surnames,gender=genders,dob=dobs,address=addresss,tel=tels,email=emails,pass=passes,status=statuss,img_path=img_paths WHERE emp_id=emp_ids;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product` (IN `pro_ids` VARCHAR(30), IN `qtys` INT(11), IN `prices` DECIMAL(11,2), IN `cate_ids` INT(11), IN `unit_ids` INT(11), IN `brand_ids` INT(11), IN `guarantees` INT(11), IN `types` VARCHAR(10), IN `promotions` DECIMAL(11,2), IN `qtyalerts` INT(11), IN `statuss` VARCHAR(50), IN `pro_names` VARCHAR(50))  NO SQL
BEGIN
update product set pro_name=pro_names,qty=qtys,price=prices,cated_id=cate_ids,unit_id=unit_ids,brand_id=brand_ids,guarantee=guarantees,type=types,promotion=promotions,qtyalert=qtyalerts,status=statuss where pro_id=pro_ids;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product2` (IN `pro_ids` VARCHAR(30), IN `qtys` INT(11), IN `prices` DECIMAL(11,2), IN `cate_ids` INT(11), IN `unit_ids` INT(11), IN `brand_ids` INT(11), IN `guarantees` INT(11), IN `types` VARCHAR(10), IN `promotions` DECIMAL(11,2), IN `qtyalerts` INT(11), IN `statuss` VARCHAR(50), IN `pro_names` VARCHAR(50), IN `img_paths` VARCHAR(1000))  NO SQL
BEGIN
update product set pro_name=pro_names,qty=qtys,price=prices,cated_id=cate_ids,unit_id=unit_ids,brand_id=brand_ids,guarantee=guarantees,type=types,promotion=promotions,qtyalert=qtyalerts,status=statuss,
img_path=img_paths where pro_id=pro_ids;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bimg_path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `bimg_path`) VALUES
(8, 'JBL', 'img_5e75f7dc927c4.png'),
(9, 'Sony', 'img_5ed5f1e577c05.png'),
(10, 'BOSE', 'img_5e75f7ef56948.png'),
(11, 'GARMIN', 'img_5e75f7fc2f69f.jpeg'),
(13, 'Jabra', 'img_5e75f80805044.jpg'),
(14, 'Huawei', 'img_5e75f814c6986.png'),
(15, 'Marshall', 'img_5e75f820d8c91.png'),
(16, 'Logitech', 'img_5e75f8abe026b.png'),
(17, 'B&O', 'img_5e75f8b44f1ad.png'),
(19, 'SUUNTO', 'img_5e75f8c5ec0d7.png'),
(20, 'harman', 'img_5e75f8d001edf.jpg'),
(22, 'CORSAIR', 'img_5e75f8da6cc2e.png'),
(23, 'beyerdynamic', 'img_5e75f8e652922.jpg'),
(24, 'SteelSeries', 'img_5e75f8f33a69a.png'),
(25, 'plantronics', 'img_5e75f91cb1ea0.png'),
(26, 'GoPro', 'img_5e75f927380a9.jpg'),
(27, 'fitbit', 'img_5e75f93973e31.png'),
(29, 'Fobase', 'img_5e75f95267c55.jpeg'),
(32, 'OPHTUS', 'img_5ed3c7262d486.png'),
(33, 'LANGTU', 'img_5ed5f05bb0bb7.png'),
(34, 'ASUS', 'img_5ed5f32a14da6.png'),
(35, 'SADES', 'img_5ed5f19200d3e.png'),
(36, 'RAZER', 'img_5ed5f1a0dcec8.png'),
(37, 'GIGABYTE', 'img_5ed6450a04ad9.png'),
(38, 'ACER', 'img_5ed5f1d036884.png'),
(39, 'ALIENWARE', 'img_5ed5f21e543ed.png'),
(40, 'AOC', 'img_5ed5f232ad315.png'),
(41, 'SAMSUNG', 'img_5ed5f2440ffc8.png'),
(42, 'APPLE', 'img_5ed5f254d7b35.png'),
(43, 'LENOVO', 'img_5ed5f278ae4e1.png'),
(44, 'DELL', 'img_5ed5f2a88a86c.png'),
(45, 'HP', 'img_5ed5f2cde92e4.png'),
(46, 'INTEL', 'img_5ed5f341e06f7.png'),
(47, 'HYPERX', 'img_5ed5f3518a8d0.png'),
(48, 'MSI', 'img_5ed5f3caadcb4.png'),
(49, 'ROG', 'img_5ed5f3ed8a1bf.png'),
(50, 'ZOWIE', 'img_5ed5f41aaeb4b.png'),
(51, 'DAREU', 'img_5ed5f7b27d2f1.png'),
(52, 'XIAOMI', 'img_5ed5f8087ec33.png'),
(53, 'ZOTAC', 'img_5ed5f93ba11f1.png'),
(54, 'SANDISK', 'img_5ed5f96bef18f.png'),
(55, 'UGREEN', 'img_5eda14e70c230.png'),
(56, 'Tenda', 'img_5eda1554a9117.jpg'),
(57, 'Alctron', 'img_5eda15a6b7c56.jpg'),
(58, 'CACZI', 'img_5eda15edf3f4f.png'),
(60, 'YINDIAO', 'img_5ee1c7bb27a9a.jpeg'),
(61, 'Inphic', 'img_5eda16e99ca93.png'),
(62, 'NUOXI', 'img_5ee1c80f8a83e.jpeg'),
(63, 'Fantech', 'img_5eda1a847fa80.png'),
(64, '?', 'img_5ee1c8a3af829.png'),
(65, 'Flydigi', 'img_5ee23ef4d5da0.png'),
(66, 'Baseus', 'img_5ee24e22098c1.png'),
(67, 'Letton', 'img_5ee328a23e0e7.png'),
(68, 'Magic Refiner', 'img_5ee33b3a090c4.jpg'),
(69, 'PHILIPS', 'img_5ee9c98cec715.png'),
(70, 'ຮຸ່ງອາລຸນ', 'img_5f06bc9c42055.png'),
(71, 'ອານຸສິດ', 'img_5f06bcb4680ae.jpg'),
(72, 'RK ', 'img_5f1fa21737655.jpeg'),
(73, 'Aula', 'img_5f1fa248e9a7c.png'),
(74, 'Plextone', 'img_5f44bdc24aded.png'),
(75, 'MEMO', 'img_5f44c51d712e1.jpg'),
(76, 'Nubwo', 'img_6011744d800e1.png'),
(77, 'EGA', 'img_60ae45e8c5342.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cate_id`, `cate_name`, `img_path`) VALUES
(3, 'ຫູຟັງ', 'img_5e6e56606e6e2.ico'),
(4, 'ລຳໂພງ', 'img_5e6e567381f38.ico'),
(5, 'ເກມມິ່ງເກຍ', 'img_5eda10a99c5d6.JPG'),
(6, 'Wearable', 'img_5e6e56e9960eb.ico'),
(7, 'ອຸປະກອນເສີມ', 'img_5e6e570dc60c8.ico'),
(8, 'Drone & Camera', 'img_5e6e5719cffc9.ico'),
(9, 'Professional Audio', 'img_5e6e572aee3b4.ico'),
(14, 'ແວ່ນຕາ', 'img_5ed3c6e3b0b77.jpg'),
(16, 'CCTV', 'img_60e816e48ea8e.jpeg'),
(17, 'Network', 'img_5ed9ffb27d25c.JPG'),
(18, 'Printer', 'img_5ed9ffd3c9634.JPG'),
(19, 'Projector', 'img_5ed9ffea71483.JPG'),
(20, 'Notebook', 'img_5eda01b0ca994.JPG'),
(21, 'Mobile & Table', 'img_5eda01db1c4bd.JPG'),
(22, 'Desktop & AIO & Server', 'img_5eda0272ef421.JPG'),
(23, 'Computer Hardware (DIY)', 'img_5eda02aa9dbd6.JPG'),
(24, 'Monitor', 'img_5eda031746a5c.JPG'),
(25, 'Keyboard', 'img_5eda04f5d44e2.JPG'),
(26, 'POS Product', 'img_5eda0f627cdf7.JPG'),
(27, 'Game Console', 'img_5eda10679f628.JPG'),
(28, 'Mouse', 'img_5ee1cd227a25f.png'),
(29, 'Mouse Pad', 'img_5ee1cd8e3b0a3.png'),
(30, 'ຄ່າສົ່ງ', '');

-- --------------------------------------------------------

--
-- Table structure for table `categorydetail`
--

CREATE TABLE `categorydetail` (
  `cated_id` int(11) NOT NULL,
  `cated_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cate_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorydetail`
--

INSERT INTO `categorydetail` (`cated_id`, `cated_name`, `cate_id`) VALUES
(2, 'ຫູຟັງ Bluetooth & Wireless', 3),
(3, 'ຫູຟັງ Headset & Earphones', 3),
(4, 'ຫູຟັງອອກກຳລັງກາຍ', 3),
(10, 'ລຳໂພງໄຮ້ສາຍ (Wireless)', 4),
(11, 'ລຳໂພງບ້ານ', 4),
(12, 'ລຳໂພງພົກພາ', 4),
(13, 'ລຳໂພງຄອມພິວເຕີ', 4),
(15, 'ລຳໂພງອັດສະລິຍະ', 4),
(16, 'Finess Tracker', 6),
(17, 'Sport Watch', 6),
(18, 'ສາຍສາກ ແລະ ອຸປະກອນສາກໄຟ', 7),
(19, 'ແບັດເຕີລີສຳຮອງ', 7),
(20, 'ແວ່ນຕາກັນແສງສີຟ້າ', 14),
(21, 'Mouse ', 28),
(22, 'Keyboard', 25),
(23, 'Keyboard & Mouse', 25),
(24, 'Mouse Pad ', 29),
(25, 'Fake CCTV', 16),
(26, 'Notebook Gaming', 20),
(27, 'Notebook', 20),
(28, 'Notebook 2in1', 20),
(29, 'All-in-one PC', 22),
(30, 'Desktop PC', 22),
(31, 'Mini PC', 22),
(32, 'Server', 22),
(33, 'Gaming Desktop', 22),
(34, 'Gaming Table', 5),
(35, 'Gaming Chair', 5),
(36, 'VR', 5),
(37, 'Microphone', 4),
(38, 'Injet Printer', 18),
(39, 'Laser Printer', 18),
(40, 'Dot Matrix Printer', 18),
(41, 'Scanner / FAX', 18),
(42, 'Ink', 18),
(43, 'Projector', 19),
(44, 'Smartphone', 21),
(45, 'Tablet', 21),
(46, 'Smart IP Camera', 16),
(47, 'IP Camera', 16),
(48, 'ຖົງນິ້ວ', 5),
(49, 'Wifi PC', 17),
(51, 'USB', 7),
(52, 'USB HUB', 7),
(53, 'Barcode Scanner', 26),
(54, 'Barcode Printer', 26),
(55, 'Cash Drawer', 26),
(56, 'Paper / Ribbon', 26),
(57, 'Mouse Pad RGB', 29),
(58, 'Mouse Wireless ', 28),
(59, 'Keyboard Wireless', 25),
(60, 'Mechanical', 25),
(61, 'KeyboardxMousexHeadset', 25),
(62, 'ບໍລິສັດຂົນສົ່ງ', 30),
(63, 'Cooling', 7);

-- --------------------------------------------------------

--
-- Table structure for table `cover`
--

CREATE TABLE `cover` (
  `id` int(11) NOT NULL,
  `img_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cover`
--

INSERT INTO `cover` (`id`, `img_path`) VALUES
(6, 'img_5ed3c4fbddfe2.jpg'),
(7, 'img_5ed3c51b22b0a.jpg'),
(8, 'img_5ed3c621be40d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `credit_card`
--

CREATE TABLE `credit_card` (
  `card_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ac_no` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ac_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_card`
--

INSERT INTO `credit_card` (`card_id`, `ac_no`, `ac_name`, `img_path`) VALUES
('BCEL ONE', '110-12-0000934646-001', 'NOPPHALAT XAYYAVONG MR', 'img_5ed3d9145815b.png');

-- --------------------------------------------------------

--
-- Table structure for table `cupon`
--

CREATE TABLE `cupon` (
  `cupon_key` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cupon`
--

INSERT INTO `cupon` (`cupon_key`, `qty`, `price`) VALUES
('Nopz10', 9, '10000.00'),
('Nopz20', 9, '20000.00'),
('Nopz49', 9, '49000.00'),
('Nopz5', 9, '5000.00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cus_surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel_app` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_surname`, `gender`, `address`, `tel`, `email`, `tel_app`, `pass`, `fb_id`) VALUES
(1, 'ບຸນນະກອນ', 'ໄຊທິລາດ', 'ຊາຍ', 'ບ້ານ ພະຂາວ ເມືອງໄຊເສດຖາ ນະຄອນຫຼວງວຽງຈັນ', '020-5555-6666', 'bon@hotmail.com', '020-2222-33333', '202cb962ac59075b964b07152d234b70', NULL),
(2, 'ບຸນພິທັກ', 'ໄຊປັນຍາ', 'ຍິງ', 'ບ້ານ ດົງໂດກ ເມືອງໄຊທານີ ນະຄອນຫຼວງວຽງຈັນ', '020-2333-1111', 'boun@hotmail.com', '020-3333-1111', '202cb962ac59075b964b07152d234b70', NULL),
(3, 'ເພັດສະພົນ', 'ແກ້ວປະເສີດ', 'ຊາຍ', 'ບ້ານ ສີໄຄທົ່ງ ເມືອງ ສີໂຄດຕະຄອງ ນະຄອນຫຼວງວຽງຈັນ', '020-1123-2323', 'phet@hotmail.com', '020-444123-12313', '202cb962ac59075b964b07152d234b70', NULL),
(7, 'souksavath', 'phongphayosith', 'ຊາຍ', 'M & N Building, Ground floor, Room No.70/101-103, Souphanouvong Avenue, Khounta Thong,Sikhotabong District, Vientiane, Laos', '+856 20 5232 9555', 'souksavath@hotmail.com', '', '202cb962ac59075b964b07152d234b70', NULL),
(13, '学生苏克', NULL, NULL, NULL, NULL, 'souksavath.52221881@gmail.com', NULL, '202cb962ac59075b964b07152d234b70', '528564037803218'),
(14, 'ລູກຄ້າທົ່ວໄປ', NULL, NULL, NULL, NULL, NULL, NULL, '202cb962ac59075b964b07152d234b70', NULL),
(15, 'MR.  souksawat soulivanh ', 'soulivanh ', 'ຊາຍ', 'Thongkhunkham', '54939555', 'Souksawat@verisette.com', '+8562077898984', '202cb962ac59075b964b07152d234b70', NULL),
(16, 'nope', 'syv', 'ຊາຍ', 'vt', '54455777', 'nopphalatsyv@gmail.com', '02054455777', '202cb962ac59075b964b07152d234b70', NULL),
(17, 'Phonz', 'Zzz', 'ຊາຍ', 'Donnoun', '55552372', 'niphon4566@hotmail.com', '55552372', '202cb962ac59075b964b07152d234b70', NULL),
(18, 'Noungning', 'Lattana', 'ຍິງ', 'Bokeo', '02052005333', 'nopeningsyv@gmail.com', '', '202cb962ac59075b964b07152d234b70', NULL),
(19, 'Thepsimeuang', 'Chanthavixay', 'ຊາຍ', 'ບ້ານປາກທ້າງ', '02056638855', 'shadowshaman490@gmail.com', '02056638855', '202cb962ac59075b964b07152d234b70', NULL),
(20, 'Sam', 'Mangkone', 'ຊາຍ', '-', '-', 'sam@mangkone.com', '-', '202cb962ac59075b964b07152d234b70', NULL),
(21, 'Leo', 'Sith', 'ຊາຍ', 'Donokhoum 12, home 197', '2055848355', 'leoo.sith@gmail.com', '2055848355', '202cb962ac59075b964b07152d234b70', NULL),
(22, 'ຕ້ອມ', 'ມະນີວອນ', 'ຊາຍ', 'ປາກມອງ', '02098918819', 'mobileahua99@gmail.com', '02059745336', '202cb962ac59075b964b07152d234b70', NULL),
(23, 'ທ້າວ. ຄຳຫວັນ', 'ຄຳສະເດັດ', 'ຊາຍ', 'ບ້ານໜອງໜ້ຽງ', '02054803421', 'fgy3214@gmail.com', '02054803421', '202cb962ac59075b964b07152d234b70', NULL),
(24, 'ຫັດ', 'ທຸມທາ', 'ຊາຍ', 'ທ່າລາດ', '02078828639', 'hhathttw@gmail.com', '02078828639', '202cb962ac59075b964b07152d234b70', NULL),
(25, 'khola', 'mahalath', 'ຊາຍ', 'ແຂວງບໍ່ແກ້ວ', '02056411828', 'souvanxai1106@gmail.com', '02056411828', '202cb962ac59075b964b07152d234b70', NULL),
(26, 'My Souksomphone', 'Boutsakone', 'ຊາຍ', 'ບ້ານໂນນສະຫງ່າ', '02099138280', 'souksonpons@gmail.com', '', '202cb962ac59075b964b07152d234b70', NULL),
(27, 'Niphon', 'SCTL', 'ຊາຍ', 'Donnoun', '55553372', 'Niphonzz567@gmail.com', '55552372', '202cb962ac59075b964b07152d234b70', NULL),
(28, 'Aek', 'Sandee', 'ຊາຍ', 'ບ້ານທ່າແຂກ', '2091179080', 'huaweilao5935@gmail.com', '', '202cb962ac59075b964b07152d234b70', NULL),
(29, 'ລູ່ຢ່າງ', 'ຈົ່ງວາດສະໜາ', 'ຊາຍ', 'ວຽງຈັນ', '02059293531', 'em58702284@gmail.com', '02059293531', '202cb962ac59075b964b07152d234b70', NULL),
(30, 'ແອັບເປີ້ນ', 'ສີບຸນລ້ຽງ', 'ຊາຍ', 'ສະຫວັນນະເຂດ', '0209357551', 'yin92735065@gmail.com', '0209357551', '202cb962ac59075b964b07152d234b70', NULL),
(31, 'Phouthavong', 'Chounlaboun', 'ຊາຍ', 'Vientiane capital', '8562052526731', 'theevilocker0@gmail.com', '8562093989180', '202cb962ac59075b964b07152d234b70', NULL),
(32, 'An operation uao was performed to send the receipt', 'An operation uao was performed to send the receipt', '1', 'An operation uao was performed to send the receipt - see the document http://apple.com', 'valrysmagin9977@gmail.com', 'valrysmagin9977@gmail.com', 'valrysmagin9977@gmail.com', '202cb962ac59075b964b07152d234b70', NULL),
(33, 'Chue', 'xiong', 'ຊາຍ', ' ບ້ານຕາມມີໄຊ', '02078039397', 'noobseexyooj@gmail.com', '02078039397', '202cb962ac59075b964b07152d234b70', NULL),
(34, 'Kird', 'Kingdom', 'ຊາຍ', 'Kang', '02097229901', 'Bounkird@gmail.com', '02054131185', '202cb962ac59075b964b07152d234b70', NULL),
(35, 'ອອຍ', 'ຄອນສີຫາລາດ', 'ຊາຍ', 'ໂຄກສີວິໄລ', '58338405', 'aoykhonesihalath@gmail.com', '58338405', '202cb962ac59075b964b07152d234b70', NULL),
(36, 'Aeknakhone', 'Chanthavong', 'ຊາຍ', 'Phontong', '02058472739', 'Aeknakhone@gmail.com', '+8613099452377', '202cb962ac59075b964b07152d234b70', NULL),
(37, 'Xaysana', 'Bounthavy', 'ຊາຍ', 'ອັດຕະປື', '2096477475', 'nuttyyy.ok@gmail.com', '2096477475', '202cb962ac59075b964b07152d234b70', NULL),
(38, 'JesseRah', 'JesseRah', '1', 'https://opendht.info/ol-dirty-bastard-1995-shimmy-shimmy-ya-cds-1480904-freedl', '82411699795', 'ioo.x.vertr.i.s@gmail.com', '85814334739', '202cb962ac59075b964b07152d234b70', NULL),
(39, 'Vanhnasook', 'Chanthamith', 'ຊາຍ', 'Dongdok', '77707052', 'vanhnasook@gmail.com', '77707052', '202cb962ac59075b964b07152d234b70', NULL),
(40, 'Fire', 'Ff', 'ຊາຍ', 'ເມືອງໝອງເເຮດ', '02094418405', 'firegg805@gmail.com', '02094418405', '202cb962ac59075b964b07152d234b70', NULL),
(41, 'Kiettisack ', 'Soda', 'ຊາຍ', 'Sisaktanak', '02055204183', 'Bobbyslayer0@gmail.com', '02055204183', '202cb962ac59075b964b07152d234b70', NULL),
(42, 'Khamsoy', 'saiyavong', 'ຊາຍ', 'Khamsoisaiyavong94@gmail.com', '+8562058157853', 'khamsoisaiyavong@gmail.com', 'Khamsoy saiyavong', '202cb962ac59075b964b07152d234b70', NULL),
(43, 'sitsana', 'thongsakhom ', 'ຊາຍ', 'luangprabang', '2076870250', 'sitsanathongsakhom69@gmail.com', '54165197', '202cb962ac59075b964b07152d234b70', NULL),
(44, 'Smile', 'Laos', 'ຊາຍ', 'ບ້ານຫນອງສະ', '+8562096124548', 'supperxddd@gmail.com', '+8562096124548', '202cb962ac59075b964b07152d234b70', NULL),
(45, 'Pepo', 'Vanxay', 'ຊາຍ', 'ສະພານທອງ(ໃຕ້)', '02059783891', 'Vkeobounsool@gmail.com', '02059783891', '202cb962ac59075b964b07152d234b70', NULL),
(46, 'Mayry', 'Ouankhamchan', 'ຍິງ', 'ບ້ານພ້າວ-ເມືອງຫາດຊາຍຟອງ', '2029180939', 'mayrysavityoffice@gmail.com', '2029180939', '202cb962ac59075b964b07152d234b70', NULL),
(47, 'Mayry sdl', 'Soudalat', 'ຍິງ', 'ບ້ານພ້າວ- ເມືອງຫາດຊາຍຟອງ', '2029180939', 'soudalatmayouankahmchan@gmail.com', '2029180939', '202cb962ac59075b964b07152d234b70', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `deli_id` int(11) NOT NULL,
  `deli_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`deli_id`, `deli_name`, `img_path`) VALUES
(2, 'ຮູ້ງອາລຸນ', 'img_5e54feea87210.png'),
(3, 'NTC', 'img_5e5510a0a6179.png');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `work_start` date DEFAULT NULL,
  `end_work` date DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_surname`, `gender`, `dob`, `address`, `tel`, `email`, `pass`, `status`, `work_start`, `end_work`, `img_path`) VALUES
('002', 'admin', 'GAME GADGET', 'ຊາຍ', '2020-02-07', 'address', '54455777', 'gamegadgetlao@gmail.com', '202cb962ac59075b964b07152d234b70', 1, '2020-02-07', '2020-02-07', ''),
('124', 'Nopphalat', 'SYV', 'ຊາຍ', '2020-02-05', 'Lao Airlines Building 7th Floor, Manthatourath Road, Xiengyeun Village, Chantabouly District, Vientiane Capital, Lao P.D.R (Headquarter)', '+856 2054455777', 'nopphalatsyv@gmail.com', '202cb962ac59075b964b07152d234b70', 2, '2015-10-05', '2020-02-25', 'img_5ed9ddc4aac7e.jpg'),
('S001', 'Ta', NULL, NULL, NULL, NULL, NULL, 'souksavath@verisette.com', '202cb962ac59075b964b07152d234b70', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `function_product`
--

CREATE TABLE `function_product` (
  `function_id` int(11) NOT NULL,
  `func_id` int(11) DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `function_product`
--

INSERT INTO `function_product` (`function_id`, `func_id`, `pro_id`, `content`) VALUES
(16, 1, '6971880290123', 'Wireless'),
(17, 3, '6971880290123', 'ເມົ້າ, ຫົວສຽບ wireless, ຄູ່ມື, ສາຍສາກ'),
(18, 1, '6956766906237', 'jack 3.5mm'),
(19, 2, '6956766906237', 'Gaming Headset with Microphone'),
(20, 3, '6956766906237', '1 x Sades Wolf Spirit'),
(21, 3, '6956766906237', '1 x ຄູ່ມື'),
(22, 1, '6956766906237', 'USB for light'),
(23, 2, '6956766906237', 'ພົກພາສະດວກ'),
(24, 1, '6950386491234', 'USB'),
(25, 3, '6950386491234', '1 x Pw5 mouse'),
(26, 1, '6943106977309', 'Wireless'),
(27, 3, '6943106977309', '1 x A4 mouse'),
(28, 3, '6943106977309', '1 x ຄູ່ມື'),
(29, 1, '6931594002009', 'USB'),
(30, 3, '6931594002009', ' 1 x j200 mouse');

-- --------------------------------------------------------

--
-- Table structure for table `func_pro`
--

CREATE TABLE `func_pro` (
  `func_id` int(11) NOT NULL,
  `func_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `func_pro`
--

INSERT INTO `func_pro` (`func_id`, `func_name`) VALUES
(1, 'ການເຊື່ອມຕໍ່'),
(2, 'Key-Highlight'),
(3, 'ອຸປະກອນພາຍໃນກ່ອງ');

-- --------------------------------------------------------

--
-- Table structure for table `imports`
--

CREATE TABLE `imports` (
  `imp_id` int(11) NOT NULL,
  `imp_bill` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `imp_date` date DEFAULT NULL,
  `imp_time` time DEFAULT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `imports`
--

INSERT INTO `imports` (`imp_id`, `imp_bill`, `order_id`, `sup_id`, `emp_id`, `pro_id`, `qty`, `price`, `imp_date`, `imp_time`, `note`) VALUES
(20, '1', 1, 4, '124', '6956766919626', 3, '192000.00', '2020-06-17', '23:01:10', 'ok'),
(21, '1', 1, 4, '124', '6123456789085', 3, '382000.00', '2020-06-17', '23:01:54', 'ok'),
(22, '1', 1, 4, '124', '6959630211895', 7, '120000.00', '2020-06-17', '23:02:22', 'ok'),
(23, '1', 1, 4, '124', '6959630211901', 1, '120000.00', '2020-06-17', '23:02:33', 'ok'),
(24, '1', 1, 4, '124', '6956766906718', 1, '120000.00', '2020-06-17', '23:02:45', 'ok'),
(25, '1', 1, 4, '124', '6947273311058', 15, '152000.00', '2020-06-17', '23:03:00', 'ok'),
(26, '1', 1, 4, '124', '6931407600620', 8, '225000.00', '2020-06-17', '23:03:17', 'ok'),
(27, '1', 1, 4, '124', '6123456784547', 11, '382000.00', '2020-06-17', '23:04:03', 'ok'),
(28, '1', 1, 4, '124', '6123456789016', 3, '860000.00', '2020-06-17', '23:04:13', 'ok'),
(29, '1', 1, 4, '124', '6123456789023', 30, '475000.00', '2020-06-17', '23:04:25', 'ok'),
(30, '1', 1, 4, '124', '6123456789030', 3, '475000.00', '2020-06-17', '23:04:43', 'ok'),
(31, '1', 1, 4, '124', '6123456789047', 3, '475000.00', '2020-06-17', '23:04:57', 'ok'),
(32, '1', 1, 4, '124', '6123456789054', 2, '475000.00', '2020-06-17', '23:05:13', 'ok'),
(33, '1', 1, 4, '124', '6123456789061', 4, '475000.00', '2020-06-17', '23:05:29', 'ok'),
(34, '1', 1, 4, '124', '6123456789078', 2, '475000.00', '2020-06-17', '23:05:46', 'ok'),
(35, '2', 2, 4, '124', '6951613917312', 1, '230000.00', '2020-06-18', '13:38:58', 'ok'),
(36, '2', 2, 4, '124', '6950589905798', 1, '300000.00', '2020-06-18', '13:39:22', 'ok'),
(37, '2', 2, 4, '124', '6950589906795', 1, '220000.00', '2020-06-18', '13:39:34', 'ok'),
(38, '2', 2, 4, '124', '6956766907364', 1, '130000.00', '2020-06-18', '13:40:00', 'ok'),
(39, '2', 2, 4, '124', '6933153602125', 1, '217000.00', '2020-06-18', '13:40:41', 'ok'),
(40, '2', 2, 4, '124', '6971880290123', 2, '84000.00', '2020-06-18', '13:40:59', 'ok'),
(41, '2', 2, 4, '124', '6943106977309', 1, '530000.00', '2020-06-18', '13:41:13', 'ok'),
(42, '3', 3, 4, '124', '6123456789542', 5, '53000.00', '2020-06-18', '14:17:42', 'ok'),
(43, '3', 3, 4, '124', '6123456789559', 15, '84000.00', '2020-06-18', '14:18:14', 'ok'),
(44, '4', 4, 5, '124', '6183450789092', 20, '370000.00', '2020-06-18', '14:18:30', 'ok'),
(45, '4', 4, 5, '124', '6123456784547', 10, '370000.00', '2020-06-18', '14:19:50', 'ok'),
(46, '3', 3, 4, '124', '6123456789542', 5, '53000.00', '2020-06-26', '22:42:08', 'ok'),
(47, '4', 4, 5, '124', '6123456789061', 5, '462000.00', '2020-06-26', '22:42:57', 'ok'),
(48, '5', 5, 4, '124', '6947273311058', 10, '152000.00', '2020-07-05', '14:58:03', 'ok'),
(49, '5', 5, 4, '124', '6956766919626', 5, '192000.00', '2020-07-05', '14:58:53', 'ok'),
(51, '6', 6, 4, '124', '6947273311058', 12, '148000.00', '2020-07-10', '17:19:02', 'ok'),
(52, '6', 6, 4, '124', '6956766919626', 7, '180000.00', '2020-07-10', '17:20:36', 'ok'),
(55, '001', 3, 2, '002', '02822112', 5, '200000.00', '2021-07-01', '33:19:20', NULL),
(56, 'IMP01', 1, 5, 'S001', '6943106977309', 2, '50000.00', '2021-07-18', '20:47:34', 'test'),
(57, 'IMP01', 1, 2, 'S001', '6943106977309', 10, '10000.00', '2021-07-18', '20:48:46', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `listimports`
--

CREATE TABLE `listimports` (
  `imp_id` int(11) NOT NULL,
  `imp_bill` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `imp_date` date DEFAULT NULL,
  `imp_time` time DEFAULT NULL,
  `note` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listorderdetail`
--

CREATE TABLE `listorderdetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listselldetail`
--

CREATE TABLE `listselldetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `listselldetail`
--

INSERT INTO `listselldetail` (`detail_id`, `pro_id`, `qty`, `color_id`, `cus_id`) VALUES
(108, '6956766906718', 1, 0, 19),
(109, '6947273311058', 1, 0, 19),
(110, '6947273311058', 1, 0, 19),
(111, '6947273311058', 1, 0, 19),
(112, '6950589905798', 1, 0, 20),
(124, '6932849427530', 1, 0, 21),
(125, '6959630211895', 1, 0, 21),
(128, '6956766907388', 1, 0, 26),
(129, '6948391227290', 1, 0, 26),
(130, '6948391226996', 1, 0, 27),
(131, '6948391233918', 1, 0, 36),
(139, '6920377905040', 1, 0, 16),
(142, '02822112', 1, 0, 39),
(143, '6971141390449', 1, 0, 39),
(146, '6956766907388', 1, 0, 40),
(147, '6956766907388', 1, 0, 40),
(148, '6970202291580', 1, 0, 40),
(152, '6123456789061', 1, 0, 41),
(156, '6972661283211', 1, 0, 45),
(157, '6905710316011', 1, 0, 46),
(158, '6905710316011', 1, 0, 46),
(159, '6905710316011', 1, 0, 46),
(160, '6905710316011', 1, 0, 46),
(161, '6905710316011', 1, 0, 46),
(162, '6905710316011', 1, 0, 46),
(163, '6905710316011', 1, 0, 46),
(164, '6905710316011', 1, 0, 46),
(165, '6905710316011', 1, 0, 46),
(166, '6957120230012', 1, 0, 46),
(168, '6972661283136', 1, 0, 47),
(169, '6905710316011', 1, 0, 47),
(170, '6905710316011', 1, 0, 47);

-- --------------------------------------------------------

--
-- Table structure for table `listselldetail2`
--

CREATE TABLE `listselldetail2` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `listselldetail2`
--

INSERT INTO `listselldetail2` (`detail_id`, `pro_id`, `qty`, `emp_id`) VALUES
(990, '0311000101', 1, 'S001');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model`, `name`) VALUES
(1, 'ດ້ານໜ້າ'),
(2, 'ດ້ານຂ້າງຊາຍ'),
(3, 'ດ້ານຂາງຂວາ'),
(4, 'ດ້ານຫຼັງ'),
(5, 'ດ້ານເທິງ'),
(6, 'ດ້ານກ້ອງ');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`detail_id`, `pro_id`, `qty`, `price`, `order_id`) VALUES
(14, '6956766919626', 3, '192000.00', 1),
(15, '6959630211895', 7, '120000.00', 1),
(16, '6959630211901', 1, '120000.00', 1),
(17, '6956766906718', 1, '120000.00', 1),
(18, '6947273311058', 15, '152000.00', 1),
(19, '6931407600620', 8, '225000.00', 1),
(20, '6123456784547', 11, '382000.00', 1),
(21, '6123456789016', 3, '860000.00', 1),
(22, '6123456789023', 30, '475000.00', 1),
(23, '6123456789030', 3, '475000.00', 1),
(24, '6123456789047', 3, '475000.00', 1),
(25, '6123456789054', 2, '475000.00', 1),
(26, '6123456789061', 4, '475000.00', 1),
(27, '6123456789078', 2, '475000.00', 1),
(28, '6123456789085', 3, '382000.00', 1),
(29, '6951613917312', 1, '230000.00', 2),
(30, '6950589905798', 1, '300000.00', 2),
(31, '6950589906795', 1, '220000.00', 2),
(32, '6956766907364', 1, '130000.00', 2),
(33, '6933153602125', 1, '217000.00', 2),
(34, '6971880290123', 2, '84000.00', 2),
(35, '6943106977309', 1, '530000.00', 2),
(36, '6123456789542', 5, '53000.00', 3),
(37, '6123456789559', 15, '84000.00', 3),
(39, '6183450789092', 20, '370000.00', 4),
(40, '6123456789061', 5, '462000.00', 4),
(41, '6123456784547', 10, '370000.00', 4),
(42, '6947273311058', 10, '152000.00', 5),
(43, '6956766919626', 5, '192000.00', 5),
(45, '6947273311058', 12, '148000.00', 6),
(46, '6956766919626', 7, '180000.00', 6),
(47, '6943106977309', 2, '20000.00', 7),
(48, '6930209303746', 1, '50000.00', 8),
(49, 'KH200BB', 3, '500000.00', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sup_id` int(11) DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `order_time` time DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen1` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_accept` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_buy` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `emp_id`, `sup_id`, `amount`, `order_date`, `order_time`, `status`, `img_path`, `seen1`, `seen2`, `user_accept`, `rate_id`, `rate_buy`) VALUES
(1, '124', 4, '34564000.00', '2020-06-17', '22:59:07', 'ອະນຸມັດ', NULL, '0', '0', NULL, 'LAK', NULL),
(2, '124', 4, '1795000.00', '2020-06-18', '13:37:37', 'ອະນຸມັດ', NULL, '0', '0', NULL, 'LAK', NULL),
(3, '124', 4, '1525000.00', '2020-06-18', '14:08:55', 'ອະນຸມັດ', NULL, '0', '1', NULL, 'USD', NULL),
(4, '124', 5, '13410000.00', '2020-06-18', '14:15:16', 'ອະນຸມັດ', NULL, '0', '1', NULL, 'LAK', NULL),
(5, '124', 4, '2480000.00', '2020-07-05', '14:56:48', 'ອະນຸມັດ', NULL, '0', '1', NULL, 'USD', NULL),
(6, '124', 4, '3036000.00', '2020-07-09', '16:48:36', 'ອະນຸມັດ', NULL, '0', '1', NULL, 'THB', NULL),
(7, 'S001', 5, '40000.00', '2021-07-18', '19:52:32', 'ບໍ່ອະນຸມັດ', NULL, '1', '1', NULL, 'LAK', '1.00'),
(8, 'S001', 2, '1550000.00', '2021-07-22', '10:30:06', 'ຍັງບໍ່ອະນຸມັດ', NULL, '1', '0', NULL, 'LAK', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pro_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `cated_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `guarantee` int(11) DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `promotion` decimal(11,2) DEFAULT NULL,
  `qtyalert` int(11) DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_stamp` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `qty`, `price`, `cated_id`, `unit_id`, `brand_id`, `guarantee`, `type`, `promotion`, `qtyalert`, `img_path`, `status`, `time_stamp`) VALUES
('02822112', 'Lightning to jack 3.5', 0, '50000.00', 18, 9, 42, 1, 'ເດືອນ', '5000.00', 1, 'img_5edb6c5d6044b.jfif', 'Normal', '2021-07-07 11:25:51'),
('0311000101', 'HG13 CHIEF', 0, '300000.00', 3, 10, 63, 2, 'ປີ', '101000.00', 1, 'img_6011707f95348.jpeg', 'Hot', '2021-07-07 11:25:51'),
('15000', 'ຄ່າສົ່ງນະຄອນຫຼວງ', 1, '15000.00', 62, 7, 71, 1, 'ວັນ', '0.00', 100, 'img_5f06bb0451087.jpg', 'Normal', '2021-07-07 11:25:51'),
('20205181045', 'G500', 1, '500000.00', 60, 10, 33, 3, 'ເດືອນ', '241000.00', 1, 'img_5f06bd629786c.jpg', 'Hot', '2021-07-07 11:25:51'),
('20205181061', 'G100', 1, '300000.00', 61, 10, 33, 3, 'ເດືອນ', '21000.00', 1, '', 'Hot', '2021-07-07 11:25:51'),
('30000', 'ຄ່າສົ່ງຮຸ່ງອາລຸນ*', 0, '30000.00', 62, 7, 70, 3, 'ວັນ', '0.00', 100, 'img_5f06bbaba2145.png', 'Normal', '2021-07-07 11:25:51'),
('4718017371247', 'CETRA CORE', 1, '700000.00', 3, 10, 49, 6, 'ເດືອນ', '90000.00', 1, 'img_60116e3076711.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6123452789093', 'Zero Clear', 3, '1000000.00', 20, 10, 32, 3, 'ເດືອນ', '325000.00', 2, 'img_5f4253e054eda.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456484566', 'Ophtus ສາຍຕາ 50-600', 99, '1999000.00', 20, 10, 32, 1, 'ເດືອນ', '1000000.00', 5, 'img_60c46fd6476fe.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6123456484567', 'Ophtus ສາຍຕາ 50-600.', 100, '900000.00', 20, 10, 32, 1, 'ເດືອນ', '200000.00', 5, 'img_60c470cd49de7.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6123456784547', 'Classic', 5, '640000.00', 20, 9, 32, 3, 'ເດືອນ', '100000.00', 2, 'img_5eea419a03348.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789016', 'Nigthawk', 1, '2000000.00', 20, 10, 32, 1, 'ເດືອນ', '761000.00', 2, 'img_5eea41a95874c.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789023', 'Zero amber', 7, '1025000.00', 20, 9, 32, 1, 'ເດືອນ', '350000.00', 2, 'img_5eea41b9c4d80.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789030', 'Stellar black-gold', 1, '1025000.00', 20, 10, 32, 1, 'ເດືອນ', '350000.00', 2, 'img_5eea41caaf9b1.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789047', 'Stellar demi-gold', 0, '1025000.00', 20, 9, 32, 1, 'ເດືອນ', '380000.00', 2, 'img_5eea41d80a235.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789054', 'Stellar white', 0, '1025000.00', 20, 9, 32, 1, 'ເດືອນ', '370000.00', 2, 'img_5eea41e9b4f95.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789061', 'Fuse black-silver', 4, '1025000.00', 20, 9, 32, 1, 'ເດືອນ', '350000.00', 2, 'img_5eea42053db76.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789078', 'Fuse demi-gold', 0, '1025000.00', 20, 9, 32, 1, 'ເດືອນ', '390000.00', 2, 'img_5eea421adecbc.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789085', 'Infinite', 4, '640000.00', 20, 9, 32, 1, 'ເດືອນ', '100000.00', 2, 'img_5eea4230d079b.jpg', 'Hot', '2021-07-07 11:25:51'),
('6123456789542', 'BT RGB 2m', 0, '130000.00', 57, 12, 64, 3, 'ເດືອນ', '41000.00', 2, 'img_5eeb8229620e5.jpg', 'Best Seller', '2021-07-07 11:25:51'),
('6123456789559', 'BT RGB 3m', 0, '150000.00', 57, 12, 64, 3, 'ເດືອນ', '51000.00', 2, 'img_5eeb8121caa3a.jpg', 'Best Seller', '2021-07-07 11:25:51'),
('6183450789092', 'Hover', 1, '690000.00', 20, 9, 32, 1, 'ເດືອນ', '80000.00', 3, 'img_5eea42448a59e.jpg', 'Hot', '2021-07-07 11:25:51'),
('6188456789017', 'F1', 0, '200000.00', 3, 10, 64, 3, 'ເດືອນ', '111000.00', 1, 'img_5f0f3cdc937a3.jpg', 'Hot', '2021-07-07 11:25:51'),
('6427894571441', 'ສາຍ OTG micro USB', 6, '50000.00', 18, 12, 64, 3, 'ເດືອນ', '11000.00', 2, 'img_5f06a1fb935d9.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6427894571442', 'ສາຍ OTG Type-C', 3, '50000.00', 18, 12, 64, 1, 'ເດືອນ', '11000.00', 2, 'img_5f06a2594b290.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6905710316011', 'H101 LITE', 0, '269000.00', 3, 10, 77, 3, 'ເດືອນ', '100000.00', 1, 'img_60ae46907e9ed.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6920201015013', 'GH10 ', 0, '200000.00', 3, 10, 45, 3, 'ເດືອນ', '21000.00', 1, 'img_60cdfed121e73.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6920377901684', 'G402', 1, '495000.00', 21, 10, 16, 3, 'ເດືອນ', '100000.00', 1, 'img_5f44d42073470.webp', 'Hot', '2021-07-07 11:25:51'),
('6920377905040', 'G213 PRODIGY', 1, '685000.00', 22, 10, 16, 6, 'ເດືອນ', '100000.00', 1, 'img_5f44d68f4213e.jfif', 'Hot', '2021-07-07 11:25:51'),
('6920377908225', 'G502', 0, '600000.00', 21, 10, 16, 3, 'ເດືອນ', '21000.00', 1, 'img_5f44d0dd24da1.jpg', 'Hot', '2021-07-07 11:25:51'),
('6922456700225', 'G1 Mouse&Keyboard Mobile', 0, '300000.00', 23, 10, 64, 1, 'ເດືອນ', '11000.00', 1, 'img_6094b4a221f7d.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6925281940439', 'PS2200', 1, '429000.00', 13, 10, 8, 3, 'ເດືອນ', '100000.00', 1, 'img_601172cb1a73c.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6925281940453', 'PS3300', 1, '499000.00', 13, 10, 8, 3, 'ເດືອນ', '100000.00', 1, 'img_6011734cb23b1.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6927530262989', 'Touch screen game sleeve', 2, '30000.00', 48, 12, 64, 1, 'ເດືອນ', '11000.00', 1, 'img_5ee250948d11a.jpeg', 'Best Seller', '2021-07-07 11:25:51'),
('6930209303746', 'A12', 0, '189000.00', 3, 9, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_5f01c34357ce9.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6931407600477', 'Q1', 8, '300000.00', 22, 10, 65, 1, 'ເດືອນ', '101000.00', 1, 'img_5f3768e656437.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6931407600620', 'Flydigi Q1 fullset', 0, '420000.00', 23, 10, 65, 3, 'ເດືອນ', '131000.00', 2, 'img_5ee72949adbd8.jpeg', 'Best Seller', '2021-07-07 11:25:51'),
('6931407601283', 'Wasp feelers 2 finger', 1, '60000.00', 48, 12, 65, 3, 'ເດືອນ', '15000.00', 1, 'img_5ee23fa39473a.jpeg', 'Best Seller', '2021-07-07 11:25:51'),
('6931594002009', 'J200', 0, '160000.00', 21, 9, 61, 3, 'ເດືອນ', '50000.00', 1, 'img_5edb65c1b36f1.png', 'Normal', '2021-07-07 11:25:51'),
('6932849427530', 'USB Wireless N 150Mbps U2', 1, '65000.00', 49, 9, 56, 3, 'ເດືອນ', '10000.00', 1, 'img_5ee1c54a9e113.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6933064647789', 'LLANO FAN', 0, '389000.00', 63, 10, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_601176b3dab10.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6933153602125', 'MK15', 0, '300000.00', 60, 10, 68, 1, 'ເດືອນ', '15000.00', 1, 'img_5ee33ba9bf498.jpg', 'Normal', '2021-07-07 11:25:51'),
('6935280807251', 'RK-956', 1, '395000.00', 23, 10, 72, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1fa2a7429fd.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6935681701332', 'ICE COOREL FAN RGB', 0, '379000.00', 63, 10, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_60117759a485c.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6935681701370', 'ICE COOREL FAN', 1, '365000.00', 63, 10, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_60117677c28cd.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6940252365035', 'K10G', 0, '389000.00', 60, 10, 45, 3, 'ເດືອນ', '90000.00', 1, 'img_5f06c3e120ef3.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6943106977309', 'A4 Wireless', 12, '130000.00', 58, 9, 60, 3, 'ເດືອນ', '5000.00', 1, 'img_5edb56b3c4c34.jpg', 'Normal', '2021-07-07 11:25:51'),
('6947273311058', 'K006', 3, '295000.00', 61, 10, 33, 1, 'ເດືອນ', '100000.00', 2, 'img_5ee32a0599404.jpg', 'Hot', '2021-07-07 11:25:51'),
('6948391225609', 'K500F + M270', 4, '250000.00', 23, 10, 45, 3, 'ເດືອນ', '41000.00', 3, 'img_5ffd4ae915be0.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6948391226996', 'K500F', 0, '300000.00', 61, 10, 45, 3, 'ເດືອນ', '41000.00', 1, 'img_6019b0a429526.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6948391227290', 'H150', 0, '275000.00', 3, 10, 45, 3, 'ເດືອນ', '100000.00', 1, 'img_5f44ca303eb1f.jfif', 'Hot', '2021-07-07 11:25:51'),
('6948391233918', 'F2o88', 0, '579000.00', 60, 10, 73, 3, 'ເດືອນ', '300000.00', 1, 'img_5f09e71060086.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6950386491234', 'P-W5', 2, '120000.00', 21, 9, 61, 3, 'ເດືອນ', '10000.00', 1, 'img_5edb5a2a7743d.jpg', 'Normal', '2021-07-07 11:25:51'),
('6950386491296', 'V680', 0, '500000.00', 61, 10, 61, 3, 'ເດືອນ', '255000.00', 1, 'img_5f09e77bcf0ae.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6950589905798', 'EK812', 1, '400000.00', 60, 10, 51, 6, 'ເດືອນ', '41000.00', 2, 'img_5ef1c2381d614.jpg', 'Best Seller', '2021-07-07 11:25:51'),
('6950589906795', 'LK195 fullset', 1, '300000.00', 23, 10, 51, 6, 'ເດືອນ', '105000.00', 2, 'img_5ef1c0a83fa5c.jpg', 'Best Seller', '2021-07-07 11:25:51'),
('6951613917312', 'G614', 0, '300000.00', 60, 10, 69, 6, 'ເດືອນ', '1000.00', 1, 'img_5ef1c28d735db.jpg', 'Top View', '2021-07-07 11:25:51'),
('6953156254862', '3,5mm+ip Adapter', 0, '90000.00', 18, 9, 66, 1, 'ເດືອນ', '15000.00', 1, 'img_5ee3283e34e8e.', 'Normal', '2021-07-07 11:25:51'),
('6956766900396', 'Headset Stand', 6, '199000.00', 3, 9, 35, 1, 'ເດືອນ', '100000.00', 2, 'img_601179e45abf5.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6956766906237', 'Wolf Spirit', 0, '160000.00', 3, 10, 35, 3, 'ເດືອນ', '20000.00', 3, 'img_5ed9e0eb8443b.jpg', 'Top View', '2021-07-07 11:25:51'),
('6956766906718', 'K10s Green Silver', 0, '300000.00', 23, 10, 67, 1, 'ເດືອນ', '141000.00', 2, 'img_5ee32b0e26d35.jpg', 'Hot', '2021-07-07 11:25:51'),
('6956766907364', 'Whisper', 0, '200000.00', 22, 10, 35, 3, 'ເດືອນ', '21000.00', 2, 'img_5ef1c317386f2.jpg', 'Best Seller', '2021-07-07 11:25:51'),
('6956766907388', 'TS-36 REVOLVER ', 0, '200000.00', 23, 10, 35, 3, 'ເດືອນ', '1000.00', 1, 'img_5f44c72ac36d2.jpg', 'Hot', '2021-07-07 11:25:51'),
('6956766919626', 'K10s Fullset', 1, '425000.00', 61, 9, 67, 3, 'ເດືອນ', '186000.00', 2, 'img_5eea1a8a8ce6b.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6957120050016', 'Type E1', 1, '239000.00', 3, 10, 77, 1, 'ເດືອນ', '100000.00', 1, 'img_60ae4889bd888.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6957120230012', 'Webcam Type W1', 1, '519000.00', 47, 10, 77, 3, 'ເດືອນ', '100000.00', 1, 'img_60ae472070710.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6957303817894', 'ສາຍແຍກ ສຽງ&ໄມ ຂາວ', 1, '40000.00', 3, 12, 55, 6, 'ເດືອນ', '5000.00', 1, 'img_5edb74c32ed1b.jpg', 'Normal', '2021-07-07 11:25:51'),
('6957303822829', 'USB HUB 3.0', 1, '70000.00', 52, 9, 55, 6, 'ເດືອນ', '5000.00', 1, 'img_5edb72109ba03.jpg', 'Normal', '2021-07-07 11:25:51'),
('6957303836208', 'ສາຍແຍກ ສຽງ&ໄມ', 1, '40000.00', 3, 12, 55, 6, 'ເດືອນ', '5000.00', 1, 'img_5edb7472dc79c.jpg', 'Normal', '2021-07-07 11:25:51'),
('6957303857142', 'Power Adapter 1A', 1, '30000.00', 18, 9, 55, 3, 'ເດືອນ', '3000.00', 1, 'img_5edb6fc53fece.jpg', 'Normal', '2021-07-07 11:25:51'),
('6957303867141', 'Power Adapter 2.1A', 0, '35000.00', 18, 9, 55, 3, 'ເດືອນ', '0.00', 1, 'img_5edb6ed57d819.jpg', 'Normal', '2021-07-07 11:25:51'),
('6959630211895', 'K10s Black silver', 1, '320000.00', 23, 10, 67, 1, 'ເດືອນ', '141000.00', 2, 'img_5ee3269eecb14.jpg', 'Hot', '2021-07-07 11:25:51'),
('6959630211901', 'K10s White  Gold', 0, '300000.00', 23, 10, 67, 1, 'ເດືອນ', '141000.00', 2, 'img_5ee32b9d3a303.jpg', 'Hot', '2021-07-07 11:25:51'),
('6970202291580', 'GMS-M4', 1, '200000.00', 57, 9, 64, 3, 'ເດືອນ', '71000.00', 2, 'img_5f0183063316a.jpg', 'Normal', '2021-07-07 11:25:51'),
('6970202291589', 'GMS-M3', 2, '109000.00', 57, 9, 64, 3, 'ເດືອນ', '10000.00', 1, 'img_5ee1cb1bb78a6.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6970383142298', 'SUOHUANG FAN', 1, '295000.00', 63, 10, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_601175fb24e6d.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6971141390036', 'G20', 0, '239000.00', 3, 10, 74, 3, 'ເດືອນ', '100000.00', 1, 'img_5f44c26b27f5c.jpg', 'Hot', '2021-07-07 11:25:51'),
('6971141390449', 'G25', 1, '259000.00', 3, 10, 74, 3, 'ເດືອນ', '100000.00', 1, 'img_5f44bf0f5fcd7.jfif', 'Hot', '2021-07-07 11:25:51'),
('6971880290123', 'A5 Wireless', 0, '140000.00', 58, 9, 60, 3, 'ເດືອນ', '5000.00', 1, 'img_5eda1d89a787c.jpg', 'Normal', '2021-07-07 11:25:51'),
('6972470500608', 'DCX-A11 Fan', 2, '199000.00', 63, 10, 64, 1, 'ເດືອນ', '100000.00', 1, 'img_601178bb4b2a3.jpeg', 'Normal', '2021-07-07 11:25:51'),
('6972579061055', 'N1 PRO', 0, '229000.00', 3, 10, 76, 3, 'ເດືອນ', '100000.00', 1, 'img_601178170cbcf.jpeg', 'Best Seller', '2021-07-07 11:25:51'),
('6972661281071', 'Phantom X15', 3, '259000.00', 21, 10, 63, 3, 'ເດືອນ', '100000.00', 1, 'img_5f06c6284f3ea.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661281101', 'Thor II X16', 1, '269000.00', 21, 10, 63, 3, 'ເດືອນ', '100000.00', 1, 'img_5f06c5a35364d.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661283013', 'HG19 IRIS', 0, '359000.00', 3, 10, 63, 2, 'ປີ', '100000.00', 1, 'img_601171cb131b9.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661283020', 'HG 17s VISAGE II', 0, '285000.00', 3, 10, 63, 3, 'ເດືອນ', '100000.00', 1, 'img_60ae4303be8cd.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661283082', 'HG CHIEF II RGB', 0, '349000.00', 3, 10, 63, 3, 'ເດືອນ', '100000.00', 1, 'img_60ae450399f28.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661283136', 'SCAR EG2 ', 0, '200000.00', 3, 9, 63, 1, 'ເດືອນ', '31000.00', 1, 'img_5fd995385b50e.jpeg', 'Hot', '2021-07-07 11:25:51'),
('6972661283211', 'HQ52 TONE ', 0, '279000.00', 3, 10, 63, 3, 'ເດືອນ', '100000.00', 1, 'img_60ae441d4c35e.jpeg', 'Hot', '2021-07-07 11:25:51'),
('740617268331', 'CLOUD ALPHA', 1, '1200000.00', 3, 10, 47, 6, 'ເດືອນ', '110000.00', 1, 'img_60116f014dcfd.jpeg', 'Hot', '2021-07-07 11:25:51'),
('740617280012', 'Cloud Earbuds', 0, '600000.00', 3, 9, 47, 6, 'ເດືອນ', '61000.00', 1, 'img_5f2a600ca754d.jpeg', 'Hot', '2021-07-07 11:25:51'),
('7914231240308', 'X30 TERMINATOR ', 1, '640000.00', 22, 10, 76, 1, 'ປີ', '100000.00', 1, 'img_60117414ce95a.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419332510', 'DEATHADDER', 0, '339000.00', 21, 10, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1be9c9eb195.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419332831', 'BASILISK X HYPERSPEED', 0, '565000.00', 21, 10, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1be94812346.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419332909', 'VIPER MINI', 0, '395000.00', 21, 10, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1bea319f6db.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419333005', 'Deathadder V2 mini', 0, '389000.00', 21, 9, 36, 1, 'ປີ', '100000.00', 1, 'img_607f979e987de.png', 'Hot', '2021-07-07 11:25:51'),
('8886419341215', 'CYNOSA PRO', 1, '449000.00', 22, 9, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1beb4b2ab46.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419370970', 'HAMMERHEAD BT', 0, '800000.00', 3, 10, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f5f3e4d570fc.png', 'Hot', '2021-07-07 11:25:51'),
('8886419378075', 'KRAKEN X', 1, '529000.00', 3, 10, 36, 3, 'ເດືອນ', '100000.00', 1, 'img_5f1beac4d3794.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419378273', 'Hammerhead True Wireless ', 0, '1000000.00', 3, 10, 36, 3, 'ເດືອນ', '20000.00', 1, 'img_5fed57141cb47.jpeg', 'Hot', '2021-07-07 11:25:51'),
('8886419378396', 'BLACKSHARK V2 X', 0, '900000.00', 3, 10, 36, 3, 'ເດືອນ', '145000.00', 1, 'img_6089339ac8229.jpeg', 'Hot', '2021-07-07 11:25:51'),
('KH200BB', 'AK77 ພັດລົມມືຖື', 0, '195000.00', 63, 10, 75, 1, 'ເດືອນ', '100000.00', 1, 'img_5f44c67f7d5af.jpg', 'Hot', '2021-07-07 11:25:51'),
('Pop10635128175', 'X9', 0, '219000.00', 3, 10, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_5f0369b87fc36.jpeg', 'Hot', '2021-07-07 11:25:51'),
('POP20200430222', 'G58', 0, '209000.00', 3, 9, 64, 3, 'ເດືອນ', '100000.00', 1, 'img_5f01c47e29560.jpeg', 'Hot', '2021-07-07 11:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `productdetail`
--

CREATE TABLE `productdetail` (
  `id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `review_youtube` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(10000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productdetail`
--

INSERT INTO `productdetail` (`id`, `pro_id`, `img_path`, `review_youtube`, `content`, `topic_id`) VALUES
(6, '6971880290123', 'img_5eda1e12bfea5.jpg', '', '', 3),
(7, '6956766906237', 'img_5eda403cd754d.jpg', 'https://www.youtube.com/embed/SrHCfgRJEtQ', '', 1),
(8, '6956766906237', 'img_5eda472ca69f0.jpg', '', 'ເພິ່ມອັດທະລົດໃນການຫຼິ້ນເກມ  ເບິ່ງຫນັງ  ຟັງເພງ ດ້ວຍສິນຄ້າມາໃຫມ່ຂອງແບນ SADES\r\n', 3),
(9, '6956766906237', 'img_5eda4af4930c4.jpg', '', '', 2),
(10, '6950386491234', 'img_5edb5a575d6d4.jpg', '', '', 3),
(11, '6950386491234', 'img_5edb5a7966dbf.jpg', '', '', 1),
(12, '6943106977309', 'img_5edb61e4d6cc6.jpg', '', '', 3),
(14, '6931594002009', 'img_5edb66088c608.jpg', '', '', 1),
(15, '6970202291589', 'img_5ee1cbba92f1a.jpeg', '', '', 1),
(16, '6970202291589', 'img_5ee1d057bce4b.', '', '', 3),
(17, '6931407601283', 'img_5ee24025a4dfa.jpeg', '', '', 1),
(18, '6931407601283', 'img_5ee2404d1fe5b.png', '', '', 3),
(19, '6927530262989', 'img_5ee250ca7e360.jpeg', '', '', 1),
(20, '6972661281071', 'img_5f12a08131e84.jpeg', '', 'เชิญทุกท่านพบกับFANTECH X15PHANTOMMoues Gammingประสิทธิสูงและดีไซน์สุดเฉียบ !!', 3),
(21, '6972661281071', 'img_5f12a0d62935b.jpeg', '', 'ลองเสียบไฟให้ดู RGB COLOR MODE บอกได้คำเดียวว่าขนาดในรูปสวยขนาดนี้ของจริงจะสวยขนาดไหน', 1),
(22, '6972661281071', 'img_5f12a114152c8.jpeg', '', 'โปรแกรมสำหรับตั้งค่าการใช้งาน ที่ถูกออกแบบมาให้ใช้งานได้ง่ายและครบครันทุกฟังชั่น', 1),
(23, '20205181045', 'img_5f12c08c9049e.jpg', '', 'Mechanical keyboard ທີ່ມາພ້ອມກັບໄຟ RGB ປັບພຣີເຊັດໄດ້ 14 ແບບ  ເຟມແຂງແຮງທົນທານ \r\nເອົາໄປຫຼິ້ນເກມແບບຟິນໆ ຫຼື ໃຊ້ເຮັດວຽງ office ເທ່ໆໄດ້ເລີຍ\r\n#ລາຄາພຽງ249,000ກີບ\r\n- Keyboard\r\n- Mouse\r\n- Mouse pad', 1),
(24, '8886419332909', 'img_5f31a3ac2cce3.jpg', 'https://www.youtube.com/embed/rk5LTWHLQ7I', '', 1),
(25, '8886419332510', 'img_5f31a4910b43c.', 'https://www.youtube.com/embed/VpCrAJHyvMI', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `color_id` int(11) NOT NULL,
  `color_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`color_id`, `color_name`, `pro_id`, `img_path`) VALUES
(4, 'black', '6971880290123', 'img_5eda1fcfc32e9.jpg'),
(5, 'silver', '6971880290123', 'img_5eda1fe4718b6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_model`
--

CREATE TABLE `product_model` (
  `model_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_model`
--

INSERT INTO `product_model` (`model_id`, `pro_id`, `img_path`, `model`) VALUES
(7, '6971880290123', 'img_5eda1ebb7a05a.jpg', 1),
(8, '6971880290123', 'img_5eda1f53702e2.jpg', 2),
(9, '6971880290123', 'img_5eda218cc6b31.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_property`
--

CREATE TABLE `product_property` (
  `ppy_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ppy_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_property`
--

INSERT INTO `product_property` (`ppy_id`, `pro_id`, `ppy_name`, `content`) VALUES
(10, '6956766906237', 'ປະເພດຫູຟັງ', 'ຫູຟັງຄອບຫູ (Over-Ear)'),
(11, '6956766906237', 'ມີສາຍ/ໄຮ້ສາຍ', 'ມີສາຍ'),
(12, '6956766906237', 'ການເຊື່ອມຕໍ່', 'jack 3.5mm'),
(13, '6956766906237', 'ໄມໂຄໂຟນ', 'ມີໄມ'),
(14, '6956766906237', 'ອິມພີແດນ', '32Ω'),
(15, '6956766906237', 'Sensitivity', '115dB/mW'),
(16, '6956766906237', 'ຄວາມໄວການຕອບສະໜອງຄວາມຖີ່', '20-20000Hz'),
(17, '6950386491234', 'ມີສາຍ/ໄຮ້ສາຍ', 'ມີສາຍ'),
(18, '6950386491234', 'ມາໂຄ', 'ມີ'),
(19, '6950386491234', 'ໄຟ RGB', 'ມີ'),
(20, '6943106977309', 'ມີສາຍ/ໄຮ້ສາຍ', 'ໄຮ້ສາຍ'),
(21, '6931594002009', 'ມີສາຍ/ໄຮ້ສາຍ', 'ມີ'),
(22, '6931594002009', 'ຄວາມໄວ ', '6400 DPI'),
(23, '6931594002009', 'ມາໂຄ', 'ມີ');

-- --------------------------------------------------------

--
-- Table structure for table `product_special`
--

CREATE TABLE `product_special` (
  `spec_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_special`
--

INSERT INTO `product_special` (`spec_id`, `pro_id`, `content`) VALUES
(6, '6971880290123', 'ເຊື່ອມຕໍ່ງ່າຍ'),
(10, '6956766906237', 'Cable length: 2.0m'),
(11, '6956766906237', 'Soft Earpad'),
(12, '6970202291589', '350*250mm'),
(13, '6970202291589', 'USB POWER, PLUG&PLAY'),
(14, '6970202291589', '12 MODE SPECTRUM BACKLIGHTING 7 color');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate_buy` decimal(11,2) DEFAULT NULL,
  `rate_sell` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `rate_buy`, `rate_sell`) VALUES
('LAK', '1.00', '1.00'),
('USD', '9000.00', '9000.00'),
('THB', '300.00', '300.00');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `sell_id` int(11) NOT NULL,
  `emp_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `sell_date` date DEFAULT NULL,
  `sell_time` time DEFAULT NULL,
  `amount` decimal(11,2) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_cash` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sell_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen1` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seen2` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupon_key` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cupon_price` decimal(11,2) DEFAULT NULL,
  `delivery` decimal(11,2) DEFAULT NULL,
  `place_deli` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `getmoney` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`sell_id`, `emp_id`, `cus_id`, `sell_date`, `sell_time`, `amount`, `status`, `status_cash`, `img_path`, `sell_type`, `seen1`, `seen2`, `cupon_key`, `cupon_price`, `delivery`, `place_deli`, `note`, `getmoney`) VALUES
(1, '124', 14, '2020-06-18', '14:26:02', '1323000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(2, '0001', 14, '2020-06-18', '20:42:32', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(3, '124', 14, '2020-06-19', '12:24:16', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(4, '124', 14, '2020-06-20', '08:19:13', '980000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(5, '124', 14, '2020-06-21', '11:59:58', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(6, '124', 14, '2020-06-21', '15:47:59', '490000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(7, '124', 14, '2020-06-22', '10:08:48', '3054000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(8, '124', 14, '2020-06-22', '10:15:55', '2437000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(9, '124', 14, '2020-06-23', '15:18:30', '3474000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(10, '124', 14, '2020-06-26', '11:52:06', '2905000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(11, '124', 14, '2020-06-26', '12:03:44', '490000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(12, '124', 14, '2020-06-26', '22:22:32', '2100000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(13, '124', 14, '2020-06-26', '22:24:37', '390000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(14, '124', 14, '2020-06-26', '22:39:22', '975000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(15, '124', 14, '2020-06-29', '15:46:02', '1911000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(16, '124', 14, '2020-06-30', '14:23:18', '1749000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(17, '124', 14, '2020-07-01', '11:35:47', '2419000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(18, '124', 14, '2020-07-02', '12:19:11', '379000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(19, '124', 14, '2020-07-02', '12:54:01', '2489000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(20, '124', 14, '2020-07-02', '16:03:11', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(21, '124', 14, '2020-07-05', '14:51:46', '2543000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(22, '124', 14, '2020-07-05', '19:04:09', '198000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(23, '124', 14, '2020-07-06', '10:45:58', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(24, '124', 14, '2020-07-09', '11:54:32', '234000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(25, '124', 14, '2020-07-09', '13:29:59', '4918000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(26, '124', 14, '2020-07-09', '13:32:11', '989000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(27, '124', 14, '2020-07-09', '16:05:20', '269000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(28, '124', 14, '2020-07-10', '11:55:10', '523000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(29, '124', 14, '2020-07-10', '11:56:36', '523000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(30, '124', 14, '2020-07-10', '15:57:37', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(31, '124', 14, '2020-07-10', '17:15:03', '396000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(32, '124', 14, '2020-07-10', '17:22:18', '318000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(33, '124', 14, '2020-07-11', '08:46:11', '1815000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(34, '124', 14, '2020-07-11', '13:49:31', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(35, '124', 14, '2020-07-11', '13:55:32', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(36, '124', 14, '2020-07-11', '14:17:40', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(37, '124', 14, '2020-07-11', '14:50:08', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(38, '124', 14, '2020-07-11', '17:33:18', '523000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(39, '124', 14, '2020-07-11', '21:06:15', '264000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(40, '124', 14, '2020-07-11', '21:07:31', '234000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(41, '124', 14, '2020-07-11', '21:09:35', '650000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(42, '124', 14, '2020-07-12', '11:44:40', '269000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(43, '124', 14, '2020-07-12', '15:04:54', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(44, '124', 14, '2020-07-12', '16:29:29', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(45, '124', 14, '2020-07-13', '14:28:22', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(46, '124', 14, '2020-07-13', '14:35:23', '328000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(47, '124', 14, '2020-07-13', '16:34:24', '239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(48, '124', 14, '2020-07-13', '17:17:22', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(49, '124', 14, '2020-07-14', '12:45:42', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(50, '124', 14, '2020-07-14', '22:42:50', '1302000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(51, '124', 14, '2020-07-15', '15:12:59', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(52, '124', 14, '2020-07-16', '00:23:39', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(53, '124', 14, '2020-07-16', '00:25:15', '294000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(54, '124', 14, '2020-07-16', '14:26:01', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(55, '124', 14, '2020-07-16', '21:51:44', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(56, '124', 14, '2020-07-17', '13:25:13', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(57, '124', 14, '2020-07-18', '13:16:59', '593000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(58, '124', 14, '2020-07-18', '13:28:59', '1043000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(59, '124', 14, '2020-07-18', '13:30:09', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(60, '124', 14, '2020-07-21', '16:06:19', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(61, '124', 14, '2020-07-21', '16:08:31', '830000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(62, '124', 14, '2020-07-22', '11:27:51', '765000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(63, '124', 14, '2020-07-23', '09:51:47', '1905000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(64, '124', 14, '2020-07-23', '13:17:02', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(65, '124', 14, '2020-07-23', '15:13:09', '1205000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(66, '124', 14, '2020-07-24', '11:26:08', '1236000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(67, '124', 14, '2020-07-25', '12:01:33', '585000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(68, '124', 14, '2020-07-26', '11:54:54', '78000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(69, '124', 14, '2020-07-26', '14:06:43', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(70, '124', 14, '2020-07-27', '11:34:43', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(71, '124', 14, '2020-07-27', '14:16:46', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(72, '124', 14, '2020-07-27', '16:28:13', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(73, '124', 14, '2020-07-28', '10:25:37', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(74, '124', 14, '2020-07-28', '10:26:24', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(75, '124', 14, '2020-07-28', '10:30:58', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(76, '124', 14, '2020-07-28', '10:37:16', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(77, '124', 14, '2020-07-28', '15:12:32', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(78, '124', 14, '2020-07-29', '11:45:07', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(79, '124', 14, '2020-07-29', '19:15:54', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(80, '124', 14, '2020-07-29', '19:22:48', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(81, '124', 14, '2020-07-30', '17:19:22', '922000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(82, '124', 14, '2020-07-30', '21:07:19', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(83, '124', 14, '2020-07-30', '21:09:22', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(84, '124', 14, '2020-07-30', '21:17:52', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(85, '124', 14, '2020-07-31', '11:51:56', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(86, '124', 14, '2020-07-31', '17:09:44', '15000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(87, '124', 14, '2020-07-31', '17:20:42', '15000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(88, '124', 14, '2020-08-01', '11:39:58', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(89, '124', 14, '2020-08-01', '11:42:18', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(90, '124', 14, '2020-08-02', '11:25:10', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(91, '124', 14, '2020-08-02', '11:26:23', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(92, '124', 14, '2020-08-02', '11:28:06', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(93, '124', 14, '2020-08-02', '11:30:32', '140000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(94, '124', 14, '2020-08-02', '18:27:42', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(95, '124', 14, '2020-08-03', '20:44:26', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(96, '124', 14, '2020-08-04', '11:27:59', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(97, '124', 14, '2020-08-05', '13:53:08', '188000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(98, '124', 14, '2020-08-05', '14:02:55', '390000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(99, '124', 14, '2020-08-06', '11:53:30', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(100, '124', 14, '2020-08-06', '11:55:14', '390000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(101, '124', 14, '2020-08-06', '12:04:55', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(102, '124', 14, '2020-08-06', '12:21:49', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(103, '124', 14, '2020-08-07', '11:42:02', '780000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(104, '124', 14, '2020-08-07', '11:47:03', '38000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(105, '124', 14, '2020-08-07', '11:48:21', '527000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(106, '124', 14, '2020-08-07', '12:59:11', '140000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(107, '124', 14, '2020-08-07', '19:21:41', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(108, '124', 14, '2020-08-07', '19:23:05', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(109, '124', 14, '2020-08-07', '20:00:18', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(110, '124', 14, '2020-08-08', '11:39:38', '1140000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(111, '124', 14, '2020-08-08', '12:34:15', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(112, '124', 14, '2020-08-08', '13:47:58', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(113, '124', 14, '2020-08-08', '15:03:45', '239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(114, '124', 14, '2020-08-10', '11:32:45', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(115, '124', 14, '2020-08-10', '11:36:08', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(116, '124', 14, '2020-08-10', '15:06:48', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(117, '124', 14, '2020-08-10', '15:07:28', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(118, '124', 14, '2020-08-10', '15:09:25', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(119, '124', 14, '2020-08-10', '15:36:59', '1205000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(120, '124', 14, '2020-08-10', '16:52:47', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(121, '124', 14, '2020-08-11', '11:46:36', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(122, '124', 14, '2020-08-11', '13:30:36', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(123, '124', 14, '2020-08-11', '13:48:11', '278000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(124, '124', 14, '2020-08-11', '14:02:14', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(125, '124', 14, '2020-08-11', '18:59:23', '239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(126, '124', 14, '2020-08-11', '19:01:30', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(127, '124', 14, '2020-08-12', '09:45:11', '975000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(128, '124', 14, '2020-08-12', '11:52:47', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(129, '124', 14, '2020-08-12', '22:35:20', '64000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(130, '124', 14, '2020-08-12', '22:39:30', '245000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(131, '124', 14, '2020-08-13', '19:35:23', '359000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(132, '124', 14, '2020-08-13', '19:36:30', '285000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(133, '124', 14, '2020-08-13', '19:37:15', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(134, '124', 14, '2020-08-14', '12:28:21', '1205000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(135, '124', 14, '2020-08-15', '11:29:41', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(136, '124', 14, '2020-08-15', '11:31:42', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(137, '124', 14, '2020-08-15', '11:35:10', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(138, '124', 14, '2020-08-15', '11:50:13', '707000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(139, '124', 14, '2020-08-15', '14:54:03', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(140, '124', 14, '2020-08-16', '15:17:32', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(141, '124', 14, '2020-08-16', '15:21:13', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(142, '124', 14, '2020-08-17', '11:51:16', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(143, '124', 14, '2020-08-17', '11:52:53', '578000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(144, '124', 14, '2020-08-18', '11:58:15', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(145, '124', 14, '2020-08-18', '12:00:35', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(146, '124', 14, '2020-08-18', '12:35:01', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(147, '124', 14, '2020-08-18', '13:30:28', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(148, '124', 14, '2020-08-19', '12:03:08', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(149, '124', 14, '2020-08-20', '11:56:39', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(150, '124', 14, '2020-08-20', '12:00:08', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(151, '124', 14, '2020-08-21', '12:14:13', '697000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(152, '124', 14, '2020-08-21', '16:27:14', '250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(153, '124', 14, '2020-08-21', '23:09:07', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(154, '124', 14, '2020-08-22', '11:31:22', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(155, '124', 14, '2020-08-23', '11:18:47', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(156, '124', 14, '2020-08-23', '13:08:28', '390000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(157, '124', 14, '2020-08-23', '15:48:56', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(158, '124', 14, '2020-08-23', '15:49:44', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(159, '124', 14, '2020-08-23', '15:52:16', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(160, '124', 14, '2020-08-23', '15:54:12', '78000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(161, '124', 14, '2020-08-25', '11:42:13', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(162, '124', 14, '2020-08-25', '17:12:35', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(163, '124', 14, '2020-08-25', '17:14:46', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(164, '124', 14, '2020-08-25', '17:48:53', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(165, '124', 14, '2020-08-26', '11:38:08', '390000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(166, '124', 14, '2020-08-26', '19:55:22', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(167, '124', 14, '2020-08-26', '19:58:10', '78000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(168, '124', 14, '2020-08-27', '13:09:21', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(169, '124', 14, '2020-08-27', '20:54:52', '119000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(170, '124', 14, '2020-08-27', '21:19:23', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(171, '124', 14, '2020-08-28', '11:20:26', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(172, '124', 14, '2020-08-28', '11:38:59', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(173, '124', 14, '2020-08-28', '11:43:06', '129000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(174, '124', 14, '2020-08-28', '20:15:41', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(175, '124', 14, '2020-08-29', '15:55:07', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(176, '124', 14, '2020-08-30', '20:18:46', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(177, '124', 14, '2020-08-31', '11:33:13', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(178, '124', 14, '2020-08-31', '22:02:52', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(179, '124', 14, '2020-08-31', '22:11:26', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(180, '124', 14, '2020-09-01', '11:38:57', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(181, '124', 14, '2020-09-01', '21:16:16', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(182, '124', 14, '2020-09-01', '21:16:17', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(183, '124', 14, '2020-09-02', '11:17:45', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(184, '124', 14, '2020-09-02', '11:22:33', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(185, '124', 14, '2020-09-02', '12:43:09', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(186, '124', 14, '2020-09-02', '14:32:15', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(187, '124', 14, '2020-09-02', '14:35:28', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(188, '124', 14, '2020-09-02', '22:27:16', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(189, '124', 14, '2020-09-03', '11:42:42', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(190, '124', 14, '2020-09-03', '11:43:35', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(191, '124', 14, '2020-09-04', '09:26:08', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(192, '124', 14, '2020-09-05', '11:43:55', '239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(193, '124', 14, '2020-09-05', '11:44:56', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(194, '124', 14, '2020-09-05', '22:33:21', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(195, '124', 14, '2020-09-06', '11:36:14', '158000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(196, '124', 14, '2020-09-06', '11:52:16', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(197, '124', 14, '2020-09-06', '12:55:44', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(198, '124', 14, '2020-09-07', '11:52:53', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(199, '124', 14, '2020-09-07', '11:54:07', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(200, '124', 14, '2020-09-07', '14:28:53', '139000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(201, '124', 14, '2020-09-08', '11:54:23', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(202, '124', 14, '2020-09-09', '11:55:02', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(203, '124', 14, '2020-09-09', '11:56:42', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(204, '124', 14, '2020-09-11', '11:36:20', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(205, '124', 14, '2020-09-11', '20:26:17', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(206, '124', 14, '2020-09-11', '20:33:52', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(207, '124', 14, '2020-09-12', '11:44:47', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(208, '124', 14, '2020-09-12', '11:46:56', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(209, '124', 14, '2020-09-12', '11:51:09', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(210, '124', 14, '2020-09-12', '11:53:03', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(211, '124', 14, '2020-09-13', '11:53:53', '777000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(212, '124', 14, '2020-09-14', '11:48:17', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(213, '124', 14, '2020-09-14', '16:57:47', '700000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(214, '124', 14, '2020-09-14', '19:13:36', '1270000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(215, '124', 14, '2020-10-12', '22:07:07', '9905000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(216, '124', 14, '2020-10-12', '22:24:24', '9998000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(217, '124', 14, '2020-10-12', '22:26:24', '1270000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(218, '124', 14, '2020-10-12', '22:27:21', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(219, '124', 14, '2020-10-13', '11:31:09', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(220, '124', 14, '2020-10-13', '11:36:22', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(221, '124', 14, '2020-10-13', '11:40:05', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(222, '124', 14, '2020-10-14', '11:18:11', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(223, '124', 14, '2020-10-14', '15:57:11', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(224, '124', 14, '2020-10-15', '11:51:26', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(225, '124', 14, '2020-10-15', '19:54:00', '238000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(226, '124', 14, '2020-10-16', '11:01:57', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(227, '124', 14, '2020-10-17', '13:38:46', '794000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(228, '124', 14, '2020-10-17', '15:15:33', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(229, '124', 14, '2020-10-18', '13:57:38', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(230, '124', 14, '2020-10-20', '14:23:25', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(231, '124', 14, '2020-10-20', '19:04:36', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(232, '124', 14, '2020-10-20', '19:59:41', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(233, '124', 14, '2020-10-24', '17:34:17', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(234, '124', 14, '2020-10-26', '20:36:21', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(235, '124', 14, '2020-10-27', '22:23:36', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(236, '124', 14, '2020-10-27', '22:41:46', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(237, '124', 14, '2020-10-30', '11:45:24', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(238, '124', 14, '2020-10-30', '15:21:47', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(239, '124', 14, '2020-10-30', '15:22:41', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(240, '124', 14, '2020-10-30', '19:33:18', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(241, '124', 14, '2020-10-31', '11:47:58', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(242, '124', 14, '2020-10-31', '11:49:47', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(243, '124', 14, '2020-10-31', '19:57:19', '1180000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(244, '124', 14, '2020-10-31', '20:24:02', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(245, '124', 14, '2020-11-01', '08:55:37', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(246, '124', 14, '2020-11-02', '10:13:55', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(247, '124', 14, '2020-11-02', '10:18:01', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(248, '124', 14, '2020-11-03', '11:37:13', '508000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(249, '124', 14, '2020-11-03', '14:34:17', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(250, '124', 14, '2020-11-03', '21:24:24', '570000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(251, '124', 14, '2020-11-04', '17:00:52', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(252, '124', 14, '2020-11-05', '11:42:35', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(253, '124', 14, '2020-11-05', '11:59:53', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(254, '124', 14, '2020-11-06', '11:54:24', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(255, '124', 14, '2020-11-06', '11:55:37', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(256, '124', 14, '2020-11-06', '12:42:47', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(257, '124', 14, '2020-11-06', '22:12:22', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(258, '124', 14, '2020-11-06', '22:13:27', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(259, '124', 14, '2020-11-07', '12:58:28', '1205000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(260, '124', 14, '2020-11-08', '11:58:41', '635000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(261, '124', 14, '2020-11-10', '12:01:59', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(262, '124', 14, '2020-11-10', '20:14:18', '645000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(263, '124', 14, '2020-11-12', '12:01:10', '645000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(264, '124', 14, '2020-11-12', '12:02:50', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(265, '124', 14, '2020-11-12', '12:29:09', '515000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(266, '124', 14, '2020-11-12', '15:00:53', '199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(267, '124', 14, '2020-11-13', '10:30:54', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(268, '124', 14, '2020-11-14', '12:01:30', '515000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(269, '124', 14, '2020-11-14', '13:17:53', '515000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(270, '124', 14, '2020-11-16', '11:36:04', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(271, '124', 14, '2020-11-16', '13:34:52', '1740000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(272, '124', 14, '2020-11-16', '19:49:10', '515000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(273, '124', 14, '2020-11-18', '13:23:22', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(274, '124', 14, '2020-11-18', '17:33:49', '1199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(275, '124', 14, '2020-11-18', '17:33:49', '1199000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(276, '124', 14, '2020-11-18', '17:43:22', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(277, '124', 14, '2020-11-19', '13:12:22', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(278, '124', 14, '2020-11-19', '13:20:37', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(279, '124', 14, '2020-11-20', '13:05:10', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(280, '124', 14, '2020-11-20', '13:55:18', '1217000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(281, '124', 14, '2020-11-21', '11:54:34', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(282, '124', 14, '2020-11-22', '18:06:23', '525000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(283, '124', 14, '2020-11-22', '21:02:46', '1217000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(284, '124', 14, '2020-11-24', '11:09:05', '1835000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(285, '124', 14, '2020-11-24', '12:01:45', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(286, '124', 14, '2020-11-24', '14:12:19', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(287, '124', 14, '2020-11-25', '12:04:58', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(288, '124', 14, '2020-11-25', '12:38:46', '525000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(289, '124', 14, '2020-11-25', '13:04:44', '665000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(290, '124', 14, '2020-11-25', '13:06:26', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(291, '124', 14, '2020-11-25', '13:24:37', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(292, '124', 14, '2020-11-25', '20:26:19', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(293, '124', 14, '2020-11-27', '14:02:23', '190000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(294, '124', 14, '2020-11-28', '08:15:52', '1180000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(295, '124', 14, '2020-11-28', '13:01:35', '359000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(296, '124', 14, '2020-11-28', '13:19:44', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(297, '124', 14, '2020-11-28', '13:43:29', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(298, '124', 14, '2020-11-29', '12:03:23', '590000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(299, '124', 14, '2020-11-29', '12:06:46', '590000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(300, '124', 14, '2020-11-29', '22:25:26', '590000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(301, '124', 14, '2020-11-29', '22:27:28', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(302, '124', 14, '2020-11-29', '22:30:15', '165000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(303, '124', 14, '2020-11-30', '11:51:05', '590000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(304, '124', 14, '2020-11-30', '12:06:44', '525000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(305, '124', 14, '2020-11-30', '15:44:17', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(306, '124', 14, '2020-11-30', '17:29:28', '525000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(307, '124', 14, '2020-12-02', '12:29:03', '590000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(308, '124', 14, '2020-12-02', '15:24:54', '690000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(309, '124', 14, '2020-12-02', '15:30:19', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(310, '124', 14, '2020-12-02', '19:25:40', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(311, '124', 14, '2020-12-03', '11:44:50', '1310000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(312, '124', 14, '2020-12-03', '11:50:17', '525000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(313, '124', 14, '2020-12-03', '11:58:24', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(314, '124', 14, '2020-12-03', '12:08:44', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(315, '124', 14, '2020-12-04', '14:57:04', '324000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL);
INSERT INTO `sell` (`sell_id`, `emp_id`, `cus_id`, `sell_date`, `sell_time`, `amount`, `status`, `status_cash`, `img_path`, `sell_type`, `seen1`, `seen2`, `cupon_key`, `cupon_price`, `delivery`, `place_deli`, `note`, `getmoney`) VALUES
(316, '124', 14, '2020-12-04', '23:02:43', '655000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(317, '124', 14, '2020-12-04', '23:03:37', '1310000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(318, '124', 14, '2020-12-05', '12:01:13', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(319, '124', 14, '2020-12-06', '15:48:25', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(320, '124', 14, '2020-12-06', '15:52:53', '709000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(321, '124', 14, '2020-12-06', '19:15:49', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(322, '124', 14, '2020-12-07', '11:51:12', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(323, '124', 14, '2020-12-07', '11:54:05', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(324, '124', 14, '2020-12-08', '11:56:02', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(325, '124', 14, '2020-12-09', '21:24:22', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(326, '124', 14, '2020-12-09', '21:26:55', '1240000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(327, '124', 14, '2020-12-11', '12:27:15', '1340000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(328, '124', 14, '2020-12-14', '11:31:50', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(329, '124', 14, '2020-12-15', '12:53:27', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(330, '124', 14, '2020-12-15', '12:56:30', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(331, '124', 14, '2020-12-15', '12:58:58', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(332, '124', 14, '2020-12-15', '13:05:47', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(333, '124', 14, '2020-12-16', '11:15:47', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(334, '124', 14, '2020-12-16', '11:42:49', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(335, '124', 14, '2020-12-16', '11:45:47', '299000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(336, '124', 14, '2020-12-16', '12:12:18', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(337, '124', 14, '2020-12-16', '14:57:30', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(338, '124', 14, '2020-12-18', '11:48:19', '1270000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(339, '124', 14, '2020-12-18', '14:38:47', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(340, '124', 14, '2020-12-18', '22:37:32', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(341, '124', 14, '2020-12-18', '22:41:25', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(342, '124', 14, '2020-12-18', '22:44:33', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(343, '124', 14, '2020-12-20', '11:40:25', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(344, '124', 14, '2020-12-20', '20:58:08', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(345, '124', 14, '2020-12-23', '11:29:58', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(346, '124', 14, '2020-12-23', '13:58:39', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(347, '124', 14, '2020-12-24', '11:56:16', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(348, '124', 14, '2020-12-24', '15:37:42', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(349, '124', 14, '2020-12-27', '11:57:27', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(350, '124', 14, '2020-12-27', '12:00:14', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(351, '124', 14, '2020-12-27', '14:39:08', '359000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(352, '124', 14, '2020-12-27', '17:33:36', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(353, '124', 14, '2020-12-30', '12:47:57', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(354, '124', 14, '2020-12-30', '20:38:49', '535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(355, '124', 14, '2020-12-31', '11:45:26', '980000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(356, '124', 14, '2021-01-01', '14:07:55', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(357, '124', 14, '2021-01-02', '14:12:51', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(358, '124', 14, '2021-01-03', '17:13:02', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(359, '124', 14, '2021-01-03', '17:18:43', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(360, '124', 14, '2021-01-04', '11:00:00', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(361, '124', 14, '2021-01-04', '11:01:18', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(362, '124', 14, '2021-01-04', '11:25:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(363, '124', 14, '2021-01-04', '12:52:17', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(365, '124', 37, '2021-01-04', '14:21:04', '165000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'online', 'SEEN', 'NOTSEEN', '0', '0.00', '10000.00', 'ເບີໂທ: 2096477475| what\'s app: 2096477475| ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: ເຟສບຸກ https://www.facebook.com/xaisana.bountave| ສະຖານທີ່ໃນການຈັດສົ່ງ: ບ້ານເຊກອງ ເມືອງສາມັກຄີໄຊ ແຂວງອັດຕະປື', 'ມື້ອື່ນຈັດສົ່ງໃຫ້ເດີ ຂອບໃຈລູກຄ້າ', NULL),
(366, '124', 14, '2021-01-05', '11:44:40', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(367, '124', 14, '2021-01-05', '16:00:28', '600000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(368, '124', 14, '2021-01-05', '20:33:40', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(369, '124', 14, '2021-01-06', '11:52:07', '1240000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(370, '124', 14, '2021-01-06', '12:09:15', '299000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(371, '124', 14, '2021-01-07', '13:54:26', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(372, '124', 14, '2021-01-08', '10:34:42', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(373, '124', 14, '2021-01-08', '12:32:27', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(374, '124', 14, '2021-01-08', '12:46:47', '295000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(375, '124', 14, '2021-01-08', '19:30:21', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(376, '124', 14, '2021-01-09', '12:19:13', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(377, '124', 14, '2021-01-09', '19:39:42', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(378, '124', 14, '2021-01-09', '19:47:29', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(379, '124', 14, '2021-01-11', '11:31:08', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(380, '124', 14, '2021-01-11', '11:33:35', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(381, '124', 14, '2021-01-11', '11:35:25', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(382, '124', 14, '2021-01-12', '14:09:19', '664000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(383, '124', 14, '2021-01-13', '21:18:43', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(384, '124', 14, '2021-01-14', '11:56:13', '299000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(385, '124', 14, '2021-01-14', '14:07:12', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(386, '124', 14, '2021-01-16', '11:59:02', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(387, '124', 14, '2021-01-16', '12:01:56', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(388, '124', 14, '2021-01-17', '15:59:52', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(389, '124', 14, '2021-01-18', '21:20:08', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(390, '124', 14, '2021-01-18', '21:27:06', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(391, '124', 14, '2021-01-18', '21:28:04', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(392, '124', 14, '2021-01-19', '10:44:48', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(393, '124', 14, '2021-01-19', '10:59:13', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(394, '124', 14, '2021-01-19', '11:40:07', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(395, '124', 14, '2021-01-19', '11:44:05', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(396, '124', 14, '2021-01-19', '11:47:43', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(397, '124', 14, '2021-01-19', '12:06:56', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(398, '124', 14, '2021-01-19', '13:49:36', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(399, '124', 14, '2021-01-20', '13:21:42', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(400, '124', 14, '2021-01-20', '20:45:11', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(401, '124', 14, '2021-01-22', '21:58:13', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(402, '124', 14, '2021-01-23', '11:44:00', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(403, '124', 14, '2021-01-24', '17:59:20', '1285000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(404, '124', 14, '2021-01-26', '11:30:08', '536000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(405, '124', 14, '2021-01-26', '18:15:43', '279000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(406, '124', 14, '2021-01-27', '10:57:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(407, '124', 14, '2021-01-27', '17:37:24', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(408, '124', 14, '2021-01-28', '13:57:13', '1350000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(409, '124', 14, '2021-01-28', '15:19:41', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(410, '124', 14, '2021-01-28', '15:50:33', '229000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(411, '124', 14, '2021-01-28', '15:52:07', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(412, '124', 14, '2021-01-29', '22:36:59', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(413, '124', 14, '2021-01-31', '20:04:46', '359000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(414, '124', 14, '2021-02-01', '11:17:46', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(415, '124', 14, '2021-02-01', '15:07:35', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(416, '124', 14, '2021-02-02', '21:36:39', '129000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(417, '124', 14, '2021-02-02', '21:39:21', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(418, '124', 14, '2021-02-03', '11:06:32', '454000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(419, '124', 14, '2021-02-03', '11:34:12', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(420, '124', 14, '2021-02-03', '11:36:01', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(421, '124', 14, '2021-02-03', '11:37:42', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(422, '124', 14, '2021-02-03', '11:55:10', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(423, '124', 14, '2021-02-03', '11:57:41', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(424, '124', 14, '2021-02-03', '13:31:00', '125000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(425, '124', 14, '2021-02-03', '18:32:21', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(426, '124', 14, '2021-02-04', '11:47:10', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(427, '124', 14, '2021-02-04', '11:54:44', '1240000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(428, '124', 14, '2021-02-04', '12:00:01', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(429, '124', 14, '2021-02-04', '15:10:33', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(430, '124', 14, '2021-02-04', '15:13:41', '478000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(431, '124', 14, '2021-02-04', '15:15:38', '129000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(432, '124', 14, '2021-02-05', '13:15:11', '204000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(433, '124', 14, '2021-02-05', '20:07:47', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(434, '124', 14, '2021-02-05', '20:08:58', '359000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(435, '124', 14, '2021-02-05', '20:33:00', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(436, '124', 14, '2021-02-06', '11:51:25', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(437, '124', 14, '2021-02-07', '11:38:32', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(438, '124', 14, '2021-02-07', '11:39:42', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(439, '124', 14, '2021-02-07', '11:40:27', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(440, '124', 14, '2021-02-07', '11:41:25', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(441, '124', 14, '2021-02-07', '11:42:06', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(442, '124', 14, '2021-02-09', '11:10:23', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(443, '124', 14, '2021-02-10', '11:30:09', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(444, '124', 14, '2021-02-10', '11:38:38', '299000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(445, '124', 14, '2021-02-14', '11:53:13', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(446, '124', 14, '2021-02-14', '17:49:47', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(447, '124', 14, '2021-02-14', '17:52:37', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(448, '124', 14, '2021-02-14', '17:56:03', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(449, '124', 14, '2021-02-15', '11:51:55', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(450, '124', 14, '2021-02-15', '12:04:14', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(451, '124', 14, '2021-02-15', '16:01:01', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(452, '124', 14, '2021-02-15', '19:35:10', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(453, '124', 14, '2021-02-15', '19:41:31', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(454, '124', 14, '2021-02-16', '10:38:14', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(455, '124', 14, '2021-02-16', '10:39:50', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(456, '124', 14, '2021-02-16', '10:44:11', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(457, '124', 14, '2021-02-16', '10:45:24', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(458, '124', 14, '2021-02-17', '12:02:31', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(459, '124', 14, '2021-02-17', '17:07:59', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(460, '124', 14, '2021-02-17', '20:04:32', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(461, '124', 14, '2021-02-17', '20:27:22', '175000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(462, '124', 14, '2021-02-17', '20:37:41', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(463, '124', 14, '2021-02-18', '11:16:11', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(464, '124', 14, '2021-02-18', '11:21:57', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(465, '124', 14, '2021-02-18', '18:09:09', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(466, '124', 14, '2021-02-18', '18:14:29', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(467, '124', 14, '2021-02-18', '18:29:24', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(468, '124', 14, '2021-02-19', '11:58:20', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(469, '124', 14, '2021-02-19', '17:42:06', '175000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(470, '124', 14, '2021-02-21', '13:29:52', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(471, '124', 14, '2021-02-22', '11:40:34', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(472, '124', 14, '2021-02-22', '12:34:40', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(473, '124', 14, '2021-02-22', '13:59:21', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(474, '124', 14, '2021-02-22', '14:38:05', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(475, '124', 14, '2021-02-24', '11:30:45', '1190000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(476, '124', 14, '2021-02-24', '11:34:28', '76000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(477, '124', 14, '2021-02-24', '11:52:25', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(478, '124', 14, '2021-02-25', '22:39:33', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(479, '124', 14, '2021-02-26', '11:47:11', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(480, '124', 14, '2021-02-27', '09:09:52', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(481, '124', 14, '2021-02-27', '10:05:47', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(482, '124', 14, '2021-02-28', '11:52:12', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(483, '124', 14, '2021-02-28', '11:54:41', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(484, '124', 14, '2021-03-01', '11:30:52', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(485, '124', 14, '2021-03-01', '11:34:33', '568000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(486, '124', 14, '2021-03-03', '11:27:08', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(487, '124', 14, '2021-03-03', '11:30:11', '299000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(488, '124', 14, '2021-03-05', '11:28:50', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(489, '124', 14, '2021-03-05', '11:33:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(490, '124', 14, '2021-03-05', '17:31:04', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(491, '124', 14, '2021-03-06', '12:53:39', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(492, '124', 14, '2021-03-06', '13:55:34', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(493, '124', 14, '2021-03-07', '15:40:29', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(494, '124', 14, '2021-03-08', '11:55:30', '484000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(495, '124', 14, '2021-03-09', '18:52:31', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(496, '124', 14, '2021-03-09', '19:26:49', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(497, '124', 14, '2021-03-10', '11:07:31', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(498, '124', 14, '2021-03-11', '11:30:47', '785000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(499, '124', 14, '2021-03-11', '11:32:42', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(500, '124', 14, '2021-03-12', '11:39:15', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(501, '124', 14, '2021-03-14', '11:36:00', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(502, '124', 14, '2021-03-14', '14:30:04', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(503, '124', 14, '2021-03-15', '16:17:08', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(504, '124', 14, '2021-03-16', '20:06:59', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(505, '124', 14, '2021-03-16', '20:11:11', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(506, '124', 14, '2021-03-18', '11:52:47', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(507, '124', 14, '2021-03-18', '11:59:08', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(508, '124', 14, '2021-03-19', '11:41:07', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(509, '124', 14, '2021-03-19', '14:48:39', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(510, '124', 14, '2021-03-21', '11:24:40', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(512, '124', 14, '2021-03-22', '07:42:39', '528000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(513, '124', 14, '2021-03-22', '07:50:30', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(514, '124', 14, '2021-03-22', '07:51:51', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(515, '124', 14, '2021-03-22', '22:18:05', '398000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(516, '124', 14, '2021-03-22', '22:24:00', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(517, '124', 14, '2021-03-22', '22:25:12', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(518, '124', 14, '2021-03-22', '22:27:02', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(519, '124', 14, '2021-03-24', '10:51:24', '295000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(520, '124', 14, '2021-03-25', '11:34:44', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(521, '124', 14, '2021-03-25', '11:37:17', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(522, '124', 14, '2021-03-25', '20:47:55', '1350000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(523, '124', 14, '2021-03-25', '20:56:55', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(524, '124', 14, '2021-03-26', '11:41:04', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(525, '124', 14, '2021-03-26', '16:45:50', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(526, '124', 14, '2021-03-27', '09:56:09', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(527, '124', 14, '2021-03-29', '11:48:56', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(528, '124', 14, '2021-03-29', '11:52:11', '175000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(529, '124', 14, '2021-03-30', '09:55:20', '175000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(530, '124', 14, '2021-04-21', '10:05:15', '195000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(531, '124', 14, '2021-04-21', '10:10:47', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(532, '124', 14, '2021-04-21', '17:39:18', '6960000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(533, '124', 14, '2021-04-21', '17:41:18', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(534, '124', 14, '2021-04-21', '17:42:51', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(535, '124', 14, '2021-04-21', '17:43:36', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(536, '124', 14, '2021-04-21', '19:38:19', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(537, '124', 14, '2021-04-22', '12:54:49', '2535000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(538, '124', 14, '2021-04-22', '19:49:44', '117000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(539, '124', 14, '2021-04-23', '10:44:20', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(540, '124', 14, '2021-04-23', '10:46:20', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(541, '124', 14, '2021-04-23', '20:23:36', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(542, '124', 14, '2021-04-28', '13:22:15', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(543, '124', 14, '2021-04-28', '13:43:01', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(544, '124', 14, '2021-04-28', '17:07:02', '755000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(545, '124', 14, '2021-04-28', '19:30:04', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(546, '124', 14, '2021-04-29', '12:29:52', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(547, '124', 14, '2021-04-29', '15:45:52', '135000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(548, '124', 14, '2021-04-30', '12:55:49', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(549, '124', 14, '2021-05-01', '11:36:04', '285000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(550, '124', 14, '2021-05-01', '15:30:22', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(551, '124', 14, '2021-05-02', '11:30:09', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(552, '124', 14, '2021-05-02', '11:46:25', '89000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(553, '124', 14, '2021-05-02', '12:18:05', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(554, '124', 14, '2021-05-02', '14:51:47', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(555, '124', 14, '2021-05-03', '19:30:11', '458000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(556, '124', 14, '2021-05-03', '19:45:07', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(557, '124', 14, '2021-05-03', '21:48:54', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(558, '124', 14, '2021-05-04', '11:20:34', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(559, '124', 14, '2021-05-04', '11:43:31', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(560, '124', 14, '2021-05-04', '11:45:11', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(561, '124', 14, '2021-05-04', '16:33:59', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(562, '124', 14, '2021-05-04', '21:57:35', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(563, '124', 14, '2021-05-05', '10:37:15', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(564, '124', 14, '2021-05-05', '10:40:11', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(565, '124', 14, '2021-05-05', '10:45:06', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(566, '124', 14, '2021-05-05', '21:45:13', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(567, '124', 14, '2021-05-05', '21:46:34', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(568, '124', 14, '2021-05-05', '21:47:35', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(569, '124', 14, '2021-05-05', '22:17:25', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(570, '124', 14, '2021-05-06', '17:06:44', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(571, '124', 14, '2021-05-07', '10:35:07', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(572, '124', 14, '2021-05-07', '18:54:48', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(573, '124', 14, '2021-05-07', '18:59:21', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(574, '124', 14, '2021-05-08', '10:48:44', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(575, '124', 14, '2021-05-08', '20:42:54', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(576, '124', 14, '2021-05-08', '20:44:38', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(577, '124', 14, '2021-05-08', '21:23:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(578, '124', 14, '2021-05-09', '12:33:29', '259000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(579, '124', 14, '2021-05-09', '12:50:56', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(580, '124', 14, '2021-05-09', '21:05:36', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(581, '124', 14, '2021-05-10', '11:23:51', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(582, '124', 14, '2021-05-11', '10:39:12', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(583, '124', 14, '2021-05-11', '11:29:55', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(584, '124', 14, '2021-05-12', '19:12:08', '39000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(585, '124', 14, '2021-05-12', '19:14:17', '351000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(586, '124', 14, '2021-05-12', '19:18:40', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(587, '124', 14, '2021-05-12', '19:21:45', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(588, '124', 14, '2021-05-12', '19:25:43', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(589, '124', 14, '2021-05-13', '15:53:58', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(590, '124', 14, '2021-05-13', '16:38:12', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(591, '124', 14, '2021-05-13', '16:46:05', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(592, '124', 14, '2021-05-13', '16:48:47', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(593, '124', 14, '2021-05-14', '22:54:26', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(594, '124', 14, '2021-05-15', '11:42:26', '109000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(595, '124', 14, '2021-05-16', '11:40:35', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(596, '124', 14, '2021-05-18', '11:19:21', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(597, '124', 14, '2021-05-18', '22:29:44', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(598, '124', 14, '2021-05-18', '22:30:35', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(599, '124', 14, '2021-05-20', '21:22:55', '1250000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(600, '124', 14, '2021-05-21', '11:33:08', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(601, '124', 14, '2021-05-21', '11:33:57', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(602, '124', 14, '2021-05-21', '22:21:23', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(603, '124', 14, '2021-05-21', '22:24:15', '129000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(604, '124', 14, '2021-05-24', '11:40:59', '647000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(605, '124', 14, '2021-05-24', '15:36:33', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(606, '124', 14, '2021-05-24', '22:25:59', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(607, '124', 14, '2021-05-25', '11:39:45', '140000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(608, '124', 14, '2021-05-25', '11:41:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(609, '124', 14, '2021-05-25', '11:46:31', '585000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(610, '124', 14, '2021-05-26', '12:01:22', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(611, '124', 14, '2021-05-26', '16:12:34', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(612, '124', 14, '2021-05-26', '21:17:36', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(613, '124', 14, '2021-05-26', '21:35:12', '156000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(614, '124', 14, '2021-05-27', '20:00:07', '1914000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(615, '124', 14, '2021-05-28', '20:22:49', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(616, '124', 14, '2021-05-29', '17:11:22', '670000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', 'Nopz5', '5000.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(617, '124', 14, '2021-05-31', '19:48:27', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(618, '124', 14, '2021-05-31', '19:49:32', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(619, '124', 14, '2021-06-01', '11:33:03', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(620, '124', 14, '2021-06-01', '11:33:31', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(621, '124', 14, '2021-06-01', '20:11:49', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(622, '124', 14, '2021-06-02', '18:20:24', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(623, '124', 14, '2021-06-02', '18:35:29', '1779000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(624, '124', 14, '2021-06-02', '18:37:11', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(625, '124', 14, '2021-06-03', '11:27:15', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(626, '124', 14, '2021-06-04', '12:00:58', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(627, '124', 14, '2021-06-04', '12:02:17', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(628, '124', 14, '2021-06-06', '12:50:20', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(629, '124', 14, '2021-06-07', '10:16:31', '351000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(630, '124', 14, '2021-06-08', '13:00:33', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL);
INSERT INTO `sell` (`sell_id`, `emp_id`, `cus_id`, `sell_date`, `sell_time`, `amount`, `status`, `status_cash`, `img_path`, `sell_type`, `seen1`, `seen2`, `cupon_key`, `cupon_price`, `delivery`, `place_deli`, `note`, `getmoney`) VALUES
(631, '124', 14, '2021-06-08', '13:03:30', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(632, '124', 14, '2021-06-08', '18:54:58', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(633, '124', 14, '2021-06-09', '11:31:19', '1239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(634, '124', 14, '2021-06-09', '20:56:39', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(635, '124', 14, '2021-06-09', '20:58:08', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(636, '124', 14, '2021-06-09', '21:02:37', '1239000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(637, '124', 14, '2021-06-10', '11:34:02', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(638, '124', 14, '2021-06-10', '17:57:08', '814000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', 'Nopz49', '49000.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(639, '124', 14, '2021-06-11', '22:33:27', '19000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(640, '124', 14, '2021-06-11', '22:35:16', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(641, '124', 14, '2021-06-12', '14:26:10', '1340000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', 'Nopz10', '10000.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(642, '124', 14, '2021-06-12', '15:34:32', '999000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(643, '124', 14, '2021-06-12', '21:11:19', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(644, '124', 14, '2021-06-13', '11:29:28', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(645, '124', 14, '2021-06-13', '11:32:20', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(646, '124', 14, '2021-06-13', '21:25:19', '95000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(647, '124', 14, '2021-06-13', '21:28:22', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(648, '124', 14, '2021-06-14', '11:36:20', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(649, '124', 14, '2021-06-14', '11:39:09', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(650, '124', 14, '2021-06-14', '11:42:32', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(651, '124', 14, '2021-06-14', '14:42:29', '394000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', 'Nopz20', '20000.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(652, '124', 14, '2021-06-15', '11:35:22', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(653, '124', 14, '2021-06-15', '11:36:48', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(654, '124', 14, '2021-06-17', '09:09:31', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(655, '124', 14, '2021-06-17', '09:11:58', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(656, '124', 14, '2021-06-17', '09:14:53', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(657, '124', 14, '2021-06-17', '14:23:20', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(658, '124', 14, '2021-06-17', '14:25:46', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(659, '124', 14, '2021-06-17', '16:39:40', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(660, '124', 14, '2021-06-18', '12:16:35', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(661, '124', 14, '2021-06-18', '15:16:21', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(662, '124', 14, '2021-06-18', '18:22:04', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(663, '124', 14, '2021-06-18', '20:33:48', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(664, '124', 14, '2021-06-19', '11:28:22', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(665, '124', 14, '2021-06-19', '11:31:15', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(666, '124', 14, '2021-06-19', '21:23:03', '610000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(667, '124', 14, '2021-06-19', '21:27:42', '438000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(668, '124', 14, '2021-06-20', '09:46:44', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(669, '124', 14, '2021-06-20', '10:05:33', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(670, '124', 47, '2021-06-20', '22:16:55', '169000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'online', 'SEEN', 'NOTSEEN', '30%', '0.00', '10000.00', 'ເບີໂທ: ແນະນຳໃຫ້ໂທຫາ ເບີ whatsapp 2029180939| what\'s app: 2029180939| ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: FB: Mayry Sdl. Whatsapp: 2029180939| ສະຖານທີ່ໃນການຈັດສົ່ງ: ບ້ານພ້າວ ຮ່ອມ6. ເມືອງຫາດຊາຍຟອງ. ແຂວງນະຄອນຫຼວງ', 'ມື້ອື່ນຈັດສົ່ງໃຫ້ເດີລູກຄ້າ ຊ່ວງ 2-5 ໂມງແລງ', NULL),
(671, '124', 14, '2021-06-21', '17:47:44', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(672, '124', 14, '2021-06-22', '14:12:47', '159000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(673, '124', 14, '2021-06-22', '16:28:28', '249000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(674, '124', 14, '2021-06-22', '16:32:50', '675000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(675, '124', 14, '2021-06-22', '17:55:51', '179000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(676, '124', 14, '2021-06-22', '17:58:25', '540000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'ໜ້າຮ້ານ', 'SEEN', 'SEEN', '0', '0.00', '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(677, 's001', 14, '2021-07-07', '17:00:00', '0.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(678, 's001', 14, '2021-07-07', '17:00:00', '0.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(679, 's001', 14, '2021-07-07', '17:00:00', '0.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(680, 'S001', 14, '2021-07-15', '20:59:35', '170000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(681, 'S001', 14, '2021-07-15', '21:35:40', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(682, 'S001', 14, '2021-07-15', '21:38:23', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', NULL),
(683, 'S001', 14, '2021-07-15', '21:39:27', '99000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', '100000.00'),
(684, 'S001', 14, '2021-07-15', '21:45:50', '539000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '15000.00', 'ໜ໊າຮ້ານ', '-', '600000.00'),
(685, 'S001', 14, '2021-07-15', '21:52:48', '228000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', 'img_60f04bc06f1ef.ico', 'ໜ້າຮ້ານ', '1', '1', NULL, NULL, '0.00', 'ໜ໊າຮ້ານ', '-', '0.00'),
(686, '0', 2, '2021-07-17', '17:59:41', '756000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', '0', 'online', '1', 'NOTSEEN', '0', '0.00', '0.00', 'ເບີໂທ: 020-5555-6633| what\'s app: +856 20 5232 9000| ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: Messenger Johny honeywell| ສະຖານທີ່ໃນການຈັດສົ່ງ: sfd', '-', NULL),
(687, '0', 2, '2021-07-17', '18:17:25', '289000.00', 'ສັ່ງຊື້ສຳເລັດ', 'ເງິນສົດ', NULL, 'online', '1', '0', NULL, NULL, '0.00', 'ເບີໂທ: 020-5555-6633| what\'s app: +856 20 5232 9000| ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: Messenger Johny honeywell| ສະຖານທີ່ໃນການຈັດສົ່ງ: kjbk', '-', NULL),
(688, '0', 2, '2021-07-19', '15:20:51', '1630000.00', 'ສັ່ງຊື້', 'ເງິນສົດ', NULL, 'online', '1', '0', NULL, NULL, '0.00', 'ເບີໂທ: 020-5555-6633| what\'s app: +856 20 5232 9000| ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: Messenger Johny honeywell| ສະຖານທີ່ໃນການຈັດສົ່ງ: ', '-', NULL),
(689, '0', 2, '2021-07-22', '11:42:45', '1090000.00', 'ສັ່ງຊື້', 'ເງິນສົດ', NULL, 'online', '0', '0', NULL, NULL, '0.00', 'ເບີໂທ: | what\'s app: | ຊ່ອງທາງອື່ນໃນການຕິດຕໍ່: | ສະຖານທີ່ໃນການຈັດສົ່ງ: ', '-', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `selldetail`
--

CREATE TABLE `selldetail` (
  `detail_id` int(11) NOT NULL,
  `pro_id` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `promotion` decimal(11,2) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `sell_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `selldetail`
--

INSERT INTO `selldetail` (`detail_id`, `pro_id`, `qty`, `price`, `promotion`, `color_id`, `sell_id`) VALUES
(89, '6123456789016', 1, '1125000.00', '875000.00', 0, 1),
(92, '6123456789061', 1, '610000.00', '390000.00', 0, 2),
(100, '6123456789023', 1, '610000.00', '390000.00', 0, 3),
(101, '6183450789092', 2, '490000.00', '120000.00', 0, 4),
(102, '6123456789023', 1, '610000.00', '390000.00', 0, 5),
(103, '6123456789085', 1, '490000.00', '120000.00', 0, 6),
(104, '6957303867141', 1, '35000.00', '0.00', 0, 7),
(105, '6947273311058', 2, '195000.00', '100000.00', 0, 7),
(106, '6183450789092', 2, '490000.00', '120000.00', 0, 7),
(107, '6931407600620', 1, '289000.00', '131000.00', 0, 7),
(108, '6956766906237', 1, '140000.00', '20000.00', 0, 7),
(109, '6123456789023', 2, '610000.00', '390000.00', 0, 7),
(111, '6931407601283', 1, '45000.00', '15000.00', 0, 8),
(112, '6123456789016', 1, '1125000.00', '875000.00', 0, 8),
(113, '6956766919626', 1, '239000.00', '186000.00', 0, 8),
(114, '6933153602125', 1, '249000.00', '51000.00', 0, 8),
(115, '6931407600620', 1, '289000.00', '131000.00', 0, 8),
(116, '6183450789092', 1, '490000.00', '120000.00', 0, 8),
(118, '6956766906237', 1, '140000.00', '20000.00', 0, 9),
(119, '6183450789092', 2, '490000.00', '120000.00', 0, 9),
(120, '6947273311058', 5, '195000.00', '100000.00', 0, 9),
(121, '6123456789023', 2, '610000.00', '390000.00', 0, 9),
(122, '6959630211895', 1, '159000.00', '141000.00', 0, 9),
(125, '6123456789023', 3, '610000.00', '390000.00', 0, 10),
(126, '6947273311058', 3, '195000.00', '100000.00', 0, 10),
(127, '6123456784547', 1, '490000.00', '120000.00', 0, 10),
(128, '6183450789092', 1, '490000.00', '120000.00', 0, 11),
(129, '6947273311058', 2, '195000.00', '100000.00', 0, 12),
(130, '6123456789023', 1, '610000.00', '390000.00', 0, 12),
(131, '6123456789030', 1, '610000.00', '390000.00', 0, 12),
(132, '6183450789092', 1, '490000.00', '120000.00', 0, 12),
(136, '6947273311058', 2, '195000.00', '100000.00', 0, 13),
(137, '6947273311058', 5, '195000.00', '100000.00', 0, 14),
(138, '6932849427530', 1, '55000.00', '10000.00', 0, 15),
(139, '6123456789023', 2, '610000.00', '390000.00', 0, 15),
(140, '6959630211895', 4, '159000.00', '141000.00', 0, 15),
(141, '6123456789023', 1, '610000.00', '390000.00', 0, 16),
(142, '6959630211895', 1, '159000.00', '141000.00', 0, 16),
(143, '6183450789092', 2, '490000.00', '120000.00', 0, 16),
(144, '6123456789023', 3, '610000.00', '390000.00', 0, 17),
(145, '6123456784547', 1, '490000.00', '120000.00', 0, 17),
(146, '6123456789559', 1, '99000.00', '51000.00', 0, 17),
(147, '6951613917312', 1, '269000.00', '31000.00', 0, 18),
(148, '6931594002009', 1, '110000.00', '50000.00', 0, 18),
(150, '6123456789023', 2, '610000.00', '390000.00', 0, 19),
(151, '6123456784547', 2, '490000.00', '120000.00', 0, 19),
(152, '6931407600620', 1, '289000.00', '131000.00', 0, 19),
(153, '6123456784547', 1, '508000.00', '120000.00', 0, 20),
(154, '6123456789023', 1, '635000.00', '390000.00', 0, 21),
(155, '6123456789559', 3, '99000.00', '51000.00', 0, 21),
(156, '6956766919626', 1, '239000.00', '186000.00', 0, 21),
(157, '6959630211895', 1, '159000.00', '141000.00', 0, 21),
(158, '6123456789061', 1, '635000.00', '390000.00', 0, 21),
(159, '6931407600620', 2, '289000.00', '131000.00', 0, 21),
(161, '6123456789559', 2, '99000.00', '51000.00', 0, 22),
(162, '6947273311058', 1, '195000.00', '100000.00', 0, 23),
(163, '6947273311058', 1, '195000.00', '100000.00', 0, 24),
(164, '6427894571442', 1, '39000.00', '11000.00', 0, 24),
(166, '6947273311058', 3, '195000.00', '100000.00', 0, 25),
(167, '20205181045', 1, '249000.00', '251000.00', 0, 25),
(168, '6427894571441', 1, '39000.00', '11000.00', 0, 25),
(169, '6123456789542', 4, '89000.00', '41000.00', 0, 25),
(170, '6183450789092', 1, '570000.00', '120000.00', 0, 25),
(171, '6959630211901', 1, '159000.00', '141000.00', 0, 25),
(172, '6123456789023', 3, '635000.00', '390000.00', 0, 25),
(173, '6123456784547', 1, '508000.00', '120000.00', 0, 25),
(174, '6123456789559', 1, '99000.00', '51000.00', 0, 25),
(175, '6931407600620', 1, '289000.00', '131000.00', 0, 25),
(176, '6959630211895', 1, '159000.00', '141000.00', 0, 25),
(181, '6123456789023', 1, '635000.00', '390000.00', 0, 26),
(182, '6947273311058', 1, '195000.00', '100000.00', 0, 26),
(183, '6959630211895', 1, '159000.00', '141000.00', 0, 26),
(184, '6956766919626', 1, '239000.00', '186000.00', 0, 27),
(185, '30000', 1, '30000.00', '0.00', 0, 27),
(187, '6123456784547', 1, '508000.00', '120000.00', 0, 28),
(188, '15000', 1, '15000.00', '0.00', 0, 28),
(190, '6123456784547', 1, '508000.00', '120000.00', 0, 29),
(191, '15000', 1, '15000.00', '0.00', 0, 29),
(193, '6123456789023', 1, '635000.00', '390000.00', 0, 30),
(194, '6123456789559', 4, '99000.00', '51000.00', 0, 31),
(195, '6959630211895', 2, '159000.00', '141000.00', 0, 32),
(196, '6123456789023', 1, '635000.00', '390000.00', 0, 33),
(197, '6123456789016', 1, '1180000.00', '875000.00', 0, 33),
(199, '6123456789023', 1, '635000.00', '390000.00', 0, 34),
(200, '6959630211895', 1, '159000.00', '141000.00', 0, 35),
(201, '6123456789023', 1, '635000.00', '390000.00', 0, 36),
(202, '6931407600620', 1, '289000.00', '131000.00', 0, 37),
(203, '6123456784547', 1, '508000.00', '120000.00', 0, 38),
(204, '15000', 1, '15000.00', '0.00', 0, 38),
(206, '6947273311058', 1, '195000.00', '100000.00', 0, 39),
(207, '6427894571442', 1, '39000.00', '11000.00', 0, 39),
(208, '30000', 1, '30000.00', '0.00', 0, 39),
(209, '6947273311058', 1, '195000.00', '100000.00', 0, 40),
(210, '6427894571442', 1, '39000.00', '11000.00', 0, 40),
(212, '6123456789023', 1, '635000.00', '390000.00', 0, 41),
(213, '15000', 1, '15000.00', '0.00', 0, 41),
(215, '6956766919626', 1, '239000.00', '186000.00', 0, 42),
(216, '30000', 1, '30000.00', '0.00', 0, 42),
(218, '6123456789559', 1, '99000.00', '51000.00', 0, 43),
(219, '6123456789542', 1, '89000.00', '41000.00', 0, 44),
(220, '6123456789078', 1, '635000.00', '390000.00', 0, 45),
(221, '6931407600620', 1, '289000.00', '131000.00', 0, 46),
(222, '6427894571442', 1, '39000.00', '11000.00', 0, 46),
(224, '6956766919626', 1, '239000.00', '186000.00', 0, 47),
(225, '6947273311058', 1, '195000.00', '100000.00', 0, 48),
(226, '6123456789559', 1, '99000.00', '51000.00', 0, 49),
(227, '6123456789023', 1, '635000.00', '390000.00', 0, 50),
(228, '6959630211895', 1, '159000.00', '141000.00', 0, 50),
(229, '6123456784547', 1, '508000.00', '120000.00', 0, 50),
(230, '6940252365035', 1, '289000.00', '100000.00', 0, 51),
(231, '6123452789093', 1, '635000.00', '365000.00', 0, 52),
(232, '6972661281101', 1, '159000.00', '100000.00', 0, 53),
(233, '6971880290123', 1, '135000.00', '5000.00', 0, 53),
(235, '6123456784547', 1, '508000.00', '120000.00', 0, 54),
(236, '6123456784547', 1, '508000.00', '120000.00', 0, 55),
(237, '6947273311058', 1, '195000.00', '100000.00', 0, 56),
(238, '6956766919626', 1, '239000.00', '186000.00', 0, 57),
(239, '6959630211895', 1, '159000.00', '141000.00', 0, 57),
(240, '6947273311058', 1, '195000.00', '100000.00', 0, 57),
(241, '6123456789061', 1, '635000.00', '390000.00', 0, 58),
(242, '20205181045', 1, '249000.00', '251000.00', 0, 58),
(243, '6959630211895', 1, '159000.00', '141000.00', 0, 58),
(244, '6947273311058', 1, '195000.00', '100000.00', 0, 59),
(245, '6123456789061', 1, '635000.00', '390000.00', 0, 60),
(246, '6123452789093', 1, '635000.00', '365000.00', 0, 61),
(247, '6947273311058', 1, '195000.00', '100000.00', 0, 61),
(249, '6183450789092', 1, '570000.00', '120000.00', 0, 62),
(250, '6947273311058', 1, '195000.00', '100000.00', 0, 62),
(252, '6123456789023', 3, '635000.00', '390000.00', 0, 63),
(253, '6183450789092', 1, '570000.00', '120000.00', 0, 64),
(254, '6183450789092', 1, '570000.00', '120000.00', 0, 65),
(255, '6123456789023', 1, '635000.00', '390000.00', 0, 65),
(257, '6123456784547', 1, '508000.00', '120000.00', 0, 66),
(258, '6959630211895', 1, '159000.00', '141000.00', 0, 66),
(259, '6956766907364', 1, '179000.00', '21000.00', 0, 66),
(260, '6947273311058', 2, '195000.00', '100000.00', 0, 66),
(264, '6947273311058', 3, '195000.00', '100000.00', 0, 67),
(265, '6427894571442', 1, '39000.00', '11000.00', 0, 68),
(266, '6427894571441', 1, '39000.00', '11000.00', 0, 68),
(268, '6123456789061', 1, '635000.00', '390000.00', 0, 69),
(269, '6947273311058', 1, '195000.00', '100000.00', 0, 70),
(270, '6183450789092', 1, '570000.00', '120000.00', 0, 71),
(271, '6123456789061', 1, '635000.00', '390000.00', 0, 72),
(272, '6947273311058', 1, '195000.00', '100000.00', 0, 73),
(273, '6123456789023', 1, '635000.00', '390000.00', 0, 74),
(274, '6972661281071', 1, '159000.00', '100000.00', 0, 75),
(275, '6972661281101', 1, '159000.00', '100000.00', 0, 76),
(276, '6940252365035', 1, '289000.00', '100000.00', 0, 77),
(277, '6123456789061', 1, '635000.00', '390000.00', 0, 78),
(278, '6183450789092', 1, '570000.00', '120000.00', 0, 79),
(279, '6123456784547', 1, '508000.00', '120000.00', 0, 80),
(280, '6123456789542', 1, '89000.00', '41000.00', 0, 81),
(281, '6123456789559', 2, '99000.00', '51000.00', 0, 81),
(282, '6123456789047', 1, '635000.00', '390000.00', 0, 81),
(283, '6123456789023', 1, '635000.00', '390000.00', 0, 82),
(284, '6183450789092', 1, '570000.00', '120000.00', 0, 83),
(285, '6123456789542', 1, '89000.00', '41000.00', 0, 84),
(286, '6123456789023', 1, '635000.00', '390000.00', 0, 85),
(287, '15000', 1, '15000.00', '0.00', 0, 86),
(288, '15000', 1, '15000.00', '0.00', 0, 87),
(289, '6123456789023', 1, '635000.00', '390000.00', 0, 88),
(290, '6123456784547', 1, '508000.00', '120000.00', 0, 89),
(291, '6931407600620', 1, '289000.00', '131000.00', 0, 90),
(292, '6931407600620', 1, '289000.00', '131000.00', 0, 91),
(293, '6123456789559', 1, '99000.00', '51000.00', 0, 92),
(294, '6956766906237', 1, '140000.00', '20000.00', 0, 93),
(295, '6931407600620', 1, '289000.00', '131000.00', 0, 94),
(296, '6183450789092', 1, '570000.00', '120000.00', 0, 95),
(297, '6123456784547', 1, '508000.00', '120000.00', 0, 96),
(298, '6123456789559', 1, '99000.00', '51000.00', 0, 97),
(299, '6123456789542', 1, '89000.00', '41000.00', 0, 97),
(301, '6947273311058', 2, '195000.00', '100000.00', 0, 98),
(302, '6123452789093', 1, '635000.00', '365000.00', 0, 99),
(303, '6947273311058', 2, '195000.00', '100000.00', 0, 100),
(304, '6123456784547', 1, '508000.00', '120000.00', 0, 101),
(305, '6947273311058', 1, '195000.00', '100000.00', 0, 102),
(306, '6947273311058', 4, '195000.00', '100000.00', 0, 103),
(307, '6927530262989', 2, '19000.00', '11000.00', 0, 104),
(308, '6972661281101', 1, '159000.00', '100000.00', 0, 105),
(309, '6933153602125', 1, '269000.00', '31000.00', 0, 105),
(310, '6970202291589', 1, '99000.00', '10000.00', 0, 105),
(311, '6956766906237', 1, '140000.00', '20000.00', 0, 106),
(312, '6123456784547', 1, '508000.00', '120000.00', 0, 107),
(313, '6427894571442', 1, '39000.00', '11000.00', 0, 108),
(314, '6972661281101', 1, '169000.00', '100000.00', 0, 109),
(315, '6183450789092', 2, '570000.00', '120000.00', 0, 110),
(316, '6123456789023', 1, '635000.00', '390000.00', 0, 111),
(317, '6959630211895', 1, '159000.00', '141000.00', 0, 112),
(318, '6956766919626', 1, '239000.00', '186000.00', 0, 113),
(319, '6183450789092', 1, '570000.00', '120000.00', 0, 114),
(320, '6123456784547', 1, '508000.00', '120000.00', 0, 115),
(321, '6947273311058', 1, '195000.00', '100000.00', 0, 116),
(322, '6947273311058', 1, '195000.00', '100000.00', 0, 117),
(323, '6427894571442', 1, '39000.00', '11000.00', 0, 118),
(324, '6183450789092', 1, '570000.00', '120000.00', 0, 119),
(325, '6123456789078', 1, '635000.00', '390000.00', 0, 119),
(327, '6123456789023', 1, '635000.00', '390000.00', 0, 120),
(328, '6123456789023', 1, '635000.00', '390000.00', 0, 121),
(329, '6427894571441', 1, '39000.00', '11000.00', 0, 122),
(330, '6956766919626', 1, '239000.00', '186000.00', 0, 123),
(331, '6427894571441', 1, '39000.00', '11000.00', 0, 123),
(333, '6931407600620', 1, '289000.00', '131000.00', 0, 124),
(334, '6956766919626', 1, '239000.00', '186000.00', 0, 125),
(335, '6972661281101', 1, '169000.00', '100000.00', 0, 126),
(336, '6947273311058', 5, '195000.00', '100000.00', 0, 127),
(337, '6931407600620', 1, '289000.00', '131000.00', 0, 128),
(338, '6927530262989', 1, '19000.00', '11000.00', 0, 129),
(339, '6931407601283', 1, '45000.00', '15000.00', 0, 129),
(341, '6950386491296', 1, '245000.00', '255000.00', 0, 130),
(342, '6950589905798', 1, '359000.00', '41000.00', 0, 131),
(343, '6933153602125', 1, '285000.00', '15000.00', 0, 132),
(344, '6931407600620', 1, '289000.00', '131000.00', 0, 133),
(345, '6183450789092', 1, '570000.00', '120000.00', 0, 134),
(346, '6123456789023', 1, '635000.00', '390000.00', 0, 134),
(347, '6931407600620', 1, '289000.00', '131000.00', 0, 135),
(348, '6183450789092', 1, '570000.00', '120000.00', 0, 136),
(349, '6183450789092', 1, '570000.00', '120000.00', 0, 137),
(350, '6931407600477', 1, '199000.00', '101000.00', 0, 138),
(351, '6123456784547', 1, '508000.00', '120000.00', 0, 138),
(353, '6123456789023', 1, '635000.00', '390000.00', 0, 139),
(354, '6959630211895', 1, '159000.00', '141000.00', 0, 140),
(355, '20205181045', 1, '259000.00', '241000.00', 0, 141),
(356, '6183450789092', 1, '570000.00', '120000.00', 0, 142),
(357, '6931407600620', 2, '289000.00', '131000.00', 0, 143),
(358, '6931407600620', 1, '289000.00', '131000.00', 0, 144),
(359, '6930209303746', 1, '89000.00', '100000.00', 0, 145),
(360, '6931407600620', 1, '289000.00', '131000.00', 0, 146),
(361, '6931407600620', 1, '289000.00', '131000.00', 0, 147),
(362, '6427894571441', 1, '39000.00', '11000.00', 0, 148),
(363, '6123456789023', 1, '635000.00', '390000.00', 0, 149),
(364, '6123456789023', 1, '635000.00', '390000.00', 0, 150),
(365, 'pop10635128175', 1, '119000.00', '100000.00', 0, 151),
(366, '6931407600620', 2, '289000.00', '131000.00', 0, 151),
(368, '6948391226996', 1, '250000.00', '50000.00', 0, 152),
(369, '6931407600620', 1, '289000.00', '131000.00', 0, 153),
(370, '6123452789093', 1, '635000.00', '365000.00', 0, 154),
(371, '6931407600620', 1, '289000.00', '131000.00', 0, 155),
(372, '6947273311058', 2, '195000.00', '100000.00', 0, 156),
(373, '6427894571441', 1, '39000.00', '11000.00', 0, 157),
(374, '6931407600620', 1, '289000.00', '131000.00', 0, 158),
(375, '6123456789023', 1, '635000.00', '390000.00', 0, 159),
(376, '6427894571442', 2, '39000.00', '11000.00', 0, 160),
(377, '6930209303746', 1, '89000.00', '100000.00', 0, 161),
(378, '6123456789061', 1, '635000.00', '390000.00', 0, 162),
(379, '6123456789023', 1, '635000.00', '390000.00', 0, 163),
(380, '6931407600620', 1, '289000.00', '131000.00', 0, 164),
(381, '6947273311058', 2, '195000.00', '100000.00', 0, 165),
(382, '6972661281101', 1, '169000.00', '100000.00', 0, 166),
(383, '6427894571441', 2, '39000.00', '11000.00', 0, 167),
(384, '6931407600477', 1, '199000.00', '101000.00', 0, 168),
(385, 'pop10635128175', 1, '119000.00', '100000.00', 0, 169),
(386, '6123456789023', 1, '635000.00', '390000.00', 0, 170),
(387, '6123456789023', 1, '635000.00', '390000.00', 0, 171),
(388, '6950589906795', 1, '289000.00', '11000.00', 0, 172),
(389, '6970202291580', 1, '129000.00', '71000.00', 0, 173),
(390, '6931407600477', 1, '199000.00', '101000.00', 0, 174),
(391, '6931407600620', 1, '289000.00', '131000.00', 0, 175),
(392, '6931407600620', 1, '289000.00', '131000.00', 0, 176),
(393, '6931407600477', 1, '199000.00', '101000.00', 0, 177),
(394, '6931407600620', 1, '289000.00', '131000.00', 0, 178),
(395, '6123456789023', 1, '635000.00', '390000.00', 0, 179),
(396, '6123456789023', 1, '635000.00', '390000.00', 0, 180),
(397, '6123456789023', 1, '635000.00', '390000.00', 0, 181),
(398, '6123456789023', 1, '635000.00', '390000.00', 0, 183),
(399, '6947273311058', 1, '195000.00', '100000.00', 0, 184),
(400, '6123456789023', 1, '635000.00', '390000.00', 0, 185),
(401, '6123456789023', 1, '635000.00', '390000.00', 0, 186),
(402, '740617280012', 1, '539000.00', '61000.00', 0, 187),
(404, '6123456789023', 1, '635000.00', '390000.00', 0, 188),
(405, '6931407600477', 1, '199000.00', '101000.00', 0, 189),
(406, '6931407600477', 1, '199000.00', '101000.00', 0, 190),
(407, '6959630211895', 1, '159000.00', '141000.00', 0, 191),
(408, '8886419332510', 1, '239000.00', '100000.00', 0, 192),
(409, '6123456789047', 1, '635000.00', '390000.00', 0, 193),
(410, '6931407600620', 1, '289000.00', '131000.00', 0, 194),
(411, '6927530262989', 1, '19000.00', '11000.00', 0, 195),
(412, '6971141390036', 1, '139000.00', '100000.00', 0, 195),
(414, '6931407600477', 1, '199000.00', '101000.00', 0, 196),
(415, '6427894571441', 1, '39000.00', '11000.00', 0, 197),
(416, '6123456789023', 1, '635000.00', '390000.00', 0, 198),
(417, '6123456789023', 1, '635000.00', '390000.00', 0, 199),
(418, '6971141390036', 1, '139000.00', '100000.00', 0, 200),
(419, '6427894571441', 1, '39000.00', '11000.00', 0, 201),
(420, '6123456789023', 1, '635000.00', '390000.00', 0, 202),
(421, '6971141390449', 1, '159000.00', '100000.00', 0, 203),
(422, '6959630211895', 1, '159000.00', '141000.00', 0, 204),
(423, '6123456789023', 1, '635000.00', '390000.00', 0, 205),
(424, '6123456789542', 1, '89000.00', '41000.00', 0, 206),
(425, '6123456789023', 1, '635000.00', '390000.00', 0, 207),
(426, '6931407600620', 1, '289000.00', '131000.00', 0, 208),
(427, '6931407600620', 1, '289000.00', '131000.00', 0, 209),
(428, '6427894571442', 1, '39000.00', '11000.00', 0, 210),
(429, '6931407600477', 1, '199000.00', '101000.00', 0, 211),
(430, '6931407600620', 2, '289000.00', '131000.00', 0, 211),
(432, '6123456789023', 1, '635000.00', '390000.00', 0, 212),
(433, '8886419370970', 1, '700000.00', '100000.00', 0, 213),
(434, '6123456789023', 2, '635000.00', '390000.00', 0, 214),
(435, '6123456789023', 3, '635000.00', '390000.00', 0, 215),
(436, '6931407600477', 4, '199000.00', '101000.00', 0, 215),
(437, 'pop20200430222', 2, '109000.00', '100000.00', 0, 215),
(438, '6972661281101', 1, '169000.00', '100000.00', 0, 215),
(439, '6959630211895', 1, '159000.00', '141000.00', 0, 215),
(440, '6123456789016', 2, '1180000.00', '875000.00', 0, 215),
(441, '6123456789061', 1, '635000.00', '390000.00', 0, 215),
(442, '6183450789092', 2, '570000.00', '120000.00', 0, 215),
(443, '6123456789030', 1, '635000.00', '390000.00', 0, 215),
(444, '6123452789093', 1, '635000.00', '365000.00', 0, 215),
(445, '6188456789017', 1, '89000.00', '111000.00', 0, 215),
(446, '6920377905040', 1, '585000.00', '100000.00', 0, 215),
(447, '6920377908225', 1, '579000.00', '21000.00', 0, 215),
(450, '6123456789023', 9, '635000.00', '390000.00', 0, 216),
(451, '6940252365035', 2, '289000.00', '100000.00', 0, 216),
(452, '6123456789559', 1, '99000.00', '51000.00', 0, 216),
(453, '6972661281101', 2, '169000.00', '100000.00', 0, 216),
(454, '6947273311058', 1, '195000.00', '100000.00', 0, 216),
(455, '6123456789016', 1, '1180000.00', '875000.00', 0, 216),
(456, '6950386491296', 1, '245000.00', '255000.00', 0, 216),
(457, '6183450789092', 2, '570000.00', '120000.00', 0, 216),
(458, '6123456789085', 1, '508000.00', '120000.00', 0, 216),
(465, '6123452789093', 2, '635000.00', '365000.00', 0, 217),
(466, '6183450789092', 1, '570000.00', '120000.00', 0, 218),
(467, '6123456789023', 1, '635000.00', '390000.00', 0, 219),
(468, '6123456789061', 1, '635000.00', '390000.00', 0, 220),
(469, '6123456789023', 1, '635000.00', '390000.00', 0, 221),
(470, '6123452789093', 1, '635000.00', '365000.00', 0, 222),
(471, '6123456789023', 1, '635000.00', '390000.00', 0, 223),
(472, '6123456789085', 1, '508000.00', '120000.00', 0, 224),
(473, '6956766907388', 1, '199000.00', '1000.00', 0, 225),
(474, '6427894571442', 1, '39000.00', '11000.00', 0, 225),
(476, '6183450789092', 1, '570000.00', '120000.00', 0, 226),
(477, '6123456789023', 1, '635000.00', '390000.00', 0, 227),
(478, '6959630211895', 1, '159000.00', '141000.00', 0, 227),
(480, '6123456789023', 1, '635000.00', '390000.00', 0, 228),
(481, '6183450789092', 1, '570000.00', '120000.00', 0, 229),
(482, '6123456789023', 1, '635000.00', '390000.00', 0, 230),
(483, '6123456789023', 1, '635000.00', '390000.00', 0, 231),
(484, '6123456789023', 1, '635000.00', '390000.00', 0, 232),
(485, '740617280012', 1, '539000.00', '61000.00', 0, 233),
(486, '6123456789054', 1, '635000.00', '390000.00', 0, 234),
(487, '6123456789023', 1, '635000.00', '390000.00', 0, 235),
(488, '6123456789023', 1, '635000.00', '390000.00', 0, 236),
(489, '6123456789023', 1, '635000.00', '390000.00', 0, 237),
(490, '6123456789023', 1, '635000.00', '390000.00', 0, 238),
(491, '6123456789023', 1, '635000.00', '390000.00', 0, 239),
(492, '6123456789061', 1, '635000.00', '390000.00', 0, 240),
(493, '6123456789023', 1, '635000.00', '390000.00', 0, 241),
(494, '6123456789023', 1, '635000.00', '390000.00', 0, 242),
(495, '6123456789016', 1, '1180000.00', '875000.00', 0, 243),
(496, '6931407600620', 1, '289000.00', '131000.00', 0, 244),
(497, '6971141390449', 1, '159000.00', '100000.00', 0, 245),
(498, '6123456789061', 1, '635000.00', '390000.00', 0, 246),
(499, '6123456789023', 1, '635000.00', '390000.00', 0, 247),
(500, '6123456789085', 1, '508000.00', '120000.00', 0, 248),
(501, '6123456789023', 1, '635000.00', '390000.00', 0, 249),
(502, '6183450789092', 1, '570000.00', '120000.00', 0, 250),
(503, '6123456789023', 1, '635000.00', '390000.00', 0, 251),
(504, '6123456789023', 1, '635000.00', '390000.00', 0, 252),
(505, '6123456789023', 1, '635000.00', '390000.00', 0, 253),
(506, '6123456789061', 1, '635000.00', '390000.00', 0, 254),
(507, '6123456789023', 1, '635000.00', '390000.00', 0, 255),
(508, '6123456789023', 1, '635000.00', '390000.00', 0, 256),
(509, '6123456789023', 1, '635000.00', '390000.00', 0, 257),
(510, '6123456789023', 1, '635000.00', '390000.00', 0, 258),
(511, '6123456789023', 1, '635000.00', '390000.00', 0, 259),
(512, '6183450789092', 1, '570000.00', '120000.00', 0, 259),
(514, '6123456789023', 1, '635000.00', '390000.00', 0, 260),
(515, '6931407600620', 1, '289000.00', '131000.00', 0, 261),
(516, '6123456789023', 1, '645000.00', '380000.00', 0, 262),
(517, '6123456789023', 1, '645000.00', '380000.00', 0, 263),
(518, '6931407600620', 1, '289000.00', '131000.00', 0, 264),
(519, '6123456789085', 1, '515000.00', '125000.00', 0, 265),
(520, '6956766907388', 1, '199000.00', '1000.00', 0, 266),
(521, '6959630211895', 1, '159000.00', '141000.00', 0, 267),
(522, '6123456784547', 1, '515000.00', '125000.00', 0, 268),
(523, '6123456784547', 1, '515000.00', '125000.00', 0, 269),
(524, '6972661281101', 1, '169000.00', '100000.00', 0, 270),
(525, '6183450789092', 3, '580000.00', '110000.00', 0, 271),
(526, '6123456784547', 1, '515000.00', '125000.00', 0, 272),
(527, '6123456789061', 1, '655000.00', '370000.00', 0, 273),
(528, '6123456789016', 1, '1199000.00', '801000.00', 0, 274),
(529, '6123456789023', 1, '655000.00', '370000.00', 0, 276),
(530, '6123452789093', 1, '655000.00', '345000.00', 0, 277),
(531, '6123456789023', 1, '655000.00', '370000.00', 0, 278),
(532, '6123452789093', 1, '655000.00', '345000.00', 0, 279),
(533, '6123456789016', 1, '1217000.00', '783000.00', 0, 280),
(534, '6123456789023', 1, '655000.00', '370000.00', 0, 281),
(535, '6123456789085', 1, '525000.00', '115000.00', 0, 282),
(536, '6123456789016', 1, '1217000.00', '783000.00', 0, 283),
(537, '6123456789054', 1, '655000.00', '370000.00', 0, 284),
(538, '6123456784547', 1, '525000.00', '115000.00', 0, 284),
(539, '6123456789061', 1, '655000.00', '370000.00', 0, 284),
(540, '6123456789023', 1, '655000.00', '370000.00', 0, 285),
(541, '6931407600620', 1, '289000.00', '131000.00', 0, 286),
(542, '6123456789023', 1, '655000.00', '370000.00', 0, 287),
(543, '6123456784547', 1, '525000.00', '115000.00', 0, 288),
(544, '6956766906237', 1, '140000.00', '20000.00', 0, 289),
(545, '6123456784547', 1, '525000.00', '115000.00', 0, 289),
(547, '6123456789023', 1, '655000.00', '370000.00', 0, 290),
(548, '6123456789023', 1, '655000.00', '370000.00', 0, 291),
(549, '6123456789023', 1, '655000.00', '370000.00', 0, 292),
(550, '6950589906795', 1, '190000.00', '110000.00', 0, 293),
(551, '6123456784547', 1, '525000.00', '115000.00', 0, 294),
(552, '6123456789023', 1, '655000.00', '370000.00', 0, 294),
(554, '6950589905798', 1, '359000.00', '41000.00', 0, 295),
(555, '6123456789023', 1, '655000.00', '370000.00', 0, 296),
(556, '6123456789023', 1, '655000.00', '370000.00', 0, 297),
(557, '6183450789092', 1, '590000.00', '100000.00', 0, 298),
(558, '6183450789092', 1, '590000.00', '100000.00', 0, 299),
(559, '6183450789092', 1, '590000.00', '100000.00', 0, 300),
(560, '6972661281071', 1, '159000.00', '100000.00', 0, 301),
(561, '6948391227290', 1, '165000.00', '100000.00', 0, 302),
(562, '6183450789092', 1, '590000.00', '100000.00', 0, 303),
(563, '6123456784547', 1, '525000.00', '115000.00', 0, 304),
(564, '6931407600620', 1, '289000.00', '131000.00', 0, 305),
(565, '6123456784547', 1, '525000.00', '115000.00', 0, 306),
(566, '6183450789092', 1, '590000.00', '100000.00', 0, 307),
(567, '6123456789023', 1, '655000.00', '370000.00', 0, 308),
(568, '6957303836208', 1, '35000.00', '5000.00', 0, 308),
(570, '6123456789023', 1, '655000.00', '370000.00', 0, 309),
(571, '6123456789559', 1, '99000.00', '51000.00', 0, 310),
(572, '6123456789030', 1, '655000.00', '370000.00', 0, 311),
(573, '6123456789061', 1, '655000.00', '370000.00', 0, 311),
(575, '6123456789085', 1, '525000.00', '115000.00', 0, 312),
(576, '6123456789023', 1, '655000.00', '370000.00', 0, 313),
(577, '6123456789023', 1, '655000.00', '370000.00', 0, 314),
(578, '6933153602125', 1, '285000.00', '15000.00', 0, 315),
(579, '6427894571441', 1, '39000.00', '11000.00', 0, 315),
(581, '6123456789023', 1, '655000.00', '370000.00', 0, 316),
(582, '6123456789023', 2, '655000.00', '370000.00', 0, 317),
(583, '6188456789017', 1, '89000.00', '111000.00', 0, 318),
(584, '6123456784547', 1, '535000.00', '105000.00', 0, 319),
(585, '8886419332909', 1, '295000.00', '100000.00', 0, 320),
(586, '6933153602125', 1, '285000.00', '15000.00', 0, 320),
(587, '6970202291580', 1, '129000.00', '71000.00', 0, 320),
(588, '6123456789023', 1, '670000.00', '355000.00', 0, 321),
(589, '6123456784547', 1, '535000.00', '105000.00', 0, 322),
(590, '6123456789023', 1, '670000.00', '355000.00', 0, 323),
(591, '6123452789093', 1, '670000.00', '330000.00', 0, 324),
(592, '6123456789085', 1, '535000.00', '105000.00', 0, 325),
(593, '6123456789016', 1, '1240000.00', '760000.00', 0, 326),
(594, '6123452789093', 2, '670000.00', '330000.00', 0, 327),
(595, '6123456789085', 1, '535000.00', '105000.00', 0, 328),
(596, '6123456789023', 1, '670000.00', '355000.00', 0, 329),
(597, '6183450789092', 1, '600000.00', '90000.00', 0, 330),
(598, '6183450789092', 1, '600000.00', '90000.00', 0, 331),
(599, '6123456789023', 1, '670000.00', '355000.00', 0, 332),
(600, '6123456784547', 1, '535000.00', '105000.00', 0, 333),
(601, '6183450789092', 1, '600000.00', '90000.00', 0, 334),
(602, '6940252365035', 1, '299000.00', '90000.00', 0, 335),
(603, '6123456789023', 1, '670000.00', '355000.00', 0, 336),
(604, '6123456789023', 1, '670000.00', '355000.00', 0, 337),
(605, '6123456789061', 1, '670000.00', '355000.00', 0, 338),
(606, '6183450789092', 1, '600000.00', '90000.00', 0, 338),
(608, '6123456789023', 1, '670000.00', '355000.00', 0, 339),
(609, '6123456784547', 1, '535000.00', '105000.00', 0, 340),
(610, '6183450789092', 1, '600000.00', '90000.00', 0, 341),
(611, '6123456789023', 1, '670000.00', '355000.00', 0, 342),
(612, '6123456789023', 1, '670000.00', '355000.00', 0, 343),
(613, '6183450789092', 1, '600000.00', '90000.00', 0, 344),
(614, '6123456784547', 1, '535000.00', '105000.00', 0, 345),
(615, '6123456789085', 1, '535000.00', '105000.00', 0, 346),
(616, '6930209303746', 1, '89000.00', '100000.00', 0, 347),
(617, '740617280012', 1, '539000.00', '61000.00', 0, 348),
(618, '6123456789023', 1, '670000.00', '355000.00', 0, 349),
(619, '6123456789023', 1, '670000.00', '355000.00', 0, 350),
(620, '6950589905798', 1, '359000.00', '41000.00', 0, 351),
(621, '6183450789092', 1, '600000.00', '90000.00', 0, 352),
(622, '6123456789023', 1, '670000.00', '355000.00', 0, 353),
(623, '6123456784547', 1, '535000.00', '105000.00', 0, 354),
(624, '8886419378273', 1, '980000.00', '20000.00', 0, 355),
(625, '6123452789093', 1, '670000.00', '330000.00', 0, 356),
(626, '6123456789085', 1, '540000.00', '100000.00', 0, 357),
(627, '6123456784547', 1, '540000.00', '100000.00', 0, 358),
(628, '6183450789092', 1, '600000.00', '90000.00', 0, 359),
(629, '6427894571441', 1, '39000.00', '11000.00', 0, 360),
(630, '6123456789023', 1, '675000.00', '350000.00', 0, 361),
(631, '6123456789023', 1, '675000.00', '350000.00', 0, 362),
(632, '6123456784547', 1, '540000.00', '100000.00', 0, 363),
(634, '6948391227290', 1, '165000.00', '100000.00', 0, 365),
(635, '6123456789061', 1, '675000.00', '350000.00', 0, 366),
(636, '6183450789092', 1, '600000.00', '90000.00', 0, 367),
(637, '6123456789023', 1, '675000.00', '350000.00', 0, 368),
(638, '6123456789016', 1, '1240000.00', '760000.00', 0, 369),
(639, '6940252365035', 1, '299000.00', '90000.00', 0, 370),
(640, '6123456789023', 1, '675000.00', '350000.00', 0, 371),
(641, '6123456789023', 1, '675000.00', '350000.00', 0, 372),
(642, '6123456789023', 1, '675000.00', '350000.00', 0, 373),
(643, '8886419332909', 1, '295000.00', '100000.00', 0, 374),
(644, '6183450789092', 1, '610000.00', '80000.00', 0, 375),
(645, '6123456789023', 1, '675000.00', '350000.00', 0, 376),
(646, '6123456789023', 1, '675000.00', '350000.00', 0, 377),
(647, '6123456789559', 1, '99000.00', '51000.00', 0, 378),
(648, '6123456784547', 1, '540000.00', '100000.00', 0, 379),
(649, '6123456789085', 1, '540000.00', '100000.00', 0, 380),
(650, '6123456784547', 1, '540000.00', '100000.00', 0, 381),
(651, '8886419332831', 1, '465000.00', '100000.00', 0, 382),
(652, '6948391225609', 1, '199000.00', '51000.00', 0, 382),
(654, '6123456789061', 1, '675000.00', '350000.00', 0, 383),
(655, '6951613917312', 1, '299000.00', '1000.00', 0, 384),
(656, '6123456789023', 1, '675000.00', '350000.00', 0, 385),
(657, '8886419332510', 1, '259000.00', '100000.00', 0, 386),
(658, '6123456784547', 1, '540000.00', '100000.00', 0, 387),
(659, '6123452789093', 1, '675000.00', '325000.00', 0, 388),
(660, '6123456789023', 1, '675000.00', '350000.00', 0, 389),
(661, '6931407600620', 1, '289000.00', '131000.00', 0, 390),
(662, '6931407600620', 1, '289000.00', '131000.00', 0, 391),
(663, '6123452789093', 1, '675000.00', '325000.00', 0, 392),
(664, '6123456789023', 1, '675000.00', '350000.00', 0, 393),
(665, '6123456789085', 1, '540000.00', '100000.00', 0, 394),
(666, '6123452789093', 1, '675000.00', '325000.00', 0, 395),
(667, '740617280012', 1, '539000.00', '61000.00', 0, 396),
(668, '6123456789023', 1, '675000.00', '350000.00', 0, 397),
(669, '6123456789023', 1, '675000.00', '350000.00', 0, 398),
(670, '6931407600620', 1, '289000.00', '131000.00', 0, 399),
(672, '6123456789023', 1, '675000.00', '350000.00', 0, 400),
(673, '6183450789092', 1, '610000.00', '80000.00', 0, 401),
(674, '6183450789092', 1, '610000.00', '80000.00', 0, 402),
(675, '6123456789023', 1, '675000.00', '350000.00', 0, 403),
(676, '6183450789092', 1, '610000.00', '80000.00', 0, 403),
(678, '6948391226996', 1, '259000.00', '41000.00', 0, 404),
(679, '6956766907388', 1, '199000.00', '1000.00', 0, 404),
(680, '6427894571441', 2, '39000.00', '11000.00', 0, 404),
(681, '6948391233918', 1, '279000.00', '300000.00', 0, 405),
(682, '6123456789023', 1, '675000.00', '350000.00', 0, 406),
(683, '6123456789023', 1, '675000.00', '350000.00', 0, 407),
(684, '6123456789023', 2, '675000.00', '350000.00', 0, 408),
(685, '6123456784547', 1, '540000.00', '100000.00', 0, 409),
(686, '6427894571442', 1, '39000.00', '11000.00', 0, 410),
(687, '6950589906795', 1, '190000.00', '110000.00', 0, 410),
(689, '6427894571441', 1, '39000.00', '11000.00', 0, 411),
(690, '6123456789023', 1, '675000.00', '350000.00', 0, 412),
(691, '6950589905798', 1, '359000.00', '41000.00', 0, 413),
(692, '6948391226996', 1, '259000.00', '41000.00', 0, 414),
(693, '6123456789085', 1, '540000.00', '100000.00', 0, 415),
(694, '6972579061055', 1, '129000.00', '100000.00', 0, 416),
(695, '6123456784547', 1, '540000.00', '100000.00', 0, 417),
(696, '6933153602125', 1, '285000.00', '15000.00', 0, 418),
(697, '6972661281101', 1, '169000.00', '100000.00', 0, 418),
(699, '6123456789023', 1, '675000.00', '350000.00', 0, 419),
(700, '6123456789023', 1, '675000.00', '350000.00', 0, 420),
(701, '6123456789023', 1, '675000.00', '350000.00', 0, 421),
(702, '6123456789023', 1, '675000.00', '350000.00', 0, 422),
(703, '6948391226996', 1, '259000.00', '41000.00', 0, 423),
(704, '6943106977309', 1, '125000.00', '5000.00', 0, 424),
(705, '6123456789023', 1, '675000.00', '350000.00', 0, 425),
(706, '6123456789023', 1, '675000.00', '350000.00', 0, 426),
(707, '6123456789016', 1, '1240000.00', '760000.00', 0, 427),
(708, '6123452789093', 1, '675000.00', '325000.00', 0, 428),
(709, '6183450789092', 1, '610000.00', '80000.00', 0, 429),
(710, '8886419341215', 1, '349000.00', '100000.00', 0, 430),
(711, '6970202291580', 1, '129000.00', '71000.00', 0, 430),
(713, '6970202291580', 1, '129000.00', '71000.00', 0, 431),
(714, '02822112', 1, '45000.00', '5000.00', 0, 432),
(715, '6971141390449', 1, '159000.00', '100000.00', 0, 432),
(717, '6123456789061', 1, '675000.00', '350000.00', 0, 433),
(718, '6950589905798', 1, '359000.00', '41000.00', 0, 434),
(719, '6183450789092', 1, '610000.00', '80000.00', 0, 435),
(720, '6948391226996', 1, '259000.00', '41000.00', 0, 436),
(721, '6123456784547', 1, '540000.00', '100000.00', 0, 437),
(722, '6123456789023', 1, '675000.00', '350000.00', 0, 438),
(723, '6123456789023', 1, '675000.00', '350000.00', 0, 439),
(724, '6123456789023', 1, '675000.00', '350000.00', 0, 440),
(725, '6123452789093', 1, '675000.00', '325000.00', 0, 441),
(726, '6183450789092', 1, '610000.00', '80000.00', 0, 442),
(727, '6123456789023', 1, '675000.00', '350000.00', 0, 443),
(728, '6940252365035', 1, '299000.00', '90000.00', 0, 444),
(729, '6123456789023', 1, '675000.00', '350000.00', 0, 445),
(730, '6183450789092', 1, '610000.00', '80000.00', 0, 446),
(731, '6123456789023', 1, '675000.00', '350000.00', 0, 447),
(732, '6123456789542', 1, '89000.00', '41000.00', 0, 448),
(733, '6123456789023', 1, '675000.00', '350000.00', 0, 449),
(734, '6123456789023', 1, '675000.00', '350000.00', 0, 450),
(735, '6123456789023', 1, '675000.00', '350000.00', 0, 451),
(736, '6183450789092', 1, '610000.00', '80000.00', 0, 452),
(737, '6123456789023', 1, '675000.00', '350000.00', 0, 453),
(738, '6123456789023', 1, '675000.00', '350000.00', 0, 454),
(739, '6123456789061', 1, '675000.00', '350000.00', 0, 455),
(740, '6123456789023', 1, '675000.00', '350000.00', 0, 456),
(741, '6123456789023', 1, '675000.00', '350000.00', 0, 457),
(742, '6948391226996', 1, '259000.00', '41000.00', 0, 458),
(743, '6972661281101', 1, '169000.00', '100000.00', 0, 459),
(744, '6123456789023', 1, '675000.00', '350000.00', 0, 460),
(745, '6948391227290', 1, '175000.00', '100000.00', 0, 461),
(746, '6123456789016', 1, '1250000.00', '750000.00', 0, 462),
(747, '6123456789023', 1, '675000.00', '350000.00', 0, 463),
(748, '6123456784547', 1, '540000.00', '100000.00', 0, 464),
(749, '6427894571441', 1, '39000.00', '11000.00', 0, 465),
(750, '6123456789016', 1, '1250000.00', '750000.00', 0, 466),
(751, '6123456789061', 1, '675000.00', '350000.00', 0, 467),
(752, '6123456789085', 1, '540000.00', '100000.00', 0, 468),
(753, '6948391227290', 1, '175000.00', '100000.00', 0, 469),
(754, '6123456789023', 1, '675000.00', '350000.00', 0, 470),
(755, '6123456789023', 1, '675000.00', '350000.00', 0, 471),
(756, '6123456789023', 1, '675000.00', '350000.00', 0, 472),
(757, '6123456789061', 1, '675000.00', '350000.00', 0, 473),
(758, '6123456789023', 1, '675000.00', '350000.00', 0, 474),
(759, '6950386491234', 1, '110000.00', '10000.00', 0, 475),
(760, '6123456784547', 2, '540000.00', '100000.00', 0, 475),
(762, '6927530262989', 4, '19000.00', '11000.00', 0, 476),
(763, '6123456789023', 1, '675000.00', '350000.00', 0, 477),
(764, '6183450789092', 1, '610000.00', '80000.00', 0, 478),
(765, '6950589906795', 1, '195000.00', '105000.00', 0, 479),
(766, '6123456789061', 1, '675000.00', '350000.00', 0, 480),
(767, '6972661281101', 1, '169000.00', '100000.00', 0, 481),
(768, '6123456789023', 1, '675000.00', '350000.00', 0, 482),
(769, '6123456789023', 1, '675000.00', '350000.00', 0, 483),
(770, '6123456789023', 1, '675000.00', '350000.00', 0, 484),
(771, '6933064647789', 1, '289000.00', '100000.00', 0, 485),
(772, '6935681701332', 1, '279000.00', '100000.00', 0, 485),
(774, '6183450789092', 1, '610000.00', '80000.00', 0, 486),
(775, '6951613917312', 1, '299000.00', '1000.00', 0, 487),
(776, '6123456784547', 1, '540000.00', '100000.00', 0, 488),
(777, '6123456789061', 1, '675000.00', '350000.00', 0, 489),
(778, '6123456789023', 1, '675000.00', '350000.00', 0, 490),
(779, '6183450789092', 1, '610000.00', '80000.00', 0, 491),
(780, '6123456789061', 1, '675000.00', '350000.00', 0, 492),
(781, '6123456784547', 1, '540000.00', '100000.00', 0, 493),
(782, '6933153602125', 1, '285000.00', '15000.00', 0, 494),
(783, '0311000101', 1, '199000.00', '101000.00', 0, 494),
(785, '6183450789092', 1, '610000.00', '80000.00', 0, 495),
(786, '6972661283013', 1, '259000.00', '100000.00', 0, 496),
(787, '6123456789061', 1, '675000.00', '350000.00', 0, 497),
(788, '6950386491296', 1, '245000.00', '255000.00', 0, 498),
(789, '6123456784547', 1, '540000.00', '100000.00', 0, 498),
(791, '6123456789016', 1, '1250000.00', '750000.00', 0, 499),
(792, '6123456789061', 1, '675000.00', '350000.00', 0, 500),
(793, '740617280012', 1, '539000.00', '61000.00', 0, 501),
(794, '6123456789023', 1, '675000.00', '350000.00', 0, 502),
(795, '6183450789092', 1, '610000.00', '80000.00', 0, 503),
(796, '6183450789092', 1, '610000.00', '80000.00', 0, 504),
(797, '6427894571442', 1, '39000.00', '11000.00', 0, 505),
(798, '6930209303746', 1, '89000.00', '100000.00', 0, 506),
(799, '6123456789085', 1, '540000.00', '100000.00', 0, 507),
(800, '6123456789023', 1, '675000.00', '350000.00', 0, 508),
(801, '6183450789092', 1, '610000.00', '80000.00', 0, 509),
(802, '6123456784547', 1, '540000.00', '100000.00', 0, 510),
(804, '6972661281101', 1, '169000.00', '100000.00', 0, 512),
(805, '6950589905798', 1, '359000.00', '41000.00', 0, 512),
(807, '6123456789085', 1, '540000.00', '100000.00', 0, 513),
(808, '6123456789085', 1, '540000.00', '100000.00', 0, 514),
(809, '6956766906237', 1, '140000.00', '20000.00', 0, 515),
(810, '6956766906718', 1, '159000.00', '141000.00', 0, 515),
(811, '6956766900396', 1, '99000.00', '100000.00', 0, 515),
(812, '6972661281101', 1, '169000.00', '100000.00', 0, 516),
(813, '6123456789023', 1, '675000.00', '350000.00', 0, 517),
(814, '6123456789023', 1, '675000.00', '350000.00', 0, 518),
(815, '8886419332909', 1, '295000.00', '100000.00', 0, 519),
(816, '6123456789023', 1, '675000.00', '350000.00', 0, 520),
(817, '6123456789030', 1, '675000.00', '350000.00', 0, 521),
(818, '6123456789023', 2, '675000.00', '350000.00', 0, 522),
(819, '6948391226996', 1, '259000.00', '41000.00', 0, 523),
(820, '6123456789023', 1, '675000.00', '350000.00', 0, 524),
(821, '6123452789093', 1, '675000.00', '325000.00', 0, 525),
(822, '6123456789023', 1, '675000.00', '350000.00', 0, 526),
(823, '6123456789023', 1, '675000.00', '350000.00', 0, 527),
(824, '6948391227290', 1, '175000.00', '100000.00', 0, 528),
(825, '6948391227290', 1, '175000.00', '100000.00', 0, 529),
(826, '6427894571441', 3, '39000.00', '11000.00', 0, 530),
(827, '6427894571442', 2, '39000.00', '11000.00', 0, 530),
(829, '8886419333005', 1, '289000.00', '100000.00', 0, 531),
(830, '6123456784547', 2, '540000.00', '100000.00', 0, 532),
(831, '6183450789092', 3, '610000.00', '80000.00', 0, 532),
(832, '6123456789023', 4, '675000.00', '350000.00', 0, 532),
(833, '6123456789061', 2, '675000.00', '350000.00', 0, 532),
(837, '6123456789023', 1, '675000.00', '350000.00', 0, 533),
(838, '6123456789023', 1, '675000.00', '350000.00', 0, 534),
(839, '6427894571442', 1, '39000.00', '11000.00', 0, 535),
(840, '6123456789023', 1, '675000.00', '350000.00', 0, 536),
(841, '6183450789092', 1, '610000.00', '80000.00', 0, 537),
(842, '6123456789061', 1, '675000.00', '350000.00', 0, 537),
(843, '6123456789016', 1, '1250000.00', '750000.00', 0, 537),
(844, '6427894571442', 2, '39000.00', '11000.00', 0, 538),
(845, '6427894571441', 1, '39000.00', '11000.00', 0, 538),
(847, '6123456789023', 1, '675000.00', '350000.00', 0, 539),
(848, '6183450789092', 1, '610000.00', '80000.00', 0, 540),
(849, '6123456789023', 1, '675000.00', '350000.00', 0, 541),
(850, '6123456789023', 1, '675000.00', '350000.00', 0, 542),
(851, '6123456789023', 1, '675000.00', '350000.00', 0, 543),
(852, '8886419378396', 1, '755000.00', '145000.00', 0, 544),
(853, '6123456789023', 1, '675000.00', '350000.00', 0, 545),
(854, '6123456789016', 1, '1250000.00', '750000.00', 0, 546),
(855, '6971880290123', 1, '135000.00', '5000.00', 0, 547),
(856, '6123456789023', 1, '675000.00', '350000.00', 0, 548),
(857, '6933153602125', 1, '285000.00', '15000.00', 0, 549),
(858, '6123456789023', 1, '675000.00', '350000.00', 0, 550),
(859, '6123456789023', 1, '675000.00', '350000.00', 0, 551),
(860, '6930209303746', 1, '89000.00', '100000.00', 0, 552),
(861, '6123456784547', 1, '540000.00', '100000.00', 0, 553),
(862, '6123456789016', 1, '1250000.00', '750000.00', 0, 554),
(863, '6971141390449', 1, '159000.00', '100000.00', 0, 555),
(864, '6940252365035', 1, '299000.00', '90000.00', 0, 555),
(866, '6123456789023', 1, '675000.00', '350000.00', 0, 556),
(867, '6123456789023', 1, '675000.00', '350000.00', 0, 557),
(868, '6183450789092', 1, '610000.00', '80000.00', 0, 558),
(869, '6123456789023', 1, '675000.00', '350000.00', 0, 559),
(870, '6123456789023', 1, '675000.00', '350000.00', 0, 560),
(871, '6123452789093', 1, '675000.00', '325000.00', 0, 561),
(872, '6123456789023', 1, '675000.00', '350000.00', 0, 562),
(873, '6123456789016', 1, '1250000.00', '750000.00', 0, 563),
(874, '6183450789092', 1, '610000.00', '80000.00', 0, 564),
(875, '6123456789061', 1, '675000.00', '350000.00', 0, 565),
(876, '6123456789023', 1, '675000.00', '350000.00', 0, 566),
(877, '6123456789023', 1, '675000.00', '350000.00', 0, 567),
(878, '6123456789023', 1, '675000.00', '350000.00', 0, 568),
(879, '6123456784547', 1, '540000.00', '100000.00', 0, 569),
(880, '6123456789085', 1, '540000.00', '100000.00', 0, 570),
(881, '6922456700225', 1, '289000.00', '11000.00', 0, 571),
(882, '6123456789023', 1, '675000.00', '350000.00', 0, 572),
(883, '6123456789023', 1, '675000.00', '350000.00', 0, 573),
(884, '6922456700225', 1, '289000.00', '11000.00', 0, 574),
(885, '6123456789023', 1, '675000.00', '350000.00', 0, 575),
(886, '6123456789023', 1, '675000.00', '350000.00', 0, 576),
(887, '6123456789061', 1, '675000.00', '350000.00', 0, 577),
(888, '6972661283013', 1, '259000.00', '100000.00', 0, 578),
(889, '6123456789061', 1, '675000.00', '350000.00', 0, 579),
(890, '6123456789023', 1, '675000.00', '350000.00', 0, 580),
(891, '6123456789023', 1, '675000.00', '350000.00', 0, 581),
(892, '6123456784547', 1, '540000.00', '100000.00', 0, 582),
(893, '6123456789016', 1, '1250000.00', '750000.00', 0, 583),
(894, '6427894571442', 1, '39000.00', '11000.00', 0, 584),
(895, '6427894571442', 4, '39000.00', '11000.00', 0, 585),
(896, '6427894571441', 5, '39000.00', '11000.00', 0, 585),
(898, '6123456789023', 1, '675000.00', '350000.00', 0, 586),
(899, '6123456789023', 1, '675000.00', '350000.00', 0, 587),
(900, '6123456789023', 1, '675000.00', '350000.00', 0, 588),
(901, '6123456789023', 1, '675000.00', '350000.00', 0, 589),
(902, '6123456789023', 1, '675000.00', '350000.00', 0, 590),
(903, '6123456789023', 1, '675000.00', '350000.00', 0, 591),
(904, '6123456789023', 1, '675000.00', '350000.00', 0, 592),
(905, '6123456789061', 1, '675000.00', '350000.00', 0, 593),
(906, 'POP20200430222', 1, '109000.00', '100000.00', 0, 594),
(907, '6183450789092', 1, '610000.00', '80000.00', 0, 595),
(908, '6123456789085', 1, '540000.00', '100000.00', 0, 596),
(909, '6123456789023', 1, '675000.00', '350000.00', 0, 597),
(910, '6123456784547', 1, '540000.00', '100000.00', 0, 598),
(911, '6123456789016', 1, '1250000.00', '750000.00', 0, 599),
(912, '6123456789023', 1, '675000.00', '350000.00', 0, 600),
(913, '6123456784547', 1, '540000.00', '100000.00', 0, 601),
(914, '6123456784547', 1, '540000.00', '100000.00', 0, 602),
(915, '6972579061055', 1, '129000.00', '100000.00', 0, 603),
(916, '6948391226996', 1, '259000.00', '41000.00', 0, 604),
(917, '6951613917312', 1, '299000.00', '1000.00', 0, 604),
(918, '6123456789542', 1, '89000.00', '41000.00', 0, 604),
(919, '6123456789085', 1, '540000.00', '100000.00', 0, 605),
(920, '6183450789092', 1, '610000.00', '80000.00', 0, 606),
(921, 'KH200BB', 1, '95000.00', '100000.00', 0, 607),
(922, '6931407601283', 1, '45000.00', '15000.00', 0, 607),
(924, '6123456789023', 1, '675000.00', '350000.00', 0, 608),
(925, '6427894571442', 10, '39000.00', '11000.00', 0, 609),
(926, '6427894571441', 5, '39000.00', '11000.00', 0, 609),
(928, '6972661283136', 1, '169000.00', '31000.00', 0, 610),
(929, '6123456789023', 1, '675000.00', '350000.00', 0, 611),
(930, '6123456789023', 1, '675000.00', '350000.00', 0, 612),
(931, '6427894571442', 1, '39000.00', '11000.00', 0, 613),
(932, '6427894571441', 3, '39000.00', '11000.00', 0, 613),
(934, '6123456789023', 1, '675000.00', '350000.00', 0, 614),
(935, '6123456789016', 1, '1239000.00', '761000.00', 0, 614),
(937, '6183450789092', 1, '610000.00', '80000.00', 0, 615),
(938, '6123456789023', 1, '675000.00', '350000.00', 0, 616),
(939, '6123456789023', 1, '675000.00', '350000.00', 0, 617),
(940, '6123456789023', 1, '675000.00', '350000.00', 0, 618),
(941, '6123456789023', 1, '675000.00', '350000.00', 0, 619),
(942, '6123456789023', 1, '675000.00', '350000.00', 0, 620),
(943, '6123456789023', 1, '675000.00', '350000.00', 0, 621),
(944, '6123456789061', 1, '675000.00', '350000.00', 0, 622),
(945, '6123456789016', 1, '1239000.00', '761000.00', 0, 623),
(946, '6123456784547', 1, '540000.00', '100000.00', 0, 623),
(948, '6123456789061', 1, '675000.00', '350000.00', 0, 624),
(949, '6123456784547', 1, '540000.00', '100000.00', 0, 625),
(950, '6183450789092', 1, '610000.00', '80000.00', 0, 626),
(951, '6123456789085', 1, '540000.00', '100000.00', 0, 627),
(952, '6123452789093', 1, '675000.00', '325000.00', 0, 628),
(953, '6427894571441', 3, '39000.00', '11000.00', 0, 629),
(954, '6427894571442', 6, '39000.00', '11000.00', 0, 629),
(956, '6123456789023', 1, '675000.00', '350000.00', 0, 630),
(957, '6123456789023', 1, '675000.00', '350000.00', 0, 631),
(958, '6123452789093', 1, '675000.00', '325000.00', 0, 632),
(959, '6123456789016', 1, '1239000.00', '761000.00', 0, 633),
(960, '6123456789023', 1, '675000.00', '350000.00', 0, 634),
(961, '6123456789023', 1, '675000.00', '350000.00', 0, 635),
(962, '6123456789016', 1, '1239000.00', '761000.00', 0, 636),
(963, '6123456784547', 1, '540000.00', '100000.00', 0, 637),
(964, '6920377908225', 1, '579000.00', '21000.00', 0, 638),
(965, '6972661283020', 1, '185000.00', '100000.00', 0, 638),
(966, '6956766900396', 1, '99000.00', '100000.00', 0, 638),
(967, '6927530262989', 1, '19000.00', '11000.00', 0, 639),
(968, '6123456784547', 1, '540000.00', '100000.00', 0, 640),
(969, '6123456789023', 1, '675000.00', '350000.00', 0, 641),
(970, '6123456789061', 1, '675000.00', '350000.00', 0, 641),
(972, '6123456484566', 1, '999000.00', '1000000.00', 0, 642),
(973, '6123456789023', 1, '675000.00', '350000.00', 0, 643),
(974, '6183450789092', 1, '610000.00', '80000.00', 0, 644),
(975, '6123452789093', 1, '675000.00', '325000.00', 0, 645),
(976, 'KH200BB', 1, '95000.00', '100000.00', 0, 646),
(977, '6123456789085', 1, '540000.00', '100000.00', 0, 647),
(978, '6123456789023', 1, '675000.00', '350000.00', 0, 648),
(979, '6972661281101', 1, '169000.00', '100000.00', 0, 649),
(980, '6959630211895', 1, '159000.00', '141000.00', 0, 650),
(981, '6970202291580', 1, '129000.00', '71000.00', 0, 651),
(982, '6933153602125', 1, '285000.00', '15000.00', 0, 651),
(984, '6183450789092', 1, '610000.00', '80000.00', 0, 652),
(985, '6123456789061', 1, '675000.00', '350000.00', 0, 653),
(986, '6123456789085', 1, '540000.00', '100000.00', 0, 654),
(987, '6123456789559', 1, '99000.00', '51000.00', 0, 655),
(988, '6123456789023', 1, '675000.00', '350000.00', 0, 656),
(989, '6123456789023', 1, '675000.00', '350000.00', 0, 657),
(990, '6123456789023', 1, '675000.00', '350000.00', 0, 658),
(991, '6123456789023', 1, '675000.00', '350000.00', 0, 659),
(992, '6123456784547', 1, '540000.00', '100000.00', 0, 660),
(993, '6123456789061', 1, '675000.00', '350000.00', 0, 661),
(994, '6123456789023', 1, '675000.00', '350000.00', 0, 662),
(995, '6183450789092', 1, '610000.00', '80000.00', 0, 663),
(996, '6183450789092', 1, '610000.00', '80000.00', 0, 664),
(997, '6123456789023', 1, '675000.00', '350000.00', 0, 665),
(998, '6183450789092', 1, '610000.00', '80000.00', 0, 666),
(999, '6972661283013', 1, '259000.00', '100000.00', 0, 667),
(1000, '6920201015013', 1, '179000.00', '21000.00', 0, 667),
(1002, '6123456789023', 1, '675000.00', '350000.00', 0, 668),
(1003, '6123456784547', 1, '540000.00', '100000.00', 0, 669),
(1004, '6905710316011', 1, '169000.00', '100000.00', 0, 670),
(1005, '6123452789093', 1, '675000.00', '325000.00', 0, 671),
(1006, '6972661281071', 1, '159000.00', '100000.00', 0, 672),
(1007, '6972661283082', 1, '249000.00', '100000.00', 0, 673),
(1008, '6123456789061', 1, '675000.00', '350000.00', 0, 674),
(1009, '6972661283211', 1, '179000.00', '100000.00', 0, 675),
(1010, '6123456789085', 1, '540000.00', '100000.00', 0, 676),
(1011, '6953156254862', 1, '75000.00', NULL, NULL, 680),
(1012, 'KH200BB', 1, '95000.00', NULL, NULL, 680),
(1013, '6123456789559', 1, '99000.00', NULL, NULL, 681),
(1014, '6123456789559', 1, '99000.00', NULL, NULL, 682),
(1015, '6123456789559', 1, '99000.00', NULL, NULL, 683),
(1016, '740617280012', 1, '539000.00', NULL, NULL, 684),
(1017, '6970202291589', 1, '99000.00', NULL, NULL, 685),
(1018, '6970202291580', 1, '129000.00', NULL, NULL, 685),
(1019, '6956766906718', 1, '159000.00', '141000.00', 0, 686),
(1020, '6956766919626', 1, '239000.00', '186000.00', 0, 686),
(1021, '6956766907364', 1, '179000.00', '21000.00', 0, 686),
(1022, '6956766907364', 1, '179000.00', '21000.00', 0, 686),
(1026, '6931407600620', 1, '289000.00', '131000.00', 0, 687),
(1027, '6123456784547', 1, '540000.00', '100000.00', 0, 688),
(1028, '740617268331', 1, '1090000.00', '110000.00', 0, 688),
(1030, '740617268331', 1, '1090000.00', '110000.00', 0, 689);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_shop` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `name`, `address`, `tel`, `email`, `img_path`, `img_title`, `date_shop`) VALUES
(1, 'GAME GADGET', 'ບ.ດອນນົກຂຸ້ມ ມ.ສີສັດຕະນາກ ນະຄອນຫຼວງວຽງຈັນ', '+8562054455777', 'gamegadgetlao@gmail.com', 'img_5ed3c42f2f2a4.png', 'img_5ed3c365c188d.png', '2015-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'ເຈົ້າຂອງຮ້ານ'),
(2, 'ພະນັກງານຂາຍ'),
(3, 'ປິດການໃຊ້ງານ');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sup_id` int(11) NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sup_id`, `company`, `tel`, `fax`, `address`, `email`) VALUES
(2, 'Jiro Computer', '+856 20 5232 9555', '+856 20 5464 9656', 'Lao Airlines Building 7th Floor, Manthatourath Road, Xiengyeun Village, Chantabouly District, Vientiane Capital, Lao P.D.R (Headquarter)', 'Robert@gmail.com'),
(4, 'Taobao', '0', '0', 'China', 'taobao@gmail.com'),
(5, 'Ophtus', '0', '0', 'Bangkok Thailand', '');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topic_id`, `topic_name`) VALUES
(1, 'ລິວິວ'),
(2, 'ສະຫຼຸບສິນຄ້າ'),
(3, 'ລາຍລະອຽດທົ່ວໄປ');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(1, 'ໜ່ວຍ'),
(7, 'ເສັ້ນ'),
(9, 'ກັບ'),
(10, 'ກ່ອງ'),
(11, 'ຖົງ'),
(12, 'ຊອງ'),
(13, 'ອັນ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `categorydetail`
--
ALTER TABLE `categorydetail`
  ADD PRIMARY KEY (`cated_id`),
  ADD KEY `cate_id` (`cate_id`);

--
-- Indexes for table `cover`
--
ALTER TABLE `cover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`cupon_key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`deli_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `function_product`
--
ALTER TABLE `function_product`
  ADD PRIMARY KEY (`function_id`),
  ADD KEY `func_id` (`func_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `func_pro`
--
ALTER TABLE `func_pro`
  ADD PRIMARY KEY (`func_id`);

--
-- Indexes for table `imports`
--
ALTER TABLE `imports`
  ADD PRIMARY KEY (`imp_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `listimports`
--
ALTER TABLE `listimports`
  ADD PRIMARY KEY (`imp_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `sup_id` (`sup_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `listselldetail`
--
ALTER TABLE `listselldetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `sup_id` (`sup_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cated_id` (`cated_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `productdetail`
--
ALTER TABLE `productdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`color_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `model` (`model`);

--
-- Indexes for table `product_property`
--
ALTER TABLE `product_property`
  ADD PRIMARY KEY (`ppy_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `product_special`
--
ALTER TABLE `product_special`
  ADD PRIMARY KEY (`spec_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sell_id`),
  ADD KEY `cus_id` (`cus_id`);

--
-- Indexes for table `selldetail`
--
ALTER TABLE `selldetail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `sell_id` (`sell_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sup_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `categorydetail`
--
ALTER TABLE `categorydetail`
  MODIFY `cated_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `cover`
--
ALTER TABLE `cover`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `deli_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `function_product`
--
ALTER TABLE `function_product`
  MODIFY `function_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `func_pro`
--
ALTER TABLE `func_pro`
  MODIFY `func_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `imports`
--
ALTER TABLE `imports`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `listimports`
--
ALTER TABLE `listimports`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `listselldetail`
--
ALTER TABLE `listselldetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=991;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `productdetail`
--
ALTER TABLE `productdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_property`
--
ALTER TABLE `product_property`
  MODIFY `ppy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_special`
--
ALTER TABLE `product_special`
  MODIFY `spec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `selldetail`
--
ALTER TABLE `selldetail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1031;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorydetail`
--
ALTER TABLE `categorydetail`
  ADD CONSTRAINT `categorydetail_ibfk_1` FOREIGN KEY (`cate_id`) REFERENCES `category` (`cate_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `function_product`
--
ALTER TABLE `function_product`
  ADD CONSTRAINT `function_product_ibfk_1` FOREIGN KEY (`func_id`) REFERENCES `func_pro` (`func_id`),
  ADD CONSTRAINT `function_product_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `imports`
--
ALTER TABLE `imports`
  ADD CONSTRAINT `imports_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `imports_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`),
  ADD CONSTRAINT `imports_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `imports_ibfk_4` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `listimports`
--
ALTER TABLE `listimports`
  ADD CONSTRAINT `listimports_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `listimports_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`),
  ADD CONSTRAINT `listimports_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `listimports_ibfk_4` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `listorderdetail`
--
ALTER TABLE `listorderdetail`
  ADD CONSTRAINT `listorderdetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `listorderdetail_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `listselldetail`
--
ALTER TABLE `listselldetail`
  ADD CONSTRAINT `listselldetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `listselldetail_ibfk_2` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `listselldetail2`
--
ALTER TABLE `listselldetail2`
  ADD CONSTRAINT `listselldetail2_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `listselldetail2_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`);

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`sup_id`) REFERENCES `suppliers` (`sup_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`cated_id`) REFERENCES `categorydetail` (`cated_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`);

--
-- Constraints for table `productdetail`
--
ALTER TABLE `productdetail`
  ADD CONSTRAINT `productdetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `productdetail_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`topic_id`);

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `product_model`
--
ALTER TABLE `product_model`
  ADD CONSTRAINT `product_model_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `product_model_ibfk_2` FOREIGN KEY (`model`) REFERENCES `model` (`model`);

--
-- Constraints for table `product_property`
--
ALTER TABLE `product_property`
  ADD CONSTRAINT `product_property_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `product_special`
--
ALTER TABLE `product_special`
  ADD CONSTRAINT `product_special_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);

--
-- Constraints for table `selldetail`
--
ALTER TABLE `selldetail`
  ADD CONSTRAINT `selldetail_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `selldetail_ibfk_2` FOREIGN KEY (`sell_id`) REFERENCES `sell` (`sell_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
