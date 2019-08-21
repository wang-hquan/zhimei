<?php


namespace app\admin\library;
use think\Model;

abstract class BaseModel extends Model
{
    public function scopeDiySelect($query, $condition)
    {
        if (isset($condition['where'])) {
            $query->where($this->formatWhere($condition['where']));
        }
        if (isset($condition['field']) && !empty($condition['field'])) {
            $query->field($condition['field']);
        }
        if (isset($condition['group']) && !empty($condition['group'])) {
            $query->group($condition['group']);
        }
        if (isset($condition['order']) && !empty($condition['order'])) {
            $query->order($condition['order']);
        }
        if (isset($condition['page']) && !empty($condition['page'])) {
            $query->page($condition['page']);
        }
        if (isset($condition['limit']) && !empty($condition['limit'])) {
            $query->limit($condition['limit']);
        }
    }

    public function scopeDiyCount($query, $condition)
    {
        if (isset($condition['where'])) {
            $query->where($this->formatWhere($condition['where']));
        }
        if (isset($condition['field']) && !empty($condition['field'])) {
            $query->field($condition['field']);
        }
        if (isset($condition['group']) && !empty($condition['group'])) {
            $query->group($condition['group']);
        }
        if (isset($condition['order']) && !empty($condition['order'])) {
            $query->order($condition['order']);
        }
    }
}