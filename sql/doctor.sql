DROP TABLE if EXISTS `doctor` ;
CREATE TABLE `doctor` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `doctor_name` VARCHAR(20) NOT NULL COMMENT '医生名称',
   `type` varchar(50) NOT NULL DEFAULT '1' COMMENT '职位标签',
   `img` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '头像',
   `brief` VARCHAR(200) NOT NULL DEFAULT '0.00' COMMENT '简介',
   `doctor_item` varchar(255) NOT NULL DEFAULT '' COMMENT '擅长方向',
   `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '详细介绍',
   `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态：1开启，0禁用',
   `create_time`  varchar(20) NOT NULL COMMENT '添加时间',
   `updata_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  CHARSET=utf8;