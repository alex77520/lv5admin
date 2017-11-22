<?php

/**
 * 后台总控制器
 * @filename  Controllers
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-14 21:55:17
 * @version   SVN:$Id:$
 */

namespace App\Http\Controllers\Home;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;


class Controller extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    protected $login_user;
    protected $m = 'admin';//模块
    protected $c, $a, $q, $path_info;
    protected $menu_info;//菜单详情

    //初始化
    public function __construct()
    {
        $this->middleware(function ($request, $next) {


            return $next($request);
        });

    }

    //获取请求信息 模块,控制器,方法
    private function _getPathInfo()
    {
        $request_uri = explode('?', $_SERVER['REQUEST_URI']);

        if (isset($request_uri[1])) {
            $this->q = $request_uri[1];
        }

        $this->path_info = trim($request_uri[0], '/');

        if ($this->path_info) {
            $mca = explode('/', $this->path_info);

            if (count($mca) == 3) {
                list($this->m, $this->c, $this->a) = $mca;
            } elseif (count($mca) == 2) {
                $this->m = 'admin';
                list($this->c, $this->a) = $mca;
            } elseif (count($mca) == 1) {
                $this->m = 'admin';
            }

        } else {
            $this->m = 'admin';
            $this->c = 'adminHome';
            $this->a = 'publicIndex';
        }

    }

    //检测权限
    private function _checkRole()
    {

        //公开菜单
        if (preg_match('/^public/', $this->a)) {
            return true;
        }
        //超级管理员请求
        if ($this->login_user->is_super == 1) {
            return true;
        }

        //没有分配菜单
        $my_menu = m('Menu')->myMenu(0);
        if (!$my_menu || !isset($this->menu_info->id)) {
            return false;
        }
        //访问菜单不在自己菜单中
        if (!in_array($this->menu_info->id, array_column($my_menu, 'id'))) {
            return false;
        }

        return true;


    }

    //写日志
    private function _saveLog($menus_id)
    {
        $data = [];
        $data['menu_id'] = $menus_id;
        $data['querystring'] = $this->q;
        $data['admin_id'] = $this->login_user->id;
        $data['ip'] = request()->ip();
        if (request()->method() == 'POST') {
            $data['data'] = json_encode(request()->all());
        }
        m('AdminLog')->create($data);
    }

    //返回视图
    public function view($data = [], $tpl = '')
    {
        if (empty($tpl)) {
            $tpl = $this->m . '/' . $this->c . '/' . $this->a;
        }
        $data['_m'] = $this->m;
        $data['_c'] = $this->c;
        $data['_a'] = $this->a;
        $data['login_user'] = $this->login_user;
        $data['menu_info'] = $this->menu_info;
        return view($tpl, $data);
    }


    //公用添加,可覆盖
    protected function add()
    {
        if ($this->storage()) {
            return $this->success('添加成功', '/' . $this->c . '/lists');
        } else {
            return $this->error();
        }
    }

    //公用修改,可覆盖
    protected function edit()
    {
        if ($this->storage()) {
            return $this->success('修改成功', '/' . $this->c . '/lists');
        } else {
            return $this->error();
        }
    }

    //公用存储,可覆盖
    private function storage()
    {
        //dd(request());
        $this->validate(request(), $this->M->rules, $this->M->messages);
        $params = request($this->M->fillable); //可以添加或修改的参数

        $params['admin_id'] = $this->login_user->id;

        if (request('id')) {
            $rs = $this->M->where('id', request('id'))->update($params);
        } else {
            $rs = $this->M->create($params);
        }
        return $rs;
    }

    // 公用状态禁用,不爽请覆盖
    protected function status()
    {
        $info = $this->M->find(request('id'));
        if (!$info) {
            return $this->error('找不到这条信息');
        }
        $info->status = $info->status == 1 ? 2 : 1;
        $info->save();
        return $this->success();
    }

    //公用删除,不爽请覆盖
    protected function del()
    {
        dd('禁止删除');
        $this->M->where('id', request('id'))->delete();
        return $this->success();
    }

}
