<?php

/**
 * 会员
 * @filename  Member
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-9-15 18:23:19
 * @version   SVN:$Id:$
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    public $dateFormat = 'U';
    public $timestamps = true;
    protected $guarded = []; //不可以注入
    public $sex_arr = [1 => '男', 2 => '女'];
    public $status_arr = [1 => '正常', 2 => '黑名单'];

    public $messages = [
        'info.realname.required' => '名称不能为空',
        //'info.mobile.regex' => '手机号不能为空',
    ];
    public $rules = [
        'info.realname' => [
            'required',
            'string',
            'max:100',
            'min:2',
        ],
        'info.mobile'=>[
            'required',
            'regex:/1[3|8|4]{1}[\d]{9}$/',
            'unique:member,mobile,request("id")'
        ]
    ];

}
