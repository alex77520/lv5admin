<?php

/**
 * 分组
 * @filename  AdminGroup
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-14 18:23:19
 * @version   SVN:$Id:$
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    protected $table = 'admin_group';
    public $dateFormat = 'U';
    public $timestamps = true;
    public $fillable = ['name', 'description','menus'];
    public $messages = [
        'name.required' => '名不能为空',
    ];
    public $rules = [
        'name' => 'required|string|max:100|min:2',
        'description' => 'required',
    ];

    public function getIdName()
    {
        return static::pluck('name', 'id')->toArray();
    }
}
