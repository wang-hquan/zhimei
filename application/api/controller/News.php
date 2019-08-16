<?php

namespace app\api\controller;

use think\Controller;
use think\Db;

class News extends Controller
{
    //添加新闻
    public function add_news()
    {
        try {
            $post = $this->request->param();
            $param = [
                'news_name' => $post['news_name'],
                'type' => $post['type'],
                'brief' => $post['brief'],
                'desc' => $post['desc'],
                'create_time' => date('Y-m-d H:i:s', time())
            ];
            Db::table('news')->insert($param);
            return toJson('200', '添加成功');
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '新增失败', $data);
        }
    }

    //查询doctor列表
    public function news_list()
    {
        try {
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $goods_arr = Db::table('news')
                ->where('status', 1)
                ->page($page, $length)
                ->order('create_time', 'desc')
                ->select();
            return toJson('200', '查询成功', $goods_arr);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }
}