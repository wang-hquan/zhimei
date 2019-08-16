<?php


namespace app\api\controller;


use think\Db;

class Info extends Base
{
    public function info()
    {
        try{
            $token =  $this->request->header('token');
            $data = Db::table('user')->where('token',$token)->find();
            return toJson('200','成功',$data);
        }catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }

    }

    public function change()
    {
        try{
            $token =  $this->request->header('token');
            $post = $this->request->param();
            Db::table('user')->where('id',$token)->update($post);
            return toJson('200', '修改成功');

        } catch (\Exception $e) {
        $data = $e->getMessage();
        return toJson('500', '修改失败', $data);
    }
    }
}