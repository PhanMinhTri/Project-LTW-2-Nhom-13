@extends('back-end.layouts.master')
@section('content')
<!-- main content - noi dung chinh trong chu -->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Cài đặt</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><small>Cài đặt  </small></h1>
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
						<form action="" method="POST" role="form" enctype="multipart/form-data">
				      		{{ csrf_field() }}
				      		<div class="form-group">
				      			<label for="input-id">Facebook</label>
				      			<input type="text" name="txtface" id="inputtxtface" class="form-control" value="{!! old('txtface',isset($data->facebook) ? $data->facebook : null) !!}"  required="required">
				      		</div>  
				      		<div class="form-group">
				      			<label for="input-id">Google Ani</label>
				      			<input type="text" name="txtgga" id="inputtxtgga" class="form-control"  value="{!! old('txtgga',isset($data->gga) ? $data->gga : null) !!}"  required="required">
				      		</div> 
				      		<div class="form-group">
				      			<label for="input-id">Tỉ giá Đôla Mỹ - Việt Nam Đồng</label>
				      			<input type="text" name="txttigia" id="inputtxttigia" class="form-control"  value="{!! old('txttigia',isset($data->tigia) ? $data->tigia : null) !!}"  required="required">
				      		</div>  		
				      		<input type="submit" name="btnCateAdd" class="btn btn-primary" value="Lưu lại" class="button" />
				      	</form>			      	
					</div>
				</div>
			</div>
		</div><!--/.row-->		
	</div>	<!--/.main-->
<!-- =====================================main content - noi dung chinh trong chu -->
@endsection