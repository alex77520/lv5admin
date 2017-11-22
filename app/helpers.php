<?php

use Illuminate\Support\HtmlString;
use Illuminate\Container\Container;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\Cookie\Factory as CookieFactory;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Broadcasting\Factory as BroadcastFactory;

/**
 * 自定义函数库
 * @filename  helpers
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017-8-9 17:08:32
 * @version   SVN:$Id:$
 */
function m($model)
{
    static $arr = [];
    $path = "\\App\\Models\\" . $model;
    if (!isset($arr[$path])) {
        $class = new ReflectionClass($path);
        $arr[$path] = $class->newInstance();
    }
    return $arr[$path];
}


/**
 * 数组转树
 * @param type $list
 * @param type $root
 * @param type $pk
 * @param type $pid
 * @param type $child
 * @return type
 */
function list_to_tree($list, $root = 0, $pk = 'id', $pid = 'parentid', $child = '_child')
{
    // 创建Tree
    $tree = array();
    if (is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] = &$list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = 0;
            if (isset($data[$pid])) {
                $parentId = $data[$pid];
            }
            if ((string)$root == $parentId) {
                $tree[] = &$list[$key];
            } else {
                if (isset($refer[$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$list[$key];
                }
            }
        }
    }
    return $tree;
}

function node_tree($arr, $id = 0, $level = 0)
{
    static $array = array();
    foreach ($arr as $v) {
        if ($v['parentid'] == $id) {
            $v['level'] = $level;
            $array[] = $v;
            node_tree($arr, $v['id'], $level + 1);
        }
    }
    return $array;
}


/**
 * 发邮件
 * @param string $subject 主题
 * @param string $str 内容
 * @param string $to 收件人 多人以 逗号 分隔
 * @param string $attach 附件 多个以 逗号 分隔
 * @param string $blade 模板
 */
function send_mail($subject, $str, $to = '', $attach = '', $blade = 'emails.mail')
{
    if (!$to) {
        $to_arr = explode(',',config('mail.to_email'));
    }else{
        if(is_array($to)){
            $to_arr = $to;
        }else{
            $to_arr = explode(',', $to);
        }
    }


    if ($attach) {
        if(is_array($attach)){
            $attach_arr = $attach;
        }else{
            $attach_arr = explode(',', $attach);
        }
    }

    \Mail::send($blade, ['str' => $str], function ($message) use ($subject, $to_arr, $attach_arr) {

        $message->subject($subject.'[' . config('app.env') . ']');

        foreach ($to_arr as $mail) {
            $message->to($mail);
        }

        if (count($attach_arr) > 0) {
            foreach ($attach_arr as $file) {
                $message->attach($file);
            }
        }
    });
}




function arr2str($arr,$str=''){

    if(is_array($arr)){
        foreach($arr as $k=>$v){
            if(is_array($v)){
                return arr2str($v,$str);
            }else{
                $str.="<p>{$k}-->{$v}</p>";
            }
        }
    }
    return $str;
}