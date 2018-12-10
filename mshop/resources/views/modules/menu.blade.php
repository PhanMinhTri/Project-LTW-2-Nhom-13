 <!-- main menu  navbar -->
    <nav class="navbar navbar-default navbar-top" role="navigation" id="main-Nav" style="background-color: #16a085;margin-bottom: 5px;font-size: 13px;">
      <div class="container">  
        <div class="row">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
             <span  class="visible-xs pull-left" style="font-size:30px;cursor:pointer; padding-left: 10px; color: #ecf0f1;" onclick="openNav()">&#9776; </span> 
             <span  class="visible-xs pull-right" style="font-size:20px;cursor:pointer; padding-right: 10px; padding-top: 8px; color: #FFFFFF;" >      
              <!-- Authentication Links -->
                @if (Auth::guest())
                    <a class="top-a" href="{{ url('/') }}" > Home </a>  &nbsp;
                    <a href="{{url('/login')}}" style="color:#e67e22;"> Đăng nhập </a>
                    {{-- <a class="top-a" href="{{ url('/login') }}">Login</a> --}}
                @else  
                    <a class="top-a" href="{{ url('/user') }}"><strong>{!!Auth::user()->name!!}</strong></a>
                    <a class="top-a" href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" title="đăng xuất">
                          <i class="fa fa-btn fa-sign-out"></i><small>Thoát</small>
                      </a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                @endif 
                </span>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="main-mav-top">
            <ul class="nav navbar-nav">
              <li> <a href="{!!url('')!!}" {!!  Request::is('') || Request::is('/*') ? 'style="color: #FFFFFF;background-color: #2c3e50;" ' : ' style="color: #FFFFFF;background-color: #333300;"' !!} ><b class="glyphicon glyphicon-home"></b> Trang chủ </a> </li>
              <li class="{!!  Request::is('mobile') || Request::is('mobile/*') ? 'active ' : '' !!}">
                <a href="{!!url('mobile')!!}" {!!  Request::is('mobile') || Request::is('mobile/*') ? 'style="color: #FFFFFF;background-color: #2c3e50;" ' : '' !!} >Điện Thoại </a>                          
              </li>                                                  
              <li class="{!!  Request::is('laptop') || Request::is('laptop/*') ? 'active' : '' !!}">
                <a href="{!!url('laptop')!!}" {!!  Request::is('laptop') || Request::is('laptop/*') ? 'style="color: #FFFFFF;background-color: #2c3e50;" ' : '' !!} > Laptop </a>                
              </li>    
              <li class="{!!  Request::is('pc') || Request::is('pc/*') ? 'active' : '' !!}">
                <a href="{!!url('pc')!!}" {!!  Request::is('pc') || Request::is('pc/*') ? 'style="color: #FFFFFF;background-color: #2c3e50;" ' : '' !!}> Máy Tính </a>                
              </li>                                          
              <li class="{!!  Request::is('tin-tuc') || Request::is('tin-tuc/*') ? 'active' : '' !!}">
               <a href="{!!url('tin-tuc')!!}" {!!  Request::is('tin-tuc') || Request::is('tin-tuc/*') ? 'style="color: #FFFFFF;background-color: #2c3e50;" ' : '' !!}> Tin Tức - Khuyễn Mãi </a>                    
              </li>                                            
            </ul>
             <ul class="nav navbar-nav pull-right">
              {{-- <li><a href="{{ url('/admin/home') }}">Vào trang quản trị</a></li> --}}
              <li class="dropdown">
                <a  class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-shopping-cart"><span class="badge">{!!Cart::count();!!}</span></span> Giỏ Hàng <b class="caret"></b></a>
                <ul class="dropdown-menu" style="right:0; left: auto; min-width: 350px;">
                @if(Cart::count() !=0)
                  <div class="table-responsive">
                     <table class="table table-hover" >
                      <thead>
                      <tr>
                        <th>Ảnh</th>
                        <th>LS</th>
                        <th>Tên <SPAN></SPAN></th>
                        <th>Giá</th>
                      </tr>
                    </thead>
                       <tbody>                       
                      @foreach(Cart::content() as $row)
                         <tr>
                           <td> {!!$row->images!!} <img class="card-img img-circle" src="{!!url('public/uploads/products/'.$row->options->img)!!}" alt="dell"></td>
                           <td>{!!$row->qty!!}</td>
                           <td>{!!$row->name!!}</td>                           
                           <td>{!!$row->price!!} Vnd</td>
                         </tr>                         
                        @endforeach                           
                       </tbody>                       
                     </table> 
                     <a href="{!!url('/gio-hang/')!!}" type="button" class="btn btn-success"> Chi Tiết Giỏ Hàng </a>
                     <a href="{!!url('/gio-hang/xoa')!!}" type="button" class="btn btn-danger pull-right"> Xóa </a>
                  </div>
                  @else
                    <div class="table-responsive">
                     <table class="table table-hover" >
                      <thead>
                      <tr>
                        <th>Ảnh</th>
                        <th>LS</th>
                        <th>Tên <SPAN></SPAN></th>
                        <th>Giá</th>
                      </tr>
                    </thead>
                       <tbody>                       
                        <td colspan="3">Hện đang trống</td>                        
                       </tbody>                       
                     </table> 
                  </div>
                  @endif
                </ul>
              </li> 
              <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{url('/login')}}">Đăng nhập</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/member') }}"><i class="glyphicon glyphicon-info-sign"></i>Thông tin cá nhân</a></li>
                            <li><a class="top-a" href="{{ url('/logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" title="đăng xuất">
                                <i class="fa fa-btn fa-sign-out"></i><small>Thoát</small>
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
          </div><!-- /.navbar-collapse -->
        </div> <!-- /row -->
      </div><!-- /container -->
    </nav>    <!-- /main nav -->

  <!-- left slider bar nav -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times; Đóng</a>
    <a href="{!!url('mobile')!!}">Điện Thoại</a>
    <a href="{!!url('laptop')!!}">Laptop</a>
    <a href="{!!url('pc')!!}">Máy Tính</a>
    <a href="{!!url('tin-tuc')!!}">Tin Tức</a>
    <a href="{!!url('gio-hang')!!}"> <span class="glyphicon glyphicon-shopping-cart"><span class="badge">{!!Cart::count()!!}</span></span> Giỏ Hàng </a>     
  </div>
  <!-- /left slider bar nav -->