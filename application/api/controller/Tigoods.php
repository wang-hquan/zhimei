<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\db\Query;

class Tigoods extends Controller
{
    //新增商品
    public function add_goods()
    {
        try {
            $post = $this->request->param();
            $param = [
                'goods_name' => $post['goods_name'],
                'type' => $post['type'],
                'img' => implode('--', $post['img']),
                'goods_price' => $post['goods_price'],
                'goods_brief' => $post['goods_brief'],
                'goods_item' => implode('--', $post['goods_item']),
                'goods_matters' => implode('--', $post['goods_matters']),
                'goods_desc' => $post['goods_desc'],
                'is_on_sale' => $post['is_on_sale'],
                'create_time' => date('Y-m-d H:i:s', time())
            ];
            Db::table('tj_goods')->insert($param);
            return toJson('200', '添加成功');
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '新增失败', $data);
        }
    }

    //商品列表
    public function goods_list()
    {
        try {
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $type = $post['type'];
            $goods_arr = Db::table('tj_goods')
                ->where('type', $type)
                ->where('is_on_sale', 1)
                ->page($page, $length)
                ->order('create_time', 'desc')
                ->select();
            foreach ($goods_arr as $k => &$v) {
                $v['img'] = explode('--', $v['img']);
                $v['goods_item'] = explode('--', $v['goods_item']);
                $v['goods_matters'] = explode('--', $v['goods_matters']);
            }
            return toJson('200', '查询成功', $goods_arr);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }

    //推荐商品
    public function best()
    {
        try {
            $post = $this->request->param();
            $page = $post['page'];
            $length = $post['length'];
            $goods_arr = Db::table('tj_goods')
                ->where('is_on_sale', 1)
                ->where('is_tuijian', 1)
                ->page($page, $length)
                ->order('create_time', 'desc')
                ->select();
            foreach ($goods_arr as $k => &$v) {
                $v['img'] = explode('--', $v['img']);
                $v['goods_item'] = explode('--', $v['goods_item']);
                $v['goods_matters'] = explode('--', $v['goods_matters']);
            }
            return toJson('200', '查询成功', $goods_arr);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }
    }

    //商品分类接口
    public function category()
    {
        $cat_arr =   Db::table('tj_category')
            ->where('status',1)
            ->select();
        return toJson('200','成功',$cat_arr);
    }

    //商品详情页
    public function goods()
    {
        $goods_id  =  $this->request->param( 'goods_id' );
        $data = Db::table('tj_goods')->where('id',$goods_id)
            ->field('id,goods_name,type,img,goods_price,goods_brief,goods_item,goods_matters,goods_desc')
            ->find();

        $param = [
            'id' => $data['id'],
            'goods_name' => $data['goods_name'],
            'type' => $data['type'],
            'img' => explode('--',$data['img']),
            'goods_price' => $data['goods_price'],
            'goods_brief' => $data['goods_brief'],
            'goods_item' =>  explode('--',$data['goods_item']),
            'goods_matters' => explode('--',$data['goods_matters']),
            'goods_desc' => $data['goods_desc'],
        ];
//        $data['goods_item'] = explode('--',$data['goods_item']);
//        $data['img'] = explode('--',$data['img']);
//        $data['goods_matters'] = explode('--',$data['goods_matters']);
//        return toJson('200','查询成功', $data);
        return toJson('200','查询成功', $param);
    }

    //搜索
    public function search()
    {
        $key = $this->request->param('key');
        $goods_arr = Db::table('tj_goods')->where('goods_name','like','%'.$key.'%')->select();
        foreach ($goods_arr as $k => &$v) {
            $v['img'] = explode('--', $v['img']);
            $v['goods_item'] = explode('--', $v['goods_item']);
            $v['goods_matters'] = explode('--', $v['goods_matters']);
        }
        return toJson('200','查询成功', $goods_arr);
    }

    //猜你想看
    public function guess_goods()
    {
        try{
            $post = $this->request->param();
            $type = $post['type'];
            $sql  =   'SELECT id,goods_name,type,img,goods_price,goods_brief,goods_item,goods_matters,goods_desc FROM tj_goods  where type = '.$type.' ORDER BY RAND() LIMIT 10' ;
            $arr = Db::query($sql);
            foreach ($arr as $k => &$v) {
                $v['img'] = explode('--', $v['img']);
                $v['goods_item'] = explode('--', $v['goods_item']);
                $v['goods_matters'] = explode('--', $v['goods_matters']);
            }
            return toJson('200','查询成功', $arr);
        } catch (\Exception $e) {
            $data = $e->getMessage();
            return toJson('500', '查询失败', $data);
        }

    }

}