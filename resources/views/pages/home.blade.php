@extends('layout')
@section('content')

<div class="features_items">
    <!-- <div class="fb-share-button" data-href="http://localhost/shopbanhang/" data-layout="button_count" data-size="small">
        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">Chia sẻ</a>
    </div> -->

    <div class="fb-like" data-href="http://fashiondv.xyz/shopbanhang/" data-width="" data-layout="button_count"
        data-action="like" data-size="small" data-share="true"></div>
    

    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>

    @foreach($product as $key => $product)
    <a href="{{URL::to('chi-tiet-san-pham/'.$product -> product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$product -> product_image)}}"
                            style="width:255px;height:150px;" alt="product" />
                        <h2>{{$product -> product_name}}</h2>
                        <p>{{number_format($product -> product_price).' '.'VNĐ'}}</p>
                        <a href="{{URL::to('/save-cart')}}" class="btn btn-default add-to-cart"><i
                                class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
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
    </a>
    @endforeach



</div>
<!--features_items-->




@endsection