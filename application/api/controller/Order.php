<?php


namespace app\api\controller;


use think\Db;

class Order extends Base
{
//     生成订单
    public function add_order()
    {
        Db::startTrans();
        try{

            if(!$token = $this->request->header('token')){return toJson( '500','请登录');}

            $post =   $this->request->param('id');
            if($post == ''){return toJson( '500','请选择商品');}
            //生成订单号
            $order_sn = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $money = 0;


            foreach ($post as $k => $v){
                $goods =   Db::table('tj_goods')->where('id',$v['id'])->find();
                $money = $goods['goods_price'] * $v['num'] +$money;
            }

            $order_data =[
                'order_sn' =>123
            ];

            $result_id = Db::name('orders')->insertGetId($order_data);
            $order_goods['order_id'] = $result_id;
            if ($post['buy_status'] == 1){
                Db::name('orders')->where('order_id',$result_id)->setField('main_oid',$result_id);
            }
            $result = Db::name('order_goods')->insert($order_goods);


            Db::commit();
            $user_id = Db::table('user')->where('token', $token)->value('id');
        }catch (\Exception $e) {
            $data = $e->getMessage();
            Db::rollback();
            return toJson('500', '生成订单失败', $data);
        }
    }

    //订单状态列表
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

    //所有订单
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

    //体检购物车
    public function tj_goods_cart()
    {
        try{
            $token = $this->request->header('token');
            $user_data = Db::table('user')->where('token', $token)->find();
            $cart_arr = Db::table('tj_goods_cart')->where('user_id',$user_data['id'])->select();
            return toJson('200','查询成功',$cart_arr);
        }catch (\Exception $e){
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }

    //添加购物车
    public function add_goods_cart()
    {
        try{
            $token = $this->request->header('token');
            $user_data = Db::table('user')->where('token', $token)->find();
            $post = $this->request->param();
            $num = $post['goods_num'];
            if(Db::table('tj_goods_cart')->where('user_id',$user_data['id'])
                ->where('goods_id',$post['goods_id'])
                ->setInc('goods_num',$num)){;
            }else{
                $param = [
                    'user_id' => $user_data['id'],
                    'goods_id' =>$post['goods_id'],
                    'goods_name' =>$post['goods_name'],
                    'goods_img' =>$post['goods_img'],
                    'goods_price' =>$post['goods_price'],
                    'goods_num' =>$post['goods_num'],
                    'goods_brief' =>$post['goods_brief'],
                ];
                Db::table('tj_goods_cart')->insert($param);
            }
            return toJson('200', '添加成功');

        }catch (\Exception $e){
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }

    // 删除购物车商品
    public function del_goods_cart()
    {
        try{
            $id = $this->request->param('id');
            Db::table('tj_goods_cart')->delete($id);
            return toJson('200', '删除成功');
        }catch (\Exception $e){
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }
}