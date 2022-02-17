@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" id="form2" action="{{URL::to('/save-coupon')}}" method="POST">
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
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input data-validation="length"
                                data-validation-error-msg="Vui lòng điền ít nhất [4-50] kí tự"
                                data-validation-length="4-50" type="text" name="coupon_name"
                                class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="editor1">Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editor2">Số lượng mã</label>
                            <input type="text" name="coupon_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng</label>
                            <select name="coupon_condition" class="form-control m-bot15">
                                <option value="0">--Chọn--</option>
                                <option value="1">Giảm giá bằng phần trăm</option>
                                <option value="2">Giảm giá bằng tiền</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editor2">Nhập số phần trăm hoặc tiền giảm</label>
                            <input type="text" name="coupon_number" class="form-control">
                        </div>

                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                    </form>
                </div>

            </div>
        </section>

    </div>


</div>
<script>
CKEDITOR.replace('coupon_desc');
</script>


@endsection