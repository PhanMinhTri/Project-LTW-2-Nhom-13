@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Chi tiết đơn hàng </li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<form action="" method="POST" role="form">	
					<input type="hidden" name="_token" value="{{ csrf_token() }}">				
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
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th> Họ-tên khách hàng</th>
											<th>Địa chỉ</th>
											<th>Điện thoại</th>
											@if($oder->type =='paypal')
												<th>Payment ID</th>
											@else
												<th>Ghi chú</th>
											@endif
											<th>Ngày đặt</th>
											<th>Tổng tiền</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{!!$oder->id!!}</td>
											<td>{!!$oder->user->name!!}</td>
											<td>{!!$oder->user->address!!}</td>
											<td>{!!$oder->user->phone!!}</td>
											<td>{!!$oder->note!!}</td>
											<td>{!!$oder->created_at!!}</td>
											<td>{!! number_format($oder->total) !!} Vnđ</td>
										</tr>
									</tbody>
								</table>
							</div>
						<div class="panel-heading">						 
							Chi tiết sản phẩm trong đơn đặt hàng
						</div>
						<div class="panel-body" style="font-size: 12px;">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>										
											<th>ID</th>										
											<th>Hình ảnh</th>
											<th>Tên sản phẩm</th>
											<th>Tóm tắt chức năng</th>
											<th> Số lượng </th>
											<th>Giá bán</th>
											<th>Trạng thái</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $row)
											<tr>
												<td>{!!$row->id!!}</td>
												<td> <img src="{!!url('public/uploads/products/'.$row->images)!!}" alt="iphone" width="50" height="40"></td>
												<td>{!!$row->name!!}</td>
												<td>{!!$row->intro!!}</td>
												<td>{!!$row->qty!!} </td>
												<td>{!! number_format($row->price) !!} Vnđ</td>
												<td>
													@if($row->status ==1)
														<span style="color:blue;">Còn hàng</span>
													@else
														<span style="color:#27ae60;"> Tạm hết</span>
													@endif
												</td>
												<td>
												    <a href="{!!url('')!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"><span class="glyphicon glyphicon-remove">Remove</span> </a>
												</td>
											</tr>
										@endforeach								
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="control-group {{ $errors->has('sltlevel') ? ' has-error' : '' }}">
                    <label  for="input-id" class="control-label"> Chọn thao tác muốn thực hiện </label>
                    <div class="controls">
                        <div >
                            <select name="sltlevel" id="inputSltCate" class="form-control" style="width: 30%">
                                <option value="0" @if($oder->status ==0) selected @endif>-- Chưa xác nhận --</option>   
                                <option value="1" @if($oder->status ==1) selected @endif>-- Đã xác nhận--</option>      
                                <option value="2" @if($oder->status ==2) selected @endif>-- Đang giao hàng --</option> 
                                <option value="3" @if($oder->status ==3) selected @endif>-- Đã giao hàng xong --</option>      
                            </select>
                        </div>
                    </div>
                </div>
                <br>
					<button type="submit" onclick="return xacnhan('Bạn có chắc chắn thực hiện hành động này ?')"  class="btn btn-danger"> Thực hiện hành động </button>
				</form>
			</div>
		</div><!--/.row-->		
	</div>	<!--/.main-->
@endsection