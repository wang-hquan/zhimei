<?php


namespace app\api\controller;


use think\Db;

class Order extends Base
{
    public function order_info()
    {
        try {
            $token = $this->request->header('token');
            $user_data = Db::table('user')->where('token', $token)->find();
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $order_list = Db::table('tj_order')
                ->where('user_id', $user_data['id'])
                ->where('order_status', $post['order_status'])
                ->where('is_del', 0)
                ->page($page, $length)
                ->field('id,order_sn,order_status,goods_name,goods_img,goods_item,goods_price,goods_num,pay_fee,pay_time')
                ->select();
            $count = Db::table('tj_order')
                ->where('user_id', $user_data['id'])
                ->where('order_status', $post['order_status'])
                ->where('is_del', 0)
                ->count();
            foreach ($order_list as $k => &$v) {
                $v['goods_item'] = explode('--', $v['goods_item']);
            }
            $data['list'] = $order_list;
            $data['count'] = $count;
            $data['page_num'] = ceil($count/$length);
            return toJson('200', '查询成功', $data);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }

    public function all_order()
    {
        try {
            $token = $this->request->header('token');
            $user_data = Db::table('user')->where('token', $token)->find();
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $order_list = Db::table('tj_order')
                ->where('user_id', $user_data['id'])
                ->where('is_del', 0)
                ->field('id,order_sn,order_status,goods_name,goods_img,goods_item,goods_price,goods_num,pay_fee,pay_time')
                ->page($page, $length)
                ->select();
            $count = Db::table('tj_order')
                ->where('user_id', $user_data['id'])
                ->where('is_del', 0)
                ->count();
            foreach ($order_list as $k => &$v) {
                $v['goods_item'] = explode('--', $v['goods_item']);
            }
            $data['count'] = $count;
            $data['list'] = $order_list;
            $data['page_num'] = ceil($count/$length);
            return toJson('200', '查询成功', $data);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }
}