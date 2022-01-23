@extends('layout')
@section('content')

<div class="features_items">

    <div class="fb-share-button" data-href="http://localhost:8080/shopbanhang/trang-chu" data-layout="button_count"
        data-size="small"><a target="_blank"
            href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
    <!--features_items-->
    @foreach($category_name as $key => $name)
    <h2 class="title text-center"><span style="color:pink">Danh mục: </span>{{$name -> category_name}}</h2>
    @endforeach

    @foreach($category_by_id as $key => $product)
    <a href="{{URL::to('chi-tiet-san-pham/'.$product -> product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$product -> product_image)}}"
                            style="width:255px;height:150px;" alt="product" />
                        <h2 style="font-weight: bold;">{{$product -> product_name}}</h2>
                        <p>{{number_format($product -> product_price).' '.'VNĐ'}}</p>
                        <a href="{{URL::to('chi-tiet-san-pham/'.$product -> product_id)}}"
                            class="btn btn-default add-to-cart"><i class="fas fa-caret-right"></i></i>Xem chi tiết</a>

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

@endsection