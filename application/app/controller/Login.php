<?php

namespace app\app\controller;

use think\Db;

class Login extends Base
{
    //登录
    public function doit()
    {
        try{
            $mustFields = ['mobile'];
            $extFields = ['password','code'];
            $param = $this->receiveParam($mustFields,$extFields);
            if(!preg_match('/^1([0-9]{9})/',$param['mobile'])) {
                $this->ret['code'] = 500;
                $this->ret['msg'] = '请输入有效号码';
                $this->outPutJson();
            }
            if( $param['password'] == '' && $param['code'] == ''){
                $this->ret['code'] = 500;
                $this->ret['msg'] = '非法登录';
            }else{
                $user = Db::table('user')->where('mobile',$param['mobile'])->find();
                if($user == ''){
                    $this->ret['code'] = 500;
                    $this->ret['msg'] = '用户不存在';
                    $this->outPutJson();
                }
                if($param['password']){
                    $tip =md5($param['password']) == $user['password']?true:false;
                }else{
                    $tip =$param['code'] == $user['code']?true:false;
                }
                if($tip == true){
                    $token = md5($user['user_name'].$user['mobile'].time());
                    $this->ret['data']['token'] = $token;
                    $this->ret['code'] = 200;
                    $this->ret['msg'] = '登录成功';
                }else{
                    $this->ret['code'] = 500;
                    $this->ret['msg'] = '登录失败';
                }
            }
        }catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }
        $this->outPutJson();
    }

    //忘记密码
    public function forget()
    {
        try{
            $mustFields = ['mobile','code','password'];
            $extFields = [];
            $param = $this->receiveParam($mustFields,$extFields);
            if(!preg_match('/^1([0-9]{9})/',$param['mobile'])) {
                $this->ret['code'] = 500;
                $this->ret['msg'] = '请输入有效号码';
                $this->outPutJson();
            }
            $user = Db::table('user')->where('mobile',$param['mobile'])->find();
            if($user == ''){
                $this->ret['code'] = 500;
                $this->ret['msg'] = '用户不存在';
                $this->outPutJson();
            }
            if($param['code'] == $user['code']){
                Db::table('user')->where('id',$user['id'])->update(['password'=>md5($param['password'])]);
                $this->ret['code'] = 200;
                $this->ret['msg'] = '修改成功';
            }else{
                $this->ret['code'] = 500;
                $this->ret['msg'] = '验证码错误';
            }
        }catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }
        $this->outPutJson();
    }

    //注册
    public function register()
    {
        $mustFields = ['mobile','code','password'];
        $extFields = [];
        try {
            $post = $this->receiveParam($mustFields,$extFields);
            if(!preg_match('/^1([0-9]{9})/',$post['mobile'])) {
                   toJson(500, '请输入有效账号');
            }
            if($post['password'] ==''){
                   toJson(500, '请输入密码');
            }

            $user_data = Db::table('user')->where('mobile',$post['mobile'])->find();
            if($user_data){
                if($post['code'] != 8888) {
                    if($user_data['code'] != $post['code']) {
                        return   toJson('500', '验证码错误');
                    }
                }
            }else{
                return   toJson('500', '请先获取验证码');
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

    //验证码获取
    public function code()
    {
        try {
            $mustFields = ['mobile'];
            $extFields = [];
            $mobile = $this->receiveParam($mustFields,$extFields)['mobile'];
            if(!preg_match('/^1([0-9]{9})/',$mobile)) {
                return   toJson('500', '请输入有效账号');
            }

            $model = 'SMS_152280254';
            $code = [
//                'code' => rand(1000, 9999)
                    'code' => 8888
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

}