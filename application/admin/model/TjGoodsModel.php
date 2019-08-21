<?php


namespace app\admin\model;


use app\admin\library\BaseModel;

class TjGoodsModel extends BaseModel
{
    protected $table = 'tj_goods';
    public  function formatWhere(array $where = null  ){
        $result = [];
        if ( $where ) {
            foreach ( $where as $k => $v ) {
                switch ( $k ) {
                    case 'id':
                        $result[$k] = ['=', $v];
                        break;
                    case 'type':
                        $result[$k] = ['=', $v];
                        break;
                }
            }
        }
        return $result;
    }
}