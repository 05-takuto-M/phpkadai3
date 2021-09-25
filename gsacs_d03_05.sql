-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2021 年 9 月 25 日 04:56
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacs_d03_05`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `product_images_table`
--

CREATE TABLE `product_images_table` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_content` mediumblob NOT NULL,
  `image_size` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `product_todo_table`
--

CREATE TABLE `product_todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `product_todo_table`
--

INSERT INTO `product_todo_table` (`id`, `todo`, `reason`, `deadline`, `created_at`, `updated_at`) VALUES
(12, 'プロダクトの骨子を作る', 'そもそもよ', '2021-09-30', '2021-09-25 11:25:22', '2021-09-25 11:25:22');

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `created_at`, `updated_at`) VALUES
(1, 'SQL練習', '2021-09-18', '2021-09-18 21:00:47', '2021-09-18 21:00:47'),
(2, 'JS復習', '2021-09-24', '2021-09-18 21:07:24', '2021-09-18 21:07:24'),
(3, 'PHP課題', '2021-09-11', '2021-09-18 21:08:50', '2021-09-18 21:08:50'),
(4, 'html作成', '2021-07-11', '2021-09-18 21:12:39', '2021-09-18 21:12:39'),
(5, 'css作成', '2021-07-18', '2021-09-18 21:13:04', '2021-09-18 21:13:04'),
(6, 'json怖い', '2021-07-25', '2021-09-18 21:13:52', '2021-09-18 21:13:52'),
(7, '朝起きる', '2021-07-19', '2021-09-18 21:16:10', '2021-09-18 21:16:10'),
(8, '朝ごはん食べる', '2021-07-20', '2021-09-18 21:16:41', '2021-09-18 21:16:41'),
(9, '出勤する', '2021-07-21', '2021-09-18 21:17:04', '2021-09-18 21:17:04'),
(10, 'タイムカード押す', '2021-07-22', '2021-09-18 21:17:38', '2021-09-18 21:17:38'),
(11, '大山様', '2021-09-25', '2021-09-18 23:13:05', '2021-09-18 23:13:05'),
(12, '岩崎様商談', '2021-09-24', '2021-09-18 23:13:58', '2021-09-18 23:13:58'),
(13, '井出様', '2021-09-30', '2021-09-18 23:14:32', '2021-09-18 23:14:32'),
(14, '井出様　契約', '2021-09-30', '2021-09-18 23:25:40', '2021-09-18 23:25:40'),
(15, '井出様　契約', '2021-09-30', '2021-09-18 23:27:25', '2021-09-18 23:27:25'),
(16, 'テスト', '2021-09-26', '2021-09-18 23:32:49', '2021-09-18 23:32:49'),
(17, 'テストpost', '2021-09-16', '2021-09-18 23:53:23', '2021-09-18 23:53:23'),
(18, 'できたかな？', '2021-09-17', '2021-09-18 23:57:03', '2021-09-18 23:57:03'),
(19, '見た目わからん', '2021-09-23', '2021-09-18 23:58:05', '2021-09-18 23:58:05'),
(20, '日付並び替え', '2021-09-01', '2021-09-19 00:03:33', '2021-09-19 00:03:33'),
(21, '今月契約', '2021-09-01', '2021-09-19 00:06:03', '2021-09-19 00:06:03'),
(22, '井出様', '2021-09-30', '2021-09-19 00:10:48', '2021-09-19 00:10:48');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `product_images_table`
--
ALTER TABLE `product_images_table`
  ADD PRIMARY KEY (`image_id`);

--
-- テーブルのインデックス `product_todo_table`
--
ALTER TABLE `product_todo_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`todo`,`reason`,`deadline`,`created_at`,`updated_at`);

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `product_images_table`
--
ALTER TABLE `product_images_table`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `product_todo_table`
--
ALTER TABLE `product_todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
