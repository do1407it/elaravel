@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
                <li class="active">Giỏ hàng của bạn</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
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
                    @php 
                    dump(Session::get('cart'));
                    @endphp
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="" style="width:110px;height:110px;" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""></a></h4>
                            <p>Sản phẩm ID: </p>
                        </td>
                        <td class="cart_price">
                            <p> </p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="" method="POST">
                                    <input class="cart_quantity_input" type="number" name="cart_quantity" value="" size="2" style="width:60px;" min="1">
                                    <input type="hidden" value="" name="rowId_cart" class="btn btn-default btn-sm">
                                    <input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm" style="margin-left:12px;">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price"></p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này không?')" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Thanh toán</h3>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tạm tím<span></span></li>
                        <li>Thuế<span></span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Tổng tiền<span></span></li>
                        <!-- total (tổng = thuế + tạm tính) -->
                    </ul>
                    <!-- <a class="btn btn-default update" href="">Update</a> -->
                    <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                    <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->

@endsection