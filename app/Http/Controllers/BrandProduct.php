<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use App\Models\Brand;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

session_start();

class BrandProduct extends Controller
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
    // // [GET] /admin
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    // [GET] /dashboard
    public function all_brand_product()
    {
        $this->AuthLogin();
        // $all_brand_product = DB::table('tbl_brand') -> get(); //Cách DB::table('')
        // $all_brand_product = Brand::all(); //Cách model
        $all_brand_product = Brand::orderBy('brand_id', 'DESC')->get(); //Cách model
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin-layout')->with('admin.all_brand_product', $manager_brand_product);
    }
    //[POST]
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        // Cách 1:
        // $data = array();
        // // CỘT SQL            = name="" trong add_brand_product.blade
        // $data['brand_name']   = $request -> brand_product_name;
        // $data['meta_keywords']= $request -> brand_product_keywords;
        // $data['brand_desc']   = $request -> brand_product_desc;
        // $data['brand_status'] = $request -> brand_product_status;
        // DB::table('tbl_brand') -> insert($data);

        // Cách 2:
        $data = $request->all();
        $brand = new Brand(); //Dùng creat save
        // // CỘT SQL      = name="" trong add_brand_product.blade
        $brand->brand_name    = $data['brand_product_name'];
        $brand->meta_keywords = $data['brand_product_keywords'];
        $brand->brand_desc    = $data['brand_product_desc'];
        $brand->brand_status  = $data['brand_product_status'];
        $brand->save();

        Session::put('message', 'Thêm thương hiệu thành công');
        return Redirect::to('add-brand-product');
    }
    // [GET]
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', 'Tắt kích hoạt !');
        return Redirect::to('all-brand-product');
    }

    // [GET]
    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Kích hoạt !');
        return Redirect::to('all-brand-product');
    }

    // [GET]
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id', $brand_product_id)->get();
        // $edit_brand_product = Brand::find($brand_product_id);    

        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);

        return view('admin-layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    //[POST]
    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        // Cách controller
        // $data = array();
        // // CỘT SQL             = name="" trong add_brand_product.blade
        // $data['brand_name'] = $request->brand_product_name;
        // $data['meta_keywords'] = $request->brand_product_keywords;
        // $data['brand_desc'] = $request->brand_product_desc;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);

        // Cách model
        $data = $request->all();
        $brand = Brand::find($brand_product_id); //Dùng update
        // // CỘT SQL      = name="" trong add_brand_product.blade
        $brand->brand_name = $data['brand_product_name'];
        $brand->meta_keywords = $data['brand_product_keywords'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->save();

        Session::put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    // [GET]
    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('all-brand-product');
    }
    // END funtion ADMIN PAGES


    public function show_brand_home(Request $request, $brand_id)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $brand_seo  = DB::table('tbl_brand')->get();
        $brand_name = DB::table('tbl_brand')->where('brand_id', $brand_id)->limit(1)->get();
        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('product_status', '1')
            ->where('brand_status', '1')
            ->where('tbl_product.brand_id', $brand_id)->get();
        foreach ($brand_seo as $key => $val) {
            // SEO
            $meta_des      =  $val->brand_desc;
            $meta_keywords =  $val->meta_keywords;
            $meta_title    =  $val->brand_name;
            $url_canonical =  $request->url();
            // end-SEO
        }

        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
}
