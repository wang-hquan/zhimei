DROP TABLE if EXISTS `tj_goods` ;
CREATE TABLE `tj_goods` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `goods_name` VARCHAR(20) NOT NULL COMMENT '商品名称',
   `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类',
   `img` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '商品图片',
   `goods_price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品单价',
   `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简介',
   `goods_item` varchar(255) NOT NULL DEFAULT '' COMMENT '体检项目',
   `goods_matters` varchar(200) NOT NULL DEFAULT  '' COMMENT '注意事项',
   `goods_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '商品详情',
   `is_on_sale` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架 1=上架  0=下架',
   `is_tuijian` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '受否推荐 1=推荐 0=未推荐',
   `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
   `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY  (`goods_name`)
) ENGINE=InnoDB  CHARSET=utf8;