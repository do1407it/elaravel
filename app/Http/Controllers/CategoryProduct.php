<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/admin')->send();
        }
    }
    // [GET] /admin
    public function add_category_product(){
        $this -> AuthLogin();
        return view('admin.add_category_product');
    }
    // [GET] /dashboard
    public function all_category_product(){
        //Lấy dữ liệu tbl_category_product
        //Lấy file all-category-product.blade.php -> kết nối file với database
        // Trả về admin_layout 
        $this -> AuthLogin();
        $all_category_product       =   DB::table('tbl_category_product') -> get();
    	$manager_category_product   =   view('admin.all_category_product') -> with('all_category_product',$all_category_product);
    	return view('admin-layout') ->  with('admin.all_category_product', $manager_category_product);
       
    }
    //[POST]
    public function save_category_product(Request $request){
        $this -> AuthLogin();
        $data = array();
        // CỘT SQL               = name="" trong add_category_product.blade
        $data['category_name']   = $request->category_product_name;
        $data['meta_keywords']   = $request->category_product_keywords;
        $data['category_desc']   = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_category_product') -> insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    // [GET]
    public function unactive_category_product($category_product_id){
        $this -> AuthLogin();
        DB::table('tbl_category_product') -> where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Tắt kích hoạt !');
        return Redirect::to('all-category-product');
    }
    
    // [GET]
    public function active_category_product($category_product_id){
        $this -> AuthLogin();
        DB::table('tbl_category_product') -> where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt !');
        return Redirect::to('all-category-product');
    }
    
    // [GET]
    public function edit_category_product($category_product_id){
        $this -> AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);

        return view('admin-layout')->with('admin.edit_category_product', $manager_category_product);
    }

    //[POST]
    public function update_category_product(Request $request, $category_product_id){
        $this -> AuthLogin();
        $data = array();
        // CỘT SQL             = name="" trong add_category_product.blade
        $data['category_name'] = $request->category_product_name;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['category_desc'] = $request->category_product_desc;

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    // [GET]
    public function delete_category_product($category_product_id){
        $this -> AuthLogin();
        $product_id  = DB::table('tbl_product') -> get();
        DB::table('tbl_category_product')
        ->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    // END funtion ADMIN PAGES

    public function show_category_home(Request $request, $category_id){
        $cate_product   = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $cate_seo   = DB::table('tbl_category_product') -> get(); 
        $brand_product  = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();
        $category_name  = DB::table('tbl_category_product') -> where('category_id',$category_id)->limit(1)->get();
        $category_by_id = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('category_status','1') 
        ->where('product_status','1')
        ->where('tbl_product.category_id',$category_id)->get();
        foreach ($cate_seo as $key => $val){
            // SEO
            $meta_des      =  $val->category_desc;
            $meta_keywords =  $val->meta_keywords;
            $meta_title    =  $val->category_name;
            $url_canonical =  $request->url();
            // end-SEO
        }
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)
        ->with('meta_des',$meta_des)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    
}