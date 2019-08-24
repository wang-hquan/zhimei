<?php


namespace app\admin\model;
use app\admin\library\BaseModel;

class TjMemberModel extends BaseModel
{
    protected $table = 'tj_member';
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
                }
            }
        }
        return $result;
    }
}