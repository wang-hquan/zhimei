<?php


namespace app\api\controller;

use think\Db;

class Info extends Base
{
    //查看个人信息
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

    //修改个人信息
    public function change()
    {
        try{
            $token =  $this->request->header('token');
            $post = $this->request->param();
            Db::table('user')->where('token',$token)->update($post);
            return toJson('200', '修改成功');
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '修改失败', $data);
        }
    }

    //添加受检人
    public function add_member()
    {
        $post = $this->request->param();
        $validate = new \app\api\validate\Info();
        if (!$validate->check($post)) {
           return toJson('500',$validate->getError());
        }
        $token = $this->request->header('token');
        $user_data = Db::table('user')->where('token', $token)->find();

        $post['city_num'] = implode('--',$post['city_num']);
        $post['user_id'] =$user_data['id'];
        $post['create_time'] =  date('Y-m-d H:i:s',time());
        Db::table('tj_member')->insert($post);
    }

    //查询受检人
    public function member_list()
    {
        $token = $this->request->header('token');
        $user_data = Db::table('user')->where('token', $token)->find();
        $post = $this->request->param();
        $length = $post['length'];
        $member_list = Db::table('tj_member')
            ->where('user_id',$user_data['id'])
            ->paginate($length)
            ->toarray();
        foreach ($member_list['data'] as $k => &$v){
            $v['city_num'] = explode('--',$v['city_num']);
        }
        return toJson('200','查询成功',$member_list);
    }

}