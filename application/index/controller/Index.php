<?php
namespace app\index\controller;

use app\index\model\IndexModel;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $data =    new IndexModel();
        $data->diySelect();
    }
}
