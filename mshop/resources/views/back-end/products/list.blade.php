@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sản phẩm</li>
			</ol>
		</div><!--/.row-->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-10"><div class="form-group">
								<label for="inputLoai" class="col-sm-3 control-label"><strong> Chọn sản phẩm </strong></label>
								<div class="col-md-6">
									 <?php
						                $cat = DB::table('category')->where('parent_id',0)->whereNotIn('id',[13,14])->get(); 
						              ?>              
						              <select name="sltCate" id="inputLoai" class="form-control" style="margin-top:3px;">
						                <option value="0">- CHỌN MỘT DANH MỤC --</option>
						                @foreach($cat as $row)
						                  <option value="{{$row->slug}}" @if($row->slug == $slug) selected @endif>- {{$row->name}} --</option>     
						                @endforeach      
						              </select>
						                  <script>
						                      document.getElementById("inputLoai").onchange = function() {
						                          if (this.selectedIndex!==0) {
						                              window.location.href = this.value;
						                          }        
						                      };
						                  </script>
								</div>
								<div class="col-md-3">
									<input type="search" name="txttk" id="inputTxttk" class="form-control" value="" placeholder="Tìm sản phẩm..." required="required" title="">
								</div>
							</div>
								
								
							</div>
							<div class="col-md-2">
							@if($slug !='all')
								<a href="{{url('admin/sanpham/'.$slug.'/add')}}" class="btn btn-success" title="new">Thêm mới sản phẩm</a>
							</div>
							@endif
						</div> 
						
					</div>
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
					<div class="panel-body" style="font-size: 12px;">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>										
										<th>ID</th>										
										<th>Hình ảnh</th>
										<th>Tên sản phẩm</th>
										<th>Tóm tắt chức năng</th>
										<th>Thương hiệu</th>
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
											<td>{!!$row->category->name!!}</td>
											<td>{!!$row->price!!} đ</td>
											<td>
												@if($row->status ==1)
													<span style="color:blue;">Còn hàng</span>
												@else
													Tạm hết hàng
												@endif
											</td>
											<td>
											<?php
												$slug = DB::table('category')->where('id',$row->cat_id)->first();
												$name = DB::table('category')->where('id',$slug->parent_id)->first();
											?>
											    <a href="{!!url('admin/sanpham/'.$name->slug.'/edit/'.$row->id)!!}" title="Sửa"><span class="glyphicon glyphicon-edit">edit</span> </a>
											    <a href="{!!url('admin/sanpham/del/'.$row->id)!!}"  title="Xóa" onclick="return xacnhan('Xóa danh mục này ?')"><span class="glyphicon glyphicon-remove">remove</span> </a>
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