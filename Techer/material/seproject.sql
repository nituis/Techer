-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2015 年 11 月 13 日 02:17
-- 伺服器版本: 10.0.17-MariaDB
-- PHP 版本： 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `seproject`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `comment`
--

INSERT INTO `comment` (`name`, `email`, `comment`) VALUES
('gh', 'dc', 'dc'),
('Sam HO', 'SAMHO@GAMAIL.COM', 'HI');

-- --------------------------------------------------------

--
-- 資料表結構 `techer_users`
--

CREATE TABLE `techer_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` char(40) CHARACTER SET utf8 NOT NULL,
  `user_type` varchar(3) NOT NULL,
  `user_gender` varchar(2) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_phone` varchar(16) NOT NULL,
  `user_educationBackground` varchar(20) NOT NULL,
  `registrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `techer_users`
--

INSERT INTO `techer_users` (`user_id`, `user_name`, `user_password`, `user_type`, `user_gender`, `user_email`, `user_phone`, `user_educationBackground`, `registrationDate`) VALUES
(5, 'boscodai', '09d33c9c909f0b1170fb74e4fbc09d0d10c1b50c', 's', '', '', '', '', '2015-11-12 18:12:06'),
(6, 'boyu', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 't', '', '', '', '', '2015-11-12 18:12:06'),
(7, 'samsam', '7c4a8d09ca3762af61e59520943dc26494f8941b', 's', '', '', '', '', '2015-11-12 18:12:06');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `techer_users`
--
ALTER TABLE `techer_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phpro_username` (`user_name`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `techer_users`
--
ALTER TABLE `techer_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
