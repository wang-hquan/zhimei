DROP TABLE if EXISTS `news` ;
CREATE TABLE `news` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `news_name` VARCHAR(20) NOT NULL COMMENT '新闻名称',
   `brief` VARCHAR(20) NOT NULL COMMENT '简短介绍',
   `type` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '新闻标签',
   `desc` text NOT NULL DEFAULT '' COMMENT '新闻详情',
   `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1开启，0禁用',
   `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
   `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  CHARSET=utf8;