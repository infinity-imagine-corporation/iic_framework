-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.57-community - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-07-01 05:29:25
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for pbmaths
DROP DATABASE IF EXISTS `pbmaths`;
CREATE DATABASE IF NOT EXISTS `pbmaths` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `pbmaths`;


-- Dumping structure for table pbmaths.backoffice_log
DROP TABLE IF EXISTS `backoffice_log`;
CREATE TABLE IF NOT EXISTS `backoffice_log` (
  `id_user` int(10) unsigned NOT NULL,
  `id_action` int(10) unsigned NOT NULL,
  `id_module` int(10) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note` text COLLATE utf8_unicode_ci,
  KEY `FK_backoffice_user_log_backoffice_user` (`id_user`),
  KEY `FK_backoffice_user_log_backoffice_module` (`id_module`),
  KEY `FK_backoffice_user_log_backoffice_user_action` (`id_action`),
  KEY `date` (`date`),
  CONSTRAINT `FK_backoffice_user_log_backoffice_module` FOREIGN KEY (`id_module`) REFERENCES `backoffice_module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_user` FOREIGN KEY (`id_user`) REFERENCES `backoffice_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_user_action` FOREIGN KEY (`id_action`) REFERENCES `backoffice_user_action` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_log: ~0 rows (approximately)
DELETE FROM `backoffice_log`;
/*!40000 ALTER TABLE `backoffice_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_log` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_module
DROP TABLE IF EXISTS `backoffice_module`;
CREATE TABLE IF NOT EXISTS `backoffice_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_enable` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 = disable, 1 = enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_module: ~6 rows (approximately)
DELETE FROM `backoffice_module`;
/*!40000 ALTER TABLE `backoffice_module` DISABLE KEYS */;
INSERT INTO `backoffice_module` (`id`, `name`, `description`, `uri`, `is_enable`) VALUES
	(1, 'Theme', NULL, NULL, 0),
	(2, 'User Group', NULL, NULL, 0),
	(3, 'User Role', NULL, NULL, 0),
	(4, 'User', NULL, NULL, 0),
	(5, 'User Permission', NULL, NULL, 0),
	(6, 'รายการวัสดุตัวอย่าง', NULL, NULL, 0);
/*!40000 ALTER TABLE `backoffice_module` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_module_permission
DROP TABLE IF EXISTS `backoffice_module_permission`;
CREATE TABLE IF NOT EXISTS `backoffice_module_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL DEFAULT '0',
  `id_group` int(10) unsigned NOT NULL DEFAULT '0',
  `id_role` int(10) unsigned NOT NULL DEFAULT '0',
  `id_action` int(10) unsigned NOT NULL DEFAULT '0',
  `id_module` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_group` (`id_group`),
  KEY `id_role` (`id_role`),
  KEY `id_action` (`id_action`),
  KEY `id_module` (`id_module`),
  CONSTRAINT `FK_backoffice_module_permission_backoffice_module` FOREIGN KEY (`id_module`) REFERENCES `backoffice_module` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_module_permission_backoffice_user` FOREIGN KEY (`id_user`) REFERENCES `backoffice_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_module_permission_backoffice_user_action` FOREIGN KEY (`id_action`) REFERENCES `backoffice_user_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_module_permission_backoffice_user_group` FOREIGN KEY (`id_group`) REFERENCES `backoffice_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_module_permission_backoffice_user_role` FOREIGN KEY (`id_role`) REFERENCES `backoffice_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_module_permission: ~0 rows (approximately)
DELETE FROM `backoffice_module_permission`;
/*!40000 ALTER TABLE `backoffice_module_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_module_permission` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_theme
DROP TABLE IF EXISTS `backoffice_theme`;
CREATE TABLE IF NOT EXISTS `backoffice_theme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `header_bg_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_text_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_text_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_text_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header_text_size` tinyint(2) unsigned DEFAULT NULL,
  `footer_bg_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_text_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foot_text_size` tinyint(2) unsigned DEFAULT NULL,
  `table_head_bg_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_head_bg_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_head_rollover_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_head_text_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_head_text_size` tinyint(2) unsigned DEFAULT NULL,
  `table_line_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_row_bg_color_1` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_row_bg_color_2` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_row_rollover_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_row_selected_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_text_color` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_text_size` tinyint(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_theme: ~1 rows (approximately)
DELETE FROM `backoffice_theme`;
/*!40000 ALTER TABLE `backoffice_theme` DISABLE KEYS */;
INSERT INTO `backoffice_theme` (`id`, `name`, `header_bg_color`, `header_bg_image`, `header_text_1`, `header_text_2`, `header_text_color`, `header_text_size`, `footer_bg_color`, `footer_bg_image`, `footer_text`, `footer_text_color`, `foot_text_size`, `table_head_bg_color`, `table_head_bg_image`, `table_head_rollover_color`, `table_head_text_color`, `table_head_text_size`, `table_line_color`, `table_row_bg_color_1`, `table_row_bg_color_2`, `table_row_rollover_color`, `table_row_selected_color`, `table_text_color`, `table_text_size`) VALUES
	(1, 'IIC Framework', '#444444', NULL, 'ระบบบริหารสถาบันกวดวิชา', 'High-Speed Maths. Center', '#FFFFFF', 24, NULL, NULL, 'All support and powered by Solution Dee Co., Ltd.', '#669900', 10, '#669900', NULL, '#36AAFF', '#FFFFFF', 12, '#AAAAAA', '#FFFFFF', '#F0F0F0', '#E4EEFF', '#E4EEFF', '#666666', 12);
/*!40000 ALTER TABLE `backoffice_theme` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_user
DROP TABLE IF EXISTS `backoffice_user`;
CREATE TABLE IF NOT EXISTS `backoffice_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(10) unsigned NOT NULL,
  `id_group` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_backoffice_user_backoffice_user_role` (`id_role`),
  KEY `FK_backoffice_user_backoffice_user_group` (`id_group`),
  CONSTRAINT `FK_backoffice_user_backoffice_user_group` FOREIGN KEY (`id_group`) REFERENCES `backoffice_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_user_backoffice_user_role` FOREIGN KEY (`id_role`) REFERENCES `backoffice_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_user: ~3 rows (approximately)
DELETE FROM `backoffice_user`;
/*!40000 ALTER TABLE `backoffice_user` DISABLE KEYS */;
INSERT INTO `backoffice_user` (`id`, `id_role`, `id_group`, `name`, `username`, `password`) VALUES
	(1, 1, 20, 'Administrator', 'admin', 'admin'),
	(2, 2, 20, 'บงการ ขั้นเทพ', 'manager', 'manager'),
	(3, 3, 20, 'เพ้อเจ้อ ขยันเขียน', 'editor', 'editor');
/*!40000 ALTER TABLE `backoffice_user` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_user_action
DROP TABLE IF EXISTS `backoffice_user_action`;
CREATE TABLE IF NOT EXISTS `backoffice_user_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_user_action: ~6 rows (approximately)
DELETE FROM `backoffice_user_action`;
/*!40000 ALTER TABLE `backoffice_user_action` DISABLE KEYS */;
INSERT INTO `backoffice_user_action` (`id`, `name`) VALUES
	(1, 'Create'),
	(2, 'Read'),
	(3, 'Update'),
	(4, 'Delete'),
	(5, 'Login'),
	(6, 'Logout');
/*!40000 ALTER TABLE `backoffice_user_action` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_user_group
DROP TABLE IF EXISTS `backoffice_user_group`;
CREATE TABLE IF NOT EXISTS `backoffice_user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_user_group: ~3 rows (approximately)
DELETE FROM `backoffice_user_group`;
/*!40000 ALTER TABLE `backoffice_user_group` DISABLE KEYS */;
INSERT INTO `backoffice_user_group` (`id`, `name`) VALUES
	(20, 'Headquarter'),
	(27, 'Thailand Branch'),
	(28, 'China Branch');
/*!40000 ALTER TABLE `backoffice_user_group` ENABLE KEYS */;


-- Dumping structure for table pbmaths.backoffice_user_role
DROP TABLE IF EXISTS `backoffice_user_role`;
CREATE TABLE IF NOT EXISTS `backoffice_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table pbmaths.backoffice_user_role: ~4 rows (approximately)
DELETE FROM `backoffice_user_role`;
/*!40000 ALTER TABLE `backoffice_user_role` DISABLE KEYS */;
INSERT INTO `backoffice_user_role` (`id`, `name`) VALUES
	(1, 'System Administrator'),
	(2, 'Manager'),
	(3, 'Content Editor'),
	(4, 'User');
/*!40000 ALTER TABLE `backoffice_user_role` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
