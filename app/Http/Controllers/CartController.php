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
    public function gio_hang(Request $request)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $meta_des      = 'Giỏ hàng của bạn';
        $meta_keywords = 'Giỏ hàng Ajax';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        return view('pages.cart.cart_ajax')->with('category', $cate_product)->with('brand', $brand_product)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();

        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_avaiable = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }
            if ($is_avaiable == 0) {
                $cart[] = array(
                    'session_id'    =>  $session_id,
                    'product_id'    =>  $data['cart_product_id'],
                    'product_name'  =>  $data['cart_product_name'],
                    'product_image' =>  $data['cart_product_image'],
                    'product_qty'   =>  $data['cart_product_qty'],
                    'product_price' =>  $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id'    =>  $session_id,
                'product_id'    =>  $data['cart_product_id'],
                'product_name'  =>  $data['cart_product_name'],
                'product_image' =>  $data['cart_product_image'],
                'product_qty'   =>  $data['cart_product_qty'],
                'product_price' =>  $data['cart_product_price'],

            );
        }
        Session::put('cart', $cart);
        Session::save();    
      
    }
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity  = $request->quantity;
        $product_info = TblCart::byId($productId)->first();

        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
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


    public function show_cart(Request $request)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $meta_des      = 'Chi tiết sản phẩm';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }

    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('show-cart');
    }

    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;

        Cart::update($rowId, $qty);
        return Redirect::to('show-cart');
    }
}
