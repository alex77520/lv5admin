<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $table = 'admin_user';
    public $status_arr = [1 => '正常', 2 => '禁用'];
    public $level_arr = [1 => '普通', 2 => '主管',3 => '经理'];
    public $dateFormat = 'U';
    public $timestamps = true;
    protected $guarded = []; //不可以注入

    public $messages = [
        'info.name.required' => '名不能为空',
    ];
    public $rules = [
        'info.name' => 'required|string|max:100|min:2',
        'info.password' => 'required|min:5|max:10',
    ];

    /**
     * 获取用户
     * @param type $where
     * @return type
     */
    public function getLists($where)
    {
        $res = static::where($where)->orderBy('id', 'desc')->paginate(20);
        foreach ($res as $k => $v) {
            if ($tmp = m('AdminGroupAccess')->getAdminGroupAccess($v['id'])) {
                $res[$k]['groups'] = implode(',', array_column($tmp, 'name'));
            }

        }
        return $res;
    }

    /**
     * 获取管理员数组 id=>realname
     * @return type
     */
    public function getIdName()
    {
        return static::pluck('realname', 'id')->toArray();
    }

    /**
     * 通过ID获取字段名称
     * @param type $id
     */
    public function getFieldValue($id)
    {
        return static::where('id', $id)->value('realname');

    }
}
