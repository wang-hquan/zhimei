<?php


namespace app\app\controller;

use app\admin\model\TjGoodsModel;

class TjGoods extends Base
{
    public $searchFields = ['id','type','is_tuijian'];
    public $TjGoodsModel = [];

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->TjGoodsModel = new TjGoodsModel();
    }

    //获取列表
    public function getData()
    {
        $condition = $this->getPageRows();
        $condition['where'] = $this->filterSearchFields($this->searchFields);
        $condition['field']= 'id,goods_name,type,img,goods_price,goods_brief,goods_item,goods_matters';
        $condition['order'] = ['create_time'=>'desc'];
        $result =  $this->TjGoodsModel->diySelect($condition)->select();
        foreach ( $result as $k => &$v)
        {
            $v['img'] = explode('--',$v['img']);
            $v['goods_item'] = explode('--',$v['goods_item']);
            $v['goods_matters'] = explode('--',$v['goods_matters']);
        }
        $data['lists'] = $result;
        $data['total'] =  $this->TjGoodsModel->diyCount($condition)->count();
        $this->assembleTableData('200', 'success', $data);
        $this->outPutJson();
    }

    //查询单个详情
    public function getDataById()
    {
        $post = $this->request->post('id');
        $data =   $this->TjGoodsModel
            ->field('id,goods_name,type,img,goods_price,goods_brief,goods_item,goods_matters,goods_desc')
            ->where('id',$post)->find();
        if($data == ''){
            $this->ret['code'] = 500;
            $this->ret['msg'] = '商品不存在';
            $this->outPutJson();
        }
        $data['img'] = explode('--',$data['img']);
        $data['goods_item'] = explode('--',$data['goods_item']);
        $data['goods_matters'] = explode('--',$data['goods_matters']);
        $this->ret['code'] = 200;
        $this->ret['data']= $data;
        $this->ret['msg'] = 'success';
        $this->outPutJson();
    }
}