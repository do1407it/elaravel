<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use Illuminate\Support\Facades\Redirect;

session_start();

use App\Models\Coupon;


class CouponController extends Controller
{
    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupons = $coupon->count();
            if ($count_coupons > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code'      => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number'    => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    } 
                }else {
                    $cou[] = array(
                        'coupon_code'      => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number'    => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                // return Redirect::to('gio-hang')->with('message', 'Thêm mã giảm giá thành công');
            }
        } else {
            // return Redirect::to('gio-hang')->with('message', 'Thêm mã giảm giá Thất bại');
        }
        dump(Session::get('coupon'));
    }

    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }

    public function delete_coupon($coupon_id)
    {
        Coupon::where('coupon_id', $coupon_id)->delete();
        // Coupon::find($coupon_id)->delete(); // Dùng khi so sánh với id 
        Session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('all-coupon');
    }

    public function all_coupon()
    {
        $all_coupon = Coupon::orderBy('coupon_id', 'DESC')->get(); //Cách model
        $manager_brand_product = view('admin.coupon.all_coupon')->with(compact('all_coupon'));
        return view('admin.coupon.all_coupon')->with(compact('manager_brand_product', 'all_coupon'));
        dd($manager_brand_product, $all_coupon);
    }

    public function save_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name      = $data['coupon_name'];
        $coupon->coupon_code      = $data['coupon_code'];
        $coupon->coupon_time      = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number    = $data['coupon_number'];
        $coupon->save();

        Session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
}
