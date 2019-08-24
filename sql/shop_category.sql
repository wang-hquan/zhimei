DROP TABLE if EXISTS `shop_category` ;
CREATE TABLE `shop_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(90) NOT NULL DEFAULT '' COMMENT '分类名称',
  `cat_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '分类描述',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `type_img` varchar(100) NOT NULL COMMENT '分类图标',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT '分类名称';