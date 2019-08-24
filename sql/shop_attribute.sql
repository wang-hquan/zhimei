DROP TABLE if EXISTS `shop_attribute` ;
CREATE TABLE `shop_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '分类Id',
  `attr_name` varchar(60) NOT NULL DEFAULT '' COMMENT '类型属性名称',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`attr_id`),
  KEY `cat_id` (`cat_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '商品类型属性';