<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use App\Models\Category;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin()
    {
        if (Session::get('login_normal')) {
            $admin_id = Session::get('admin_id');
        } else {
            $admin_id = Auth::id();
        }
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    // [GET] /admin
    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    // [GET] /dashboard
    public function all_category_product()
    {
        //Lấy dữ liệu tbl_category_product
        //Lấy file all-category-product.blade.php -> kết nối file với database
        // Trả về admin_layout 
        $this->AuthLogin();
        $all_category_product       =   Category::get();
        $manager_category_product   =   view('admin.all_category_product')->with(compact('all_category_product'));
        return view('admin-layout') ->  with(compact('manager_category_product'));
    }
    //[POST]
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        // Cách 2:
        $data = $request->all();
        $category = new Category(); //Dùng creat save
        // // CỘT SQL      = name="" trong add_category_product.blade
        $category->category_name    = $data['category_product_name'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_desc    = $data['category_product_desc'];
        $category->category_status  = $data['category_product_status'];
        $category->save();

        Session::put('message', 'Thêm danh mục thành công');
        return Redirect::to('add-category-product');
    }
    // [GET]
    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Tắt kích hoạt !');
        return Redirect::to('all-category-product');
    }

    // [GET]
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Kích hoạt !');
        return Redirect::to('all-category-product');
    }

    // [GET]
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product      =  Category::where('category_id', $category_product_id)->get();

        $manager_category_product   =  view('admin.edit_category_product')->with(compact('edit_category_product'));

        return view('admin-layout') -> with(compact('manager_category_product'));
    }

    //[POST]
    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $category = Category::find($category_product_id); //Dùng update
        // // CỘT SQL      = name="" trong add_category_product.blade
        $category->category_name = $data['category_product_name'];
        $category->meta_keywords = $data['category_product_keywords'];
        $category->category_desc = $data['category_product_desc'];
        $category->save();

        Session::put('message', 'Cập nhật danh mục thành công');
        return Redirect::to('all-category-product');
    }
    // [GET]
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        $product_id  = DB::table('tbl_product')->get();
        Category::where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    // END funtion ADMIN PAGES

    public function show_category_home(Request $request, $category_id)
    {
        $cate_product   = Category::where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $cate_seo   = Category::get();
        $category_product  = DB::table('tbl_category')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $category_name  = Category::where('category_id', $category_id)->limit(1)->get();
        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
            ->where('category_status', '1')
            ->where('category_status', '1')
            ->where('product_status', '1')
            ->where('tbl_product.category_id', $category_id)->get();
        foreach ($cate_seo as $key => $val) {
            // SEO
            $meta_des      =  $val->category_desc;
            $meta_keywords =  $val->meta_keywords;
            $meta_title    =  $val->category_name;
            $url_canonical =  $request->url();
            // end-SEO
        }
        return view('pages.category.show_category')->with('category', $cate_product)->with('category', $category_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
}
