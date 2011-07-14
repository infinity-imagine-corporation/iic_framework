# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.57-community
# Server OS:                    Win64
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-07-14 20:19:01
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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


# Dumping structure for table iic_framework.backoffice_permission
DROP TABLE IF EXISTS `backoffice_permission`;
CREATE TABLE IF NOT EXISTS `backoffice_permission` (
  `id_role` int(10) unsigned NOT NULL DEFAULT '0',
  `id_group` int(10) unsigned NOT NULL DEFAULT '0',
  `id_action` int(10) unsigned NOT NULL DEFAULT '0',
  `id_module` int(10) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_role`,`id_group`,`id_action`,`id_module`),
  KEY `FK__backoffice_user_group` (`id_group`),
  KEY `FK__backoffice_module` (`id_module`),
  KEY `FK__backoffice_permission_action` (`id_action`),
  CONSTRAINT `FK__backoffice_user_role` FOREIGN KEY (`id_role`) REFERENCES `backoffice_user_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__backoffice_user_group` FOREIGN KEY (`id_group`) REFERENCES `backoffice_user_group` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__backoffice_module` FOREIGN KEY (`id_module`) REFERENCES `backoffice_module` (`id_module`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__backoffice_permission_action` FOREIGN KEY (`id_action`) REFERENCES `backoffice_permission_action` (`id_action`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_permission` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_permission_action
DROP TABLE IF EXISTS `backoffice_permission_action`;
CREATE TABLE IF NOT EXISTS `backoffice_permission_action` (
  `id_action` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_action`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_permission_action: ~4 rows (approximately)
/*!40000 ALTER TABLE `backoffice_permission_action` DISABLE KEYS */;
INSERT INTO `backoffice_permission_action` (`id_action`, `name`) VALUES
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_role` int(10) unsigned DEFAULT NULL,
  `id_group` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_group` (`id_group`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `backoffice_user_ibfk_3` FOREIGN KEY (`id_role`) REFERENCES `backoffice_user_role` (`id_role`) ON DELETE SET NULL,
  CONSTRAINT `backoffice_user_ibfk_2` FOREIGN KEY (`id_group`) REFERENCES `backoffice_user_group` (`id_group`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user: ~1 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user` DISABLE KEYS */;
INSERT INTO `backoffice_user` (`id_user`, `name`, `username`, `password`, `id_role`, `id_group`) VALUES
	(1, 'Administrator', 'admin', 'admin', NULL, NULL);
/*!40000 ALTER TABLE `backoffice_user` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_group
DROP TABLE IF EXISTS `backoffice_user_group`;
CREATE TABLE IF NOT EXISTS `backoffice_user_group` (
  `id_group` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_group` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_log
DROP TABLE IF EXISTS `backoffice_user_log`;
CREATE TABLE IF NOT EXISTS `backoffice_user_log` (
  `id_user` int(10) unsigned NOT NULL,
  `id_action` int(10) unsigned NOT NULL,
  `id_module` int(10) unsigned NOT NULL,
  `first_use` datetime DEFAULT NULL,
  `lase_use` datetime DEFAULT NULL,
  `additional_info` text COLLATE utf8_unicode_ci,
  KEY `id_user` (`id_user`),
  KEY `FK_backoffice_user_log_backoffice_permission_action` (`id_action`),
  KEY `FK_backoffice_user_log_backoffice_module` (`id_module`),
  CONSTRAINT `FK_backoffice_user_log_backoffice_module` FOREIGN KEY (`id_module`) REFERENCES `backoffice_module` (`id_module`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_permission_action` FOREIGN KEY (`id_action`) REFERENCES `backoffice_permission_action` (`id_action`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_backoffice_user_log_backoffice_user` FOREIGN KEY (`id_user`) REFERENCES `backoffice_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_log: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_log` ENABLE KEYS */;


# Dumping structure for table iic_framework.backoffice_user_role
DROP TABLE IF EXISTS `backoffice_user_role`;
CREATE TABLE IF NOT EXISTS `backoffice_user_role` (
  `id_role` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

# Dumping data for table iic_framework.backoffice_user_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `backoffice_user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `backoffice_user_role` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
