<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
   public function __construct()
   {
      $this->middleware('admin');
   }
   public function getlist()
   {
   		$data = User::paginate(10);
    	return view('back-end.users.list',['data'=>$data]);
   }
   public function getedit($id)
   {
   		$data = User::where('id',$id)->first();
   		return view('back-end.users.edit',['data'=>$data]);
   }
   public function getdel($id)
   {
      $dt = User::FindOrFail($id);
      if ($dt->count()>0) {
         $dt->delete();
         return redirect('admin/khachhang/')
         ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã xóa thành công !']); 
      }
   }
}
