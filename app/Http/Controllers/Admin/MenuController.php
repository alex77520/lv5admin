<?php
/**
 *
 * @filename  MenuController.php
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017/8/21 14:33
 */
namespace App\Http\Controllers\Admin;
class MenuController extends Controller{
    public function __construct()
    {
        parent::__construct();
        $this->M = m('Menu');
    }


    public function lists(){
        $where=[];
        if(request('status')){
            $where[]=['status',request('status')];
        }
        if(request('write_log')){
            $where[]=['write_log',request('write_log')];
        }
        if(request('name')){
            $where[]=['name','like','%'.request('name').'%'];
        }
        $lists = $this->M->getMenuList($where);
        foreach ($lists as $k => $v) {
            $lists[$k]['name'] = $v['level'] == 0 ?  $v['name']  : '├─' . $v['name'];
            $lists[$k]['name'] = str_repeat("│        ", $v['level']) . $lists[$k]['name'];

        }
        return $this->view(compact('lists'));
    }

    public function info(){
        $info = $this->M->find(request('id'));
        $menus = m('Menu')->selectMenu();
        return $this->view(compact('info','menus'));
    }

    public function add(){
        $this->validate(request(), $this->M->rules, $this->M->messages);
        $params = request($this->M->fillable); //可以添加或修改的参数

        if($params['parentid']===null){
            $params['parentid']=0;
        }


        $res = $this->M->create($params);


        if($res->a=='lists'){
            $params['parentid']=$res->id;
            $params['icon']='';
            $params['status']=2;

            $params['name']='详情';
            $params['a']='info';
            $this->M->create($params);

            $params['name']='添加';
            $params['a']='add';
            $this->M->create($params);

            $params['name']='修改';
            $params['a']='edit';
            $this->M->create($params);

            $params['name']='删除';
            $params['a']='del';
            $this->M->create($params);


        }
        return $this->success('添加成功','/menu/lists');
    }

    public function edit(){
        $this->validate(request(), $this->M->rules, $this->M->messages);
        $params = request($this->M->fillable); //可以添加或修改的参数
        if($params['parentid']===null){
            $params['parentid']=0;
        }
        $rs = $this->M->where('id', request('id'))->update($params);
        if ($rs) {
            return $this->success('修改成功', '/'.$this->c.'/lists');
        } else {
            return $this->error();
        }
    }
    //删除
    public function del()
    {
        $id = request('id');
        $this->M->where('id', $id)->delete();
        $this->M->where('parentid',$id)->delete();
        return $this->success();
    }

    //排序
    public function setListorder(){
        $data = request('listorder');
        foreach($data as $k=>$v){
            $this->M->where('id',$k)->update(['listorder'=>$v]);
        }
        return $this->success();
    }
}