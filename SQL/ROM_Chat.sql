-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: fdb20.awardspace.net
-- Üretim Zamanı: 11 Haz 2020, 16:07:18
-- Sunucu sürümü: 5.7.20-log
-- PHP Sürümü: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `3305687_rom`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comm`
--

CREATE TABLE `comm` (
  `id` int(11) NOT NULL,
  `mesaj_id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `serh` varchar(300) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `mesaj` text NOT NULL,
  `alan_id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `vaxt` varchar(50) NOT NULL,
  `oxundu` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `id` int(11) NOT NULL,
  `nik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `vaxt` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `o_sms`
--

CREATE TABLE `o_sms` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `time` varchar(30) NOT NULL,
  `k_limit` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `smslike`
--

CREATE TABLE `smslike` (
  `id` int(11) NOT NULL,
  `smsid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nik` varchar(200) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `user` text NOT NULL,
  `ad` varchar(20) DEFAULT NULL,
  `dtarix` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `reg_date` varchar(50) NOT NULL,
  `acar` varchar(100) DEFAULT NULL,
  `on` int(11) NOT NULL,
  `ip` text NOT NULL,
  `soft` text NOT NULL,
  `img` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `viewanket`
--

CREATE TABLE `viewanket` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `kim` varchar(100) NOT NULL,
  `kimid` int(11) NOT NULL,
  `tarix` int(11) NOT NULL,
  `view` int(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `comm`
--
ALTER TABLE `comm`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `o_sms`
--
ALTER TABLE `o_sms`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Tablo için indeksler `smslike`
--
ALTER TABLE `smslike`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `viewanket`
--
ALTER TABLE `viewanket`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `comm`
--
ALTER TABLE `comm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- Tablo için AUTO_INCREMENT değeri `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1580;
--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1045;
--
-- Tablo için AUTO_INCREMENT değeri `o_sms`
--
ALTER TABLE `o_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Tablo için AUTO_INCREMENT değeri `smslike`
--
ALTER TABLE `smslike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- Tablo için AUTO_INCREMENT değeri `viewanket`
--
ALTER TABLE `viewanket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
