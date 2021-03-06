<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    public function index()
    {

    	$all_published_product=DB::table('tbl_products')
    	               ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                       ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id') 
                       ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                       ->where('tbl_products.publication_status',1)
                       ->limit(9)
    	               ->get();

        return view('pages.home_content',compact('all_published_product'));
    	//return view('pages.home_content');
    }

    public function show_product_by_category($category_id)
    {
      $product_by_category=DB::table('tbl_products')
                        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                      
                       ->select('tbl_products.*','tbl_category.category_name')
                       ->where('tbl_category.category_id',$category_id)
                       ->where('tbl_products.publication_status',1)
                       ->limit(18)
                     ->get();

        return view('pages.category_by_product',compact('product_by_category'));
    }


    public function show_product_by_manufacture($manufacture_id)
    {
      $product_by_manufacture=DB::table('tbl_products')
                        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                       ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id') 
                       ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                       ->where('tbl_manufacture.manufacture_id',$manufacture_id)
                       ->where('tbl_products.publication_status',1)
                       ->limit(18)
                     ->get();

        return view('pages.manufacture_by_product',compact('product_by_manufacture'));
    }

    public function product_details_by_id($product_id)
    {
        $product_by_details=DB::table('tbl_products')
                        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                      ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id') 
                       ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                       ->where('tbl_products.product_id',$product_id)
                       ->where('tbl_products.publication_status',1)
                       
                     ->first();

        return view('pages.product_details',compact('product_by_details'));
    } 
}
