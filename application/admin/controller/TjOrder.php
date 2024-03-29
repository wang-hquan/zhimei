<?php


namespace app\admin\controller;


use app\admin\library\BaseController;
use app\admin\model\TjOrderModel;

class TjOrder extends BaseController
{
    public $searchFields = ['id','order_status'];
    public $TjOrderModel = [];

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->TjOrderModel = new TjOrderModel();
    }

    //获取列表
    public function getData()
    {
        $condition = $this->getPageRows();
        $condition['where'] = $this->filterSearchFields($this->searchFields);
        $data['lists'] =  $this->TjOrderModel->diySelect($condition)->select();
        $data['total'] =  $this->TjOrderModel->diyCount($condition)->count();
        $this->assembleTableData('200', 'success', $data);
        $this->outPutJson();
    }

    //查询单个详情
    public function getDataById()
    {
        $post = $this->request->post('id');
        $data =   $this->TjOrderModel->where('id',$post)->find();
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
            $this->TjOrderModel->destroy($post);
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
        $mustFields = ['id','user_id','order_status','order_sn','goods_price','pay_fee','goods_num'];
        $extFields = ['goods_name','goods_img','goods_item','address'];

        try {
            $param = $this->receiveParam($mustFields, $extFields);
            $rec = TjOrderModel::get(['id' => $param['id']]);
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
        $mustFields = ['user_id','order_status','order_sn','goods_price','pay_fee','goods_num'];
        $extFields = ['goods_name','goods_img','goods_item','address'];
        try {
            $param = $this->receiveParam($mustFields, $extFields);
            $param['create_time'] = date('Y-m-d H:i:s');
            if ($this->TjOrderModel->save($param)) {
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