# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.57-community
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-07-18 14:39:06
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for iic_framework
DROP DATABASE IF EXISTS `iic_framework`;
CREATE DATABASE IF NOT EXISTS `iic_framework` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `iic_framework`;


# Dumping structure for table iic_framework.backoffice_module
DROP TABLE IF EXISTS `backoffice_module`;
CREATE TABLE IF NOT EXISTS `backoffice_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_enable` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 = disable, 1 = enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_module: ~5 rows (approximately)
/*!40000 ALTER TABLE `backoffice_module` DISABLE KEYS */;
INSERT INTO `backoffice_module` (`id`, `name`, `description`, `is_enable`) VALUES
	(1, 'Theme', NULL, 0),
	(2, 'User Group', NULL, 0),
	(3, 'User Role', NULL, 0),
	(4, 'User', NULL, 0),
	(5, 'User Permission', NULL, 0);
/*!40000 ALTER TABLE `backoffice_module` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_permission
DROP TABLE IF EXISTS `backoffice_permission`;
CREATE TABLE IF NOT EXISTS `backoffice_permission` (
  `id` int(10) unsigned NOT NULL DEFAULT '0',
  `group` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'id',
  `action` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'id',
  `module` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'id',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_backoffice_permission_backoffice_user_group` (`group`),
  KEY `FK_backoffice_permission_backoffice_permission_action` (`action`),
  KEY `FK_backoffice_permission_backoffice_module` (`module`),
  CONSTRAINT `FK_backoffice_permission_backoffice_user_group` FOREIGN KEY (`group`) REFERENCES `backoffice_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_permission_backoffice_permission_action` FOREIGN KEY (`action`) REFERENCES `backoffice_permission_action` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_permission_backoffice_module` FOREIGN KEY (`module`) REFERENCES `backoffice_module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_permission` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_permission_action
DROP TABLE IF EXISTS `backoffice_permission_action`;
CREATE TABLE IF NOT EXISTS `backoffice_permission_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_permission_action: ~6 rows (approximately)
/*!40000 ALTER TABLE `backoffice_permission_action` DISABLE KEYS */;
INSERT INTO `backoffice_permission_action` (`id`, `name`) VALUES
	(1, 'Create'),
	(2, 'Read'),
	(3, 'Update'),
	(4, 'Delete'),
	(5, 'Login'),
	(6, 'Logout');
/*!40000 ALTER TABLE `backoffice_permission_action` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_theme
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

# Dumping data for table iic_framework.backoffice_theme: ~1 rows (approximately)
/*!40000 ALTER TABLE `backoffice_theme` DISABLE KEYS */;
INSERT INTO `backoffice_theme` (`id`, `name`, `header_bg_color`, `header_bg_image`, `header_text_1`, `header_text_2`, `header_text_color`, `header_text_size`, `footer_bg_color`, `footer_bg_image`, `footer_text`, `footer_text_color`, `foot_text_size`, `table_head_bg_color`, `table_head_bg_image`, `table_head_rollover_color`, `table_head_text_color`, `table_head_text_size`, `table_line_color`, `table_row_bg_color_1`, `table_row_bg_color_2`, `table_row_rollover_color`, `table_row_selected_color`, `table_text_color`, `table_text_size`) VALUES
	(1, 'IIC Framework', '#444444', NULL, 'Backoffice System', 'IIC Framework', '#FFFFFF', 24, NULL, NULL, 'All support and powered by NextGen Sulution Co., Ltd.', '#669900', 10, '#669900', NULL, '#36AAFF', '#FFFFFF', 12, '#AAAAAA', '#FFFFFF', '#F0F0F0', '#E4EEFF', '#E4EEFF', '#666666', 12);
/*!40000 ALTER TABLE `backoffice_theme` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user
DROP TABLE IF EXISTS `backoffice_user`;
CREATE TABLE IF NOT EXISTS `backoffice_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(10) unsigned DEFAULT NULL COMMENT 'id',
  `group` int(10) unsigned DEFAULT NULL COMMENT 'id',
  PRIMARY KEY (`id`),
  KEY `FK_backoffice_user_backoffice_user_role` (`role`),
  KEY `FK_backoffice_user_backoffice_user_group` (`group`),
  CONSTRAINT `FK_backoffice_user_backoffice_user_role` FOREIGN KEY (`role`) REFERENCES `backoffice_user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_backoffice_user_backoffice_user_group` FOREIGN KEY (`group`) REFERENCES `backoffice_user_group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user: ~1 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user` DISABLE KEYS */;
INSERT INTO `backoffice_user` (`id`, `name`, `username`, `password`, `role`, `group`) VALUES
	(1, 'Administrator', 'admin', 'admin', NULL, NULL);
/*!40000 ALTER TABLE `backoffice_user` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_group
DROP TABLE IF EXISTS `backoffice_user_group`;
CREATE TABLE IF NOT EXISTS `backoffice_user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_group` DISABLE KEYS */;
INSERT INTO `backoffice_user_group` (`id`, `name`) VALUES
	(20, 'cccdddddddddsadfsadf'),
	(21, 'aaajjjjjxxxssss'),
	(22, 'bbbrrrjjjjxxxx'),
	(23, 'FFFfffasdfsdf'),
	(24, 'asdg'),
	(25, 'asdf');
/*!40000 ALTER TABLE `backoffice_user_group` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_log
DROP TABLE IF EXISTS `backoffice_user_log`;
CREATE TABLE IF NOT EXISTS `backoffice_user_log` (
  `user` int(10) unsigned NOT NULL COMMENT 'id',
  `action` int(10) unsigned NOT NULL COMMENT 'id',
  `module` int(10) unsigned NOT NULL COMMENT 'id',
  `first_use` datetime DEFAULT NULL,
  `lase_use` datetime DEFAULT NULL,
  `additional_info` text COLLATE utf8_unicode_ci,
  KEY `FK_backoffice_user_log_backoffice_user` (`user`),
  KEY `FK_backoffice_user_log_backoffice_permission_action` (`action`),
  KEY `FK_backoffice_user_log_backoffice_module` (`module`),
  CONSTRAINT `FK_backoffice_user_log_backoffice_user` FOREIGN KEY (`user`) REFERENCES `backoffice_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_permission_action` FOREIGN KEY (`action`) REFERENCES `backoffice_permission_action` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_module` FOREIGN KEY (`module`) REFERENCES `backoffice_module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_log` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_role
DROP TABLE IF EXISTS `backoffice_user_role`;
CREATE TABLE IF NOT EXISTS `backoffice_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_role` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_category
DROP TABLE IF EXISTS `catalog_category`;
CREATE TABLE IF NOT EXISTS `catalog_category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_enable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_parent`,`id_category`,`ordering`),
  UNIQUE KEY `id_category` (`id_category`),
  KEY `id_parent` (`id_parent`,`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.catalog_category: ~6 rows (approximately)
/*!40000 ALTER TABLE `catalog_category` DISABLE KEYS */;
INSERT INTO `catalog_category` (`id_category`, `id_parent`, `name`, `description`, `is_enable`, `ordering`) VALUES
	(24, 0, 'cat1', '', 1, 1),
	(25, 0, 'cat2', '', 1, 3),
	(26, 0, 'cat33', '', 0, 9),
	(27, 0, 'cat 1.1', '', 0, 12),
	(28, 0, 'zxczzczxc', '', 0, 10),
	(29, 0, 'zxczxcxz', '', 1, 11),
	(30, 0, 'asdf', '', 0, 13),
	(31, 0, 'asdf', '', 0, 14),
	(32, 0, 'xxxxx', '', 0, 15),
	(33, 0, 'asgsdf', '', 0, 16),
	(34, 0, 'xxxxasdf', '', 0, 17),
	(35, 0, 'sdffffff', '', 0, 18);
/*!40000 ALTER TABLE `catalog_category` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_category_item
DROP TABLE IF EXISTS `catalog_category_item`;
CREATE TABLE IF NOT EXISTS `catalog_category_item` (
  `id_category` int(10) unsigned NOT NULL,
  `id_item` int(10) unsigned NOT NULL,
  `id_item_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_item`),
  KEY `id_item_type` (`id_item_type`),
  CONSTRAINT `FK_catalog_category_item_catalog_category` FOREIGN KEY (`id_category`) REFERENCES `catalog_category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_catalog_category_item_catalog_category_item_type` FOREIGN KEY (`id_item_type`) REFERENCES `catalog_category_item_type` (`id_item_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.catalog_category_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `catalog_category_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `catalog_category_item` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_category_item_type
DROP TABLE IF EXISTS `catalog_category_item_type`;
CREATE TABLE IF NOT EXISTS `catalog_category_item_type` (
  `id_item_type` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_item_type`),
  KEY `id_item_type` (`id_item_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.catalog_category_item_type: ~2 rows (approximately)
/*!40000 ALTER TABLE `catalog_category_item_type` DISABLE KEYS */;
INSERT INTO `catalog_category_item_type` (`id_item_type`, `type_name`) VALUES
	(1, 'story'),
	(2, 'bug');
/*!40000 ALTER TABLE `catalog_category_item_type` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_item
DROP TABLE IF EXISTS `catalog_item`;
CREATE TABLE IF NOT EXISTS `catalog_item` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_enable` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.catalog_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `catalog_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `catalog_item` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
