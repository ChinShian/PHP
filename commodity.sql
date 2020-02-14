-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `commodity`
--

-- --------------------------------------------------------

--
-- 資料表結構 `categoryies`
--

CREATE TABLE `categoryies` (
  `categoryId` int(11) NOT NULL COMMENT '流水號',
  `categoryName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別名稱',
  `categoryParentId` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '上層編號',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `categoryies`
--

INSERT INTO `categoryies` (`categoryId`, `categoryName`, `categoryParentId`, `created_at`, `updated_at`) VALUES
(33, '智慧手錶', '智慧手錶', '2020-01-18 21:04:04', '2020-01-18 21:04:04'),
(34, '藍芽耳機', '藍芽耳機', '2020-01-18 21:04:04', '2020-01-18 21:04:04'),
(35, '錄影器材', '錄影器材', '2020-01-18 21:04:04', '2020-01-18 21:04:04'),
(36, '其他', '其他', '2020-01-18 21:04:04', '2020-01-18 21:04:04');

-- --------------------------------------------------------

--
-- 資料表結構 `items`
--

CREATE TABLE `items` (
  `itemId` int(11) NOT NULL COMMENT '商品編號',
  `itemName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `itemImg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品照片',
  `itemDescription` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `itemPrice` int(11) NOT NULL COMMENT '商品價格',
  `itemQty` tinyint(4) NOT NULL COMMENT '商品數量',
  `itemCategoryId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品類別',
  `itemColor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品顏色',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `itemImg`, `itemDescription`, `itemPrice`, `itemQty`, `itemCategoryId`, `itemColor`, `created_at`, `updated_at`) VALUES
(188, '123123', 'jq範例1.jpg', '123', 30000, 10, '智慧手錶', '黑', '2020-01-31 23:35:58', '2020-01-31 23:35:58');

-- --------------------------------------------------------

--
-- 資料表結構 `multiple_images`
--

CREATE TABLE `multiple_images` (
  `multipleImageId` int(11) NOT NULL COMMENT '流水號',
  `multipleImageImg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '圖片名稱',
  `itemId` int(11) NOT NULL COMMENT '商品編號',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間	',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `multiple_images`
--

INSERT INTO `multiple_images` (`multipleImageId`, `multipleImageImg`, `itemId`, `created_at`, `updated_at`) VALUES
(167, 'jq範例2.jpg', 188, '2020-01-31 23:35:58', '2020-01-31 23:35:58'),
(168, 'jq範例3.jpg', 188, '2020-01-31 23:35:58', '2020-01-31 23:35:58'),
(169, 'jq範例4.jpg', 188, '2020-01-31 23:35:58', '2020-01-31 23:35:58');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `categoryies`
--
ALTER TABLE `categoryies`
  ADD PRIMARY KEY (`categoryId`);

--
-- 資料表索引 `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);

--
-- 資料表索引 `multiple_images`
--
ALTER TABLE `multiple_images`
  ADD PRIMARY KEY (`multipleImageId`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `categoryies`
--
ALTER TABLE `categoryies`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=37;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品編號', AUTO_INCREMENT=189;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `multiple_images`
--
ALTER TABLE `multiple_images`
  MODIFY `multipleImageId` int(11) NOT NULL AUTO_INCREMENT COMMENT '流水號', AUTO_INCREMENT=170;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
