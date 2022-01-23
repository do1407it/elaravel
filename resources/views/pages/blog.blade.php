@extends('layout')
@section('content')

<div class="blog-post-area">
    <h2 class="title text-center">Tin tức của chúng tôi</h2>
    <div class="single-blog-post">
        <h3>Tin tức về cửa hàng</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Đình Đô</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
        </div>
        <a href="">
            <img src="{{URL::to('public/fontend/images/blog.png')}}" alt="">
        </a>
        <p>Với tình thương yêu bệnh nhân cùng chuyên môn về tâm lý lâm sàng của mình, chị Hà đã vượt qua các trở ngại để đồng hành và chia sẻ với những F0 bị khủng hoảng tinh thần.</p>
        <a class="btn btn-primary" href="">Xem thêm</a>
    </div>
    <div class="single-blog-post">
        <h3>Tin tức về thông tin</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Đình Đô</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
        </div>
        <a href="">
            <img src="{{URL::to('public/fontend/images/blog3.png')}}" alt="">
        </a>
        <p>Với tình thương yêu bệnh nhân cùng chuyên môn về tâm lý lâm sàng của mình, chị Hà đã vượt qua các trở ngại để đồng hành và chia sẻ với những F0 bị khủng hoảng tinh thần.</p>
        <a class="btn btn-primary" href="">Xem thêm</a>
    </div>
    <div class="single-blog-post">
        <h3>Tin tức về sản phẩm</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Gia Vinh</li>
                <li><i class="fa fa-clock-o"></i> 2:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
        </div>
        <a href="">
            <img src="{{URL::to('public/fontend/images/blog2.jpg')}}" alt="">
        </a>
        <p>Với tình thương yêu bệnh nhân cùng chuyên môn về tâm lý lâm sàng của mình, chị Hà đã vượt qua các trở ngại để đồng hành và chia sẻ với những F0 bị khủng hoảng tinh thần.</p>
        <a class="btn btn-primary" href="">Xem thêm</a>
    </div>
    <div class="pagination-area">
        <ul class="pagination">
            <li><a href="" class="active">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
        </ul>
    </div>
</div>


@endsection