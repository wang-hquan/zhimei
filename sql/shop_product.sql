DROP TABLE IF EXISTS  `shop_products`;
CREATE TABLE `shop_products` (
  `product_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_attr` varchar(50) DEFAULT NULL COMMENT '商品属性',
  `product_number` smallint(5) unsigned DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;