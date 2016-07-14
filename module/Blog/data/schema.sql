CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

REPLACE INTO `posts` (`id`, `title`, `text`) VALUES
	(1, 'Blog #1', 'Welcome to my first blog post'),
	(2, 'Blog #2', 'Welcome to my second blog post'),
	(3, 'Blog #3', 'Welcome to my third blog post'),
	(4, 'Blog #4', 'Welcome to my fourth blog post'),
	(5, 'Blog #5', 'Welcome to my fifth blog post'),

