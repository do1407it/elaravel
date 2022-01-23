<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\TblCart;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request){
        $productId = $request->productid_hidden;
        $quantity  = $request->quantity;
        $product_info = TblCart::byId($productId)->first(); 
        
        $cate_product  = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $brand_product = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();
        // echo '<pre>';
        // print_r($data); 
        // echo '<pre>';
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();

        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data); 
        Cart::setGlobalTax(0); //set thuế toàn cục
        // Cart::destroy();
        return Redirect::to('show-cart');
    }

    public function show_cart(Request $request){
        $cate_product  = DB::table('tbl_category_product') -> where('category_status','1') -> orderBy('category_id', 'desc') -> get(); 
        $brand_product = DB::table('tbl_brand') -> where('brand_status','1') -> orderBy('brand_id', 'desc') -> get();
        $meta_des      = 'Chi tiết sản phẩm';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('meta_des',$meta_des)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);   
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('show-cart');
    }

    public function update_cart_quantity(Request $request){
        $rowId = $request-> rowId_cart;
        $qty = $request -> cart_quantity;

        Cart::update($rowId, $qty);
        return Redirect::to('show-cart');
    }
}