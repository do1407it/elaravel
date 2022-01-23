@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" id="form2" action="{{URL::to('/save-category-product')}}" method="POST">
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
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input data-validation="length"
                                data-validation-error-msg="Vui lòng điền ít nhất [4-50] kí tự"
                                data-validation-length="4-50" type="text" name="category_product_name"
                                class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="editor1">Mô tả danh mục</label>
                            <textarea style="resize:none" rows="8" type="text" name="category_product_desc"
                                class="form-control" id="editor1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editor2">Từ khóa danh mục</label>
                            <textarea style="resize:none" rows="8" type="text" name="category_product_keywords"
                                class="form-control" id="editor2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_product_status" class="form-control m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                </div>

            </div>
        </section>

    </div>


</div>
<script>
CKEDITOR.replace('category_product_desc');
</script>


@endsection