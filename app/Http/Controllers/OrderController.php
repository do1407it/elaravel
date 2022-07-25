<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;

class OrderController extends Controller
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
    public function manage_order()
    {
        $this->AuthLogin();
        $order =  Order::orderby('order_id', 'DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($orderCode)
    {
        $this->AuthLogin();
        $order_details =  OrderDetails::orderby('order_details_id', 'DESC')->get();
        return view('admin.view_order')->with(compact('order_details'));
    }
}
