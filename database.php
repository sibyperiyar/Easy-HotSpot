<?php
$stmt = $DB_con->prepare("SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO'");
$stmt->execute(array());

$stmt = $DB_con->prepare("SET time_zone = '+05:30'");
$stmt->execute(array());

$stmt = $DB_con->prepare("CREATE TABLE IF NOT EXISTS `hotspot_users` (
  `user_id` int(11) NOT NULL,
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
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");
$stmt->execute(array());

$stmt = $DB_con->prepare("ALTER TABLE `hotspot_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `username` (`username`)");
$stmt->execute(array());

$stmt = $DB_con->prepare("ALTER TABLE `hotspot_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1");
$stmt->execute(array());

$stmt = $DB_con->prepare("CREATE TABLE IF NOT EXISTS `hotspot_vouchers` (
  `id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `creator` int(3) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `printed_times` int(3) DEFAULT NULL,
  `printed_last` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `group_of` int(4) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `limit_uptime` varchar(30) DEFAULT NULL,
  `limit_bytes` varchar(30) DEFAULT NULL,
  `profile` varchar(30) DEFAULT NULL,
  `uid` VARCHAR(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8");
$stmt->execute(array());

$stmt = $DB_con->prepare("ALTER TABLE `hotspot_vouchers`
  ADD PRIMARY KEY (`id`)");
$stmt->execute(array());

$stmt = $DB_con->prepare("ALTER TABLE `hotspot_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");
$stmt->execute(array());
?>