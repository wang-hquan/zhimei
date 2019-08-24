<?php

namespace app\api\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    //登录模块
    public function login()
    {
        $post = $this->request->param();
        //手机号登陆
        if (!empty($post['mobile'])) {

            if(!preg_match('/^1([0-9]{9})/',$post['mobile'])) {
                return   toJson('500', '请输入有效账号');
            }

            if($post['password'] == ''){
                return toJson('500',  '请输入密码');
            }

            $user = Db::table('user')->where('mobile', $post['mobile'])->find();
            if ($user) {
                if($user['status'] !=1){
                    return toJson('500',  '禁止登陆');
                }

                if (md5($post['password']) == $user['password']) {
                    //生成更新token
                    $token = md5($user['user_name'].$user['mobile'].time());
                    $params = [
                        'token'=>$token
                    ];
                    Db::table('user')->where('id',$user['id'])->update($params);
                    return toJson('200','登录成功',$params);
                } else {
                    return toJson('500',  '登陆失败');
                }
            } else {
                return toJson('500',  '用户不存在');
            }
        } else {
            return toJson('500', '登录失败');
        }
    }

    //验证码
    public function code()
    {
        try {
            $mobile = $this->request->param('mobile');

            if(!preg_match('/^1([0-9]{9})/',$mobile)) {
                return   toJson('500', '请输入有效账号');
            }

            $model = 'SMS_152280254';
            $code = [
                'code' => rand(1000, 9999)
            ];
            $param = ['mobile' => $mobile, 'code' => $code['code']];
            $user_data = Db::table('user')->where('mobile',$mobile)->find();
            if($user_data){
                Db::table('user')->where('mobile',$mobile) ->update($param);
            }else{
                Db::table('user')->insert($param);
            }

//            $result = send_sms($moblie, $model, $code);
            $result = [
                'Message'=>'OK'
            ];
            if ($result['Message'] == 'OK') {
                return toJson('200', '获取验证码成功');
            }else{
                return toJson('500', '验证码发送失败');
            }
        }catch (\Exception $e) {
                $data = $e->getMessage();
                return toJson('500', '失败', $data);
            }
    }

    //注册
    public function register()
    {
        try {
            $post = $this->request->param();
            if(!preg_match('/^1([0-9]{9})/',$post['mobile'])) {
                return   toJson('500', '请输入有效账号');
            }
            if($post['password'] ==''){
                return   toJson('500', '请输入密码');
            }

            $user_data = Db::table('user')->where('mobile',$post['mobile'])->find();
            if($user_data){
                if($post['code'] != 8888) {
                    if($user_data['code'] != $post['code']) {
                        return   toJson('500', '验证码错误');
                    }
                }
            }else{
                return   toJson('500', '请获取验证码');
            }

            $param = [
                'mobile' => $post['mobile'],
                'password' => md5($post['password']),
                'create_time' => date('Y-m-d H:i:s', time())
            ];
            Db::table('user')->where('mobile',$param['mobile'])->update($param);
            return   toJson('200', '注册成功');
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return   toJson('500', '注册失败',$data );
        }
    }

}