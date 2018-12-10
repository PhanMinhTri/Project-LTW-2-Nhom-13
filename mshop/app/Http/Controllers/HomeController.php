<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,DB,DateTime;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oder = DB::table('oders')->where('c_id','=',Auth::user()->id)->get();
        return view('member.user',['data'=>$oder]);
    }
    public function getedit()
   {
        $id = Auth::user()->id;
        $data = User::where('id',$id)->first();
        return view('member.edit',['data'=>$data]);
   }
    public function postedit(Request $rq)
   {
        $id = Auth::user()->id;
        $dt = User::FindOrFail($id);
        $dt->name = $rq->name;
        if ($rq->password !='') {
            $dt->password = bcrypt($rq->password);
        }        
        $dt->phone = $rq->phone;
        $dt->address = $rq->address;
        $dt->updated_at = new datetime;
        $dt->save();
        echo '<script type="text/javascript">
                  alert("Cập nhật thông tin khách hàng thành công !");                
                   window.location = "';
                   echo route('info');
               echo '";
            </script>';  
   }
}
