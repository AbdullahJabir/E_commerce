<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class WorkerController extends Controller
{
     public function index()
   {
   /* $this->AdminAuthCheck();*/
   	return view('admin.add_worker');
   }


    public function save_worker(Request $request)
   {
   /* $this->AdminAuthCheck();*/
   	$data=array();

   	$data['name']=$request->name;
   
  
   	$data['title']=$request->title;
   	$data['sub_title']=$request->sub_title;
   	$data['date']=$request->date;
   	$data['publication_status']=$request->publication_status;

   $image=$request->file('image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['image']=$image_url;
            DB::table('worker_tbl')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
        }else{
             DB::table('worker_tbl')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
        }
   }


   public function all_worker()
   {
    /*$this->AdminAuthCheck();*/


    	$all_worker=DB::table('worker_tbl')
    	               
    	                ->get();

        return view('admin.all_worker',compact('all_worker'));
   }


      public function unactive_worker($id)
    {
      DB::table('worker_tbl')
               ->where('id',$id)
               ->update(['publication_status'=>0]);
               Session::put('message','Worker Unactive Sussessfully');
               return Redirect::to('/all_worker');
    }
      public function active_worker($id)
    {
      DB::table('worker_tbl')
               ->where('id',$id)
               ->update(['publication_status'=>1]);
               Session::put('message','Worker active Sussessfully');
               return Redirect::to('/all_worker');
    }

}
