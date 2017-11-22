# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.29-log)
# Database: lv5admin
# Generation Time: 2017-11-22 09:00:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table lv_admin_group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_admin_group`;

CREATE TABLE `lv_admin_group` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `menus` text COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `listorder` smallint(5) unsigned DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `admin_id` smallint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分组';

LOCK TABLES `lv_admin_group` WRITE;
/*!40000 ALTER TABLE `lv_admin_group` DISABLE KEYS */;

INSERT INTO `lv_admin_group` (`id`, `name`, `description`, `menus`, `listorder`, `updated_at`, `created_at`, `admin_id`)
VALUES
	(1,'测试权限','测试权限','106,110,109,108,107,169,19,33,34,21,29,3,1,6,122,123,2,28',0,1511340264,1504588542,1),
	(2,'管理员','所有权限','106,110,107,108,109,3,1,79,58,6,7,8,122,123,124,125,126,2,28,169,19,66,36,33,34,35,21,29,30,31',0,1511321796,1504588611,1);

/*!40000 ALTER TABLE `lv_admin_group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_admin_group_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_admin_group_access`;

CREATE TABLE `lv_admin_group_access` (
  `admin_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '角色id',
  UNIQUE KEY `uid_group_id` (`admin_id`,`group_id`),
  KEY `uid` (`admin_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户所属分组';

LOCK TABLES `lv_admin_group_access` WRITE;
/*!40000 ALTER TABLE `lv_admin_group_access` DISABLE KEYS */;

INSERT INTO `lv_admin_group_access` (`admin_id`, `group_id`)
VALUES
	(2,1),
	(1,2),
	(3,2),
	(4,3);

/*!40000 ALTER TABLE `lv_admin_group_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_admin_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_admin_log`;

CREATE TABLE `lv_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` mediumint(8) NOT NULL DEFAULT '0' COMMENT '菜单id',
  `primary_id` int(11) DEFAULT '0' COMMENT '表中主键ID',
  `querystring` varchar(255) DEFAULT '' COMMENT '参数',
  `data` text COMMENT 'POST数据',
  `ip` varchar(18) NOT NULL DEFAULT '',
  `admin_id` mediumint(8) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_menu_id` (`menu_id`),
  KEY `idx_admin_id` (`admin_id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lv_admin_log` WRITE;
/*!40000 ALTER TABLE `lv_admin_log` DISABLE KEYS */;

INSERT INTO `lv_admin_log` (`id`, `menu_id`, `primary_id`, `querystring`, `data`, `ip`, `admin_id`, `created_at`, `updated_at`)
VALUES
	(1,35,2,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"2\",\"info\":{\"realname\":\"12341\",\"mobile\":null,\"level\":null,\"status\":null}}','127.0.0.1',1,1511339375,1511339375),
	(2,35,2,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"2\",\"info\":{\"realname\":\"12341\",\"mobile\":\"1234\",\"level\":\"1\",\"status\":\"1\"},\"group_ids\":[\"1\"]}','127.0.0.1',1,1511339384,1511339384),
	(3,35,2,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"2\",\"info\":{\"realname\":\"\\u6d4b\\u8bd5\\u8d26\\u53f7\",\"mobile\":\"18888873646\",\"level\":\"1\",\"status\":\"1\"},\"group_ids\":[\"1\"]}','127.0.0.1',1,1511340114,1511340114),
	(4,31,1,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"1\",\"menus\":\"106,110,109,108,107,169,19,33,34,21,29,6,123,2,28\",\"name\":\"\\u6d4b\\u8bd5\\u6743\\u9650\",\"description\":\"\\u6d4b\\u8bd5\\u6743\\u9650\"}','127.0.0.1',1,1511340153,1511340153),
	(5,36,0,'id=2',NULL,'127.0.0.1',1,1511340184,1511340184),
	(6,36,2,'id=2','{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"2\",\"password\":\"testtest\",\"password_confirmation\":\"testtest\"}','127.0.0.1',1,1511340192,1511340192),
	(7,31,1,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"1\",\"menus\":\"106,110,109,108,107,169,19,33,34,21,29,3,1,6,122,123,2,28\",\"name\":\"\\u6d4b\\u8bd5\\u6743\\u9650\",\"description\":\"\\u6d4b\\u8bd5\\u6743\\u9650\"}','127.0.0.1',1,1511340264,1511340264),
	(8,109,3,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"3\",\"info\":{\"mobile\":\"18341234124\",\"realname\":\"1234\",\"sex\":\"1\",\"status\":\"1\"}}','127.0.0.1',2,1511340283,1511340283),
	(9,109,4,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"4\",\"info\":{\"mobile\":\"18888873647\",\"realname\":\"\\u675c\\u632f\\u8bad\",\"sex\":\"2\",\"status\":\"1\"}}','127.0.0.1',2,1511340288,1511340288),
	(10,109,4,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"4\",\"info\":{\"mobile\":\"18888873647\",\"realname\":\"\\u675c\\u632f\\u8bad\",\"sex\":\"1\",\"status\":\"1\"}}','127.0.0.1',2,1511340790,1511340790),
	(11,109,3,NULL,'{\"_token\":\"nyRugO7XUOz4bikganB1plsPoinktMo9uKjd53Zb\",\"id\":\"3\",\"info\":{\"mobile\":\"18341234124\",\"realname\":\"1234\",\"sex\":\"2\",\"status\":\"1\"}}','127.0.0.1',2,1511340809,1511340809);

/*!40000 ALTER TABLE `lv_admin_log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_admin_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_admin_menu`;

CREATE TABLE `lv_admin_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `parentid` smallint(6) DEFAULT '0' COMMENT '上级',
  `icon` varchar(20) DEFAULT '' COMMENT '图标',
  `m` varchar(10) NOT NULL DEFAULT 'admin' COMMENT '模块',
  `c` varchar(20) NOT NULL DEFAULT '' COMMENT 'controller',
  `a` varchar(20) NOT NULL DEFAULT '' COMMENT 'action',
  `data` varchar(50) DEFAULT '',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `listorder` smallint(6) unsigned DEFAULT '999',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示1:显示,2:不显示',
  `write_log` tinyint(1) NOT NULL DEFAULT '2' COMMENT '记录日志:1记录,2不记录',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `idx_a_c` (`c`,`a`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lv_admin_menu` WRITE;
/*!40000 ALTER TABLE `lv_admin_menu` DISABLE KEYS */;

INSERT INTO `lv_admin_menu` (`id`, `name`, `parentid`, `icon`, `m`, `c`, `a`, `data`, `group`, `listorder`, `status`, `write_log`, `updated_at`, `created_at`)
VALUES
	(1,'后台菜单',3,NULL,'admin','menu','lists',NULL,'',999,1,2,1511322035,1503299010),
	(2,'日志管理',3,NULL,'admin','adminLog','lists',NULL,'',999,1,2,1511322035,1503300454),
	(3,'系统管理',0,'fa-gears','admin','system','index',NULL,'',50,1,2,1511322035,1503300505),
	(6,'查看',1,NULL,'admin','menu','info',NULL,'',999,2,2,1511322035,1503303676),
	(7,'添加',1,NULL,'admin','menu','add',NULL,'',999,2,2,1511322035,1503303742),
	(8,'修改',1,NULL,'admin','menu','edit',NULL,'',999,2,1,1511322035,1503303780),
	(19,'管理员',169,NULL,'admin','adminUser','lists',NULL,'',10,1,2,1511322035,1503305413),
	(21,'角色管理',169,NULL,'admin','adminGroup','lists',NULL,'',999,1,2,1511322035,1503305466),
	(28,'日志详情',2,NULL,'admin','adminLog','info',NULL,'',999,2,2,1511322035,1503561164),
	(29,'详情',21,NULL,'admin','adminGroup','info',NULL,'',999,2,2,1511322035,1503655888),
	(30,'添加',21,NULL,'admin','adminGroup','add',NULL,'',999,2,2,1511322035,0),
	(31,'修改',21,NULL,'admin','adminGroup','edit',NULL,'',999,2,1,1511322035,0),
	(33,'详情',19,'','admin','adminUser','info','','',999,2,2,1511322035,0),
	(34,'添加',19,'','admin','adminUser','add','','',999,2,2,1511322035,0),
	(35,'修改',19,'','admin','adminUser','edit','','',999,2,1,1511322035,0),
	(36,'修改用户密码',19,'','admin','adminUser','changePwd','','',999,2,1,1511322035,0),
	(58,'排序',1,NULL,'admin','menu','setListorder',NULL,'',999,2,2,1511322035,1503657729),
	(66,'禁用',19,NULL,'admin','adminUser','status',NULL,'',999,2,1,1511322035,1504605933),
	(79,'删除',1,NULL,'admin','menu','del',NULL,'',999,2,2,1511322035,1504998588),
	(106,'会员管理',0,'fa-users','admin','member','lists',NULL,'',1,1,2,1511322035,1505630166),
	(107,'详情',106,'','admin','member','info',NULL,'',1,2,2,1511322035,1505630166),
	(108,'添加',106,'','admin','member','add',NULL,'',1,2,2,1511322035,1505630166),
	(109,'修改会员信息',106,NULL,'admin','member','edit',NULL,'',1,2,1,1511322035,1505630166),
	(110,'删除',106,'','admin','member','del',NULL,'',1,2,2,1511322035,1505630166),
	(122,'站点设置',3,NULL,'admin','site','info',NULL,'',999,1,2,1511322035,1506336604),
	(123,'详情',122,'','admin','site','info',NULL,'',999,2,2,1511322035,1506336604),
	(124,'添加',122,'','admin','site','add',NULL,'',999,2,2,1511322035,1506336604),
	(125,'修改',122,'','admin','site','edit',NULL,'',999,2,2,1511322035,1506336604),
	(126,'删除',122,'','admin','site','del',NULL,'',999,2,2,1511322035,1506336604),
	(169,'管理员管理',0,'fa-users','admin','adminUser','index',NULL,'',2,1,2,1511322035,1511320558),
	(170,'删除角色',21,NULL,'admin','adminGroup','del',NULL,'',999,2,2,1511322035,1511321984);

/*!40000 ALTER TABLE `lv_admin_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_admin_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_admin_user`;

CREATE TABLE `lv_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(125) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `realname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '真实姓名',
  `city_id` int(11) NOT NULL DEFAULT '1' COMMENT '城市',
  `store_id` smallint(5) DEFAULT NULL COMMENT '店面id',
  `position_id` tinyint(1) DEFAULT '0' COMMENT '部门',
  `level` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1' COMMENT '1正常,2禁用',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `updated_at` int(11) NOT NULL,
  `created_at` int(10) NOT NULL COMMENT '创建时间',
  `is_super` tinyint(1) DEFAULT '0' COMMENT '超级管理员,直接拥有所有权限',
  PRIMARY KEY (`id`),
  KEY `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='后台管理员';

LOCK TABLES `lv_admin_user` WRITE;
/*!40000 ALTER TABLE `lv_admin_user` DISABLE KEYS */;

INSERT INTO `lv_admin_user` (`id`, `name`, `password`, `email`, `mobile`, `realname`, `city_id`, `store_id`, `position_id`, `level`, `status`, `remember_token`, `updated_at`, `created_at`, `is_super`)
VALUES
	(1,'admin','$2y$10$0ZbfbtNTozAEKkB.xa1BkejOb0ssYVWS.spu6pf09HleMmCkHdFty','system@100iec.com','18888873646','杜振训',1,NULL,1,1,1,'xOn9ORMHRCdJAIqzGHh8sHNCaFybvn1xkaxbiEUdhiEWnLTL9IOVkTdWeTyq',1511340241,0,1),
	(2,'test','$2y$10$2Rucnfk92ndIKgFVYEhbX.yfW3JpL.xh5a5mai3o5pWcH9FcIwiuK','','18888873646','测试账号',1,NULL,0,1,1,'NHr3bPXUE9WHjVvFLIqYRAfa0lpHSg7cbpErpWIFGdtoVq6oiZDrFk4cmqNx',1511340192,1511339326,0);

/*!40000 ALTER TABLE `lv_admin_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_member`;

CREATE TABLE `lv_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `city_id` varchar(20) DEFAULT NULL COMMENT '市',
  `mobile` char(11) NOT NULL,
  `realname` varchar(30) DEFAULT NULL COMMENT '真实性名',
  `sex` tinyint(1) DEFAULT '0' COMMENT '1男,2女,0不详',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0',
  `reg_ip` char(15) NOT NULL DEFAULT '',
  `last_ip` char(15) NOT NULL DEFAULT '',
  `login_num` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `agent_id` int(10) DEFAULT '0' COMMENT '上级id',
  `weixin_openid` varchar(50) NOT NULL DEFAULT '' COMMENT '微信id',
  `head_img` varchar(255) DEFAULT '' COMMENT '头像',
  `subscribe` tinyint(1) DEFAULT '1' COMMENT '是否关注微信号',
  `subscribe_time` int(11) DEFAULT '0' COMMENT '关注时间',
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `message` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员';

LOCK TABLES `lv_member` WRITE;
/*!40000 ALTER TABLE `lv_member` DISABLE KEYS */;

INSERT INTO `lv_member` (`id`, `city_id`, `mobile`, `realname`, `sex`, `status`, `updated_at`, `created_at`, `reg_ip`, `last_ip`, `login_num`, `type`, `agent_id`, `weixin_openid`, `head_img`, `subscribe`, `subscribe_time`, `groupid`, `message`, `vip`)
VALUES
	(1,'1','1234','1234',1,1,1505631909,1505631909,'','',0,0,1,'','',1,0,0,0,0),
	(2,'1','18888873646','12341',1,1,1506319674,1506319674,'','',0,0,1,'','',1,0,0,0,0),
	(3,'1','18341234124','1234',2,1,1511340809,1506332174,'','',0,0,1,'','',1,0,0,0,0),
	(4,NULL,'18888873647','杜振训',1,1,1511340790,1507819720,'','',0,0,1,'','',1,0,0,0,0);

/*!40000 ALTER TABLE `lv_member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_migrations`;

CREATE TABLE `lv_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `lv_migrations` WRITE;
/*!40000 ALTER TABLE `lv_migrations` DISABLE KEYS */;

INSERT INTO `lv_migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2017_10_29_170116_create_sessions_table',1);

/*!40000 ALTER TABLE `lv_migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lv_site
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lv_site`;

CREATE TABLE `lv_site` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT '',
  `keywords` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `misname` varchar(50) DEFAULT NULL COMMENT '后台名称',
  `setting` mediumtext,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='站点设置';

LOCK TABLES `lv_site` WRITE;
/*!40000 ALTER TABLE `lv_site` DISABLE KEYS */;

INSERT INTO `lv_site` (`id`, `title`, `keywords`, `description`, `misname`, `setting`, `created_at`, `updated_at`)
VALUES
	(1,'xxx','dadsf','asdf','lv5admin',NULL,1506337198,1511330781);

/*!40000 ALTER TABLE `lv_site` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
