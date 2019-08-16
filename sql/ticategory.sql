DROP TABLE if EXISTS `ti_category` ;
CREATE TABLE `ti_category` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `cat_name` VARCHAR(20) NOT NULL COMMENT '分类名称',
   `pid` int(10) unsigned DEFAULT 0 ,
   `status` tinyint(1) unsigned DEFAULT 1,
   `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
   `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
    PRIMARY KEY (`id`),
    unique key (`cat_name`)
) ENGINE=InnoDB  CHARSET=utf8;