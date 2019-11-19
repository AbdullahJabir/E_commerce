<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_manufacture');
    }


    public function save_manufacture(Request $request)
    {
        $this->AdminAuthCheck();
    	$validatedData = $request->validate([
             'manufacture_name' => 'required|unique:tbl_manufacture',
             
         ]);

    	$data=array();
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
    	$data['publication_status']=$request->publication_status;

    	$category=DB::table('tbl_manufacture')->insert($data);

    	/*Session::put('message','Category Added Sussessfully');
    	return Redirect::to('/add_category');*/
    	if ($category) {      	 $notification=array(
                'messege'=>'Successfully Category Inserted',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);   
        }else{
        	  $notification=array(
                'messege'=>'Something went wrong!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);   
        }
    }
      public function all_manufacture()
    {
        $this->AdminAuthCheck();
    	$category=DB::table('tbl_manufacture')->get();

        return view('admin.all_manufacture',compact('category'));
    	/*return view('admin.all_category');*/
    }


    public function unactive_manufacture($manufacture_id)
    {
    	DB::table('tbl_manufacture')
    	         ->where('manufacture_id',$manufacture_id)
    	         ->update(['publication_status'=>0]);
    	         Session::put('message','Manufacture Unactive Sussessfully');
    	         return Redirect::to('/all_manufacture');
    }

    public function active_manufacture($manufacture_id)
    {
    	DB::table('tbl_manufacture')
    	         ->where('manufacture_id',$manufacture_id)
    	         ->update(['publication_status'=>1]);
    	         Session::put('message','Manufacture Active Sussessfully');
    	         return Redirect::to('/all_manufacture');
    }


    public function edit_manufacture($manufacture_id)
    {
        $this->AdminAuthCheck();

    	$category=DB::table('tbl_manufacture')
    	         ->where('manufacture_id',$manufacture_id)->first();
    	          return view('admin.edit_manufacture',compact('category'));
    	
    }


    public function update_manufacture(Request $request,$manufacture_id)
    {
        $this->AdminAuthCheck();
    	

    	$data=array();
    	
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
    	$category=DB::table('tbl_manufacture')
    	        ->where('manufacture_id',$manufacture_id)
    	         ->insert($data);
    	         if ($category) {      	 $notification=array(
                'messege'=>'Successfully manufacture Updated',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_manufacture')->with($notification);   
        }else{
        	  $notification=array(
                'messege'=>'Something went wrong!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);   
        }
}

        public function delete_manufacture($manufacture_id)
            {
            	 $delete=DB::table('tbl_manufacture')->where('manufacture_id',$manufacture_id)->delete();
                   if ($delete) {      
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
