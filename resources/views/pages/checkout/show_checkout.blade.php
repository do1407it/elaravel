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
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                {{csrf_field()}}
                                <input type="text" name="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="Phone*">
                                <p>Ghi chú</p>
                                <textarea name="shipping_notes"
                                    placeholder="Ghi chú đơn hàng của bạn cho nhà vận chuyển" rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
                            </form>
                        </div>
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