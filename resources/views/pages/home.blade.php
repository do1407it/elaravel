@extends('layout')
@section('content')

<div class="features_items">
    <!-- <div class="fb-share-button" data-href="http://localhost/shopbanhang/" data-layout="button_count" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">Chia sẻ</a>
    </div> -->

    <div class="fb-like" data-href="http://fashiondv.xyz/shopbanhang/" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>


    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    
    @foreach($product as $key => $product)
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        {{csrf_field()}}
                        <input type="hidden" value="{{$product -> product_id}}" class="cart_product_id_{{$product -> product_id}}">
                        <input type="hidden" value="{{$product -> product_name}}" class="cart_product_name_{{$product -> product_id}}">
                        <input type="hidden" value="{{$product -> product_image}}" class="cart_product_image_{{$product -> product_id}}">
                        <input type="hidden" value="{{$product -> product_price}}" class="cart_product_price_{{$product -> product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product -> product_id}}">
                        <a href="{{URL::to('chi-tiet-san-pham/'.$product -> product_id)}}">
                            <img src="{{URL::to('public/uploads/product/'.$product -> product_image)}}" style="width:255px;height:150px;" alt="product" />
                            <h2>{{$product -> product_name}}</h2>
                        </a>
                        <p>{{number_format($product -> product_price).' '.'VNĐ'}}</p>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product -> product_id}}"> <i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
                    </form>
                </div>
                <!-- <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($product -> product_price).' '.'VNĐ'}}</h2>
                        <p>{{$product -> product_content}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                    </div>
                </div> -->
            </div>
            <!-- <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>So Sánh</a></li>
                </ul>
            </div> -->
        </div>
    </div>
    @endforeach



</div>
<!--features_items-->




@endsection