<?php

namespace app\admin\model;
use think\Model;

class AdminUserModel extends Model
{
    public $table = 'admin_user';

    public function login($uname, $pwd)
    {
        $rec = $this->where(['user_name'=>$uname,'status'=>1])->find();
        if (empty($rec)) {
            return false;
        }
        if ($pwd !==$rec['password']) {
            return false;
        }
        unset($rec['password']);
        return $rec;
    }
}