@extends("admin.main")
@section("content")
    <div class="page-content">

        <div class="page-header">
            <h1>
                站点设置
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <form class="form-horizontal" role="form" method="POST" action="{{isset($info->id)?'edit':'add'}}">
                    {{csrf_field()}}
                    @if(isset($info->id))
                        <input type="hidden" name="id" value="{{$info->id}}"/>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> 前台名称 </label>
                        <div class="col-sm-9">
                            <input type="text" name="info[title]" value="{{$info->title or ''}}"  class="col-xs-10 col-sm-8">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> 后台名称 </label>
                        <div class="col-sm-9">
                            <input type="text" name="info[misname]" value="{{$info->misname or ''}}"  class="col-xs-10 col-sm-8">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> 关键词 </label>
                        <div class="col-sm-9">
                            <input type="text" name="info[keywords]" value="{{$info->keywords or ''}}"  class="col-xs-10 col-sm-8">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right"> 描述 </label>
                        <div class="col-sm-9">
                            <textarea name="info[description]" class="col-xs-10 col-sm-8" rows="2" cols="20" style="height:300px;">{{$info->description or ''}}</textarea>
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
                            <button class="btn btn-info" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                提交
                            </button>

                            &nbsp; &nbsp; &nbsp;
                            <button class="btn" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </button>
                        </div>
                    </div>


                </form>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection


