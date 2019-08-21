DROP   TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) DEFAULT NULL COMMENT '用户名',
  `head_img` varchar(100) DEFAULT NULL COMMENT '头像',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `status` tinyint(1) unsigned NULL DEFAULT 1 COMMENT '账号状态',
  `create_time` varchar(20) NOT NULL COMMENT '添加时间',
  `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY  (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT '后台管理员账号';