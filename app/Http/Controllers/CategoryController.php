<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CategoryController extends Controller
{
    public function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_category');
    }

    public function all_category()
    {
        $this->AdminAuthCheck();
    	$category=DB::table('tbl_category')->get();

        return view('admin.all_category',compact('category'));
    	/*return view('admin.all_category');*/
    }

    public function save_category(Request $request)
    {
        $this->AdminAuthCheck();
    	$validatedData = $request->validate([
             'category_name' => 'required|unique:tbl_category',
             
         ]);

    	$data=array();
    	$data['category_id']=$request->category_id;
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['publication_status']=$request->publication_status;

    	$category=DB::table('tbl_category')->insert($data);

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

    public function unactive_category($category_id)
    {
    	DB::table('tbl_category')
    	         ->where('category_id',$category_id)
    	         ->update(['publication_status'=>0]);
    	         Session::put('message','Category Unactive Sussessfully');
    	         return Redirect::to('/all_category');
    }


    public function active_category($category_id)
    {
    	DB::table('tbl_category')
    	         ->where('category_id',$category_id)
    	         ->update(['publication_status'=>1]);
    	         Session::put('message','Category Active Sussessfully');
    	         return Redirect::to('/all_category');
    }

    public function edit_category($category_id)
    {
        $this->AdminAuthCheck();

    	$category=DB::table('tbl_category')
    	         ->where('category_id',$category_id)->first();
    	          return view('admin.edit_category',compact('category'));
    	
    }

    public function update_category(Request $request,$category_id)
    {
    	$this->AdminAuthCheck();

    	$data=array();
    	
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$category=DB::table('tbl_category')
    	        ->where('category_id',$category_id)
    	         ->insert($data);
    	         if ($category) {      	 $notification=array(
                'messege'=>'Successfully Category Updated',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all_category')->with($notification);   
        }else{
        	  $notification=array(
                'messege'=>'Something went wrong!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);   
        }
}
   
   public function delete_category($category_id)
   {
    
   	 $delete=DB::table('tbl_category')->where('category_id',$category_id)->delete();
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

