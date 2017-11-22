<?php

/**
  * 
  * @filename  Test
  * @author    Zhenxun Du <5552123@qq.com> 
  * @date      2017-8-4 16:18:43  
  * @version   SVN:$Id:$ 
  */
namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class TestFacade extends Facade{
    protected static function getFacadeAccessor(){
	//return \App\Model\Testa::class;//直接使用真名
	return 'TestModel';//使用别名
	//return 'testRegister';//自动注册容器中的 key;
    }
}