<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // use DB;
use Illuminate\Support\Facades\Session; // use Session;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $city = City::orderBy('matp', 'asc')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp    = $data['city'];
        $fee_ship->fee_maqh    = $data['province'];
        $fee_ship->fee_xaid    = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
    }
    public function update_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_ship->fee_feeship = rtrim($data['fee_price'], '.');
        $fee_ship->save();
    }
    public function select_delivery(Request $request)
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

    public function select_feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
            <table class="table table-bordered">
            <thread>
                <tr>
                    <th>Thành phố</th>
                    <th>Quận huyện</th>
                    <th>Xã phường</th>
                    <th>Phí ship</th>
                </tr>
            </thread>
            <tbody>';
        foreach ($feeship as $key => $value) {
            $output .= '
                <tr>
                    <td>' . $value->city->name_city . '</td>
                    <td>' . $value->province->name_quanhuyen . '</td>
                    <td>' . $value->wards->name_xaphuong . '</td>
                    <td contenteditable data-feeship_id=' . $value->fee_id . ' class="feeship_edit">' . number_format($value->fee_feeship, 0, ',', '.') . '</td>
                </tr>';
        }
        $output .= '
                </tbody>
                </table>
                </div>
            ';
        echo $output;
    }
}
