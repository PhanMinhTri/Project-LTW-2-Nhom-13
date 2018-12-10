<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// index
Route::get('/', ['as'=>'index','uses'=>'PagesController@index']);
// auth
Auth::routes();
// member 
Route::get('/member', ['as'=>'info', 'uses'=>'HomeController@index']);
Route::get('/member/edit', 'HomeController@getedit');
Route::post('/member/edit', 'HomeController@postedit');

// admin auth
Route::GET ('admin/login',['as'=> 'getlogin','uses'=> 'AdminAuth\LoginController@showLoginForm']);               
Route::POST('admin/login', ['as'=>'postlogin','uses'=>'AdminAuth\LoginController@login']);    
                  
Route::POST('admin/logout',['as'=>'adminlogout', 'uses'=>'AdminAuth\LoginController@logout']);      
Route::POST('admin/password/email', ['as'=>'sendmaillinkreset', 'uses'=>'AdminAuth\ForgotPasswordController@sendResetLinkEmail']);
Route::GET('admin/password/reset',  ['as'=>'getpasswordreset','uses'=>'AdminAuth\ForgotPasswordController@showLinkRequestForm']);
Route::POST('admin/password/reset', ['as'=>'postpasswordreset','uses'=>'AdminAuth\ResetPasswordController@reset']);           
Route::GET('admin/password/reset/{token} ', ['as'=>'getreset','uses'=>'AdminAuth\ResetPasswordController@showResetForm']);
// admin index
Route::get('/admin',['as'=>'adminhome','uses'=>'AdminController@index']);

// cart - oder
Route::get('gio-hang', ['as'  => 'getcart', 'uses' =>'PagesController@getcart']);
// them vao gio hang
Route::get('gio-hang/addcart/{id}', ['as'  => 'getcartadd', 'uses' =>'PagesController@addcart']);
Route::get('gio-hang/update/{id}/{qty}-{dk}', ['as'  => 'getupdatecart', 'uses' =>'PagesController@getupdatecart']);
Route::get('gio-hang/delete/{id}', ['as'  => 'getdeletecart', 'uses' =>'PagesController@getdeletecart']);
Route::get('gio-hang/xoa', ['as'  => 'getempty', 'uses' =>'PagesController@xoa']);

// tien hanh dat hang
Route::get('dat-hang', ['as'  => 'getoder', 'uses' =>'PagesController@getoder']);
Route::post('dat-hang', ['as'  => 'postoder', 'uses' =>'PagesController@postoder']);
// category
Route::get('/{cat}', ['as'  => 'getcate', 'uses' =>'PagesController@getcate']);
Route::get('/{cat}/{id}-{slug}', ['as'  => 'getdetail', 'uses' =>'PagesController@detail']);

Route::resource('payment', 'PayMentController');
//============================== back-end ==========================================
// -------------------- quan ly danh muc----------------------
Route::group(['prefix' => 'admin/danhmuc'], function() {
	Route::get('add',['as'        =>'getaddcat','uses' => 'CategoryController@getadd']);
	Route::post('add',['as'       =>'postaddcat','uses' => 'CategoryController@postadd']);

	Route::get('/',['as'       =>'getcat','uses' => 'CategoryController@getlist']);
	Route::get('del/{id}',['as'   =>'getdellcat','uses' => 'CategoryController@getdel'])->where('id','[0-9]+');

	Route::get('edit/{id}',['as'  =>'geteditcat','uses' => 'CategoryController@getedit'])->where('id','[0-9]+');
	Route::post('edit/{id}',['as' =>'posteditcat','uses' => 'CategoryController@postedit'])->where('id','[0-9]+');
});
 // -------------------- quan ly san pham--------------------
Route::group(['prefix' => 'admin/sanpham'], function() {
    Route::get('/{cat}/add',['as'        =>'getaddpro','uses' => 'ProductsController@getadd']);
    Route::post('/{cat}/add',['as'       =>'postaddpro','uses' => 'ProductsController@postadd']);

    Route::get('/{cat}',['as'       =>'getpro','uses' => 'ProductsController@getlist']);
    Route::get('/del/{id}',['as'   =>'getdellpro','uses' => 'ProductsController@getdel'])->where('id','[0-9]+');
   
    Route::get('/{cat}/edit/{id}',['as'  =>'geteditpro','uses' => 'ProductsController@getedit'])->where('id','[0-9]+');
    Route::post('/{cat}/edit/{id}',['as' =>'posteditpro','uses' => 'ProductsController@postedit'])->where('id','[0-9]+');
    });
// -------------------- quan ly blog----------------------
 Route::group(['prefix' => '/admin/news'], function() {
	  Route::get('/add',['as'        =>'getaddnews','uses' => 'NewsController@getadd']);
   	Route::post('/add',['as'       =>'postaddnews','uses' => 'NewsController@postadd']);

   	Route::get('/',['as'       =>'getnews','uses' => 'NewsController@getlist']);
   	Route::get('/del/{id}',['as'   =>'getdellnews','uses' => 'NewsController@getdel'])->where('id','[0-9]+');
   
   	Route::get('/edit/{id}',['as'  =>'geteditnews','uses' => 'NewsController@getedit'])->where('id','[0-9]+');
   	Route::post('/edit/{id}',['as' =>'posteditnews','uses' => 'NewsController@postedit'])->where('id','[0-9]+');
});
// -------------------- quan ly đơn đặt hàng--------------------
Route::group(['prefix' => '/admin/donhang'], function() {
   Route::get('',['as'       =>'getpro','uses' => 'OdersController@getlist']);
   Route::get('/del/{id}',['as'   =>'getdeloder','uses' => 'OdersController@getdel'])->where('id','[0-9]+');
   
   Route::get('/detail/{id}',['as'  =>'getdetail','uses' => 'OdersController@getdetail'])->where('id','[0-9]+');
   Route::post('/detail/{id}',['as' =>'postdetail','uses' => 'OdersController@postdetail'])->where('id','[0-9]+');
});
// -------------------- quan ly khach hang--------------------
Route::group(['prefix' => '/admin/khachhang'], function() {
   Route::get('',['as'       =>'getmem','uses' => 'UsersController@getlist']);
   Route::get('/del/{id}',['as'   =>'getdelmem','uses' => 'UsersController@getdel'])->where('id','[0-9]+');
   
   Route::get('/edit/{id}',['as'  =>'geteditmem','uses' => 'UsersController@getedit'])->where('id','[0-9]+');
   Route::post('/edit/{id}',['as' =>'posteditmem','uses' => 'UsersController@postedit'])->where('id','[0-9]+');
});
// -------------------- ql nhan vien--------------------
Route::group(['prefix' => '/admin/nhanvien'], function() {
  Route::get('/add',['as'        =>'getaddnv','uses' => 'Admin_usersController@getadd']);
  Route::post('/add',['as'       =>'postaddnv','uses' => 'Admin_usersController@postadd']);

  Route::get('',['as'       =>'getnv','uses' => 'Admin_usersController@getlist']);
  Route::get('/del/{id}',['as'   =>'getdelnv','uses' => 'Admin_usersController@getdel'])->where('id','[0-9]+');
   
  Route::get('/edit/{id}',['as'  =>'geteditnv','uses' => 'Admin_usersController@getedit'])->where('id','[0-9]+');
  Route::post('/edit/{id}',['as' =>'posteditnv','uses' => 'Admin_usersController@postedit'])->where('id','[0-9]+');

  Route::get('/change/{id}',['as'  =>'geteditnv','uses' => 'Admin_usersController@getchange'])->where('id','[0-9]+');
  Route::post('/change/{id}',['as' =>'posteditnv','uses' => 'Admin_usersController@postchange'])->where('id','[0-9]+');
});
// ---------------van de khac ----------------------

// ---------------cấu hình Shops ----------------------
Route::group(['prefix' => 'admin/catdat'], function() {
   Route::get('',['as'=>'getupdate','uses' => 'SettingsController@getsetting']);
   Route::post('',['as'=>'postupdate','uses' => 'SettingsController@postsetting']);

});