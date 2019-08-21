<?php


namespace app\admin\model;

use app\admin\library\BaseModel;

class DoctorModel extends BaseModel
{
    protected $table = 'doctor';

    public  function formatWhere(array $where = null  ){
        $result = [];
        if ( $where ) {
            foreach ( $where as $k => $v ) {
                switch ( $k ) {
                    case 'id':
                        $result[$k] = ['=', $v];
                        break;
                }
            }
        }
        return $result;
    }
}