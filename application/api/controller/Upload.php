<?php

namespace app\api\controller;

use think\Controller;

class Upload extends Controller
{
    private $image_suffix = ['bmp', 'jpg', 'jpeg','png', 'mp4','tif', 'gif', 'pcx', 'tga', 'exif', 'fpx', 'svg', 'psd', 'cdr', 'pcd', 'dxf', 'ufo', 'eps', 'ai', 'raw', 'wmf', 'webp'];
    private $image_size = 2097152;// 2M
    private $Http='http://www.zhimei.com/img/';

    public function images()
    {
        try {
            if (!$this->request->file()) {
                return toJson('500','上传失败', '请选择文件上传');
            }
            $file = $this->request->file('file');
            $file->validate(['size' => $this->image_size, 'ext' => $this->image_suffix]);
            $upload = $file->move( APP_PATH.'/img');
            if($upload) {
                $url =$this->Http.$upload->getSaveName();
                return toJson('200','success',$url);
            }else{
                return toJson('500','上传失败', $file->getError());
            }
        } catch (\Exception $ex) {
            return toJson('500','上传失败',$ex->getMessage());
        }
    }
}