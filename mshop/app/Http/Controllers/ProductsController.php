<?php

namespace App\Http\Controllers;
use App\Products;
use App\Pro_details;
use App\Detail_img;

use Illuminate\Http\Request;
use DB,Auth,DateTime,File;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getlist($cat)
    {
      	if ($cat =='all') {
    		$data = Products::paginate(15);
    		return view('back-end.products.list',['data'=>$data,'slug'=>'all']);
    	} else {
    		$root = DB::table('category')->where('slug',$cat)->first();
    		$sub = DB::table('category')->where('parent_id',$root->id)->get();
    		$c=array();
		    foreach ($sub as $row) {
		        array_push($c,$row->id);         
		    }
		    $data = Products::wherein('cat_id',$c)->paginate(15);
		    return view('back-end.products.list',['data'=>$data,'slug'=>$root->slug]);
    	}
    }
    public function getadd($cat)
    {
    	$root = DB::table('category')->where('slug',$cat)->first();
    	$sub = DB::table('category')->where('parent_id',$root->id)->get();
    	if ($root->slug =='pc-may-bo') {
    		return view('back-end.products.pc-add',['data'=>$sub,'slug'=>$root->slug,'loai'=>$root->name]);
    	}else {
    		return view('back-end.products.add',['data'=>$sub,'slug'=>$root->slug,'loai'=>$root->name]);
    	}
    }
    public function postadd($cat, Request $rq)
    {
    	$pro = new Products();
    	$pro->name = $rq->txtname;
    	$pro->slug = str_slug($rq->txtname,'-');
    	$pro->intro = $rq->txtintro;
    	$pro->promo1 = $rq->txtpromo1;
    	$pro->promo2 = $rq->txtpromo2;
    	$pro->promo3 = $rq->txtpromo3;
    	$pro->packet = $rq->txtpacket;
    	$pro->r_intro = $rq->txtre_Intro;
    	$pro->review = $rq->txtReview;
    	$pro->tag = $rq->txttag;
    	$pro->price = $rq->txtprice;
    	$pro->cat_id = $rq->sltCate;
    	$pro->user_id = Auth::guard('admin')->user()->id;
    	$pro->created_at = new datetime;
    	$pro->status = '1';
    	// dd($pro);
    	$f = $rq->file('txtimg')->getClientOriginalName();
    	$filename = time().'_'.$f;
    	$pro->images = $filename;    	
    	$rq->file('txtimg')->move('public/uploads/products/',$filename);
    	$pro->save();    	
    	$pro_id =$pro->id;

    	$detail = new Pro_details();
    	$detail->cpu = $rq->txtCpu;
    	$detail->ram = $rq->txtRam;
    	$detail->screen = $rq->txtScreen;
    	$detail->vga = $rq->txtVga;
    	$detail->storage = $rq->txtStorage;
    	$detail->exten_memmory =$rq->txtExtend;
    	$detail->cam1 = $rq->txtCam1;
    	$detail->cam2 = $rq->txtCam2;
    	$detail->sim = $rq->txtSIM;
    	$detail->connect = $rq->txtConnect;
    	$detail->pin = $rq->txtPin;
    	$detail->os = $rq->txtOs;
        $detail->note = $rq->txtNote;
    	$detail->pro_id = $pro_id;
        if ($rq->exten_memmory =='') {
            $detail->exten_memmory= $rq->txtCase;
        }
    	$detail->created_at = new datetime;
    	$detail->save();    	

    	if ($rq->hasFile('txtdetail_img')) {
    		$df = $rq->file('txtdetail_img');
    		foreach ($df as $row) {
    			$img_detail = new Detail_img();
    			if (isset($row)) {
    				$name_img= time().'_'.$row->getClientOriginalName();
    				$img_detail->images_url = $name_img;
    				$img_detail->pro_id = $pro_id;
    				$img_detail->created_at = new datetime;
    				$row->move('public/uploads/products/details/',$name_img);
    				$img_detail->save();
    			}
    		}
		}
	return redirect('admin/sanpham/all')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã thêm thành công !']);    	
    }
    public function getedit($cat,$id)
    {
    	$root = DB::table('category')->where('slug',$cat)->first();
    	$sub = DB::table('category')->where('parent_id',$root->id)->get();
    	$pro = Products::where('id',$id)->first();
    	if ($root->slug =='pc-may-bo') {
    		return view('back-end.products.edit-pc',['cat'=>$sub,'pro'=>$pro,'slug'=>$root->slug,'loai'=>$root->name]);
    	}else {
    		return view('back-end.products.edit',['cat'=>$sub,'pro'=>$pro,'slug'=>$root->slug,'loai'=>$root->name]);
    	}
    }
    public function postedit($cat,$id,Request $rq)
    {
    	$pro = Products::find($id);
        $pro->name = $rq->txtname;
        $pro->slug = str_slug($rq->txtname,'-');
        $pro->intro = $rq->txtintro;
        $pro->promo1 = $rq->txtpromo1;
        $pro->promo2 = $rq->txtpromo2;
        $pro->promo3 = $rq->txtpromo3;
        $pro->packet = $rq->txtpacket;
        $pro->r_intro = $rq->txtre_Intro;
        $pro->review = $rq->txtReview;
        $pro->tag = $rq->txttag;
        $pro->price = $rq->txtprice;
        $pro->cat_id = $rq->sltCate;
        $pro->user_id = Auth::guard('admin')->user()->id;
        $pro->updated_at = new datetime;
        $pro->status = $rq->sltstatus;
        $file_path = public_path('public/uploads/products/').$pro->images;        
        if ($rq->hasFile('txtimg')) {
            if (file_exists($file_path))
                {
                    unlink($file_path);
                }            
            $f = $rq->file('txtimg')->getClientOriginalName();
            $filename = time().'_'.$f;
            $pro->images = $filename;       
            $rq->file('txtimg')->move('public/uploads/products/',$filename);
        }       
        $pro->save(); 
        
        $pro->pro_details->cpu = $rq->txtCpu;
        $pro->pro_details->ram = $rq->txtRam;
        $pro->pro_details->screen = $rq->txtScreen;
        $pro->pro_details->vga = $rq->txtVga;
        $pro->pro_details->storage = $rq->txtStorage;
        $pro->pro_details->exten_memmory =$rq->txtExtend;
        $pro->pro_details->connect = $rq->txtConnect;
        $pro->pro_details->cam1 = $rq->txtCam1;
        $pro->pro_details->cam2 = $rq->txtCam2;

        if ($rq->txtSIM =='') {
            $pro->pro_details->sim= 'Không có';
        } else {
            $pro->pro_details->sim = $rq->txtSIM;
        }
       
        if ($rq->txtPin =='') {
            $pro->pro_details->pin= 'Không có';
        } else {
            $pro->pro_details->pin = $rq->txtPin;
        }
        $pro->pro_details->os = $rq->txtOs;
        $pro->pro_details->updated_at = new datetime;        

        if ($rq->hasFile('txtdetail_img')) {
            $detail = Detail_img::where('pro_id',$id)->get();
            $df = $rq->file('txtdetail_img');
            foreach ($detail as $row) {                
               $dt = Detail_img::find($row->id);
               $pt = public_path('public/uploads/products/details/').$dt->images_url; 
               // dd($pt);   
                if (file_exists($pt))
                {
                    unlink($pt);
                }
               $dt->delete();                              
            }
            foreach ($df as $row) {
                $img_detail = new Detail_img();
                if (isset($row)) {
                    $name_img= time().'_'.$row->getClientOriginalName();
                    $img_detail->images_url = $name_img;
                    $img_detail->pro_id = $id;
                    $img_detail->created_at = new datetime;
                    $row->move('public/uploads/products/details/',$name_img);
                    $img_detail->save();
                }
            }
        }
    $pro->pro_details->save();
    return redirect('admin/sanpham/all')
      ->with(['flash_level'=>'result_msg','flash_massage'=>' Đã lưu !']);       
    }

    public function getdel($id)
    {
        $detail = Detail_img::where('pro_id',$id)->get();
        foreach ($detail as $row) {                
               $dt = Detail_img::find($row->id);
               $pt = public_path('uploads/products/details/').$dt->images_url; 
               // dd($pt);   
                if (file_exists($pt))
                {
                    unlink($pt);
                }
               $dt->delete();                              
            }        
    	$pro = Products::find($id);
        $ptp = public_path('uploads/products/').$pro->images; 
        if (file_exists($ptp)){
        	unlink($ptp);
    	}
        $pro->delete();
        return redirect('admin/sanpham/all')
         ->with(['flash_level'=>'result_msg','flash_massage'=>'Đã xóa !']);
    }
}
