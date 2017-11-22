@extends("admin.main")
@section("content")

    <div class="page-content">
        <div class="page-header">
            <h1>
                {{$menu_info->name or ''}}
                <span class="btn btn-sm btn-primary pull-right" onclick="javascript:window.location.href = 'info'">
            添加
            </h1>
        </div>

        <div class="operate panel panel-default">
            <div class="panel-body ">
                <form name="myform" method="GET" class="form-inline">

                    <div class="form-group select-input">
                        <div class="input-group">
                            <div class="input-group-addon">时间</div>
                            <input type="text" class="layui-input" id="start_time" placeholder="" name="start_time"  value="{{request('start_time')}}">
                        </div>

                        <div class="input-group" style="margin-left: 0;">
                            <div class="input-group-addon"> 至</div>
                            <input type="text" class="layui-input" id="end_time" placeholder="" name="end_time" value="{{request('end_time')}}">
                        </div>

                        <div class="input-group">
                            <div class="input-group-addon">手机号</div>
                            <input class="form-control" name="mobile" type="text" value="{{request('mobile')}}" >
                        </div>

                        <div class="input-group">
                            <div class="input-group-addon">性别</div>
                            {{From::select(m('Member')->sex_arr,request('sex'),'class="input-group-addon"  name="sex" ','--请选择--')}}
                        </div>

                        <div class="input-group">
                            <div class="input-group-addon">状态</div>
                            {{From::select(m('Member')->status_arr,request('status'),'class="input-group-addon"  name="status" ','--请选择--')}}
                        </div>


                        <div class="input-group">
                            <input type="submit" value="搜索" class="btn btn-danger btn-sm">
                            <span class="btn btn-info btn-sm" onclick="window.location.href = '?'">重置</span>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>姓名</th>
                                <th>手机号</th>
                                <th>性别</th>
                                <th>状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($lists as $info)
                                <tr>
                                    <td>{{$info->id}}</td>
                                    <td>{{$info->realname}}</td>
                                    <td>{{$info->mobile}}</td>
                                    <td>{{m('Member')->sex_arr[$info->sex]}}</td>
                                    <td>{{m('Member')->status_arr[$info->status]}}</td>
                                    <td>{{$info->created_at}}</td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <a href="info?id={{$info->id}}">编辑</a>
                                            <a href="del?id={{$info->id}}">删除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div id="page">{{$lists->appends(request()->all())->links()}}</div>
                    </div><!-- /.span -->

                </div><!-- /.row -->
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div>
    </div>



@endsection