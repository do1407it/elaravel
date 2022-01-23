@extends('admin-layout')
@section('admin-content')
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin tài khoản
        </div>

        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order_by_id[0]->customer_name}}</td>
                        <td>{{$order_by_id[0]->customer_phone}}</td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</div>
<br>
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>


        <div class="table-responsive">

            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người nhận hàng</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$order_by_id[0]->shipping_name}}</td>
                        <td>{{$order_by_id[0]->shipping_address}}</td>
                        <td>{{$order_by_id[0]->shipping_phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê chi tiết đơn hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <!-- <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label> -->
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_by_id[0]->order_list as $order)
                    <tr>
                        <td><label class="i-checks m-b-none">
                                <!-- <input type="checkbox" name="post[]"><i></i></label> -->
                        </td>
                        <td>{{$order->product_name}}</td>
                        <td>{{$order->product_sales_quantity}}</td>
                        <td>{{number_format($order->product_price)}} vnđ</td>
                        <td>{{number_format($order->product_price*$order->product_sales_quantity)}} vnđ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</div>
@endsection