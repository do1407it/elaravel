<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use Cart;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

session_start();

class  CheckoutController extends Controller
{
    public function AuthLogin()
    {
        if (Session::get('login_normal') || Session::get('admin_id')) {
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

    public function confirm_order(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();
        $order = new Order();
        // tbl_shipping
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        // tbl_order
        $check_code = substr(md5(microtime()), rand(0, 26), 5);
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping->shipping_id;
        $order->order_status = 1;
        $order->order_code = $check_code;
        $order->save();
        // tbl_order_details
        if (Session::get('cart') == true) {
            foreach (Session::get('cart') as $key => $cart) {
                $order_details = new OrderDetails();
                $order_details->order_code = $check_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $order_details->created_at = now();
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        if ($data['city']) {
            $fee_ship = Feeship::where('fee_matp', $data['city'])->where('fee_maqh', $data['province'])->where('fee_xaid', $data['wards'])->get();
            if ($fee_ship) {
                $count_feeship = $fee_ship->count();
                if ($count_feeship > 0) {
                    foreach ($fee_ship as $key => $value) {
                        Session::put('fee', $value->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 10000);
                    Session::save();
                }
            }
        }
    }

    public function delete_fee()
    {
        Session::forget('fee');
        return Redirect::to('/checkout');
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();
                $output .= '<option>--Chọn quận huyện--</option>';
                foreach ($select_province as $key => $value) {
                    $output .= '<option value="' . $value->maqh . '">' . $value->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();
                $output .= '<option>--Chọn xã phường--</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
    }

    public function login_checkout(Request $request)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        $meta_des      = 'Đăng nhập, đăng ký';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }
    // public function forgot_password(Request $request){
    //     $data = $request->all();
    //     $date = new DateTime();
    //     // print_r($data['sdt']);
    //     if(!isset($data['sdt'])){
    //         $code = Str::random(6);
    //         $khachhang = DB::table('khachhang')->where('email_kh',$data['email'])->first();
    //         DB::table('taikhoan')->where('id_kh',$khachhang->id_kh)->update(['phone_code' => $code,'updated_at'=>$date->format('Y-m-d H:i:s')]);

    //         $details = [
    //             'phone_code' => $code,
    //             'url' => route('checkpass',$khachhang->id_kh),
    //         ];
    //         Mail::to($khachhang->email_kh)->send(new \App\Mail\ForgotPassword($details));
    //     } elseif(isset($data['sdt'])){
    //         $code = Str::random(6);
    //         $khachhang = DB::table('khachhang')->where('sdt_kh',$data['sdt'])->first();
    //         DB::table('taikhoan')->where('id_kh',$khachhang->id_kh)->update(['phone_code' => $code,'updated_at'=>$date->format('Y-m-d H:i:s')]);
    //         $details =[
    //             'phone_code' => $code,
    //             'url' => route('checkpass',$khachhang->id_kh),
    //         ];

    //         return Nexmo::message()->send([
    //             'to'   => $khachhang->sdt_kh,
    //             'from' => '0396739457',
    //             'text' => "{$code} is your identity code.Truy cập vào link:<a href='{$details['url']}'>{$details['url']}</a>"
    //         ]);
    //     }
    // }

    public function save_customer(Request $request)
    {

        $data = array();
        $data['customer_name']      = $request->customer_name;
        $data['customer_email']     = $request->customer_email;
        $data['customer_phone']     = $request->customer_phone;
        $data['customer_password']  = md5($request->customer_password);

        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('checkout');
    }
    public function checkout(Request $request)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $meta_des      = 'Thông tin chuyển hàng';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        $city = City::orderBy('matp', 'asc')->get();

        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical)->with('city', $city);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }

    public function payment(Request $request)
    {
        $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $meta_des      = 'Thông tin chuyển hàng';
        $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
        $meta_title    = 'Laptop giá rẻ, chất lượng cao';
        $url_canonical = $request->url();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)
            ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
    }

    public function order_place(Request $request)
    {
        // $content = Cart::content();
        // echo $content;
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id']      = $order_id;
            $order_d_data['product_id']    = $v_content->id;
            $order_d_data['product_name']  = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 'atm') {
            Cart::destroy();
            echo 'Thanh toán atm';
        } elseif ($data['payment_method'] == 'cash') {
            Cart::destroy();
            $cate_product  = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
            $meta_des      = 'Lưu thông tin giỏ hàng';
            $meta_keywords = 'laptop, may tinh, máy tính giá rẻ';
            $meta_title    = 'Laptop giá rẻ, chất lượng cao';
            $url_canonical = $request->url();
            return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product)
                ->with('meta_des', $meta_des)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('url_canonical', $url_canonical);
        } else {
            Cart::destroy();
            echo 'Thẻ ghi nợ';
        }


        //    return Redirect::to('/payment'); 
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email    =     $request->email_account;
        $password = md5($request->password_account);
        // Lấy table tb_admin -> Kiểm tra email -> kiểm tra password -> Lấy giới hạn 1 user
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        // echo '<pre>';
        // print_r($result);    
        // echo '</pre>';
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return Redirect::to('/checkout');
        } else {
            Session::put('message', 'Email hoặc mật khẩu của bạn nhập sai. Làm ơn nhập lại');
            return Redirect::to('/login-checkout');
        }
    }

    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name')
            ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin-layout')->with('admin.manage_order', $manager_order);
    }

    public function view_order($orderId)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            // ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
            // ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')
            ->where('tbl_order.order_id', $orderId)
            ->orderby('tbl_order.order_id', 'desc')
            // ->firt();
            ->get();

        $order_by_id = collect($order_by_id)->transform(function ($item) {
            $item->order_list = DB::table('tbl_order_details')->where('order_id', '=', $item->order_id)->get();
            return $item;
        });

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin-layout')->with('admin.view_order', $manager_order_by_id);
    }

    public function delete_order($order_id)
    {
        $this->AuthLogin();
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        Session::put('message', 'Xóa đơn hàng thành công');
        return Redirect::to('manage-order');
    }
}
