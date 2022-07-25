@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>


<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Quản lý đơn hàng
        </div>
        <div class="row w3-res-tb">

        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Stt</th>
                        <th>Mã đơn hàng</th>
                        <th>Tình trạng đơn hàng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=0;
                    @endphp
                    @foreach($order as $key => $ord)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$ord->order_code}}</td>
                        <td>
                            @if ($ord->order_status == 1)
                            Đơn hàng mới
                            @else
                            Đơn hàng đã xử lý
                            @endif
                        </td>

                        <td style="display: flex;">
                            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" ui-toggle-class="">
                                <i class="fas fa-eye" style="font-size:24px;"></i>
                            </a>
                            <a href="{{URL::to('/delete-order/'.$ord->order_code)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')" ui-toggle-class="">
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