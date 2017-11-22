<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class SiteController extends Controller
{
    public $M;

    public function __construct()
    {
        parent::__construct();
        $this->M = m('Site');
    }

    //列表
    public function lists()
    {
        $where = [];

        $lists = $this->M->where($where)->orderBy('id', 'desc')->paginate(20);

        if (request()->ajax()) {
            return $lists;
        } else {
            return $this->view(compact('lists'));

        }

    }

    //详情
    public function info()
    {
        $info = $this->M->find(1);

        return $this->view(compact('info'));
    }

    //添加
    protected function add()
    {
        if ($this->storage()) {
            return $this->success('添加成功');
        } else {
            return $this->error();
        }
    }

    //修改
    protected function edit()
    {
        if ($this->storage()) {
            return $this->success('修改成功');
        } else {
            return $this->error();
        }
    }
    //存储
    public function storage(){

        $info = request('info');
        $id = request('id');
        //修改
        if ($id) {
            $rs = $this->M->where('id', $id)->update($info);
        } else {
            //添加
            $rs = $this->M->create($info);
        }
        return $rs;
    }



}
