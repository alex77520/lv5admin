<?php

/**
 * 管理员
 * @filename  AdminGroupController
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-14 18:20:12
 * @version   SVN:$Id:$
 */

namespace App\Http\Controllers\Admin;

use App\Models\Position;

class AdminUserController extends Controller
{

    public $M;

    public function __construct()
    {
        parent::__construct();
        $this->M = m('AdminUser');
    }


    //列表
    public function lists()
    {

        $where = [];

        if (request('title')) {
            $where[] = ['title', 'like', '%' . request('title') . '%'];
        }
        if (request('type')) {
            $where[] = ['type', request('type')];
        }
        if (request('status')) {
            $where[] = ['status', request('status')];
        }

        $lists = $this->M->getLists($where);
        return $this->view(compact('lists'));

    }

    //详情
    public function info()
    {

        $info = $this->M->find(request('id'));
        if ($info) {
            $groups = m('AdminGroupAccess')->getAdminGroupAccess($info->id, 'admin_id');
            if ($groups) {
                $info['group_ids'] = implode(',', array_column($groups, 'id'));
            }
        }
        return $this->view(compact('info'));

    }

    //添加
    public function add()
    {
        if ($this->storage()) {
            return $this->success('添加成功', '/'.$this->c.'/lists');
        } else {
            return $this->error();
        }
    }
    //修改
    public function edit()
    {
        if ($this->storage()) {
            return $this->success('修改成功', '/'.$this->c.'/lists');
        } else {
            return $this->error();
        }
    }

    /*
     * 存储
     */
    private function storage()
    {
        $data = request('info');

        if ($id=request('id')) {
            $rs = $this->M->where('id', $id)->update($data);
            $admin_id = $id;
        } else {
            //添加
            if(m('AdminUser')->where('name',$data['name'])->value('id')){
                return false;
            }
            $this->validate(request(), $this->M->rules, $this->M->messages);
            $data['password'] = bcrypt($data['password']);
            $rs = $this->M->create($data);
            $admin_id = $rs->id;
        }

        if(request('group_ids')){
            m('AdminGroupAccess')->store($admin_id, request('group_ids'));
        }else{
            m('AdminGroupAccess')->del($admin_id);
        }
        return $rs;
    }


    //修改密码
    public function changePwd()
    {
        $info = $this->M->find(request('id'));

        if (!$info) {
            return $this->error('非法请求');
        }

        if (request('password')) {
            $this->validate(request(), [
                'password' => 'required|min:3|max:20|confirmed',
            ], [
                'password.required' => '密码不能为空',
                'password.confirmed' => '密码与确认密码不一致'
            ]);

            $this->M->where('id', request('id'))->update(['password' => bcrypt(request('password'))]);

            return $this->success('修改成功', '/'.$this->c.'/lists');
        } else {
            return $this->view(compact('info'));
        }
    }


}
