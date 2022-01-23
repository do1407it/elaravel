<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class HomeController extends Controller
{
    //sendmail 
    public function send_mail(Request $request){
        $details = [
            'title' => 'Đình Đô with love',
            'body' => 'Love uuu'
        ];
       
        Mail::to('hoctapchung123@gmail.com')->send(new \App\Mail\MyMail($details));
       
        dd("Email is Sent.");
    }
    // [GET] /trang-chu
    public function index(Request $request){
        // SEO
        $meta_des      = 'Chuyên bán các loại laptop gia dụng, chất lượng tốt, giá cả phải chăn';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        // end-SEO
        
        $cate_product  = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $brand_product = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_status','1')
        ->where('brand_status','1')
        ->where('category_status','1')
        //->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        
        ->orderBy('product_id', 'desc')-> limit(12) -> get();

        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('product', $all_product)
        ->with('meta_des',$meta_des)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        // return view('pages.home')->with(compact('cate_product','brand_product','all_product');
    }

    public function mycv(Request $request){
        $cate_product  = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $brand_product = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();
        $meta_des      = 'Chi tiết sản phẩm';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();

        return view('pages.mycv')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('meta_des',$meta_des)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function tin_tuc(Request $request){
        $cate_product  = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $brand_product = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();
        $meta_des      = 'Chi tiết sản phẩm';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
            
        return view('pages.blog')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('meta_des',$meta_des)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function search(Request $request){
        $keywords = $request -> keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('product_status','1')
        ->where('brand_status','1')
        ->where('category_status','1')
        
        ->where('product_name','like','%'.$keywords.'%')
        ->get(); 

        // return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
        return view('pages.sanpham.search', [
            'category' => $cate_product,
            'brand' => $brand_product,
            'search_product' => $search_product
        ]);
    }
}