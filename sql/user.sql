DROP TABLE if EXISTS `user` ;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile` varchar(11) NOT NULL COMMENT '手机号',
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `user_money` decimal(18,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `head_img` varchar(100) COMMENT '头像',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `token` varchar(50) DEFAULT NULL COMMENT 'token',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别 1男 0 女',
  `weight` varchar(20) NOT NULL DEFAULT '0' COMMENT '体重',
  `openid`   varchar(30) NOT NULL DEFAULT '0' COMMENT '微信openid',
  `nickname` varchar(50) NULL COMMENT '微信昵称',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
  `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY  (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;