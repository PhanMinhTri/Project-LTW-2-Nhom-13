<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Admins;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use DateTime,Auth;
class Admin_usersController extends Controller
{

  public function __construct()
  {
    $this->middleware('admin');
  }
  
  public function getlist()
   {
   		$data = Admins::paginate(10);
    	return view('back-end.admin_mem.list',['data'=>$data]);
   }
   public function getadd()
   {
   	return view('back-end.admin_mem.add');
   }
   public function postadd(Request $rq)
   {
      $validator = Validator::make(
            $rq->only('name', 'email', 'password','password_confirmation','sltlevel'),
            Admins::$validators,Admins::$msg
            );
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else{
   		$dt = new Admins();
   		$dt->name = $rq->name;
   		$dt->email = $rq->email;
   		$dt->password = bcrypt($rq->password);
   		$dt->level = $rq->sltlevel;
   		$dt->phone = $rq->phone;
   		$dt->address = $rq->address;
         $dt->created_at = new datetime;
         $dt->save();
   		return redirect('admin/nhanvien')
      	->with(['flash_level'=>'result_msg','flash_massage'=>' Đã thêm thành công !']);  
      }
   }
   public function getedit($id)
   {
      $dt = Admins::FindOrFail($id);
      return view('back-end.admin_mem.edit',['data'=>$dt]);
   }
   public function postedit($id, Request $rq)
   {
      if ($rq->password !='') {
         $validator = Validator::make(
            $rq->only('name','address','phone','password','password_confirmation', 'email','sltlevel'),
            Admins::$validators,Admins::$msg
            );
      } else{
          $validator = Validator::make(
            $rq->only('name','address','phone', 'email','sltlevel'),
            Admins::$validators_edit,Admins::$msg
            );
      }
      
      if ($validator->fails()) {
         return Redirect::back()->withInput()->withErrors($validator);
      } else {
         $dt = Admins::FindOrFail($id);
         $dt->name = $rq->name;
         $dt->email = $rq->email;
         if ($rq->password !='') {
             $dt->password = bcrypt($rq->password);
         }        
         $dt->level = $rq->sltlevel;
         $dt->phone = $rq->phone;
         $dt->address = $rq->address;
         $dt->updated_at = new datetime;
         $dt->save();
         return redirect('admin/nhanvien')
         ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã sửa thành công !']);  
      }
   } 
   public function getdel($id)
     {
         if (Auth::guard('admin')->user()->level == 100) {
            $dt = Admins::FindOrFail($id);
            $dt->delete();
            return redirect('admin/nhanvien')
            ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã xóa thành công !']);
          } else{
            echo '<script type="text/javascript">
                  alert("Bạn không có quyền thực hiện thao tác này !");                
                   window.location = "';
                   echo route('getnv');
               echo '";
            </script>';
          } 
     }
   public function getchange($id)
   {
      return view('back-end.admin_mem.change'); 
   }  
   public function postchange($id, Request $rq)
   {
      if (Auth::guard('admin')->attempt(['email'=>Auth::guard('admin')->user()->email,'password'=>$rq->oldpassword])) {
          $validator = Validator::make(
            $rq->only('oldpassword','password','password_confirmation'),
            Admins::$validators_pass,Admins::$msg
            );
         if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
         } else {
               $dt = Admins::FindOrFail($id);         
               $dt->password = bcrypt($rq->password);         
               $dt->updated_at = new datetime;
               $dt->save();
               echo '<script type="text/javascript">
                  alert("Mật khẩu của bạn đã được thay đổi, sẽ có hiệu lực vào lần đăng nhập tiếp theo !");                
                   window.location = "';
                   echo route('adminhome');
                  echo '";
               </script>';  
            }
      } else{
         return Redirect::back()->withInput()->withErrors('Mật khẩu hiện tại không đúng vui lòng kiểm tra lại !');
      }

   }
}
