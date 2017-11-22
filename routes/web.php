<?php


//前台
Route::get('/', 'Home\IndexController@index');
//后台使用
Route::get('/admin', 'Admin\LoginController@index');

if (!isset($_SERVER['argv'])) {
	$act = explode('?', $_SERVER['REQUEST_URI'])[0]; //请求

	if ($act != '/') {
		$method = strtolower($_SERVER['REQUEST_METHOD']); //方法
		$path = explode('/', trim($act, '/'));
		if(count($path)==3){
			Route::$method($act, ucfirst($path[0]).'\\' . ucfirst($path[1]) . 'Controller@' . $path[2]);
		}
	}
}
