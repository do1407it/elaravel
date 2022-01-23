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


        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php 
				$content = Cart::content();
				// echo '<pre>';
				// print_r($content);
				// echo '</pre>';
				?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="qty">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $value_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$value_content->options->image)}}"
                                    style="width:110px;height:110px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value_content -> name}}</a></h4>
                            <p>Sản phẩm ID: {{$value_content -> id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($value_content -> price).' vnđ'}} </p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{csrf_field()}}
                                    <input class="cart_quantity_input" type="number" name="cart_quantity"
                                        value="{{$value_content -> qty}}" size="2" style="width:60px;" min="1">
                                    <input type="hidden" value="{{$value_content -> rowId}}" name="rowId_cart"
                                        class="btn btn-default btn-sm">
                                    <input type="submit" value="Cập nhật" name="update_qty"
                                        class="btn btn-default btn-sm" style="margin-left:12px;">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php 
									$subtotal = ($value_content -> price) * ($value_content -> qty); // giá * số lượng
									echo number_format($subtotal).' '.'vnđ';
								?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"
                                onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')"
                                href="{{URL::to('/delete-to-cart/'.$value_content -> rowId)}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="review-payment">
            <h2 style="line-height: 60px;">Hình thức thanh toán</h2>
        </div>
        <form action="{{URL::to('/order-place')}}" method="POST">
            {{csrf_field()}}
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="atm" type="checkbox"> Thanh toán ATM </label>
                </span>
                <span>
                    <label><input name="payment_option" value="cash" type="checkbox"> Nhận tiền mặt </label>
                </span>
                <span>
                    <label><input name="payment_option" value="debitcard" type="checkbox"> Thẻ ghi nợ </label>
                </span>

                <input type="submit" value="Đặt hàng" name="send_order_play" class="btn btn-primary btn-sm" style="margin:0px;">
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->

@endsection