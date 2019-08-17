<?php

namespace app\api\validate;

use think\Validate;

class Info extends Validate
{
    protected $rule =   [
        'name'  => 'require',
        'sex'  => 'require',
        'mobile' => 'require| regex:/^1([0-9]{9})/|length:11',
        'height'  => 'require',
        'weight'  => 'require',
        'birthday'  => 'require',
        'city'  => 'require',
        'address'  => 'require',
    ];

    protected $message  =   [
        'mobile.length'     => '请输入正确的手机号',
        'mobile.regex'      => '请输入正确的手机号',
    ];
}