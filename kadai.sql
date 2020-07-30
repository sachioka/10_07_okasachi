-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 7 月 30 日 16:12
-- サーバのバージョン： 10.4.13-MariaDB
-- PHP のバージョン: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `kadai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `registration list`
--

CREATE TABLE `registration list` (
  `id` int(11) NOT NULL,
  `stockcode` varchar(4) NOT NULL,
  `stockname` varchar(20) NOT NULL,
  `csv_file` varchar(128) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `registration list`
--

INSERT INTO `registration list` (`id`, `stockcode`, `stockname`, `csv_file`, `created_at`) VALUES
(1, '1301', '1301', 'upload/20200730115012d41d8cd98f00b204e9800998ecf8427e.csv', '2020-07-30 09:50:12'),
(2, '1301', '1301', 'upload/20200730145648d41d8cd98f00b204e9800998ecf8427e.csv', '2020-07-30 12:56:49'),
(3, '1301', '1301', 'upload/20200730155509d41d8cd98f00b204e9800998ecf8427e.csv', '2020-07-30 13:55:09'),
(4, '1301', '1301', 'upload/20200730155700d41d8cd98f00b204e9800998ecf8427e.csv', '2020-07-30 13:57:00'),
(5, '1301', '1301', 'upload/20200730155714d41d8cd98f00b204e9800998ecf8427e.csv', '2020-07-30 13:57:14');

-- --------------------------------------------------------

--
-- テーブルの構造 `sakata`
--

CREATE TABLE `sakata` (
  `id` int(11) NOT NULL,
  `formula1` varchar(128) NOT NULL,
  `formula2` varchar(128) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `registration list`
--
ALTER TABLE `registration list`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `sakata`
--
ALTER TABLE `sakata`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `registration list`
--
ALTER TABLE `registration list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルのAUTO_INCREMENT `sakata`
--
ALTER TABLE `sakata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
