@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->


        <div class="register-req">
            <p>Vui lòng điền đày đủ thông tin</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Thông tin chuyển hàng</p>
                        <div class="form-one">
                            <form method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone*">
                                <p>Ghi chú</p>
                                <textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn cho nhà vận chuyển" rows="5"></textarea>
                                <!-- Fee -->
                                @if (Session::get('fee'))
                                <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                                @else
                                <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                @endif
                                <!-- Coupon -->
                                @if (Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $value)
                                <input type="hidden" name="order_coupon" class="order_coupon" value="{{$value['coupon_code']}}">
                                @endforeach
                                @else
                                <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                    <select name="payment_select" class="form-control m-bot15 payment_select">
                                        <option value="0">Chuyển khoản</option>
                                        <option value="1">Tiền mặt</option>
                                    </select>
                                </div>
                                <input type="button" value="Gửi" name="send_order" class="btn btn-primary btn-sm send_order">
                            </form>

                            <form role="form" action="{{URL::to('/save-brand-product')}}" method="POST">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select id="city" name="city" class="form-control m-bot15 choose city">
                                        @foreach($city as $key => $value)
                                        <option value="{{$value->matp}}">{{$value->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select id="province" name="province" class="form-control m-bot15 choose province">
                                        <option value="">--Chọn--</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select id="wards" name="wards" class="form-control m-bot15  wards">
                                        <option value="">--Chọn--</option>

                                    </select>
                                </div>
                                <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 clearfix">
                    <div class="table-responsive cart_info">
                        <form action="{{url('/update-sp')}}" method="POST">
                            {{csrf_field()}}
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Hình ảnh</td>
                                        <td class="description">Sản phẩm</td>
                                        <td class="price">Giá</td>
                                        <td class="qty">Số lượng</td>
                                        <td class="total">Tổng tiền</td>
                                        <td></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(Session::get('cart')==true)
                                    @php
                                    dump(Session::get('cart'));
                                    $total = 0;
                                    @endphp
                                    @foreach(Session::get('cart') as $key => $value)
                                    @php
                                    $subtotal = $value['product_price'] * $value['product_qty'];
                                    $total += $subtotal;
                                    @endphp

                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img src="{{asset('public/uploads/product/'.$value['product_image'])}}" style="width:110px;height:110px;" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4><a href=""></a></h4>
                                            <p>Sản phẩm ID: {{$value['product_id']}} </p>
                                            <p>Tên sản phẩm: <span style="color:red">{{$value['product_name']}}</span>
                                            </p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{number_format($value['product_price']).' vnđ'}}</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">

                                                <input class="cart_quantity" type="number" name="cart_quantity[{{$value['session_id']}}]" value="{{$value['product_qty']}}" size="2" style="width:60px;" min="1">

                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">
                                                {{number_format($subtotal).' '.'vnđ'}}
                                            </p>
                                        </td>
                                        <td class="cart_delete">
                                            <a class="cart_quantity_delete" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-sp/'.$value['session_id'])}}"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td><input type="submit" value="Cập nhật" name="update" class="btn btn-default btn-sm" style="margin-left:12px;"></td>
                                        <td> <a class="btn btn-default check_out" style="margin:0;" href="{{URL::to('/delete-all')}}">Xoá tất cả</a></td>
                                        @if(Session::get('coupon'))
                                        <td> <a class="btn btn-default check_out" style="margin:0;" href="{{URL::to('/unset-coupon')}}">Xoá mã khuyến mãi</a></td>
                                        @endif
                                        <td>
                                            <li>Tổng tiền:
                                                <span>{{number_format($total).' '.'vnđ'}}</span>
                                            </li>
                                            <li>
                                                @if(Session::get('coupon'))
                                                @foreach(Session::get('coupon') as $key => $value)
                                                @if($value['coupon_condition']==1)
                                                Mã Giảm: {{$value['coupon_number']}}%
                                                <p>
                                                    @php
                                                    $total_coupon = ($total * $value['coupon_number'])/100;
                                                    echo '
                                            <li>Tổng giảm: '.number_format($total_coupon).' '.'vnđ'.'</li>';
                                            @endphp
                                            </p>
                                            <p>
                                                <li>Tổng tiền đã giảm:
                                                    {{number_format($total - $total_coupon).' '.'vnđ'}}
                                                </li>
                                            </p>
                                            @elseif($value['coupon_condition']==2)
                                            <p>
                                                Mã Giảm: {{$value['coupon_number']}} vnđ
                                                @php
                                                $total_coupon = $value['coupon_number'];
                                                echo '<li>Tổng giảm: '.number_format($total_coupon).' '.'vnđ'.'</li>';
                                                @endphp
                                            </p>
                                            <p>
                                                <li>Tổng tiền đã giảm: {{number_format($total-$total_coupon).' '.'vnđ'}}
                                                </li>
                                            </p>
                                            @endif
                                            @endforeach

                                            @endif
                                            </li>
                                            <!-- <li>Thuế<span></span></li> -->

                                            @if(Session::get('fee'))
                                            <li><a href="{{url('/delete-fee')}}">x</a> Phí vận chuyển:
                                                <span>{{Session::get('fee')}}</span>
                                            </li>
                                            @endif
                                            <li>Tổng tiền cuối cùng:
                                                <span>
                                                    @php
                                                    if (Session::get('fee') && !Session::get('coupon')){
                                                    $total_after = $total - Session::get('fee');
                                                    echo number_format($total_after).' '.'vnđ';
                                                    }elseif (!Session::get('fee') && Session::get('coupon')){
                                                    $total_after = $total-$total_coupon;
                                                    echo number_format($total_after).' '.'vnđ';
                                                    }elseif (Session::get('fee') && Session::get('coupon')){
                                                    $total_after_1 = Session::get('fee');
                                                    $total_after_2 = $total-$total_coupon;
                                                    echo number_format($total_after_1+$total_after_2).' '.'vnđ';
                                                    }else{
                                                    $total_after = $total;
                                                    echo number_format($total_after).' '.'vnđ';
                                                    }
                                                    @endphp
                                                </span>
                                            </li>

                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>
                                            @php
                                            echo 'Chưa có sản phẩm nào được thêm vào giỏ hàng';
                                            @endphp
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </form>
                        @if(Session::get('cart'))
                        <td>
                            <form action="{{url('/check-coupon')}}" method="POST" enctype="">
                                {{csrf_field()}}
                                <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                <input type="submit" class="btn btn-default check_out" style="margin:0;" name="check_coupon" value="Tính mã giảm giá" placeholder="Nhập mã giảm giá">
                            </form>
                        </td>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="review-payment">
            <h2>Hình thức thanh toán</h2>
        </div> -->


        <!-- <div class="payment-options">
            <span>
                <label><input name="payment_option" value="atm" type="checkbox"> Thanh toán ATM </label>
            </span>
            <span>
                <label><input name="payment_option" value="cash" type="checkbox"> Nhận tiền mặt </label>
            </span>
             <span>
                <label><input type="checkbox"> Paypal</label>
            </span> 
        </div> -->
    </div>
</section>
<!--/#cart_items-->

@endsection