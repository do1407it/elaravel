@extends('admin-layout')
@section('admin-content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê thương hiệu sản phẩm
        </div>
        <!-- <div class="row w3-res-tb" style="display:none">
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
                        //Lấy message
                        $message =Session::get('message');
                        
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message',null);
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
                        <th>Hiển thị</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_brand_product as $key => $values)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$values -> brand_name}}</td>
                        <td>
                            <?php
                                if($values -> brand_status == 1){
                            ?>
                            <a href="{{URL::to('/unactive-brand-product/'.$values->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                            <?php
                                }else{
                            ?>
                            <a href="{{URL::to('/active-brand-product/'.$values->brand_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                            <?php
                                }
                            ?>
                        </td>

                        <td style="display: flex;">
                            <a href="{{URL::to('/edit-brand-product/'.$values->brand_id)}}" ui-toggle-class="">
                                <i class="fas fa-edit text-success text-active"></i>
                            </a>
                            <a href="{{URL::to('/delete-brand-product/'.$values->brand_id)}}" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')" ui-toggle-class="">
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