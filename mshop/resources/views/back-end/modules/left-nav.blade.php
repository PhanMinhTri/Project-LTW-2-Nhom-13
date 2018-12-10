<!-- left menu - menu ben  trai	 -->
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Tìm kiếm ...">
			</div>
		</form>
		<ul class="nav menu">
			<li class="{!!  Request::is('admin') ? 'active ' : '' !!}"><a href="{!!url('admin/')!!}"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Trang chủ</a></li>
			<li id="danhmuc" class="{!!  Request::is('admin/danhmuc') || Request::is('admin/danhmuc/*') ? 'active ' : '' !!}" ><a href="{!!url('admin/danhmuc')!!}"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Danh mục</a></li>
			<li id="sanpham" class="{!!  Request::is('admin/sanpham') || Request::is('admin/sanpham/*') ? 'active ' : '' !!}"><a href="{!!url('admin/sanpham/all')!!}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Sản phẩm </a></li>
			<li class="{!!  Request::is('admin/news') || Request::is('admin/news/*') ? 'active ' : '' !!}"><a href="{!!url('admin/news')!!}"><span class="glyphicon glyphicon-file"></span> Tin tức</a></li>


			<li class="{!!  Request::is('admin/donhang') || Request::is('admin/donhang/*') ? 'active ' : '' !!}"><a href="{!!url('admin/donhang')!!}"><svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg> Đơn đặt hàng</a></li>

			<li class="{!!  Request::is('admin/khachhang') || Request::is('admin/khachhang/*') ? 'active ' : '' !!}"><a href="{!!url('admin/khachhang')!!}"><svg class="glyph stroked app-window"><use xlink:href="#stroked-line-graph"></use></svg>  Khách hàng</a></li>

			<li class="{!!  Request::is('admin/nhanvien') || Request::is('admin/nhanvien/*') ? 'active ' : '' !!}"><a href="{!!url('admin/nhanvien')!!}"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Nhân Viên</a></li>			
			
			<li role="presentation" class="divider"></li>
			<li class="{!!  Request::is('admin/catdat') || Request::is('admin/catdat/*') ? 'active ' : '' !!}"><a href="{!!url('admin/catdat')!!}"><svg class="glyph stroked female user"><use xlink:href="#stroked-female-user"/></svg> Cài đặt</a></li>
		</ul>

	</div><!--/.sidebar-->