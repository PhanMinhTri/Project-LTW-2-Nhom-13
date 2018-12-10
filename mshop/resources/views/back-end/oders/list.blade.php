@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Đơn đặt hàng</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-heading">
					Danh sách đơn đặt hàng						
				</div>
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
					<div class="panel-body" style="font-size: 13px;">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>										
										<th>ID</th>										
										<th>Tên khách hàng</th>
										<th>Địa chỉ</th>
										<th>Điện thoại</th>
										<th>Email</th>										
										<th>Ngày đặt</th>
										<th>Thành tiền</th>
										<th>Trạng thái</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $row)
										<tr>
											<td>{!!$row->id!!}</td>
											<td>{!!$row->user->name!!}</td>
											<td>{!!$row->user->address!!}</td>
											<td>{!!$row->user->phone!!}</td>
											<td>{!!$row->user->email!!}</td>											
											<td>{!!$row->created_at!!}</td>
											<td>{!!$row->total!!} Vnd</td>
											<td>
												@if($row->status ==0)
													<span style="color:#d35400;">Đơn hàng COD chưa xác nhận</span>													
												@elseif($row->status==1)
													@if($row->type =='paypal' && $row->note !='' && $row->status==1)
													<span style="color:#d35400;">Đơn hàng đã thanh toán online</span>
													@else
														<span style="color:#27ae60;">Đơn hàng COD đã xác nhận</span>
													@endif												
												@elseif($row->status ==2)
													<span style="color:#CC0066;">Đơn hàng đang được giao</span>
												@elseif($row->status ==3)
													<span style="color:blue;">Đã giao hàng xong</span>
												@endif
											</td>
											<td>
											    <a href="{!!url('admin/donhang/detail/'.$row->id)!!}" title="Chi tiết">Chi tiết  </a> &nbsp;
											    <a href="{!!url('admin/donhang/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"> Hủy bỏ</a>
											</td>
										</tr>
									@endforeach								
								</tbody>
							</table>
						</div>
						{!! $data->render() !!}
					</div>
				</div>
			</div>
		</div><!--/.row-->		
	</div>	<!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection