@extends('layouts.master')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<table class="table table-bordered table-hover text-center">
						<thead>
							<tr>
								<th colspan="2"> Lịch sử mua hàng : {!!Auth::user()->name !!}</th>										
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Họ tên</td>
								<td>{!!Auth::user()->name!!}</td>
							</tr>
							<tr>
								<td>Địa chỉ E-mail</td>
								<td>{!!Auth::user()->email!!}</td>
							</tr>
							<tr>
								<td>Điện thoại</td>
								<td>{!!Auth::user()->phone !!}</td>
							</tr>
							<tr>
								<td>Địa chỉ Khách hàng</td>
								<td>{!!Auth::user()->address!!}</td>
							</tr>
							<tr>
								<td>Ngày đăng ký</td>
								<td>{!!Auth::user()->created_at !!}</td>
							</tr>
						</tbody>
					</table>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="table-responsive">
					<table class="table table-bordered table-hover text-center">
						<tbody>
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
                                <label  for="input-id" class="control-label"> </label>
                                <div class="controls">
                                    <div >
                                     <button type="submit" class="btn btn-primary">
                                        Lưu lại
                                    </button>
                                </div>
                                </div>
                            </div>
                        </form>                 
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
