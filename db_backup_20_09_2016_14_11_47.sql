-- TABLE: hotspot_customers
CREATE TABLE `hotspot_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(30) NOT NULL,
  `company` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `validity` varchar(10) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `valid_till` datetime DEFAULT NULL,
  `pub_key` varchar(30) NOT NULL,
  `priv_key` varchar(30) NOT NULL,
  `hits` int(11) DEFAULT '0',
  `error_hit` int(11) DEFAULT '0',
  `comment` varchar(50) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `mac_id` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
INSERT INTO `hotspot_customers` (`id`, `customer_id`, `company`, `address`, `telephone`, `mobile`, `email`, `state`, `country`, `validity`, `created_on`, `valid_till`, `pub_key`, `priv_key`, `hits`, `error_hit`, `comment`, `ip`, `mac_id`, `status`) VALUES ('1', 'jaison123', 'Inspire Digital Solutions', 'Karippayil Building, NH 183, Kumily - 685 509', 'telephone', 'mobile', 'mail@zetone.com', 'Tamilnadu', 'Pakistan', '1 Month', '2016-09-16 00:00:00', '2016-10-20 00:00:00', 'J3NZY-L9NAW-52MY2-I5P9H-L2U3L', 'WKTQN-P359T-NP7EO-DXXY2-S3ZMD', '7', '4', '00-16-EA-7C-10-38', '', '00-16-EA-7C-10-38', 'Active');
INSERT INTO `hotspot_customers` (`id`, `customer_id`, `company`, `address`, `telephone`, `mobile`, `email`, `state`, `country`, `validity`, `created_on`, `valid_till`, `pub_key`, `priv_key`, `hits`, `error_hit`, `comment`, `ip`, `mac_id`, `status`) VALUES ('2', 'Jinu Devasia', 'Zetozone Technologies', 'Karippayil Building, NH 183, Kumily - 685 509', '9961144235', '9656224691', 'jinu@live.in', 'Kerala', 'India', 'Lifetime', '2016-09-20 00:00:00', '2019-06-16 00:00:00', 'JF94O-YBA7B-ZSHHF-KFABI-JUWP2', 'UUY5G-QZB7L-59HDW-SSE9L-TFIJF', '0', '0', '', '', '18:10:18', 'Deleted');

-- TABLE: hotspot_users
CREATE TABLE `hotspot_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `date_added` date NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '3',
  `user_group` int(1) NOT NULL,
  `image_path` varchar(50) NOT NULL,
  `thumb_path` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
INSERT INTO `hotspot_users` (`user_id`, `email`, `date_added`, `firstname`, `lastname`, `password`, `created_at`, `username`, `user_level`, `user_group`, `image_path`, `thumb_path`, `status`) VALUES ('1', '', '2016-09-20', 'Administrator', '', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2016-09-20 11:49:31', 'admin', '1', '1', '', '', 'Active');
INSERT INTO `hotspot_users` (`user_id`, `email`, `date_added`, `firstname`, `lastname`, `password`, `created_at`, `username`, `user_level`, `user_group`, `image_path`, `thumb_path`, `status`) VALUES ('3', '', '2016-09-20', 'Head User', 'Master', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0000-00-00 00:00:00', 'admin2', '3', '0', '', '', 'Active');