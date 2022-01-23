@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>


<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý đơn hàng
        </div>
        <!-- <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div> -->
        <div class="table-responsive">
            <?php
                    $message = Session::get('message');
                    if($message){
                        echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);
                    }
                ?>
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <!-- <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th> -->
                        <th>Tên người đặt</th>
                        <th>Tình trạng</th>
                        <th>Tổng giá tiền</th>
                        <th>Hiển thị</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_order as $key => $order)
                    <tr>
                        <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
                        <td>{{$order->customer_name}}</td>
                        
                        <td>{{ $order->order_status }}</td>
                        <td>{{$order->order_total}} vnđ</td>
                        <!-- number_format($order->order_total).' '.'VNĐ' -->
                        <td style="display: flex;">
                            <a href="{{URL::to('/view-order/'.$order->order_id)}}" ui-toggle-class="">
                                <i class="fas fa-eye" style="font-size:24px;"></i>
                            </a>
                            <a href="{{URL::to('/delete-order/'.$order->order_id)}}"
                                onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')"
                                ui-toggle-class="">
                                <i class="fa fa-trash-alt text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- <footer class="panel-footer">
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
        </footer> -->
    </div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>
@endsection