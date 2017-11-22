@extends("admin.main")
@section("content")

    <div class="page-content">


        <div class="page-header">
            <h1>
                {{isset($info->id)?'详情':'添加'}}
                <button class="btn btn-sm btn-primary pull-right"
                        onclick="javascript:window.location.href = 'lists?module_id={{request('module_id')}}'">
                    返回列表
            </h1>

        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">


                <form id="myform" name="myform" class="form-horizontal" role="form" method="POST"
                      action="{{isset($info->id)?'edit':'add'}}">
                    {{csrf_field()}}
                    @if(isset($info->id))
                        <input type="hidden" name="id" value="{{$info->id}}"/>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right">
                            <span class="red">*</span> 手机号
                        </label>
                        <div class="col-sm-9 col-xs-9">
                            <input type="text" name="info[mobile]" value="{{$info->mobile or ''}}"
                                   class="col-xs-10 col-sm-5">
                            <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle hidden-xs green"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right">
                            <span class="red">*</span> 姓名
                        </label>
                        <div class="col-sm-9 col-xs-9">
                            <input type="text" name="info[realname]" value="{{$info->realname or ''}}"
                                   class="col-xs-10 col-sm-5">
                            <span class="help-inline col-xs-12 col-sm-7">
                                   <span class="middle hidden-xs green"></span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right">
                            <span class="red">*</span> 性别
                        </label>
                        <div class="col-sm-9 col-xs-9">
                            {!! From::radio(m('Member')->sex_arr,isset($info->id)?$info->sex:1,' name="info[sex]" ',50,'info[sex]') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 col-xs-3 control-label no-padding-right">
                            <span class="red">*</span> 状态
                        </label>
                        <div class="col-sm-9 col-xs-9">
                            {{From::select(m('Member')->status_arr,isset($info->id)?$info->status:1,'class="col-xs-10 col-sm-5"  name="info[status]" ')}}
                        </div>
                    </div>


                    @if (count($errors) > 0)
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-info" type="submit" id="dosubmit">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                提交
                            </button>
                            <button class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection

