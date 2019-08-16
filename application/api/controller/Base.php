<?php


namespace app\api\controller;


use think\App;
use think\Controller;
use think\Db;

class Base extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->isLogin();
    }

    public function isLogin()
    {
        $token =  $this->request->header('token');
        $user_data =  Db::table('user')->where('token',$token)->find();
        if(!$user_data){
            echo  toJson('300', '请重新登录'); exit;
        }
    }
}