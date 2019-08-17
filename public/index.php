<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET, POST, PATCH, PUT, DELETE');
header('Access-Control-Allow-Headers:Authorization, Content-Type, Token, If-Match, If-Modified-Since, If-None-Match, If-Unmodified-Since, X-Requested-With');

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';
define('APP_PATH', __DIR__);
// 支持事先使用静态方法设置Request对象和Config对象

// 执行应用并响应
Container::get('app')->run()->send();

