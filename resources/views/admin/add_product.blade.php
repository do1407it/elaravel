@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-product')}}" method="POST" enctype="multipart/form-data"
                        id="form1">
                        {{csrf_field()}}
                        <?php
                        //Lấy message
                        $message =Session::get('message');
                        
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
                        }
                        ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input data-validation="length"
                                data-validation-error-msg="Vui lòng điền ít nhất [6-50] kí tự"
                                data-validation-length="6-50" type="text" name="product_name" class="form-control"
                                id="exampleInputEmail1" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number"
                                data-validation-error-msg="Vui lòng điền giá lại"
                                data-validation-allowing="range[1;9999999999999]" name="product_price"
                                class="form-control" id="exampleInputEmail1" placeholder="Nhập giá sản phẩm">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input data-validation="length mime size" data-validation-length="min1"
                                data-validation-error-msg-length="Bạn cần tải lên ít nhất 1 hình ảnh" type="file"
                                name="product_image" class="form-control" multiple="multiple" id="avatar">
                            <span class="form-message" style="color:red;"></span>

                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none" rows="8" type="text" name="product_desc" class="form-control"
                                id="editor1" id="txtarea_consolidation"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize:none" rows="8" type="text" name="product_content"
                                class="form-control" id="txtarea_consolidation" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control m-bot15">
                                @foreach($cate_product as $key => $cate)
                                <option value="{{$cate -> category_id}}">{{$cate -> category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control m-bot15">
                                @foreach($brand_product as $key => $brand)
                                <option value="{{$brand -> brand_id}}">{{$brand -> brand_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
</div>
<script>
CKEDITOR.replace('product_content');
CKEDITOR.replace('product_desc');
</script>
<script>
Validator({
    form: '#form1',
    errorSelector: '.form-message',
    formGroupSelector: '.form-group',
    rules: [
        Validator.isFile('#avatar'),
    ]
});
</script>

@endsection