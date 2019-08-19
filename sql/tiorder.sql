DROP TABLE if EXISTS `tj_order` ;
CREATE TABLE `tj_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `order_sn` varchar(250) NOT NULL COMMENT '订单号',
  `order_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '订单状态0 未付款 1已付款 2已完成',
  `pay_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '总金额',
  `address` varchar (200) NOT NULL DEFAULT '' COMMENT '受检人id',
  `pay_time`  varchar(20) NOT NULL COMMENT '付款时间',
  `is_del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除',
  `pay_log` int(10) unsigned NOT NULL DEFAULT 0 COMMENT '支付日志',
  `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
  `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY  (`order_sn`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `order_status` (`order_status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT 'pc体验订单表';