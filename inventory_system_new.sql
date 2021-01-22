-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-28 10:18:30
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `inventory_system`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `m_ID` varchar(20) NOT NULL,
  `m_account` varchar(50) NOT NULL,
  `m_password` varchar(50) NOT NULL,
  `m_name` varchar(20) NOT NULL,
  `m_tel` varchar(20) NOT NULL,
  `m_address` varchar(50) NOT NULL,
  `join_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`m_ID`, `m_account`, `m_password`, `m_name`, `m_tel`, `m_address`, `join_date`) VALUES
('001', 'A001', 'A001', '阿村', '0978341112', '彰化縣社頭鄉成功十六街三段164巷420號', '2020-12-14'),
('002', 'A002', 'A002', '王柏波', '0937284153', '台北市士林區中山北路6段77號', '2020-12-14'),
('003', 'A003', 'A003', '陳冠廷', '0937229102', '台南市仁德區文華路二段66號', '2020-12-14'),
('004', 'A004', 'A004', '張盛經', '0937261123', '台南市北區海安路三段533號', '2020-12-14'),
('005', 'A005', 'A005', '陳伯夷', '0936252161', '花蓮縣新城鄉中興路134號', '2020-12-14'),
('006', 'A006', 'A006', '吳為政', '0946201846', '苗栗縣卓蘭鎮號', '2020-12-14'),
('007', 'A007', 'A007', '陳輝聽', '0944635281', '台中市西區五權五街138號', '2020-12-14'),
('008', 'A008', 'A008', '王政', '0973625183', '台北市士林區中山北路五段461巷21號', '2020-12-14'),
('009', 'A009', 'A009', '彭例', '0944639271', '花蓮縣秀林鄉榕樹1鄰2號', '2020-12-14'),
('010', 'A010', 'A010', '張大', '0937281919', '花蓮縣瑞穗鄉廣東路161號', '2020-12-14');

--
-- 觸發器 `member`
--
DELIMITER $$
CREATE TRIGGER `tg_member_insert` BEFORE INSERT ON `member` FOR EACH ROW BEGIN
  INSERT INTO member_seq VALUES (NULL);
  SET NEW.m_id = CONCAT(LPAD(LAST_INSERT_ID(), 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `member_seq`
--

CREATE TABLE `member_seq` (
  `id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `member_seq`
--

INSERT INTO `member_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- 資料表結構 `order_seq`
--

CREATE TABLE `order_seq` (
  `id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `order_seq`
--

INSERT INTO `order_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(13),
(14),
(15),
(16),
(17),
(18),
(19);

-- --------------------------------------------------------

--
-- 資料表結構 `purchase`
--

CREATE TABLE `purchase` (
  `tea_type` varchar(20) NOT NULL,
  `tea_num` int(8) NOT NULL,
  `unit_price` int(20) NOT NULL,
  `tea_price` int(20) NOT NULL,
  `tea_date` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `purchase_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `purchase`
--

INSERT INTO `purchase` (`tea_type`, `tea_num`, `unit_price`, `tea_price`, `tea_date`, `location`, `purchase_id`) VALUES
('古早味紅茶', 50, 220, 11000, '2020-12-14', '台灣', 'P01'),
('古早味綠茶', 40, 220, 4800, '2020-12-14', '台灣', 'P02'),
('台灣茶', 20, 220, 2400, '2020-12-14', '台灣', 'P03'),
('烏龍茶', 40, 220, 4800, '2020-12-14', '台灣', 'P04'),
('紅茶', 40, 220, 4800, '2020-12-14', '台灣', 'P05'),
('綠茶', 40, 220, 4800, '2020-12-14', '台灣', 'P06'),
('青茶', 40, 220, 4800, '2020-12-14', '台灣', 'P07'),
('高山茶', 20, 220, 2400, '2020-12-14', '台灣', 'P08'),
('紅茶', 20, 220, 2400, '2020-12-22', 'Taiwan', 'P14');

--
-- 觸發器 `purchase`
--
DELIMITER $$
CREATE TRIGGER `tg_purchase_insert` BEFORE INSERT ON `purchase` FOR EACH ROW BEGIN
  INSERT INTO purchase_seq VALUES (NULL);
  SET NEW.purchase_id = CONCAT('P', LPAD(LAST_INSERT_ID(), 2, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `purchase_seq`
--

CREATE TABLE `purchase_seq` (
  `id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `purchase_seq`
--

INSERT INTO `purchase_seq` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(13),
(14);

-- --------------------------------------------------------

--
-- 資料表結構 `tea_inventory`
--

CREATE TABLE `tea_inventory` (
  `tea_type` varchar(20) NOT NULL,
  `tea_ID` varchar(8) NOT NULL,
  `stock_price` int(20) NOT NULL,
  `inventory_qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `tea_inventory`
--

INSERT INTO `tea_inventory` (`tea_type`, `tea_ID`, `stock_price`, `inventory_qty`) VALUES
('古早味紅茶', '02R', 240, 25),
('古早味綠茶', '02G', 240, 40),
('台灣茶', '06TW', 240, 20),
('烏龍茶', '04O', 240, 15),
('紅茶', '01R', 240, 30),
('綠茶', '01G', 240, 20),
('青茶', '03T', 240, 20),
('高山茶', '05M', 240, 10);

-- --------------------------------------------------------

--
-- 資料表結構 `tea_order`
--

CREATE TABLE `tea_order` (
  `tea_type` varchar(20) NOT NULL,
  `tea_num` int(8) NOT NULL,
  `unit_price` int(20) NOT NULL,
  `tea_price` int(20) NOT NULL,
  `tea_date` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `m_ID` varchar(20) NOT NULL,
  `order_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `tea_order`
--

INSERT INTO `tea_order` (`tea_type`, `tea_num`, `unit_price`, `tea_price`, `tea_date`, `location`, `m_ID`, `order_ID`) VALUES
('烏龍茶', 30, 240, 7200, '2020-12-14', '台灣', '003', 'S04'),
('紅茶', 20, 240, 4800, '2020-12-14', '台灣', '001', 'S05'),
('綠茶', 20, 240, 4800, '2020-12-14', '台灣', '002', 'S06'),
('青茶', 20, 240, 4800, '2020-12-14', '台灣', '005', 'S07'),
('高山茶', 10, 240, 2400, '2020-12-14', '台灣', '001', 'S08'),
('古早味紅茶', 20, 240, 4800, '2020-12-14', '台灣', '001', 'S13'),
('綠茶', 40, 240, 4800, '2020-12-15', '台灣', '001', 'S14'),
('紅茶', 50, 240, 4800, '2020-12-14', '台灣', '002', 'S15'),
('紅茶', 40, 240, 4800, '2020-12-14', '台灣', '004', 'S16'),
('綠茶', 20, 240, 2400, '2020-12-22', '彰化縣社頭鄉成功十六街三段164巷420', '001', 'S17'),
('古早味紅茶', 10, 240, 1200, '2020-12-22', '花蓮縣瑞穗鄉廣東路161號', '010', 'S18'),
('古早味紅茶', 10, 240, 1200, '2020-12-22', '台北市士林區中山北路五段461巷21號', '008', 'S19');

--
-- 觸發器 `tea_order`
--
DELIMITER $$
CREATE TRIGGER `tg_order_insert` BEFORE INSERT ON `tea_order` FOR EACH ROW BEGIN
  INSERT INTO order_seq VALUES (NULL);
  SET NEW.order_ID = CONCAT('S', LPAD(LAST_INSERT_ID(), 2, '0'));
END
$$
DELIMITER ;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`m_ID`);

--
-- 資料表索引 `member_seq`
--
ALTER TABLE `member_seq`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `order_seq`
--
ALTER TABLE `order_seq`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- 資料表索引 `purchase_seq`
--
ALTER TABLE `purchase_seq`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `tea_inventory`
--
ALTER TABLE `tea_inventory`
  ADD PRIMARY KEY (`tea_type`,`tea_ID`);

--
-- 資料表索引 `tea_order`
--
ALTER TABLE `tea_order`
  ADD PRIMARY KEY (`order_ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_seq`
--
ALTER TABLE `member_seq`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_seq`
--
ALTER TABLE `order_seq`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase_seq`
--
ALTER TABLE `purchase_seq`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
