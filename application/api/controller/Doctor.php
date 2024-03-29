<?php


namespace app\api\controller;
use think\Controller;
use think\Db;

class Doctor extends Controller
{
    //添加doctor
    public function add_doctor()
    {
        try {
            $post = $this->request->param();
            $param = [
                'doctor_name' => $post['doctor_name'],
                'type' => $post['type'],
                'img' => $post['img'],
                'brief' => $post['brief'],
                'doctor_item' => implode('--', $post['doctor_item']),
                'desc' =>  $post['desc'],
                'status' =>  $post['status'],
                'create_time' => date('Y-m-d H:i:s', time())
            ];
            Db::table('doctor')->insert($param);
            return toJson('200', '添加成功');
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '新增失败', $data);
        }
    }

    //查询doctor列表
    public function doctor_list()
    {
        try {
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $goods_arr = Db::table('doctor')
                ->where('status', 1)
                ->page($page, $length)
                ->order('create_time', 'desc')
                ->select();
            foreach ($goods_arr as $k => &$v) {
                $v['doctor_item'] = explode('--', $v['doctor_item']);
            }
            return toJson('200', '查询成功', $goods_arr);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }
}