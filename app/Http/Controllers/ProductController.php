<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
   public function index()
   {
    $this->AdminAuthCheck();
   	return view('admin.add_product');
   }


   public function all_product()
   {
    $this->AdminAuthCheck();


    	$manage_product=DB::table('tbl_products')
    	               ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                     ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id') 
                     ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    	                ->get();

        return view('admin.all_product',compact('manage_product'));
   }

   public function save_product(Request $request)
   {
    $this->AdminAuthCheck();
   	$data=array();

   	$data['product_name']=$request->product_name;
   	$data['category_id']=$request->category_id;
   	$data['manufacture_id']=$request->manufacture_id;
   	$data['product_short_description']=$request->product_short_description;
   	$data['product_long_description']=$request->product_long_description;
   	$data['product_price']=$request->product_price;
   	$data['product_size']=$request->product_size;
   	$data['product_color']=$request->product_color;
   	$data['publication_status']=$request->publication_status;

   $image=$request->file('product_image');
        if ($image) {
            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $data['product_image']=$image_url;
            DB::table('tbl_products')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
        }else{
             DB::table('tbl_products')->insert($data);
             $notification=array(
                'messege'=>'Successfully Post Inserted',
                'alert-type'=>'success'
                 );
             return Redirect()->back()->with($notification);
        }
   }

      public function unactive_product($product_id)
    {
      DB::table('tbl_products')
               ->where('product_id',$product_id)
               ->update(['publication_status'=>0]);
               Session::put('message','Manufacture Unactive Sussessfully');
               return Redirect::to('/all-product');
    }
      public function active_product($product_id)
    {
      DB::table('tbl_products')
               ->where('product_id',$product_id)
               ->update(['publication_status'=>1]);
               Session::put('message','Manufacture active Sussessfully');
               return Redirect::to('/all-product');
    }

    public function delete_product($product_id)
            {
               $delete=DB::table('tbl_products')->where('product_id',$product_id)->delete();
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