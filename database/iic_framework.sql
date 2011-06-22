# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.8
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3881
# Date/time:                    2011-06-22 23:26:53
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
  `id_module` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_enable` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0 = disable, 1 = enable',
  PRIMARY KEY (`id_module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_module: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_module` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_theme
DROP TABLE IF EXISTS `backoffice_theme`;
CREATE TABLE IF NOT EXISTS `backoffice_theme` (
  `id_theme` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  PRIMARY KEY (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_theme: ~1 rows (approximately)
/*!40000 ALTER TABLE `backoffice_theme` DISABLE KEYS */;
INSERT INTO `backoffice_theme` (`id_theme`, `theme_name`, `header_bg_color`, `header_bg_image`, `header_text_1`, `header_text_2`, `header_text_color`, `header_text_size`, `footer_bg_color`, `footer_bg_image`, `footer_text`, `footer_text_color`, `foot_text_size`, `table_head_bg_color`, `table_head_bg_image`, `table_head_rollover_color`, `table_head_text_color`, `table_head_text_size`, `table_line_color`, `table_row_bg_color_1`, `table_row_bg_color_2`, `table_row_rollover_color`, `table_row_selected_color`, `table_text_color`, `table_text_size`) VALUES
	(1, 'Padonc Green', '#669900', NULL, 'Backoffice System', 'IIC Framework', '#FFFFFF', 24, NULL, NULL, 'All support and powered by NextGen Sulution Co., Ltd.', '#669900', 10, '#669900', NULL, '#36AAFF', '#FFFFFF', 12, '#AAAAAA', '#FFFFFF', '#F0F0F0', '#E4EEFF', '#E4EEFF', '#666666', 12);
/*!40000 ALTER TABLE `backoffice_theme` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user
DROP TABLE IF EXISTS `backoffice_user`;
CREATE TABLE IF NOT EXISTS `backoffice_user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user: ~1 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user` DISABLE KEYS */;
INSERT INTO `backoffice_user` (`id_user`, `name`, `username`, `password`) VALUES
	(1, 'Administrator', 'admin', 'admin');
/*!40000 ALTER TABLE `backoffice_user` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_permission
DROP TABLE IF EXISTS `backoffice_user_permission`;
CREATE TABLE IF NOT EXISTS `backoffice_user_permission` (
  `id_user` int(10) unsigned NOT NULL,
  `id_module` int(10) unsigned NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `create` tinyint(1) NOT NULL DEFAULT '1',
  `update` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`,`id_module`),
  KEY `FK__backoffice_module` (`id_module`),
  CONSTRAINT `FK__backoffice_user` FOREIGN KEY (`id_user`) REFERENCES `backoffice_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__backoffice_module` FOREIGN KEY (`id_module`) REFERENCES `backoffice_module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_permission` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_category
DROP TABLE IF EXISTS `catalog_category`;
CREATE TABLE IF NOT EXISTS `catalog_category` (
  `id_category` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `is_enable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordering` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.catalog_category: ~9 rows (approximately)
/*!40000 ALTER TABLE `catalog_category` DISABLE KEYS */;
INSERT INTO `catalog_category` (`id_category`, `id_parent`, `name`, `description`, `is_enable`, `ordering`) VALUES
	(1, 0, 'Category 1', '', 1, 1),
	(13, 0, 'Category 2', 'naja อิอิ\n', 0, 2),
	(14, 13, 'Cat 2-1', '', 1, 1),
	(15, 0, 'Category 3', '', 1, 3),
	(16, 0, '4', '', 0, 0),
	(17, 0, '5', '', 1, 0),
	(18, 0, '6', '', 1, 0),
	(19, 0, '7', '', 0, 0),
	(20, 1, '1.1', '', 1, 0);
/*!40000 ALTER TABLE `catalog_category` ENABLE KEYS */;


# Dumping structure for table iic_framework.catalog_category_item
DROP TABLE IF EXISTS `catalog_category_item`;
CREATE TABLE IF NOT EXISTS `catalog_category_item` (
  `id_category` int(10) unsigned NOT NULL,
  `id_item` int(10) unsigned NOT NULL,
  `id_item_type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id_category`,`id_item`),
  KEY `id_item_type` (`id_item_type`),
  CONSTRAINT `FK_catalog_category_item_catalog_category_item_type` FOREIGN KEY (`id_item_type`) REFERENCES `catalog_category_item_type` (`id_item_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_catalog_category_item_catalog_category` FOREIGN KEY (`id_category`) REFERENCES `catalog_category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE
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
