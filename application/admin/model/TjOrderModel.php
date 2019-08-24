<?php


namespace app\admin\model;


use app\admin\library\BaseModel;

class TjOrderModel extends BaseModel
{
    protected $table = 'tj_order';

    public function formatWhere(array $where = null ) {
        $result  = [];
        if ( $where ) {
            foreach ( $where as $k => $v ) {
                switch ( $k ) {
                    case 'id':
                        $result[] = [$k,'=', $v];
                        break;
                    case 'user_id':
                        $result[] = [$k,'=', $v];
                        break;
                    case 'order_status':
                        $result[] = [$k,'=', $v];
                        break;
                }
            }
        }
        return $result;
    }
}