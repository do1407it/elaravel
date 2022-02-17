@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê mã giảm giá
        </div>

        <div class="table-responsive">
            <?php
            //Lấy message
            $message = Session::get('message');

            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên danh mục</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng</th>
                        <th>Tính năng</th>
                        <th>Số phần trăm hoặc tiền giảm</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_coupon as $key => $values)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$values -> coupon_name}}</td>
                        <td>{{$values -> coupon_code}}</td>
                        <td>{{$values -> coupon_time}}</td>
                        <td>
                            <?php
                            if ($values->coupon_condition == 1) {
                            ?>
                                <span>Giá {{$values -> coupon_number}}%</span>
                            <?php
                            } else {
                            ?>
                                <span>Giá {{$values -> coupon_number}}k</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>{{$values -> coupon_number}}</td>

                        <td style="display: flex;">
                            <a href="{{URL::to('/edit-brand-product/'.$values->coupon_id)}}" ui-toggle-class="">
                                <i class="fas fa-edit text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-coupon/'.$values->coupon_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')" ui-toggle-class="">
                                <i class="fa fa-trash-alt text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer" style="display:none">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection