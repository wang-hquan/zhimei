<?php


namespace app\admin\controller;


use app\admin\library\BaseController;
use app\admin\model\TjGoodsModel;

class TjGoods extends BaseController
{
    public $searchFields = ['id','type'];
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
        $data['lists'] =  $this->TjGoodsModel->diySelect($condition)->select();
        $data['total'] =  $this->TjGoodsModel->diyCount($condition)->count();
        $this->assembleTableData('200', 'success', $data);
        $this->outPutJson();
    }

    //查询单个详情
    public function getDataById()
    {
        $post = $this->request->post('id');
        $data =   $this->TjGoodsModel->where('id',$post)->find();
        $data['img'] = explode('--',$data['img']);
        $this->ret['code'] = 200;
        $this->ret['data']= $data;
        $this->ret['msg'] = 'success';
        $this->outPutJson();
    }

    //删除
    public  function delete()
    {
        try {
            $post = $this->request->post('id');
            $this->TjGoodsModel->destroy($post);
            $this->ret['code'] = 200;
            $this->ret['msg'] = 'success';
        } catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }
        $this->outPutJson();
    }

    // 修改
    public function  edit()
    {
        $mustFields = ['id','goods_name','type','img','goods_price'];
        $extFields = ['goods_brief','goods_item','goods_matters','goods_desc','is_on_sale','is_tuijian'];

        try {
            $param = $this->receiveParam($mustFields, $extFields);
            $param['img'] = implode('--',$param['img']);
            $rec = TjGoodsModel::get(['id' => $param['id']]);
            foreach ( $param as $k => $v ) {
                $rec->$k = $v;
            }
            if ($rec->save()) {
                $this->ret['code'] = 200;
                $this->ret['msg'] = '编辑成功';
            } else {
                $this->ret['code'] = 500;
                $this->ret['msg'] = '编辑失败';
            }

        } catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }
        $this->outPutJson();

    }

    //添加
    public function add()
    {
        $mustFields = ['goods_name','type','img','goods_price'];
        $extFields = ['goods_brief','goods_item','goods_matters','goods_desc','is_on_sale','is_tuijian'];
        try {
            $param = $this->receiveParam($mustFields, $extFields);
            $param['img'] = implode('--',$param['img']);
            $param['create_time'] = date('Y-m-d H:i:s');
            if ($this->TjGoodsModel->save($param)) {
                $this->ret['code'] = 200;
                $this->ret['msg'] = '添加成功';
            } else {
                $this->ret['code'] = 500;
                $this->ret['msg'] = '添加失败';
            }
        } catch (\Exception $ex) {
            $this->ret['code'] = 500;
            $this->ret['msg'] = $ex->getMessage();
        }
        $this->outPutJson();
    }
}