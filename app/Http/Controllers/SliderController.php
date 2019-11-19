<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function index()
    {
    	return view('admin.add_slider');
    }

       public function save_slider(Request $request)
   {
     $this->AdminAuthCheck();

    $data=array();
    $data['slider_id']=$request->slider_id;
    $data['publication_status']=$request->publication_status;
     $image=$request->file('slider_image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='slider/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['slider_image']=$image_url;
            DB::table('tbl_slider')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
            }else{
             DB::table('tbl_slider')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
                }
            }

			 public function all_slider()
			 {
			 	$all_slider=DB::table('tbl_slider')->get();

                return view('admin.all_slider',compact('all_slider'));
			 }


			 public function unactive_slider($slider_id)
			 {
			 	DB::table('tbl_slider')
               ->where('slider_id',$slider_id)
               ->update(['publication_status'=>0]);
               Session::put('message','Slider Unactive Sussessfully');
               return Redirect::to('/all-slider');
			 }


    public function active_slider($slider_id)
    {
    	DB::table('tbl_slider')
    	         ->where('slider_id',$slider_id)
    	         ->update(['publication_status'=>1]);
    	         Session::put('message','slider Active Sussessfully');
    	         return Redirect::to('/all-slider');
    }

    public function delete_slider($slider_id)
    {
    	$delete=DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
            if ($delete) 
                {       
                  $notification=array(
                'messege'=>'Successfully deleted',
                'alert-type'=>'success'
                
                 );
               return Redirect()->back()->with($notification);   
        }
    }


    public function AdminAuthCheck()
      {
	      $admin_id=Session::get('admin_id');
	      if($admin_id)
	      {
	        return;
	      }else{
	        return Redirect::to('/admin')->send();
      }
    }
}
