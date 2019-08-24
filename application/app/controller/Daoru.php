<?php


namespace app\app\controller;
use think\Env;
use think\Controller;

class Daoru extends Controller
{
    public function daoru()
    {
        //上传excel文件
        $file = request()->file('excel');
        //将文件保存到public/uploads目录下面
        $info = $file->move( './uploads');
        if($info){
            //获取上传到后台的文件名
            $fileName = $info->getSaveName();
            //获取文件路径
            $data= new Env();
            $filePath = $data->get('root_path').'./'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.$fileName;
            //获取文件后缀
            $suffix = $info->getExtension();
            //判断哪种类型
            if($suffix=="xlsx"){
                $reader = \PHPExcel_IOFactory::createReader('Excel2007');
            }else{
                $reader = \PHPExcel_IOFactory::createReader('Excel5');
            }
        }else{
            $this->error('文件过大或格式不正确导致上传失败-_-!');
        }
        //载入excel文件
        $excel = $reader->load("$filePath",$encode = 'utf-8');
        //读取第一张表
        $sheet = $excel->getSheet(0)->toArray();
        print_r($sheet);exit;

    }
}