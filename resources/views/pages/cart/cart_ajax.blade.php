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
        <?php
        //Lấy message
        $message = Session::get('message');

        if ($message) {
            echo '<span class="text-alert">' . $message . '</span>';
            Session::put('message', null);
        }
        ?>
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
                                <p>Tên sản phẩm: <span style="color:red">{{$value['product_name']}}</span></p>
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
                            <td>
                                <li>Tạm tím
                                    <span>{{number_format($total).' '.'vnđ'}}</span>
                                </li>
                                <li>Thuế<span></span></li>
                                <li>Phí vận chuyển <span>Free</span></li>
                                <li>Tổng tiền<span></span></li>

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

            <td>
                <form action="{{url('/check-coupon')}}" method="POST" enctype="">
                {{csrf_field()}}
                    <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                    <input type="submit" class="btn btn-default check_out" style="margin:0;" name="check_coupon" value="Tính mã giảm giá" placeholder="Nhập mã giảm giá">
                </form>
            </td>
        </div>
    </div>
</section>
<!--/#cart_items-->


@endsection