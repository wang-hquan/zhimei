DROP TABLE IF EXISTS `tj_order_goods`;
CREATE TABLE `tj_order_goods` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `goods_name` varchar(120) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(120) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_item` varchar (200)   NOT NULL DEFAULT  '' COMMENT '体检项目',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品单价',
  `goods_num` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`) USING BTREE,
  KEY `goods_id` (`goods_id`) USING BTREE
) ENGINE=innodb  CHARSET=utf8 COMMENT '体验订单商品表';