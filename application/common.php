<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
require_once '../extend/alisms/vendor/autoload.php';
// 应用公共文件
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;

function send_sms($to, $model, $code)
{
    Config::load(); //加载区域结点配置
//    $config = Db::name('sms_config')->select();
    $accessKeyId = 'LTAICJcXnK7bE1zM';
    $accessKeySecret = 'Q4ek7I2n9q1V3UnIE3idDSfcmkBml3';
    $templateParam = $code;
    $templateCode = $model;
    //短信模板ID
//    switch ($model) {
//        case 1:
//            $templateCode = $config[0]['sms_stencil_code']; // 注册登录短信验证码模板
//            break;
//        case 2:
//            $templateCode = $config[1]['sms_stencil_code']; // 重置密码短信验证码模板
//            break;
//    }
    //短信API产品名（短信产品名固定，无需修改）
    $product = "Dysmsapi";
    //短信API产品域名（接口地址固定，无需修改）
    $domain = "dysmsapi.aliyuncs.com";
    //暂时不支持多Region（目前仅支持cn-hangzhou请勿修改）
    $region = "cn-hangzhou";
    // 初始化用户Profile实例
    $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
    // 增加服务结点
    DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
    // 初始化AcsClient用于发起请求
    $acsClient = new DefaultAcsClient($profile);
    // 初始化SendSmsRequest实例用于设置发送短信的参数
    $request = new SendSmsRequest();
    // 必填，设置雉短信接收号码
    $request->setPhoneNumbers($to);
    // 必填，设置签名名称
    $request->setSignName('nnbw');
    // 必填，设置模板CODE
    $request->setTemplateCode($templateCode);
    // 可选，设置模板参数
    if ($templateParam) {
        $request->setTemplateParam(json_encode($templateParam));
    }
    //发起访问请求
    $acsResponse = $acsClient->getAcsResponse($request);
    //返回请求结果
    $result = json_decode(json_encode($acsResponse), true);
    // 具体返回值参考文档：https://help.aliyun.com/document_detail/55451.html?spm=a2c4g.11186623.6.563.YSe8FK
    return $result;
}

function toJson($code,$msg,$data='') {
    $param = [
        'code' => $code,
        'data' =>$data,
        'msg' =>$msg
    ];
    echo  json_encode($param,JSON_UNESCAPED_UNICODE);
}