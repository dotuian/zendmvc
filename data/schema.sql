-- --------------------------------------------------------
-- ホスト:                          127.0.0.1
-- サーバのバージョン:                    10.1.9-MariaDB - mariadb.org binary distribution
-- サーバー OS:                      Win64
-- HeidiSQL バージョン:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for zend
CREATE DATABASE IF NOT EXISTS `zend` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zend`;


-- Dumping structure for テーブル zend.album
CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table zend.album: ~5 rows (approximately)
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
REPLACE INTO `album` (`id`, `artist`, `title`) VALUES
	(1, 'The  Military  Wives', 'In  My  Dreams 222'),
	(2, 'Adele', '21'),
	(3, 'Bruce  Springsteen', 'Wrecking Ball (Deluxe)'),
	(4, 'Lana  Del  Rey', 'Born  To  Die'),
	(5, 'Gotye', 'Making  Mirrors');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;


-- Dumping structure for テーブル zend.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Dumping data for table zend.news: ~5 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
REPLACE INTO `news` (`id`, `title`, `content`) VALUES
	(1, 'First news', 'This is the first news'),
	(2, 'Second news', 'This is the second news'),
	(3, 'Third news', 'This is the third news'),
	(4, 'fourth news', 'This is the fourth news'),
	(5, 'Fifth news', 'This is the fifth news');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for テーブル zend.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table zend.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'test1234'),
	(2, 'shou', 'shouadmin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
