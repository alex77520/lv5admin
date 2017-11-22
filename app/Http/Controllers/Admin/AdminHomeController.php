<?php

/**
 *
 * @filename  UserHomeController
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-16 10:20:11
 * @version   SVN:$Id:$
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Hash;

class AdminHomeController extends Controller
{

    public $M;

    public function __construct()
    {
        parent::__construct();
        $this->M = m('AdminUser');
    }

    public function publicIndex()
    {
        return $this->view('','admin/adminHome/publicIndex');


    }

    /**
     * 个人修改资料
     */
    public function publicInfo()
    {
        $info = $this->M->find($this->login_user->id);

        if (request('id')) {
            //修改
            if ($info->id) {
                $params = request(['mobile', 'realname']); //可以添加或修改的参数

                $this->M->where('id', $info->id)->update($params);
            }
            return $this->success();
        } else {

            return $this->view(compact('info'));
        }
    }

    /**
     * 个人修改密码
     */
    public function publicChangePwd()
    {
        $info = $this->M->find($this->login_user->id);

        if (!$info) {
            return $this->error('操作非法');
        }

        if (request('id')) {
            $this->validate(request(), [
                'passwordOld' => 'required',
                'password' => 'required|min:3|max:20|confirmed',
            ], [
                'passwordOld.required' => '旧密码不能为空',
                'password.required' => '密码不能为空',
                'password.confirmed' => '密码与确认密码不一致',
            ]);
            //旧密码不正确
            if (!Hash::check(request('passwordOld'),$info->password)) {
                return $this->error('旧密码不正确');
            }

            $this->M->where('id', $info->id)->update(['password' => bcrypt(request('password'))]);
            return $this->success();
        } else {
            return $this->view(compact('info'));
        }
    }


}
