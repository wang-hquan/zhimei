DROP TABLE IF EXISTS `tj_goods_cart`;
CREATE TABLE `tj_goods_cart` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID' ,
  `goods_name` varchar(50)  NOT NULL DEFAULT '0' COMMENT '商品名称',
  `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简介',
  `goods_img` varchar (200) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0' COMMENT '商品价格' ,
  `goods_num` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量' ,
   PRIMARY KEY (`id`)
) ENGINE=innodb DEFAULT CHARSET=utf8 COMMENT '体检商品购物车';