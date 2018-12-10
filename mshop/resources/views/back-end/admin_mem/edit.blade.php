@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">           
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Nhân viên</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><small>Thêm mới nhân viên</small></h1>
            </div>
        </div><!--/.row-->      
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">                   
                    <div class="panel-body" style="background-color: #ecf0f1; color:#27ae60;">
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
                        <form class="form-horizontal" role="form" method="POST">
                            {{ csrf_field() }}
                            <div class="control-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="control-label">Họ tên :</label>
                                <div class="controls">
                                    <input id="name" type="text" class="form-control" name="name" value="{!! old('name',isset($data->name) ? $data->name : null) !!}" required autofocus >
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="control-label">Địa chỉ:</label>
                                <div class="controls">
                                    <input id="address" type="text" class="form-control" name="address" value="{!! old('address',isset($data->address) ? $data->address : null) !!}" required autofocus >
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="control-label">Điện thoại:</label>
                                <div class="controls">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{!! old('phone',isset($data->phone) ? $data->phone : null) !!}" required autofocus >
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label">Email :</label>
                                <div class="controls">
                                    <input id="email" type="email" class="form-control" name="email" value="{!! old('address',isset($data->email) ? $data->email : null) !!}" required readonly>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
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
                                <label  for="input-id" class="control-label"> Chọn Quyền </label>
                                <div class="controls">
                                    <div >
                                        <select name="sltlevel" id="inputSltCate" class="form-control">
                                            <option value="100" @if($data->level ==100) selected @endif>-- Quản trị viên --</option>   
                                            <option value="1" @if($data->level ==1) selected @endif>-- Nhân viên quản lý --</option>      
                                            <option value="2" @if($data->level ==2) selected @endif>-- Nhân viên bán hàng --</option>       
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group {{ $errors->has('sltlevel') ? ' has-error' : '' }}">
                                <label  for="input-id" class="control-label"> </label>
                                <div class="controls">
                                    <div >
                                     <button type="submit" class="btn btn-primary">
                                        Thêm nhân viên
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