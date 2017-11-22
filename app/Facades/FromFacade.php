<?php

/**
 * 表单
 * @filename  FromFacade.php
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017/8/8 14:58
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FromFacade extends Facade {

    protected static function getFacadeAccessor() {
	return new \App\Extend\From(); //直接使用
    }

}
