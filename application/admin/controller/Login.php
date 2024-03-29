<?php

namespace app\admin\controller;
use app\admin\library\BaseController;
use app\admin\model\AdminUserModel;
use think\facade\Session;

class Login extends BaseController
{

    public $AdminUserModel = '';

    public function  initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->AdminUserModel =  new AdminUserModel();
    }

    public function doit()
    {
        $mustFields = ['uname','pwd'];
        $extFields = [];
        try {
            $param = $this->receiveParam($mustFields, $extFields);
            $uname = $param['uname'];
            $pwd = $param['pwd'];
            if ( empty($uname) || empty($pwd) ) {
                throw new \Exception('请把表单填写正确');
            }

            if ( strlen($pwd) !== 32 ) {
                throw new \Exception('密码格式错误');
            }

            $userInfo = $this->AdminUserModel->login($uname, $pwd);
            if ( empty($userInfo) ) {
                throw new \Exception('登录失败，请输入正确的用户名和密码');
            }
            $uInfo = [
                'id' => $userInfo['id'],
                'uname' => $userInfo['user_name'],
            ];
            $this->ret['code'] = 200;
            $this->ret['msg'] = '登录成功';
            $this->ret['data'] = $uInfo;

        } catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }

        if ( $this->ret['code'] == 200 ) {
            $this->_handleSessionData($userInfo);
        }
        $this->outPutJson(true, true);
    }

    public function checkLoginState()
    {
        if (empty(session('_logined.user'))) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = '登录状态失效';
            $this->ret['data'] = [];

        } else {
            $this->ret['code'] = 200;
            $this->ret['msg'] = '登录状态有效';
            $this->ret['data'] = [];
        }
        $this->outPutJson();
    }

    private function _handleSessionData($uinfo)
    {
        $uinfo = [
            'user' => [
                'id' => $uinfo['id'],
                'user' => $uinfo['user_name'],
            ],
        ];
        session('_logined',$uinfo);
    }

    public function logout()
    {
        Session::destroy();
        $this->ret['code'] = 200;
        $this->ret['msg'] = '退出登录';
        $this->outPutJson(true, true);
    }

}