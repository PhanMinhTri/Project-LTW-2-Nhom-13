<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
use DateTime;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getsetting()
    {
    	$st = Settings::all();
    	if ($st->count()==0) {
    		$dt = new Settings();
    		$dt->facebook = 'vietdhtn';
    		$dt->gga = 'vietdhtn';
    		$dt->tigia = '22000';
    		$dt->created_at = new datetime();
    		$dt->save();
    	}
        $data = $st = Settings::first();
    	return view('back-end.setting',['data'=>$data]);
    }
    public function postsetting(Request $rq)
    {
		$dt = Settings::first();
		$dt->facebook = $rq->txtface;
		$dt->gga =  $rq->txtgga;
		$dt->tigia =  $rq->txttigia;
		$dt->updated_at = new datetime();
    	$dt->save();
    	return redirect('admin/catdat')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã cập nhật thành công!']);
    }
}
