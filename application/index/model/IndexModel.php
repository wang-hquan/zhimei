<?php
namespace app\index\model;

use think\Model;

class IndexModel extends Model
{
    protected $table = 'news';
    public function diySelect()
    {
        $this->page(1);
        $this->limit(2);
        $sql = $this->select(false);
        echo  $sql;
    }
}