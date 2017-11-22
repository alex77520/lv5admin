<?php

/**
 *
 * @filename  Login
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-14 21:55:17
 * @version   SVN:$Id:$
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use App\Extend\JumpAdmin;
class LoginController extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests,
        JumpAdmin;

    public function index()
    {
        if(isset(request()->user('admin')->id)){
            return redirect('admin/adminHome/publicIndex');
        }else{
            $info['misname'] = m('Site')->where('id',1)->value('misname');

            return view('admin.login.index',compact('info'));
        }

    }

    public function login()
    {

        $this->validate(request(), [
            'name' => 'required',
            'password' => 'required'

        ]);
        $params = request(['name', 'password']);

        $is_remember = boolval(request('is_remember'));
         //dd($params);
        if (\Auth::guard('admin')->attempt($params, $is_remember)) {

            if(request()->user('admin')->status==2){
                \Auth::guard('admin')->logout();
                //return $this->error('账号已停用','/login/index');
                return \Redirect::back()->withErrors('账号已停用');
            }
            return redirect('admin/adminHome/publicIndex');
        } else {
            return \Redirect::back()->withErrors('账号密码不匹配');
        }
    }

    public function logout()
    {
        \Auth::guard('admin')->logout();
        return redirect('admin/login/index');
    }

}
