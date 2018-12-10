@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Thông tin</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Thay đổi mật khẩu </small></h1>
            </div>
        </div><!--/.row-->      
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif (Session()->has('flash_level'))
                            <div class="alert alert-success">
                                <ul>
                                    {!! Session::get('flash_massage') !!}   
                                </ul>
                            </div>
                        @endif                   
                    <div class="panel-body" style="background-color: #ecf0f1; color:#27ae60;">
                        <form class="form-horizontal" role="form" method="POST">
                            {{ csrf_field() }}  
                            <div class="control-group {{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                                <label class="control-label">Mật khẩu hiện tại :</label>
                                <div class="controls">
                                    <input id="oldpassword" type="password" class="form-control" name="oldpassword" >
                                    @if ($errors->has('oldpassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oldpassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                          
                            <div class="control-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label">Mật khẩu :</label>
                                <div class="controls">
                                    <input id="password" type="password" class="form-control" name="password" >
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="password-confirm" class="control-label">Xác nhận lại mật khẩu</label>
                                <div class="controls">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('sltlevel') ? ' has-error' : '' }}">
                                <label  for="input-id" class="control-label"> </label>
                                <div class="controls">
                                    <div >
                                     <button type="submit" class="btn btn-primary">
                                        Thau đổi mật khẩu
                                    </button>
                                </div>
                                </div>
                            </div>
                        </form>                 
                    </div>
                </div>
            </div>
        </div><!--/.row-->      
    </div>  <!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection