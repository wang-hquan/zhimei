DROP TABLE if EXISTS `tj_member` ;
CREATE TABLE `tj_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `name` varchar(120) NOT NULL DEFAULT '' COMMENT '体检人姓名',
  `mobile` varchar (11) NOT NULL DEFAULT  '' COMMENT '手机号',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别 1男 0 女',
  `height` varchar(20) NOT NULL DEFAULT '0' COMMENT '身高',
  `weight` varchar(20) NOT NULL DEFAULT '0' COMMENT '体重',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `city` varchar(50)  NOT NULL DEFAULT '' COMMENT '城市' ,
  `city_num` varchar(50)  NOT NULL DEFAULT '' COMMENT '城市代码' ,
  `address` varchar(200) COMMENT '详细地址',
  `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
  `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '受检人信息表';